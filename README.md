# page-scrapper

Change DB Configuration in DBWrapper.php

PHP built-in web server.

Run "php -S localhost:22345"

http://localhost:22345/scraper.php

Click on the label to fetch the table containing word count

Schema :

CREATE DATABASE IA;

CREATE TABLE `wordsStore` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `configId` int(11) DEFAULT NULL,
  `word` varchar(1024) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `Configs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(1024) DEFAULT NULL,
  `configName` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;