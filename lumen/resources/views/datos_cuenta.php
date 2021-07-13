<html lang='<?php echo $datos->idioma; ?>'>
<?php
  $GLOBALS['lang']=$datos->idioma;

  function texto($espanol,$ingles){    
    if($GLOBALS['lang']=='es'){
      echo $espanol;
    }else{
      echo $ingles;
    }
  }
?>

	<head>
        <base href="../../">
		<style>	
			#datos-cuenta, #payu {
				width : 50%;
				float: left;
			}
			#datos-cuenta, #payu {
				font-family: 'Helvetica';
				color: #372F29;
				line-height: 1.3em;
			}
			#datos-cuenta h3, #payu h3 {
				border-bottom: 2px solid #B4D341;
				padding-bottom: 5px;
				margin-bottom: 10px;
				font-size: 16px;
			}
			#datos-cuenta h4 , #payu h4{
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
			#payu div{
				width: 50%;
				float: left;
				height: 25px;
				font-size: 13px;
    			font-weight: bold;	
				border-bottom: solid 0.5px #aaa;
				margin-top: 4px;
			}
            #payu .donar input{
                height: 20px;
				position: absolute;    			
            }            
			#payu .donar{
				width: 25%;    			
			}
			#payu .donar img{
				height: 20px;
    			text-align: right;
			}
			#datos-cuenta > p {
				margin-bottom: 	0px;
				margin-top: 	10px;
				font-size: 14px;
    			font-weight: bold;
			}
			.confirm-message {
				width: 100%;
				height: 2px;
				float: left;
				margin-top: 20px;
				border-top: 1px solid #B4D341;
			}
			.wrapper {
				position:fixed;
				top:50%;
				left:50%;
			}
			body {
				-webkit-text-size-adjust: 100%;
			}	
			@media (max-width: 600px) {
				#datos-cuenta, #payu {
					width : 100%;					
				}
			}
			


		</style>
		<meta name="viewport" content="width=device-width; initial-scale=1.0;" />
	</head>
	<body>
		<div id="datos-cuenta" >
		   <h3><?php texto('CUENTAS DE BANCOS','BANK ACCOUNTS') ?> </h3>
		   <br>
		   <img src="img/bcp.png" height="25px" />	
		   	<?php 
			if($datos->idioma=="es"){
			?>	   
		    <p>
				<?php texto('Cuenta Soles','Soles Account') ?>: 193-2093463-0-89<br>
		    	CCI: 002-193-002093463089-16
		    </p>
			<?php
			} else {
			?>
			<p>
				Account number: 193-2093463-0-89<br>
		    	SWIFT Code: BCPLPEPL<br>
				Account holder: SOCIEDAD PERUANA DE DERECHO AMBIENTAL
		    </p>
			<?php
			}
			?>
			<br>
			<?php 
			if($datos->idioma=="es"){
			?>
			<img src="img/scotiabank.png" height="25px" />
		    <p>
			<?php texto('Cuenta Soles','Soles Account') ?>: 00-031-106-0109-24<br>
		    	CCI: 009-031-000106010924-64
		    </p>
			<?php
			}
			?>
		</div>
		<div id="payu" >
		   <h3><?php texto('PAGOS ONLINE','ONLINE PAYMENTS') ?>:</h3>
		   <br>
		   <img src="img/payu.png" height="25px" />
		    <p>		   



				<div><?php texto('Adoptar 1 árbol','Adopt 1 tree') ?></div> 
				<!--div class="donar">
					<form target="_parent" method="post" action="https://gateway.payulatam.com/ppp-web-gateway/pb.zul" accept-charset="UTF-8">
					  <input type="image" border="0" alt="" src="https://reforesta.pe/img/RxN_Dona-2<?php texto('','_en') ?>.png" onClick="this.form.urlOrigen.value = window.location.href;"/>
					  <input name="buttonId" type="hidden" value="kIjRRJLwRuYxAwTaZM3gvUNiKFXACNWyp8doy5wNTFfcDLxeq0dipw=="/>
					  <input name="merchantId" type="hidden" value="757235"/>
					  <input name="accountId" type="hidden" value="763139"/>
					  <input name="description" type="hidden" value="Adopción de un árbol nativo en Perú"/>
					  <input name="referenceCode" type="hidden" value="A0001"/>
					  <input name="amount" type="hidden" value="20.00"/>
					  <input name="tax" type="hidden" value="0.00"/>
					  <input name="taxReturnBase" type="hidden" value="0.00"/>
					  <input name="shipmentValue" value="0.00" type="hidden"/>
					  <input name="currency" type="hidden" value="USD"/>
					  <input name="lng" type="hidden" value="es"/>
					  <input name="displayBuyerComments" type="hidden" value="true"/>
					  <input name="sourceUrl" id="urlOrigen" value="" type="hidden"/>
					  <input name="buttonType" value="SIMPLE" type="hidden"/>
					  <input name="signature" value="aa9aef6b9d0367b1a043ab7974e78de6a17b184d8d8ebc3d8059e564886d2857" type="hidden"/>
					
					</form>			
				</div-->
				<div class="donar">
						<form target="_parent" method="post" action="<?php echo $datos->url; ?>" accept-charset="UTF-8">
							<input type="image" src="https://reforesta.pe/img/RxN_Dona-2<?php texto('','_en') ?>.png"/>
							
							<input name="merchantId" type="hidden" value="<?php echo $datos->merchantId; ?>">
							<input name="accountId" type="hidden" value="<?php echo $datos->accountId; ?>"/>
							
							<input name="description" type="hidden" value="<?php texto('Adopción de 1 árboles nativos en Perú','Adoption of 1 native trees in Peru') ?>"/>  
							<input name="referenceCode" type="hidden" value="<?php echo $datos->referencia; ?>"/>	
							<input name="amount" type="hidden" value="<?php echo $datos->precio1; ?>"/>
							<input name="tax" type="hidden" value="0.00"/>
							<input name="taxReturnBase" type="hidden" value="0.00"/>
							<input name="currency" type="hidden" value="<?php echo $datos->moneda; ?>"/>
							<input name="responseUrl"    type="hidden"  value="http://reforesta.pe/response" >

							<input name="shipmentValue" value="0.00" type="hidden"/>
							<input name="displayBuyerComments" type="hidden" value="true"/>
							<input name="sourceUrl" id="urlOrigen" value="" type="hidden"/>
							<input name="buttonType" value="SIMPLE" type="hidden"/>
							<input name="signature" value="<?php echo $datos->signature1; ?>" type="hidden"/>

							<input name="lng" value="<?php echo $datos->idioma; ?>" type="hidden"/>
							<input name="test" type="hidden" value="<?php echo $datos->test; ?>"/>
						</form>
					</div>



		    	<div><?php texto('Adoptar 2 árboles','Adopt 2 trees') ?></div>
				<!--div class="donar">
					<form target="_parent" method="post" action="https://gateway.payulatam.com/ppp-web-gateway/pb.zul" accept-charset="UTF-8">
					  <input type="image" border="0" alt="" src="https://reforesta.pe/img/RxN_Dona-2<?php texto('','_en') ?>.png" onClick="this.form.urlOrigen.value = window.location.href;"/>
					  <input name="buttonId" type="hidden" value="rhMcpRiqIrsfzMw7Sld4bf3Bj4uV9L1s3cxRQTb3V094vIcBp8HomQ=="/>
					  <input name="merchantId" type="hidden" value="757235"/>
					  <input name="accountId" type="hidden" value="763139"/>
					  <input name="description" type="hidden" value="Adopción de dos árboles nativos en Perú"/>
					  <input name="referenceCode" type="hidden" value="A0002"/>
					  <input name="amount" type="hidden" value="40.00"/>
					  <input name="tax" type="hidden" value="0.00"/>
					  <input name="taxReturnBase" type="hidden" value="0.00"/>
					  <input name="shipmentValue" value="0.00" type="hidden"/>
					  <input name="currency" type="hidden" value="USD"/>
					  <input name="lng" type="hidden" value="es"/>
					  <input name="displayBuyerComments" type="hidden" value="true"/>
					  <input name="sourceUrl" id="urlOrigen" value="" type="hidden"/>
					  <input name="buttonType" value="SIMPLE" type="hidden"/>
					  <input name="signature" value="7ee2fa7db3827d666ca6d590cbead84cceb777f508c87f436c71902336748aed" type="hidden"/>
					</form>				
				</div-->
				<div class="donar">
					<form target="_parent" method="post" action="<?php echo $datos->url; ?>" accept-charset="UTF-8">
						<input type="image" src="https://reforesta.pe/img/RxN_Dona-2<?php texto('','_en') ?>.png"/>
						
						<input name="merchantId" type="hidden" value="<?php echo $datos->merchantId; ?>">
						<input name="accountId" type="hidden" value="<?php echo $datos->accountId; ?>"/>
						
						<input name="description" type="hidden" value="<?php texto('Adopción de 2 árboles nativos en Perú','Adoption of 2 native trees in Peru') ?>"/>  
						<input name="referenceCode" type="hidden" value="<?php echo $datos->referencia; ?>"/>	
						<input name="amount" type="hidden" value="<?php echo $datos->precio2; ?>"/>
						<input name="tax" type="hidden" value="0.00"/>
						<input name="taxReturnBase" type="hidden" value="0.00"/>
						<input name="currency" type="hidden" value="<?php echo $datos->moneda; ?>"/>
						<input name="responseUrl"    type="hidden"  value="http://reforesta.pe/response" >

						<input name="shipmentValue" value="0.00" type="hidden"/>
						<input name="displayBuyerComments" type="hidden" value="true"/>
						<input name="sourceUrl" id="urlOrigen" value="" type="hidden"/>
						<input name="buttonType" value="SIMPLE" type="hidden"/>
						<input name="signature" value="<?php echo $datos->signature2; ?>" type="hidden"/>

						<input name="lng" value="<?php echo $datos->idioma; ?>" type="hidden"/>
						<input name="test" type="hidden" value="<?php echo $datos->test; ?>"/>
					</form>
				</div>






				<div><?php texto('Adoptar 5 árboles','Adopt 5 trees') ?></div>
				<!--div class="donar">
					<form target="_parent" method="post" action="https://gateway.payulatam.com/ppp-web-gateway/pb.zul" accept-charset="UTF-8">
					  <input type="image" border="0" alt="" src="https://reforesta.pe/img/RxN_Dona-2<?php texto('','_en') ?>.png" onClick="this.form.urlOrigen.value = window.location.href;"/>
					  <input name="buttonId" type="hidden" value="KHCbLX6iMpWxdpUQ5Ca3M1idkIlVeIafBxMEWbK238Gh4pNyvF6MUQ=="/>
					  <input name="merchantId" type="hidden" value="757235"/>
					  <input name="accountId" type="hidden" value="763139"/>
					  <input name="description" type="hidden" value="Adopción de 5 árboles nativos en Perú"/>
					  <input name="referenceCode" type="hidden" value="A0005"/>
					  <input name="amount" type="hidden" value="100.00"/>
					  <input name="tax" type="hidden" value="0.00"/>
					  <input name="taxReturnBase" type="hidden" value="0.00"/>
					  <input name="shipmentValue" value="0.00" type="hidden"/>
					  <input name="currency" type="hidden" value="USD"/>
					  <input name="lng" type="hidden" value="es"/>
					  <input name="displayBuyerComments" type="hidden" value="true"/>
					  <input name="sourceUrl" id="urlOrigen" value="" type="hidden"/>
					  <input name="buttonType" value="SIMPLE" type="hidden"/>
					  <input name="signature" value="dd7e806a8f695aa48fcd27aa28c914c53b8855847d8b43901b0e194262273935" type="hidden"/>
					</form>
				</div-->
				<div class="donar">
					<form target="_parent" method="post" action="<?php echo $datos->url; ?>" accept-charset="UTF-8">
						<input type="image" src="https://reforesta.pe/img/RxN_Dona-2<?php texto('','_en') ?>.png"/>
						
						<input name="merchantId" type="hidden" value="<?php echo $datos->merchantId; ?>">
						<input name="accountId" type="hidden" value="<?php echo $datos->accountId; ?>"/>
						
						<input name="description" type="hidden" value="<?php texto('Adopción de 5 árboles nativos en Perú','Adoption of 5 native trees in Peru') ?>"/>  
						<input name="referenceCode" type="hidden" value="<?php echo $datos->referencia; ?>"/>	
						<input name="amount" type="hidden" value="<?php echo $datos->precio3; ?>"/>
						<input name="tax" type="hidden" value="0.00"/>
						<input name="taxReturnBase" type="hidden" value="0.00"/>
						<input name="currency" type="hidden" value="<?php echo $datos->moneda; ?>"/>
						<input name="responseUrl"    type="hidden"  value="http://reforesta.pe/response" >

						<input name="shipmentValue" value="0.00" type="hidden"/>
						<input name="displayBuyerComments" type="hidden" value="true"/>
						<input name="sourceUrl" id="urlOrigen" value="" type="hidden"/>
						<input name="buttonType" value="SIMPLE" type="hidden"/>
						<input name="signature" value="<?php echo $datos->signature3; ?>" type="hidden"/>

						<input name="lng" value="<?php echo $datos->idioma; ?>" type="hidden"/>
						<input name="test" type="hidden" value="<?php echo $datos->test; ?>"/>

					</form>
				</div>




				<div><?php texto('Adoptar 10 árboles','Adopt 10 trees') ?></div>
				<!--div class="donar">
					<form target="_parent" method="post" action="https://gateway.payulatam.com/ppp-web-gateway/pb.zul" accept-charset="UTF-8">
					  <input type="image" border="0" alt="" src="https://reforesta.pe/img/RxN_Dona-2<?php texto('','_en') ?>.png" onClick="this.form.urlOrigen.value = window.location.href;"/>
					  <input name="buttonId" type="hidden" value="1FpuhYutdh/GN5QlF2AwRY5moD5GpsVe081uxJ/5qQFCBusro+7UuA=="/>
					  <input name="merchantId" type="hidden" value="757235"/>
					  <input name="accountId" type="hidden" value="763139"/>
					  <input name="description" type="hidden" value="Adopción de 10 árboles nativos en Perú"/>
					  <input name="referenceCode" type="hidden" value="A0010"/>
					  <input name="amount" type="hidden" value="200.00"/>
					  <input name="tax" type="hidden" value="0.00"/>
					  <input name="taxReturnBase" type="hidden" value="0.00"/>
					  <input name="shipmentValue" value="0.00" type="hidden"/>
					  <input name="currency" type="hidden" value="USD"/>
					  <input name="lng" type="hidden" value="es"/>
					  <input name="displayBuyerComments" type="hidden" value="true"/>
					  <input name="sourceUrl" id="urlOrigen" value="" type="hidden"/>
					  <input name="buttonType" value="SIMPLE" type="hidden"/>
					  <input name="signature" value="59e96036e05efda501860623bd8e1b2395ae38b70d4dc7bf211a9632a09d693b" type="hidden"/>
					</form>
				</div-->
				<div class="donar">
					<form target="_parent" method="post" action="<?php echo $datos->url; ?>" accept-charset="UTF-8">
						<input type="image" src="https://reforesta.pe/img/RxN_Dona-2<?php texto('','_en') ?>.png"/>
						
						<input name="merchantId" type="hidden" value="<?php echo $datos->merchantId; ?>">
						<input name="accountId" type="hidden" value="<?php echo $datos->accountId; ?>"/>
						
						<input name="description" type="hidden" value="<?php texto('Adopción de 10 árboles nativos en Perú','Adoption of 10 native trees in Peru') ?>"/>  
						<input name="referenceCode" type="hidden" value="<?php echo $datos->referencia; ?>"/>	
						<input name="amount" type="hidden" value="<?php echo $datos->precio4; ?>"/>
						<input name="tax" type="hidden" value="0.00"/>
						<input name="taxReturnBase" type="hidden" value="0.00"/>
						<input name="currency" type="hidden" value="<?php echo $datos->moneda; ?>"/>
						<input name="responseUrl"    type="hidden"  value="http://reforesta.pe/response" >

						<input name="shipmentValue" value="0.00" type="hidden"/>
						<input name="displayBuyerComments" type="hidden" value="true"/>
						<input name="sourceUrl" id="urlOrigen" value="" type="hidden"/>
						<input name="buttonType" value="SIMPLE" type="hidden"/>
						<input name="signature" value="<?php echo $datos->signature4; ?>" type="hidden"/>

						<input name="lng" value="<?php echo $datos->idioma; ?>" type="hidden"/>
						<input name="test" type="hidden" value="<?php echo $datos->test; ?>"/>
					</form>
				</div>



				
				
				
				
				
				
				
					<div style="display:none">
					<div><?php texto('Adoptar 1 árboles','Adopt 1 tree') ?></div>
					<div class="donar">
						<form target="_parent" method="post" action="<?php echo $datos->url; ?>" accept-charset="UTF-8">
							<input type="image" src="https://reforesta.pe/img/RxN_Dona-2<?php texto('','_en') ?>.png"/>
							
							<input name="merchantId" type="hidden" value="<?php echo $datos->merchantId; ?>">
							<input name="accountId" type="hidden" value="<?php echo $datos->accountId; ?>"/>
							
							<input name="description" type="hidden" value="<?php texto('Adopción de 1 árboles nativos en Perú','Adoption of 1 native trees in Peru') ?>"/>  
							<input name="referenceCode" type="hidden" value="<?php echo $datos->referencia; ?>"/>	
							<input name="amount" type="hidden" value="<?php echo $datos->precio1; ?>"/>
							<input name="tax" type="hidden" value="0.00"/>
							<input name="taxReturnBase" type="hidden" value="0.00"/>
							<input name="currency" type="hidden" value="<?php echo $datos->moneda; ?>"/>
							<input name="responseUrl"    type="hidden"  value="http://reforesta.pe/response" >

							<input name="shipmentValue" value="0.00" type="hidden"/>
							<input name="displayBuyerComments" type="hidden" value="true"/>
							<input name="sourceUrl" id="urlOrigen" value="" type="hidden"/>
							<input name="buttonType" value="SIMPLE" type="hidden"/>
							<input name="signature" value="<?php echo $datos->signature1; ?>" type="hidden"/>

							<input name="lng" value="<?php echo $datos->idioma; ?>" type="hidden"/>
							<input name="test" type="hidden" value="<?php echo $datos->test; ?>"/>
						</form>
					</div>



					<div><?php texto('Adoptar 2 árboles','Adopt 2 tree') ?></div>
					<div class="donar">
						<form target="_parent" method="post" action="<?php echo $datos->url; ?>" accept-charset="UTF-8">
							<input type="image" src="https://reforesta.pe/img/RxN_Dona-2<?php texto('','_en') ?>.png"/>
							
							<input name="merchantId" type="hidden" value="<?php echo $datos->merchantId; ?>">
							<input name="accountId" type="hidden" value="<?php echo $datos->accountId; ?>"/>
							
							<input name="description" type="hidden" value="<?php texto('Adopción de 2 árboles nativos en Perú','Adoption of 2 native trees in Peru') ?>"/>  
							<input name="referenceCode" type="hidden" value="<?php echo $datos->referencia; ?>"/>	
							<input name="amount" type="hidden" value="<?php echo $datos->precio2; ?>"/>
							<input name="tax" type="hidden" value="0.00"/>
							<input name="taxReturnBase" type="hidden" value="0.00"/>
							<input name="currency" type="hidden" value="<?php echo $datos->moneda; ?>"/>
							<input name="responseUrl"    type="hidden"  value="http://reforesta.pe/response" >

							<input name="shipmentValue" value="0.00" type="hidden"/>
							<input name="displayBuyerComments" type="hidden" value="true"/>
							<input name="sourceUrl" id="urlOrigen" value="" type="hidden"/>
							<input name="buttonType" value="SIMPLE" type="hidden"/>
							<input name="signature" value="<?php echo $datos->signature2; ?>" type="hidden"/>

							<input name="lng" value="<?php echo $datos->idioma; ?>" type="hidden"/>
							<input name="test" type="hidden" value="<?php echo $datos->test; ?>"/>
						</form>
					</div>




					<div><?php texto('Adoptar 3 árboles','Adopt 3 tree') ?></div>
					<div class="donar">
						<form target="_parent" method="post" action="<?php echo $datos->url; ?>" accept-charset="UTF-8">
							<input type="image" src="https://reforesta.pe/img/RxN_Dona-2<?php texto('','_en') ?>.png"/>
							
							<input name="merchantId" type="hidden" value="<?php echo $datos->merchantId; ?>">
							<input name="accountId" type="hidden" value="<?php echo $datos->accountId; ?>"/>
							
							<input name="description" type="hidden" value="<?php texto('Adopción de 3 árboles nativos en Perú','Adoption of 3 native trees in Peru') ?>"/>  
							<input name="referenceCode" type="hidden" value="<?php echo $datos->referencia; ?>"/>	
							<input name="amount" type="hidden" value="<?php echo $datos->precio3; ?>"/>
							<input name="tax" type="hidden" value="0.00"/>
							<input name="taxReturnBase" type="hidden" value="0.00"/>
							<input name="currency" type="hidden" value="<?php echo $datos->moneda; ?>"/>
							<input name="responseUrl"    type="hidden"  value="http://reforesta.pe/response" >

							<input name="shipmentValue" value="0.00" type="hidden"/>
							<input name="displayBuyerComments" type="hidden" value="true"/>
							<input name="sourceUrl" id="urlOrigen" value="" type="hidden"/>
							<input name="buttonType" value="SIMPLE" type="hidden"/>
							<input name="signature" value="<?php echo $datos->signature3; ?>" type="hidden"/>

							<input name="lng" value="<?php echo $datos->idioma; ?>" type="hidden"/>
							<input name="test" type="hidden" value="<?php echo $datos->test; ?>"/>

						</form>
					</div>



					<div><?php texto('Adoptar 4 árboles','Adopt 4 tree') ?></div>
					<div class="donar">
						<form target="_parent" method="post" action="<?php echo $datos->url; ?>" accept-charset="UTF-8">
							<input type="image" src="https://reforesta.pe/img/RxN_Dona-2<?php texto('','_en') ?>.png"/>
							
							<input name="merchantId" type="hidden" value="<?php echo $datos->merchantId; ?>">
							<input name="accountId" type="hidden" value="<?php echo $datos->accountId; ?>"/>
							
							<input name="description" type="hidden" value="<?php texto('Adopción de 4 árboles nativos en Perú','Adoption of 4 native trees in Peru') ?>"/>  
							<input name="referenceCode" type="hidden" value="<?php echo $datos->referencia; ?>"/>	
							<input name="amount" type="hidden" value="<?php echo $datos->precio4; ?>"/>
							<input name="tax" type="hidden" value="0.00"/>
							<input name="taxReturnBase" type="hidden" value="0.00"/>
							<input name="currency" type="hidden" value="<?php echo $datos->moneda; ?>"/>
							<input name="responseUrl"    type="hidden"  value="http://reforesta.pe/response" >

							<input name="shipmentValue" value="0.00" type="hidden"/>
							<input name="displayBuyerComments" type="hidden" value="true"/>
							<input name="sourceUrl" id="urlOrigen" value="" type="hidden"/>
							<input name="buttonType" value="SIMPLE" type="hidden"/>
							<input name="signature" value="<?php echo $datos->signature4; ?>" type="hidden"/>

							<input name="lng" value="<?php echo $datos->idioma; ?>" type="hidden"/>
							<input name="test" type="hidden" value="<?php echo $datos->test; ?>"/>
						</form>
					</div>
				</div>







				<div style="display:none">Adoptar test</div>
				<div style="display:none" class="donar">
					<form target="_parent" method="post" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/" accept-charset="UTF-8">
						<input type="image" src="https://reforesta.pe/img/RxN_Dona-2<?php texto('','_en') ?>.png"/>
						
						<input name="merchantId" type="hidden" value="508029">
						<input name="accountId" type="hidden" value="512323"/>
						
						<input name="description" type="hidden" value="<?php texto('Adopción de 10 árboles nativos en Perú','Adoption of 10 native trees in Peru') ?>"/>  
						<input name="referenceCode" type="hidden" value="<?php echo $datos->referencia; ?>"/>	
						<input name="amount" type="hidden" value="<?php echo $datos->precio1; ?>"/>
						<input name="tax" type="hidden" value="0.00"/>
						<input name="taxReturnBase" type="hidden" value="0.00"/>
						<input name="currency" type="hidden" value="<?php echo $datos->moneda; ?>"/>
						<input name="responseUrl"    type="hidden"  value="http://reforesta.pe/response" >

						<input name="shipmentValue" value="0.00" type="hidden"/>
						<input name="lng" type="hidden" value="es"/>
						<input name="displayBuyerComments" type="hidden" value="true"/>
						<input name="sourceUrl" id="urlOrigen" value="" type="hidden"/>
						<input name="buttonType" value="SIMPLE" type="hidden"/>
						<input name="signature" value="<?php echo $datos->signature1; ?>" type="hidden"/>
					</form>
				</div>







		    </p>		   
		</div>
		<div class="confirm-message">
				<br>
		</div>
	</body>
</html>

