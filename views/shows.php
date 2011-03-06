<?php include("headerGeneral.php"); ?>


<div id="contentevents">
    <h1><span class="title">Dips and More<br />
    </span>Event Dates</h1>
    <p>&nbsp;</p>
    <h3 class="pbold2" >Selling All Stars Dips and Desserts</h3>
    <p><span class="pbold2">Owners</span><br />
      Shane and Connie Jennings<br />
      2944 Limber Pine Dr. Whiteland, IN. 46184<a href="mailto:www.dipsandmore@yahoo.com" class="email"><br />
        www.dipsandmore@yahoo.com</a>
  </h3>
    </p>
    <hr />
    <p>&nbsp;</p>
    <?
	$events = $this->events;
	foreach($events as $name => $month){
	?>
	<p ><span class="pbold2"><?echo $name?></span><br />
	<?
		foreach ($month as &$e){
	  	  if (date(jS, strtotime($e->value->startdatetime)) == date(jS, strtotime($e->value->enddatetime))){
	  	  	echo date(jS, strtotime($e->value->startdatetime));
	  	  } else {
		  	echo date(jS, strtotime($e->value->startdatetime)) . '-' . date(jS, strtotime($e->value->enddatetime));
	  	  }
		  echo ' ' . $e->value->city . ', ' . $e->value->state . '. ';
		  echo ' ' . $e->value->name;
	?>
	  <br />
	<?  
		}
	?>
	<br />
	<?
	}
	?>
</p>

 
 </div>
 <?php include("footerGeneral.php"); ?>
