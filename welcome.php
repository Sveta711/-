<?php
require_once 'config.php';
require_once 'BookRepository.php';

// Ստուգում ենք, արդյոք Database կլասը կա
$connection = Database::getInstance();
$bookRepository = new BookRepository($connection);

// Ստանում ենք բոլոր գրքերը բազայից
$dynamicBooks = $bookRepository->getAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>catalog site</title>
   <script src="https://kit.fontawesome.com/c96de77452.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="icon" href="image/logo.png" type="image/x-icon">
       <link rel="stylesheet" href="style.css">
<style>
    .cart-icon-wrapper {
            position: relative;
            cursor: pointer;
            padding: 10px;
            border-radius: 50%;
            background: #f8f8f8;
        }
        
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ff4757;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
        }
        
    .cart-modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .cart-modal-overlay.active {
            display: block;
            opacity: 1;
        }
        
        .cart-modal {
            position: fixed;
            top: 0;
            right: -400px;
            width: 380px;
            height: 100%;
            background: white;
            box-shadow: -5px 0 25px rgba(0, 0, 0, 0.1);
            z-index: 1001;
            transition: right 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        
        .cart-modal.active {
            right: 0;
        }
        
        .cart-modal-header {
            padding: 20px;
            border-bottom: 1px solid #eae5df;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #354a40;
            color: white;
        }
        
        .cart-modal-header h3 {
            margin: 0;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .close-cart {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            padding: 5px;
            line-height: 1;
        }
        
        .cart-modal-content {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
        }
        
        .cart-modal-item {
            display: flex;
            gap: 15px;
            padding: 15px;
            border-radius: 8px;
            background: #f9f9f9;
            margin-bottom: 15px;
            border: 1px solid #eaeaea;
        }
        
        .cart-modal-item-image {
            width: 60px;
            height: 80px;
            border-radius: 5px;
            overflow: hidden;
            flex-shrink: 0;
        }
        
        .cart-modal-item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .cart-modal-item-details {
            flex: 1;
        }
        
        .cart-modal-item-title {
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }
        
        .cart-modal-item-author {
            color: #666;
            font-size: 0.8rem;
            margin-bottom: 8px;
        }
        
        .cart-modal-item-price {
            color: #354a40;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .cart-modal-item-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    
        .quantity-control {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .quantity-btn {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            border: 1px solid #ddd;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
        }
        
        .quantity-input {
            width: 35px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 3px;
        }
        
        .remove-btn {
            background: none;
            border: none;
            color: #ff4757;
            font-size: 0.8rem;
            cursor: pointer;
            padding: 5px 8px;
            border-radius: 4px;
        }
        
        .cart-modal-empty {
            text-align: center;
            padding: 40px 20px;
        }
        
        .cart-modal-empty i {
            font-size: 48px;
            color: #d4a574;
            margin-bottom: 15px;
        }
        
        .cart-modal-footer {
            padding: 20px;
            border-top: 1px solid #eae5df;
            background: #f9f9f9;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }
        
        .summary-row.total {
            font-weight: 600;
            font-size: 1.1rem;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }
        
        .btn-checkout {
            width: 100%;
            padding: 12px;
            background: #354a40;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            margin-top: 15px;
        }
        
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #354a40;
            color: white;
            padding: 12px 18px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 1002;
            animation: slideIn 0.3s ease;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
</style>
</head>
<body>

   <header class="site-header">
        
        <div class="headernav">
        <div class="announcement-banner">
            <div class="container banner-container">
                
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="chevron-icon">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
                <div style="width:auto;">
                <marquee behavior="scroll" direction="left" scrollamount="6">    Enjoy Audiobooks Everywhere, Everytime</marquee></div>
                
               <div style="display: flex; gap: 10px; align-items: center; padding-bottom: 0;"> <i class="fa-solid fa-retweet"></i><a href="earn.php" class="header-link">Refer & Earn</a> </div>
             <div style="display: flex; gap: 10px; align-items: center; padding-bottom: 0;"> <i class="fa-regular fa-address-card"></i><a href="about.php" class="header-link">About</a></div>
                <div  style="display: flex; gap: 10px; align-items: center; padding-bottom: 0;"> <i class="fa-regular fa-circle-question"></i> <a href="support.php" class="header-link">Support</a></div>
                    
                    
                   
            
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="chevron-icon">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </div>
        </div>

        <!-- Section 2: Main Header (Desktop) -->
        <div class="nav">

        <div class="main-header desktop-only">
            <nav class="container">
                
                <!-- Left Side: Toggle -->
                <div class="header-toggle">
                    <span class="toggle-label-text">HOME </span>
                    <label for="office-toggle" class="toggle-switch">
                        <input id="office-toggle" type="checkbox" class="toggle-checkbox">
                        <span class="toggle-label">
                            <span class="toggle-knob"></span>
                        </span>
                    </label>
                    <span class="toggle-label-text ">DOWNLOADS</span>
                </div>
                
                <!-- Center: Logo -->
                <div class="header-logo">
                    <a href="#">AUDIORIA</a>
                </div>
                
                <!-- Right Side: Links & Icons -->
                <div class="header-right">
                    
                    <!-- User Icon -->
                     <a href="add_book.php" title="Add book"><i id="addbook" class="fa-solid fa-plus"></i></a>
                    <div class="account-menu">
                   <div class="user-icon"> <a href="#" class="icon-link">
                        <i class="fa-regular fa-user"></i>   </a></div>
                        <div class="account-dropdown">
                <h3 class="dropdown-title">Account</h3>
              <a href="index.php">  <button class="btn btn-primary">LOG OUT</button></a>
             
            </div></div>
                    <!-- Search Icon -->
                    <a href="#" class="icon-link">
                       <i class="fa-solid fa-magnifying-glass"></i>
                    </a>
                    <!-- Button -->
                    <a href="#" class="cta-button1">
                        LISTEN NOW
                    </a>
                    <!-- Cart Icon -->
                    <a href="#" id="cartIcon" class="icon-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                         <span id="cartBadge" class="cart-badge" style="display: none;">0</span>
                    </a>
                </div>
            </nav>
        </div>
        <div id="cartModalOverlay" class="cart-modal-overlay"></div>
    <div id="cartModal" class="cart-modal">
        <div class="cart-modal-header">
            <h3><i class="fas fa-shopping-cart"></i> Your Cart</h3>
            <button class="close-cart">&times;</button>
        </div>
        
        <div class="cart-modal-content" id="cartModalItems">
            <!-- Cart items loaded dynamically -->
        </div>
        
        <div class="cart-modal-footer">
            <div class="summary-row">
                <span>Subtotal</span>
                <span>$<span id="cartSubtotal">0.00</span></span>
            </div>
            <div class="summary-row">
                <span>Tax (10%)</span>
                <span>$<span id="cartTax">0.00</span></span>
            </div>
            <div class="summary-row total">
                <span>Total</span>
                <span>$<span id="cartTotal">0.00</span></span>
            </div>
            
            <button class="btn-checkout">
                <i class="fas fa-lock"></i> Proceed to Checkout
            </button>
        </div>
    </div>

        
        <div class="navigation-bar desktop-only">
            <nav class="container">
                <a href="#" class="w1">Shop By</a>
                <a href="#" class="w1">Online Books</a>
                <a href="#" class="w1">Free Audiobooks</a>
                <a href="#" class="w1"> Audiobooks</a>
                <a href="#" class="w1">Music </a>
                <a href="#" class="w1">Accessories</a>
                <a href="#" class="link-highlight">Black Friday</a>
            </nav>
        </div></div>
</div>


        <!-- Section 4: Mobile Header -->
         <div class="nav">
        <div class="mobile-header mobile-only">
            <button id="menu-btn" class="icon-button">
                <!-- Hamburger Icon -->
                <svg id="icon-menu" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
                <!-- Close Icon (hidden by default) -->
                <svg id="icon-close" class="hidden" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            
            <a href="#" class="mobile-logo">AUDIORIA</a>
             <a href="#" title="Add book"><i id="addbook" class="fa-solid fa-plus"></i></a>
                    <div class="account-menu">
                   <div class="user-icon"> <a href="#" class="icon-link">
                        <i class="fa-regular fa-user"></i>   </a></div>
                        <div class="account-dropdown">
                <h3 class="dropdown-title">Account</h3>
              <a href="signin.php">  <button class="btn btn-primary">SIGN IN</button></a>
              <a href="account.php">  <button class="btn btn-secondary">CREATE ACCOUNT</button></a>
            </div></div>
                    <!-- Search Icon -->
                    <a href="#" class="icon-link">
                       <i class="fa-solid fa-magnifying-glass"></i>
                    </a>
                    <!-- Button -->
                    <a href="#" class="cta-button1">
                        LISTEN NOW
                    </a>
                    <!-- Cart Icon -->
            <a href="#" class="icon-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
            </a>
        </div>

        <!-- Section 5: Mobile Menu (Dropdown) -->
        <div id="mobile-menu" class="mobile-menu mobile-only hidden">
            <!-- Nav Links -->
            <div class="mobile-menu-group">
                <a href="#">Shop By</a>
                <a href="#">Online Books</a>
                <a href="#">Free Audiobooks</a>
                <a href="#">Audiobooks</a>
                <a href="#">Music </a>
                <a href="#">Accessories</a>
                <a href="#" class="link-highlight">Black Friday</a>
            </div>
            
            <div class="mobile-menu-group-bottom">
                <!-- User Links -->
                <a href="#">Account</a>
                <a href="#">Refer & Earn</a>
                <a href="#">About</a>
                <a href="#">Support</a>
                
                
                <!-- Toggle -->
                <div class="header-toggle">
                    <span class="toggle-label-text">HOME OFFICE</span>
                    <label for="office-toggle-mobile" class="toggle-switch">
                        <input id="office-toggle-mobile" type="checkbox" class="toggle-checkbox">
                        <span class="toggle-label">
                            <span class="toggle-knob"></span>
                        </span>
                    </label>
                    <span class="toggle-label-text disabled">DOWNLOADS</span>
                </div>
                
                <!-- Button -->
                <a href="#" class="cta-button mobile-cta">
                    LISTEN NOW
                </a>
            </div>
        </div>
</div>
       
     

    </header>

    <main class="page-content">
         <div id="w1">
        <div id="h1"><h1 class="z">LISTEN  EVERYTIME, EVERYWHERE</h1></div><div class="logo1"><img  id="d1"src="image/logo.png"></div></div>
        <div class="placeholder-content" id="carousel">
                   <button class="nav-arrow prev-arrow"> &lt; </button>
            <div class="cards">
                <div class="carddiv"id="c0"></div>
           <div  class="carddiv"id="c7">  <a href="category.php?genre=audiobook" class="linkcard"><img src="image/audio.png"> <p class="cardtext">AUDIOBOOKS</p></a></div>
           <div class="carddiv" id="c1"> <a href="category.php?genre=romance" class="linkcard"> <img src="image/romance1.png"> <p class="cardtext">ROMANCE</p></a></div>
           <div class="carddiv"id="c2"> <a href="category.php?genre=history" class="linkcard"> <img src="image/history2.png">  <p class="cardtext">HISTORY</p></a> </div> 
           <div class="carddiv"id="c3"> <a href="category.php?genre=fantasy" class="linkcard"> <img src="image/fantasy2.png">  <p class="cardtext">FANTASY</p></a> </div>
           <div class="carddiv"id="c4"> <a href="category.php?genre=detective"class="linkcard" > <img src="image/detective.png"> <p class="cardtext">DETECTIVE</p></a></div>
           <div class="carddiv"id="c5"> <a href="category.php?genre=comedy" class="linkcard"> <img src="image/comedy.png"><p class="cardtext">COMEDY</p></a> </div>
           <div class="carddiv"id="c6"> <a href="category.php?genre=children" class="linkcard"> <img src="image/children1.png"><p class="cardtext">FOR CHILDREN</p></a> </div> 
        </div> <button class="nav-arrow next-arrow"> &gt; </button>
         <div class="button"> <button class="shop-button">SHOP</button></div>
    </div>
    <div claa="b1"><p class="b11">bye</p></div>
    
        

      <div class="books">
        <?php if (!empty($dynamicBooks)): ?>
        <?php foreach ($dynamicBooks as $book): ?>
            <div class="book1">
                <a href="book-details.php?id=<?php echo $book['id']; ?>">
                    <img src="<?php echo htmlspecialchars($book['cover_url']); ?>" 
                         class="img" 
                         alt="<?php echo htmlspecialchars($book['title']); ?>"
                         onerror="this.src='image/default-book.jpg'"> <h3 class="product-title"><?php echo htmlspecialchars($book['title']); ?></h3>
                    
                    <p class="product-author"><?php echo htmlspecialchars($book['author']); ?></p>
                    
                    <?php 
                        $price = (float)$book['price'];
                        if ($price == 0) {
                            echo '<div class="product-price" style="color:green;">FREE AUDIOBOOK</div>';
                        } else {
                            echo '<div class="product-price">' . number_format($price, 2) . '$</div>';
                        }
                    ?>
                </a>
                
                <button class="add-to-card" 
                        data-title="<?php echo htmlspecialchars($book['title']); ?>" 
                        data-author="<?php echo htmlspecialchars($book['author']); ?>" 
                        data-price="<?php echo $price; ?>" 
                        data-image="<?php echo htmlspecialchars($book['cover_url']); ?>">
                    ADD TO CART
                </button>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <div class="book1">
     <a href="defaultbook.php?type=static&id=pride">
            <img src="image/pride.jpg" class="img">
            <h3 class="product-title">PRIDE AND PREJUDICE</h3>
                <p class="product-author">JANE AUSTIN</p>
                <div class="product-price">FREE</div>
              
          <!--  <p class="booktext">PRIDE AND PREJUDICE</p>-->
        </a>
          <button class="add-to-card" data-title="Pride and Prejudice" data-author="Jane Austen" data-price="0" data-image="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400&h=300&fit=crop">ADD TO CART</button>
    </div>
    <div class="book1">
     <a href="defaultbook.php?type=static&id=harry1">

            <img src="image/harry.jpg"class="img">
             <h3 class="product-title">HARRY POTTER AND THE PHILISOPHER STONE</h3>
                <p class="product-author">JK ROWLING</p>
                <div class="product-price"style="color:green;">FREE AUDIOBOOK</div>
        </a>                <button class="add-to-card" data-title="HARRY POTTER-1" data-author="JK ROWLING"data-price="0" data-image="image/harry.jpg">ADD TO CART</button>

    </div>
    <div class="book1">
             <a href="defaultbook.php?type=static&id=davinchi">
            <img src="image/davinchi.jpg"class="img">
             <h3 class="product-title">CODE DA VINCHI</h3>
                <p class="product-author"> DAN BROWN</p>
                <div class="product-price">11.50$</div>
          <!--  <p class="booktext">DAVINCHI'S CODE</p>-->
        </a>
                        <button class="add-to-card" data-title="CEDE DA VINCHI" data-author="DAN BROWN" data-price="11.50" data-image="image/davinchi.jpg">ADD TO CART</button>

    </div>
    <div class="book1">
          <a href="defaultbook.php?type=static&id=fary">
            <img src="image/tale.jpg"class="img">
             <h3 class="product-title">FARYTALES</h3>
                <p class="product-author">H.TUMANYAN</p>
                <div class="product-price">8.00$</div>
        </a>
                        <button class="add-to-card" data-title="FARYTALES" data-author="H TUMANYAN" data-price="8.00" data-image="image/tale.jpg">ADD TO CART</button>

    </div>
     <div class="book1">
             <a href="defaultbook.php?type=static&id=me">
            <img src="image/me.jpg"class="img">
             <h3 class="product-title">ME BEFORE YOU</h3>
                <p class="product-author">JOJO MOYES</p>
                <div class="product-price"style="color:green;">10.00$</div>
        </a>
                        <button class="add-to-card" data-title="ME BEFORE YOU" data-author="JOJO MOYES" data-price="10.00" data-image="image/me.jpg">ADD TO CART</button>

    </div>
    <div class="book1">
       <a href="defaultbook.php">
            <img src="image/agata.jpg"class="img">
             <h3 class="product-title">DEATH IN CLOUDS</h3>
                <p class="product-author"> AGATA CHRISTI</p>
                <div class="product-price">10.50$</div>
        </a>
                        <button class="add-to-card" data-title="DEATH IN CLOUDS" data-author="AGATHA CHRISTI" data-price="10.50" data-image="image/agata.jpg">ADD TO CART</button>

    </div>
    <div class="book1">
        <a href="defaultbook.php">
            <img src="image/agata1.jpg"class="img">
             <h3 class="product-title">HAND WITH TOXIC PEN</h3>
                <p class="product-author">AGATA CHRISTI</p>
                <div class="product-price"style="color:green;">FREE</div>  
        </a> <button class="add-to-card" data-title="HAND WITH TOXIC PEN" data-author="AGATHA CHRISTI" data-price="0" data-image="image/agata1.jpg">ADD TO CART</button>
    </div>
        <div class="book1">
       <a href="defaultbook.php">
            <img src="image/azkaban.png"class="img">
             <h3 class="product-title">HARRY POTTER AND PRISONER OF AZKABAN</h3>
                <p class="product-author">JK ROWLING</p>
                <div class="product-price"style="color:green;">FREE AUDIOBOOK</div>
        </a>
                        <button class="add-to-card" data-title="HARRY POTTER-3" data-author="JK ROWLING" data-price="0" data-image="image/azkaban.jpg">ADD TO CART</button>

    </div>
       <div class="book1">
         <a href="defaultbook.php">
            <img src="image/blood-prince.png"class="img">
             <h3 class="product-title">HARRY POTTER AND HALF-BLOOD PRINCE</h3>
                <p class="product-author">JK ROWLING</p>
                <div class="product-price"style="color:green;">FREE AUDIOBOOK</div>
        </a>
                        <button class="add-to-card" data-title="HARRY POTTER-6" data-author="JK ROWLING" data-price="0" data-image="image/blood-prince.jpg">ADD TO CART</button>

    </div>
            
</div>
 <div style="text-align: center; margin-top: 30px;">
            <button id="clearCart" style="padding: 10px 20px; background: #fbf8f9ff; color: white; border: none; border-radius: 5px; cursor: pointer;">
                Clear Cart
            </button>
        </div>
    </div>
    </main>
    <?php include 'include/footer.php' ?>

<script>
   alert("YOU'RE SUCCESSFULLY SIGNED🎉");
    class CartSystem {
        constructor() {
            this.cart = JSON.parse(localStorage.getItem('audiobookCart')) || {};
            this.init();
        }
        
        init() {
            console.log('Cart System Initialized');
            
            const cartIcon = document.getElementById('cartIcon');
            if (cartIcon) {
                cartIcon.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    this.openCart();
                });
            }
            
            const cartIconMobile = document.getElementById('cartIconMobile');
            if (cartIconMobile) {
                cartIconMobile.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    this.openCart();
                });
            }
            
            const closeBtn = document.querySelector('.close-cart');
            if (closeBtn) {
                closeBtn.addEventListener('click', () => this.closeCart());
            }
            
            const overlay = document.getElementById('cartModalOverlay');
            if (overlay) {
                overlay.addEventListener('click', () => this.closeCart());
            }
            
            document.querySelectorAll('.add-to-card').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const item = {
                        title: e.target.dataset.title,
                        author: e.target.dataset.author,
                        price: parseFloat(e.target.dataset.price) || 0,
                        image: e.target.dataset.image || 'image/default-book.jpg',
                        id: Date.now() + Math.random()
                    };
                    
                    console.log('Adding item:', item);
                    this.addItem(item);
                    
                    const originalText = e.target.textContent;
                    const originalColor = e.target.style.backgroundColor;
                    e.target.textContent = '✓ ADDED!';
                    e.target.style.backgroundColor = '#1f4730';
                    e.target.style.color = 'white';
                    
                    setTimeout(() => {
                        e.target.textContent = originalText;
                        e.target.style.backgroundColor = originalColor;
                        e.target.style.color = '';
                    }, 1500);
                });
            });
            
           
            const clearBtn = document.getElementById('clearCart');
            if (clearBtn) {
                clearBtn.addEventListener('click', () => {
                    if (confirm('Are you sure you want to clear your cart?')) {
                        this.cart = {};
                        this.saveCart();
                        this.updateCartBadge();
                        this.renderCartItems();
                        alert('Cart cleared!');
                    }
                });
            }
            
           
            this.updateCartBadge();
            
    
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && document.getElementById('cartModal').classList.contains('active')) {
                    this.closeCart();
                }
            });
        }
        
        addItem(item) {
            if (!item.id) item.id = Date.now() + Math.random();
            
            if (this.cart[item.id]) {
                this.cart[item.id].quantity += 1;
            } else {
                this.cart[item.id] = {
                    ...item,
                    quantity: 1
                };
            }
            
            this.saveCart();
            this.updateCartBadge();
            this.showNotification(`Added "${item.title}" to cart`);
            
            if (document.getElementById('cartModal').classList.contains('active')) {
                this.renderCartItems();
            }
        }
        
        openCart() {
            console.log('Opening cart');
            document.getElementById('cartModal').classList.add('active');
            document.getElementById('cartModalOverlay').classList.add('active');
            document.body.style.overflow = 'hidden';
            this.renderCartItems();
        }
        
        closeCart() {
            document.getElementById('cartModal').classList.remove('active');
            document.getElementById('cartModalOverlay').classList.remove('active');
            document.body.style.overflow = '';
        }
        
        updateCartBadge() {
            const badges = [
                document.getElementById('cartBadge'),
                document.getElementById('cartBadgeMobile')
            ];
            
            const totalItems = Object.values(this.cart).reduce((sum, item) => sum + item.quantity, 0);
            
            badges.forEach(badge => {
                if (badge) {
                    if (totalItems > 0) {
                        badge.textContent = totalItems;
                        badge.style.display = 'flex';
                    } else {
                        badge.style.display = 'none';
                    }
                }
            });
        }
        
        calculateTotals() {
            let subtotal = 0;
            
            Object.values(this.cart).forEach(item => {
                subtotal += (item.price || 0) * item.quantity;
            });
            
            const tax = subtotal * 0.1;
            const total = subtotal + tax;
            
            return { 
                subtotal: subtotal.toFixed(2), 
                tax: tax.toFixed(2), 
                total: total.toFixed(2) 
            };
        }
        
        renderCartItems() {
            const container = document.getElementById('cartModalItems');
            const totals = this.calculateTotals();
            
            // Update totals
            document.getElementById('cartSubtotal').textContent = totals.subtotal;
            document.getElementById('cartTax').textContent = totals.tax;
            document.getElementById('cartTotal').textContent = totals.total;
            
            const items = Object.entries(this.cart);
            
            if (items.length === 0) {
                container.innerHTML = `
                    <div class="cart-modal-empty">
                        <i class="fas fa-shopping-cart"></i>
                        <h4>Your cart is empty</h4>
                        <p>Add some audiobooks to get started!</p>
                    </div>
                `;
                return;
            }
            
            let html = '';
            
            items.forEach(([id, item]) => {
                const itemTotal = ((item.price || 0) * item.quantity).toFixed(2);
                
                html += `
                    <div class="cart-modal-item">
                        <div class="cart-modal-item-image">
                            <img src="${item.image}" alt="${item.title}" onerror="this.src='image/default-book.jpg'">
                        </div>
                        <div class="cart-modal-item-details">
                            <div class="cart-modal-item-title">${item.title}</div>
                            <div class="cart-modal-item-author">${item.author}</div>
                            <div class="cart-modal-item-price">$${(item.price || 0).toFixed(2)}</div>
                            <div class="cart-modal-item-actions">
                                <div class="quantity-control">
                                    <button class="quantity-btn minus" data-id="${id}">-</button>
                                    <input type="number" class="quantity-input" value="${item.quantity}" min="1" data-id="${id}">
                                    <button class="quantity-btn plus" data-id="${id}">+</button>
                                </div>
                                <button class="remove-btn" data-id="${id}">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            container.innerHTML = html;
            
            this.addCartItemListeners();
        }
        
        addCartItemListeners() {
            document.querySelectorAll('.quantity-btn.minus').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const id = e.target.dataset.id;
                    this.updateQuantity(id, -1);
                });
            });
            
            document.querySelectorAll('.quantity-btn.plus').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const id = e.target.dataset.id;
                    this.updateQuantity(id, 1);
                });
            });
            
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', (e) => {
                    const id = e.target.dataset.id;
                    const newQuantity = parseInt(e.target.value);
                    
                    if (newQuantity >= 1) {
                        this.cart[id].quantity = newQuantity;
                        this.saveCart();
                        this.renderCartItems();
                        this.updateCartBadge();
                    }
                });
            });
            
            document.querySelectorAll('.remove-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const id = e.target.dataset.id;
                    if (confirm('Remove this item from cart?')) {
                        delete this.cart[id];
                        this.saveCart();
                        this.renderCartItems();
                        this.updateCartBadge();
                    }
                });
            });
            
            const checkoutBtn = document.querySelector('.btn-checkout');
            if (checkoutBtn) {
                checkoutBtn.addEventListener('click', () => {
                    if (Object.keys(this.cart).length === 0) {
                        alert('Your cart is empty!');
                        return;
                    }
                    
                    const total = this.calculateTotals().total;
                    alert(`Thank you for your purchase!\nTotal: $${total}`);
                    this.cart = {};
                    this.saveCart();
                    this.updateCartBadge();
                    this.renderCartItems();
                    this.closeCart();
                });
            }
        }
        
        updateQuantity(id, change) {
            if (!this.cart[id]) return;
            
            this.cart[id].quantity += change;
            
            if (this.cart[id].quantity < 1) {
                delete this.cart[id];
            }
            
            this.saveCart();
            this.renderCartItems();
            this.updateCartBadge();
        }
        
        saveCart() {
            localStorage.setItem('audiobookCart', JSON.stringify(this.cart));
        }
        
        showNotification(message) {
            const existing = document.querySelector('.notification');
            if (existing) existing.remove();
            
            const notification = document.createElement('div');
            notification.className = 'notification';
            notification.innerHTML = `
                <i class="fas fa-check-circle"></i>
                <span>${message}</span>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.style.animation = 'slideOut 0.3s ease';
                    setTimeout(() => {
                        if (notification.parentNode) {
                            notification.parentNode.removeChild(notification);
                        }
                    }, 300);
                }
            }, 3000);
        }
    }
    
    document.addEventListener('DOMContentLoaded', () => {
        window.cartSystem = new CartSystem();
    });

    /* // Simple Cart System
        class CartSystem {
            constructor() {
                this.cart = JSON.parse(localStorage.getItem('audiobookCart')) || {};
                this.init();
            }
            
            init() {
                // Cart icon click
                document.getElementById('cartIcon').addEventListener('click', () => this.openCart());
                
                // Close cart
                document.querySelector('.close-cart').addEventListener('click', () => this.closeCart());
                document.getElementById('cartModalOverlay').addEventListener('click', () => this.closeCart());
                
                // Add to cart buttons
                document.querySelectorAll('.add-to-cart').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const item = {
                            title: e.target.dataset.title,
                            author: e.target.dataset.author,
                            price: parseFloat(e.target.dataset.price),
                            image: e.target.dataset.image,
                            id: Date.now() + Math.random()
                        };
                        this.addItem(item);
                        
                        // Visual feedback
                        const originalText = e.target.textContent;
                        e.target.textContent = '✓ ADDED!';
                        e.target.style.background = '#1f4730';
                        
                        setTimeout(() => {
                            e.target.textContent = originalText;
                            e.target.style.background = '';
                        }, 1500);
                    });
                });
                
                // Clear cart button
                document.getElementById('clearCart').addEventListener('click', () => {
                    this.cart = {};
                    this.saveCart();
                    this.updateCartBadge();
                    this.renderCartItems();
                });
                
                // Update initial badge
                this.updateCartBadge();
            }
            
            addItem(item) {
                if (!item.id) item.id = Date.now() + Math.random();
                
                if (this.cart[item.id]) {
                    this.cart[item.id].quantity += 1;
                } else {
                    this.cart[item.id] = {
                        ...item,
                        quantity: 1
                    };
                }
                
                this.saveCart();
                this.updateCartBadge();
                this.showNotification(`Added "${item.title}" to cart`);
            }
            
            openCart() {
                document.getElementById('cartModal').classList.add('active');
                document.getElementById('cartModalOverlay').classList.add('active');
                document.body.style.overflow = 'hidden';
                this.renderCartItems();
            }
            
            closeCart() {
                document.getElementById('cartModal').classList.remove('active');
                document.getElementById('cartModalOverlay').classList.remove('active');
                document.body.style.overflow = '';
            }
            
            updateCartBadge() {
                const badge = document.getElementById('cartBadge');
                const totalItems = Object.values(this.cart).reduce((sum, item) => sum + item.quantity, 0);
                
                if (totalItems > 0) {
                    badge.textContent = totalItems;
                    badge.style.display = 'flex';
                } else {
                    badge.style.display = 'none';
                }
            }
            
            calculateTotals() {
                let subtotal = 0;
                
                Object.values(this.cart).forEach(item => {
                    subtotal += item.price * item.quantity;
                });
                
                const tax = subtotal * 0.1;
                const total = subtotal + tax;
                
                return { subtotal, tax, total };
            }
            
            renderCartItems() {
                const container = document.getElementById('cartModalItems');
                const totals = this.calculateTotals();
                
                // Update totals
                document.getElementById('cartSubtotal').textContent = totals.subtotal.toFixed(2);
                document.getElementById('cartTax').textContent = totals.tax.toFixed(2);
                document.getElementById('cartTotal').textContent = totals.total.toFixed(2);
                
                const items = Object.entries(this.cart);
                
                if (items.length === 0) {
                    container.innerHTML = `
                        <div class="cart-modal-empty">
                            <i class="fas fa-shopping-cart"></i>
                            <h4>Your cart is empty</h4>
                            <p>Add some audiobooks to get started!</p>
                        </div>
                    `;
                    return;
                }
                
                let html = '';
                
                items.forEach(([id, item]) => {
                    const itemTotal = (item.price * item.quantity).toFixed(2);
                    
                    html += `
                        <div class="cart-modal-item">
                            <div class="cart-modal-item-image">
                                <img src="${item.image}" alt="${item.title}">
                            </div>
                            <div class="cart-modal-item-details">
                                <div class="cart-modal-item-title">${item.title}</div>
                                <div class="cart-modal-item-author">${item.author}</div>
                                <div class="cart-modal-item-price">$${item.price.toFixed(2)}</div>
                                <div class="cart-modal-item-actions">
                                    <div class="quantity-control">
                                        <button class="quantity-btn minus" data-id="${id}">-</button>
                                        <input type="number" class="quantity-input" value="${item.quantity}" min="1" data-id="${id}">
                                        <button class="quantity-btn plus" data-id="${id}">+</button>
                                    </div>
                                    <button class="remove-btn" data-id="${id}">
                                        <i class="fas fa-trash"></i> Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                });
                
                container.innerHTML = html;
                
                // Add event listeners to new elements
                this.addCartItemListeners();
            }
            
            addCartItemListeners() {
                // Quantity buttons
                document.querySelectorAll('.quantity-btn.minus').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const id = e.target.dataset.id;
                        this.updateQuantity(id, -1);
                    });
                });
                
                document.querySelectorAll('.quantity-btn.plus').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const id = e.target.dataset.id;
                        this.updateQuantity(id, 1);
                    });
                });
                
                // Quantity inputs
                document.querySelectorAll('.quantity-input').forEach(input => {
                    input.addEventListener('change', (e) => {
                        const id = e.target.dataset.id;
                        const newQuantity = parseInt(e.target.value);
                        
                        if (newQuantity >= 1) {
                            this.cart[id].quantity = newQuantity;
                            this.saveCart();
                            this.renderCartItems();
                            this.updateCartBadge();
                        }
                    });
                });
                
                // Remove buttons
                document.querySelectorAll('.remove-btn').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const id = e.target.dataset.id;
                        delete this.cart[id];
                        this.saveCart();
                        this.renderCartItems();
                        this.updateCartBadge();
                    });
                });
                
                // Checkout button
                document.querySelector('.btn-checkout').addEventListener('click', () => {
                    if (Object.keys(this.cart).length === 0) {
                        alert('Your cart is empty!');
                        return;
                    }
                    
                    alert(`Thank you for your purchase! Total: $${this.calculateTotals().total.toFixed(2)}`);
                    this.cart = {};
                    this.saveCart();
                    this.updateCartBadge();
                    this.renderCartItems();
                    this.closeCart();
                });
            }
            
            updateQuantity(id, change) {
                if (!this.cart[id]) return;
                
                this.cart[id].quantity += change;
                
                if (this.cart[id].quantity < 1) {
                    delete this.cart[id];
                }
                
                this.saveCart();
                this.renderCartItems();
                this.updateCartBadge();
            }
            
            saveCart() {
                localStorage.setItem('audiobookCart', JSON.stringify(this.cart));
            }
            
            showNotification(message) {
                // Remove existing notification
                const existing = document.querySelector('.notification');
                if (existing) existing.remove();
                
                // Create new notification
                const notification = document.createElement('div');
                notification.className = 'notification';
                notification.innerHTML = `
                    <i class="fas fa-check-circle"></i>
                    <span>${message}</span>
                `;
                
                document.body.appendChild(notification);
                
                // Remove after 3 seconds
                setTimeout(() => {
                    notification.style.animation = 'slideOut 0.3s ease';
                    setTimeout(() => {
                        if (notification.parentNode) {
                            notification.parentNode.removeChild(notification);
                        }
                    }, 300);
                }, 3000);
            }
        }
        
        // Initialize cart when page loads
        document.addEventListener('DOMContentLoaded', () => {
            window.cartSystem = new CartSystem();
        });*/
</script>
    <script src="script.js"></script>

</body>
</html>