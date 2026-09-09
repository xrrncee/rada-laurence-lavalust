<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product | Login</title>
    <style>
        :root { --ink:#17221f; --paper:#f4f0e8; --accent:#d9573f; --line:#c9c0b2; }
        * { box-sizing:border-box; } body { margin:0; min-height:100vh; display:grid; place-items:center; color:var(--ink); background:radial-gradient(circle at 10% 10%, #e7c9a5, transparent 34%), var(--paper); font-family:Georgia, serif; }
        main { width:min(440px, calc(100% - 36px)); } .eyebrow { font:700 11px Verdana,sans-serif; letter-spacing:.16em; text-transform:uppercase; color:var(--accent); } h1 { font-size:clamp(3rem, 10vw, 5rem); line-height:.9; font-weight:400; margin:12px 0 32px; } form { border-top:4px solid var(--ink); padding-top:24px; } label { display:block; margin:18px 0 7px; font:700 11px Verdana,sans-serif; text-transform:uppercase; letter-spacing:.08em; } input { width:100%; padding:13px 12px; border:1px solid var(--line); background:#fffdf8; font:16px Georgia,serif; } button { margin-top:24px; width:100%; padding:14px; border:0; background:var(--ink); color:#fffdf8; font-weight:700; cursor:pointer; } .error { color:#a52d22; margin:0 0 14px; }
    </style>
</head>
<body><main>
    <div class="eyebrow"></div><h1>Sign in.</h1>
    <?php if ($error): ?><p class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p><?php endif; ?>
    <form method="post" action="<?= base_url('login') ?>">
        <label for="username">Username</label><input id="username" name="username" required autofocus>
        <label for="password">Password</label><input id="password" type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</main></body></html>