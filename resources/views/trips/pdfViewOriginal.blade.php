<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SSLogistics</title>
</head>

<body style="margin:0; padding:0;">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
  <tr>
    <td align="left" valign="top" style="border: 1px solid #000; border-collapse: collapse;">
    	<table width="100%" border="0">
  <tr>
    <td width="15%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;"><img src="{{asset('/images/pdf_logo.jpg')}}" alt="SSLogistics" /></td>
    <td width="85%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px; text-align:center;">
    <table width="100%" border="0">
      <tr>
        <td style="font-family: Arial, Helvetica, sans-serif; font-size:20px; color:#000; font-weight: bold; text-align:center;">S. S. Logistics</td>
      </tr>
      <tr>
        <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; text-align:center; padding:3px 0;">11/5/1 Cossipore Road, Kolkata, West Bengal - 700002<br />
          Phone: +91 9007759038, +91 98365 82274, Email- info@sslogistics.org<br />
         GSTIN: 19ACFFS8681L1Z8<br />
         Consignment Note
         </td>
      </tr>
    </table>

    
    </td>
    <td width="15%" align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px; text-align:right;">Original</td>
  </tr>
  <tr>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;">&nbsp;</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px; text-align:center;">&nbsp;</td>
    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px; text-align:right;">&nbsp;</td>
  </tr>
  
      </table>

<table width="100%" border="0">
  <tr>
    <td width="14%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">LR No.:</td>
    <td width="29%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{record.lr_no}}</td>
    <td width="19%" align="left" valign="top">&nbsp;</td>
    <td width="10%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">FROM:</td>
    <td width="28%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{record.start_location}}</td>
  </tr>
  <tr>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">DATE:</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{formatDate(record.trip_date) |  date:'dd-MM-yyyy :: hh:mm:ss a'}}</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">TO:</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{record.end_location}}</td>
  </tr>
  <tr>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
  </tr>
  
</table>


<table width="100%" border="0">
  <tr>
    <td width="19%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">Consignor M/S:</td>
    <td width="45%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{record.plant_description}}</td>
    <td width="2%" align="left" valign="top">&nbsp;</td>
    <td width="14%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">TRUCK:</td>
    <td width="20%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{record.truck_no}}</td>
  </tr>
  <tr>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">Consignee M/S:</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{record.party_name}}</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">Trip No:</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{trip_no}}</td>
  </tr>
  <tr>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
  </tr>
  
</table>


<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
  <tr>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000; border-left:0px;">No of Bags</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000;">WT</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000;">DESCRIPTION</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000;">RATE</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000;">DIESEL</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000; border-right:0px;">ADVANCE</td>
    </tr>
  <tr>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000; border-left:0px;">@{{no_of_bags}}</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000;">@{{record.quantity}}</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000;">@{{record.category_name}} - @{{subCatName}}</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000;">@{{tripPayment.rate}}</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000;">@{{record.diesel_amount}}</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000; border-right:0px;">@{{record.advance_amount}}</td>
    </tr>
</table>


<table width="100%" border="0">
	
    <tr>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
  </tr>
    
  <tr>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">INVOICE NO:</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{record.invoice_challan_no}}</td>
    </tr>
  <tr>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">SHIPMENT/DELIVERY NO:</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{record.do_shipment_no}}</td>
    </tr>
  
  
</table>


<table width="100%" border="0">

   
  <tr>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">Received above material in Good Condition</td>
    </tr>
  
  </table>
<table width="100%" border="0">
  <tr>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{record.user_name}}</td>
    </tr>
  <tr>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">Consignee Signature with Seal</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">For, S. S. Logistics</td>
    </tr>
  <tr>
    <td colspan="3" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">Note: All disputes are subjected to Kolkata Jurisdiction</td>
    </tr>
    
</table></td>
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
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
  <tr>
    <td align="left" valign="top" style="border: 1px solid #000; border-collapse: collapse;">
    	<table width="100%" border="0">
  <tr>
    <td width="15%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;"><img src="{{asset('/images/pdf_logo.jpg')}}" alt="SSLogistics" /></td>
    <td width="85%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px; text-align:center;">
    <table width="100%" border="0">
  <tr>
    <td style="font-family: Arial, Helvetica, sans-serif; font-size:20px; color:#000; font-weight: bold; text-align:center;">S. S. Logistics</td>
  </tr>
  <tr>
    <td style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; font-weight: bold; text-align:center; padding:3px 0 0 0;">@{{record.plant_name}}</td>
  </tr>
  <tr>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; text-align:center; padding:3px 0;">Phone: +91 9007759038, +91 98365 82274, Email- info@sslogistics.org<br />
      GSTIN: 19ACFFS8681L1Z8</td>
  </tr>
  <tr>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; text-align:center; text-decoration: underline;">Payment Voucher</td>
  </tr>
