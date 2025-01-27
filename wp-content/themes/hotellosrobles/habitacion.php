<?php
/* habitacion.php
* @package WordPress
* @subpackage hotellosrobles
* @since hotellosrobles 2.0
* Template Name: Habitación
*/ ?>
<?php get_header();?>
		
		<?php //El loop de WordPress
		if (have_posts()) : while (have_posts()) : the_post(); get_page($page_id); $page_data = get_page($page_id);?>
		<div class="clearfix"></div>
		<h1><?php the_title();?></h1>
		<article class="article_left habitacion">
			<div class="imagen">
				<figure>
					<div class="imagen_elastica">
						<?php //Imágenes repetibles
						if(wpmd_is_phone()) {//Smartphone
							if(has_post_thumbnail()) {
							the_post_thumbnail('custom-thumb-600-450');
							} else {
								echo '<img src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" alt="'.__('Sin imagen', 'hotellosrobles').'" />';
							}
						}
						else if(wpmd_is_tablet()) {//Tablet
							if(has_post_thumbnail()) {
							the_post_thumbnail('custom-thumb-800-600');
							} else {
								echo '<img src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" alt="'.__('Sin imagen', 'hotellosrobles').'" />';
							}
						}
						else if(wpmd_is_notdevice()) {//Desktop
							if(has_post_thumbnail()) {
							the_post_thumbnail('custom-thumb-1000-800');
							} else {
								echo '<img src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" alt="'.__('Sin imagen', 'hotellosrobles').'" />';
							}
						}
						;?>
					</div>

					<?php if(wpmd_is_notdevice()) {//Enlaces al fancybox imágenes grandes. Desktops ?>
					<?php $attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible',true));
					foreach ($attachID as $item) {
					$imagen = wp_get_attachment_image_src($item,'custom-thumb-1600-x'); 
					$alt = get_post_meta($item, '_wp_attachment_image_alt', true);
					$descripcion = get_post_field('post_content', $item);
					echo '<a title="'.$alt.'" class="fancybox" rel="gallery1" href="'.$imagen[0].'">';
					//if (count($alt)) {};
					echo '</a>';};?>
					<?php };?>

					<?php if(wpmd_is_tablet()) {//Enlaces al fancybox imágenes grandes. Tablets ?>
					<?php $attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible',true));
					foreach ($attachID as $item) {
					$imagen = wp_get_attachment_image_src($item,'custom-thumb-1000-x'); 
					$alt = get_post_meta($item, '_wp_attachment_image_alt', true);
					$descripcion = get_post_field('post_content', $item);
					echo '<a title="'.$alt.'" class="fancybox" rel="gallery1" href="'.$imagen[0].'">';
					//if (count($alt)) {};
					echo '</a>';};?>
					<?php };?>

				</figure>
				<div class="clearfix"></div>
			</div><!-- .imagen -->
		</article>
		<article class="article_right individual habitacion">
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
			
			<?php if(wpmd_is_phone()) { //Listado de imágenes. Smartphones ?>
			<div class="imagen">
				<figure class="solo_movil">
					<?php $attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible',true));
					foreach ($attachID as $item) {
					$imagen = wp_get_attachment_image_src($item,'custom-thumb-600-x'); 
					$alt = get_post_meta($item, '_wp_attachment_image_alt', true);
					$descripcion = get_post_field('post_content', $item);
					echo '<img alt="'.$alt.'" src="'.$imagen[0].'" ';
					//if (count($alt)) {};
					echo '/>';};?>	
				</figure><!-- .solo_movil -->
			</div><!-- .imagen -->
			<?php };?>
		</article>
		<article>
			<h3><?php _e('Ver otras habitaciones...', 'hotellosrobles');?></h3>
			<ul class="subpaginas">
			<?php $args = array(
				'child_of'		=> 8,
				'title_li'		=> ''
			);
			wp_list_pages( $args );
			?>
			</ul>
		</article>
		<?php endwhile; else: ?>
		<?php endif; ?>
	</section>
</div><!-- #home_page -->
<?php get_footer();?>