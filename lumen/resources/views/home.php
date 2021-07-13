<!DOCTYPE html>
<!--[if IE 6]>	  <html lang='es' class='lt-ie7 lt-ie8 lt-ie9 lt-ie10 lt-ie11'>  <![endif]-->
<!--[if IE 7]>	  <html lang='es' class='lt-ie8 lt-ie9 lt-ie10 lt-ie11'>  <![endif]-->
<!--[if IE 8]>    <html lang='es' class='lt-ie9 lt-ie10 lt-ie11'> <![endif]-->
<!--[if IE 9]>    <html lang='es' class='lt-ie10 lt-ie11'> <![endif]-->
<!--[if IE 10]>   <html lang='es' class='lt-ie11'> <![endif]-->
<!--[if IE 11]><!-->


<html lang='<?php echo $idioma; ?>'>
<?php
  $GLOBALS['lang']=$idioma;

  function texto($espanol,$ingles){    
    if($GLOBALS['lang']=='es'){
      echo $espanol;
    }else{
      echo $ingles;
    }
  }

?>
<!--<![endif]-->

<head>
  <meta charset='UTF-8'>
  <base href="./">
  <title>Reforestamos por Naturaleza</title>
  <meta name="description" content="Reforestamos por Naturaleza es una campaña de Conservamos por Naturaleza, que permite a cualquier persona apoyar iniciativas de conservación en todo el país, a través de la adopción de árboles nativos.">
  <link rel="shortcut icon" href="https://www.conservamospornaturaleza.org/wp-content/themes/conservamosTheme/images/favicon.ico" type="image/x-icon" />
  <meta name='viewport' content='width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui'>
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
  <link rel="stylesheet" href="css/jquery.fancybox.css" type="text/css" />
  <link href="css/green.css" rel="stylesheet" />
  <link href="css/datepicker.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/jquery.bxslider.min.css" type="text/css" />
  <script>
    idioma="<?php echo $idioma; ?>";
  </script>
  <script src="js/jquery.js"></script>
  <script src="js/icheck.min.js"></script>
  <script src="js/jquery.lettering.min.js"></script>
  <script src="js/jquery.bxslider.min.js"></script>
  <script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
  <link href="css/main.css?v=5" rel="stylesheet" type="text/css">

  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

</head>

