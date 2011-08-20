<?php $this->addScript($javascript->link("http://www.google.com/jsapi")); ?>
<h1>New Photo!!</h1>
<?php
if(is_null($pid)) { 
  foreach ($list as $key => $val) {
      print sprintf('<a href="/photos/main/pid/%s"><img src="%s" width="80px"></img></a>',$val['Photo']['id'],$val['Photo']['fbpath']);
  }
} else {
  foreach ($list as $key => $val) {
      if ($val['Photo']['id'] == $pid) {
        print sprintf('<a href="/photos/main/pid/%s"><img src="%s" width="80px"></img></a>',$val['Photo']['id'],$val['Photo']['fbpath']);
      }    
  }
}
?>

   <div id="chart"></div>
   <script type="text/javascript">
      var queryString = '';
      var dataUrl = '';

      function onLoadCallback() {
        if (dataUrl.length > 0) {
          var query = new google.visualization.Query(dataUrl);
          query.setQuery(queryString);
          query.send(handleQueryResponse);
        } else {
          var dataTable = new google.visualization.DataTable();
          dataTable.addRows(<?php echo count($pv);?>);

          dataTable.addColumn('number');
          dataTable.addColumn('number');
          <?php 
          $i =0 ;
          foreach ($pv as $key => $val ) {
            echo sprintf('dataTable.setValue(%s, 0, %s);'."\n",$i,$val['Photo_pv']['pv']);   
            echo sprintf('dataTable.setValue(%s, 1, %s);'."\n",$i,$val['Photo_pv']['pv'] -30 );   
            $i++;
          }          
          ?>
          /*
          dataTable.setValue(0, 0, 58.899579860735685);
          dataTable.setValue(0, 1, 65.9);
          dataTable.setValue(1, 0, 50.46128684790649);
          dataTable.setValue(1, 1, 48.599);
          dataTable.setValue(2, 0, 52.343444024154444);
          dataTable.setValue(2, 1, 44.149);
          dataTable.setValue(3, 0, 41.65319748261632);
          dataTable.setValue(3, 1, 45.519);
          dataTable.setValue(4, 0, 41.07887886454893);
          dataTable.setValue(4, 1, 39.06);
          dataTable.setValue(5, 0, 50.063754195386224);
          dataTable.setValue(5, 1, 22.948);
          dataTable.setValue(6, 0, 45.25780461311417);
          dataTable.setValue(6, 1, 18.421);
          dataTable.setValue(7, 0, 39.69625377251456);
          dataTable.setValue(7, 1, 40.776);
          dataTable.setValue(8, 0, 40.331027215773545);
          dataTable.setValue(8, 1, 41.678);
          dataTable.setValue(9, 0, 45.91694446484325);
          dataTable.setValue(9, 1, 47.819);
          dataTable.setValue(10, 0, 44.48440482025034);
          dataTable.setValue(10, 1, 40.294);
          dataTable.setValue(11, 0, 48.442298626663);
          dataTable.setValue(11, 1, 45.738);
          dataTable.setValue(12, 0, 40.82864829125659);
          dataTable.setValue(12, 1, 58.639);
          dataTable.setValue(13, 0, 44.481028774074126);
          dataTable.setValue(13, 1, 62.641);
          dataTable.setValue(14, 0, 44.28166908910498);
          dataTable.setValue(14, 1, 75);
          dataTable.setValue(15, 0, null);
          dataTable.setValue(15, 1, 100);
          dataTable.setValue(16, 0, null);
          dataTable.setValue(16, 1, 30);
          */
          draw(dataTable);
        }
      }

      function draw(dataTable) {
        var vis = new google.visualization.ImageChart(document.getElementById('chart'));
        var options = {
          chxl: '0:|1st|2nd|3rd|4th|1:|0|50|100|2:|0|25|50|75|100',
          chxp: '',
          chxr: '0,0,1025',
          chxs: '0,FF28C0,14,0.5,lt,676767',
          chxtc: '',
          chxt: 'x,r,y',
          chs: '260x150',
          cht: 'ls',
          chco: 'FF38C0,00FF00',
          chd: 't:58.9,50.461,52.343,41.653,41.079,50.064,45.258,39.696,40.331,45.917,44.484,48.442,40.829,44.481,44.282|65.9,48.599,44.149,45.519,39.06,22.948,18.421,40.776,41.678,47.819,40.294,45.738,58.639,62.641,75,100,30',
          chdl: '|',
          chdlp: 'b',
          chg: '10,25,0,4',
          chls: '3|3',
          chma: '10,10,10,10'
        };
        vis.draw(dataTable, options);
      }

      function handleQueryResponse(response) {
        if (response.isError()) {
          alert('Error in query: ' + response.getMessage() + ' ' + response.getDetailedMessage());
          return;
        }
        draw(response.getDataTable());
      }

      google.load("visualization", "1", {packages:["imagechart"]});
      google.setOnLoadCallback(onLoadCallback);

    </script>