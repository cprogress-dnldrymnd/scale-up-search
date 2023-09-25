<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor image gallery widget.
 *
 * Elementor widget that displays a set of images in an aligned grid.
 *
 * @since 1.0.0
 */
class Ogeko_Elementor_Image_Gallery extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve image gallery widget name.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'ogeko-image-gallery';
    }

    /**
     * Get widget title.
     *
     * Retrieve image gallery widget title.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__('Ogeko Image Gallery', 'ogeko');
    }

    public function get_script_depends() {
        return [
            'isotope',
            'ogeko-elementor-image-gallery'
        ];
    }

    public function get_style_depends() {
        return ['magnific-popup'];
    }


    /**
     * Get widget icon.
     *
     * Retrieve image gallery widget icon.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since  2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['image', 'photo', 'visual', 'gallery'];
    }

    /**
     * Register image gallery widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_gallery',
            [
                'label' => esc_html__('Image Gallery', 'ogeko'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'filter_title',
            [
                'label'       => esc_html__('Filter Title', 'ogeko'),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__('List Item', 'ogeko'),
                'default'     => esc_html__('List Item', 'ogeko'),
            ]
        );

        $repeater->add_control(
            'wp_gallery',
            [
                'label'      => esc_html__('Add Images', 'ogeko'),
                'type'       => Controls_Manager::GALLERY,
                'show_label' => false,
                'dynamic'    => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'filter',
            [
                'label'       => '',
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'filter_title' => esc_html__('Gallery 1', 'ogeko'),
                    ],
                ],
                'title_field' => '{{{ filter_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Layout', 'ogeko'),
                'tab'   => Controls_Manager::TAB_LAYOUT
            ]
        );

        $this->add_control(
            'show_filter_bar',
            [
                'label'     => esc_html__('Filter Bar', 'ogeko'),
                'type'      => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('Off', 'ogeko'),
                'label_on'  => esc_html__('On', 'ogeko'),
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                //                'exclude'   => ['custom'],
                'separator' => 'none',
                'default'   => 'maisonco-gallery-image'
            ]
        );


        $this->add_responsive_control(
            'columns',
            [
                'label'   => esc_html__('Columns', 'ogeko'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6],
            ]
        );

        $this->add_responsive_control(
            'gutter',
            [
                'label'      => esc_html__('Gutter', 'ogeko'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 60,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .column-item' => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2); padding-bottom: calc({{SIZE}}{{UNIT}})',
                    '{{WRAPPER}} .row'         => 'margin-left: calc({{SIZE}}{{UNIT}} / -2); margin-right: calc({{SIZE}}{{UNIT}} / -2);',
                ],
            ]
        );

        $this->add_control(
            'view',
            [
                'label'   => esc_html__('View', 'ogeko'),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_design_filter',
            [
                'label'     => esc_html__('Filter Bar', 'ogeko'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_filter_bar' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_filter',
                'selector' => '{{WRAPPER}} .elementor-galerry__filter',
            ]
        );

        $this->add_responsive_control(
            'filter_item_spacing',
            [
                'label'     => esc_html__('Space Between', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 70,
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-galerry__filter:not(:last-child)'  => 'margin-right: calc({{SIZE}}{{UNIT}}/2)',
                    '{{WRAPPER}} .elementor-galerry__filter:not(:first-child)' => 'margin-left: calc({{SIZE}}{{UNIT}}/2)',
                ],
            ]
        );

        $this->add_responsive_control(
            'filter_spacing',
            [
                'label'     => esc_html__('Spacing', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 45,
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-galerry__filters' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'filter_padding',
            [
                'label'      => esc_html__('Filter Padding', 'ogeko'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-galerry__filter' => 'padding-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'filter_align',
            [
                'label'        => esc_html__('Alignment', 'ogeko'),
                'type'         => Controls_Manager::CHOOSE,
                'default'      => 'top',
                'options'      => [
                    'left'   => [
                        'title' => esc_html__('Left', 'ogeko'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'ogeko'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'ogeko'),
                        'icon'  => 'eicon-text-align-right',
                    ]
                ],
                'toggle'       => false,
                'prefix_class' => 'elementor-filter-',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_design_image',
            [
                'label' => esc_html__('Image', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'image_radius',
            [
                'label'      => esc_html__('Border Radius', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .column-item a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render image gallery widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('row', 'class', 'row grid');

        if (!empty($settings['columns'])) {
            $this->add_render_attribute('row', 'data-elementor-columns', $settings['columns']);
        }

        if (!empty($settings['columns_tablet'])) {
            $this->add_render_attribute('row', 'data-elementor-columns-tablet', $settings['columns_tablet']);
        }
        if (!empty($settings['columns_mobile'])) {
            $this->add_render_attribute('row', 'data-elementor-columns-mobile', $settings['columns_mobile']);
        }

        if ($settings['show_filter_bar'] == 'yes') {
            $this->add_render_attribute('row', 'class', 'isotope-grid');
            ?>
            <ul class="elementor-galerry__filters"
                data-related="isotope-<?php echo esc_attr($this->get_id()); ?>">
                <?php
                $total_image = 0;

                foreach ($settings['filter'] as $key => $term) {
                    $total_image += count($term['wp_gallery']);
                } ?>

                <li class="elementor-galerry__filter elementor-active"
                    data-filter=".masonry-item__all"><?php echo esc_html__('All', 'ogeko'); ?>
                    <span class="count"><?php echo esc_html($total_image); ?></span></li>
                <?php foreach ($settings['filter'] as $key => $term) { ?>
                    <li class="elementor-galerry__filter"
                        data-filter=".gallery_group_<?php echo esc_attr($key); ?>"><?php echo esc_html($term['filter_title']); ?>
                        <span class="count"><?php echo count($term['wp_gallery']); ?></span></li>
                <?php } ?>
            </ul>
            <?php
        }
        ?>

        <div class="elementor-opal-image-gallery">
            <div <?php echo ogeko_elementor_get_render_attribute_string('row', $this) ?>>
                <?php

                if (Plugin::$instance->editor->is_edit_mode()) {
                    $this->add_render_attribute('link', [
                        'class' => 'elementor-clickable',
                    ]);
                }
                $this->add_render_attribute('link', 'data-elementor-lightbox-slideshow', $this->get_id());
                $image_gallery = array();
                foreach ($settings['filter'] as $index => $item) {
                    if (!empty($item['wp_gallery'])):
                        foreach ($item['wp_gallery'] as $items => $attachment) {
                            $attachment['thumbnail_url'] = Group_Control_Image_Size::get_attachment_image_src($attachment['id'], 'thumbnail', $settings);
                            $attachment['group']         = $index;
                            $image_gallery[]             = $attachment;
                        }
                    endif;
                }

                foreach ($image_gallery as $index => $item) {
                    $image_url      = Group_Control_Image_Size::get_attachment_image_src($item['id'], 'thumbnail', $settings);
                    $image_url_full = wp_get_attachment_image_url($item['id'], 'full');
                    ?>
                    <div class="column-item grid__item masonry-item__all <?php echo 'gallery_group_' . esc_attr($item['group']); ?>">
                        <a data-elementor-open-lightbox="yes" <?php echo ogeko_elementor_get_render_attribute_string('link', $this); ?>
                           href="<?php echo esc_url($image_url_full); ?>">
                            <img src="<?php echo esc_url($image_url); ?>"
                                 alt="<?php echo esc_attr(Control_Media::get_image_alt($item)); ?>"/>
                        </a>
                    </div>
                    <?php
                }

                ?>
            </div>
        </div>

        <?php
    }
}

$widgets_manager->register(new Ogeko_Elementor_Image_Gallery());





