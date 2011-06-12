<?php
  class Cell
  {
    private $column;
    private $row;
    private $neigbour;
    
    function __construct($column, $row)
    {
      $this->column = $column;
      $this->row    = $row;
    }
  }
?>