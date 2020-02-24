
<!--header start-->
<?php echo isset($header) ? $header : ''; ?>
<!--header end-->

<!--sidebar start-->
<?php echo isset($left_sidebar) ? $left_sidebar : ''; ?>
<!--sidebar end-->


<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><?php echo isset($breadcrumbs['page_title']) ? $breadcrumbs['page_title'] : 'Dashboard'; ?></h1>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">        
            <div class="content-body">
                <?php echo isset($content) ? $content : ''; ?>
            </div>
        </div>
    </div>
</div>
