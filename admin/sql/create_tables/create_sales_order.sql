CREATE TABLE IF NOT EXISTS sales_order
( id INT(11) UNSIGNED PRIMARY KEY

, total_cost NUMERIC(6, 2)
, submit_date DATETIME
, shipping_cost NUMERIC(6, 2)
, delivery_date DATE
, delivery_status ENUM('pending', 'shipped', 'delivered')

, contact_phone_area_code INT(3)
, contact_phone_number INT(7)
, customer_username VARCHAR(64)
, address_id INT(11) UNSIGNED
, credit_card_number INT(16) UNSIGNED

, FOREIGN KEY (contact_phone_area_code, contact_phone_number) REFERENCES phone (area_code, number)
, FOREIGN KEY (customer_username) REFERENCES customer (username)
, FOREIGN KEY (address_id) REFERENCES address (id)
, FOREIGN KEY (credit_card_number) REFERENCES credit_card (number)
);