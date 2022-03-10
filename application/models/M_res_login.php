<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_res_login extends CI_Model
{
    private $loginResult; //boolean 
    private $idUser; //int
    private $userName; //String
    private $userMail; //String
    private $userPhone; //String
    private $userFullName; //String
    private $hospitalName; //String
    private $token; //String
    private $refreshToken; //String
    private $propHospital;  //array( undefined )

    /**
     * Get the value of loginResult
     */
    public function getLoginResult()
    {
        return $this->loginResult;
    }

    /**
     * Set the value of loginResult
     *
     * @return  self
     */
    public function setLoginResult($loginResult)
    {
        $this->loginResult = $loginResult;

        return $this;
    }

    /**
     * Get the value of idUser
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get the value of userName
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set the value of userName
     *
     * @return  self
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get the value of userMail
     */
    public function getUserMail()
    {
        return $this->userMail;
    }

    /**
     * Set the value of userMail
     *
     * @return  self
     */
    public function setUserMail($userMail)
    {
        $this->userMail = $userMail;

        return $this;
    }

    /**
     * Get the value of userPhone
     */
    public function getUserPhone()
    {
        return $this->userPhone;
    }

    /**
     * Set the value of userPhone
     *
     * @return  self
     */
    public function setUserPhone($userPhone)
    {
        $this->userPhone = $userPhone;

        return $this;
    }

    /**
     * Get the value of userFullName
     */
    public function getUserFullName()
    {
        return $this->userFullName;
    }

    /**
     * Set the value of userFullName
     *
     * @return  self
     */
    public function setUserFullName($userFullName)
    {
        $this->userFullName = $userFullName;

        return $this;
    }

    /**
     * Get the value of hospitalName
     */
    public function getHospitalName()
    {
        return $this->hospitalName;
    }

    /**
     * Set the value of hospitalName
     *
     * @return  self
     */
    public function setHospitalName($hospitalName)
    {
        $this->hospitalName = $hospitalName;

        return $this;
    }

    /**
     * Get the value of token
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set the value of token
     *
     * @return  self
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the value of refreshToken
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * Set the value of refreshToken
     *
     * @return  self
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * Get the value of propHospital
     */
    public function getPropHospital()
    {
        return $this->propHospital;
    }

    /**
     * Set the value of propHospital
     *
     * @return  self
     */
    public function setPropHospital($propHospital)
    {
        $this->propHospital = $propHospital;

        return $this;
    }
}

/* End of file M_res_login.php */
