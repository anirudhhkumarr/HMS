<head>
	<title>Complains</title>
	<script>
		$(document).ready(function(){
		});
	</script>
</head>
  <center>
	<h1>Complains</h1>
        <?php if(sizeof($complains) == 0){
	    echo 'No complains<br>';
        }?>
        <?php foreach($complains as $complain){?>
			<a href="<?php echo base_url('complain/view/complain/'.$complain['complain_id']);?>">Subject:<?php echo $complain['complain_subject'];?></a>
			<br>--------------------------------------------------<br>
		<?php }?>
  </center>
</body>
</html>
