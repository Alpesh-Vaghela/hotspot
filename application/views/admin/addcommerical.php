<div class="x_panel">
  <div class="x_title">
	<h2>Add commerical</h2>
	<div class="clearfix"></div>
  </div>
  <div class="x_content">
	<br />
	<?php if(validation_errors()): ?>
		<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <?php echo validation_errors(); ?>
		</div>
	<?php endif; ?>
	<?php if(isset($error)): ?>
		<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <?=$error["error"]?>
		</div>
	<?php endif; ?>
	<form method="POST" id="addcommerical-form" class="form-horizontal form-label-left" enctype="multipart/form-data">
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="limit_type">Nasname <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<select id="nas_id" name="nas_id" required="required" class="form-control col-md-7 col-xs-12">
				<option value="">Select nasname</option>
		<?php	if($nas) foreach($nas as $n){	?>
					<option <?=(isset($form_data['nas_id']) && $form_data['nas_id'] == $n["id"] ? 'selected' : '')?> value="<?=$n["id"]?>"><?=$n["nasname"]?></option>
		<?php	}	?>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="limit_type">Type <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<select id="type" name="type" class="form-control col-md-7 col-xs-12" required="required">
					<option value="">Select type</option>
					<option <?=(isset($form_data['type']) && $form_data['type'] == 0 ? 'selected' : '')?> value="0">Image (gif, jpg, jpeg, png)</option>
					<option <?=(isset($form_data['type']) && $form_data['type'] == 1 ? 'selected' : '')?> value="1">Video (mp4, mpeg, avi)</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="limit_type">Upload file <?=(isset($form_data['id']) && $form_data['id'] ? '' : '<span class="required">*</span>')?>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
			<?php
				if(isset($form_data['id']) && $form_data['id']){
					$data = json_decode($form_data['data']);
					
					if($form_data['type'] == 0)
						echo '<img width="400" src="/'.$data->path.'">';
					else
						echo '<video width="320" height="240" controls>
								<source src="/'.$data->path.'" type="'.$data->file_type.'">
							</video>';
				}
			?>
				<input type="file" name="file" id="file" <?=(isset($form_data['id']) && $form_data['id'] ? '' : 'required="required"')?>>
			</div>
		</div>
		
		<div class="ln_solid"></div>
		<div class="form-group">
			<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
				<button type="submit" name="submit" value="submit" class="btn btn-success">Save</button>
			</div>
		</div>

	</form>
  </div>
</div>