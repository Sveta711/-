<?php
class BookRepository {
    private $connection;
    
    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function save(Book $book) {
        $sql = "INSERT INTO books (title, author, genre, year, description, price, pages, cover_url, created_at) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->connection->prepare($sql);
        
        $data = $book->toArray();
        $stmt->bind_param("sssisdiss", 
            $data['title'],
            $data['author'],
            $data['genre'],
            $data['year'],
            $data['description'],
            $data['price'],
            $data['pages'],
            $data['cover'],
            $data['created_at']
        );
        
        return $stmt->execute();
    }

    public function getAll() {
        $sql = "SELECT * FROM books ORDER BY created_at DESC";
        $result = $this->connection->query($sql);
        
        $books = [];
        while ($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
        
        return $books;
    }
}
?>