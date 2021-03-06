CREATE TABLE IF NOT EXISTS wishlist
( book_isbn CHAR(13)
, customer_username VARCHAR(64)

, FOREIGN KEY (customer_username) REFERENCES customer (username)
, FOREIGN KEY (book_isbn) REFERENCES book (isbn)
, PRIMARY KEY (book_isbn, customer_username)
);
