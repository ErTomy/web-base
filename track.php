<?php 
if(isset($_POST['track'])){
    file_put_contents('tracks/'.$_POST['track'], date("d/m/Y H:i:s") . PHP_EOL, FILE_APPEND | LOCK_EX);
}

/* datos de ejemplo para estadisticas 
for ($i=0; $i < rand(100, 1000); $i++) { 
    $randomDate = date("d/m/Y H:i:s", mt_rand(strtotime("10 September 2018"), strtotime("24 February 2020")));    
    file_put_contents('tracks/track cinco', $randomDate . PHP_EOL, FILE_APPEND | LOCK_EX);
}
for ($i=0; $i < rand(100, 1000); $i++) { 
    $randomDate = date("d/m/Y H:i:s", mt_rand(strtotime("10 September 2018"), strtotime("24 February 2020")));    
    file_put_contents('tracks/track seis', $randomDate . PHP_EOL, FILE_APPEND | LOCK_EX);
}
for ($i=0; $i < rand(100, 1000); $i++) { 
    $randomDate = date("d/m/Y H:i:s", mt_rand(strtotime("10 September 2018"), strtotime("24 February 2019")));    
    file_put_contents('tracks/track siete', $randomDate . PHP_EOL, FILE_APPEND | LOCK_EX);
}
for ($i=0; $i < rand(100, 1000); $i++) { 
    $randomDate = date("d/m/Y H:i:s", mt_rand(strtotime("10 September 2018"), strtotime("24 February 2019")));    
    file_put_contents('tracks/track ocho', $randomDate . PHP_EOL, FILE_APPEND | LOCK_EX);
}
*/

 
