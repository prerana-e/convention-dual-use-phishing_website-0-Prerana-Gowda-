<?php

class RegisterUser {
    private $email;
    private $password;
    private $storage = "data.json";
    private $stored_users;
    private $new_user;

    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
        $this->stored_users = json_decode(file_get_contents($this->storage), true);
        
        $this->new_user = [
            "email" => $this->email,
            "password" => $this->password
        ];

        if ($this->checkFieldValues()){
            $this->insertUser();
        }
    }

    private function checkFieldValues() {
        if (empty($this->email) || empty($this->password)) {
            echo "Error: Email and Password fields cannot be empty.";
            return false;
        }
        return true;
    }

    private function insertUser() {
        array_push($this->stored_users, $this->new_user);
        file_put_contents($this->storage, json_encode($this->stored_users, JSON_PRETTY_PRINT));
        echo "User registered successfully.";
    }


}
