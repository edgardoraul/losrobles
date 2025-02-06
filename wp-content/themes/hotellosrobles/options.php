<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
function optionsframework_option_name()
{

	// Nombre de la plantilla
	$themename = wp_get_theme();
	$themename = preg_replace("/W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'hotellosrobles'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */


function optionsframework_options()
{
	//Pestaña Configuración general
	$options[]	=	array(
	'name'	=>	__('Configuración General', 'options_framework_theme'),
	'type'	=>	'heading');


	// Meta: keywords
	$options[]	=	array(
		'name'			=>	__('Meta: Palabras claves', 'options_framework_theme'),
		'desc'			=>	__('Introducir palabras (separadas por comas) claves de la web que son útiles para algunos buscadores. Muy importantes para SEO. Máximo 160 caracteres.', 'options_framework_theme'),
		'id'			=>	'meta_keywords2',
		'placeholder'	=>	'palabra1, palabra2, palabra3...',
		'class'			=>	'',
		'type'			=>	'text',
	);

	// Meta: Descripción
	$options[]	=	array(
		'name'			=>	__('Meta: Descripción de la web', 'options_framework_theme'),
		'desc'			=>	__('Introducir una descripción breve acerca de lo que trata esta web. Muy importante para el SEO. Máximo 160 caracteres.', 'options_framework_theme'),
		'id'			=>	'meta_description',
		'placeholder'	=>	'Este sitio web está dedicado a la ...',
		'class'			=>	'',
		'type'			=>	'textarea',
	);

	// Google Analitics
	$options[]	=	array(
		'name'			=>	__('Google Analitycs', 'options_framework_theme'),
		'desc'			=>	__('Introduzca el script de Google Analitycs.', 'options_framework_theme'),
		'id'			=>	'google_analitycs',
		'placeholder'	=>	'var _gaq = _gaq || []; _gaq.push(["_setAccount", "UA-40089469-1"]); _gaq.push(["_trackPageview"]); etc...',
		'class'			=>	'',
		'type'			=>	'textarea'
	);


	/* =================== Pestaña información de contacto ============================== */
	$options[]	=	array(
	'name'	=>	__('Redes Sociales', 'options_framework_theme'),
	'type'	=>	'heading' );

	// Facebook
	$options[] = array(
		'name'			=>	__('Facebook', 'options_framework_theme'),
		'desc'			=>	__('Introduzca el enlace a Facebook.', 'options_framework_theme'),
		'id'			=>	'facebook_contact',
		'class'			=>	'',
		'placeholder'	=>	'www.facebook.com/usuario',
		'type'			=>	'text'
	);


	// Twitter
	$options[] = array(
		'name' => __('Twitter', 'options_framework_theme'),
		'desc' => __('Introduzca su enlace a Twitter.', 'options_framework_theme'),
		'id' => 'twitter_contact',
		'placeholder' => 'www.twitter.com/usuario',
		'class' => '',
		'type' => 'text'
	);

	// Skype
	$options[] = array(
		'name' => __('Skype', 'options_framework_theme'),
		'desc' => __('Introduzca su usuario de Skype o email de Outlook.com, Msn, Hotmail (Deben estar habilitados para hacer videoconferencia).', 'options_framework_theme'),
		'id' => 'skype_contact',
		'placeholder' => '"fulano_de_tal" o también "fulano_de_tal@outlook.com"',
		'class' => '',
		'type' => 'text'
	);

	// LinkedIn
	$options[] = array(
		'name' => __('LinkedIn', 'options_framework_theme'),
		'desc' => __('Introduzca su enlace al perfil de LinkedIn.', 'options_framework_theme'),
		'id' => 'linkedin_contact',
		'placeholder' => 'www.linkedin.com/usuario',
		'class' => '',
		'type' => 'text'
	);

	// Google+
	$options[] = array(
		'name' => __('Google+', 'options_framework_theme'),
		'desc' => __('Introduzca su enlace a Google+.', 'options_framework_theme'),
		'id' => 'google_plus_contact',
		'placeholder' => 'plus.google.com/usuario',
		'class' => '',
		'type' => 'text'
	);

	// GitHub
	$options[] = array(
		'name' => __('GitHub', 'options_framework_theme'),
		'desc' => __('Introduzca su enlace a GitHub.', 'options_framework_theme'),
		'id' => 'github_contact',
		'placeholder' => 'github.com/usuario',
		'class' => '',
		'type' => 'text'
	);



	$facebook_contact = of_get_option('facebook_contact','');
	$twitter_contact = of_get_option('twitter_contact','');
	$linkedin_contact = of_get_option('linkedin_contact', '');
	$google_plus_contact = of_get_option('google_plus_contact','');
	$email_contact = of_get_option('email_contact','');
	$email_contact_ventas = of_get_option('email_contact_ventas','');
	$background_de_la_web = of_get_option('background_de_la_web','');

	/* Panel de la home page =========================================================*/
	$options[] = array(
	'name' => __('Datos de Contacto', 'options_framework_theme'),
	'type' => 'heading');

	// Email de contacto
	$options[] = array(
		'name' => __('E-mail de contacto', 'options_framework_theme'),
		'desc' => __('Introduzca el Email de contacto, se mostrará al pie del sitio web en un ícono.', 'options_framework_theme'),
		'id' => 'email_contact',
		'placeholder' => 'tu-mail@lo-que-sea.com.ar',
		'class' => '',
		'type' => 'text'
	);


	// Teléfono Fijo
	$options[] = array(
		'name' => __('Teléfono Fijo', 'options_framework_theme'),
		'desc' => __('Introduzca su teléfono fijo incluyendo el código de área.', 'options_framework_theme'),
		'id' => 'telefono_fijo',
		'placeholder' => '0351-4882213',
		'class' => 'mini',
		'type' => 'text'
	);

	// Teléfono Celular
	$options[] = array(
		'name' => __('Teléfono Celular', 'options_framework_theme'),
		'desc' => __('Introduzca su teléfono celular incluyendo el código de área.', 'options_framework_theme'),
		'id' => 'telefono_celular',
		'placeholder' => '0351-15882213',
		'class' => 'mini',
		'type' => 'text'
	);

	// Campo de texto
	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 7,
		'tinymce' => array( 'plugins' => 'wordpress, wplink' ),
	);

	// Dirección
	$options[] = array(
		'name' => __('Dirección', 'options_framework_theme'),
		'desc' => __('Introduzca calle, número, ciudad y provincia.', 'options_framework_theme'),
		'id' => 'direccion_web',
		'placeholder' => __('Man Sartín 453, Dpto. 3, Las Catitas, Tierra del Agua.', 'hotellosrobles'),
		'class' => '',
		'type' => 'textarea',
		// 'settings' => $wp_editor_settings,
	);

	return $options;
}
