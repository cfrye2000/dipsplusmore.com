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
    </span>Categories Admin</h1>
    <p>&nbsp;</p>
    <h3 class="pbold2" >Categories</h3>
    </p>
    <hr />
    <p>&nbsp;</p>
    <button class="showAdd"">ADD a New Category</button>
    <div class="formAdd">
			<fieldset>
			<legend>New Category Details</legend>
			<label for="name">Name</label><br />
			<input name="name" id="nameAdd" type="text" value="" /><br />
			<label for="description">Description</label><br />
			<input name="description" id="descriptionAdd" type="text" value="" /><br />
			<label for="categoryid">Category ID</label><br />
			<input name="categoryid" id="categoryidAdd" type="text" value="" /><br />
			<label for="isvisible">Visible?</label>
			<input name="isvisible" id="isvisibleAdd" type="checkbox" checked="checked" value="true" /><br />
			<button class="postAdd">Save</button>&nbsp;
			<button class="doneAdd">Cancel</button><br />
			<div class="loadergifAdd"><img src="/application/views/images/ajax-loader.gif"/></div>
			<div class="messageAdd" />

			</fieldset>
	  </div>
	  <br/>
	  <p>&nbsp;</p>
	<script>
	$("div.loadergifAdd").hide();
	$("button.showAdd").click(function () {
    	$("div.formAdd").toggle();
    	$("div.messageAdd").hide();
    });
  
    $("button.doneAdd").click(function () {
    	$("div.formAdd").slideUp();
    });

    $("button.postAdd").click(function () {
    	$("div.loadergifAdd").show();
    	$("div.messageAdd").hide();
    	$.post("/admincategories/addcategory",
    		{"name":$("input#nameAdd").val(),
    		 "description":$("input#descriptionAdd").val(),
    		 "categoryid":$("input#categoryidAdd").val(),
    		 "isvisible":($("input#isvisibleAdd").is(":checked"))?"true":"false"   
    		},
    		function(data){
    			$("div.loadergifAdd").hide();
    			if (data.indexOf("error") != -1){
    				$("div.messageAdd")
    				.css("background", "yellow")
    				.html(data);
    				$("div.messageAdd").show();
    			}
    		});
    	
    });
    </script>
	  
	  
	  <h3 class="pbold2" >Existing Categories</h3>
	<div id="events">
	
    <?
	$categories = $this->categories;
	foreach($categories as $c){

		  echo $c->value->name . '. ';
		  echo '<button class="show' . $c->id . '">edit</button>';
	?>
	  <br/>
	  <div class="form<?echo $c->id?>">
			<fieldset>
			<legend>Edit Details</legend>
			<input id="id<?echo $c->id?>" type="hidden" value="<?echo $c->id;?>" />
			<label for="name">Name</label><br />
			<input name="name" id="name<?echo $c->id?>" type="text" value="<?echo $c->value->name;?>" /><br />
			<label for="description">Description</label><br />
			<input name="description" id="description<?echo $c->id?>" type="text" value="<?echo $c->value->description;?>" /><br />
			<label for="categoryid">Category ID</label><br />
			<input name="categoryid" id="categoryid<?echo $c->id?>" type="text" value="<?echo $c->value->categoryid;?>" /><br />
			<label for="isvisible">Visible?</label>
			<input name="isvisible" id="isvisible<?echo $c->id?>" type="checkbox" <? echo ($c->value->isvisible == true)?  'checked="checked" value="true"' : 'value="false"'?> /><br />
			<button class="post<?echo $c->id;?>">Save</button>&nbsp;
			<button class="done<?echo $c->id;?>">Cancel</button>
			<button class="delete<?echo $c->id;?>">Delete</button><br />
			<br />
			<div class="message<?echo $c->id;?>" />

			</fieldset>
	  </div>
	  <script>
    $("button.show<?echo $c->id?>").click(function () {
    	$("div.form<?echo $c->id?>").toggle();
    	$("div.message<?echo $c->id?>").hide();
    });
    $("button.done<?echo $c->id?>").click(function () {
    	$("div.form<?echo $c->id?>").slideUp();
    });
    $("button.post<?echo $c->id?>").click(function () {
    	$.post("/admincategories/updatecategory",
    		{"id":$("input#id<?echo $c->id?>").val(),
    		 "name":$("input#name<?echo $c->id?>").val(),
    		 "description":$("input#description<?echo $c->id?>").val(),
    		 "categoryid":$("input#categoryid<?echo $c->id?>").val(),
    		 "isvisible":($("input#isvisible<?echo $c->id?>").is(":checked"))?'true':'false'  
    		},
    		function(data){
    			$("div.message<?echo $c->id?>")
    				.css("background", "yellow")
    				.html(data);
    		});
    	$("div.message<?echo $c->id?>").show();
    	
    	
    });
    $("button.delete<?echo $c->id?>").click(function () {
    	$.post("/admincategories/deletecategory",
    		{"id":$("input#id<?echo $c->id?>").val()},
    		function(data){
    			$("div.message<?echo $c->id?>")
    				.css("background", "yellow")
    				.html(data);
    		});
    	$("div.message<?echo $c->id?>").show();
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
