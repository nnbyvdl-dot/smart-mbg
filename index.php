<?php
session_start();

/* =====================
   Ambil data session
===================== */
$name        = $_SESSION['name'] ?? null;
$alerts      = $_SESSION['alerts'] ?? [];
$active_form = $_SESSION['active_form'] ?? '';

/* =====================
   Bersihkan session sementara
===================== */
unset($_SESSION['alerts'], $_SESSION['active_form']);

/* =====================
   Tentukan class modal (anti warning PHP 8)
===================== */
$modalClass = '';

if ($active_form === 'register') {
    $modalClass = 'show slide';
} elseif ($active_form === 'login') {
    $modalClass = 'show';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Smart MBG</title>

	<link rel="stylesheet" href="style.css">
	<link href="https://cdn.boxicons.com/3.0.8/fonts/basic/boxicons.min.css" rel="stylesheet">
</head>
<body>

<header>
	<a href="#" class="logo">SMART MBG</a>

	<nav>
		<a href="#">Home</a>
		<a href="#">About</a>
		<a href="#">Collection</a>
		<a href="#">Contact</a>
	</nav>

	<div class="user-auth">
		<?php if (!empty($name)): ?>
			<div class="profile-box">
				<div class="avatar-circle"><?= strtoupper($name[0]) ?></div>
				<div class="dropdown">
					<a href="#">My Account</a>
					<a href="logout.php">Logout</a>
				</div>
			</div>
		<?php else: ?>
			<button type="button" class="login-btn-modal">Login</button>
		<?php endif; ?>
	</div>
</header>

<section>
	<h1>Hi <?= htmlspecialchars($name ?? 'ARCANOVAzen') ?>!</h1>
</section>

<?php if (!empty($alerts)): ?>
<div class="alert-box">
	<?php foreach ($alerts as $alert): ?>
		<div class="alert <?= htmlspecialchars($alert['type']) ?>">
			<i class="bx <?= $alert['type'] === 'success' ? 'bxs-check-circle' : 'bxs-x-circle' ?>"></i>
			<span><?= htmlspecialchars($alert['message']) ?></span>
		</div>
	<?php endforeach; ?>
</div>
<?php endif; ?>

<div class="auth-modal <?= $modalClass ?>">
	<button type="button" class="close-btn-modal">
		<i class="bx bx-x"></i>
	</button>

	<!-- LOGIN FORM -->
	<div class="form-box login">
		<h2>Login</h2>
		<form action="auth_process.php" method="POST">
			<div class="input-box">
				<input type="email" name="email" placeholder="Email" required>
				<i class="bx bx-envelope"></i>
			</div>

			<div class="input-box">
				<input type="password" name="password" placeholder="Password" required>
				<i class="bx bx-lock"></i>
			</div>

			<button type="submit" name="login_btn" class="btn">Login</button>
			<p>Don't have an account? <a href="#" class="register-link">Register</a></p>
		</form>
	</div>

	<!-- REGISTER FORM -->
	<div class="form-box register">
		<h2>Register</h2>
		<form action="auth_process.php" method="POST">
			<div class="input-box">
				<input type="text" name="name" placeholder="Name" required>
				<i class="bx bx-user"></i>
			</div>

			<div class="input-box">
				<input type="email" name="email" placeholder="Email" required>
				<i class="bx bx-envelope"></i>
			</div>

			<div class="input-box">
				<input type="password" name="password" placeholder="Password" required>
				<i class="bx bx-lock"></i>
			</div>

			<button type="submit" name="register_btn" class="btn">Register</button>
			<p>Already have an account? <a href="#" class="login-link">Login</a></p>
		</form>
	</div>
</div>

<script src="script.js"></script>
</body>
</html>