<!DOCTYPE html>
<html lang="en">
<!-- <?=$_SERVER['REQUEST_URI']?> -->
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/linefi/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/linefi/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/linefi/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/linefi/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<link href="<?=base_url()?>assets/linefi/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/linefi/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/linefi/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/linefi/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/linefi/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/linefi/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN THEME GLOBAL STYLES -->
	<link href="<?=base_url()?>assets/linefi/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
	<link href="<?=base_url()?>assets/linefi/css/plugins.min.css" rel="stylesheet" type="text/css" />
	<!-- END THEME GLOBAL STYLES -->
	<!-- BEGIN THEME LAYOUT STYLES -->
	<link href="<?=base_url()?>assets/linefi/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url()?>assets/linefi/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
	<link href="<?=base_url()?>assets/linefi/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
	<!-- END THEME LAYOUT STYLES -->
	<link rel="shortcut icon" href="favicon.ico" /> 
    <style>
        .table.table-bordered.table-hover td {
            vertical-align: middle;
            color: #999;
        }
    </style>
	

  <script src="<?=base_url()?>assets/theme/js/jquery.min.js"></script>
  <script src="http://malsup.github.com/jquery.form.js"></script> 

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
	<script>
		$(document).on('change','#nas-datatable select',function(){
			elem = $(this);
			data = {
				id:$(elem).parents('tr').attr('data-id'),
				name:$(elem).attr('name'),
				value:$(elem).val()
			}
			$.ajax({
				url:'/admin/nasAjaxChange',
				method:'POST',
				dataType: 'json',
				data:data,
				beforeSend:function(){
					$(elem).prop( "disabled", true );
				},
				success:function(data){
					$(elem).prop( "disabled", false );
				}
			});
		});
	</script>
</head>


