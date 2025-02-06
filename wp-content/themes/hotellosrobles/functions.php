<?php
/* functions.php
* @package WordPress
* @subpackage hotellosrobles
* @since hotellosrobles 2.0
*/


// Detección de móviles.
require_once "includes/wp-mobile-detect.php";

// Cargar Panel de Opciones
if ( !function_exists( 'optionsframework_init' ) )
{
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/includes/' );
	require_once dirname( __FILE__ ) . '/includes/options-framework.php';
}

add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function()
{
	jQuery('#example_showhidden').click(function()
	{
		jQuery('#section-example_text_hidden').fadeToggle(400);
	});
	if (jQuery('#example_showhidden:checked').val() !== undefined)
	{
		jQuery('#section-example_text_hidden').show();
	}
});
</script>

<?php
}

// Sitemap en xml
// require_once "includes/sitemap.php";

 
// Deshabilitar Iconos Emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Remover la API REST
function remove_api ()
{
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );
}
add_action( 'after_setup_theme', 'remove_api' );

// Desactivar el script de embebidos
function my_deregister_scripts()
{
	wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );

// Remover cosas raras de Wordpress
remove_action( 'wp_head', 'wp_resource_hints', 2 );
remove_action( 'wp_head', 'dns-prefetch' );


// Agregar clases a los enlances de los posts next y back
function add_class_next_post_link($html)
{
	$html = str_replace('<a', '<a class="boton green"', $html);
	return $html;
}
add_filter('next_post_link', 'add_class_next_post_link', 10, 1);
function add_class_previous_post_link($html)
{
	$html = str_replace('<a', '<a class="boton red"', $html);
	return $html;
}
add_filter('previous_post_link', 'add_class_previous_post_link', 10, 1);


// Permitir comentarios encadenados
function enable_threaded_comments()
{
	if(is_singular() AND comments_open() AND (get_option('thread_comments')==1))
	{
		wp_enqueue_script('comment-reply');
	}
};
add_action('get_header','enable_threaded_comments');


// Remover clases automáticas del the_post_thumbnail
function the_post_thumbnail_remove_class($output)
{
	$output = preg_replace('/class=".*?"/', '', $output);
	return $output;
}
add_filter('post_thumbnail_html', 'the_post_thumbnail_remove_class');


//Remover atributos de ancho y alto de las imágenes insertadas
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to__ditor', 'remove_width_attribute', 10 );
function remove_width_attribute( $html )
{
	$html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
	return $html;
};


//Cambiar el logo del login y la url del mismo y el título
function custom_login_logo()
{
	echo '
	<style type="text/css">
		h1 a
		{
			background: url('.get_bloginfo('template_directory').'/img/logo_login.png) 100% no-repeat !important;
			width: 300px !important;
			margin-top: 0 !important;
			padding-top: 0 !important;
		}
		div#login
		{
			padding-top: 4em !important;
		}
	</style>';
};
add_action('login_head', 'custom_login_logo');
function the_url( $url )
{
	return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'the_url' );
function change_wp_login_title()
{
	return get_option('blogname');
};
add_filter('login_headertext', 'change_wp_login_title');


//Permitir svg en las imágenes para cargar.
function cc_mime_types($mimes)
{
	$mimes['svg']='image/svg+xml';return $mimes;
};
add_filter('upload_mimes','cc_mime_types');


// Deshabilitar la edición desde otros programas, el link corto y la versión del WP.
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link', 1);
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links__xtra', 3);
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');


//Remover clases e ids automáticos de los menúes
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var)
{
	return is_array($var) ? array_intersect($var, array('current-menu-item', 'current_page_item')) : '';
};



// Personalizar las palabras del excerpt; o sea de los pequeños resúmenes.
function custom__xcerpt_length($length)
{
	return 57;
};
add_filter('excerpt_length','custom__xcerpt_length');


//Remover versiones de los scripts y css innecesarios
function remove_script_version($src)
{
	$parts = explode('?', $src); return $parts[0];
};
add_filter('script_loader_src', 'remove_script_version', 15, 1);
//add_filter('style_loader_src', 'remove_script_version', 15, 1);


