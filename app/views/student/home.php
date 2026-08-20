<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>John Laurence Rada | Student Home</title>
    <style>
        :root { --ink: #17222b; --paper: #f5f0e8; --coral: #e76f51; --teal: #2a9d8f; --line: #c9c0b4; }
        * { box-sizing: border-box; }
        body { margin: 0; color: var(--ink); background: var(--paper); font-family: Georgia, 'Times New Roman', serif; }
        main { max-width: 960px; margin: 0 auto; padding: 28px 24px 64px; }
        nav { display: flex; justify-content: space-between; border-bottom: 1px solid var(--line); padding-bottom: 18px; }
        nav a { color: var(--ink); font-weight: bold; text-decoration: none; }
        .eyebrow { color: var(--coral); letter-spacing: .16em; text-transform: uppercase; font: 700 12px Verdana, sans-serif; }
        h1 { max-width: 680px; margin: 72px 0 18px; font-size: clamp(3rem, 8vw, 6.5rem); line-height: .9; font-weight: 400; }
        .intro { max-width: 560px; font-size: 20px; line-height: 1.55; }
        .strip { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; margin-top: 54px; }
        .panel { border-top: 5px solid var(--teal); padding: 22px 0; }
        .panel strong { display: block; font-size: 28px; font-weight: 400; }
        .panel span { display: block; margin-top: 8px; color: #5b625e; font: 12px Verdana, sans-serif; text-transform: uppercase; letter-spacing: .08em; }
        .notice { margin-top: 28px; padding: 14px 18px; background: #e6dfd2; font: 13px Verdana, sans-serif; }
        @media (max-width: 600px) { h1 { margin-top: 52px; } .strip { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
<main>
    <nav>
        <a href="<?= site_url('student') ?>">MCC2024 /00140 </a>
        <a href="<?= site_url('student/profile') ?>">Open profile -></a>
    </nav>
    <p class="eyebrow">Student information page / field notes</p>
    <h1>I am the Best in my own way.</h1>
    <p class="intro">Welcome to <?= htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8') ?> student information page, simple page for my student profile.</p>
    <div class="strip">
        <div class="panel"><strong><?= htmlspecialchars($student['course'], ENT_QUOTES, 'UTF-8') ?></strong><span>Course</span></div>
        <div class="panel"><strong><?= htmlspecialchars($student['year'], ENT_QUOTES, 'UTF-8') ?> / <?= htmlspecialchars($student['section'], ENT_QUOTES, 'UTF-8') ?></strong><span>Current standing</span></div>
    </div>
    <?php if (!empty($notice)): ?><p class="notice"><?= htmlspecialchars($notice, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
</main>
</body>
</html>