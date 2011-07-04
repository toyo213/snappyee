<script type="text/javascript" src="/js/window.js">
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
<!-- jQuery /-->
        
    <!-- Dialog -->
    <div class="jqmWindow" id="dialog" >
        <div id="lightbox_wrap">
            <div class="closebtn"><a href="" class="jqmClose"><img src="/img/images/btn_close.gif" alt="Close" border="0" id="Image1" /></a></div>
            <!-- /closebtn -->
            <img src="/img/geegee_title_pink.png" alt="Welcome to Gee Gee!" width="180" height="59" /><br />
            <p class="up5down5">Gee Geeアカウント登録</p>
            <div id="lightbox_frame">
                <div id="lightbox_inbox01">
                    <form action="#" method="post" class="formbox" >
                        <dl>
                            <dt><span class="t-hide">SingUp</span></dt>
                            <dt class="txtbold">Gee Geeユーザネーム</dt>
                            <dd><input name="username" type="text" class="marginup2down10" id="login_username" size="25" />
                            </dd>
                            <dt class="txtbold">ブログ URL</dt>
                            <dd><input name="blog_url" type="text" class="marginup2down10" id="blog_url" size="25" />
                            </dd>
                            <dt class="txtbold">Email</dt>
                            <dd><input name="email" type="text" class="marginup2down10" id="email" size="25" />
                            </dd>     
                            <dt><span class="t-hide">signup</span></dt>
                            <dd><input name="signup" type="submit" value="アカウント登録" /></dd>
                        </dl>
                    </form>
                    
                </div><!-- /lightbox_inbox01 -->
                
                        
            </div><!-- /lightbox_frame -->
        </div><!-- /lightbox_wrap -->
    </div><!-- /Dialog -->
  <!--  link to singin JS  
    <ul id="nav">
        <li class="navlistbox"><a href="#" accesskey="s" class="jqModal">Sign in</a></li>
    </ul>
    -->
<?php
$numbers = range(0,19);
shuffle($numbers);
?>

<!-- Sample Pulldown menu -->
    <!--  image pull down
    <div id="navi">
	<ul id="dd">
    <li class="mainmenu"><a href="#" class="menu" id="mmenu1" onMouseOver="mopen(1);" onMouseOut="mclosetime();"><img src="/img/cake.icon.gif" alt="" width="100" height="20" border="0" class="imgover"></a>
	<div class="submenu" id="menu1" onMouseOver="mcancelclosetime()" onMouseOut="mclosetime();">
	<a href="#"><img src="/img/cake.icon.gif" alt="" width="99" height="18" border="0" class="imgover"></a>
	<a href="#"><img src="/img/cake.icon.gif" alt="" width="99" height="18" border="0" class="imgover"></a>
	<a href="#"><img src="/img/cake.icon.gif" alt="" width="99" height="18" border="0" class="imgover"></a>
	<a href="#"><img src="/img/cake.icon.gif" alt="" width="99" height="18" border="0" class="imgover"></a>
	</div>
	</li>
	</div>
	</ul>
	-->
	
	<!--  
	text pull down
    <ul id="dd">
  	<li>
    <a href="#" class="menu" id="mmenu1" 
      onmouseover="mopen(1);"
      onmouseout="mclosetime();">Home</a>
    <div class="submenu" id="menu1"
      onmouseover="mcancelclosetime()"
      onmouseout="mclosetime();">
        <a href="#">HTML Tutorials</a>
        <a href="#">DHTML Tutorials</a>
        <a href="#">JavaScript Tutorials</a>
        <a href="#">CSS Tutorials</a>
    </div>
  </li>
  <li>
    <a href="#" class="menu" id="mmenu2" 
      onmouseover="mopen(2);"
      onmouseout="mclosetime();">Download</a>
    <div class="submenu" id="menu2"
      onmouseover="mcancelclosetime()"
      onmouseout="mclosetime();">
        <a href="#">ASP Scripts</a>
        <a href="#">PHP Scripts</a>
        <a href="#">Ajax Scripts</a>
        <a href="#">Perl Scripts</a>
    </div>
  </li>  
  <li>
    <a href="#" class="menu" id="mmenu3" 
      onmouseover="mopen(3);"
      onmouseout="mclosetime();">Contact</a>
    <div class="submenu a" id="menu3"
      onmouseover="mcancelclosetime()"
      onmouseout="mclosetime();">
        <a href="#">Office</a>
        <a href="#">Sales</a>
        <a href="#">Customer Service</a>
        <a href="#">Shipping</a>
    </div>
  </li>
</ul>
    -->
    <!-- Sample Pulldown menu -->
    
    <!-- photo list Big -->
<div class="photoList rightMarginS leftcol">
    
    <?php $i = 0; ?>
    <?php while ($i < 5): ?>
    <div class="photo radiux3px">
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>"><img src="<?php echo $list[$numbers[$i]]['Photo']['fbpath'];?>" width="163px" alt="" /></a>
        </div>
    <?php  $i++; ?>
    <?php endwhile; ?>

</div>
<!-- /photo list Big -->

<!-- photo list Normal 1 -->
<div class="photoList rightMarginS leftcol">
    <?php $i = 5; ?>
    <?php while ($i < 10): ?>
        <div class="photo radiux3px">
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>"><img src="<?php echo $list[$numbers[$i]]['Photo']['fbpath']; ?>" width="163px" alt="" /></a>
        </div>
    <?php  $i++; ?>
    <?php endwhile; ?>
</div>
<!-- /photo list Normal 1 -->

<!-- photo list Normal 1 -->
<div class="photoList rightMarginS leftcol">
    <?php $i = 10; ?>
    <?php while ($i < 15): ?>
        <div class="photo radiux3px">
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>"><img src="<?php echo $list[$numbers[$i]]['Photo']['fbpath']; ?>" width="163px" alt="" /></a>
        </div>
    <?php  $i++; ?>
    <?php endwhile; ?>
</div>
<!-- /photo list Normal 1 -->

<!-- photo list Normal 2 -->
<div class="photoList leftcol">
    <?php $i = 15; ?>
    <?php while ($i < 20): ?>
    <div class="photo radiux3px">
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>"><img src="<?php echo $list[$numbers[$i]]['Photo']['fbpath']; ?>" width="163px" alt="" /></a>
        </div>
    <?php  $i++; ?>
    <?php endwhile; ?>
</div>     
<!-- /photo list Normal 2 -->      