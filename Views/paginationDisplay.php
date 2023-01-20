<?php
/** @var PaginationDisplay $controller */
$search = $this->getRequestParameter('search');

for ($i=1; $i <= $controller->getNumberOfPages(); $i++){
    if (!empty($search)){
        echo "<a class='page-link' href='index.php?page=".$i."&search=".$search."'>".$i."</a>";
        echo "<a class='position-absolute bottom-0 end-0 btn btn-secondary' href='index.php'>Refresh Page</a>";
    } else {
        echo "<a class='page-link' href='index.php?page=".$i."'>".$i."</a>";
    }
} ?>
