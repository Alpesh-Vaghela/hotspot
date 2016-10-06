<?php
$following = false;

use Abraham\TwitterOAuth\TwitterOAuth;

switch ($network) {
    case "Twitter":
        $consumerKey = $consumerKey;
        $consumerSecret = $consumerSecret;
        $oAuthToken = $access_token;
        $oAuthSecret = $access_token_secret;

        # API OAuth

        require_once(APPPATH . 'libraries/TwitterOAuth/autoload.php');
        require_once(APPPATH . 'libraries/TwitterOAuth/src/TwitterOAuth.php');

        $tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);

        if (isset($_POST["follow"])) {
            $result = $tweet->post('friendships/create', array('user_id' => $username, 'screen_name' => $twitter_follow_user));
            $friendships = $tweet->get('friendships/show', array('source_screen_name' => $displayName, 'target_screen_name' => $twitter_follow_user));
            exit(json_encode($friendships->relationship->source->following));
        }


        $friendships = $tweet->get('friendships/show', array('source_screen_name' => $displayName, 'target_screen_name' => $twitter_follow_user));
        break;
    case "Facebook":

        break;
}
?>


<html>
    <head>		
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/component.css" />

    <script type="text/javascript" src="/assets/js/jquery.js"></script>
    <script id="twitter-wjs" src="https://platform.twitter.com/widgets.js"></script>
    <script src="http://connect.facebook.net/en_US/all.js"></script>

    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="-1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<script type="text/javascript">
    function doredirect() {
        window.location.href = 'http://<?php echo $nas_ip . "/login?username=" . $username . "&password=" . $password ?>';
    }
    document.write('<style>.noscript { display:none }</style>');
</script>
<div class="pages-stack">
    <div class="carousel slide">
        <div class="carousel-inner">
            <div class="item active">
                <div data-parallaxify-range-x="140" class="fill" style="background-image:url('/assets/img/bgBodyCoffee.jpg');"></div>
                <div class="main">
                    <div class="header">
                        <div class="row">
                            <div class="col-lg-4 col-lg-offset-4">
                                <form role="form">
                                    <div class="form-group">
                                        <div class="col-sm-12 col-xs-10 center-block">
                                            <?php
                                            $url = 'http://hotspot.linefi.net/welcome/getlokasyon/' . $shortname;
                                            $text = 'test';
                                            switch ($network) {
                                                case "Facebook":
                                                    if ($_SERVER["HTTP_REFERER"] == "https://www.facebook.com") {
                                                        ?>
                                                        <script type="text/javascript"> window.onload = doredirect;</script>
                                                    <?php
                                                    } else {
                                                        header("Location: https://www.facebook.com/dialog/share?app_id=" . $consumerID . "&display=popup&href=" . $url . "&redirect_uri=" . $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] . "&redirect=true");
                                                        exit();
                                                    }
                                                    ?>
                                                    <?php
                                                    break;
                                                case "Twitter":
                                                    if (!$twitter_follow_user) {
                                                        ?>
                                                        <script type="text/javascript"> window.onload = doredirect;</script>
                                                        <?	} else if(isset($friendships->errors)){
                                                        header("Location: ".$url);
                                                        exit();
                                                        } 

                                                        if($friendships->relationship->source->following){ ?>
                                                        <script type="text/javascript"> window.onload = doredirect;</script>
                                                        <?	} else {
                                                        $tweet->post('friendships/create', array('user_id' => $username, 'screen_name' => $twitter_follow_user)); ?>
                                                        <script type="text/javascript"> window.onload = doredirect;</script>	
                                                        <?	}

                                                        break;
                                                        }
                                                        ?>
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

            <script type="text/javascript">
                // twitter

                // var url = window.location.href;

                // $('.twitter-follow-button').click(function(e){
                // e.preventDefault();
                // $.post(url, {follow: true}, function(data){
                // var data = $.parseJSON(data);

                // if(data)
                // doredirect();
                // });
                // });
            </script>
            <?	if($network == "Facebook"){ 

            ?>	
            <script type="text/javascript">
                /*				  window.fbAsyncInit = function() {
                 FB.init({appId: '<?= $consumerID ?>', status: true, cookie: true, xfbml: true});
                 // FB.Event.subscribe('edge.create', function() {alert(1221);});
                 };
                 
                 (function(d, s, id){
                 var js, fjs = d.getElementsByTagName(s)[0];
                 if (d.getElementById(id)) {return;}
                 js = d.createElement(s); js.id = id;
                 js.src = "//connect.facebook.net/en_US/sdk.js";
                 fjs.parentNode.insertBefore(js, fjs);
                 }(document, 'script', 'facebook-jssdk'));
                 function share_facebook(url){
                 FB.ui(
                 {
                 appId: '<?= $consumerID ?>',
     method: 'share',
     href: url, 
     }, 
     // callback
     function(response) {
     if (response && !response.error_message) {
     console.log(response);
     // doredirect();
     } 
     }
     );
     }*/
</script>
<?	}	?>

</body>
</html>
