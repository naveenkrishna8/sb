<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>404 Error</title>
	<style>
		@keyframes move-twink-back {
  from {
    background-position: 0 0;
  }
  to {
    background-position: -10000px 5000px;
  }
}

@-webkit-keyframes move-twink-back {
  from {
    background-position: 0 0;
  }
  to {
    background-position: -10000px 5000px;
  }
}

@-moz-keyframes move-twink-back {
  from {
    background-position: 0 0;
  }
  to {
    background-position: -10000px 5000px;
  }
}

@-ms-keyframes move-twink-back {
  from {
    background-position: 0 0;
  }
  to {
    background-position: -10000px 5000px;
  }
}

@keyframes move-clouds-back {
  from {
    background-position: 0 0;
  }
  to {
    background-position: 10000px 0;
  }
}

@-webkit-keyframes move-clouds-back {
  from {
    background-position: 0 0;
  }
  to {
    background-position: 10000px 0;
  }
}

@-moz-keyframes move-clouds-back {
  from {
    background-position: 0 0;
  }
  to {
    background-position: 10000px 0;
  }
}

@-ms-keyframes move-clouds-back {
  from {
    background-position: 0;
  }
  to {
    background-position: 10000px 0;
  }
}

.stars,
.twinkling,
.clouds {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  height: 100%;
  display: block;
}

.stars {
  background: #000 url(<?php echo get_stylesheet_directory_uri(); ?>/error-images/stars.png) repeat top center;
  z-index: 0;
}

.twinkling {
  background: transparent url(<?php echo get_stylesheet_directory_uri(); ?>/error-images/twinkling.png) repeat top center;
  z-index: 1;
  -moz-animation: move-twink-back 200s linear infinite;
  -ms-animation: move-twink-back 200s linear infinite;
  -o-animation: move-twink-back 200s linear infinite;
  -webkit-animation: move-twink-back 200s linear infinite;
  animation: move-twink-back 200s linear infinite;
}

.clouds {
  background: transparent url(<?php echo get_stylesheet_directory_uri(); ?>/error-images/clouds.png) repeat top center;
  z-index: 3;
  -moz-animation: move-clouds-back 200s linear infinite;
  -ms-animation: move-clouds-back 200s linear infinite;
  -o-animation: move-clouds-back 200s linear infinite;
  -webkit-animation: move-clouds-back 200s linear infinite;
  animation: move-clouds-back 200s linear infinite;
}

.error-info {
    position: absolute;
    z-index: 9;
    color: #fff;
    text-align: center;
    font-family: monospace;
    font-size: 14px;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
}
.error-info img{
	max-width: 100%;
}
.error-info h1 {
    font-size: 60px;
    margin: auto;
}
.error-info p{
	font-size: 16px;
}

.home-btn{
	display: inline-block;
	color: #fff;
	padding: 5px 20px;
	font-size: 18px;
	border-radius: 20px;
	text-decoration: none;
	border: solid 1px #fff;
}

</style>
</head>
<body>
<div class="stars">
</div>
<div class="twinkling"></div>
<div class="clouds"></div>
<div class="error-info">
	<img src="<?php echo get_stylesheet_directory_uri(); ?>/error-images/rocket.png" alt="">
	<h1>404</h1>
	<p>Looks like you are lost in space!</p>
	<a class="home-btn" href="<?php echo home_url(); ?>">Go Home</a>
</div>
</body>
</html>