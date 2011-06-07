<!-- photo list Big -->
<div class="photoListBig rightMargin5px leftcol">
    <?php foreach ($list as $key => $val): ?>
        <div class="photo radiux3px">
            <a href="../fbpict_like/<?php echo $val['Photo']['id']; ?>"><img src="<?php echo $val['Photo']['fbpath']; ?>" width="260px" alt="" /></a>
            <!--
            <div class="photoUnderBig">
                <div id="fb-root"></div><script src="#"></script><fb:like href="#" send="false" layout="button_count"width="250" show_faces="false" font=""></fb:like>
            </div>
            -->
        </div>
    <?php endforeach; ?>         

</div>
<!-- /photo list Big -->

<!-- photo list Normal 1 -->
<div class="photoList rightMargin5px leftcol">
    <?php foreach ($list as $key => $val): ?>
        <div class="photo radiux3px">
            <a href="../fbpict_like/<?php echo $val['Photo']['id']; ?>"><img src="<?php echo $val['Photo']['fbpath']; ?>" width="190px" alt="" /></a>
            <!--

            <div class="photoUnder">
                <div id="fb-root"></div><script src="#"></script><fb:like href="#" send="false" layout="button_count"width="180" show_faces="false" font=""></fb:like>
            </div>
            -->
        </div>
    <?php endforeach; ?>
</div>
<!-- /photo list Normal 1 -->
<!-- photo list Normal 2 -->
<div class="photoList leftcol">
    <?php foreach ($list as $key => $val): ?>
        <div class="photo radiux3px">
            <a href="../fbpict_like/<?php echo $val['Photo']['id']; ?>"><img src="<?php echo $val['Photo']['fbpath']; ?>" width="190px" alt="" /></a>
            <!--
         <div class="photoUnder">
             <div id="fb-root"></div><script src="#"></script><fb:like href="#" send="false" layout="button_count"width="180" show_faces="false" font=""></fb:like>
         </div>
            -->
        </div>
    <?php endforeach; ?> 
</div>     
<!-- /photo list Normal 2 -->      