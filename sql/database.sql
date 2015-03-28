--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `survival_guide_categories` (
  `idCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `code_section` varchar(20) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1;


--
-- Table structure for table `relation`
--

CREATE TABLE IF NOT EXISTS `survival_guide_relation` (
  `idCategorie` int(11) NOT NULL,
  `partie` int(11) NOT NULL,
  `chapitre` int(11) NOT NULL,
  `position` float NOT NULL,
  UNIQUE KEY `idCategorie` (`idCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Contraintes pour la table `relation`
--
ALTER TABLE `survival_guide_relation`
  ADD CONSTRAINT `survival_guide_relation_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `survival_guide_categories` (`idCategorie`);

--
-- Table structure for table `survival_guide_regids`
--

CREATE TABLE IF NOT EXISTS `survival_guide_pushes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(200) NOT NULL,
  `message` varchar(255) NOT NULL,
  `code_section` varchar(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 ;

-- --------------------------------------------------------

--
-- Table structure for table `regids`
--

CREATE TABLE IF NOT EXISTS `survival_guide_regids` (
  `regid` varchar(255) NOT NULL,
  `code_section` varchar(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`regid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
