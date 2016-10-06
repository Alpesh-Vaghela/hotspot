<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <title>LineFi Giriş</title>
    <meta name="description" content="">
    <meta name="author" content="LineFi">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--STYLESHEETS-->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="/assets/css/style.css" />
    <!--GOOGLE FONTS CODE-->
    <link rel="stylesheet" href="/assets/css/font-awesome.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <!-- Enable this css if you want to override styles-->
    <!--<link href="css/override.css" rel="stylesheet" media="screen">-->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--FAVICON & APPLE ICONS-->
    <link rel="apple-touch-icon" sizes="57x57" href="/assets/icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/assets/icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/assets/icon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/assets/icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/icon/favicon-16x16.png">
    <link rel="manifest" href="/assets/icon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/assets/icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!--SCRIPTS-->
    <script type="text/javascript" src="/assets/js/modernizr-1.0.min.js"></script>

</head>
<body>
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

$divcount = 0;
$w = '';
foreach ($sociallinks as $s => $k) {
    if ($k) {
        $divcount++;
    }
}
switch ($divcount) {
    case 1:
        $w = 100/1;
        break;

    case 2:
        $w = 100/2;
        break;
    case 3:
        $w = 100/3;
        $z = '0';
        break;
    case 4:
        $w = '50';
        break;
    case 5:
        $w = '50';
        break;

    default :
        $w=100/3;

        break;



}

$topcolor = $kampanya->topcolor;
$toplogo = $kampanya->logo;
$ad_name_color = $kampanya->ad_name_color;
$ad_name = $kampanya->ad_name;
$ad_name_description_color = $kampanya->ad_name_description_color;

