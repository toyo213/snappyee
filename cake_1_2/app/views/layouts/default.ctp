<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTMl xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $html->charset(); ?>
	<title>
		<?php __('Job Tiger: Upgrade Your Career Today'); ?>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $html->meta('icon');

		echo $html->css('main.css');

		echo $scripts_for_layout;
	?>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
    
</head>



<body id="home"> 
	<div id="header"> 
		<div id="logo"> 
			<h1><a href="http://job-tiger.com/" title="Home">
			<?php echo $html->image('logo.gif', array(
                'alt' => 'Job Tiger',
            ));
            ?>
            </a></h1> 
		</div> 
		<!--
		<ul id="nav">
			<li class="navlistbox"><a class="current" href="http://job-tiger.com/" accesskey="h">Home</a></li>
			<li class="navlistbox"><a href="#" accesskey="a">About</a></li>
			<li class="navlistbox"><a href="#" accesskey="m">Media</a></li>
			<li class="navlistbox"><a href="#" accesskey="r">References</a></li>
			<li class="navlistbox"><a href="#" accesskey="t">Contact</a></li>
		</ul>--> 
			
	</div> 
	<div id="content"> 
		<div id="left"> 
<div class="contentbox"> 
 
 
</div> 

		<?php $session->flash(); ?>

			<?php echo $content_for_layout; ?>


</div> 

 
<div id="right"> 
<div class="sidebox"> 
<iframe src="http://www.facebook.com/plugins/likebox.php?id=131433756902326&amp;width=220&amp;connections=10&amp;stream=true&amp;header=true&amp;height=587" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:587px;" allowTransparency="true"></iframe> 
<div class="downmargin10">&nbsp;</div> 
<script type="text/javascript" id="tcws_178651936">(function(){function async_load(){var s=document.createElement('script');s.type='text/javascript';s.async=true;s.src='http://twittercounter.com/remote/?v=2&username_owner=jobtiger411&users_id=11789826&width=240&nr_show=6&hr_color=709cb2&a_color=709cb2&bg_color=ffffff';x=document.getElementById('tcws_178651936'); x.parentNode.insertBefore(s,x);}if(window.attachEvent){window.attachEvent('onload',async_load);}else{window.addEventListener('load',async_load,false);}})(); </script> 
<div id="tcw_178651936"></div> 
</div><!--/sidebox --> 
</div>
 
<div id="footer"> 
			<div class="wrap"> 
			<p>Job Tiger &copy; 2010</p> 
			<p><a href="http://job-tiger.com/">Home</a> &middot; <a href="http://213stomperz.com/">Corporate</a> </p> 
			</div> 
		</div>	
</body> 

</html> 
