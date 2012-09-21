<?php include('application/views/includes/header.php');?>
	
<script type="text/javascript">
$(document).ready(function(){
 	$('tr:odd').css('background', '#BBC3CF');

	// paginate with the data
	$('.next').live('click', function(){
		var limit = $('#limit').val();
		
		var offset = $(this).attr('id');
	
		$.ajax({
			data: {'offset' : offset, 'limit': limit}, 
			datatype:'JSON',
			type:'POST', 
			url:"<?php echo base_url()?>admin/get_list_ajax",
			success: function(data){
				
				var register = data.register;
				
				// declare table data array
				var row = '';
				var tr = Array;
				$('#register-update-remove').remove();
				
				for(var i=0; i<register.length; i++)
				{
					var img;
					if(register[i].newsletter == 1)
						img = '<img src="<?php echo base_url(); ?>assets/images/yes.png" height="16" width="16" alt="Yes" border="0">';
					
					else if(register[i].newsletter == 0)
						img = '<img src="<?php echo base_url()?>assets/images/no.png" height="16" width="16" alt="Yes" border="0">';
					
					// add row color
					var tr_style = '';
					if((i % 2) != 0)
						tr_style = '<tr style="background:#BBC3CF">';
					else tr_style = '<tr>';
					
					tr[i] = tr_style+"<td>"+register[i].id+"</td><td>"+register[i].first_name+" "+register[i].last_name+"</td><td>"+register[i].email+"</td><td>"+register[i].phone+"</td><td>"+img+"</td><td>"+register[i].address+" "+register[i].address_suffix+"</td><td>"+register[i].city+"</td><td>"+register[i].state+"</td><td>"+register[i].zip+"</td><td>"+register[i].created+"</td></tr>";
					 
					// concatenate rows of data into one variable, then add that variable's html code to the id
					row = row.concat(tr[i]);
				}
				$('#register-update').html(row);
			
				// replace old offset with new one with designation for id
				var new_offset = data.offset;	
				$(this).attr('id', new_offset);
				$('#register-next').html("<a href='#' class='next' id='" + new_offset + "'>next >></a>");
				//console.log($('#register-next'));
			},
			error: function(msg){
				alert('error ! '+msg.responseTxt);
			}
		});
	});
});
</script>

<div id="container">
	<div style="float:right; margin-bottom:15px">
	<select name="limit" id="limit">
    	<option value="10">10</option>
        <option value="15">15</option>
        <option value="25">25</option>
        <option value="50">50</option>
        <option value="100">100</option>
    </select>
    </div>
    <div class="clearfix"></div>
	<table> 
		<thead>
			<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Newsletter</th><th>Address</th><th>City</th><th>State</th><th>Zip</th><th>Registered</th></tr>
		</thead>
        	<tbody id="register-update-remove">
            <?php
			$img = array();
			for($i=0; $i<$num_rows; $i++){
				if($register[$i]->newsletter == 1)
					$img[$i] = '<img src="'.base_url().'assets/images/yes.png" height="16" width="16" alt="Yes" border="0">';
				else if($register[$i]->newsletter == 0)
					$img[$i] = '<img src="'.base_url().'assets/images/no.png" height="16" width="16" alt="No" border="0">';
					
			echo "<tr><td>".$register[$i]->id."</td><td>".$register[$i]->first_name." ".$register[$i]->last_name."</td><td>".$register[$i]->email."</td><td>".$register[$i]->phone."</td><td>".$img[$i]."</td><td>".$register[$i]->address." ".$register[$i]->address_suffix."</td><td>".$register[$i]->city."</td><td>".$register[$i]->state."</td><td>".$register[$i]->zip."</td><td>".$register[$i]->created."</td></tr>";}
			?>
            </tbody>
            
            <tbody id="register-update"></tbody>
         	
	</table>
    
    <!-- this div will be updated once pressed-->
    <div id="register-next">
        <a href="#" class="next" id ="10">next >></a>
    </div>
</div>
<?php include('application/views/includes/footer.php');?>