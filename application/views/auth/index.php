<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?=base_url("admin/")?>">Home</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Users</span>
		</li>
	</ul>
  
</div>

<h3 class="page-title">Users</h3>

<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption"><?php echo lang('index_subheading');?></div>
				<div class="actions">
					<!-- div class="btn-group btn-group-devided" data-toggle="buttons">
                    <a class="btn red" data-toggle="modal" href="#responsive"> Add New User </a>
                    </div> -->
                </div>
			</div>
			<div class="portlet-body form">
				<div class="table-scrollable">
					<table id="usersList" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th><?php echo lang('index_fname_th');?></th>
								<th><?php echo lang('index_lname_th');?></th>
								<th><?php echo lang('index_email_th');?></th>
								<th><?php echo lang('index_groups_th');?></th>
								<th><?php echo lang('index_status_th');?></th>
								<th width="140px;"><?php echo lang('index_action_th');?></th>
							</tr>
						</thead>
						
						<tbody>
							<?php foreach ($users as $user):?>
								<tr>
									<td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
									<td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
									<td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
									<td>
										<?php foreach ($user->groups as $group):?>
											<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8'), array('class' => 'btn btn-xs blue')) ;?>
										<?php endforeach?>
									</td>
									<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link'), array('class' => 'btn btn-xs green')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'), array('class' => 'btn btn-xs red'));?></td>
									<td style="vertical-align: middle; color: #999;">
										<?php echo anchor("auth/edit_user/".$user->id, 'Edit', array('class' => 'btn btn-xs green')) ;?>
									</td>
								</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>