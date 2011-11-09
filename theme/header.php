<?php
// Turn off all error reporting
error_reporting(0);
ini_set("memory_limit","128M");
include('functions/init.php');
include ('variables/site_vars.php');

//Breadcrumb
$path = htmlentities($_SERVER['REQUEST_URI']);
foreach ($menus as $menu) {
  $menu_array = ${$menu . '_menu'}; //each menu_array provides ['link'] and ['title'] for our menu items
  //print_r($menu_array);
  foreach ($menu_array  as $item) {
    //Check to see if this is the 'active' link and add css class if it is
    if (strstr($path,$item["link"])) {
      $breadcrumb = " - " . ucwords($menu) .  " - " . $item["title"];
    }
  }
}
?>
<html>
  <head>
    <title><?php echo $title ?> <?php echo $breadcrumb ?></title>
    <link rel="stylesheet" href="theme/css/main.css" />
    <link rel="stylesheet" href="javascript/tinytable/style.css" />
  </head>

<body>
  <div id="header">
    <div id="nav"><a href="index.php">Home</a></div>
  </div>
  <div id="page-wrapper">
  <?php
    print ('<h1 class="page-title">' . $available_groups[$myinputs['group']] .  $breadcrumb . '</h1>');
    include('theme/sidebar.php');
  ?>
</body>
