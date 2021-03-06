<?php
include_once '../admin/php/connection.php';
include_once '../admin/php/login.php';
require_once '../admin/php/inserters/address_inserter.php';
require_once '../admin/php/inserters/credit_card_inserter.php';
require_once '../admin/php/inserters/customer_inserter.php';

session_start();

// open db connection and create db interaction elements
$login = Login::get_instance();
$db = open_connection();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$address_inserter = new Address_inserter($db);
$card_inserter = new Credit_card_inserter($db);
$customer_inserter = new Customer_inserter($db);

$updating = $_POST['update']? true: false;
$success = false;
if (!$updating && $customer_inserter->does_exist($_POST['username'])) {
  $error_message = 'Username is taken: '. $_POST['username'];
} else {

  try {

    if ($updating && $_POST['address-selection'] == 'other-address') {
      $address_id = intval($_POST['other-address']);
    } elseif ($updating && $_POST['address-selection'] == 'current-address') {
      $address_id = $login->get_primary_address()['id'];
    } else {
      $address_info = [
        'street_address' => $_POST['street-address'],
        'city' => $_POST['city'],
        'zip' => $_POST['zip'],
        'state' => $_POST['state']
      ];

      $address_id = $address_inserter->insert($address_info)['id'];
    }

    if ($updating) {
      $update = [
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'first_name' => $_POST['first-name'],
        'last_name' => $_POST['last-name'],
        'address_id' => $address_id
      ];
      if (isset($_POST['password'])) {
        $update['password'] = $_POST['password'];
      }

      $customer_inserter->update($update);
    } else {
      $customer_inserter->insert([
        'username' => $_POST['username'],
        'password' => $_POST['password'],
        'email' => $_POST['email'],
        'first_name' => $_POST['first-name'],
        'last_name' => $_POST['last-name'],
        'address_id' => $address_id
      ]);
    }

    $card_id = $card_inserter->insert([
      'username' => $_POST['username'],
      'number' => $_POST['card-number'],
      'issuer' => $_POST['card-type'],
      'expiration' => $_POST['card-expiration']
    ]);

    try {
      // insert customer, address into lookup table
      $query = 'INSERT INTO customer_address
          VALUES (:username, :address_id);';
      $stmt = $db->prepare($query);
      $stmt->execute([
          'username' => $_POST['username'],
          'address_id' => $address_id
      ]);
    } catch (PDOException $e) {
      // exception thrown if username/address combo already in
    }

    // put card number into customer
    // TODO: do this when initially adding customer
    $query = 'UPDATE customer
        SET card_number = :card_number
        WHERE username = :username;';
    $stmt = $db->prepare($query);
    $stmt->execute([
        'card_number' => $_POST['card-number'],
        'username' => $_POST['username']
    ]);
  } catch (PDOException $e) {
    print_r($e);
  }

  $success = true;
}

if ($success) {
  echo json_encode([
      'status' => 'success',
      'info' => $_POST,
      'previousPage' => $_SESSION['previous']
  ]);
} else {
  echo json_encode([
      'status' => 'fail',
      'info' => $error_message,
      'previousPage' => $_SESSION['previous']
  ]);
}
?>