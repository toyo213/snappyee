        <div class="photoList rightMarginS leftcol"> 
        <img src="<?php echo $lists['Photo']['fbpath'];?>"  width="400"></img>
        <br/>
        </div>

        <div class="photoDetail rightMarginS rightcol"> 
        <h1>
        <font size="4"><?php echo __('You Like This Photo?');?></font> 
        </h1>

        <?php if($isLike==false):  ?>
        <script>
        $(function() {
            $('#change_btn').click(function() {
            $("#change_area").html('<img src="/img/ajax-loader.gif" width="30" height="30" alt="Now Loading..." />');
            $.post('/users/like/<?php echo $lists['Photo']['id'];?>',
                    {
                        name : $('#name').attr('value')
                    },
                    callBack);
            });
        });

        function callBack(data) {
            $('#change_area').html(data);
            $('#b_erace').hide();
        }
        </script>
        <span id="change_area"><span class="likeFontBig"><?php echo sprintf("%03d",(int)$result['Photo']['cnt']);?></span>likes</span>
        <div id="b_erace">

        <div class="like_on_big like_button radiux3px" id="change_btn"><?php echo __('Like!'); ?></div>
        <!--
        <form action="" id="form1" method="post">
        <button type="button" src="/img/icn_yes.gif" id="change_btn" value="like" /> 
        <img src="/img/icn_yes.gif" />
        </button>    
        </form>
        -->
        </div>
        <?php else:  ?>    
        <span class="likeFontBig"><?php echo sprintf("%03d",$result['Photo']['cnt']);?></span><span style="font-family:Shruti;">likes</span>
        <?php endif;  ?>
        <br><?php echo __('Uploaded');?> by <a href="../profile?pid=<?php echo $lists['Photo']['id'];?>"><font size="3"><?php echo $lists['User']['nickname'];?> </a>&nbsp;(<a href="<?php echo $lists['User']['blogurl'];?>">Blog</font></a>)<br>
        <?php echo $lists['Photo']['comment'];?><br>
        <?php echo $facebook->like(array('show_faces'=>"false",'href'=>"http://".$_SERVER['SERVER_NAME']."/users/fbpict_like/".$lists['Photo']['id']));?>

        <!-- like user-->
        Like user<br>
        <?php
        $tmp = array();
        echo '<ul id="banner">';
            foreach ($likeuser as $key => $val) {
                if (!isset($tmp[$val['Photo_like_log']['fb_id']])) {
                  echo '<li><div class="photo photoFloat">';
                  $img = $facebook->picture($val['Photo_like_log']['fb_id'], array('width' => '26', 'height' => '26'));
                  $pt = '<a href="/users/profile?pid=%s">%s</a></div></li>';
                  echo sprintf($pt, $val['Photo_like_log']['fb_id'],$img)."\n";
                }
                $tmp[$val['Photo_like_log']['fb_id']] = '';
            }
            echo '</ul>';
        ?>
        <br>
        <br>
        <br>
        <br>
        <!-- like user-->
        <!-- my album-->
        Other pictures<br>

        <?php
        echo '<ul id="banner">';
            foreach ($album as $key => $val) {
                echo '<li><div class="photo photoFloat">';
                $pt = '<a href="/users/fbpict_like/%s"><img src="%s" height="30px" /></a></div></li>';
                  echo sprintf($pt, $val['Photo']['id'], $val['Photo']['fbpath']) . "\n";
            }
            echo '</ul>';
        ?>
        <!-- my album-->

        </div>
        <?php //echo $facebook->comments(array('href'=>"http://".$_SERVER['SERVER_NAME']."/users/fbpict_like/".$lists['Photo']['id'], 'width' => '400')); ?>
        <?php echo $facebook->comments(array('href'=>"http://".$_SERVER['SERVER_NAME']."/users/fbpict_like/".$lists['Photo']['id'])); ?>