<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<title>Untitled Document</title> 
<link href="/application/views/mystyle.css" rel="stylesheet" type="text/css" /> 
<script type="text/javascript" src="/application/views/js/jquery-1.4.2.js"></script> 
<script src="/application/views/SpryAssets/SpryMenuBar.js" type="text/javascript"></script> 
<link href="/application/views/SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css" /> 
</head> 
 
<body> 
<div id="wrapper"> 
<?
$categories = $this->categories;
$user = $this->user;
$cart = $this->cart;
?>
<div id="accountBar" align="right">
<? if ($user == null) { ?>
	<a href="/account">sign in/create Account</a>
<? } else { ?>
	signed in as <a href="/account"><?echo $user->userid?></a> (<a href="/logout">sign out</a>)
<? } ?>	
&nbsp;
<? if ($cart == null) { ?>
	<a href="/cart">shopping cart</a> is empty
<? } else { ?>
	<a href="/cart">shopping cart</a> has <?echo sizeof($cart->products)?> items
<? } ?>	
</div>
<div id="navigation"> 

<ul id="MenuBar1" class="MenuBarHorizontal"> 
        <li class="MenuBarHorizontal"><a href="index.html">Home</a>   </li> 
        <li><a href="about.html">About</a></li> 
        <li class="MenuBarHorizontal"><a href="products.html" class="MenuBarItemSubmenu">Products</a> 
          <ul> 
          <?
          foreach($categories as $c){
			?>
			<li><a href="/products/index/cat/<?echo $c->value->categoryid?>"><?echo $c->value->name?></a></li> 
			<?}?>
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
        <li><a href="/events">Events</a></li> 
        <li><a href="contact.html">Contact</a></li> 
  </ul> 
  <script type="text/javascript"> 
<!--
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgDown:"SpryAssets/SpryMenuBarDownHover.gif", imgRight:"SpryAssets/SpryMenuBarRightHover.gif"});
//-->
</script> 
</div> 
 
