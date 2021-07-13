<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

include('lumen/vendor/mailing/MailChimp.php');
include('lumen/vendor/mailing/Mail.php');

use DrewM\MailChimp\MailChimp;

class HomeController extends Controller
{
    //Produccion
    private $apikey="UK1KZTe4J114M9HBNJy1CC0R5S";
    private $merchantId="757235";
    private $accountId="763139";
    private $url="https://checkout.payulatam.com/ppp-web-gateway-payu/";
    private $test="0";


    //Desarrollo    
    /*
    private $apikey="4Vj8eK4rloUd272L48hsrarnUA";
    private $merchantId="508029";
    private $accountId="512323";
    private $url="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/"
    */
    //private $test="1";

    
    /**

     * Show the profile for the given user.

     *

     * @param  int  $id

     * @return Response

     */

    public function home()

    {

        $url=URL::current();
        $pos = strrpos($url, "/en");

        $idioma="en";
        if ($pos === false) {
            $idioma="es";
        }
        $precio=25;
        if($idioma=="es"){
            $precio=25;
        }
        
        $cantidad = DB::table("cantidad_arboles_adoptados")->get();

        $website = DB::table("website")->orderBy('id')->get() ;

        $noticias = DB::table("noticias")->get();

        $areas = DB::table("areas")->get();

        return view('home', ['num_arboles' => $cantidad[0]->cantidad, 'precio'=>$precio, 'website' => $website, 'noticias' => $noticias, 'areas' => $areas, 'idioma' => $idioma ]);

    }public function semillas()

    {
        $url=URL::current();
        $pos = strrpos($url, "/en");

        $idioma="en";
        if ($pos === false) {
            $idioma="es";
        }
        $precio=25;
        if($idioma=="es"){
            $precio=25;
        }
        $cantidad = DB::table("cantidad_arboles_adoptados")->get();

        $website = DB::table("website")->orderBy('id')->get() ;

        $noticias = DB::table("noticias")->get();

        $areas = DB::table("areas")->get();
        return view('home', ['num_arboles' => $cantidad[0]->cantidad, 'precio'=>$precio, 'website' => $website, 'noticias' => $noticias, 'areas' => $areas, 'idioma' => $idioma ]);
     
    }
    public function faq()

    {

        $url=URL::current();
        $pos = strrpos($url, "/en");

        $idioma="en";
        if ($pos === false) {
            $idioma="es";
        }

        $website = DB::table("website")->orderBy('id')->get() ;

        return view('faq', ['website' => $website, 'idioma' => $idioma ]);

    }
    public function politicas()

    {

        $url=URL::current();
        $pos = strrpos($url, "/en");

        $idioma="en";
        if ($pos === false) {
            $idioma="es";
        }

        $website = DB::table("website")->orderBy('id')->get() ;

        return view('politicas', ['website' => $website , 'idioma' => $idioma ]);

    }
    public function subscribe(Request $request)

    {

        $api_key = 'c6d04cc103ce31589edaf45dd8d035d7-us3';

        $list_id = '5de289d7a1';



        $MailChimp = new MailChimp($api_key);

        //print_r($MailChimp);



        $result = $MailChimp->post("lists/$list_id/members", [

            'email_address' => $_POST["email"],

            'merge_fields'  => ['FNAME' => $_POST["fname"], 'LNAME' => $_POST["lname"]],

            'status'        => 'pending',

        ]);

        if ($result["title"]) {

            if ($result["title"] == "Member Exists") {

                echo json_encode(array("success" => 0, "message" => "<h4>Usted ya se encuentra suscrito a la comunidad.</h4>"));

            }

        } elseif ($MailChimp->success()) {

            echo json_encode(array("success" => 1, "message" => "<h4>Gracias por unirte a la comunidad.</h4>"));

        } else {

            echo json_encode(array("success" => 0, "message" => "<h4>Lo sentimos, hubo un error, por favor inténtalo de nuevo.</h4>"));

        }

    }


