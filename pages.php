<?php include('./inc/header.php') ?>
<?php
$page = !empty($_GET['page']) ? $_GET['page'] : '';
if (!empty($page)) {
    $database = new Connection();
    $db = $database->openConnection();
    $getPageData = new  MainFunctions();
    $data = $getPageData->getPageData($page, $db);

?>


    <div class="container tb-pad-40">
        <div class="row">
            <div class="col-md-12">
                <?php foreach ($data as  $data_page) {

                    echo    $data_page['page_content'];
                }
                ?>




            </div>
        </div>
    </div>



<?php } ?>
<?php include('./inc/footer.php') ?>