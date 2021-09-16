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
                return password_verify($password, $user->password);
            }
        }
    }
}
