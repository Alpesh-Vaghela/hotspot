<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?=base_url("admin/")?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Hotspot Users</span>
        </li>
    </ul>
  
</div>
<h3 class="page-title">Hotspot Users</h3>
<!-- <?php var_dump($users); ?> -->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption"></div>
                <div class="actions">
                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                        <a class="btn red" data-toggle="modal" href="#responsive" id="add_item"> Add New User </a>
                    </div>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="table-scrollable">
                    <table id="usersList" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Photo</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>GSM No</th>
                                <th>User type</th>
                                <!-- <th>Visits</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($users) && $users) foreach($users as $key => $value):?>
                                <tr>
                                    <td class="u-id"><?php echo $value['id']?></td>
                                    <td><img src="<?php echo base_url(); ?>assets/img/no_image_available.png" height="80" class="circle"/></td>
                                    <td class="u-name"><?php echo $value['uname']; ?></td>
                                    <td class="u-pass"><?php echo $value['clear_pword']; ?></td>
                                    <td class="u-fn"><?php echo $value['fname']; ?></td>
                                    <td class="u-ln"><?php echo $value['lname']; ?></td>
                                    <td class="u-email"><?php echo $value['email']; ?></td>
                                    <td class="u-gsmno"><?php echo $value['gsmno']; ?></td>
                                    <td class="u-type"><?php echo $value['users_type']; ?></td>
                                    <!-- <td><?php echo rand(1,20); ?></td> -->
                                    <td class="u-grname hidden"><?php echo $value['groupname']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-xs green dropdown-toggle item-edit" type="button" aria-expanded="false"> Edit </a>
                                            <a class="btn btn-xs blue dropdown-toggle item-delete" href="<?php echo base_url(); ?>admin/hotspot_users_delete/<?php echo $value['id']?>" aria-expanded="false"> Delete</a>
                                        </div>
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

<div id="responsive" class="modal fade" tabindex="-1" data-width="500">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Change Users</h4>
    </div>
    <form role="form" method="POST" action="<?php echo base_url(); ?>admin/hotspot_users_set" id="create_user">
        <input type="hidden" name="admin_created" value="1">
        <div class="modal-body form-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>First name</label>
                                <input class="form-control spinner" type="text" placeholder="First Name" name="fname" required="required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input class="form-control spinner" type="text" placeholder="Last Name" name="lname" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>E-mail</label>
                                <input class="form-control spinner" type="email" placeholder="E-mail" name="email" required="required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telephone</label>
                                <input class="form-control spinner" type="number" placeholder="Telephone" name="gsmno" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control spinner" type="text" placeholder="Password" maxlength="6" name="clear_pword" required="required" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Plan</label>
                                <select name="plan_id" class="form-control" required="required">
                                    <?php if(isset($plans)) foreach($plans as $key => $value):?>
                                        <option class="plans-options" data-rgname="<?php echo $value['rgp_groupname']; ?>" value="<?php echo $value['id']; ?>"><?php echo $value['plan_adi']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <button type="button" class="gen-password btn blue form-control spinner">Generate password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer form-actions">
        <button type="button" data-dismiss="modal" class="btn btn-outline dark">Close</button>
        <button type="submit" class="btn green">Save</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).on('click', '#add_item', function(e){
        $('form#create_user').trigger('reset');
        $('form#create_user').find('input[name="id"]').remove();
        $('form#create_user').find('input[name="clear_pword"]').attr('required',"required");
    });

    $(document).on('click', 'a.item-edit', function(e){
        $('form#create_user').trigger('reset');
        var container = $(this).parents('tr');
        var id = container.find('.u-id').html();
        var firstname = container.find('.u-fn').html();
        var lastname = container.find('.u-ln').html();
        var email = container.find('.u-email').html();
        var gsmno = container.find('.u-gsmno').html();
        var grname = container.find('.u-grname').html();
        var pass = container.find('.u-pass').html();
        $('.plans-options').each(function(i, v){
            if($(v).data('rgname') == grname)
                $('#responsive').find('select[name="plan_id"]').val($(v).val());
        });
        $('#responsive').find('input[name="fname"]').val(firstname);
        $('#responsive').find('input[name="lname"]').val(lastname);
        $('#responsive').find('input[name="email"]').val(email);
        $('#responsive').find('input[name="gsmno"]').val(gsmno);
        $('#responsive').find('input[name="clear_pword"]').val(pass)
        $('#responsive input[name="fname"]').before('<input type="hidden" name="id" value="'+id+'" >');
        $('#responsive').find('input[name="clear_pword"]').removeAttr('required');
        $('#responsive').modal();
    });

    $(document).on('click', 'button.gen-password', function(e){
        $(this).parents('.row').find('input[name="clear_pword"]').val(gen_random_string());
    });

    $(document).on('click', 'a.item-delete', function(e) {
        return confirm('Are you sure?');
    });

    function gen_random_string() {
        var text = "";
        var possible = "0123456789";

        for( var i=0; i < 6; i++ )
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    }
</script>