<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?=base_url("admin/")?>">Home</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Settings</span>
		</li>
	</ul>
  
</div>
<h3 class="page-title">Settings</h3>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">Service Plans Configurations</div>
				<div class="actions">
					<a href="<?=base_url('admin/nas')?>" class="btn red mt-ladda-btn ladda-button update_action" data-style="slide-right">
						<span class="ladda-label">Update Settings</span>
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="table-scrollable">
					<table id="nas-datatable" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>id</th> 
								<th>nasname</th> 
								<th>description</th> 
								<?=($is_admin ? '<th>admin</th> ' : '') ?>
								<th>free</th> 
								<th>sms</th> 
								<th>social</th> 
								<th>paid </th>
							</tr>
						</thead>
						
						<tbody>
							<?php foreach ($nas as $item): ?>
								<tr data-id = '<?=$item['id']?>'>
									<td><?=$item['id']?></td>
									<td><?=$item['nasname']?></td>
									<td><?=$item['description']?></td>
								<?php if($is_admin){ ?>
										<td>
											<select class="form-control" name='user_id'>
												<option value='-1'>Select user</option>
												<?php foreach($users as $account):?>
													<option value='<?=$account['id']?>' <?=($item['user_id'] == $account['id'] ? 'selected':'')?>><?=$account['first_name']." ".$account['last_name']?></option>
												<?php endforeach;?>
											</select>
										</td>
								<?php	}	?>
									<td>
										<select class="form-control" name='free'>
											<option value='-1'>Select limit</option>
											<?php foreach($limits as $limit):?>
												<option value='<?=$limit['id']?>' <?=($item['free']==$limit['id']?'selected':'')?>><?=$limit['plan_adi']?></option>
											<?php endforeach;?>
										</select>
									</td>
									<td>							
										<select class="form-control" name='sms'>
											<option value='-1'>Select limit</option>
											<?php foreach($limits as $limit):?>
												<option value='<?=$limit['id']?>' <?=($item['sms']==$limit['id']?'selected':'')?>><?=$limit['plan_adi']?></option>
											<?php endforeach;?>
										</select>
									</td>
									<td>							
										<select class="form-control" name='social'>
											<option value='-1'>Select limit</option>
											<?php foreach($limits as $limit):?>
												<option value='<?=$limit['id']?>' <?=($item['social']==$limit['id']?'selected':'')?>><?=$limit['plan_adi']?></option>
											<?php endforeach;?>
										</select>
									</td>
									<td>							
										<select class="form-control" name='paid'>
											<option value='-1'>Select limit</option>
											<?php foreach($limits as $limit):?>
												<option value='<?=$limit['id']?>' <?=($item['paid']==$limit['id']?'selected':'')?>><?=$limit['plan_adi']?></option>
											<?php endforeach;?>
										</select>
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