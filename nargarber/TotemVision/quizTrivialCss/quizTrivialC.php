<?php

function getColorPorTematica($tematica) {
  $coloresHTML = [
    "geografia" => "blue", // Azul
    "entretenimiento" => "pink", // Rosa
    "historia" => "yellow", // Amarillo
    "arte_y_literatura" => "purple", // Púrpura 
    "ciencia_y_naturaleza" => "green", // Verde
    "deportes_y_pasatiempos" => "orange", // Naranja
    "ciencias_sociales" => "brown", // Marron
    "ulysseus" => "#312A63" // #312A63 purple
  ];

  return isset($coloresHTML[$tematica]) ? $coloresHTML[$tematica] : "white";
}


function getRandomBackgroundPorTematica($tematica) {
  $coloresHTML = [
    "geografia" => "blue", // Azul
    "entretenimiento" => "pink", // Rosa
    "historia" => "yellow", // Amarillo
    "arte_y_literatura" => "purple", // Púrpura 
    "ciencia_y_naturaleza" => "green", // Verde
    "deportes_y_pasatiempos" => "orange", // Naranja
    "ciencias_sociales" => "brown", // Marron
    "ulysseus" => "#312A63" // #312A63 purple
  ];
  $color = isset($coloresHTML[$tematica]) ? $coloresHTML[$tematica] : "white";
  $positions=["at left top", "at center top", "at right top", "at left center", "at center", "at right center", "at left bottom", "at center bottom", "at right bottom"];
  $randomKey = array_rand($positions);
  $position = $positions[$randomKey];
  $bk_color_css = "radial-gradient(".$position.", #C1C1C1 , ".$color.")";
  return $bk_color_css;
}

function getTituloPorTematica($tematica) {
  $coloresHTML = [
    "geografia" => "GEOGRAFÍA", // Azul
    "entretenimiento" => "ENTRETENIMIENTO", // Rosa
    "historia" => "HISTORIA", // Amarillo
    "arte_y_literatura" => "ARTE Y LITERATURA", // Púrpura 
    "ciencia_y_naturaleza" => "CIENCIA Y NATURALEZA", // Verde
    "deportes_y_pasatiempos" => "DEPORTES Y PASATIEMPOS", // Naranja
    "ciencias_sociales" => "CIENCIAS SOCIALES", //Brown
    "ulysseus" => "ULYSSEUS" // #312A63
];

  return isset($coloresHTML[$tematica]) ? $coloresHTML[$tematica] : "white";
}

// Leer el archivo JSON
$jsons = ["quizTrivial_test.json", "quizTrivial_chatGPT.json", "quizTrivial_ulysseus.json"];
$claveAleatoria = array_rand($jsons);
$jsonAzar = $jsons[$claveAleatoria];
$jsonData = file_get_contents($jsonAzar);
$data = json_decode($jsonData, true);


// Seleccionar un país al azar
$cartaAleatoria = $data['cartas'][array_rand($data['cartas'])];

$tematica=$cartaAleatoria["tematica"];
$sub_tematica=$cartaAleatoria["titulo"];
$respuesta=$cartaAleatoria["nombre"];
$urlImagen=$cartaAleatoria["imagenUrl"];
//list($anchoImagen, $altoImagen) = getimagesize($urlImagen);
$imageOrientation=$cartaAleatoria["imageOrientation"];
$respuestaWiki=$cartaAleatoria["enlace"];
$hechos1=$cartaAleatoria["hechos"][0];
$hechos2=$cartaAleatoria["hechos"][1];
$hechos3=$cartaAleatoria["hechos"][2];
$hechos4=$cartaAleatoria["hechos"][3];

$bk_color=getRandomBackgroundPorTematica($tematica);
$titulo=getTituloPorTematica($tematica);
$timestampActual = time();

?>
<script>console.log("<?php echo $bk_color; ?>");</script>
<?php

// Obtener todas las variables definidas
//$todasLasVariables = get_defined_vars();

// Imprimir las variables
// echo '<pre>';
// print_r($todasLasVariables);
// echo '</pre>';

if ($imageOrientation=='H') { 

  ?>

<form id="formRedirect" action="quizTrivialH.php?<?php echo $timestampActual; ?>" method="post" style="display: none;">
<input type="hidden" name="tematica" value="<?php echo htmlspecialchars($tematica); ?>">
<input type="hidden" name="sub_tematica" value="<?php echo htmlspecialchars($sub_tematica); ?>">
<input type="hidden" name="respuesta" value="<?php echo htmlspecialchars($respuesta); ?>">
<input type="hidden" name="urlImagen" value="<?php echo htmlspecialchars($urlImagen); ?>">
<input type="hidden" name="respuestaWiki" value="<?php echo htmlspecialchars($respuestaWiki); ?>">
<input type="hidden" name="hechos1" value="<?php echo htmlspecialchars($hechos1); ?>">
<input type="hidden" name="hechos2" value="<?php echo htmlspecialchars($hechos2); ?>">
<input type="hidden" name="hechos3" value="<?php echo htmlspecialchars($hechos3); ?>">
<input type="hidden" name="hechos4" value="<?php echo htmlspecialchars($hechos4); ?>">
<input type="hidden" name="bk_color" value="<?php echo htmlspecialchars($bk_color); ?>">
<input type="hidden" name="titulo" value="<?php echo htmlspecialchars($titulo); ?>">
</form>

<script type="text/javascript">
    document.getElementById('formRedirect').submit();
</script>

<?php
}

