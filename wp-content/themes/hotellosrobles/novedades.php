<?php
/* novedades.php
* @package WordPress
* @subpackage hotellosrobles
* @since hotellosrobles 2.0
* Template Name: Novedades
*/ ?>
<?php get_header() ;?>
		<article class="habitaciones blog">
			<h1><?php the_title();?></h1>
			<div id="calendario">
				<ul>
					<?php $args = array(
					'child_of'		=> 12,
					'title_li'		=> ''
					);
					wp_list_pages( $args );?>
				</ul>
			</div>
			<?php query_posts('cat=3,2'); while (have_posts()) : the_post() ?>
			<div class="habitacion_listado">
				<a href="<?php the_permalink();?>"><h3><?php the_title();?></h3></a>
				<div class="imagen">
				<figure>
					<a href="<?php the_permalink();?>">
					<?php if(wpmd_is_notdevice()) {//Desktops
						if (has_post_thumbnail()){the_post_thumbnail('custom-thumb-800-x');
							} else {
								echo '<img alt="'.__('Sin imagen', 'hotellosrobles').'" src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" />';
							}
						}
					;?>
					<?php if(wpmd_is_tablet()) {//Tablets
						if (has_post_thumbnail()){the_post_thumbnail('custom-thumb-1000-x');
							} else {
								echo '<img alt="'.__('Sin imagen', 'hotellosrobles').'" src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" />';
							}
						}
					;?>
					<?php if(wpmd_is_phone()) {//Smartphones
						if (has_post_thumbnail()){the_post_thumbnail('custom-thumb-600-x');
							} else {
								echo '<img alt="'.__('Sin imagen', 'hotellosrobles').'" src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" />';
							}
						}
					;?>	
					</a>
					<figcaption>
						<time datetime="<?php the_time('j-m-Y');?>" pubdate><?php _e('Publicado el: ', 'hotellosrobles');?><?php the_time('j-m-Y') ?></time>
						<div class="texto">
							<?php the_excerpt();?>
						</div>
						<div><a href="<?php the_permalink();?>" class="boton_enviar vermas" title="Ver más..."><?php _e('Ver más...', 'hotellosrobles');?></a></div>
					</figcaption>
				</figure>
				</div><!-- .imagen -->
				<div class="clearfix"></div>
			</div><!-- .habitacion_listado -->
			<?php endwhile;?>
		</article>
		<div id="pagination"><?php if (function_exists("pagination")) {pagination();};?></div>
	</section>
	</div><!-- #home_page -->
<?php get_footer();?>