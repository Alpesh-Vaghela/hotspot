<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?=base_url("admin/")?>">Home</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Service Plans</span>
		</li>
	</ul>
  
</div>
<h3 class="page-title">Service Plans</h3>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">Service Plans Configurations </div>
				<div class="actions">
					<div class="btn-group btn-group-devided" data-toggle="buttons">
						<button type="btn btn-danger pull-right" class="btn btn-danger pull-right add plan" data-toggle="modal" data-target="#addPlan">Add Service Plan</button>
					</div>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="table-scrollable">
					<table id="plans-datatable" class="table table-bordered table-hover">
						<thead>
							<tr>
							  <th>ID</th>
							  <?=($is_admin ? '<th>Admin</th> ' : '') ?>
							  <th>Plan adi</th>
							  <th>Limit type</th>
							  <th>Time limit</th>
							  <th>Time unit</th>
							  <th>Data limit</th>
							  <th>Data unit</th>
							  <th>Max up</th>
							  <th>Max down</th>
							  <th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($plans as $plan): ?>
								<tr data-id="<?=$plan['id']?>">
									<td><?=$plan['id']?></td>
							<?php 	if($is_admin){ ?>
									<td><?=$plan['first_name']." ".$plan["last_name"]?></td>
							<?php 	}	?>
									<td><?=$plan['plan_adi']?></td>
									<td><?=$plan['limit_type']?></td>
									<td><?=$plan['time_limit']?></td>
									<td><?=$plan['time_unit']?></td>
									<td><?=$plan['data_limit']?></td>
									<td><?=$plan['data_unit']?></td>
									<td><?=$plan['max_up']?></td>
									<td><?=$plan['max_down']?></td>
									<td>
										<button type="btn btn-danger pull-right" class="btn green btn-xs pull-left edit plan" data-toggle="modal" data-target="#addPlan">Edit</button>
										<a class="btn btn-xs blue pull-left delete plan" href="<?=base_url("admin/deleteplan/{$plan['id']}")?>">Delete</a>
									</td>
								</tr>
								
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="addPlan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Add Service Plans</h4>
	</div>
	<form method="POST" id="addplan-form" class="" action="<?=base_url()?>admin/addplan">
		<div class="modal-body form-body">
			<div class="row">
				<div class="col-md-12">
			<?php 	if($is_admin){ ?>
						<div class="form-group">
							<label for="plan_adi">Admin Name <span class="required">*</span></label>
							<select id='user_id' name='user_id' required="required" class="form-control">
								<option value='-1'>Select user admin</option>
								<?php foreach($users as $account):?>
									<option value='<?=$account['id']?>'><?=$account['first_name']." ".$account['last_name']?></option>
								<?php endforeach;?>
							</select>
						</div>
			<?php 	} 	?>
					<div class="form-group">
						<label for="plan_adi">Plan Name <span class="required">*</span></label>
						<input type="text" id="plan_adi" name="plan_adi" required="required" class="form-control spinner" value="<?=(isset($form_data['plan_adi']) ? $form_data['plan_adi'] : '')?>" placeholder="Silver">
					</div>
					<div class="form-group">
						<label for="limit_type">Limit type <span class="required">*</span></label>
						<select id="limit_type" name="limit_type" required="required" class="form-control">
							<option <?=(isset($form_data['limit_type']) &&  $form_data['limit_type'] == '0' ? 'selected' : '')?> value="0">0</option>
							<option <?=(isset($form_data['limit_type']) &&  $form_data['limit_type'] == '1' ? 'selected' : '')?> value="1">1</option>
						</select>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="time_limit">Time limit <span class="required">*</span></label>
								<input type="text" id="time_limit" name="time_limit" required="required" class="form-control spinner" value="<?=(isset($form_data['time_limit']) ? $form_data['time_limit'] : '')?>" placeholder="5">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="time_unit">Time unit <span class="required">*</span></label>
								<select id="time_unit" name="time_unit" required="required" class="form-control">
									<option <?=(isset($form_data['time_unit']) &&  $form_data['time_unit'] == 'Mins' ? 'selected' : '')?> value="Mins">Mins</option>
									<option <?=(isset($form_data['time_unit']) &&  $form_data['time_unit'] == 'Hrs' ? 'selected' : '')?> value="Hrs">Hrs</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="data_limit">Data limit <span class="required">*</span></label>
								<input type="text" id="data_limit" name="data_limit" required="required" class="form-control spinner" value="<?=(isset($form_data['data_limit']) ? $form_data['data_limit'] : '')?>" placeholder="500">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="data_unit">Data unit <span class="required">*</span></label>
								<select id="data_unit" name="data_unit" required="required" class="form-control">
									<option <?=(isset($form_data['data_unit']) &&  $form_data['data_unit'] == 'MB' ? 'selected' : '')?> value="MB">MB</option>
									<option <?=(isset($form_data['data_unit']) &&  $form_data['data_unit'] == 'GB' ? 'selected' : '')?> value="GB">GB</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="max_up">Max up <span class="required">*</span></label>
								<input type="text" id="max_up" name="max_up" required="required" class="form-control spinner" value="<?=(isset($form_data['max_up']) ? $form_data['max_up'] : '')?>" placeholder="4">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="max_down">Max down <span class="required">*</span></label>
								<input type="text" id="max_down" name="max_down" required="required" class="form-control spinner" value="<?=(isset($form_data['max_down']) ? $form_data['max_down'] : '')?>" placeholder="2">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<input type="hidden" value="" name="id" id="id" class="plan_id">
			<button type="button" class="btn btn-outline dark" data-dismiss="modal">Close</button>
			<button type="submit" class="btn green">Save changes</button>
		</div>
	</form>
</div>