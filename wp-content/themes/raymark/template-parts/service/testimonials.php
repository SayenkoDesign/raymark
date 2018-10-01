<?php

/*
Service - Testimonials
		
*/    
    
if( ! class_exists( 'Service_Testimonials_Section' ) ) {
    class Service_Testimonials_Section extends Element_Section {
        
        public function __construct() {
            parent::__construct();

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
                     $this->get_name() . '-testimonials',
                     $this->get_name() . '-testimonials' . '-' . $this->get_id(),
                ]
            );
        }
        
        // Add content
        public function render() {
            
            $testimonials = $this->get_testimonials();
            
            if( empty( $testimonials ) ) {
                return false;
            }
            
            // split testimonials into 2's
            $columns = array_chunk( $testimonials, 2 );
                        
            $rows = array_map( array( $this, 'wrap_columns' ), $columns );
                                       
            return sprintf( '<div class="row align-middle"><div class="column"><header><h2><span>Reviews</span></h2></header><div class="slick">%s</div></div></div>', 
                            join( '', $rows ) );
        }
        
        private function get_testimonials() {
            
            $slides = [];
            
            $stars = sprintf('<div class="stars"><img src="%sservice/stars.png" alt="5 stars" /></div>', trailingslashit( THEME_IMG ) ); 
            
            // arguments, adjust as needed
            $args = array(
                'post_type'      => 'testimonial',
                'posts_per_page' => 100,
                'post_status'    => 'publish'
            );
        
            // Use $loop, a custom variable we made up, so it doesn't overwrite anything
            $loop = new WP_Query( $args );
        
            // have_posts() is a wrapper function for $wp_query->have_posts(). Since we
            // don't want to use $wp_query, use our custom variable instead.
            if ( $loop->have_posts() ) :                 
            
                 while ( $loop->have_posts() ) : $loop->the_post(); 
        
                    $cite =  _s_format_string( get_the_title(), 'h3' );
                                                    
                    $blockquote = sprintf( '<blockquote>%s%s%s</blockquote>', 
                                           $stars, apply_filters( 'pb_the_content', get_the_content() ), $cite );
                    
                    $slides[] = sprintf( '<div class="column">%s</div>', $blockquote );
        
                endwhile;
            endif;
            wp_reset_postdata();  
            
            return $slides; 
        }
        
        
        private function wrap_columns( $columns ) {
            if( ! empty( $columns ) ) {
                return sprintf( '<div class="slide"><div class="row large-unstack align-middle">%s</div></div>', join( '', $columns ) );
            }
        }
      
    }
}
   
new Service_Testimonials_Section;

    