<?php

class Login
{
    // Globals
    public static $userLive = 'user_live';
    public static $loggedIn = 'loggedIn';
    public static $userName = 'userName';
    
    /*
     * Function to verify user and crypted password
     * @param string $userName username
     * @param string $userPassword users' password
     * @return bool
     */
    public static function verify($userName, $userPassword) 
    {
        // Gtabbing the Hash password
        $salt = sha1("{$userName}_{$userPassword}");
        $salt2 = md5("{$userName}_{$userPassword}");
        $subtract = substr($salt . $salt2, 3, 7);
        $crypt = '$2atr0p' . $subtract;

        $userName = mysql_real_escape_string($userName);
        $crypt = mysql_real_escape_string($crypt);

        //Grabbing all the user details with this query
        $r1 = mysql_fetch_array(mysql_query("SELECT password, rand, created_at FROM user WHERE username='".$userName."' 
                                             AND password= '".$crypt."';"));
        $r2 = "SELECT user_live FROM user WHERE username='".$userName."' AND user_live= 1";
        $result = mysql_query($r2); 
        $person = mysql_fetch_assoc($result);

        // IF username and password is correct
        if ($r1) {
            // if user is live
            if ($person[static::$userLive] == 1) { 
                return true;
            }
        } else{
            return false;
        }
    }
    
    /*
     * Function to set session information for logged in
     * users.
     * @param string $userName username
     * @return void
     */
    public static function setLoggedIn($userName) 
    {
        //Sets sessions
        $_SESSION[static::$loggedIn] = true;
        $_SESSION[static::$userName] = $userName;
        self::redirectTo('main');
    }
    
    /*
     * Function to check if user is logged in
     * @return bool
     */
    public static function isLoggedIn() 
    { 
        return (isset($_SESSION[static::$loggedIn]) && $_SESSION[static::$loggedIn] ? true : false );
    }
    
    /*
     * Function to redirect user to a given page specified in params
     * @param string $page page to redirect to
     * @return void
     */
    public static function redirectTo($page) 
    {
        header( 'Location: '.$page.'.php' );
    }
}


