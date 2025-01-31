<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo('charset');?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
<?php if (is_home()) {?>
	<title><?php bloginfo('name');?></title>
<?php } else { ?> 
	<title><?php the_title();?> | <?php bloginfo('name');?></title>
<?php };?>
	<meta name="description" content="<?php bloginfo('description');?>" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/css/style.min.css" />

<?php if (wp_is_mobile()==false) { ?>
	<!--[if IE 8]>
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/html5.js"></script>
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/selectivizr-min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/respond.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory');?>/css/style-IE8.css" />
	<![endif]-->
	<!--[if IE 9]>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory');?>/css/style-IE9.css" />
	<![endif]-->
<?php };?>

<?php if (wpmd_is_ios()) {//Favicones para iOS ?>
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php bloginfo('stylesheet_directory');?>/img/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo('stylesheet_directory');?>/img/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo('stylesheet_directory');?>/img/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php bloginfo('stylesheet_directory');?>/img/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php bloginfo('stylesheet_directory');?>/img/apple-touch-icon-60x60.png" />
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php bloginfo('stylesheet_directory');?>/img/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php bloginfo('stylesheet_directory');?>/img/apple-touch-icon-76x76.png" />
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php bloginfo('stylesheet_directory');?>/img/apple-touch-icon-152x152.png" />
<?php };?>
	<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory');?>/img/favicon-96x96.png" sizes="96x96" />
	<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory');?>/img/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory');?>/img/favicon-16x16.png" sizes="16x16" />
<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('stylesheet_directory');?>/img/favicon.ico" />
	<?php wp_head();?>
</head>
<body>
<?php // Comprobamos si estamos en la home, y de acuerdo con esto mostramos lo que hay acá dentro.
if (is_home()) {?>
<div id="contenedor">
	<div id="home_page">
		<header>
<?php };?> 
<?php if(!is_home()) { //Comprobamos si estamos o no en la home, y de acuerdo con esto mostramos o no lo que hay acá dentro. ?>
<div id="bg_top"></div>
<div id="contenedor" class="no_home">
	<div id="home_page" class="no_home">
		<header class="no_home">
<?php };?>
		<div id="logo_bg">
			<figure id="logo_header">
				<a href="<?php bloginfo('url');?>" title="<?php _e('Inicio', 'hotellosrobles');?> | <?php bloginfo('name');?>">
					<img src="<?php bloginfo('stylesheet_directory');?>/img/logo.png" alt="Logo Hotel Los Robles" />
				</a>
			</figure>			
			<div class="iconos" id="los_iconmoons">
				<ul><!-- iconos -->
					<li>
						<a id="icono-home" class="icon-home2" href="<?php bloginfo('url');?>">
						</a>
						<ul class="submenu">
							<li><?php _e('Inicio', 'hotellosrobles');?></li>
						</ul>
					</li>
					<li>
						<a id="icono-mail" class="icon-mail" href="<?php bloginfo('url');?>/tarifas#consulta_o_reserva"></a>
						<ul class="submenu">
							<li><?php _e('Contacto', 'hotellosrobles');?></li>
						</ul>
					</li>
					<li>
						<a id="icono-feed" class="icon-feed2" href="<?php bloginfo('rss2_url');?>" target="_blank"></a>
						<ul class="submenu">
							<li><?php _e('Sucríbete al Feed de Noticias', 'hotellosrobles');?></li>
						</ul>
					</li>
					<li>
						<a id="icono-clima" class="icon-snowy" href="<?php bloginfo('url');?>/el-clima-en-villa-cura-brochero/"></a>
						<ul class="submenu">
							<li><?php _e('Clima en Villa Cura Brochero', 'hotellosrobles');?></li>
						</ul>
					</li>
				</ul>
			</div><!-- #los_iconmoons -->
		</div><!-- #logo_bg -->
		<div id="boton_menu"><a href="#">Menú</a></div>
	<?php if (!is_home()) { ?>
		<nav id="header_nav" class="no_home">
	<?php } else { ?>
		<nav id="header_nav">
	<?php };?>
			<?php 
			$default=array(
				'container'=>false,
				'depth'=>2,
				'menu'=>'header_nav',
				'theme_location'=>'header_nav',
				'items_wrap'=>'<ul class="no_home navegacion--listado-cerrar">%3$s</ul>'
			);
		wp_nav_menu($default);?>
		</nav><!-- #header_nav -->
	</header><!-- #header -->
	<section id="home_section">