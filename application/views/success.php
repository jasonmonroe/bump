<?php include('application/views/includes/header.php');?>

<div id="container">
	<p>Thank You For Registering for the Bumpity Bump Beta Test.  Have a nice day.</p>
</div>
<script type="text/javascript">
	var three_seconds = 3000;
	setTimeout('redirect()',three_seconds);
	function redirect()
	{
		location.href = "<?php echo base_url()?>";
	}
</script>	

<?php include('application/views/includes/footer.php');?>