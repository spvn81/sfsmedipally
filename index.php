<?php include('./inc/header.php');

$data = new MainFunctions();

$getBanners = $data->getBanners($db)

?>



<section class="rev_slider_wrapper">
<div id="slider1" class="rev_slider" data-version="5.0">
<ul>
                



        <?php foreach($getBanners  as $getBanners_data){ ?>    
            
       

    <li data-transition="fade">
        <img src="<?= $getBanners_data['banner_image']; ?>" alt="" width="1920" height="683"
            data-bgposition="top center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="1">

        <div class="tp-caption tp-resizeme" data-x="center" data-hoffset="0" data-y="center" data-voffset="0"
            data-transform_idle="o:1;"
            data-transform_in="x:[-175%];y:0px;z:0;rX:0;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0.01;s:3000;e:Power3.easeOut;"
            data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
            data-mask_in="x:[100%];y:0;s:inherit;e:inherit;" data-splitin="none" data-splitout="none"
            data-responsive_offset="on" data-start="500">
            <div class="slide-content-box text-center">
                <h2 style="color:#fff; font-size:46px;">  </h2>
            </div>
        </div>


        <div class="tp-caption tp-resizeme" data-x="center" data-hoffset="-100" data-y="center"
            data-voffset="140" data-transform_idle="o:1;"
            data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
            data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-splitin="none"
            data-splitout="none" data-responsive_offset="on" data-start="2300">

        
        </div>

        <div class="tp-caption tp-resizeme" data-x="center" data-hoffset="100" data-y="center"
            data-voffset="140" data-transform_idle="o:1;"
            data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;"
            data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-splitin="none"
            data-splitout="none" data-responsive_offset="on" data-start="2600">
            
        </div>
    </li>
             
    <?php } ?>




</ul>
</div>
</section>



<?php include('./inc/footer.php') ?>
