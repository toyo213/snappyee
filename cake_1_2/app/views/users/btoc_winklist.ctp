<?php
        function cutStr( $InStr, $MaxSize ) {
            if ( strlen( $InStr ) > $MaxSize ) {
                return( substr( $InStr, 0, $MaxSize -3 ) . " ..." );
            } else {
                return( $InStr );
            }
        }
    ?>

<div id="body">
		<ul> 
			<li class="navlistbox" style="float:left"><a href=./home>Home</a></li>
			<li class="navlistbox" style="float:left"><a href=./profile>Profile</a></li>
			<li class="navlistbox" style="float:left"><a href=./index>Top Page</a></li>
			<li class="navlistbox" style="float:left"><a href=./r_message>Message</a></li>
			<li class="navlistbox" style="float:left"><a href=./btocWinklist>Likes </a></li>
			<li class="navlistbox" style="float:left"><a href=./logout>Log Out</a></li>　	
		</ul>
		</div>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<h2>Recieved Likes                      <a href=/users/ctobWinklist>Your Likes　送ったLikes</a></h2>

		<ul>
			<li class="navlistbox" style="float:center">
			
			</li>
			
			<li class="navlistbox" style="float:left">
			<span style="color:red"> <?php echo count($winks); ?> Likes </span>
			</li>
		</ul>

<br/>
<br/>

<table cellpadding="0" cellspacing="0">
					<tr>
					<th> Corporation </th>
					<th>URL </th>
					<th>Profile</th>
					<th>Date and Time</th>
					<tr>

	<?php foreach ($_corp as $item): ?> 
	<tr>
		<td><?php echo $html->link($item['c']["corporation"], '/users/corp_profile_view/'.$item['c']['id']); ?></td>
		<td><?php echo $html->link($item['c']['corp_url'],$item['c']['corp_url']);?></td>
		<td><?php echo cutStr($item['c']['corp_profile'], 20); ?></td>
		<td><?php echo $item['b']['created'];?></td>
	</tr>
	<?php endforeach; ?>
</table>



<!-- 
Received Message
<br />
<table cellpadding="0" cellspacing="0">
					<tr>
					<th> Sender ID </th>
					<th> Message </th>
					<th> Created Date </th>
					<tr>
				<?php
				$i = 0;
foreach ($winks as $wink):
				$class = null;
if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
	}
?>
				<tr <?php echo $class;?>>

				<td>
				<?php echo $wink['Btoc_wink']['sid']; ?>
				</td>
				<td>
				<?php echo $wink['Btoc_wink']['content']; ?>
				</td>
				<td>
				<?php echo $wink['Btoc_wink']['created']; ?>
				</td>
				</tr>
				<?php endforeach; ?>
				</table>
<br />
<br />


 -->
