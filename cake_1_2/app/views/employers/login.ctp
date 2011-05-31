<h2>Employers Login 企業用アカウントログイン</h2>

<?php $session->flash('auth'); ?>
<?php e($form->create('Employer', array('action'=>'login'))); ?>
<h2><p class="label">Username</p></h2>
<p><?php e($form->text('username', array('size'=>'35', 'maxlength'=>'1000'))); ?><?php e($form->error('Url.full_url')); ?></p>

<br/>
<br/>
<h2><p class="label">Password</p></h2>
<p><?php e($form->password('passwd', array('size'=>'35'))); ?></p>

<br/>
<br/>
<?php e($form->submit('login')); ?>
<?php e($form->end()); ?>


<br/>
<br/>
<img src="/images/img_txt_joinjobtiger.gif" alt="Join JobTiger!"><br />
<br/>
<br/>
<div> <h2><a href = "http://job-tiger.com/employers/signup">Looking For Hiring? Sign up for Job Tiger Today!
<br/> 求人掲載をご検討ですか？　Job Tigerにサインアップ！ </a></h2></div>

<br/>
<br/>


<p class="up5down5 txtbold">No more search, No more Headhunters.</p>
<br/>
<div>
JobTiger is a social job matching service that takes applicants preferences and skill sets,<br>
And automatically matches them with employers requirements and corporate culture.
<br/>Find your right candidate on Job Tiger.

<br/>
<br/>
<br/>
<br/>
Job Tigerはtwitter/ソーシャルを利用した口コミ求人サービスです。
<br/>twitterを通して仕事を紹介しあい、よりスピーディかつ正確に適切な候補者へのアクセスを提供します。
<br/> Headhunterではなく業界のインサイダーがtwitterを通して御社の採用ニーズと候補者をマッチングします。
</div>
<br/>
<br/>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;




<br/>
<br/>
<br/>
<br/>
