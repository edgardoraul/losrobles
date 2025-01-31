<?php
/* habitaciones-listado.php
* @package WordPress
* @subpackage hotellosrobles
* @since hotellosrobles 2.0
* Template Name: Habitaciones - Listado
*/ ?>
<?php get_header();?>
		<article class="habitaciones_listado">
			<h1><?php the_title();?></h1>
			<div class="habitacion_listado">
			<?php $recent = new WP_Query("page_id=28"); while($recent->have_posts()) : $recent->the_post();?>
				<a href="<?php echo get_page_link( $post->ID );?>"><h3><?php the_title();?></h3></a>
				<div class="imagen">
				<figure>
					<a href="<?php echo get_page_link( $post->ID );?>">
						<?php //Mostramos si es un Desktop y/o Smartphone						
						if(wpmd_is_nottab()){
						the_post_thumbnail('custom-thumb-600-450');};
						if(wpmd_is_tablet()){//Mostramos si es una Tablet
						the_post_thumbnail('custom-thumb-1000-800');}?>
					</a>
					<figcaption>
						<?php the_content();?>
						<div><a href="<?php echo get_page_link( $post->ID );?>" class="boton_enviar ver_fotos"><?php _e('Ver fotos de la habitación', 'hotellosrobles');?></a></div>
					</figcaption>
				</figure>
				<div class="clearfix"></div>
				</div><!-- .imagen -->
				<?php endwhile; wp_reset_query();?>
			</div><!-- .habitacion_listado -->
			<div class="habitacion_listado">
			<?php $recent = new WP_Query("page_id=61"); while($recent->have_posts()) : $recent->the_post();?>
				<a href="<?php echo get_page_link( $post->ID );?>"><h3><?php the_title();?></h3></a>
				<div class="imagen">
				<figure>
					<a href="<?php echo get_page_link( $post->ID );?>">
						<?php
							if ( has_post_thumbnail() ) {
							
								// Mostramos si es un Desktop y/o Smartphone						
								if( wpmd_is_nottab() ) {
									the_post_thumbnail('custom-thumb-600-450');
								} else { // Para tablets
									the_post_thumbnail('custom-thumb-1000-800');
								};
								
							} else {
								echo '<img src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" alt="'.__('Sin imagen', 'hotellosrobles').'" />';
							}
						?>
					</a>
					<figcaption>
						<?php the_content();?>
						<div><a href="<?php echo get_page_link( $post->ID );?>" class="boton_enviar ver_fotos"><?php _e('Ver fotos de la habitación', 'hotellosrobles');?></a></div>
					</figcaption>
				</figure>
				<div class="clearfix"></div>
				</div><!-- .imagen -->
				<?php endwhile; wp_reset_query();?>
			</div><!-- .habitacion_listado -->			
			<div class="habitacion_listado">
			<?php $recent = new WP_Query("page_id=105"); while($recent->have_posts()) : $recent->the_post();?>
				<a href="<?php echo get_page_link( $post->ID );?>"><h3><?php the_title();?></h3></a>
				<div class="imagen">
				<figure>
					<a href="<?php echo get_page_link( $post->ID );?>">
						<?php
							if ( has_post_thumbnail() ) {
							
								// Mostramos si es un Desktop y/o Smartphone						
								if( wpmd_is_nottab() ) {
									the_post_thumbnail('custom-thumb-600-450');
								} else { // Para tablets
									the_post_thumbnail('custom-thumb-1000-800');
								};
								
							} else {
								echo '<img src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" alt="'.__('Sin imagen', 'hotellosrobles').'" />';
							}
						?>
					</a>
					<figcaption>
						<?php the_content();?>
						<div><a href="<?php echo get_page_link( $post->ID );?>" class="boton_enviar ver_fotos"><?php _e('Ver fotos de la habitación', 'hotellosrobles');?></a></div>
					</figcaption>
				</figure>
				<div class="clearfix"></div>
				</div><!-- .imagen -->
				<?php endwhile; wp_reset_query();?>
			</div><!-- .habitacion_listado -->
			<div class="habitacion_listado">
			<?php $recent = new WP_Query("page_id=108"); while($recent->have_posts()) : $recent->the_post();?>
				<a href="<?php echo get_page_link( $post->ID );?>"><h3><?php the_title();?></h3></a>
				<div class="imagen">
				<figure>
					<a href="<?php echo get_page_link( $post->ID );?>">
					<?php
						if ( has_post_thumbnail() ) {
						
							// Mostramos si es un Desktop y/o Smartphone						
							if( wpmd_is_nottab() ) {
								the_post_thumbnail('custom-thumb-600-450');
							} else { // Para tablets
								the_post_thumbnail('custom-thumb-1000-800');
							};
							
						} else {
							echo '<img src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" alt="'.__('Sin imagen', 'hotellosrobles').'" />';
						}
					?>
					</a>
					<figcaption>
						<?php the_content();?>
						<div><a href="<?php echo get_page_link( $post->ID );?>" class="boton_enviar ver_fotos"><?php _e('Ver fotos de la habitación', 'hotellosrobles');?></a></div>
					</figcaption>
				</figure>
				<div class="clearfix"></div>
				</div><!-- .imagen -->
				<?php endwhile; wp_reset_query();?>
			</div><!-- .habitacion_listado -->
			<div class="habitacion_listado">
			<?php $recent = new WP_Query("page_id=111"); while($recent->have_posts()) : $recent->the_post();?>
				<a href="<?php echo get_page_link( $post->ID );?>"><h3><?php the_title();?></h3></a>
				<div class="imagen">
				<figure>
					<a href="<?php echo get_page_link( $post->ID );?>">
						<?php
							if ( has_post_thumbnail() ) {
							
								// Mostramos si es un Desktop y/o Smartphone						
								if( wpmd_is_nottab() ) {
									the_post_thumbnail('custom-thumb-600-450');
								} else { // Para tablets
									the_post_thumbnail('custom-thumb-1000-800');
								};
								
							} else {
								echo '<img src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" alt="'.__('Sin imagen', 'hotellosrobles').'" />';
							}
						?>
					</a>
					<figcaption>
						<?php the_content();?>
						<div><a href="<?php echo get_page_link( $post->ID );?>" class="boton_enviar ver_fotos"><?php _e('Ver fotos de la habitación', 'hotellosrobles');?></a></div>
					</figcaption>
				</figure>
				<div class="clearfix"></div>
				</div><!-- .imagen -->
				<?php endwhile; wp_reset_query();?>
			</div><!-- .habitacion_listado -->
		</article>
	</section>
	</div><!-- #home_page -->
<?php get_footer();?>