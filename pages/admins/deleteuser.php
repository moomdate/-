<script type="text/javascript" src="js/jquery.cookie.js"></script>
<?php
include_once('configs/config.db.php');

if(isset($_GET['cookie'])){
	$cookie = $_GET['cookie'];
	$uid = $_GET['uid'];
	?>
	<script type="text/javascript">
		var myCook = "<?php Print($cookie); ?>";
		if($.cookie('data') == myCook){
			$.removeCookie('uid');
			if($.removeCookie('data')){
				//alert('ok');
			}
		}else{
			window.location.href = "index.php?index=main&userac=createmem";
		}
	</script>
	<?php
	$sql_comm = "DELETE FROM `user` WHERE `user`.`user_id` = $uid";
	$action = mysqli_query($con__,$sql_comm);
	if($action){
		//echo "ok";
		header("location:index.php?index=main&userac=createmem");
	}else{
		echo "error";
	}
}

echo $uid;
?>