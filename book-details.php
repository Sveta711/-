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
        body{
            padding-top:100px;
        }
        .product-container {
            display: flex;
            gap: 50px;
            max-width: 1000px;
            margin: 150px auto;
            padding: 20px;
            background: #fff;
        }
        .product-left { flex: 1; }
        .product-left img { width: 100%; border-radius: 8px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .product-right { flex: 1.5; }
        .product-title { font-size: 32px; margin-bottom: 10px; }
        .product-author { font-size: 20px; color: #555; margin-bottom: 20px; }
        .product-desc { line-height: 1.6; color: #666; margin-bottom: 30px; }
        .product-price { font-size: 24px; font-weight: bold; color: #e67e22; margin-bottom: 20px; }
        .buy-btn {
            padding: 15px 30px;
            background: #27ae60;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 18px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php include 'include/header.php'; // Եթե ունես առանձնացրած header ?>

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
    </div>
    <?php include "include/footer.php"?>
</body>
</html>