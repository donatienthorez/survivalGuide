<header></header>
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="">ESN - Survival Guide </a>
			<div class="nav-collapse">
				<?php if(isset($_SESSION['username']) && isset($_SESSION['code_section'])){ ?>
				<ul class="nav pull-right">
					<li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i><?php echo $_SESSION['username'];?><b class="caret"></b></a>
						<ul class="dropdown-menu">
						  <li><a href="includes/connection/logout.php">Logout</a></li>
						</ul>
					</li>
				</ul>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
