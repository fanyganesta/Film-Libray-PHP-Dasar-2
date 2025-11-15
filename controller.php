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

    function cariData($request){
        
        $key = $request['cariData'];
        $req = "LIKE '%$key%'";

        // Query data berdasarkan nama, tanggal, atau rating
        $query = "SELECT * FROM datafilm WHERE 
            namaFilm $req ||
            tahunTerbit $req ||
            deskripsiSingkat $req ||
            rating $req
        ";
        $hasilPencarian = query( $query );
        
        // Tambah key pencarian dan diiskan ke input pencarian
            /* 
            1. Tambahkan array dengan key 'key' di setiap array hasil pencarian
            2. Gunakan For dan hitung jumlah hasil perncarian untuk menambahkan 'key'
            */
        $ditemukan = count($hasilPencarian);
        for( $i = 0; $i < $ditemukan; $i++){

            $hasilPencarian[$i]['key'] = $key;
        }
        
        // var_dump($hasilPencarian); die;

        return $hasilPencarian;
    }







?>