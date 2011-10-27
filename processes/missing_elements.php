<?php
if (in_array($myinputs['group'],array_keys($available_groups))) {
    //Include variables for each group. Use group name for the argument
    //e.g. php detect_html.php dfid
    require_once 'variables/' .  $_GET['group'] . '.php';
    require_once 'functions/xml_child_exists.php';
    
    $elements = array('activity-date',
                      'participating-org',
                      'transaction'
                      );
    
    $results = files_with_no_elements ($elements);


    print('<div id="main-content">');
    
      //Print out Files with no elements
      if ($results["missing"] != NULL) {
        echo "<h3>Missing Elements Summary</h3>";
        theme_how_many_of_each ($results["missing"]);
      } else {
          echo "<h3>Missing Elements Summary</h3>";
          echo '<p class="tick">All files have AT LEAST one of the elements we are checking for.</p>';
      }
      
      if (!empty($results["rows"])) {
        print('<p class="table-title check">Table of files with missing elements</p>');
            print('<table id="table1" class="sortable">
                <thead>
                  <tr>
                    <th><h3>Element</h3></th>
                    <th><h3>File</h3></th>
                  </tr>
                </thead>
                <tbody>' . $results["rows"] . '</tbody>
                </table>');
        }



        //Print out Files and activities with missing elements
        $files_with_no_elements = $results["files"];
        $activities = activites_with_elements($elements);
        $files_with_some_activities_missing_some_elements = $activities["files"];
        $additional_files = array_diff($files_with_some_activities_missing_some_elements, $files_with_no_elements);


        if (!empty($activities["rows"])) {
            echo "<p class='table-title check'>Table of additional files with SOME activities missing elements</p>";
                print('<table id="table2" class="sortable">
                    <thead>
                      <tr>
                        <th><h3>Element</h3></th>
                        <th><h3>Identifier</h3></th>
                        <th><h3>File</h3></th>
                      </tr>
                    </thead>
                    <tbody>' . $activities["rows"] . '</tbody>
                    </table>');
            }


    print('</div>');
}

function files_with_no_elements ($elements) {
    global $dir;
    global $url;
    $missing= array();
    $files = array();
    $rows = '';
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
                  if(!xml_child_exists($xml, "//iati-organisation"))  { //exclude organisation files
                    //We're just checking each file for at least one occurance!!
                    
                        foreach ($elements as $element) {
                            //we can test conditions for elements of the activity data here
                            // the $relative_to allows us to search relative to root (//) or element (.//)
                            if(xml_child_exists($xml, "//" . $element))  {           
                                //echo $i . 'Yes'.PHP_EOL;
                                //print_r($activity->transaction);
                                //die;
                            } else {
                                //Not found
                                $rows .='<tr><td>' .  $element . '</td><td>' . $url . $file .'</td></tr>';
                                //echo '"' .  $element . '","' . $activity->{'iati-identifier'} . '","' . $url . '","' . $file .PHP_EOL;
                                array_push($missing, $element);
                                array_push($files,$file);
                                //continue 3;
                            }
                        }
                    
                    
                   } 
                } else { //simpleXML failed to load a file
                    //echo $file . ' empty';
                }
                
            }// end if file is not a system file
        } //end while
        closedir($handle);
        
    }
    return array("rows" => $rows,
                  "missing" => $missing,
                  "files" => $files
                  );
}

function activites_with_elements ($elements) {
  global $dir;
  global $url;
  $missing= array();
  $files = array();
  $rows = '';
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
                if(!xml_child_exists($xml, "//iati-organisation"))  { //exclude organisation files
                  //We're just checking each file for at least one occurance!!
                    foreach ($xml as $activity) {
                      foreach ($elements as $element) {
                          //we can test conditions for elements of the activity data here
                          // the // allows us to search relative to root
                          if(xml_child_exists($activity, ".//" . $element))  {           
                              //echo $i . 'Yes'.PHP_EOL;
                              //print_r($activity->transaction);
                              //die;
                          } else {
                              //Not found
                              $rows .='<tr><td>' .  $element . '</td><td>' . (string)$activity->{'iati-identifier'} . '</td><td>' . $url . $file .'</td></tr>';
                              //echo '"' .  $element . '","' . $activity->{'iati-identifier'} . '","' . $url . '","' . $file .PHP_EOL;
                              array_push($missing, $element);
                              array_push($files,$file);
                              //continue 3;
                          }
                      }
                    }
                  
                  
                 } 
              } else { //simpleXML failed to load a file
                  //echo $file . ' empty';
              }
              
          }// end if file is not a system file
      } //end while
      closedir($handle);
  }
  return array("rows" => $rows,
               "missing" => $missing,
               "files" => $files
               );
}


function theme_how_many_of_each ($array) {
$how_many_of_each = array_count_values ($array);
    arsort($how_many_of_each);
    foreach ($how_many_of_each as $key => $value) {
      if ($value >1 ) { 
        echo '<p class="cross">&lt;' . $key . '&gt; not found at all in (' . $value . ') files' . '</p>';
      }
    }
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
	sorter.init("table1",1);
  </script>

	<script type="text/javascript">
  var sorter1 = new TINY.table.sorter("sorter1");
	sorter1.head = "head";
	sorter1.asc = "asc";
	sorter1.desc = "desc";
	sorter1.even = "evenrow";
	sorter1.odd = "oddrow";
	sorter1.evensel = "evenselected";
	sorter1.oddsel = "oddselected";
	sorter1.paginate = true;
	sorter1.currentid = "currentpage";
	sorter1.limitid = "pagelimit";
	sorter1.init("table2",1);
  </script>
