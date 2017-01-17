<?php
/**
 * Template Variables
 * ==================
 *
 * This library allows you to pass data to templates when loading them. It
 * provides two functions: `ai_get_template_part()` and `ai_get_var()`. The former
 * is a drop-in replacement for `get_template_part()`, but allows you to pass an
 * array of data to be used in the template. For instance,
 *
 *     ai_get_template_part( 'loop', 'single', array( 'image_size' => 'thumbnail' ) );
 *
 * The latter allows you to safely retrieve that variable, and also set a
 * default value, should it not be set. For instance,
 *
 *     the_post_thumbnail( ai_get_var( 'image_size', 'medium' ) );
 *
 * In the above code, since 'image_size' was set, the image will be loaded in
 * the 'thumbnail' size. If 'image_size' had not been set, the 'medium'-sized
 * image would have been used.
 *
 * You might find it easier to use `ai_get_template_part()` exclusively over
 * `get_template_part()`. Avoiding a mix of the two helps prevent potentially
 * unexpected results in a cascade like:
 *
 *     Template A: ai_get_template_part( 'B', array( 'size' => 'large' ) );
 *     Template B: get_template_part( 'C' );
 *     Template C: the_post_thumbnail( ai_get_var( 'size', 'small' ) );
 *
 * which would call `the_post_thumbnail( 'large' )` in template C. If you
 * exclusively use `ai_get_template_part()`, the data will be scoped to the
 * requested template, and not available within any templates it loads through
 * `ai_get_template_part()`.
 */

if ( ! function_exists( 'ai_get_template_part' ) ) :

	/**
	 * Get a template part while setting a global variable that can be read from within the template.
	 *
	 * $name can be ommitted, and $variables can optionally be the second function argument. e.g.
	 *      ai_get_template_part( 'sidebar', array( 'image_size' => 'thumbnail' ) )
	 *
	 * @param string $slug Template slug. @see get_template_part().
	 * @param string $name Optional. Template name. @see get_template_part().
	 * @param array $variables Optional. key => value pairs you want to access from the template.
	 * @return void
	 */
	function ai_get_template_part( $slug, $name = null, $variables = array() ) {
		global $ai_vars, $post;
		if ( ! is_array( $ai_vars ) ) {
			$ai_vars = array();
		}

		list( $name, $variables ) = _ai_fix_template_part_args( $name, $variables );

		// We add the variables to the end of the array, as variables will
		// always be pulled from the top (the currently activate template). This
		// allows us to nest templates without crossing our streams.
		$ai_vars[] = $variables;

		// We store the current global post to ensure that our template part
		// doesn't modify it.
		$current_post = $post;

		get_template_part( $slug, $name );

		// If our template part changed the global post, we'll reset it to what
		// it was before loading the template part. Note that we're not calling
		// wp_reset_postdata() because $post may not have been the current post
		// from the global query.
		if ( $current_post !== $post ) {
			$post = $current_post;
			setup_postdata( $post );
		}

		// Lastly, we pop the variables off the top of the array
		array_pop( $ai_vars );
	}

endif;


if ( ! function_exists( 'ai_get_var' ) ) :

	/**
	 * Get a value from the global ai_vars array.
	 *
	 * @param  string $key The key from the variables.
	 * @param  mixed $default Optional. If the key is not in $ai_vars, the function returns this value. Defaults to null.
	 * @return mixed Returns $default.
	 */
	function ai_get_var( $key, $default = null ) {
		global $ai_vars;
		if ( empty( $ai_vars ) ) {
			return $default;
		}

		$current_template = end( $ai_vars );
		if ( isset( $current_template[ $key ] ) ) {
			return $current_template[ $key ];
		}
		return $default;
	}

endif;


