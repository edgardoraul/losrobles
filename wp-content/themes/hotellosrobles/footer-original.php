	<footer>
		<div id="footer_nav">
		<?php // El menú del footer
			$default=array(
				'container'=>false,
				'depth'=>2,
				'menu'=>'footer_nav',
				'theme_location'=>'footer_nav',
				'items_wrap'=>'<ul class="nav">%3$s</ul>'
			);
		wp_nav_menu($default);?>
		</div>
		<p>Av. Belgrano 854 - Villa Cura Brochero - CP 5891 - Traslasierra - Córdoba - Tel: 03544-470042.<br />E-mail: info@hotellosrobles.com.ar</p>
		<small id="copyright">&#169; <?php bloginfo('name');?>, <?=date('Y');?>. Todos los derechos reservados</small>
		<p><sub>Desarrollado por <a target="_blank" href="http://www.webmoderna.com.ar">WebModerna</a></sub></p>
		<div><a title="Ir Arriba" href="#" class="up" id="irarriba">^</a></div>
	</footer>
</div><!-- #contenedor -->
<script type="text/javascript" defer src="<?php bloginfo('template_directory');?>/js/scripts.js"></script>
<?php if(is_page( 'tarifas' )) { //Solo se cargará en la página del formulario ?>
	<script type="text/javascript" defer src="<?php bloginfo('stylesheet_directory');?>/js/datepicker-completo.js" ></script>
<?php };?>
<script type="text/javascript">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-45690804-1', 'hotellosrobles.com.ar');
  ga('send', 'pageview');
</script>
<?php wp_footer();?>
</body>
</html>