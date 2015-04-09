<?php
class ValidatorModel {
	private $name;
	private $email;
	private $pass;
    private $result = array
    (
        '%NAME_ERR%' =>'',
        '%PASS_ERR%' => '',
        '%EMAIL_ERR%' => '',
        '%NAME%' =>'',
        '%PASS%' => '',
        '%EMAIL%' => '',
        '%LOGIN%' => '',
    );

	public function __construct(){
	}

    public function validateInputs($name, $pass, $email){
        $this->name = $this->mainHandling($name);
        $this->name = $this->inputLength($name, 'name');
        $this->pass = $this->mainHandling($pass);
        $this->pass = $this->inputLength($pass, 'pass');
        $this->email = $this->mainHandling($email);
        $this->email = $this->emailCheck($email, 'email');
        if (!empty($this->name) && !empty($this->email) && !empty($this->pass)){
            return true;
        } else {
            return $this->result;
        }
    }

    public function mainHandling($val){
        return strip_tags(trim($val));

    }
    public function inputLength($input, $name){
        $this->result['%'.strtoupper($name).'%'] = $input;
        if (strlen($input) > 3 && strlen($input) <= 10) {
            return $input;
        } else {
            $this->result['%'.strtoupper($name).'_ERR%'] = ' '.$name.' must be more then 4 and less then 11 symbols';

            $input = '';
            return $input;
        }
    }

    public function emailCheck($email, $name){
        $this->result['%'.strtoupper($name).'%'] = $email;
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
             return $email;
        } else {
            $this->result['%'.strtoupper($name).'_ERR%'] = ' '.$name.' invalid Email';
        }
    }
    /**
     * @return array
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }




}
