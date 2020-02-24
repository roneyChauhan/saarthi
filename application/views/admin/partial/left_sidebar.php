<?php 
    $currentClass   = $this->router->fetch_class();
    $currentMethod  = $this->router->fetch_method();
    $currentView    = '';

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <span class="brand-text font-weight-light">Admin</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?php echo admin_url(); ?>" class="nav-link <?php echo ($currentClass == 'admin') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo admin_url(); ?>state" class="nav-link <?php echo ($currentClass == 'state') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>State</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo admin_url(); ?>city" class="nav-link <?php echo ($currentClass == 'city') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>City</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo admin_url(); ?>route" class="nav-link <?php echo ($currentClass == 'route') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Route</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo admin_url(); ?>category" class="nav-link <?php echo ($currentClass == 'category') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo admin_url(); ?>vehicle_type" class="nav-link <?php echo ($currentClass == 'vehicle_type') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Vehicle Type</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo admin_url(); ?>vehicle" class="nav-link <?php echo ($currentClass == 'vehicle') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Vehicle</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo admin_url(); ?>booking" class="nav-link <?php echo ($currentClass == 'booking') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Booking</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo admin_url(); ?>user" class="nav-link <?php echo ($currentClass == 'user') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo admin_url(); ?>inquiry" class="nav-link <?php echo ($currentClass == 'inquiry') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>Inquiry</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!--<nav class="side-navbar">
    <div class="side-navbar-wrapper">
         Sidebar Header    
        <div class="sidenav-header d-flex align-items-center justify-content-center">
             User Info
            <div class="sidenav-header-inner text-center"><img src="../../../d19m59y37dris4.cloudfront.net/dashboard/1-4-5/img/avatar-7.jpg" alt="person" class="img-fluid rounded-circle">
                <h2 class="h5">Nathan Andrews</h2><span>Web Developer</span>
            </div>
             Small Brand information, appears on minimized sidebar
            <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center"> <strong>B</strong><strong class="text-primary">D</strong></a></div>
        </div>
         Sidebar Navigation Menus
        <div class="main-menu">
            <h5 class="sidenav-heading">Main</h5>
            <ul id="side-main-menu" class="side-menu list-unstyled">
                <li class="<?php echo ($currentClass == 'category') ? 'active' : ''; ?>" >
                    <a class="menu-item" href="<?php echo admin_url(); ?>category">Category</a>
                </li>
                <li class="<?php echo ($currentClass == 'vehicle') ? 'active' : ''; ?>" >
                    <a class="menu-item" href="<?php echo admin_url(); ?>vehicle">Vehicles</a>
                </li>
                <li class="<?php echo ($currentClass == 'state') ? 'active' : ''; ?>" >
                    <a class="menu-item" href="<?php echo admin_url(); ?>state">State</a>
                </li>
                <li class="<?php echo ($currentClass == 'city') ? 'active' : ''; ?>" >
                    <a class="menu-item" href="<?php echo admin_url(); ?>city">City</a>
                </li>
            </ul>
        </div>
        <div class="admin-menu">
            <h5 class="sidenav-heading">Second menu</h5>
            <ul id="side-admin-menu" class="side-menu list-unstyled"> 
                <li> <a href="#"> <i class="icon-screen"> </i>Demo</a></li>
                <li> <a href="#"> <i class="icon-flask"> </i>Demo
                        <div class="badge badge-info">Special</div>
                    </a>
                </li>
                <li> <a href="#"> <i class="icon-flask"> </i>Demo</a></li>
                <li> <a href="#"> <i class="icon-picture"> </i>Demo</a></li>
            </ul>
        </div>
    </div>
</nav>-->
