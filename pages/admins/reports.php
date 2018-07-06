
<?php
$list = 0;
if(isset($_GET['list'])){
	$list = 1;
}

?>
<div class="ui two  item menu">

	<?php
	if($list){
		echo " <a class=\"item\" href=\"index.php?index=main&userac=state\">สถิติิการแจ้งซ่อม</a>";
		echo "<a class=\"item active\" href=\"index.php?index=main&userac=state&list=name\">สถิติการแจ้งซ่อมตามรายชื่อ</a>";
	}else{
		echo " <a class=\"item active\" href=\"index.php?index=main&userac=state\">สถิติิการแจ้งซ่อม</a>";
		echo "<a class=\"item\" href=\"index.php?index=main&userac=state&list=name\">สถิติการแจ้งซ่อมตามรายชื่อ</a>";
	}
	?>

</div>
<?php
	switch ($list) {
		case '1':
			include_once("pages/admins/userstate.php");
			break;
		
		default:
			include_once("pages/admins/chart.php");
			break;
	}

?>