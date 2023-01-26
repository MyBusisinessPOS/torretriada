<?php
    class herramientas{
        // nada por ahora ^^

        function herramientas(){
            //var $formatedDate;    
        }

        function getFormatedDate($unformatedDate){
            $date = new DateTime($unformatedDate, new DateTimeZone('America/Merida'));
          
            $formatedDate = $date->format('l d \d\e F\ \d\e\l Y\ ');
         
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

        function getFormatDate($FDate){

            $date = new DateTime($FDate, new DateTimeZone('America/Merida'));
          
            $formatedDate = $date->format('j \d\e F\ \d\e\l Y\ ');
         
            $namesMonthsEnglish = array('January', 'February', 'March', 'April', 'May', 'June',
                                        'July', 'August', 'September', 'October', 'November', 'December');
            $namesMonthsSpanish = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                                        'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
            $formatedDate = str_replace($namesMonthsEnglish, $namesMonthsSpanish, $formatedDate);
         
            return $formatedDate;
        }
        
        function numformat ($num){
            $numformat = number_format ($num, 2);
            return $numformat;  
        }
    }
?>