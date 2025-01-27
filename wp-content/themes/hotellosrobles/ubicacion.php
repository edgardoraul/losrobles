<?php
/* ubicacion.php
* @package WordPress
* @subpackage hotellosrobles
* @since hotellosrobles 2.0
* Template Name: Ubicación - 2 Cols c/img a la izquierda
*/ ?>
<?php get_header();?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); get_page($page_id); $page_data = get_page($page_id);?>
		<div class="clearfix"></div>
		<h1><?php the_title();?></h1>
		<article class="article_left">
			<div class="imagen ubicacion">
				<figure class="excursiones">
					<div class="imagen_elastica">
						<?php if (wpmd_is_notdevice()) {//Obteniendo la url de la thumbnail. Desktop
							$custom_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'custom-thumb-1600-x' );
							$src = $custom_thumb['0'];
						} else if (wpmd_is_tablet()) {//Obteniendo la url de la thumbnail. Tablet
							$custom_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'custom-thumb-1000-x' );
							$src = $custom_thumb['0'];}?>
						<?php if (wpmd_is_notphone()) {//Solo para Desktop y Tablets ?>
						<div>
							<a href="<?php echo $src;?>" class="fancybox boton_enviar" rel="gallery1" title="<?php the_title();?>"><?php _e('Ver mapas', 'hotellosrobles');?></a>
						</div>
					<?php };?>
					<?php //Aca va la primera imágen, la destacada. Si no hay una establecida, se carga una imagen ilustrativa por defecto.
					if (wpmd_is_notdevice()) {//Solo Desktop
 						if ( has_post_thumbnail()) {
   							$custom_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full');
							$src = $custom_thumb['0'];
   							echo '<a href="'; echo $src; echo '" >'; echo the_post_thumbnail('custom-thumb-600-450').'</a>';
   						} else {
   							echo '<img src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" alt="'.__('Sin imagen', 'hotellosrobles').'" />';
   						};
   						echo '<div class="mapa-ubicacion">';
   						// echo do_shortcode('[codepeople-post-map]');
   						echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3921.093402047729!2d-65.01346940887112!3d-31.714347730997314!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x2e447e03f5ea99f8!2sHotel+Los+Robles!5e0!3m2!1ses-419!2sar!4v1477495375381" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>';
   						echo '</div>';
   						//Acá irá un listado de imágenes 
						$attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible',true));?>
						<?php if ($attachID !== '') {
						foreach ($attachID as $item) {
						$imagen = wp_get_attachment_image_src($item,'custom-thumb-600-x'); // Obtenemos la image "full". En vez de full podemos poner otro que dispongamos en nuestro tema
						$alt = get_post_meta($item, '_wp_attachment_image_alt', true); // Si queremos obtener el alt de la imagen
						$descripcion = get_post_field('post_content', $item); // Si queremos obtener la descripción de la imagen
						echo '<img class="item ocultar" src="' . $imagen[0] . '" width="' . $imagen[1] . '" height="' . $imagen[2] . '"';
						
echo ' alt="' . $alt . '"';

						echo ' />';
						echo '<div class="ocultar"><span>'.$alt.'</span></div>';
						};
   						}
   					};
   					if (wpmd_is_tablet()) {//Solo Tablet
   						if ( has_post_thumbnail()) {
							$custom_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full');
							$src = $custom_thumb['0'];   						
   							echo '<a href="'; echo $src; echo '" >'; echo the_post_thumbnail('custom-thumb-1000-800').'</a>';
   						} else {
   							echo '<img src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" alt="'.__('Sin imagen', 'hotellosrobles').'" />';
   						}
   						echo '<div class="mapa-ubicacion">';
   						// echo do_shortcode('[codepeople-post-map]');
   						echo '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3921.093402047729!2d-65.01346940887112!3d-31.714347730997314!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x2e447e03f5ea99f8!2sHotel+Los+Robles!5e0!3m2!1ses-419!2sar!4v1477495375381" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>';
   						echo '</div>';
   					};
   					if (wpmd_is_phone()) {//Solo smartphone
   						if ( has_post_thumbnail()) {
   							$custom_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full');
							$src = $custom_thumb['0'];
   							echo '<a href="'; echo $src; echo '" >'; echo the_post_thumbnail('custom-thumb-800-600').'</a>';
   						} else {
   							echo '<img src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" alt="'.__('Sin imagen', 'hotellosrobles').'" />';
   						}
   						echo '<div class="mapa-ubicacion">';
   						echo do_shortcode('[codepeople-post-map]');
   						echo '</div>';   						
   					};?>
				</div>
					<?php if(wpmd_is_notdevice()) {//Enlaces al fancybox imágenes grandes. Desktops ?>
					<?php $attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible',true));
					foreach ($attachID as $item) {
					$imagen = wp_get_attachment_image_src($item,'custom-thumb-1600-x'); 
					$alt = get_post_meta($item, '_wp_attachment_image_alt', true);
					$descripcion = get_post_field('post_content', $item);
					echo '<a title="'.$alt.'" class="fancybox" rel="gallery1" href="'.$imagen[0].'">';
					
					echo '</a>';};?>
					<?php };?>

					<?php if(wpmd_is_tablet()) {//Enlaces al fancybox imágenes grandes. Tablets ?>
					<?php $attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible',true));
					foreach ($attachID as $item) {
					$imagen = wp_get_attachment_image_src($item,'custom-thumb-1000-x'); 
					$alt = get_post_meta($item, '_wp_attachment_image_alt', true);
					$descripcion = get_post_field('post_content', $item);
					echo '<a title="'.$alt.'" class="fancybox" rel="gallery1" href="'.$imagen[0].'">';
					
					echo '</a>';};?>
					<?php };?>	
				</figure>
				<div class="clearfix"></div>
			</div><!-- .imagen -->
		</article>
		<article class="article_right">
			<?php the_content();?>
			<div class="imagen">
				<figure class="solo_movil">
				<?php $attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible',true));?>
				<?php if ($attachID !== '') {
				foreach ($attachID as $item) {
				$imagen_full = wp_get_attachment_image_src($item,'full');//con esto logramos que la imagen tenga un enlace al su versión full lista para descargarla o verla en fullsize.
				$imagen = wp_get_attachment_image_src($item,'custom-thumb-1000-800');
				$alt = get_post_meta($item, '_wp_attachment_image_alt', true); // Si queremos obtener el alt de la imagen
				$descripcion = get_post_field('post_content', $item); // Si queremos obtener la descripción de la imagen
				echo '<a href="'.$imagen_full[0].'"><img class="item" src="' . $imagen[0] . '" width="' . $imagen[1] . '" height="' . $imagen[2] . '"';
					
echo ' alt="' . $alt . '"';

				echo ' /></a>';
				echo '<div><span>'.$alt.'</span></div>';
				};}?>
				</figure>
			</div>
		</article>
		<?php endwhile; else: endif;?>
	</section>
</div><!-- #home_page -->
<?php get_footer();?>