
<br /><br />

<h2><?php echo $jobpost["Jobpost"]["corporation"] ?></h2>


<table style ="width:100%;">
<tr><th>Job Title<br/>(職種）</th><td><?php echo $jobpost["Jobpost"]["job_title"] ?></td></tr>
<tr><th>Salary Range<br/>（給与レンジ）</th><td><?php echo $jobpost["Jobpost"]["salary_range_min"] ?> - <?php echo $jobpost["Jobpost"]["salary_range_max"] ?><br/> <?php echo $jobpost["Jobpost"]["salary_range_comment"] ?></td></tr>
<tr><th>Location<br/>（勤務地）</th><td><?php echo $jobpost["Jobpost"]["location"] ?></td></tr>
<tr><th>Requirement<br/>（応募条件）</th><td><?php echo $jobpost["Jobpost"]["requirement"] ?></td></tr>
</table>

<br />
<br />

<table style ="width:100%;">
<tr><th>Job Description（職務内容）</th></tr>
<tr><td> <?php echo $jobpost["Jobpost"]["job_description"] ?></td></tr>
 
</table>

<br />
<br />