<?php
/**
 * Custom Body Class
 *
 * @param array $classes
 * @return array
 */

add_filter( 'body_class', function( $classes ) {
    unset( $classes[array_search('page-template-default', $classes )] );
    return $classes;
}, 99 );

get_header(); ?>

<?php
_s_get_template_part( 'template-parts/home', 'hero-video' );
?>

<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">
     
	<?php
     
     _s_get_template_part( 'template-parts/home', 'reviews' );
     
     _s_get_template_part( 'template-parts/home', 'services' );
     
     _s_get_template_part( 'template-parts/home', 'about' );
     
     _s_get_template_part( 'template-parts/home', 'discount' );
     
     _s_get_template_part( 'template-parts/home', 'areas-we-serve' );

   	?>
        
	</main>


</div>

<?php
get_footer();
