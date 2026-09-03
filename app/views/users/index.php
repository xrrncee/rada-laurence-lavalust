<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <style>
        :root { --ink: #060a0d; --paper: #fffefc; --coral: #0f0705; --teal: #051715; --line: #100f0d; }
        * { box-sizing: border-box; }
        body { margin: 0; color: var(--ink); background: var(--paper); font-family: Georgia, 'Times New Roman', serif; }
        main { max-width: 1100px; margin: 0 auto; padding: 28px 24px 64px; }
        nav { display: flex; justify-content: space-between; border-bottom: 1px solid var(--line); padding-bottom: 18px; }
        nav a { color: var(--ink); font-weight: bold; text-decoration: none; }
        .eyebrow { margin-top: 72px; color: var(--coral); font: 700 12px Verdana, sans-serif; letter-spacing: .16em; text-transform: uppercase; }
        h1 { margin: 12px 0 14px; font-size: clamp(2.8rem, 7vw, 6rem); line-height: .95; font-weight: 400; }
        .intro { color: #363b38; font-size: 18px; }
        .table-wrap { margin-top: 42px; overflow-x: auto; border-top: 5px solid var(--teal); }
        table { width: 100%; min-width: 700px; border-collapse: collapse; text-align: left; }
        th { padding: 16px 14px; color: #3a3f3c; font: 700 11px Verdana, sans-serif; letter-spacing: .08em; text-transform: uppercase; }
        td { padding: 18px 14px; border-top: 1px solid var(--line); font-size: 17px; }
        td:first-child { color: var(--teal); font-weight: bold; }
        @media (max-width: 600px) { .eyebrow { margin-top: 52px; } main { padding-inline: 18px; } }
    </style>
</head>
<body>
<main>
    
    <p class="eyebrow"></p>
    <h1>User records</h1>
    <p class="intro"></p>
    <div class="table-wrap">
        <table>
            <thead>
                <tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Username</th></tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars((string) $user['id'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars((string) $user['firstname'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars((string) $user['lastname'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars((string) $user['email'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars((string) $user['username'], ENT_QUOTES, 'UTF-8') ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
</body>
</html>