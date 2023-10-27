<?php

use Carbon_Fields\Container;
use Carbon_Fields\Complex_Container;
use Carbon_Fields\Field;


/*-----------------------------------------------------------------------------------*/
/* Footer Settings
/*-----------------------------------------------------------------------------------*/

Container::make('theme_options', __('Theme Settings'))
    ->add_tab('FOOTER CTA', array(
        Field::make('select', 'footer_cta_target', 'Target')
            ->set_options(array(
                '_self' => 'Same Window',
                '_blank' => 'New Tab',
            )),
        Field::make('text', 'footer_cta_heading', 'Heading'),
        Field::make('text', 'footer_cta_button_text', 'Button Text'),
        Field::make('text', 'footer_cta_button_url', 'Button URL'),
    ));



/*-----------------------------------------------------------------------------------*/
/* Career Settings
/*-----------------------------------------------------------------------------------*/

Container::make('post_meta', __('Careers Details'))
    ->where('post_type', '=', 'careers')
    ->add_fields(array(
        Field::make('text', 'salary', 'Salary'),
        Field::make('complex', 'accordion', 'Accordion')
            ->add_fields(array(
                Field::make('text', 'accordion_title', 'Accordion Title'),
                Field::make('rich_text', 'accordion_content', 'Accordion Content'),
            ))
            ->set_default_value(array(
                array(
                    'accordion_title' => 'Responsibilities',
                ),
                array(
                    'accordion_title' => 'Requirements',
                ),
            ))
            ->set_header_template('<%- accordion_title  %>')
    ));


/*-----------------------------------------------------------------------------------*/
/* Blog Settings
/*-----------------------------------------------------------------------------------*/
Container::make('post_meta', __('Blog Settings'))
    ->where('post_type', '=', 'post')
    ->set_context('side')
    ->set_priority('high')
    ->add_fields(array(
        Field::make('image', 'logo', 'Logo'),
        Field::make('text', 'artilce_url', 'Article URL'),

    ));



/*-----------------------------------------------------------------------------------*/
/* Footer Settings
/*-----------------------------------------------------------------------------------*/
Container::make('post_meta', __('Footer Settings'))
    ->where('post_type', '=', 'post')
    ->or_where('post_type', '=', 'page')
    ->or_where('post_type', '=', 'product')
    ->set_context('side')
    ->set_priority('high')
    ->add_fields(array(
        Field::make('checkbox', 'overwrite_footer_cta', 'Overwrite Footer CTA'),
        Field::make('select', 'target', 'Target')
            ->set_options(array(
                '_self' => 'Same Window',
                '_blank' => 'New Tab',
            )),
        Field::make('text', 'heading', 'Heading')
            ->set_conditional_logic(array(
                array(
                    'field' => 'overwrite_footer_cta',
                    'value' => true,
                )
            )),

        Field::make('text', 'button_text', 'Button Text')
            ->set_conditional_logic(array(
                array(
                    'field' => 'overwrite_footer_cta',
                    'value' => true,
                )
            )),
        Field::make('text', 'button_url', 'Button URL')
            ->set_conditional_logic(array(
                array(
                    'field' => 'overwrite_footer_cta',
                    'value' => true,
                )
            )),

    ));

/*-----------------------------------------------------------------------------------*/
/* Our Process Page Settings
/*-----------------------------------------------------------------------------------*/
Container::make('post_meta', __('Our Process Settings'))
    ->where('post_template', '=', 'templates/page-template-process.php')
    ->add_fields(array(
        Field::make('complex', 'process', 'Process')
            ->add_fields(array(
                Field::make('image', 'image', 'Image'),
                Field::make('text', 'stage', 'Stage'),
                Field::make('text', 'heading', 'Heading'),
                Field::make('rich_text', 'description', 'Description')->set_width(50),
                Field::make('rich_text', 'image_overlay_text', 'Image Overlay Text')->set_width(50),

            ))
            ->set_header_template('<%- heading  %>')
            ->set_layout('tabbed-vertical')
    ));



/*-----------------------------------------------------------------------------------*/
/* Our Process Page Settings
/*-----------------------------------------------------------------------------------*/
Container::make('post_meta', __('Partner Settings'))
    ->where('post_type', '=', 'partners')
    ->add_fields(array(
        Field::make('text', 'website', 'Website'),
        Field::make('image', 'logo', 'Logo'),
        Field::make('image', 'alt_logo', 'Alt Logo'),
    ));
