<?php
    /*
      Including the following files allows us to use many shortcut
      functions provided by AppGini. Here, we'll be using the
      following functions:
        makeSafe()
            protect against malicious SQL injection attacks
        sql()
            connect to the database and execute a SQL query
        db_fetch_assoc()
            same as PHP built-in mysqli_fetch_assoc() function
    */
    $curr_dir = dirname(__FILE__);
    include("{$curr_dir}/defaultLang.php");
    include("{$curr_dir}/language.php");
    include("{$curr_dir}/lib.php");

    /* receive calling parameters */
    $id_convention = makeSafe($_REQUEST['convention']);
    $verifiees = $_REQUEST['verifiees']; /* this is an array of IDs */

    if (isset($id_convention) & $verifiees == "oui") {
      $res = sql( "UPDATE depenses SET verifie=1 WHERE convention=$id_convention", $eo);
    }
    if (isset($id_convention) & $verifiees == "non") {
      $res = sql( "UPDATE depenses SET verifie=NULL WHERE convention=$id_convention", $eo);
    }
