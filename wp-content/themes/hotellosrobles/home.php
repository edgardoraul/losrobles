<?php
/* home.php
* @package WordPress
* @subpackage hotellosrobles
* @since hotellosrobles 2.0
* Template Name: Home
*/ ?>
<?php get_header();?>
		<article id="home_slider">
			<div id="slider" class="cycle-slideshow" data-cycle-fx="fade" data-cycle-speed="2000" data-cycle-pause-on-hover="true" data-cycle-pager="#adv-custom-pager" data-cycle-next=".next" data-cycle-prev=".back" >
			
			<?php //Mostrando el contenido de la página Inicio
			//$recent = new WP_Query("page_id=77"); while($recent->have_posts()) : $recent->the_post();

			$args = array (
				'pagename' => 'inicio',
			);

			// The Query
			$query = new WP_Query( $args );

			// The Loop
			if ( $query->have_posts() )
			{
				while ( $query->have_posts() )
				{
					$query->the_post();
					// do something
			?>
				
				

				<?php if(wpmd_is_phone())
				{
					$attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible',true));
				?>

					<?php if ($attachID !== '')
					{
						foreach ($attachID as $item)
						{
							$imagen = wp_get_attachment_image_src($item,'custom-thumb-600-450'); 
							$alt = get_post_meta($item, '_wp_attachment_image_alt', true);
							$descripcion = get_post_field('post_content', $item); 
							echo '<img class="item" src="' . $imagen[0] . '"';
							
								echo ' alt="' . $alt . '"';
							
							echo ' />';
						};
					};
				};?>
				
				
				<?php if(wpmd_is_tablet())
				{
					$attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible',true));?>
					
					<?php if ($attachID !== '')
					{
						foreach ($attachID as $item)
						{
							$imagen = wp_get_attachment_image_src($item,'custom-thumb-1060-795');
							$alt = get_post_meta($item, '_wp_attachment_image_alt', true);
							$descripcion = get_post_field('post_content', $item);
							echo '<img class="item" src="' . $imagen[0] . '"';
							
								echo ' alt="' . $alt . '"';
							
							echo ' />';
						};
					};
				};?>
				

				<?php if(wpmd_is_notdevice())
				{
					$attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible',true));?>
				
					<?php if ($attachID !== '')
					{
						foreach ($attachID as $item)
						{
							$imagen = wp_get_attachment_image_src($item,'custom-thumb-1600-1200');
							$alt = get_post_meta($item, '_wp_attachment_image_alt', true);
							$descripcion = get_post_field('post_content', $item);
							echo '<img class="item" src="' . $imagen[0] . '"';
							
								echo ' alt="' . $alt . '"';
							
							echo ' />';
						};
					};
				};?>
			
			
			<?php
					}
				} else {
					// no posts found
				}
				// Restore original Post Data
				wp_reset_postdata();
			?>
			

			<div class="navegacion">
				<div class="back"><a href="#navegacion">‹</a></div>
				<div class="next"><a href="#navegacion">›</a></div>
			</div><!-- .navegación -->
		</div>
		</article>
	</section>
	</div><!-- #home_page -->
<?php get_footer();?>