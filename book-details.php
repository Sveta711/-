<?php
require_once 'config.php';
require_once 'BookRepository.php';

$connection = Database::getInstance();
$bookRepository = new BookRepository($connection);


$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$book = $bookRepository->getById($id);

if (!$book) {
    die("Book not found!");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $book['title']; ?> - Details</title>
    <link rel="stylesheet" href="style.css">
    <style>
       main{
           padding: auto;

        }
        .product-container {
            display: flex;
            width: 1200px;
            margin: 40px auto;
            padding: 150px;
            gap: 40px;
            flex-wrap: wrap;
        }
        .product-left {
            flex: 1;
            min-width: 300px;
            text-align: center;
        }
        .product-left img {
            max-width: 100%;
            max-height: 500px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }
        
        .product-title {
            font-size: 2.2rem;
            margin-bottom: 10px;
            color: #354a40;
            font-family: 'Playfair Display', serif;
        }
        .product-author {
            font-size: 1.3rem;
            color: #666;
            margin-bottom: 20px;
            font-style: italic;
        }
        .product-price {
            font-size: 1.8rem;
            color: #d4a574;
            font-weight: bold;
            margin-bottom: 25px;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .product-desc {
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 30px;
            color: #444;
        }
        .product-right {
            padding: 12px 25px;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            font-size: 1rem;
        }
        .book-meta {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .meta-item {
            margin-bottom: 10px;
            font-size: 1rem;
            color: #555;
        }
        .buy-btn {
            padding: 10px 40px;
           background: #354a40;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 18px;
            border-radius: 5px;
        }
         .back-button {
            display: inline-block;
            padding: 12px 25px;
            background: #354a40;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            font-weight: 600;
            transition: background 0.3s;
        }
        .back-button:hover {
            background: #2a3b33;
        }
    </style>
</head>
<body>
    <?php include 'include/header.php';  ?>

    <div class="product-container">
        <div class="product-left">
            <img src="<?php echo $book['cover_url']; ?>" alt="<?php echo $book['title']; ?>">
        </div>
        <div class="product-right">
            <h1 class="product-title"><?php echo $book['title']; ?></h1>
            <p class="product-author">By <?php echo $book['author']; ?></p>
            <div class="product-price">$<?php echo number_format($book['price'], 2); ?></div>
            <p class="product-desc"><?php echo $book['description']; ?></p>
            
            <button class="buy-btn add-to-card" 
                    data-title="<?php echo $book['title']; ?>" 
                    data-price="<?php echo $book['price']; ?>" 
                    data-image="<?php echo $book['cover_url']; ?>">
                ADD TO CART
            </button>
        </div>
         <div class="book-meta">
                    <div class="meta-item"><strong>Format:</strong> Audiobook</div>
                    <div class="meta-item"><strong>Duration:</strong> 8 hours 30 minutes</div>
                    <div class="meta-item"><strong>Language:</strong> English</div>
                    <div class="meta-item"><strong>Narrator:</strong> Professional Voice Actor</div>
                </div>
                
                <a href="welcome.php" class="back-button">
                    <i class="fas fa-arrow-left"></i> BACK TO CATALOG
                </a>
    </div>
    <?php include "include/footer.php"?>
</body>
</html>