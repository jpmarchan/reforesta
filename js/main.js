$(document).ready(function () {    
    console.log("Version 0.3");


    mensajes= {
        nombre: {
            required: "Ingresa nombre"
        },
        apellido: {
            required: "Ingresa apellido",
        },
        dni: {
            required: "Ingresa un DNI, RUC o Pasaporte",
        },
        email: {
            required: "Ingresa email",
            email: "Ingresa email válido"
        },
        nacionalidad: {
            required: "Ingresa nacionalidad",
        },
        codigo: {
            required: "Ingresa código",
        },
        para: {
            required: "Selecciona para quién es el arbol",
        },
        nombreCertificado: {
            required: "Ingresa nombre para el certificado",
        },
        metodo: {
            required: "Seleccione el método de pago",
        },
        tipodocumento: {
            required: "Seleccione el tipo de documento",
        },
        fecha:{
            required: "Ingrese una fecha válida",
        }
    };

    if(idioma=="en"){
        mensajes= {
            nombre: {
                required: "Enter name"
            },
            apellido: {
                required: "Enter last name",
            },
            dni: {
                required: "Enter ID or Passaport",
            },
            email: {
                required: "Enter email",
                email: "Enter valid email"
            },
            nacionalidad: {
                required: "Enter nationality",
            },
            codigo: {
                required: "Enter code",
            },
            para: {
                required: "Select who the tree is for",
            },
            nombreCertificado: {
                required: "Enter name for the certificate",
            },
            metodo: {
                required: "Select the payment method",
            },
            tipodocumento: {
                required: "Select the type of document",
            },
            fecha:{
                required: "Enter a valid date",
            }
        };
    }


    $('#fechaCertificado').datepicker({
      language: 'es'
    });
    $.validator.addMethod('select', function(value, element) {
      return this.optional(element) || value !== "-1"
    }, mensajes.nacionalidad.required);

    $.validator.addMethod(
        "datePeru",
        function(value, element) {
            var check = false;
            var re = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
            if( re.test(value)){
                var adata = value.split('/');
                var dd = parseInt(adata[0],10);
                var mm = parseInt(adata[1],10);
                var yyyy = parseInt(adata[2],10);
                var xdata = new Date(yyyy,mm-1,dd);
                if ( ( xdata.getFullYear() === yyyy ) && ( xdata.getMonth () === mm - 1 ) && ( xdata.getDate() === dd ) ) {
                    check = true;
                }
                else {
                    check = false;
                }
            } else {
                check = false;
            }
            return this.optional(element) || check;
        },
        mensajes.fecha.required
    );

    var countries = {"AF":"Afganist\u00e1n","AL":"Albania","DE":"Alemania","AD":"Andorra","AO":"Angola","AI":"Anguila","AG":"Antigua y Barbuda","AN":"Antillas Neerlandesas","AQ":"Ant\u00e1rtida","SA":"Arabia Saud\u00ed","DZ":"Argelia","AR":"Argentina","AM":"Armenia","AW":"Aruba","AU":"Australia","AT":"Austria","AZ":"Azerbaiy\u00e1n","BS":"Bahamas","BH":"Bahr\u00e9in","BD":"Bangladesh","BB":"Barbados","BZ":"Belice","BJ":"Ben\u00edn","BM":"Bermudas","BY":"Bielorrusia","BO":"Bolivia","BA":"Bosnia-Herzegovina","BW":"Botsuana","BR":"Brasil","BN":"Brun\u00e9i","BG":"Bulgaria","BF":"Burkina Faso","BI":"Burundi","BT":"But\u00e1n","BE":"B\u00e9lgica","CV":"Cabo Verde","KH":"Camboya","CM":"Camer\u00fan","CA":"Canad\u00e1","TD":"Chad","CL":"Chile","CN":"China","CY":"Chipre","VA":"Ciudad del Vaticano","CO":"Colombia","KM":"Comoras","CG":"Congo","KP":"Corea del Norte","KR":"Corea del Sur","CR":"Costa Rica","CI":"Costa de Marfil","HR":"Croacia","CU":"Cuba","DK":"Dinamarca","DM":"Dominica","EC":"Ecuador","EG":"Egipto","SV":"El Salvador","AE":"Emiratos \u00c1rabes Unidos","ER":"Eritrea","SK":"Eslovaquia","SI":"Eslovenia","ES":"Espa\u00f1a","US":"Estados Unidos","EE":"Estonia","ET":"Etiop\u00eda","PH":"Filipinas","FI":"Finlandia","FJ":"Fiyi","FR":"Francia","GA":"Gab\u00f3n","GM":"Gambia","GE":"Georgia","GH":"Ghana","GI":"Gibraltar","GD":"Granada","GR":"Grecia","GL":"Groenlandia","GP":"Guadalupe","GU":"Guam","GT":"Guatemala","GF":"Guayana Francesa","GG":"Guernsey","GN":"Guinea","GQ":"Guinea Ecuatorial","GW":"Guinea-Bissau","GY":"Guyana","HT":"Hait\u00ed","HN":"Honduras","HU":"Hungr\u00eda","IN":"India","ID":"Indonesia","IQ":"Iraq","IE":"Irlanda","IR":"Ir\u00e1n","BV":"Isla Bouvet","CX":"Isla Christmas","NU":"Isla Niue","NF":"Isla Norfolk","IM":"Isla de Man","IS":"Islandia","KY":"Islas Caim\u00e1n","CC":"Islas Cocos","CK":"Islas Cook","FO":"Islas Feroe","GS":"Islas Georgia del Sur y Sandwich del Sur","HM":"Islas Heard y McDonald","FK":"Islas Malvinas","MP":"Islas Marianas del Norte","MH":"Islas Marshall","SB":"Islas Salom\u00f3n","TC":"Islas Turcas y Caicos","VG":"Islas V\u00edrgenes Brit\u00e1nicas","AX":"Islas \u00c5land","IL":"Israel","IT":"Italia","JM":"Jamaica","JP":"Jap\u00f3n","JE":"Jersey","JO":"Jordania","KZ":"Kazajist\u00e1n","KE":"Kenia","KG":"Kirguist\u00e1n","KI":"Kiribati","KW":"Kuwait","LA":"Laos","LS":"Lesoto","LV":"Letonia","LR":"Liberia","LY":"Libia","LI":"Liechtenstein","LT":"Lituania","LU":"Luxemburgo","LB":"L\u00edbano","MK":"Macedonia","MG":"Madagascar","MY":"Malasia","MW":"Malaui","MV":"Maldivas","ML":"Mali","MT":"Malta","MA":"Marruecos","MQ":"Martinica","MU":"Mauricio","MR":"Mauritania","YT":"Mayotte","FM":"Micronesia","MD":"Moldavia","MN":"Mongolia","ME":"Montenegro","MS":"Montserrat","MZ":"Mozambique","MM":"Myanmar","MX":"M\u00e9xico","MC":"M\u00f3naco","NA":"Namibia","NR":"Nauru","NP":"Nepal","NI":"Nicaragua","NG":"Nigeria","NO":"Noruega","NC":"Nueva Caledonia","NZ":"Nueva Zelanda","NE":"N\u00edger","OM":"Om\u00e1n","PK":"Pakist\u00e1n","PW":"Palau","PS":"Palestina","PA":"Panam\u00e1","PG":"Pap\u00faa Nueva Guinea","PY":"Paraguay","NL":"Pa\u00edses Bajos","PE":"Per\u00fa","PN":"Pitcairn","PF":"Polinesia Francesa","PL":"Polonia","PT":"Portugal","PR":"Puerto Rico","QA":"Qatar","GB":"Reino Unido","CF":"Rep\u00fablica Centroafricana","CZ":"Rep\u00fablica Checa","CD":"Rep\u00fablica Democr\u00e1tica del Congo","DO":"Rep\u00fablica Dominicana","RE":"Reuni\u00f3n","RW":"Ruanda","RO":"Ruman\u00eda","RU":"Rusia","WS":"Samoa","AS":"Samoa Americana","BL":"San Bartolom\u00e9","KN":"San Crist\u00f3bal y Nieves","SM":"San Marino","MF":"San Mart\u00edn","PM":"San Pedro y Miquel\u00f3n","VC":"San Vicente y las Granadinas","SH":"Santa Elena","LC":"Santa Luc\u00eda","ST":"Santo Tom\u00e9 y Pr\u00edncipe","SN":"Senegal","RS":"Serbia","CS":"Serbia y Montenegro","SC":"Seychelles","SL":"Sierra Leona","SG":"Singapur","SY":"Siria","SO":"Somalia","LK":"Sri Lanka","SZ":"Suazilandia","ZA":"Sud\u00e1frica","SD":"Sud\u00e1n","SE":"Suecia","CH":"Suiza","SR":"Surinam","SJ":"Svalbard y Jan Mayen","EH":"S\u00e1hara Occidental","TH":"Tailandia","TW":"Taiw\u00e1n","TZ":"Tanzania","TJ":"Tayikist\u00e1n","TL":"Timor Oriental","TG":"Togo","TK":"Tokelau","TO":"Tonga","TT":"Trinidad y Tobago","TM":"Turkmenist\u00e1n","TR":"Turqu\u00eda","TV":"Tuvalu","TN":"T\u00fanez","UA":"Ucrania","UG":"Uganda","UY":"Uruguay","UZ":"Uzbekist\u00e1n","VU":"Vanuatu","VE":"Venezuela","VN":"Vietnam","WF":"Wallis y Futuna","YE":"Yemen","DJ":"Yibuti","ZM":"Zambia","ZW":"Zimbabue"};
	function viewport() {
        var e = window, a = 'inner';
        if (!('innerWidth' in window )) {
            a = 'client';
            e = document.documentElement || document.body;
        }
        return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
    }
    
    

    $('#formArbol').validate({ 
        rules: {        	
            nombre: {
                required: true
            },
            apellido: {
                required: true,
            },
            dni: {
                required: true,
            },
            fecha: {
                datePeru: true
            },
            email: {
                required: true,
                email: true
            },
            nacionalidad: {
                required: true,
                select: true,
            },
            codigo: {
                required: true,
            },
            para: {
                required: true,
            },
            metodo: {
                required: true,
            },
            tipodocumento: {
                required: true,
            },
            nombreCertificado:{
                required: true,
            }
        },
        messages: mensajes,
        errorLabelContainer: "#errorBox",
        wrapper: "li",
    });
    var updateCertificadoValues = function() {
        $("#nombreCertificado").val("");

        if ($(".radioInput:checked").val() === "0") {
            if ($("#nombre").val() && $("#apellido").val()) {
                $("#nombreCertificado").val($("#nombre").val() + " " + $("#apellido").val());
            }
        }

    }
    $(".radioInput").change(function() {
        //updateCertificadoValues();
    });
    //$("#nombre, #apellido, #email").keyup(updateCertificadoValues);
    $("input").change(function() {
            $('#response-success').hide();
        }
        
        );

    if (viewport().width <= 750 ) {
        $("#bodyContainer .bodyText").append($("#alianzas"));
    }
    $(window).resize(function() {
        if (viewport().width <= 750 ) {
            $("#bodyContainer .bodyText").append($("#alianzas"));
        } else {
            $("#bodyContainer .formContainer").append($("#alianzas"));
        }   

    });
	$(".fancybox").fancybox({ 
        openEffect: "none",
        prevEffect  : 'none',
        nextEffect  : 'none',
        maxWidth: 1000,
        afterLoad   : function() {
            $(".modal-title").text($(this.element).data("title"));   
            $(".modal-description").text($(this.element).data("description"));  
            $(".modal-image img").attr("src",$(this.element).data("image") ); 
            $(".modal-specie").text($(this.element).data("specie") );
        }
    });
    $(".tiendas").fancybox({
        maxWidth: 1000
    });
    $(".contactanos").fancybox({
        maxWidth: 500
    });


    $("#enviar").click(function(e) {
        $("#enviar").fadeTo("fast",0.5);
        if($("#formArbol").valid()){
            var nombre = $("#nombre").val();
            var email = $("#email").val();
            var fecha = '';
            if ($("#fechaCertificado").val()) {
                fecha = $("#fechaCertificado").val();
            }
            
            urlCrear="certificados/crear";
            urlConfirmar="certificados/confirmar";
            if(idioma=="en"){
                urlCrear="certificados/crear/en";
                urlConfirmar="certificados/confirmar/en";
            }

            $.post(urlCrear, {
                newsletter: $("#newsletter").prop("checked") ? 1 : 0,
                nombre: nombre,
                dni: $('#dni').val(),                
                email: email,
                fecha: fecha,
                de: $('#deCertificado').val(),
                nacionalidad: $('#nacionalidad').val(),
                apellido: $('#apellido').val(),
                codigo: $('#codigo').val(),
                para: $('input[name=para]:checked', '#formArbol').val(),
                nombre_certificado: $('#nombreCertificado').val(),
            }, 'JSON').done(function(data){
                $("#enviar").fadeTo("fast",1);
                var obj = JSON.parse(data);

                if(obj.result === 0){
                    $('#response-error').show().parent().show().parent().show();
                    $('#response-success').hide();
                    $('#response-error').html(obj.error);
                } else {
                    $.fancybox({
                        href: urlConfirmar+"?urlCertificado="+obj.certificadoUrl+"&"+$("#formArbol").serialize(),
                        type: "iframe",
                        maxWidth: 700,
                        maxHeight: 550
                    });
                }
                sending = false;
                //$('#canvasloader').hide();
            });
            
        }else{
            $("#enviar").fadeTo("fast",1);
        }
    });
    $(".mypopup").click(function() {
        var popupname = $(this).data("popupname");
        var sizeh = 300;
        var sizehData = $(this).data("sizeh");
        if (sizehData) {
            sizeh = sizehData;
        }
        var sizew = 700;
        var sizewData = $(this).data("sizew");
        if (sizewData) {
            sizew = sizewData;
        }
        var params="";
        var paramsData = $(this).data("params");
        if (paramsData) {
            params = paramsData;
        }

        $.fancybox({
            href: popupname + "/?"+params,
            type: "iframe",
            maxWidth: 1200,
            maxHeight: sizeh
        });
        return false;
    });
    var navigation = $("#header").navigation();
    $(".goAdopta").click(function() {
        navigation.goTo("#adopta");
    });
    $(".squares li").hover(function() {
        var title = $(this).find("a").data("link");
        $("."+title).css("text-decoration", "underline");
    }, function(){
        var title = $(this).find("a").data("link");
        $("."+title).css("text-decoration", "none");
    });
    var popDropDown = function(id, options) {
      var select = document.getElementById(id);
      for (var key in options) {
          var opt = options[key];
          var el = document.createElement("option");
          el.textContent = opt;
          el.innerText = opt;
          el.value = opt;        
          select.appendChild(el);
      }    
    }
    popDropDown("nacionalidad", countries);
    $(".boxLetters").lettering();

    $(".goToNav").click(function() {
        $href = $("#" + $(this).data("goto"));
        $("html, body").animate({scrollTop: $href.offset().top - 76 }, '500');
        $("header nav").removeClass("open");
        return false;
    });
    function updateLogoScroll() {
        if( $(window).scrollTop() > 0) {
            $("#logoConservamos").addClass("scrolled");
        } else {
            $("#logoConservamos").removeClass("scrolled");
        }
    }

    updateLogoScroll();

    $(window).scroll(function() {
        updateLogoScroll();
    });
    $("#signup").validate({
        // if valid, post data via AJAX
        submitHandler: function(form) {
            $.post("subscribe", { fname: $("#fname").val(), lname: $("#lname").val(), email: $("#email_s").val() }, function(data) {
                dataJ = JSON.parse(data);
                if (dataJ["success"] == '1') {
                    $("#signup")[0].reset();
                }
                $('#response').html(dataJ["message"]);

            });
        },
        // all fields are required
        rules: {
            fname: {
                required: true
            },
            lname: {
                required: true
            },
            email_s: {
                required: true,
                email: true
            },
            
        },
        messages: {
            fname: {
                required: "Ingresa nombre"
            },
            lname: {
                required: "Ingresa apellido",
            },
            email_s: {
                required: "Ingresa email",
                email: "Ingresa email válido"
            }
        },
    });
    $('.noticias').bxSlider({
        pager: false
    });
    $(document).ready(function(){
          $('input').iCheck({
            checkboxClass: 'icheckbox_minimal-green',
            radioClass: 'iradio_minimal-green',
            increaseArea: '20%' // optional
          });
    });
    $(".hiddenPick").hide();
    
    setInterval (() => {
        
        var valor=parseInt($("input[name=para]:checked").val());
        var texto="";
        switch(valor){
            case 0:
                if(idioma=="en"){
                    texto="Thank you for helping us plant life and hope in places where people live in harmony with nature.";
                }else{
                    texto="GRACIAS POR AYUDAR A SEMBRAR VIDA Y ESPERANZAS EN LUGARES DONDE SE VIVE EN ARMONÍA CON LA NATURALEZA.";
                }                
                break;
            case 1:
                if(idioma=="en"){
                    texto="It is growing with you, with love.";
                }else{
                    texto="ESTÁ CRECIENDO CON USTEDES, CON AMOR.";
                }                  
                break;
            case 2:
                if(idioma=="en"){
                    texto="So that it may continue growing and giving life.";
                }else{
                    texto="PARA QUE SIGA ECHANDO RAÍCES Y DANDO VIDA.";
                }      
                           
                break;
            case 3:
                if(idioma=="en"){
                    texto="It is taking root and growing every day, just like you.";             
                }else{
                    texto="ESTÁ ECHANDO RAÍCES Y CRECIENDO CADA DIA IGUAL QUE TU.";
                }        
                break;
            case 4:
                if(idioma=="en"){
                    
                    texto="It is taking root and giving hope in places where people live in harmony with nature.";       
                }else{
                    texto="ESTÁ ECHANDO RAÍCES Y DANDO ESPERANZA EN LUGARES DONDE SE VIVE EN ARMONÍA CON LA NATURALEZA.";
                } 
                              
                break;
            default:
                texto="";
        }
        texto=texto.toUpperCase();
        $("#deCertificado").text(texto);
    }, 500);

});