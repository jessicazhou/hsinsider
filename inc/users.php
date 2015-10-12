<?php
/**
 * Custom roles and capabilities
 */

class HSInsider_Special_Users {

	private $role = 'student';

	public function __construct() {
		
		//Unlike core add_role functions, which should only be run once,
		//The wpcom_vip_add_role function should be run every load
		add_action( 'init', array( $this, 'add_role' ), 1 );
		
		//Modify the user capabilities to give students the edit_others_posts cap under _very_ strict circumstances
		add_filter( 'user_has_cap', array( $this, 'polldaddy_fake_editor' ), 10, 3 );
	
		if( !is_admin() )
			return;
			
		//Add a column to the users page to manage schools
		add_filter( 'manage_users_columns', array( &$this, 'add_user_column_schools' ) );
		add_action( 'manage_users_custom_column', array( &$this, 'show_user_column_schools' ), 10, 3 );
		
		//Print the JS to make the ajax request
		add_action( 'admin_head', array( &$this, 'print_user_school_js' ) );
		
		//Save changes to user school
		add_action( 'wp_ajax_user_school', array( &$this, 'ajax' ) );
		
		//Show the school dropdown on the add user form in the admin and check the form before it's submitted
		add_action( 'user_new_form', array( &$this, 'user_form_school_dropdown' ) );
		add_action( 'admin_head', array( &$this, 'user_form_school_check' ) );
		add_action( 'user_register', array( &$this, 'user_form_school_save' ) );
	
		//If the user is a student, remove the school meta box, show a meta
		//box that instead gives them instructions or whatever, and automatically
		//set the user's school as the story term
		add_action( 'add_meta_boxes', array( &$this, 'add_meta_boxes' ) );
		add_action( 'add_meta_boxes', array( &$this, 'remove_meta_boxes' ), 99 );
		add_action( 'save_post', array( &$this, 'save_school' ) );
		add_action( 'save_post', array( &$this, 'save_poll' ) );
		
		//User settings to associate a user with a school
		add_action( 'show_user_profile', array( &$this, 'profile_role_edit' ) );
		add_action( 'edit_user_profile', array( &$this, 'profile_role_edit' ) );
		add_action( 'personal_options_update', array( &$this, 'profile_role_save' ) );
		add_action( 'edit_user_profile_update', array( &$this, 'profile_role_save' ) );
	}

	
	/*
	 * Adds the student role
	 * Hey VIP can we talk about changing the perfectly fine core role management functions?
	 *
	 */
	public function add_role() {
		wpcom_vip_add_role( $this->role,
			__( 'Student' ),
			array(
				'read' => true,
				'edit_posts' => true,
				'upload_files' => true,
				'edit_published_posts' => false,
				'level_1' => true,
			)
		);
	}
	
	/*
	 * Oh my hack batman
	 *
	 * Basically, we want students to be able to edit add polls, which requires the edit_others_posts
	 * cap, but we don't want them to actually be able to edit others posts. So we intercept the 
	 * user_has_cap request and see which function is requesting the cap. 
	 * 
	 * I anticipate this breaking around 10,000 times.
	 * 
	 * It would be super swell if the Polldaddy plugin used custom caps instead of hooking
	 * on to WordPress defaults. Just sayin'.
	 *
	 */
	public function polldaddy_fake_editor( $allcaps, $caps, $args ) {
			
		if( array( 0 => 'edit_others_posts' ) == $caps && ( $backtrace = debug_backtrace() ) && $backtrace[ 6 ][ 'class' ] == 'WPORG_Polldaddy' && $backtrace[ 6 ][ 'function' ] == '__construct' )
			$allcaps[ 'edit_others_posts' ] = 1;

		return $allcaps;
	}
	
	
	/*
	 * Adds a dropdown to select a school to associate with a user on the new user page
	 * Hurrah static variables!
	 */
	function user_form_school_dropdown() { ?>
	
		<table class="form-table">
			<th scope="row">
				<label for="adduser-school">School</label>
			</th>
			<td>
				<?php wp_dropdown_categories( array( 'show_option_none' => ' ', 'class' => 'adduser-school', 'name' => 'adduser-school', 'taxonomy' => 'school', 'hide_empty' => false, 'echo' => true ) ); ?>
			</td>
		</table>
	
	<?php }
	
	
	
	/*
	 * Form checking!
	 *
	 */
	function user_form_school_check() { ?>
		
		<script>
			jQuery( document ).ready( function() {
				jQuery( '#adduser, #createuser' ).submit( function( e ) {
					if( jQuery( '.adduser-school', this ).val() == '-1' ) {
						var hasSchool = confirm( 'You are adding a user without selecting a school. Continue?' );
						if( hasSchool != true ) {
							e.preventDefault();
						}
					}
				});
			});
		</script>
	
	<?php }
	
