<? require "/home/tyrone/baseballengine1.2/run.php"; ?>
<html>
	<head>
		<!-- Input Styling -->
		<link rel="stylesheet" href="/selections.css">

		<!-- Bootstrap Styling -->
		<link rel="stylesheet" href="/bootstrap/docs/assets/css/bootstrap.css">
		<link rel="stylesheet" href="/bootstrap/docs/assets/css/bootstrap-responsive.css">
		<link rel="stylesheet" href="/bootstrap/docs/assets/css/docs.css">
		<link rel="stylesheet" href="/bootstrap/docs/assets/js/google-code-prettify/prettify.css">
		<link href='https://fonts.googleapis.com/css?family=Acme|Ubuntu' rel='stylesheet' type='text/css'>

		<!-- Favicon -->
		<link href="/images/favicon.ico" rel="icon" type="image/x-icon" />

		<!-- Page Specific Styling -->
    <link rel="stylesheet" href="/css/style.css">
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
							<a href="#goPro" data-toggle="modal">Go Pro</a>
						</li>
					</ul>
					<ul class="nav pull-right">
						<li>
							<form class="form-inline" action="/login/checkLogin.php" method="post">
								<input type="text" class="input-small" placeholder="Email" name="email" />
								<input type="password" class="input-small" placeholder="Password" name="passwordPro" />
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
			<div class="position-select">
				<div class="btn-group" data-toggle="buttons-radio">
					<button class="btn active" data-pos="Batter">Batters</button>
					<button class="btn" data-pos="Pitcher">Pitchers</button>
				</div>
			</div><!-- end position-select -->
			<div class="stat-select-Batter">
				<div class="btn-group">
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<span class="current-stat">BE Score</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="#" rel="popover" data-content="The Baseball Engine's method for ranking players. Uses aspects of OBP, SLG, RBI, HR, R, SB, AB, & VORP." data-original-title="BE Score" class="definition">BE Score</a>
							<a href="#" rel="popover" data-content="The number of hits divided by the number of at bats." data-original-title="Average" class="definition">Average</a>
							<a href="#" rel="popover" data-content="An official turn at batting charged to a baseball player except when the player walks, sacrifices, is hit by a pitched ball, or is interfered with by the catcher." data-original-title="At Bats" class="definition">At Bats</a>
							<a href="#" rel="popover" data-content="The number of times a player advances around first, second and third base and returns safely to home plate, before three outs are recorded." data-original-title="Runs" class="definition">Runs</a>
							<a href="#" rel="popover" data-content="A hit is credited to a batter when the batter safely reaches first base after hitting the ball into fair territory, without the benefit of an error or a fielder's choice." data-original-title="Hits" class="definition">Hits</a>
							<a href="#" rel="popover" data-content="A double is the act of a batter safely reaching second base after hitting the ball." data-original-title="Doubles" class="definition">Doubles</a>
							<a href="#" rel="popover" data-content="A triple is the act of a batter safely reaching third base after hitting the ball." data-original-title="Triples" class="definition">Triples</a>
							<a href="#" rel="popover" data-content="A home run is scored when the ball is hit so that the batter is able to reach home safely in one play without any errors being committed by the defensive team in the process." data-original-title="Home Runs" class="definition">Home Runs</a>
							<a href="#" rel="popover" data-content="When a runner scores a run resulting from a player's at bat." data-original-title="RBI" class="definition">RBI</a>
							<a href="#" rel="popover" data-content="A strikeout occurs when a batter receives three strikes during hit time at bat." data-original-title="Strikeout" class="definition">K</a>
							<a href="#" rel="popover" data-content="A stolen base occurs when a baserunner successfully advances to the next base while the pitcher is delivering the ball to home plate." data-original-title="Stolen Bases" class="definition">SB</a>
							</li>
							<li class="divider"></li>
							<li>
							<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="When the baserunner attempts to advance or lead off from one base to another without the ball being batted and then is tagged out by a fielder while making the attempt." data-original-title="Caught Stealing" class="definition pro-stat">CS</a>
							<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A based on balls is credited to a batter when a batter receives four pitches that the umpire calls balls. It is better known as a walk." data-original-title="Base on Balls" class="definition pro-stat">BB</a>
							<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A measure of how often a batter reaches base for any reason other than a fielding error, fielder's choice, dropped/uncaught third strike, fielder's obstruction, or catcher's interference." data-original-title="On-Base Percentage" class="definition pro-stat">OBP</a>
							<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A mesure of the powwer of a hitter. It is calculated as total bases divided by at bats." data-original-title="Slugging percentage" class="definition pro-stat">SLG</a>
							<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A sabermetric baseball statistic calculated as the sum of a player's on-base percentage and slugging percentage." data-original-title="On-base plus Slugging" class="definition pro-stat">OPS</a>
							<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The total number of games in which a player has participated." data-original-title="Games Played" class="definition pro-stat">GP</a>
							<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The number of games in which the player started the game in the starting lineup." data-original-title="Games Started" class="definition pro-stat">GS</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="Total bases refers to the number of bases a player has gained with hits, i.e., the sum of his hits weighted by 1 for a single, 2 for a double, 3 for a triple and 4 for a home run. Only bases attained from hits count toward this total." data-original-title="Total Bases" class="definition pro-stat">TB</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A batter's act of deliberately bunting the ball in a manner that allows a runner on base to advance to another base." data-original-title="Sacrifice Hit/Bunt" class="definition pro-stat">SH</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A sacrifice fly is a batted ball that satisfies four criteria: [1]: There are fewer than two outs when the ball is hit. [2]: The ball is hit to the outfield. [3]: The batter is put out because an outfielder (or an infielder running in the outfield) catches the ball on the fly (or the batter would have been out if not for an error). [4]: A runner who is already on base scores on the play." data-original-title="Sacrifice Fly" class="definition pro-stat">SF</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="Measures the times when a batter hits a ground ball that leads to a double play being executed by the defense without a fielding error on either of the putouts." data-original-title="Grounded into Double Play" class="definition pro-stat">GIDP</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The sum total of a player's at-bats, base on balls (walks), times hit by pitch, sacrifice flies, sacrifice bunts, or times reaching base due to defensive interference." data-original-title="Total Plate Appearances" class="definition pro-stat">TPA</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="Measures the times in which a player or a piece of equipment, excluding his bat, is contacted by the ball during a pitch." data-original-title="Hit by Pitch" class="definition pro-stat">HBP</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="Records when the pitcher deliberately walks a batter by throwing the ball, known as an Intentional Ball, away from the batter preventing them from making a hit on the ball. The batter is automatically allowed to move to first base without risk of being put out. Both the batter and the pitcher receive a Intentional Base on Balls (IBB) when this occurs." data-original-title="Intentional Walk" class="definition pro-stat">IBB</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The number of consecutive official games in which a player gets at least one base hit." data-original-title="Hitting Streak" class="definition pro-stat">HS</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The number of at bats a batter has when there is at least one player on either second or third base." data-original-title="At Bats - Runners in Scoring Position" class="definition">AB (RISP)</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The number of hits a batter has when there is at least one player on either second or third base." data-original-title="Hits - Runners in Scoring Position" class="definition">Hits (RISP)</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A batter's batting average when there is at least one player on either second or third base." data-original-title="Average - Runners in Scoring Position" class="definition">Avg (RISP)</a>
						 	<span>Pro</span><a href="#goPro" rel="popover" data-toggle="modal" data-content="The number of at bats divided by the number of home runs." data-original-title="Home Run Rate" class="definition pro-stat">HR Rate</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The number of at bats divided by the number of runs batted in." data-original-title="RBI Rate" class="definition pro-stat">RBI Rate</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The number of at bats divided by the number of walks." data-original-title="Base on Bals Rate" class="definition pro-stat">BB Rate</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The number of at bats divided by the number of strikeout." data-original-title="Strikeout Rate" class="definition pro-stat">K Rate</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The number of at bats divided by the number of doubles hit." data-original-title="Double Rate" class="definition pro-stat">Double Rate</a>
							<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The number of at bats divided by the number of triples hit." data-original-title="Triple Rate" class="definition pro-stat">Triple Rate</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The number of at bats divided by the number of runs." data-original-title="Runs Rate" class="definition pro-stat">Runs Rate</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The number of at bats divided by the number of stolen bases." data-original-title="Stolen Base Rate" class="definition pro-stat">SB Rate</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The number of at bats divided by the number of total bases." data-original-title="Total Bases Rate" class="definition pro-stat">TB Rate</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A player's stolen base percentage measures his rate of success in stealing bases. Formula: SB% = Stolen Bases/(Stolen Bases + Caught Stealing)" data-original-title="Stolen Base Percentage" class="definition pro-stat">SB %</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content='Runs created is a baseball statistic invented by Bill James to estimate the number of runs a hitter contributes to his team. The Baseball Engine uses the "Technical" version of runs created in its calculations.' data-original-title="Runs Created" class="definition pro-stat">Runs Created</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="Measures how many of a batter's balls in play go for hits. Formula: BABIP = (Hits - Home runs)/(At Bats - Strikeouts - Home Runs + Sacrifice Flies)" data-original-title="Batting average on balls in play" class="definition pro-stat">BABIP</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="Gross Production Average or GPA is a baseball statistic created in 2003 by Aaron Gleeman, as a refinement of On-Base Plus Slugging (OPS). Formula: GPA = ((1.8)OBP + SLG)/4" data-original-title="Gross Production Average" class="definition pro-stat">GPA</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A sabermetric which measures a batter's raw power. Formula: ISO = SLG - AVG." data-original-title="Isolated Power" class="definition pro-stat">ISO</a>
						 <span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content='Demonstrates how much a hitter contributes offensively to his team in comparison to a fictitious "replacement player," who is an average fielder at his position and a below average hitter.' data-original-title="Value over replacement player" class="definition pro-stat">VORP</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A measure of a hitter's plate discipline and knowledge of the strike zone." data-original-title="Walk-to-strikeout ratio" class="definition pro-stat">BB:K</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="Normalizes league average so as to permit cross-era comparison. Formula: (Hits/At Bats)/((League Hits - Hits)/(League At Bats - At Bats))." data-original-title="Relative Batting Average" class="definition pro-stat">Relative BA</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A measure of offensive contribution from a variety of batting and baserunning events. The concept of the numerator is bases gaines, that of the denominator is outs made. Formula: (Total Bases + Steals + Walks + HBP - Caught Stealing)/(At Bats - Hits + Caught Stealing + GIDP)." data-original-title="Total Average" class="definition pro-stat">Total AVG</a>
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
							<a href="#" rel="popover" data-content="The Baseball Engine's method for ranking players. Uses aspects of Wins, SO, ERA, WHIP, BAA, Saves, MB9, & IP" data-original-title="BE Score" class="definition">BE Score</a>
							<a href="#" rel="popover" data-content="The number of innings a pitcher has completed, measured by the number of batters and baserunners that are put out while the pitcher on the pitching mound in a game." data-original-title="Innings Pitched" class="definition">IP</a>
							<a href="#" rel="popover" data-content="The winning pitcher is defined as the pitcher who last pitched prior to the half-inning when the winning team took the lead for the last time." data-original-title="Wins" class="definition">Wins</a>
							<a href="#" rel="popover" data-content="The losing pitcher is the pitcher who allows the go-ahead run to reach base for a lead that the winning team never relinquishes." data-original-title="Losees" class="definition">Losses</a>
							<a href="#" rel="popover" data-content="Awarded to a pitcher who successfully maintains the lead until the end of the game. Usually these conditions apply: [1]: He is the finishing pitcher in a game won by his team, [2]: He is not the winning pitcher, and [3]: He is crddited with at least 1/3 of an inning pitched. " data-original-title="Saves" class="definition">Saves</a>
							<a href="#" rel="popover" data-content="The number of strikeouts the pitcher has thrown." data-original-title="Strikeouts" class="definition">SO</a>
							<a href="#" rel="popover" data-content="The number of hits the pitcher has allowed." data-original-title="Hits Allowed" class="definition">Hits</a>
							<a href="#" rel="popover" data-content="The number of runs the pitcher has allowed." data-original-title="Runs Allowed" class="definition">Runs</a>
							<a href="#" rel="popover" data-content="The number of home runs the pitcher has allowed." data-original-title="Home Runs Allowed" class="definition">Home Runs</a>
							<a href="#" rel="popover" data-content="An earned run is any run for which the pitcher is held accountable (i.e., the run scored as a result of normal pitching, and not due to a fielding error or a passed ball)." data-original-title="Earned Runs" class="definition">ER</a>
							<a href="#" rel="popover" data-content="The mean of earned runs given up by a pitcher per nine innings pitched. Fomula: ERA = 9*(Earned Runs/Innings Pitched)" data-original-title="Earned Run Average" class="definition">ERA</a>
						</li>
            <li class="divider"></li>
            <li>
							<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The number of walks the pitcher has allowed. This measure includes intentional walks." data-original-title="Base on Balls Allowed" class="definition pro-stat">BB</a>
							<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A sabermetric measurement of the number of baserunners a pitcher has allowed per inning pitched. It is a measure of a pitcher's ability to prevent batters from reaching base." data-original-title="Walks plus hits per inning pitcher" class="definition pro-stat">WHIP</a>
							<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The total number of games in which a player has participated." data-original-title="Games Played" class="definition pro-stat">GP</a>
              <span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="Games started indicates the number of games that a pitcher has started for his team." data-original-title="Games Started" class="definition pro-stat">GS</a>
							<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The act of a pitcher pitching an entire game without the benefit of a relief pitcher." data-original-title="Complete Game" class="definition pro-stat">CG</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A hold is awarded to a relief pitcher who meets the following three conditions: [1]: Enters the game in a save situation, [2]: Records at least one out, and [3]: Leaves the game before it has ended without his team having relinquished the lead at any point and does not record a save." data-original-title="Hold" class="definition pro-stat">HLD</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="When a pitcher [1] enters the game with a lead of three or fewer runs and pitches at least one inning, [2] enters the game with the potential tying run on base, at bat, or on deck, or [3] pitches three or more innings with a lead and is credited with a save by the official scorer." data-original-title="Save Opportunities" class="definition pro-stat">SVO</a>
							<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A relief pitcher is credited with a game finished if he is the last pitcher to pitch for his team in a game. A starting pitcher is not credited with a game finished for pitching a complete game." data-original-title="Games Finished" class="definition pro-stat">GF</a>
						  <span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A shutout refers to the act by which a single pitcher pitches a complete game and does not allow the opposing team to score a run." data-original-title="Shutout" class="definition pro-stat">SHO</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A quality start is a statistic for a starting pitcher defined as a game in which the pitcher completes at least six innings and permits no more than three earned runs." data-original-title="Quality Start" class="definition pro-stat">QS</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The number of batters who made a plate appearance before the pitcher in a game or in a season." data-original-title="Total Batters Faced" class="definition pro-stat">TBF</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="Any number of illegal actions or motions that a pitcher may not commit constitute as a balk." data-original-title="Balk" class="definition pro-stat">BK</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A wild pitch is charged against a pitcher when his pitch is too high, too short, or too wide of home plate for the catcher to control with ordinary effort, thereby allowing a baserunner, perhaps even the batter-runner on strike three or ball four, to advance." data-original-title="Wild Pitch" class="definition pro-stat">WP</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The total number of pitches the pitcher has thrown." data-original-title="Total Pitches" class="definition pro-stat">TP</a>
							<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The total number of singles allowed by the pitcher." data-original-title="Singles Allowed" class="definition pro-stat">SA</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The total number of doubles allowed by the pitcher." data-original-title="Doubles Allowed" class="definition pro-stat">DA</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The total number of triples allowed by the pitcher." data-original-title="Triples Allowed" class="definition pro-stat">TA</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The number of innings pitched divided by the number of games started by the pitcher." data-original-title="Innings per Start" class="definition pro-stat">I/S</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A measure of how frequently a pitcher gets batters out on ground balls versus fly balls. Formula: (Ground Outs) / (Fly Outs)." data-original-title="Ground ball fly ball ratio" class="definition pro-stat">G/F</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A measure of hits, walks, and hit batsmen allowed per nine innings." data-original-title="Men on Base per 9 Innings" class="definition pro-stat">MB9</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A measure of the effectiveness of a relief pitcher who enters a game with runners on base." data-original-title="Inherited runs allowed to score" class="definition pro-stat">IRS</a>
							<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The percentage of the time a pitcher is awarded a win as opposed to a loss. Formula: Win % = Wins/(Wins + Losses)" data-original-title="Winning Percentage" class="definition pro-stat">Win %</a>
							<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="The number of innings pitched divided by the number strikeouts thrown." data-original-title="Strikeout Rate" class="definition pro-stat">SO Rate</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A statistic that measures a pitcher's ability to prevent hits during official at bats. Formula: BAA = Hits Allowed/(Batters Faced - Walks - Hit Batsmen - Sacrifice Hits - Sacrifice Flies)" data-original-title="Batting Average Against" class="definition pro-stat">BAA</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="A measure of a pitcher's ability to control pitches." data-original-title="Strikeout-to-walk ratio" class="definition pro-stat">SO/BB</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="Measures a pitcher's effectiveness based only on plays that do not involve fielders. Formula: FIP = ((13*Home Runs + 3*Walks - 2*Strikeouts)/(Innings Pitched))+3.1" data-original-title="Fielding Independed Pitching" class="definition pro-stat">FIP</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="measure devised to quantify how many runs a pitcher saves for his team relative to a league average pitcher. Formula: PR = (League ERA - ERA)*((Innings Pitched/9))" data-original-title="Pitcher Runs" class="definition pro-stat">PR</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="Intended to separate pitches who rely on their defense from those who don't. Formula: P/F Ration = (Strikeouts + Walks)/Innings Pitched." data-original-title="Power/Finesse Ratio" class="definition pro-stat">P/F Ratio</a>
						 	<span>Pro</span><a href="#goPro" data-toggle="modal" rel="popover" data-content="CERA attempts to forecast a pitcher's earned run average from the number of hits and walks allowed rather than the standard formula of average number of earned runs per nine innings." data-original-title="Component ERA" class="definition pro-stat">CERA</a>
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
		</div><!-- end row-fluid -->
	</div><!-- end well -->

	<!-- Begin container-fluid -->
	<div class="container-fluid">
		<div id="graph"></div>
	</div>

	<div class="container-fluid gray" style="border-top:1px solid #EEE;margin:auto;">
		<a href="#goPro" data-toggle="modal" style="float:left;padding:10px;">Baseball Engine Pro</a>
		<span style="float:right;padding:10px;">&copy; <a href="/" target="_blank"></a>2012 Baseball Engine | <a href="#contact" data-toggle="modal">Contact Me</a> | Last updated: <? echo date(' M j, y'); ?></span>
	</div>

	<!-- Begin goPro -->
	<div id="goPro" class="modal hide fade in">
		<div class="modal-header"><!-- Begin modal-header -->
			<a class="close" data-dismiss="modal">x</a>
			<h3>You're Ready to Go Pro!</h3>
		</div><!-- end modal-header -->
		<div class="modal-body"><!-- Begin modal-body -->
			<p class="well" style="font-size:16px;">
				For $10.00 you can gain access to over 60 advanced statistics and sabermetrics for the entire 2012 MLB season 
			</p>
			<form class="form-vertical" id="payment-form" method="post" action="https://baseballengine.com/stripe/charge.php"><!-- Begin form -->
				<div class="well"><!-- Begin well -->
					<label>E-mail Address</label>
					<input type="text" name="email" class="required" autofocus/>
					<label>Password</label>
					<input type="password" name="passwordPro" class="required" />
					<label>Card Number</label>
					<input maxlength="20" autocomplete="off" class="card-number stripe-sensitive required" type="text" id="credit-card"/>
					<div class="row"><!-- Begin row -->
						<div class="span2"><!-- Begin span2 -->
							<label>Expiration</label>
							<div class="expiry-wrapper">
								<select class="card-expiry-month stripe-sensitive required"></select>
								<span> / </span>
								<select class="card-expiry-year strip-sensitive required"></select>
							</div>
						</div><!-- End span2 -->
						<div class="span3"><!-- Begin span3 -->
							<label>CVC</label>
							<input type="text" maxlength="4" autocomplete="off" class="card-cvc stripe-sensitive required" />
						</div><!-- End span3 --> 
					</div><!-- end row -->
					<div class="row">
						<span class="span5">The Baseball Engine will never share or sell your personal information.</span>
					</div><!-- end row -->
				</div><!-- end well -->
				<span class="payment-errors"></span>
			</div><!-- end modal-body -->
			<div class="modal-footer"><!-- Begin modal-footer -->
				<span id="siteseal" style="float:left;"><script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=UGOhB3pNNiWUNmyNPrQHoehzchqvnq9VLLwlhfYkj9yWaUUjkorY"></script></span>
				<button type="submit" name="submit-button" class="btn btn-primary"><i class="icon-shopping-cart icon-white"></i> Charge Me $10.00</button>
				<img src="/images/ajax-loader.gif" name="processing">
			</form><!-- End form -->
		</div><!-- End modal-footer -->
	</div><!-- end goPro -->

	<div class="modal hide fade in" id="contact">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">x</a>
			<a href="/"><h3>The Baseball Engine</h3></a>
		</div>
		<div class="modal-body">
			<div class="well">
				<label>Your e-mail address</label>
				<input type="text" name="emailContact" autofocus>
				<label>Subject</label>
				<input type="text" name="subject">
				<label>Write your message below</label>
				<textarea rows="7" name="message"></textarea>
			</div>
			<div class="alert alert-success" style="display:none;">
				<span style='font-size:14px;'>Thanks for getting in touch! I'll respond within the next 24-48 hours. Thank you for using The Baseball Engine.</span>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-inverse">Contact me</button>
			<button class="btn btn-inverse" data-dismiss="modal" name="closeContact" style="display:none;">Close</button>
			<img src="/images/ajax-loader.gif" name="processing">
		</div>
	</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.8.1/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v1/"></script>
<script type="text/javascript" src="stripe/stripe.js"></script>
<script type="text/javascript" src="/js/default.js"></script>
<script type="text/javascript" src="drawgraph.js"></script>
<script type="text/javascript" src="/contact/js/script.js"></script>
</body>
</html>
