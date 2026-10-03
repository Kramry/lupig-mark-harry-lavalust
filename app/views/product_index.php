<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$products = $products ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Products | Product Management</title>
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
			width: min(1080px, 92%);
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

		.page-head-right {
			display: flex;
			align-items: center;
			gap: 0.75rem;
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

		.btn-small {
			padding: 0.5rem 1rem;
			font-size: 0.85rem;
		}

		.btn-danger {
			background: #e74c3c;
		}

		.btn-danger:hover {
			background: #c0392b;
		}

		.panel {
			background: var(--surface);
			border-radius: var(--radius-lg);
			padding: 0.5rem;
			box-shadow: 10px 10px 24px var(--shadow-dark), -10px -10px 24px var(--shadow-light);
		}

		.table-wrap {
			overflow-x: auto;
			border-radius: var(--radius-md);
		}

		table {
			width: 100%;
			border-collapse: separate;
			border-spacing: 0;
			font-size: 0.95rem;
		}

		thead th {
			text-align: left;
			padding: 1rem 1.25rem;
			font-family: 'Poppins', Arial, sans-serif;
			font-weight: 500;
			font-size: 0.82rem;
			color: var(--muted);
			background: var(--surface);
			box-shadow: inset 4px 4px 8px var(--shadow-dark), inset -4px -4px 8px var(--shadow-light);
		}

		thead th:first-child { border-top-left-radius: var(--radius-sm); border-bottom-left-radius: var(--radius-sm); }
		thead th:last-child { border-top-right-radius: var(--radius-sm); border-bottom-right-radius: var(--radius-sm); }

		tbody tr td {
			padding: 1rem 1.25rem;
			border-bottom: 1px solid #d7dfe7;
			transition: transform .15s ease, box-shadow .15s ease;
		}

		tbody tr:last-child td { border-bottom: 0; }

		tbody tr:hover td {
			background: var(--surface);
			box-shadow: 4px 4px 10px var(--shadow-dark), -4px -4px 10px var(--shadow-light);
		}

		tbody tr:hover td:first-child { border-top-left-radius: var(--radius-sm); border-bottom-left-radius: var(--radius-sm); }
		tbody tr:hover td:last-child { border-top-right-radius: var(--radius-sm); border-bottom-right-radius: var(--radius-sm); }

		.actions {
			display: flex;
			gap: 0.5rem;
		}

		.price {
			font-weight: 600;
			color: var(--accent);
		}

		.quantity {
			display: inline-block;
			padding: 0.25rem 0.75rem;
			border-radius: 12px;
			background: var(--accent-soft);
			color: var(--accent);
			font-size: 0.85rem;
			font-weight: 500;
		}

		.empty {
			display: flex;
			flex-direction: column;
			align-items: center;
			gap: .6rem;
			padding: 3.5rem 1rem;
			margin: 0.5rem;
			border-radius: var(--radius-md);
			color: var(--muted);
			text-align: center;
			box-shadow: inset 4px 4px 10px var(--shadow-dark), inset -4px -4px 10px var(--shadow-light);
		}

		.empty svg { width: 34px; height: 34px; color: var(--accent); opacity: .8; }

		.empty strong { color: var(--ink); font-family: 'Poppins', Arial, sans-serif; font-weight: 500; }

		@media (max-width: 640px) {
			.description { display: none; }
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
				<h1>Products</h1>
				<p class="subtitle">Manage your product inventory.</p>
			</div>
		</div>
		<div class="page-head-right">
			<a href="<?= htmlspecialchars(site_url('products/create'), ENT_QUOTES, 'UTF-8') ?>" class="btn">
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<line x1="12" y1="5" x2="12" y2="19"/>
					<line x1="5" y1="12" x2="19" y2="12"/>
				</svg>
				Add Product
			</a>
			<a href="<?= htmlspecialchars(site_url('logout'), ENT_QUOTES, 'UTF-8') ?>" class="btn btn-secondary">
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
					<path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
					<polyline points="16 17 21 12 16 7"/>
					<line x1="21" y1="12" x2="9" y2="12"/>
				</svg>
				Logout
			</a>
		</div>
	</div>

	<div class="panel">
		<div class="table-wrap">
			<table>
				<thead>
					<tr>
						<th>ID</th>
						<th>Product Name</th>
						<th>Description</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Created</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php if (empty($products)): ?>
						<tr>
							<td colspan="7">
								<div class="empty">
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
										<path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
										<line x1="3" y1="6" x2="21" y2="6"/>
										<path d="M16 10a4 4 0 0 1-8 0"/>
									</svg>
									<strong>No products yet</strong>
									<span>Start by adding your first product.</span>
								</div>
							</td>
						</tr>
					<?php else: ?>
						<?php foreach ($products as $product): ?>
							<tr>
								<td><?= htmlspecialchars((string) ($product['id'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
								<td><?= htmlspecialchars((string) ($product['product_name'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
								<td class="description"><?= htmlspecialchars((string) ($product['description'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
								<td class="price">$<?= number_format((float) ($product['price'] ?? 0), 2) ?></td>
								<td><span class="quantity"><?= htmlspecialchars((string) ($product['quantity'] ?? 0), ENT_QUOTES, 'UTF-8') ?></span></td>
								<td><?= htmlspecialchars((string) ($product['created_at'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
								<td>
									<div class="actions">
										<a href="<?= htmlspecialchars(site_url('products/edit/' . (string) ($product['id'] ?? '')), ENT_QUOTES, 'UTF-8') ?>" class="btn btn-small">Edit</a>
										<form action="<?= htmlspecialchars(site_url('products/delete/' . (string) ($product['id'] ?? '')), ENT_QUOTES, 'UTF-8') ?>" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this product?');"><button type="submit" class="btn btn-small btn-danger">Delete</button></form>
									</div>
								</td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</main>
</body>
</html>