// Deshabilitar los enlaces automáticos en los comentarios
remove_filter('comment_text', 'make_clickable', 9);


//Cambio del avatar de WordPress por uno personalizado
function nuevoGravatar($avatar_defaults)
{
	$nuevo = get_bloginfo("stylesheet_directory").'/img/favicon-32x32.png';
	$avatar_defaults[$nuevo] = bloginfo('name');
	return $avatar_defaults;
}
add_filter('avatar_defaults', 'nuevoGravatar');


//Modifica el pie de página del panel de administarción
function remove_footer_admin()
{
	echo 'Desarrollado por <a title="...:: WebModerna | el futuro de la web ::..." href="http://www.webmoderna.com.ar" target="_blank"> <img title="WebModerna" src="'.get_bloginfo("stylesheet_directory").'/img/webmoderna.png" width="150" style="display:inline-block;vertical-align:middle;" /></a></p>';
};
add_filter('admin_footer_text','remove_footer_admin');


//Modificar los campos del perfil de usuario de WordPress
function extra_contact_info($contactmethods)
{
	unset($contactmethods['aim']);
	unset($contactmethods['yim']);
	unset($contactmethods['jabber']);
	$contactmethods['facebook']='Facebook';
	$contactmethods['twitter']='Twitter';
	$contactmethods['google_mas']='Google+';
	return $contactmethods;
};
add_filter('user_contactmethods','extra_contact_info');

// gets the value of the custom field featured_image and prints it.
if ( function_exists( 'get_custom_field_value' ) ) get_custom_field_value( 'featured_image', true );

//Remover versión del WordPress
function remove_wp_version() { return''; };
add_filter('the_generator','remove_wp_version');


//Añadir imágenes a los feeds rss
function rss_post_thumbnail($content)
{
	global $post;
	if(has_post_thumbnail($post->ID))
	{
		$content = '<p>'.get_the_post_thumbnail($post->ID).'</p>'.get_the_content();
	};
	return $content;
};
add_filter('the_excerpt_rss', 'rss_post_thumbnail');
add_filter('the_content_feed', 'rss_post_thumbnail');


//Eliminar el atributo rel="category tag".
function remove_category_list_rel($output)
{
	return str_replace(' rel="category tag"', '', $output);
};
add_filter('wp_list_categories', 'remove_category_list_rel');
add_filter('the_category', 'remove_category_list_rel');


//Eliminar css y scripts de comentarios cuando no hagan falta
function clean_header()
{
	wp_deregister_script('comment-reply');
};
add_action('init','clean_header');


// Cargar scripts para comentarios solo en single.php y page.php
function wd_single_scripts()
{
   if(is_singular() || is_page())
   {
	   wp_enqueue_script( 'comment-reply' ); // Carga el javascript necesario para los comentarios anidados
	}
}
add_action('wp_print_scripts', 'wd_single_scripts');


//Definir tamaños personalizados de miniaturas - hay que configurarlas
add_theme_support('post-thumbnails', array('post', 'page'));
add_image_size('custom-thumb-2048-1536', 2048, 1536, true);
add_image_size('custom-thumb-1600-1200', 1600, 1200, true);
add_image_size('custom-thumb-1600-x', 1600, false); //Completas para Desktops
add_image_size('custom-thumb-1000-800', 1000, 800, true);
add_image_size('custom-thumb-1000-x', 1000, false); //Completas para Tablets
add_image_size('custom-thumb-1060-795', 1060, 795, true);
add_image_size('custom-thumb-800-600', 800, 600, true);
add_image_size('custom-thumb-800-x', 800, false);
add_image_size('custom-thumb-600-450', 600, 450, true);
add_image_size('custom-thumb-600-x', 600, false); //Completas para smartphones
add_image_size('custom-thumb-400-300', 400, 300, true);
add_image_size('custom-thumb-300-225', 300, 225, true);
add_image_size('custom-thumb-100-100', 100, 100, true);


// Habilitar la compresión de imágenes
function optimizadorImagen()
{
	return 50;
}
add_filter( 'jpeg_quality', 'optimizadorImagen');

