

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
<link rel="shortcut icon" href="<?= base_url() ?>assets/favicon.ico" />
<meta property="og:site_name" content="LineFi" />
<meta content="website" property="og:type" />
<title>LineFi Login</title>
<link href="<?= base_url() ?>assets/app/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/app/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/app/css/jquery.maximage.min.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/app/css/style.css" rel="stylesheet" />
<link href="<?= base_url() ?>assets/app/css/intlTelInput.css" rel="stylesheet" />
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="/assets/app/js/modernizr.custom.25376.js"></script>
<style>
.loading { position: absolute; left: 50%; top: 50%; margin: -60px 0 0 -50px; background: #ffffff url("<?= base_url() ?>assets/app/images/app-logo-bw.svg") no-repeat center center;
    width: 100px; height: 100px; border-radius: 100%; border: 10px solid #19bee1; }
.loading:after { content: ''; background: trasparent; width: 140%; height: 140%; position: absolute; border-radius: 100%; top: -20%; left: -20%; opacity: 0.7;
    box-shadow: rgba(255, 255, 255, 0.6) -4px -5px 3px -3px; animation: rotate 1s infinite linear; }
@keyframes rotate { 0% { transform: rotateZ(0deg); } 100% { transform: rotateZ(360deg); } }
</style>

</head>
<body>
<style>
    html,body{
        display: inline-block;
            overflow: hidden;
    }
    .wh{
        width:100%;
        height:100%;
    }

    .videoWrap{
        margin-top:0;
        padding-top:50px;
    }
    .video img{
        max-height: 100%;
        max-width: 100%;
    }
    
.iimg{
    width: 100%;
    height: 100%;
    background-repeat: no-repeat;
    background-position: 50%;
    background-size: contain;
}
</style>
        <!--start header-->
        <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color:#20272f">
            <div class="container">
                <a class="navbar-brand navbar-left" href="#"><img src="/assets/app/images/palmarina.png" alt=""/></a>
                <a class="navbar-linefi navbar-right" href="#"><img src="/assets/app/images/linefi-logo.png" alt="LineFi"></a>
                <div class="custom-timer" style="position: absolute; left: 50%;margin-left: -62px;top: 29%;">
                    <div class="timer" style=" display: inline; "><?=(($video->file_type == 'video/mp4')?$video->length:'30')?></div> Saniye bekleyiniz.</div>
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

                <img src="/assets/app/images/bg3.jpg" alt="">
            </div>
        </div>
        <!--start slider-->
        <div id="perspective" class="perspective effect-airbnb wh">
            <div id="pages" class="dynasty-pages wh">
                <div id="wrapper" class="wh">
                    <!--video buraya gelecek"-->


                    <div class="videoWrap wh" id="videowrapper">
                        <div class="video wh">
                        <?php if ($video->file_type == 'video/mp4') { ?>
                            <video class="play-vid" src="<?=base_url().$video->path?>"  width="100%" height="100%" ></video>
                            <img src="<?= base_url() ?>assets/img/play.png" class="play-btn">
                        <?php } else { ?>
                        <div class='iimg play-vid' style="background-image:url('<?=base_url().$video->path?>')"></div>
                        <?php } ?>
                        </div>
                        <!-- <img src="http://img.youtube.com/vi/iNJdPyoqt8U/maxresdefault.jpg" width="100%" height="100%" />-->
                    </div>
                    <div class="container">

                        <header id="header">
                        </header>

                        <!--  start home page  -->
                        <div id="home-page" class="info-box active-page">

                           <div class="box-container" id="homee" style="display: none">

                                <div id="title">
                                    <span class="h1" style="color:#">Palmarina Hotspot</span>
                                </div>
                                <div id="description" style="color:#">Connect to the wi-fi with your acconts.</div>

                                <a href="<?= base_url() ?>hauth/reset"class="btn btn-info btn-lg" ><i class="fa fa-wifi"></i> | Connect to Internet</a>
                            </div>
                        </div>
                        <!--  end home page  -->
                       

                    </div> <!--  end container  -->
                </div> <!--  end wrapper  -->
            </div> <!-- end pages -->
            <!--start navigation menu-->
           

            <!--  start social network links  -->
            <footer>
                <div id="external-links">
                    <a href="https://twitter.com/lineficom"><i class="fa my-fa-icon fa-fw fa-twitter shape"></i></a>
                    <a href="https://www.facebook.com/lineficom"><i class="fa my-fa-icon fa-fw fa-facebook shape"></i></a>
                    <a href="http://www.linefi.com/"><i class="fa my-fa-icon fa-fw fa fa-info-circle shape"></i></a>
                </div>
            </footer>
            <!--  start social network links  -->

        </div> <!--  end perspective  -->
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<script src="/assets/app/js/snap.svg-min.js"></script>
<script src="/assets/app/js/jquery.min.js"></script>
<script src="/assets/app/js/bootstrap.min.js"></script>
<script src="/assets/app/js/jquery.plugin.min.js"></script>
<script src="/assets/app/js/classie.js"></script>
<script src="/assets/app/js/maximage.js"></script>
<script src="/assets/app/js/menu.js"></script>
<script src="/assets/app/js/intlTelInput.js"></script>
<script src="/assets/app/js/soon.min.js"></script>
<script src="/assets/app/js/main.js"></script>

<script type="text/javascript">
    function soonCompleteCallback(){document.getElementById("my-soon-counter").style.display = "none";}
</script>
        <script type="text/javascript">
            var timer = <?=(($video->file_type == 'video/mp4')?$video->length:'30')?>;
            $('.play-vid').ready(function(){
                var video = false; 
                var video_elem = jQuery('.videoWrap .video video');
                if (video_elem.length){                 
                    video = video_elem.get()[0];
                    video_elem.click(function(){
                        if (video.paused){
                            video.play();
                            $('.videoWrap .play-btn').hide();
                        }
                        else{
                            video.pause();
                            $('.videoWrap .play-btn').show();
                        }
                    });
                    video.play();
                    
                }               
                var interval = setInterval(function() {                 
                    if (video){
                        if (video.paused){
                            return;
                        }
                    }
                    timer--;
                    $('.timer').text(timer);
                    if (timer === 0){ clearInterval(interval);
                         $('#homee').fadeIn(400);
                    }
                }, 1000);
                
            });
            

            
        </script>
</body>
</html>