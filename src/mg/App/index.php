<?php

// set error reporting level
if (version_compare(phpversion(), "5.3.0", ">=") == 1)
  error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
else
  error_reporting(E_ALL & ~E_NOTICE);


// initialization of login system and generation code
$oSimpleLoginSystem = new SimpleLoginSystem();
$sLoginForm = $oSimpleLoginSystem->getLoginBox();
echo strtr(file_get_contents('main_page.html'), array('{login_form}' => $sLoginForm));


// class SimpleLoginSystem
class SimpleLoginSystem {

    // variables
    var $aExistedMembers; // Existed members array

    // constructor
    function SimpleLoginSystem() {
        $this->aExistedMembers = array(
            'User1' => 'd8578edf8458ce06fbc5bb76a58c5ca4',  //Sample: MD5('qwerty')
            'User2' => 'd8578edf8458ce06fbc5bb76a58c5ca4'
        );
    }

    function getLoginBox() {
        ob_start();
        require_once('login_form.html');
        $sLoginForm = ob_get_clean();

        ob_start();
        require_once('logout_form.html');
        $sLogoutForm = ob_get_clean();

        if (isset($_GET['logout'])) {
            if (isset($_COOKIE['member_name']) && isset($_COOKIE['member_pass']))
                $this->simple_logout();
        }

        if ($_POST['username'] && $_POST['password']) {
            if ($this->check_login($_POST['username'], MD5($_POST['password']))) {
                $this->simple_login($_POST['username'], $_POST['password']);
                return $sLogoutForm . '<h2>Hello ' . $_COOKIE['member_name'] . '!</h2>';
            } else {
                return $sLoginForm . '<h2>Username or Password is incorrect</h2>';
            }
        } else {
            if ($_COOKIE['member_name'] && $_COOKIE['member_pass']) {
                if ($this->check_login($_COOKIE['member_name'], $_COOKIE['member_pass'])) {
                    return $sLogoutForm . '<h2>Hello ' . $_COOKIE['member_name'] . '!</h2>';
                }
            }
            return $sLoginForm;
        }
    }

    function simple_login($sName, $sPass) {
        $this->simple_logout();

        $sMd5Password = MD5($sPass);

        $iCookieTime = time() + 24*60*60*30;
        setcookie("member_name", $sName, $iCookieTime, '/');
        $_COOKIE['member_name'] = $sName;
        setcookie("member_pass", $sMd5Password, $iCookieTime, '/');
        $_COOKIE['member_pass'] = $sMd5Password;
    }

    function simple_logout() { 
        setcookie('member_name', '', time() - 96 * 3600, '/');
        setcookie('member_pass', '', time() - 96 * 3600, '/');

        unset($_COOKIE['member_name']);
        unset($_COOKIE['member_pass']);
    }

    function check_login($sName, $sPass) {
        return ($this->aExistedMembers[$sName] == $sPass);
    }
}

?>
