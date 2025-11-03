<?php include 'check_auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flavor Haven - Menu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --accent: #f72585;
            --dark: #1d3557;
            --light: #f8f9fa;
            --card-bg: rgba(255, 255, 255, 0.95);
        }

        * {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-attachment: fixed;
            min-height: 100vh;
            color: #333;
            overflow-x: hidden;
            padding-top: 80px; /
        }

        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            left: 80%;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            top: 80%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
        }

        .glass-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .glass-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .glass-card:hover::before {
            transform: scaleX(1);
        }

        .main-container {
            padding: 40px 0;
        }

        .header-section {
            padding: 30px 0;
            margin-bottom: 50px;
            text-align: center;
            position: relative;
        }

        .header-section h1 {
            font-weight: 800;
            color: white;
            font-size: 3.5rem;
            margin-bottom: 15px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, #fff 0%, #f0f0f0 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .header-section p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 30px;
            font-weight: 300;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .menu-image {
            height: 220px;
            object-fit: cover;
            width: 100%;
            transition: transform 0.4s ease;
        }

        .glass-card:hover .menu-image {
            transform: scale(1.1);
        }

        .image-container {
            overflow: hidden;
            border-radius: 20px 20px 0 0;
        }

        .card-body {
            padding: 25px;
            position: relative;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .card-title {
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 12px;
            font-size: 1.3rem;
        }

        .card-text {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
            font-size: 0.95rem;
            flex-grow: 1;
        }

        .price-tag {
            font-weight: 800;
            color: var(--primary);
            font-size: 1.5rem;
            text-shadow: 0 2px 5px rgba(67, 97, 238, 0.2);
            white-space: nowrap;
        }

        .order-btn {
            background: linear-gradient(135deg, var(--success), #4895ef);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 5px 15px rgba(76, 201, 240, 0.3);
            text-decoration: none;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .order-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(76, 201, 240, 0.4);
            color: white;
        }

        .food-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .badge-popular {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, var(--accent), #b5179e);
            color: white;
            padding: 5px 15px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            z-index: 2;
            box-shadow: 0 4px 15px rgba(247, 37, 133, 0.3);
        }

        .stats-bar {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            margin: 40px auto;
            max-width: 800px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stat-item {
            text-align: center;
            color: white;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
            background: linear-gradient(135deg, #fff, #f0f0f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
            font-weight: 300;
        }

        .footer {
            text-align: center;
            padding: 40px 0 20px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        .price-order-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid rgba(0,0,0,0.1);
            gap: 10px;
        }

        /* Animation classes */
        .animate-fade-in {
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Stagger animation for cards */
        .food-grid .glass-card {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
        }

        .food-grid .glass-card:nth-child(1) { animation-delay: 0.1s; }
        .food-grid .glass-card:nth-child(2) { animation-delay: 0.2s; }
        .food-grid .glass-card:nth-child(3) { animation-delay: 0.3s; }
        .food-grid .glass-card:nth-child(4) { animation-delay: 0.4s; }
        .food-grid .glass-card:nth-child(5) { animation-delay: 0.5s; }
        .food-grid .glass-card:nth-child(6) { animation-delay: 0.6s; }

        @media (max-width: 768px) {
            body {
                padding-top: 70px;
            }
            
            .header-section h1 {
                font-size: 2.5rem;
            }
            
            .header-section p {
                font-size: 1.1rem;
            }
            
            .food-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .stats-bar {
                padding: 15px;
            }
            
            .stat-number {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="main-container">
        <div class="container">
            <div class="header-section animate__animated animate__fadeInDown">
                <h1><i class="fas fa-utensils me-3"></i>Our Menu</h1>
                <p class="mt-3">Experience culinary excellence with our carefully crafted dishes made from the finest ingredients</p>
            </div>

            <div class="stats-bar glass-card animate__animated animate__fadeInUp">
                <div class="row text-center">
                    <div class="col-md-3 col-6 stat-item">
                        <div class="stat-number">
                            <?php
                                include('./conn/conn.php');
                                $stmt = $conn->prepare("SELECT COUNT(*) FROM tbl_menu");
                                $stmt->execute();
                                echo $stmt->fetchColumn();
                            ?>
                        </div>
                        <div class="stat-label">Menu Items</div>
                    </div>
                    <div class="col-md-3 col-6 stat-item">
                        <div class="stat-number">15+</div>
                        <div class="stat-label">Categories</div>
                    </div>
                    <div class="col-md-3 col-6 stat-item">
                        <div class="stat-number">4.9</div>
                        <div class="stat-label">Customer Rating</div>
                    </div>
                    <div class="col-md-3 col-6 stat-item">
                        <div class="stat-number">5+</div>
                        <div class="stat-label">Years Experience</div>
                    </div>
                </div>
            </div>

            <div class="food-grid">
                <?php
                    include('./conn/conn.php');

                    $stmt = $conn->prepare("SELECT * FROM tbl_menu");
                    $stmt->execute();

                    $result = $stmt->fetchAll();
                    $count = 0;

                    foreach ($result as $row) {
                        $count++;
                        $image = $row['image'];
                        $name = $row['name'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $menuId = $row['tbl_menu_id'];
                        $isPopular = $count % 3 == 0; 
                        ?>
                        <div class="glass-card">
                            <?php if ($isPopular): ?>
                                <div class="badge-popular">
                                    <i class="fas fa-star me-1"></i> Popular
                                </div>
                            <?php endif; ?>
                            <div class="image-container">
                                <img src="<?= $image ?>" class="menu-image" alt="<?= $name ?>">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title"><?= $name ?></h5>
                                <p class="card-text"><?= $description ?></p>
                                <div class="price-order-container">
                                    <span class="price-tag">₱<?= number_format($price, 2) ?></span>
                                    <a href="new-order.php?add_item=<?= $menuId ?>" class="order-btn">
                                        <i class="fas fa-shopping-cart"></i> Order Now
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>
            </div>

            <div class="footer animate__animated animate__fadeInUp">
                <p>&copy; 2024 Flavor Haven Restaurant. Crafted with <i class="fas fa-heart" style="color: var(--accent);"></i> for food lovers.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stats = document.querySelectorAll('.stat-number');
            stats.forEach(stat => {
                if (!stat.innerText.includes('+') && !stat.innerText.includes('.')) {
                    const target = parseInt(stat.innerText);
                    let current = 0;
                    const increment = target / 50;
                    
                    const updateCount = () => {
                        if (current < target) {
                            current += increment;
                            stat.innerText = Math.ceil(current);
                            setTimeout(updateCount, 50);
                        } else {
                            stat.innerText = target;
                        }
                    };
                    
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                updateCount();
                                observer.unobserve(entry.target);
                            }
                        });
                    });
                    
                    observer.observe(stat);
                }
            });
        });
    </script>
</body>
</html>