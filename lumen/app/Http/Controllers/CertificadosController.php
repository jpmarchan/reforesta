<?php

namespace App\Http\Controllers;

use App\Arboles;
use App\CertificadosCampanias;
use App\Codigos;
use App\Exports\CertificadosExportar;
use App\Imports\UsuariosImportar;
use App\Usuarios;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\DB; 
use Maatwebsite\Excel\Facades\Excel;
use DateTime;
use Exception;

use Illuminate\Support\Facades\URL;

include('lumen/vendor/mailing/Mail.php');

class CertificadosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        if ($request->accion == 'xls') {
            //for xls
            ob_end_clean(); 
            return Excel::download(new CertificadosExportar(json_encode($request->all())), 'certificados.xls')->deleteFileAfterSend(false);
        } elseif ($request->accion == 'pdf') {
            //return Excel::download(new CertificadosExportar(json_encode($request->all())), 'certificados.xls');
            $buscar = $request->buscar;
            $codigos = DB::table('certificados');
            $codigos=$codigos->where(function($query) use($buscar){
                $query->where('nombre', 'like', '%' . $buscar . '%')
                ->orWhere('apellido', 'like', '%' . $buscar . '%')
                ->orWhere('nombre_certificado', 'like', '%' . $buscar . '%');
            });
            if ($request->area) {
                $codigos=$codigos->where('codigo', 'like', $request->area."%" );
            }            
            if ($request->campana) {
                $codigos=$codigos->where('campania', 'like' , $request->campana);
            }
            if ($request->desde) {
                $codigos=$codigos->where('created_at', '>=' , $request->desde);
            }
            if ($request->hasta) {
                $codigos=$codigos->where('created_at', '<=' , $request->hasta);
            }
            $codigos=$codigos->get();
            $cabecera="<tr><th>Nro.</th><th style='width:80px'>DNI / RUC</th><th>Nombre</th><th>Apellidos</th><th>Nombre Certificado</th><th>Link</th></tr>";
            $items="";
            $contado=0;
            foreach ($codigos as $codigo) {
                $contado++;
                $class="tg-0lax";
                if ($contado%2==0){
                    $class="tg-sjuo";
                }
                $items.='<tr>';
                $items.='<td class="'.$class.'">'.$contado.'</td>';
                $items.='<td class="'.$class.'">'.$codigo->dni.'</td>';
                $items.='<td class="'.$class.'">'.$codigo->nombre.'</td>';
                $items.='<td class="'.$class.'">'.$codigo->apellido.'</td>';
                $items.='<td class="'.$class.'">'.$codigo->nombre_certificado.'</td>';
                $items.='<td class="'.$class.'"><a href="https://reforesta.pe/api/v1/certificados/image?id='.$codigo->id.'&arbol='.$codigo->id_arbol.'&show=1">Descargar</a></td>';
                $items.='</tr>';
            }
            //print_r (($items));
            //exit();
            
            $html='<style type="text/css"> .tg  {border-collapse:collapse;border-color:#bbb;border-spacing:0; width:100%} .tg td{background-color:#E0FFEB;border-color:#bbb;border-style:solid;border-width:1px;color:#594F4F; font-family:Arial, sans-serif;font-size:14px;overflow:hidden;padding:10px 5px;word-break:normal;} .tg th{background-color:#9DE0AD;border-color:#bbb;border-style:solid;border-width:1px;color:#493F3F; font-family:Arial, sans-serif;font-size:14px;font-weight:600;overflow:hidden;padding:10px 5px;word-break:normal;} .tg .tg-0lax{text-align:left;vertical-align:top} .tg .tg-sjuo{background-color:#C2FFD6;text-align:left;vertical-align:top} </style><table class="tg">'.$cabecera.$items."</table>";
            //echo $html;

            header("Content-type: application/vnd.ms-word");
            header("Content-Disposition: attachment;Filename=Invoice-.doc");
            print_r($html);

            exit();
            $dompdf = new Dompdf();

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            // Render the HTML as PDF
            $dompdf->render();
            // Output the generated PDF to Browser
            $dompdf->stream();
            # code...
        } else {
            $buscar = $request->buscar;

            $codigos = DB::table('certificados');
            $codigos=$codigos->where(function($query) use($buscar){
                    $query->where('nombre', 'like', '%' . $buscar . '%')
                    ->orWhere('apellido', 'like', '%' . $buscar . '%')
                    ->orWhere('nombre_certificado', 'like', '%' . $buscar . '%');
                });
            if ($request->area) {
                $codigos=$codigos->where('codigo', 'like', $request->area."%" );
            }            
            if ($request->campana) {
                $codigos=$codigos->where('campania', 'like' , $request->campana);
            }
            if ($request->desde) {
                $codigos=$codigos->where('created_at', '>=' , $request->desde);
            }
            if ($request->hasta) {
                $codigos=$codigos->where('created_at', '<=' , $request->hasta);
            }
            $codigos=$codigos->paginate($request->paginado);
            
            return response()->json($codigos);
        }
    }
    public function subir(Request $request)
    {
        $path = $request->file('file')->storeAs(
            'files_importar',
            'certificados.xlsx'
        );
        return response()->json(['status' => 'success', 'data' => $path]);
    }
    public function importar()
    {
        
        try {
            ob_clean();
            $response = Excel::import(new UsuariosImportar, 'files_importar\certificados.xlsx');  

            DB::table('arboles')
            ->where('status',2)
            ->update(['status' => 1]);

            return response()->json(['status' => 'success']);
        } catch (Exception $e) {
            DB::table('arboles')
            ->where('status',2)
            ->update(['status' => 0]);

            throw new Exception( $e->getMessage() );

            //return response()->json(['status' => 'error', 'mensaje' => $e->getMessage()]);
        }

        
        //print_r($response);

        //return response()->json(['status' => 'success']);
    }
    public function campanias()
    {
        $campanias = CertificadosCampanias::all();
        return response()->json($campanias);
    }
    public function actualizar(Request $request)
    {
        //print_r("aa");
        //exit();
        $usuario = Usuarios::find($request->id);
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->nombre_certificado = $request->nombre_certificado;
        $usuario->nombre_de = $request->nombre_de;
        $usuario->tipo_certificado = $request->tipo_certificado;
        $usuario->fecha_registro = $request->fecha_registro;
        $usuario->save();

        $arbol = Arboles::find($request->id_arbol);
        $arbol->gps = $request->gps;
        $arbol->save();

        return response()->json(['status' => 'success']);
    }
    public function download_img(Request $request)
    {
        //exit("aa");
        $usuario = Usuarios::find($request->id);        
        if ($request->has('arbol')) {
            if ($usuario->id_arbol != $request->arbol) {
                return response()->json(['status' => 'error']);
            }
        } else {
            return response()->json(['status' => 'error']);
        }
        $arbol = Arboles::find($usuario->id_arbol);
        $codigo = Codigos::find($usuario->id_codigo);
        
        $url = "certificados/" . $arbol->codigo . '_cert.jpg';

        if(file_exists($url) && $request->show=="1"){
            $url= url()."/".$url."?r=".rand();
            print_r("<script>document.location='$url'</script>");
            die();
        }else{       
            
            $datosRender= [            
                "tipo_certificado"=>$usuario->tipo_certificado,
                "nombre_certificado"=>$usuario->nombre_certificado,
                "idioma"=>$codigo->idioma, //viene de codigos
                "nombre"=>$usuario->nombre_de,
                "apellido"=>$usuario->apellido,
                "fecha"=>$usuario->fecha_registro,
                "arbol"=> $arbol,
                "lugar"=>"AMAZONAS, PERÚ"
            ];    
            //print_r($datosRender);
            //exit();
            $prefijo=substr($arbol->codigo, 0, 2);
            $prefijo2=substr($arbol->codigo, 0, 3);
            //exit("a");
            if( $prefijo2!="CHI" && ($prefijo=="LG" ||  $prefijo=="CH" || $prefijo=="LA" || $prefijo=="EP" || $prefijo=="NE" || $prefijo=="TB" || $prefijo=="UL")  ){
                //return response()->json(array("error" => "", "result" => 1,  "certificadoUrl" => $this->renderIMG2($datosRender)));
                if($codigo->idioma==0){
                    $certificadoUrl= $this->renderIMG2($datosRender);
                }else{
                    $certificadoUrl= $this->renderIMG2EN($datosRender);
                }
                
                $url= url()."/".$certificadoUrl."?r=".rand();
                print_r("<script>document.location='$url'</script>");
            }else{
                //return response()->json(array("error" => "", "result" => 1,  "certificadoUrl" => $this->renderIMG($datosRender)));
                $certificadoUrl= $this->renderIMG($datosRender);
                $url= url()."/".$certificadoUrl."?r=".rand();
                print_r("<script>document.location='$url'</script>");
            }
            exit();
           

        }
        
    }
    public function download_pdf(Request $request)
    {
        $usuario = Usuarios::find($request->id);
        if ($request->has('arbol')) {
            if ($usuario->id_arbol != $request->arbol) {
                return response()->json(['status' => 'error']);
            }
        } else {
            return response()->json(['status' => 'error']);
        }
        $arbol = Arboles::find($usuario->id_arbol);
        $codigo = Codigos::find($usuario->id_codigo);
        $urlimg = url() . "/certificados/" . $arbol->codigo . '_cert.jpg';
        $urlpdf = "certificados/" . $arbol->codigo . '_cert.pdf';



        $dompdf = new Dompdf(array('enable_remote' => true));
        $url = 'https://www.google.com/maps/search/' . $arbol->gps;
        $escaped_url = htmlspecialchars($url, ENT_QUOTES | ENT_HTML5);
        ////
        $prefijo=substr($arbol->codigo, 0, 2);
        if($prefijo=="LG" ||  $prefijo=="CH" || $prefijo=="LA" || $prefijo=="EP" || $prefijo=="NE" || $prefijo=="TB" || $prefijo=="UL"  ){
            $dompdf->loadHtml('<html><head><meta charset="utf-8"><style>@page { margin: 0px; } body { margin: 0px; }</style></head><body><img width="2000" height="1414" src="' . $urlimg . '" style="max-width: none; width: 100%, max-height: none; height: 100%, " /><a style="display:block; width: 580px; height: 40px;  position:absolute; top:1250px; left: 400px;" href="' . $escaped_url . '" target="_blank"></a></body></html>');
            // (Optional) Setup the paper size and orientation
            $paper_size = array(0, 0, 2000, 1414);
        }else{
            $dompdf->loadHtml('<html><head><meta charset="utf-8"><style>@page { margin: 0px; } body { margin: 0px; }</style></head><body><img style="max-width:100%" src="' . $urlimg . '" /><a style="display:block; width: 480px; height: 30px;  position:absolute; top:655px; left: 225px;" href="' . $escaped_url . '" target="_blank"></a></body></html>');
            // (Optional) Setup the paper size and orientation
            $paper_size = array(0, 0, 1500, 750);
        }
        ////////////
        $dompdf->setPaper($paper_size);
        //$dompdf->set_paper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        $output = $dompdf->output();
        file_put_contents($urlpdf, $output);

        $url=url() . "/" . $urlpdf;
        
        print_r("<script>document.location='$url'</script>");
        die();
        //return response()->json(['status' => 'success', "pdf" => url() . "/" . $urlpdf]);
    }
    function open_image($file)
    {    
        //$path=realpath('./');        
        //exit();
        if (file_exists($file)) {
            $size = getimagesize($file);
            switch ($size["mime"]) {
                case "image/jpeg":
                    $im = imagecreatefromjpeg($file); //jpeg file
                    break;
                case "image/gif":
                    $im = imagecreatefromgif($file); //gif file
                    break;
                case "image/png":
                    $im = imagecreatefrompng($file); //png file
                    break;
                default:
                    $im = false;
                    break;
            }
            return $im;
        }
        return false;
    }
    function crear(Request $request){
        //print_r( $request->all() ) ;
        
        /**
         * Buscar codigo si existe
         */
        $codigo = DB::table("codigos")
            ->where("codigo","=",$request->codigo)
            ->get();

        if($codigo->count()==0){
            echo json_encode(array("error" => "Este código no existe","result" => 0 ));
		    return;
        }
        /**
         * Si el codigo existe ver si ya se ha usado
         */
        $cantidad = DB::table("usuarios")
            ->where("id_codigo","=",$codigo[0]->id)
            ->count();                    
        if($cantidad==1){
            echo json_encode(array("error" => "Este código ya ha sido usado","result" => 0 ));
		    return;
        }
        /**
         * verificamos si existen arboles
         */
        $arbol=DB::table("arboles")
        ->where("status","=",0)
        ->where("campania","=",$codigo[0]->campania)
        ->get();                    

        if($arbol->count()==0){
            echo json_encode(array("error" => 'Lo sentimos, ya no quedan árboles disponibles.',"result" => 0 ));
		    return;
        }
        
        /**
         * renderimazmos
        */
        $datosRender= [            
            "tipo_certificado"=>$request->para,
            "nombre_certificado"=>$request->nombre_certificado,
            "idioma"=> (!$codigo[0]->idioma) ? 0 : $codigo[0]->idioma,
            "nombre"=>$request->nombre,
            "apellido"=>$request->apellido,
            "fecha"=>$request->fecha,
            "arbol"=>$arbol[0],
            "lugar"=>"AMAZONAS, PERÚ"
        ];
        if($request->de) $datosRender["nombre"]=$request->de;
        
        //echo json_encode(array("error" => "", "result" => 1,  "certificadoUrl" => $this->renderIMG($datosRender)));
        $prefijo=substr($datosRender["arbol"]->codigo, 0, 2);

        if($prefijo=="LG" ||  $prefijo=="CH" || $prefijo=="LA" || $prefijo=="EP" || $prefijo=="NE" || $prefijo=="TB" || $prefijo=="UL"  ){
            
            if($codigo[0]->idioma==1){
                echo json_encode(array("error" => "", "result" => 1,  "certificadoUrl" => $this->renderIMG2EN($datosRender)));
            }else{
                echo json_encode(array("error" => "", "result" => 1,  "certificadoUrl" => $this->renderIMG2($datosRender)));
            }

        }else{
            echo json_encode(array("error" => "", "result" => 1,  "certificadoUrl" => $this->renderIMG($datosRender)));
        }
        exit();
    }

    public function confirmar(Request $request)
    {   

        $url=URL::current();
        $pos = strrpos($url, "/en");

        $idioma="en";
        if ($pos === false) {
            $idioma="es";
        }


        return view('confirmar',['idioma' => $idioma, "request"=>$request->all()]);
    }

    public function renderIMG($datos){
        //print_r($datos["arbol"]->codigo);
        //exit();
        //create white Imagge
        $bg = imagecreatetruecolor(2000, 1000);
        // sets background to white
        $whiteBg = imagecolorallocate($bg, 255, 255, 255);
        imagefill($bg, 0, 0, $whiteBg);
        //bsucar la iamgen del arbol
        $jpg_image = $this->open_image("public/imgCertificados/" . $datos["arbol"]->codigo . ".jpg");        
        //
        if ($datos["idioma"] == 1) {
            $jpg_texture =  $this->open_image("public/plantillas/certificadoLeft" . $datos["tipo_certificado"] . "_en.jpg");
        } else {
            $jpg_texture =  $this->open_image("public/plantillas/certificadoLeft" . $datos["tipo_certificado"] . ".jpg");
        }

        //exit($datos["tipo_certificado"]);
        //exit($datos["arbol"]->codigo);
        $png_borderImage = imagecreatefrompng("public/plantillas/certificadoRight.png");
        $pngBorderWithAlpha = imagecreatetruecolor(1000, 1000);
        imagecolortransparent($pngBorderWithAlpha, imagecolorallocate($pngBorderWithAlpha, 0, 0, 0));
        imagecopyresampled($pngBorderWithAlpha, $png_borderImage, 0, 0, 0, 0, 1000, 1000, 1000, 1000);
        // Merge the image onto the white BG      
        imagecopymerge($bg, $jpg_image, 1000, 0, 0, 0, 1000, 1000, 100);
        imagecopymerge($bg, $jpg_texture, 0, 0, 0, 0, 1000, 1000, 100);
        imagecopymerge($bg, $pngBorderWithAlpha, 1000, 0, 0, 0, 1000, 1000, 100);

        //Nombre
        $blackText = imagecolorallocate($bg, 0, 0, 0);
        $font_path = realpath("fonts/OratorStd.ttf");
        $size = 32;
        $bbox = imagettfbbox($size, 0, $font_path, '·' . $datos["nombre_certificado"] . '·');
        $textWidth = $bbox[2] - $bbox[0];
        $positionX = -$textWidth / 2 + 480;
        imagettftext($bg, $size, 0, $positionX, 125, $blackText, $font_path, '·' . $datos["nombre_certificado"] . '·');

        if($datos["tipo_certificado"]!=0){
            //Firma
            $firma = $datos["nombre"];
            $size = 28;
            $bbox = imagettfbbox($size, 0, $font_path, $firma);
            $textWidth = $bbox[2] - $bbox[0];
            $positionX = -$textWidth / 2 + 500;
            imagettftext($bg, $size, 0, $positionX, 440, $blackText, $font_path, $firma);
        }
        



        //Fecha
        $fecha = $datos["fecha"];
        /*if (is_string($fecha)) {
            $date = new DateTime($fecha);
            if ($datos->idioma == 1) {
                $fecha = $date->format('m-d-Y');
            } else {
                $fecha = $date->format('d-m-Y');
            }
        } else {
            if ($datos->idioma == 1) {
                $fecha = $fecha->format('m-d-Y');
            } else {
                $fecha = $fecha->format('d-m-Y');
            }
        }*/

        imagettftext($bg, 20, 0, 140, 508, $blackText, $font_path, $fecha);
        //Codigo Arbol
        if ($datos["idioma"] == 1) {
            imagettftext($bg, 20, 0, 210, 550, $blackText, $font_path, $datos["arbol"]->codigo);
        } else {
            imagettftext($bg, 20, 0, 290, 550, $blackText, $font_path, $datos["arbol"]->codigo);
        }
        //NombreComun
        imagettftext($bg, 20, 0, 235, 592, $blackText, $font_path, $datos["arbol"]->nombre);
        //Especie
        imagettftext($bg, 20, 0, 170, 634, $blackText, $font_path, $datos["arbol"]->nombre_c);
        //Coordenadas
        if ($datos["idioma"] == 1) {
            imagettftext($bg, 20, 0, 225, 676, $blackText, $font_path, $datos["arbol"]->gps);
        } else {
            imagettftext($bg, 20, 0, 220, 676, $blackText, $font_path, $datos["arbol"]->gps);
        }
        //Ubicación y área     
        $area = "Milpuj - La Heredad";
        if (substr($datos["arbol"]->codigo, 0, 3) == "ODA") {
            $ubicacion = "San Martín, Perú";
            $area = "Bosques del Futuro Ojos de Agua";
        } elseif (substr($datos["arbol"]->codigo, 0, 2) == "BB") {
            $area = "Bosque Berlín";
        } elseif (substr($datos["arbol"]->codigo, 0, 2) == "PI") {
            $ubicacion = "Loreto, Perú";
            $area = "Paraíso Natural Iwirati Puerto Prado";
        } elseif (substr($datos["arbol"]->codigo, 0, 2) == "CL") {
            $area = "Caverna de Leo";
        }elseif (substr($datos["arbol"]->codigo, 0, 2) == "CH") {
            $area = "Los Chilchos";
        }
        if ($datos["idioma"] == 1) {
            imagettftext($bg, 20, 0, 325, 721, $blackText, $font_path, $area);
        } else {
            imagettftext($bg, 20, 0, 348, 721, $blackText, $font_path, $area);
        }
        imagettftext($bg, 20, 0, 194, 763, $blackText, $font_path, $datos["lugar"]);

        //header("Content-Type: image/png");
        //imagepng($bg);        
        $url = "certificados/" . $datos["arbol"]->codigo . '_cert.jpg';

        imagejpeg($bg, $url, 100);
        imagedestroy($bg);

        return $url;
    }


    public function renderIMG2($datos){
        //print_r($datos["arbol"]->codigo);
        //exit();
        //create white Imagge
        $bg = imagecreatetruecolor(2000, 1414);
        // sets background to white
        $whiteBg = imagecolorallocate($bg, 255, 255, 255);
        imagefill($bg, 0, 0, $whiteBg);
        //bsucar la iamgen del arbol
        $jpg_image = $this->open_image("public/imgCertificados/" . $datos["arbol"]->codigo . ".jpg");     
        //        
        list($ancho, $alto) = getimagesize("public/imgCertificados/" . $datos["arbol"]->codigo . ".jpg");
        $thumb = imagecreatetruecolor(1000, 1414);
        imagecopyresized($thumb, $jpg_image, 0, 0, 0, 0, 1000, 1414, $ancho, $alto);
        //
        $jpg_image=$thumb; 
           
        //
       //if ($datos["idioma"] == 1) {
            $jpg_texture =  $this->open_image("public/plantillas2/certificadoLeft" . $datos["tipo_certificado"] . ".png");
        //} else {
            //$jpg_texture =  $this->open_image("public/plantillas2/certificadoLeft" . $datos["tipo_certificado"] . ".jpg");
        //}
        //exit($datos["tipo_certificado"]);
        //exit($datos["arbol"]->codigo);
        $png_borderImage = imagecreatefrompng("public/plantillas2/certificadoRight.png");
        $pngBorderWithAlpha = imagecreatetruecolor(1000, 1414);
        imagecolortransparent($pngBorderWithAlpha, imagecolorallocate($pngBorderWithAlpha, 0, 0, 0));
        imagecopyresampled($pngBorderWithAlpha, $png_borderImage, 0, 0, 0, 0, 1000, 1414, 1000, 1414);
        // Merge the image onto the white BG      
        imagecopymerge($bg, $jpg_image, 1000, 0, 0, 0, 1000, 1414, 100);
        imagecopymerge($bg, $jpg_texture, 0, 0, 0, 0, 1000, 1414, 100);
        imagecopymerge($bg, $pngBorderWithAlpha, 1000, 0, 0, 0, 1000, 1414, 100);

        //Nombre
        $blackText = imagecolorallocate($bg, 0, 0, 0);
        $font_path = realpath("fonts/OratorStd.ttf");
        $size = 36;
        $bbox = imagettfbbox($size, 0, $font_path, '·' . $datos["nombre_certificado"] . '·');
        $textWidth = $bbox[2] - $bbox[0];
        $positionX = -$textWidth / 2 + 488;
        imagettftext($bg, $size, 0, $positionX, 126, $blackText, $font_path, '·' . $datos["nombre_certificado"] . '·');

        //if($datos["tipo_certificado"]!=0){  //para todos
            //Firma
            $firma = $datos["nombre"];
            $firma = wordwrap($firma, 30, "\n");
            $firmas = explode("\n", $firma);
            $firmaY = 320;
            foreach ($firmas as &$valor) {
                $firmaY+=40;
                $size = 28;
                $bbox = imagettfbbox($size, 0, $font_path, $valor);
                $textWidth = $bbox[2] - $bbox[0];
                $positionX = -$textWidth / 2 + 494;
                imagettftext($bg, $size, 0, $positionX, $firmaY, $blackText, $font_path, $valor);

            }
            
        //}
        



        //Fecha
        $fecha = $datos["fecha"];        
        imagettftext($bg, 24, 0, 188+12, 508+296 - 59, $blackText, $font_path, $fecha);
        //Codigo Arbol
        if ($datos["idioma"] == 1) {
            imagettftext($bg, 24, 0, 384+12, 550+296+(11*1) - 59, $blackText, $font_path, $datos["arbol"]->codigo);
        } else {
            imagettftext($bg, 24, 0, 384+12, 550+296+(11*1) - 59, $blackText, $font_path, $datos["arbol"]->codigo);
        }
        //NombreComun
        imagettftext($bg, 24, 0, 313+12, 592+296+(11*2)+2 - 59, $blackText, $font_path, $datos["arbol"]->nombre);
        //Especie
        imagettftext($bg, 24, 0, 224+12, 634+296+(11*3) - 59, $blackText, $font_path, $datos["arbol"]->nombre_c);
        //Coordenadas
        if ($datos["idioma"] == 1) {
            imagettftext($bg, 24, 0, 295+12, 676+296+(11*4)+2 - 59, $blackText, $font_path, $datos["arbol"]->gps);
        } else {
            imagettftext($bg, 24, 0, 295+12, 676+296+(11*4)+2 - 59, $blackText, $font_path, $datos["arbol"]->gps);
        }
        //Ubicación y área     
        $area = "";
        if (substr($datos["arbol"]->codigo, 0, 2) == "LG") {
            $area = "La Gorda";
            $ubicacion = "Pasco, Perú";
        }
        if (substr($datos["arbol"]->codigo, 0, 2) == "LA") {
            $area = "Los Abuelos";
            $ubicacion = "Pasco, Perú";
        }
        if (substr($datos["arbol"]->codigo, 0, 2) == "CH") {
            $area = "Churumazú";
            $ubicacion = "Pasco, Perú";
        }

        if (substr($datos["arbol"]->codigo, 0, 2) == "EP") {
            $area = "El Palmeral";
            $ubicacion = "Pasco, Perú";
        }

        if (substr($datos["arbol"]->codigo, 0, 2) == "NE") {
            $area = "Fundo Las Neblinas";
            $ubicacion = "Pasco, Perú";
        }

        if (substr($datos["arbol"]->codigo, 0, 2) == "TB") {
            $area = "Tierra de Bosques";
            $ubicacion = "Pasco, Perú";
        }

        if (substr($datos["arbol"]->codigo, 0, 2) == "UL") {
            $area = "Ulcumano Ecolodge";
            $ubicacion = "Pasco, Perú";
        }


        if ($datos["idioma"] == 1) {
            imagettftext($bg, 24, 0, 456+12, 721+296+(11*5) - 59, $blackText, $font_path, $area);
        } else {
            imagettftext($bg, 24, 0, 456+12, 721+296+(11*5) - 59, $blackText, $font_path, $area);
        }
        imagettftext($bg, 24, 0, 260+10, 763+296+(11*6)+1 - 59, $blackText, $font_path, $ubicacion);

        //header("Content-Type: image/png");
        //imagepng($bg);        
        $url = "certificados/" . $datos["arbol"]->codigo . '_cert.jpg';

        imagejpeg($bg, $url, 100);
        imagedestroy($bg);

        return $url;
    }

    public function renderIMG2EN($datos){
        //print_r($datos["arbol"]->codigo);
        //exit();
        //create white Imagge
        $bg = imagecreatetruecolor(2000, 1414);
        // sets background to white
        $whiteBg = imagecolorallocate($bg, 255, 255, 255);
        imagefill($bg, 0, 0, $whiteBg);
        //bsucar la iamgen del arbol
        $jpg_image = $this->open_image("public/imgCertificados/" . $datos["arbol"]->codigo . ".jpg");        
        //
        list($ancho, $alto) = getimagesize("public/imgCertificados/" . $datos["arbol"]->codigo . ".jpg");
        $thumb = imagecreatetruecolor(1000, 1414);
        imagecopyresized($thumb, $jpg_image, 0, 0, 0, 0, 1000, 1414, $ancho, $alto);
        //
        $jpg_image=$thumb; 
        //
       //if ($datos["idioma"] == 1) {
            $jpg_texture =  $this->open_image("public/plantillas2/certificadoLeft0_en.png");
        //} else {
            //$jpg_texture =  $this->open_image("public/plantillas2/certificadoLeft" . $datos["tipo_certificado"] . ".jpg");
        //}
        //exit($datos["tipo_certificado"]);
        //exit($datos["arbol"]->codigo);
        $png_borderImage = imagecreatefrompng("public/plantillas2/certificadoRight.png");
        $pngBorderWithAlpha = imagecreatetruecolor(1000, 1414);
        imagecolortransparent($pngBorderWithAlpha, imagecolorallocate($pngBorderWithAlpha, 0, 0, 0));
        imagecopyresampled($pngBorderWithAlpha, $png_borderImage, 0, 0, 0, 0, 1000, 1414, 1000, 1414);
        // Merge the image onto the white BG      
        imagecopymerge($bg, $jpg_image, 1000, 0, 0, 0, 1000, 1414, 100);
        imagecopymerge($bg, $jpg_texture, 0, 0, 0, 0, 1000, 1414, 100);
        imagecopymerge($bg, $pngBorderWithAlpha, 1000, 0, 0, 0, 1000, 1414, 100);

        //Nombre
        $blackText = imagecolorallocate($bg, 0, 0, 0);
        $font_path = realpath("fonts/OratorStd.ttf");
        $size = 36;
        $bbox = imagettfbbox($size, 0, $font_path, '·' . $datos["nombre_certificado"] . '·');
        $textWidth = $bbox[2] - $bbox[0];
        $positionX = -$textWidth / 2 + 488;
        imagettftext($bg, $size, 0, $positionX, 126, $blackText, $font_path, '·' . $datos["nombre_certificado"] . '·');

        //if($datos["tipo_certificado"]!=0){  //para todos
            //Firma
            $firma = $datos["nombre"];
            $firma = wordwrap($firma, 30, "\n");
            $firmas = explode("\n", $firma);
            $firmaY = 320;
            foreach ($firmas as &$valor) {
                $firmaY+=40;
                $size = 28;
                $bbox = imagettfbbox($size, 0, $font_path, $valor);
                $textWidth = $bbox[2] - $bbox[0];
                $positionX = -$textWidth / 2 + 494;
                imagettftext($bg, $size, 0, $positionX, $firmaY, $blackText, $font_path, $valor);

            }
            
        //}

        $xEstabilizador=12;
        $yEstabilizador=28;
        //Fecha
        $fecha = $datos["fecha"];        
        imagettftext($bg, 24, 0, 199+$xEstabilizador, 705 + $yEstabilizador, $blackText, $font_path, $fecha);
        //Codigo Arbol
        imagettftext($bg, 24, 0, 280+$xEstabilizador, 757 + $yEstabilizador, $blackText, $font_path, $datos["arbol"]->codigo);        
        //NombreComun
        imagettftext($bg, 24, 0, 312+$xEstabilizador, 810 + $yEstabilizador, $blackText, $font_path, $datos["arbol"]->nombre);
        //Especie
        imagettftext($bg, 24, 0, 377+$xEstabilizador, 862 + $yEstabilizador, $blackText, $font_path, $datos["arbol"]->nombre_c);
        //Coordenadas
        imagettftext($bg, 24, 0, 479+$xEstabilizador, 914 + $yEstabilizador, $blackText, $font_path, $datos["arbol"]->gps);
        
        //Ubicación y área     
        $area = "";
        if (substr($datos["arbol"]->codigo, 0, 2) == "LG") {
            $area = "La Gorda";
            $ubicacion = "Pasco, Perú";
        }
        if (substr($datos["arbol"]->codigo, 0, 2) == "LA") {
            $area = "Los Abuelos";
            $ubicacion = "Pasco, Perú";
        }
        if (substr($datos["arbol"]->codigo, 0, 2) == "CH") {
            $area = "Churumazú";
            $ubicacion = "Pasco, Perú";
        }

        if (substr($datos["arbol"]->codigo, 0, 2) == "EP") {
            $area = "El Palmeral";
            $ubicacion = "Pasco, Perú";
        }

        if (substr($datos["arbol"]->codigo, 0, 2) == "NE") {
            $area = "Fundo Las Neblinas";
            $ubicacion = "Pasco, Perú";
        }

        if (substr($datos["arbol"]->codigo, 0, 2) == "TB") {
            $area = "Tierra de Bosques";
            $ubicacion = "Pasco, Perú";
        }

        if (substr($datos["arbol"]->codigo, 0, 2) == "UL") {
            $area = "Ulcumano Ecolodge";
            $ubicacion = "Pasco, Perú";
        }
        //
        imagettftext($bg, 24, 0, 409+$xEstabilizador, 967 + $yEstabilizador, $blackText, $font_path, $area);
        //
        imagettftext($bg, 24, 0, 263+$xEstabilizador, 1019 + $yEstabilizador, $blackText, $font_path, $ubicacion);

        //header("Content-Type: image/png");
        //imagepng($bg);        
        $url = "certificados/" . $datos["arbol"]->codigo . '_cert.jpg';

        imagejpeg($bg, $url, 100);
        imagedestroy($bg);

        return $url;
    }

    public function grabar(Request $request)
    {   
        $date = DateTime::createFromFormat('d/m/Y', $request->fecha);

       

        //print_r( $request->all() ) ;
        
        /**
         * Buscar codigo si existe
         */
        $codigo = DB::table("codigos")
            ->where("codigo","=",$request->codigo)
            ->get();

        if($codigo->count()==0){
            echo json_encode(array("error" => "Este código no existe","result" => 0 ));
		    return;
        }
        /**
         * Si el codigo existe ver si ya se ha usado
         */
        $cantidad = DB::table("usuarios")
            ->where("id_codigo","=",$codigo[0]->id)
            ->count();                    
        if($cantidad==1){
            echo json_encode(array("error" => "Este código ya ha sido usado","result" => 0 ));
		    return;
        }
        /**
         * verificamos si existen arboles
         */
        $arbol=DB::table("arboles")
        ->where("status","=",0)
        ->where("campania","=",$codigo[0]->campania)
        ->get();                    

        if($arbol->count()==0){
            echo json_encode(array("error" => 'Lo sentimos, ya no quedan árboles disponibles.',"result" => 0 ));
		    return;
        }        
        /**
         * renderimazmos
        */
        /*$datosRender= [            
            "tipo_certificado"=>$request->para,
            "nombre_certificado"=>$request->nombreCertificado,
            "idioma"=>0, //viene de codigos
            "nombre"=>$request->nombre,
            "apellido"=>$request->apellido,
            "fecha"=>$request->fecha,
            "arbol"=>$arbol[0],
            "lugar"=>"AMAZONAS, PERÚ"
        ];
        */
        $nombre_de=$request->nombre;
        if($request->deCertificado) $nombre_de=$request->deCertificado;
        
        $metodopago=$request->metodo;
        if($request->otrotxt) $metodopago=$request->otrotxt;

        DB::table('usuarios')->insert(
            [
                "nombre"=>$request->nombre,
                "apellido"=>$request->apellido,
                "nombre_de"=>$nombre_de,
                "dni"=>$request->dni,
                "email"=>$request->email,
                "nacionalidad"=>$request->nacionalidad,
                "nombre_certificado"=>$request->nombreCertificado,
                "id_codigo"=>$codigo[0]->id,
                "id_arbol"=>$arbol[0]->id,
                "fecha_registro"=>$date,
                "tipo_certificado"=>$request->para,
                "newsletter"=>$request->input('newsletter', 0),
                "tipodocumento"=>$request->tipodocumento,
                "metodopago" => $metodopago
            ]
        );

        $affected = DB::table('arboles')
              ->where('id', $arbol[0]->id)
              ->update(['status' => 1]);

        $mailTemplate = "mailingUnomismo.php";
        if ($request->para !== "0") {
            $mailTemplate = "mailingAlguienmas.php";
        }
        $mail = new \Mail();
        $envio=$mail->send($request->email, $request->nombre, $mailTemplate, $request->urlCertificado);
        //print_r(json_encode($envio));
        //print_r();
        
        echo json_encode(array("error" => "", "result" => 1,  "certificadoUrl" => "certificados/" . $arbol[0]->codigo . '_cert.jpg'));
        //exit();
        
    }

}
