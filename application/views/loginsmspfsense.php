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
    <link rel="stylesheet" type="text/css" href="/assets/css/demo.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/component.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/custom.css" />

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
                    <div data-parallaxify-range-x="50" data-parallaxify-range-y="50" class="fill" style="background-image:url('<?php echo $ad_description_bg; ?>');"></div>
                    <div class="main">
                        <div class="header">
                            <h1 style="color:#<?php echo $ad_name_color; ?>"><?php echo $ad_name; ?></h1>
                            <h3 style="color:#<?php echo $ad_name_description_color; ?>"><?php echo $ad_name_description; ?></h3>
                            <h4 style="color:#<?php echo $ad_name_description_color; ?>">Cep telefonunuza kullanıcı adı ve şifre göndereceğiz. <br>Cep telefon numaranızı başında 0 olmadan yazınız.</h4>

                            <p class="terms">LineFi <a href="/terms.html">Hizmet Şartları</a>'nı kabul ediyorum.</p>
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-4 ">
								<? if($pfsense) {  ?>
                                    <form action="http://<?=$cihaztipi->nas_ip?>" method="post" id="redirectform">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12 col-xs-10 center-block">
                                                    <input type="text" name="auth_user" class="form-control" id="auth_user"
                                                           placeholder="Kullanıcı Adınız"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12 col-xs-10 center-block">
                                                    <input type="password" name="auth_pass" class="form-control" id=""
                                                           placeholder="Şifreniz"></div>
                                                <input type="hidden" name="accept" value="Continue">
                                                <input type="hidden" name="zone" value="linefi">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12 col-xs-10 center-block">
                                                <input type="submit" name="accept" class="btn btn-default" id=""
                                                       value="Giriş Yap">
                                            </div>
                                        </div>
										<input name="redirurl" type="hidden" value="" id="auth_proxy">
										<script>
											$("#auth_user").keyup(function() {
												$("#auth_proxy").val("http://hotspot.linefi.net/welcome/status/<?=$cihaztipi->location_name?>?user="+$(this).val());
											});
											$("#auth_user").change(function() {
												$("#auth_proxy").val("http://hotspot.linefi.net/welcome/status/<?=$cihaztipi->location_name?>?user="+$(this).val());
											});
										</script>
                                    </form>
								<? } else { ?>
                                    <form role="form" action="http://<?php echo $tip->nas_ip ?>/login"
                                          method="post">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12 col-xs-10 center-block">
                                                    <input type="text" name="auth_user" class="form-control" id=""
                                                           placeholder="Kullanıcı Adınız"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12 col-xs-10 center-block">
                                                    <input type="password" name="auth_pass" class="form-control" id=""
                                                           placeholder="Şifreniz"></div>
                                                <input type="hidden" name="accept" value="Continue">
                                                <input type="hidden" name="zone" value="linefi">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12 col-xs-10 center-block">
                                                <input type="submit" name="" class="btn btn-default" id=""
                                                       value="Giriş Yap">
                                            </div>
                                        </div>
                                    </form>
								<? } ?>
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
<nav class="navbar navbar-inverse navbar-fixed-top" style="background-color:#<?php echo $topcolor; ?>">
    <div class="container">
        <a class="navbar-brand navbar-left" href="#"><img src="<?php echo $toplogo; ?>" alt="<?php echo $ad_name; ?>"/></a>
        <a class="navbar-linefi navbar-right" href="#"><img src="/assets/img/linefi-logo.png" alt="LineFi"/></a>
    </div>
</nav>
<script type="text/javascript" src="/assets/js/classie.js"></script>

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