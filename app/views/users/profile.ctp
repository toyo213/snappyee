

<?php // var_dump($u);?>
<table border=2 width=500 align=center>
<caption><font color="red"><?php echo $u['User']['nickname']; ?></font>さんのプロフィール</caption>
<tr>
<td bgcolor="#FFF0F5">ユーザネーム</td>
<td><?php echo $u['User']['nickname']; ?></td>
</tr>
<tr>
<td bgcolor="#FFF0F5">ロケーション</td>
<td><?php echo $u['User']['location']; ?></td>
</tr>
<tr>
<td bgcolor="#FFF0F5">アナタについて</td>
<td><?php echo $u['User']['profile']; ?></td>
</tr>
<tr>
<td bgcolor="#FFF0F5">プロフィールURL</td>
<td><a href="<?php echo $u['User']['blogurl']; ?>"><?php echo $u['User']['blogurl']; ?></a></td>
</tr>
</table>