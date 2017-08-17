<?php

require_once('../include/autoload.php');

$dir = "";


$res = '';

    $id = $_POST['id'];
    $cat = $_POST['category'];

    switch ($cat) {
        case 'hotel':
            $dir = HOTEL_IMG_PATH;
            break;
        
        default:
            # code...
            break;
    }

    $newdir = $dir.'/'.$id;

    if(is_dir($newdir)) {
        
        foreach ($_FILES as $file) {
            for($i=0; $i < sizeof($file["name"]); $i++) {
                $new_name = $id.'-'.$i.substr($file["name"][$i], strpos($file["name"][$i],"."));
                $res = move_uploaded_file($file["tmp_name"][$i], $newdir.'/'. $new_name);                
            }
        }

        
        
    } else {
        mkdir($newdir);
        foreach ($_FILES as $file) {
            for($i=0; $i < sizeof($file["name"]); $i++) {
                $new_name = $id.'-'.$i.substr($file["name"][$i], strpos($file["name"][$i],"."));
                $res = move_uploaded_file($file["tmp_name"][$i], $newdir.'/'. $new_name); 
            }
        }

    }

    

    
    echo $res;
?>