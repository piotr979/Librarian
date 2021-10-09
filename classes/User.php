<?php

    /**
     * User 
     * A person or entity that can log in to the site
     */

class User
{
    /**
     * Unique identifier of each user
     * @var integer
     */
    public $id;

    /**
     * User name
     * @var string
     */
    public $user;

    /**
     * Password for user
     * @var string
     */
    public $password;


    /** 
     * Check if user is admin
     * @var boolean
     */
    public $is_admin;

    /**
     * It lets user to log in
     *
     * @param object $conn Connection to the database
     * @param string $user Username
     * @param string $password Password
     *
     * @return bool true if credentials are correct, null otherwise
     */

    public static function authenticate($conn, $username, $password)
    {
        $sql = " SELECT * FROM users WHERE username = :username";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "User");
        
        $stmt->execute();

        if ($stmt->execute()) {
            if ($user = $stmt->fetch()) {
                return $pass_and_admin_verify = [password_verify($password, $user->password), $user->is_admin];
            }
        }
    }

    /**
     * Check if the password is correct, also sanitze it.
     * @param object $conn Connection to the database
     * @param string $username new Username
     * @param string $password
     * @param string $password_repeat Password to be checked against $password
     */
    public static function processRegisteration($conn, $username, $password, $password_repeat) 
    {
        $errors = [];
        if (empty($username) || empty($password) || empty($password_repeat) ) {
            array_push($errors, "Please fill missing fields.");
        } else if ($password != $password_repeat) 
        {
            $errors[] .= "Password confirmation doesn't match password.";
        } else if (strlen($password) < 8) {
            $errors[] .= "Password must be at least 8 characters length";
          
        }
        if (empty($errors)) {
        $sql = "INSERT INTO users (username, password) VALUES 
                ( :username, :password )";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(":username", $username, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->execute();
        } else {
            return $errors;
        }
        
    }
}