<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white">
	<!-- BEGIN HEADER -->
	<div class="page-header navbar navbar-fixed-top">
		<!-- BEGIN HEADER INNER -->
		<div class="page-header-inner ">
			<!-- BEGIN LOGO -->
			<div class="page-logo">
				<a href="index.html">
					<img src="<?=base_url()?>assets/theme/images/logo.svg" alt="logo" class="logo-default" /> </a>
				<div class="menu-toggler sidebar-toggler">
					<span></span>
				</div>
			</div>
			<!-- END LOGO -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
				<span></span>
			</a>
			<!-- END RESPONSIVE MENU TOGGLER -->
			<!-- BEGIN TOP NAVIGATION MENU -->
			<div class="top-menu">
				<ul class="nav navbar-nav pull-right">
					<!-- BEGIN NOTIFICATION DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<i class="icon-bell"></i>
							<span class="badge badge-default"> 7 </span>
						</a>
						<ul class="dropdown-menu">
							<li class="external">
								<h3>
									<span class="bold">12 pending</span> notifications</h3>
								<a href="page_user_profile_1.html">view all</a>
							</li>
							<li>
								<ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
									<li>
										<a href="javascript:;">
											<span class="time">just now</span>
											<span class="details">
												<span class="label label-sm label-icon label-success">
													<i class="fa fa-plus"></i>
												</span> New user registered. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
											<span class="time">3 mins</span>
											<span class="details">
												<span class="label label-sm label-icon label-danger">
													<i class="fa fa-bolt"></i>
												</span> Server #12 overloaded. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
											<span class="time">10 mins</span>
											<span class="details">
												<span class="label label-sm label-icon label-warning">
													<i class="fa fa-bell-o"></i>
												</span> Server #2 not responding. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
											<span class="time">14 hrs</span>
											<span class="details">
												<span class="label label-sm label-icon label-info">
													<i class="fa fa-bullhorn"></i>
												</span> Application error. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
											<span class="time">2 days</span>
											<span class="details">
												<span class="label label-sm label-icon label-danger">
													<i class="fa fa-bolt"></i>
												</span> Database overloaded 68%. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
											<span class="time">3 days</span>
											<span class="details">
												<span class="label label-sm label-icon label-danger">
													<i class="fa fa-bolt"></i>
												</span> A user IP blocked. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
											<span class="time">4 days</span>
											<span class="details">
												<span class="label label-sm label-icon label-warning">
													<i class="fa fa-bell-o"></i>
												</span> Storage Server #4 not responding dfdfdfd. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
											<span class="time">5 days</span>
											<span class="details">
												<span class="label label-sm label-icon label-info">
													<i class="fa fa-bullhorn"></i>
												</span> System Error. </span>
										</a>
									</li>
									<li>
										<a href="javascript:;">
											<span class="time">9 days</span>
											<span class="details">
												<span class="label label-sm label-icon label-danger">
													<i class="fa fa-bolt"></i>
												</span> Storage server failed. </span>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<!-- END NOTIFICATION DROPDOWN -->
					<!-- BEGIN INBOX DROPDOWN -->
					<!-- BEGIN USER LOGIN DROPDOWN -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<li class="dropdown dropdown-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<span class="username username-hide-on-mobile"><?=$this->session->userdata('identity')?></span>
							<i class="fa fa-angle-down"></i>
						</a>
						<ul class="dropdown-menu dropdown-menu-default">
							<li>
								<a href="page_user_profile_1.html">
									<i class="icon-user"></i> My Profile </a>
							</li>
							<li>
								<a href="app_calendar.html">
									<i class="icon-calendar"></i> My Calendar </a>
							</li>
							<li>
								<a href="app_inbox.html">
									<i class="icon-envelope-open"></i> My Inbox
									<span class="badge badge-danger"> 3 </span>
								</a>
							</li>
							<li>
								<a href="app_todo.html">
									<i class="icon-rocket"></i> My Tasks
									<span class="badge badge-success"> 7 </span>
								</a>
							</li>
							<li class="divider"> </li>
							<li>
								<a href="page_user_lock_1.html">
									<i class="icon-lock"></i> Lock Screen </a>
							</li>
							<li>
								<a href="<?=base_url()?>admin/auth/logout">
									<i class="icon-key"></i> Log Out </a>
							</li>
						</ul>
					</li>
					<!-- END USER LOGIN DROPDOWN -->
					<!-- BEGIN QUICK SIDEBAR TOGGLER -->
					<!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
					<li class="dropdown dropdown-quick-sidebar-toggler">
						<a href="<?=base_url()?>admin/auth/logout" class="dropdown-toggle">
							<i class="icon-logout"></i>
						</a>
					</li>
					<!-- END QUICK SIDEBAR TOGGLER -->
				</ul>
			</div>
			<!-- END TOP NAVIGATION MENU -->
		</div>
		<!-- END HEADER INNER -->
	</div>
	<!-- END HEADER -->
	<!-- BEGIN HEADER & CONTENT DIVIDER -->
	<div class="clearfix"> </div>
	<!-- END HEADER & CONTENT DIVIDER -->
	 <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-light " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <li class="sidebar-toggler-wrapper hide">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler">
                                <span></span>
                            </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>
                        <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                        <li class="sidebar-search-wrapper">
                            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                            <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                            <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                            <form class="sidebar-search  " action="page_general_search_3.html" method="POST">
                                <a href="javascript:;" class="remove">
                                    <i class="icon-close"></i>
                                </a>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <a href="javascript:;" class="btn submit">
                                            <i class="icon-magnifier"></i>
                                        </a>
                                    </span>
                                </div>
                            </form>
                            <!-- END RESPONSIVE QUICK SEARCH FORM -->
                        </li>
                        <?php $is_mem = $this->ion_auth->get_users_groups($this->ion_auth->get_user_id())->result();?>
                        <?php if($this->ion_auth->is_admin()): ?>
                            <li class="nav-item start <?=base_url($_SERVER['REQUEST_URI']) == base_url("admin")?'active':''?>">
                                <a href="<?=base_url("admin")?>" class="nav-link">
                                    <i class="icon-home"></i>
                                    <span class="title">Dashboard</span>
    								<?=base_url($_SERVER['REQUEST_URI']) == base_url("admin")?'<span class="selected"></span>':''?>
                                </a>
                            </li>
                            <li class="nav-item <?=base_url($_SERVER['REQUEST_URI']) == base_url("admin/hotspot_users")?'active':''?>">
                                <a href="<?=base_url("admin/hotspot_users")?>" class="nav-link">
                                    <i class="icon-user"></i>
                                    <span class="title">Hotspot Users</span>
                                    <?=base_url($_SERVER['REQUEST_URI']) == base_url("admin/hotspot_users")?'<span class="selected"></span>':''?>
                                </a>
                            </li>
                            <li class="nav-item <?=base_url($_SERVER['REQUEST_URI']) == base_url("admin/nas_commerical")?'active':''?>">
                                <a href="<?=base_url("admin/nas_commerical")?>" class="nav-link">
                                    <i class="icon-diamond"></i>
                                    <span class="title">Campaigns</span>
    								<?=base_url($_SERVER['REQUEST_URI']) == base_url("admin/nas_commerical")?'<span class="selected"></span>':''?>
                                </a>
                            </li>
                            <li class="nav-item <?=base_url($_SERVER['REQUEST_URI']) == base_url("admin/plans")?'active':''?>">
                                <a href="<?=base_url("admin/plans")?>" class="nav-link">
                                    <i class="icon-paper-plane"></i>
                                    <span class="title">Service Plans</span>
    								<?=base_url($_SERVER['REQUEST_URI']) == base_url("admin/plans")?'<span class="selected"></span>':''?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=base_url("admin")?>" class="nav-link">
                                    <i class="icon-home"></i>
                                    <span class="title">Vouchers</span>
                                </a>
                            </li>						
    						<li class="nav-item <?=(strpos((base_url($_SERVER['REQUEST_URI'])), 'auth') !== false)?'open':''?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                    <i class="icon-list"></i>
                                    <span class="title">Admin Menu</span>
                                    <span class="arrow <?=(strpos((base_url($_SERVER['REQUEST_URI'])), 'auth') !== false)?'open':''?>"></span>
                                </a>
                                <ul class="sub-menu <?=(strpos((base_url($_SERVER['REQUEST_URI'])), 'auth') !== false)?'open':''?>" style="<?=(strpos((base_url($_SERVER['REQUEST_URI'])), 'auth') !== false)?'display:block':''?>">
                                    <li class="nav-item">
                                        <a href="javascript:;" class="nav-link nav-toggle">
    										<span class="title">Users</span>
    										<span class="arrow <?=(strpos((base_url($_SERVER['REQUEST_URI'])), 'auth') !== false)?'open':''?>"></span>
    									</a>
    									<ul class="sub-menu" style="<?=(strpos((base_url($_SERVER['REQUEST_URI'])), 'auth') !== false)?'display:block':''?>">
    										<li class="nav-item <?=base_url($_SERVER['REQUEST_URI']) == base_url("auth")?'active':''?>">
    											<a href="<?=base_url("auth")?>" class="nav-link ">
    												<span class="title">List</span>
    												<?=base_url($_SERVER['REQUEST_URI']) == base_url("auth")?'<span class="selected"></span>':''?>
    											</a>
    										</li>
    										
    										<li class="nav-item <?=base_url($_SERVER['REQUEST_URI']) == base_url("auth/create_user")?'active':''?>">
    											<a href="<?=base_url("auth/create_user")?>" class="nav-link ">
    												<span class="title">Create a new user</span>
    												<?=base_url($_SERVER['REQUEST_URI']) == base_url("auth/create_user")?'<span class="selected"></span>':''?>
    											</a>
    										</li>
    										<li class="nav-item <?=base_url($_SERVER['REQUEST_URI']) == base_url("auth/create_group")?'active':''?>">
    											<a href="<?=base_url("auth/create_group")?>" class="nav-link ">
    												<span class="title">Create a new group</span>
    												<?=base_url($_SERVER['REQUEST_URI']) == base_url("auth/create_group")?'<span class="selected"></span>':''?>
    											</a>
    										</li>
    									</ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item <?=base_url($_SERVER['REQUEST_URI']) == base_url("admin/nas")?'active':''?>">
                                <a href="<?=base_url('admin/nas')?>" class="nav-link">
                                    <i class=" icon-wrench"></i>
                                    <span class="title">Settings</span>
                                    <?=base_url($_SERVER['REQUEST_URI']) == base_url("admin/nas")?'<span class="selected"></span>':''?>
                                </a>
                            </li>
                    <?php elseif($is_mem[0]->name == 'administartor'): ?>
                            <li class="nav-item start <?=base_url($_SERVER['REQUEST_URI']) == base_url("admin")?'active':''?>">
                                <a href="<?=base_url("admin")?>" class="nav-link">
                                    <i class="icon-home"></i>
                                    <span class="title">Dashboard</span>
                                    <?=base_url($_SERVER['REQUEST_URI']) == base_url("admin")?'<span class="selected"></span>':''?>
                                </a>
                            </li>
                            <li class="nav-item <?=base_url($_SERVER['REQUEST_URI']) == base_url("admin/hotspot_users")?'active':''?>">
                                <a href="<?=base_url("admin/hotspot_users")?>" class="nav-link">
                                    <i class="icon-user"></i>
                                    <span class="title">Hotspot Users</span>
                                    <?=base_url($_SERVER['REQUEST_URI']) == base_url("admin/hotspot_users")?'<span class="selected"></span>':''?>
                                </a>
                            </li>
                            <li class="nav-item <?=base_url($_SERVER['REQUEST_URI']) == base_url("admin/nas_commerical")?'active':''?>">
                                <a href="<?=base_url("admin/nas_commerical")?>" class="nav-link">
                                    <i class="icon-diamond"></i>
                                    <span class="title">Campaigns</span>
                                    <?=base_url($_SERVER['REQUEST_URI']) == base_url("admin/nas_commerical")?'<span class="selected"></span>':''?>
                                </a>
                            </li>
                            <li class="nav-item <?=base_url($_SERVER['REQUEST_URI']) == base_url("admin/plans")?'active':''?>">
                                <a href="<?=base_url("admin/plans")?>" class="nav-link">
                                    <i class="icon-paper-plane"></i>
                                    <span class="title">Service Plans</span>
                                    <?=base_url($_SERVER['REQUEST_URI']) == base_url("admin/plans")?'<span class="selected"></span>':''?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?=base_url("admin")?>" class="nav-link">
                                    <i class="icon-home"></i>
                                    <span class="title">Vouchers</span>
                                </a>
                            </li>                       
                            <li class="nav-item <?=base_url($_SERVER['REQUEST_URI']) == base_url("admin/nas")?'active':''?>">
                                <a href="<?=base_url('admin/nas')?>" class="nav-link">
                                    <i class=" icon-wrench"></i>
                                    <span class="title">Settings</span>
                                    <?=base_url($_SERVER['REQUEST_URI']) == base_url("admin/nas")?'<span class="selected"></span>':''?>
                                </a>
                            </li>
                    <?php else: ?>
                        <li class="nav-item <?=base_url($_SERVER['REQUEST_URI']) == base_url("admin/hotspot_users")?'active':''?>">
                            <a href="<?=base_url("admin/hotspot_users")?>" class="nav-link">
                                <i class="icon-user"></i>
                                <span class="title">Hotspot Users</span>
                                <?=base_url($_SERVER['REQUEST_URI']) == base_url("admin/hotspot_users")?'<span class="selected"></span>':''?>
                            </a>
                        </li>
                    <?php endif; ?>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
				<div class="page-content">
					<?php echo $content?>
				</div>
			</div>
		
        <!-- footer content -->
        <div class="page-footer">
            <div class="page-footer-inner"> 2014 &copy; Metronic by keenthemes.
                <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
            </div>
            <div class="scroll-to-top">
                <i class="icon-arrow-up"></i>
            </div>
        </div>
        <!-- /footer content -->
      </div>
      <!-- /page content -->

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  <!-- END FOOTER -->
        <!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
	<!-- BEGIN CORE PLUGINS -->
