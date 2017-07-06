<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('SHAREDATA_VERSION', '1.0beta');
define('PLUGIN', 'vendor/');
define('NODE_MODULES', 'node_modules/');
define('BOOTSTRAP', 'vendor/twitter/bootstrap/dist');

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to Data Share Server</title>

	<link rel="stylesheet" href="<?php echo PLUGIN; ?>/enyo/dropzone/dist/min/basic.min.css">
	<link rel="stylesheet" href="<?php echo PLUGIN; ?>/enyo/dropzone/dist/dropzone.css">
	<link rel="stylesheet" href="<?php echo BOOTSTRAP; ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo BOOTSTRAP; ?>/css/bootstrap-theme.min.css">
	<!-- <link href="<?php echo BOOTSTRAP; ?>/../docs/examples/theme/theme.css" rel="stylesheet"> -->

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		/*margin: 40px;*/
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		/*border-bottom: 1px solid #D0D0D0;*/
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	/*#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}*/

	.dropzone {
		border:3px dashed #8686ff;
	}

	.dz-default.dz-message {
		height: 120px !important;
	}

	.dropzone.dz-preview.dz-image {
		border-radius: 5px !important;
	    overflow: hidden;
	    width: 120px;
	    height: 120px !important;
	    position: relative;
	    display: block;
	    z-index: 10;
		box-shadow: 1px 2px 5px #d0d0d0;
	}

	.nav-tabs {
      margin-bottom: 15px;
    }

	div.list-file div.list {
		display: inline-block;
		width: 200px;
	}

	.data-list > div > .list {
		cursor: pointer;
	}

	.chbx {
		visibility: hidden;
		display: none;
	}

	.box-selected {
		position: absolute;
		top: 0;
		left: 0;
		border: 1px solid #ddd;
		border-radius: 4px;
		width:100%;
		height:100%;
		opacity: 0.2;
		background: black;
		display: none;
		cursor: pointer;
	}

	.file-label {
		position: absolute;
		/*border: 1px solid #ddd;*/
		bottom:0px;
		right:0px;
		/*border-radius: 4px;*/
		width:auto;
		height:auto;
		padding:5px;
		opacity: 0.9;
		color: #FFF;
		background: black;
		/*display: none;*/
	}

	.remove-btn {
		/* border: 3px solid red; */
		border-radius: 50% 50% 50% 50%;
		color: red;
		position: absolute;
		top: 0px;
		font-size: 3em;
		right: 20px;
		padding:2px 7px;
		/* background: #FFF; */
		opacity: 0.9;
		cursor: pointer;
		display: none;
	}

	div.list {
		padding:40px;
		width:100%;
		height:100%;
		vertical-align: middle !important;
		text-align: center;
		border: 1px solid #ddd;
		display: inline-block;
		border-radius: 4px;
		font-weight: bold;
	}

	.data-list div{
		margin: auto auto !important;
		vertical-align: middle !important;
	}
	.choose-sign {
		position: absolute;
		top: 50%;
		left: 50%;
		font-size:5em;
		display: none;
		color: #0062ff;
	}

	</style>
</head>
<body>

<div class="container" id="container">
	<div class="row">
		<div class="col-sm-12 col-xs-12">
			<h1>Welcome Share-Data! - <?php echo $ip_addr; ?></h1>

			<div id="body">
				<form action="/upload" class="dropzone" id="my-awesome-dropzone" enctype="multipart/form-data">
					<div class="fallback">
						<input type="file" name="file" multiple/>
					</div>
				</form>
			</div>

			<p class="footer"></p>
			<!-- <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'Share-Data <strong>' . SHAREDATA_VERSION . ' by awaludin</strong>' : '' ?></p> -->
		</div>
	</div>
</div>

<div class="container" id="container">
	<div class="row">
		<div class="col-sm-12 col-xs-12">
			<h1>Shared Data <button class="btn btn-warning btn-xs refresh-data"><i class="glyphicon glyphicon-refresh"></i></button></h1>

			<div id="body">
				<div class="shared-data">
				<?php /*
					<!-- <pre>
						<?php print_r($data); ?>
					</pre> -->
					<?php
					$datafile = [];
					// $tab = array_keys($data);
					?>
					<ul id="myTab1" class="nav nav-tabs">
						<?php
						$ix = 0;
						foreach($data as $k => $tb){
							$active = ($ix == 1) ? 'active':''; ?>
				      		<li class="<?php echo $active;?>"><a href="#<?php echo $tb[0]['host']; ?>" data-toggle="tab"><?php echo ($k == '0') ? 'local' : $k; ?></a></li>
						<?php
							$ix++;
						} ?>
				    </ul>
				    <div id="myTabContent1" class="tab-content">
						<?php
						$ix = 0;
						foreach($data as $k => $tb) {
							$active = ($ix == 1) ? 'active':''; ?>
					      	<div class="tab-pane fade in <?php echo $active; ?>" id="<?php echo $tb[0]['host']; ?>">
								<div class="list-file">
								<?php foreach($tb as $files){ ?>
									<?php
									$filesd = explode('.', $files['list']);
									$ln = count($filesd);
									$ext = $filesd[$ln-1];

									if (in_array($ext, ['png', 'jpeg', 'gif'])) { ?>
										<div class="list">
											<div>
												<img src="shared/<?php echo $files['name'];?>" class="img-thumbnail" width="100">
											</div>
											<div><?php echo $files['list']; ?></div>
										</div>
									<?php } else { ?>
										<div class="list">
											<div>
												<img title="FILE" class="img-thumbnail" width="100">
											</div>
											<div><?php echo $files['list']; ?></div>
										</div>
										<?php
									}

								}
								 ?>
								</div>
					      	</div>
				  		<?php
						$ix++;
						} ?>
				    </div>
					*/ ?>
				</div>
			</div>

			<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'Share-Data <strong>' . SHAREDATA_VERSION . ' by awaludin</strong>' : '' ?></p>
		</div>
	</div>
