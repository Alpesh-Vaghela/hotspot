<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?=base_url("admin/")?>">Home</a>
			<i class="fa fa-circle"></i>
		</li>
		<li>
			<span>Campaigns</span>
		</li>
	</ul>
  
</div>
<h3 class="page-title">Campaigns</h3>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">Campaigns Management</div>
				<div class="actions">
					<div class="btn-group btn-group-devided" data-toggle="buttons">
						<button type="btn btn-danger pull-right" class="btn btn-danger pull-right add commerical" data-toggle="modal" data-target="#addCommerical">Add New Campaign</button>
					</div>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="table-scrollable">
					<style>
						.table.table-bordered.table-hover td{ vertical-align: middle; color: #999}
					</style>
					<table id="nas-datatable" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>ID</th> 
								<th>Cover Photo</th> 
								<th>Nas Name</th> 
								<th>Title</th> 
								<th>Status</th> 
								<th>Type</th> 
								<th>Date</th> 
								<th>Impressions</th> 
								<th>Clicks</th> 
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($nas_commerical as $item): 
								$data = (array)json_decode($item['data']);
								?>
								<!-- <?php var_dump([$data, $item])?>-->
								<tr data-id = '<?=$item['id']?>'>
									<td><?=$item['id']?></td>
									<td><?=($item['type'] == 0 ? '<img class="circle" width="70" src="/'.$data['path'].'">' : '')?></td>
									<td><?=$item['nasname']?></td>
									<td><?=$item['title'] == ''?'':$item['title']?></td>
									<td><span class="label label-sm label-success"> Active </span></td>
									<td><?=(isset($item['type_page']) && $item['type_page'] == 0 ? "Login Page" : "Expired Page")?></td>
									<td>22/05/2016<br>26/05/2016</td>
									<td><?=isset($item['impressions'])?$item['impressions']:0?></td>
									<td><?=isset($item['clicks'])?$item['clicks']:0?></td>
									<td>
										<button type="btn btn-danger pull-right" class="btn green btn-xs pull-left edit commerical" data-toggle="modal" data-target="#addCommerical">Edit</button>
										<a class="btn btn-xs blue pull-left delete commerical" href="<?=base_url("admin/deletecommerical/{$item['id']}")?>">Delete</a>
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
<div class="modal fade" id="addCommerical" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Add commerical</h4>
	</div>
	<form method="POST" id="addcommerical-form" class="" action="<?=base_url()?>admin/addcommerical">
		<div class="modal-body form-body">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="nas_id">Choose Location <span class="required">*</span></label>
								<select id="nas_id" name="nas_id" required="required" class="form-control">
									<option value="">Select nasname</option>
							<?php	if($nas) foreach($nas as $n){	?>
										<option <?=(isset($form_data['nas_id']) && $form_data['nas_id'] == $n["id"] ? 'selected' : '')?> value="<?=$n["id"]?>"><?=$n["nasname"]?></option>
							<?php	}	?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="type_page">Ads Placement <span class="required">*</span></label>
								<select id="type_page" name="type_page" required="required" class="form-control">
									<option <?=(isset($form_data['type_page']) &&  $form_data['type_page'] == '0' ? 'selected' : '')?> value="0">Login Page </option>
									<option <?=(isset($form_data['type_page']) &&  $form_data['type_page'] == '1' ? 'selected' : '')?> value="1">Expired Page </option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="title">Campaign Name <span class="required">*</span></label>
						<input type="text" name="title" id="title" required="required" class="form-control spinner" placeholder="Palmarina Hotspot Welcome">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="description">Campaign Desctiption <span class="required">*</span></label>
						<input type="text" name="description" id="description" required="required" class="form-control spinner" placeholder="Sign Up or Login to use Wi-Fi.">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="type">Type <span class="required">*</span></label>
								<select id="type" name="type" class="form-control" required="required">
									<option value="">Select type</option>
									<option <?=(isset($form_data['type']) && $form_data['type'] == 0 ? 'selected' : '')?> value="0">Image (gif, jpg, jpeg, png)</option>
									<option <?=(isset($form_data['type']) && $form_data['type'] == 1 ? 'selected' : '')?> value="1">Video (mp4, mpeg, avi)</option>
								</select>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="file">Upload Ad (jpg,png,gif or mp4) <?=(isset($form_data['id']) && $form_data['id'] ? '' : '<span class="required">*</span>')?></label>
								<div class="file_block"></div>
								<input type="file" name="file" id="file" <?=(isset($form_data['id']) && $form_data['id'] ? '' : 'required="required"')?>>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<input type="hidden" value="" name="id" id="id" class="commerical_id">
			<button type="button" class="btn btn-outline dark" data-dismiss="modal">Close</button>
			<button type="submit" class="btn green">Save changes</button>
		</div>
	</form>
</div>