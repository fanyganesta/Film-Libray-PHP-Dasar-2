<?php

    // Buat fungsi query untuk mengirimkan data hasi query array asosiatif
    $db = mysqli_connect( 'localhost', 'root', '', 'film_library' );
    
    function query( $query ){
       
        global $db;
        $queryResult = mysqli_query( $db, $query );
        $rawDatas = [];

        while( $fetchResult = mysqli_fetch_assoc( $queryResult ) ){

            $rawDatas[] = $fetchResult;
        }
        return $rawDatas;
    }








?>