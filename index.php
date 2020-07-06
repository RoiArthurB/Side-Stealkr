<!DOCTYPE html><html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Stealkr" />
	<title>Stealkr - RoiArthurB</title>
	<link href="css/style.css" rel="stylesheet">

	<link rel="apple-touch-icon" sizes="194x194" href="img/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="img/apple-touch-icon.png" sizes="194x194">
</head>
<body onload="search()">
	<header>
		<!-- <div class="logo"></div> -->
		<h1 style="font-weight: bolder; font-size: 500%">Stealkr</h1>
	</header>
	<section class="searchbar">
		<h3>Search</h3>

		<form method="GET" action="?">
			<input type="hidden" name="action" value="download" />

			<input required type="text" name="searchfield" id="searchfield" placeholder="Insert Flickr URL">
		</form>
		<p class="maintainer"><a href="https://github.com/RoiArthurB">RoiArthurB</a></p>
	</section>

	<?php if ($_GET["action"]) { // If request

	$curlOptions = array(
	    CURLOPT_RETURNTRANSFER => TRUE,
	    CURLOPT_FOLLOWLOCATION => TRUE,
	    CURLOPT_VERBOSE => FALSE,
	    CURLOPT_STDERR => $verbose = fopen('php://temp', 'rw+'),
	    CURLOPT_FILETIME => TRUE,
	);

	// Get max size img
	$url = explode("in", $_GET['searchfield'])[0]."/sizes/k/";

	$handle = curl_init($url);
	curl_setopt_array($handle, $curlOptions);
	$content = curl_exec($handle);
	curl_close($handle);

	// Could be cleaner, but I did it in 1 hour..
	// Feel free to PR a nicer way ;)
	$img = explode(">", explode("src=", explode("faq-link", explode("allsizes-photo", $content)[1])[0])[1])[0];


	?>
	
	<section class="searchbar">
		<img src=<?php echo $img; ?> style="width: 100%"/>
		
		<form method="get" action=<?php echo $img; ?> >
		   <button type="submit">Download!</button>
		</form>

	</section>
 	
 	<?php } ?>

	<section class="footer">
		<p class="version">v 2.0</p>
		<a href="https://github.com/RoiArthurB/Side-Stealkr">Stealkr ~ GPL3</a><br>
	</section>
</body>
</html>