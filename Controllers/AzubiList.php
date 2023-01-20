<?php

class AzubiList extends SafetyController
{
    protected $view = "list";
    public $numPerPage;
    public $page;
    public $startFrom;
    protected array $options = ['1','3','10','25','50','100'];

    public function injectSelectAttribute($selectedOption, $option_value)
    {
        return strtolower($selectedOption) === strtolower($option_value) ? 'selected="selected"' : '';
    }

    public function getAzubiData()
    {
        $search = $this->getRequestParameter('search');
        $this->numPerPage = $this->getRequestParameter('amountPerPage');
        if (empty($this->numPerPage)){
            $this->numPerPage = 10;
        }
        if (isset($_GET['page'])){
            $this->page = $_GET['page'];
        } else {
            $this->page = 1;
        }
        $this->startFrom = ($this->page - 1)*$this->numPerPage;
        //Contains Nothing - Will be returned if the search input has no output (i.e. no data with the search input)
        $azubiArray = [];
        //Select Data Query
        $query = "SELECT * FROM azubi";
        //Condition - If Search Input has been submitted
        if (!empty($search)){
            $search = mysqli_real_escape_string(DatabaseConnect::getDbConnection(), $search);
            //search query is concatenated if a search input exists
            $query .= " WHERE name LIKE '%$search%' OR birthday LIKE '%$search%' OR email LIKE '%$search%'";
        }
        $query .= " LIMIT $this->startFrom, $this->numPerPage";
        $display = DatabaseConnect::executeMysqlQuery($query);
        // If execution works
        if ($display){
            //variable data is given azubi details
            $data = mysqli_fetch_all($display, MYSQLI_ASSOC);
            foreach ($data as $row){
                //variable azubi is given the class Azubi from Azubi.php
                $azubi = new Azubi($row['id'], $row['name'], $row['birthday'], $row['email'], $row['githubuser'], $row['employmentstart'], $row['pictureurl'], $row['password']);
                $azubiArray[] = $azubi;
            }
        }
        return $azubiArray;
    }

    public function deleteSelected()
    {
        $selection = $this->getRequestParameter('checkedId');
        if (!empty($selection)) {
            foreach ($selection as $id){
                $azubi = new Azubi();
                $azubi->delete($id);
            }
        }
    }

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

    public function delete()
    {
        $id = $this->getRequestParameter('delete_azubi_id');
        $azubi = new Azubi();
        $azubi->delete($id);
    }

    public function getPaginationLinks($selectedOption, $search, $i)
    {
        $url = 'index.php?amountPerPage='.$selectedOption.'&page='.$i;
        if (!empty($search)){
            $url .= '&search='.$search;
        }
        return $url;
    }

    public function getOptions()
    {
        return $this->options;
    }
}