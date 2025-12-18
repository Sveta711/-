<?php
class BookController {
    private $bookRepository;
    
    public function __construct($bookRepository) {
        $this->bookRepository = $bookRepository;
    }

    public function handleAddBook($postData) {
        // Ստեղծել նոր Book օբյեկտ
        $book = new Book(
            htmlspecialchars($postData['title']),
            htmlspecialchars($postData['author']),
            htmlspecialchars($postData['genre']),
            htmlspecialchars($postData['description'])
        );

        // Սեթ անել օպցիոնալ դաշտերը
        if (!empty($postData['year'])) {
            $book->setYear((int)$postData['year']);
        }
        
        if (!empty($postData['price'])) {
            $book->setPrice((float)$postData['price']);
        }
        
        if (!empty($postData['pages'])) {
            $book->setPages((int)$postData['pages']);
        }
        
        if (!empty($postData['cover'])) {
            $book->setCover(htmlspecialchars($postData['cover']));
        }

        // Վալիդացիա
        $errors = $book->validate();
        
        if (empty($errors)) {
            // Պահպանել տվյալների բազայում
            $success = $this->bookRepository->save($book);
            
            if ($success) {
                return [
                    'success' => true,
                    'message' => 'Book has been successfully added!',
                    'book' => $book
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Error saving book to database.'
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => implode('<br>', $errors)
            ];
        }
    }

    public function getAllBooks() {
        return $this->bookRepository->getAll();
    }
}
?>