ALTER TABLE `extaz_informations` ADD `use_faq` INT NULL;
ALTER TABLE `extaz_team`ADD `dname` VARCHAR(255) NULL AFTER `id`;


CREATE TABLE IF NOT EXISTS `extaz_faqs` (
  `id` int(11) NOT NULL,
  `question` text,
  `answer` text
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `extaz_votes`;
CREATE TABLE IF NOT EXISTS `extaz_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `reward` int(11) NOT NULL,
  `next_vote` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