	/*
	 *
	 *
	 */
	function user_form_school_save( $user_id ) {
		//Here lie the 8000000000 possible variations of how to save the user's school to their meta. Kill me now.
	}
	
	/*
	 * Adds the instructional meta box if the user is a student
	 *
	 */
	function add_meta_boxes() {
	
		if( current_user_can( 'edit_others_posts' ) ) {
			add_meta_box( 'hsinsiderpoll', 'Poll', array( &$this, 'poll_meta_box' ), 'post', 'side', 'high' );
			return;
		}
		
		add_meta_box( 'hsinsiderschool', 'School', array( &$this, 'school_meta_box' ), 'post', 'side', 'high' );
	}
	
	/*
	 * Removes the school meta box if the user is a student
	 *
	 */
	function remove_meta_boxes() {
	
		remove_meta_box( 'dfcg_desc', 'post', 'normal' );
		remove_meta_box( 'dfcg_image', 'post', 'normal' );
		remove_meta_box( 'post-meta-inspector', 'post', 'normal' );
		remove_meta_box( 'byline', 'post', 'normal' );
		remove_meta_box( 'writing_helper_meta_box', 'post', 'normal' );
	
		if( current_user_can( 'edit_others_posts' ) )
			return;
		
		remove_meta_box( 'schooldiv', 'post', 'normal' );
		remove_meta_box( 'trackbacksdiv', 'post', 'normal' );
		remove_meta_box( 'mt_seo', 'post', 'normal' );
		remove_meta_box( 'edit-flow-editorial-comments', 'post', 'normal' );
		remove_meta_box( 'likes_meta', 'post', 'normal' );
	}

	/*
	 * Display the instructional meta box to students
	 *
	 */	
	function poll_meta_box( $post ) {
	
		$poll = get_post_meta( $post->ID, '_poll', true );
		wp_nonce_field( $post->ID . '_poll', 'poll_meta_nonce' ); ?>

		<input type="text" name="poll" id="poll" value="<?php echo esc_attr( $poll ); ?>" placeholder="Polldaddy Poll ID" />
	
	<?php }
	
	/*
	 * Set the school term for posts submitted by students
	 *
	 */
	function save_poll( $post_id ) {
		
		if ( wp_is_post_revision( $post_id ) )
			return;
		
		if( empty( $_POST[ 'poll_meta_nonce' ] ) )
			return;
		
		if( ! wp_verify_nonce( $_POST[ 'poll_meta_nonce' ], $post_id . '_poll' ) )
			return; 
			
		if( !current_user_can( 'edit_others_posts' ) )
			return;

		if( !empty( $_POST[ 'poll' ] ) ) {
			update_post_meta( $post_id, '_poll', (int) $_POST[ 'poll' ] );
			wp_set_post_terms( $post_id, array( 'Polls' ), 'browse', true );
		} else {
			delete_post_meta( $post_id, '_poll' );
			wp_remove_object_terms( $post_id, array( 'polls' ), 'browse' );
		}
	}

	/*
	 * Display the instructional meta box to students
	 *
	 */	
	function school_meta_box( $post ) {
	
		$school = (int) get_user_attribute( get_current_user_id(), '_hsinsider_school', true );
		$school = get_term( $school, 'school' );
		
		//In case there's any form input in the future
		wp_nonce_field( 'hsinsider_school_' . $post->ID, 'school_meta_nonce' );
		
		if( empty( $school ) || is_wp_error( $school ) ) : ?>
			<strong>No school set.</strong>
		<?php else: ?>
			Your stories will automatically be posted in the <strong><?php echo esc_html( $school->name ); ?></strong> category.
		<?php endif;
	}
	
	/*
	 * Set the school term for posts submitted by students
	 *
	 */
	function save_school( $post_id ) {
		
		if ( wp_is_post_revision( $post_id ) )
			return;
		
		$post = get_post( $post_id );
		
		if( current_user_can( 'edit_others_posts' ) && is_staff_post( $post ) )
			return wp_set_post_terms( $post_id, array( 'Staff Stories' ), 'browse', true );
		
		if( empty( $_POST[ 'school_meta_nonce' ] ) )
			return;
		
		if( ! wp_verify_nonce( $_POST[ 'school_meta_nonce' ], 'hsinsider_school_' . $post_id ) )
			return; 
			
		$school = (int) get_user_attribute( get_current_user_id(), '_hsinsider_school', true );
		$school = get_term( $school, 'school' );
		
		if( empty( $school ) || is_wp_error( $school ) )
			return;
			
		wp_set_post_terms( $post_id, $school->term_id, 'school' );
	}
	
