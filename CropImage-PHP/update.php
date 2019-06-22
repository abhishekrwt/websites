<?php
    error_reporting(0);
    include_once("config/db.php");
    $filename=$_FILES['image']['name'];
    for($i=0; $i<count($_FILES['image']['name']); $i++){
        $filetmp=$_FILES['image']['tmp_name'][$i];
        $filename=$_FILES['image']['name'][$i];
        $path="img/".$filename;
        move_uploaded_file($filetmp,$path);
        $insert="INSERT into image(image)values('$filename')";
        $query=mysqli_query($conn,$insert);

        $fullpath="img/".$filename;
        $fullpath_2="image/".$filename;
        clearstatcache();				
        $original_size = getimagesize($fullpath);
        $original_width = $original_size[0];
        $original_height = $original_size[1];	
        // Specify The new size
        $main_width = 600; // set the width of the image
        $main_height = 400;
        //create the new resized image
        $src2 = imagecreatefromjpeg($fullpath);
        $main = imagecreatetruecolor($main_width,$main_height);
        imagecopyresampled($main,$src2,0, 0, 0, 0,$main_width,$main_height,$original_width,$original_height);
    //upload new version
        $main_temp = $fullpath_2;
        imagejpeg($main, $main_temp, 100);
        chmod($main_temp,0777);
    //free up memory
        imagedestroy($src2);
        imagedestroy($main);
        imagedestroy($fullpath);
        @ unlink($fullpath);   

    }
    if(!$query){
        echo"Data not inserted";
    }
    else{
        header("location: index.php");
    }
?>
