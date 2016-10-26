/*
  *  2. Design a mysql database and write SQL queries.
  */

/*
  *  Create following tables in database (and insert sample data) in order to check if 'select' queries at the bottom of the file work as expected
  */
CREATE TABLE `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `type` (`id`, `name`) VALUES
(1, 'small'),
(2, 'regular'),
(3, 'big'),
(4, 'huge');

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `category` (`id`, `name`, `lft`, `rgt`) VALUES
(1, 'food', 1, 12),
(2, 'fruit', 2, 3),
(3, 'vegetable', 4, 5),
(4, 'meat', 6, 11),
(5, 'beef', 7, 8),
(6, 'chicken', 9, 10),
(7, 'furniture', 13, 18),
(8, 'table', 14, 15),
(9, 'chair', 16, 17);

CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`category_id`) REFERENCES `category`(`id`),
  FOREIGN KEY (`type_id`) REFERENCES `type`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `item` (`id`, `name`, `price`, `category_id`, `type_id`) VALUES
(1, 'banana', '5.25', 2, 1),
(2, 'potato', '6.00', 3, 2),
(3, 'cake', '4.25', 1, 4),
(4, 'steak', '25.40', 5, 1),
(5, 'minced meat', '15.20', 4, 3),
(6, 'chicken breast', '1.10', 6, 1),
(7, 'table', '25.00', 8, 2),
(8, 'closet', '50.10', 7, 2),
(9, 'armchair', '35.20', 9, 2);

/****************************************************/

/*
  * Get all items from category 'X' (here 'X' = 'meat')
  */
SELECT i.* FROM `item` AS i
JOIN `category` AS c ON c.`id` = i.`category_id`
WHERE c.`name` = 'meat';

/*
  * Get all items from category 'X' including all sub-categories (here 'X' = 'meat')
  */
SELECT i.* FROM `item` AS i
JOIN `category` AS c1 ON c1.`name` = 'meat'
JOIN `category` AS c2 ON c2.`id` = i.`category_id`
WHERE c2.`lft` >= c1.`lft` AND c2.`rgt` <= c1.`rgt`;