</table>

    
    </td>
    <td width="15%" align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px; text-align:right;">Original</td>
  </tr>
  <tr>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;">&nbsp;</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px; text-align:center;">&nbsp;</td>
    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px; text-align:right;">&nbsp;</td>
  </tr>
  
      </table>

<table width="100%" border="0">
  <tr>
    <td width="10%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">LR No.:</td>
    <td width="23%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{record.lr_no}}</td>
    <td align="left" valign="top">&nbsp;</td>
    <td width="11%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">DATE:</td>
    <td width="20%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{formatDate(record.trip_date) |  date:'dd-MM-yyyy :: hh:mm:ss a'}}</td>
  </tr>
  <tr>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">Pay to:</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{record.truck_owner}}</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">Trip No:</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{trip_no}}</td>
  </tr>
  <tr>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
  </tr>
  
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
  <tr>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000; border-left:0px;">TRUCK</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000;">QTY</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000;">PARTY</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000;">DESTINATION</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000; border-right:0px;">CASH AMOUNT PAID</td>
    </tr>
  <tr>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000; border-left:0px;">@{{record.truck_no}}</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000;">@{{record.quantity}}</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000;">@{{record.party_name}}</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000;">@{{record.end_location}}</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000; border-right:0px;">@{{record.advance_amount}}</td>
    </tr>
</table>
<table width="100%" border="0">
  
  
  <tr>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">Amount in Words: @{{advanceWords}} </td>
    </tr>
  
</table>
<table width="100%" border="0">
  <tr>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;"><table width="200" border="0">
      <tr>
        <td style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; border-bottom:1px solid #000;">&nbsp;</td>
      </tr>
    </table></td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{record.user_name}}</td>
    </tr>
  <tr>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:5px 10px 5px 50px;">Receiver Signature</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">For, S. S. Logistics</td>
    </tr>
  <tr>
    <td colspan="3" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">Note: All disputes are subjected to Kolkata Jurisdiction</td>
    </tr>
    
</table></td>
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


<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
  <tr>
    <td align="left" valign="top" style="border: 1px solid #000; border-collapse: collapse;">
    	<table width="100%" border="0">
  <tr>
    <td width="15%" align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;"><img src="{{asset('/images/pdf_logo.jpg')}}" alt="SSLogistics" /></td>
    <td width="85%" align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px; text-align:center;">
      <table width="100%" border="0">
        <tr>
          <td style="font-family: Arial, Helvetica, sans-serif; font-size:20px; color:#000; font-weight: bold; text-align:center;">S. S. Logistics</td>
          </tr>
        <tr>
          <td style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; font-weight: bold; text-align:center; padding:3px 0 0 0;">@{{record.plant_name}} - Diesel Slip</td>
          </tr>
        <tr>
          <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; text-align:center; padding:3px 0;">@{{record.petrol_pump_name}}</td>
          </tr>
        </table>
      
      
    </td>
    <td width="15%" align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px; text-align:right;">Original</td>
    </tr>
  <tr>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px; text-align:left;">&nbsp;</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px; text-align:center;">&nbsp;</td>
    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; padding:3px;">&nbsp;</td>
  </tr>
  
      </table>
   	  <table width="100%" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
   	    <tr>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000; border-left:0px;">Trip No</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000;">DATE</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000;">LR NO</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000;">TRUCK</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000; border-right:0px;">DIESEL</td>
    </tr>
  <tr>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000; border-left:0px;">@{{trip_no}}</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000;">@{{formatDate(record.trip_date) |  date:'dd-MM-yyyy :: hh:mm:ss a'}}</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000;">@{{record.lr_no}}</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000;">@{{record.truck_no}}</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px; border:1px solid #000; border-right:0px;">@{{record.diesel_amount}}</td>
    </tr>
</table>
   	  <table width="100%" border="0">
      <tr>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
    </tr>
   	 <tr>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">&nbsp;</td>
    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">@{{record.user_name}}</td>
    </tr>
  <tr>
    <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">Pump Signature &amp; Sign</td>
    <td align="center" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">Slip is valid for 24 Hour from Loading Date &amp; Time</td>
    <td align="right" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size:11px; color:#000; padding:3px 5px;">For, S. S. Logistics</td>
    </tr>
  
    
</table></td>
  </tr>
</table>
</body>
</html>
