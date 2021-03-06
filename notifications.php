<html>
<?php 
include 'includes/connection/session.php'; 	
include 'includes/database/Database.php';
include 'includes/entities/Member.php';
include 'includes/model/MemberModel.php';
include 'includes/entities/Pushes.php';
include 'includes/entities/RegId.php';
include 'includes/model/NotificationModel.php';

$db = new Database("includes/database/config.xml");
$ms = new MemberModel($db);
$ns = new NotificationModel($db);

if(isset($_POST['code_section']) && ($ms->getRole($_SESSION['username'])==Member::ROLE_ADMIN))
{
    $_SESSION['code_section']=$_POST['code_section'];
}

$notifications = $ns->getLastNotifications($_SESSION['code_section']);


?>
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
	      
	      <script type="text/javascript">
		  $(document).ready(function() {

			$( "ListeSection" ).change(function(){
				console.log("test");
			});
		});
	      </script>

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

		<div class = "main-inner">
			<div class="container">
				<div class="span5">
					<div class="widget">
						<div class="widget-header">
							<i class="icon-book"></i>
							<h3>Send a notification</h3>
						</div>
						<div class="widget-content">

                                <form action="notifications.php" method="POST">
                                <?php if ($ms->getRole($_SESSION['username'])==Member::ROLE_ADMIN){
                                ?>
                                    <select id="ListeSection" name="code_section">
                                        <option value="<?php echo $_SESSION['phpCAS']['attributes']['sc']; ?>"><?php echo $_SESSION['phpCAS']['attributes']['sc']; ?></option>
                                        <option value="FR"  <?php if($_SESSION['code_section'] == "FR"){ echo "selected";}?>>French sections</option>
                                        <option value="ALL"  <?php if($_SESSION['code_section'] == "ALL"){ echo "selected";}?>>All the sections</option>
                                        <option value="DEV"  <?php if($_SESSION['code_section'] == "DEV"){ echo "selected";}?>>For developpers</option>
                                    </select>
                                    <input type="submit" value="Change my section">
                                <?php } ?>

                                </form>


                                    <form action="sendNotifications.php" method="post">


				<input type="hidden" value="DEV" name="code_section"/>
                                <div class="control-group">
                                    <label class="control-label" for="subject">Subject</label>
                                    <div class="controls">
                                        <input type="text" class="span4" id="subject" name="subject">
                                    </div> <!-- /controls -->
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="message">Message</label>
                                    <div class="controls">
                                        <textarea type="text" class="span4" id="message" rows="10" cols="50" name="message"></textarea>
                                    </div> <!-- /controls -->
                                </div>
                                <input type="submit" button class="btn btn-primary" value="Send notification">
                            </form>
						</div>
					</div>
				</div> <!-- /span5 -->
			
				<div class="span5">
					<div class="widget">
						<div class="widget-header"> 
							<i class="icon-book"></i>
							<h3>Last notification</h3>
						</div>
						<div class="widget-content">
							<ul class="news-items">
                                <?php

                                foreach($notifications as &$notification)
                                {
                                    $date = explode(" ", $notification->date);
                                    $date2 = explode("-", $date[0]);


                                echo "<li>
                                    <div class=\"news-item-date\">
                                        <span class=\"news-item-month\">" . $date2[2] . "/" . $date2[1] .  "</span>
                                        <span class=\"news-item-month\">" . $date[1] . "</span>
                                    </div>
                                            <div class=\"news-item-detail\">
                                        <span class=\"news-item-title\">" . $notification->subject . "</span>
                                                <p class=\"news-item-preview\">" . $notification->message . "</p>
                                            </div>
                                        </li>";
                                }


                                if(sizeof($notifications)==0){
                                    echo "There is no notifications yet.";
                                }
                                        ?>
                            </ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
