<?php 

require 'phpMailer/PHPMailerAutoload.php'; 

class Mail {

	public function __construct(){

        $this->mail = new PHPMailer;
        $this->mail->isSMTP();    
        //$this->mail->Host = 'smtp.mandrillapp.com';
        $this->mail->Host = 'gator4054.hostgator.com';
		$this->mail->SMTPAuth = true;                            
		//$this->mail->Username = 'brunomonteferri@gmail.com';       
		$this->mail->Username = 'reforesta@conservamos.org'; 
		$this->mail->Password = 'NaranjaLima10';                    
		$this->mail->SMTPSecure = 'ssl';                            
		$this->mail->Port = 465;    
		$this->mail->CharSet = 'UTF-8';

    }
    public function get_include_contents($filename, $variablesToMakeLocal) {
	    extract($variablesToMakeLocal);
	    if (is_file($filename)) {
	        ob_start();
	        include $filename;
	        return ob_get_clean();
	    }
	    return false;
	} 
  
    public function send($toMail, $toName, $mailTemplate, $url){

    	$this->mail->From = 'reforesta@conservamos.org';
		$this->mail->FromName = 'Conservamos Por Naturaleza';
		$this->mail->addAddress($toMail, $toName);  
		$this->mail->isHTML(true);                                

		$this->mail->Subject = 'GRACIAS POR SEMBRAR VIDA Y ESPERANZA';
		$this->mail->AltBody = "Gracias por sembrar vida y esperanza.";
		$this->mail->Body    = $this->get_include_contents('mailing/' . $mailTemplate, array("toName" => $toName, "urlCertificado" => $url ));
		
        //print_r($this->mail->Body);
        //exit();
		return $this->mail->send();

    }	

	public function sendCodigo($toMail, $toName, $mailTemplate, $cantidad, $codigo){ 
		//////////////////////////////////////
    	$this->mail->From = 'reforesta@conservamos.org';
		$this->mail->FromName = 'Conservamos Por Naturaleza';
		$this->mail->addAddress($toMail, $toName);  
		$this->mail->isHTML(true);
		//////////////////////////////////////
		if($mailTemplate=="envioCodigoEs.php"){
			$this->mail->Subject = 'Este es tu código Reforestamos por Naturaleza 🌲';
			$this->mail->AltBody = "Este es tu código Reforestamos por Naturaleza. 🌲";
		}else{
			$this->mail->Subject = 'This is your code We reforest by Nature 🌲';
			$this->mail->AltBody = "This is your code We reforest by Nature. 🌲";
		}
		///////////////////////////////////////
		$this->mail->Body    = $this->get_include_contents('mailing/' . $mailTemplate, array("toName" => $toName, "cantidad" => $cantidad, "codigo" => $codigo ));
		///////////////////////////////////////

        //print_r($this->mail->Body);
        //exit("a");
		return $this->mail->send();
    }	


}