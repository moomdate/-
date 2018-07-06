<div class="ui segment">
	
</div>
<div class="ui container">
	
	<div class="ui segment centered">
		
		<?php
		if(isset($_SESSION['admin'])){//createmem
			//echo "this is main page for admin";
			if(isset($_GET['userac'])){
				$index = $_GET['userac'];
			}else{
				$index = 'defualt';
			}
			switch ($index) {
				case 'createmem':
				include_once("pages/admins/createuser.php");
				break;
				case 'edituser':
				include_once("pages/admins/edituser.php");
				break;
				case 'deluser':
				include_once("pages/admins/deleteuser.php");
				break;
				case 'create_m':
				include_once("pages/admins/create_m.php");
				break;//savenewuser
				case 'savenewuser':
				include_once("pages/admins/savenewuser.php");
				break;//savenewuser
				case 'lists':
				include_once("pages/admins/lists_.php");
				break;
				case 'state':
				include_once("pages/admins/reports.php");
				break;
				case 'del':
				include_once("pages/admins/delist.php");
				break;
				case 'edit':
				include_once("pages/admins/edit_list.php");
				break;
				case 'save__':
				include_once("pages/admins/saveeditform.php");
				break;
				case 'saveus':
				include_once("pages/admins/edituser_save.php");
				break;
				default:
					# code...
				break;
			}
		}else if(isset($_SESSION['user'])){
			
			if(isset($_GET['userac'])){
				$index = $_GET['userac'];
			}else{
				$index = 'defualt';
			}
			switch ($index) {
				case 'lists':
				include_once("pages/users/list.php");
					//echo "list";
				break;
				case 'savelist':
				include_once("pages/users/savelist.php");
				break;
//editform
				case 'editform'://saveform
				include_once("pages/users/editform.php");
				break;
				case 'saveform'://saveform
				include_once("pages/users/editform_save.php");
				break;
				case 'del'://saveform
				include_once("pages/users/delist.php");
				break;
				default:
				echo "error";
				break;
			}
		}
		?>
	</div>
</div>
