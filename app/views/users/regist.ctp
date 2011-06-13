
<img src="/img/geegee_title_pink.png" width="200" height="66"></img>



<?php foreach ($fbuser as $key => $val):?>
<?php // echo $key.' : '.$val; ?>
<?php endforeach;?>
<?php //var_dump($fbuser);?>

<?php
echo $form->create('User',array('type' => 'post','url' =>   '/users/regist_end'));
//echo $form->input('comment');
//echo $form->input('ido');
//echo $form->input('kdo');
//echo "<fieldset>";
echo "<dl>";
echo "<legend>Gee Gee ユーザ登録</legend>";
echo "<dt class=txtbold>Gee Geeユーザネーム</dt>";
echo $form->input('nickname' ,array('type'=>'text','label'=>'','value'=>$fbuser["name"],'error'=>'エラーです','vertical-align'=>'middle','text-align'=>'right'));
echo "<br/>";
echo "<dt class=txtbold>プロフィール URL</dt>";
echo $form->input('blogurl', array('type'=>'text','label'=>'','value'=>$fbuser["link"],'error'=>'エラーです'));
//echo $form->hidden('id', array('value'=>$list[0]['People']['id']));
echo "</dl>";
echo "<br/><dd>";	
echo $form->end('ユーザ登録');
echo "</dd>";
?>
						<!--  
						<form>
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
                        -->