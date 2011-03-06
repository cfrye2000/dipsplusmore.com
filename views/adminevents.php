<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<link href="/application/views/mystyle.css" rel="stylesheet" type="text/css" />
<script src="/application/views/SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script type="text/javascript" src="/application/views/js/jquery-1.4.2.js"></script>
<link href="/application/views/SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <script>
  $(document).ready(function () {
  $("*[class^=form]").hide();
});
  </script>

<div id="wrapper">
<div id="navigation">
      
<ul id="MenuBar1" class="MenuBarHorizontal">
        <li class="MenuBarHorizontal"><a href="index.html">Home</a>   </li>
        <li><a href="about.html">About</a></li>
        <li class="MenuBarHorizontal"><a href="products.html" class="MenuBarItemSubmenu">Products<br/> 
        <span class="link">Coming Soon</span></a>
          <ul>
          <li><a href="p_dips.html">Dips</a></li>
            <li><a href="p_desserts.html">Desserts</a></li>
            <li><a href="p_mustard.html">Ben's Sweets and Hot Mustard</a></li>
            <li><a href="p_bbqsauce.html">HB's BBQ Sauce</a></li>
          </ul>
        </li>
    <li><a href="recipes.html">Recipes</a></li>
        <li class="MenuBarHorizontal"><a href="fundraising.html" class="MenuBarItemSubmenu">Fundraising</a>
          <ul>
          <li><a href="i_101fundamentals.html">Fundraising 101</a></li>
            <li><a href="i_schedchecklist.html">Scheduling Checklist</a></li>
            <li><a href="i_instruction.html">Instructions</a></li>
            <li><a href="i_childsafety.html">Child Safety</a></li>
            <li><a href="i_agreementform.html">Agreement Form</a></li>
            <li><a href="i_evaluation.html">Evaluation</a></li>
          </ul>
        </li>
        <li><a href="shows.html">Events</a></li>
        <li><a href="contact.html">Contact</a></li>
  </ul>
  <script type="text/javascript">
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"/application/views/SpryAssets/SpryMenuBarDownHover.gif", imgRight:"/application/views/SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script>
</div>

