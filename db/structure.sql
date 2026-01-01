-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               11.8.3-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.13.0.7147
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table werkgroep2025.Log
CREATE TABLE IF NOT EXISTS `Log` (
                                     `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                     `userId` int(10) unsigned NOT NULL,
                                     `action` varchar(255) NOT NULL,
                                     `data` text NOT NULL,
                                     `datetime` datetime NOT NULL,
                                     PRIMARY KEY (`id`),
                                     KEY `FK__User` (`userId`),
                                     CONSTRAINT `FK__User` FOREIGN KEY (`userId`) REFERENCES `User` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table werkgroep2025.QuizAnswer
CREATE TABLE IF NOT EXISTS `QuizAnswer` (
                                            `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                            `questionId` int(10) unsigned NOT NULL,
                                            `position` int(10) unsigned NOT NULL,
                                            `text` varchar(255) NOT NULL,
                                            `isCorrect` tinyint(1) unsigned NOT NULL DEFAULT 0,
                                            `isSpongebob` tinyint(1) unsigned NOT NULL DEFAULT 0,
                                            PRIMARY KEY (`id`),
                                            KEY `FK_QuizAnswer_QuizQuestion` (`questionId`),
                                            CONSTRAINT `FK_QuizAnswer_QuizQuestion` FOREIGN KEY (`questionId`) REFERENCES `QuizQuestion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1421 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table werkgroep2025.QuizQuestion
CREATE TABLE IF NOT EXISTS `QuizQuestion` (
                                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                              `nr` int(10) unsigned NOT NULL,
                                              `title` varchar(255) NOT NULL DEFAULT '0',
                                              PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=302 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table werkgroep2025.QuizResponse
CREATE TABLE IF NOT EXISTS `QuizResponse` (
                                              `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                              `userId` int(10) unsigned NOT NULL,
                                              `datetime` datetime NOT NULL,
                                              PRIMARY KEY (`id`),
                                              KEY `userId` (`userId`) USING BTREE,
                                              CONSTRAINT `FK_QuizResponse_User` FOREIGN KEY (`userId`) REFERENCES `User` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table werkgroep2025.QuizResponseAnswer
CREATE TABLE IF NOT EXISTS `QuizResponseAnswer` (
                                                    `quizResponseId` int(10) unsigned NOT NULL,
                                                    `quizQuestionId` int(10) unsigned NOT NULL,
                                                    `quizAnswerId` int(10) unsigned NOT NULL,
                                                    `isCorrect` tinyint(1) unsigned NOT NULL,
                                                    `isSpongebob` tinyint(1) unsigned NOT NULL,
                                                    PRIMARY KEY (`quizResponseId`,`quizQuestionId`),
                                                    KEY `FK__QuizQuestion` (`quizQuestionId`),
                                                    KEY `FK__QuizAnswer` (`quizAnswerId`),
                                                    CONSTRAINT `FK__QuizAnswer` FOREIGN KEY (`quizAnswerId`) REFERENCES `QuizAnswer` (`id`) ON UPDATE CASCADE,
                                                    CONSTRAINT `FK__QuizQuestion` FOREIGN KEY (`quizQuestionId`) REFERENCES `QuizQuestion` (`id`) ON UPDATE CASCADE,
                                                    CONSTRAINT `FK__QuizResponse` FOREIGN KEY (`quizResponseId`) REFERENCES `QuizResponse` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table werkgroep2025.User
CREATE TABLE IF NOT EXISTS `User` (
                                      `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                                      `username` varchar(50) NOT NULL,
                                      `passwordHash` varchar(255) NOT NULL,
                                      `currentPuzzle` varchar(50) NOT NULL DEFAULT '1',
                                      `puzzle2Pdf` varchar(255) DEFAULT NULL,
                                      `puzzle3Question` varchar(255) DEFAULT NULL,
                                      `puzzle3Answer` varchar(255) DEFAULT NULL,
                                      `puzzle3Result` varchar(255) DEFAULT NULL,
                                      PRIMARY KEY (`id`),
                                      UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
