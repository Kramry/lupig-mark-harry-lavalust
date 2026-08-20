<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Desk | Profile</title>
    <style>
        :root { --ink: #17212b; --muted: #62717d; --paper: #f5f1e8; --accent: #d95f39; --line: #d9d0c2; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; color: var(--ink); background: linear-gradient(135deg, #f5f1e8 0 60%, #e9dfd0 60%); font-family: Arial, sans-serif; }
        main { width: min(760px, 92%); margin: auto; padding: 5rem 0; }
        nav { margin-bottom: 4rem; } nav a { color: var(--ink); font-weight: 700; text-decoration: none; } nav a::before { content: '\2190  '; color: var(--accent); }
        .eyebrow { color: var(--accent); font-size: .75rem; font-weight: 700; letter-spacing: .16em; text-transform: uppercase; }
        h1 { margin: .7rem 0 2.5rem; font: 400 clamp(3rem, 8vw, 6rem) Georgia, serif; }
        dl { display: grid; grid-template-columns: 1fr 2fr; margin: 0; border-top: 1px solid var(--line); }
        dt, dd { margin: 0; padding: 1.25rem 0; border-bottom: 1px solid var(--line); }
        dt { color: var(--muted); font-size: .72rem; font-weight: 700; letter-spacing: .12em; text-transform: uppercase; }
        dd { font-size: 1.1rem; }
        @media (max-width: 600px) { main { padding: 3rem 0; } dl { grid-template-columns: 1fr; } dt { padding-bottom: .35rem; border-bottom: 0; } dd { padding-top: 0; } }
    </style>
</head>
<body>
<main>
    <nav><a href="<?= site_url('student') ?>">Back to student home</a></nav>
    <span class="eyebrow">Personal record</span>
    <h1>Student Profile</h1>
    <dl>
        <dt>Student ID</dt><dd><?= htmlspecialchars($student['student_id']) ?></dd>
        <dt>Name</dt><dd><?= htmlspecialchars($student['name']) ?></dd>
        <dt>Course</dt><dd><?= htmlspecialchars($student['course']) ?></dd>
        <dt>Year Level</dt><dd><?= htmlspecialchars($student['year']) ?></dd>
        <dt>Section</dt><dd><?= htmlspecialchars($student['section']) ?></dd>
        <dt>Email</dt><dd><?= htmlspecialchars($student['email']) ?></dd>
    </dl>
</main>
</body>
</html>