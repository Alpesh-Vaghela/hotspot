<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?=base_url("admin/")?>">Home</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span><?php echo lang('edit_user_heading');?></span>
		</li>
	</ul>
  
</div>




<h3 class="page-title"><?php echo lang('edit_user_heading');?></h3>

<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption"><?php echo lang('edit_user_subheading');?></div>
				<div class="actions"></div>
			</div>
			<div class="portlet-body form">
				<div id="infoMessage"><?php echo $message;?></div>
				
				<?php echo form_open(uri_string(), array('class' => 'form-horizontal form-label-left'));?>

					  <div class="form-group">
							<?php echo lang('edit_user_fname_label', 'first_name', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']);?>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<?php echo form_input($first_name);?>
							</div>
					  </div>

					  <div class="form-group">
							<?php echo lang('edit_user_lname_label', 'last_name', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']);?>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<?php echo form_input($last_name);?>
							</div>
					  </div>

					  <div class="form-group">
							<?php echo lang('edit_user_company_label', 'company', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']);?>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<?php echo form_input($company);?>
							</div>
					  </div>

					  <div class="form-group">
							<?php echo lang('edit_user_phone_label', 'phone', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']);?>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<?php echo form_input($phone);?>
							</div>
					  </div>

					  <div class="form-group">
							<?php echo lang('edit_user_password_label', 'password', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']);?>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<?php echo form_input($password);?>
							</div>
					  </div>

					  <div class="form-group">
							<?php echo lang('edit_user_password_confirm_label', 'password_confirm', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']);?>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<?php echo form_input($password_confirm);?>
							</div>
					  </div>

					  <?php if ($this->ion_auth->is_admin()): ?>
						<div class="form-group">
						<div class="col-md-6 col-md-offset-3 col-sm-6-col-sm-offset-3 col-xs-12 col-xs-offset-0">
						  <h3><?php echo lang('edit_user_groups_heading');?></h3>
						  <?php foreach ($groups as $group):?>
							  <label class="checkbox">
							  <?php
								  $gID=$group['id'];
								  $checked = null;
								  $item = null;
								  foreach($currentGroups as $grp) {
									  if ($gID == $grp->id) {
										  $checked= ' checked="checked"';
									  break;
									  }
								  }
							  ?>
							  <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
							  <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
							  </label>
						  <?php endforeach?>
						</div>
						</div>
					  <?php endif ?>

					  <?php echo form_hidden('id', $user->id);?>
					  <?php echo form_hidden($csrf); ?>

					  <div class="form-group">
						<div class="col-md-6 col-md-offset-3 col-sm-6-col-sm-offset-3 col-xs-12 col-xs-offset-0">
							<?php echo form_submit('submit', lang('edit_user_submit_btn'), ['class' => 'btn green']);?>
						</div>
					  </div>

				<?php echo form_close();?>
								
			</div>
		</div>
	</div>
</div>
