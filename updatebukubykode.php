<?php


// insertdonasi.php
include 'connection.php';

// prepare > bindparam > execute

$conn = getConnection();

try {
    if ($_POST) {
        $kode = $_POST["kode"];
        $kode_kategori = $_POST["kode_kategori"];
        $judul = $_POST["judul"];
        $pengarang = $_POST["pengarang"];
        $penerbit = $_POST["penerbit"];
        $tahun = $_POST["tahun"];
        $tanggal_input = $_POST["tanggal_input"];
        $harga = $_POST["harga"];

        //statement untuk ambil data by kode
        $statement = $conn->prepare("SELECT * FROM buku WHERE kode = :kode");
        $statement->bindParam(':kode', $kode);
        $statement->execute();
        $result = $statement->fetch();

        if($result) {

            if (isset($_FILES["file_cover"]["name"])) {
                $image_name = $_FILES["file_cover"]["name"];
                $extensions = ["jpg", "png", "jpeg", "JPG", "JPEG"];
                $extension = pathinfo($image_name, PATHINFO_EXTENSION);

                if (in_array($extension, $extensions)) {
                    $upload_path = 'image/' . $image_name;

                    if (move_uploaded_file($_FILES["file_cover"]["tmp_name"], $upload_path)) {
                        $file_cover = "http://localhost/bookstore/" . $upload_path;

                        $statement = $conn->prepare("UPDATE `buku` SET kode = :kode, kode_kategori = :kode_kategori, judul = :judul,  pengarang = :pengarang, penerbit =:penerbit, tahun =:tahun, tanggal_input = :tanggal_input, harga=:harga, file_cover=:file_cover WHERE kode = :kode");

                        $statement->bindParam(':kode', $kode);
                        $statement->bindParam(':kode_kategori', $kode_kategori);
                        $statement->bindParam(':judul', $judul);
                        $statement->bindParam(':pengarang', $pengarang);
                        $statement->bindParam(':penerbit', $penerbit);
                        $statement->bindParam(':tahun', $tahun);
                        $statement->bindParam(':tanggal_input', $tanggal_input);
                        $statement->bindParam(':harga', $harga);
                        $statement->bindParam(':file_cover', $file_cover);

                    }
                    $statement->execute();
                    $response["message"] = "Data Diupdate!";
                }
                    else {
                        echo "gagal upload";
                    }
                } else {
                    $response["message"] = "Hanya diperbolehkan menginput cover dengan format jpg, jpeg dan png!";
                }
            }
        }
} catch (PDOException $e) {
    $response["message"] = "error $e";
}
echo json_encode($response, JSON_PRETTY_PRINT);


