<?php


session_start();
if(count($_SESSION)>0){
foreach($_SESSION['form'] as $key => $value){
    echo $key .' = ' . $value  .'<br>';
}
}else{
    echo 'no session';
}
?>