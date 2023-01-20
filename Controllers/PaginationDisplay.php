<?php

class PaginationDisplay extends AjaxController
{
    protected $view = "paginationDisplay";
    //Properties
    public $numPerPage;

    public function getNumberOfPages()
    {
        $search = $this->getRequestParameter('search');
        $this->numPerPage = $this->getRequestParameter('amountPerPage');
        if (empty($this->numPerPage)){
            $this->numPerPage = 10;
        }
        $query = "SELECT * FROM azubi";
        if (!empty($search)){
            $search = mysqli_real_escape_string(DatabaseConnect::getDbConnection(), $search);
            //search query is concatenated if a search input exists
            $query .= " WHERE name LIKE '%$search%' OR birthday LIKE '%$search%' OR email LIKE '%$search%'";
        }
        $paginationResult = DatabaseConnect::executeMysqlQuery($query);
        $totalRecords = mysqli_num_rows($paginationResult);
        $totalPages = ceil($totalRecords/$this->numPerPage);
        return $totalPages;
    }
}