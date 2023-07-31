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
			<td align="left" valign="middle">A 'Forgot Password' request has been generated for the Email ID: {{$email}}</td>
		</tr>
		<tr>
			<td align="left" valign="middle">&nbsp;</td>
		</tr>
		<tr>
			<td align="left" valign="middle">Click the following link to reset password :- 
				<a href="{{$resetLink}}">
					{{$resetLink}}
				</a>
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


