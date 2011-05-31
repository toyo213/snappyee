
<h3><?php echo '<a href = "./home">'.$name.'</a>' ?></h3>
<br/>
<?php echo '<h3> <a href = "./stats"> YOUR STATS </a></h3>';?>
<br/>
<?php echo  '<a href = "./logout"> Log Out  </a>';?>



<?php 

//foreach ($cons as $item){ 

//	echo "<tr><td>" ;	
//	echo $item["Fb_connection"]["fb_id_2"]."<br/>";
//    echo "</td></tr>";
//}

//echo $item["Fb_connection"]["fb_id_2"]."<br/>";
//var_dump($cons["0"]["Fb_connection"]["fb_id_2"])



?>



<table>
<?php 
foreach ($names as $item){ 

	echo "<tr><td>" ;	
	echo $item."<br/>";
    echo "</td></tr>";
}
		
//for ($i = 0 , $i = $i + 1) {
//  $item = $cons[$i];

//var_dump($items);
//}
?>
</table>








<!--  for each practice

$b = array('su', 'zu', 'ki');
$c = $a["tako"]["kome"];


foreach($c as $item) {
  var_dump($item); -->