$ad_description_bg = $kampanya->ad_description_bg;
$ad_name_description =$kampanya->ad_description;
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
<div id="main" class="container">
    <div id="wrapper">
        <header class="clearfix" style="background-color: #<?php echo $topcolor; ?>;">
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-9">

                    <h3 class="brand"><a href="" title="">


                            <img class="img-responsive2" src="<?php echo $toplogo; ?>"
                                 alt="Brand Logo"></a>

                    </h3>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <h3 class="linefi"><a href="http://www.linefi.com"><img src="/assets/img/linefi-logo.png"
                                                                            class="img-responsive2" alt="LineFi"
                                                                            style="float: right;"></a></h3>
                </div>
            </div>
            <!--end-of-row-->
        </header>
        <article>
            <!-- Tab panes -->
            <div class="tab-content-wrapper">
                <div class="tb-content" id="home"
                     style="background-image: url('<?php echo $ad_description_bg; ?>');">
                    <div class="box home">
                        <div class="home-box">

                            <h4 style=" color: #<?php echo $kampanya->ad_name_color; ?>; margin-bottom: 0px; "><?php echo $ad_name; ?></h4>

                            <h3 style=" color: #<?php echo $kampanya->ad_name_description_color; ?>; margin-bottom: 0px; "><?php echo $ad_name_description; ?></h3>

                            <p style=" color:#<?php echo $kampanya->ad_name_description_color; ?> ; margin-top: 0px; ">
                                Ücretsiz İnternete Bağlanın</p>
                        </div>
                    </div>
                </div>
                <!--end-of-tab-content-->
                <!-- free connection -->
                <div class="tb-content" id="free">
                    <div class="box freeConnection">
                        <div class="box1-content">
                            <div class="badges"><img src="/assets/img/R1.png"></div>
                            <h2 class="heading">Hoşgeldiniz</h2>

                            <p class="message">Hesabınıza Giriş yaparak internete bağlanın.</p>

                            <p class="terms">LineFi <a href="terms.html">Hizmet Şartları</a>'nı kabul ediyorum.</p>
                        </div>
                    </div>

                    <form method="post" id="login" name="login" action="http://<?php echo $nasbilgi->nas_ip ?>/login">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="text" name="username" class="form-control" id="" placeholder="Kullanıcı Adınız">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="password" name="password" class="form-control" id="" placeholder="Şifreniz">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="submit" name="" class="btn btn-default" id="" value="Giriş Yap" >

                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- free connection -->
                <!-- sms connection -->

                <div class="tb-content" id="sms">
                    <div class="box freeConnection">
                        <div class="box1-content">
                            <div class="badges"><img src="/assets/img/R1.png"></div>
                            <h2 class="heading">Hoşgeldiniz</h2>

                            <p class="message"> Cep telefonunuza kullanıcı adı ve şifre göndereceğiz. Cep telefon
                                numaranızı başında 0 olmadan yazınız.</p>

                            <p class="terms">LineFi <a href="terms.html">Hizmet Şartları</a>'nı kabul ediyorum.</p>
                        </div>
                    </div>

                    <div class="form-dark">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="options-wrapper">
                                    <form method="post" action="" name="sms_gonder" id="sms_gonder">
                                        <div class="option-step option-step-active">

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <input type="text" id="sms_ad" name="sms_ad"
                                                               class="form-control" placeholder="Adınız" required="required"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <input type="text" id="sms_soyad" name="sms_soyad"
                                                               class="form-control" placeholder="Soyadınız" required="required"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <input type="text" id="sms_telefon" name="sms_telefon"
                                                               class="form-control" placeholder="530 xxx xx xx" required="required"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <button id="sendsms" type="submit"
                                                                class="btn btn-default option-toggle"
                                                                data-option="#option-2"> <i class="fa fa-envelope-o"></i>
                                                            Mesaj Gönder</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form method="post" action="http://<?php echo $nasbilgi->nas_ip; ?>/login" id="giris_yap">
                                        <div class="option option-step" id="option-2">
                                            <p class="message">Cep telefonunuza gelen kullanıcı adı ve şifre ile
                                                giriş yapınız.</p>
                                            <!--<div class="alert alert-danger">
                                              Please check the <strong>password</strong> which we sent you and try again.
                                            </div>-->
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <input type="" class="form-control" id="inputPassword3"
                                                               placeholder="Kullanıc Adı"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <input type="" class="form-control" id="inputPassword3"
                                                               placeholder="Şifre"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <a class="btn btn-default option-close back"
                                                           href="javascript:;"><i
                                                                class="fa fa-chevron-circle-left"></i> Geri</a>
                                                        <input type="submit" name="" class="btn btn-default" id=""
                                                               value="Giriş Yap">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <!-- sms connection -->
                <!-- kimlik connection -->
                <div class="tb-content" id="kimlik">
                    <div class="box freeConnection">
                        <div class="box1-content">
                            <div class="badges"><img src="/assets/img/R1.png"></div>
                            <h2 class="heading">Hoşgeldiniz</h2>

                            <p class="message">Lütfen aşağıdaki formu nüfus cüzdanınızdaki gibi doldurunuz. Eğer
                                kimlik bilgileriniz onaylanırsa sisteme otomatik giriş yapacaksınız.</p>

                            <p class="terms">LineFi <a href="terms.html">Hizmet Şartları</a>'nı kabul ediyorum.</p>
                        </div>
                        <form method="post" name="kimlik" id="kimlik" action="/hauth/tckimlik?" class="form-dark">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" id="kimlik_no" name="kimlik_no"
                                                       class="form-control"
                                                       placeholder="TC Kimlik No">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" id="kimlik_ad" name="kimlik_ad"
                                                       class="form-control"
                                                       placeholder="Adınız">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" id="kimlik_soyad" class="form-control"
                                                       name="kimlik_soyad"
                                                       placeholder="Soyadınız">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input type="text" id="kimlik_dogumtarihi" class="form-control"
                                                       name="kimlik_dogumtarihi"
                                                       placeholder="Doğum Tarihi">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="submit" name="" class="btn btn-default" id=""
                                                   value="Giriş Yap">
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </form>
                        <form method="post" action="http://192.168.82.1/login" id="giris_yap">
                            <div class="option option-step" id="option-2">
                                <p class="message">Cep telefonunuza gelen kullanıcı adı ve şifre ile
                                    giriş yapınız.</p>
                                <!--<div class="alert alert-danger">
                                  Please check the <strong>password</strong> which we sent you and try again.
                                </div>-->
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="" id="tc_username" class="form-control" id="inputPassword3"
                                                   placeholder="Kullanıc Adı"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="" id="tcpassword" class="form-control" id="inputPassword3"
                                                   placeholder="Şifre"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a class="btn btn-default option-close back"
                                               href="javascript:;"><i
                                                    class="fa fa-chevron-circle-left"></i> Geri</a>
                                            <input type="submit" name="" class="btn btn-default" id=""
                                                   value="Giriş Yap">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- twitter connection -->
                <div class="tb-content" id="twitter">
                    <div class="box freeConnection">
                        <div class="box1-content">
                            <div class="badges"><img src="/assets/img/R1.png"></div>
                            <h2 class="heading">Hoşgeldiniz</h2>

                            <p class="message">Twitter hesabınız ile giriş yap, internete bağlan.</p>

                            <p class="terms">LineFi <a href="terms.html">Hizmet Şartları</a>'nı kabul ediyorum.</p>
                        </div>
                        <form id="contact-form" method="post" action="" class="form-dark">
                            <div class="field-wrapper">
                                <div class="row margin-bottom-20">
                                    <div class="col-md-12 form-row">
                                        <a class="btn btn-default" href="/hauth/login/Twitter" role="button"> <i
                                                class="fa fa-twitter-square"></i> Twitter ile Giriş yap</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- twitter connection -->
                <!-- facebook connection -->
                <div class="tb-content" id="facebook">
                    <div class="box freeConnection">
                        <div class="box1-content">
                            <div class="badges"><img src="/assets/img/R1.png"></div>
                            <h2 class="heading">Hoşgeldiniz</h2>

                            <p class="message">Facebook hesabınızla internete giriş yap.</p>

                            <p class="terms">LineFi <a href="terms.html">Hizmet Şartları</a>'nı kabul ediyorum.</p>
                        </div>

                        <div class="field-wrapper">
                            <div class="row margin-bottom-20">
                                <div class="col-md-12 form-row">

                                    <a  class="btn btn-default" href="/hauth/login/Facebook" role="button"> <i
                                            class="fa fa-facebook-square"></i> Facebook ile Giriş Yap</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- facebook connection -->
                <!-- instagram connection -->
                <div class="tb-content" id="instagram">
                    <div class="box freeConnection">
                        <div class="box1-content">
                            <div class="badges"><img src="/assets/img/R1.png"></div>
                            <h2 class="heading">Hoşgeldiniz</h2>

                            <p class="message">Instagram hesabınızla internete giriş yap.</p>

                            <p class="terms">LineFi <a href="terms.html">Hizmet Şartları</a>'nı kabul ediyorum.</p>
                        </div>
                        <form id="contact-form" method="post" action="" class="form-dark">
                            <div class="field-wrapper">
                                <div class="row margin-bottom-20">
                                    <div class="col-md-12 form-row">
                                        <a class="btn btn-default" href="/hauth/login/Instagram" role="button"> <i
                                                class="fa fa-instagram"></i> Instagram ile Giriş Yap </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- instagram connection -->

                <!--Feature Development-->
                <!-- twitter connection -->
                <div class="tb-content" id="voucher">
                    <div class="box freeConnection">
                        <div class="box1-content">
                            <div class="badges"><img src="/assets/img/R1.png"></div>
                            <h2 class="heading">Hoşgeldiniz</h2>

                            <p class="message">Swarm'da check in yap, internete bağlan.</p>

                            <p class="terms">LineFi <a href="terms.html">Hizmet Şartları</a>'nı kabul ediyorum.</p>
                        </div>
                        <form id="contact-form" method="post" action="" class="form-dark">
                            <div class="field-wrapper">
                                <div class="row margin-bottom-20">
                                    <div class="col-md-12 form-row">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="text" name="vouchernumber" class="form-control" id="vouchernumber" placeholder="Lütfen Voucher Numaranızı Giriniz">
                                                </div></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">

                                                    <a class="btn btn-default" href="?network=voucher" role="button"> <i
                                                            class="fa fa-ticket"></i> Voucher Girişi</a>
                                                </div></div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- twitter connection -->
                <!-- subscribe connection -->
                <div class="tb-content" id="subscribe">
                    <div class="box freeConnection">
                        <div class="box1-content">
                            <div class="badges"><img src="/assets/img/R1.png"></div>
                            <h2 class="heading">Hoşgeldiniz</h2>

                            <p class="message">Hesabınıza Giriş yaparak internete bağlanın.</p>

                            <p class="terms">LineFi <a href="terms.html">Hizmet Şartları</a>'nı kabul ediyorum.</p>
                        </div>
                        <form class="" role="form">
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active"><a data-toggle="tab" href="#signin">Sign In</a></li>
                                <li><a data-toggle="tab" href="#signup">Sign Up</a></li>
                            </ul>
                            <div class="tab-content" style="margin-top:20px">
                                <div id="signin" class="tab-pane fade in active">
                                    <div class="alert alert-danger">
                                        The <strong>username</strong> and <strong>password</strong> do not match.
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12"><input type="" class="form-control" id=""
                                                                          placeholder="Username"/></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12"><input type="" class="form-control" id=""
                                                                          placeholder="PassWord"/></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-default"><i class="fa fa-user"></i>
                                                Sign In
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div id="signup" class="tab-pane fade">
                                    <div class="alert alert-danger">
                                        Please enter a valid phone number. Such as <strong>+90 532 123 45
                                            67</strong>
                                    </div>
                                    <div class="alert alert-danger">
                                        This username is already taken!
                                    </div>
                                    <div class="alert alert-danger">
                                        Password must be at least 6 characters.
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-12 form-label" for="email">Name</label>

                                        <div class="row">
                                            <div class="col-sm-12"><input type="" class="form-control" id=""
                                                                          placeholder="Name"/></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-12 form-label" for="email">Phone
                                            number</label>

                                        <div class="row">
                                            <div class="col-sm-12"><input type="" class="form-control" id=""
                                                                          placeholder="+90"/></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-12 form-label" for="email">Email
                                            Adress</label>

                                        <div class="row">
                                            <div class="col-sm-12"><input type="" class="form-control" id=""
                                                                          placeholder="Email Address"/></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-12 form-label"
                                               for="email">Username</label>

                                        <div class="row">
                                            <div class="col-sm-12"><input type="" class="form-control" id=""
                                                                          placeholder=""/></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-12 form-label"
                                               for="email">Password</label>

                                        <div class="row">
                                            <div class="col-sm-12"><input type="" class="form-control" id=""
                                                                          placeholder="Password "/></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-default"><i
                                                        class="fa fa-user"></i> Sign Up
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- subscribe connection -->


            </div>
            <!--end-of-tab-content-->
        </article>
        <footer>
            <!-- tabs -->
            <ul class="tabs clearfix">
                <?php if ($normal) { ?>
                    <li class="free-login" style="width: <?php echo $w+$z.'%'; ?>"><a href="#free" data-toggle="tab"
                                                                                      title=""><i class="fa fa-wifi"></i>
                            Giriş
                            Yap </a></li>
                <?php }; ?>
                <?php if ($sms) { ?>
                    <li class="sms" style="width: <?php echo $w+$z.'%'; ?>"><a href="#sms" data-toggle="tab" title=""><i
                                class="fa fa-envelope"></i> SMS</a>
                    </li>
                <?php }; ?>
                <?php if ($tckimlik) { ?>
                    <li class="kimlik" style="width: <?php echo $w+$z.'%'; ?>"><a href="#kimlik" data-toggle="tab"
                                                                                  title=""><i class="fa fa-user"></i> TC
                            Kimlik</a>
                    </li>
                <?php }; ?>

                <?php if ($twitter) {


                    ?>
                    <li class="twitter" style="width: <?php echo $w+$z.'%'; ?>"><a href="#twitter" data-toggle="tab"
                                                                                   title=""><i
                                class="fa fa-twitter-square"></i> Twitter</a></li>
                    <?php
                } ?>
                <?php if ($facebook) {


                    ?>
                    <li class="facebook" style="width: <?php echo $w+$z.'%'; ?>"><a href="#facebook" data-toggle="tab"
                                                                                    title=""><i
                                class="fa fa-facebook-square"></i> Facebook</a></li>
                <?php } ?>

                <?php if ($instagram) { ?>
                    <li class="instagram" style="width: <?php echo $w+$z.'%'; ?>"><a href="#instagram" data-toggle="tab"
                                                                                     title=""><i
                                class="fa fa-instagram"></i> Instagram</a></li>
                <?php } ?>
                <?php if ($voucher) { ?>
                    <li class="swarm"><a href="#voucher" data-toggle="tab" title=""><i class="fa fa-ticket"></i> Voucher</a></li>
                <?php } ?>
            </ul>
        </footer>
        <p class="footer-help">Destek Merkezi <a href="http://www.linefi.com">www.linefi.com</a></p>
    </div>
    <!--end-of-wrapper-->
</div>
<!--end-of-container-->
<!--SCRIPTS-->
<script src="/assets/js/jquery.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/placeholders.js"></script>
<script src="/assets/js/jquery.validate.min.js"></script>
<script src="/assets/js/messages.js"></script>
<script src="/assets/js/custom.js"></script>
<script src="/assets/js/retina.min.js"></script>

</body>
</html>