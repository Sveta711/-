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

   <?php include 'include/header.php' ?>

    <main class="page-content">
         <div id="w1">
        <div id="h1"><h1 class="z">LISTEN  EVERYTIME, EVERYWHERE</h1></div><div class="logo1"><img  id="d1"src="image/logo.png"></div></div>
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
    <div claa="b1"><p class="b11">bye</p></div>
    
        

      <div class="books">
    <div class=book1>
        <a href="">
            <img src="image/pride.jpg" class="img">
            <h3 class="product-title">PRIDE AND PREJUDICE</h3>
                <p class="product-author">JANE AUSTIN</p>
                <div class="product-price">FREE</div>
                <button class="cta-button">ADD TO CART</button>
          <!--  <p class="booktext">PRIDE AND PREJUDICE</p>-->
        </a>
    </div>
    <div class="book1">
     <a href="">
            <img src="image/harry.jpg"class="img">
             <h3 class="product-title">HARRY POTTER AND THE PHILISOPHER STONE</h3>
                <p class="product-author">JK ROWLING</p>
                <div class="product-price"style="color:green;">FREE AUDIOBOOK</div>
                <button class="cta-button">ADD TO CART</button>
        </a></div>
    <div class="book1">
        <a href="">
            <img src="image/davinchi.jpg"class="img">
             <h3 class="product-title">CODE DA VINCHI</h3>
                <p class="product-author"> DAN BROWN</p>
                <div class="product-price">11.50$</div>
                <button class="cta-button">ADD TO CART</button>
          <!--  <p class="booktext">DAVINCHI'S CODE</p>-->
        </a>
    </div>
    <div class="book1">
         <a href="">
            <img src="image/tale.jpg"class="img">
             <h3 class="product-title">FARYTALES</h3>
                <p class="product-author">H.TUMANYAN</p>
                <div class="product-price">8.00$</div>
                <button class="cta-button">ADD TO CART</button>
        </a>
    </div>
     <div class="book1">
     <a href="">
            <img src="image/me.jpg"class="img">
             <h3 class="product-title">ME BEFORE YOU</h3>
                <p class="product-author">JOJO MOYES</p>
                <div class="product-price"style="color:green;">10.00$</div>
                <button class="cta-button">ADD TO CART</button>
        </a></div>
    <div class="book1">
         <a href="">
            <img src="image/agata.jpg"class="img">
             <h3 class="product-title">DEATH IN CLOUDS</h3>
                <p class="product-author"> AGATA CHRISTI</p>
                <div class="product-price">10.50$</div>
                <button class="cta-button">ADD TO CART</button>
        </a>
    </div>
    <div class="book1">
     <a href="">
            <img src="image/agata1.jpg"class="img">
             <h3 class="product-title">HAND WITH TOXIC PEN</h3>
                <p class="product-author">AGATA CHRISTI</p>
                <div class="product-price"style="color:green;">FREE</div>
                <button class="cta-button">ADD TO CART</button>
        </a></div>
        <div class="book1">
     <a href="">
            <img src="image/azkaban.png"class="img">
             <h3 class="product-title">HARRY POTTER AND PRISONER OF AZKABAN</h3>
                <p class="product-author">JK ROWLING</p>
                <div class="product-price"style="color:green;">FREE AUDIOBOOK</div>
                <button class="cta-button">ADD TO CART</button>
        </a></div>
       <div class="book1">
     <a href="">
            <img src="image/blood-prince.png"class="img">
             <h3 class="product-title">HARRY POTTER AND HALF-BLOOD PRINCE</h3>
                <p class="product-author">JK ROWLING</p>
                <div class="product-price"style="color:green;">FREE AUDIOBOOK</div>
                <button class="cta-button">ADD TO CART</button>
        </a></div>
       
        
</div>
    </main>
    <?php include 'include/footer.php' ?>


    <script src="script.js"></script>

</body>
</html>