<?php
/*
 * Class for Meta
 */

class EverAccess_SkiplinksMeta {
    function __construct() {
        add_action( 'add_meta_boxes', array( $this, 'add_the_box' ) );
        add_action( 'save_post', array( $this, 'save' ) );
    }
    public function add_the_box() {
        add_meta_box(
	        EA_SKIPLINKS_ID,
	        EA_SKIPLINKS_NAME,
            array( $this, 'the_meta_callback' ),
            array( get_post_types() )
        );
    }
    public function the_meta_callback( $post ) {
        wp_nonce_field( basename( __FILE__ ), EA_SKIPLINKS_ID );

        $screen = get_current_screen();
        var_dump($screen);

        // Start Wrapper

        echo '<div class="wrap-everaccess">';
        echo '	<div class="panel-content">';

	    // Header

	    echo '<div class="ea-toggler ui-sortable">';
	    echo '  <button type="button" class="btn-toggler ui-sortable-handle">' . __('Header', 'everaccess') . '</button>';
	    echo '  <div class="toggler-content ui-sortable-handle">';
	    ea_create_meta_field($post, 'text', 'eas-header-id', __('Header ID', 'everaccess'), '', 2, true);
	    ea_create_meta_field($post, 'text', 'eas-header-text', __('Header Text', 'everaccess'), '', 2, true);
	    echo '	</div>';
	    echo '</div>';

	    // NAvigation bar

	    echo '<div class="ea-toggler ui-sortable">';
	    echo '  <button type="button" class="btn-toggler ui-sortable-handle">' . __('Navigation Bar', 'everaccess') . '</button>';
	    echo '  <div class="toggler-content ui-sortable-handle">';
	    ea_create_meta_field($post, 'text', 'eas-meinav-id', __('Navigation Bar ID', 'everaccess'), '', 2, true);
	    ea_create_meta_field($post, 'text', 'eas-meinav-text', __('Navigation Bar Text', 'everaccess'), '', 2, true);
	    echo '	</div>';
	    echo '</div>';

	    // Footer

	    echo '<div class="ea-toggler ui-sortable">';
	    echo '  <button type="button" class="btn-toggler ui-sortable-handle">' . __('Footer', 'everaccess') . '</button>';
	    echo '  <div class="toggler-content ui-sortable-handle">';
	    ea_create_meta_field($post, 'text', 'eas-footer-id', __('Footer ID', 'everaccess'), '', 2, true);
	    ea_create_meta_field($post, 'text', 'eas-footer-text', __('Footer Text', 'everaccess'), '', 2, true);
	    echo '	</div>';
	    echo '</div>';

		// End wrapper

		echo '	</div>';
		echo '</div>';

    }

    public function save( $post ) {
        $is_autosave = wp_is_post_autosave( $post );
        $is_revision = wp_is_post_revision( $post );
        $is_valid_nonce = ( isset( $_POST[ 'harari_meta' ] ) && wp_verify_nonce( $_POST[ 'harari_meta' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

        if ( $is_autosave || $is_revision || !$is_valid_nonce )
            return;

        foreach ($_POST as $key => $value) {
            if( substr($key, 0, 4) === 'eas-' && $value != '' ) {
	            update_post_meta( $post, $key, $value);
            } elseif ( substr($key, 0, 4) === 'eas-' && $value == '' ) {
                delete_post_meta( $post, $key );
            }
        }
    }
}