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
    <title>Student Desk | Home</title>
    <style>
        :root { --ink: #17212b; --muted: #62717d; --paper: #f5f1e8; --accent: #d95f39; --line: #d9d0c2; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; color: var(--ink); background: radial-gradient(circle at 15% 10%, #fff8e9 0, transparent 35%), var(--paper); font-family: Georgia, serif; }
        main { width: min(900px, 92%); margin: auto; padding: 6rem 0; }
        nav { display: flex; justify-content: space-between; gap: 1rem; margin-bottom: 5rem; font: 700 0.85rem Arial, sans-serif; text-transform: uppercase; letter-spacing: .12em; }
        nav a { color: var(--ink); text-decoration: none; border-bottom: 2px solid var(--accent); padding-bottom: .35rem; }
        .kicker { color: var(--accent); font: 700 .8rem Arial, sans-serif; letter-spacing: .18em; text-transform: uppercase; }
        h1 { max-width: 680px; margin: .75rem 0 1.5rem; font-size: clamp(3.3rem, 9vw, 7rem); line-height: .9; font-weight: 400; }
        .intro { max-width: 560px; color: var(--muted); font-size: 1.15rem; line-height: 1.7; }
        .notice { margin: 2rem 0; padding: 1rem 1.25rem; border-left: 4px solid var(--accent); background: #fff8e9; font: .95rem Arial, sans-serif; }
        .facts { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1px; margin-top: 4rem; border-top: 1px solid var(--line); border-bottom: 1px solid var(--line); }
        .fact { padding: 1.5rem 1rem; border-right: 1px solid var(--line); }
        .fact:last-child { border-right: 0; }
        .label { display: block; color: var(--muted); font: .7rem Arial, sans-serif; letter-spacing: .12em; text-transform: uppercase; }
        .value { display: block; margin-top: .55rem; font-size: 1.15rem; }
        @media (max-width: 600px) { main { padding: 3rem 0; } nav { margin-bottom: 4rem; } .facts { grid-template-columns: 1fr; } .fact { border-right: 0; border-bottom: 1px solid var(--line); } .fact:last-child { border-bottom: 0; } }
    </style>
</head>
<body>
<main>
    <nav><a href="<?= site_url('student') ?>">Student Desk</a><a href="<?= site_url('student/profile') ?>">Profile &rarr;</a></nav>
    <span class="kicker">Web Systems and Technologies</span>
    <h1>Welcome to my student page.</h1>
    <p class="intro">A small LavaLust application that keeps my academic identity in one clear place.</p>
    <?php if ($message): ?><p class="notice"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
    <section class="facts" aria-label="Student summary">
        <div class="fact"><span class="label">Student ID</span><span class="value"><?= htmlspecialchars($student['student_id']) ?></span></div>
        <div class="fact"><span class="label">Course</span><span class="value"><?= htmlspecialchars($student['course']) ?></span></div>
        <div class="fact"><span class="label">Section</span><span class="value"><?= htmlspecialchars($student['section']) ?></span></div>
    </section>
</main>
</body>
</html>