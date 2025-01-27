<?php
/* page_1col.php
* @package WordPress
* @subpackage hotellosrobles
* @since hotellosrobles 2.0
* Template Name: Clima
*/ ?>
<?php get_header();?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); get_page($page_id); $page_data = get_page($page_id);?>
		<div class="clearfix"></div>
		<h1><?php the_title();?></h1>
		<article class="article_left">
			<div class="imagen">
				<figure class="excursiones">
					<div class="imagen_elastica">
						
					<?php //Aca va la primera imágen, la destacada. Si no hay una establecida, se carga una imagen ilustrativa por defecto.
					if (wpmd_is_notdevice()) {//Solo Desktop
 						if ( has_post_thumbnail()) {
   						echo get_the_post_thumbnail($post->ID, 'custom-thumb-600-450');
   						} else {
   							echo '<img src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" alt="'.__('Sin imagen', 'hotellosrobles').'" />';
   						};
   						//Acá irá un listado de imágenes 
					$attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible',true));
						if ($attachID !== '') {
							foreach ($attachID as $item) {
								$imagen = wp_get_attachment_image_src($item,'custom-thumb-600-x'); // Obtenemos la image "full". En vez de full podemos poner otro que dispongamos en nuestro tema
								$alt = get_post_meta($item, '_wp_attachment_image_alt', true); // Si queremos obtener el alt de la imagen
								$descripcion = get_post_field('post_content', $item); // Si queremos obtener la descripción de la imagen
								echo '<img class="item ocultar" src="' . $imagen[0] . '" width="' . $imagen[1] . '" height="' . $imagen[2] . '"';
									
										echo ' alt="' . $alt . '"';
									
								echo ' />';
								echo '<div class="ocultar"><span>'.$alt.'</span></div>';
							};
   						};
   					};
   					if (wpmd_is_tablet()) {//Solo Tablet
   						if ( has_post_thumbnail()) {
   						echo get_the_post_thumbnail($post->ID, 'custom-thumb-1000-800'); 
   						} else {
   							echo '<img src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" alt="'.__('Sin imagen', 'hotellosrobles').'" />';
   						}
   					};
   					if (wpmd_is_phone()) {//Solo smartphone
   						if ( has_post_thumbnail()) {
   							the_post_thumbnail('custom-thumb-800-600');
   						} else {
   							echo '<img src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" alt="'.__('Sin imagen', 'hotellosrobles').'" />';
   						}
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
			<?php if(wpmd_is_phone()) {//El Clima para phones ?>
				<div id="cont_f575c1bef3150b1e813500ad86637096">
  					<span id="h_f575c1bef3150b1e813500ad86637096"><a id="a_f575c1bef3150b1e813500ad86637096" href="http://www.tiempo.com/" target="_blank" rel="nofollow" style="color:#339966;font-family:Helvetica;font-size:14px;">El Tiempo</a> en Villa Cura Brochero</span>
  					<script type="text/javascript" src="http://www.tiempo.com/wid_loader/f575c1bef3150b1e813500ad86637096"></script>
				</div>
			<?php };?>
			<?php if (wpmd_is_notphone()) {//para Desktops y Tablets ?>
				<div id="cont_5d14fd74b6c44d840b5d3a857a413018">
  					<span id="h_5d14fd74b6c44d840b5d3a857a413018">El Tiempo en <a id="a_5d14fd74b6c44d840b5d3a857a413018" href="http://www.tiempo.com/villa-cura-brochero.htm" target="_blank" style="color:#339966;font-family:Helvetica;font-size:14px;">Villa Cura Brochero</a></span>
 					 <script type="text/javascript" src="http://www.tiempo.com/wid_loader/5d14fd74b6c44d840b5d3a857a413018"></script>
				</div>
			<?php };?>
			<?php the_content();?>
			<?php // Es para no enviar esto si es un móvil
			if (wpmd_is_notdevice()) {//Obteniendo la url de la thumbnail. Desktop
				$custom_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'custom-thumb-1600-x' );
				$src = $custom_thumb['0'];
			}
			else if (wpmd_is_tablet()) {//Obteniendo la url de la thumbnail. Tablet
				$custom_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'custom-thumb-1000-x' );
				$src = $custom_thumb['0'];
			}?>
			<?php if (wpmd_is_notphone()) {//Solo para Desktop y Tablets ?>
			<div>
				<a href="<?php echo $src;?>" class="fancybox boton_enviar" rel="gallery1" title="<?php the_title();?>">
					<?php _e('Ver fotos...', 'hotellosrobles');?>
				</a>
			</div>
			<?php };?>

			<div class="imagen"><figure class="solo_movil">
				<!-- Acá irá un listado de imágenes -->
				<?php $attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible',true));?>
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
		</article>
		<?php endwhile; else: endif;?>
	</section>
</div><!-- #home_page -->
<?php get_footer();?>