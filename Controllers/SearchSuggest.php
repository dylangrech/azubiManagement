<?php

class SearchSuggest extends AjaxController
{
    protected $view = 'searchSuggest';

    public function getSearchData()
    {
        $return = [];
        $search = $this->getRequestParameter('search');
        $sql = "SELECT * FROM azubi WHERE name LIKE '%$search%'";
        $result = DatabaseConnect::executeMysqlQuery($sql);
        if ($result){
            $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($data as $row){
                $return[] = $row['name'];
            }
        }
        return $return;
    }

    public function boldText($searchSuggestions)
    {
        $search = $this->getRequestParameter('search');
        $lastPosition = strlen($search);
        $firstPosition = stripos($searchSuggestions, $search);
        $replacement = substr($searchSuggestions, $firstPosition, $lastPosition);
        $searchSuggestions = substr_replace($searchSuggestions, '<b><u>'.$replacement.'</u></b>', $firstPosition, $lastPosition);
        echo $searchSuggestions;
    }

}