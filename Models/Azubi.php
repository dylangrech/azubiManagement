<?php
class Azubi
{

    //Properties
    protected $id;
    protected $name;
    protected $birthday;
    protected $email;
    protected $githubuser;
    protected $employmentstart;
    protected $pictureurl;
    protected $password;
    protected array $skillPre;
    protected array $skillNew;

    public function __construct($id = '', $name = '', $birthday = '', $email = '', $githubuser = '', $employmentstart = '', $pictureurl = '', $password = '', $skillPre =[], $skillNew =[]){
        $this->setData($id, $name, $birthday, $email, $githubuser, $employmentstart, $pictureurl, $password, $skillPre, $skillNew);
    }

    public function setData($id = '', $name = '', $birthday = '', $email = '', $githubuser = '', $employmentstart = '', $pictureurl = '', $password = '', $skillPre =[], $skillNew =[])
    {
        $this->setId($id);
        $this->setName($name);
        $this->setBirthday($birthday);
        $this->setEmail($email);
        $this->setGithubUser($githubuser);
        $this->setEmploymentstart($employmentstart);
        $this->setPictureurl($pictureurl);
        $this->setPassword($password);
        $this->setSkillPre($skillPre);
        $this->setSkillNew($skillNew);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getGithubuser()
    {
        return $this->githubuser;
    }

    public function setGithubUser($githubuser)
    {
        $this->githubuser = $githubuser;
    }

    public function getEmploymentstart()
    {
        return $this->employmentstart;
    }

    public function setEmploymentstart($employmentstart)
    {
        $this->employmentstart = $employmentstart;
    }

    public function getPictureurl()
    {
        return $this->pictureurl;
    }

    public function setPictureurl($pictureurl)
    {
        $this->pictureurl = $pictureurl;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getSkillPre()
    {
        return $this->skillPre;
    }

    public function setSkillPre($skillPre)
    {
        $this->skillPre = $skillPre;
    }

    public function getSkillNew()
    {
        return $this->skillNew;
    }

    public function setSkillNew($skillNew)
    {
        $this->skillNew = $skillNew;
    }

    public function getSkills($type)
    {
        $Skill = [];
        $querySkills = "SELECT * FROM azubi_skills WHERE type='$type' AND azubi_id='".$this->getId()."'";
        $loadSkills = DatabaseConnect::executeMysqlQuery($querySkills);
        if ($loadSkills->num_rows > 0){
            while ($row = $loadSkills->fetch_assoc()){
                $Skill[] = $row['skill'];
            }
        }
        return $Skill;
    }

    public function load($id)
    {
        $queryAzubi = "SELECT * FROM azubi WHERE id='$id'";
        $loadAzubi = DatabaseConnect::executeMysqlQuery($queryAzubi);
        if ($loadAzubi){
            $dataAzubi = mysqli_fetch_assoc($loadAzubi);
            if(!empty($dataAzubi)){
                $this->setId($dataAzubi['id']);
                $this->setData($dataAzubi['id'], $dataAzubi['name'], $dataAzubi['birthday'], $dataAzubi['email'], $dataAzubi['githubuser'], $dataAzubi['employmentstart'], $dataAzubi['pictureurl'], $dataAzubi['password'], $this->getSkills('pre'), $this->getSkills('new'));
            }
        }
    }

    public function saveSkills($type, $Skill)
    {
        $skillsDB = $this->getSkills($type);
        foreach ($Skill as $skill){
            if(!in_array($skill, $skillsDB)){
                $queryInsert = "INSERT INTO azubi_skills (azubi_id, type, skill) VALUES ('".$this->getId()."', '$type', '$skill')";
                DatabaseConnect::executeMysqlQuery($queryInsert);
            }
        }

        foreach ($skillsDB as $skill){
            if(!in_array($skill, $Skill)){
                $queryDelete = "DELETE FROM azubi_skills WHERE azubi_id ='".$this->getId()."' AND type ='$type' AND skill ='$skill'";
                DatabaseConnect::executeMysqlQuery($queryDelete);
            }
        }
    }

    public function save()
    {
       $insert = "INSERT INTO azubi (name, birthday,email, githubuser, employmentstart, pictureurl, password) VALUES ('".$this->getName()."', '".$this->getBirthday()."', '".$this->getEmail()."', '".$this->getGithubuser()."', '".$this->getEmploymentstart()."', '".$this->getPictureurl()."', '".DatabaseConnect::getHashed($this->getPassword())."')";
       $update = "UPDATE azubi SET name ='".$this->getName()."', birthday ='".$this->getBirthday()."', email ='".$this->getEmail()."', githubuser ='".$this->getGithubUser()."', employmentstart ='".$this->getEmploymentstart()."', pictureurl ='".$this->getPictureurl()."', password = '".DatabaseConnect::getHashed($this->getPassword())."' WHERE id=".$this->getId();
       if (empty($this->getId())){
           DatabaseConnect::executeMysqlQuery($insert);
           $this->setId(mysqli_insert_id(DatabaseConnect::getDbConnection()));
       } else{
           DatabaseConnect::executeMysqlQuery($update);
       }

       $this->saveSkills('pre', $this->getSkillPre());
       $this->saveSkills('new', $this->getSkillNew());
    }

    public function delete($id = false)
    {
        if ($id === false){
            $id = $this->getId();
        }
        $delete = "Delete FROM azubi WHERE id='$id'";
        $deleteSkills = "DELETE FROM azubi_skills WHERE azubi_id ='$id'";
        DatabaseConnect::executeMysqlQuery($delete);
        DatabaseConnect::executeMysqlQuery($deleteSkills);
    }

    public function getLoggedUserData($email)
    {
        $query = "SELECT * FROM azubi WHERE email = '$email'";
        $result = DatabaseConnect::executeMysqlQuery($query);
        if ($result) {
            $data = mysqli_fetch_assoc($result);
            if (!empty($data)){
                $this->setId($data['id']);
                $this->setData($data['id'], $data['name'], $data['birthday'], $data['email'], $data['githubuser'], $data['employmentstart'], $data['pictureurl'], $data['password'], $this->getSkills('pre'), $this->getSkills('new'));
            }
        }
    }

}




