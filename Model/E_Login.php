<?php
class E_Login {
    private $Id;
    private $username;
    private $password;

    public function __construct($Id, $username, $password) {
        $this->Id = $Id;
        $this->username = $username;
        $this->password = $password;
    }

    public function getId() {
        return $this->Id;
    }

    public function getusername() {
        return $this->username;
    }

    public function getpassword() {
        return $this->password;
    }
}
?>
