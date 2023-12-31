<?php
    //session_name('doctor_session');
    session_start();
    
    // Destroy the session
    session_destroy();
    
    // Unset all session variables
    $_SESSION = array();
    
    // Delete the session cookie
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name('doctor_session'), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    // Redirect to the index page
    header("Location: index.php");
    exit;
    
        //it won't destroy the session immediately, but you need to close the browser and reopening it to avoid unauthorize access to the account
    // this is because when you close the browser, the session will automatically destroyed.
?>
