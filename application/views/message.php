<head>
       <meta charset="utf-8">
       <title>Message</title>
       <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
       <script>
               $(document).ready(function(){
               });
       </script>
</head>
<table  class="table1" width="100%" cellpadding="1" cellspacing="0" border="0" align="center">
	<tbody>
		<tr><td height="5" colspan="2" ></td></tr>
		<tr>
			<td align="center">
				<table width="100%" cellpadding="0" cellspacing="2" border="0" align="center" >
					<tbody>
						<tr>
							<td align="right" valign="top" width="20%"><b>To:&nbsp;&nbsp;</b></td>
							<td align="left" valign="top" width="80%"><?php echo $message['message_sender'];?></td>
						</tr>
						<tr>
							<td align="right" valign="top" width="20%"><b>From:&nbsp;&nbsp;</b></td>
							<td align="left" valign="top" width="80%"><?php echo $message['message_recipient'];?></td>
						</tr>
						<tr>
							<td align="right" valign="top" width="20%"><b>Subject:&nbsp;&nbsp;</b></td>
							<td align="left" valign="top" width="80%"><?php echo $message['message_subject'];?></td>
						</tr>
						<tr>
							<td align="right" valign="top" width="20%"><b>End Date</b></td>
							<td align="left" valign="top" width="80%"></td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr><td height="5" colspan="2" ></td></tr>
	</tbody>
</table>
<table class="table2" width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
	<tbody>
		<tr>
			<td align="left"><br><pre><?php echo $message['message_description'];?></pre></td>
		</tr>
		<tr><td height="5" colspan="2" ></td></tr>
	</tbody>
</table>
</body>
</html>
