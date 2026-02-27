-- Additional Books for Ethiopia BookStore
-- Run this after the main database.sql setup

USE online_bookstore;

-- More Fiction Books
INSERT INTO books (title, author, isbn, category_id, subcategory_id, description, price, stock_quantity, publisher, publication_year, pages, language) VALUES
('Pride and Prejudice', 'Jane Austen', '9780141439518', 1, 2, 'A romantic novel of manners', 11.99, 55, 'Penguin Classics', 1813, 432, 'English'),
('The Alchemist', 'Paulo Coelho', '9780062315007', 1, 1, 'A mystical story about following your dreams', 13.99, 70, 'HarperOne', 1988, 208, 'English'),
('Harry Potter and the Sorcerer Stone', 'J.K. Rowling', '9780439708180', 1, 1, 'The magical journey begins', 19.99, 100, 'Scholastic', 1997, 309, 'English'),
('The Hobbit', 'J.R.R. Tolkien', '9780547928227', 1, 1, 'A fantasy adventure in Middle Earth', 15.99, 65, 'Mariner Books', 1937, 310, 'English'),
('The Da Vinci Code', 'Dan Brown', '9780307474278', 1, 3, 'A mystery thriller about religious secrets', 16.99, 50, 'Anchor', 2003, 489, 'English'),
('Gone Girl', 'Gillian Flynn', '9780307588371', 1, 3, 'A psychological thriller about a missing wife', 14.99, 45, 'Broadway Books', 2012, 422, 'English'),friends'),
('Astrophysics for People in a Hurry', 'Neil deGrasse Tyson', '9780393609394', 3, 7, 'Quick guide to theBang to black holes', 16.99, 50, 'Bantam', 1988, 212, 'English'),
('The Selfish Gene', 'Richard Dawkins', '9780198788607', 3, 9, 'How genes shape behavior', 14.99, 45, 'Oxford University Press', 1976, 360, 'English'),
('Cosmos', 'Carl Sagan', '9780345539434', 3, 7, 'A journey through space and time', 17.99, 55, 'Ballantine Books', 1980, 365, 'English'),
('The Origin of Species', 'Charles Darwin', '9780451529060', 3, 9, 'The foundation of evolutionary biology', 13.99, 40, 'Signet Classics', 1859, 576, 'EnglishEnglish'),

-- Science Books
('A Brief History of Time', 'Stephen Hawking', '9780553380163', 3, 7, 'From the Big ir of former First Lady Michelle Obama', 19.99, 65, 'Crown', 2018, 448, 'English'),
('The Diary of a Young Girl', 'Anne Frank', '9780553296983', 2, 5, 'The powerful diary of Anne Frank', 12.99, 70, 'Bantam', 1947, 283, 'English'),
('Long Walk to Freedom', 'Nelson Mandela', '9780316548182', 2, 4, 'Autobiography of Nelson Mandela', 18.99, 45, 'Little Brown', 1994, 656, 'English'),
('Into the Wild', 'Jon Krakauer', '9780385486804', 2, 6, 'True story of Christopher McCandless', 15.99, 40, 'Anchor', 1996, 207, ''English'),
('Becoming', 'Michelle Obama', '9781524763138', 2, 4, 'Memot sea with a tiger', 14.99, 55, 'Mariner Books', 2001, 460, 'English'),

-- Non-Fiction Books
('Steve Jobs', 'Walter Isaacson', '9781451648539', 2, 4, 'The exclusive biography of Steve Jobs', 16.99, 30, 'Simon & Schuster', 2011, 656, 'English'),
('Sapiens', 'Yuval Noah Harari', '9780062316110', 2, 5, 'A brief history of humankind', 18.99, 40, 'Harper', 2015, 443, 'English'),
('Educated', 'Tara Westover', '9780399590504', 2, 4, 'A memoir about education and self-invention', 17.99, 50, 'Random House', 2018, 334,  'A boy survives 227 days a'Riverhead Books', 2003, 371, 'English'),
('Life of Pi', 'Yann Martel', '9780156027328', 1, 1,hip and redemption', 15.99, 60, 
('The Kite Runner', 'Khaled Hosseini', '9781594631931', 1, 1, 'A powerful story of 