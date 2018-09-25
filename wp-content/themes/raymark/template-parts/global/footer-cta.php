<?php
// Footer - CTA

if( ! class_exists( 'Footer_CTA_Section' ) ) {
    class Footer_CTA_Section extends Element_Section {
        
        public function __construct() {
            parent::__construct();
            
            $show_footer_cta = false;

            // default to TRUE for the blog
            if( is_page() && ! is_front_page() ) {
                $show_footer_cta = get_field( 'page_settings_call_to_action' );
            }
            else {
                $show_footer_cta = true;
            }
            
            if( ! $show_footer_cta ) {
                return false;
            }
                        
            $fields['footer_cta_text'] = get_field( 'footer_cta_text', 'option' );
            $fields['footer_cta_link'] = get_field( 'footer_cta_link', 'option' );
                        
            $fields['show_footer_cta'] = $show_footer_cta;            
                        
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
                     $this->get_name() . '-footer-cta'
                ]
            );            
            
        }  
       
        
        // Add content
        public function render() {
                
            $footer_cta_text = sprintf( '<div class="column"><h2>%s</h2></div>', $this->get_fields( 'footer_cta_text' ) );
            
            $footer_cta_link = $this->get_fields( 'footer_cta_link' );
            $footer_cta_link_url = $footer_cta_link['url'];
            $footer_cta_link_title = empty( $footer_cta_link['title'] ) ? 'Donate Now!' : $footer_cta_link['title'];
            $footer_cta_button = sprintf( '<div class="column shrink"><a href="%s" class="red button">%s</a></div>', $footer_cta_link_url, $footer_cta_link_title );
            
            return sprintf( '<div class="row large-unstack align-middle">%s%s</div>', $footer_cta_text, $footer_cta_button );
        
        }
        
    }
}
   
new Footer_CTA_Section;