//Registrar las menúes de navegación
register_nav_menus (array(
	'header_nav'  => __('Menú Principal',  'hotellosrobles'),
	'footer_nav'  => __('Menú Secundario', 'hotellosrobles')
	)
);



//Habilitar botones de edición avanzados
function habilitar_mas_botones($buttons)
{
	$buttons[]='hr';
	$buttons[]='sub';
	$buttons[]='sup';
	$buttons[]='fontselect';
	$buttons[]='fontsizeselect';
	$buttons[]='cleanup';
	$buttons[]='styleselect';
	return $buttons;
};
add_filter("mce_buttons_3","habilitar_mas_botones");


// Agregar varias imágenes a las entradas y páginas
function add_custom_meta_box()
{
	add_meta_box(
	'custom_meta_box', // id
	'<strong>Subir las fotos del producto desde aquí</strong>', // título
	'show_custom_meta_box', // función a la que llamamos
	'page', // sólo para páginas
	'normal', // contexto
	'high'); // prioridad
};
add_action('add_meta_boxes', 'add_custom_meta_box');

// Para imágenes cargamos el script sólo si estamos en páginas.
function add_admin_scripts ($hook)
{
	global $post;
	if ( $hook == 'post-new.php' || $hook == 'post.php' )
	{
		wp_enqueue_script('custom-js', get_stylesheet_directory_uri().'/js/custom-js.js');
	}
};
add_action( 'admin_enqueue_scripts', 'add_admin_scripts', 10, 1 );

//Nombre del campo personalizado.
$prefix = 'custom_';
$custom_meta_fields = array( // Dentro de este array podemos incluir más tipos
	 array(
	   'label'  => 'Fotos',
	   'desc'   => '<strong>IMPORTANTE!!: </strong>Las imágenes deben ser mínimo de <strong><i style="color:red;">2048px (ancho)</i></strong> ya que hay que optimizar para Tablets y Móviles, es muy importante cargar imágenes al doble del tamaño en el cual van a aparecer en la página web (A las imágenes más chicas o de diferentes tamaños, el sistema las cortará autmáticamente). Tiene que ser de esta forma para que se pueda optimizar y ver correctamente en los dispositivos con tecnología Retina Display. Estos aparatos lo que hacen es cuadriplicar la densidad en píxeles; por lo tanto una foto común ser vería en esos dispositivos en la mitad de su tamaño real (en el mejor de los casos); o si no, horriblemente pixelada (lo más común).
	  ',
	   'id'     => $prefix.'imagenrepetible',
	   'type'   => 'imagenrepetible' ));

