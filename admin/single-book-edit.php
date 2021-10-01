<?php

require '../includes/init.php';
$conn = require '../includes/db.php';

Auth::requireLogin(true);
$upload_status = '';
$current_image_file = '';
if (isset($_GET['id'])) {
    
    $book = Book::getBookById($conn, $_GET['id']);
    $current_image_file = $book->image_file;
}


if ($_SERVER['REQUEST_METHOD']  == "POST") {
   
   if (isset($_POST['submit'])) {

       $book->title = $_POST['title'];
       $book->author = $_POST['author'];
       $book->year = $_POST['year'];
       $book->category = $_POST['category'];
       $book->pages = $_POST['pages'];
       $book->publisher = $_POST['publisher'];
       $book->age_from = $_POST['age'] == 'children' ? 0 : 1;
       $book->image_file = $_POST['file_path'];
       if ( $book->updateBook($conn, $_GET['id'])) {
           Url::redirect('/librarian/admin/');
       };

   }
   if (isset($_POST['upload'])) {
       $book->title = $_POST['title'];
       $book->author = $_POST['author'];
       $book->year = $_POST['year'];
       $book->category = $_POST['category'];
       $book->pages = $_POST['pages'];
       $book->publisher = $_POST['publisher'];
       $book->age_from = $_POST['age'] == 'children' ? 0 : 1;
       $book->image_file = '';

       try {

           if (empty($_FILES)) {
               throw new Exception('Invalid upload');
           }
           
           switch ($_FILES['image_file']['error']) {
               case UPLOAD_ERR_OK:
                   break;
               case UPLOAD_ERR_NO_FILE:
                   throw new Exception("No file uploaded");
                   break;
               default:
                   throw new Exception("An error occurred");
           }

           if ($_FILES['image_file']['size'] > 1000000 ) {
               throw new Exception("File is too large");
           }

           $mime_types = ['image/gif', 'image/png', 'image/jpeg', 'image/webp'];
           $finfo = finfo_open(FILEINFO_MIME_TYPE);
           $mime_type = finfo_file($finfo, $_FILES['image_file']['tmp_name']);
           
           if ( ! in_array($mime_type, $mime_types)) {

               throw new Exception('It\'s not of valid type.');
           }

           $pathinfo = pathinfo($_FILES['image_file']['name']);
           $base = $pathinfo['filename'];
           $base = preg_replace('/[^a-zA-Z0-9_-]/', '_', $base);
           $base = mb_substr($base, 0, 200);
           $filename = $base . '.' . $pathinfo['extension'];
           $destination = "../uploads/$filename";

           $i = 1;

           while (file_exists($destination)) {

               $filename = $base . "-$i" . '.' . $pathinfo['extension'];
               $destination = "../uploads/$filename";
               $i++;
           }

           // Image file name in book instance is set here 
           $book->image_file = $filename;
           $current_image_file = $book->image_file;
           //Moves file to selected folder
           if (move_uploaded_file($_FILES['image_file']['tmp_name'], $destination)) {

              $upload_status = "File uploaded";
           } else {
               $upload_status = "Not uploaded. Sorry";
           }

       } catch (Exception $e) {
           $upload_status = $e->getMessage();
       }
   }

}
?>
<?php require 'includes/header.php'; ?>
<div class="book-edit">
    <h4>Edit book</h4>
</div>
<?php require 'includes/form.php'; ?>

<?php require 'includes/footer.php'; ?>