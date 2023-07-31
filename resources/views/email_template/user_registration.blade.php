@extends('email_template.email_master')
@section('content')

	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td align="left" valign="middle">Hello {{$name}} ,</td>
		</tr>
		<tr>
			<td align="left" valign="middle">&nbsp;</td>
		</tr>
		<tr>
			<td align="left" valign="middle">A new user account has been created for you in SSLogistics. The details are as follows:- </td>
		</tr>
		<tr>
			<td align="left" valign="middle">&nbsp;</td>
		</tr>
		<tr>
			<td align="left" valign="middle">
				<table>
					<tr><td>Email :</td><td>{{$email}}</td></tr>
					<tr><td>Password :</td><td>{{$password}}</td></tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="left" valign="middle">&nbsp;</td>
		</tr>
		<tr>
			<td align="left" valign="middle">Regards,</td>
		</tr>
		<tr>
			<td>SSLogistics</td>
		</tr>
	</table>

@endsection


