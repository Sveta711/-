<?php
class Book {
    private $title;
    private $author;
    private $genre;
    private $year;
    private $description;
    private $price;
    private $pages;
    private $cover;
    private $createdAt;

    public function __construct($title, $author, $genre, $description) {
        $this->title = $title;
        $this->author = $author;
        $this->genre = $genre;
        $this->description = $description;
        $this->createdAt = date('Y-m-d H:i:s');
    }

    // Getter and Setter մեթոդներ
    public function getId() { return $this->id; }
    public function getTitle() { return $this->title; }
    public function getAuthor() { return $this->author; }
    public function getGenre() { return $this->genre; }
    public function getYear() { return $this->year; }
    public function getDescription() { return $this->description; }
    public function getPrice() { return $this->price; }
    public function getPages() { return $this->pages; }
    public function getCover() { return $this->cover; }
    public function getCreatedAt() { return $this->createdAt; }
   
    public function setYear($year) { $this->year = $year; }
    public function setPrice($price) { $this->price = $price; }
    public function setPages($pages) { $this->pages = $pages; }
    public function setCover($cover) { $this->cover = $cover; }

    public function validate() {
        $errors = [];
        
        if (empty($this->title)) {
            $errors[] = "Book title is required";
        }
        
        if (empty($this->author)) {
            $errors[] = "Author is required";
        }
        
        if (empty($this->genre)) {
            $errors[] = "Genre is required";
        }
        
        if (empty($this->description)) {
            $errors[] = "Description is required";
        }
        
        if ($this->year && ($this->year < 1000 || $this->year > date('Y'))) {
            $errors[] = "Invalid publication year";
        }
        
        if ($this->price && $this->price < 0) {
            $errors[] = "Price cannot be negative";
        }
        
        return $errors;
    }

    public function toArray() {
        return [
            'title' => $this->title,
            'author' => $this->author,
            'genre' => $this->genre,
            'year' => $this->year,
            'description' => $this->description,
            'price' => $this->price,
            'pages' => $this->pages,
            'cover' => $this->cover,
            'created_at' => $this->createdAt
        ];
    }
}
?>