<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$product = $product ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Product | Product Management</title>
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
		}

		main {
			width: min(600px, 92%);
			margin: auto;
			padding: 4.5rem 0 5rem;
		}

		.page-head {
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 1.25rem;
			margin-bottom: 2.75rem;
		}

		.page-head-left {
			display: flex;
			align-items: center;
			gap: 1.25rem;
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
		input[type="number"],
		textarea {
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

		input:focus,
		textarea:focus {
			outline: none;
			box-shadow: inset 6px 6px 12px var(--shadow-dark), inset -6px -6px 12px var(--shadow-light);
		}

		textarea {
			min-height: 120px;
			resize: vertical;
		}

		.btn {
			display: inline-flex;
			align-items: center;
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

		.btn-secondary {
			background: var(--muted);
		}

		.btn-secondary:hover {
			background: #5a6470;
		}

		.form-actions {
			display: flex;
			gap: 1rem;
			margin-top: 2rem;
		}

		.required {
			color: #e74c3c;
		}
	</style>
</head>
<body>
<main>
	<div class="page-head">
		<div class="page-head-left">
			<span class="badge" aria-hidden="true">
				<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
					<path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
					<line x1="3" y1="6" x2="21" y2="6"/>
					<path d="M16 10a4 4 0 0 1-8 0"/>
				</svg>
			</span>
			<div>
				<h1>Edit Product</h1>
				<p class="subtitle">Update product information.</p>
			</div>
		</div>
		<a href="<?= htmlspecialchars(site_url('logout'), ENT_QUOTES, 'UTF-8') ?>" class="btn btn-secondary">
			<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
				<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
				<polyline points="16 17 21 12 16 7"/>
				<line x1="21" y1="12" x2="9" y2="12"/>
			</svg>
			Logout
		</a>
	</div>

	<div class="panel">
		<form action="<?= htmlspecialchars(site_url('products/update/' . (string) ($product['id'] ?? '')), ENT_QUOTES, 'UTF-8') ?>" method="POST">
			<div class="form-group">
				<label for="product_name">Product Name <span class="required">*</span></label>
				<input type="text" id="product_name" name="product_name" required maxlength="100" value="<?= htmlspecialchars((string) ($product['product_name'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
			</div>

			<div class="form-group">
				<label for="description">Description</label>
				<textarea id="description" name="description" placeholder="Enter product description..."><?= htmlspecialchars((string) ($product['description'] ?? ''), ENT_QUOTES, 'UTF-8') ?></textarea>
			</div>

			<div class="form-group">
				<label for="price">Price <span class="required">*</span></label>
				<input type="number" id="price" name="price" required step="0.01" min="0" value="<?= htmlspecialchars((string) ($product['price'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
			</div>

			<div class="form-group">
				<label for="quantity">Quantity <span class="required">*</span></label>
				<input type="number" id="quantity" name="quantity" required min="0" value="<?= htmlspecialchars((string) ($product['quantity'] ?? ''), ENT_QUOTES, 'UTF-8') ?>">
			</div>

			<div class="form-actions">
				<button type="submit" class="btn">
					<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<polyline points="20 6 9 17 4 12"/>
					</svg>
					Update Product
				</button>
				<a href="<?= htmlspecialchars(site_url('products'), ENT_QUOTES, 'UTF-8') ?>" class="btn btn-secondary">Cancel</a>
			</div>
		</form>
	</div>
</main>
</body>
</html>
