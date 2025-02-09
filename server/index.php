<?php require_once('configuration.php'); ?>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="zBis.fr">
<link rel="shortcut icon" href="">

<title>TweeterTree</title>

<!-- Bootstrap core CSS -->
<link href="assets/css/bootstrap.css" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="assets/css/style.css" rel="stylesheet">

<!-- Just for debugging purposes. Don't actually copy this line! -->
<!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<style type="text/css"></style>
<script type="text/javascript">
	$(function () {
	    $('#container').highcharts({
	        title: {
	            text: 'Number of Hashtag by minutes',
	            x: -20 //center
	        },
	        xAxis: {
	        	<?php echo getDays(); ?>
	        },
	        yAxis: {
	            title: {
	                text: 'number of Hashtag'
	            },
	            plotLines: [{
	                value: 0,
	                width: 1,
	                color: '#808080'
	            }]
	        },
	        legend: {
	            layout: 'vertical',
	            align: 'right',
	            verticalAlign: 'middle',
	            borderWidth: 0
	        },
	        series: [{
	            name: '<?php echo getHashtag(); ?>',
	            data: <?php echo dataHashtag(); ?>,
	        }]
	    });
	});
</script>
</head>

<body style="">

<!-- Wrap all page content here -->
<div id="wrap">
  	<!-- Fixed navbar -->
  	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">TweeterTree</span>
			</button>
			<a class="navbar-brand" href="/tweeterTree">TweeterTree</a>
		</div>
		<div class="collapse navbar-collapse">
			<ul id="navigation" class="nav navbar-nav">
				<li><a href="#configuration">Configuration</a></li>
				<li><a href="#statistics">Statistics</a></li>
				<li><a href="#faq">FAQ</a></li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
  </div>

  <!-- Begin page content -->
  <div class="container">
	<div class="jumbotron">
        <h1><span class="glyphicon glyphicon-tree-deciduous"></span>TweeterTree</h1>
        <p>Application to manage the tweeterTree</p>
  	</div>
  		<section id="configuration">
	        <div class="page-header">
	          <h2 > <span class="glyphicon glyphicon-wrench"></span> Configuration</h2>
	        </div>
			<div class="row">
			  <div class="col-md-6 col-md-offset-3">
				<form id="hashtagForm" role="form" action="configuration.php", method="POST">
					<fieldset>
						<h3 class="form-signin-heading">Hashtag</h3>
						<div class="form-group">
							<label for="hashtag" class="col-sm-12 control-label" >Hashtag followed</label>
							<div class="col-sm-12">
								<input type="text" id="hashtagInput" class="form-control" placeholder="Current Hashtag : <?php echo getHashtag(); ?>" id="hashtag" name="hashtag">
							</div>
							<p class="help-block">  Select the hashtag you want to follow</p>
						</div>
					</fieldset>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Save</button>
				</form>
			  </div>
			</div>
			<hr>
		</section>
		<section id="statistics">
			<div class="jumbotron">
		        <h2 id="statistics"> <span class="glyphicon glyphicon-stats"></span> Statistics</h2>
				<!-- <p>Sirloin jerky salami pancetta brisket ham hock. Beef ribs swine boudin meatball alcatra beef pork loin doner tongue venison biltong capicola rump. Pastrami landjaeger brisket pork pork belly. Tenderloin capicola sausage alcatra drumstick shoulder landjaeger t-bone shank brisket. Shank meatball kielbasa venison picanha drumstick beef landjaeger pastrami rump jerky ball tip. Ham capicola pastrami, sirloin pig pork loin meatloaf venison short loin t-bone tri-tip.</p> -->
				<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	      	</div>
		</section>
		<section>
			<div class="jumbotron">
		        <h2 id="faq"> <span class="glyphicon glyphicon-question-sign"></span> FAQ</h2>
		        <h3>How to change the twitter keys?</h3>
				<p>To change keys, edit the informations.php file and reload the page</p>
	      	</div>
		</section>
  </div>
</div>

<div id="footer">
  <div class="container">
    <p class="text-muted">TweeterTree - A project supported by zBis and Faclab</p>
  </div>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/highcharts.js"></script>

<script>
	    $(document).ready(function(){
	    	$('form').submit(function(){
	    		var form = $('#hashtagForm');
	    		var datas = $('#hashtagForm').serialize();

				$.ajax({
	                url: "configuration.php",
	                type: "POST",
	                data: datas,
	                dataType : 'text',
	                success: function( response ) {
	                	displayNotifications(form, response.notifications);
	                	refreshParts(form, response.notifications);
	                }
            	});
	    		return false;
	    	});
	    	function displayNotifications(form, response)
	    	{
	    		
	    		$('.alert').remove();
				form.after('<div class="alert alert-success" role="alert">Suceed ! </div>');
				$('.alert').fadeOut(1500);
	    	}
	    	function refreshParts(form, response)
	    	{
	    		$('#hashtagForm input').val("");
	    		$("#hashtagForm input").attr("placeholder", "");
	    	}
	    });
</script>

</body>
</html>
