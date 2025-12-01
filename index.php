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
                
               <div style="display: flex; gap: 10px; align-items: center; padding-bottom: 0;"> <i class="fa-solid fa-retweet"></i><a href="" class="header-link">Refer & Earn</a> </div>
             <div style="display: flex; gap: 10px; align-items: center; padding-bottom: 0;"> <i class="fa-regular fa-address-card"></i><a href="#" class="header-link">About</a></div>
                <div  style="display: flex; gap: 10px; align-items: center; padding-bottom: 0;"> <i class="fa-regular fa-circle-question"></i> <a href="#" class="header-link">Support</a></div>
                    
                    
                   
            
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
                    <div class="account-menu">
                   <div class="user-icon"> <a href="#" class="icon-link">
                        <i class="fa-regular fa-user"></i>   </a></div>
                        <div class="account-dropdown">
                <h3 class="dropdown-title">Account</h3>
                <button class="btn btn-primary">SIGN IN</button>
                <button class="btn btn-secondary">CREATE ACCOUNT</button>
            </div></div>
                    <!-- Search Icon -->
                    <a href="#" class="icon-link">
                       <i class="fa-solid fa-magnifying-glass"></i>
                    </a>
                    <!-- Button -->
                    <a href="#" class="cta-button">
                        LISTEN NOW
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
        <div id="h1"><h1>LISTEN  EVERYTIME, EVERYWHERE</h1></div><div class="logo1"><img  id="d1"src="image/logo.png"></div></div>
        <div class="placeholder-content" id="carousel">
                   <button class="nav-arrow prev-arrow"> &lt; </button>
            <div class="cards">
                <div class="carddiv"id="c0"></div>
           <div  class="carddiv"id="c7">  <a href="" class="linkcard"><img src="image/audio.png"> <p class="cardtext">AUDIOBOOKS</p></a></div>
           <div class="carddiv" id="c1"> <a href="" class="linkcard"> <img src="image/romance1.png"> <p class="cardtext">ROMANCE</p></a></div>
           <div class="carddiv"id="c2"> <a href="" class="linkcard"> <img src="image/history2.png">  <p class="cardtext">HISTORY</p></a> </div> 
           <div class="carddiv"id="c3"> <a href="" class="linkcard"> <img src="image/fantasy2.png">  <p class="cardtext">FANTASY</p></a> </div>
           <div class="carddiv"id="c4"> <a href=""class="linkcard" > <img src="image/detective.png"> <p class="cardtext">DETECTIVE</p></a></div>
           <div class="carddiv"id="c5"> <a href="" class="linkcard"> <img src="image/comedy.png"><p class="cardtext">COMEDY</p></a> </div>
           <div class="carddiv"id="c6"> <a href="" class="linkcard"> <img src="image/children1.png"><p class="cardtext">FOR CHILDREN</p></a> </div> 
        </div> <button class="nav-arrow next-arrow"> &gt; </button>
         <div class="button"> <button class="shop-button">SHOP</button></div>
    </div>
        

      <div>
    <div></div>
    <div></div>
    <div></div>
</div>
    </main>


    <script src="script.js"></script>

</body>
</html>