if ($imageOrientation=='V') { 

?>

<form id="formRedirect" action="quizTrivialV.php?<?php echo $timestampActual; ?>" method="post" style="display: none;">
<input type="hidden" name="tematica" value="<?php echo htmlspecialchars($tematica); ?>">
<input type="hidden" name="sub_tematica" value="<?php echo htmlspecialchars($sub_tematica); ?>">
<input type="hidden" name="respuesta" value="<?php echo htmlspecialchars($respuesta); ?>">
<input type="hidden" name="urlImagen" value="<?php echo htmlspecialchars($urlImagen); ?>">
<input type="hidden" name="respuestaWiki" value="<?php echo htmlspecialchars($respuestaWiki); ?>">
<input type="hidden" name="hechos1" value="<?php echo htmlspecialchars($hechos1); ?>">
<input type="hidden" name="hechos2" value="<?php echo htmlspecialchars($hechos2); ?>">
<input type="hidden" name="hechos3" value="<?php echo htmlspecialchars($hechos3); ?>">
<input type="hidden" name="hechos4" value="<?php echo htmlspecialchars($hechos4); ?>">
<input type="hidden" name="bk_color" value="<?php echo htmlspecialchars($bk_color); ?>">
<input type="hidden" name="titulo" value="<?php echo htmlspecialchars($titulo); ?>">
</form>

<script type="text/javascript">
    document.getElementById('formRedirect').submit();
</script>

<?php
}
?>


<!doctype html>
<html ⚡>
  <head>
    <meta charset="utf-8">

    <script>
    
      // truco para que refresque a los 40s - hay que calcular el tiempo cada vez
      setTimeout(function() {
          window.location.href = 'quizTrivialC.php?' + new Date().getTime();
      }, 30000);
    
    </script>

    <title>Quizzy</title>
    <link rel="canonical" href="quiz.html">
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
 
    <script async custom-element="amp-video" src="https://cdn.ampproject.org/v0/amp-video-0.1.js"></script>
    <script async custom-element="amp-story" src="https://cdn.ampproject.org/v0/amp-story-1.0.js"></script>

    <script async custom-element="amp-script" src="https://cdn.ampproject.org/v0/amp-script-0.1.js"></script>


    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400" rel="stylesheet">
    <style amp-custom>
      amp-story {
        font-family: 'Oswald',sans-serif;
        color: #fff;
      }
      amp-story-page {
        background: <?php echo $bk_color; ?>;
      }
      h1 {
        font-weight: bold;
        font-size: 2.875em;
        font-weight: normal;
        line-height: 1.174;
        text-shadow: 
        -1px -1px 0 #000,  
         1px -1px 0 #000,
        -1px 1px 0 #000,
         1px 1px 0 #000;
      }
      h2{
        text-align: center;
        text-shadow: 
        -1px -1px 0 #000,  
         1px -1px 0 #000,
        -1px 1px 0 #000,
         1px 1px 0 #000;
      }
      p {
        font-weight: normal;
        font-size: 1.3em;
        line-height: 1.5em;
        color: #fff;
        text-align: center;
        text-shadow: 
        -1px -1px 0 #000,  
         1px -1px 0 #000,
        -1px 1px 0 #000,
         1px 1px 0 #000;
      }
      q {
        font-weight: 300;
        font-size: 1.1em;
      }
      amp-story-grid-layer.bottom {
        align-content:end;
      }
      amp-story-grid-layer.noedge {
        padding: 0px;
      }
      amp-story-grid-layer.center-text {
        align-content: center;
      }
      .wrapper {
        display: grid;
        grid-template-columns: 50% 50%;
        grid-template-rows: 50% 50%;
      }
      .banner-text {
        text-align: center;
        background-color: #000;
        line-height: 2em;
      }

      .borde-negro {
        color: yellow;
        text-shadow: 
        -1px -1px 0 #000,  
         1px -1px 0 #000,
        -1px 1px 0 #000,
         1px 1px 0 #000;
      }

      .bnlb {
        color: white;
        text-shadow: 
        -1px -1px 0 #000,  
         1px -1px 0 #000,
        -1px 1px 0 #000,
         1px 1px 0 #000;
      }
      .imagen-contenedor {
            width: 80vw;
            height: 80vw;
            display: flex;
            align-items: center;  /* Centrar verticalmente */
            justify-content: center; /* Centrar horizontalmente */
            overflow: hidden; /* Evita que la imagen se desborde del contenedor */
            margin: 0 auto;
          /*  border: 1px solid white; */
      }

      .imagen-contenedor amp-img {
            max-width: 100%;
            max-height: 100%;
      }
      #respuestaWiki{
        font-size: 0.8em;
      }

    </style>
  </head>
  <body>


    <!-- Cover page -->
    <amp-story standalone
        title="Quizzy"
        publisher="tecniBUS"
        publisher-logo-src="assets/AMP-Brand-White-Icon.svg"
        poster-portrait-src="assets/cover.jpg">
      <amp-story-page id="cover" auto-advance-after="3s">
        <amp-story-grid-layer template="fill">
          <amp-img src="../../../SHARED/imagenes/quizziCover.png"
              width="768" height="1280"
              layout="responsive">
          </amp-img>
        </amp-story-grid-layer>
        <amp-story-grid-layer template="vertical">
          <h1  class="borde-negro"><?php echo $titulo;?></h1>
        </amp-story-grid-layer>
      </amp-story-page>



