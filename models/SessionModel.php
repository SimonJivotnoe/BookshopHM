<?php


class SessionModel {
    public function __construct()
    {

    }

    public function add($key, $value)
    {
        if(session_start())
        {
            $_SESSION[$key] = $value;
            return true;
        }
        else
        {
            return false;
        }
    }

    public function read($key)
    {
        if(isset($_SESSION[$key]))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function remove($key)
    {
        if(isset($_SESSION[$key]))
        {
            session_unset();
            return true;
        }
        else
        {
            return false;
        }
    }
} 