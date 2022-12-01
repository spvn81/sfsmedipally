<?php include('./inc/header.php') ?>

<?php
  $files_id = !empty($_GET['files']) ? $_GET['files'] : '';

if (!empty($files_id)) {
    $database = new Connection();
    $db = $database->openConnection();
    $getPageData = new  MainFunctions();

    $data = $getPageData->getFiles($files_id, $db);
  
}
?>


<div class="container tb-pad-40">
    <div class="row">


<?php foreach( $data as  $dataFiles){ ?>

<div class="col-md-3">
  <?php if($dataFiles['file_type']=='image'){ ?>
  <a class="example-image-link" href="<?= $dataFiles['file'] ?>" data-lightbox="example-set" >
<img style="width: 250px;height:200px;margin:4px"  src="<?= $dataFiles['file'] ?>" alt=""/></a>
<?php }else if($dataFiles['file_type']=='video'){ ?>
  <video width="320" height="240" controls>
  <source src="<?= $dataFiles['file'] ?>" >

</video>

<?php } ?>
</div>

<?php } ?>

    </div>

</div>




<?php include('./inc/footer.php') ?>
