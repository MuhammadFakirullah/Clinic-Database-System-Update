<?php
    //session_name('admin_session'); //must use this to avoid destroy session for another account too,
    session_start();               //when this account is logged out, it wont interfere session for another account.
    
    // Destroy the session
    session_destroy();
    
    

    // Redirect to the index page
    header("Location: index.php");
    exit;
    
    //it won't destroy the session immediately, but you need to close the browser and reopening it to avoid unauthorize access to the account
    // this is because when you close the browser, the session will automatically destroyed.

?>
