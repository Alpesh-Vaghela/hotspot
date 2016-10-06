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
if (empty($ad_name_description)) {
    $ad_name_description = "Ücretsiz İnternet'in Keyfini Çıkarın";

}


?>

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LineFi Login</title>
    <meta name="description" content="Wireless Advertising Platform" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="/assets/favicon.ico">

    <script type="text/javascript" src="/assets/js/jquery.js"></script>
    <script type="text/javascript" src="/assets/js/jquery.parallaxify.min.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/assets/js/modernizr-custom.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/component.css" />
    

</head>

<body>
<!-- navigation -->

<!-- /navigation-->
<!-- pages stack -->
<div class="pages-stack">
    <!-- page -->
    <div class="page" id="home">
        <div class="carousel slide">
            <div class="carousel-inner">
                <div class="item active">
                    <div data-parallaxify-range-x="50" data-parallaxify-range-y="50" class="fill" style="background-image:url('/assets/uploads/error-404.jpg');"></div>
                    <div class="main home">
                        <div class="header">
                            <div class="linefi-badge"><img src="/assets/uploads/app-logo.svg" class="img-responsive center-block"  style="border:none;border-radius: inherit">
                                </div>
                            <h1>Üzgünüz</h1>
                            <h3><strong>404</strong> Kere Aradık</h3>
                            <h4>Aradığınız Sayfayı Bulunamadık.</h4>
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-4">
                                    <form role="form">
                                        <div class="form-group">
                                            <div class="col-sm-12 col-xs-10 center-block">
                                                <a href="http://www.linefi.com" class="btn">
                                                    <i class="fa fa-star"></i> | Keşfet</a>
                                            </div>
                                        </div>
                                    </form>
                                </div><!-- /.col-lg-4 -->
                            </div><!-- /.row -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /navigation -->

<script type="text/javascript" src="/assets/js/classie.js"></script>
<script type="text/javascript" src="/assets/js/main.js"></script>
<script type="text/javascript">
    $(function(){
        $(document).ready(function() {
            $('.carousel').carousel({
                interval: 5000 //changes the speed
            });
            $.parallaxify({
                parallaxBackgrounds: true,
                parallaxElements: true,
                positionProperty: 'transform',
                responsive: true,
                motionType: 'natural',
                mouseMotionType: 'performance',
                motionAngleX: 70,
                motionAngleY: 70,
                alphaFilter: 0.5,
                adjustBasePosition: true,
                alphaPosition: 0.025,
            });
        });
    });
</script>
</body>
</html>