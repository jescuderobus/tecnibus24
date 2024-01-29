<!doctype html>
<html ⚡>
  <head>
    <meta charset="utf-8">

    <script>
    
      // truco para que refresque a los 40s - hay que calcular el tiempo cada vez
      setTimeout(function() {
          window.location.href = 'quizTrivial.php?' + new Date().getTime();
      }, 30000);
    
    </script>


    <title>Quiz geográfico</title>
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
        background-color: #000;
      }
      h1 {
        font-weight: bold;
        font-size: 2.875em;
        font-weight: normal;
        line-height: 1.174;
      }
      h2{
        text-align: center;
      }
      p {
        font-weight: normal;
        font-size: 1.3em;
        line-height: 1.5em;
        color: #fff;
        text-align: center;
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
    </style>
  </head>
  <body>

  <?php
// Leer el archivo JSON
$jsonData = file_get_contents('./alvcarnun/AmpTotems/quizTrivial.json');
$data = json_decode($jsonData, true);

// Seleccionar un país al azar
$paisAleatorio = $data['paises'][array_rand($data['paises'])];

$paisRegionProvincia=$paisAleatorio["titulo"];
$paisNombre=$paisAleatorio["nombre"];
$paisImagen=$paisAleatorio["imagenUrl"];
$paisWiki=$paisAleatorio["enlace"];
$hechos1=$paisAleatorio["hechos"][0];
$hechos2=$paisAleatorio["hechos"][1];
$hechos3=$paisAleatorio["hechos"][2];
$hechos4=$paisAleatorio["hechos"][3];

// Obtener todas las variables definidas
//$todasLasVariables = get_defined_vars();

// Imprimir las variables
// echo '<pre>';
// print_r($todasLasVariables);
// echo '</pre>';

?>

    <!-- Cover page -->
    <amp-story standalone
        title="Quizzy"
        publisher="tecniBUS"
        publisher-logo-src="./../../../SHARED/imagenes/AMP-Brand-White-Icon.svg"
        poster-portrait-src="./../../../SHARED/imagenes/cover.jpg">
      <amp-story-page id="cover" auto-advance-after="3s">
        <amp-story-grid-layer template="fill">
          <amp-img src="./../../../SHARED/imagenes/quizziCover.jpg"
              width="768" height="1280"
              layout="responsive">
          </amp-img>
        </amp-story-grid-layer>
        <amp-story-grid-layer template="vertical">
          <h1  class="borde-negro">Un poco de geografía</h1>
          <p  class="borde-negro">By tecniBUS</p>
        </amp-story-grid-layer>
      </amp-story-page>


<!-- PAIS -->

<amp-story-page id="page0-part0" auto-advance-after="8s"> 
  <amp-story-grid-layer template="vertical">
    <amp-img id="paisImagen" width="250" height="250" src="<?php echo $paisImagen;?>"  layout="responsive"></amp-img>
    <h2 style="text-align: center;font-size: 2em;padding-top: 1em;padding-bottom: 1em;">?</h2>
    <p id="paisRegionProvincia" style="text-align: center;"><?php echo $paisRegionProvincia;?></p>
  </amp-story-grid-layer>
</amp-story-page>


<amp-story-page id="page0-part1" auto-advance-after="3s">
  <amp-story-grid-layer template="vertical">
    <amp-img id="paisImagen" width="250" height="250"  src="<?php echo $paisImagen;?>"  layout="responsive"></amp-img>
    <h2 style="text-align: center;font-size: 2em;padding-top: 1em;padding-bottom: 1em;">?</h2>
    <p  id="paisHecho1"><?php echo $hechos1;?></p>
  </amp-story-grid-layer>
</amp-story-page>


<amp-story-page id="page0-part2" auto-advance-after="3s">
  <amp-story-grid-layer template="vertical">
    <amp-img id="paisImagen" width="250" height="250" src="<?php echo $paisImagen;?>"  layout="responsive"></amp-img>
    <h2 style="text-align: center;font-size: 2em;padding-top: 1em;padding-bottom: 1em;">?</h2>
    <p  id="paisHecho2"><?php echo $hechos2;?></p>
  </amp-story-grid-layer>
</amp-story-page>

<amp-story-page id="page0-part3" auto-advance-after="3s">
  <amp-story-grid-layer template="vertical">
    <amp-img id="paisImagen" width="250" height="250" src="<?php echo $paisImagen;?>"  layout="responsive"></amp-img>
    <h2 style="text-align: center;font-size: 2em;padding-top: 1em;padding-bottom: 1em;">?</h2>
    <p  id="paisHecho3"><?php echo $hechos3;?></p>
  </amp-story-grid-layer>
</amp-story-page>

<amp-story-page id="page0-part4" auto-advance-after="3s">
  <amp-story-grid-layer template="vertical">
    <amp-img id="paisImagen" width="250" height="250" src="<?php echo $paisImagen;?>"  layout="responsive"></amp-img>
    <h2 style="text-align: center;font-size: 2em;padding-top: 1em;padding-bottom: 1em;">?</h2>
    <br>
    <p id="paisHecho4"><?php echo $hechos4;?></p>
  </amp-story-grid-layer>
</amp-story-page>

<amp-story-page id="page0-part5" auto-advance-after="6s">
  <amp-story-grid-layer template="vertical">
    <amp-img id="paisImagen" width="250" height="250" src="<?php echo $paisImagen;?>"  layout="responsive"></amp-img>
    <h2 id="paisNombre" style="text-align: center;font-size: 2em;padding-top: 1em;padding-bottom: 1em;"><?php echo $paisNombre;?></h2>
    <br><br>
    <p id="paisWiki"><?php echo $paisWiki;?></p>
  </amp-story-grid-layer>
</amp-story-page>


      <!-- Bookend -->
      <amp-story-bookend src="bookend.json" layout="nodisplay"></amp-story-bookend>
    </amp-story>

  </body>
</html>