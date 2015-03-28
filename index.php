<?php require_once 'php/init.php'; ?>
<html>
	<head>
		<title>Flatmate Balance Manager</title>

		<link rel="stylesheet" type="text/css" href="css/reset.css">
		<link rel="stylesheet" type="text/less" href="css/style.less">

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.cookie.js"></script>
		<script type="text/javascript" src="js/less.min.js"></script>
	</head>
	<body>
		<div id="title">
			<h1>Flatmate</h1>
			<h3>Balance Manager</h3>
			<nav class="card list">
				<ul>
					<li><a href="./">Lists</a></li>
					<li><a href="./?page=pstats">Per person stats</a></li>
					<li><a href="./?page=stats">Stats</a></li>
					<li><a href="./?page=charts">Charts</a></li>
					<li><a href="./php/reset.php" title="Clear all existing balance">Reset Balance Date</a></li>
				</ul>
			</nav>
		</div>
		<div id="container">
		<?php
			if(isset($_GET["page"])){
				$page = $_GET["page"];
				if($page=='pstats')
					require_once 'php/pstats.php';
				else if($page=='stats')
					require_once 'php/stats.php';
				else if($page=='charts')
					require_once 'php/charts.php';
				else
					require_once 'php/home.php';
			}
			else{
				require_once 'php/home.php';
			}
		?>
		</div>
	</body>
	<script type="text/javascript" src="js/functions.js"></script>
</html>