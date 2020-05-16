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
	$pdf->SetTitle('Single Project Detail');
	$pdf->SetSubject('Single Project Detail From Search Query');
	$pdf->SetKeywords('Project, Single, detail, PDF, pdf');
	
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
	$pdf->SetFont('dejavusans', '', 14, '', true);
	
	// Add a page
	// This method has several options, check the source code documentation for more information.
	$pdf->AddPage();
	

	// Set some content to print
	$html .= '
		<style>
			h1 {
				text-align: center;
				margin: 10px 0px;
			}
			h2 { background-color: #F1F1F1;
				 color: #8C0002;
				 text-align: center;
				 padding: 5px 0px; 
				 margin: 10px auto;
			}
			h3 {
				text-align: center;
				color: #8C0002;
			}
			p {
				text-align: justify;
				padding: 5px;
			}
			table {
				border: 1px solid #949494;
				background: #EDEDED;
			}
			table tr {
				margin: 5px 0px;
			}
			table td {
				padding: 10px;
				height: 40px;
			}
		</style>
		<h1> - Complete List of All Projects - </h1>';
		
		$sql = "SELECT * FROM project WHERE status='Active'";
		$result = $database->query($sql);
		while($project = $database->fetch_array($result)) {
		
        $html .= '<table cellpadding="5" cellspacing="5">
            <tr style="margin: 10px 0px;">
            	<td colspan="2" style="background-color: #1C85DB; color: #FFFFFF; text-align: center;"> 
				#'. $project["project_id"] .' - '. $project["project_title"] .' </td>
                <td colspan="2" style="background-color: #1C85DB; color: #FFFFFF; text-align: center;"> 
				'. $project["start_date"] .' - '. $project["end_date"] .' </td>
            </tr>
            <tr>
            	<td style="background-color: #00FFFB;"> Client Name </td> <td> '. $project["client_name"] .' </td>
                <td style="background-color: #00FFFB;"> Client Phone </td> <td> '. $project["client_phone"] .' </td>
            </tr>
            <tr>
            	<td style="background-color: #00FFFB;"> Cost in USD </td> <td> $'. $project["cost_in_usd"] .' </td>
                <td style="background-color: #00FFFB;"> Department </td> <td> '. $project["department"] .' </td>
            </tr>
            <tr>
            	<td style="background-color: #00FFFB;"> Completed </td> <td> '. $project["completed"] .' </td>
                <td style="background-color: #00FFFB;"> Taxation </td> <td> '. $project["taxation"] .' </td>
            </tr>
            <tr>
            	<td style="background-color: #00FFFB;"> Sub-Contructor </td> <td> '. $project["subcontractor"] .' </td>
                <td style="background-color: #00FFFB;"> Unit </td> <td> '. $project["unit"] .' </td>
            </tr>
            <tr>
            	<td style="background-color: #00FFFB;"> ASCC Employee </td> <td> '. $project["project_by_ascc_employee"] .' </td>
                <td style="background-color: #00FFFB;"> Invoice AFs </td> <td> '. $project["invoice_afs"] .' AFs </td>
            </tr>
            <tr>
            	<td style="background-color: #00FFFB;"> Invoice USD </td> <td> $'. $project["invoice_usd"] .' </td>
                <td style="background-color: #00FFFB;"> Rate </td> <td> '. $project["rate"] .' </td>
            </tr>
            <tr>
            	<td style="background-color: #00FFFB;"> Recived Date </td> <td> '. $project["received_date"] .' </td>
                <td style="background-color: #00FFFB;"> Total Amount Spent </td> <td> $'. $project["total_amount_spent"] .' </td>
            </tr>
            <tr>
            	<td style="background-color: #00FFFB;"> Total Amount Shared </td> <td> $'. $project["total_amount_shared"] .' </td>
                <td style="background-color: #00FFFB;"> Net Profit USD </td> <td> $'. $project["net_profit_usd"] .' </td>
            </tr>
            <tr style="border-bottom: 1px solid: #CCCCCC;">
            	<td style="background-color: #00FFFB;"> Net Profit AFs </td> <td> '. $project["net_profit_afs"] .' AFs </td>
            </tr>
            <tr>
            	<td colspan="4"> <h3> Description of Activities </h3> 
                <p> '. $project["description_of_activities"] .' </p> </td>
            </tr>
			</table>';
		}
	// output the HTML content
	$pdf->writeHTML($html, true, false, true, false, '');
	
	// Change to Avoid the PDF Error
	ob_end_clean();
	// -----------------------------------------------------------------
	
	// Close and output PDF document 
	// This method has several options, check the source code documentation for more information.
	$pdf->Output('projects_report.pdf', 'I');
	
	//========================================================================+
	// END OF FILE
	//========================================================================+