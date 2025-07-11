<?php
require_once '../configuration/config.php';

$success = $error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nip           = mysqli_real_escape_string($conn, $_POST['nip']);
    $nama          = mysqli_real_escape_string($conn, $_POST['nama']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $no_telepon    = mysqli_real_escape_string($conn, $_POST['no_telepon']);
    $email         = mysqli_real_escape_string($conn, $_POST['email']);
    $password      = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $status        = 'Staff IT';
    $verifikasi    = 'pending';
    $foto_user     = NULL;

    // Validasi email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email tidak valid!';
    }
    // Validasi no_telepon hanya angka
    elseif (!preg_match('/^[0-9]+$/', $no_telepon)) {
        $error = 'No Telepon hanya boleh angka!';
    }

    // Upload foto jika ada
    if (!$error && isset($_FILES['foto_user']) && $_FILES['foto_user']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['foto_user']['name'], PATHINFO_EXTENSION);
        $filename = 'user_' . $nip . '_' . time() . '.' . $ext;
        $target = '../assets/img/user/' . $filename;
        if (move_uploaded_file($_FILES['foto_user']['tmp_name'], $target)) {
            $foto_user = $filename;
        } else {
            $error = 'Upload foto gagal!';
        }
    }

    if (!$error) {
        $sql = "INSERT INTO tb_user (nip, nama, jenis_kelamin, no_telepon, email, status, verifikasi, foto_user, password) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sssssssss', $nip, $nama, $jenis_kelamin, $no_telepon, $email, $status, $verifikasi, $foto_user, $password);
        if (mysqli_stmt_execute($stmt)) {
            $success = '<div style="display:flex;align-items:center;gap:12px;justify-content:center;"><span style="font-size:2.2rem;color:#28a745;"><i class="fas fa-check-circle"></i></span><span><b>Registrasi Staff IT Berhasil!</b><br>Selamat, akun Anda berhasil didaftarkan.<br>Silakan menunggu verifikasi dari admin.<br>Terus semangat dan tunjukkan kemampuan terbaikmu!</span></div>';
        } else {
            $error = 'Registrasi gagal: ' . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Staff IT</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body { background: #6d44e5; }
        .login-card {
            width: 100%;
            max-width: 520px;
            margin: 0 auto;
            padding: 48px 5vw 38px 5vw;
            box-sizing: border-box;
        }
        .login-title {
            font-size: 2rem;
            margin-bottom: 24px;
        }
        .register-form input,
        .register-form select {
            width: 100%;
            font-size: 1.18rem;
            padding: 18px 20px;
            box-sizing: border-box;
        }
        .login-btn, .back-btn {
            width: 100%;
            font-size: 1.15rem;
            padding: 16px 0;
            box-sizing: border-box;
        }
        .login-card > div[style*='background'] {
            width: 100%;
            box-sizing: border-box;
            word-break: break-word;
        }
        @media (max-width: 700px) {
            .login-card {
                width: 100vw;
                max-width: 99vw;
                padding: 22px 2vw 18px 2vw;
            }
            .login-title {
                font-size: 1.3rem;
                margin-bottom: 18px;
            }
            .register-form input,
            .register-form select {
                font-size: 1rem;
                padding: 12px 14px;
            }
            .login-btn, .back-btn {
                font-size: 1rem;
                padding: 12px 0;
            }
        }
        @media (max-width: 400px) {
            .login-card {
                padding: 10px 1vw 10px 1vw;
            }
            .register-form input,
            .register-form select {
                font-size: 0.97rem;
                padding: 10px 8px;
            }
        }
    </style>
</head>
<body>
    <div class="login-bg"></div>
    <div class="login-card">
        <h2 class="login-title">Register Staff IT</h2>
        <?php if ($success): ?>
            <div style="background:#d4edda;color:#155724;padding:18px 12px;border-radius:10px;margin-bottom:18px;font-size:1.08rem;text-align:left;box-shadow:0 2px 8px #0001;">
                <?= $success ?>
            </div>
        <?php elseif ($error): ?>
            <div style="background:#f8d7da;color:#721c24;padding:12px;border-radius:8px;margin-bottom:18px;"> <?= $error ?> </div>
        <?php endif; ?>
        <form class="register-form" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <input type="text" name="nip" placeholder="NIP" required>
            </div>
            <div class="input-group">
                <input type="text" name="nama" placeholder="Nama Lengkap" required>
            </div>
            <div class="input-group">
                <select name="jenis_kelamin" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="input-group">
                <input type="text" name="no_telepon" placeholder="No Telepon" required>
            </div>
            <div class="input-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="input-group">
                <input type="file" name="foto_user" accept="image/*">
            </div>
            <button type="submit" class="login-btn">Daftar Staff IT</button>
            <a href="form_login.php" class="login-btn back-btn" style="background:#e0d7ff;color:#6d44e5;margin-top:10px;text-align:center;display:block;">Kembali ke Login</a>
        </form>
    </div>
</body>
</html> 