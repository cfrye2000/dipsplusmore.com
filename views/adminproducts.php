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
    </span>Products Admin</h1>
    <p>&nbsp;</p>
    <h3 class="pbold2" >Products</h3>
    </p>
    <hr />
    <p>&nbsp;</p>
    <?$p = new Products();?>
    <button class="showAdd"">ADD a New Product</button>
    <div class="formAdd">
			<fieldset>
			<legend>New Product Details</legend>
			<input id="idAdd" type="hidden" value="" />
			<label for="name">Product Id</label><br />
			<input name="productid" id="productidAdd" type="text" value="" /><br />
			<label for="name">Name</label><br />
			<input name="name" id="nameAdd" type="text" value="" /><br />
			<label for="description">Description</label><br />
			<input name="description" id="descriptionAdd" type="text" value="" /><br />
			<label for="ingredients">Ingredients</label><br />
			<input name="ingredients" id="ingredientsAdd" type="text" value="" /><br />
			<label for="price">Price</label><br />
			<input name="price" id="priceAdd" type="text" value="0.00" /><br />
			<label for="weight">Weight</label><br />
			<input name="weight" id="weightAdd" type="text" value="" /><br />
			<label for="category">Category</label><br />
			<select name="category" id="categoryAdd">
			<?
			$categories = $this->categories;
			foreach($categories as $c){
			?>
			  <option value="<?echo $c->value->categoryid?>" ><?echo $c->value->name?></option>
			<?}?>
			</select><br />
			<label for="sequence">Sequence</label><br />
			<input name="sequence" id="sequenceAdd" type="text" value="0" /><br />
			<label for="image">Image Name</label><br />
			<input name="image" id="imageAdd" type="text" value="image.jpg" /><br />
			<label for="isvisible">Visible?</label>
			<input name="isvisible" id="isvisibleAdd" type="checkbox" <? echo ($p->isvisible == "true")?  'checked="checked" value="true"' : 'value="false"'?> /><br />
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
    	$.post("/adminproducts/addproduct",
    		{"id":$("input#idAdd").val(),
    		 "productid":$("input#productidAdd").val(),
    		 "name":$("input#nameAdd").val(),
    		 "description":$("input#descriptionAdd").val(),
    		 "ingredients":$("input#ingredientsAdd").val(),
    		 "price":$("input#priceAdd").val(),
    		 "weight":$("input#weightAdd").val(),
    		 "category":$("select#categoryAdd option:selected").val(),
    		 "sequence":$("input#sequenceAdd").val(),
    		 "image":$("input#imageAdd").val(),
    		 "isvisible":($("input#isvisibleAdd").is(":checked"))?"true":"false"   
    		},
    		function(data){
    			$("div.messageAdd")
    				.css("background", "yellow")
    				.html(data);
    		});
    	$("div.messageAdd").show();
    	
    });
    </script>
	  
	  
	  <h3 class="pbold2" >Existing Products</h3>
	<div id="events">
	
    <?
	$products = $this->products;
	foreach($products as $p){

		  echo $p->value->productid . ', ' . $p->value->name . '. ';
		  echo '<button class="show' . $p->id . '">edit</button>';
	?>
	  <br/>
	  <div class="form<?echo $p->id?>">
			<fieldset>
			<legend>Edit Details</legend>
			<input id="id<?echo $p->id?>" type="hidden" value="<?echo $p->id;?>" />
			<label for="productid">Product Id</label><br />
			<input name="productid" id="productid<?echo $p->id?>" type="text" value="<?echo $p->value->productid;?>" /><br />
			<label for="name">Name</label><br />
			<input name="name" id="name<?echo $p->id?>" type="text" value="<?echo $p->value->name;?>" /><br />
			<label for="description">Description</label><br />
			<input name="description" id="description<?echo $p->id?>" type="text" value="<?echo $p->value->description;?>" /><br />
			<label for="ingredients">Ingredients</label><br />
			<input name="ingredients" id="ingredients<?echo $p->id?>" type="text" value="<?echo $p->value->ingredients;?>" /><br />
			<label for="price">Price</label><br />
			<input name="price" id="price<?echo $p->id?>" type="text" value="<?echo $p->value->price;?>" /><br />
			<label for="weight">Weight</label><br />
			<input name="weight" id="weight<?echo $p->id?>" type="text" value="<?echo $p->value->weight;?>" /><br />
			<label for="category">Category</label><br />
			<select name="category" id="category<?echo $p->id?>">
			<?
			$categories = $this->categories;
			foreach($categories as $c){
			?>
			  <option value="<?echo $c->value->categoryid?>" <? echo ($p->value->category == $c->value->categoryid)?  'selected' : ''?>><?echo $c->value->name?></option>
			<?}?>
			</select><br />
			<label for="sequence">Sequence</label><br />
			<input name="sequence" id="sequence<?echo $p->id?>" type="text" value="<?echo $p->value->sequence;?>" /><br />
			<label for="image">Image Name</label><br />
			<input name="image" id="image<?echo $p->id?>" type="text" value="<?echo $p->value->image;?>" /><br />
			<label for="isvisible">Visible?</label>
			<input name="isvisible" id="isvisible<?echo $p->id?>" type="checkbox" <? echo ($p->value->isvisible == "true")?  'checked="checked" value="true"' : 'value="false"'?> /><br />
			<button class="post<?echo $p->id;?>">Save</button>&nbsp;
			<button class="done<?echo $p->id;?>">Cancel</button>
			<button class="delete<?echo $p->id;?>">Delete</button><br />
			<br />
			<div class="message<?echo $p->id;?>" />

			</fieldset>
	  </div>
	  <script>
    $("button.show<?echo $p->id?>").click(function () {
    	$("div.form<?echo $p->id?>").toggle();
    	$("div.message<?echo $p->id?>").hide();
    });
    $("button.done<?echo $p->id?>").click(function () {
    	$("div.form<?echo $p->id?>").slideUp();
    });
    $("button.post<?echo $p->id?>").click(function () {
    	$.post("/adminproducts/updateproduct",
    		{"id":$("input#id<?echo $p->id?>").val(),
    		 "productid":$("input#productid<?echo $p->id?>").val(),
    		 "name":$("input#name<?echo $p->id?>").val(),
    		 "description":$("input#description<?echo $p->id?>").val(),
    		 "ingredients":$("input#ingredients<?echo $p->id?>").val(),
    		 "price":$("input#price<?echo $p->id?>").val(),
    		 "weight":$("input#weight<?echo $p->id?>").val(),
    		 "category":$("select#category<?echo $p->id?>").val(),
    		 "sequence":$("input#sequence<?echo $p->id?>").val(),
    		 "image":$("input#image<?echo $p->id?>").val(),
    		 "isvisible":($("input#isvisible<?echo $p->id?>").is(":checked"))?"true":"false"   
    		},
    		function(data){
    			$("div.message<?echo $p->id?>")
    				.css("background", "yellow")
    				.html(data);
    		});
    	$("div.message<?echo $p->id?>").show();
    	
    	
    });
    $("button.delete<?echo $p->id?>").click(function () {
    	$.post("/adminproducts/deleteproduct",
    		{"id":$("input#id<?echo $p->id?>").val()},
    		function(data){
    			$("div.message<?echo $p->id?>")
    				.css("background", "yellow")
    				.html(data);
    		});
    	$("div.message<?echo $p->id?>").show();
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
