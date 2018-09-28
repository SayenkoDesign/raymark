<?php

get_header(); 

_s_get_template_part( 'template-parts/service', 'hero' );
?>

<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">
     
	<?php
    _s_get_template_part( 'template-parts/service', 'form' );
    
    _s_get_template_part( 'template-parts/service', 'reviews' );
    
    _s_get_template_part( 'template-parts/service', 'content' ); 
    
    _s_get_template_part( 'template-parts/service', 'faq' );
    
    _s_get_template_part( 'template-parts/service', 'contact' );  
   
    _s_get_template_part( 'template-parts/service', 'about' );	
    
    _s_get_template_part( 'template-parts/service', 'testimonials' ); 	
    
    
	?>
        
	</main>


</div>

<?php
get_footer();
