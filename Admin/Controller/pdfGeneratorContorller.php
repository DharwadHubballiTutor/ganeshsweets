<?php
require_once("../vendor/autoload.php");
require_once("../Model/quotationModel.php");
require_once("../DB Operations/quotationOps.php");
require_once("../DB Operations/salesorderOps.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $waterMarked = $_POST['waterMarked'];
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'showWatermarkText' => $waterMarked,
        'orientation' => 'P',
        'autoPadding' => 'true',
        'collapseBlockMargins' => 'false',
        'defaultheaderline' => '2',
    ]);
    $fileType = $_POST['fileType'];
    $fileName = $_POST['fileName'];
   
    if ($waterMarked == 'true') {
        $mpdf->WriteHTML('<watermarktext content="Ganesh Sweets" alpha="0.1" />');
    }
    $mpdf->WriteHTML($_POST['html'], \Mpdf\HTMLParserMode::HTML_BODY);
    $mpdf->Output('../pdfs/' . $fileType . '/' . $fileName . '.pdf', \Mpdf\Output\Destination::FILE);
    error_log($fileType);
   
    if($fileType=='itemList'){
        $Quotation= new Quotation();
        $Quotation->set_quoteId($_POST['quoteId']);
        $Quotation->set_modifiedby($_POST['modifiedby']);
    $Quotation->set_itemListName($fileName.'.pdf');
    DBQuotation::updateFileName($Quotation);

    }else if ($fileType=='quotations'){
        $Quotation= new Quotation();
        $Quotation->set_quoteId($_POST['quoteId']);
        $Quotation->set_modifiedby($_POST['modifiedby']);
    $Quotation->set_quotePDFName($fileName.'.pdf');
    DBQuotation::updateFileName($Quotation);
    
    }else if ($fileType=='salesorder')
    {
        $Sales= new SalesOrder();
        $Sales->set_id($_POST['salesId']);
        $Sales->set_salesPDFName($fileName.'.pdf');
        DBsales::updateFileName($Sales);
    }
    // header('Content-type: application/pdf');
    // header('Content-Disposition: inline; filename="' . $filename . '"');
    // header('Content-Transfer-Encoding: binary');
    // header('Content-Length: ' . filesize($filename));
    // header('Accept-Ranges: bytes');
    // readfile($filename);
}