	/*
	 * Add the school select option to the user's profile page
	 *
	 */
	public function profile_role_edit( $user ) {
	
		if( user_can( $user, 'edit_others_posts' ) )
			return;
	
		$dropdown = wp_dropdown_categories( array( 'name' => 'school', 'taxonomy' => 'school', 'hide_empty' => false, 'echo' => false, 'selected' => ( $school = get_user_attribute( $user->ID, '_hsinsider_school', true ) ) ? $school : false ) );
	
		if( !current_user_can( 'edit_others_posts' ) ) {
			$dropdown = str_replace( '<select', '<select disabled="disabled"', $dropdown );
		}
	
		?>
		<table class="form-table">
			<tr>
				<th><label for="school">School</label></th>
				<td>
					<?php echo $dropdown; ?>
				</td>
			</tr>
		</table>
	<?php }

	/*
	 * Save the school to a user
	 *
	 */
	public function profile_role_save( $user_id ) {

		//Can the current user edit this user?
		if ( !current_user_can( 'edit_user', $user_id ) )
			return false;
		
		//Users without this cap can't save this meta field even
		//on their own profiles
		if( !current_user_can( 'edit_others_posts' ) )
			return false;
		
		//If the user being currently edited has this cap, this option is irrelevant
		if( user_can( $user_id, 'edit_others_posts' ) )
			return;
		
		if( empty( $_POST[ 'school' ] ) )
			return;
		
		$school = (int) $_POST[ 'school' ];
		
		if( term_exists( $school, 'school' ) ) {
			update_user_attribute( $user_id, '_hsinsider_school', $school );
		} else {
			delete_user_attribute( $user_id, '_hsinsider_school' );
		}
	}
	
	/*
	 * Add a column to the user page to allow admins to select user school
	 *
	 */
	public function add_user_column_schools( $columns ) {

		$columns[ 'school' ] = 'School';
		return $columns;
	}
	
	/*
	 * Display a column on the user page to allow admins to select user school
	 *
	 */
	public function show_user_column_schools( $value, $column_slug, $user_id ) {

		if( $column_slug != 'school' )
			return $value;
		
		$user = get_user_by( 'id', $user_id );
		
		if( !in_array( 'student', $user->roles ) )
			return $value;
		
		$school = (int) get_user_attribute( $user->ID, '_hsinsider_school', true );

		return wp_dropdown_categories( array(
				'taxonomy' => 'school',
				'hide_empty' => false,
				'show_option_none' => 'None selected',
				'selected' => $school,
				'name' => wp_create_nonce( 'user_school-' . $user->ID ),
				'id' => 'user_school-' . $user->ID,
				'class' => 'school',
				'orderby' => 'name',
				'echo' => false,
			) );

	}
	
	public function print_user_school_js() { ?>
	
		<script type="text/javascript">
			jQuery(function( $ ) {
				$( 'select.school' ).change( function() {
					var ajax = ajaxurl + '?action=user_school&school=' + $( this ).val() + '&_nonce=' + $( this ).attr( 'name' ) + '&user_id=' + $( this ).attr( 'id' ).replace( 'user_school-', '' );
					$.get( ajax, function( data ) {
						if( data.success != true ) {
							alert( 'Error saving user school' );
						}
					});
				});
			});
		</script>
	
	<?php }
	
	/*
	 * Save the school
	 *
	 */
	public function ajax() {
	
		if( !current_user_can( 'edit_others_posts' ) )
			wp_send_json_error( 'unauthorized' );
		
		if( empty( $_GET[ 'user_id' ] ) || empty( $_GET[ 'school' ] ) )
			wp_send_json_error( 'incomplete' );
		
		$user_id = (int) $_GET[ 'user_id' ];
		
		if( !wp_verify_nonce( $_GET[ '_nonce' ], 'user_school-' . $user_id ) )
			wp_send_json_error( 'invalid_nonce' );
		
		$user = get_user_by( 'id', $user_id );
		
		if( !in_array( 'student', $user->roles ) )
			wp_send_json_error( 'not_student' );
		
		$school = (int) $_GET[ 'school' ];
		
		if( term_exists( $school, 'school' ) ) {
			update_user_attribute( $user->ID, '_hsinsider_school', $school );
		} else {
			delete_user_attribute( $user->ID, '_hsinsider_school' );
		}
		wp_send_json_success();
	}
}

$hsinsider_special_users = new HSInsider_Special_Users;
