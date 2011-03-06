<?php include("headerGeneral.php"); ?>

  <script>
  $(document).ready(function () {
  $("*[class^=form]").hide();
});
  </script>
<p>&nbsp;</p>
<?$user = $this->user;?>
<div id="contentdips"> 
<h3 class="pbold2" >Account for <?echo $user->userid?></h3>
	<div id="events">
	<p />
    <text onMouseOver = "this.style.color = '#F30';" onMouseOut = "this.style.color = '#807166'"; class="show1">View/Edit Your Account Information</text>
	  <br/>
	  <div class="form1">
			<fieldset>
			<legend>Account Details</legend>
			<input id="id" type="hidden" value="<?echo $user->_id;?>" />
			<label for="userid">User ID</label><br />
			<input name="userid" id="userid" type="text" value="<?echo $user->userid?>" /><br />
			<label for="firstname">First Name</label><br />
			<input name="firstname" id="firstname" type="text" value="<?echo $user->firstname?>" /><br />
			<label for="lastname">Last Name</label><br />
			<input name="lastname" id="lastname" type="text" value="<?echo $user->lastname?>" /><br />
			<label for="email">Email</label><br />
			<input name="email" id="email" type="text" value="<?echo $user->email?>" /><br />
			<label for="telephone">Telephone Number</label><br />
			<input name="telephone" id="telephone" type="text" value="<?echo $user->telephone?>" /><br />
			<button class="post1">Save</button>&nbsp;
			<button class="done1">Cancel</button>&nbsp;
			<br />
			<!--<div class="message1" />-->
			<div class="loadergif1"><img src="/application/views/images/ajax-loader.gif"/></div>
			<div class="message1" />
			</fieldset>
	  </div>
	  <script>
	$("div.loadergif1").hide();
    $("text.show1").click(function () {
    	$("div.form1").toggle();
    	$("div.message1").hide();
    });
    $("button.done1").click(function () {
    	$("div.form1").slideUp();
    });
    $("button.post1").click(function () {
    	$("div.loadergif1").show();
    	$("div.message1").hide();
    	$.post("/account/updateUser",
    		{"id":$("input#id").val(),
    		 "userid":$("input#userid").val(),
    		 "email":$("input#email").val(),
    		 "firstname":$("input#firstname").val(),
    		 "lastname":$("input#lastname").val(),
    		 "telephone":$("input#telephone").val(),
    		},
    		function(data){
    			$("div.loadergif1").hide();
    			if (data.indexOf("error") != -1){
    				$("div.message1")
    				.css("background", "yellow")
    				.html(data);
    				$("div.message1").show();
    			}
    		});
    	
    	
    });
    $("button.delete1").click(function () {
    	$.post("/admincategories/deletecategory",
    		{"id":$("input#id").val()},
    		function(data){
    			$("div.message")
    				.css("background", "yellow")
    				.html(data);
    		});
    	$("div.message").show();
    });
    </script>
    <p />
	<text onMouseOver = "this.style.color = '#F30';" onMouseOut = "this.style.color = '#807166'"; class="show2">View or change entries in my address book</text>
	<div class="form2">
			<fieldset>
			<legend>Billing Address</legend>
			<input id="id" type="hidden" value="<?echo $user->_id;?>" />
			<label for="baddress1">Address 1</label><br />
			<input name="baddress1" id="baddress1" type="text" value="<?echo $user->billingaddress->address1;?>" /><br />
			<label for="baddress2">Address 2</label><br />
			<input name="baddress2" id="baddress2" type="text" value="<?echo $user->billingaddress->address2;?>" /><br />			
			<label for="bcity">City</label><br />
			<input name="bcity" id="bcity" type="text" value="<?echo $user->billingaddress->city;?>" /><br />			
			<label for="bstate">State</label><br />
				
			
			<select name="bstate" id="bstate">
				<option <? echo ($user->billingaddress->state == 'None')? 'selected="selected"' : ''?> value="None">Please Select</option>
				<option <? echo ($user->billingaddress->state == 'AL')? 'selected="selected"' : ''?> value="AL">Alabama</option>
				<option <? echo ($user->billingaddress->state == 'AK')? 'selected="selected"' : ''?> value="AK">Alaska</option>
				<option <? echo ($user->billingaddress->state == 'AS')? 'selected="selected"' : ''?> value="AS">American Samoa</option>
				<option <? echo ($user->billingaddress->state == 'AZ')? 'selected="selected"' : ''?> value="AZ">Arizona</option>
				<option <? echo ($user->billingaddress->state == 'AR')? 'selected="selected"' : ''?> value="AR">Arkansas</option>
				<option <? echo ($user->billingaddress->state == 'CA')? 'selected="selected"' : ''?> value="CA">California</option>
				<option <? echo ($user->billingaddress->state == 'CO')? 'selected="selected"' : ''?> value="CO">Colorado</option>
				<option <? echo ($user->billingaddress->state == 'CT')? 'selected="selected"' : ''?> value="CT">Connecticut</option>
				<option <? echo ($user->billingaddress->state == 'DE')? 'selected="selected"' : ''?> value="DE">Delaware</option>
				<option <? echo ($user->billingaddress->state == 'DC')? 'selected="selected"' : ''?> value="DC">District of Columbia</option>
				<option <? echo ($user->billingaddress->state == 'FL')? 'selected="selected"' : ''?> value="FL">Florida</option>
				<option <? echo ($user->billingaddress->state == 'GA')? 'selected="selected"' : ''?> value="GA">Georgia</option>
				<option <? echo ($user->billingaddress->state == 'GU')? 'selected="selected"' : ''?> value="GU">Guam</option>
				<option <? echo ($user->billingaddress->state == 'HI')? 'selected="selected"' : ''?> value="HI">Hawaii</option>
				<option <? echo ($user->billingaddress->state == 'ID')? 'selected="selected"' : ''?> value="ID">Idaho</option>
				<option <? echo ($user->billingaddress->state == 'IL')? 'selected="selected"' : ''?> value="IL">Illinois</option>
				<option <? echo ($user->billingaddress->state == 'IN')? 'selected="selected"' : ''?> value="IN">Indiana</option>
				<option <? echo ($user->billingaddress->state == 'IA')? 'selected="selected"' : ''?> value="IA">Iowa</option>
				<option <? echo ($user->billingaddress->state == 'KS')? 'selected="selected"' : ''?> value="KS">Kansas</option>
				<option <? echo ($user->billingaddress->state == 'KY')? 'selected="selected"' : ''?> value="KY">Kentucky</option>
				<option <? echo ($user->billingaddress->state == 'LA')? 'selected="selected"' : ''?> value="LA">Louisiana</option>
				<option <? echo ($user->billingaddress->state == 'ME')? 'selected="selected"' : ''?> value="ME">Maine</option>
				<option <? echo ($user->billingaddress->state == 'MD')? 'selected="selected"' : ''?> value="MD">Maryland</option>
				<option <? echo ($user->billingaddress->state == 'MA')? 'selected="selected"' : ''?> value="MA">Massachusetts</option>
				<option <? echo ($user->billingaddress->state == 'MI')? 'selected="selected"' : ''?> value="MI">Michigan</option>
				<option <? echo ($user->billingaddress->state == 'MN')? 'selected="selected"' : ''?> value="MN">Minnesota</option>
				<option <? echo ($user->billingaddress->state == 'MS')? 'selected="selected"' : ''?> value="MS">Mississippi</option>
				<option <? echo ($user->billingaddress->state == 'MO')? 'selected="selected"' : ''?> value="MO">Missouri</option>
				<option <? echo ($user->billingaddress->state == 'MT')? 'selected="selected"' : ''?> value="MT">Montana</option>
				<option <? echo ($user->billingaddress->state == 'NE')? 'selected="selected"' : ''?> value="NE">Nebraska</option>
				<option <? echo ($user->billingaddress->state == 'NV')? 'selected="selected"' : ''?> value="NV">Nevada</option>
				<option <? echo ($user->billingaddress->state == 'NH')? 'selected="selected"' : ''?> value="NH">New Hampshire</option>
				<option <? echo ($user->billingaddress->state == 'NJ')? 'selected="selected"' : ''?> value="NJ">New Jersey</option>
				<option <? echo ($user->billingaddress->state == 'NM')? 'selected="selected"' : ''?> value="NM">New Mexico</option>
				<option <? echo ($user->billingaddress->state == 'NY')? 'selected="selected"' : ''?> value="NY">New York</option>
				<option <? echo ($user->billingaddress->state == 'NC')? 'selected="selected"' : ''?> value="NC">North Carolina</option>
				<option <? echo ($user->billingaddress->state == 'ND')? 'selected="selected"' : ''?> value="ND">North Dakota</option>
				<option <? echo ($user->billingaddress->state == 'OH')? 'selected="selected"' : ''?> value="OH">Ohio</option>
				<option <? echo ($user->billingaddress->state == 'OK')? 'selected="selected"' : ''?> value="OK">Oklahoma</option>
				<option <? echo ($user->billingaddress->state == 'OR')? 'selected="selected"' : ''?> value="OR">Oregon</option>
				<option <? echo ($user->billingaddress->state == 'PA')? 'selected="selected"' : ''?> value="PA">Pennsylvania</option>
				<option <? echo ($user->billingaddress->state == 'RI')? 'selected="selected"' : ''?> value="RI">Rhode Island</option>
				<option <? echo ($user->billingaddress->state == 'SC')? 'selected="selected"' : ''?> value="SC">South Carolina</option>
				<option <? echo ($user->billingaddress->state == 'SD')? 'selected="selected"' : ''?> value="SD">South Dakota</option>
				<option <? echo ($user->billingaddress->state == 'TN')? 'selected="selected"' : ''?> value="TN">Tennessee</option>
				<option <? echo ($user->billingaddress->state == 'TX')? 'selected="selected"' : ''?> value="TX">Texas</option>
				<option <? echo ($user->billingaddress->state == 'UT')? 'selected="selected"' : ''?> value="UT">Utah</option>
				<option <? echo ($user->billingaddress->state == 'VT')? 'selected="selected"' : ''?> value="VT">Vermont</option>
				<option <? echo ($user->billingaddress->state == 'VA')? 'selected="selected"' : ''?> value="VA">Virginia</option>
				<option <? echo ($user->billingaddress->state == 'WA')? 'selected="selected"' : ''?> value="WA">Washington</option>
				<option <? echo ($user->billingaddress->state == 'WV')? 'selected="selected"' : ''?> value="WV">West Virginia</option>
				<option <? echo ($user->billingaddress->state == 'WI')? 'selected="selected"' : ''?> value="WI">Wisconsin</option>
				<option <? echo ($user->billingaddress->state == 'WY')? 'selected="selected"' : ''?> value="WY">Wyoming</option>
			</select><br />
			<label for="bzip">Zipcode</label><br />
			<input name="bzip" id="bzip" type="text" value="<?echo $user->billingaddress->zip;?>" /><br />		

			</fieldset>
			
			<fieldset>
			<legend>Shipping Address</legend>
			<input id="id" type="hidden" value="<?echo $user->_id;?>" />
			<label for="saddress1">Address 1</label><br />
			<input name="saddress1" id="saddress1" type="text" value="<?echo $user->shippingaddress->address1;?>" /><br />
			<label for="saddress2">Address 2</label><br />
			<input name="saddress2" id="saddress2" type="text" value="<?echo $user->shippingaddress->address2;?>" /><br />			
			<label for="scity">City</label><br />
			<input name="scity" id="scity" type="text" value="<?echo $user->shippingaddress->city;?>" /><br />			
			<label for="sstate">State</label><br />
			<select name="sstate" id="sstate">
				<option <? echo ($user->shippingaddress->state == 'None')? 'selected="selected"' : ''?> value="None">Please Select</option>
				<option <? echo ($user->shippingaddress->state == 'AL')? 'selected="selected"' : ''?> value="AL">Alabama</option>
				<option <? echo ($user->shippingaddress->state == 'AK')? 'selected="selected"' : ''?> value="AK">Alaska</option>
				<option <? echo ($user->shippingaddress->state == 'AS')? 'selected="selected"' : ''?> value="AS">American Samoa</option>
				<option <? echo ($user->shippingaddress->state == 'AZ')? 'selected="selected"' : ''?> value="AZ">Arizona</option>
				<option <? echo ($user->shippingaddress->state == 'AR')? 'selected="selected"' : ''?> value="AR">Arkansas</option>
				<option <? echo ($user->shippingaddress->state == 'CA')? 'selected="selected"' : ''?> value="CA">California</option>
				<option <? echo ($user->shippingaddress->state == 'CO')? 'selected="selected"' : ''?> value="CO">Colorado</option>
				<option <? echo ($user->shippingaddress->state == 'CT')? 'selected="selected"' : ''?> value="CT">Connecticut</option>
				<option <? echo ($user->shippingaddress->state == 'DE')? 'selected="selected"' : ''?> value="DE">Delaware</option>
				<option <? echo ($user->shippingaddress->state == 'DC')? 'selected="selected"' : ''?> value="DC">District of Columbia</option>
				<option <? echo ($user->shippingaddress->state == 'FL')? 'selected="selected"' : ''?> value="FL">Florida</option>
				<option <? echo ($user->shippingaddress->state == 'GA')? 'selected="selected"' : ''?> value="GA">Georgia</option>
				<option <? echo ($user->shippingaddress->state == 'GU')? 'selected="selected"' : ''?> value="GU">Guam</option>
				<option <? echo ($user->shippingaddress->state == 'HI')? 'selected="selected"' : ''?> value="HI">Hawaii</option>
				<option <? echo ($user->shippingaddress->state == 'ID')? 'selected="selected"' : ''?> value="ID">Idaho</option>
				<option <? echo ($user->shippingaddress->state == 'IL')? 'selected="selected"' : ''?> value="IL">Illinois</option>
				<option <? echo ($user->shippingaddress->state == 'IN')? 'selected="selected"' : ''?> value="IN">Indiana</option>
				<option <? echo ($user->shippingaddress->state == 'IA')? 'selected="selected"' : ''?> value="IA">Iowa</option>
				<option <? echo ($user->shippingaddress->state == 'KS')? 'selected="selected"' : ''?> value="KS">Kansas</option>
				<option <? echo ($user->shippingaddress->state == 'KY')? 'selected="selected"' : ''?> value="KY">Kentucky</option>
				<option <? echo ($user->shippingaddress->state == 'LA')? 'selected="selected"' : ''?> value="LA">Louisiana</option>
				<option <? echo ($user->shippingaddress->state == 'ME')? 'selected="selected"' : ''?> value="ME">Maine</option>
				<option <? echo ($user->shippingaddress->state == 'MD')? 'selected="selected"' : ''?> value="MD">Maryland</option>
				<option <? echo ($user->shippingaddress->state == 'MA')? 'selected="selected"' : ''?> value="MA">Massachusetts</option>
				<option <? echo ($user->shippingaddress->state == 'MI')? 'selected="selected"' : ''?> value="MI">Michigan</option>
				<option <? echo ($user->shippingaddress->state == 'MN')? 'selected="selected"' : ''?> value="MN">Minnesota</option>
				<option <? echo ($user->shippingaddress->state == 'MS')? 'selected="selected"' : ''?> value="MS">Mississippi</option>
				<option <? echo ($user->shippingaddress->state == 'MO')? 'selected="selected"' : ''?> value="MO">Missouri</option>
				<option <? echo ($user->shippingaddress->state == 'MT')? 'selected="selected"' : ''?> value="MT">Montana</option>
				<option <? echo ($user->shippingaddress->state == 'NE')? 'selected="selected"' : ''?> value="NE">Nebraska</option>
				<option <? echo ($user->shippingaddress->state == 'NV')? 'selected="selected"' : ''?> value="NV">Nevada</option>
				<option <? echo ($user->shippingaddress->state == 'NH')? 'selected="selected"' : ''?> value="NH">New Hampshire</option>
				<option <? echo ($user->shippingaddress->state == 'NJ')? 'selected="selected"' : ''?> value="NJ">New Jersey</option>
				<option <? echo ($user->shippingaddress->state == 'NM')? 'selected="selected"' : ''?> value="NM">New Mexico</option>
				<option <? echo ($user->shippingaddress->state == 'NY')? 'selected="selected"' : ''?> value="NY">New York</option>
				<option <? echo ($user->shippingaddress->state == 'NC')? 'selected="selected"' : ''?> value="NC">North Carolina</option>
				<option <? echo ($user->shippingaddress->state == 'ND')? 'selected="selected"' : ''?> value="ND">North Dakota</option>
				<option <? echo ($user->shippingaddress->state == 'OH')? 'selected="selected"' : ''?> value="OH">Ohio</option>
				<option <? echo ($user->shippingaddress->state == 'OK')? 'selected="selected"' : ''?> value="OK">Oklahoma</option>
				<option <? echo ($user->shippingaddress->state == 'OR')? 'selected="selected"' : ''?> value="OR">Oregon</option>
				<option <? echo ($user->shippingaddress->state == 'PA')? 'selected="selected"' : ''?> value="PA">Pennsylvania</option>
				<option <? echo ($user->shippingaddress->state == 'RI')? 'selected="selected"' : ''?> value="RI">Rhode Island</option>
				<option <? echo ($user->shippingaddress->state == 'SC')? 'selected="selected"' : ''?> value="SC">South Carolina</option>
				<option <? echo ($user->shippingaddress->state == 'SD')? 'selected="selected"' : ''?> value="SD">South Dakota</option>
				<option <? echo ($user->shippingaddress->state == 'TN')? 'selected="selected"' : ''?> value="TN">Tennessee</option>
				<option <? echo ($user->shippingaddress->state == 'TX')? 'selected="selected"' : ''?> value="TX">Texas</option>
				<option <? echo ($user->shippingaddress->state == 'UT')? 'selected="selected"' : ''?> value="UT">Utah</option>
				<option <? echo ($user->shippingaddress->state == 'VT')? 'selected="selected"' : ''?> value="VT">Vermont</option>
				<option <? echo ($user->shippingaddress->state == 'VA')? 'selected="selected"' : ''?> value="VA">Virginia</option>
				<option <? echo ($user->shippingaddress->state == 'WA')? 'selected="selected"' : ''?> value="WA">Washington</option>
				<option <? echo ($user->shippingaddress->state == 'WV')? 'selected="selected"' : ''?> value="WV">West Virginia</option>
				<option <? echo ($user->shippingaddress->state == 'WI')? 'selected="selected"' : ''?> value="WI">Wisconsin</option>
				<option <? echo ($user->shippingaddress->state == 'WY')? 'selected="selected"' : ''?> value="WY">Wyoming</option>
			</select><br />			
			<label for="szip">Zipcode</label><br />
			<input name="szip" id="szip" type="text" value="<?echo $user->shippingaddress->zip;?>" /><br />			
			
			
			</fieldset>
			<fieldset>
			<button class="post2">Save</button>&nbsp;
			<button class="done2">Cancel</button>&nbsp;
			<br />
			<div class="loadergif2"><img src="/application/views/images/ajax-loader.gif"/></div>
			<div class="message2" />
			</fieldset>
			
	  </div>
	  <script>
	$("div.loadergif2").hide();
    $("text.show2").click(function () {
    	$("div.form2").toggle();
    	$("div.message2").hide();
    });
    $("button.done2").click(function () {
    	$("div.form2").slideUp();
    });
    $("button.post2").click(function () {
    	$("div.loadergif2").show();
    	$("div.message2").hide();
    	$.post("/account/updateUser",
    		{"id":$("input#id").val(),
    		 "userid":$("input#userid").val(),
    		 "billingaddress":{"address1":$("input#baddress1").val(),
    		 	"address2":$("input#baddress2").val(),
    		 	"city":$("input#bcity").val(),
    		 	"state":$("select#bstate option:selected").val(),
    		 	"zip":$("input#bzip").val(),
    		 },
    		 "shippingaddress":{"address1":$("input#saddress1").val(),
    		 	"address2":$("input#saddress2").val(),
    		 	"city":$("input#scity").val(),
    		 	"state":$("select#sstate option:selected").val(),
    		 	"zip":$("input#szip").val(),
    		 },
    		 
    		},
    		function(data){
    			$("div.loadergif2").hide();
    			if (data.indexOf("error") != -1){
    				$("div.message2")
    				.css("background", "yellow")
    				.html(data);
    				$("div.message2").show();
    			}
    		});
    	
    	
    });
    $("button.delete2").click(function () {
    	$.post("/admincategories/deletecategory",
    		{"id":$("input#id").val()},
    		function(data){
    			$("div.message")
    				.css("background", "yellow")
    				.html(data);
    		});
    	$("div.message").show();
    });
    </script>
	<p />
	<text onMouseOver = "this.style.color = '#F30';" onMouseOut = "this.style.color = '#807166'"; class="show3">Change my account password</text>
	<div class="form3">
			<fieldset>
			<legend>Edit Details</legend>
			<input id="id" type="hidden" value="<?echo $user->_id;?>" />
			<label for="oldpassword">Old Password</label><br />
			<input name="oldpassword" id="oldpassword" type="password" value="" /><br />
			<label for="newpassword">New Password</label><br />
			<input name="newpassword" id="newpassword" type="password" value="" /><br />
			<label for="confirmpassword">Confirm New Password</label><br />
			<input name="confirmpassword" id="confirmpassword" type="password" value="" /><br />
			<button class="post3">Save</button>&nbsp;
			<button class="done3">Cancel</button>&nbsp;
			<br />
			<div class="loadergif3"><img src="/application/views/images/ajax-loader.gif"/></div>
			<div class="message3" />

			</fieldset>
	  </div>
	  <script>
	 $("div.loadergif3").hide();
    $("text.show3").click(function () {
    	$("div.form3").toggle();
    	$("div.message3").hide();
    });
    $("button.done3").click(function () {
    	$("div.form3").slideUp();
    });
    $("button.post3").click(function () {
    	$("div.loadergif3").show();
    	$("div.message3").hide();
    	$.post("/account/updatePassword",
    		{"id":$("input#id").val(),
    		 "userid":$("input#userid").val(),
    		 "oldpassword":$("input#oldpassword").val(),
    		 "newpassword":$("input#newpassword").val(),
    		 "confirmpassword":$("input#confirmpassword").val(),
    		},
    		function(data){
    			$("div.loadergif3").hide();
    			if (data.indexOf("error") != -1){
    				$("div.message3")
    				.css("background", "yellow")
    				.html(data);
    				$("div.message3").show();
    			}
    		});
    	
    	
		    });
		    $("button.delete3").click(function () {
		    	$.post("/admincategories/deletecategory",
		    		{"id":$("input#id").val()},
		    		function(data){
		    			$("div.message")
		    				.css("background", "yellow")
		    				.html(data);
		    		});
		    	$("div.message").show();
		    });
    </script>
	</div>
<p/>
</div>
<?php include("footerGeneral.php"); ?>

