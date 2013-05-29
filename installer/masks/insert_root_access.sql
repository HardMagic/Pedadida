
DROP TABLE IF EXISTS `wp_users`;
-- NEXT_QUERY --
CREATE TABLE IF NOT EXISTS `wp_users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) NOT NULL DEFAULT '',
  `user_pass` varchar(64) NOT NULL DEFAULT '',
  `user_nicename` varchar(50) NOT NULL DEFAULT '',
  `user_email` varchar(100) NOT NULL DEFAULT '',
  `user_url` varchar(100) NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) NOT NULL DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `display_name` varchar(250) NOT NULL DEFAULT '',
  `user_role` int(3) NOT NULL DEFAULT '9' COMMENT 'Role Assignment for Users',
  `spam` tinyint(2) NOT NULL DEFAULT '0',
  `deleted` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- NEXT_QUERY --
-- Dumping data for table `wp_users`
--

INSERT INTO `wp_users` (`ID`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `display_name`, `user_role`, `spam`, `deleted`) VALUES
(1, '{admin_username}', '{admin_password_hash}', '{admin_realname}', '{email_notify}', '', '2013-05-19 23:41:31', '', 0, '{admin_realname}', 1, 0, 0),
(2, 'joseph', '{admin_password_hash}', 'joseph', 'joseph@example.com', '', '2013-05-20 05:09:21', '', 0, 'jo seph', 9, 0, 0);

-- NEXT_QUERY --
-- Dumping data for table `wp_sitemeta`
--
-- UPDATE  `charles`.`wp_sitemeta` SET  `meta_value` =  'a:1:{i:0;s:8:'{admin_username}';}' WHERE  `wp_sitemeta`.`meta_id` =8; * --