<div id="contentevents">
    <h1><span class="title">Dips and More<br />
    </span>Event Admin</h1>
    <p>&nbsp;</p>
    <h3 class="pbold2" >Events</h3>
    </p>
    <hr />
    <p>&nbsp;</p>
    <button class="showAdd"">ADD a New Event</button>
    <div class="formAdd">
			<fieldset>
			<legend>New Event Details</legend>
			<label for="name">Name</label><br />
			<input name="name" id="nameAdd" type="text" value="" /><br />
			<label for="description">Description</label><br />
			<input name="description" id="descriptionAdd" type="text" value="" /><br />
			<label for="startDateTime">Start Date and Time</label><br />
			<input name="startDateTime" id="startDateTimeAdd" type="text" value="YYYY/MM/DD 9:00 AM" /><br />
			<label for="endDateTime">End Date and Time</label><br />
			<input name="endDateTime" id="endDateTimeAdd" type="text" value="YYYY/MM/DD 5:00 PM" /><br />
			<label for="locationName">Location</label><br />
			<input name="locationName" id="locationNameAdd" type="text" value="" /><br />
			<label for="address">Address</label><br />
			<input name="address" id="addressAdd" type="text" value="" /><br />
			<label for="city">City</label><br />
			<input name="city" id="cityAdd" type="text" value="" /><br />
			<label for="state">State</label><br />
			<input name="state" id="stateAdd" type="text" value="" /><br />
			<label for="zipcode">Zipcode</label><br />
			<input name="zipcode" id="zipcodeAdd" type="text" value="" /><br />
			<label for="phone">Phone</label><br />
			<input name="phone" id="phoneAdd" type="text" value="" /><br />
			<label for="isvisible">Visible?</label>
			<input name="isvisible" id="isvisibleAdd" type="checkbox" value="0" /><br />
			<button class="postAdd">Save</button>&nbsp;
			<button class="doneAdd">Cancel</button><br />
			<div class="messageAdd" />

			</fieldset>
	  </div>
	  <br/>
	  <p>&nbsp;</p>
	<script>
	$("button.showAdd").click(function () {
    	$("div.formAdd").toggle();
    	$("div.messageAdd").hide();
    });
  
    $("button.doneAdd").click(function () {
    	$("div.formAdd").slideUp();
    });

    $("button.postAdd").click(function () {
    	$.post("/adminevents/addevent",
    		{"id":$("input#eventIdAdd").val(),
    		 "name":$("input#nameAdd").val(),
    		 "description":$("input#descriptionAdd").val(),
    		 "startdatetime":$("input#startDateTimeAdd").val(),
    		 "enddatetime":$("input#endDateTimeAdd").val(),
    		 "location":$("input#locationNameAdd").val(),
    		 "address":$("input#addressAdd").val(),
    		 "city":$("input#cityAdd").val(),
    		 "state":$("input#stateAdd").val(),
    		 "zipcode":$("input#zipcodeAdd").val(),
    		 "phone":$("input#phoneAdd").val(),
    		 "isvisible":($("input#isvisibleAdd").is(":checked"))?'true':'false'   
    		},
    		function(data){
    			$("div.messageAdd")
    				.css("background", "yellow")
    				.html(data);
    		});
    	$("div.messageAdd").show();
    	
    });
    </script>
	  
	  
	  <h3 class="pbold2" >Existing Events</h3>
	<div id="events">
	
    <?
	$events = $this->events;
	foreach($events as $e){
	  	  if (date('jS', strtotime($e->value->startdatetime)) == date('jS', strtotime($e->value->enddatetime))){
	  	  	echo date('jS', strtotime($e->value->startdatetime));
	  	  } else {
		  	echo date('jS', strtotime($e->value->startdatetime)) . '-' . date('jS', strtotime($e->value->enddatetime));
	  	  }
		  echo ' ' . $e->value->city . ', ' . $e->value->state . '. ';
		  echo ' ' . $e->value->name;
		  echo '<button class="show' . $e->id . '">edit</button>';
	?>
	  <br/>
	  <div class="form<?echo $e->id?>">
			<fieldset>
			<legend>Edit Details</legend>
			<input id="eventId<?echo $e->id?>" type="hidden" value="<?echo $e->id;?>" />
			<label for="name">Name</label><br />
			<input name="name" id="name<?echo $e->id?>" type="text" value="<?echo $e->value->name;?>" /><br />
			<label for="description">Description</label><br />
			<input name="description" id="description<?echo $e->id?>" type="text" value="<?echo $e->value->description;?>" /><br />
			<label for="startDateTime">Start Date and Time</label><br />
			<input name="startDateTime" id="startDateTime<?echo $e->id?>" type="text" value="<?echo $e->value->startdatetime;?>" /><br />
			<label for="endDateTime">End Date and Time</label><br />
			<input name="endDateTime" id="endDateTime<?echo $e->id?>" type="text" value="<?echo $e->value->enddatetime;?>" /><br />
			<label for="locationName">Location</label><br />
			<input name="locationName" id="locationName<?echo $e->id?>" type="text" value="<?echo $e->value->location;?>" /><br />
			<label for="address">Address</label><br />
			<input name="address" id="address<?echo $e->id?>" type="text" value="<?echo $e->value->address;?>" /><br />
			<label for="city">City</label><br />
			<input name="city" id="city<?echo $e->id?>" type="text" value="<?echo $e->value->city;?>" /><br />
			<label for="state">State</label><br />
			<input name="state" id="state<?echo $e->id?>" type="text" value="<?echo $e->value->state;?>" /><br />
			<label for="zipcode">Zipcode</label><br />
			<input name="zipcode" id="zipcode<?echo $e->id?>" type="text" value="<?echo $e->value->zipcode;?>" /><br />
			<label for="phone">Phone</label><br />
			<input name="phone" id="phone<?echo $e->id?>" type="text" value="<?echo $e->value->phone;?>" /><br />
			<label for="isvisible">Visible?</label>
			<input name="isvisible" id="isvisible<?echo $e->id?>" type="checkbox" <? echo ($e->value->isvisible == "true")?  'checked="checked" value="true"' : 'value="false"'?> /><br />
			<button class="post<?echo $e->id;?>">Save</button>&nbsp;
			<button class="done<?echo $e->id;?>">Cancel</button>
			<button class="delete<?echo $e->id;?>">Delete</button><br />
			<br />
			<div class="message<?echo $e->id;?>" />

			</fieldset>
	  </div>
	  <script>
    $("button.show<?echo $e->id?>").click(function () {
    	$("div.form<?echo $e->id?>").toggle();
    	$("div.message<?echo $e->id?>").hide();
    });
    $("button.done<?echo $e->id?>").click(function () {
    	$("div.form<?echo $e->id?>").slideUp();
    });
    $("button.post<?echo $e->id?>").click(function () {
    	$.post("/adminevents/updateevent",
    		{"id":$("input#eventId<?echo $e->id?>").val(),
    		 "name":$("input#name<?echo $e->id?>").val(),
    		 "description":$("input#description<?echo $e->id?>").val(),
    		 "startdatetime":$("input#startDateTime<?echo $e->id?>").val(),
    		 "enddatetime":$("input#endDateTime<?echo $e->id?>").val(),
    		 "location":$("input#locationName<?echo $e->id?>").val(),
    		 "address":$("input#address<?echo $e->id?>").val(),
    		 "city":$("input#city<?echo $e->id?>").val(),
    		 "state":$("input#state<?echo $e->id?>").val(),
    		 "zipcode":$("input#zipcode<?echo $e->id?>").val(),
    		 "phone":$("input#phone<?echo $e->id?>").val(),
    		 "isvisible":($("input#isvisible<?echo $e->id?>").is(":checked"))?'true':'false'   
    		},
    		function(data){
    			$("div.message<?echo $e->id?>")
    				.css("background", "yellow")
    				.html(data);
    		});
    	$("div.message<?echo $e->id?>").show();
    	
    	
    });
    $("button.delete<?echo $e->id?>").click(function () {
    	$.post("/adminevents/deleteevent",
    		{"id":$("input#eventId<?echo $e->id?>").val()},
    		function(data){
    			$("div.message<?echo $e->id?>")
    				.css("background", "yellow")
    				.html(data);
    		});
    	$("div.message<?echo $e->id?>").show();
    });
    </script>
	  <br />
	<?  
	}
	?>
	<br />
	</div>
	
</p>
<p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
	<p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
	<p>&nbsp;</p>
  <p>&nbsp;</p>
 
 </div>
   <div id="footer">
    <table width="800" cellspacing="5" cellpadding="5px">
      <tr>
        <td width="359"><span class="footer">&copy; Copyright 2010 Lisa Frye Design <a href="http://www.lisafrye.org">www.lisafrye.org</a></span></td>
        <td width="404"><span class="footer">Contact: Connie and Steven Jennings 
 
317-205-6289 or <a href="mailto:www.dipsandmore@yahoo.com" class="email">www.dipsandmore@yahoo.com</a></span></td>
      </tr>
    </table>
</div>
</div>

<script type="text/javascript">
</script>
</body>
</html>
