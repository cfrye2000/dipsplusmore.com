<?php include("headerGeneral.php"); ?>
  <script>
  $(document).ready(function () {
  $("*[class^=form]").hide();
});
  </script>
<?$redirect = $this->redirect;?>
<div id="contentdips"> 
<form action="/login/post/redirect/<?echo $redirect?>" method="post">
	<fieldset>
		<legend>Please Login</legend>
		<label for="username">Username</label>
		<input type="text" name="username" id="username" value="" /><br />
		<label for="password">Password</label>
		<input type="password" name="password" id="password" value="" /><br />
		<input type="hidden" name="token" value="<?echo $_SESSION['token'];?>" />
		<input type="submit" name="login_submit" value="Log In" />
		or <a href="/">cancel</a>
	</fieldset>
</form>
<text onMouseOver = "this.style.color = '#000000';" onMouseOut = "this.style.color = '#807166'"; class="show3">Create an Account</text>
	<div class="form3">
			<fieldset>
			<legend>Edit Details</legend>
			<input id="id" type="hidden" value="<?echo $user->_id;?>" />
			<label for="userid">User ID</label><br />
			<input name="userid" id="userid" type="text" value="" /><br />
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
    	$.post("/account/addUser",
    		{"id":$("input#id").val(),
    		 "userid":$("input#userid").val(),
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
</div>
<?php include("footerGeneral.php"); ?>

