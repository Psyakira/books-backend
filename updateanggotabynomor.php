<?php
//updatebyid.php

include 'connection.php';

$conn = getConnection();
try {
    if($_POST){
        $nomor = $_POST["nomor"];
        $nama = $_POST["nama"];
        $jenis_kelamin= $_POST["jenis_kelamin"];
        $alamat= $_POST["alamat"];
        $no_hp= $_POST["no_hp"];

        $statement = $conn->prepare("SELECT * FROM anggota WHERE nomor = :nomor");
        $statement->bindParam(':nomor',$nomor);
        $statement->execute();
        $result = $statement->fetch();

        if ($result){
            $statement = $conn->prepare("UPDATE `anggota` SET nomor = :nomor, nama = :nama, jenis_kelamin = :jenis_kelamin, alamat = :alamat, no_hp = :no_hp WHERE nomor = :nomor");

            $statement->bindParam(':nomor',$nomor);
            $statement->bindParam(':nama',$nama);
            $statement->bindParam(':jenis_kelamin',$jenis_kelamin);
            $statement->bindParam(':alamat',$alamat);
            $statement->bindParam(':no_hp',$no_hp);

            $statement->execute();
            $response["message"] = "Data berhasil diupdate";
        }
    }
}
catch (PDOException $e){
    $response["message"] = "error $e";
}
echo json_encode($response, JSON_PRETTY_PRINT);
?>