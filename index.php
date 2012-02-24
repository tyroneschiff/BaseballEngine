<? require 'batters.php'; ?>
<html>
	<head>
		<!-- Chosen Styling -->
		<link rel="stylesheet" href="chosen/chosen/chosen.css">
		<link rel="stylesheet" href="selections.css">

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
			.navbar {
				margin-bottom:1px;
			}
			.navbar .brand {
				font-family: 'Acme', sans-serif;
				font-size:24px;
				letter-spacing:1px;
			}
			.dropdown-menu {
				min-width:320px;
				max-width:360px;
			}
			.dropdown-definition {
				list-style-type:none;
				color:#999;
			}
			@media (max-width: 980px) {
				li form.form-inline {
					margin-left:13px;
				}
				div[id$="_chzn"]{
					width:560px !important;
					margin-left:20px;
					font-size:12px !important;
				}
				.chzn-container {
					margin-left:20px;
				}
			}
			@media (min-width: 980px) {
				div[id$="_chzn"]{
					width:auto !important;
					margin-left:20px;
					min-width:560px;
					max-width:1126px;
				}
			}
			ul.dropdown-menu li a.pro-stat span {
				font-size:11px;
				padding:2px 3px;
				background:#000;
				color:white;
				border-radius:4px;
				font-weight:normal;
			}
			form.form-inline {
				margin:6px 3px 0px 3px;
			}
			form.form-inline input.input-small {
				height:27px;
				font-size:10px;
			}
			form.form-inline button.btn.btn-inverse {
				padding:4px 10px;
				margin:0px;
			}
			.input-small {
				width:120px;
			}
			div.well {
				padding:8px 0px;
			}
			.chzn-container-multi .chzn-choices .search-field input {
				height:25px;
			}
			.chzn-container {
				font-size:14px;
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
					<ul class="nav pull-left">
						<li>
							<a href="#About">About</a>
						</li>
						<li>
							<a href="#Pro">Go Pro</a>
						</li>
					</ul>
					<ul class="nav pull-right">
						<li>
							<form class="form-inline" action="http://baseballengine.com/pro/checkLogin.php" method="post">
								<input type="text" class="input-small" placeholder="Email" name="username" />
								<input type="password" class="input-small" placeholder="Password" name="password" />
								<button type="submit" class="btn btn-inverse">Log In</button>
							</form>
						</li>
					</ul><!-- end nav pull-right -->
				</div>
			</div><!-- End container -->
		</div><!-- End navbar-inner -->
	</div><!-- End navbar -->

	<!-- Begin well -->
	<div class="well">
		<div class="row-fluid">
			<div style="float:left;margin-left:20px;">
				<div class="btn-group">
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="current-stat">BE Score</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="#">BE Score</a>
							<ul class="dropdown-definition">
								<li>
									The Baseball Engine's method for ranking players
								</li>
							</ul>
						</li>
						<li>
							<a href="#">Average</a>
							<ul class="dropdown-definition">
								<li>
									Number of hits (divided by) number of at bats
								</li>
							</ul>
						<li class="divider"></li>
						<li>
							<a href="#" class="pro-stat">Home Run Ratio <span>Available in Pro</span></a>
						</li>
					</ul><!-- end dropdown-menu -->
				</div><!-- end btn-group -->
			</div><!-- end -->
			<div style="float:left;">
				<select data-placeholder="Select your batters..." class="chzn-select span9" multiple>
					<? foreach ( $batters as $id => $player_name ): ?>
					<option <? if ( in_array( $player_name, $topBEscores ) ){ echo "selected=selected"; } ?>><?= $player_name; ?></option>          
					<? endforeach; ?>
				</select>
			</div><!-- end -->
		</div><!-- end row-fluid -->
	</div>

	<!-- Begin container-fluid -->
	<div class="container-fluid">
		<div id="graph"></div>
	</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/docs/assets/js/google-code-prettify/prettify.js"></script>
<script type="text/javascript" src="bootstrap/docs/assets/js/bootstrap-collapse.js"></script>
<script type="text/javascript" src="bootstrap/docs/assets/js/bootstrap-typeahead.js"></script>
<script type="text/javascript" src="bootstrap/docs/assets/js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="bootstrap/docs/assets/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="highcharts/js/highcharts.src.js"></script>
<script type="text/javascript" src="drawgraph.js"></script>
<script type="text/javascript" src="changestat.js"></script>
<script type="text/javascript" src="functional.js"></script>
<script type="text/javascript" src="chosen/chosen/chosen.jquery.js"></script>
<script>
	$(".chzn-select").chosen();
	$(".chzn-select-deselect").chosen({allow_single_deselect:true}); 
</script>
</body>
</html>
