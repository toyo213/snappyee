<?php e($form->create('User', array('action'=>'direct_msg'))); ?>
<h2>Direct Message</h2>

<br/>
<br/>
<span style=color:blue> To @ </span> <?php e($form->text('to', array('size'=>'35', 'maxlength'=>'1000')))?> 

<br/>
<br/>

<p><?php e($form->textarea('msg', array('cols'=>55, 'rows'=> 4, 'value'=>$jobpost["Jobpost"]["corporation"]."  ".$jobpost["Jobpost"]["job_title"]."  ".$jobpost["Jobpost"]["salary_range_min"]."-".$jobpost["Jobpost"]["salary_range_max"]."  ".$surl))); ?><?php e($form->error('Url.full_url')); ?></p>

<?php 
//url "http://job-tiger.com/users/jobpostview/".$jobpost["Jobpost"]["id"]."?hid=".$user["User"]["twitter_id"]
//e($form->text('msg', array('size'=>'35', 'maxlength'=>'1000'))); ?>

<br/>

<?php e($form->submit('submit')); ?>
<?php e($form->end()); ?>

<br/>

<p>
<?php foreach($image as $key => $item)
{
	echo "<img src=".$item." title=".$key." width=45 height=45 onMousemove=\"imgSize(this,60,60)\" onMouseout=\"imgSize(this,48,48)\" >";
}

?>
</p>
<p id="exp"></p>

<script src="/jquery.js" type="text/javascript"></script>  
<script src="/jQuery.jTagging.js" type="text/javascript"></script>  
<script type="text/javascript">

function imgSize(obj,w,h)
{
   obj.width=w;
   obj.height=h;
}

var listener = function(ev){
	var exp = document.getElementById('exp');
	if(!exp.firstChild){
		exp.appendChild(document.createTextNode(""));
	}
	if(ev.target.tagName == "IMG"){
		
		document.getElementById('UserDirectMsgForm').UserTo.value = ev.target.title;
		exp.firstChild.nodeValue = ev.target.title;
 	}else{
		exp.firstChild.nodeValue = "";
	}
};

document.addEventListener('click', listener, false);

$(document).ready(function(){  
    $("#id名").jTagging($("タグの配列要素名"), "");  
}); 


</script> 







