<?php 
if(isset($_POST['track'])){
    file_put_contents('tracks/'.$_POST['track'], date("d/m/Y H:i:s") . PHP_EOL, FILE_APPEND | LOCK_EX);
}
