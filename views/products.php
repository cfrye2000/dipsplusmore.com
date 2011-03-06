<?php include("headerGeneral.php"); ?>
<?
$category = $this->category;
?>
<div id="contentdips"> 
<div id="titleproduct"> 

    <h1><span class="title">Dips and More Products</span><br /> 
     <?echo $category->name?></span><br /> 
    </h1> 
    <p>&nbsp; </p> 
    <p><span class="pbold2">Contact Us to Place an Order</span><br /> 
Connie and Steven Jennings<br /> 
317-937-5410 or
    317-205-6289<br /> 
    <a href="mailto:dipsandmore@yahoo.com" class="email">dipsandmore@yahoo.com</a> </p> 
</div> 
    
<?
$products = $this->products;
foreach($products as $p){
?>
<div id="productpicture1"> 
 
<img src="/application/views/images/<?echo $p->value->image?>" width="180" height="190" alt="<?echo $p->value->name?>" /></div> 
    <div id="productinfo1"> 
      <div id="productname"><h2><?echo $p->value->name?>
      </h2> 
      </div> 
    <div id="description"> 
    Ingredients: <?echo $p->value->ingredients?>
    </div> 
    <div id="netweight"> Net Weight: <?echo $p->value->weight?></div> 
      <div id="item"></div> 
       
       <div id="quantity"> 
    <tr> 
<td align="left"><br/></td> 
        
      </div> 
        <div id="price"> 
  <table width="195" border="0" cellpadding="0"> 
    <tr> 
      <td width="107" height="29" align="left" valign="middle" class="pbold2">Price $<?echo $p->value->price?> ea.</td> 
      <td width="77">&nbsp;</td> 
      <td width="77"><a href="/cart/add/product/<?echo $p->value->_id?>">add to cart</a></td>
    </tr> 
  </table> 
    </div> 
    
</div> 
 
<?
}
?>

</div> 
 
 
 
 
    
<?php include("footerGeneral.php"); ?>
