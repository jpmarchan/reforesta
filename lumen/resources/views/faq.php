<html>

<head>
	<base href="../../">

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

		#faq {
			font-family: 'Helvetica';
			color: #372F29;
			line-height: 1.3em;
		}

		#faq h3 {
			border-bottom: 2px solid #B4D341;
			padding-bottom: 5px;
			margin-bottom: 10px;
		}

		#faq h4 {
			color: #372F29;
			background: #B4D340;
			padding-left: 20px;
			padding-right: 20px;
			display: inline-block;
			margin-bottom: 0px;
			padding-top: 5px;
			padding-bottom: 5px;
			border-radius: 15px;
			margin-top: 5px;
		}

		#faq>p {
			margin-bottom: 10px;
			margin-top: 10px;
		}

		.wrapper {
			position: fixed;
			top: 50%;
			left: 50%;
		}

		#faq>p:nth-of-type(2n+1) {
			font-family: "Daft Brush";
			background: #372F29;
			color: #B4D340;
			display: inline-block;
			width: 34px;
			height: 34px;
			position: relative;
			text-align: center;
			padding-top: 6px;
			box-sizing: border-box;
			border-radius: 17px;
			font-size: 20px;
			margin-right: 10px;
		}

		body {
			-webkit-text-size-adjust: 100%;
		}
	</style>
	<meta name="viewport" content="width=device-width; initial-scale=1.0;" />
</head>

<body>
	<div id="faq">
		<?php if ($idioma=="es") { ?>
			<?php echo $website[14]->valor; ?>
		<?php } else { ?>
			<?php echo $website[14]->valor_en; ?>
		<?php } ?>
	</div>
</body>

</html>