
<?php
// insertdonasi.php
include 'connection.php';

// prepare > bindparam > execute

$conn = getConnection();

try {
    if($_POST){
        $nomor = $_POST["nomor"];
        $nama = $_POST["nama"];
        $jenis_kelamin= $_POST["jenis_kelamin"];
        $alamat= $_POST["alamat"];
        $no_hp= $_POST["no_hp"];

        $statement = $conn->prepare("INSERT INTO `anggota`(`nomor`, `nama`, `jenis_kelamin`,`alamat`,`no_hp`) 
        VALUES (:nomor, :nama, :jenis_kelamin, :alamat,:no_hp);");

        $statement->bindParam(':nomor',$nomor);
        $statement->bindParam(':nama',$nama);
        $statement->bindParam(':jenis_kelamin',$jenis_kelamin);
        $statement->bindParam(':alamat',$alamat);
        $statement->bindParam(':no_hp',$no_hp);

        $statement->execute();
        $response["message"] = "Data berhasil direcord";
    }
}
catch (PDOException $e){
    $response["message"] = "error $e";
}
echo json_encode($response, JSON_PRETTY_PRINT);
?>
