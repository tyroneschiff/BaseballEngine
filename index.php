<html>
	<head>
		<!-- Bootstrap Styling -->
		<link rel="stylesheet" href="bootstrap/docs/assets/css/bootstrap.css">
		<link rel="stylesheet" href="bootstrap/docs/assets/css/bootstrap-responsive.css">
		<link rel="stylesheet" href="bootstrap/docs/assets/css/docs.css">
		<link rel="stylesheet" href="bootstrap/docs/assets/js/google-code-prettify/prettify.css">
		<link href='http://fonts.googleapis.com/css?family=Acme|Ubuntu' rel='stylesheet' type='text/css'>
	
		<style>
			body {
				padding-top:0px;
				font-family: 'Ubuntu', sans-serif;
			}
			.player-search {
				margin-top:4px;
				border-radius:8px;
			}
			#chart {
				height:90%;
			}
			.chzn-container {
				top:3px;
			}
			.chzn-container-multi .chzn-choices .search-field input {
				height:18px;
			}
			.navbar-search input {
				height:25px;
				margin-top:3px;
				font-size:14px;
				margin-left:10px;
			}
			.navbar .brand {
				font-family: 'Acme', sans-serif;
				font-size:24px;
				letter-spacing:1px;
			}
		</style>
		<title>The Baseball Engine</title>
	</head>
<body>

	<!-- Begin navbar -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container" style="width:auto;">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="#">The Baseball Engine</a>
				<div class="nav-collapse">
					<form class="navbar-search pull-left">
						<input type="text" class="typeahead span2" data-provide="typeahead" data-items="8">
					</form>
					<form class="navbar-search pull-left playerSearch2">
						<input type="text" class="typeahead span2" data-provide="typeahead" data-items="8">
					</form>
					<ul class="nav pull-right">
						<li class="divider-vertical"></li>
						<li><a href="#">Go Premium</a></li>
					</ul>
				</div><!-- End nav-collapse -->
			</div><!-- End container -->
		</div><!-- End navbar-inner -->
	</div><!-- End navbar -->

	<!-- Begin container-fluid -->
	<div class="container-fluid">
		<div id="chart"></div>
	</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/docs/assets/js/google-code-prettify/prettify.js"></script>
<script type="text/javascript" src="bootstrap/docs/assets/js/bootstrap-collapse.js"></script>
<script type="text/javascript" src="bootstrap/docs/assets/js/bootstrap-typeahead.js"></script>
<script type="text/javascript" src="bootstrap/docs/assets/js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="highcharts/js/highcharts.src.js"></script>
<script type="text/javascript" src="drawgraph.js"></script>
<script type="text/javascript" src="batters.js"></script>
<script type="text/javascript" src="typeahead.js"></script>
</body>
</html>
