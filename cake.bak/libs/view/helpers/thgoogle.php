<?php
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * Thgoogle Helper :  On CakePHP
 * Copyright 2008-2009, auto encoding behavior. (http://blog.widget-info.net)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2008-2009, blog.widget-info.net
 * @since         ThgoogleHelper on CakePHP v 1.2.0
 * @version       $Revision: 1.0.0 $
 * @modifiedby    $LastChangedBy: blog.widget-info.net $
 * @lastmodified  $Date: 2009-10-15 $
 * @license       MIT License
 */
class ThgoogleHelper extends AppHelper
{
	/*---------------------------------------------------------------------------------------
	 * Setting
	 ---------------------------------------------------------------------------------------*/
	//Import helpers
	var $helpers = array('Ajax');
	
	/*---------------------------------------------------------------------------------------
	 * Methods
	 ---------------------------------------------------------------------------------------*/
	
	/** googlemap
	 * API v3
	 * 
	 * [$scripts_for_layout] auto write in <head>.iPhone and Android is Sensor value to true
	 * <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=ja"></script>
	 * 
	 * Default lat and lng is Tokyo tower
	 * 
	 * $option=array(
	 *		'width'=>'width value',							//default 500
	 *		'height'=>'height value',						//default 500
	 *		'zoom'=>'zoom levle',							//default 12[0-19]
	 *		'lat'=>'lat value',								//default 35.65861
	 *		'lng'=>'lng value',								//default 139.745447
	 *		'marker'=>If $marker is NULL to this marker,	//default boolean true
	 *		'title'=>'title value',							//default NULL
	 *		'type'=>'googlemap map type value',				//default R [R|S|H|T]
	 *		'onLoad'=>this script initialize() load,		//default boolean false 
	 *		'scripts'=>'other script'						//default NULL [other script]
	 *	);
	 * 
	 * MAP TYPE
	 * 	R : ROADMAP
	 * 	S : SATELLITE
	 * 	H : HYBRID
	 * 	T : TERRAIN
	 * 
	 * 
	 * $marker=array(
	 * 	'marker name'=>array(
	 * 		'lat'=>'lat value',
	 * 		'lng'=>'lng value',
	 * 		'title'=>'lat title'
	 * 	)
	 * )
	 * 
	 * $infowindow=array(
	 * 	'marker name'=>array(
	 * 		'string'=>'string value',
	 * 		'width'=>'width value',
	 * 		'height'=>'height title'
	 * 	)
	 * )
	 * 
	 */
	function googlemap($domId=NULL,$option=array(),$marker=array(),$infowindow=array()){
		if(empty($domId)){$domId=$this->dfaoultDomId;}
		if(!is_array($infowindow)){$infowindow=array();}
		//Setting merge
		$op=array_merge($this->gOption,$option);
		$scripts=NULL;
		if(isset($op['scripts'])){
			$scripts=$op['scripts'];
			unset($op['scripts']);
		}
		//Select map type
		$_gMap=(in_array($op['type'],array_keys($this->_gMap)))?$this->_gMap[$op['type']]:current($this->_gMap);
		$divArea=sprintf($this->tagMap['div'],$domId);
		//Markers
		$markers='';
		if(empty($marker) && $op['marker']){
			$marker=array($this->dfaoultMarkerName=>array('lat'=>$op['lat'],'lng'=>$op['lng'],'title'=>$op['title']));
		}
		if(!empty($marker)){
			$markerList=array();
			$markerList=$this->__marker($marker,$infowindow);
			$markers=implode("",$markerList);
		}
		//bind option
		$addOptions=$markers;
		if(!empty($scripts)){
			$addOptions.="\n".$scripts;
		}
		//Create map
		$this->Ajax->Javascript->link($this->__getGoogleMapUrl(),false);
		$divSize=$this->__divSize($op['width'],$op['height']);
		if($this->sensor == 'true'){
			$op['onLoad']=false;
		}
		$code=sprintf($this->tagMap['map'],
			$domId,
			$divSize,
			$op['zoom'],
			$op['lat'],
			$op['lng'],
			$_gMap,
			$addOptions
		);
		//Inline link google
		
		if($op['onLoad']){
			$code=$this->__initialize($code);
			$this->Ajax->Javascript->codeBlock($code,array('allowCache'=>true,'inline'=>false));
			return $divArea;
		}else{
			return $divArea.$this->Ajax->Javascript->codeBlock($code);
		}
	}
	//__getGoogleMapUrl()
	function __getGoogleMapUrl(){
		$this->__autoMapHader();
		return $this->googleUrl.'?sensor='.$this->sensor.'&amp;language='.$this->lang;
	}
	//__autoMapHader()
	function __autoMapHader(){
		$this->sensor=(preg_match("/iPhone|Android/",$_SERVER['HTTP_USER_AGENT']))?'true':'false';
	}
	//__divSize()
	function __divSize($width=0,$height=0){
		if($this->sensor == 'false'){
			return sprintf($this->tagMap['divSize']['pc'],$width,$height);
		}else{
			return sprintf($this->tagMap['divSize']['m'],$width,$height);
		}
	}
	//__marker()
	function __marker($marker=array(),$infowindow=array()){
		$markerList=array();
		foreach($marker as $markerName => $mValue){
			extract($mValue);
			$markerList[]=sprintf($this->tagMap['marker'],$markerName,$lat,$lng,$title);
			if(isset($infowindow[$markerName])){
				$infoName=$markerName.'Info';
				$markerList[]=$this->__infowindow($infoName,$markerName,$infowindow[$markerName]);
			}
		}
		return $markerList;
	}
	//__infowindow()
	function __infowindow($infoName,$markerName,$infowindow){
		extract($infowindow);
		if(!empty($string)){$string=nl2br($string);}
		return sprintf($this->tagMap['infowindow'],$infoName,$string,$width,$height,$markerName,$infoName,$markerName);
	}
	//__initialize()
	function __initialize($code){
		return sprintf($this->tagMap['initialize'],$code);
	}
	
	/*---------------------------------------------------------------------------------------
	 * googlemap Setting Not Change
	 ---------------------------------------------------------------------------------------*/
	//Default foofle API URL
	var $googleUrl='http://maps.google.com/maps/api/js';//?sensor=false&amp;language=
	var $lang='ja';
	var $sensor='false';
	//Default option
	var $gOption=array(
		'width'=>'500',
		'height'=>'500',
		'zoom'=>'12',
		'lat'=>'35.65861',
		'lng'=>'139.745447',
		'marker'=>true,
		'title'=>'',
		'type'=>'R',
		'onLoad'=>false,
		'scripts'=>NULL
	);
	//Default DOM ID
	var $dfaoultDomId='googleMapDiv';
	//Default marker name
	var $dfaoultMarkerName='marker';
	//Google map type
	var $_gMap=array(
		'R'=>'ROADMAP','S'=>'SATELLITE','H'=>'HYBRID','T'=>'TERRAIN'
	);
	
	var $tagMap=array(
'div'=>'<div id="%s">&nbsp;</div>',
'divSize'=>array(
	'pc'=>"
	mapdiv.style.width = '%spx';
	mapdiv.style.height = '%spx';
",
	'm'=>"
	mapdiv.style.width = '%spx';
	mapdiv.style.height = '%spx';
"
),
'map'=>"
google.maps.event.addDomListener(window, 'load', function() {
	var useragent = navigator.userAgent;
	var mapdiv = document.getElementById('%s');
	
	%s
	var myOptions = {
		zoom: %s,
		center: new google.maps.LatLng(%s,%s),
		mapTypeId: google.maps.MapTypeId.%s,
		scaleControl: true,
	};
	var map = new google.maps.Map(mapdiv, myOptions);
	%s
});",
'marker'=>"
	var %s = new google.maps.Marker({
		position: new google.maps.LatLng(%s, %s),
		map: map,
		title: '%s'
	});",
'infowindow'=>"
	var %s = new google.maps.InfoWindow({
		content: '%s',
		size: new google.maps.Size(%s,%s)
	});
	google.maps.event.addListener(%s, 'click', function() {
		%s.open(map,%s);
	});",
'initialize'=>"
	var map;
	document.body.onload=initialize();
	function initialize() {
		%s
	}
"
);
}
?>
