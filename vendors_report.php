<?php 
ob_start();
// Include the database.php
include 'includes/database.php';
include 'includes/functions.php';

// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');

/* ---------------------------------------------- Report of Search Query -------------------------------------- */
	// Retrive data from the database according to the project ID
	
	
	// create new PDF document
	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	
	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Afghan Skills');
	$pdf->SetTitle('Vendors Report');
	$pdf->SetSubject('Reports of all Vendors');
	$pdf->SetKeywords('Vendors, list, report, PDF, pdf');
	
	// set default header data
	$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
	$pdf->setFooterData(array(0,64,0), array(0,64,128));
	
	// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	
	// set default monspaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	
	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->setFooterMargin(PDF_MARGIN_FOOTER);
	
	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	
	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SALE_RATIO);
	
	// set some language-dependent strings (optional)
	if(@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		require_once(dirname(__FILE__).'/lang/eng.php');
		$pdf->setLanguageArray($l);	
	}
	
	// ------------------------------------------------------------------------
	
	// set default font subsetting mode
	$pdf->setFontSubsetting(true);
	
	// set font
	// dejavusans is a UTF-8 Unicode font, if you only need to
	// print standard ASCII chars, you can use core fonts like
	// helvetica or times to reduce file size
	$pdf->SetFont('dejavusans', '', 12, '', true);
	
	// Add a page
	// This method has several options, check the source code documentation for more information.
	$pdf->AddPage();
	

	// Set some content to print
	$html = '
		<style>
			h2 { background-color: #F1F1F1;
				 color: #8C0002;
				 text-align: center;
				 padding: 5px 0px; 
				 margin: 10px auto;
			}
			table tr { padding: 10px 0px; }
			td { padding-top: 10px; }
			th { text-align: center; height: 30px; }
		</style>
		<h2> Vendors list </h2>      
';
    $no = 1;
	$sql = "SELECT * FROM vendor";
	$result = $database->query($sql);
	while($vendor = $database->fetch_array($result)) {
		$vendor_id = $vendor['vendor_id'];
		$vendor_name = $vendor['vendor_name'];
		$address = $vendor['address'];
		$profile = $vendor['profile'];
	   
       $html .= '<div style="border: 1px solid #1F1F1F; margin-bottom: 10px; color:#000000;">
    	<table border="1" width="100%" cellpadding="0" cellspacing="0">
        	<tr> <th colspan="4"> Vendor ['. $vendor_name .'] </th></tr>        	
            <tr style="background-color:#073a3b; color: #ffffff;">
                <th width="10%"> Vendor ID </th>
                <th width="20%"> Name </th>
                <th width="20%"> Address </th>
                <th width="50%"> Profile </th>
            </tr>
            <tr>
            	<td width="10%"> '. $no++ .' </td>
                <td width="20%"> '. $vendor_name .' </td>
                <td width="20%"> '. $address .' </td>
                <td width="50%"> '. $profile .' </td>
            </tr>
        </table> <br /><br />
        <table width="100%" border="1" cellpadding="0" cellspacing="0">
        	<tr> <th colspan="6"> Products </th></tr>
            <tr style="background-color:#5f6eeb;">
            	<th width="10%"> ID </th>
                <th width="20%"> Name </th>
                <th width="20%"> POC </th>
                <th width="20%"> Email </th>
                <th width="20%"> Phone </th>
                <th width="10%"> Skype </th>
            </tr>';
		$pro_no = 1;
		$query = "SELECT * FROM products WHERE vendor_id=$vendor_id";
		$query_result = $database->query($query);
		while($products = $database->fetch_array($query_result)) {
          $html .= '<tr>
            	<td width="10%"> '. $pro_no++ .' </td>
                <td width="20%"> '. $products["product_name"] .' </td>
                <td width="20%"> '. $products["poc"] .' </td>
                <td width="20%"> '. $products["email"] .' </td>
                <td width="20%"> '. $products["tel"] .' </td>
                <td width="10%"> '. $products["skype"] .' </td>
            </tr>';
		}
        $html .= '</table>
        
        <table width="100%" border="1" cellpadding="0" cellspacing="0">
        	<tr> <th colspan="6"> Contact Persons </th></tr>
            <tr style="background-color:#5f6eeb;">
            	<th width="10%"> ID </th>
                <th width="20%"> Name </th>
                <th width="20%"> Phone </th>
                <th width="20%"> Email </th>
                <th width="20%"> Skype </th>
                <th width="10%"> Viber </th>
            </tr>';
		$client_no = 1;
		$query1 = "SELECT * FROM contact_person WHERE vendor_id=$vendor_id";
		$query1_result = $database->query($query1);
		while($clients = $database->fetch_array($query1_result)) {
         $html .= '<tr>
            	<td width="10%"> '. $client_no .' </td>
                <td width="20%"> '. $clients["name"] .' </td>
                <td width="20%"> '. $clients["phone"] .' </td>
                <td width="20%"> '. $clients["email"] .' </td>
                <td width="20%"> '. $clients["skype"] .' </td>
                <td width="10%"> '. $clients["viber"] .' </td>
            </tr>';
		}
        $html .= '</table>
    </div>';
	}
     $html .= '</table>';
	
	// output the HTML content
	$pdf->writeHTML($html, true, false, true, false, '');
	
	// Change to Avoid the PDF Error
	ob_end_clean();
	// -----------------------------------------------------------------
	
	// Close and output PDF document 
	// This method has several options, check the source code documentation for more information.
	$pdf->Output('budget_report.pdf', 'I');
	
	//========================================================================+
	// END OF FILE
	//========================================================================+