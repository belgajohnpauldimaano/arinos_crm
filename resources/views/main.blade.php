<!DOCtype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CRM</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="robots" content="index, follow">

	<link type="text/css" rel="stylesheet" href="css/normalize.css">
	<link type="text/css" rel="stylesheet" href="css/style.css">

	<!-- Your JS files here -->
	<script src="js/jquery-3.1.1.min.js"></script>

	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<![endif]-->
	
</head>
<body id="top">
<div class="container">
	<div id="masthead" class="site-header">
		<h1>メイン画面</h1>
	</div> <!-- .site-header -->
	
	<div class="site-main" role="main">

		<div class="main-screen">
			<a href="{{ route('customer_search') }}" class="btn-blue">顧客検索</a>
			<a href="{{ route('file_capture') }}" class="btn-blue">ファイル取込</a>
		</div>

	</div> <!-- .site-main -->
	
</div> <!-- .container -->

<div id="colophon" class="site-footer" role="contentinfo">

</div> <!-- .site-footer -->

</body>
</html>