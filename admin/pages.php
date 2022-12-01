<?php
require_once('./inc/header.php');
require_once('./inc/Functions.php');
$pageLink = 'pages.php';



try {
    $database = new Connection();
    $db = $database->openConnection();


    if (!empty($_GET['update'])) {
        $id = $_GET['update'];
        $getSIngleTableData = new Functions();
        $getSIngleTableData_exe = $getSIngleTableData->getSIngleTableData('pages', $id, $db);
        $page_title_up = $getSIngleTableData_exe['page_title'];
        $main_image_up = $getSIngleTableData_exe['main_image'];
        $page_content_up = $getSIngleTableData_exe['page_content'];
        $page_link_up = $getSIngleTableData_exe['page_link'];
        $status_up = $getSIngleTableData_exe['status'];
        $page_slug_up = $getSIngleTableData_exe['page_slug'];

    }


    if (!empty($_GET['delete'])) {
        $id = $_GET['delete'];
        $getSIngleTableData = new Functions();
        $getSIngleTableData_exe = $getSIngleTableData->deleteRecord('pages', $id, $db);
        if (isset($getSIngleTableData_exe)) {
            $successMsg =  "Record has been successfully deleted";
        }
    }


    if (isset($_POST['submit'])) {
        $page_title = !empty($_POST['page_title']) ? $_POST['page_title'] : $err[] = 'page title is required';
        $main_image = !empty($_FILES['main_image']) ? $_FILES['main_image'] : '';
        $page_content = !empty($_POST['page_content']) ? $_POST['page_content'] : $err[] = 'page content is required';
         $page_slug = !empty($_POST['page_slug']) ? $_POST['page_slug'] : $err[] = 'slug is required';

        if (!empty($_FILES)) {
            $fileUpload = new Functions();
            $main_image = $fileUpload->fileUpload($_FILES, 'main_image', '../uploads/', 'uploads');
        } else {
            $main_image = '';
        }
        if(!empty($page_slug)){

            $url = 'pages.php?page='.urlencode($page_slug);
            $page_link =$url;
   
            // $getSIngleTableData = new Functions();
            // $slug_data = $getSIngleTableData->getSIngleTableDataWithTableField('pages',trim($page_slug),$db);
            // if(empty($slug_data)){
            //     $url = urlencode($slug);
            //     $page_link =$url;
            // }else{
            //     // print_r($slug_data);
            // }
            

        }else{
            $page_link =$err[] = 'page link is required';
        }
  


        if (empty($err)) {
            if (!empty($_GET['update'])) {
                $id = $_GET['update'];
                $getSIngleTableData = new Functions();
                $getSIngleTableData_exe = $getSIngleTableData->getSIngleTableData('pages', $id, $db);
                $sql = "UPDATE `pages` SET `page_title`= '" . $page_title . "' , `main_image` = '" . $main_image . "' , 
                `main_image` = '" . $main_image . "', `page_content` = '" . $page_content . "' , `page_link` = '" . $page_link . "' WHERE `id` = $id";
                  $affected_rows  = $db->exec($sql);

                if (isset($affected_rows)) {
                    $successMsg =  "Record has been successfully updated";
                }
            } else {
                $stm = $db->prepare("INSERT INTO pages (page_title,page_slug,main_image,page_content,page_link,status)
                VALUES (:page_title, :page_slug, :main_image, :page_content, :page_link, :status)");
                $InsertArr = [
                    ':page_title' => $page_title,
                    ':page_slug'=>$page_slug,
                    ':main_image' => $main_image,
                    ':page_content' => $page_content,
                    ':page_link' => $page_link,
                    ':status' => 1
                ];

                $stm->execute($InsertArr);
                $successMsg =  "New record created successfully";
            }
        }
    }

    $getData = new Functions();
    $data = $getData->getAllTableData('pages', $db);
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
                <h3>All Banners</h3>
                <ul>
                    <li>
                        <a href="#">Home</a>
                    </li>
                    <li>Menu</li>
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
                                    <h3>Create Menu</h3>
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






                            <form class="new-added-form" method="post" enctype="multipart/form-data">
                                <div class="row">

                                    <div class="col-12-xxxl col-lg-12 col-12 form-group">
                                        <label>page title*</label>
                                        <input type="text" name="page_title" placeholder="" value="<?= !empty($page_title_up) ? $page_title_up : "" ?>" class="form-control">

                                    </div>

                                    <div class="col-12-xxxl col-lg-12 col-12 form-group">
                                        <label>page slug*</label>
                                        <input type="text" name="page_slug" placeholder="" value="<?= !empty($page_slug_up) ? $page_slug_up : "" ?>" class="form-control">

                                    </div>


                                    

                                    <div class="col-12-xxxl col-lg-12 col-12 form-group">
                                        <label>page main image*</label>
                                        <input type="file" name="main_image" placeholder="" class="form-control">

                                    </div>


                                    <div class="col-12-xxxl col-lg-12 col-12 form-group">

                                        <label> Page Content*</label>
                                            <textarea name="page_content" id="page_content" style="border:none;"><?= !empty($page_content_up)?$page_content_up:'' ?></textarea>
                                            </div>
                                    <div class="col-12 form-group mg-t-8">
                                        <button type="submit" name="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                        <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                    </div>

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
                                    <h3>All Menu</h3>
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





                                        <?php if (!empty($data)) {


                                            foreach ($data as $data_of_menu) {
                                        ?>
                                                <tr>
                                                    <td><?= $data_of_menu['id'] ?></td>
                                                    <td><?= $data_of_menu['page_title'] ?></td>
                                                    <td><?= $data_of_menu['main_image'] ?></td>
                                                    <td><?= $data_of_menu['page_link'] ?></td>


                                                    <td><a type='button' name='update' class='btn btn-info' href=<?= $pageLink ?>?update=<?= $data_of_menu['id'] ?>>Update</a>
                                                        <a type='button' class='btn btn-danger' href=<?= $pageLink ?>?delete=<?= $data_of_menu['id'] ?>>Delete</a>
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

<script>
    CKEDITOR.replace('page_content', {
        filebrowserUploadUrl: 'ckeditor/ck_upload.php',
        filebrowserUploadMethod: 'form'
    });
</script>