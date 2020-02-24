<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <title><?php echo isset($page_title) ? $page_title : "eLibrary Admin Portal"; ?></title>

        <meta name="description" content="<?php echo isset($metaData['metaDescription']) ? $metaData['metaDescription'] : ''; ?>">
        <meta name="keywords" content="<?php echo isset($metaData['metaKeywords']) ? $metaData['metaKeywords'] : ""; ?>">

        <!--<link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">-->
        
        <link rel="stylesheet" href="<?php echo asset_url(); ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo asset_url(); ?>css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo asset_url(); ?>css/fontastic.css">
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">

        <link rel="stylesheet" href="<?php echo asset_url(); ?>css/grasp_mobile_progress_circle-1.0.0.min.css">
        <link rel="stylesheet" href="<?php echo asset_url(); ?>css/jquery.mCustomScrollbar.css">
        <link rel="stylesheet" href="<?php echo asset_url(); ?>css/style.default.css" id="theme-stylesheet">
        <link rel="stylesheet" href="<?php echo asset_url(); ?>css/custom.css">
        <link rel="shortcut icon" href="https://d19m59y37dris4.cloudfront.net/dashboard/1-4-5/img/favicon.ico">

        <?php echo (isset($css_files)) ? $css_files : ''; ?>

        <!--<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/style.css">-->
        
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script type="text/javascript">
            var base_url    = '<?php echo base_url(); ?>';
            var ADMIN_URL   = '<?php echo admin_url(); ?>';
        </script>

    </head>
    <body>
        
        <?php echo isset($main_content) ? $main_content : ''; ?>

    <script src="<?php echo asset_url(); ?>js/jquery.min.js"></script>
    <script src="<?php echo asset_url(); ?>js/popper.min.js"> </script>
    <script src="<?php echo asset_url(); ?>js/bootstrap.min.js"></script>
    <script src="<?php echo asset_url(); ?>js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="<?php echo asset_url(); ?>js/jquery.cookie.js"> </script>
    <!--<script src="<?php echo asset_url(); ?>js/Chart.min.js"></script>-->
    <script src="<?php echo asset_url(); ?>js/jquery.validate.min.js"></script>
    <script src="<?php echo asset_url(); ?>js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!--<script src="<?php echo asset_url(); ?>js/charts-home.js"></script>-->
    <!-- Main File-->
    <script src="<?php echo asset_url(); ?>js/front.js"></script>

        <!-- Dynamic Load JS files starts -->
            <?php echo isset($js_files) ? $js_files : '';?>
        <!-- Dynamic Load JS files ends -->

        <script src="<?php echo asset_url(); ?>js/custom.js"></script>

        <?php
            $success= $this->session->flashdata('success');
            $error  = $this->session->flashdata('error');
        ?>

        <script type="text/javascript">
            setTimeout(function() {
                <?php if (isset($success) && $success != '') { ?>
                    showMessage('success', '<?php echo $success; ?>');
                <?php } else if (isset($error) && $error != '') { ?>
                    showMessage('danger', '<?php echo $error; ?>');
                <?php } ?>
            }, 100);
        </script>

    </body>
</html>