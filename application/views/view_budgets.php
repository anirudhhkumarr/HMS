
<head>
       <title>Budgets</title>
</head>
<body>
<center>
       <h1>Budgets</h1>
       <?php 
       if(sizeof($budgets) == 0){
           echo 'No budgets<br>';
       }
       else{
		   foreach($budgets as $budget){?>
				<tr valign="top">
						<tr valign="top">
							<a href="<?php echo base_url('budget/view/budget/'.$budget['budget_id']);?>"><?php echo $budget['budget_subject'];?>
								<td  align="left"><?php echo $budget['budget_subject'];?></td>
							</a>
							<td>
								<?php echo $budget['budget_recipient'];?>
							</td>
							<td>
								<?php echo $budget['budget_sender'];?>
							</td>
						</tr>
				</tr>
				<br>--------------------------------------------------<br>
		<?php }}?>
</body>
</html>		   
