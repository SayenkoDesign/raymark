<?php

/*
About Intro
		
*/


if( ! class_exists( 'About_Mission_Section' ) ) {
    class About_Mission_Section extends Element_Section {
        
        public function __construct() {
            parent::__construct();
                        
            $fields = get_field( 'mission' );            
            $this->set_fields( $fields );
            
            $settings = [];
            $this->set_settings( $settings );
            
            // Render the section
            $this->render();
            
            // print the section
            $this->print_element();        
        }
              
        // Add default attributes to section        
        protected function _add_render_attributes() {
            
            // use parent attributes
            parent::_add_render_attributes();
    
            $this->add_render_attribute(
                'wrapper', 'class', [
                     $this->get_name() . '-mission'
                ]
            );
        }
        
        
        // Add content
        public function render() {
            
            $fields = $this->get_fields(); 
            
            if( empty( $this->get_fields( 'subheading' ) ) ) 
                return;
                
            $logo_mark = sprintf( '<div class="logo-mark"><img src="%sicons/service-area-icon.svg" class="" /></div>', trailingslashit( THEME_IMG ) );
                
            $subheading = _s_format_string( sprintf( '<span>%s</span>', _s_wrap_string( $this->get_fields( 'subheading' ) ) ), 'h3' );
            
            $description = _s_format_string( $this->get_fields( 'description' ), 'p' );
            
            $quote_mark = sprintf( '<div class="quote-mark"><img src="%sabout/quote-gray.svg" /></div>', trailingslashit( THEME_IMG ) );
            
            $caption = sprintf( '<div class="column"><div class="caption">%s<div class="wrap">%s%s%s</div></div></div>', $logo_mark, $subheading, $description, $quote_mark );
            
            $photos = $this->get_fields( 'photos' );
            
            // 85% and 129%
            
            if( empty( $photos ) ) {
                return;
            }
            
            $photo_classes = [ 'width-60', 'width-40', 'width-40', 'width-60' ];
            $items = '';
            
            foreach( $photos as $key => $photo ) {
                $background = _s_get_acf_image( $photo['ID'], 'large', true );
                $style = sprintf( ' style="background-image: url(%s);"', $background );
                $items .= sprintf( '<div class="%s"><div class="background"%s></div></div>', $photo_classes[$key], $style );
            }
            
            $grid = sprintf( '<div class="column"><div class="photo-grid clearfix">%s</div></div>', $items );
                       
            return sprintf( '<div class="row align-middle large-unstack">%s%s</div>', $grid, $caption );
        }
    }
}
   
new About_Mission_Section; 