<!--	<script src="<?=base_url()?>assets/linefi/plugins/jquery.min.js" type="text/javascript"></script>	-->
	<script src="<?=base_url()?>assets/linefi/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>assets/linefi/plugins/js.cookie.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>assets/linefi/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>assets/linefi/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>assets/linefi/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>assets/linefi/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<script src="<?=base_url()?>assets/linefi/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
	<script src="<?=base_url()?>assets/linefi/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN THEME GLOBAL SCRIPTS -->
	<script src="<?=base_url()?>assets/linefi/scripts/app.min.js" type="text/javascript"></script>
	<!-- END THEME GLOBAL SCRIPTS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<script src="<?=base_url()?>assets/linefi/pages/scripts/ui-extended-modals.min.js" type="text/javascript"></script>
	<!-- END PAGE LEVEL SCRIPTS -->
	<!-- BEGIN THEME LAYOUT SCRIPTS -->
	<script src="<?=base_url()?>assets/linefi/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>assets/linefi/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
	<script src="<?=base_url()?>assets/linefi/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
	<!-- END THEME LAYOUT SCRIPTS -->
	
  <script src="<?=base_url()?>assets/theme/js/alert.js"></script>

  <!-- bootstrap progress js -->
  <script src="<?=base_url()?>assets/theme/js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="<?=base_url()?>assets/theme/js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- icheck -->
  <script src="<?=base_url()?>assets/theme/js/icheck/icheck.min.js"></script>
  <!-- daterangepicker -->
  <script type="text/javascript" src="<?=base_url()?>assets/theme/js/moment/moment.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/theme/js/datepicker/daterangepicker.js"></script>

  <script src="<?=base_url()?>assets/theme/js/custom.js"></script>

  <!-- flot js -->
  <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
  <script type="text/javascript" src="<?=base_url()?>assets/theme/js/flot/jquery.flot.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/theme/js/flot/jquery.flot.pie.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/theme/js/flot/jquery.flot.orderBars.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/theme/js/flot/jquery.flot.time.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/theme/js/flot/date.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/theme/js/flot/jquery.flot.spline.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/theme/js/flot/jquery.flot.stack.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/theme/js/flot/curvedLines.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/theme/js/flot/jquery.flot.resize.js"></script>
  <!-- worldmap -->
  <script type="text/javascript" src="<?=base_url()?>assets/theme/js/maps/jquery-jvectormap-2.0.3.min.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/theme/js/maps/gdp-data.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/theme/js/maps/jquery-jvectormap-world-mill-en.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/theme/js/maps/jquery-jvectormap-us-aea-en.js"></script>
  <!-- skycons -->
  <script src="<?=base_url()?>assets/theme/js/skycons/skycons.min.js"></script>

  <!-- /footer content -->
</body>

</html>
