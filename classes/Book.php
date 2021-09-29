<?php

/**
 * Book entity 
 * 
 */

 class Book 
 {
     /**
      * Unique indetifier of item
      * @var integer
      */

      public $id;

      /**
       * Author of the book
       * @var string
       */

      public $author;

      /**
       * Title of the book
       * @var string
       */

      public $title;

      /**
       * Released year
       * @var integer
       */

      public $year;

      /**
       * Category of the book
       * @var integer
       */

      public $category;

      /**
       * Print length (pages)
       * @var integer
       */
      public $pages;

      /**
       * Publisher of the book
       * @var string
       */
      public $publisher;

      /**
       * Recommended age
       * @var integer
       */

      public $age_from;

      /** 
       * Is book available?
       * @var boolean
       */

      public $is_available;

      /**
       * URL of image
       * @var string
       */

      public $image_file;

      /**
       * @param array $errors Contains all errors to display
       */

       public $errors = [];

       /**
        * @param array Array of categories
        */

        public $categories = [
            'romance',
            'documentary',
            'fiction',
            'fantasy',
            'sci-fi',
            'other',
            'classic'
        ];

    /**
     * Get all books in the library
     * @return array $books Array of all the books
     */

     public static function getAllBooks($conn)
     {
        $sql = "SELECT * FROM book ORDER BY title";

        $result = $conn->query($sql);
        if ($result) {
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "Cannot fetch data";

        }
     }

     /**
      * Get single book by ID
      * @param object $conn Connection to the database
      * @param integer $id Id of the book
      *
      * @return object returns book information
      */
     public static function getBookById($conn, $id, $columns = "*") {
         $sql = "SELECT $columns FROM book WHERE id = :id";
         $stmt = $conn->prepare($sql);
         $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_CLASS, "Book");

         if ($stmt->execute()) {
             return $stmt->fetch();
         } else {
             echo "No data";
         }
     }

     /**
      * Deletes selected book from library
      * @param object $conn Connection to the database
      * @param integer $id id of the book
      */

     public static function deleteBook($conn, $id) 
     {
    
         $sql = "DELETE FROM book WHERE id =:id";
         $stmt = $conn->prepare($sql);
         $stmt->bindValue(':id', $id, PDO::PARAM_INT);
         
         if ($stmt->execute()) {
             Url::redirect('/librarian/admin/index.php');
         } else {
             echo "Operation failed.";
         }

     }

     /**
      * Inserts new book
      * @param object $conn Connection to the database
      * @return boolean true if success, false otherwise
      */
      
     public function insertBook($conn)
    {
       if ($this->validate()) {
           
            // Fill class with proper values before creating new book in DB
            $this->category = array_search($this->category, $this->categories); 
            $this->age_from == 'kids' ? $this->age_from = 0 : $this->age_from = 1;
            $this->is_available = 1;

            $sql = "INSERT INTO book (title, 
            author,
            year,
            category,
            pages,
            publisher,
            age_from,
            is_available,
            image_file) VALUES (
            :title,
            :author,
            :year,
            :category,
            :pages,
            :publisher,
            :age_from,
            :is_available,
            :image_file)";

            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
            $stmt->bindValue(':author', $this->author, PDO::PARAM_STR);
            $stmt->bindValue(':year', $this->year, PDO::PARAM_INT);
            $stmt->bindValue(':category', $this->category, PDO::PARAM_INT);
            $stmt->bindValue('pages', $this->pages, PDO::PARAM_INT);
            $stmt->bindValue('publisher', $this->publisher, PDO::PARAM_STR);
            $stmt->bindValue('age_from', $this->age_from, PDO::PARAM_INT);
            $stmt->bindValue('is_available',1, PDO::PARAM_INT);
            $stmt->bindValue('image_file', $this->image_file, PDO::PARAM_STR);

            if ($stmt->execute()) {
               return true;
            } else {
                return false;
            }

       } else {
           return false;
       }
    }

     /**
      * Updates existing book
      * @param object $conn Connection to the database

      * @return boolean true if success, false otherwise

      */
      
      public function updateBook($conn, $id)
      {
         if ($this->validate()) {
             
              // Fill class with proper values before creating new book in DB
              $this->category = array_search($this->category, $this->categories); 
              $this->age_from == 'kids' ? $this->age_from = 0 : $this->age_from = 1;
              $this->is_available = 1;
  
              $sql = "UPDATE book SET 
              title = :title,
              author = :author,
              year = :year,
              category = :category,
              pages = :pages,
              publisher = :publisher,
              age_from = :age_from,
              is_available = :is_available,
              image_file = :image_file WHERE id = :id";
  
              $stmt = $conn->prepare($sql);
              $stmt->bindValue(':title', $this->title, PDO::PARAM_STR);
              $stmt->bindValue(':author', $this->author, PDO::PARAM_STR);
              $stmt->bindValue(':year', $this->year, PDO::PARAM_INT);
              $stmt->bindValue(':category', $this->category, PDO::PARAM_INT);
              $stmt->bindValue('pages', $this->pages, PDO::PARAM_INT);
              $stmt->bindValue('publisher', $this->publisher, PDO::PARAM_STR);
              $stmt->bindValue('age_from', $this->age_from, PDO::PARAM_INT);
              $stmt->bindValue('is_available',1, PDO::PARAM_INT);
              $stmt->bindValue('image_file', $this->image_file, PDO::PARAM_STR);
              $stmt->bindValue('id', $id, PDO::PARAM_INT);
  
              if ($stmt->execute()) {
                 return true;
              } else {
                  return false;
              }
  
         } else {
             return false;
         }
      }

    /**
     * Validates the form when user enters data
     * 
     * @return bool true if errors occurred, false otherwise
     */

    protected function validate()
    {
        if ($this->title == '') {
            $this->errors[] = 'Title is required';
        }
        if ($this->author == '') {
            $this->errors[] = 'Author is required'
;        }
        return empty($this->errors);
    }
    public static function displayByCategory() {
        $sql = "SELECT * FROM book JOIN category WHERE book.category = category.id";
    }

 }


