<!DOCTYPE html>
<html lang="en">

    <!-- Mirrored from themesjungle.net/html/prime-cab/home-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 15 Oct 2019 18:18:51 GMT -->
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Prime Cab HTML5 Responsive Template">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Prime Cab HTML5 Responsive Template</title>

        <!-- Css Files Start -->
        <link href="<?php echo front_asset_url() ?>css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo front_asset_url() ?>css/style.css" rel="stylesheet">
        <link href="<?php echo front_asset_url() ?>css/fontawesome-all.min.css" rel="stylesheet">
        <link id="switcher" href="<?php echo front_asset_url() ?>css/color.css" rel="stylesheet">
        <link href="<?php echo front_asset_url() ?>css/color-switcher.css" rel="stylesheet">
        <link href="<?php echo front_asset_url() ?>css/owl.carousel.css" rel="stylesheet">
        <link href="<?php echo front_asset_url() ?>css/select2.min.css" rel="stylesheet">
        <link href="<?php echo front_asset_url() ?>css/select2-bootstrap4.min.css" rel="stylesheet">
        <link href="<?php echo front_asset_url() ?>css/animate.css" rel="stylesheet">
        <link href="<?php echo front_asset_url() ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo front_asset_url(); ?>css/toastr.min.css">

        <link href="<?php echo front_asset_url() ?>css/responsive.css" rel="stylesheet">
        <link href="<?php echo front_asset_url() ?>css/custom.css" rel="stylesheet">
        <!-- Css Files End -->
 
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <?php echo (isset($css_files)) ? $css_files : ''; ?>

        <script src="<?php echo front_asset_url() ?>js/jquery-1.12.5.min.js"></script>
        <script type="text/javascript">
            var base_url = '<?php echo base_url(); ?>';
            var portal_url = '<?php echo portal_url(); ?>';
        </script>
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
        <script src="<?php echo front_asset_url() ?>js/jquery.validate.min.js"></script>
        <script src="<?php echo front_asset_url() ?>js/bootstrap-datetimepicker.min.js"></script>
        <script src="<?php echo front_asset_url() ?>js/select2.full.js"></script>
        <script src="<?php echo front_asset_url(); ?>js/popper.min.js"></script>
        <script src="<?php echo front_asset_url(); ?>js/toastr.min.js"></script>
        <!-- Js Files End --> 


        <!-- Script -->
        
        
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
    </body>

</html>