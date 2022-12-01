<?php
require_once('./inc/header.php');
require_once('./inc/Functions.php');
$pageLink = 'image-gallery.php';



try {
    $database = new Connection();
    $db = $database->openConnection();


    if (!empty($_GET['update'])) {
        $id = $_GET['update'];
        $getSIngleTableData = new Functions();
        $getSIngleTableData_exe = $getSIngleTableData->getSIngleTableData('gallery', $id, $db);
        $albums_id_up = $getSIngleTableData_exe['albums_id'];
        $file_up = $getSIngleTableData_exe['file'];
     

    }


    if (!empty($_GET['delete'])) {
        $id = $_GET['delete'];
        $getSIngleTableData = new Functions();
        $getSIngleTableData_exe = $getSIngleTableData->deleteRecord('gallery', $id, $db);
        if (isset($getSIngleTableData_exe)) {
            $successMsg =  "Record has been successfully deleted";
        }
    }


    if (isset($_POST['submit'])) {
        $title = !empty($_POST['title']) ? $_POST['title'] : $err[] = 'Album title is required';
        $album_image = !empty($_FILES['album_image']) ? $_FILES['album_image'] : $err[] = 'album image is required';
         $type = !empty($_POST['type']) ? $_POST['type'] : $err[] = 'type is required';

        if (!empty($_FILES)) {
            $fileUpload = new Functions();
            $album_image = $fileUpload->fileUpload($_FILES, 'album_image', '../uploads/', 'uploads');
        } else {
            $album_image = '';
        }
        if(!empty($title)){

            $url = urlencode($title);
            $album_link =$url;
   


        }else{
            $album_link =$err[] = 'album link link is required';
        }
  


        if (empty($err)) {
            if (!empty($_GET['update'])) {
                $id = $_GET['update'];
                $getSIngleTableData = new Functions();
                $getSIngleTableData_exe = $getSIngleTableData->getSIngleTableData('albums', $id, $db);
                $sql = "UPDATE `albums` SET `title`= '" . $title . "' , `album_image` = '" . $album_image . "' , 
                `album_link` = '" . $album_link . "', `type` = '" . $type . "' WHERE `id` = $id";
                  $affected_rows  = $db->exec($sql);

                if (isset($affected_rows)) {
                    $successMsg =  "Record has been successfully updated";
                }
            } else {
                $stm = $db->prepare("INSERT INTO albums (title,album_image,album_link,type,status)
                VALUES (:title, :album_image, :album_link, :type, :status)");
                $InsertArr = [
                    ':title' => $title,
                    ':album_image'=>$album_image,
                    ':album_link' => $album_link,
                    ':type' => $type,
                    ':status' => 1
                ];

                $stm->execute($InsertArr);
                $successMsg =  "New record created successfully";
            }
        }
    }

    $getData = new Functions();
    
    $sql = "SELECT * FROM albums where `type`='images'" ;
    $albums =   $db->query($sql);

    $gallery = $getData->getAllTableData('gallery', $db);

} catch (PDOException $e) {
    echo "There is some problem in connection: " . $e->getMessage();
}





?>
<!-- Preloader Start Here -->

<div id="wrapper" class="wrapper bg-ash">
    <!-- Header Menu Area Start Here -->
    <?php include "./inc/topheader.php"; ?>
    <!-- Header Menu Area End Here -->
    <!-- Page Area Start Here -->
    <div class="dashboard-page-one">
        <!-- Sidebar Area Start Here -->
        <?php include "./inc/sidebar-menu.php"; ?>
        <!-- Sidebar Area End Here -->
        <div class="dashboard-content-one">
            <!-- Breadcubs Area Start Here -->
            <div class="breadcrumbs-area">
                <h3>Gallery</h3>
                <ul>
                    <li>
                        <a href="#">Home</a>
                    </li>
                    <li>Gallery</li>
                </ul>
            </div>
            <!-- Breadcubs Area End Here -->
            <!-- All Subjects Area Start Here -->
            <div class="row">
                <div class="col-4-xxxl col-12">
                    <div class="card height-auto">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>Create Gallery</h3>
                                </div>

                            </div>
                            <?php
                            if (!empty($successMsg)) {
                                echo $successMsg;
                            }
                            ?>


                            <div class="heading-layout1">
                                <div class="item-title">
                                    <?php
                                    if (!empty($err)) {
                                        foreach ($err as  $err_data) {
                                            echo '<div class="text-danger text-uppercase">' . $err_data . '</div>';
                                        }
                                    }

                                    ?>
                                </div>

                            </div>






                            <form method="post" action="upload.php" enctype="multipart/form-data" class="dropzone" id="image-upload">
                                <div class="row">

                                <div class="col-12-xxxl col-lg-12 col-12 form-group">
                                        <label> Album *</label>
                                        <select  class="form-control" name="albums_id">
                                            <option>--SELECT Album--</option>
                                            <?php foreach($albums  as $albumsData ){ 
                                                if(!empty($albums_id_up) && $albums_id_up==$albumsData['id']){
                                                    $selected = 'selected';
                                                }else{
                                                    $selected = '';

                                                }
                                                
                                                ?>

                                            <option  <?= $selected ?> value="<?= $albumsData['id'] ?>"><?= $albumsData['title'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="file_type" value="image">


                               


                                    

                               






                              

                                </div>
                            </form>
                        </div>
                    </div>
                </div>



                <div class="col-8-xxxl col-12">
                    <div class="card height-auto">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>All Gallery</h3>
                                </div>

                            </div>
                            <div class="table-responsive">




                                <table class="table display data-table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>main image</th>
                                            <th>Page Link</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>





                                        <?php if (!empty($gallery)) {


                                            foreach ($gallery as $gallery_data) {
                                        ?>
                                                <tr>
                                                    <td><?= $gallery_data['id'] ?></td>
                                                    <td><?= $gallery_data['albums_id'] ?></td>
                                                    <td><?= $gallery_data['file'] ?></td>
                                                 


                                                    <td><a type='button' name='update' class='btn btn-info' href=<?= $pageLink ?>?update=<?= $gallery_data['id'] ?>>Update</a>
                                                        <a type='button' class='btn btn-danger' href=<?= $pageLink ?>?delete=<?= $gallery_data['id'] ?>>Delete</a>
                                                    </td>
                                                </tr>

                                        <?php }
                                        } ?>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Page Area End Here -->
    <?php include "./inc/copy_write.php"; ?>
</div>

<?php

require_once('./inc/footer.php');
?>

<script type="text/javascript">
	Dropzone.options.imageUpload = {
        maxFilesize:20,
        acceptedFiles: ".jpeg,.jpg,.png,.gif"
    };
</script>