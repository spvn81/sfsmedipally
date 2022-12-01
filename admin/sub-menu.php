<?php
require_once('./inc/header.php');
require_once('./inc/Functions.php');
$pageLink = 'sub-menu.php';


try {
  $database = new Connection();
  $db = $database->openConnection();


  if(!empty($_GET['update'])){
    $id =$_GET['update'];
    $getSIngleTableData = new Functions();
    $getSIngleTableData_exe = $getSIngleTableData->getSIngleTableData('sub_menu',$id,$db);
    $title = $getSIngleTableData_exe['title'];
    $page_link = $getSIngleTableData_exe['page_link'];
    $menu_id  = $getSIngleTableData_exe['menu_id'];
    $status = $getSIngleTableData_exe['status'];
  }


  if(!empty($_GET['delete'])){
    $id =$_GET['delete'];
    $getSIngleTableData = new Functions();
    $getSIngleTableData_exe = $getSIngleTableData->deleteRecord('sub_menu',$id,$db);
    if(isset($getSIngleTableData_exe))
    {
        $successMsg =  "Record has been successfully deleted";

    }  
  }


    if (isset($_POST['submit'])) {

        $title = !empty($_POST['title']) ? $_POST['title'] : $err[] = 'title is required';
        $page_link = !empty($_POST['page_link']) ? $_POST['page_link'] : $err[] = 'page link is required';
        $menu_id = !empty($_POST['menu_id']) ? $_POST['menu_id'] : $err[] = 'menu id is required';

        if (empty($err)) {
            if(!empty($_GET['update'])){
            $id =$_GET['update'];
            $getSIngleTableData = new Functions();
            $getSIngleTableData_exe = $getSIngleTableData->getSIngleTableData('menu',$id,$db);
            $sql = "UPDATE `sub_menu` SET  `menu_id`='".$menu_id."' , `title`= '".$title."' , `page_link` = '".$page_link."' WHERE `id` = $id" ;
            $affected_rows  = $db->exec($sql);

            if(isset($affected_rows))
            {
                $successMsg =  "Record has been successfully updated";

            }  
            }else{
                $stm = $db->prepare("INSERT INTO sub_menu (menu_id,title,page_link,status) VALUES ( :menu_id,:title, :page_link,:status)");
                $InsertArr = [
                    ':menu_id' => $menu_id,
                    ':title' => $title,
                    ':page_link' => $page_link,
                    'status' => 1
                ];
    
                $stm->execute($InsertArr);
                $successMsg =  "New record created successfully";
            }

           
        }
    }

   $getData = new Functions();
   $menuData = $getData->getAllTableData('menu',$db);
   $sub_menu_data = $getData->getAllTableData('sub_menu',$db);


   



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
                                    <h3>Create Sub Menu</h3>
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
                                        <label>menu id *</label>
                                        <select  class="form-control" name="menu_id">
                                            <option>--SELECT MENU--</option>
                                            <?php foreach($menuData  as $menuDataOptions ){ 
                                                if(!empty($menu_id) && $menu_id==$menuDataOptions['id']){
                                                    $selected = 'selected';
                                                }else{
                                                    $selected = '';

                                                }
                                                
                                                ?>

                                            <option  <?= $selected ?> value="<?= $menuDataOptions['id'] ?>"><?= $menuDataOptions['title'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>



                                    <div class="col-12-xxxl col-lg-12 col-12 form-group">
                                        <label>title*</label>
                                        <input type="text" name="title" placeholder="" value="<?= !empty($title)?$title:"" ?>" class="form-control">

                                    </div>



                                    <div class="col-12-xxxl col-lg-12 col-12 form-group">
                                        <label>page link*</label>
                                        <input type="text" name="page_link" class="form-control" id="page_link" placeholder="page link" value="<?= !empty($page_link)?$page_link:"#" ?>">

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
                                    <h3>All Sub Menu</h3>
                                </div>

                            </div>
                        <div class="table-responsive">




                        <table class="table display data-table text-nowrap">
                                       <thead>
						  <tr>
                            <th>ID</th>
                            <th>menu</th>
							<th>Title</th>
                          
							<th>Page Link</th>
                          
							<th>Action</th>
							
						  </tr>
						</thead>
						<tbody>
                                                    
					
 


  <?php if(!empty($sub_menu_data)){


    foreach($sub_menu_data as $data_of_sub_menu){
    ?>     
<tr>
<td><?= $data_of_sub_menu['id'] ?></td>
<td><?= $data_of_sub_menu['menu_id'] ?></td>
<td><?= $data_of_sub_menu['title'] ?></td>    
<td><?= $data_of_sub_menu['page_link'] ?></td>
   
     
<td><a type='button' name='update' class='btn btn-info' href=<?= $pageLink ?>?update=<?= $data_of_sub_menu['id'] ?>>Update</a>
<a type='button'  class='btn btn-danger' href=<?= $pageLink ?>?delete=<?= $data_of_sub_menu['id'] ?>>Delete</a></td>
                                </tr>

    <?php } } ?>

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