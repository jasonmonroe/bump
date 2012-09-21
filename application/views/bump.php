<?php include('application/views/includes/header.php');?> 

<script type="text/javascript">
$(document).ready(function(){
	var duration = 300;
	$('li.optional').hide();
	$('#newsletter').attr('checked', false);
	
	// show and hide optional information
	$('#newsletter').on('click', function(){

		if($(this).is(':checked'))
			$('li.optional').show(duration);
		 
		else $('li.optional').hide(duration);	 
	});
});
</script>

<script type="text/javascript">
/* This function validates the optional fields if the newsletter checkbox is pressed. */
function validate()
{
	if($('#newsletter').is(':checked'))
	{ 
		if($('#address').val() == '')
		{
			alert('You need to fill in your address.');
			return false;
		}
		 
		if($('#city').val() == '' || $('#city').val().length < 2)
		{
			alert('You need to fill in your city.');
			return false;
		}
		 
		if($('#state').val() == '')
		{
			alert('You need to fill in your state.');
			return false;
		}
		 
		if($('#zip').val() == '' || $.isNumeric($('#zip').val()) == false)
		{
			alert('You need to fill in your zip code.');
			return false;
		}
		 
		if( ($('#address').val() != '') && ($('#city').val() != '') && ($('#state').val() != '') && ($('#zip').val() != '') )
		{
			//alert('Everything complete!');
			return true;
		}
	}	
}
</script>

<div id="container">
    <div id="panel">
    	<header>Registration </header>
        <form name="register-form" id="register-form" method="post" action="">
			
        	<div class="form-border">
                <div class="form-content-left">
                    <ul>
                        <li>
                            <label for="first-name">First Name*</label>
                            <input type="text" name="first-name" id="first-name" value="<?php echo set_value('first-name'); ?>" maxlength="64" />
                            <?php echo form_error('first-name');?>
                        </li>
                        <li>
                            <label for="last-name">Last Name*</label>
                            <input type="text" name="last-name" id="last-name" value="<?php echo set_value('last-name'); ?>" maxlength="64" />
                            <?php echo form_error('last-name'); ?>
                        </li>
                        <li>
                            <label for="email">Email*</label>
                            <input type="text" name="email" id="email" value="<?php echo set_value('email'); ?>" maxlength="32" />
                            <?php echo form_error('email'); ?>
                        </li>
                        <li>
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" value="<?php echo set_value('phone'); ?>" maxlength="10" size="10" />
                            <?php echo form_error('phone'); ?>
                        </li>
                    </ul>
                </div>
                <div class="form-content-right">
                    <ul>
                        <span style="font-size:14px;font-weight:normal;margin-bottom:3px;">Newsletter</span>
                        <li class="ios-checkbox">     	
                            <input type="checkbox" name="newsletter" id="newsletter" class="newsletter" value="on"/>
                            <label for="newsletter">Newsletter</label>  
                            <?php echo form_error('newsletter'); ?>
                        </li>
                        <li class="optional">	
                            <label for="address">Address*</label>
                            <input type="text" name="address" id="address" value="<?php echo set_value('address'); ?>" maxlength="64"/>
                            <?php echo form_error('address'); ?>
                        </li>
                        <li class="optional">
                            <label for="address-suffix">Address Suffix</label>
                            <input type="text" name="address-suffix" id="address-suffix" value="<?php echo set_value('address-suffix'); ?>" maxlength="8" size="8"/>
                            <?php echo form_error('address-suffix'); ?>
                        </li>
                        <li class="optional">
                            <label for="city">City*</label>
                            <input type="text" name="city" id="city" value="<?php echo set_value('city'); ?>" />
                            <?php echo form_error('city'); ?>
                        </li>
                        <li class="optional">
                            <label for="state">State*</label>
                            <select name="state" id="state">
                                <option value="" selected="selected"></option>
                                <option value="AL">Alabama</option>
                                <option value="AK">Alaska</option>
                                <option value="AZ">Arizona</option>
                                <option value="AR">Arkansas</option>
                                <option value="CA">California</option>
                                <option value="CO">Colorado</option>
                                <option value="CT">Connecticut</option>
                                <option value="DE">Delaware</option>
                                <option value="DC">District of Columbia</option>
                                <option value="FL">Florida</option>
                                <option value="GA">Georgia</option>
                                <option value="HI">Hawaii</option>
                                <option value="ID">Idaho</option>
                                <option value="IL">Illinois</option>
                                <option value="IN">Indiana</option>
                                <option value="IA">Iowa</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
                                <option value="LA">Louisiana</option>
                                <option value="ME">Maine</option>
                                <option value="MD">Maryland</option>
                                <option value="MA">Massachusetts</option>
                                <option value="MI">Michigan</option>
                                <option value="MN">Minnesota</option>
                                <option value="MS">Mississippi</option>
                                <option value="MO">Missouri</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NV">Nevada</option>
                                <option value="NH">New Hampshire</option>
                                <option value="NJ">New Jersey</option>
                                <option value="NM">New Mexico</option>
                                <option value="NY">New York</option>
                                <option value="NC">North Carolina</option>
                                <option value="ND">North Dakota</option>
                                <option value="OH">Ohio</option>
                                <option value="OK">Oklahoma</option>
                                <option value="OR">Oregon</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="RI">Rhode Island</option>
                                <option value="SC">South Carolina</option>
                                <option value="SD">South Dakota</option>
                                <option value="TN">Tennessee</option>
                                <option value="TX">Texas</option>
                                <option value="UT">Utah</option>
                                <option value="VT">Vermont</option>
                                <option value="VA">Virginia</option>
                                <option value="WA">Washington</option>
                                <option value="WV">West Virginia</option>
                                <option value="WI">Wisconsin</option>
                                <option value="WY">Wyoming</option>
                            </select>
                            <?php echo form_error('state'); ?>
                        </li>
                        <li class="optional">
                            <label for="zip">Zip Code*</label>
                            <input type="text" name="zip" id="zip" value="<?php echo set_value('zip'); ?>" maxlength="5" size="5" />
                            <?php echo form_error('zip'); ?>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
            
            <div class="action">
            	<a href="admin" style="margin-right:520px">Administrator</a> 
                <button type="reset"  name="clear"  id="clear" >Clear</button>
                <button type="submit" name="submit" id="submit" onClick="return validate();">Register Now</button>
            </div>
            <div class="clearfix"></div>
        </form>   
    </div>
</div> 
<?php include('application/views/includes/footer.php');?>