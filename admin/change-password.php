<?php require_once('inc/verify.php'); ?>

<!doctype html>
<html class="no-js" lang="">



<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin |Feedbacks</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="css/normalize.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="css/main.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="css/all.min.css">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="fonts/flaticon.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.min.css">
    <!-- Select 2 CSS -->
    <link rel="stylesheet" href="css/select2.min.css">
    <!-- Data Table CSS -->
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- Modernize js -->
    <script src="js/modernizr-3.6.0.min.js"></script>
</head>

<body>
    <!-- Preloader Start Here -->
    
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        <?php include "inc/topheader.php" ;?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php include "inc/sidebar-menu.php" ;?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Change Admin Password</h3>
                    <ul>
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                       
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- All Subjects Area Start Here -->
                <div class="row">
            <div class="col-4-xxxl col-sm-12 col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                
                                <form class="new-added-form" method="post">
                                    <div class="row">
                                       
										<div class="col-12-xxxl col-lg-6 col-12 form-group">
                                            <label>Old Password*</label>
                                            <input type="text"  name="password" placeholder="" class="form-control">
                                            <label>New Password*</label>
                                            <input type="text"  name="newpassword" placeholder="" class="form-control">
                                            <label>Confirm Password*</label>
                                            <input type="text" name="confirmnewpassword" placeholder="" class="form-control">
                                        </div>
                                        
                                        
                                        <div class="col-12 form-group mg-t-8">
                                            <button type="submit" name="update" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Update</button>
                                           
                                        </div>
                                    </div>
                                </form>
                                    <?php include "inc/dbconfig.php";
$sql = "SELECT password FROM admin";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    $pass=$row['password'];
if(isset($_POST['update'])){
        $password = $_POST['password'];
        $newpassword = $_POST['newpassword'];
        $confirmnewpassword = $_POST['confirmnewpassword'];
       
        if(($newpassword==$confirmnewpassword)&($pass==$password))
       { 
    $sql = "UPDATE admin SET password='$newpassword' WHERE password='$password' ";
        
if (mysqli_query($con, $sql)) {
    echo "Congratulations You have successfully changed your password";
} else {
    echo "Passwords do not match";
}   
        }
   else{echo "Passwords do not match" ;}
}
}}mysqli_close($con);
?>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- All Subjects Area End Here -->
               
            </div>
        </div>
        <!-- Page Area End Here -->
    </div> <?php include "inc/footer.php" ;?>
    <!-- jquery-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Select 2 Js -->
    <script src="js/select2.min.js"></script>
    <!-- Scroll Up Js -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- Data Table Js -->
    <script src="js/jquery.dataTables.min.js"></script>
    <!-- Custom Js -->
    <script src="js/main.js"></script>

</body>



</html>