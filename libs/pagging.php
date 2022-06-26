<?php
/**
* @link: http://www.Awcore.com/dev
*/

function pagination(/*$query*/ $total = 0, $per_page = 10, $page = 1, $url = '?' /*, $link*/){
   // $query = "SELECT COUNT(*) as `num` FROM {$query}";
   // $row = mysqli_fetch_array(mysqli_query($link,$query));
   // $total = $row['num'];
   $adjacents = 2;

   $page = ($page == 0 ? 1 : $page);
   $start = ($page - 1) * $per_page;

   $prev = $page - 1;
   $next = $page + 1;
   $lastpage = ceil($total/$per_page);
   $lpm1 = $lastpage - 1;

   $pagination = "";
   if($lastpage > 1) {
      $pagination .= "<ul class='pagination m-0 justify-content-center'>";
      $pagination .= "<li class='details'><a class='page-link' href='#'>Page $page of $lastpage</a></li>";
      if ($lastpage < 7 + ($adjacents * 2)) {
         for ($counter = 1; $counter <= $lastpage; $counter++) {
            if ($counter == $page)
               $pagination.= "<li class='page-item active'><a class='page-link current'>$counter</a></li>";
            else
               $pagination.= "<li class='page-item'><a class='page-link' href='{$url}paging=$counter'>$counter</a></li>";
         }
      } elseif($lastpage > 5 + ($adjacents * 2)) {
         if($page < 1 + ($adjacents * 2)) {
            for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
               if ($counter == $page)
                  $pagination.= "<li class='page-item active'><a class='page-link current'>$counter</a></li>";
               else
                  $pagination.= "<li class='page-item'><a class='page-link' href='{$url}paging=$counter'>$counter</a></li>";
            }
            $pagination.= "<li class='dot'><a class='page-link' href='#'>...</a></li>";
            $pagination.= "<li class='page-item'><a class='page-link' href='{$url}paging=$lpm1'>$lpm1</a></li>";
            $pagination.= "<li class='page-item'><a class='page-link' href='{$url}paging=$lastpage'>$lastpage</a></li>";
         } elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
            $pagination.= "<li class='page-item'><a class='page-link' href='{$url}paging=1'>1</a></li>";
            $pagination.= "<li class='page-item'><a class='page-link' href='{$url}paging=2'>2</a></li>";
            $pagination.= "<li class='dot'><a class='page-link' href='#'>...</a></li>";
            for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
               if ($counter == $page)
                  $pagination.= "<li class='page-item active'><a class='page-link current'>$counter</a></li>";
               else
                  $pagination.= "<li class='page-item'><a class='page-link' href='{$url}paging=$counter'>$counter</a></li>";
            }
            $pagination.= "<li class='dot'><a class='page-link' href='#'>...</a></li>";
            $pagination.= "<li class='page-item'><a class='page-link' href='{$url}paging=$lpm1'>$lpm1</a></li>";
            $pagination.= "<li class='page-item'><a class='page-link' href='{$url}paging=$lastpage'>$lastpage</a></li>";
         } else {
            $pagination.= "<li class='page-item'><a class='page-link' href='{$url}paging=1'>1</a></li>";
            $pagination.= "<li class='page-item'><a class='page-link' href='{$url}paging=2'>2</a></li>";
            $pagination.= "<li class='dot'><a class='page-link' href='#'>...</a></li>";
            for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
               if ($counter == $page)
                  $pagination.= "<li class='page-item active'><a class='page-link current'>$counter</a></li>";
               else
                  $pagination.= "<li class='page-item'><a class='page-link' href='{$url}paging=$counter'>$counter</a></li>";
            }
         }
      }

      if ($page < $counter - 1){
         $pagination.= "<li class='page-item'><a class='page-link' href='{$url}paging=$next'>Next</a></li>";
         $pagination.= "<li class='page-item'><a class='page-link' href='{$url}paging=$lastpage'>Last</a></li>";
      }else{
         $pagination.= "<li class='page-item active'><a class='page-link current'>Next</a></li>";
         $pagination.= "<li class='page-item active'><a class='page-link current'>Last</a></li>";
      }
      $pagination.= "</ul>\n";
   }
   return $pagination;
}
