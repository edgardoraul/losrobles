<?php
/* contacto.php
* @package WordPress
* @subpackage hotellosrobles
* @since hotellosrobles 2.0
* Template Name: Tarifas - Contacto
*/ ?>
<?php get_header();?>
		<article class="article_left">
			<h1><?php the_title();?></h1>
        	
<?php //Este loop es para mostar el contenido de las subpáginas hijas...en este caso las temporadas.
$args = array(
    'post_type'      => 'page',
    'posts_per_page' => 1,
    'post_parent'    => $post->ID,
    /*'order'          => 'ASC',
    'orderby'        => 'menu_order'*/
 );

$parent = new WP_Query( $args );

if ( $parent->have_posts() ) : ?>

    <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
		<?php the_content(); ?>
    <?php endwhile; ?>
	<?php endif; wp_reset_query(); //Fin de este loop?>

		<?php // Loop normal para el resto del contenido de la página padre.
		 if (have_posts()) : while (have_posts()) : the_post(); get_page($page_id); $page_data = get_page($page_id);?>
		 <?php the_content();?>
		
		</article>
		<article id="consulta_o_reserva" class="article_right">
			<h2><?php _e('Reserva o Contacto', 'hotellosrobles');?></h2>
			<div><?php echo do_shortcode('[contact-form-7 id="ab206a1" title="Formulario de contacto"]');?>
			</div>
		</article>
		<?php endwhile; else: endif;?>
	</section>
</div><!-- #home_page -->
<?php get_footer();?>