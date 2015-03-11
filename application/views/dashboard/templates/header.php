<!Doctype html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title><?php echo $title ?> - CodeIgniter 2 Tutorial</title>
    <link href="<?= base_url() ?>public/css/bootstrap.min.css" rel="stylesheet"/> 
    <link href="<?= base_url() ?>public/css/style.css" rel="stylesheet"/> 

    <script type="text/javascript" src="<?= base_url() ?>public/js/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>public/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>public/js/dashboard/template.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>public/js/dashboard/result.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>public/js/dashboard/event.js"></script>
    <script type="text/javascript" src="<?= base_url() ?>public/js/dashboard/dashboard.js"></script>
    <script>
     $(function(){
	 // Init the Dashboard Application
	 var dashboard = new Dashboard();

     });
    </script>
</head>
<body>
    <nav class="navbar navbar-default">
	<div class="container-fluid">
	    <div class="navbar-header">
		<a class="navbar-brand" href="#">CodeIgniter</a>
	    </div>
	    <div class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
		    <li><a href="#">Dashboard</a></li>
		    <li><a href="#">User</a></li>
		    <li><a href="<?= site_url('dashboard/logout') ?>">Logout</a></li>
		</ul>
	    </div>
	</div><!-- end container-fluid -->
    </nav>

    <!-- class wrapper -->
    <div class="wrapper">
