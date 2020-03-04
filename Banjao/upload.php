<?php

    $files = $_FILES['files'];//fetch the uploaded file into an assoc array
    $allowedFileType = array('jpg', 'jpeg', 'png','php');// array of allowed file types

    foreach ($files['name'] as $key => $value) {
        $fileExplode = explode('/',$files['type'][$key]);//divide the file type
        $fileExtension = end($fileExplode);//fetch the last index in the array $fileExplode
        //check the file type uploaded if allowed
        if(in_array($fileExtension,$allowedFileType)){
            //checks if the file size is allowed
            if($files['size'][$key] <= 10000000){
                $directory = 'upload';//folder where the upload will be stored
                $uploadedName = $directory.basename($files['name'][$key]);//file name when the file will uplaod.
                //if file does not exist in the folder procees in uploading
                if(!file_exists($uploadedName)){    
                    //if uploaded will echo succes
                    if(move_uploaded_file($uploadedName,$directory)){
                        echo "file successfully uploaded <br>";
                        echo '<img src="$uploadedName">';
                    }else{
                        echo "there was an error uploading your file";
                    }
                }else{
                    echo $files['name']['index'],"this file is already uploaded";
                }
            }else{
                echo $files['size']['index']," file size is to large";
            }
        }else{
            echo $files['name']['index']," this file type is not allowed";
        }

    }

?>