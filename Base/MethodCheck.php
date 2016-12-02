<?php

/*
 * Made by M4ciej
 */

/**
 * Description of MethodCheck
 *
 * @author m4ciej
 */
class MethodCheck {

    /**
     * 
     * @param string $variable variable to check in GET array
     * @return boolean|string
     */
    public static function checkInputMethod($variable = "") {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if (!empty($variable)) {
                if ((isset($_POST[$variable])) && (!empty($_POST[$variable]))) {
                    return "POST";
                } else {
                    return false;
                }
            } else {
                return "POST";
            }
        } else if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if (!empty($variable)) {
                if ((isset($_GET[$variable])) && (!empty($_GET[$variable]))) {
                    return "GET";
                } else {
                    return false;
                }
            } else {
                return "GET";
            }
        } else {
            return false;
        }
    }

}
