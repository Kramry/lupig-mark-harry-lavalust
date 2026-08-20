<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Ledger | Profile</title>
    <style>
        :root { --ink: #10232a; --muted: #4d6a73; --paper: #eef6f4; --accent: #0f7a6c; --line: #c5d9d4; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; color: var(--ink); background: linear-gradient(135deg, #eef6f4 0 58%, #d7ece7 58%); font-family: Arial, sans-serif; }
        main { width: min(760px, 92%); margin: auto; padding: 5rem 0; }
        nav { display: flex; gap: 1.25rem; margin-bottom: 3.5rem; font-size: .85rem; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; }
        nav a { color: var(--ink); text-decoration: none; border-bottom: 2px solid var(--accent); padding-bottom: .3rem; }
        .eyebrow { color: var(--accent); font-size: .75rem; font-weight: 700; letter-spacing: .16em; text-transform: uppercase; }
        h1 { margin: .7rem 0 2.2rem; font: 400 clamp(2.6rem, 7vw, 5rem) Georgia, serif; }
        dl { display: grid; grid-template-columns: 1fr 2fr; margin: 0; border-top: 1px solid var(--line); }
        dt, dd { margin: 0; padding: 1.15rem 0; border-bottom: 1px solid var(--line); }
        dt { color: var(--muted); font-size: .72rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; }
        dd { font-size: 1.05rem; }
        @media (max-width: 600px) { main { padding: 3rem 0; } dl { grid-template-columns: 1fr; } dt { padding-bottom: .3rem; border-bottom: 0; } dd { padding-top: 0; } }
    </style>
</head>
<body>
<main>
    <nav>
        <a href="<?= site_url('student') ?>">Home</a>
        <a href="<?= site_url('student/profile') ?>">Student Profile</a>
    </nav>
    <span class="eyebrow">Protected record</span>
    <h1>Student Profile</h1>
    <dl>
        <dt>Student ID</dt><dd><?= htmlspecialchars($student['student_id'], ENT_QUOTES, 'UTF-8') ?></dd>
        <dt>Name</dt><dd><?= htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8') ?></dd>
        <dt>Course</dt><dd><?= htmlspecialchars($student['course'], ENT_QUOTES, 'UTF-8') ?></dd>
        <dt>Year Level</dt><dd><?= htmlspecialchars($student['year'], ENT_QUOTES, 'UTF-8') ?></dd>
        <dt>Section</dt><dd><?= htmlspecialchars($student['section'], ENT_QUOTES, 'UTF-8') ?></dd>
        <dt>Email</dt><dd><?= htmlspecialchars($student['email'], ENT_QUOTES, 'UTF-8') ?></dd>
        <dt>Address</dt><dd><?= htmlspecialchars($student['address'], ENT_QUOTES, 'UTF-8') ?></dd>
        <dt>Contact</dt><dd><?= htmlspecialchars($student['contact'], ENT_QUOTES, 'UTF-8') ?></dd>
        <dt>Skills</dt><dd><?= htmlspecialchars($student['skills'], ENT_QUOTES, 'UTF-8') ?></dd>
        <dt>Hobbies</dt><dd><?= htmlspecialchars($student['hobbies'], ENT_QUOTES, 'UTF-8') ?></dd>
        <dt>About</dt><dd><?= htmlspecialchars($student['about'], ENT_QUOTES, 'UTF-8') ?></dd>
    </dl>
</main>
</body>
</html>
