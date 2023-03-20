<?php
/*
$tempPDF = tempnam( '/tmp', 'generated-invoice' );
$url = 'http://kels.ae/olympia/services/invoice.php?orderid=21';

exec( "wkhtmltopdf  $url  $tempPDF" );

header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename=invoice.pdf');

echo file_get_contents( $tempPDF );
unlink( $tempPDF );
*/

// Set parameters
$apikey = 'b3d71adf-aad0-4057-92af-cc64a6048c20';
$value = 'http://kels.ae/olympia/services/invoice.php?orderid='.$_GET['orderid']; // can aso be a url, starting with http..
 
// Convert the HTML string to a PDF using those parameters.  Note if you have a very long HTML string use POST rather than get.  See example #5
$result = file_get_contents("http://api.html2pdfrocket.com/pdf?apikey=" . urlencode($apikey) . "&value=" . urlencode($value));
 
// Output headers so that the file is downloaded rather than displayed
// Remember that header() must be called before any actual output is sent
header('Content-Description: File Transfer');
header('Content-Type: application/pdf');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . strlen($result));
 
// Make the file a downloadable attachment - comment this out to show it directly inside the 
// web browser.  Note that you can give the file any name you want, e.g. alias-name.pdf below:
//header('Content-Disposition: attachment; filename=' . 'invoice.pdf' );
 
 	//move_uploaded_file($result,"invoices/invoice.pdf");
 	
$invoice = 'invoice_'.$_GET['orderid'].'.pdf';

file_put_contents('invoices/'.$invoice, $result);

// Stream PDF to user
//echo $result;


?>