<!-- PAIS -->
<amp-story-page id="page0-part0" auto-advance-after="8s"> 
  <amp-story-grid-layer template="vertical">
  <div class="imagen-contenedor"><amp-img id="urlImagen" width="250" height="250" src="<?php echo $urlImagen;?>"  layout="fixed"></amp-img></div>
    <h2 style="text-align: center;font-size: 2em;padding-top: 1em;padding-bottom: 1em;">?</h2>
    <p id="paisRegionProvincia" style="text-align: center;"><?php echo $sub_tematica;?></p>
  </amp-story-grid-layer>
</amp-story-page>


<amp-story-page id="page0-part1" auto-advance-after="3s">
  <amp-story-grid-layer template="vertical">
  <div class="imagen-contenedor"><amp-img id="urlImagen" width="250" height="250" src="<?php echo $urlImagen;?>"  layout="fixed"></amp-img></div>
    <h2 style="text-align: center;font-size: 2em;padding-top: 1em;padding-bottom: 1em;">?</h2>
    <p  id="paisHecho1"><?php echo $hechos1;?></p>
  </amp-story-grid-layer>
</amp-story-page>


<amp-story-page id="page0-part2" auto-advance-after="3s">
  <amp-story-grid-layer template="vertical">
  <div class="imagen-contenedor"><amp-img id="urlImagen" width="250" height="250" src="<?php echo $urlImagen;?>"  layout="fixed"></amp-img></div>
    <h2 style="text-align: center;font-size: 2em;padding-top: 1em;padding-bottom: 1em;">?</h2>
    <p  id="paisHecho2"><?php echo $hechos2;?></p>
  </amp-story-grid-layer>
</amp-story-page>

<amp-story-page id="page0-part3" auto-advance-after="3s">
  <amp-story-grid-layer template="vertical">
  <div class="imagen-contenedor"><amp-img id="urlImagen" width="250" height="250" src="<?php echo $urlImagen;?>"  layout="fixed"></amp-img></div>
    <h2 style="text-align: center;font-size: 2em;padding-top: 1em;padding-bottom: 1em;">?</h2>
    <p  id="paisHecho3"><?php echo $hechos3;?></p>
  </amp-story-grid-layer>
</amp-story-page>

<amp-story-page id="page0-part4" auto-advance-after="3s">
  <amp-story-grid-layer template="vertical">
  <div class="imagen-contenedor"><amp-img id="urlImagen" width="250" height="250" src="<?php echo $urlImagen;?>"  layout="fixed"></amp-img></div>
    <h2 style="text-align: center;font-size: 2em;padding-top: 1em;padding-bottom: 1em;">?</h2>
    <br>
    <p id="paisHecho4"><?php echo $hechos4;?></p>
  </amp-story-grid-layer>
</amp-story-page>

<amp-story-page id="page0-part5" auto-advance-after="6s">
  <amp-story-grid-layer template="vertical">
  <div class="imagen-contenedor"><amp-img id="urlImagen" width="250" height="250" src="<?php echo $urlImagen;?>"  layout="fixed"></amp-img></div>
    <h2 id="paisNombre" style="text-align: center;font-size: 2em;padding-top: 1em;padding-bottom: 1em;"><?php echo $respuesta;?></h2>
    <br><br>
    <p id="respuestaWiki"><?php echo $respuestaWiki;?></p>
  </amp-story-grid-layer>
</amp-story-page>


      <!-- Bookend -->
      <amp-story-bookend src="bookend.json" layout="nodisplay"></amp-story-bookend>
    </amp-story>

  </body>
</html>