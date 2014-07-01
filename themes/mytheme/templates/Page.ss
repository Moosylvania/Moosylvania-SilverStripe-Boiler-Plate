<!doctype html> <!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 oldie" lang="en"> <![endif]-->
<!--[if gt IE 9]><!-->
<html class="no-js" lang="en">
	<!--<![endif]-->
	<head>
		<% base_tag %>
		$MetaTags(true)
		<script src="$ThemeDir/javascript/modernizr.js"></script>
		<!--[if lte IE 7 ]>
		<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script>
		<script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script>
		<![endif]-->
	</head>
	<body>
		<% include Header %>
		<div id="main" role="main">
			$Layout
		</div>
		<% include Footer %>
		<% include SocialScriptInclude %>		
	</body>
</html>
