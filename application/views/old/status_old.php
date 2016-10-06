<?php
/*
 * CREATE TABLE `test` (

 `test`
 PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=

$sql = "CREATE TABLE `twitter_profiles` ( `id` int(11) NOT NULL AUTO_INCREMENT,";
foreach ($user_profile as $row => $key ) {
    $sql .= "`$row` varchar(255) CHARACTER SET utf8  NULL,";
}
$sql.=" PRIMARY KEY (`id`)";
$sql .= ");";
echo $sql;

 */
var_dump($user_profile);
?>


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
                <div class="tb-content" id="home">
                    <div class="box freeConnection">
                        <div class="badges"><img src="img/R1.png"></div>
                        <h2 class="heading">Merhaba Emin!</h2>
                        <h3 class="subheading">Ücretsiz internetin keyfini çıkartın.</h3>
                        <p class="message">Şuan <strong>"Location Name"</strong> kablosuz ağına bağlısınız.</p>

                    </div>
                    <form id="contact-form" method="post" action="" class="form-dark">
                        <div class="field-wrapper">
                            <div class="row">
                                <div class="col-md-12 form-row">
                                    <a class="btn btn-default" href="http://www.google.com" role="button"> <i class="fa fa-google"></i> Google Search </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!--end-of-tab-content-->

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
