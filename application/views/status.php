<?php
/**
 * Created by PhpStorm.
 * User: eminnasirov
 * Date: 13.03.2016
 * Time: 15:37
 */

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

$topcolor = $kampanya->topcolor;
$toplogo = $kampanya->logo;
$ad_name_color = $kampanya->ad_name_color;
$ad_name = $kampanya->ad_name;
$ad_name_description_color = $kampanya->ad_name_description_color;
$ad_description_bg = $kampanya->ad_description_bg;
$ad_name_description = $kampanya->ad_description;
$website_url = $kampanya->website_url;

if (empty($topcolor)) {
    $topcolor = '000000';

}


if (empty($toplogo)) {
    $toplogo = "/assets/img/linefi-logo.png";

} else {
    $toplogo = 'http://app.linefi.com/modules/servers/linefimodule/lib/uploads/' . $kampanya->logo;
}

if (empty($ad_description_bg)) {
    $ad_description_bg = '/assets/img/bgBodyCoffee.jpg';
} else {
    $ad_description_bg = 'http://app.linefi.com/modules/servers/linefimodule/lib/uploads/' . $kampanya->ad_description_bg;
}
if (empty($ad_name)) {
    $ad_name = "LineFi'ye Hoş Geldiniz";
} else {
    $ad_name = $kampanya->ad_name;
}
if (empty($website_url)) {
    $website_url = "http://www.linefi.com";
} else {
    $website_url = $kampanya->website_url;
}
if (empty($ad_name_description)) {
    $ad_name_description = "Ücretsiz İnternet'in Keyfini Çıkarın";
}


?>

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
<link rel="shortcut icon" href="images/favicon.ico">
<meta property="og:site_name" content="LineFi">
<meta content="website" property="og:type">
<title>LineFi Login</title>
<link href="/assets/app/css/bootstrap.min.css" rel="stylesheet">
<link href="/assets/app/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="/assets/app/css/jquery.maximage.min.css" rel="stylesheet">
<link href="/assets/app/css/style.css" rel="stylesheet">
<link href="/assets/app/css/slider.css" rel="stylesheet">
<link href="/assets/app/css/app.css" rel="stylesheet" >
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="/assets/app/js/modernizr.custom.25376.js"></script>
<style>
.loading { position: absolute; left: 50%; top: 50%; margin: -60px 0 0 -50px; background: #ffffff url("/assets/app/images/app-logo-bw.svg") no-repeat center center;width: 100px; height: 100px; border-radius: 100%; border: 10px solid #19bee1; }
.loading:after { content: ''; background: trasparent; width: 140%; height: 140%; position: absolute; border-radius: 100%; top: -20%; left: -20%; opacity: 0.7;box-shadow: rgba(255, 255, 255, 0.6) -4px -5px 3px -3px; animation: rotate 1s infinite linear; } @keyframes rotate { 0% { transform: rotateZ(0deg); } 100% { transform: rotateZ(360deg); } }
</style>
    </head>
    <body>
      <!--start header-->
        <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color:#<?php echo $topcolor; ?>">
            <div class="container">
                <a class="navbar-brand navbar-left" href="#"><img src="<?php echo $toplogo; ?>" alt="<?php echo $ad_name; ?>"/></a>
                <a class="navbar-linefi navbar-right" href="#"><img src="/assets/app/images/linefi-logo.png" alt="LineFi"></a>
                <i id="info-box-close-button" title="Close" class="menu-button fa fa-angle-double-left"> </i>
            </div>
        </nav>
        <!--end header-->

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

                               <div id="avatar">
                                 <div class="custom_profile" style="background-image: url()">
                               </div>
                             </div>
                               <div id="av-bg"></div>


                                <div id="title">
                                    <span class="h1" style="color:#<?php echo $ad_name_color; ?>">Welcome
                                      <?php
                                      if(!empty($userdata->fname))
                                      {
                                          echo $userdata->fname ." ".$userdata->lname;
                                      }
                                      else
                                      {
                                          echo $userinfo['uname'];
                                      }
                                      ?>
                                    </span>
                                </div>
                                <div id="title2">
                                    <span class="h3" style="color:#<?php echo $ad_name_description_color; ?>">Enjoy your free Wi-Fi</span>
                                </div>
                                <div id="description" style="color:#<?php echo $ad_name_description_color; ?>">Now you are connected to <strong></strong> Network.</div>
                                <a href="<?php echo $website_url; ?>" class="btn btn-danger btn-lg"><i class="fa fa-star"></i> | Discover</a>
                            </div>
                        </div>
                        <!--  end home page  -->
                    </div> <!--  end container  -->
                </div> <!--  end wrapper  -->
            </div> <!-- end pages -->


        </div> <!--  end perspective  -->
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
        <script src="/assets/app/js/bootstrap.min.js"></script>
        <script src="/assets/app/js/jquery.plugin.min.js"></script>
        <script src="/assets/app/js/classie.js"></script>
        <script src="/assets/app/js/maximage.js"></script>
        <script src="/assets/app/js/menu.js"></script>
        <script src="/assets/app/js/main.js"></script>
    </body>
</html>
