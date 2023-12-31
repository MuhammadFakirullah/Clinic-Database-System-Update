<?php
    //session_name('pharmacy_session'); //it is necessary to put this into logout.php so it won't interfere another account logout session
    session_start();

    // session management ad 2, session_destroy(), session_timeout()
    // Destroy the session
    session_destroy(); //deactivate this type of session to avoid account that is not related logged out automatically

    // add timeout session

    // Clear session cookies (assuming you're using cookies for session management)
    //setcookie(session_name(), "", time() - 3600, "/");
    


    // Redirect to the index page
    header("Location: index.php");
   exit;
   
       //it won't destroy the session immediately, but you need to close the browser and reopening it to avoid unauthorize access to the account
    // this is because when you close the browser, the session will automatically destroyed.
?>
