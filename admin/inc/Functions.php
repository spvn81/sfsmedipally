<?php 

class Functions{
public $messages;

    function deleteRecord($tableName,$id,$db){   
     $sql = "DELETE FROM $tableName WHERE `id` = $id" ;
       $affected_rows  =   $db->exec($sql);
         if(isset($affected_rows))
         {
            return true;
         }else{
            return false;

         }
    
         
    }



    function getAllTableData($tableName,$db){
        $sql = "SELECT * FROM $tableName" ;
        return $db->query($sql);

    }


    function getSIngleTableData($tableName,$id,$db){
        $sql = "SELECT * FROM $tableName where `id`=$id" ;

        foreach ($db->query($sql) as $row) {
                return  $row;
            }

  
    }


    function getSIngleTableDataWithTableField($tableName,$value,$db){
   
        $sql = "SELECT * FROM $tableName where `page_slug`=$value" ;

        foreach ($db->query($sql) as $row) {
                return  $row;
            }

  
    }




    function fileUpload($file,$ame,$filePath,$pathName){
        $target_dir = $filePath;
         $target_file = $target_dir .md5(uniqid(rand(), true)). basename($file["$ame"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $file_name = basename($target_file,PATHINFO_EXTENSION);

                

        
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $uploadOk = 0;
            $uploaded = false;
             $this->messages = 'file upload  jpg,png,jpeg,gif';

        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $uploaded = false;
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($file["$ame"]["tmp_name"], $target_file)) {
            return $fn = $pathName.'/'.$file_name;
               
          } else {
            $uploaded = false;
              $this->messages = 'file upload failed';

          }
        }


    }

 





}



?>