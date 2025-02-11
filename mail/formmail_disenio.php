<?php
include_once("Funciones/FuncionesPanel.php");
function br($texto, $max)
{      
     if(strlen($texto) > $max) 
//si el texto tiene mas de los caracteres que le indicamos con la variable $max
       { 
         $texto = wordwrap($texto,$max,"<br>",1);
//nos lo corta a la cantidad de caracteres indicado
       }
        else $texto=$texto;
// si no llega a los caracteres incicado, pues lo deja tal cual
        return $texto;      
} 
if(isset($_POST["enviado"]) && $_POST["email"]<>""){

$fecha_llegada=$_POST["anoLL"]."-".$_POST["mesLL"]."-".$_POST["diaLL"];
$fecha_partida=$_POST["anoP"]."-".$_POST["mesP"]."-".$_POST["diaP"];



$asunto = "Consultas Hotel Los Robles"; 
  $cuerpo = '
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hotel los Robles</title>
<link href="http://www.hotellosrobles.com.ar/favicon.ico" rel="shortcut icon" type="image/x-icon">
<style type="text/css">
/* Etiquetas y selectores */
a {color:#F60; font-size:16px; font-weight:bold;}
a:active {color:#F60; text-decoration:none;}
a:hover {color:#F60; text-decoration:underline;}
a:link {text-decoration:none;}
a:visited {color:#F60; text-decoration:none;}
body {margin:0px; padding:0px; background-color:#ADA567;}
body, table, tr, td, caption, th {font-family:Tahoma, Geneva, sans-serif; font-size:16px;color:#000;}
table, .tablablanca {border-collapse:collapse; background-color:white; cellpadding:0px; cellspacing:0px;}
h1, h2, h3, h4, h5, h6, table, tr, td {font-family:"Trebuchet MS", Arial, Helvetica, sans-serif; font-style:normal; font-weight:lighter;}
h1{font-size:19px;}
h2{font-size:17px;}
h3{font-size:15px;}
p{text-align:justify;}
/* Clases para formato de tablas y párrafos */
.advertencia {color:#666; text-align:center; margin-top:1em;}
.bottom {vertical-align:bottom;}
.centrador {text-align:center; vertical-align:middle;}
.destacado {color:#E47F39; text-transform:uppercase;}
.font-h3 {font-size:15px;}
.fondo-titular {background-color:red;}
.margin-right2em {margin-right:1em;}
.parrafo-comun {padding:2em; text-align:justify;}
.titular-blanco {color:#fff;}
.titular-derecha {text-align:right;}
.titular-izquierda {text-align:left;}
</style>
</head>
<body>
<table align="center" width="800" border="0" cellpadding="0" cellspacing="0">
   <tr>
    <td colspan="3" width="800" height="180">
      <img src="http://www.hotellosrobles.com.ar/mail/header2.jpg" alt="Hotel los Robles" width="800" height="180" border="0" usemap="#Hotel" longdesc="Hotel los Robles">
    </td>
  </tr>
  <tr>
    <td width="23px" background="http://www.hotellosrobles.com.ar/mail/lateralizquierdo.jpg">
    </td>
    <td width="754px" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
    
    <!--Acá van la tabla con los contenidos y las fotos del mail-->
    <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse" align="center">
      <tr>
        <td class="parrafo-comun" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
        <p class="destacado centrador">Se ha recibido la siguiente consulta:</p>
        <hr align="center" width="90%">';
		$cuerpo.='<br>';
		$cuerpo.='<strong>Tipo de Consulta:</strong>';
		$cuerpo.=' ';
		$cuerpo.=$_POST["Requerimiento"];
		$cuerpo.='<br>';
		$cuerpo.='<strong>Apellido y Nombre:</strong>';
		$cuerpo.=' ';
		$cuerpo.=$_POST["Nombre"];
		$cuerpo.='<br>';
		$cuerpo.='<strong>Ciudad:</strong>';
		$cuerpo.=' ';
		$cuerpo.=$_POST["ciudad"];
		$cuerpo.='<br>';
		$cuerpo.='<strong>Pa&iacute;s:</strong>';
		$cuerpo.=' ';
		$cuerpo.=$_POST["pais"];
		$cuerpo.='<br>';
		$cuerpo.='<strong>Tel&eacute;fono:</strong>';
		$cuerpo.=' ';
		$cuerpo.=$_POST["telefono"];
		$cuerpo.='<br>';
		$cuerpo.='<strong>Email:</strong>';
		$cuerpo.=' ';
		$cuerpo.=$_POST["email"];
		$cuerpo.='<br>';
		$cuerpo.='<strong>Tipo de Habitaci&oacute;n:</strong>';
		$cuerpo.=' ';
		$cuerpo.='Habitaci&oacute;n '.$_POST["tipoHabitacion"];
		$cuerpo.=' ';
		$cuerpo.='<br>';
		$cuerpo.='<strong><u>Cantidad de Personas</u>:</strong>';
		$cuerpo.=' ';
		$cuerpo.='<br>';
		$cuerpo.='<strong>Adultos:</strong>';
		$cuerpo.=' ';
		$cuerpo.=$_POST["CantidadA"];
		$cuerpo.='<br>';
		$cuerpo.='<strong>Ni&ntilde;os:</strong>';
		$cuerpo.=' ';
		$cuerpo.=$_POST["CantidadN"];
		$cuerpo.='<br>';
		$cuerpo.='<strong>Beb&eacute;s:</strong>';
		$cuerpo.=' ';
		$cuerpo.=$_POST["CantidadB"];
		$cuerpo.='<br>';
		$cuerpo.='<strong>Fecha de Llegada:</strong>';
		$cuerpo.=' ';
		$cuerpo.=date("d-m-Y",(strtotime($fecha_llegada)));
		$cuerpo.='<br>';
		$cuerpo.='<strong>Fecha de Partida:</strong>';
		$cuerpo.=' ';
		$cuerpo.=date("d-m-Y",(strtotime($fecha_partida)));
		$cuerpo.='<br>';
		$cuerpo.='<strong>Mensaje:</strong>';
		$cuerpo.=' ';
		$cuerpo.=br($_POST["Mensaje"],70);
    $cuerpo.='
	  </td>
      </tr>
      
    </table>
    </td>
    <td width="23" background="http://www.hotellosrobles.com.ar/mail/lateralderecho.jpg"></td>
  </tr>
  <tr>
    <td width="800" height="180" colspan="3"><img src="http://www.hotellosrobles.com.ar/mail/footer2.jpg" alt="Hotel los Robles" width="800" height="180" border="0" usemap="#HotellosRobles" longdesc="Hotel los Robles"></td>
  </tr>
</table>
<map name="HotellosRobles">
  <area shape="rect" coords="132,78,365,108" href="http://www.hotellosrobles.com.ar" target="_self" alt="Hotel los Robles">
  <area shape="rect" coords="274,119,641,150" href="http://www.webmoderna.com.ar" target="_self" alt="...:: WebModerna | el futuro de la web ::...">
</map>
<map name="Hotel">
  <area shape="rect" coords="22,57,316,154" href="http://www.hotellosrobles.com.ar" target="_blank" alt="Hotel los Robles">
</map>
</body>
</html>
'; 

//para el envío en formato HTML 
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=utf-8"; 

//dirección del remitente 
$headers .= "From: Consultas\r\n"; 
	
$email2="djedgardroul@hotmail.com"; //acá iba info@hotellosrobles.com.ar

$t=mail($email2,$asunto,$cuerpo,$headers);

}else{

header("Location: tarifas.php?email='no'");

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hotel Los Robles:::::</title>
<link rel="stylesheet" type="text/css" href="gallery/styleold.css" />
<link href="http://www.hotellosrobles.com.ar/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>
<body>
<div id="top_menu">
					 
                <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','855','height','28','src','flash/menu2B','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','transparent','movie','flash/menu2B' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase=					"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="855" height="28" >
                                            <param name="movie" value="flash/menu2B.swf" />
                                            <param name="quality" value="high" />
                                            <param name="wmode" value="transparent" />
                                           <embed src="flash/menu2B.swf" width="855" height="28" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="transparent"></embed>
  </object></noscript>
                      
                 
</div>
<div id="main_content">
	<div id="top_banner">
	  <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','851','height','100','src','flash/logo2','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','movie','flash/logo2' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="851" height="100">
        <param name="movie" value="flash/logo2.swf" />
        <param name="quality" value="high" />
        <embed src="flash/logo2.swf" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="851" height="100"></embed>
      </object>
	</noscript></div>
    
    <div id="page_content_left_tarifas">
      <div class="title">
        <p><strong>Gracias por contactarnos</strong></p>
        <p>&nbsp;</p>
      </div>
	  
	  
      <div class="content_text">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p> <p>&nbsp;</p> 
        </div> 
  </div>
    <div id="page_bottom">
      <div class="content_text"></div>
      
  </div>
		
</div>

<div id="footer">
  <div id="footer_content">
    <div id="copyrights"></div>
    <div>
      <ul class="footer_menu">
        <li><a href="index.html" class="nav2">Home </a></li>
        <li><a href="servicios.html" class="nav2">Servicios</a></li>
        <li><a href="habitaciones.html" class="nav2">Habitaciones</a></li>
        <li><a href="tarifas.php" class="nav2">Reservas</a></li>
        <li><a href="ubicacion.html" class="nav2">Ubicacion</a></li>
        <li><a href="vacaciones.html" class="nav2">Sus Vacaciones</a></li>
        <li><a href="excursiones.html" class="nav2">Excursiones</a></li>
        <li><a href="tarifas.php" class="nav2">Contacto</a></li>
      </ul>
    </div>
    <div id="madeby">HumanBlink®<br />
    </div>
  </div>
</div>
</body>
</html>