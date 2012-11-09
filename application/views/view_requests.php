<head>
	<title>Requests</title>
	<script>
		$(document).ready(function(){
		});
	</script>
</head>
  <center>
	<h1>Requests</h1>
        <?php if(sizeof($requests) == 0){
	    echo 'No requests<br>';
        }?>
        <?php foreach($requests as $request){?>
			<a href="<?php echo base_url('request/view/request/'.$request['request_id']);?>">Subject:<?php echo $request['request_subject'];?></a>
			<br>--------------------------------------------------<br>
		<?php }?>
  </center>
</body>
</html>
