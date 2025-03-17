<?php
session_start();
include 'db.php';

 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UrinoBot AI</title>
    <link rel="stylesheet" href="style.css"> 
        
<style>
    body {
  	font-family: 'Inter', sans-serif;
  	color: #666666;
	background-color: #f7fafc;
	font-size: 16px;
	padding-bottom: 5rem;
}
canvas {
	width: 100% !important;
	height: 100% !important;
}
.headline {
	font-size: 1.25rem;
	font-weight: 600;
}

.text--small {
	font-size: 0.875rem;
}

a {
	color: #606FC7;
	font-weight: 600;
}

a:hover {
	color: #434190;
}

i {
	position: absolute;
	padding: 0.75rem;
	color: #606FC7;
}

span.icon {
	position: absolute;
	padding: 0.5rem;
	right: 0;
}

.header {
	background-color: white;
	padding: 1rem;
	padding-bottom: 2.5rem;
}

.header__grid {
	display: grid;
	grid-template-columns: repeat(1, minmax(0, 1fr));
	grid-template-rows: repeat(4, minmax(0, 1fr));
	gap: 1.5rem;
	max-width: 56rem;
}

.header__logo {
	height: 4rem;
}

.header__label {
	text-transform: uppercase;
	display: block;
	margin-bottom: 0.5rem;
	font-size: 0.875rem;
	font-weight: 600;
	color: #718096;
}

.content {
	padding: 1rem;
	width: 100%;
}

.content__grid {
	display: grid;
	grid-template-columns: repeat(12, minmax(0, 1fr));
	grid-template-rows: repeat(3, minmax(0, 1fr));
	max-width: 56rem;
	column-gap: 1rem;
	row-gap: 2.5rem;
	padding-top: 1rem;
	padding-bottom: 1rem;
}

#imageOptions.content__grid {
    grid-template-rows: repeat(2, minmax(0, 0.5fr));
}

.flex {
	display: flex;
}

.flex-1 {
	flex: 1 1 0%;
}

.relative {
	position: relative;
}

.col-6-m3 {
	grid-column: span 6 / span 6;
}

.col-12-s6-m4, .col-12-m6, .col-12-m8, .col-12 {
	grid-column: span 12 / span 12;
}

.result {
	max-width: 56rem;
}

.result__header {
	display: flex;
	justify-content: space-between;
	margin-bottom: 1rem;
}

.divider {
	border-width: 1px;
	border-color: #cbd5e0;
	margin-top: 2.5rem;
	margin-bottom: 2.5rem;
	height: 0;
}

input:disabled {
	background-color: white;
}

.input {
	border-width: 1px;
	border-color: #cbd5e0;
	border-radius: 0.25rem;
	height: 2.5rem;
	width: 100%;
	padding-left: 0.5rem;
	padding-right: 0.5rem;
}

.input--left {
	border-top-right-radius: 0;
	border-bottom-right-radius: 0;
	margin-right: -1rem;
}

.input__icon {
	padding-left: 2.5rem;
	padding-right: 2.5rem;
}

.input__label {
	margin-bottom: 0.5rem;
	display: block;
}

.bttn {
	padding-top: 0.5rem;
	padding-bottom: 0.5rem;
	padding-left: 0.75rem;
	padding-right: 0.75rem;
	background-color: white;
	border-width: 1px;
	border-color: #cbd5e0;
	margin-right: -0.5rem;
	height: 2.5rem;
}

.bttn.fill {
	width: 50%;
}

.bttn:focus {
	outline: 1px dotted;
}

.bttn:hover {
	background-color: #edf2f7;
}

.left {
	border-top-left-radius: 0.25rem;
	border-bottom-left-radius: 0.25rem;
}

.right {
	border-top-right-radius: 0.25rem;
	border-bottom-right-radius: 0.25rem;
	margin-right: 0;
}

.bttn.active {
	background-color: #606FC7;
	color: white;
	border-width: 1px;
	border-color: #606FC7;
}

.bttn__primary {
	background-color: #606FC7;
	color: white;
	border-width: 1px;
	border-color: #606FC7;
	border-radius: 0.25rem;
	font-size: 1.125rem;
	padding-left: 1.25rem;
	padding-right: 1.25rem;
	padding-top: 0.75rem;
	padding-bottom: 0.75rem;
}

.bttn.active:hover, .bttn__primary:hover {
	background-color: #4c51bf;
}

.codeblock {
	border-width: 1px;
	border-color: #cbd5e0;
	border-radius: 0.25rem;
	display: block;
	padding: 0.75rem;
	background-color: white;
}

