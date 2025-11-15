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



    // Untuk halaman index
    function index($request) {

        // Buat default query untuk menampilkan seluruh data film
        $limit = 5;

        // Ganti index berdasarkan halaman
        if( isset($_GET['halaman']) < 1){
            $halamanAktif = 1;
        } else {
            $halamanAktif = $_GET['halaman'] ?? 1;
        }
        $index = $halamanAktif * $limit - $limit;

        $queryAllFilms = "SELECT * FROM datafilm LIMIT $index, $limit";
        $datas = query( $queryAllFilms );

        // Hitung halaman total
        $countAllFilms = query('SELECT * FROM datafilm');
        $totalHalaman = ceil(count( $countAllFilms ) / $limit );

        $result =[ 'datas' => $datas, 'totalHalaman' => $totalHalaman, 'halamanAktif' => $halamanAktif];
        return $result;
    }



    // Untuk fitur cari data
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