<?php

class Book {

  public $id = -1;
  public $title = '';
  public $first_name = '';
  public $last_name = '';
  public $price = 0.0;
  public $publisher = '';
  public $isbn = 0;
  public $description = '';
  public $cover = NULL;
  
  function __construct($data) {
    foreach ($data as $key => $value) {
      $this->$key = $value;
    }
  }
  
  public function generateBookInfo($show_publisher = false, $showISBN = false) {

    $to_return = generateBookInfoLine('Title', $this->title)
    . generateBookInfoLine('Author', $this->first_name . ' ' . $this->last_name)
    . generateBookInfoLine('Price', "$" . $this->price);
    
    if ($show_publisher) {
      $to_return .= generateBookInfoLine('Publisher', $this->publisher);
    }
    
    if ($showISBN) {
      $to_return .= generateBookInfoLine('ISBN', $this->isbn);
    }
    
    return $to_return;
  }
  
  private static function generateBookInfoLine($label, $content) {
    $lower_case = strtolower($label);
    return '<div class="book-info book-' . $lower_case . '">
          <label class="book-label">' . $label . '</label>' . $content . '</div>';
  }
  
  public function generateBookView($book) {
    $to_return = '<div class="book-view">
          <img src="' . $cover . '" class="book-cover" /><div class="book-info-box">'
            . generateBookInfoLine('Title', $this->title)
            . generateBookInfoLine('Author', $this->first_name . ' ' . $this->last_name)
            . '</div>
             </div>';
    return $to_return;
  }
  
}

/**
 * Generate content for a cell in tables holding book information.
 * For use in Cart, Order-confirmation, etc.
 *
 * @param array   $book Book information (title, author, etc)
 * @param boolean $show_publisher Whether or not to show publisher info
 * @param boolean $show_isbn Whether or not to show isbn
 */
function generateBookInfo($book, $show_publisher = false, $showISBN = false) {
  $to_return = generateBookInfoLine('Title', $book['title'])
    . generateBookInfoLine('Author', $book['first_name'] . ' ' . $book['last_name'])
    . generateBookInfoLine('Price', "$" . $book['price']);

  if ($show_publisher) {
    $to_return .= generateBookInfoLine('Publisher', $book['publisher']);
  }

  if ($showISBN) {
    $to_return .= generateBookInfoLine('ISBN', $book['isbn']);
  }

  return $to_return;
}

/**
 * Generate line in book info content
 *
 * @param string $label
 *          Label (one word only)
 * @param string $content
 *          Content
 */
function generateBookInfoLine($label, $content) {
  $lower_case = strtolower($label);
  return '<div class="book-info book-' . $lower_case . '">
        <label class="book-label">' . $label . '</label>' . $content . '</div>';
}

/**
 * Generate content for a book with cover, used on the main page
 *
 * @param array   $book Book information (title, author, etc)
 */
function generateBookView($book) {
  $to_return = '<div class="book-view">
        <img src="' . $book['cover'] . '" class="book-cover" /><div class="book-info-box">'
          . generateBookInfoLine('Title', $book['title'])
          . generateBookInfoLine('Author', $book['first_name'] . ' ' . $book['last_name'])
          . '</div>
           </div>';
  return $to_return;
}

?>