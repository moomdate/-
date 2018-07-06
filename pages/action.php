<div class="ui container segment three column fullfooter  centered grid">


<?php
    if(isset($_GET['fn'])){
        $index = $_GET['fn'];
    }else{
        $index = 'defualt';
    }
    switch($index){
        case 'login':
            include_once("systems/loginCheck.php"); 
        break;
    }
?>
</div>