<?php

class AzubiForm extends SafetyController
{
    //Properties
    protected $view = 'form';
    protected $searchList = false;

    //function that outputs an array with pre-skill values, no empty values are added, loops up to 5 times
    public function cleanPreArray()
    {
        $preSkillValues = [];
        for ($i = 0; $i <= 4; $i++) {
            if (!empty($this->getRequestParameter('preSkill'.$i))) {
                $preSkillValues[] = $this->getRequestParameter('preSkill'.$i);
            }
        }
        return $preSkillValues;
    }

    //function that outputs an array with new-skill values, no empty values are added, loops up to 5 times
    public function cleanNewArray()
    {
        $newSkillValues = [];
        for ($i = 0; $i <= 4; $i++) {
            if (!empty($this->getRequestParameter('newSkill'.$i))) {
                $newSkillValues[] = $this->getRequestParameter('newSkill'.$i);
            }
        }
        return $newSkillValues;
    }

    public function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    //function that requests the inputted data by the user in form.php, which is then inserted or updated in the database
    public function submit()
    {
        $id = $this->getRequestParameter('azubi_id', ' ');
        $name = $this->getRequestParameter('name', ' ');
        $birthday = $this->getRequestParameter('birthday', ' ');
        $email = $this->getRequestParameter('email', ' ');
        $githubuser = $this->getRequestParameter('githubuser', ' ');
        $employmentstart = $this->getRequestParameter('employmentstart', ' ');
        $pictureurl = $this->getRequestParameter('pictureurl', ' ');
        $password = $this->getRequestParameter('password', ' ');
        $passwordConfirm = $this->getRequestParameter('password-confirm', ' ');
        $preSkill = $this->cleanPreArray(); //Requested Array
        $newSkill = $this->cleanNewArray();

        $url = "https://github.com/".$githubuser;
        $headers = get_headers($url);
        if($headers && strpos( $headers[0], '200')) {
            $status = 'url exists';
        } else {
            throw new \Exception('Github User Does not Exist');
        }

        if (empty($name || $birthday || $email || $githubuser || $employmentstart || $pictureurl || $password)){
            throw new \Exception("All Fields Required");
        }

        if ($passwordConfirm != $password){
            throw new \Exception ('Passwords have to match');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new \Exception ('Invalid Email Address!');
        }

        if ($this->validateDate($birthday) === false){
            throw new \Exception('Invalid Birthdate');
        }

        if ($this->validateDate($employmentstart) === false){
            throw new \Exception('Invalid Employment Date');
        }

        if (filter_var($url, FILTER_VALIDATE_URL === FALSE)){
            throw new \Exception('Invalid Github User');
        }



        $azubi = new Azubi();
        $azubi->load($id);
        $azubi->setName($name);
        $azubi->setBirthday($birthday);
        $azubi->setEmail($email);
        $azubi->setGithubUser($githubuser);
        $azubi->setEmploymentstart($employmentstart);
        $azubi->setPictureurl($pictureurl);
        $azubi->setPassword($password);
        $azubi->setSkillPre($preSkill);
        $azubi->setSkillNew($newSkill);
        $azubi->save();
    }

    public function delete()
    {
        $id = $this->getRequestParameter('delete_azubi_id');
        $azubi = new Azubi();
        $azubi->delete($id);
    }

    public function getAzubi(){
        $azubi_id = $this->getRequestParameter('azubi_id');
        $azubi = new Azubi();
        $azubi->load($azubi_id);
        return $azubi;
    }
}