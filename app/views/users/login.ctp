<!-- photo list Big -->
<div class="photoListBig rightMargin5px leftcol">
    <?php 
    $numbers = range(1, 19);
shuffle($numbers);
    
    ?>
    
    <?php $i = 0; ?>
    <?php while ($i < 5): ?>
    <div class="photo radiux3px">
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>"><img src="<?php echo $list[$numbers[$i]]['Photo']['fbpath'];?>" width="260px" alt="" /></a>
            <!--
            <div class="photoUnderBig">
                <div id="fb-root"></div><script src="#"></script><fb:like href="#" send="false" layout="button_count"width="250" show_faces="false" font=""></fb:like>
            </div>
            -->
        </div>
    <?php  $i++; ?>
    <?php endwhile; ?>

</div>
<!-- /photo list Big -->

<!-- photo list Normal 1 -->
<div class="photoList rightMargin5px leftcol">
    <?php $i = 6; ?>
    <?php while ($i < 13): ?>
        <div class="photo radiux3px">
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>"><img src="<?php echo $list[$numbers[$i]]['Photo']['fbpath']; ?>" width="190px" alt="" /></a>
            <!--

            <div class="photoUnder">
                <div id="fb-root"></div><script src="#"></script><fb:like href="#" send="false" layout="button_count"width="180" show_faces="false" font=""></fb:like>
            </div>
            -->
        </div>
    <?php  $i++; ?>
    <?php endwhile; ?>
</div>
<!-- /photo list Normal 1 -->
<!-- photo list Normal 2 -->
<div class="photoList leftcol">
    <?php $i = 13; ?>
    <?php while ($i < 18): ?>
    <div class="photo radiux3px">
            <a href="/users/fbpict_like/<?php echo $list[$numbers[$i]]['Photo']['id'];?>"><img src="<?php echo $list[$numbers[$i]]['Photo']['fbpath']; ?>" width="190px" alt="" /></a>
            <!--
         <div class="photoUnder">
             <div id="fb-root"></div><script src="#"></script><fb:like href="#" send="false" layout="button_count"width="180" show_faces="false" font=""></fb:like>
         </div>
            -->
        </div>
    <?php  $i++; ?>
    <?php endwhile; ?>
</div>     
<!-- /photo list Normal 2 -->      

