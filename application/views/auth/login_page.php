<!DOCTYPE html>
<html>
    <head>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/linefi/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/linefi/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/linefi/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/linefi/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
         
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="<?=base_url()?>assets/linefi/pages/css/pricing.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/linefi/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?=base_url()?>assets/linefi/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?=base_url()?>assets/linefi/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?=base_url()?>assets/linefi/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/linefi/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?=base_url()?>assets/linefi/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->


        <link href="<?=base_url()?>assets/linefi/pages/css/login.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/linefi/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">

        <script src="<?=base_url()?>assets/linefi/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/linefi/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

        <script>const base_url = '<?=base_url()?>';</script>

        <title>Admin Sign In</title>

    </head>

    <body class="login">
            <!-- BEGIN LOGO -->
            <div class="logo">
                <a href="#">
                    <img src="<?=base_url()?>assets/theme/images/logo.svg" height="100px" alt=""> 
                </a>
            </div>
            <!-- END LOGO -->
            
            <div class="content">
                <!-- BEGIN LOGIN FORM -->
                <form class="login-form" method="post">
                    <h3 class="form-title font-green">Sign In</h3>
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        <span> Enter any username and password. </span>
                    </div>
                    <div class="form-group">
                        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                        <label class="control-label visible-ie8 visible-ie9">Username</label>
                        <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="identity" /> </div>
                    <div class="form-group">
                        <label class="control-label visible-ie8 visible-ie9">Password</label>
                        <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" /> </div>
                    <div class="form-actions">
                        <button type="submit" class="btn green uppercase">Login</button>
                        <label class="rememberme check">
                            <input type="checkbox" name="remember" value="1" />Remember </label>
                    </div>
                </form>
                <!-- END LOGIN FORM -->
        </div>
    </body>
</html>