<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>AdminLTE 3</title>

        <link rel="stylesheet" href="<?php echo asset_url(); ?>css/all.min.css">
        <link rel="stylesheet" href="<?php echo asset_url(); ?>css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo asset_url(); ?>css/adminlte.min.css">
        <link rel="stylesheet" href="<?php echo asset_url(); ?>css/toastr.min.css">
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        
        <?php echo (isset($css_files)) ? $css_files : ''; ?>

        <link rel="stylesheet" href="<?php echo asset_url(); ?>css/custom.css">        

        <script src="<?php echo asset_url(); ?>js/jquery.min.js"></script>
        <script type="text/javascript">
            var base_url    = '<?php echo base_url(); ?>';
            var ADMIN_URL   = '<?php echo admin_url(); ?>';
        </script>
    </head>
    <body class="<?php echo isset($body_class) ? $body_class : "" ?>">
        <div class="wrapper">
            <?php echo isset($main_content) ? $main_content : ''; ?>
        </div>

        <script src="<?php echo asset_url(); ?>js/jquery.validate.min.js"></script>
        <script src="<?php echo asset_url(); ?>js/toastr.min.js"></script>
        <script src="<?php echo asset_url(); ?>js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo asset_url(); ?>js/bootstrap-switch.min.js"></script>
        <script type="text/javascript" src="<?php echo asset_url(); ?>js/sweetalert2.js"></script>

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
