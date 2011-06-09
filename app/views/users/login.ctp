<!-- photo list Big -->
<div class="photoListBig rightMargin5px leftcol">
    <?php 
    $numbers = range(1, 19);
shuffle($numbers);
    
    ?>

<!--  screen projection Author Toyo -->
<head>
<link rel="stylesheet" href="/css/login.css" type="text/css" media="screen, projection" />   
    <!-- jQuery /-->
	<link href="/css/signup.css" rel="stylesheet" type="text/css" />	 
	<link href="/js/jQuery/jqModal/jqModal.css" rel="stylesheet" type="text/css" />
	<link href="/css/login.css" rel="stylesheet" type="text/css" />
	<script src="/js/jQuery/jquery-1.2.6.js" type="text/javascript"></script>  
	<script src="/js/jQuery/jqModal/jqModal.js" type="text/javascript"></script>  
<script type="text/javascript">
<!--
$(function() {  
//$('#dialog').jqm();  
$('#dialog').jqm({ modal: true });    
});

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>  
<!-- /jQuery-->
</head> 
<body id="home" onLoad="MM_preloadImages('img/images/btn_createmyaccount_on.gif')">

<!-- Dialog -->
<div class="jqmWindow" id="dialog">
<div id="lightbox_wrap">
<div class="closebtn"><a href="" class="jqmClose"><img src="/img/images/btn_close.gif" alt="Close" border="0" id="Image1" /></a></div>
<!-- /closebtn -->
<img src="/img/images/img_login_txt01welcome.gif" alt="Welcome to JobTiger!" /><br />
<p class="up5down5">Hey there! Welcome back. Login with your account.</p>
<div id="lightbox_frame">
<div id="lightbox_inbox01">
<form action="#" method="post" class="formbox">
<dl>
<dt><span class="t-hide">Login or Sinup?</span></dt>
<dd class="downmargin20"><img src="/img/images/img_login_txt02loginwith.gif" alt="Login with JobTiger ID."/></dd>
<dt class="txtbold">Username</dt>
<dd><input name="login_username" type="text" class="marginup2down10" id="login_username" size="25" />
</dd>
<dt class="txtbold">Password</dt>
<dd><input name="login_pass" type="password" class="marginup2down10" id="login_pass" size="25" />
</dd>
<dt><span class="t-hide">Login</span></dt>
<dd><input name="login" type="submit" value="Login" /></dd>
</dl>
</form>
</div><!-- /lightbox_inbox01 -->
<img src="/img/images/bg_h220px.gif">
<div id="lightbox_inbox02">
<img src="/img/images/img_txt_or.gif" alt="or" width="40" height="22">
</div><!-- /lightbox_inbox02 -->
<div id="lightbox_inbox03">
<a href="#"><img src="/img/images/btn_facebooklogin.gif" alt="Login with facebook" /></a></div>
<!-- /lightbox_inbox03 -->

</div><!-- /lightbox_frame -->
</div><!-- /lightbox_wrap -->
</div><!-- /Dialog -->
<ul id="nav">
			<li class="navlistbox"><a href="#" accesskey="s" class="jqModal">Sign in</a></li>
		</ul>

<!--  screen projection Author Toyo -->    
    
    <?php $i = 0; ?>
    <?php while ($i < 5): ?>
    <div class="photo radiux3px">
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>"><img src="<?php echo $list[$numbers[$i]]['Photo']['fbpath'];?>" width="260px" alt="" /></a>
            <!--
            <div class="photoUnderBig">
                <div id="fb-root"></div><script src="#"></script><fb:like href="#" send="false" layout="button_count"width="250" show_faces="false" font=""></fb:like>
            </div>
            -->
        </div>
    <?php  $i++; ?>
    <?php endwhile; ?>

</div>
<!-- /photo list Big -->

<!-- photo list Normal 1 -->
<div class="photoList rightMargin5px leftcol">
    <?php $i = 6; ?>
    <?php while ($i < 13): ?>
        <div class="photo radiux3px">
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>"><img src="<?php echo $list[$numbers[$i]]['Photo']['fbpath']; ?>" width="190px" alt="" /></a>
            <!--

            <div class="photoUnder">
                <div id="fb-root"></div><script src="#"></script><fb:like href="#" send="false" layout="button_count"width="180" show_faces="false" font=""></fb:like>
            </div>
            -->
        </div>
    <?php  $i++; ?>
    <?php endwhile; ?>
</div>
<!-- /photo list Normal 1 -->
<!-- photo list Normal 2 -->
<div class="photoList leftcol">
    <?php $i = 13; ?>
    <?php while ($i < 18): ?>
    <div class="photo radiux3px">
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>"><img src="<?php echo $list[$numbers[$i]]['Photo']['fbpath']; ?>" width="190px" alt="" /></a>
            <!--
         <div class="photoUnder">
             <div id="fb-root"></div><script src="#"></script><fb:like href="#" send="false" layout="button_count"width="180" show_faces="false" font=""></fb:like>
         </div>
            -->
        </div>
    <?php  $i++; ?>
    <?php endwhile; ?>
</div>     
<!-- /photo list Normal 2 -->      

