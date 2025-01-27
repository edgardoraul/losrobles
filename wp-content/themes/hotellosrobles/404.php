<?php get_header();?>
		<article class="habitaciones">
			<h1><?php _e('Error 404. No encontramos lo que estás buscando.', 'hotellosrobles');?></h1>
			<div class="entrada-individual">
				<div class="imagen">
					<figure>
						<a href="<?php bloginfo('url');?>" title="<?php _e('Inicio', 'hotellosrobles');?> | <?php bloginfo('name');?>">
							<img src="<?php echo get_stylesheet_directory_uri();?>/img/favicon 200.png" alt="Logo Hotel Los Robles" />
						</a>
						<figcaption>
							<?php _e('Has hecho una consutla que realmente no entendemos; o tal vez quisiste entrar a una sección que no existe o nunca tuvimos.', 'hotellosrobles');?>
						</figcaption>
					</figure>
				</div>
			</div>
		</article>
	</section>
</div><!-- #home_page -->
<?php get_footer();?>