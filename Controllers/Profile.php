<?php

class Profile extends SafetyController
{
    protected $view = "profile";
    protected $searchList = false;

    public function timeElapsed()
    {
        $azubi = new Azubi();
        $azubi->load(290);
        $timeStart = $azubi->getEmploymentstart();
        $now = time();
        $start = strtotime($timeStart);
        $elapsetime = $now - $start;

        $conversiontosec = [
            'Years' => 60 * 60 * 24 * 365,
            'Months'=> 60 * 60 * 24 * 30,
            'Days' => 60 * 60 * 24
        ];
        $result = [];
        while ($elapsetime > 60 * 60 * 24){
            foreach ($conversiontosec as $unit => $secs){
                if ($elapsetime >= $secs){
                    if (array_key_exists($unit, $result) === false){
                        $result[$unit] = 0;
                    }
                    $result[$unit]++;
                    $elapsetime -= $secs;
                    break;
                }
            }
        }
        return $result;
    }

    public function outputTime(){
        $timeElapsed = $this->timeElapsed();
        var_dump($timeElapsed);
        if (array_key_exists('Years', $timeElapsed)){
            echo $timeElapsed['Years'].' Jahr(en) ';
        }
        if (array_key_exists('Months', $timeElapsed)){
            echo $timeElapsed['Months'].' Monat(en) ';
        }
        if (array_key_exists('Days', $timeElapsed)){
            echo $timeElapsed['Days'].' Tag(en)';
        }
    }

    public function getAzubi(){
        $userEmail = $_SESSION["userEmail"];
        $string = "'";
        $userEmail = $string.$userEmail.$string;
        $sql = "SELECT azubi.id FROM azubi WHERE email = ".$userEmail." ";
        $result = DatabaseConnect::executeMysqlQuery($sql);
        $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach ($data as $row){
        }
        $azubi = new Azubi();
        $azubi->load($row['id']);
        return $azubi;
    }
}