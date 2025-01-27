<?php get_header();?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); get_page($page_id); $page_data = get_page($page_id);?>
		<h1><?php the_title();?></h1>
		<article  class="calendario article_left">
			<figure>
				<?php 
				if(has_post_thumbnail())
				{
					the_post_thumbnail('custom-thumb-600-x');
				} else 
				{
					echo '<img src="'.get_stylesheet_directory_uri().'/img/sin_imagen2.png" alt="'.__('Sin imagen', 'hotellosrobles').'" />';
				}
				?>
			</figure>
			
			<?php /*Listado de imágenes*/ 
				$attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible', true));
				foreach ($attachID as $item)
				{
					$imagen = wp_get_attachment_image_src($item,'custom-thumb-600-x'); 
					$alt = get_post_meta($item, '_wp_attachment_image_alt', true);
					$descripcion = get_post_field('post_content', $item);
					if ($imagen!="") 
					{
						echo '<figure><img alt="'.$alt.'" src="'.$imagen[0].'" ';
						
						echo '/><figcaption>'.$alt.'</figcaption></figure>';
					
					}
				};?>
				<div class="clearfix"></div>
		</article>
		<article class="article_right">
			<div>
				<?php the_content();?>
			</div>
		</article>
		<?php endwhile; else: endif; ?>
	</section>
</div><!-- #home_page -->
<?php get_footer();?>