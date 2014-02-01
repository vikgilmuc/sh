DROP TABLE IF EXISTS `#__dreamworkgallery`;
 
CREATE TABLE `#__dreamworkgallery` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `catid` INT(8) UNSIGNED NOT NULL,
  `ordnum` INT(11) UNSIGNED NOT NULL,
  `publish` INT(2) UNSIGNED,
  `name` VARCHAR(255) NOT NULL,
  `descr` TEXT NOT NULL,
  `altthumb` VARCHAR(255) NOT NULL,
  `altlarge` VARCHAR(255) NOT NULL,
  `thumb` VARCHAR(255) NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `linkname` VARCHAR(255) NOT NULL,
  `linkit` VARCHAR(255) NOT NULL,
  `reg_price` VARCHAR(255) NOT NULL,
  `dis_price` VARCHAR(255) NOT NULL,
  `medfld` INT(4) UNSIGNED,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `#__dreamworkgalleryc`;
 
CREATE TABLE `#__dreamworkgalleryc` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ordnum` INT(11) UNSIGNED NOT NULL,
  `publish` INT(2) UNSIGNED NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `descr` TEXT NOT NULL,
  `altthumb` VARCHAR(255) NOT NULL,
  `altlarge` VARCHAR(255) NOT NULL,
  `thumb` VARCHAR(255) NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  `linkname` VARCHAR(255) NOT NULL,
  `linkit` VARCHAR(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;