<?php
  include_once 'admin/php/book_info.php';
  include_once 'admin/php/common.php';
  include_once 'admin/php/displays.php';
?>
<!doctype html>
<html>
  <?=createBasicHead('Cart', null, ['book_table.css'])?>
  <body>
    <div id="container">
      <?=createHeader()?>
      <div class="content">
        <div id="cart" class="centered box">
          <form method="post" action="<?=$_SERVER['PHP_SELF']?>">
            <table id="books-in-cart" class="wide">
              <tr>
                <th class="thin-cell">Remove</th>
                <th>Book Description</th>
                <th class="thin-cell">Qty</th>
                <th class="thin-cell">Price</th>
              </tr>
              
              <!-- TODO: generate rows from db -->
              <?php 
                $book = [
                    'id' => 1,
                    'title' => 'Absolute Java',
                    'author' => 'Walter Savitch',
                    'price' => '149.99',
                    'quantity' => '2',
                    'publisher' => 'Addison-Wesley',
                    'isbn' => '978-0132834230'
                ]
              ?>
              <tr>
                <td class="book-info"><input type="submit" class="purple button centered-input" value="Delete" name="delete <?=$book['id']?>">
                <td class="book-info"><?=generateBookInfo($book)?></td>
                <td class="book-info"><input type="number" name="quantity" class="quantity-box right-aligned centered-input" value="<?=$book['quantity']?>"></td>
                <td class="book-info"><div class="centered-input">$<?=$book['price']*$book['quantity']?></div></td>
              </tr>
              
            </table>
            <div id="buttons" class="box align-right">
              <input type="submit" class="blue button" value="Update">
              <input type="submit" class="green button" value="Checkout">
            </div>
          </form>
        </div>
      </div>
      <?=createFooter()?>
    </div>
  </body>
</html>
