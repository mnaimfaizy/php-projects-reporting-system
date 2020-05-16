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
	$pdf->SetTitle('Projects Budget Report');
	$pdf->SetSubject('Reports of all projects budget');
	$pdf->SetKeywords('Project, budget, report, PDF, pdf');
	
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
		<h2> Budget of projects </h2>
        
        <table style="width: 100%; border: 1px solid #B3B3B3;" cellpadding="4" cellspacing="4">
        	<tr style="border: 1px solid #009BFF; background-color: #009BFF; color: #FFFFFF;">
            	<th style="width:10%;"> Project id </th>
                <th style="width:10%;"> Project Title </th>
                <th style="width:50%;"> Description </th>
                <th style="width:10%;"> Start Date </th>
                <th style="width:10%;"> End Date </th>
                <th style="width:10%;"> Completed </th>
            </tr>';
    
	$sql = "SELECT * FROM project WHERE status='Active'";
	$result = $database->query($sql);
	while($project = $database->fetch_array($result)) {
	   
       $html .= '<tr>
            	<td style="width:10%;"> '. $project['project_id'] .' </td>
                <td style="width:10%;"> '. $project['project_title'] .' </td>
                <td style="width:50%;"> '. $project['description_of_activities'] .' </td>
                <td style="width:10%;"> '. $project['start_date'] .' </td>
                <td style="width:10%;"> '. $project['end_date'] .' </td>
                <td style="width:10%;"> '. $project['completed'] .' </td>
            </tr>
			<tr>
				<td style="width:10%;"> &nbsp; </td>
                <td style="width:10%;"> &nbsp; </td>
                <td style="width:50%;"> &nbsp; </td>
                <td style="width:10%;"> &nbsp; </td>
                <td style="width:10%;"> &nbsp; </td>
                <td style="width:10%;"> &nbsp; </td>
			</tr>';
	}
     $html .= '</table>';
	
	// output the HTML content
	$pdf->writeHTML($html, true, false, true, false, '');
	
	// Change to Avoid the PDF Error
	ob_end_clean();
	// -----------------------------------------------------------------
	
	// Close and output PDF document 
	// This method has several options, check the source code documentation for more information.
	$pdf->Output('completed_projects_report.pdf', 'I');
	
	//========================================================================+
	// END OF FILE
	//========================================================================+