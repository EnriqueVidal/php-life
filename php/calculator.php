<?php
  require_once 'cellgrid.php';
  
  $grid       = new CellGrid($_GET['width'], $_GET['height']);
  $cells_sent = $_GET['cells'];
  
  // cells come in a [x,y] format, we break them into an array and remove the brackets
  
  for ($i = 0; $i < count($cells_sent); $i++)
  {
    $coordinates  = explode(",", $cells_sent[$i]);
    $row          = str_replace("[", "", $coordinates[0]);
    $column       = str_replace("]", "", $coordinates[1]);

    $grid->living_cells(array($row, $column));
  }
  
  $cells = $grid->step();
  echo json_encode($cells);

  //echo "\n" . print_r($cells["surviving_cells"], true);
?>