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

					// Seleccionamos las imágenes según el dispositivo
					if( wpmd_is_phone() ) {
						$imagen_seleccionada = "custom-thumb-600-450";
					} elseif( wpmd_is_tablet() ) {
						$imagen_seleccionada = "custom-thumb-1060-795";
					} else {
						$imagen_seleccionada = "custom-thumb-1600-1200";
					}
					
					// Mostramos las imágenes repetibles según el dispositivo seleccionado
					$attachID = ( get_post_meta( $post->ID, 'custom_imagenrepetible',true) );
					if ($attachID !== '')
					{
						foreach ($attachID as $item)
						{
							$imagen = wp_get_attachment_image_src($item, $imagen_seleccionada); 
							$alt = get_post_meta($item, '_wp_attachment_image_alt', true);
							$descripcion = get_post_field('post_content', $item); 
							echo '<img class="item" src="' . $imagen[0] . '" alt="' . $alt . '" />';
						}
					}

				}
			}
			
			// Restore original Post Data
			wp_reset_postdata();?>
			

			<div class="navegacion">
				<div class="back"><a href="#navegacion">‹</a></div>
				<div class="next"><a href="#navegacion">›</a></div>
			</div><!-- .navegación -->
		</div>
		</article>
	</section>
	</div><!-- #home_page -->
<?php get_footer();?>