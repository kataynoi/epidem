<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Kent is Learning CodeIgniter - Test 2</title>
</head>
<body>
<fb:login-button autologoutlink="true"
                 onlogin="window.location.reload(true);"></fb:login-button>
<div style="width:600px;">
    <?
    if(isset($friends)){
        foreach($friends as $friend){
            ?>
            <img src="http://graph.facebook.com/<?=$friend['id'];?>/picture" title="<?=$friend['name'];?>" />
        <?
        }
    }
    ?>
</div>
<p><?=anchor('facebook_connect/page4','Go back to page 4 of the tutorial');?></p>
<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js"></script>
<script>
    FB.init({appId: '457228377680583', status: true, cookie: true, xfbml: true});
    FB.Event.subscribe('auth.sessionChange', function(response) {
        if (response.session) {
            // A user has logged in, and a new cookie has been saved
            window.location.reload(true);
        } else {
            // The user has logged out, and the cookie has been cleared
        }
    });
</script>
</body>
</html>