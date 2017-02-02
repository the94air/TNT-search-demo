<?php

    try{
    			
    $dsn = 'mysql:host=127.0.0.1;dbname=search;charset=utf8';
    $user = 'username';
    $pass = 'password';
    		
    $db = new PDO( $dsn, $user, $pass );
    
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false); 
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    		
      }catch(PDOException $e){
    			
    	echo $e->getMessage() . '<br>';

    	die('PDO could not create connection with DB');
    }