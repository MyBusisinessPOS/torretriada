<?php
include_once 'conexion.php';
class herramientas{

    var $PATH = 'http://localhost:8888/logra/';

    function __construct(){

    }
    /**
     * Devuelve una fecha formateada en español con el nombre del mes.
     * @param  [date] $unformatedDate [fecha sin formato]
     * @return [string]                 [fecha con formato]
     */
    function getFormatedDate($unformatedDate){
        $date = new DateTime($unformatedDate, new DateTimeZone('America/Merida'));

        $formatedDate = $date->format('l d \d\e F\ \d\e Y\ ');

        $namesDaysEnglish = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
        $namesDaysSpanish = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');

        $namesMonthsEnglish = array('January', 'February', 'March', 'April', 'May', 'June',
                                    'July', 'August', 'September', 'October', 'November', 'December');
        $namesMonthsSpanish = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                                    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        $formatedDate = str_replace($namesDaysEnglish, $namesDaysSpanish, $formatedDate);
        $formatedDate = str_replace($namesMonthsEnglish, $namesMonthsSpanish, $formatedDate);

        return $formatedDate;
    }

    function numformat ($num){
        $numformat = number_format ($num, 2);
        return $numformat;
    }
    /**
     * Corta una cadena de texto
     * @param  [string] $text     [cadena a cortar]
     * @param  [integer] $count    [numero de caracteres]
     * @param  [string] $wrapText [texto al final de la cadena]
     * @return [string]          [Devuelve la cadena cortada]
     */
    function cortarTexto($text, $count, $cortar = true, $wrapText = '...'){
        if($cortar){
            $text = htmlspecialchars_decode($text);
            $text = strip_tags($text);
            if(strlen($text)>$count){
                preg_match('/^.{0,' . $count . '}(?:.*?)\b/siu', $text, $matches);
                $text = $matches[0];
            }else{
                $wrapText = '';
            }
            return $text . $wrapText;
        }else{
            return $text;
        }

    }
    /**
     * Convierte un titulo en url
     * @param  [string] $texto [Titulo sin convertir]
     * @return [string]        [Devuelve el titulo en formato url]
     */
    function getUrlAmigable($texto = ''){
        $from = explode (',', "Á,Â,Ã,Ä,Å,Æ,Ç,È,É,Ê,Ë,Ì,Í,Î,Ï,Ð,Ñ,Ò,Ó,Ô,Õ,Ö,Ø,Ù,Ú,Û,Ü,Ý,ß,� ,á,â,ã,ä,å,æ,ç,è,é,ê,ë,ì,í,î,ï,ñ,ò,ó,ô,õ,ö,ø,ù,ú,û,ü,ý,ÿ,Ā,ā,Ă,ă,Ą,ą,Ć,ć,Ĉ,ĉ,Ċ,ċ,Č,č,Ď,ď,Đ,đ,Ē,ē,Ĕ,ĕ,Ė,ė,Ę,ę,Ě,ě,Ĝ,ĝ,Ğ,ğ,� ,ġ,Ģ,ģ,Ĥ,ĥ,Ħ,ħ,Ĩ,ĩ,Ī,ī,Ĭ,ĭ,Į,į,İ,ı,Ĳ,ĳ,Ĵ,ĵ,Ķ,ķ,Ĺ,ĺ,Ļ,ļ,Ľ,ľ,Ŀ,ŀ,Ł,ł,Ń,ń,Ņ,ņ,Ň,ň,ŉ,Ō,ō,Ŏ,ŏ,Ő,ő,Œ,œ,Ŕ,ŕ,Ŗ,ŗ,Ř,ř,Ś,ś,Ŝ,ŝ,Ş,ş,� ,š,Ţ,ţ,Ť,ť,Ŧ,ŧ,Ũ,ũ,Ū,ū,Ŭ,ŭ,Ů,ů,Ű,ű,Ų,ų,Ŵ,ŵ,Ŷ,ŷ,Ÿ,Ź,ź,Ż,ż,Ž,ž,ſ,ƒ,� ,ơ,Ư,ư,Ǎ,ǎ,Ǐ,ǐ,Ǒ,ǒ,Ǔ,ǔ,Ǖ,ǖ,Ǘ,ǘ,Ǚ,ǚ,Ǜ,ǜ,Ǻ,ǻ,Ǽ,ǽ,Ǿ,ǿ,(,),[,],'");
        $to = explode (',', 'A,A,A,A,A,AE,C,E,E,E,E,I,I,I,I,D,N,O,O,O,O,O,O,U,U,U,U,Y,s,a,a,a,a,a,a,ae,c,e,e,e,e,i,i,i,i,n,o,o,o,o,o,o,u,u,u,u,y,y,A,a,A,a,A,a,C,c,C,c,C,c,C,c,D,d,D,d,E,e,E,e,E,e,E,e,E,e,G,g,G,g,G,g,G,g,H,h,H,h,I,i,I,i,I,i,I,i,I,i,IJ,ij,J,j,K,k,L,l,L,l,L,l,L,l,l,l,N,n,N,n,N,n,n,O,o,O,o,O,o,OE,oe,R,r,R,r,R,r,S,s,S,s,S,s,S,s,T,t,T,t,T,t,U,u,U,u,U,u,U,u,U,u,U,u,W,w,Y,y,Y,Z,z,Z,z,Z,z,s,f,O,o,U,u,A,a,I,i,O,o,U,u,U,u,U,u,U,u,U,u,A,a,AE,ae,O,o,,,,,,');
        $s = preg_replace ('~[^\w\d]+~', '-', str_replace ($from, $to, trim ($texto)));
        $url = strtolower (preg_replace ('/^-/', '', preg_replace ('/-$/', '',$s)));
        return $url;
    }
    /**
     * Controla los mensajes de alerta en los listados del panel
     * @param  [int] $tipo [Codigo de alerta]
     * @return [string]       [Devuelve un html con el mensaje de alerta]
     */
    function mensajesAlerta($tipo){
        switch($tipo){
            case '0':
                $alert = '<div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>¡ERROR!</strong> No seleccionó ningún elemento.
                          </div>';
            break;
            case '1':
                $alert = '<div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>¡MUY BIEN!</strong> Elemento creado correctamente.
                          </div>';
            break;
            case '2':
                $alert = '<div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>¡MUY BIEN!</strong> Se han modificado correctamente los datos.
                          </div>';
            break;
            case '3':
                $alert = '<div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>¡MUY BIEN!</strong> Se ha eliminado correctamente.
                          </div>';
            break;
            case '4':
                $alert = '<div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>¡MUY BIEN!</strong> Se ha activado correctamente.
                          </div>';
            break;
            case '5':
                $alert = '<div class="alert alert-warning alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>¡MUY BIEN!</strong> Se ha desactivado correctamente, cuando desactiva elementos, éstos no se muestran en la página.
                          </div>';
            break;
        }
        return $alert;
    }
    /**
     * Paginador de los paneles usado con ajax
     * @param  [integer]  $ultimapagina       [description]
     * @param  [integer]  $paginaactual       [description]
     * @param  [integer]  $paginaanterior     [description]
     * @param  [integer]  $paginasiguiente    [description]
     * @param  [integer] $paginasavisualizar [description]
     * @return [string]                      [Devuelve html para el paginador]
     */
    function paginador($ultimapagina, $paginaactual, $paginaanterior, $paginasiguiente, $paginasavisualizar = 4){
        $htmlpaginador = "";
        $dato = "data-last='".$ultimapagina."'";
        $dato2 = "data-actual = '".$paginaactual."'";

        $htmlpaginador .= '<center>';

        if ($paginaactual == 1 || $ultimapagina <= 4) {
            if($paginaactual == 1){
                $htmlpaginador .= '<img src="img/first.png" class="first off"/>';
                $htmlpaginador .= '<img src="img/prev.png" class="prev off"/>';
            }else{
                $htmlpaginador .= '<img src="img/first.png" class="first" onclick="listar(1)"/>';
                $htmlpaginador .= '<img src="img/prev.png" class="prev" onclick="listar('.$paginaanterior.')"/>';
            }


            for ($i = 1; $i <= $paginasavisualizar; $i++) {
                if ($paginaactual == $i) {
                    $htmlpaginador .= '<span class="pages actual" '.$dato2.' onclick="listar('.$i.')"> '.$i.' </span>';
                }else if($ultimapagina >= $i){
                    $htmlpaginador .= '<span class="pages" onclick="listar('.$i.')"> '.$i.' </span>';
                }
            };

            if($ultimapagina == $paginaactual){
                $htmlpaginador .= '<img src="img/next.png" class="next off"/>';
                $htmlpaginador .= '<img src="img/last.png" '.$dato.' class="last off"/>';
            }else {
                $htmlpaginador .= '<img src="img/next.png" class="next" onclick="listar('.$paginasiguiente.')"/>';
                $htmlpaginador .= '<img src="img/last.png" '.$dato.' class="last" onclick="listar('.$ultimapagina.')"/>';
            }

        }else{
            $mitad = $ultimapagina / 2;
            $diferencia = $ultimapagina - $paginaactual;

            $htmlpaginador .= '<img src="img/first.png" class="first" onclick="listar(1)"/>';
            $htmlpaginador .= '<img src="img/prev.png" class="prev" onclick="listar('.$paginaanterior.')"/>';

            if($paginaactual <= $mitad){
                $indice = $paginaactual - 1;
                $limite = $paginaactual + 2;
            }else if($paginaactual < $ultimapagina){
                $indice = $paginaactual - 2;
                $limite = $paginaactual + 1;
            }else{
                $indice = $paginaactual - 3;
                $limite = $paginaactual;
            }

            for ($i = $indice; $i <= $limite; $i++) {

                if ($paginaactual == $i) {
                    $htmlpaginador .= '<span class="pages actual" '.$dato2.' onclick="listar('.$i.')"> '.$i.' </span>';
                }else{
                    $htmlpaginador .= '<span class="pages" onclick="listar('.$i.')"> '.$i.' </span>';
                }
            }

            if ($ultimapagina > $paginaactual) {
                $htmlpaginador .= '<img src="img/next.png" class="next" onclick="listar('.$paginasiguiente.')"/>';
                $htmlpaginador .= '<img src="img/last.png" class="last" '.$dato.' onclick="listar('.$ultimapagina.')"/>';
            } else {
                $htmlpaginador .= '<img src="img/next.png" class="next off"/>';
                $htmlpaginador .= '<img src="img/last.png" '.$dato.' class="last off"/>';
            }
        }
        $htmlpaginador .= '</center>';
        return $htmlpaginador;
    }
    /**
     * Paginador de los paneles usado con ajax
     * @param  [integer]  $ultimapagina       [description]
     * @param  [integer]  $paginaactual       [description]
     * @param  [integer]  $paginaanterior     [description]
     * @param  [integer]  $paginasiguiente    [description]
     * @param  [integer] $paginasavisualizar [description]
     * @return [string]                      [Devuelve html para el paginador]
     */
    function paginadorFrontEnd($ultimapagina, $paginaactual, $paginaanterior, $paginasiguiente, $paginasavisualizar = 4, $_metodo = ''){
        $_funcion = 'listar';
        $htmlpaginador = "";
        //$dato = "data-last='".$ultimapagina."'";
        //$dato2 = "data-actual = '".$paginaactual."'";

        /*if($paginaactual == 1 OR $paginaactual == ''){
            $htmlpaginador .= ' <li class="paginas ">'.$paginaactual.' - '.$ultimapagina.'</li><li class="hide lileft"><button class="btn btn-pager"> <i class="icon ion-ios-arrow-left"></i> </button></li><li class="paginas hide">'.$paginaactual.' - '.$ultimapagina.'</li>';
            $_class = 'border-1x';
        }else{
            $htmlpaginador .= '<li class="lileft"><button class="btn btn-pager '.$_class.'" onclick="'.$_metodo.'('.$paginaanterior.')"> <i class="icon ion-ios-arrow-left"></i> </button></li><li class="paginas ">'.$paginaactual.' - '.$ultimapagina.'</li>';
            $_class = '';
        }
        if($ultimapagina > $paginaactual){
            $htmlpaginador .= '<li class="liright"><button class="btn btn-pager '.$_class.'" onclick="'.$_metodo.'('.$paginasiguiente.')"> <i class="icon ion-ios-arrow-right"></i> </button></li>';
        }else{
            $htmlpaginador .= '<li class="hide liright"><button class="btn btn-pager '.$_class.'" > <i class="icon ion-ios-arrow-right"></i> </button></li>';
        }*/

        $htmlpaginador = "";
        //$dato = "data-last='".$ultimapagina."'";
        //$dato2 = "data-actual = '".$paginaactual."'";

        if ($paginaactual == 1 || $ultimapagina <= 4) {
            if($paginaactual == 1){
                //$htmlpaginador .= '<img src="img/first.png" class="first off"/>';
                //$htmlpaginador .= '<li><span style="cursor:pointer;" class="caret previous disabled"></span></li>';
            }else{
                //$htmlpaginador .= '<img src="img/first.png" class="first" onclick="listar(1)"/>';
                //$htmlpaginador .= '<li data-page="'.$paginaanterior.'"><span style="cursor:pointer;" class="caret previous"></span></li>';
            }


            for ($i = 1; $i <= $paginasavisualizar; $i++) {
                if ($paginaactual == $i) {
                    //$htmlpaginador .= '<span class="pages actual" '.$dato2.' onclick="listar('.$i.')"> '.$i.' </span>';
                    $htmlpaginador .= '<li data-page="'.$i.'"><a style="cursor:pointer;" class="active">'.$i.'</a></li>';
                }else if($ultimapagina >= $i){
                    $htmlpaginador .= '<li data-page="'.$i.'"><a style="cursor:pointer;" >'.$i.'</a></li>';
                }
            };

            if($ultimapagina == $paginaactual){
                //$htmlpaginador .= '<li><span style="cursor:pointer;" class="caret next disabled"></span></li>';
                //$htmlpaginador .= '<img src="img/last.png" '.$dato.' class="last off"/>';
            }else {
                //$htmlpaginador .= '<li onclick="" data-page="'.$paginasiguiente.'"><span style="cursor:pointer;" class="caret next"></span></li>';
                //$htmlpaginador .= '<img src="img/last.png" '.$dato.' class="last" onclick="listar('.$ultimapagina.')"/>';
            }

        }else{
            $mitad = $ultimapagina / 2;
            $diferencia = $ultimapagina - $paginaactual;

            //$htmlpaginador .= '<img src="img/first.png" class="first" onclick="listar(1)"/>';
            $htmlpaginador .= '<li onclick="" data-page="'.$paginaanterior.'"><a class="anterior"><ion-icon name="ios-arrow-back"></ion-icon></li>';

            if($paginaactual <= $mitad){
                $indice = $paginaactual - 1;
                $limite = $paginaactual + 2;
            }else if($paginaactual < $ultimapagina){
                $indice = $paginaactual - 2;
                $limite = $paginaactual + 1;
            }else{
                $indice = $paginaactual - 3;
                $limite = $paginaactual;
            }

            for ($i = $indice; $i <= $limite; $i++) {

                if ($paginaactual == $i) {
                    $htmlpaginador .= '<li data-page="'.$i.'"><a class="active">'.$i.'</a></li>';
                }else{
                    $htmlpaginador .= '<li data-page="'.$i.'"><a>'.$i.'</a></li>';
                }
            }

            if ($ultimapagina > $paginaactual) {
                //$htmlpaginador .= '<li data-page="'.$paginasiguiente.'"><span class="caret next"></span></li>';
                //$htmlpaginador .= '<img src="img/last.png" class="last" '.$dato.' onclick="listar('.$ultimapagina.')"/>';
            } else {
                //$htmlpaginador .= '<li><span class="caret next disabled"></span></li>';
                //$htmlpaginador .= '<img src="img/last.png" '.$dato.' class="last off"/>';
            }
        }
        return $htmlpaginador;
    }
    /**
     * Listado de años
     * @return [array] [Devuelve arreglo de años]
     */
    function listaAnios(){
        $anios = array();
        for($i = date ("Y"); $i >= date ("Y") - 100; $i--){
            $registro = array();
            $registro['anio'] = $i;
            array_push($anios,$registro);
        }
        return $anios;
    }
    /**
     * Listado de dias
     * @return [array] [Devuelve arreglo de dias]
     */
    function listaDias(){
        $dias = array();
        for($i = 1; $i < 32; $i++){
            ($i < 10) ? $dia = '0'.$i : $dia = $i;
            $registro = array();
            $registro['dia'] = $dia;
            array_push($dias,$registro);
        }
        return $dias;
    }
    /**
     * Listado de meses
     * @return [array] [Devuelve arreglo de meses]
     */
    function listaMeses(){
        $meses = Array (
            0 => Array ( "value" => "01", "mes" => "Enero"),
            1 => Array ( "value" => "02", "mes" => "Febrero"),
            2 => Array ( "value" => "03", "mes" => "Marzo"),
            3 => Array ( "value" => "04", "mes" => "Abril"),
            4 => Array ( "value" => "05", "mes" => "Mayo"),
            5 => Array ( "value" => "06", "mes" => "Junio"),
            6 => Array ( "value" => "07", "mes" => "Julio"),
            7 => Array ( "value" => "08", "mes" => "Agosto"),
            8 => Array ( "value" => "09", "mes" => "Septiembre"),
            9 => Array ( "value" => "10", "mes" => "Octubre"),
            10 => Array ( "value" => "11", "mes" => "Noviembre"),
            11 => Array ( "value" => "12", "mes" => "Diciembre")
        );
        return $meses;
    }
    /**
     * Listado del abecedario
     * @return [array]
     */
    function listarABC(){
        $abc = range('a', 'z');
        return $abc;
    }

    function formatedTags($texto, $frontEnd){
        $label = "";
        if($frontEnd){
            $texto = explode('-', $texto);
            foreach($texto as $_t){
                $label .= '<a href="'.$this -> PATH.'blogs/tag/'.$_t.'">'.$_t.'</a>  ';
            }
        }else{
            $texto = explode(',', $texto);
            foreach($texto as $_t){
                $label .= '<label class="label label-default">'.$_t.'</label> ';
            }
        }
        return $label;
    }

    function separateTags($texto, $delimiter){
        $tags = explode($delimiter, $texto);
        return $tags;
    }

    function videoType($url) {
        if (strpos($url, 'youtube') > 0) {
            return 'youtube';
        } elseif (strpos($url, 'vimeo') > 0) {
            return 'vimeo';
        } else {
            return 'unknown';
        }
    }

}
?>
