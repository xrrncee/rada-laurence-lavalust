<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8') ?> | Student Profile</title>
    <style>
        :root { --ink: #17222b; --paper: #f5f0e8; --coral: #e76f51; --teal: #2a9d8f; --line: #c9c0b4; }
        * { box-sizing: border-box; }
        body { margin: 0; color: var(--ink); background: var(--paper); font-family: Georgia, 'Times New Roman', serif; }
        main { max-width: 820px; margin: 0 auto; padding: 28px 24px 64px; }
        nav { display: flex; justify-content: space-between; border-bottom: 1px solid var(--line); padding-bottom: 18px; }
        nav a { color: var(--ink); font-weight: bold; text-decoration: none; }
        .kicker { margin-top: 76px; color: var(--coral); font: 700 12px Verdana, sans-serif; letter-spacing: .16em; text-transform: uppercase; }
        h1 { margin: 12px 0 42px; font-size: clamp(3rem, 8vw, 6rem); line-height: .9; font-weight: 400; }
        dl { border-top: 1px solid var(--line); margin: 0; }
        .row { display: grid; grid-template-columns: 180px 1fr; gap: 20px; border-bottom: 1px solid var(--line); padding: 20px 0; }
        dt { color: #5b625e; font: 700 11px Verdana, sans-serif; letter-spacing: .1em; text-transform: uppercase; }
        dd { margin: 0; font-size: 21px; }
        .return { display: inline-block; margin-top: 40px; color: var(--teal); font-weight: bold; }
        @media (max-width: 600px) { .kicker { margin-top: 52px; } .row { grid-template-columns: 1fr; gap: 8px; } }
    </style>
</head>
<body>
<main>
    <nav><a href="<?= site_url('student') ?>">MCC2024 / 00140</a><a href="<?= site_url('student') ?>">Home</a></nav>
    <p class="kicker">Verified student profile</p>
    <h1><?= htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8') ?></h1>
    <dl>
        <div class="row"><dt>Student ID</dt><dd><?= htmlspecialchars($student['student_id'], ENT_QUOTES, 'UTF-8') ?></dd></div>
        <div class="row"><dt>Course</dt><dd><?= htmlspecialchars($student['course'], ENT_QUOTES, 'UTF-8') ?></dd></div>
        <div class="row"><dt>Year level</dt><dd><?= htmlspecialchars($student['year'], ENT_QUOTES, 'UTF-8') ?></dd></div>
        <div class="row"><dt>Section</dt><dd><?= htmlspecialchars($student['section'], ENT_QUOTES, 'UTF-8') ?></dd></div>
        <div class="row"><dt>Email</dt><dd><?= htmlspecialchars($student['email'], ENT_QUOTES, 'UTF-8') ?></dd></div>
        <div class="row"><dt>Current focus</dt><dd><?= htmlspecialchars($student['focus'], ENT_QUOTES, 'UTF-8') ?></dd></div>
    </dl>
    <a class="return" href="<?= site_url('student') ?>"><- Return to student home</a>
</main>
</body>
</html>