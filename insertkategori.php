
<?php
// insertdonasi.php
include 'connection.php';

// prepare > bindparam > execute

$conn = getConnection();

try {
    if($_POST){
        $kode = $_POST["kode"];
        $jenis_kategori= $_POST["jenis_kategori"];

        $statement = $conn->prepare("INSERT INTO `kategori`( `kode`, `jenis_kategori`) 
        VALUES (:kode, :jenis_kategori);");

            $statement->bindParam(':kode',$kode);
            $statement->bindParam(':jenis_kategori',$jenis_kategori);

            $statement->execute();
            $response["message"] = "Data berhasil direcord";
        }
}
catch (PDOException $e){
    $response["message"] = "error $e";
}
echo json_encode($response, JSON_PRETTY_PRINT);
?>
