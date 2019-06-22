<?php
require_once 'Model.php';

class UserModel extends Model {

    //doar incarc datele pentru user deja procesate
    public function uploadUser($parameters) {
        $sql = "INSERT INTO users (username, password, salt, user_type, firstname, lastname, email, avatar_img, created_at, updated_at) 
                VALUES (:username, :password, :salt, :user_type, :firstname, :lastname, :email, NULL, sysdate(), sysdate())";
        $query = $this->getConnection()->prepare($sql);
        return ($query->execute($parameters) ? true : false);
    }

    //procesez datele pentru user
    public function addUser($username, $password, $user_type, $firstname, $lastname, $email) {
        $salt = uniqid("", true);
        $passhash = md5($password.$salt);
        $parameters = array(
            ':username' => $username,
            ':password' => $passhash,
            ':salt' => $salt,
            ':user_type' => $user_type,
            ':firstname' => $firstname,
            ':lastname' => $lastname,
            ':email' => $email);
        return($this->uploadUser($parameters));
    }

    public function getUserCredentials($username) {
        $sql = "SELECT id, username, password, salt, user_type, firstname FROM users WHERE username = :username";
        $query = $this->getConnection()->prepare($sql);
        $parameters = array(':username' => $username);
        $query->execute($parameters);
        return ($query->rowcount() ? $query->fetchAll(PDO::FETCH_ASSOC) : false);
    }

    public function getUserId($username) {
        $sql = "SELECT id FROM users WHERE username = :username";
        $query = $this->getConnection()->prepare($sql);
        $parameters = array(':username' => $username);
        $query->execute($parameters);
        return ($query->rowcount() ? true : false);
    }

    public function alterUser($username, $user_type) {
        $sql = "UPDATE users SET user_type = :user_type where username = :username";
        $query = $this->getConnection()->prepare($sql);
        $parameters = array(
            'user_type' => $user_type,
            ':username' => $username);
        return ($query->execute($parameters) ? true : false);
    }

    public function setAvatar($username, $url) {
        $sql = "UPDATE users SET avatar_img = :url where username = :username";
        $query = $this->getConnection()->prepare($sql);
        $parameters = array(
            'url' => $url,
            ':username' => $username);
        return ($query->execute($parameters) ? true : false);
    }
}