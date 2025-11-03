<?php include 'check_auth.php'; ?>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="fas fa-utensils me-2"></i>Flavor Haven
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="index.php">
                        <i class="fas fa-home me-1"></i> Menu
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'orders.php' ? 'active' : ''; ?>" href="orders.php">
                        <i class="fas fa-shopping-cart me-1"></i> Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'new-order.php' ? 'active' : ''; ?>" href="new-order.php">
                        <i class="fas fa-plus-circle me-1"></i> New Order
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'table-management.php' ? 'active' : ''; ?>" href="table-management.php">
                        <i class="fas fa-chair me-1"></i> Tables
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>" href="about.php">
                        <i class="fas fa-info-circle me-1"></i> About
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user me-1"></i> <?php echo $_SESSION['full_name']; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="menu-manager.php"><i class="fas fa-cog me-2"></i> Manage Menu</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<style>
.navbar {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    padding: 15px 0;
    transition: all 0.3s ease;
}

.navbar-brand {
    font-weight: 700;
    font-size: 1.5rem;
    color: white !important;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.navbar-nav .nav-link {
    color: rgba(255, 255, 255, 0.9) !important;
    font-weight: 500;
    margin: 0 10px;
    padding: 8px 16px !important;
    border-radius: 25px;
    transition: all 0.3s ease;
    position: relative;
}

.navbar-nav .nav-link:hover {
    color: white !important;
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-2px);
}

.navbar-nav .nav-link.active {
    color: white !important;
    background: linear-gradient(135deg, var(--primary), var(--accent));
    box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
}

.navbar-toggler {
    border: 1px solid rgba(255, 255, 255, 0.3);
    padding: 4px 8px;
}

.navbar-toggler:focus {
    box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.3);
}

.dropdown-menu {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 10px;
}

.dropdown-item {
    padding: 8px 15px;
}

@media (max-width: 991px) {
    .navbar-nav {
        text-align: center;
        margin-top: 15px;
    }
    
    .nav-link {
        margin: 5px 0 !important;
    }
}
</style>