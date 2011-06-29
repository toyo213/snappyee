<?php
$numbers = range(0, 19);
shuffle($numbers);
?>

    
    <!-- photo list Big -->
<div class="photoList rightMarginS leftcol">
    
    <?php $i = 0; ?>
    <?php while ($i < 5): ?>
        <?php if(isset($list[$numbers[$i]])): ?>
    <div class="photo radiux3px">
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>"><img src="<?php echo $list[$numbers[$i]]['Photo']['fbpath'];?>" width="163px" alt="" /></a>
        </div>
    <?php endif; ?>
    <?php  $i++; ?>
    <?php endwhile; ?>

</div>
<!-- /photo list Big -->

<!-- photo list Normal 1 -->
<div class="photoList rightMarginS leftcol">
    <?php $i = 6; ?>
    <?php while ($i < 10): ?>
    <?php if(isset($list[$numbers[$i]])): ?>
    <div class="photo radiux3px">
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>"><img src="<?php echo $list[$numbers[$i]]['Photo']['fbpath']; ?>" width="163px" alt="" /></a>
        </div>
    <?php endif; ?>
    <?php  $i++; ?>
    <?php endwhile; ?>
</div>
<!-- /photo list Normal 1 -->

<!-- photo list Normal 1 -->
<div class="photoList rightMarginS leftcol">
    <?php $i = 10; ?>
    <?php while ($i < 13): ?>
    <?php if(isset($list[$numbers[$i]])): ?>
    <div class="photo radiux3px">
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>"><img src="<?php echo $list[$numbers[$i]]['Photo']['fbpath']; ?>" width="163px" alt="" /></a>

   </div>
    <?php endif; ?>   
    <?php  $i++; ?>
    <?php endwhile; ?>
</div>
<!-- /photo list Normal 1 -->

<!-- photo list Normal 2 -->
<div class="photoList leftcol">
    <?php $i = 13; ?>
    
    <?php while ($i < 18): ?>
    <?php if(isset($list[$numbers[$i]])): ?>
    <div class="photo radiux3px">
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>"><img src="<?php echo $list[$numbers[$i]]['Photo']['fbpath']; ?>" width="163px" alt="" /></a>
        </div>
     <?php endif; ?>
    <?php  $i++; ?>
    <?php endwhile; ?>
</div>     
<!-- /photo list Normal 2 -->      