<body>
  <div id="topHeader" class="container">
    <a target="_blank" href="http://www.conservamospornaturaleza.org/">
      <div id="logoConservamos" class="left"></div>
    </a>
    <ul>
      <li class="goToNav" data-goto="adopta"><?php texto('ADOPTA UN ÁRBOL','ADOPT A TREE') ?></li>
      <li class="goToNav" data-goto="que-es"><?php texto('¿QUÉ ES RXN?','WHAT IS RXN?') ?></li>
      <li class="goToNav" data-goto="proyectos"><?php texto('PROYECTOS','PROJECTS') ?></li>
      <li class="goToNav" data-goto="aliados"><?php texto('ALIADOS','ALLIES') ?></li>
      <?php 
      if ($idioma=="en") { 
      ?>
        <li class="idioma"><a href="https://reforesta.pe/">Español</a> / <span class="activo">English</span></li>
      <?php
      } ?>
      <?php 
      if ($idioma=="es") { 
      ?>
        <li class="idioma"><span class="activo">Español</span> / <a href="https://reforesta.pe/en">English</a></li>
      <?php
      } ?>
    </ul>
    <div class="social right">
      <a href="https://www.facebook.com/conservamospornaturaleza" target="_blank"><span class="icon small iconFb"></span></a>
      <a href="https://www.twitter.com/conservamos" target="_blank"><span class="icon small iconTwitter"></span></a>
      <a href="https://vimeo.com/conservamospornaturaleza/" target="_blank"><span class="icon small iconVimeo"></span></a>
      <a href="https://www.youtube.com/user/Conservamos" target="_blank"><span class="icon small iconYt"></span></a>
      <a href="https://instagram.com/conservamos" target="_blank"><span class="icon small iconInstagram"></span></a>
    </div>
  </div>
  <header class="container">
    <div id="<?php texto('logo','logo_en') ?>"></div>
    <div id="sloganContainer" class="container">
      <?php 
      if ($idioma=="en") { 
        //$num_arboles=$num_arboles/3.5;
        $num_arboles=round($num_arboles);
      } ?>

      <h2><?php texto('YA SE HAN ADOPTADO ','') ?><div class="boxLetters"><?php echo $num_arboles;
                                                      ?></div> <?php texto('ÁRBOLES Y RECAUDAMOS ','trees have already been adopted, and ') ?> <span><?php texto('S/','$') ?></span>
        <div class="boxLetters"><?php 
          if ($idioma=="en") { 
            //$num_arboles=$num_arboles/3.5;
            echo intval ($num_arboles * $precio / 3.5);
          }
          if ($idioma=="es") { 
            //$num_arboles=$num_arboles/3.5;
            echo intval ($num_arboles * $precio);
          } ?></div> <?php texto('PARA INICIATIVAS DE CONSERVACIÓN VOLUNTARIA','have been raised for voluntary conservation initiatives') ?> 
      </h2>

    </div>
    <div class="creditos"><?php texto('Foto','Photo') ?>: Claudio Moro</div>
  </header>

  <div id="bodyContainer">
    <div id="adopta" class="instructions">      
      <div class="instructions-content">
        <h2><?php texto('ADOPTA UN ÁRBOL','Adopt a tree') ?></h2><br>
        <div class="left">
          <h3><?php texto('AÚN NO TENGO MI CÓDIGO:','I don’t have a code yet:') ?></h3>
          <ul>
            <li><span class="number">1.</span><img src="img/instructions1.png" />
              <p>
                <?php texto($website[9]->valor,$website[9]->valor_en) ?>
              </p>
              <div class="desc-instruc big">
                <?php texto($website[5]->valor,$website[5]->valor_en) ?> 
                <a href="#" class="mypopup" data-popupname="popup/datos_cuenta/<?php echo  $idioma; ?>">
                  (<?php texto($website[13]->valor,$website[13]->valor_en) ?>)
                </a>
              </div>
            </li>
            <li><span class="number">2.</span><img src="img/instructions2.png" />
              <p><?php texto($website[10]->valor,$website[10]->valor_en) ?></p>
              <div class="desc-instruc big">
                <?php texto($website[6]->valor,$website[6]->valor_en) ?>
              </div>
            </li>
            <li class="clearfix"></li>
          </ul>
        </div>
        <div class="right">
          <h3><?php texto("YA TENGO MI CÓDIGO","I ALREADY HAVE MY CODE") ?>:</h3> 
          <ul>
            <li><span class="number">3.</span><img src="img/instructions3.png" />
              <p>
                <?php texto($website[11]->valor,$website[11]->valor_en) ?>
              </p>
              <div class="desc-instruc big">
                <?php texto($website[7]->valor,$website[7]->valor_en) ?>
              </div>
            </li>
            <li><span class="number">4.</span><img src="img/instructions4.png" />
              <p>
                <?php texto($website[12]->valor,$website[12]->valor_en) ?>
              </p>
              <div class="desc-instruc big">
                <?php texto($website[8]->valor,$website[8]->valor_en) ?>
              </div>
            </li>
            <li class="clearfix"></li>
          </ul>
        </div>
        <div class="clearfix"></div>
        <p class="note"><?php texto('Si quieres adoptar más de 10 árboles a la vez por favor escríbenos a:','If you would like to adopt more than 10 trees at a time, please write to us at: ') ?>  <a href="mailto:reforesta@conservamos.org"><span>reforesta@conservamos.org</span></a></p>
      </div>
    </div>

    <div class="right formContainer section" name="adopta-name">
      <div class="headerForm">
        <h2><?php texto('CREA TU CERTIFICADO','Create your certificate') ?></h2>
      </div>

      <div class="bodyForm">
        <form id="formArbol">

          <div>
            
          </div>
          <div class="escogeOpcion">
            <div class="inputRow radioRow">
              <h3><?php texto('EL ÁRBOL ES PARA','Who is the tree for?') ?></h3>
              <div class="radioRowCenter">
                <span class="radioAndLabel">
                  <label for="mi">
                    <img style="margin:auto; display:block;" src="img/iconMi.png" />
                    <span class="text-radio"><?php texto('Mi','Me') ?></span>
                    <input name="para" id="mi" value="0" type="radio" class="radioInput" />
                  </label>
                </span>
                <span class="radioAndLabel">
                  <label for="alguienMas">
                    <img style="margin:auto; display:block;" src="img/iconAlguienQuiero.png" />
                    <span class="text-radio"><?php texto('Alguien que quiero','Someone I love') ?></span>
                    <input name="para" id="alguienMas" value="4" type="radio" class="radioInput" />
                  </label>
                </span>
                <span class="radioAndLabel">
                  <label for="matrimonio">
                    <img style="margin:auto; display:block;" src="img/iconMatrimonio.png" />
                    <span class="text-radio"><?php texto('Un matrimonio','A wedding') ?></span>
                    <input name="para" value="1" id="matrimonio" type="radio" class="radioInput" />
                  </label>
                </span>
                <span class="radioAndLabel">
                  <label for="fallece">
                    <img style="margin:auto; display:block;" src="img/iconFallece.png" />
                    <span class="text-radio"><?php texto('Una persona que nos dejó','Someone who has left us') ?></span>
                    <input name="para" id="fallece" value="2" type="radio" class="radioInput" />
                  </label>
                </span>
                <span class="radioAndLabel">
                  <label for="bebe">
                    <img style="margin:auto; display:block;" src="img/iconBebe.png" />
                    <span class="text-radio"><?php texto('Un bebé recién llegado','A new baby') ?></span>
                  </label>
                  <input name="para" id="bebe" value="3" type="radio" class="radioInput" />
                </span>
              </div>
              <div style="width: 85%">
              

                <div class="inputRow" style="height: auto;">
                  <textarea id="deCertificado" name="deCertificado" placeholder="<?php texto('Dedicatoria (max 220 caracteres)','Dedication (max 220 characters)') ?>" maxlength="220" rows="4"></textarea>
                </div>
                <div class="inputRow">
                  <input name="nombreCertificado" id="nombreCertificado" placeholder="<?php texto('Para','For') ?>" />
                </div>
                <div class="inputRow">
                  <input name="fecha" id="fechaCertificado" placeholder="<?php texto('Fecha (Opcional)','Date (Optional)') ?>" />
                </div>
                

              </div>
            </div>            
          </div>
          <div class="formRight">
            <h3><?php texto('INFORMACIÓN DE PAGO','Payment information') ?></h3>
            <div class="inputRow">
              <input type="text" name="nombre" placeholder="<?php texto('Nombre','Name') ?>" id="nombre" class="double" />
            </div>
            <div class="inputRow">
              <input type="text" name="apellido" placeholder="<?php texto('Apellido','Last Name') ?>" id="apellido" class="double right" />
            </div>
            <div class="inputRow">
              <input type="text" name="dni" id="dni" placeholder="<?php texto('DNI / RUC / Pasaporte','Enter ID or Passaport.') ?>" class="double" />
              <select name="tipodocumento" id="tipodocumento" class="turnintodropdown double right">
                <option value="-1"><?php texto('Tipo de Documento','Document Type') ?></option>
                <option value="1"><?php texto('DNI','ID') ?></option>
                <option value="2"><?php texto('RUC','Passaport') ?></option>
                <option value="3"><?php texto('Pasaporte','Other') ?></option>
              </select>
            </div>
            <div class="inputRow">
              <select name="nacionalidad" id="nacionalidad" class="turnintodropdown double right">
                <option value="-1"><?php texto('Nacionalidad','Select a nationality.') ?></option>
              </select>
            </div>
            <div class="inputRow">
              <input type="text" name="email" id="email" placeholder="<?php texto('Correo Electrónico','Enter email') ?>" />
            </div>
            <?php if ($idioma=="es") { ?>
            <div class="inputRow" style="height:auto; min-height: 45px;"><input id="newsletter" value="1" type="checkbox" name="newsletter" checked /><label for="newsletter"> Deseo suscribirme al boletín de noticias de CxN.</label></div>
            <?php } else { ?>  
              <br>
            <?php } ?>
            <div class="inputRow metodopago" style="height:auto; min-height: 45px;"><label class="etiqueta"><?php texto('Indica el método de pago que utilizaste','What payment method did you use?') ?></label></div>
            <div class="inputRow metodopago" style="height:auto; min-height: 45px;">
              
              <span class="radioAndLabel">
                <label for="bcp">                                    
                  <input name="metodo" value="bcp" id="bcp" type="radio" class="radioInput" />
                  <span class="text-radio">BCP</span>
                </label>
                <label for="scotiabank">                                    
                  <input name="metodo" value="scotiabank" id="scotiabank" type="radio" class="radioInput" />
                  <span class="text-radio">Scotiabank</span>
                </label>
                <label for="payu">                                    
                  <input name="metodo" value="payu" id="payu" type="radio" class="radioInput" />
                  <span class="text-radio">PayU</span>
                </label>
                <label for="otro">                  
                  <input name="metodo" value="-1" id="otro" type="radio" class="radioInput" />
                </label>
                <input type="text" name="otrotxt" id="otrotxt" placeholder="<?php texto('Otro','Other') ?>" />
              </span>

            </div>

            

            
            <div class="inputRow">
              <input type="text" name="codigo" id="codigo" placeholder="<?php texto('Ingresa tu código','This code does not exist') ?>" />
            </div>
            <!--h4><b>Si el árbol no es para ti, </b><br>ingresa los datos de la(s) persona(s) para quien está dedicado:</h4>
            <div id="inputsTodos">
              <div class="inputRow">
                <input name="nombreCertificado" id="nombreCertificado" placeholder="Nombre de la(s) persona(s)" />
              </div>
            </div-->   

          </div>          
          <div class="formFinal">
            <br><br>
            <div>
              <a id="enviar"> <?php texto('ADOPTAR ÁRBOL','ADOPT A TREE') ?>  </a>
            </div>
            <ul id="errorBox" display="block;">
              <li><label id="response-error" class="error" style="display: inline;"></label></li>
            </ul>
            <div id="response-success"></div>
            <br>
          </div>
          <div class="faq"><p>&nbsp;<br> <?php texto('¿Tienes alguna duda?','Do you still have questions?') ?>  <b><?php texto('Revisa aquí','Check here') ?> :</b> <a href="#" class="mypopup" data-popupname="popup/faq/<?php echo  $idioma; ?>" data-sizeh="600"><?php texto('PREGUNTAS FRECUENTES','FAQ') ?></a></p></div>
          <br><br>
        </form>
      </div>
    </div>
    <div id="que-es" class="que-es">
      <h2><?php texto('¿QUÉ ES REFORESTAMOS?','What is We reforest by Nature?') ?></h2>
      <div class="left">
        <?php texto($website[0]->valor,$website[0]->valor_en); ?>
        <?php if ($idioma=="es") { ?>
          <div class="video">
            <?php texto($website[2]->valor,$website[2]->valor_en); ?>
          </div>
        <?php } ?>
      </div>
      <div class="right">
        <?php texto($website[1]->valor, $website[1]->valor_en ); ?>
        <?php if ($idioma=="es") { ?>
          <!--h2>NOTICIAS</h2>
        <ul class="noticias">
          <?php
            $c = 0;
            foreach ($noticias as $noticia) {
              if ($c % 2 == 0) {
                echo '<li><a href="' . $noticia->url . '" target="_blank"><img src="' . $noticia->imagen . '" /><h3>' . $noticia->titulo . '</h3></a>';
              }
              if ($c % 2 == 1) {
                echo '<a href="' . $noticia->url . '" target="_blank"><img src="' . $noticia->imagen . '" /><h3>' . $noticia->titulo . '</h3></a></li>';
              }
              $c = $c + 1;
            }
          ?>
        </ul-->
        <?php } ?>
        
      </div>
      <div class="clearfix"></div>
    </div>
    <div id="proyectos" class="proyectosContainer">
      <div class="proyectos">
        <h2><?php texto('PROYECTOS','Projects') ?></h2>
        <div class="left">
          <h3><?php texto('¿En qué áreas de conservación reforestamos y qué logramos con tus donaciones?','In which conservation areas do we reforest, and what do we achieve with your donations?') ?></h3>
        </div>
        <div class="right">
          <p><?php texto('Aprende más sobre las áreas de conservación que participan en la campaña, y los diferentes proyectos que se implementan gracias a tus donaciones.','Learn more about the conservation areas that participate in this campaign, and the different projects that are implemented thanks to your donations. ') ?></p>
        </div>
        <div class="clearfix"></div>
        
        
        
        <ul class="areas">

          <?php
          foreach ($areas as $area) { ?>
            <li class="mypopup" data-popupname="popup/proyecto_conservacion/<?php echo  $idioma; ?>" data-params="id=<?php echo  $area->id ?>" data-sizew="1200" data-sizeh="600">
              <img src="lumen/storage/app/public/proyecto<?php echo  $area->id ?>.jpg" />
              <div class="circle">
                <div>
                  <h4><?php echo  $area->titulo  ?></h4>
                  <span>+ INFO</span>
                </div>
              </div>
            </li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
    <div id="aliados" class="aliadosContainer">
      <div class="aliados">
        <h2><?php texto('ALIADOS','Allies') ?></h2>
        <div class="left">
        <?php texto($website[3]->valor,$website[3]->valor_en) ?>
        </div>
        
        <div class="parent">
          <div class="div1">
            <img src="lumen/storage/app/images/logo1.png" />
          </div>
          <div class="div2"> 
            <img src="lumen/storage/app/images/logo2.png" />
          </div>
          <div class="div3">
            <img src="lumen/storage/app/images/logo3.png" />
          </div>
          <div class="div4"> 
            <img src="lumen/storage/app/images/logo4.png" />
          </div>
          <div class="div5">
            <img src="lumen/storage/app/images/logo5.png" />
          </div>
          <div class="div6"> 
            <img src="lumen/storage/app/images/logo6.png" />
          </div>
        </div>

      </div>
    </div>
    <footer>
      <div class="footerContainer">
        <div class="column">
          <div class="sponsors">
            <a target="_blank" href="http://www.conservamospornaturaleza.org/" class="conservamosLogoLink">
              <!--div id="logoConservamos"></div-->
              <img src="img/Logo_SPDA-CxN-Wht.png"  width="100%" />
            </a>
            <!--a target="_blank" href="http://www.spda.org.pe/" class="spdaLogoLink">
              <div id="spdaLogo"></div>
            </a-->
          </div>
          <div>
          <?php texto($website[4]->valor,$website[4]->valor_en) ?>
          </div>
        </div>
        <div class="column">
          <ul>
            <li class="goToNav" data-goto="adopta"><?php texto('ADOPTA UN ÁRBOL','ADOPT A TREE') ?></li>
            <li class="goToNav" data-goto="que-es"><?php texto('¿QUÉ ES RXN?','WHAT IS RXN?') ?></li>
            <li class="goToNav" data-goto="proyectos"><?php texto('PROYECTOS','PROJECTS') ?></li>
            <li class="goToNav" data-goto="aliados"><?php texto('ALIADOS','Allies') ?></li>
            <!--li><a target="_blank" href="http://issuu.com/conservamospornaturaleza/docs/politicas_y_condiciones_de_reforest">POLÍTICAS Y CONDICIONES</a></li-->
            <li><a href="#" class="mypopup" data-popupname="popup/politicas/<?php echo  $idioma; ?>" data-sizeh="600"><?php texto('POLÍTICAS Y CONDICIONES','policies and conditions') ?></a></li>
            <li><a href="#" class="mypopup" data-popupname="popup/faq/<?php echo  $idioma; ?>" data-sizeh="600"><?php texto('FAQ','FAQ') ?></a></li>
          </ul>
        </div>
        <div class="column">
          <form id="signup" class="formee" action="./subscribe" method="post">
            <fieldset>
              <legend><?php texto('ÚNETE AL BOLETÍN','JOIN THE NEWSLETTER') ?></legend>
              <div>
                <label for="fname"></label> <input name="fname" id="fname" type="text" placeholder="<?php texto('Nombre','Name') ?>*" />
              </div>
              <div>
                <label for="lname"></label> <input name="lname" id="lname" type="text" placeholder="<?php texto('Apellidos','Last Name') ?>*" />
              </div>
              <div>
                <label for="email_s"></label> <input name="email_s" id="email_s" type="text" placeholder="<?php texto('Correo','Email address') ?>*" />
              </div>
              <div>
                <input class="right inputnew" type="submit" title="SUSCRIBIRME AL BOLETÍN" value="<?php texto('SUSCRIBIRME AL BOLETÍN','Subscribe') ?>" />
              </div>
            </fieldset>
          </form>
          <div id="response"></div>
        </div>
        <div class="clearfix"></div>
      </div>
    </footer>
    <img class="hiddenPick" src="img/logoConservamos_icon.png" />  
    <img class="hiddenPick" src="img/iFb_b.png" />
    <img class="hiddenPick" src="img/iTwitter_b.png" />
    <img class="hiddenPick" src="img/iVimeo_b.png" />
    <img class="hiddenPick" src="img/iYt_r.png" />
    <img class="hiddenPick" src="img/iInstagram_b.png" />

    <script src="js/jquery.validate.js"></script>
    <script src="js/datepicker.min.js"></script>
    <script src="js/datepicker.es.js"></script>
    <script src="js/navigate.js"></script>
    <script src="js/main.js?v=5"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
      $('.areas').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
        {
          breakpoint: 1200,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ]
      });

      <?php
        if($GLOBALS['lang']=='en'){
      ?>
        window.addEventListener("resize", function(e) {
          $("#videoquees").height( $("#videoquees").width()) ;
        });
        ////
        $("#videoquees").height( $("#videoquees").width()) ;
        /////
      <?php } ?>

    </script>
</body>





</html>

