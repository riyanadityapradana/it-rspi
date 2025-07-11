<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="../assets/img/icon.png">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="login-bg"></div>
    <div class="login-card">
        <img src="../assets/img/icon.png" alt="Logo IT RS Pelita Insani" class="login-logo">
        <h2 class="login-title">IT - RSPI</h2>
        <form class="login-form" method="post" action="proses_login.php">
            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required>
                <span class="input-icon right"><i class="fas fa-user"></i></span>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
                <span class="input-icon right"><i class="fas fa-lock"></i></span>
            </div>
            <div class="options-row">
                <label class="remember-me"><input type="checkbox" name="remember"> Remember me</label>
                <a href="#" class="forgot-link">Forgot password?</a>
            </div>
            <button type="submit" class="login-btn">Login</button>
        </form>
        <div class="signup-row">
            Don't have an account? <a href="#" class="signup-link" id="openRegisterModal">Register</a>
        </div>
    </div>
    <div id="registerModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" id="closeRegisterModal">&times;</span>
            <h3 class="modal-title">Pilih Jenis Registrasi</h3>
            <div class="register-options" id="registerOptions">
                <a href="#" class="register-box calon-karyawan">
                    <i class="fas fa-user-plus"></i>
                    <span>Register Calon Karyawan</span>
                </a>
                <a href="register_staff.php" class="register-box staff-it" id="openStaffRegisterForm">
                    <i class="fas fa-user-cog"></i>
                    <span>Register Staff IT</span>
                </a>
            </div>
        </div>
    </div>
    <script src="../assets/js/login.js"></script>
</body>
</html>
