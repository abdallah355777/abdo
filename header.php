<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retail Shop</title>
    <link rel="stylesheet" href="style.css">
</head>

<?php
$current = basename($_SERVER['PHP_SELF']);

// Start session for login check
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<body>
    <div class="header-container">
        <div id="navMenu" class="hidden">
            <div>
                <a href="index.php" class="<?= $current === 'index.php' ? 'active' : '' ?>">Home</a>
                <a href="all_products.php" class="<?= $current === 'all_products.php' ? 'active' : '' ?>">Products</a>
                <a href="admin_login.php" class="<?= $current === 'admin_login.php' ? 'active' : '' ?>">Admin
                    Portal</a>
            </div>
        </div>
        <header class="header-wrapper">
            <div id="menuToggle" class="hum-menu">
                <svg width="800px" height="800px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <title>Menu</title>
                    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Menu">
                            <rect id="Rectangle" fill-rule="nonzero" x="0" y="0" width="24" height="24">

                            </rect>
                            <line x1="5" y1="7" x2="19" y2="7" id="Path" stroke="#0C0310" stroke-width="2"
                                stroke-linecap="round">

                            </line>
                            <line x1="5" y1="17" x2="19" y2="17" id="Path" stroke="#0C0310" stroke-width="2"
                                stroke-linecap="round">

                            </line>
                            <line x1="5" y1="12" x2="19" y2="12" id="Path" stroke="#0C0310" stroke-width="2"
                                stroke-linecap="round">

                            </line>
                        </g>
                    </g>
                </svg>
            </div>
            <h1><a href="index.php">ABDO Shop</a></h1>
            <nav>
                <div>
                    <a href="index.php" class="<?= $current === 'index.php' ? 'active' : '' ?>">Home</a>
                    <a href="all_products.php"
                        class="<?= $current === 'all_products.php' ? 'active' : '' ?>">Products</a>
                    <a href="admin_login.php" class="<?= $current === 'admin_login.php' ? 'active' : '' ?>">Admin
                        Portal</a>
                </div>
            </nav>
            <div class="account">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="cart.php" title="Cart">
                        <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M3.86376 16.4552C3.00581 13.0234 2.57684 11.3075 3.47767 10.1538C4.3785 9 6.14721 9 9.68462 9H14.3153C17.8527 9 19.6214 9 20.5222 10.1538C21.4231 11.3075 20.9941 13.0234 20.1362 16.4552C19.5905 18.6379 19.3176 19.7292 18.5039 20.3646C17.6901 21 16.5652 21 14.3153 21H9.68462C7.43476 21 6.30983 21 5.49605 20.3646C4.68227 19.7292 4.40943 18.6379 3.86376 16.4552Z" />
                            <path
                                d="M19.5 9.5L18.7896 6.89465C18.5157 5.89005 18.3787 5.38775 18.0978 5.00946C17.818 4.63273 17.4378 4.34234 17.0008 4.17152C16.5619 4 16.0413 4 15 4M4.5 9.5L5.2104 6.89465C5.48432 5.89005 5.62128 5.38775 5.90221 5.00946C6.18199 4.63273 6.56216 4.34234 6.99922 4.17152C7.43808 4 7.95872 4 9 4" />
                            <path
                                d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4C15 4.55228 14.5523 5 14 5H10C9.44772 5 9 4.55228 9 4Z" />
                        </svg>
                    </a>
                    <a href="logout.php" title="Logout">
                        <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M9.00195 7C9.01406 4.82497 9.11051 3.64706 9.87889 2.87868C10.7576 2 12.1718 2 15.0002 2L16.0002 2C18.8286 2 20.2429 2 21.1215 2.87868C22.0002 3.75736 22.0002 5.17157 22.0002 8L22.0002 16C22.0002 18.8284 22.0002 20.2426 21.1215 21.1213C20.2429 22 18.8286 22 16.0002 22H15.0002C12.1718 22 10.7576 22 9.87889 21.1213C9.11051 20.3529 9.01406 19.175 9.00195 17"
                                stroke-linecap="round" />
                            <path d="M15 12L2 12M2 12L5.5 9M2 12L5.5 15" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                <?php else: ?>
                    <a href="login.php" class="header-login-btn">Login/Register</a>
                <?php endif; ?>
            </div>
        </header>
    </div>
</body>


<script>
    const toggle = document.getElementById('menuToggle');
    const navMenu = document.getElementById('navMenu');

    toggle.addEventListener('click', () => {
        navMenu.classList.toggle('show-navMenu');
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) {
            navMenu.classList.remove('show-navMenu');
        }
    });
</script>