<?php get_header();?>
		<article class="habitaciones blog">
			<h1><?php the_title();?></h1>
			<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
			<div class="habitacion_listado">
				<a href="<?php the_permalink();?>">
					<h3><?php the_title();?></h3>
				</a>
				<div class="imagen">
				<figure>
					<a href="<?php the_permalink();?>">
						<?php //La miniatura que se consulta
						if (has_post_thumbnail()){the_post_thumbnail('custom-thumb-1600-1200');};
						?>
					</a>
					<figcaption>
						<time datetime="<?php the_time('j-m-Y');?>" pubdate>Publicado el: <?php the_time('j-m-Y') ?></time>
						<div class="texto">
							<?php the_excerpt();?>
						</div>
						<div><a href="<?php the_permalink();?>" class="boton_enviar"><?php _e('Ver más...', 'hotellorobles');?></a></div>
					</figcaption>
				</figure>
				</div><!-- .imagen -->
				<div class="clearfix"></div>
			</div><!-- .habitacion_listado -->
			<?php //La paginación 
			if (function_exists("pagination")) {pagination();};?>
			<?php endwhile; else: ?>
				<p><?php _e('No hay entradas publicadas en esta sección.', 'hotellorobles'); ?></p>
			<?php endif; ?>
		</article>
	</section>
	</div><!-- #home_page -->
<?php get_footer();?>