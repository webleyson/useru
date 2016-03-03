<head>
	<title>Welcome to Useryou</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!--<link rel="stylesheet" type="text/css" href="css/screen.css"> -->
	
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
	<link rel="stylesheet" type="text/css" href="css/linkPreview.css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 	<link rel="stylesheet" type="text/css" href="css/mystyles.css" />
	<script type="text/javascript" src="js/linkPreview.js" ></script>
	<script type="text/javascript" src="js/linkPreviewRetrieve.js" ></script>
	<script>
		$(document).ready(function() {
			$('#retrieveFromDatabase').linkPreviewRetrieve();
			$('#lp2').linkPreview({placeholder: "Share your work.."});
		});
	</script>
</head>