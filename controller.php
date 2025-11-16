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
            header("Location: index.php?error=Ukuran terlalu besar");
            exit;

        // Cek apakah extensi gambar benar
        } else if ( !in_array( $fileExtention, $allowedExtention )){
            header("Location: index.php?error=File tidak diperbolehkan");
            exit;
        }

        $imgNewName = uniqid($pureName . '-') . '.' . $fileExtention;
        move_uploaded_file($imgTmpName, 'img/' . $imgNewName);
        return $imgNewName;
    }



    // Ambil data untuk dirubah
    function ubahGetData($request){
        $query = "SELECT * FROM datafilm WHERE id = $request";
        $result = query($query)[0];
        return $result;
    }



    // Simpan data yang dirubah
    function ubahData($request, $requestFiles){
        global $db;

        // Beri sedikit keamanan
        $namaFilm = htmlspecialchars($request['namaFilm']);
        $id = htmlspecialchars($request['id']);
        $rating = htmlspecialchars($request['rating']);
        $tahunTerbit = htmlspecialchars($request['tahunTerbit']);
        $deskripsiSingkat = htmlspecialchars($request['deskripsiSingkat']);
        $namaFilm = htmlspecialchars($request['namaFilm']);
        $oldImg = htmlspecialchars($request['oldImg']);

        // img = 'null' ketika oldImg null dan file null
        // img = oldImg ketika file null
        // img = file ketika file terisi

        if($requestFiles['error'] == 0){
            $img = "'" . dataFiles($requestFiles) . "'";
        } elseif($requestFiles['error'] == 4){
            $img = ($oldImg == '') ? 'NULL' : "'" . $oldImg . "'";
        }

        $query = "UPDATE datafilm SET 
            namaFilm = '$namaFilm',
            deskripsiSingkat = '$deskripsiSingkat',
            tahunTerbit = '$tahunTerbit',
            rating = '$rating',
            img = $img
            WHERE id = '$id'
        ";

        mysqli_query($db, $query);
        header("Location: index.php?message=Data berhasil dirubah!");
        exit;
    }



    // Tambah fitur register
    function registerUser($request){
        global $db;

        // Beri sedikit keamanan
        $username = htmlspecialchars(strtolower($request['username']));
        $password = mysqli_real_escape_string($db, $request['password']);
        $passwordKonfirmasi = mysqli_real_escape_string($db, $request['passwordKonfirmasi']);

        // Cek apakah password = passwordKonfirmasi
        ($password != $passwordKonfirmasi) ?
        header("Location: ?error=Password dan Konfirmasi Password anda berbeda!") : null;

        // Cek apakah user sudah ada dalam database?
        $query = "SELECT * FROM users WHERE username = '$username'";
        $result = query($query);

        ( count($result) > 0 ) ? 
        header("Location: ?error=Username sudah pernah digunakan, silahkan ganti!") : null;

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($db, "INSERT INTO users VALUES(
            '',
            '$username',
            '$hashedPassword'
        )");

        header("Location: login.php?message=User berhasil ditambahkan");
        exit;
    }
?>