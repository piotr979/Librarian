<?php

/**
 * User authorization 
 */

 class Auth 
 {
     /**
      * This function check if user is logged in
      * @return boolean true if logged, false otherwise
      */
     public static function isLoggedIn() 
     {
         
        return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];
    }

    public static function requireLogin() 
    {
        if (!Auth::isLoggedIn()) {
            die("Unauthorised. Please log in first.");
        }
    }
    /**
     * User just logged in. Sets true. Regenerate session
     */

     public static function logIn() 
     {
        session_regenerate_id(true);
        $_SESSION['is_logged_in'] = true;
     }
    /** 
     * Loggin out process. Taken from PHP website
     */
    public static function logout()
    {

        // Unset all of the session variables.
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
    }
 }