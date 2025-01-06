<head>
    <link rel="stylesheet" href="/styles/header.css">
</head>
<header class="header">
    <?php if (session()->get('isLoggedIn')): ?>
        <div class="header-left">
            <img src="logo_datapro_nobg.png" alt="DataPro Logo" class="logo">
            <div class="user-info">
                <h1 class="welcome-text">Welcome, <?= esc(session()->get('name')) ?></h1>
                <span class="username"><?= esc(session()->get('username')) ?></span>
            </div>
        </div>
        <div class="header-right">
            <nav class="nav-menu">
                    <a href="/" class="nav-link">Dashboard</a>
                    <a href="/about" class="nav-link">About</a>
                    <a href="/blog" class="nav-link">Blog</a>
                    <a href="/customer" class="nav-link">View Customer Table</a>
                    <a href="/customerAPI" class="nav-link">Customer API</a>
                    <a href="/coba" class="nav-link">Coba</a>
                    <a href="/cobaAPI" class="nav-link">Coba API</a>
            </nav>
            <button class="btn btn-logout" onclick="window.location.href='/logout'">Logout</button>
        </div>
    <?php else: ?>
        <div class="header-left">
            <img src="logo_datapro_nobg.png" alt="DataPro Logo" class="logo">
            <div class="user-info">
                <h1 class="welcome-text">Welcome, Guest</h1>
                <span class="username">Please login to continue</span>
            </div>
        </div>
        <div class="header-right">
            <nav class="nav-menu">
                <a href="/" class="nav-link">Dashboard</a>
                <a href="/about" class="nav-link">About</a>
                <a href="/blog" class="nav-link">Blog</a>
                <a href="/customer" class="nav-link">View Customer Table</a>
                <a href="/customerAPI" class="nav-link">Customer API</a>
                <a href="/coba" class="nav-link">Coba</a>
                <a href="/cobaAPI" class="nav-link">Coba API</a>
            </nav>
            <button class="btn btn-login" onclick="window.location.href='/authentication'">Login</button>
            <button class="btn btn-register" onclick="window.location.href='/authentication'">Register</button>
        </div>
    <?php endif; ?>
</header>