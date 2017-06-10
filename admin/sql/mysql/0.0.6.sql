DROP TABLE IF EXISTS `#__ncompcustomcode`;
 
CREATE TABLE `#__ncompcustomcode` (
	`id`       INT(11)     NOT NULL AUTO_INCREMENT,
	`mainhtmldata` TEXT NOT NULL,
	`published` tinyint(4) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;
 
INSERT INTO `#__ncompcustomcode` (`mainhtmldata`) VALUES
('Hello World!'),
('Good bye World!');