<?php

if (in_array($myinputs['group'],array_keys($available_groups))) {
  //Include variables for each group. Use group name for the argument
  //e.g. php detect_html.php dfid
  require_once 'variables/' .  $_GET['group'] . '.php';


  //Count activities in files
  $count = get_count ($dir);
  //Calculate the filesize
  $size = get_filesize ($dir);
  //Print a nice table
  print('<div id="main-content">');
    theme_size_count($count,$size,$url);
  print('</div>');
      
    
}              

function theme_size_count ($count,$size,$url) {
  //Get a count of all files
  $total_files = count($count);
  
  //Find any failing files and take them out of the array
  //Print a table of failing files
  foreach ($count as $file => $number) {
    if ($number == "FAIL") {
      $rows .= '<tr><td><a href="' .$url . $file . '">' . $file . '</a></td></tr>';
      unset($count[$file]);
    }
  }
  if ($rows) {
      print("
          <table id='fail-table' class='sortable'>
            <thead>
              <tr>
                <th><h3>These files need attention:</h3></th>
              </tr>
            </thead>
            <tbody>
              $rows
            </tbody>
          </table>"
         );
  }
  
  //Print out a table of all the files that have a good file count
  print("
    <table id='table' class='sortable'>
      <thead>
        <tr>
          <th><h3>No. Activities</h3></th>
          <th><h3>Size</h3></th>
          <th><h3>File</h3></th>
          <th class='nosort'></th>
        </tr>
      </thead>
      <tbody>
      ");
    arsort($count);
    $remaining_files = count($count);
    echo 'Table below shows ' . $remaining_files . ' out of ' . $total_files . ' files in the dataset';
  foreach ($count as $file => $number) {
    print('
      <tr>
        <td>' . $number . '</td>
        <td>' . $size[$file] . '</td>
        <td><a href="' .$url . $file . '">' . $file . '</a></td>
        <td><a href="http://webapps.kitwallace.me/exist/rest/db/apps/iati/xquery/validate.xq?type=activitySet&source=' . urlencode($url . $file) . '&mode=download">View Validator results</a></td>
    </tr>
    ');
  }
  print("</tbody>
      </table>");
}


function get_count ($dir) {
  if ($handle = opendir($dir)) {
    /* This is the correct way to loop over the directory. */
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") { //ignore these system files
          if ($xml = simplexml_load_file($dir . $file)) {;
            //$count = $xml->count(); //php >5.3
            $count = count($xml->children()); //php < 5.3
            $results[$file] = $count;
          } else {
            $results[$file] = 'FAIL';
          }
        }
    }
  }
  return $results;
}

function get_filesize ($dir) {
  if ($handle = opendir($dir)) {
    /* This is the correct way to loop over the directory. */
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") { //ignore these system files
           $path_to_file  = '/home/david/iati/batch/' .  substr($dir,3) . $file;
           $path_to_file  = '/home/david/iati/batch/' .  $dir . $file;
           $filesize = filesize($path_to_file);
           //$filesize = filesize($file);
           $filesize = format_bytes($filesize);
           $results[$file] = $filesize;
          
        }
    }
  }
  return $results;
}
  

function format_bytes($size) {
    $units = array(' B', ' KB', ' MB', ' GB', ' TB');
    //for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024;
    for ($i = 0; $size >= 10 && $i < 1; $i++) $size /= 1024;
    return round($size, 2).$units[$i];
}



?>


<script type="text/javascript" src="javascript/script.js"></script>
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
