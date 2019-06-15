
<!DOCTYPE html>
<html lang="en" dir="ltr" xmlns:fb="http://ogp.me/ns/fb#">
<head>
<style>
.demo-frame header, .demo-frame h1, .demo-frame .demo-conversion {
	display: none;
}

.demo-wrapper {
	min-height: 500px;
}

.bsap {
	position: absolute;
	top: 0;
	right: 0;
}
</style>
	<style>
		video { border: 1px solid #ccc; display: block; margin: 0 0 20px 0; }
		#canvas { margin-top: 20px; border: 1px solid #ccc; display: block; }
	</style>
</head>
<body>

<script>
window.ORIGINAL_JSON=window.JSON;
</script>



	<!-- <p>Using Opera Next or Chrome Canary, use this page to take your picture!</p> -->
	<a href="custom_test.php">Back</a>
	<video id="video" width="640" height="480" autoplay></video>
	<button id="snap" class="sexyButton">Snap Photo</button>
	<button id="btn" onclick="getfiledata()" class="">GetFile</button>
	<canvas id="canvas" width="640" height="480"></canvas>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>

		// Put event listeners into place
		window.addEventListener("DOMContentLoaded", function() {
			// Grab elements, create settings, etc.
            var canvas = document.getElementById('canvas');
            var context = canvas.getContext('2d');
            var video = document.getElementById('video');
            var mediaConfig =  { video: true };
            var errBack = function(e) {
            	console.log('An error has occurred!', e)
            };

			// Put video listeners into place
            if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia(mediaConfig).then(function(stream) {
                    video.src = window.URL.createObjectURL(stream);
                    video.play();
                });
            }

            /* Legacy code below! */
            else if(navigator.getUserMedia) { // Standard
				navigator.getUserMedia(mediaConfig, function(stream) {
					video.src = stream;
					video.play();
				}, errBack);
			} else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
				navigator.webkitGetUserMedia(mediaConfig, function(stream){
					video.src = window.webkitURL.createObjectURL(stream);
					video.play();
				}, errBack);
			} else if(navigator.mozGetUserMedia) { // Mozilla-prefixed
				navigator.mozGetUserMedia(mediaConfig, function(stream){
					video.src = window.URL.createObjectURL(stream);
					video.play();
				}, errBack);
			}

			// Trigger photo take
			document.getElementById('snap').addEventListener('click', function() {
				context.drawImage(video, 0, 0, 640, 480);
			});
		}, false);

		
		
		// var canvas = document.getElementById('myCanvas');
   		//  var context = canvas.getContext('2d');


   
	</script>
	<script type="text/javascript">
		function getfiledata(){
			var canvas = document.getElementById('canvas');
		    var context = canvas.getContext('2d');
		    // begin custom shape
		    context.beginPath();
		    context.moveTo(170, 80);
		    // context.bezierCurveTo(130, 100, 130, 150, 230, 150);
		    // context.bezierCurveTo(250, 180, 320, 180, 340, 150);
		    // context.bezierCurveTo(420, 150, 420, 120, 390, 100);
		    // context.bezierCurveTo(430, 40, 370, 30, 340, 50);
		    // context.bezierCurveTo(320, 5, 250, 20, 250, 50);
		    // context.bezierCurveTo(200, 5, 150, 20, 170, 80);

		    // complete custom shape
		    // context.closePath();
		    // context.lineWidth = 5;
		    // context.fillStyle = '#8ED6FF';
		    // context.fill();
		    // context.strokeStyle = 'blue';
		    context.stroke();
			
			var dataURL = canvas.toDataURL();
			// alert(dataURL);
			$.ajax({
			  type: "POST",
			  url: "script.php",
			  data: { 
			     imgBase64: dataURL
			  },
			  success:function(res){
			  	console.log(res);
			  }
			});
		}
	</script>
</div>


</main>

	<style>


.carbon-img img {
display: block;
margin: 0 auto 1em;
}

.carbon-text {
display: block;
margin-bottom: .5em;
}

.carbon-poweredby {
display: block;
font-size: 16px;
}



	</style>
	<script>
	window.TEMP_JSON = window.JSON;
	window.JSON = window.ORIGINAL_JSON;
	</script>


<script>

document.body.className+= ' demo-page';

window.addEventListener('load', function() {
	var s = 'script';
	var d = document;
	var w = window;
	var firstScript = d.getElementsByTagName(s)[0];


	(function() {
		var first_paragraph = document.getElementsByTagName('p')[0];
		if(first_paragraph) {
			first_paragraph.className = 'demo-intro';
		}

		setTimeout(function() {
			var headerA = d.getElementById('header-fx');
			if(headerA) headerA.className += ' complete';
		}, 2000);
	})();


	// BSA bitches!
	var bsa = d.createElement(s);
	bsa.async = 1;
	bsa.src = '//s3.buysellads.com/ac/bsa.js';
	firstScript.parentNode.insertBefore(bsa, firstScript);

	

  [].slice.call(document.querySelectorAll('header img[data-src]')).forEach(function(el) {
    el.src = el.getAttribute('data-src');
  });
});

!function(e){var t=e.createElement("link"),s="setAttribute";t[s]("type","text/css"),t[s]("rel","stylesheet"),t[s]("href","//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css"),e.body.appendChild(t)}(z.d);!function(e){var t=e.documentElement,n="fonts-loaded";if(-1==t.className.indexOf(n)){var s=e.createElement("link"),a="setAttribute";s.onload=function(){t.className+=" "+n},s[a]("type","text/css"),s[a]("rel","stylesheet"),s[a]("href",z.themePath+"/fonts.css"),e.body.appendChild(s)}}(z.d);</script>
</body>
</html>
