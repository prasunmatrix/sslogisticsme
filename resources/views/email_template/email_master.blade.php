<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Logistics</title>
</head>

<body style="margin:0; padding:0;">
<table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top"><a href="{{ url('') }}" target="_blank"><img src="{{ asset('/images/email_images/logo_mail.jpg') }}" alt="" border="0" /></a></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" valign="top"><img src="{{ asset('/images/email_images/topbanner.jpg') }}" alt="" /></td>
  </tr>
  <tr>
    <td align="left" valign="top">&nbsp;</td>
  </tr>


<tr>
    <td align="left" valign="top" style="padding:20px; background:#ececec;">   
		@yield('content')
    </td>
</tr>


<tr>
	<td align="left" valign="top" style="padding:20px; background:#39b3c0;">
	    
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		    <td align="center" valign="top"><a href="javascript:void(0);" target="_blank" style=" text-decoration: none;"><img src="{{ asset('/images/email_images/facebook.png') }}" alt="" border="0" style="margin:0 5px;" /></a> <a href="javascript:void(0);" target="_blank" style=" text-decoration: none;"><img src="{{ asset('/images/email_images/twitter.png') }}" alt="" border="0" style="margin:0 5px;" />
		  </a> <a href="javascript:void(0);" target="_blank" style=" text-decoration: none;"><img src="{{ asset('/images/email_images/linkedin.png') }}" alt="" border="0" style="margin:0 5px;" />
		  </a> <a href="javascript:void(0);" target="_blank" style=" text-decoration: none;"><img src="{{ asset('/images/email_images/instagram.png') }}" alt="" border="0" style="margin:0 5px;" />
		  </a></td>
		  </tr>
		  <tr>
		    <td align="left" valign="top">&nbsp;</td>
		  </tr>
		  
		  <tr>
		    <td align="center" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:15px; color:#fff;">
		 <a href="javascript:void(0);" style="color:#fff; text-decoration: none;">Terms &amp; Conditions</a> | <a href="javascript:void(0);" style="color:#fff; text-decoration: none;">Privacy Policy</a> | <a href="javascript:void(0);" style="color:#fff; text-decoration: none;">Contact Us</a></td>
		  </tr>
		  <tr>
		    <td align="left" valign="top">&nbsp;</td>
		  </tr>
		  <tr>
		    <td align="center" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; line-height:15px; color:#fff;">
		© <?php echo  date('Y'); ?> – Logistics, All Rights Reserved</td>
		</tr>
	  </table>
	</td>
</tr>
<tr>
  <td align="left" valign="top">&nbsp;</td>
</tr>



</table>

</body>
</html>
