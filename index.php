<?php
	session_start();
	
	// On redirige vers guide si la personne est deja connecte 
	if(isset($_SESSION['username']) && isset($_SESSION['code_section'])) {
		header('Location: guide.php');
	}

    include 'includes/database/Database.php';
    include 'includes/model/NotificationModel.php';
    include 'includes/model/GuideModel.php';

    $db = new Database("includes/database/config.xml");
    $ns = new NotificationModel($db);
    $gm = new GuideModel($db);

    $nb_notifications = $ns->countNotification();
    $nb_guides = $gm->countGuide();
    $nb_users = $ns->countRegIds();
?>
<html>
	<head>
		<title>ESN - Survival Guide</title>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="apple-mobile-web-app-capable" content="yes">

		<link rel="shortcut icon" href="css/img/logo.ico" type="image/vnd.microsoft.icon" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="css/font-awesome.css" rel="stylesheet">
		<link href="css/pages/dashboard.css" rel="stylesheet"><link href="css/pages/dashboard.css" rel="stylesheet">
		<link href="css/pages/signin.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">

		<script src="js/jquery-1.7.2.min.js"></script>      

		<script type="text/javascript">
			function animateToValue(value, id_layout) {
				$({someValue: 0}).animate({someValue: value}, {
					duration: 2000,
					easing: 'swing', // can be anything
					step: function () { // called on every step
						// Update the element's text with rounded-up value:
						$('#' + id_layout).text(commaSeparateNumber(Math.round(this.someValue)));
					}
				});
			}
			animateToValue(<?php echo $nb_notifications; ?>, "layout_guides");
			animateToValue(<?php echo $nb_users; ?>, "layout_users");
			animateToValue(<?php echo $nb_guides; ?>, "layout_notifications");

			function commaSeparateNumber(val) {
				while (/(\d+)(\d{3})/.test(val.toString())) {
					val = val.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
				}
				return val;
			}
		</script>
	</head>

	<body>
		<?php include 'includes/partials/navbar.php'; ?>

		<div class="account-container"  style="width:700px;">
			<div class="content clearfix">
				<h1 style="text-align:center;">Welcome </h1><br/>
				<h3 style="text-align:center">Welcome to the Survival Guide edition website.</h3> <br/>
				<h3 style="text-align:center">To access to all the functionalities, connect with your galaxy account.</h3> <br/>
				<center>
					<a href="includes/connection/login_galaxy.php">
						<button class="button btn btn-success btn-medium btn-galaxy">Connect with Galaxy</button>
					</a>
				</center>
			</div>
		</div>

		<div class="account-container" style="width:700px;">
			<div class="content clearfix">
				<h3 style="text-align:center">Send notifications to your Erasmus students and write a survival guide for them.</h3><br/>
		
			<div id="big_stats" class="cf">
				<div class="stat"> <i class="icon-book"></i> <span class="value"><span id="layout_guides">3</span> guides</span></div>
				<!-- .stat -->

				<div class="stat"> <i class="icon-user"></i> <span class="value"><span id="layout_users">25</span> users</span> </div>
				<!-- .stat -->

				<div class="stat"> <i class="icon-exclamation-sign"></i> <span class="value"><span id="layout_notifications">74</span> notifications</span> </div>
				<!-- .stat -->
				<!-- /widget-content --> 
			</div>
            <br>
            <h3 style="text-align:center"> For any suggestions, remarks or bugs, please contact : <a href="mailto:webmaster@esnlille.fr">webmaster@esnlille.fr</a></h3>
		</div>
	</body>
</html>
