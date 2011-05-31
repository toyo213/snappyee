<?php  echo $form->create(null,array('type'=>'post','url'=>'http://59.106.186.237/job-tiger/app/users/btocComment?id='.$id)); ?>
     <?php echo $form->label('Comment'); ?>
					<br />
     <?php echo $form->text('Wink.content'); ?>
					<br />

   		<?php echo $form->end('send');?>

					<br />
					<br />

					<?php echo $html->link(__('Received Wink List', true), 'http://59.106.186.237/job-tiger/app/users/btocWinklist');?>

					<br />
					<br />
