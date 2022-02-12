<?php
    session_start(); 
      function Clean($input){
        $input =  filter_var($input,FILTER_SANITIZE_STRING);   // 
        return $input;
    }
    function Clean_c($input){
    $inputt=htmlspecialchars($input);
    return $inputt;
    }




if($_SERVER['REQUEST_METHOD']=="POST"){
    $title    =  Clean($_POST['title']);
    $content  = Clean_c( $_POST['content']);

    echo 'title = '.$title .'<br>'.'content = '.$content . '<br>';
}
$errors=[];
#validate >>title 
if(empty($title)){
    $errors['errortitle']='required title';
}

#validate >> content
if(empty($content))
{
    $errors['errorcontent']='required content';
}elseif(strlen($content)>50){
    $errors['errorcontent']='length must be <50 character';  

}


// image   
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (!empty($_FILES['image']['name'])) {

        $imgName  = $_FILES['image']['name'];
        $imgTemp  = $_FILES['image']['tmp_name'];//path
        $imgType  = $_FILES['image']['type'];   
/// search ext.
        $nameArray =  explode('.', $imgName);
        $imgExtension =  strtolower(end($nameArray));

        $imgFinalName = time() . rand() . '.' . $imgExtension;

        $allowedExt = ['png', 'jpg'];

        if (in_array($imgExtension, $allowedExt)) {
            

            $disPath = 'uploadsimg/' . $imgFinalName;

            if (move_uploaded_file($imgTemp, $disPath)) {
                echo 'File Uploaded'.'<br>';
            } else {
                echo 'Error In Uploading Try Again';
            }
        } else {
            echo 'InValid Extension';
        }
    } else {

        echo ' Image Required';
    }
}
//////////////////////////
#check
if(count($errors)>0){
    foreach($errors as $key=>$value){
        echo $key.' = '.$value .'<br>';
    }

}else{
    echo 'valid data ...successfulllllll'.'<br>';
}

// $_SESSION['Ttitle']=$title;
// $_SESSION['Ccontent']=$content;

// $_SESSION['form']=['Ttitle'  =>  $title  ,  'Ccontent'  =>  $content]

// echo $_SESSION['Ttitle'].'<br>';
// echo $_SESSION['Ccontent'].'<br>'

$file=fopen('file.txt',"a") or die("can not open this file");
$component=$title .' => '.$content;
fwrite($file,$component);


fclose($file);

?>