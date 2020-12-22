<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>投稿の詳細</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
	<div>
		<h1 class="bg-success"><a href="/">Laravel Sample Blog</a></h1>
	</div>
	<font size="6">{{$posts->title}}</font><br>
	<font size="2">{{$posts->content}}</font><br>
	<a href="/"class="btn btn-warning btn btn-xs">戻る</a>
</body>
</html>