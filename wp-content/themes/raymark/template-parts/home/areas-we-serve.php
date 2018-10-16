<?php
// Home Intro

if( ! class_exists( 'Home_Areas_We_Serve_Section' ) ) {
    class Home_Areas_We_Serve_Section extends Element_Section {
        
        public function __construct() {
            parent::__construct();
                        
            $fields = get_field( 'areas_served' );
            $this->set_fields( $fields );
            
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
                     $this->get_name() . '-areas-we-serve'
                ]
            ); 
            
            $this->add_render_attribute(
                'wrapper', 'id', $this->get_name() . '-areas-we-serve', true );            
            
        }  
       
        
        // Add content
        public function render() {
            
            $fields = $this->get_fields();
                                                             
            $row = new Element_Row(); 
            $row->add_render_attribute( 'wrapper', 'class', ['small-collapse', 'expanded', 'large-unstack', 'align-middle'] );  

            
            $column = new Element_Column(); 
            
            $header = '<header><h2><span style="text-decoration: underline;">Areas</span> We Service</h2></header>';
            // Map
            $map_shortcode = sprintf( '<div class="map-container">%s</div>', do_shortcode( $this->get_fields( 'map_shortcode' ) ) );
            $map = new Element_Html( [ 'fields' => [ 'html' => $header . $map_shortcode ] ] ); // set fields from Constructor
            $column->add_child( $map );
            
            $row->add_child( $column );
            
            $column = new Element_Column(); 
            
            $contact = _s_format_string( 'Contact Us', 'h3', ['class' => 'yellow'] );
            $phone = '(206) 440-9077';
            $number = _s_format_telephone_url( $phone );
            $phone = sprintf( '<p><a href="%s">%s</a></p>', $number, $phone );
            $areas_served = _s_format_string( '<span>Areas Served</span>', 'h3', ['class' => 'lines'] );
            $header = sprintf( '<header>%s%s%s</header>', $contact, $phone, $areas_served );
            
            $locations = sprintf( '<div class="scroll scroll-left"><ul class="no-bullet">%s</ul></div>', nl2li( $this->get_fields( 'locations' ) ) );
            $zip_codes = sprintf( '<div class="scroll scroll-right"><ul class="no-bullet">%s</ul></div>', nl2li( $this->get_fields( 'zipcodes' )) );
            $container = sprintf( '<div class="container">%s<div class="scroll-container align-center">%s%s</div></div>',$header, $locations, $zip_codes );
            
            $areas_served = new Element_Html( [ 'fields' => [ 'html' => $container ] ] ); // set fields from Constructor
            $column->add_child( $areas_served );
            
            
                                    
            $row->add_child( $column );
            
            $this->add_child( $row );
            
        }
        
    }
}
   
new Home_Areas_We_Serve_Section;
