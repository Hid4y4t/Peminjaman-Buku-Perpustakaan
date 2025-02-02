<?php
// Koneksi ke database
include '../koneksi/koneksi.php';
// check_book.php


// Assume $idBuku is obtained from POST request
$idBuku = $_POST['id_buku'];

// Query to check if the book exists in the database
$query = "SELECT * FROM buku WHERE id_buku = '$idBuku'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) > 0) {
    // Book found, fetch the data
    $book = mysqli_fetch_assoc($result);
    
    // Prepare the response JSON
    $response = array(
        'status' => 'found',
        'judul' => $book['judul'],
        'id_buku' => $book['id_buku'] // Include the id_buku in the response
    );
} else {
    // Book not found
    $response = array('status' => 'not_found');
}

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);


// Menutup koneksi
mysqli_close($koneksi);
?>
