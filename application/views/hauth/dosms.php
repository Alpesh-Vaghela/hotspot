<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <form action="<?php echo ($device == "Mikrotik" ? "http://".$nas_ip."/login" : "http://".$nas_ip)?>" method="<?php echo ($device == "Mikrotik" ? "GET" : "POST")?>" id="redirectform" style="display:none">
            <input type="hidden" name="<?php echo ($device == "Mikrotik" ? "username" : "auth_user")?>" value="<?php echo $auth_user ?>" />
            <input type="hidden" name="<?php echo ($device == "Mikrotik" ? "password" : "auth_pass")?>" value="<?php echo $auth_pass ?>" />
            <input name="redirurl" type="hidden" value="<?php echo $this->config->base_url() ?>welcome/status/<?php echo $location_name ?>?user=<?php echo $auth_user?>" />
            <input name="zone" type="hidden" value="palmarina_hotspot" />
            <input name="accept" type="hidden" value="Continue" />
            <span class="noscript">Javascript is disabled, click to
                <input name="accept" type="submit" value="Continue" />
            </span>		
        </form>

<script type="text/javascript"> 
	window.onload = doredirect;
	function doredirect() {
        var frm = document.getElementById("redirectform");
        frm.submit();
    }
</script>
    </body>
</html>