if ( ! function_exists( 'ai_loop_template_part' ) ) :

	/**
	 * Iterate a WP_Query or array over a given template part.
	 *
	 * @param WP_Query|array $source WP_Query object or array of items to
	 *                               iterate over.
	 * @param string $slug Template slug. @see ai_get_template_part().
	 * @param string $name Optional. Template name. @see ai_get_template_part().
	 * @param array $variables Optional. Variables for the template.
	 *                         @see ai_get_template_part.
	 */
	function ai_loop_template_part( $source, $slug, $name = null, $variables = array() ) {
		list( $name, $variables ) = _ai_fix_template_part_args( $name, $variables );

		if ( $source instanceof WP_Query ) {
			return _ai_loop_template_part_query( $source, $slug, $name, $variables );
		} elseif ( is_array( $source ) ) {
			return _ai_loop_template_part_array( $source, $slug, $name, $variables );
		}
	}

	/**
	 * Run "The Loop" over a given template part.
	 *
	 * @access private
	 *
	 * @param WP_Query $query WP_Query object.
	 * @param string $slug Template slug. @see ai_get_template_part().
	 * @param string $name Template name. @see ai_get_template_part().
	 * @param array $variables Variables for the template. Adds 'index' which is
	 *                         the index of the current post.
	 *                         @see ai_get_template_part.
	 */
	function _ai_loop_template_part_query( $query, $slug, $name, $variables ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$variables['index'] = $query->current_post;
			ai_get_template_part( $slug, $name, $variables );
		}
	}

	/**
	 * Run "The Loop" over an array of posts. This will run `setup_postdata()`
	 * with each post, so that normal loop rules can apply.
	 *
	 * @access private
	 *
	 * @param array $items The posts to iterate over.
	 * @param string $slug Template slug. @see ai_get_template_part().
	 * @param string $name Template name. @see ai_get_template_part().
	 * @param array $variables Variables for the template. Adds 'index' which is
	 *                         the index of the current post.
	 *                         @see ai_get_template_part.
	 */
	function _ai_loop_template_part_array( $items, $slug, $name, $variables ) {
		global $post;
		foreach ( $items as $i => $post ) {
			setup_postdata( $post );
			$variables['index'] = $i;
			ai_get_template_part( $slug, $name, $variables );
		}
	}

endif;


if ( ! function_exists( 'ai_iterate_template_part' ) ) :

	/**
	 * Iterate over an array of arbitrary items, passing the index and item to a
	 * given template part.
	 *
	 * This function will load the given partial and add two variables to its
	 * variables array: `index` and `item`. `index` will hold the array key, and
	 * `item` will hold the array value.
	 *
	 * @param array $items The items to iterate over.
	 * @param string $slug Template slug. @see ai_get_template_part().
	 * @param string $name Template name. @see ai_get_template_part().
	 * @param array $variables Variables for the template. Adds 'index' and
	 *                         'item' as noted above. @see ai_get_template_part.
	 */
	function ai_iterate_template_part( $items, $slug, $name = null, $variables = array() ) {
		list( $name, $variables ) = _ai_fix_template_part_args( $name, $variables );

		foreach ( (array) $items as $index => $item ) {
			ai_get_template_part( $slug, $name, array_merge( $variables, array( 'item' => $item, 'index' => $index ) ) );
		}
	}

endif;

if ( ! function_exists( '_ai_fix_template_part_args' ) ) {

	/**
	 * Sort out `$name` and `$variables` for all of the custom template part
	 * functions.
	 *
	 * `$name` comes before `$variables` in the argument order, but is optional.
	 * This helper determines if `$name` was actually provided or not.
	 *
	 * @access private
	 *
	 * @param  mixed $name Technically, `$name` should be a string or null.
	 *                     However, because it's optional, it might be an array.
	 *                     In that case, it will be reset to null and its value
	 *                     transferred to `$variables`.
	 * @param  array $variables Variables to pass to template partials.
	 * @return array In the format: `array( $name, $variables )`. This can be
	 *               used with `list()` very easily.
	 */
	function _ai_fix_template_part_args( $name, $variables ) {
		if ( is_array( $name ) ) {
			$variables = $name;
			$name = null;
		}

		return array( $name, $variables );
	}

}
