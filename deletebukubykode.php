<?php
include 'connection.php';

$conn = getConnection();

try {
    if (isset($_GET["kode"])) {
        $kode = $_GET["kode"];

        $statement = $conn->prepare("SELECT * FROM buku WHERE kode = :kode;");
        $statement->bindParam(':kode', $kode);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_OBJ);
        $result = $statement->fetch();

        if ($result) {
            $statement = $conn->prepare("DELETE FROM buku WHERE kode = :kode");
            $statement->bindParam("kode", $kode);
            $statement->execute();

            $response['message'] = "Data berhasil dihapus";
        } else {
            http_response_code(404);
            $response['message'] = "Kode tidak terdeteksi";
        }

    } else {
        $response['message'] = "Data gagal dihapus";
    }
} catch (PDOException $e) {
    echo $e;
}

$json = json_encode($response, JSON_PRETTY_PRINT);
echo $json;
