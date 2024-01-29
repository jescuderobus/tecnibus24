<?php
/*
    $variables = array(
      'tematica' => $tematica,
      'sub_tematica' => $sub_tematica,
      'respuesta' => $respuesta,
      'urlImagen' => $urlImagen,
      'respuestaWiki' => $respuestaWiki,
      'hechos1' => $hechos1,
      'hechos2' => $hechos2,
      'hechos3' => $hechos3,
      'hechos4' => $hechos4,
      'bk_color' => $bk_color,
      'titulo' => $titulo
    );  
*/
// Verifica si hay datos de POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Rescata los valores enviados por POST
  $tematica = isset($_POST['tematica']) ? $_POST['tematica'] : null;
  $sub_tematica = isset($_POST['sub_tematica']) ? $_POST['sub_tematica'] : null;
  $respuesta = isset($_POST['respuesta']) ? $_POST['respuesta'] : null;
  $urlImagen = isset($_POST['urlImagen']) ? $_POST['urlImagen'] : null;
  $respuestaWiki = isset($_POST['respuestaWiki']) ? $_POST['respuestaWiki'] : null;
  $hechos1 = isset($_POST['hechos1']) ? $_POST['hechos1'] : null;
  $hechos2 = isset($_POST['hechos2']) ? $_POST['hechos2'] : null;
  $hechos3 = isset($_POST['hechos3']) ? $_POST['hechos3'] : null;
  $hechos4 = isset($_POST['hechos4']) ? $_POST['hechos4'] : null;
  $bk_color = isset($_POST['bk_color']) ? $_POST['bk_color'] : null;
  $titulo= isset($_POST['titulo']) ? $_POST['titulo'] : null;
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

    <title>Quizzi</title>
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
        background-color: <?php echo $bk_color; ?>;
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
  <div class="imagen-contenedor"><amp-img id="urlImagen" width="450" height="250" src="<?php echo $urlImagen;?>"  layout="fixed"></amp-img></div>
    <h2 style="text-align: center;font-size: 2em;padding-top: 1em;padding-bottom: 1em;">?</h2>
    <p id="paisRegionProvincia" style="text-align: center;"><?php echo $sub_tematica;?></p>
  </amp-story-grid-layer>
</amp-story-page>


<amp-story-page id="page0-part1" auto-advance-after="3s">
  <amp-story-grid-layer template="vertical">
  <div class="imagen-contenedor"><amp-img id="urlImagen" width="450" height="250" src="<?php echo $urlImagen;?>"  layout="fixed"></amp-img></div>
    <h2 style="text-align: center;font-size: 2em;padding-top: 1em;padding-bottom: 1em;">?</h2>
    <p  id="paisHecho1"><?php echo $hechos1;?></p>
  </amp-story-grid-layer>
</amp-story-page>


<amp-story-page id="page0-part2" auto-advance-after="3s">
  <amp-story-grid-layer template="vertical">
  <div class="imagen-contenedor"><amp-img id="urlImagen" width="450" height="250" src="<?php echo $urlImagen;?>"  layout="fixed"></amp-img></div>
    <h2 style="text-align: center;font-size: 2em;padding-top: 1em;padding-bottom: 1em;">?</h2>
    <p  id="paisHecho2"><?php echo $hechos2;?></p>
  </amp-story-grid-layer>
</amp-story-page>

<amp-story-page id="page0-part3" auto-advance-after="3s">
  <amp-story-grid-layer template="vertical">
  <div class="imagen-contenedor"><amp-img id="urlImagen" width="450" height="250" src="<?php echo $urlImagen;?>"  layout="fixed"></amp-img></div>
    <h2 style="text-align: center;font-size: 2em;padding-top: 1em;padding-bottom: 1em;">?</h2>
    <p  id="paisHecho3"><?php echo $hechos3;?></p>
  </amp-story-grid-layer>
</amp-story-page>

<amp-story-page id="page0-part4" auto-advance-after="3s">
  <amp-story-grid-layer template="vertical">
  <div class="imagen-contenedor"><amp-img id="urlImagen" width="450" height="250" src="<?php echo $urlImagen;?>"  layout="fixed"></amp-img></div>
    <h2 style="text-align: center;font-size: 2em;padding-top: 1em;padding-bottom: 1em;">?</h2>
    <br>
    <p id="paisHecho4"><?php echo $hechos4;?></p>
  </amp-story-grid-layer>
</amp-story-page>

<amp-story-page id="page0-part5" auto-advance-after="6s">
  <amp-story-grid-layer template="vertical">
  <div class="imagen-contenedor"><amp-img id="urlImagen" width="450" height="250" src="<?php echo $urlImagen;?>"  layout="fixed"></amp-img></div>
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