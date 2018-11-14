<?php  
 //upload.php
 $prod_id= $_REQUEST['product'];
 $output = '';
 if(is_array($_FILES))
 {
      foreach($_FILES['images']['name'] as $name => $value)
      {
           $file_name = explode(".", $_FILES['images']['name'][$name]);
           $allowed_extension = array("jpg", "jpeg", "png", "gif");
           if(in_array($file_name[1], $allowed_extension))
           {
                $new_name = rand() . '.'. $file_name[1];
                $sourcePath = $_FILES["images"]["tmp_name"][$name];
                $targetPath = "images/".$prod_id."/".$value;
                move_uploaded_file($sourcePath, $targetPath);
           }
      }
 }

 ?>
