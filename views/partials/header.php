<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Belanja</title>
        <!-- Bootstrap Core CSS -->
        <link href="<?= base_url ?>/assets/css/bootstrap.css" rel="stylesheet">
        <!-- Font awesome -->
        <link href="<?= base_url ?>/assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?= base_url ?>/assets/css/reset.css" rel="stylesheet">
        <link href="<?= base_url ?>/assets/css/style.css" rel="stylesheet">
        <!-- jQuery -->
        <script src="<?= base_url ?>/assets/js/jquery.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?= base_url ?>/assets/js/bootstrap.min.js"></script>
    </head>

    <body>
        <!-- Header -->
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <a class="navbar-brand" href="<?= base_url ?>">BELANJA</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?= base_url ?>/?page=produk"><span class="glyphicon glyphicon-th-large"></span> Produk </a></li>
                        <li><a href="<?= base_url ?>/?page=cart"><span class="glyphicon glyphicon-shopping-cart"></span> Cart </a></li>
                        <?php if(!$this->session['username']): ?>
                        <li><a href="<?= base_url ?>/?page=member"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        <?php else: ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?= $this->session['user_nama'] ?><span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url ?>/?page=logout">Logout</a></li>
                            </ul>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!--Header end-->