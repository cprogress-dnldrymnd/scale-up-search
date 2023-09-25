<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Ogeko_Elementor')) :

    /**
     * The Ogeko Elementor Integration class
     */
    class Ogeko_Elementor {
        private $suffix = '';

        public function __construct() {
            $this->suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';

            add_action('wp', [$this, 'register_auto_scripts_frontend']);
            add_action('elementor/init', array($this, 'add_category'));
            add_action('wp_enqueue_scripts', [$this, 'add_scripts'], 15);
            add_action('elementor/widgets/register', array($this, 'customs_widgets'));
            add_action('elementor/widgets/register', array($this, 'include_widgets'));
            add_action('elementor/frontend/after_enqueue_scripts', [$this, 'add_js']);

            // Custom Animation Scroll
            add_filter('elementor/controls/animations/additional_animations', [$this, 'add_animations_scroll']);

            // Backend
            add_action('elementor/editor/after_enqueue_styles', [$this, 'add_style_editor'], 99);

            // Add Icon Custom
            add_action('elementor/icons_manager/native', [$this, 'add_icons_native']);
            add_action('elementor/controls/controls_registered', [$this, 'add_icons']);

            // Add Breakpoints
            add_action('wp_enqueue_scripts', 'ogeko_elementor_breakpoints', 9999);

            if (!ogeko_is_elementor_pro_activated()) {
                require trailingslashit(get_template_directory()) . 'inc/elementor/custom-css.php';
                require trailingslashit(get_template_directory()) . 'inc/elementor/sticky-section.php';
                if (is_admin()) {
                    add_action('manage_elementor_library_posts_columns', [$this, 'admin_columns_headers']);
                    add_action('manage_elementor_library_posts_custom_column', [$this, 'admin_columns_content'], 10, 2);
                }
            }

            add_filter('elementor/fonts/additional_fonts', [$this, 'additional_fonts']);
            add_action('wp_enqueue_scripts', [$this, 'elementor_kit']);
        }

        public function elementor_kit() {
            $active_kit_id = Elementor\Plugin::$instance->kits_manager->get_active_id();
            Elementor\Plugin::$instance->kits_manager->frontend_before_enqueue_styles();
            $myvals = get_post_meta($active_kit_id, '_elementor_page_settings', true);
            if (!empty($myvals)) {
                $css = '';
                foreach ($myvals['system_colors'] as $key => $value) {
                    $css .= $value['color'] !== '' ? '--' . $value['_id'] . ':' . $value['color'] . ';' : '';
                }

                $var = "body{{$css}}";
                wp_add_inline_style('ogeko-style', $var);
            }
        }

        public function additional_fonts($fonts) {
            $fonts["Ogeko"] = 'system';
            return $fonts;
        }

        public function admin_columns_headers($defaults) {
            $defaults['shortcode'] = esc_html__('Shortcode', 'ogeko');

            return $defaults;
        }

        public function admin_columns_content($column_name, $post_id) {
            if ('shortcode' === $column_name) {
                ob_start();
                ?>
                <input class="elementor-shortcode-input" type="text" readonly onfocus="this.select()" value="[hfe_template id='<?php echo esc_attr($post_id); ?>']"/>
                <?php
                ob_get_contents();
            }
        }

        public function add_js() {
            global $ogeko_version;
            wp_enqueue_script('ogeko-elementor-frontend', get_theme_file_uri('/assets/js/elementor-frontend.js'), [], $ogeko_version);
        }

        public function add_style_editor() {
            global $ogeko_version;
            wp_enqueue_style('ogeko-elementor-editor-icon', get_theme_file_uri('/assets/css/admin/elementor/icons.css'), [], $ogeko_version);
        }

        public function add_scripts() {
            global $ogeko_version;
            $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
            wp_enqueue_style('ogeko-elementor', get_template_directory_uri() . '/assets/css/base/elementor.css', '', $ogeko_version);
            wp_style_add_data('ogeko-elementor', 'rtl', 'replace');

            // Add Scripts
            wp_register_script('tweenmax', get_theme_file_uri('/assets/js/vendor/TweenMax.min.js'), array('jquery'), '1.11.1');
            wp_register_script('parallaxmouse', get_theme_file_uri('/assets/js/vendor/jquery-parallax.js'), array('jquery'), $ogeko_version);

            if (ogeko_elementor_check_type('animated-bg-parallax')) {
                wp_enqueue_script('tweenmax');
                wp_enqueue_script('jquery-panr', get_theme_file_uri('/assets/js/vendor/jquery-panr' . $suffix . '.js'), array('jquery'), '0.0.1');
            }
        }

        public function register_auto_scripts_frontend() {
            global $ogeko_version;
            wp_register_script('ogeko-elementor-accordion', get_theme_file_uri('/assets/js/elementor/accordion.js'), array('jquery','elementor-frontend'), $ogeko_version, true);
            wp_register_script('ogeko-elementor-brand', get_theme_file_uri('/assets/js/elementor/brand.js'), array('jquery','elementor-frontend'), $ogeko_version, true);
            wp_register_script('ogeko-elementor-image-gallery', get_theme_file_uri('/assets/js/elementor/image-gallery.js'), array('jquery','elementor-frontend'), $ogeko_version, true);
            wp_register_script('ogeko-elementor-number-box', get_theme_file_uri('/assets/js/elementor/number-box.js'), array('jquery','elementor-frontend'), $ogeko_version, true);
            wp_register_script('ogeko-elementor-posts-grid', get_theme_file_uri('/assets/js/elementor/posts-grid.js'), array('jquery','elementor-frontend'), $ogeko_version, true);
            wp_register_script('ogeko-elementor-progress-bar', get_theme_file_uri('/assets/js/elementor/progress-bar.js'), array('jquery','elementor-frontend'), $ogeko_version, true);
            wp_register_script('ogeko-elementor-project', get_theme_file_uri('/assets/js/elementor/project.js'), array('jquery','elementor-frontend'), $ogeko_version, true);
            wp_register_script('ogeko-elementor-service', get_theme_file_uri('/assets/js/elementor/service.js'), array('jquery','elementor-frontend'), $ogeko_version, true);
            wp_register_script('ogeko-elementor-tabs', get_theme_file_uri('/assets/js/elementor/tabs.js'), array('jquery','elementor-frontend'), $ogeko_version, true);
            wp_register_script('ogeko-elementor-team-box', get_theme_file_uri('/assets/js/elementor/team-box.js'), array('jquery','elementor-frontend'), $ogeko_version, true);
            wp_register_script('ogeko-elementor-testimonial', get_theme_file_uri('/assets/js/elementor/testimonial.js'), array('jquery','elementor-frontend'), $ogeko_version, true);
            wp_register_script('ogeko-elementor-timeline', get_theme_file_uri('/assets/js/elementor/timeline.js'), array('jquery','elementor-frontend'), $ogeko_version, true);
            wp_register_script('ogeko-elementor-video', get_theme_file_uri('/assets/js/elementor/video.js'), array('jquery','elementor-frontend'), $ogeko_version, true);
           
        }

        public function add_category() {
            Elementor\Plugin::instance()->elements_manager->add_category(
                'ogeko-addons',
                array(
                    'title' => esc_html__('Ogeko Addons', 'ogeko'),
                    'icon'  => 'fa fa-plug',
                ),
                1);
        }

        public function add_animations_scroll($animations) {
            $animations['Ogeko Animation'] = [
                'opal-move-up'    => 'Move Up',
                'opal-move-down'  => 'Move Down',
                'opal-move-left'  => 'Move Left',
                'opal-move-right' => 'Move Right',
                'opal-flip'       => 'Flip',
                'opal-helix'      => 'Helix',
                'opal-scale-up'   => 'Scale',
                'opal-am-popup'   => 'Popup',
            ];

            return $animations;
        }

        public function customs_widgets() {
            $files = glob(get_theme_file_path('/inc/elementor/custom-widgets/*.php'));
            foreach ($files as $file) {
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        }

        /**
         * @param $widgets_manager Elementor\Widgets_Manager
         */
        public function include_widgets($widgets_manager) {
            $files = glob(get_theme_file_path('/inc/elementor/widgets/*.php'));
            foreach ($files as $file) {
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        }

        public function add_icons( $manager ) {
            $new_icons = json_decode( '{"ogeko-icon-account":"account","ogeko-icon-advanced":"advanced","ogeko-icon-angle-down":"angle-down","ogeko-icon-angle-left":"angle-left","ogeko-icon-angle-right":"angle-right","ogeko-icon-angle-up":"angle-up","ogeko-icon-arrow-left":"arrow-left","ogeko-icon-arrow-right":"arrow-right","ogeko-icon-award":"award","ogeko-icon-basic":"basic","ogeko-icon-breadcrumb":"breadcrumb","ogeko-icon-build":"build","ogeko-icon-business":"business","ogeko-icon-call":"call","ogeko-icon-check-fill":"check-fill","ogeko-icon-clients":"clients","ogeko-icon-clock":"clock","ogeko-icon-communication":"communication","ogeko-icon-compare":"compare","ogeko-icon-compensation":"compensation","ogeko-icon-compensation1":"compensation1","ogeko-icon-culture":"culture","ogeko-icon-cyber-security":"cyber-security","ogeko-icon-digital-marketing":"digital-marketing","ogeko-icon-donec":"donec","ogeko-icon-download-pdf":"download-pdf","ogeko-icon-envelop2":"envelop2","ogeko-icon-experience":"experience","ogeko-icon-eye":"eye","ogeko-icon-facebook-f":"facebook-f","ogeko-icon-flus2":"flus2","ogeko-icon-google-plus-g":"google-plus-g","ogeko-icon-heart-1":"heart-1","ogeko-icon-hiring":"hiring","ogeko-icon-indentify":"indentify","ogeko-icon-industry":"industry","ogeko-icon-innovators":"innovators","ogeko-icon-like":"like","ogeko-icon-linkedin-in":"linkedin-in","ogeko-icon-location3":"location3","ogeko-icon-machine":"machine","ogeko-icon-management":"management","ogeko-icon-misson":"misson","ogeko-icon-onboarding":"onboarding","ogeko-icon-ourstategy":"ourstategy","ogeko-icon-ourteam":"ourteam","ogeko-icon-peaplecohesion":"peaplecohesion","ogeko-icon-phone2":"phone2","ogeko-icon-play-solid":"play-solid","ogeko-icon-premier":"premier","ogeko-icon-profile2user":"profile2user","ogeko-icon-qoute-2":"qoute-2","ogeko-icon-quality":"quality","ogeko-icon-quote1":"quote1","ogeko-icon-ranking":"ranking","ogeko-icon-reply-o":"reply-o","ogeko-icon-round-arrow-drop-down":"round-arrow-drop-down","ogeko-icon-scale":"scale","ogeko-icon-shopping-bag":"shopping-bag","ogeko-icon-support2":"support2","ogeko-icon-survey":"survey","ogeko-icon-testicon":"testicon","ogeko-icon-web-design":"web-design","ogeko-icon-360":"360","ogeko-icon-bars":"bars","ogeko-icon-caret-down":"caret-down","ogeko-icon-caret-left":"caret-left","ogeko-icon-caret-right":"caret-right","ogeko-icon-caret-up":"caret-up","ogeko-icon-cart-empty":"cart-empty","ogeko-icon-check-square":"check-square","ogeko-icon-circle":"circle","ogeko-icon-cloud-download-alt":"cloud-download-alt","ogeko-icon-comment":"comment","ogeko-icon-comments":"comments","ogeko-icon-contact":"contact","ogeko-icon-credit-card":"credit-card","ogeko-icon-dot-circle":"dot-circle","ogeko-icon-edit":"edit","ogeko-icon-envelope":"envelope","ogeko-icon-expand-alt":"expand-alt","ogeko-icon-external-link-alt":"external-link-alt","ogeko-icon-file-alt":"file-alt","ogeko-icon-file-archive":"file-archive","ogeko-icon-filter":"filter","ogeko-icon-folder-open":"folder-open","ogeko-icon-folder":"folder","ogeko-icon-frown":"frown","ogeko-icon-gift":"gift","ogeko-icon-grid":"grid","ogeko-icon-grip-horizontal":"grip-horizontal","ogeko-icon-heart-fill":"heart-fill","ogeko-icon-heart":"heart","ogeko-icon-history":"history","ogeko-icon-home":"home","ogeko-icon-info-circle":"info-circle","ogeko-icon-instagram":"instagram","ogeko-icon-level-up-alt":"level-up-alt","ogeko-icon-list":"list","ogeko-icon-map-marker-check":"map-marker-check","ogeko-icon-meh":"meh","ogeko-icon-minus-circle":"minus-circle","ogeko-icon-minus":"minus","ogeko-icon-mobile-android-alt":"mobile-android-alt","ogeko-icon-money-bill":"money-bill","ogeko-icon-pencil-alt":"pencil-alt","ogeko-icon-play-circle":"play-circle","ogeko-icon-play":"play","ogeko-icon-plus-circle":"plus-circle","ogeko-icon-plus":"plus","ogeko-icon-quote":"quote","ogeko-icon-random":"random","ogeko-icon-reply-all":"reply-all","ogeko-icon-reply":"reply","ogeko-icon-search-plus":"search-plus","ogeko-icon-search":"search","ogeko-icon-shield-check":"shield-check","ogeko-icon-shopping-basket":"shopping-basket","ogeko-icon-shopping-cart":"shopping-cart","ogeko-icon-sign-out-alt":"sign-out-alt","ogeko-icon-smile":"smile","ogeko-icon-spinner":"spinner","ogeko-icon-square":"square","ogeko-icon-star":"star","ogeko-icon-store":"store","ogeko-icon-sync":"sync","ogeko-icon-tachometer-alt":"tachometer-alt","ogeko-icon-th-large":"th-large","ogeko-icon-th-list":"th-list","ogeko-icon-thumbtack":"thumbtack","ogeko-icon-ticket":"ticket","ogeko-icon-times-circle":"times-circle","ogeko-icon-times":"times","ogeko-icon-trophy-alt":"trophy-alt","ogeko-icon-truck":"truck","ogeko-icon-user-headset":"user-headset","ogeko-icon-user-shield":"user-shield","ogeko-icon-user":"user","ogeko-icon-video":"video","ogeko-icon-adobe":"adobe","ogeko-icon-amazon":"amazon","ogeko-icon-android":"android","ogeko-icon-angular":"angular","ogeko-icon-apper":"apper","ogeko-icon-apple":"apple","ogeko-icon-atlassian":"atlassian","ogeko-icon-behance":"behance","ogeko-icon-bitbucket":"bitbucket","ogeko-icon-bitcoin":"bitcoin","ogeko-icon-bity":"bity","ogeko-icon-bluetooth":"bluetooth","ogeko-icon-btc":"btc","ogeko-icon-centos":"centos","ogeko-icon-chrome":"chrome","ogeko-icon-codepen":"codepen","ogeko-icon-cpanel":"cpanel","ogeko-icon-discord":"discord","ogeko-icon-dochub":"dochub","ogeko-icon-docker":"docker","ogeko-icon-dribbble":"dribbble","ogeko-icon-dropbox":"dropbox","ogeko-icon-drupal":"drupal","ogeko-icon-ebay":"ebay","ogeko-icon-facebook":"facebook","ogeko-icon-figma":"figma","ogeko-icon-firefox":"firefox","ogeko-icon-google-plus":"google-plus","ogeko-icon-google":"google","ogeko-icon-grunt":"grunt","ogeko-icon-gulp":"gulp","ogeko-icon-html5":"html5","ogeko-icon-joomla":"joomla","ogeko-icon-link-brand":"link-brand","ogeko-icon-linkedin":"linkedin","ogeko-icon-mailchimp":"mailchimp","ogeko-icon-opencart":"opencart","ogeko-icon-paypal":"paypal","ogeko-icon-pinterest-p":"pinterest-p","ogeko-icon-pinterest":"pinterest","ogeko-icon-reddit":"reddit","ogeko-icon-skype":"skype","ogeko-icon-slack":"slack","ogeko-icon-snapchat":"snapchat","ogeko-icon-spotify":"spotify","ogeko-icon-trello":"trello","ogeko-icon-twitter":"twitter","ogeko-icon-vimeo":"vimeo","ogeko-icon-whatsapp":"whatsapp","ogeko-icon-wordpress":"wordpress","ogeko-icon-yoast":"yoast","ogeko-icon-youtube":"youtube"}', true );
			$icons     = $manager->get_control( 'icon' )->get_settings( 'options' );
			$new_icons = array_merge(
				$new_icons,
				$icons
			);
			// Then we set a new list of icons as the options of the icon control
			$manager->get_control( 'icon' )->set_settings( 'options', $new_icons ); 
        }

        public function add_icons_native($tabs) {
            global $ogeko_version;
            $tabs['opal-custom'] = [
                'name'          => 'ogeko-icon',
                'label'         => esc_html__('Ogeko Icon', 'ogeko'),
                'prefix'        => 'ogeko-icon-',
                'displayPrefix' => 'ogeko-icon-',
                'labelIcon'     => 'fab fa-font-awesome-alt',
                'ver'           => $ogeko_version,
                'fetchJson'     => get_theme_file_uri('/inc/elementor/icons.json'),
                'native'        => true,
            ];

            return $tabs;
        }
    }

endif;

return new Ogeko_Elementor();
