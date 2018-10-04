CREATE TABLE `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB;

INSERT INTO `accounts` (`id`, `userId`, `amount`) VALUES
(1, 1, '10000.00');

CREATE TABLE `users` (
  `id` int(11) NOT NULL  AUTO_INCREMENT,
  `login` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1, 'user', 'test');
