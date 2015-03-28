<?php include 'includes/connection/session.php'; ?>
<html>
	<head>
	      <meta charset="utf-8">

	      <title>ESN - Survival Guide</title>

	      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	      <meta name="apple-mobile-web-app-capable" content="yes">

	      <link rel="shortcut icon" href="css/img/logo.ico" type="image/vnd.microsoft.icon" />

	      <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">

	      <link href="css/bootstrap.min.css" rel="stylesheet">
	      <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	      <link href="css/font-awesome.css" rel="stylesheet">

	      <link href="css/pages/signin.css" rel="stylesheet">
	      <link href="css/pages/dashboard.css" rel="stylesheet">

	      <link href="css/style.css" rel="stylesheet">

	      <script src="js/jquery-1.7.2.min.js"></script> 
	      <script src="js/bootstrap.js"></script>
	</head>

	<body>
		<?php include 'includes/partials/navbar.php'; ?>
		<div class="subnavbar">
		<div class="subnavbar-inner">
				<div class="container">
					<ul class="mainnav">
						<li class=""><a href="index.php"><i class="icon-list-alt"></i><span>Survival Guide</span> </a> </li>
						<li class="active"><a href="notifications.php"><i class="icon-exclamation-sign"></i><span>Notifications</span> </a> </li>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>
