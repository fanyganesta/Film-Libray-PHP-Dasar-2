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





    // Tambah function fitur tambah data
    function tambah($requestPost, $requestFiles){
        $namaFilm = $requestPost['namaFilm'];
        $deskripsiSingkat = $requestPost['deskripsiSingkat'];
        $tahunTerbit = $requestPost['tahunTerbit'];
        $rating = $requestPost['rating'];
        
        // Perbolehkan gambar diisi null
        $img = ( $requestFiles['file']['error'] == 4) ? 'null' : "'" . dataFiles($requestFiles['file']) . "'";
        
        // Masukkan hasil ke database
        $query = "INSERT INTO datafilm VALUES (
            '',
            '$namaFilm',
            '$deskripsiSingkat',
            '$tahunTerbit',
            '$rating',
            $img
        )";

        global $db;
        mysqli_query($db, $query);

        header("Location: index.php?message=Data berhasil ditambahkan");
    }




    // Fungsi untuk memproses data file
    function dataFiles($requestFiles){
        $imgName = $requestFiles['name'];
        $imgTmpName = $requestFiles['tmp_name'];
        $imgError = $requestFiles['error'];
        $imgSize = $requestFiles['size'];

        // Ambil extensi dan nama file
        $arrayName = explode('.', $imgName);
        $pureName = $arrayName[0];
        $fileExtention = end($arrayName);

        // Extenti yang diperbolehkan
        // $allowedExtention = ['jpeg', 'jpg', 'png', 'webp'];
        $allowedExtention = ['webp'];
        
        // Cek ukuran agar tidak lebih dari 1mb
        $maxBytes = 1000000;
        if( $imgSize > $maxBytes ){
            header("Location: tambah.php?error=Ukuran terlalu besar");
            exit;

        // Cek apakah extensi gambar benar
        } else if ( !in_array( $fileExtention, $allowedExtention )){
            header("Location: tambah.php?error=File tidak diperbolehkan");
            exit;
        }

        $imgNewName = $pureName . uniqid($pureName) . '.' . $fileExtention;
        move_uploaded_file($imgTmpName, 'img/' . $imgNewName);
        return $imgNewName;
    }


?>