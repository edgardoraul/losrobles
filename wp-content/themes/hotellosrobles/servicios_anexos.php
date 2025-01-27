<?php
/* servicios_anexos.php
* @package WordPress
* @subpackage hotellosrobles
* @since hotellosrobles 2.0
* Template Name: Servicios Anexos
*/ ?>
	<?php get_header();?>

		<h1>Servicios Anexos</h1>

		<?php //Este loop es para mostar el contenido de las subpáginas hijas...en este caso las temporadas.
		$args = array(
		    'post_type'      => 'page',
		    'posts_per_page' => -1,
		    'post_parent'    => $post->ID,
		    'order'          => 'ASC',
		    'orderby'        => 'menu_order'
		 );
		$parent = new WP_Query( $args );
		if ( $parent->have_posts() ) : ?>
		<?php while ( $parent->have_posts() ) : $parent->the_post(); ?>

		<article id="parent-<?php the_ID(); ?>" class="servicios_anexos parent-page">

			<div class="enlaces">
				<?php if( wpmd_is_notphone() )
				{ ?>
					<?php 
					// Los enlaces al Fancybox. Solo para Tablets y Desktops.
					// A contunuación se mostrará el enlace provisto por la imagen destacada.
					if ( has_post_thumbnail() ) 
					{
						$custom_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'custom-thumb-1600-x' );
						$src = $custom_thumb['0'];
						echo '<a href="'.$src.'" class="fancybox" rel="gallery'.$post->ID.'"></a>';
					} else
					{
						echo '<a class="fancybox" rel="gallery'.$post->ID.'" href="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" alt="'.__('Sin imagen', 'hotellosrobles').'"></a>';
					}

					//Enlaces provistos por el listado de imágenes
					$attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible', true));
					foreach ($attachID as $item)
					{
						$imagen = wp_get_attachment_image_src($item,'custom-thumb-1600-x'); 
						$alt = get_post_meta($item, '_wp_attachment_image_alt', true);
						$descripcion = get_post_field('post_content', $item);
						if ($imagen[0]!='') 
						{
							echo '<a title="'.$alt.'" class="fancybox" rel="gallery'.$post->ID.'" href="'.$imagen[0].'">';
							
							echo '</a>';}
							
						}?>
				<?php };?>
			</div> <!-- .enlaces -->

			<!-- El slider con las imágenes -->
			<figure class="cycle-slideshow"
			data-cycle-fx="fade"
			data-cycle-speed="2000"
			data-cycle-pause-on-hover="true">
				<?php //Solo para teléfonos
				if (wpmd_is_phone()) 
				{
					//Primera imágen es la destacada
					if(has_post_thumbnail())
					{
						the_post_thumbnail('custom-thumb-600-450');
					} else 
					{
						echo '<img src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" alt="'.__('Sin imagen', 'hotellosrobles').'" />';
					}
					//Ahora el listado del resto de imágenes
					$attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible',true));
					foreach ($attachID as $item) {
					$imagen = wp_get_attachment_image_src($item,'custom-thumb-600-450'); 
					$alt = get_post_meta($item, '_wp_attachment_image_alt', true);
					$descripcion = get_post_field('post_content', $item);
					
					if ($imagen[0]!='') 
					{
						echo '<img alt="'.$alt.'" src="'.$imagen[0].'" ';
						
						echo '/>';};
					}
				};
				if (wpmd_is_notphone()) 
				{ //Para tablets y desktops
					//Primera imágen es la destacada
					if(has_post_thumbnail())
					{
						the_post_thumbnail('custom-thumb-1000-800');
					} else 
					{
						echo '<a href="" class="fancybox" rel="gallery'.$post->ID.'"><img src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" alt="'.__('Sin imagen', 'hotellosrobles').'" />';
					}
					// Ahora el listado del resto de imágenes
					$attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible',true));
					foreach ($attachID as $item) {
					$imagen = wp_get_attachment_image_src($item,'custom-thumb-1000-800'); 
					$alt = get_post_meta($item, '_wp_attachment_image_alt', true);
					$descripcion = get_post_field('post_content', $item);
					
					if ($imagen[0]!='') 
					{
						echo '<img alt="'.$alt.'" src="'.$imagen[0].'" ';
						
						echo '/>';};
					}
				} /*Fin del slideshow con las imágenes*/
				;?>
				<figcaption><?php _e('Contiguo al hotel.', 'hotellosrobles');?></figcaption>
			</figure><!-- .cycle-slideshow -->
		
			<div>
				<h2><?php the_title();?></h2>
				<cite>
					<?php the_content();?>
				</cite>
			</div>
		</article>
		<hr />

		<?php endwhile; ?>
		<?php endif; wp_reset_query(); //Fin de este loop?>		
	</section>
	</div><!-- #home_page -->
<?php get_footer();?>