    public function datos(){
        $url=URL::current();
        $pos = strrpos($url, "/en");

        $datos = new \stdClass();
        $datos->idioma = "en";
        $datos->moneda = "USD";
        $datos->precio1 = "20.00";
        $datos->precio2 = "40.00";
        $datos->precio3 = "100.00";
        $datos->precio4 = "200.00";
        
        if ($pos === false) {

            $datos->idioma = "es";
            $datos->moneda="PEN";
            $datos->precio1="50.00";
            $datos->precio2="100.00";
            $datos->precio3="250.00";
            $datos->precio4="500.00";
        }
        
        $fecha = new \DateTime();
        $codigo = $fecha->getTimestamp();
        $website = DB::table("website")->orderBy('id')->get() ;

        $datos->referencia="A".$codigo;
        $datos->accountId=$this->accountId;
        $datos->merchantId=$this->merchantId;  
        $datos->url=$this->url;
        $datos->test=$this->test;

        $datos->signature1 = md5( $this->apikey . "~" . $this->merchantId . "~" . $datos->referencia . "~" . $datos->precio1 . "~" . $datos->moneda );
        $datos->signature2 = md5( $this->apikey . "~" . $this->merchantId . "~" . $datos->referencia . "~" . $datos->precio2 . "~" . $datos->moneda );
        $datos->signature3 = md5( $this->apikey . "~" . $this->merchantId . "~" . $datos->referencia . "~" . $datos->precio3 . "~" . $datos->moneda );
        $datos->signature4 = md5( $this->apikey . "~" . $this->merchantId . "~" . $datos->referencia . "~" . $datos->precio4 . "~" . $datos->moneda );
        //$datos->signature1 = ( $apikey . "~" . $merchantId . "~" . $datos->referencia . "~" . $datos->precio1 . "~" . $datos->moneda );
        
        return view('datos_cuenta', ['website' => $website , 'datos' => $datos ]);
    }

    public function response(Request $request){
       
        DB::table("pruebas")
                ->insert([
                    'nombre' => 'Elvis',
                    'detalle' => $request->getContent()
                ]);


        $newValor=substr($request->value, 0, strlen($request->value)-1);
        $firma = md5( $this->apikey . "~" . $this->merchantId . "~" . $request->reference_sale . "~" . $newValor . "~" . $request->currency . "~" . "4");
        //$firma = md5( $this->apikey . "~" . $this->merchantId . "~" . $request->reference_sale . "~" . $newValor . "~" . $request->currency . "~" . $request->state_pol);
        $codigosValor="";
        
        if( $firma == $request->sign){
            //envio de correo

            $mailTemplate = "envioCodigoEs.php";
            $cantidad=intval ($newValor)/50;
            $idioma=0;
            if ($request->currency == "USD") {
                $idioma=1;
                $mailTemplate = "envioCodigoEn.php";
                $cantidad=intval ($newValor)/20;
            }
            ////////////////////////////////////////////////
            ////////////////////////////////////////////////
            //obtener codigos
            $codigos = DB::table("codigos_con_estado_uso")
                ->where('campania',"CXN2020")
                ->where('estado',0)
                ->where('reserva',0)
                ->limit($cantidad)
                ->get();
            
            
            foreach ($codigos as &$codigo) {

                /* */
                DB::table("codigos")
                ->where('id',$codigo->id)
                ->update([
                    'reserva' => '1',
                    'idioma' => $idioma,
                    'pago_merchant' => $this->merchantId,
                    'pago_code' => $request->reference_sale,
                    'pago_value' => $newValor,
                    'pago_currency' => $request->currency,
                    'pago_email' => $request->email_buyer,
                    'pago_date' => $request->transaction_date
                    ]
                );
                /**/

                $codigosValor=$codigosValor.$codigo->codigo.",<br>";
            } 
            $codigosValor=substr($codigosValor,0,strlen($codigosValor)-5);
            /////////////////////////////////////////////////
            /////////////////////////////////////////////////

            //exit($codigosValor);
            //return $files;
            //exit();

            $mail = new \Mail();
            $envio=$mail->sendCodigo($request->email_buyer, $request->cc_holder, $mailTemplate, $cantidad, $codigosValor );

            ////////////////////////////////////////////////


            //echo "correcto";
        }else{
            //echo "error";
        }

        DB::table("log_pagos")
                ->insert([
                    'merchant' => $this->merchantId,
                    'code' => $request->reference_sale,
                    'value' => $newValor,
                    'currency' => $request->currency,
                    'email' => $request->email_buyer,
                    'date' => $request->transaction_date,
                    'estado' => $request->state_pol,
                    'codigos' => $codigosValor
                ]);
        
        //return $request->all();
        exit();
    }



    
}

