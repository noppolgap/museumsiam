
<script src="assets/plugin/jquery.urlshortener.min.js"></script>
<div class="fb-like" data-share="true" data-width="450" data-show-faces="true"></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '<?=_FACEBOOK_ID_?>',
      xfbml      : true,
      version    : 'v2.5'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/th_TH/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

$(document).ready(function(){
  jQuery.urlShortener.settings.apiKey = '<?=_GOOGLE_API_?>';
});
</script>
