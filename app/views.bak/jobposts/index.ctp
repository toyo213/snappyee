	
<h1>Job Posts</h1>
<p><?php echo $html->link("Add Job Post", "/jobposts/add"); ?></p>
<table>
<tr> 
<th>Corporation</th> 
<th>Job Title</th> 
<th>Salary Range</th> 
<th>Location</th> 
<th>Requirement</th> 
</tr> 

<?php foreach ($jobposts as $jobpost): ?>

	<tr>
		
		<td>
			<?php echo $html->link($jobpost['Jobpost']['corporation'],'/jobposts/view/'.$jobpost['Jobpost']['id']);?>
		</td>
		
		<td>
		<?php echo $html->link($jobpost['Jobpost']['job_title'],'/jobposts/view/'.$jobpost['Jobpost']['id']);?>
		</td>
		
		<td>
		<?php echo $html->link($jobpost['Jobpost']['salary_range_min'],'/jobposts/view/'.$jobpost['Jobpost']['id']);?> - 
		<?php echo $html->link($jobpost['Jobpost']['salary_range_max'],'/jobposts/view/'.$jobpost['Jobpost']['id']);?>
		<?php echo $html->link($jobpost['Jobpost']['salary_range_comment'],'/jobposts/view/'.$jobpost['Jobpost']['id']);?>
		</td>
		
		<td>
		<?php echo $html->link($jobpost['Jobpost']['requirement'],'/jobposts/view/'.$jobpost['Jobpost']['id']);?>
		</td>
		
		<td>
		<?php echo $html->link($jobpost['Jobpost']['job_description'],'/jobposts/view/'.$jobpost['Jobpost']['id']);?>
		</td>
		<td>
		<?php echo $html->link("Edit",'/jobposts/edit/'.$jobpost['Jobpost']['id']);?>
		</td>
	</tr>
<?php endforeach; ?>

</table>


