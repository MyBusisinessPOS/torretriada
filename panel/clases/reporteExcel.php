<?php
    require_once 'lib/PHPExcel/PHPExcel.php';
    require_once 'newsletter.php';

    date_default_timezone_set('America/Mexico_City');

    if (PHP_SAPI == 'cli')
        die('Este archivo solo se puede ver desde un navegador web');

        /** Se agrega la libreria PHPExcel */
        require_once 'lib/PHPExcel/PHPExcel.php';


        // Se crea el objeto PHPExcel
        $objPHPExcel = new PHPExcel();
        $newsletter = new newsletter();
        $temporal = $newsletter -> listNewsletter(1,'',true);

        // Se asignan las propiedades del libro
        $objPHPExcel->getProperties()->setCreator("Correduría 6 y 9") //Autor
                             ->setLastModifiedBy("Correduría 6 y 9") //Ultimo usuario que lo modificó
                             ->setTitle("Newsletter")
                             ->setSubject("Correduría 6 y 9")
                             ->setDescription("Newsletter")
                             ->setKeywords("Newsletter")
                             ->setCategory("Reporte excel");

        $tituloReporte = "Newsletter Correduría 6 y 9";
        $titulosColumnas = array('ID', 'correo');

        $objPHPExcel->setActiveSheetIndex(0)
                    ->mergeCells('A1:B1');
        /*$objDrawing = new PHPExcel_Worksheet_Drawing();
        $objDrawing->setName('Thumb');
        $objDrawing->setDescription('Thumbnail Image');
        $objDrawing->setPath('../../img/logo.png');
        $objDrawing->setHeight(35);
        $objDrawing->setCoordinates('B1');
        $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());*/

        // Se agregan los titulos del reporte
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1',$tituloReporte)
                    ->setCellValue('A3',  $titulosColumnas[0])
                    ->setCellValue('B3',  $titulosColumnas[1]);

        //Se agregan los datos de los alumnos
        $i = 4;
        foreach ($temporal as $key) {
            $cont ++;
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i,  $key['idNewsletter'])
                    ->setCellValue('B'.$i,  $key['correo']);
                    $i++;
        }

        $estiloTituloReporte = array(
            'font' => array(
                'name'      => 'Verdana',
                'bold'      => true,
                'italic'    => false,
                'strike'    => false,
                'size' =>16,
                    'color'     => array(
                        'rgb' => '000000'
                    )
            ),
            /*'fill' => array(
                'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('argb' => 'FF220835')
            ),*/
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            ),
            'alignment' =>  array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'rotation'   => 0,
                    'wrap'          => TRUE
            )
        );

        $estiloTituloColumnas = array(
            'font' => array(
                'name'      => 'Arial',
                'bold'      => true,
                'color'     => array(
                    'rgb' => '000000'
                )
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            ),
            /*'fill'  => array(
                'type'      => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
                'rotation'   => 90,
                'startcolor' => array(
                    'rgb' => '4CC6DA'
                ),
                'endcolor'   => array(
                    'rgb' => '4CC6DA'
                )
            ),
            'borders' => array(
                'top'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                ),
                'bottom'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_MEDIUM ,
                    'color' => array(
                        'rgb' => '143860'
                    )
                )
            ),*/
            'alignment' =>  array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    'wrap'          => TRUE
            ));

        $estiloInformacion = new PHPExcel_Style();
        $estiloInformacion->applyFromArray(
            array(
                'font' => array(
                'name'      => 'Arial',
                'color'     => array(
                    'rgb' => '000000'
                )
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
            /*'fill'  => array(
                'type'      => PHPExcel_Style_Fill::FILL_SOLID,
                'color'     => array('rgb' => '4CC6DA')
            ),
            'borders' => array(
                'left'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN ,
                    'color' => array(
                        'rgb' => '3a2a47'
                    )
                )
            )*/
        ));

        $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($estiloTituloReporte);
        $objPHPExcel->getActiveSheet()->getStyle('A3:B3')->applyFromArray($estiloTituloColumnas);
        $objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:B".($i-1));

        for($i = 'A'; $i <= 'B'; $i++){
            $objPHPExcel->setActiveSheetIndex(0)
                ->getColumnDimension($i)->setAutoSize(TRUE);
        }

        // Se asigna el nombre a la hoja
        $objPHPExcel->getActiveSheet()->setTitle('Correduría 6 y 9');

        // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
        $objPHPExcel->setActiveSheetIndex(0);
        // Inmovilizar paneles
        //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
        $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

        // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
        header('Content-Encoding: UTF-8');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="ListaDeCorreos.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;

?>
