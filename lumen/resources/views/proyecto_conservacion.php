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

<head>
	<?php if ($idioma=="en") { ?>
		<base href="../../">
	<?php } else { ?>
		<base href="../../">
	<?php }  ?>

	<style>
		@font-face {
			font-family: 'Daft Brush';
			src: url('fonts/DaftBrush.eot');
			src: url('fonts/DaftBrush.eot?#iefix') format('embedded-opentype'),
				url('fonts/DaftBrush.woff') format('woff'),
				url('fonts/DaftBrush.ttf') format('truetype');
			font-weight: normal;
			font-style: normal;
		}

		#proyecto_conservacion {
			font-family: 'Helvetica';
			color: #372F29;
			line-height: 1.3em;
		}

		#proyecto_conservacion h3 {
			padding-bottom: 5px;
			margin-bottom: 0px;
			font-family: "Daft Brush";
			color: #B4D340;
			line-height: 1em;
			font-size: 50px;
			text-transform: uppercase;
		}

		#proyecto_conservacion .left,
		#proyecto_conservacion .right {
			width: 50%;
			float: left;
			box-sizing: border-box;
		}

		#proyecto_conservacion p {
			font-size: 14px;
			padding-left: 15px;
		}

		#proyecto_conservacion .video {
			margin-top: 20px;
			margin-bottom: 15px;
			position: relative;
			padding-bottom: 56.25%;
			height: 0;
			overflow: hidden;
		}

		#proyecto_conservacion .video img {
			width: 100%;
			height: auto;
		}

		#proyecto_conservacion .video iframe {
			width: 100%;
			height: 100%;
			position: absolute;
			top: 0px;
		}

		#proyecto_conservacion .footer {
			background: #B4D340;
			font-weight: bold;
		}

		#proyecto_conservacion .footer a {
			text-decoration: none;
			color: #372F29;
		}

		#proyecto_conservacion .footer p {
			width: 50%;
			padding-left: 15px;
			margin-left: auto;
			height: 50px;
			padding-top: 10px;
			padding-bottom: 5px;
			margin-bottom: 0px;
			margin-top: 0px;
			padding-right: 15px;
		}

		@media (max-width: 900px) {
			#proyecto_conservacion h3 {
				text-align: center;
			}

			#proyecto_conservacion .left,
			#proyecto_conservacion .right {
				width: 100%;
				float: none;
			}

			#proyecto_conservacion .left {
				width: 80%;
				margin: auto;
			}

			#proyecto_conservacion .footer p {
				width: 100%;
				padding-right: 10px padding-left: 10px;
				box-sizing: border-box;
				padding-top: 5px;
				height: auto;
				padding-bottom: 5px;
			}

			body {
				-webkit-text-size-adjust: 100%;
			}
		}
	</style>
	<meta name="viewport" content="width=device-width; initial-scale=1.0;" />

</head>

<body>
	<div id="proyecto_conservacion">
		<h3>
			<?php echo $area->titulo ?>
			
		</h3>
		<div class="left">
			<div class="video">

				<?php if ($idioma=="es") { ?>
					<?php echo $area->video; ?>
				<?php } else { ?>
					<?php echo $area->video_en; ?>
				<?php } ?>

			</div>
		</div>
		<div class="right">
			<?php if ($idioma=="es") { ?>
					<?php echo $area->texto; ?>
				<?php } else { ?>
					<?php echo $area->texto_en; ?>
				<?php } ?>
		</div>
		<div style="clear:both;"></div>
		<div class="footer">
			<?php
			if($area->texto_link!=""){
			?>
			<p><a target="_blank" href="<?php echo $area->link ?>"><?php texto($area->texto_link,$area->texto_link_en) ?>. <?php texto('HAZ CLICK AQUÍ','CLICK HERE')?>.</a></p>
			<?php } ?>
		</div>
	</div>
</body>

</html>