// Función show custom metabox. Es larguísimaaaa!!!
function show_custom_meta_box()
{
	global $custom_meta_fields, $post;
	// Usamos nonce para verificación


	wp_nonce_field( basename( __FILE__ ), 'custom_meta_box_nonce' );
	// Creamos la tabla de campos personalizados y empezamos un loop con todos ellos

	echo '<table class="form-table">';

	foreach ($custom_meta_fields as $field)
	{
		// Hacemos un loop con todos los campos personalizados
		// obtenemos el valor del campo personalizado si existe para este $post->ID
		$meta = get_post_meta($post->ID, $field['id'], true);

		// comenzamos una fila de la tabla
		echo '<tr>
				<th>
					<label for="'.$field['id'].'">'.$field['label'].'</label>
				</th>
				<td>';
		switch($field['type'])
		{
			// Si tenemos varios tipos de campos aquí se seleccionan
			// En nuestro caso tenemos solo uno: Imagen repetible
			case 'imagenrepetible': // Lo que pone en "type" más arriba

			$image = get_stylesheet_directory_uri().'/img/gravatar.png'; // Ponemos una imagen por defecto

			echo '<i class="custom_default_image" style="display:none">'.$image.'</i>'; // Al principio no la mostramos

			echo '<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';

			$i = 0;

			if ($meta)
			{
				// Si get_post_meta nos ha dado valores, hacemos un foreach
				foreach($meta as $row)
				{
					// Obtenemos la imagen en su tamaño máximo. Podéis poner en su lugar thumbnail, medium o large
					$image = wp_get_attachment_image_src($row, 'custom-thumb-300-225');
					// la primera parte de wp_get_attachment_image_src nos da su url.
					$image = $image[0]; ?>
					<li>
						<!-- Añadimos la imagen que se arrastra para cambiar posición, dentro de tu tema -->
						<i title="Arrastrar y soltar. Mover arriba o abajo." class="sort hndle dashicons-before dashicons-image-flip-vertical" style="float:left;">&nbsp;&nbsp;&nbsp;</i>

						<!-- El input con el valor del meta. Su attributo "name" tiene un número que se irá incrementando a medida que creamos nuevos campos -->
						<input name="<?php echo $field['id'] . '['.$i.']'; ?>" id="<?php echo $field['id']; ?>" type="hidden" class="custom_upload_image" value="<?php echo $row; ?>" />

						<!-- mostramos la imagen con 200px de ancho para ver lo que hemos subido -->
						<img src="<?php echo $image; ?>" class="custom_preview_image" alt="" width="200"/><br />

						<!-- El botón de Seleccionar Imagen -->
						<input class="custom_upload_image_button button" type="button" value="Seleccionar imagen" />&nbsp;&nbsp;&nbsp;

						<!-- Los botones de eliminar imagen y de quitar fila-->
						<small>
							<a href="#" class="custom_clear_image_button"><?php _e('Eliminar imagen', 'hotellosrobles');?></a>
						</small>
						&nbsp;&nbsp;&nbsp;
						<a class="repeatable-remove button" href="#"><?php _e('Quitar fila', 'hotellosrobles');?></a>
					</li>
					<?php $i++; // Incrementamos el contador para que no se repita el atributo "name"
				} // Fin del foreach
			}
			else
			{ // Si no hay datos ?>

			<li>
				<i title="Arrastrar y soltar. Mover arriba o abajo." class="sort hndle dashicons-before dashicons-image-flip-vertical" style="float:left;">&nbsp;&nbsp;&nbsp;</i>
				<input name="<?php echo $field['id'] . '['.$i.']'; ?>" id="<?php echo $field['id']; ?>" type="hidden" class="custom_upload_image" value="<?php echo $row; ?>" />
				<img src="<?php echo $image; ?>" class="custom_preview_image" alt="" width="200" />
				<br />
				<input class="custom_upload_image_button button" type="button" value="<?php _e('Seleccionar imagen', 'hotellosrobles');?>" />
				<small>
					<a href="#" class="custom_clear_image_button"><?php _e('Eliminar imagen', 'hotellosrobles');?></a>
				</small>
				&nbsp;&nbsp;&nbsp;
				<a class="repeatable-remove button" href="#"><?php _e('Quitar fila', 'hotellosrobles');?></a>
			</li>
	<?php } ?>
		</ul>
		<br />

		<!-- Botón para añadir una nueva fila -->
		<a class="repeatable-add button-primary" href="#">+ Agregar Imagen</a>

		<!-- Aquí va la descripción -->
		<br clear="all" />
		<br />

		<p class="description"><?php echo $field['desc']; ?></p>
		<?php break;
		} // fin del switch
		echo '</td></tr>';
	} // fin del foreach
	echo '</table>'; // fin de la tabla
}; // Fin de la función

