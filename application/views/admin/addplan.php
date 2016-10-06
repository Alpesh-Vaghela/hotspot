<div class="x_panel">
  <div class="x_title">
	<h2>Add plan</h2>
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
	<form method="POST" id="addplan-form" class="form-horizontal form-label-left">
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="plan_adi">Plan adi <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" id="plan_adi" name="plan_adi" required="required" class="form-control col-md-7 col-xs-12" value="<?=(isset($form_data['plan_adi']) ? $form_data['plan_adi'] : '')?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="limit_type">Limit type <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<select id="limit_type" name="limit_type" required="required" class="form-control col-md-7 col-xs-12">
					<option <?=(isset($form_data['limit_type']) &&  $form_data['limit_type'] == '0' ? 'selected' : '')?> value="0">0</option>
					<option <?=(isset($form_data['limit_type']) &&  $form_data['limit_type'] == '1' ? 'selected' : '')?> value="1">1</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="time_limit">Time limit <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" id="time_limit" name="time_limit" required="required" class="form-control col-md-7 col-xs-12" value="<?=(isset($form_data['time_limit']) ? $form_data['time_limit'] : '')?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="time_unit">Time unit <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<select id="time_unit" name="time_unit" required="required" class="form-control col-md-7 col-xs-12">
					<option <?=(isset($form_data['time_unit']) &&  $form_data['time_unit'] == 'Mins' ? 'selected' : '')?> value="Mins">Mins</option>
					<option <?=(isset($form_data['time_unit']) &&  $form_data['time_unit'] == 'Hrs' ? 'selected' : '')?> value="Hrs">Hrs</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="data_limit">Data limit <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" id="data_limit" name="data_limit" required="required" class="form-control col-md-7 col-xs-12" value="<?=(isset($form_data['data_limit']) ? $form_data['data_limit'] : '')?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="data_unit">Data unit <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<select id="data_unit" name="data_unit" required="required" class="form-control col-md-7 col-xs-12">
					<option <?=(isset($form_data['data_unit']) &&  $form_data['data_unit'] == 'MB' ? 'selected' : '')?> value="MB">MB</option>
					<option <?=(isset($form_data['data_unit']) &&  $form_data['data_unit'] == 'GB' ? 'selected' : '')?> value="GB">GB</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="max_up">Max up <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" id="max_up" name="max_up" required="required" class="form-control col-md-7 col-xs-12" value="<?=(isset($form_data['max_up']) ? $form_data['max_up'] : '')?>">
			</div>
		</div>
		<div class="form-group">
			<label class="control-label col-md-3 col-sm-3 col-xs-12" for="max_down">Max down <span class="required">*</span>
			</label>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<input type="text" id="max_down" name="max_down" required="required" class="form-control col-md-7 col-xs-12" value="<?=(isset($form_data['max_down']) ? $form_data['max_down'] : '')?>">
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