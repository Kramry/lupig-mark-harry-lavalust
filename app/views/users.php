<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$users = $users ?? [];

/** Small helper: two-letter initials for the avatar badge. */
function user_initials(array $user): string {
	$f = mb_substr((string) ($user['firstname'] ?? ''), 0, 1);
	$l = mb_substr((string) ($user['lastname'] ?? ''), 0, 1);
	$initials = strtoupper($f . $l);
	return $initials !== '' ? $initials : '?';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Users | User Management</title>
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
			gap: 1.25rem;
			margin-bottom: 2.75rem;
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

		.person {
			display: flex;
			align-items: center;
			gap: .75rem;
		}

		.avatar {
			flex: none;
			width: 36px;
			height: 36px;
			border-radius: 50%;
			display: grid;
			place-items: center;
			background: var(--accent-soft);
			color: var(--accent);
			font-family: 'Poppins', Arial, sans-serif;
			font-weight: 600;
			font-size: 0.78rem;
			box-shadow: 3px 3px 6px var(--shadow-dark), -3px -3px 6px var(--shadow-light);
		}

		.name { font-weight: 500; }

		.email, .username { color: var(--muted); }

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
			.email { display: none; }
		}
	</style>
</head>
<body>
<main>
	<div class="page-head">
		<span class="badge" aria-hidden="true">
			<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
				<path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/>
				<circle cx="10" cy="7" r="4"/>
				<path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
				<path d="M16 3.13a4 4 0 0 1 0 7.75"/>
			</svg>
		</span>
		<div>
			<h1>Users</h1>
			<p class="subtitle">Everyone with access to the user management module.</p>
		</div>
	</div>

	<div class="panel">
		<div class="table-wrap">
			<table>
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>Username</th>
					</tr>
				</thead>
				<tbody>
					<?php if (empty($users)): ?>
						<tr>
							<td colspan="4">
								<div class="empty">
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
										<path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/>
										<circle cx="10" cy="7" r="4"/>
										<line x1="19" y1="8" x2="19" y2="14"/>
										<line x1="22" y1="11" x2="16" y2="11"/>
									</svg>
									<strong>No users yet</strong>
									<span>Once accounts are added, they'll show up here.</span>
								</div>
							</td>
						</tr>
					<?php else: ?>
						<?php foreach ($users as $user): ?>
							<tr>
								<td><?= htmlspecialchars((string) ($user['id'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
								<td>
									<div class="person">
										<span class="avatar" aria-hidden="true"><?= htmlspecialchars(user_initials($user), ENT_QUOTES, 'UTF-8') ?></span>
										<span class="name"><?= htmlspecialchars(trim((string) ($user['firstname'] ?? '') . ' ' . (string) ($user['lastname'] ?? '')), ENT_QUOTES, 'UTF-8') ?></span>
									</div>
								</td>
								<td class="email"><?= htmlspecialchars((string) ($user['email'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
								<td class="username"><?= htmlspecialchars((string) ($user['username'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
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