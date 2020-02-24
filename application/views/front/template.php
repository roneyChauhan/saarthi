<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Saarthi Rent & Ride">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Saarthi Rent & Ride</title>
        <link rel="icon" href="<?php echo front_asset_url() ?>images/fevicon.png" type="image/gif">

        <link href="<?php echo front_asset_url() ?>css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo front_asset_url() ?>css/style.css" rel="stylesheet">
        <link href="<?php echo front_asset_url() ?>css/fontawesome-all.min.css" rel="stylesheet">
        <link id="switcher" href="<?php echo front_asset_url() ?>css/color.css" rel="stylesheet">
        <link href="<?php echo front_asset_url() ?>css/color-switcher.css" rel="stylesheet">
        <link href="<?php echo front_asset_url() ?>css/owl.carousel.css" rel="stylesheet">
        <!--<link href="<?php echo front_asset_url() ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet">--> 
        <link href="<?php echo front_asset_url() ?>css/datepicker.min.css" rel="stylesheet"> 
        <link href="<?php echo front_asset_url() ?>css/daterangepicker.css" rel="stylesheet">
        <link href="<?php echo front_asset_url() ?>css/jquery.timepicker.min.css" rel="stylesheet">
        <link href="<?php echo front_asset_url() ?>css/select2.min.css" rel="stylesheet">
        <link href="<?php echo front_asset_url() ?>css/select2-bootstrap4.min.css" rel="stylesheet">
        <link href="<?php echo front_asset_url() ?>css/icomoon.css" rel="stylesheet">
        <link href="<?php echo front_asset_url() ?>css/animate.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo front_asset_url(); ?>css/toastr.min.css">
        
        <?php echo (isset($css_files)) ? $css_files : ''; ?>

        <script type="text/javascript">
            var base_url = '<?php echo base_url(); ?>';
            var portal_url = '<?php echo portal_url(); ?>';
        </script>

        <link href="<?php echo front_asset_url() ?>css/responsive.css" rel="stylesheet">
        <link href="<?php echo front_asset_url() ?>css/custom.css" rel="stylesheet">

        <script src="<?php echo front_asset_url() ?>js/jquery-1.12.5.min.js"></script>
 
    </head>
    <body>
        <!--Wrapper Content Start-->
        <div class="tj-wrapper">
            <div class="loader-outer">
                <div class="tj-loader">
                    <img src="<?php echo front_asset_url() ?>images/pre-loader.gif" alt="">
                    <h2>Loading...</h2>
                </div>
            </div>
            <?php echo isset($main_content) ? $main_content : ''; ?>
        </div>
        <!--Wrapper Content End-->

        <!-- Js Files Start -->
        <script src="<?php echo front_asset_url() ?>js/bootstrap.min.js"></script> 
        <script src="<?php echo front_asset_url() ?>js/migrate.js"></script>
        <script src="<?php echo front_asset_url() ?>js/owl.carousel.min.js"></script>
        <script src="<?php echo front_asset_url() ?>js/color-switcher.js"></script>
        <script src="<?php echo front_asset_url() ?>js/jquery.isotope.min.js"></script>
        <script src="<?php echo front_asset_url() ?>js/imagesloaded.pkgd.min.js"></script>
        <script src="<?php echo front_asset_url() ?>js/jquery.counterup.min.js"></script>
        <script src="<?php echo front_asset_url() ?>js/waypoints.min.js"></script>
        <script src="<?php echo front_asset_url() ?>js/moment.js"></script>
        <!--<script src="<?php echo front_asset_url() ?>js/bootstrap-datetimepicker.min.js"></script>-->
        <script src="<?php echo front_asset_url() ?>js/datepicker.min.js"></script>
        <script src="<?php echo front_asset_url() ?>js/daterangepicker.min.js"></script>        
        <script src="<?php echo front_asset_url() ?>js/jquery.timepicker.min.js"></script>        
        <script src="<?php echo front_asset_url() ?>js/jquery.validate.min.js"></script>        
        <script src="<?php echo front_asset_url() ?>js/select2.full.js"></script>
        <script src="<?php echo front_asset_url(); ?>js/popper.min.js"></script>
        <script src="<?php echo front_asset_url(); ?>js/rolldate.min.js"></script>
        <script src="<?php echo front_asset_url(); ?>js/toastr.min.js"></script>
        
        
        <!-- Dynamic Load JS files starts -->
            <?php echo isset($js_files) ? $js_files : '';?>
        <!-- Dynamic Load JS files ends -->
        <script src="<?php echo front_asset_url() ?>js/custom.js"></script>
        <script>
            var errorToaster    = '<?php echo trim($this->session->flashdata('error')); ?>';
            var successToaster  = '<?php echo trim($this->session->flashdata('success')); ?>';

            if (successToaster != '') {
                showMessage('success', successToaster);
            }
            if (errorToaster != '') {
                showMessage('danger', errorToaster);
            }
            $('.toggle').click(function (e) {
                e.preventDefault();
                var $this = $(this);
                if ($this.next().hasClass('show')) {
                    $this.next().removeClass('show');
                    $this.next().slideUp();
                } else {
                    $this.parent().parent().find('li .inner').removeClass('show');
                    $this.parent().parent().find('li .inner').slideUp();
                    $this.next().toggleClass('show');
                    $this.next().slideToggle();
                }
            });
        </script>
        <!-- Js Files End --> 
    </body>

    <!-- Mirrored from themesjungle.net/html/prime-cab/home-1.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 15 Oct 2019 18:20:00 GMT -->
</html>