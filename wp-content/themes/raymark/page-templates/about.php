<?php
/*
Template Name: About
*/

function kr_body_class( $classes ) {
  unset( $classes[array_search('page-template-default', $classes )] );
  $classes[] = 'page-builder';
  return $classes;
}
add_filter( 'body_class', 'kr_body_class', 99 );

get_header(); ?>

<?php
_s_get_template_part( 'template-parts/global', 'hero' );
_s_get_template_part( 'template-parts/about', 'mission' );

function my_the_content_filter($content) 
{
  	$a = array('<h2>','</h2>');
	$b = array('<h2><span>','</span></h2>');
	$content = str_replace( $a, $b, $content );
  	return $content;
}

//add_filter( 'the_content', 'my_the_content_filter' );


function my_acf_load_value( $value, $post_id, $field )
{
    $pos = strpos( $value, '<span>' );

    if( $pos === false ) {
    	return $value;
    }

    $a = array('<h2>','</h2>');
	$b = array('<h2><span>','</span></h2>');
	$value = str_replace( $a, $b, $value );
  	return $value;
}

// acf/load_value - filter for every value load
//add_filter('acf/load_value', 'my_acf_load_value', 10, 3);

function my_acf_format_value( $value, $post_id, $field ) {
	
    $a = array('<h2>','</h2>');
	$b = array('<h2><span>','</span></h2>');
	$value = str_replace( $a, $b, $value );
	
	
	// return
	return $value;
}

add_filter('acf/format_value/type=wysiwyg', 'my_acf_format_value', 10, 3);

?>

<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">
	<?php
        while ( have_posts() ) :

        the_post();

        if ( have_rows('sections') ) {
		
			while ( have_rows('sections') ) { 
			
				the_row();
                
                // Use custom template part function so we can pass data
                _s_get_template_part( 'template-parts/page-builder', sprintf( 'section-%s', get_row_layout() ), ['data' => [] ] );
  					
			} // endwhile have_rows('sections')
			
 		
		} // endif have_rows('sections')

        endwhile; 	
    
	?>
	</main>


</div>

<?php
get_footer();
