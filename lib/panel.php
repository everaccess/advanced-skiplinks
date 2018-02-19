<?php
/*
 * Plugin Panel Class
 */
class EverAccess_SkiplinksPanel {
    public function __construct() {
        add_action( 'admin_menu', array(&$this, 'register_page') );
        add_action( 'admin_init', array(&$this, 'register_settings') );
    }
    public function register_page() {
        add_submenu_page(
            'accessible-poetry',
            'Skiplinks',
            'Skiplinks',
            'manage_options',
            'submenu-page',
            array(&$this, 'create_page')
        );
    }
    public function register_settings() {
        $options = get_option(EA_SKIPLINKS_ID);

        if( isset($_POST[EA_SKIPLINKS_ID]) ) {
	        foreach ($_POST[EA_SKIPLINKS_ID] as $field_key => $field_value) {
	            $options[$field_key] = $field_value;
		        update_option(EA_SKIPLINKS_ID, $options);
	        }
        }


    }
    public function create_page() {
        $this->options = get_option( EA_SKIPLINKS_ID );
        $everaccess_siteurl = ( is_rtl() ) ? 'https://www.everaccess.co.il/' : 'https://everaccess.io/';
	    $taxonomies = get_taxonomies(array( 'public' => true ));
	    $post_types = get_post_types(array( 'public' => true ), 'objects');

        // Start the form
        echo '<form method="post" action="">';
	    settings_fields( EA_SKIPLINKS_ID );
        ?>
        <div id="everaccess-skiplinks-panel" class="wrap">
            <h1 class="wp-heading-inline"><?php echo EA_SKIPLINKS_NAME;?></h1>
            <div class="wrap-everaccess">
                <div class="panel-content card">
                    <div class="sections-wrap">
                        <section>
                            <h2><?php _e('General', 'everaccess');?></h2>
                            <?php ea_create_panel_field('select', 'side', __('Side', 'everaccess'), array(
                                            'none'  => __('Center', 'everaccess'),
                                            'right'  => __('Right', 'everaccess'),
                                            'left'  => __('Left', 'everaccess'),
                                    ), 2, true);?>
                        </section>
                        <section>
                            <h2><?php _e('Design', 'everaccess');?></h2>
                            <?php ea_create_panel_field('color', 'bgcolor', __('Background Color', 'everaccess'), '', 2, true);?>
                            <?php ea_create_panel_field('color', 'color', __('Text Color', 'everaccess'), '', 2, true);?>
                            <?php ea_create_panel_field('number', 'fontsize', __('Font Size (in pixels)', 'everaccess'), '', 2, true);?>
                        </section>

                        <section>
                            <h2><?php _e('Structure', 'everaccess');?></h2>
                            <p><?php _e('Set the structure of fixed components and default objects. to hide skip-link object simply leave the field enpty.', 'everaccess');?></p>

                            <?php if( $taxonomies ) : ?>
                            <div class="ea-panel-archives">
                                <h3><?php _e('Archives', 'everaccess');?></h3>
                                <?php foreach($taxonomies as $tax) : $taxonomy = get_taxonomy($tax); ?>
                                <?php

                                    ?>
                                <?php if( $tax != 'post_format' ) : ?>
                                    <div class="ea-toggler">
                                        <button type="button" class="btn-toggler" data-id="#ea-pside-<?php echo $tax;?>"><?php echo $taxonomy->label;?></button>
                                    </div>
                                <?php endif; ?>

                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>


                            <?php if( $post_types ) : ?>
                            <div class="ea-panel-post_types">
                                <h3><?php _e('Post Types', 'everaccess');?></h3>
		                        <?php foreach($post_types as $type) : ?>
                                <?php if( $type->name != 'attachment') : ?>
                                <div class="ea-toggler">
                                    <button type="button" class="btn-toggler" data-id="#ea-pside-<?php echo $type->name;?>"><?php echo $type->label;?></button>
                                </div>
			                    <?php endif; ?>
		                        <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </section>
                    </div>
                </div>
                <div class="panel-side card">
	                <?php if( $post_types ) : ?>
                    <div class="wp-clearfix">
		                <?php foreach($post_types as $type) : if( $type->name != 'attachment' ) : ?>

                        <div id="ea-pside-<?php echo $type->name; ?>" class="ea-side-show toggler-content hidden">
                            <h4><?php echo $type->label; ?></h4>
                            <button type="button" class="ea-add-skiplink">Add</button>
                            <ul class="menu ui-sortable">
                            </ul>
                        </div>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <?php

	                if( $taxonomies ) {
		                foreach($taxonomies as $tax) {
			                $taxonomy = get_taxonomy($tax);
			                if( $tax != 'post_format' ) {
				                echo '<div id="ea-pside-' . $tax . '" class="ea-side-show toggler-content hidden">';
				                echo '  <h4>' . $taxonomy->label . '</h4>';
				                ea_create_panel_field('text', $tax . '-id', $taxonomy->label . ' ' . __('content ID', 'everaccess'), '', 2, true);
				                ea_create_panel_field('text', $tax . '-text', $taxonomy->label . ' ' . __('content text', 'everaccess'), '', 2, true);
				                ea_create_panel_field('text', $tax . '-sidebar-id', $taxonomy->label . ' ' . __('sidebar ID', 'everaccess'), '', 2, true);
				                ea_create_panel_field('text', $tax . '-sidebar-text', $taxonomy->label . ' ' . __('sidebar text', 'everaccess'), '', 2, true);
				                echo '</div>';
			                }
		                }
	                }
	                ?>
                </div>
            </div>
        </div>
        <?php submit_button();?>
    </form>
        <?php
    }
}