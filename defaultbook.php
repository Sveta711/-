<?php
require_once 'config.php';
require_once 'BookRepository.php';

$connection = Database::getInstance();
$bookRepository = new BookRepository($connection);

$bookType = $_GET['type'] ?? 'dynamic'; // 'dynamic' կամ 'static'
$bookId = $_GET['id'] ?? null;

$book = null;

if ($bookType === 'dynamic' && $bookId) {
    $book = $bookRepository->getById($bookId);
} elseif ($bookType === 'static') {
    $staticBooks = [
        'pride' => [
            'title' => 'PRIDE AND PREJUDICE',
            'author' => 'JANE AUSTIN',
            'price' => 0,
            'image' => 'image/pride.jpg',
            'description' => 'A classic romantic novel of manners...'
        ],
        'harry1' => [
            'title' => 'HARRY POTTER AND THE PHILOSOPHER STONE',
            'author' => 'JK ROWLING',
            'price' => 0,
            'image' => 'image/harry.jpg',
            'description' => 'The first book in the Harry Potter series...'
        ],
        'davinchi' => [
            'title' => 'THE DA VINCI CODE',
            'author' => 'DAN BROWN',
            'price' => 11.50,
            'image' => 'image/davinchi.jpg',
            'description' => 'A mystery thriller novel...'
        ],
        'fary'=>[
            'title' => 'FARYTALES',
            'author' => 'H TUMANYAN',
            'price' => 8.00,
            'image' => 'image/tale.jpg',
            'description' => 'For children and for adults...'
        ],
        'me'=> [
          'title' => 'ME BEFORE YOU',
            'author' => 'JOJO MOYES',
            'price' => 10.00,
            'image' => 'image/me.jpg',
            'description' => 'A romance  for breaking your heart...'
        ],
    ];
    
    $book = $staticBooks[$bookId] ?? null;
}

if (!$book) {
    header("Location: welcome.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($book['title']); ?> - Audiobook</title>
    <link rel="stylesheet" href="style.css">
    <style>
        main{
           padding: auto;

        }
        .book-details-container {
            display: flex;
            width: 1200px;
            margin: 40px auto;
            padding: 150px;
            gap: 40px;
            flex-wrap: wrap;
        }
        .book-image {
            flex: 1;
            min-width: 300px;
            text-align: center;
        }
        .book-image img {
            max-width: 100%;
            max-height: 500px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }
        .book-info {
            flex: 2;
            min-width: 300px;
        }
        .book-title {
            font-size: 2.2rem;
            margin-bottom: 10px;
            color: #354a40;
            font-family: 'Playfair Display', serif;
        }
        .book-author {
            font-size: 1.3rem;
            color: #666;
            margin-bottom: 20px;
            font-style: italic;
        }
        .book-price {
            font-size: 1.8rem;
            color: #d4a574;
            font-weight: bold;
            margin-bottom: 25px;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .book-description {
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 30px;
            color: #444;
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
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }
        .btn {
            padding: 12px 25px;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            font-size: 1rem;
        }
        .btn-cart {
            background: #d4a574;
            color: white;
        }
        .btn-cart:hover{
            transform:scale(1.05);
        }
        .btn-listen {
            background: #354a40;
            color: white;
        }
        .btn-listen:hover{
                        transform:scale(1.05);

        }
        
        @media (max-width: 768px) {
            .book-details-container {
                flex-direction: column;
                margin: 20px auto;
             padding:170px;
                gap: 20px;
            }
            .book-title {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <?php include 'include/header.php'; ?>
    
    <main class="page-content">
        <div class="book-details-container">
            <div class="book-image">
                <img src="<?php echo htmlspecialchars($book['image']); ?>" 
                     alt="<?php echo htmlspecialchars($book['title']); ?>"
                     onerror="this.src='image/default-book.jpg'">
            </div>
            
            <div class="book-info">
                <h1 class="book-title"><?php echo htmlspecialchars($book['title']); ?></h1>
                <h2 class="book-author"><?php echo htmlspecialchars($book['author']); ?></h2>
                
                <div class="book-price">
                    <?php 
                    if ($book['price'] == 0) {
                        echo '<span style="color:green;">FREE AUDIOBOOK</span>';
                    } else {
                        echo number_format($book['price'], 2) . '$';
                    }
                    ?>
                </div>
                
                <div class="book-description">
                    <?php 
                    if (isset($book['description'])) {
                        echo htmlspecialchars($book['description']);
                    } else {
                        echo 'Enjoy this amazing audiobook. Listen anytime, anywhere with our premium audio quality.';
                    }
                    ?>
                </div>
                
                <div class="action-buttons">
                    <button class="btn btn-cart add-to-cart-btn"
                            data-title="<?php echo htmlspecialchars($book['title']); ?>"
                            data-author="<?php echo htmlspecialchars($book['author']); ?>"
                            data-price="<?php echo $book['price']; ?>"
                            data-image="<?php echo htmlspecialchars($book['image']); ?>">
                        <i class="fas fa-cart-plus"></i> ADD TO CART
                    </button>
                    <button class="btn btn-listen">
                        <i class="fas fa-headphones"></i> LISTEN NOW
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
        </div>
    </main>
    
    <?php include 'include/footer.php'; ?>
    
    <script>
        document.querySelector('.add-to-cart-btn').addEventListener('click', function() {
            const item = {
                title: this.dataset.title,
                author: this.dataset.author,
                price: parseFloat(this.dataset.price),
                image: this.dataset.image
            };
            
            if (window.cartSystem) {
                window.cartSystem.addItem(item);
                
                const originalText = this.innerHTML;
                this.innerHTML = '<i class="fas fa-check"></i> ADDED!';
                this.style.background = '#1f4730';
                
                setTimeout(() => {
                    this.innerHTML = originalText;
                    this.style.background = '';
                }, 1500);
            } else {
                alert('Added to cart!');
            }
        });
    </script>
</body>
</html>
