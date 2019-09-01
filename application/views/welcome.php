<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>assets/images/favicon.png">
    <title>Login User</title>
    
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/dist/css/style.css" rel="stylesheet">

    <style type="text/css">
    	body{
    		background: url(<?php echo base_url(); ?>assets/bg.jpg);
    		background-size: cover;
    		margin: 0;
    		text-align: center;
    	}
    	img{
    		margin-top: 8%;
    	}

    	p{
    		padding: 20px;
    		background-color: rgba(200,200,200, .8);
    		border-radius: 10px;
    	}
    </style>
 
</head>

<body>
    
    <div class="container">
		<img style="width: 200px;" src="<?php echo base_url(); ?>assets/logo.png" class="img-fluid">
    	<h1 class="mt-4">Welcome in Vielab</h1><br>
	    <p>vielab or virtual english laboratory is specifically designed to practice and test your English. With vielab, break the border of learning. Improve your english skill anytime and anywhere you want.</p>
	    <a class="btn btn-outline-primary" href="<?php echo base_url(); ?>login">Sign In Now</a>
	</div>
    	
    <script src="<?php echo base_url(); ?>assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/node_modules/popper/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    
</body>

</html>