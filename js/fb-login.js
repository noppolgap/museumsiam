(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/th_TH/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

window.fbAsyncInit = function() {
    FB.init({
        appId: appId,
        cookie: true, // enable cookies to allow the server to access
        // the session
        xfbml: true, // parse social plugins on this page
        version: 'v2.5' // use version 2.3
    });

    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
};
// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {

    if (response.status === 'connected') {
        // Logged into your app and Facebook.
        // we need to hide FB login button
        //$('#fblogin').hide();
        //fetch data from facebook
        //getUserInfo();
    } else if (response.status === 'not_authorized') {
        // The person is logged into Facebook, but not your app.
        $('#status').html('Please log into this app.');
    } else {
        // The person is not logged into Facebook, so we're not sure if
        // they are logged into this app or not.
        $('#status').html('Please log into facebook');
    }
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample code below.
function checkLoginState() {
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
}

function FBLogin() {
    FB.login(function(response) {
        if (response.authResponse) {
            getUserInfo(); //Get User Information.
        } else {
            alert('Authorization failed.');
        }
    }, {
        scope: 'public_profile,email'
    });
}

function FBLogout(){

    FB.logout(function(response) {
        window.location.href = 'index.php';
    });

}

function getUserInfo() {
    FB.api('/me', function(response) {

        $.ajax({
            type: "POST",
            dataType: 'json',
            data: response,
            url: 'login-fb-ajax.php',
            success: function(msg) {
                if (msg.error == 1) {
                    alert('Something Went Wrong!');
                } else {
                    window.location.href = back_link;
                }
            }
        });


    });
}