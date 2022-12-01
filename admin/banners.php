<?php
require_once('./inc/header.php');
require_once('./inc/Functions.php');
$pageLink = 'banners.php';



try {
    $database = new Connection();
    $db = $database->openConnection();


    if (!empty($_GET['update'])) {
        $id = $_GET['update'];
        $getSIngleTableData = new Functions();
        $getSIngleTableData_exe = $getSIngleTableData->getSIngleTableData('banners', $id, $db);
        $title_up = $getSIngleTableData_exe['title'];
        $description_up = $getSIngleTableData_exe['description'];
        $banner_image_up = $getSIngleTableData_exe['banner_image'];
        $status = $getSIngleTableData_exe['status'];
    }


    if (!empty($_GET['delete'])) {
        $id = $_GET['delete'];
        $getSIngleTableData = new Functions();
        $getSIngleTableData_exe = $getSIngleTableData->deleteRecord('banners', $id, $db);
        if (isset($getSIngleTableData_exe)) {
            $successMsg =  "Record has been successfully deleted";
        }
    }


    if (isset($_POST['submit'])) {

        $title = !empty($_POST['title']) ? $_POST['title'] :'';
        $description = !empty($_POST['description']) ? $_POST['description'] : '';
        $banner_image = !empty($_FILES['banner_image']['name'])?$_FILES: $err[] = 'banner image is required';
        if (!empty($_FILES['banner_image']['name'])) {
            $fileUpload = new Functions();
            $banner_image = $fileUpload->fileUpload($banner_image, 'banner_image', '../uploads/', 'uploads');
        } else {
            $banner_image = '';
        }



        if (empty($err)) {
            if (!empty($_GET['update'])) {
                $id = $_GET['update'];
                $getSIngleTableData = new Functions();
                $getSIngleTableData_exe = $getSIngleTableData->getSIngleTableData('banners', $id, $db);
                $sql = "UPDATE `banners` SET `title`= '" . $title . "' , `banner_image` = '" . $banner_image . "', `description` = '" . $description . "' WHERE `id` = $id";
                $affected_rows  = $db->exec($sql);

                if (isset($affected_rows)) {
                    $successMsg =  "Record has been successfully updated";
                }
            } else {
                $stm = $db->prepare("INSERT INTO banners (title,description,banner_image,status) VALUES ( :title, :description,:banner_image,:status)");
                $InsertArr = [
                    ':title' => $title,
                    ':description' => $description,
                    ':banner_image' => $banner_image,
                    'status' => 1    
                    ];

                $stm->execute($InsertArr);
                $successMsg =  "New record created successfully";
            }
        }
    }

    $getData = new Functions();
    $banners = $getData->getAllTableData('banners', $db);
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
                                            echo $err_data;
                                        }
                                    }

                                    ?>
                                </div>

                            </div>






                            <form class="new-added-form" method="post" enctype="multipart/form-data">
                                <div class="row">

                                    <div class="col-12-xxxl col-lg-12 col-12 form-group">
                                        <label>title*</label>
                                        <input type="text" name="title" placeholder="" value="<?= !empty($title_up) ? $title_up : "" ?>" class="form-control">

                                    </div>



                                    <div class="col-12-xxxl col-lg-12 col-12 form-group">
                                        <label>description</label>
                                        <input type="text" name="description" class="form-control" id="description" placeholder="description" value="<?= !empty($description_up) ? $description_up : "" ?>">

                                    </div>



                                    <div class="col-12-xxxl col-lg-12 col-12 form-group">
                                        <label>banner image*</label>
                                        <input type="file" name="banner_image" placeholder="" class="form-control">

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

                                            <th>Page Link</th>

                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>





                                        <?php if (!empty($banners)) {


                                            foreach ($banners as $banners_data) {
                                        ?>
                                                <tr>
                                                    <td><?= $banners_data['id'] ?></td>
                                                    <td><?= $banners_data['title'] ?></td>

                                                    <td><?= $banners_data['banner_image'] ?></td>


                                                    <td><a type='button' name='update' class='btn btn-info' href=<?= $pageLink ?>?update=<?= $banners_data['id'] ?>>Update</a>
                                                        <a type='button' class='btn btn-danger' href=<?= $pageLink ?>?delete=<?= $banners_data['id'] ?>>Delete</a>
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