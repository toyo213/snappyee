<div>プロフィール情報</div>
<img src="https://graph.facebook.com/<?php echo $uid; ?>/picture">
<?php echo $me['name']; ?>

<div>セッション情報</div>
<pre><?php print_r($session); ?></pre>
<hr>
<div id="fb-root">
</div>
<h1>Hello FB!</h1>
<script language="JavaScript">
    window.fbAsyncInit = function(){
        FB.init({
            appId: '102978646442980', //アプリケーション ID
            status: true,
            cookie: true,
            xfbml: true
        });
        FB.getLoginStatus(function(response){
            if (response.session) {
                // Logged in
                showUserName();
            }
            else {
                FB.login(function(response){
                    if (response.session) {
                        // Logged in
                        showUserName();
                    }
                    else {
                        alert("Bye.");
                    }
                });
            }
        });
    };
    function showUserName(){
        FB.api('/me', function(response){
            alert("Welcome, " + response.name);
        });
    }
    (function(){
        var e = document.createElement('script');
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
    }());
</script>
