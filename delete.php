<?php
include 'db_connection.php';  // Pastikan ini adalah file yang menghubungkan ke database

// Pastikan parameter 'id' ada di URL
if (isset($_GET['id'])) {
    // Mengambil ID dari URL
    $id = $_GET['id'];

    // Menyiapkan query untuk menghapus data berdasarkan ID
    $sql = "DELETE FROM deliveries WHERE id = ?";

    // Menyiapkan statement
    if ($stmt = $conn->prepare($sql)) {
        // Mengikat parameter untuk statement (type "i" berarti integer)
        $stmt->bind_param("i", $id);

        // Mengeksekusi statement
        if ($stmt->execute()) {
            // Setelah berhasil dihapus, alihkan ke halaman delivery.php
            header("Location: delivery.php");
            exit(); // Pastikan kode berhenti dieksekusi setelah pengalihan
        } else {
            // Jika terjadi error saat eksekusi query
            echo "Error executing query: " . $stmt->error;
        }

        // Menutup statement
        $stmt->close();
    } else {
        // Jika terjadi kesalahan dalam menyiapkan query
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    // Jika ID tidak ada di URL
    echo "No ID provided for deletion.";
}

// Menutup koneksi database
$conn->close();
?>
