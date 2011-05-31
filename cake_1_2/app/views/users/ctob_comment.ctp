 
<h2> Comment </h2>
 <?php  echo $form->create(null,array('type'=>'post','url'=>'http://job-tiger.com/users/ctobComment?id='.$id)); ?>
     <?php //echo $form->label('Comment'); ?>
					<br />
     <?php echo $form->textarea('Wink.content', array('cols' => 80, 'rows' => 10)); ?>
					<br />

   		<?php echo $form->end('send');?>

					<br />
					<br />

					<?php echo $html->link(__('Received Wink List', true), 'http://job-tiger.com/users/ctobWinklist');?>

					<br />
					<br />
