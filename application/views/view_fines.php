
<head>
       <title>Fines</title>
</head>
<body>
<center>
       <h1>Fines</h1>
       <?php 
       if(sizeof($fines) == 0){
           echo 'No fines<br>';
       }
       else{
		   foreach($fines as $fine){?>
				<tr valign="top">
						<tr valign="top">
							<a href="<?php echo base_url('fine/view/fine/'.$fine['fine_id']);?>"><?php echo $fine['fine_subject'];?>
								<td  align="left"><?php echo $fine['fine_subject'];?></td>
							</a>
							<td>
								<?php echo $fine['fine_recipient'];?>
							</td>
							<td>
								<?php echo $fine['fine_sender'];?>
							</td>
						</tr>
				</tr>
				<br>--------------------------------------------------<br>
		<?php }}?>
</body>
</html>		   
