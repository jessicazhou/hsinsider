<?php
/**
 * Field Manager Fields
 */

/**
 * `video_info` Fieldmanager fields.
 */
function hsinsider_fm_video_info() {
	$fm = new Fieldmanager_Group( array(
		'name' => 'video_info',
		'children' => array(
			'youtube_id' => new Fieldmanager_TextField( __( 'Youtube Video ID', 'hsinsider' ) ),
		),
	) );
	$fm->add_meta_box( __( 'Video Information', 'hsinsider' ), array( 'video' ), 'normal', 'high' );
}
add_action( 'fm_post_video', 'hsinsider_fm_video_info' );

function hsinsider_fm_school_info() {
	$fm = new Fieldmanager_Group( array(
		'name' => 'school_info',
		'children' => array(
			'address' => new Fieldmanager_Textfield( 'Address', array(
					'name' => 'address',
					'attributes' => array(
						'placeholder' => '202 W 1st St. Los Angeles, CA 90012'
					)
				)
			),
			'logo' => new Fieldmanager_Media( 'Logo' ),
      'locale' => new Fieldmanager_Select( array(
        'name' => 'locale',
        'label' => 'Locale',
        'options' => array(
            'los_angeles' => 'Los Angeles',
            'chicago' => 'Chicago',
            'other' => 'Other',
        ),
      ) ),
		)
	) );
	$fm->add_term_form( 'School Info', 'school' );
}
add_action( 'fm_term_school', 'hsinsider_fm_school_info' );

/**
 * This function holds and returns the array of fields for all
 * organization taxonomies besides Schools.  Updating the fields
 * in this array will update the fields across all those taxonomies.
 */
function hsinsider_fm_get_org_fields() {
  $org_fields = array(
    'name' => 'org_info',
    'children' => array(
      'address' => new Fieldmanager_Textfield( 'Address', array(
          'name' => 'address',
          'attributes' => array(
            'placeholder' => '202 W 1st St. Los Angeles, CA 90012'
          )
        )
      ),
      'logo' => new Fieldmanager_Media( 'Logo' ),
      'locale' => new Fieldmanager_Select( array(
        'name' => 'locale',
        'label' => 'Locale',
        'options' => array(
            'los_angeles' => 'Los Angeles',
            'chicago' => 'Chicago',
            'other' => 'Other',
        ),
      ) ),
    )
  );
  return $org_fields;
}

/**
 * 83-87 add $org_fields to a taxonomy/term.  Copy/paste with
 * and replace 'youth_group' taxonomy names to add organization fields
 * to the new taxonomy.
 */
function hsinsider_fm_org_info() {
	$fm = new Fieldmanager_Group( hsinsider_fm_get_org_fields() );
	$fm->add_term_form( 'Organization Info', 'youth_group' );
}
add_action( 'fm_term_youth_group', 'hsinsider_fm_org_info' );
