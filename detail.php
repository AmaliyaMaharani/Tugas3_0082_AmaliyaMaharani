<?php 
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_php";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan ID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mendapatkan detail user berdasarkan ID
    $sql = "SELECT * FROM tb_users WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
    
    // Jika diminta gambar, kirim gambar sebagai respons
    if (isset($_GET['show_image'])) {
        header("Content-type: image/jpeg");
        echo $row['foto'];
        exit;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Gradasi warna Serenity ke Rose Quartz */
        body {
            background: linear-gradient(135deg, #91A8D0, #F7CAC9);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.8); /* Transparansi untuk kesan elegan */
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 18rem;
        }

        .card-title {
            font-weight: bold;
            color: #333;
        }

        .btn-primary {
            background-color: #91A8D0;
            border-color: #91A8D0;
        }

        .btn-primary:hover {
            background-color: #7F99BC;
            border-color: #7F99BC;
        }

        .card-body {
            text-align: center;
        }

        .card-img-top {
            max-height: 300px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
    </style>
</head>
<body>
    <div class="card">
        <img src="detail.php?id=<?php echo $row['id']; ?>&show_image=1" class="card-img-top" alt="Foto User">
        <div class="card-body">
            <h5 class="card-title"><?php echo $row['nama']; ?></h5>
            <p class="card-text"><strong>Jenis Kelamin:</strong> <?php echo $row['jenis_kelamin']; ?></p>
            <p class="card-text"><strong>No HP:</strong> <?php echo $row['nohp']; ?></p>
            <p class="card-text"><strong>Email:</strong> <?php echo $row['email']; ?></p>
            <p class="card-text"><strong>Alamat:</strong> <?php echo $row['alamat']; ?></p>
            <a href="index.php" class="btn btn-primary">Kembali</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