#urlContainer {
	display: none;
}

/* small breakpoint */
@media (min-width: 640px) {
	.header {
		padding: 2.5rem;
	}
	.header__grid {
		grid-template-columns: repeat(2, minmax(0, 1fr));
		grid-template-rows: repeat(2, minmax(0, 1fr));
	}
	.header__logo {
		grid-column: span 2 / span 2;
	}
	.content {
		padding: 2.5rem;
	}
	.content__grid {
		column-gap: 1rem;
		row-gap: 2.5rem;
	}
	.col-12-s6-m4 {
		grid-column: span 6 / span 6;
	}
}

/* medium breakpoint */
@media (min-width: 768px) {
	.header__grid {
		grid-template-columns: repeat(4, minmax(0, 1fr));
		grid-template-rows: repeat(1, minmax(0, 1fr));
	}
	.header__logo {
		grid-column: span 1 / span 1;
	}
	.col-6-m3 {
		grid-column: span 3 / span 3;
	}
	.col-12-s6-m4 {
		grid-column: span 4 / span 4;
	}
	.col-12-m6 {
		grid-column: span 6 / span 6;
	}
	.col-12-m8 {
		grid-column: span 8 / span 8;
	}
	.bttn {
		padding-left: 1rem;
		padding-right: 1rem;
	}
}

