<?php

/*****************************************************/
# Trip Controller             
# Class name : TripController
# Functionality: listing, add, edit, view of trips,generating reports
# Author : Sanchari Ghosh                                 
# Created Date :  31/08/2018                                
# Purpose: Developing the functionality of listing, add, edit, view of trips, generating reports
/*****************************************************/
namespace App\Http\Controllers;

use PDFTC;


class TestController extends Controller {
 
	/*****************************************************/
	# Trip Controller             
	# Class name : TripController
	# Functionality: constructor
	# Author : Sanchari Ghosh                                 
	# Created Date : 31/08/2018                                 
	# Purpose:  
	# Params :                                            
	/*****************************************************/
	public function __construct()
	{ 

	}



	public function downloadPDF(){

		$LogoImageFileName = env('DOMAIN_NAME').'/images/pdf_logo.jpg'; 
        PDFTC::SetTitle('Trip Data');
	    PDFTC::AddPage();


        $originalHtmlData = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>SSLogistics</title>
		</head>

		<body style="margin:0; padding:0;" id="pdfOriginalDataHolder">
		<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
		  <tr>
		    <td align="left" valign="top" style="border: 1px solid #000; border-collapse: collapse;">
		    	<table width="100%" border="0" cellpadding="0">
		  			<tr>
		    			<td width="15%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:30px 5px 5px 5px;"><img src="'.$LogoImageFileName.'" alt="SSLogistics" /></td>
		    			<td width="75%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:center;">
								<table width="100%" border="0">
									<tr>
										<td width="100%" style="font-family: Arial, Helvetica, sans-serif; font-size:14px;line-height:18px; color:#000; font-weight: bold; text-align:center;">S. S. Logistics</td>
									</tr>
									<tr>
										<td width="100%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px;line-height:14px; color:#000; text-align:center; padding:3px 0;">11/5/1 Cossipore Road, Kolkata, West Bengal - 700002<br />
												Phone: +91 9007759038, +91 98365 82274, Email- info@sslogistics.org<br />
											GSTIN: 19ACFFS8681L1Z8<br />
											<strong><u>Consignment Note</u></strong>
										</td>
										</tr>
								</table>		    
		    				</td>
								<td width="10%" align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px;line-height:24px; color:#000; padding:3px; text-align:right;">
									Original
								</td>
		  			</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;">&nbsp;</td>
							<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:center;">&nbsp;</td>
							<td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:right;">&nbsp;</td>
						</tr>
		      </table>
					<table width="100%" border="0">
						<tr>
							<td width="20%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">LR No.:</td>
							<td width="25%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TEST</td>
							<td width="5%" align="left" valign="top">&nbsp;</td>
							<td width="12%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">FROM:</td>
							<td width="33%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TEST</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">DATE:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TEST</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TO:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TEST</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">&nbsp;</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">&nbsp;</td>
						</tr>
						
					</table>
					<table width="100%" border="0">
						<tr>
							<td width="20%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">Consignor M/S:</td>
							<td width="25%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TEST</td>
							<td width="5%" align="left" valign="top">&nbsp;</td>
							<td width="12%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TRUCK:</td>
							<td width="33%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TEST</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">Consignee M/S:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">TEST</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">Trip No:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">TEST</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">&nbsp;</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">&nbsp;</td>
						</tr>
						
					</table>
				<table width="100%" border="0" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
					<tr width="100%">
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000; border-left:none;">No of Bags</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">WT</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">DESCRIPTION</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">RATE</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">DIESEL</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000; border-right:none;">ADVANCE</td>
						</tr>
					<tr  width="100%">
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000; border-left:none;">TEST</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">TEST</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">TEST</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">TEST</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">TEST</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000;border:1px solid #000; border-right:none;">TEST</td>
						</tr>
				</table>
				<table width="100%" border="0" cellpadding="0" cellspacing="0" >
					
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
					</tr>
						
					<tr>
						<td width="30%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">INVOICE NO:</td>
						<td width="70%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TEST</td>
						</tr>
					<tr>
						<td width="30%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">SHIPMENT/DELIVERY NO:</td>
						<td width="70%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TEST</td>
						</tr>
						<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
					</tr>
				</table>


				<table width="100%" border="0">
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">Received above material in Good Condition</td>
					</tr>
					<tr>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
					</tr>
		  </table>
				<table width="100%" border="0">
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
						<td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">TEST</td>
						</tr>
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">Consignee Signature with Seal</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
						<td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">For, S. S. Logistics</td>
						</tr>
						<tr>
						<td colspan="3" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:15px; color:#000; padding:3px 5px;">Note: All disputes are subjected to Kolkata Jurisdiction</td>
					</tr>
						
				</table>
		</td>
		  </tr>
		</table>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <tr>
		    <td style="border-bottom: 1px dashed #000; font-size:2px; height:10px">&nbsp;</td>
		  </tr>
		  <tr>
		    <td style="font-size:2px; height:10px">&nbsp;</td>
		  </tr>
		</table>
		<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
		  <tr>
		    <td align="left" valign="top" style="border: 1px solid #000; border-collapse: collapse;">
		    	<table width="100%" border="0" cellpadding="0" >
		  <tr>
		    <td width="15%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;"><img src="'.$LogoImageFileName.'" alt="SSLogistics" /></td>
		    <td width="75%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:center;">
		    <table width="100%" border="0">
		  <tr>
		    <td style="font-family: Arial, Helvetica, sans-serif; font-size:14px;line-height:18px; color:#000; font-weight: bold; text-align:center;">S. S. Logistics</td>
		  </tr>
		  <tr>
						<td width="100%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px;line-height:14px; color:#000; text-align:center; padding:3px 0;">11/5/1 Cossipore Road, Kolkata, West Bengal - 700002<br />
						Phone: +91 9007759038, +91 98365 82274, Email- info@sslogistics.org<br />
					GSTIN: 19ACFFS8681L1Z8<br />
					<strong><u>Payment Voucher</u></strong>
				</td>
		  </tr>
		</table>

		    
		    </td>
		    <td width="10%" align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px;line-height:14px; color:#000; padding:3px; text-align:right;">Original</td>
		  </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;">&nbsp;</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:center;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:right;">&nbsp;</td>
		  </tr>
		  
		      </table>

		<table width="100%" border="0">
		  <tr>
		    <td width="20%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">LR No.:</td>
		    <td width="25%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TEST</td>
		    <td width="5%" align="left" valign="top">&nbsp;</td>
		    <td width="12%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">DATE:</td>
		    <td width="33%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TEST</td>
		  </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">Pay to:</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">TEST</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">Trip No:</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">TEST</td>
		  </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">&nbsp;</td>
		    <td align="left" valign="top">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px;padding:3px 5px;">&nbsp;</td>
		  </tr>
		  
		</table>
		<table width="100%" border="0" cellpadding="3" cellspacing="0" style="border-collapse: collapse;">
		  <tr>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; spadding:3px 5px; border:1px solid #000; border-left:none;">TRUCK</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000;">QTY</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000;">PARTY</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000;">DESTINATION</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000; border-right:none;">CASH AMOUNT PAID</td>
		    </tr>
		  <tr>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000; border-left:none;">TEST</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000;">TEST</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000;">TEST</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000;">TEST</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000; border-right:none;">TEST</td>
		    </tr>
		</table>
		<table width="100%" border="0">
		  
				<tr>
				<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
			</tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">Amount in Words: TEST </td>
				</tr>
				<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
					</tr>
		  
		</table>
		<table width="100%" border="0">
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;"><table width="200" border="0">
		      <tr>
		        <td style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border-bottom:1px solid #000;">&nbsp;</td>
		      </tr>
		    </table></td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">TEST</td>
		    </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:5px 10px 5px 50px;">Receiver Signature</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">For, S. S. Logistics</td>
				</tr>
		  <tr>
		    <td colspan="3" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:15px; font-size:9px; color:#000; padding:3px 5px;">Note: All disputes are subjected to Kolkata Jurisdiction</td>
		    </tr>
		    
		</table></td>
		  </tr>
		</table>

		<table width="100%" border="0" cellpadding="10" cellspacing="0">
		  <tr>
		    <td style="border-bottom: 1px dashed #000; font-size:2px; height:10px">&nbsp;</td>
		  </tr>
		  <tr>
		    <td style="font-size:2px; height:10px">&nbsp;</td>
		  </tr>
		</table>
		<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
		  <tr>
		    <td align="left" valign="top" style="border: 1px solid #000; border-collapse: collapse;">
		    	<table width="100%" border="0" >
		  <tr>
		    <td width="15%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;"><img src="'.$LogoImageFileName.'" alt="SSLogistics" /></td>
		    <td width="75%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:center;">
		      <table width="100%" border="0">
		        <tr>
		          <td style="font-family: Arial, Helvetica, sans-serif; font-size:14px;line-height:18px; color:#000; font-weight: bold; text-align:center;">S. S. Logistics</td>
		          </tr>
						<tr>
						<td width="100%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px;line-height:14px; color:#000; text-align:center; padding:3px 0;">11/5/1 Cossipore Road, Kolkata, West Bengal - 700002<br />
												Phone: +91 9007759038, +91 98365 82274, Email- info@sslogistics.org<br />
											GSTIN: 19ACFFS8681L1Z8<br />
											<strong><u>Diesel Slip</u></strong>
										</td>
		          </tr>
		        </table>
		      
		      
		    </td>
		    <td width="10%" align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:right;">Original</td>
		    </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:left;">&nbsp;</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:center;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;">&nbsp;</td>
		  </tr>
		  
		      </table>
					 <table width="100%" border="0" cellpadding="3" cellspacing="0" style="border-collapse: collapse;">
		   	    <tr>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px; border:1px solid #000; border-left:none;">Trip No</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px; border:1px solid #000;">DATE</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px; border:1px solid #000;">LR NO</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px; border:1px solid #000;">TRUCK</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px; border:1px solid #000; border-right:none;">DIESEL</td>
		    </tr>
		  <tr>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px; border:1px solid #000; border-left:none;">TEST</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px; border:1px solid #000;">TEST</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px; border:1px solid #000;">TEST</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px; border:1px solid #000;">TEST</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px; border:1px solid #000; border-right:none;">TEST</td>
		    </tr>
		</table>
		   	  <table width="100%" border="0">
		      <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
		    </tr>
		   	 <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">TEST</td>
		    </tr>
		  <tr>
		    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">Pump Signature &amp; Sign</td>
		    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">Slip is valid for 24 Hour from Loading Date &amp; Time</td>
		    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">For, S. S. Logistics</td>
		    </tr>
		  </table></td>
		  </tr>
		</table>
		</body>
		</html>
		';

		/*page break in pdf*/
		PDFTC::writeHTML($originalHtmlData, true, false, true, false, '');
		PDFTC::AddPage();


		$duplicateHtmlData = '<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
			  <tr>
			    <td align="left" valign="top" style="border: 1px solid #000; border-collapse: collapse;">
			    	<table width="100%" border="0">
			  <tr>
			    <td width="15%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;"><img src="'.$LogoImageFileName.'" alt="SSLogistics" /></td>
			    <td width="75%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:center;">
			    <table width="100%" border="0">
			      <tr>
			        <td style="font-family: Arial, Helvetica, sans-serif; font-size:14px;line-height:18px color:#000; font-weight: bold; text-align:center;">S. S. Logistics</td>
			      </tr>
			      <tr>
						<td width="100%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px;line-height:14px; color:#000; text-align:center; padding:3px 0;">11/5/1 Cossipore Road, Kolkata, West Bengal - 700002<br />
						Phone: +91 9007759038, +91 98365 82274, Email- info@sslogistics.org<br />
					GSTIN: 19ACFFS8681L1Z8<br />
					<strong><u>Consignment Note</u></strong>
				</td>
			      </tr>
			    </table>

			    
			    </td>
			    <td width="10%" align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:right;">Duplicate</td>
			  </tr>
			  <tr>
			    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;">&nbsp;</td>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:center;">&nbsp;</td>
			    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:right;">&nbsp;</td>
			  </tr>
			  
			      </table>

			<table width="100%" border="0">
						<tr>
							<td width="20%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">LR No.:</td>
							<td width="25%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TEST</td>
							<td width="5%" align="left" valign="top">&nbsp;</td>
							<td width="12%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">FROM:</td>
							<td width="33%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TEST</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">DATE:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TEST</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TO:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TEST</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">&nbsp;</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">&nbsp;</td>
						</tr>
						
					</table>
					<table width="100%" border="0">
						<tr>
							<td width="20%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">Consignor M/S:</td>
							<td width="25%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TEST</td>
							<td width="5%" align="left" valign="top">&nbsp;</td>
							<td width="12%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TRUCK:</td>
							<td width="33%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TEST</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">Consignee M/S:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">TEST</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">Trip No:</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">TEST</td>
						</tr>
						<tr>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">&nbsp;</td>
							<td align="left" valign="top">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">&nbsp;</td>
							<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; line-height:14px; padding:3px 5px;">&nbsp;</td>
						</tr>
						
					</table>
				<table width="100%" border="0" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
					<tr width="100%">
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000; border-left:none;">No of Bags</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">WT</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">DESCRIPTION</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">RATE</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">DIESEL</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000; border-right:none;">ADVANCE</td>
						</tr>
					<tr  width="100%">
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000; border-left:none;">TEST</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">TEST</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">TEST</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">TEST</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; border:1px solid #000;">TEST</td>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000;border:1px solid #000; border-right:none;">TEST</td>
						</tr>
				</table>
				<table width="100%" border="0" cellpadding="0" cellspacing="0" >
					
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
					</tr>
						
					<tr>
						<td width="30%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">INVOICE NO:</td>
						<td width="70%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TEST</td>
						</tr>
					<tr>
						<td width="30%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">SHIPMENT/DELIVERY NO:</td>
						<td width="70%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:14px; color:#000; padding:3px 5px;">TEST</td>
						</tr>
						<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
					</tr>
				</table>


				<table width="100%" border="0">
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">Received above material in Good Condition</td>
					</tr>
					<tr>
						<td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
					</tr>
		  </table>
				<table width="100%" border="0">
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
						<td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">TEST</td>
						</tr>
					<tr>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">Consignee Signature with Seal</td>
						<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
						<td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">For, S. S. Logistics</td>
						</tr>
						<tr>
						<td colspan="3" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; line-height:15px; color:#000; padding:3px 5px;">Note: All disputes are subjected to Kolkata Jurisdiction</td>
					</tr>
						
				</table>
			</td>
			  </tr>
			</table>


			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
			    <td style="border-bottom: 1px dashed #000; font-size:2px; height:10px">&nbsp;</td>
			  </tr>
			  <tr>
			    <td style="font-size:2px; height:10px">&nbsp;</td>
			  </tr>
			</table>

			<table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
			  <tr>
			    <td align="center" valign="middle" style="vertical-align: middle; border: 1px solid #000; text-align:center; border-collapse: collapse; height:100px; text-align: center; vertical-align: middle; line-height:100px; font-weight: bold; font-size:22px;">Intentionally Left Blank </td>
			  </tr>
			</table>

			<table width="100%" border="0" cellpadding="0" cellspacing="0">
			  <tr>
			    <td style="border-bottom: 1px dashed #000; font-size:2px; height:10px">&nbsp;</td>
			  </tr>
			  <tr>
			    <td style="font-size:2px; height:10px">&nbsp;</td>
			  </tr>
			</table><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
			  <tr>
			    <td align="left" valign="top" style="border: 1px solid #000; border-collapse: collapse;">
			    	<table width="100%" border="0">
			  <tr>
		    <td width="15%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;"><img src="'.$LogoImageFileName.'" alt="SSLogistics" /></td>
		    <td width="75%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:center;">
		      <table width="100%" border="0">
		        <tr>
		          <td style="font-family: Arial, Helvetica, sans-serif; font-size:14px;line-height:18px; color:#000; font-weight: bold; text-align:center;">S. S. Logistics</td>
		          </tr>
						<tr>
						<td width="100%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px;line-height:14px; color:#000; text-align:center; padding:3px 0;">11/5/1 Cossipore Road, Kolkata, West Bengal - 700002<br />
												Phone: +91 9007759038, +91 98365 82274, Email- info@sslogistics.org<br />
											GSTIN: 19ACFFS8681L1Z8<br />
											<strong><u>Diesel Slip</u></strong>
										</td>
		          </tr>
		        </table>
		      
		      
		    </td>
		    <td width="10%" align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px; text-align:right;">Duplicate</td>
				</tr>
				<tr>
				<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
				<td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
				<td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
				</tr>
			  
			      </table>
			   	  <table width="100%" border="0" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
			   	    <tr>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:14px; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000; border-left:none;">Trip No</td>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:14px; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000;">DATE</td>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:14px; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000;">LR NO</td>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:14px; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000;">TRUCK</td>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:14px; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000; border-right:none;">DIESEL</td>
			    </tr>
			  <tr>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:14px; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000; border-left:none;">TEST</td>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:14px; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000;">TEST</td>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:14px; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000;">TEST</td>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:14px; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000;">TEST</td>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; line-height:14px; font-size:9px; color:#000; padding:3px 5px; border:1px solid #000; border-right:none;">TEST</td>
			    </tr>
			</table>
			   	  <table width="100%" border="0">
			      <tr>
			    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
			    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
			    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
			    </tr>
			   	 <tr>
			    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
			    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">&nbsp;</td>
			    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">TEST</td>
			    </tr>
			  <tr>
			    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">Pump Signature &amp; Sign</td>
			    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">Slip is valid for 24 Hour from Loading Date &amp; Time</td>
			    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:9px; color:#000; padding:3px 5px;">For, S. S. Logistics</td>
			    </tr>
			</table></td>
			  </tr>
			</table>
		';


		/*Output a PDF*/
	    PDFTC::writeHTML($duplicateHtmlData, true, false, true, false, '');
	    PDFTC::Output('hello_world.pdf');

	}
}


?>