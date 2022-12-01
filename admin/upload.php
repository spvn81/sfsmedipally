        
<?php
require('./inc/db_config.php');
require_once('./inc/Functions.php');




if (!empty($_FILES) && !empty($_POST['albums_id'])) {
{
$database = new Connection();
$db = $database->openConnection();

$albums_id=!empty($_POST['albums_id'])?$_POST['albums_id']:'';
$file_type=!empty($_POST['file_type'])?$_POST['file_type']:'';


$sql = "SELECT * FROM albums where `id`='$albums_id'" ;
$result = $db->query($sql);
if($result->rowCount() > 0){
   while($row = $result->fetch()){
       $title = $row['title'];
      }
      $category = $title;
    }else{
        $category = ''; 
    }

  $dir1="../gallery/$category";
  $dir_data="gallery/$category";
 $tmpFile = $_FILES['file']['tmp_name'];
 $filename =  $_FILES['file']['name'];
$fnm =$_FILES["file"]["name"];    
	$back = "../";

if( is_dir($dir1) === false )
{
    mkdir($dir1);
}
 move_uploaded_file($tmpFile,$dir1.'/'.$filename);
    

$file = $dir_data.'/'.$filename;
 $stm = $db->prepare("INSERT INTO gallery (albums_id,file,file_type) VALUES ( :albums_id, :file,:file_type)");
 $InsertArr = [
     ':albums_id' => $albums_id,
     ':file' => $file,
     ':file_type' => $file_type,

 ];

 $stm->execute($InsertArr);
 $successMsg =  "New record created successfully";


}
}



?>          
                          

