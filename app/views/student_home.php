<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$message = $_SESSION['student_message'] ?? null;
unset($_SESSION['student_message']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Ledger | <?= htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8') ?></title>
    <style>
        :root { --ink: #10232a; --muted: #4d6a73; --paper: #eef6f4; --accent: #0f7a6c; --line: #c5d9d4; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; color: var(--ink); background: radial-gradient(circle at 12% 8%, #fff 0, transparent 32%), var(--paper); font-family: Georgia, serif; }
        main { width: min(920px, 92%); margin: auto; padding: 5.5rem 0; }
        nav { display: flex; gap: 1.25rem; margin-bottom: 4.5rem; font: 700 0.85rem Arial, sans-serif; letter-spacing: .08em; text-transform: uppercase; }
        nav a { color: var(--ink); text-decoration: none; border-bottom: 2px solid var(--accent); padding-bottom: .3rem; }
        .kicker { color: var(--accent); font: 700 .78rem Arial, sans-serif; letter-spacing: .16em; text-transform: uppercase; }
        h1 { max-width: 720px; margin: .75rem 0 1.4rem; font-size: clamp(2.8rem, 8vw, 5.6rem); line-height: .95; font-weight: 400; }
        .intro { max-width: 580px; color: var(--muted); font-size: 1.12rem; line-height: 1.7; }
        .notice { margin: 2rem 0; padding: 1rem 1.25rem; border-left: 4px solid var(--accent); background: #fff; font: .95rem Arial, sans-serif; }
        .facts { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1px; margin-top: 3.5rem; border-top: 1px solid var(--line); border-bottom: 1px solid var(--line); }
        .fact { padding: 1.4rem 1rem; border-right: 1px solid var(--line); }
        .fact:last-child { border-right: 0; }
        .label { display: block; color: var(--muted); font: .7rem Arial, sans-serif; letter-spacing: .12em; text-transform: uppercase; }
        .value { display: block; margin-top: .55rem; font-size: 1.12rem; }
        @media (max-width: 600px) { main { padding: 3rem 0; } .facts { grid-template-columns: 1fr; } .fact { border-right: 0; border-bottom: 1px solid var(--line); } .fact:last-child { border-bottom: 0; } }
    </style>
</head>
<body>
<main>
    <nav>
        <a href="<?= site_url('student') ?>">Home</a>
        <a href="<?= site_url('student/profile') ?>">Student Profile</a>
    </nav>
    <span class="kicker">Campus Ledger</span>
    <h1>Student Information</h1>
    <p class="intro"><?= htmlspecialchars($student['about'], ENT_QUOTES, 'UTF-8') ?></p>
    <?php if ($message): ?><p class="notice"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
    <section class="facts" aria-label="Student summary">
        <div class="fact"><span class="label">Student ID</span><span class="value"><?= htmlspecialchars($student['student_id'], ENT_QUOTES, 'UTF-8') ?></span></div>
        <div class="fact"><span class="label">Name</span><span class="value"><?= htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8') ?></span></div>
        <div class="fact"><span class="label">Course</span><span class="value"><?= htmlspecialchars($student['course'], ENT_QUOTES, 'UTF-8') ?></span></div>
        <div class="fact"><span class="label">Year Level</span><span class="value"><?= htmlspecialchars($student['year'], ENT_QUOTES, 'UTF-8') ?></span></div>
        <div class="fact"><span class="label">Section</span><span class="value"><?= htmlspecialchars($student['section'], ENT_QUOTES, 'UTF-8') ?></span></div>
        <div class="fact"><span class="label">Email</span><span class="value"><?= htmlspecialchars($student['email'], ENT_QUOTES, 'UTF-8') ?></span></div>
    </section>
</main>
</body>
</html>
