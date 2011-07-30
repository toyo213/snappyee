
<img src="/img/geegee_title_pink.png" width="200" height="66"></img>

<?php var_dump($fbuser);?>

<?php foreach ($fbuser as $key => $val):?>
<?php // echo $key.' : '.$val; ?>
<?php endforeach;?>


<?php
echo $form->create('User',array('type' => 'post','url' =>   '/users/regist_end'));
//echo $form->input('comment');
//echo $form->input('ido');
//echo $form->input('kdo');
//echo "<fieldset>";
echo "<dl>";
echo  "<legend>";
echo "<font color=red>"; 
echo __('Gee Gee Create Account');
echo "</font>";
echo "</legend>";
echo "<br/>";

echo "<dt class=txtbold>";
echo __('User Name');
echo "</dt>";

echo $form->input('nickname' ,array('type'=>'text','label'=>'','value'=>$fbuser["name"], 'vertical-align'=>'middle','text-align'=>'right'));
echo "<br/>";
echo "<dt class=txtbold>";
echo __('Profile URL');
echo "</dt>";
echo $form->input('blogurl', array('type'=>'text','label'=>'','value'=>$fbuser["link"]));
//echo $form->hidden('id', array('value'=>$list[0]['People']['id']));
echo "</dl>";
echo "<br/><dd>";?>

<dt class="textbold">
<?php echo __('Fashion Magazines you often read'); ?>
</dt>
<?php echo $form->input('magazines',array('type'=>'text','label'=>''));?>


<dt class="textbold">
<?php echo __('Occupations'); ?>
</dt>
<?php echo $form->input('occupations',array('type'=>'text','label'=>''));?>

<dt class="textbold">
<?php echo __('Interests'); ?>
</dt>
<?php echo $form->input('interests',array('type'=>'text','label'=>''));?>

<dt class="textbold">
Locations
</dt>


<script type="text/javascript"> 
//<![CDATA[
var gLocalSerch;
var gMap;
 
function serch(){
	//検索対象の地域を地図の表示位置に設定
	gLocalSearch.setCenterPoint(gMap);
	//テキストボックスの値で検索
	gLocalSearch.execute(document.getElementById('q').value)
}
function onLocalSearch(){
	//取得できたか判定
	if(gLocalSearch.results.length > 0){
		//検索結果からマーカーを作成
		for(var i = 0;i < gLocalSearch.results.length;i++ ){
			setMarker(gLocalSearch.results[i]);
		}
		//検索結果の最初の座標に移動
		gMap.setCenter(new GLatLng(gLocalSearch.results[0].lat,gLocalSearch.results[0].lng));
	}
	else{
		window.alert("見つかりません");
	}
}
 
function setMarker(result){
	//マーカーを作成
	var marker = new GMarker(new GLatLng(parseFloat(result.lat),parseFloat(result.lng)));
	GEvent.addListener(marker, "click", function() {
		marker.openInfoWindow(result.html);
	});
	gMap.addOverlay(marker);
}
 
//]]>
</script> 


<div id="map" style="width:500px;height:400px;"></div> 
<input type="text" id="q" style="width:400px;"  /> 
<input type="button" id="s"  value="検索" onclick="serch();"/><br> 
<a href="http://www.google.com/uds/samples/places.html">http://www.google.com/uds/samples/places.html</a>を参考に作成しました。<br> 
ＡＰＩの解説は<a href="http://code.google.com/apis/ajaxsearch/">http://code.google.com/apis/ajaxsearch/</a><br> 
<script type="text/javascript"> 
	//<![CDATA[
 
	//Google Maps APIオブジェクト作成＆初期化
	gMap = new GMap2(document.getElementById("map"));
	gMap.addControl(new GLargeMapControl());
	gMap.addControl(new GMapTypeControl());
	gMap.addControl(new GScaleControl());
	gMap.setCenter(new GLatLng(36.566486260884,137.66196124364),13,G_NORMAL_MAP);
 
	//Google AJAX Search APIのlocalserchするためのオブジェクト作成
	gLocalSearch = new GlocalSearch();
	//検索結果が返ってきたときに実行するメソッドを設定
	gLocalSearch.setSearchCompleteCallback(null, onLocalSearch);
 
	//]]>
</script> 

<div id="map" style="width:500px;height:400px;"></div> 

<input type="submit" value="<?php echo __('Create Account'); ?>" />

<?php 
echo $form->end();
echo "</dd>";
?>
				