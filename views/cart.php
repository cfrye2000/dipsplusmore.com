<?php include("headerGeneral.php"); ?>

<div id="contentdips"> 
<div id="titleproduct"> 
    <h1><span class="title">Shopping Cart</span></h1> 
</div>
<?
if ($cart->inflatedProducts != null){
	foreach ($cart->inflatedProducts as $p) {
		$carttotal = $carttotal + $p->price;
?>
		
<div class="product<?echo $p->_id?>">	
<div id="productpicture1"> 
 
<img src="/application/views/images/<?echo $p->image?>" width="180" height="190" alt="<?echo $p->name?>" /></div> 
    <div id="productinfo1"> 
      <div id="productname"><h2><?echo $p->name?>
      </h2> 
      </div> 
    <div id="description"> 
    Ingredients: <?echo $p->ingredients?>
    </div> 
    <div id="netweight"> Net Weight: <?echo $p->weight?></div> 
      <div id="item"></div> 
       
       <div id="quantity"> 
    <tr> 
<td align="left"><br/></td> 
        
      </div> 
        <div id="price"> 
  <table width="195" border="0" cellpadding="0"> 
    <tr> 
      <td width="107" height="29" align="left" valign="middle" class="pbold2">Price $<?echo $p->price?> ea.</td> 
      <td width="77">&nbsp;</td> 
      <td width="77"><text onMouseOver = "this.style.color = '#F30';" onMouseOut = "this.style.color = '#807166';" class="delete<?echo $p->_id?>">remove</text><div class="loadergif<?echo $p->_id?>"><img src="/application/views/images/ajax-loader.gif"/></div></td>
    </tr> 
  </table> 
    </div> 
    
</div>	
</div>
<script>
    $("div.loadergif<?echo $p->_id?>").hide();
    $("text.delete<?echo $p->_id?>").click(function () {
    	$("div.loadergif<?echo $p->_id?>").show();
    	$.post("/cart/remove",
    		{"productid":"<?echo $p->_id?>"},
    		function(data){
    			$("div.loadergif<?echo $p->_id?>").hide();
    			$("div.product<?echo $p->_id?>").remove();
    		});
    });
</script>
<p/>
<?
	}
}
?>
</div>
<br/>
<div id="titleproduct"> 
    <h1><span class="title">Cart Total: <?echo $carttotal?></span></h1> 
</div>

<?php include("footerGeneral.php"); ?>
