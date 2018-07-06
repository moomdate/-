<?php
@session_start();
unset($_SESSION['admin']);
unset($_SESSION['user']);
header("location:index.php?index=defualt");
?>
<div class="ui segment three column centered grid fullfooter">
	sign out
</div>