<?php

class UserBatchShell extends Shell {

    //var $uses = array('Model');//モデルを使用する場合指定しておく
    var $today = '';

    function main() {
        $this->today = date("Ymd");
        // ロギング
        CakeLog::write('batch', sprintf("%s %s", __FILE__, 'start'));
        $data = $this->getData();
        $calc = $this->calcData($data);
        $save = $this->saveData($calc);

        CakeLog::write('batch', sprintf("%s %s", __FILE__, 'end'));
    }

    // 前回実施した時間を取得する
    function getBeforeExecutetime() {
    }
        
    // データ取得
    function getData() {
        print sprintf('%s/%s__fbpict_like.log',LOGS,$this->today);
        // get UU data
        // get PV data
        return array();
    }

    // データ計算
    function calcData() {
        return array();
    }

    // データ入力
    function saveData() {
        return array();
    }

    // お掃除
    function cleanData() {
        return array();
    }

 
}