DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `acc_no` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `image` varchar(500) NOT NULL,
  `category` varchar(50) NOT NULL,
  `author` varchar(255) NOT NULL,
  `copies` int NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `copyright_year` year NOT NULL,
  `class_no` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `status` varchar(50) NOT NULL,
  `comment` varchar(255) NOT NULL,
  PRIMARY KEY (`acc_no`),
  UNIQUE KEY `isbn` (`isbn`)
);

INSERT INTO `books` (`acc_no`, `title`, `image`, `category`, `author`, `copies`, `publisher`, `isbn`, `copyright_year`, `class_no`, `price`, `status`, `comment`) VALUES
(1, 'River sing me home', 'River Sing Me Home.jpeg', 'English Fiction', 'Elanor Shearer', 3, 'LBClassics', '14582-546584', 2015, 'CAR-F', 1450, 'Old', ''),
(2, 'Princess Freedom', 'Princess Freedom.jpeg', 'English Fiction', 'Griggri Archembalo', 1, 'GAClassics', '785659-8569-4523', 2016, 'CAR-F', 1500, 'New', 'Donated by a student'),
(3, 'A court for Ravens', 'A court for ravens.jpg', 'English Fiction', 'Layla Blue', 1, 'LBClassics', '7854-8569-965', 2019, 'CAR-F', 1500, 'New', '');

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `name` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` char(10) NOT NULL,
  `grade_class` varchar(3) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `password` varchar(15) NOT NULL,
  PRIMARY KEY (`user_id`)
);

INSERT INTO `members` (`name`, `email`, `contact_no`, `grade_class`, `user_id`, `password`) VALUES
('Fazna Sheriffdeen', 'gfsheriffdeen@gmail.com', '0758528524', '11B', '4526', 'Qwerty@123'),
('Fathima', 'fathima@gmail.com', '0728569426', '11B', '4741', 'qazwsx123'),
('Chamaylee', 'chamaylee@gmail.com', '0758528524', '11B', '4785', 'qazwsx123'),
('rithosha', 'rithosha@gmail.com', '2178523698', '11D', '7850', 'qwerty123'),
('Sampath Perera', 'sampath@gmail.com', '0756985236', '', 'AAAA', 'admin@123');

DROP TABLE IF EXISTS borrowed_book_details;
CREATE TABLE IF NOT EXISTS borrowed_book_details (
  borrow_id INT AUTO_INCREMENT NOT NULL,
  book_id INT NOT NULL,
  user_id varchar(10) NOT NULL,
  borrowed_date date NOT NULL,
  return_date date NOT NULL,
  status varchar(20) NOT NULL,
  KEY (borrow_id,user_id),
  CONSTRAINT user_id_fk FOREIGN KEY(user_id) REFERENCES members(user_id),
  CONSTRAINT book_id_fk FOREIGN KEY(book_id) REFERENCES books(acc_no));