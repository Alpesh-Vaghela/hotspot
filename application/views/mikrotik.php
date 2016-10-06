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
	<script type="text/javascript" src="/assets/js/custom.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/component.css" />
	<link rel="stylesheet" type="text/css" href="/assets/css/custom.css" />

	<meta property="og:site_name" content="LineFi">
	<meta content="website" property="og:type">
	<meta content="<?=$nasbilgi->og_title?>" property="og:title">
	<meta content="http://app.linefi.com/modules/servers/linefimodule/lib/uploads/n4rnlvy8hr4k888cww.png" property="og:image">
	<meta content="<?=($nasbilgi->og_url ? $nasbilgi->og_url : 'http://hotspot.linefi.net/welcome/getlokasyon/'.$nasbilgi->shortname)?>" property="og:url">
	<meta property="og:description" content="<?=$nasbilgi->og_description?>">

</head>

<body>
<!-- navigation -->
<nav class="pages-nav">

    <?php if ($facebook == 'on') { ?>
        <div class="pages-nav__item col-xs-4 col-sm-4"><a class="link link--page" href="#facebook"><img src="/assets/uploads/facebook.png" class="img-responsive center-block" /><h5 class="icon_name">Facebook</h5></a></div>  <?php } ?>
    <?php if ($twitter == 'on') { ?>
        <div class="pages-nav__item col-xs-4 col-sm-4"><a class="link link--page" href="#twitter"><img src="/assets/uploads/twitter.png" class="img-responsive center-block" /><h5 class="icon_name">Twitter</h5></a></div><?php } ?>
    <?php if ($instagram == 'on') { ?>
        <div class="pages-nav__item col-xs-4 col-sm-4"><a class="link link--page" href="#instagram"><img src="/assets/uploads/instagram.png" class="img-responsive center-block" /><h5 class="icon_name">Instagram</h5></a></div><?php } ?>
    <?php if ($normal == 'on') { ?>
        <div class="pages-nav__item col-xs-4 col-sm-4"><a class="link link--page" href="#normal_login"><img src="/assets/uploads/normal_login.png" class="img-responsive center-block" /><h5 class="icon_name">Sign In</h5></a></div><?php } ?>
    <?php if ($sms == 'on') { ?>
        <div class="pages-nav__item col-xs-4 col-sm-4"><a class="link link--page" href="#sms"><img src="/assets/uploads/sms.png" class="img-responsive center-block" /><h5 class="icon_name">SMS Login</h5></a></div><?php } ?>
    <?php if ($tckimlik == 'on') { ?>
        <div class="pages-nav__item col-xs-4 col-sm-4"><a class="link link--page" href="#id_login"><img src="/assets/uploads/id_login.png" class="img-responsive center-block" /><h5 class="icon_name">ID Login</h5></a></div> <?php } ?>
	<?php if (true) { ?>
        <div class="pages-nav__item col-xs-4 col-sm-4"><a class="link link--page" href="#payment_login"><img src="/assets/uploads/paypal.jpg" class="img-responsive center-block" /><h5 class="icon_name">Turbo LineFi</h5></a></div> <?php } ?>