#resultContainer {
	display: none;
}



        body {
            font-family: Arial, sans-serif;
            background: #E6F7F7;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .title {
            font-size: 50px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .title span {
            color: #E74C3C;
        }
        .main-container {
            width: 70%;
            max-width: 800px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            padding: 50px;
            text-align: center;
        }
        .content {
            font-size: 20px;
            margin-bottom: 30px;
        }
        .check-list {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
        }
        .check-list p {
            display: flex;
            align-items: center;
            font-size: 18px;
        }
        .check-list img {
            width: 25px;
            height: 25px;
            margin-right: 10px;
        }
        .upload-btn {
            background: #58B6C0;
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
    <head>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
</head>

<body>
    <h1 class="title">Urino<span>Bot</span>.AI</h1>
    <div class="main-container">
        <h2>Urine Microscopic Interpretation</h2>
        <p class="content">Turn urine microscopics into actionable insights.</p>
		<pre id="output"  >  </pre>

        <form id="inputForm">
            <input type="text" id="fileName" readonly  required>
			<button type="button" id="fileMock">Browse</button>
            <button type="submit" value="Run Inference"  class="upload-btn">Upload Microscope Image</button>
          
	<?php require 'urininclude.php'; ?>
		
		<div class="col-12" hidden>
			<button type="submit" value="Run Inference" class="bttn__primary">Run Inference</button>
		</div>

	</form>
    </div>
 
 
</body>




<body>

</body>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(function() {
		retrieveDefaultValuesFromLocalStorage();
		setupButtonListeners();
	});

	var infer = function() {
		$('#output').html("Inferring...");
		$("#resultContainer").show();
		$('html').scrollTop(100000);

		getSettingsFromForm(function(settings) {
			settings.error = function(xhr) {
				$('#output').html("").append([
					"Error loading response.",
					"",
					"Check your API key, model, version,",
					"and other parameters",
					"then try again."
				].join("\n"));
			};

			$.ajax(settings).then(function(response) {
				var pretty = $('<pre>');
				var formatted = JSON.stringify(response, null, 4)

				pretty.html(formatted);
				$('#output').html("").append(pretty);
				$('html').scrollTop(100000);

				// Draw squares on the image
				drawInferenceResults(response);
			});
		});
	};

	var drawInferenceResults = function(response) {
		var img = new Image();
		img.src = $('#file').get(0).files[0] ? URL.createObjectURL($('#file').get(0).files[0]) : $('#url').val();
		img.onload = function() {
			var canvas = document.createElement('canvas');
			canvas.width = img.width;
			canvas.height = img.height;
			var ctx = canvas.getContext('2d');
			ctx.drawImage(img, 0, 0);

			response.predictions.forEach(function(prediction) {
				ctx.strokeStyle = 'rgba(255, 0, 0, 0.7)'; // Set opacity to 0.7
				ctx.lineWidth = 2;
				ctx.strokeRect(prediction.x - prediction.width / 2, prediction.y - prediction.height / 2, prediction.width, prediction.height);
				ctx.fillStyle = 'rgba(255, 0, 0, 0.7)'; // Set opacity to 0.7
				ctx.font = '13px Arial'; // Increase font size
				ctx.fillText(prediction.class, prediction.x - prediction.width / 2, prediction.y - prediction.height / 2 - 5);
			});

			$('#output').html("").append(canvas);
		};
	};

	var retrieveDefaultValuesFromLocalStorage = function() {
		try {
			var api_key = localStorage.getItem("rf.api_key");
			var model = localStorage.getItem("rf.model");
			var format = localStorage.getItem("rf.format");

			if (api_key) $('#api_key').val(api_key);
			if (model) $('#model').val(model);
			if (format) $('#format').val(format);
		} catch (e) {
			// localStorage disabled
		}

		$('#model').change(function() {
			localStorage.setItem('rf.model', $(this).val());
		});

		$('#api_key').change(function() {
			localStorage.setItem('rf.api_key', $(this).val());
		});

		$('#format').change(function() {
			localStorage.setItem('rf.format', $(this).val());
		});
	};

	var setupButtonListeners = function() {
		// run inference when the form is submitted
		$('#inputForm').submit(function() {
			infer();
			return false;
		});

		// make the buttons blue when clicked
		// and show the proper "Select file" or "Enter url" state
		$('.bttn').click(function() {
			$(this).parent().find('.bttn').removeClass('active');
			$(this).addClass('active');

			if($('#computerButton').hasClass('active')) {
				$('#fileSelectionContainer').show();
				$('#urlContainer').hide();
			} else {
				$('#fileSelectionContainer').hide();
				$('#urlContainer').show();
			}

			return false;
		});

		// wire styled button to hidden file input
		$('#fileMock').click(function() {
			$('#file').click();
		});

		// grab the filename when a file is selected
		$("#file").change(function() {
			var path = $(this).val().replace(/\\/g, "/");
			var parts = path.split("/");
			var filename = parts.pop();
			$('#fileName').val(filename);
		});
	};

	var getSettingsFromForm = function(cb) {
		var settings = {
			method: "POST",
		};

		var parts = [
			"https://detect.roboflow.com/",
			$('#model').val(),
			"/",
			$('#version').val(),
			"?api_key=" + $('#api_key').val()
		];

		var classes = $('#classes').val();
		if(classes) parts.push("&classes=" + classes);

		var confidence = 1;
		if(confidence) parts.push("&confidence=" + confidence);

		var overlap = $('#overlap').val();
		if(overlap) parts.push("&overlap=" + overlap);

		parts.push("&format=json");
		settings.format = "json";

		var method = $('#method .active').attr('data-value');
		if(method == "upload") {
			var file = $('#file').get(0).files && $('#file').get(0).files.item(0);
			if(!file) return alert("Please select a file.");

			getBase64fromFile(file).then(function(base64image) {
				settings.url = parts.join("");
				settings.data = base64image;

				console.log(settings);
				cb(settings);
			});
		} else {
			var url = $('#url').val();
			if(!url) return alert("Please enter an image URL");

			parts.push("&image=" + encodeURIComponent(url));

			settings.url = parts.join("");
			console.log(settings);
			cb(settings);
		}
	};

	var getBase64fromFile = function(file) {
		return new Promise(function(resolve, reject) {
			var reader = new FileReader();
			reader.readAsDataURL(file);
			reader.onload = function() {
				resolve(reader.result);
			};
			reader.onerror = function(error) {
				reject(error);
			};
		});
	};

	var resizeImage = function(base64Str) {
		return new Promise(function(resolve, reject) {
			var img = new Image();
			img.src = base64Str;
			img.onload = function(){
				var canvas = document.createElement("canvas");
				var MAX_WIDTH = 1500;
				var MAX_HEIGHT = 1500;
				var width = img.width;
				var height = img.height;
				if (width > height) {
					if (width > MAX_WIDTH) {
						height *= MAX_WIDTH / width;
						width = MAX_WIDTH;
					}
				} else {
					if (height > MAX_HEIGHT) {
						width *= MAX_HEIGHT / height;
						height = MAX_HEIGHT;
					}
				}
				canvas.width = width;
				canvas.height = height;
				var ctx = canvas.getContext('2d');
				ctx.drawImage(img, 0, 0, width, height);
				resolve(canvas.toDataURL('image/jpeg', 1.0));  
			};
		
		});    
	};
</script>

<span>


</span>
<H2>Or</H2>
<p>
<h1><a href="https://9000-idx-urinobot-1741709498331.cluster-a3grjzek65cxex762e4mwrzl46.cloudworkstations.dev/?embedded=0&monospaceUid=441182" style="text-decoration: none; color: inherit;">Scan the Microscopics</a></h1>
</p>
</html>
