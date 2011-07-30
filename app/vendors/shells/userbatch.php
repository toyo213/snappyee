<?php

class UserBatchShell extends Shell {

    //var $uses = array('Model');//モデルを使用する場合指定しておく
    var $today = '';
    var $uses = array('Photo_pv','Photo_uu');

    function main() {
        $this->today = date("Ymd");
        $end_time = $this->getBeforeExecutetime();

        CakeLog::write('batch', sprintf("%s %s", __FILE__, 'start'));
        $data = $this->getData($end_time);        
        $save = $this->saveData($data);
        CakeLog::write('batch', sprintf("%s %s", __FILE__, 'end'));
    }

    // 前回実施した時間を取得する
    function getBeforeExecutetime() {
       $log = sprintf('%s/%s_batch.log',LOGS,$this->today);
       $data = file($log);
       $last_row = trim(end($data));
       $row = split(' ',$last_row);
       return $row[1]; // endtime  
    }
        
    // データ取得
    function getData($end_time) {
        
        $log = sprintf('%s/%s_fbpict_like.log',LOGS,$this->today);
        $data = file($log);
        foreach ($data as $key => $val) {
            $row = split(' ',trim($val));
            // 直近のPV用
            if ($row[1] >= $end_time) {  
                $rows_detail[$row['4']][$row['3']] = ''; 
                if (isset($rows[$row['4']])) {
                  $rows[$row['4']]++;
               } else {
                  $rows[$row['4']] = 1;
               }
            }
            // UUは1日のデータをなめる必要あり
        }
        var_dump($rows);
        var_dump($rows_detail);
       
        // get UU data
        // get PV data
        $ret = array();
        $ret['pv'] = $rows;
        $ret['uu'] = $rows_detail;

        return array($ret);
    }

    // データ入力
    function saveData($data) {

        // 既存データ収集
        $res = $this->Photo_pv->find('all', array('conditions' => array('Photo_pv.date' => $this->today)));
        $pv_arr = array();
        foreach ($res as $key => $val) {
            $pv_arr[$val['Photo_pv']['pid']] = $val['Photo_pv']['pv'];
        }
        
        foreach ($data[0]['pv'] as $key => $val) {
            $_data['Photo_pv']['date'] = $this->today;
            $_data['Photo_pv']['pid'] = $key;
            $_data['Photo_pv']['pv'] = $val;

            if (isset($pv_arr[$key])) {
                // countup
                $cntup = sprintf("pv +%s",$val);
                echo $key.'-'.$cntup."\n";
                $this->Photo_pv->updateAll(array('pv' => $cntup), array('pid' => $key),array('date' => $this->today ));
            } else {
                // 新規
                $result = $this->Photo_pv->save($_data);
            }
        }
        return array();
    }

    // お掃除
    function cleanData() {
        return array();
    }
 
}