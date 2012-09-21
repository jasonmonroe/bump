<?php include('application/views/includes/header.php');?>

<div id="container">
	<?php echo $table;?>
    <div id="paginate"><?php echo $this->pagination->create_links();?></div>
</div>
<script type="text/javascript">
	$('tr:odd').css('background', '#BBC3CF');
</script> 

<?php include('application/views/includes/footer.php');?>