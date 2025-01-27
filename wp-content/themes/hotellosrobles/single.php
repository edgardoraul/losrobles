<?php get_header();?>
		<article class="">
			<a href="<?php bloginfo('url');?>/novedades"><h2><?php _e('Volver a Novedades', 'hotellosrobles');?></h2></a>
			<div class="blog entrada-individual">
			<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
				<h3><?php the_title();?></h3>
					<time datetime="<?php the_time('j-m-Y');?>" pubdate><?php _e('Publicado el', 'hotellosrobles');?>: <?php the_time('j-m-Y');?></time>
				<div class="imagen">
				<figure>
					<div class="imagen_elastica">
					<?php 
					if (wpmd_is_notdevice()) {//Desktop
 						if (has_post_thumbnail()) {the_post_thumbnail('custom-thumb-800-x');
   							} else {
   							echo '<img alt="'.__('Sin imagen', 'hotellosrobles').'" src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" />';
   						};
   					};
   					if(wpmd_is_tablet()) {//Tablets
   						if (has_post_thumbnail()) {the_post_thumbnail('custom-thumb-1000-x');
   						} else {
   							echo '<img alt="'.__('Sin imagen', 'hotellosrobles').'" src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" />';
   						};
   					};
   					if(wpmd_is_phone()) {//Smartphones
   						if (has_post_thumbnail()) {the_post_thumbnail('custom-thumb-600-x');
   						} else {
   							echo '<img alt="'.__('Sin imagen', 'hotellosrobles').'" src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" />';
   						};
   					};?>
				<?php //Listado de imágenes para tablets
				/*if(wpmd_is_tablet()) {
				$attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible',true));?>
				<?php if ($attachID !== '') {
				foreach ($attachID as $item) {
				$imagen = wp_get_attachment_image_src($item,'custom-thumb-1000-x');
				$alt = get_post_meta($item, '_wp_attachment_image_alt', true);
				$descripcion = get_post_field('post_content', $item); 
				echo '<img class="item" src="' . $imagen[0] . '"';
					
echo ' alt="' . $alt . '"';

				echo ' />';};
					};
				};*/?>
				<?php //Listado de imágenes para smartphones y desktop
				/*if(wpmd_is_nottab()) {
				$attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible',true));?>
				<?php if ($attachID !== '') {
				foreach ($attachID as $item) {
				$imagen = wp_get_attachment_image_src($item,'custom-thumb-600-x');
				$alt = get_post_meta($item, '_wp_attachment_image_alt', true);
				$descripcion = get_post_field('post_content', $item); 
				echo '<img class="item" src="' . $imagen[0] . '"';
					
echo ' alt="' . $alt . '"';
			echo ' />';};
					};
				};*/?>		
					</div>					
					<figcaption>
						<div class="texto"><?php the_content();?></div>
						<?php/* if(wpmd_is_notdevice()) {//Un listado de enlaces para las imágenes grandes que usarán si solo es un desktop
						$attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible',true));
						foreach ($attachID as $item) {
						$imagen = wp_get_attachment_image_src($item,'custom-thumb-1600-x'); 
						$alt = get_post_meta($item, '_wp_attachment_image_alt', true);
						$descripcion = get_post_field('post_content', $item);
						echo '<a title="'.$alt.'" class="fancybox" rel="gallery1" href="'.$imagen[0].'">';
						
						echo '</a>';};					
						}
						;?>
						<?php if (wpmd_is_notdevice()) {//Solo Desktop
						$custom_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'custom-thumb-1600-x' );
						$src = $custom_thumb['0'];};?>
						<?php if(wpmd_is_notdevice()) {//Solo Desktop */?>
							<!--<div>
								<a href="<?php //echo $src;?>" class="fancybox boton_enviar" rel="gallery1" title="<?php the_title();?>">
								<?php //_e('Ver fotos...', 'hotellosrobles');?>
								</a>
							</div>-->
						<?php //};?>
					</figcaption>
				</figure>
				<div class="clearfix"></div>
			</div>
			<hr />
			<!-- #pagination -->
			<div class="alert">
				<span class="izq">
				<?php echo _e("Anterior: ", "hotellosrobles"); previous_post_link();?>
				</span>
				<span class="der">
					<?php echo _e("Siguiente: ", 'hotellosrobles'); next_post_link();?>
				</span>
				<div class="clearfix"></div>
			</div><!-- #pagination -->
			<hr />
			<div class="comentarios">
				<?php comments_template(); ?>
			</div>
			<?php endwhile; else: ?>
				<p><?php _e('No hay entradas .'); ?></p>
			<?php endif; ?>
			</div><!-- .blog -->
		</article>
	</section>
	</div><!-- #home_page -->
<?php get_footer();?>