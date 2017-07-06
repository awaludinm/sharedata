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
			<div class="row">
			<?php foreach($tb as $files){ ?>
				<?php
				$filesd = explode('.', $files['list']);
				$ln = count($filesd);
				$ext = $filesd[$ln-1];

				if (in_array($ext, ['png', 'jpeg', 'gif', 'jpg', 'svg'])) { ?>
					<div class="col-md-4 col-sm-12 col-xs-12 data-list">
						<div>
							<img src="shared/<?php echo $files['name'];?>" class="img-thumbnail list" data-src="holder.js/200x200">
							<input class="chbx" type="checkbox" value="<?php echo $files['name'];?>">
							<div class="file-label">
								<label><?php echo $files['list']; ?></label>
							</div>
							<div class="remove-btn"><i class="glyphicon glyphicon-remove-circle"></i></div>
							<div class="box-selected"></div>
							<div class="choose-sign">
								<i class="glyphicon glyphicon-ok-sign"></i>
							</div>
						</div>
					</div>
				<?php } else { ?>
					<div class="col-md-4 col-sm-12 col-xs-12 data-list">
						<div>
							<div class="list"><?php echo strtoupper($ext); ?></div>
							<input class="chbx" type="checkbox" value="<?php echo $files['name'];?>">
							<div class="file-label">
								<label><?php echo $files['list']; ?></label>
							</div>
							<div class="remove-btn"><i class="glyphicon glyphicon-remove"></i></div>
							<div class="box-selected"></div>
							<div class="choose-sign">
								<i class="glyphicon glyphicon-ok-sign"></i>
							</div>
						</div>
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
