<html>
	<head>
		<!-- Input Styling -->
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
			#graph {
				width:960px;
				margin:auto;
			}
			.navbar {
				margin-bottom:1px;
			}
			.navbar .brand {
				font-family: 'Acme', sans-serif;
				font-size:24px;
				letter-spacing:1px;
			}
			div.btn-group ul.dropdown-menu {
				min-width:320px;
				max-width:360px;
			}
			.dropdown-definition {
				list-style-type:none;
				color:#999;
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
				padding:14px 0px 0px 0px;
			}
			div.well div.row-fluid {
				width:960px;
				margin:auto;
			}
			div.stat-select-Batter, div.stat-select-Pitcher {
				margin-left:10px;
				text-align:left;
				display:inline-block;
			}
			span.current-stat {
				font-size:14px;
			}
			div.player-select {
				margin-left:10px;
				display:inline-block;
				position:relative;
				top:-7px;
			}
			div.position-select {
				min-width:132px;
				display:inline-block;
				float:right;
			}
			input.span2.player {
				height:28px;
				padding-top:5px;
				font-size:14px;
				display:inline-block;
			}
			@media (max-width: 980px) {
				li form.form-inline {
					margin-left:13px;
				}
				input.span2.player {
					font-size:12px;
				}
				span.current-stat {
					font-size:12px;
				}
				div.position-select div.btn-group button {
					font-size:11px;
				}
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
				</div><!-- end nav-collapse -->
			</div><!-- End container -->
		</div><!-- End navbar-inner -->
	</div><!-- End navbar -->

	<!-- Begin well -->
	<div class="well">
		<div class="row-fluid">
			<div class="stat-select-Batter">
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
			</div><!-- end stat-select-batter -->
			<div class="stat-select-Pitcher" style="display:none;">
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
							<a href="#">ERA</a>
							<ul class="dropdown-definition">
								<li>
									Divide the number of earned runs allowed by the number of innings pitched and multiply by nine
								</li>
							</ul>
						<li class="divider"></li>
						<li>
							<a href="#" class="pro-stat">Strikeout Ratio <span>Available in Pro</span></a>
						</li>
					</ul><!-- end dropdown-menu -->
				</div><!-- end btn-group -->
			</div><!-- end stat-select-pitcher -->
			<div class="player-select">
				<input type="text" class="span2 player" data-provide="typeahead">
				<input type="text" class="span2 player" data-provide="typeahead">
				<input type="text" class="span2 player" data-provide="typeahead">
				<input type="text" class="span2 player" data-provide="typeahead">
			</div><!-- player-select end -->
			<div class="position-select">
				<div class="btn-group" data-toggle="buttons-radio">
					<button class="btn active" data-pos="Batter">Batters</button>
					<button class="btn" data-pos="Pitcher">Pitchers</button>
				</div>
			</div><!-- end position-select -->
		</div><!-- end row-fluid -->
	</div><!-- end well -->

	<!-- Begin container-fluid -->
	<div class="container-fluid">
		<div id="graph"></div>
	</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="bootstrap/docs/assets/js/google-code-prettify/prettify.js"></script>
<script type="text/javascript" src="bootstrap/docs/assets/js/bootstrap-collapse.js"></script>
<script type="text/javascript" src="bootstrap/docs/assets/js/bootstrap-typeahead.js"></script>
<script type="text/javascript" src="bootstrap/docs/assets/js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="bootstrap/docs/assets/js/bootstrap-button.js"></script>
<script type="text/javascript" src="highcharts/js/highcharts.min.js"></script>
<script type="text/javascript" src="drawgraph.js"></script>
<script type="text/javascript" src="changestat.js"></script>
</body>
</html>
