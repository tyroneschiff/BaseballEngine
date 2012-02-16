<? require 'batters.php'; ?>
<html>
	<head>
		<!-- Chosen Styling -->
		<link rel="stylesheet" href="chosen/chosen/chosen.css">

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
			#graph {
				height:90%;
			}
			.navbar-search input {
				height:25px;
				margin-top:3px;
				font-size:14px;
			}
			.navbar .brand {
				font-family: 'Acme', sans-serif;
				font-size:24px;
				letter-spacing:1px;
			}
			.chzn-container-multi .chzn-choices .search-field input {
				height:25px;
				padding-top:5px;
			}
			.chzn-container {
				top:1px;
			}
		</style>
		<title>The Baseball Engine</title>
	</head>
<body>

	<!-- Begin navbar -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container" style="width:auto;">
				<a class="brand" href="#">The Baseball Engine</a>
				<form class="navbar-search pull-left">
					<select data-placeholder="Select your batters..." class="chzn-select span6" multiple>
						<? foreach ( $batters as $id => $player_names ): ?>
						<option><?= $player_names; ?></option>
						<? endforeach; ?>
					</select>
				</form>
				<ul class="nav pull-right">
					<li class="divider-vertical"></li>
					<li><a href="#">Go Pro</a></li>
				</ul>
			</div><!-- End container -->
		</div><!-- End navbar-inner -->
	</div><!-- End navbar -->

	<!-- Begin container-fluid -->
	<div class="container-fluid">
		<div id="graph"></div>
	</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/docs/assets/js/google-code-prettify/prettify.js"></script>
<script type="text/javascript" src="bootstrap/docs/assets/js/bootstrap-collapse.js"></script>
<script type="text/javascript" src="bootstrap/docs/assets/js/bootstrap-typeahead.js"></script>
<script type="text/javascript" src="bootstrap/docs/assets/js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="highcharts/js/highcharts.src.js"></script>
<script type="text/javascript" src="drawgraph.js"></script>
<script type="text/javascript" src="chosen/chosen/chosen.jquery.js"></script>
<script>
	$(".chzn-select").chosen();
	$(".chzn-select-deselect").chosen({allow_single_deselect:true}); 
</script>
</body>
</html>
