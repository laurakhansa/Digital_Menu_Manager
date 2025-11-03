<?php include 'check_auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flavor Haven - About</title>

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
            padding-top: 80px;
        }

        .glass-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .main-container {
            padding: 40px 0;
        }

        .header-section {
            padding: 30px 0;
            margin-bottom: 40px;
            text-align: center;
        }

        .header-section h1 {
            font-weight: 800;
            color: white;
            font-size: 3rem;
            margin-bottom: 15px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .header-section p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .about-card {
            padding: 30px;
            margin-bottom: 30px;
        }

        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 1.8rem;
        }

        .team-member {
            text-align: center;
            padding: 20px;
        }

        .member-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 15px;
            border: 4px solid var(--primary);
        }

        @media (max-width: 768px) {
            body {
                padding-top: 70px;
            }
            
            .header-section h1 {
                font-size: 2.2rem;
            }
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="main-container">
        <div class="container">
            <div class="header-section">
                <h1><i class="fas fa-info-circle me-3"></i>About Flavor Haven</h1>
                <p class="mt-3">Discover the story behind our passion for exceptional cuisine</p>
            </div>

            <div class="glass-card about-card">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2>Our Story</h2>
                        <p class="lead">Founded in 2018, Flavor Haven began as a small family restaurant with a big dream: to bring exceptional culinary experiences to our community.</p>
                        <p>What started as a humble kitchen serving traditional family recipes has evolved into a culinary destination known for innovation, quality, and unforgettable dining experiences.</p>
                        <p>Today, we continue to honor our roots while embracing new culinary techniques and global flavors that delight our guests.</p>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="feature-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h4>Passion for Food</h4>
                        <p>Every dish tells a story of dedication and love for culinary excellence.</p>
                    </div>
                </div>
            </div>

            <div class="glass-card about-card">
                <h2 class="text-center mb-5">Our Values</h2>
                <div class="row">
                    <div class="col-md-4 text-center mb-4">
                        <div class="feature-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h4>Fresh Ingredients</h4>
                        <p>We source only the freshest, highest quality ingredients from local farmers and trusted suppliers.</p>
                    </div>
                    <div class="col-md-4 text-center mb-4">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Community Focus</h4>
                        <p>We believe in building strong community ties and supporting local businesses and initiatives.</p>
                    </div>
                    <div class="col-md-4 text-center mb-4">
                        <div class="feature-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h4>Excellence</h4>
                        <p>Every dish is crafted with attention to detail and a commitment to exceptional quality.</p>
                    </div>
                </div>
            </div>

            <div class="glass-card about-card">
                <h2 class="text-center mb-5">Meet Our Team</h2>
                <div class="row">
                    <div class="col-md-4 team-member">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" class="member-image" alt="Chef Marco">
                        <h4>Chef Marco Rodriguez</h4>
                        <p class="text-muted">Head Chef & Founder</p>
                        <p>With over 15 years of culinary experience, Chef Marco brings innovation and tradition to every dish.</p>
                    </div>
                    <div class="col-md-4 team-member">
                        <img src="https://images.unsplash.com/photo-1554151228-14d9def656e4?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" class="member-image" alt="Sarah">
                        <h4>Sarah Chen</h4>
                        <p class="text-muted">Restaurant Manager</p>
                        <p>Sarah ensures every guest experiences the warmth and excellence that defines Flavor Haven.</p>
                    </div>
                    <div class="col-md-4 team-member">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" class="member-image" alt="James">
                        <h4>James Wilson</h4>
                        <p class="text-muted">Sous Chef</p>
                        <p>James brings creativity and precision to our kitchen, crafting dishes that surprise and delight.</p>
                    </div>
                </div>
            </div>

            <div class="glass-card about-card text-center">
                <h2 class="mb-4">Visit Us</h2>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <i class="fas fa-map-marker-alt fa-2x text-primary mb-3"></i>
                        <h5>Location</h5>
                        <p>123 Culinary Avenue<br>Foodie District, FH 10101</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <i class="fas fa-clock fa-2x text-primary mb-3"></i>
                        <h5>Hours</h5>
                        <p>Mon-Thu: 11AM-10PM<br>Fri-Sun: 11AM-11PM</p>
                    </div>
                    <div class="col-md-4 mb-3">
                        <i class="fas fa-phone fa-2x text-primary mb-3"></i>
                        <h5>Contact</h5>
                        <p>(555) 123-FOOD<br>hello@flavorhaven.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>