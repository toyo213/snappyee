<?php
$numbers = range(0,19);
shuffle($numbers);
?>

    
    <!-- photo list Big -->
<div class="photoList rightMarginS leftcol">
    
    <?php $i = 0; ?>
    <?php while ($i < 5): ?>
    <div class="photo radiux3px">
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>"><img src="<?php echo $list[$numbers[$i]]['Photo']['fbpath'];?>" width="163px" alt="" /></a>
            <?php $comment = $list[$numbers[$i]]['Photo']['comment'];?>
            <?php echo $list[$numbers[$i]]['Photo']['cnt'];?><img src="/img/like_heart_on.png"></img>
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>">
            <?php echo $data = (strlen($comment)>18)?mb_substr($comment,0,18).'...':$comment;?>
            </a>
    </div>
    <?php  $i++; ?>
    <?php endwhile; ?>

</div>
<!-- /photo list Big -->

<!-- photo list Normal 1 -->
<div class="photoList rightMarginS leftcol">
    <?php $i = 5; ?>
    <?php while ($i < 10): ?>
        <div class="photo radiux3px">
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>"><img src="<?php echo $list[$numbers[$i]]['Photo']['fbpath']; ?>" width="163px" alt="" /></a>
            <?php $comment = $list[$numbers[$i]]['Photo']['comment'];?>
            <?php echo $list[$numbers[$i]]['Photo']['cnt'];?><img src="/img/like_heart_on.png"></img>
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>">
            <?php echo $data = (strlen($comment)>18)?mb_substr($comment,0,18).'...':$comment;?>
            </a>
        </div>
    <?php  $i++; ?>
    <?php endwhile; ?>
</div>
<!-- /photo list Normal 1 -->

<!-- photo list Normal 1 -->
<div class="photoList rightMarginS leftcol">
    <?php $i = 10; ?>
    <?php while ($i < 15): ?>
        <div class="photo radiux3px">
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>"><img src="<?php echo $list[$numbers[$i]]['Photo']['fbpath']; ?>" width="163px" alt="" /></a>
            <?php $comment = $list[$numbers[$i]]['Photo']['comment'];?>
            <?php echo $list[$numbers[$i]]['Photo']['cnt'];?><img src="/img/like_heart_on.png"></img>
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>">
            <?php echo $data = (strlen($comment)>18)?mb_substr($comment,0,18).'...':$comment;?>
            </a>
        </div>
    <?php  $i++; ?>
    <?php endwhile; ?>
</div>
<!-- /photo list Normal 1 -->

<!-- photo list Normal 2 -->
<div class="photoList leftcol">
    <?php $i = 15; ?>
    <?php while ($i < 20): ?>
    <div class="photo radiux3px">
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>"><img src="<?php echo $list[$numbers[$i]]['Photo']['fbpath']; ?>" width="163px" alt="" /></a>
            <?php $comment = $list[$numbers[$i]]['Photo']['comment'];?>
            <?php echo $list[$numbers[$i]]['Photo']['cnt'];?><img src="/img/like_heart_on.png"></img>
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>">
            <?php echo $data = (strlen($comment)>18)?mb_substr($comment,0,18).'...':$comment;?>
            </a>
    </div>
    <?php  $i++; ?>
    <?php endwhile; ?>
</div>     
<!-- /photo list Normal 2 -->      