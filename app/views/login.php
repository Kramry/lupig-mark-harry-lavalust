<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login | Product Management</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
	<style>
		:root {
			--bg: #e7ecf2;
			--surface: #e7ecf2;
			--shadow-light: #ffffff;
			--shadow-dark: #b6c2d1;
			--ink: #29323d;
			--muted: #75828f;
			--accent: #2f8f82;
			--accent-soft: #e0efec;
			--radius-lg: 28px;
			--radius-md: 18px;
			--radius-sm: 12px;
		}

		* { box-sizing: border-box; }

		body {
			margin: 0;
			min-height: 100vh;
			color: var(--ink);
			background: var(--bg);
			font-family: 'Inter', Arial, sans-serif;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		main {
			width: min(400px, 92%);
			padding: 2rem 0;
		}

		.page-head {
			display: flex;
			align-items: center;
			gap: 1.25rem;
			margin-bottom: 2.75rem;
			justify-content: center;
		}

		.badge {
			flex: none;
			width: 60px;
			height: 60px;
			border-radius: 18px;
			display: grid;
			place-items: center;
			background: var(--surface);
			box-shadow: 6px 6px 12px var(--shadow-dark), -6px -6px 12px var(--shadow-light);
			color: var(--accent);
		}

		.badge svg { width: 26px; height: 26px; }

		h1 {
			margin: 0 0 .3rem;
			font-family: 'Poppins', Arial, sans-serif;
			font-weight: 600;
			font-size: clamp(1.9rem, 4vw, 2.5rem);
			letter-spacing: -0.01em;
		}

		.subtitle {
			margin: 0;
			color: var(--muted);
			font-size: 0.98rem;
		}

		.panel {
			background: var(--surface);
			border-radius: var(--radius-lg);
			padding: 2rem;
			box-shadow: 10px 10px 24px var(--shadow-dark), -10px -10px 24px var(--shadow-light);
		}

		.form-group {
			margin-bottom: 1.5rem;
		}

		label {
			display: block;
			margin-bottom: 0.5rem;
			font-weight: 500;
			color: var(--ink);
		}

		input[type="text"],
		input[type="password"] {
			width: 100%;
			padding: 0.875rem 1rem;
			border: none;
			border-radius: var(--radius-sm);
			background: var(--surface);
			box-shadow: inset 4px 4px 8px var(--shadow-dark), inset -4px -4px 8px var(--shadow-light);
			font-family: 'Inter', Arial, sans-serif;
			font-size: 0.95rem;
			color: var(--ink);
			transition: box-shadow 0.15s ease;
		}

		input:focus {
			outline: none;
			box-shadow: inset 6px 6px 12px var(--shadow-dark), inset -6px -6px 12px var(--shadow-light);
		}

		.btn {
			width: 100%;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			gap: 0.5rem;
			padding: 0.75rem 1.5rem;
			border-radius: var(--radius-sm);
			border: none;
			background: var(--accent);
			color: white;
			font-family: 'Inter', Arial, sans-serif;
			font-weight: 500;
			font-size: 0.95rem;
			cursor: pointer;
			text-decoration: none;
			box-shadow: 4px 4px 10px var(--shadow-dark), -4px -4px 10px var(--shadow-light);
			transition: transform 0.15s ease, box-shadow 0.15s ease;
		}

		.btn:hover {
			transform: translateY(-2px);
			box-shadow: 6px 6px 14px var(--shadow-dark), -6px -6px 14px var(--shadow-light);
		}

		.error {
			background: #fee;
			color: #c33;
			padding: 0.75rem 1rem;
			border-radius: var(--radius-sm);
			margin-bottom: 1.5rem;
			font-size: 0.9rem;
		}

		.required {
			color: #e74c3c;
		}

		.info {
			text-align: center;
			margin-top: 1.5rem;
			color: var(--muted);
			font-size: 0.85rem;
		}
	</style>
</head>
<body>
<main>
	<div class="page-head">
		<span class="badge" aria-hidden="true">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
				<path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
				<polyline points="10 17 15 12 10 7"/>
				<line x1="15" y1="12" x2="3" y2="12"/>
			</svg>
		</span>
		<div>
			<h1>Login</h1>
			<p class="subtitle">Access product management.</p>
		</div>
	</div>

	<div class="panel">
		<?php if (session_status() !== PHP_SESSION_ACTIVE) session_start(); ?>
		<?php if (!empty($_SESSION['login_error'])): ?>
			<div class="error">
				<?= htmlspecialchars($_SESSION['login_error'], ENT_QUOTES, 'UTF-8') ?>
			</div>
			<?php unset($_SESSION['login_error']); ?>
		<?php endif; ?>

		<form action="<?= htmlspecialchars(site_url('login/authenticate'), ENT_QUOTES, 'UTF-8') ?>" method="POST">
			<div class="form-group">
				<label for="username">Username <span class="required">*</span></label>
				<input type="text" id="username" name="username" required>
			</div>

			<div class="form-group">
				<label for="password">Password <span class="required">*</span></label>
				<input type="password" id="password" name="password" required>
			</div>

			<button type="submit" class="btn">
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
					<polyline points="10 17 15 12 10 7"/>
					<line x1="15" y1="12" x2="3" y2="12"/>
				</svg>
				Login
			</button>
		</form>

		<div class="info">
			<strong>Demo credentials:</strong> admin / admin123
		</div>
	</div>
</main>
</body>
</html>