</nav>
<!-- /navigation-->
<!-- pages stack -->
<div class="pages-stack">
    <!-- page -->
    <div class="page" id="home">
        <div class="carousel slide">
            <div class="carousel-inner">
                <div class="item active">
                    <div data-parallaxify-range-x="140" class="fill" style="background-image:url('<?php echo $ad_description_bg; ?>');"></div>
                    <div class="main home">
                        <div class="header">
                            <h1 style="color:#<?php echo $ad_name_color; ?>;"><?php echo $ad_name; ?></h1>
                            <h3 style="color:#<?php echo $ad_name_description_color; ?>"><?php echo $ad_name_description; ?></h3>
                            <h4 style="color:#<?php echo $ad_name_description_color; ?>">İnternete Bağlanmak için yukarıdaki <i class="fa fa-bars"></i> butona tıklayınız.</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page" id="facebook">
        <div class="carousel slide">
            <div class="carousel-inner">
                <div class="item active">
                    <div data-parallaxify-range-x="140" class="fill"
                         style="background-image:url('<?php echo $ad_description_bg; ?>');"></div>
                    <div class="main">
                        <div class="header">
                            <h1 style="color:#<?php echo $ad_name_color; ?>"><?php echo $ad_name; ?></h1>
                            <h3 style="color:#<?php echo $ad_name_description_color; ?>"><?php echo $ad_name_description; ?></h3>
                            <h4 style="color:#<?php echo $ad_name_description_color; ?>">İnternete Bağlanmak için yukarıdaki <i class="fa fa-bars"></i> butona tıklayınız.</h4>
                            <p class="terms">LineFi <a href="/terms.html">Hizmet Şartları</a>'nı kabul ediyorum.</p>

                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-4">
                                    <form role="form">
                                        <div class="form-group">
                                            <div class="col-sm-12 col-xs-10 center-block">
												<a href="/hauth/login/Facebook?nasid=<?php echo $nasbilgi->id; ?>" class="btn btn-facebook">
													<i class="fa fa-facebook"></i> | Share</a>
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
    <div class="page" id="twitter">
        <div class="carousel slide">
            <div class="carousel-inner">
                <div class="item active">
                    <div data-parallaxify-range-x="140" class="fill"
                         style="background-image:url('<?php echo $ad_description_bg; ?>');"></div>
                    <div class="main">
                        <div class="header">

                            <h1 style="color:#<?php echo $ad_name_color; ?>"><?php echo $ad_name; ?></h1>
                            <h3 style="color:#<?php echo $ad_name_description_color; ?>"><?php echo $ad_name_description; ?></h3>
                            <h4 style="color:#<?php echo $ad_name_description_color; ?>">Twitter hesabınızla internete giriş yapınız.</h4>
                            <p class="terms">LineFi <a href="/terms.html">Hizmet Şartları</a>'nı kabul ediyorum.</p>
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-4">
                                    <form role="form">
                                        <div class="form-group">
                                            <div class="col-sm-12 col-xs-10 center-block">
                                            <a href="/hauth/login/Twitter?nasid=<?php echo $nasbilgi->id; ?>" class="btn btn-twitter">
                                                <i class="fa fa-twitter"></i> | Twitter'la Giriş Yap</a>
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
    <div class="page" id="instagram">
        <div class="carousel slide">
            <div class="carousel-inner">
                <div class="item active">
                    <div data-parallaxify-range-x="140" class="fill"
                         style="background-image:url('<?php echo $ad_description_bg; ?>');"></div>
                    <div class="main">
                        <div class="header">

                            <h1 style="color:#<?php echo $ad_name_color; ?>"><?php echo $ad_name; ?></h1>
                            <h3 style="color:#<?php echo $ad_name_description_color; ?>"><?php echo $ad_name_description; ?></h3>
                            <h4 style="color:#<?php echo $ad_name_description_color; ?>">Instagram hesabınızla internete giriş yapınız.</h4>
                            <p class="terms">LineFi <a href="/terms.html">Hizmet Şartları</a>'nı kabul ediyorum.</p>

                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-4">
                                    <form role="form">
                                        <div class="form-group">
                                            <div class="col-sm-12 col-xs-10 center-block">
                                                <a href="/hauth/login/Instagram?nasid=<?php echo $nasbilgi->id; ?>" class="btn btn-instagram">
                                                    <i class="fa fa-instagram"></i> | Instagram'la Giriş Yap</a>
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
    <div class="page" id="normal_login">
        <div class="carousel slide">
            <div class="carousel-inner">
                <div class="item active">
                    <div data-parallaxify-range-x="140" class="fill"
                         style="background-image:url('<?php echo $ad_description_bg; ?>');"></div>
                    <div class="main">
                        <div class="header">
                            <h1 style="color:#<?php echo $ad_name_color; ?>"><?php echo $ad_name; ?></h1>
                            <h3 style="color:#<?php echo $ad_name_description_color; ?>"><?php echo $ad_name_description; ?></h3>

                            <p class="terms">LineFi <a href="/terms.html">Hizmet Şartları</a>'nı kabul ediyorum.</p>
                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-4 ">



                                    <form role="form" action="http://<?php echo $nasbilgi->nas_ip ?>/login">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-xs-10 center-block">
                                                    <input type="text" name="username" class="form-control" id=""
                                                           placeholder="Kullanıcı Adınız"> </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-xs-10 center-block">
                                                    <input type="password" name="password" class="form-control" id=""
                                                           placeholder="Şifreniz"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-6 col-xs-10 center-block">
                                                <input type="submit" name="" class="btn btn-default" id="" value="Giriş Yap">
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
    <div class="page" id="sms">
        <div class="carousel slide">
            <div class="carousel-inner">
                <div class="item active">
                    <div data-parallaxify-range-x="140" class="fill"
                         style="background-image:url('<?php echo $ad_description_bg; ?>');"></div>
                    <div class="main">
                        <div class="header">
                            <h1 style="color:#<?php echo $ad_name_color; ?>"><?php echo $ad_name; ?></h1>
                            <h3 style="color:#<?php echo $ad_name_description_color; ?>"><?php echo $ad_name_description; ?></h3>
                            <h4 style="color:#<?php echo $ad_name_description_color; ?>">Cep telefonunuza kullanıcı adı
                                ve şifre göndereceğiz. <br>Cep telefon numaranızı başında 0 olmadan yazınız.</h4>

                            <p class="terms">LineFi <a href="/terms.html">Hizmet Şartları</a>'nı kabul ediyorum.</p>

                            <div class="row">
                                <div class="col-lg-4 col-lg-offset-4">
                                    <form role="form" method="post" action="/hauth/sms?nasbilgi=<?php echo $nasbilgi->shortname?>">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-xs-10 center-block">
                                                    <input type="hidden" name="nasid" id="nasid" value="<?php echo $nasbilgi->id; ?>">

                                                    <input type="text" name="kimlik_ad" class="form-control" id=""
                                                           placeholder="Adınız">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-xs-10 center-block">
                                                    <input type="text" name="kimlik_soyad" class="form-control" id=""
                                                           placeholder="Soyadınız">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-xs-10 center-block">
                                                    <input type="text" name="kimlik_cepno" class="form-control" id=""
                                                           placeholder="Telefon Numaranız">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-6 col-xs-10 center-block">
                                                <input type="submit" name="" class="btn btn-default" id="" value="SMS Gönder">

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
    <div class="page" id="id_login">
        <div class="carousel slide">
            <div class="carousel-inner">
                <div class="item active">
                    <div data-parallaxify-range-x="140" class="fill"
                         style="background-image:url('<?php echo $ad_description_bg; ?>');"></div>
                    <div class="main">
                        <div class="header">
                            <h1 style="color:#<?php echo $ad_name_color; ?>"><?php echo $ad_name; ?></h1>
                            <h3 style="color:#<?php echo $ad_name_description_color; ?>"><?php echo $ad_name_description; ?></h3>
                            <h4 style="color:#<?php echo $ad_name_description_color; ?>">Lütfen aşağıdaki formu nüfus cüzdanınızdaki gibi doldurunuz. </h4>
                            <p class="terms">LineFi <a href="/terms.html">Hizmet Şartları</a>'nı kabul ediyorum.</p>
                                <div class="row">
                                    <div class="col-lg-4 col-lg-offset-4">
                                        <form role="form" action="/hauth/tckimlik" method="post">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6 col-xs-10 center-block">
                                                        <input type="hidden" name="nasid" id="nasid" value="<?php echo $nasbilgi->id; ?>">
                                                        <input type="text" id="kimlik_no" name="kimlik_no" class="form-control"
                                                               placeholder="TC Kimlik No">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6 col-xs-10 center-block">
                                                        <input type="text" id="kimlik_ad" name="kimlik_ad" class="form-control"
                                                               placeholder="Adınız">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6 col-xs-10 center-block">
                                                        <input type="text" id="kimlik_soyad" class="form-control"
                                                               name="kimlik_soyad" placeholder="Soyadınız">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6 col-xs-10 center-block">
                                                        <input type="text" id="kimlik_dogumtarihi" class="form-control"
                                                               name="kimlik_dogumtarihi" placeholder="Doğum Tarihi">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-6 col-xs-10 center-block">
                                                    <input type="submit" name="" class="btn btn-default" id="" value="Giriş Yap">
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
	<div class="page" id="payment_login">
		<div class="carousel slide">
            <div class="carousel-inner">
                <div class="item active">
                    <div data-parallaxify-range-x="140" class="fill"
                         style="background-image:url('<?php echo $ad_description_bg; ?>');"></div>
                    <div class="main">
                        <div class="header">
                            <h1 style="color:#<?php echo $ad_name_color; ?>"><?php echo $ad_name; ?></h1>

                            <h3 style="color:#<?php echo $ad_name_description_color; ?>"><?php echo $ad_name_description; ?></h3>
                            <h4 style="color:#<?php echo $ad_name_description_color; ?>">Bir tarife planı seçin.<br> 
							Ödeme sonra size giriş için bir kullanıcı adı ve parola verir.</h4>

                            <p class="terms">LineFi <a href="/terms.html">Hizmet Şartları</a>'nı kabul ediyorum.</p>

                            <div class="plans-container row">
                                <div class="col-lg-4 col-lg-offset-4">
									<?php foreach ($locaction_plans as $plan):?>
										<div class="plan-button-wrapper">
											<div class="plan-select-btn btn btn-default" data-plan-id="<?=$plan->id?>"><?=$plan->title?></div>
										</div>
									<?php endforeach?>
									
                                </div><!-- /.col-lg-4 -->
                            </div><!-- /.row -->
							
							<div class="payment-container row" style="display:none">
								<div class="plan-title"></div>
								<div class="payment-form-wrapper">
									<form id="paypal-form" name="Paypal" target="" style="text-align:center;" action="https://www.sandbox.paypal.com/ru/cgi-bin/merchantpaymentweb">
										<input type="hidden" name="cmd" value="_xclick">
										<input type="hidden" name="business" value="rustam.r.zaripov-facilitator@gmail.com">
										<input type="hidden" name="item_name" value="">
										<input type="hidden" name="amount" value="">
										<input type="hidden" name="currency_code" value="EUR">
										<input type="hidden" name="charset" value="utf-8">
										<input type="hidden" name="no_shipping" value="1">
										<input type="hidden" name="no_note" value="">
										<input type="hidden" name="rm" value="2">
										<input type="hidden" name="return" value="<?=base_url(). "hauth/paypal_callback/{$nasbilgi->id}?status=success"?>">
										<input type="hidden" name="cancel_return" value="<?=base_url(). "welcome/getlokasyon/{$nasbilgi->shortname}"?>">
										<div class="col-lg-4 col-lg-offset-4 payment-btn-block">
											<input type="submit" class="paybutton btn" value="Paypal Payment">
											<div class="return-btn btn btn-default ">Return</div>
										</div>
									</form>
								</div>

							</div>
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
        <button class="menu-button"><span>Menu</span></button>
        <a class="navbar-linefi navbar-right" href="#"><img src="/assets/img/linefi-logo.png" alt="LineFi"/></a>
    </div>
</nav>
<script type="text/javascript">
	<?php if (isset($_GET['show_login_form'])) echo 'var show_login_form=true;'; ?>
</script>
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