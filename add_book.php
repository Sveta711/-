<?php
require_once 'config.php';
require_once 'Book.php';
require_once 'BookRepository.php';
require_once 'BookController.php';


$connection = Database::getInstance();
$bookRepository = new BookRepository($connection);
$bookController = new BookController($bookRepository);


$result = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $bookController->handleAddBook($_POST);
}

// Ստանալ բոլոր գրքերը ցուցադրման համար
$allBooks = $bookController->getAllBooks();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book - BookBranch</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }
        
        body {
            background: #f8f5f2;
            color: #333;
            padding: 20px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid #e0d9d1;
            margin-bottom: 40px;
        }
        
        .logo {
            font-size: 28px;
            font-weight: 700;
            color: #2a5c3d;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo i {
            color: #d4a574;
        }
        
        .nav-links a {
            margin-left: 25px;
            text-decoration: none;
            color: #555;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .nav-links a:hover {
            color: #2a5c3d;
        }
        
        .page-title {
            font-size: 32px;
            margin-bottom: 10px;
            color: #222;
            font-weight: 600;
        }
        
        .page-subtitle {
            color: #666;
            margin-bottom: 40px;
            font-size: 18px;
        }
        
        .form-container {
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            border: 1px solid #eae5df;
            margin-bottom: 40px;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group.full-width {
            grid-column: 1 / -1;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #444;
            font-size: 15px;
        }
        
        .input-wrapper {
            position: relative;
        }
        
        input, select, textarea {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
            background-color: #fcfbf9;
        }
        
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #d4a574;
            box-shadow: 0 0 0 3px rgba(212, 165, 116, 0.2);
            background-color: white;
        }
        
        .input-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }
        
        textarea {
            min-height: 120px;
            resize: vertical;
            font-family: inherit;
        }
        
        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #eee;
        }
        
        .btn {
            padding: 14px 32px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-primary {
            background-color: #2a5c3d;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #1f4730;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(42, 92, 61, 0.2);
        }
        
        .btn-secondary {
            background-color: #f1eeea;
            color: #555;
        }
        
        .btn-secondary:hover {
            background-color: #e5e0da;
        }
        
        .message {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        
        .message.success {
            background-color: #f0f9f0;
            border: 1px solid #c3e6c3;
            color: #2a5c3d;
        }
        
        .message.error {
            background-color: #fdf0f0;
            border: 1px solid #f5c6cb;
            color: #d44;
        }
        
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 40px;
        }
        
        .book-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border: 1px solid #eae5df;
            transition: transform 0.3s;
        }
        
        .book-card:hover {
            transform: translateY(-5px);
        }
        
        .book-cover {
            height: 200px;
            background: linear-gradient(135deg, #e9dfd1, #d4c5b0);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #7a6a52;
        }
        
        .book-info {
            padding: 20px;
        }
        
        .book-title {
            font-size: 20px;
            margin-bottom: 8px;
            color: #222;
        }
        
        .book-author {
            color: #666;
            margin-bottom: 12px;
            font-size: 16px;
        }
        
        .book-description {
            color: #555;
            line-height: 1.5;
            margin-bottom: 15px;
            font-size: 14px;
        }
        
        .book-meta {
            display: flex;
            justify-content: space-between;
            color: #777;
            font-size: 14px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        
        .required::after {
            content: " *";
            color: #d44;
        }
        
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .books-grid {
                grid-template-columns: 1fr;
            }
            
            .nav-links {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <a href="#" class="logo">
                <i class="fas fa-book-open"></i>
                AUDIORIA
            </a>
            
        </header>
        
        <main>
            <h1 class="page-title">Add New Book</h1>
            <p class="page-subtitle">Fill in the book details below</p>
            
            <?php if ($result): ?>
                <div class="message <?php echo $result['success'] ? 'success' : 'error'; ?>">
                    <i class="fas <?php echo $result['success'] ? 'fa-check-circle' : 'fa-exclamation-circle'; ?>"></i> 
                    <?php echo $result['message']; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="" class="form-container">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="title" class="required">Book Title</label>
                        <div class="input-wrapper">
                            <input type="text" id="title" name="title" required
                                   value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>"
                                   placeholder="e.g., The Great Gatsby">
                            <i class="fas fa-book input-icon"></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="author" class="required">Author</label>
                        <div class="input-wrapper">
                            <input type="text" id="author" name="author" required
                                   value="<?php echo isset($_POST['author']) ? htmlspecialchars($_POST['author']) : ''; ?>"
                                   placeholder="e.g., F. Scott Fitzgerald">
                            <i class="fas fa-user-pen input-icon"></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="genre" class="required">Genre</label>
                        <div class="input-wrapper">
                            <select id="genre" name="genre" required>
                                <option value="" disabled <?php echo !isset($_POST['genre']) ? 'selected' : ''; ?>>Select genre</option>
                                <option value="Audiobook" <?php echo (isset($_POST['genre']) && $_POST['genre'] == 'Fiction') ? 'selected' : ''; ?>>Fiction</option>
                                <option value="Romance" <?php echo (isset($_POST['genre']) && $_POST['genre'] == 'Non-Fiction') ? 'selected' : ''; ?>>Non-Fiction</option>
                                <option value="Comedy" <?php echo (isset($_POST['genre']) && $_POST['genre'] == 'Science Fiction') ? 'selected' : ''; ?>>Science Fiction</option>
                                <option value="Fantasy" <?php echo (isset($_POST['genre']) && $_POST['genre'] == 'Fantasy') ? 'selected' : ''; ?>>Fantasy</option>
                                <option value="Detective" <?php echo (isset($_POST['genre']) && $_POST['genre'] == 'Mystery') ? 'selected' : ''; ?>>Mystery</option>
                                <option value="History" <?php echo (isset($_POST['genre']) && $_POST['genre'] == 'Biography') ? 'selected' : ''; ?>>Biography</option>
                            </select>
                            <i class="fas fa-tag input-icon"></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="year">Publication Year</label>
                        <div class="input-wrapper">
                            <input type="number" id="year" name="year"
                                   value="<?php echo isset($_POST['year']) ? htmlspecialchars($_POST['year']) : ''; ?>"
                                   min="1000" max="<?php echo date('Y'); ?>" placeholder="e.g., 1925">
                            <i class="fas fa-calendar input-icon"></i>
                        </div>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="description" class="required">Description</label>
                        <textarea id="description" name="description" required placeholder="Brief description of the book..."><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="price">Price ($)</label>
                        <div class="input-wrapper">
                            <input type="number" id="price" name="price" step="0.01"
                                   value="<?php echo isset($_POST['price']) ? htmlspecialchars($_POST['price']) : ''; ?>"
                                   placeholder="e.g., 19.99">
                            <i class="fas fa-tag input-icon"></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="pages">Page Count</label>
                        <div class="input-wrapper">
                            <input type="number" id="pages" name="pages"
                                   value="<?php echo isset($_POST['pages']) ? htmlspecialchars($_POST['pages']) : ''; ?>"
                                   min="1" placeholder="e.g., 320">
                            <i class="fas fa-file-lines input-icon"></i>
                        </div>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="cover">Book Cover Image URL</label>
                        <div class="input-wrapper">
                            <input type="url" id="cover" name="cover"
                                   value="<?php echo isset($_POST['cover']) ? htmlspecialchars($_POST['cover']) : ''; ?>"
                                   placeholder="https://example.com/book-cover.jpg">
                            <i class="fas fa-image input-icon"></i>
                        </div>
                    </div>
                </div>
                
                <div class="form-footer">
                    <a href="welcome.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Home
                    </a>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Add Book
                    </button>
                </div>
            </form>
            
            <?php if (!empty($allBooks)): ?>
            <div>
                <h2 style="font-size: 24px; margin-bottom: 20px; color: #222; display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-books"></i> Recently Added Books
                </h2>
                
                <div class="books-grid">
                    <?php foreach ($allBooks as $book): ?>
                    <div class="book-card">
                        <div class="book-cover">
                            <?php if (!empty($book['cover_url'])): ?>
                                <img src="<?php echo htmlspecialchars($book['cover_url']); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>" style="width:100%; height:100%; object-fit:cover;">
                            <?php else: ?>
                                <i class="fas fa-book fa-3x"></i>
                            <?php endif; ?>
                        </div>
                        <div class="book-info">
                            <h3 class="book-title"><?php echo htmlspecialchars($book['title']); ?></h3>
                            <p class="book-author">by <?php echo htmlspecialchars($book['author']); ?></p>
                            <p class="book-description"><?php echo htmlspecialchars(substr($book['description'], 0, 150)) . '...'; ?></p>
                            <div class="book-meta">
                                <span><i class="fas fa-tag"></i> <?php echo htmlspecialchars($book['genre']); ?></span>
                                <span><i class="fas fa-calendar"></i> <?php echo htmlspecialchars($book['year']); ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </main>
    </div>
</body>
</html>

<!--<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book - BookBranch</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }
        
        body {
            background: #f8f5f2;
            color: #333;
            padding: 20px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid #e0d9d1;
            margin-bottom: 40px;
        }
        
        .logo {
            font-size: 28px;
            font-weight: 700;
            color: #2a5c3d;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo i {
            color: #d4a574;
        }
        
        .nav-links a {
            margin-left: 25px;
            text-decoration: none;
            color: #555;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .nav-links a:hover {
            color: #2a5c3d;
        }
        
        .page-title {
            font-size: 32px;
            margin-bottom: 10px;
            color: #222;
            font-weight: 600;
        }
        
        .page-subtitle {
            color: #666;
            margin-bottom: 40px;
            font-size: 18px;
        }
        
        .form-container {
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            border: 1px solid #354a40;
            margin-bottom: 40px;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
        }
        
        .form-group.full-width {
            grid-column: 1 / -1;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #444;
            font-size: 15px;
        }
        
        .input-wrapper {
            position: relative;
        }
        
        input, select, textarea {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s;
            background-color: #fcfbf9;
        }
        
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #354a40;
            box-shadow: 0 0 0 3px rgba(212, 165, 116, 0.2);
            background-color: white;
        }
        
        .input-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }
        
        textarea {
            min-height: 120px;
            resize: vertical;
            font-family: inherit;
        }
        
        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid #354a40;
        }
        
        .btn {
            padding: 14px 32px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
        
        .btn-primary {
            background-color: #2a5c3d;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #1f4730;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(42, 92, 61, 0.2);
        }
        
        .btn-secondary {
            background-color: #f1eeea;
            color: #555;
        }
        
        .btn-secondary:hover {
            background-color: #e5e0da;
        }
        
        .message {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
        
        .message.success {
            background-color: #f0f9f0;
            border: 1px solid #c3e6c3;
            color: #2a5c3d;
        }
        
        .message.error {
            background-color: #fdf0f0;
            border: 1px solid #f5c6cb;
            color: #d44;
        }
        
        .books-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 40px;
        }
        
        .book-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border: 1px solid #eae5df;
            transition: transform 0.3s;
        }
        
        .book-card:hover {
            transform: translateY(-5px);
        }
        
        .book-cover {
            height: 200px;
            background: linear-gradient(135deg, #e9dfd1, #d4c5b0);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #7a6a52;
        }
        
        .book-info {
            padding: 20px;
        }
        
        .book-title {
            font-size: 20px;
            margin-bottom: 8px;
            color: #222;
        }
        
        .book-author {
            color: #666;
            margin-bottom: 12px;
            font-size: 16px;
        }
        
        .book-description {
            color: #555;
            line-height: 1.5;
            margin-bottom: 15px;
            font-size: 14px;
        }
        
        .book-meta {
            display: flex;
            justify-content: space-between;
            color: #777;
            font-size: 14px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        
        .required::after {
            content: " *";
            color: #d44;
        }
        
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .books-grid {
                grid-template-columns: 1fr;
            }
            
            .nav-links {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <a href="#" class="logo">
                <i class="fas fa-book-open"></i>
                AUDIORIA 
            </a>
            
        </header>
        
        <main>
            <h1 class="page-title">Add New Book</h1>
            <p class="page-subtitle">Fill in the book details below</p>
            
            
            
            <form method="POST" action="" class="form-container">
                <div class="form-grid">
                    <div class="form-group">
                        <label for="title" class="required">Book Title</label>
                        <div class="input-wrapper">
                            <input type="text" id="title" name="title" required
                                   value=""
                                   placeholder="e.g., The Great Gatsby">
                            <i class="fas fa-book input-icon"></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="author" class="required">Author</label>
                        <div class="input-wrapper">
                            <input type="text" id="author" name="author" required
                                   value=""
                                   placeholder="e.g., F. Scott Fitzgerald">
                            <i class="fas fa-user-pen input-icon"></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="genre" class="required">Genre</label>
                        <div class="input-wrapper">
                            <select id="genre" name="genre" required>
                                <option value="" disabled >Select genre</option>
                                <option value="Fiction" >Fiction</option>
                                <option value="Non-Fiction" >Non-Fiction</option>
                                <option value="Science Fiction" >Science Fiction</option>
                                <option value="Fantasy" <?php echo (isset($_POST['genre']) && $_POST['genre'] == 'Fantasy') ? 'selected' : ''; ?>>Fantasy</option>
                                <option value="Mystery" <?php echo (isset($_POST['genre']) && $_POST['genre'] == 'Mystery') ? 'selected' : ''; ?>>Mystery</option>
                                <option value="Biography" <?php echo (isset($_POST['genre']) && $_POST['genre'] == 'Biography') ? 'selected' : ''; ?>>Biography</option>
                            </select>
                            <i class="fas fa-tag input-icon"></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="year">Publication Year</label>
                        <div class="input-wrapper">
                            <input type="number" id="year" name="year"
                                   value="<?php echo isset($_POST['year']) ? htmlspecialchars($_POST['year']) : ''; ?>"
                                   min="1000" max="<?php echo date('Y'); ?>" placeholder="e.g., 1925">
                            <i class="fas fa-calendar input-icon"></i>
                        </div>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="description" class="required">Description</label>
                        <textarea id="description" name="description" required placeholder="Brief description of the book..."><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="price">Price ($)</label>
                        <div class="input-wrapper">
                            <input type="number" id="price" name="price" step="0.01"
                                   value="<?php echo isset($_POST['price']) ? htmlspecialchars($_POST['price']) : ''; ?>"
                                   placeholder="e.g., 19.99">
                            <i class="fas fa-tag input-icon"></i>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="pages">Page Count</label>
                        <div class="input-wrapper">
                            <input type="number" id="pages" name="pages"
                                   value="<?php echo isset($_POST['pages']) ? htmlspecialchars($_POST['pages']) : ''; ?>"
                                   min="1" placeholder="e.g., 320">
                            <i class="fas fa-file-lines input-icon"></i>
                        </div>
                    </div>
                    
                    <div class="form-group full-width">
                        <label for="cover">Book Cover Image URL</label>
                        <div class="input-wrapper">
                            <input type="url" id="cover" name="cover"
                                   value="<?php echo isset($_POST['cover']) ? htmlspecialchars($_POST['cover']) : ''; ?>"
                                   placeholder="https://example.com/book-cover.jpg">
                            <i class="fas fa-image input-icon"></i>
                        </div>
                    </div>
                </div>
                
                <div class="form-footer">
                    <a href="welcome.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Home
                    </a>
                    
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Add Book
                    </button>
                </div>
            </form>
            
            
            <div>
                <h2 style="font-size: 24px; margin-bottom: 20px; color: #222; display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-books"></i> Recently Added Books
                </h2>
                
                <div class="books-grid">
                    
                    <div class="book-card">
                        <div class="book-cover">
                           
                                <img src="image/fantasy2.png" alt="" style="width:100%; height:100%; object-fit:cover;">
                         
                                <i class="fas fa-book fa-3x"></i>
                            
                        </div>
                        <div class="book-info">
                            <h3 class="book-title"></h3>
                            <p class="book-author">by  </p>
                            <p class="book-description"></p>
                            <div class="book-meta">
                                <span><i class="fas fa-tag"></i> </span>
                                <span><i class="fas fa-calendar"></i> </span>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
            
        </main>
    </div>
    <script src="script.js"></script>
</body>
</html>-->