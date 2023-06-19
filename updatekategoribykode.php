<?php
//updatebyid.php

include 'connection.php';

$conn = getConnection();
try {
    if($_POST){
        $kode = $_POST["kode"];
        $jenis_kategori= $_POST["jenis_kategori"];

        $statement = $conn->prepare("SELECT * FROM kategori WHERE kode = :kode");
        $statement->bindParam(':kode', $kode);
        $statement->execute();
        $result = $statement->fetch();

        if ($result){
            $statement = $conn->prepare("UPDATE `kategori` SET kode = :kode, jenis_kategori = :jenis_kategori WHERE kode = :kode");

            $statement->bindParam(':kode',$kode);
            $statement->bindParam(':jenis_kategori',$jenis_kategori);

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
