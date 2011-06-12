<?php
  class CellGrid
  {
    private $width;
    private $height;
    private $grid;
    private $next_grid;
    private $living_cells =  array();
    
    public function __construct($width, $height)
    {
      // set a widht and height to know where the edge of the grid is
      $this->width  = $width;
      $this->height = $height;
      
      // Setup new empty grid
      for ($i = 0; $i < $height; $i++)
         for ($j = 0; $j < $width; $j++)
           $this->grid[$i][$j] = 0;
           
      $this->next_grid = $this->grid;
    }
    
    public function step()
    { 
      $surviving_cells = array();
      
      for ($column = 0; $column < $this->height; $column++)
        for ($row = 0; $row < $this->width; $row++)
        {
          if ($this->grid[$column][$row] == 0 && $this->neighbours($row, $column) == 3)
          {
            $this->next_grid[$column][$row] = 1;
            $surviving_cells[count($surviving_cells)] =  "[" . $column. ",".  $row ."]";
          }

          if ($this->grid[$column][$row] == 1 && ( $this->neighbours($row, $column) == 2 || $this->neighbours($row, $column) == 3))
          {
              $this->next_grid[$column][$row] = 1;
              $surviving_cells[count($surviving_cells)] = "[" . $column. ",".  $row ."]";
          }
        }
        
        return array("new_grid" => $this->next_grid, "surviving_cells" => $surviving_cells);
    }
    
    public function living_cells($coordinates = null)
    {
      if ( gettype($coordinates) == "array" && count($coordinates) == 2)
      {
        $next_element = count($this->living_cells);

        // We save our living cells coordinates and update the status of the grid
        $this->living_cells[$next_element]            = $coordinates;
        $this->grid[$coordinates[0]][$coordinates[1]] = 1;
      }
      return $this->living_cells;
    }
    
    public function get_neighbour_count()
    {
      $cell = 0;
      
      foreach($this->living_cells as $living_cell)
      {
        $count[$cell] = $this->neighbours($living_cell[0], $living_cell[1]);
        $cell++;
      }
      
      return $count;
    }
    
    // We count each cell's neighbours
    private function neighbours($row, $column)
      { 
        $count = 0;

        if ( $row > 0 && $row > 0 )
          if ( $this->grid[$column - 1][$row - 1] == 1)
            $count++;

        if ($column > 0)
          if ($this->grid[$column - 1][$row] == 1)
            $count++;

        if ( $row < $this->width && $column > 0 )
          if ( $this->grid[$column - 1][$row + 1] == 1 )
            $count++;

        if ($row > 0)
          if ($this->grid[$column][$row -1] == 1)
            $count++;

        if ($row < $this->width)
          if ($this->grid[$column][$row + 1] == 1)
            $count++;

        if ($row > 0 && $column < $this->height)
          if ( $this->grid[$column + 1][$row - 1] == 1)
            $count++;

        if ($column < 19)
          if ($this->grid[$column + 1][$row] == 1)
            $count++;

        if ($row < 19 && $column < $this->height)
          if ($this->grid[$column + 1][$row + 1] == 1)
            $count++;

        return $count;
      }
  }
?>