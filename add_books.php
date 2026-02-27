<?php
require_once 'config.php';

// Books data array
$books = [
    // Fiction Books
    ['Pride and Prejudice', 'Jane Austen', '9780141439518', 1, 2, 'A romantic novel of manners set in Georgian England', 11.99, 55, 'Penguin Classics', 1813, 432],
    ['The Alchemist', 'Paulo Coelho', '9780062315007', 1, 1, 'A mystical story about following your dreams', 13.99, 70, 'HarperOne', 1988, 208],
    ['Harry Potter Sorcerers Stone', 'J.K. Rowling', '9780439708180', 1, 1, 'The magical journey begins at Hogwarts', 19.99, 100, 'Scholastic', 1997, 309],
    ['The Hobbit', 'J.R.R. Tolkien', '9780547928227', 1, 1, 'A fantasy adventure in Middle Earth', 15.99, 65, 'Mariner Books', 1937, 310],
    ['The Da Vinci Code', 'Dan Brown', '9780307474278', 1, 3, 'A mystery thriller about religious secrets', 16.99, 50, 'Anchor', 2003, 489],
    ['Gone Girl', 'Gillian Flynn', '9780307588371', 1, 3, 'A psychological thriller about a missing wife', 14.99, 45, 'Broadway Books', 2012, 422],
    ['The Kite Runner', 'Khaled Hosseini', '9781594631931', 1, 1, 'A powerful story of friendsh182', 2, 4, 'Autobiography of Nelson Mandela', 18.99,, 'Michelle Obama', '9781524763138', 2, 4, 'Memoir of former First Lady Michelle Obama', 19.99, 65, 'Crown', 2018, 448],
    ['The Diary of a Young Girl', 'Anne Frank', '9780553296983', 2, 5, 'The powerful diary of Anne Frank', 12.99, 70, 'Bantam', 1947, 283],
    ['Long Walk to Freedom', 'Nelson Mandela', '9780316548ention', 17.99, 50, 'Random House', 2018, 334],
    ['Becoming'days at sea with a tiger', 14.99, 55, 'Mariner Books', 2001, 460],
    
    // Non-Fiction Books
    ['Educated', 'Tara Westover', '9780399590504', 2, 4, 'A memoir about education and self-inv99, 60, 'Riverhead Books', 2003, 371],
    ['Life of Pi', 'Yann Martel', '9780156027328', 1, 1, 'A boy survives 227 ip and redemption', 15.