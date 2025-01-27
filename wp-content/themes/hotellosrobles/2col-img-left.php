<?php
/* vacaciones.php
* @package WordPress
* @subpackage hotellosrobles
* @since hotellosrobles 2.0
* Template Name: 2 Columnas con imágenes a la izquierda
*/ ?>
<?php get_header();?>
		<!-- El loop de WordPress -->
		<?php if (have_posts()) : while (have_posts()) : the_post(); get_page($page_id); $page_data = get_page($page_id);?>
		<div class="clearfix"></div>
		<h1><?php the_title();?></h1>
		<article class="article_left">
			<div class="imagen vacaciones">
				<!-- Imágenes repetibles -->
				<figure>
					<div class="imagen_elastica">
					<?php //Es para no enviar esto si es un móvil
					if (wpmd_is_notdevice()) {
 						if ( has_post_thumbnail()) {
   						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
   						echo '<a class="fancybox" rel="gallery1" href="' . $large_image_url[0] . '" title="' . the_title_attribute('echo=0') . '" >';
   						echo get_the_post_thumbnail($post->ID, 'custom-thumb-800-600'); 
   						echo '</a>';
   						} else {
   							echo '<img alt="'.__('Sin imagen', 'hotellosrobles').'" src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" />';
   						}
   					};
   					if (wpmd_is_phone()) {
   						if ( has_post_thumbnail()) {
   							the_post_thumbnail('custom-thumb-800-600');
   						} else {
   							echo '<img alt="'.__('Sin imagen', 'hotellosrobles').'" src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" />';
   						}
   					};?>
					</div>

					<!-- Los enlaces al fancybox provistos por las imágenes grandes -->
					<?php $attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible',true));
					foreach ($attachID as $item) {
					$imagen = wp_get_attachment_image_src($item,'custom-thumb-1600-x'); // Obtenemos la image "full". En vez de full podemos poner otro que dispongamos en nuestro tema
					$alt = get_post_meta($item, '_wp_attachment_image_alt', true); // Si queremos obtener el alt de la imagen
					$descripcion = get_post_field('post_content', $item); // Si queremos obtener la descripción de la imagen
					echo '<a title="'.$alt.'" class="fancybox" rel="gallery1" href="' . $imagen[0] . '">';
					
					echo '</a>';};?>
					
				</figure>
				<div class="clearfix"></div>
				
				<?php //El mismo listado de imágenes. Acá solo se verá pero en desktops. No en móviles ni táblets
				if (wp_is_mobile()==false) { ?>
				<div class="imagen vacaciones"><figure class="solo_movil">
				
				<?php //Acá irá un listado de imágenes
				$attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible',true));?>
				<?php if ($attachID !== '') {
				foreach ($attachID as $item) {
				$imagen = wp_get_attachment_image_src($item,'custom-thumb-1000-800'); // Obtenemos la image "full". En vez de full podemos poner otro que dispongamos en nuestro tema
				$alt = get_post_meta($item, '_wp_attachment_image_alt', true); // Si queremos obtener el alt de la imagen
				$descripcion = get_post_field('post_content', $item); // Si queremos obtener la descripción de la imagen
				echo '<img class="item" src="' . $imagen[0] . '" width="' . $imagen[1] . '" height="' . $imagen[2] . '"';
					
echo ' alt="' . $alt . '"';

				echo ' />';
				echo '<div><span>'.$alt.'</span></div>';
				};}?>
				</figure></div>
				<?php };?>


			</div><!-- .imagen -->
		</article>
		<article class="article_right">
			<?php the_content();?>
			<?php // Es para no enviar esto si es un móvil
			if (wp_is_mobile()==false) { ?>			
			<div><a href="<?php if ( has_post_thumbnail()) {echo $large_image_url[0];};?>" class="fancybox boton_enviar" rel="gallery1" title="Ver fotos...">Ver fotos...</a></div>
			<div class="imagen vacaciones"><figure class="solo_movil">
			<?php //Acá irá un listado de imágenes. Solo se mostrará en dispositivos móviles
			$attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible',true));?>
			<?php if ($attachID !== '') {
			foreach ($attachID as $item) {
			$imagen = wp_get_attachment_image_src($item,'custom-thumb-1000-800'); // Obtenemos la image "full". En vez de full podemos poner otro que dispongamos en nuestro tema
			$alt = get_post_meta($item, '_wp_attachment_image_alt', true); // Si queremos obtener el alt de la imagen
			$descripcion = get_post_field('post_content', $item); // Si queremos obtener la descripción de la imagen
			echo '<img class="item" src="' . $imagen[0] . '" width="' . $imagen[1] . '" height="' . $imagen[2] . '"';
				
echo ' alt="' . $alt . '"';

			echo ' />';
			echo '<div><span>'.$alt.'</span></div>';
			};}?>
			</figure></div>
			<?php };?>
		</article>
		<?php // El final del loop
			endwhile; else: ?>
		<?php endif; ?>
	</section>
</div><!-- #home_page -->
<?php get_footer();?>