</div>
<div class="box-selected"></div>

<script src="<?php echo NODE_MODULES; ?>jquery/dist/jquery.min.js"></script>
<script src="<?php echo BOOTSTRAP; ?>/js/bootstrap.min.js"></script>
<!-- <script src="<?php echo BOOTSTRAP; ?>/../docs/assets/js/docs.min.js"></script> -->
<script src="<?php echo PLUGIN; ?>enyo/dropzone/dist/min/dropzone.min.js"></script>
<script>
	$(document).ready(function(){
		var timeoutId = 0;
		var timeouts = {};
		var timeoutPId = 0;
		var count = 0;
		window.parentObj = {};

		$('div.dz-default.dz-message span').html('Drop file here to uploads, or click it');

		Dropzone.options.myAwesomeDropzone = {
			init: function() {
      			this.on("drop", function(file) {
					alert("Added file.");
				})
			},
		  	paramName: "file", // The name that will be used to transfer the file
		  	maxFilesize: 1000, // MB
		  	accept: function(file, done) {
		    	console.log('Done');
				done();
			},
		};

		$('.shared-data').html('Loading...');
		var refreshDataList = function() {
			$.ajax({
				url:'getData',
				success: function(response) {
					$('.shared-data').html(response);
				}
			});
		}

		refreshDataList();

		$('.refresh-data').on('click', function(e){
			refreshDataList();
		});

		$('.dropzone.dz-clickable').on('drop', function(e){
			refreshDataList();
		})

		var addItemSelected = function(parent) {
			div = parent.find('div.box-selected')
			div.fadeIn();
			sign = parent.find('div.choose-sign')
			sign.fadeIn();
		}

		var removeItemSelected = function(div) {
			parent = div.parent();
			div = parent.find('div.box-selected')
			div.fadeOut();
			sign = parent.find('div.choose-sign')
			sign.fadeOut();
			// setTimeout(function(){div.remove()}, 1000);
		}

		var removeButton = function(obj, show = 1) {
			parent = obj.parent()
			parentObj = parent;
			rmbtn = parent.find('.remove-btn')
			if (show) {
				rmbtn.show();
			} else {
				rmbtn.hide();
			}
		}

		$(document).on('click', '.remove-btn', function(e){
			alert('Do you want to remove this file');		
		});

		$(document).on('click', '.list', function(e){
			obj = $(this)
			parent = obj.parent()
			parentObj = parent;
			chbx = parent.find('.chbx')
			if (! chbx.prop('checked')) {
				chbx.prop('checked', true);
				addItemSelected(parent);
			} else {
				chbx.prop('checked', false);
			}
		}).on('mouseover', '.list', function(e){
			removeButton($(this))
		}).on('mouseout','.list', function(e){
			removeButton($(this), 0);
		});

		$(document).on('click', 'div.box-selected, div.choose-sign', function(){
			removeItemSelected($(this))
		})

		// var worker = new Worker("public/app/js/worker/timeout-worker.js");
		// worker.addEventListener("message", function(evt) {
		//   var data = evt.data,
		//       id = data.id,
		//       fn = timeouts[id].fn,
		//       args = timeouts[id].args;
		//
		//   fn.apply(null, args);
		//   delete timeouts[id];
		// });
		//
		// window.setTimeout = function(fn, delay) {
		//   var args = Array.prototype.slice.call(arguments, 2);
		//   timeoutId += 1;
		//   delay = delay || 0;
		//   var id = timeoutId;
		//   timeouts[id] = {fn: fn, args: args};
		//   worker.postMessage({command: "setTimeout", id: id, timeout: delay});
		//   return id;
		// };
		//
		// window.clearTimeout = function(id) {
		//   worker.postMessage({command: "clearTimeout", id: id});
		//   delete timeouts[id];
		// };
		//
		// TIMEOUT_DATA_REFRESH = 600000;
		// var refreshData = function() {
		// 	console.log('getData');
		// 	// $.ajax({
		// 	// 	url: '/getData',
		// 	// 	success:function(response){
		// 	// 		console.log('Load Data');
		// 	// 	}
		// 	// })
		//
		// 	window.clearTimeout(timeoutPId);
		// 	// timeoutPId = window.setTimeout(refreshData(), TIMEOUT_DATA_REFRESH);
		// 	if (count == 3) {
		// 		window.clearTimeout(timeoutPId);
		// 	}
		// 	count += 1;
		// }
		//
		// timeoutPId = window.setTimeout(function(){
		// 	refreshData();
		// }, TIMEOUT_DATA_REFRESH);
	})
</script>
</body>
</html>
