<?php
if (in_array($myinputs['group'],array_keys($available_groups))) {
  //Include variables for each group. Use group name for the argument
  //e.g. php detect_html.php dfid
  require_once 'variables/' .  $_GET['group'] . '.php';
  require_once 'functions/xml_child_exists.php';
  $participating_org_ref_count = 0;
  $exclude = array("GB","EU");
  $bad_codes = array();
  $bad_files = array();

  include_once('helpers/parse_csv.php');
  //$unique_codes = array_keys($codes);
  //if (array_key_exists('41300', $codes)) {
    //   echo "iuyyu";
  //}
  //die;
  //print_r($unique_codes);
  //die;
  if ($handle = opendir($dir)) {
      //echo "Directory handle: $handle\n";
      //echo "Files:\n";

      /* This is the correct way to loop over the directory. */
      while (false !== ($file = readdir($handle))) {
          if ($file != "." && $file != "..") { //ignore these system files
              //echo $file . PHP_EOL;
              //load the xml
              if ($xml = simplexml_load_file($dir . $file)) {;
              //print_r($xml); //debug
                  foreach ($xml as $activity) {
                      //CHECK: Participating Org code is on the code list
                      foreach ($activity->{'participating-org'} as $participating_org) {
                          $participating_org_ref = (string)$participating_org->attributes()->ref;
                          if (!array_key_exists($participating_org_ref, $codes) && !in_array($participating_org_ref,$exclude)) {
                              array_push($bad_codes,$participating_org_ref);
                              array_push($bad_files,$url . $file);
                              //echo $url . $file . PHP_EOL;
                              $participating_org_ref_count ++;
                              //continue 3;
                          }
                      }
                      
                      //CHECK: Participating org Code matches output text
                      foreach ($activity->{'participating-org'} as $participating_org) {
                          $participating_org_ref = (string)$participating_org->attributes()->ref;
                          //if ($participating_org_ref == NULL) { $participating_org_ref = ""; }
                          //echo $participating_org_ref . PHP_EOL;
                          if (array_key_exists($participating_org_ref, $codes) && !in_array($participating_org_ref,$exclude)) {
                              if ($codes[$participating_org_ref][2] == $participating_org[0]) {
                                //echo "match";
                              } else {
                                //echo "mismatch";
                                $expected = $codes[$participating_org_ref][2];
                                $found = $participating_org[0];
                                if ($participating_org_ref == NULL) { $participating_org_ref = "empty string"; } //no-ref given
                                $rows .= '<tr><td>'. $participating_org_ref . '</td><td>' . $expected . '</td><td>' . $found . '</td><td>' . $file . '</td></tr>';
                                //echo '"'. $participating_org_ref . '","' ;
                                //echo $codes[$participating_org_ref][2] . '","';
                                //echo $participating_org[0] . '","' . $file . '"' . PHP_EOL;
                              }
                              
                          }
                           
                              //echo $participating_org_ref . " - " ;
                              //echo $participating_org[0] . " - " . $file . PHP_EOL;
                        
                      }
                      //print_r($activity);
                      //die;
                      //CHECK: Participating Org Code exists!
                      /*foreach ($activity->{'participating-org'} as $participating_org) {
                          $participating_org_ref = (string)$participating_org->attributes()->ref;
                              if ($participating_org_ref == NULL) {
                                  echo $participating_org_ref . " - " ;
                                  echo $participating_org[0] . " - " . $file . PHP_EOL;
                              }
                            }
                      }
                      //print_r($activity);
                      //die;
                      */
              }
                  
                  
              } else { //simpleXML failed to load a file
                  //echo $file . ' empty';
              }
              
          }// end if file is not a system file
      } //end while
      closedir($handle);
  }
  
  print('<div id="main-content">');
     //Print out a table of all the files that have a good file count
    print("
      <p class='table-title'>Table of mismatch &lt;participating-org&gt; code strings to found string.</p>
      <table id='table' class='sortable'>
        <thead>
          <tr>
            <th><h3>Partcipating Org Ref</h3></th>
            <th><h3>Expected</h3></th>
            <th><h3>Found</h3></th>
            <th><h3>File</h3></th>
          </tr>
        </thead>
        <tbody>
        ");
        echo $rows;
    print("</tbody>
        </table>");
        
          print("
      <p class='table-title'>Table of &lt;participating-org&gt; codes not on code lists.</p>
      <p>Occurances: " . count($bad_codes). " from " . count(array_unique($bad_files)) . " affected files.</p>
      <table id='table2' class='sortable'>
        <thead>
          <tr>
            <th><h3>Code</h3></th>
          </tr>
        </thead>
        <tbody>
        ");
        $bad_codes = array_unique($bad_codes);
        sort($bad_codes);
        foreach ($bad_codes as $code) {
          echo "<tr><td>" . $code ."</td></tr>";
        }
    print("</tbody>
        </table>");
    
    //echo $participating_org_ref_count;
    
    //$bad_codes = array_unique($bad_codes);
    //sort($bad_codes);
    //print_r($bad_codes). PHP_EOL;
    //print_r(array_unique($bad_files)). PHP_EOL;
    //echo count(array_unique($bad_files)). PHP_EOL;
    
    print('<div class="notes"><p>Excluded codes:</p>
    <ul>');
    foreach ($exclude as $ex) {
          echo "<li>" . $ex ."</li>";
        }
    print('</ul>
    </div>');
  print('</div>'); 
}
?>
<script type="text/javascript" src="javascript/tinytable/script.js"></script>
	<script type="text/javascript">
  var sorter = new TINY.table.sorter("sorter");
	sorter.head = "head";
	sorter.asc = "asc";
	sorter.desc = "desc";
	sorter.even = "evenrow";
	sorter.odd = "oddrow";
	sorter.evensel = "evenselected";
	sorter.oddsel = "oddselected";
	sorter.paginate = true;
	sorter.currentid = "currentpage";
	sorter.limitid = "pagelimit";
	sorter.init("table");
  </script>
