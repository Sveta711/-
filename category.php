<?php

$all_books = [
    [
        'title' => 'PRIDE AND PREJUDICE',
        'author' => 'JANE AUSTEN',
        'price' => 'FREE',
        'image' => 'image/pride.jpg',
        'genre' => 'romance',
        'id'=> '1'
    ],
    [
        'title' => 'CODE DA VINCI',
        'author' => 'DAN BROWN',
        'price' => '11.50$',
        'image' => 'image/davinchi.jpg',
        'genre' => 'history',
      'id'=> '2'
    ],
     [
        'title' => 'FARYTALES',
        'author' => 'H TUMANYAN',
        'price' => '8.00$',
        'image' => 'image/tale.jpg',
        'genre' => 'children',
          'id'=> '3'

    ],
     [
        'title' => 'ME BEFORE YOU',
        'author' => 'JOJO MOYES',
        'price' => '10.00$',
        'image' => 'image/me.jpg',
        'genre' => 'romance',
       'id'=> '4'

    ],
     [
        'title' => 'DEATH IN CLOUDS',
        'author' => 'AGATA CHRISTI',
        'price' => '10.50$',
        'image' => 'image/agata.jpg',
        'genre' => 'detective',
                'id'=> '5'

    ],
     [
        'title' => 'HAND WITH TOXIC PEN',
        'author' => 'AGATA CHRISTI',
        'price' => 'FREE',
        'image' => 'image/agata1.jpg',
        'genre' => 'detective',
             'id'=> '6'

    ],
     [
        'title' => 'HARRY POTTER AND PRISONER OF AZKABAN',
        'author' => 'JK ROWLING',
        'price' => 'FREE',
        'image' => 'image/azkaban.png',
        'genre' => 'fantasy',
                'id'=> '7'

    ], [
        'title' => 'HARRY POTTER AND HALF-BLOOD PRINCE',
        'author' => 'JK ROWLING',
        'price' => 'FREE',
        'image' => 'image/blood-prince.png',
        'genre' => 'fantasy',
         'id'=> '8'

    ],
    [
        'title' => 'HARRY POTTER AND THE PHILISOPHER STONE',
        'author' => 'JK ROWLING',
        'price' => 'FREE',
        'image' => 'image/harry.jpg',
        'genre' => 'fantasy',
           'id'=> '9'

    ]
];

$selected_genre = $_GET['genre'] ?? '';

$filtered_books = array_filter($all_books, function($book) use ($selected_genre) {
    return $book['genre'] === $selected_genre;
});
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo strtoupper($selected_genre); ?> Books</title>
    <link rel="stylesheet" href="style.css">
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
              
                
                <!-- Center: Logo -->
                <div class="header-logo">
                    <a href="#">AUDIORIA</a>
                </div>
                
                <!-- Right Side: Links & Icons -->
                <div class="header-right">
                    
                    <!-- User Icon -->
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
                   
                    <!-- Cart Icon -->
                    <a href="#" class="icon-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                        </svg>
                    </a>
                </div>
            </nav>
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
        </div></header>

    <div class="container">
        <h1>Genre: <?php echo ucfirst($selected_genre); ?></h1>
        
        <div class="books" style="margin-top:100px;">
            <?php if (count($filtered_books) > 0): ?>
                <?php foreach ($filtered_books as $book): ?>
                    <div class="book1">
                        <a href="book-details.php?book=<?php echo urlencode($book['title']); ?>">
                            <img src="<?php echo $book['image']; ?>" class="img">
                            <h3 class="product-title"><?php echo $book['title']; ?></h3>
                            <p class="product-author"><?php echo $book['author']; ?></p>
                            <div class="product-price"><?php echo $book['price']; ?></div>
                        </a>
                        <button class="add-to-card" 
                                data-title="<?php echo $book['title']; ?>" 
                                data-price="<?php echo str_replace('$', '', $book['price']); ?>" 
                                data-image="<?php echo $book['image']; ?>">
                            ADD TO CART
                        </button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No books found in this genre.</p>
            <?php endif; ?>
        </div>
    </div>
   
</body>
</html>