// Grabar los datos de las imágenes subidas.
function save_custom_meta($post_id)
{
	global $custom_meta_fields;
	// verificamos usando nonce

	if (!isset($_POST['custom_meta_box_nonce']) || !wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
	return $post_id;

	// comprobamos si se ha realizado una grabación automática, para no tenerla en cuenta
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
	return $post_id;

	// comprobamos que el usuario puede editar
	if ('page' == $_POST['post_type'])
	{
		if (!current_user_can('edit_page', $post_id))
		return $post_id;
	}
	elseif (!current_user_can('edit_post', $post_id))
	{
		return $post_id;
	}

	// hacemos un loop por todos los campos y guardamos los datos
	foreach ($custom_meta_fields as $field)
	{
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if ($new && $new != $old)
		{
			update_post_meta($post_id, $field['id'], $new);
		}
		elseif ('' == $new && $old)
		{
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
	// final del foreach
};
add_action('save_post', 'save_custom_meta');


// Paginación avanzada
function pagination($pages = '', $range = 4)
{
	$pagina_palabra = __('Página', 'hotellosrobles');
	$de_palabra = __('de', 'hotellosrobles');
	$showitems = ($range * 2)+1;
	global $paged;
	if(empty($paged)) $paged = 1;
	if($pages == '')
	{
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages) {
			$pages = 1;
		}
	}
	if(1 != $pages)
	{
		echo "<div class='pagination'><span>".$pagina_palabra." ".$paged." ".$de_palabra." ".$pages."</span>";
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
		if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
		for ($i=1; $i <= $pages; $i++)
		{
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			{
				echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive'>".$i."</a>";
			}
		}
		if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";
		if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
		 echo "</div>\n";
	}
};


//Para hacer posible que esta plantilla pueda cambiar de idioma
load_theme_textdomain('hotellosrobles', TEMPLATEPATH.'/languages');
$locale=get_locale();$locale_file=TEMPLATEPATH."/languages/$locale.php";
if(is_readable($locale_file)) require_once($locale_file);


//Detén las adivinanzas de URLs de WordPress
add_filter('redirect_canonical', 'stop_guessing');
function stop_guessing($url)
{
	if( is_404() )
	{
		return false;
	}
	return $url;
}


//Ocultar los errores en la pantalla de Inicio de sesión de WordPress
function no_errors_please()
{
	return '¡Sal de mi jardín! ¡AHORA MISMO!';
};
add_filter('login_errors','no_errors_please');


// Removiendo el panel de bienvenida del wordpress
remove_action('welcome_panel', 'wp_welcome_panel');

//Relativas las urls
// add_action( 'template_redirect', 'relative_url' );
function relative_url()
{
	// Don't do anything if:
	// - In feed
	// - In sitemap by WordPress SEO plugin
	if ( is_feed() || get_query_var( 'sitemap' ) )
	return;
	$filters = array(
	'post_link',       // Normal post link
	'post_type_link',  // Custom post type link
	'page_link',       // Page link
	'attachment_link', // Attachment link
	'get_shortlink',   // Shortlink
	'post_type_archive_link',    // Post type archive link
	'get_pagenum_link',          // Paginated link
	'get_comments_pagenum_link', // Paginated comment link
	'term_link',   // Term link, including category, tag
	'search_link', // Search link
	'day_link',   // Date archive link
	'month_link',
	'year_link',

	// site location
	// 'option_home',
	// 'admin_url',
	// 'home_url',
	// 'site_url',
	// 'site_option_siteurl',
	'network_home_url',
	'network_site_url',

	// debug only filters
	'get_the_author_url',
	'get_comment_link',
	'wp_get_attachment_image_src',
	'wp_get_attachment_thumb_url',
	'wp_get_attachment_url',
	'wp_login_url',
	'wp_logout_url',
	'wp_lostpassword_url',
	'get_stylesheet_uri',
	'get_stylesheet_directory_uri',//
	'plugins_url',//
	'plugin_dir_url',//
	'stylesheet_directory_uri',//
	'get_template_directory_uri',//
	'template_directory_uri',//
	'get_locale_stylesheet_uri',
	'script_loader_src', // plugin scripts url
	'style_loader_src', // plugin styles url
	'get_theme_root_uri',
	);

	foreach ( $filters as $filter )
	{
		add_filter( $filter, 'wp_make_link_relative' );
	}
	home_url($path = '', $scheme = null);
};



// Mapa de Sitio
add_action("publish_post", "eg_create_sitemap");
add_action("publish_page", "eg_create_sitemap");

function eg_create_sitemap()
{
	$postsForSitemap = get_posts(array(
	'numberposts'		=>	-1,
	'orderby'			=>	'modified',
	'post_type'			=>	array('post','page'),
	'order'				=>	'DESC'
	));
	$sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
	$sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	foreach($postsForSitemap as $post)
	{
		setup_postdata($post);
		$postdate = explode(" ", $post->post_modified);
		$sitemap .= '<url>'.
		'<loc>'. get_permalink($post->ID) .'</loc>'.
		'<lastmod>'. $postdate[0] .'</lastmod>'.
		'<changefreq>monthly</changefreq>'.
		'</url>';
	}
	$sitemap .= '</urlset>';
	$fp = fopen(ABSPATH . "sitemap.xml", 'w');
	fwrite($fp, $sitemap);
	fclose($fp);
};

// Función para Minificar el HTML
class WP_HTML_Compression
{
	protected $compress_css = true;
	protected $compress_js = true;
	protected $info_comment = true;
	protected $remove_comments = true;
	protected $html;
	public function __construct($html)
	{
		if (!empty($html))
		{
			$this->parseHTML($html);
		}
	}
	public function __toString()
	{
		return $this->html;
	}
	protected function bottomComment($raw, $compressed)
	{
		$raw = strlen($raw);
		$compressed = strlen($compressed);
		$savings = ($raw-$compressed) / $raw * 100;
		$savings = round($savings, 2);
		return '<!-- HTML Minify | Se ha reducido el tamaño de la web un '.$savings.'% | De '.$raw.' Bytes a '.$compressed.' Bytes -->';
	}
	protected function minifyHTML($html)
	{
		$pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
		preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
		$overriding = false;
		$raw_tag = false;
		$html = '';
		foreach ($matches as $token)
		{
			$tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
			$content = $token[0];
			if (is_null($tag))
			{
				if ( !empty($token['script']) )
				{
					$strip = $this->compress_js;
				}
				else if ( !empty($token['style']) )
				{
					$strip = $this->compress_css;
				}
				else if ($content == '<!--wp-html-compression no compression-->')
				{
					$overriding = !$overriding;
					continue;
				}
				else if ($this->remove_comments)
				{
					if (!$overriding && $raw_tag != 'textarea')
					{
						$content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
					}
				}
			}
			else
			{
				if ($tag == 'pre' || $tag == 'textarea')
				{
					$raw_tag = $tag;
				}
				else if ($tag == '/pre' || $tag == '/textarea')
				{
					$raw_tag = false;
				}
				else
				{
					if ($raw_tag || $overriding)
					{
						$strip = false;
					}
					else
					{
						$strip = true;
						$content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
						$content = str_replace(' />', '/>', $content);
					}
				}
			}
			if ($strip)
			{
				$content = $this->removeWhiteSpace($content);
			}
			$html .= $content;
		}
		return $html;
	}
	public function parseHTML($html)
	{
		$this->html = $this->minifyHTML($html);
		if ($this->info_comment)
		{
			$this->html .= "\n" . $this->bottomComment($html, $this->html);
		}
	}
	protected function removeWhiteSpace($str)
	{
		$str = str_replace("\t", ' ', $str);
		$str = str_replace("\n",  '', $str);
		$str = str_replace("\r",  '', $str);
		while (stristr($str, '  '))
		{
			$str = str_replace('  ', ' ', $str);
		}
		return $str;
	}
}
function wp_html_compression_finish($html)
{
	return new WP_HTML_Compression($html);
}
function wp_html_compression_start()
{
	ob_start('wp_html_compression_finish');
}
// add_action('get_header', 'wp_html_compression_start');


//  DISABLE GUTENBERG STYLE IN HEADER| WordPress 5.9
function wps_deregister_styles() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'wc-block-style' ); // REMOVE WOOCOMMERCE BLOCK CSS
	wp_dequeue_style( 'global-styles' ); // REMOVE THEME.JSON
}
add_action( 'wp_enqueue_scripts', 'wps_deregister_styles', 100 );

// Mostrar un favicón personalizado en el panel de administración
function faviconAdmin()
{
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="' . get_stylesheet_directory_uri() . '/favicon.ico" />';
}
add_action( 'admin_head', 'faviconAdmin' );


function desactivar_scripts_raros() {
	wp_deregister_script( 'wp-i18n' );
}
add_action( "desactivar_scripts_raros", "wp_enqueue_scripts", 100 );