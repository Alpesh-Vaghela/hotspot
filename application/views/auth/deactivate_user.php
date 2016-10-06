<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?=base_url("admin/")?>">Home</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span><?php echo lang('deactivate_heading');?></span>
		</li>
	</ul>
  
</div>

<h3 class="page-title"><?php echo lang('deactivate_heading');?></h3>

<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption"><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></div>
				<div class="actions"></div>
			</div>
			<div class="portlet-body form">
					<?php echo form_open("auth/deactivate/".$user->id);?>

						  <p>
							<?php echo lang('deactivate_confirm_y_label', 'confirm');?>
							<input type="radio" name="confirm" value="yes" checked="checked" />
							<?php echo lang('deactivate_confirm_n_label', 'confirm');?>
							<input type="radio" name="confirm" value="no" />
						  </p>

						  <?php echo form_hidden($csrf); ?>
						  <?php echo form_hidden(array('id'=>$user->id)); ?>

						  <p><?php echo form_submit('submit', lang('deactivate_submit_btn'), array('class' => 'btn green'));?></p>

					<?php echo form_close();?>
			</div>
		</div>
	</div>
</div>

