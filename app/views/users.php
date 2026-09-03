<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$users = $users ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Users | User Management</title>
	<style>
		:root { --ink: #10232a; --muted: #4d6a73; --paper: #eef6f4; --accent: #0f7a6c; --line: #c5d9d4; }
		* { box-sizing: border-box; }
		body { margin: 0; min-height: 100vh; color: var(--ink); background: radial-gradient(circle at 12% 8%, #fff 0, transparent 32%), var(--paper); font-family: Georgia, serif; }
		main { width: min(1100px, 92%); margin: auto; padding: 4.5rem 0; }
		.kicker { color: var(--accent); font: 700 .78rem Arial, sans-serif; letter-spacing: .16em; text-transform: uppercase; }
		h1 { margin: .75rem 0 1.8rem; font-size: clamp(2.2rem, 6vw, 3.6rem); font-weight: 400; line-height: 1; }
		.table-wrap { overflow-x: auto; background: #fff; border: 1px solid var(--line); }
		table { width: 100%; border-collapse: collapse; font: 0.95rem Arial, sans-serif; }
		th, td { text-align: left; padding: .9rem 1rem; border-bottom: 1px solid var(--line); }
		th { color: var(--muted); font-size: .72rem; letter-spacing: .1em; text-transform: uppercase; background: #f7fbfa; }
		tr:last-child td { border-bottom: 0; }
		.empty { padding: 1.5rem 1rem; color: var(--muted); font: 1rem Arial, sans-serif; }
	</style>
</head>
<body>
<main>
	<span class="kicker">User Management Module</span>
	<h1>Users</h1>
	<div class="table-wrap">
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Username</th>
				</tr>
			</thead>
			<tbody>
				<?php if (empty($users)): ?>
					<tr>
						<td colspan="5" class="empty">No users found in the database.</td>
					</tr>
				<?php else: ?>
					<?php foreach ($users as $user): ?>
						<tr>
							<td><?= htmlspecialchars((string) ($user['id'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
							<td><?= htmlspecialchars((string) ($user['firstname'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
							<td><?= htmlspecialchars((string) ($user['lastname'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
							<td><?= htmlspecialchars((string) ($user['email'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
							<td><?= htmlspecialchars((string) ($user['username'] ?? ''), ENT_QUOTES, 'UTF-8') ?></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</main>
</body>
</html>
