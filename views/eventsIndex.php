<h1>Events</h1>

<?
$events = $this->events;
?>
<?
foreach($events as $name => $month){
?>
<h2><?echo $name?></h2>
<?	
	foreach ($month as &$e){
?>
<div id='event'>
<div id='name'><? echo $e->getName();?></div>
<div id='description'><? echo $e->getdescription();?></div>
<div id='startime'><? echo $e->getStartWeekday() . ', ' . $e->getStartDate();?></div>
<div><? echo $e->getLocationName();?></div>
</div>
<?
	}
}
?>


