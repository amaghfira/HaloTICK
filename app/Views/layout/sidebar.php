<?php $sess = session(); ?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #202C59;">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="<?= base_url('dist/img/bpsputih.png'); ?>" alt="Logo BPS" style="opacity: .8; width:230px">
        <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="info">
                <a href="" class="d-block">Selamat Datang, <br> <b style="color:lightskyblue"><?php echo $sess->nama; ?></b> </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <?php if ($_SESSION['role'] == '92600' || $_SESSION['role'] == '92610' || $_SESSION['role'] == '92620' || $_SESSION['role'] == '92630') : ?>
                        <a href="<?= base_url(); ?>/admin/home" class="nav-link">
                        <?php else : ?>
                            <a href="<?= base_url(); ?>/user/home" class="nav-link">
                            <?php endif; ?>
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Dashboard
                                <span class="right badge badge-danger">New</span>
                            </p>
                            </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url() ?>/tiket/index" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Tickets List
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url() ?>/tiket/add" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Create Ticket
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Website Management
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/charts/chartjs.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/status" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Statuses</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/category" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>/priority" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Priorities</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url(); ?>/auth/logout" class="nav-link">
                        <i class="nav-icon fas fa-fw fa-sign-out-alt">
                        </i>
                        Logout
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- MAIN CONTENT  -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0">Dashboard</h1> -->
                </div><!-- /.col -->
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->