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
		)
	) );
	$fm->add_term_form( 'School Info', 'school' );
}
add_action( 'fm_term_school', 'hsinsider_fm_school_info' );