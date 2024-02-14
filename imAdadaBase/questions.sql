-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Feb 07, 2024 at 01:20 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `libary`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions_mk3`
--

CREATE TABLE `questions` (
  `question_id` int NOT NULL,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions_mk3`
--

INSERT INTO `questions` (`question_id`, `topic`, `question_text`) VALUES
(1, 'tech', 'What is the primary purpose of Docker?'),
(2, 'tech', 'What is the role of a load balancer in a web server infrastructure?'),
(3, 'tech', 'What is the purpose of version control systems?'),
(4, 'tech', 'What is the difference between HTTP and HTTPS?'),
(5, 'tech', 'What is the significance of the 404 HTTP status code?'),
(6, 'tech', 'What is the primary function of a firewall in network security?'),
(7, 'tech', 'What is the purpose of an API (Application Programming Interface)?'),
(8, 'tech', 'What is the role of an ORM (Object-Relational Mapping) in software development?'),
(9, 'tech', 'What does the acronym CDN stand for in the context of web development?'),
(10, 'tech', 'What is the primary purpose of a cache in computing?'),
(11, 'tech', 'What is the concept of \"scalability\" in the context of software architecture?'),
(12, 'tech', 'What is the significance of the 502 HTTP status code?'),
(13, 'tech', 'What is the main purpose of a Content Delivery Network (CDN) in web development?'),
(14, 'tech', 'In the context of programming languages, what does \"static typing\" refer to?'),
(15, 'tech', 'What is the role of a reverse proxy in a web server setup?'),
(16, 'tech', 'What does the acronym SQL stand for?'),
(17, 'tech', 'What is the purpose of Continuous Integration (CI) in software development?'),
(18, 'tech', 'What is the primary role of a router in a computer network?'),
(19, 'tech', 'What is the purpose of a NoSQL database?'),
(20, 'tech', 'What is the difference between Git and SVN (Subversion)?'),
(21, 'tech', 'What is the role of a package manager in software development?'),
(22, 'tech', 'What does the term \"Microservices\" refer to in software architecture?'),
(23, 'tech', 'In the context of cybersecurity, what is the purpose of a honeypot?'),
(24, 'tech', 'What is the role of a CDN in optimizing website performance?'),
(25, 'tech', 'What is the purpose of a JWT (JSON Web Token) in authentication?'),
(26, 'tech', 'What is the concept of \"Dependency Injection\" in software development?'),
(27, 'tech', 'What is the primary function of a CDN in the context of web security?'),
(28, 'tech', 'What is the significance of the 503 HTTP status code?'),
(29, 'tech', 'What is the purpose of the \"git clone\" command in Git?'),
(30, 'tech', 'What is the primary advantage of using a CDN for serving static assets in web development?'),
(31, 'tierwelt', 'Welches Säugetier ist für seine fliegenden Fähigkeiten bekannt?'),
(32, 'tierwelt', 'Welche Reptilienart ist dafür berühmt, ihre Beute durch Schlangenbewegungen zu fangen?'),
(33, 'tierwelt', 'Welches Meerestier ist für seine Fähigkeit bekannt, Tinte als Verteidigungsmechanismus freizusetzen?'),
(34, 'tierwelt', 'Welcher Vogel ist für sein imposantes Federkleid und seine Fähigkeit zum Fliegen in großen Höhen bekannt?'),
(35, 'tierwelt', 'Welche Art von Insekt ist für ihre sozialen Kolonien und Honigproduktion bekannt?'),
(36, 'tierwelt', 'Welches Säugetier ist für seine Streifen und seine Fähigkeit zum Sprinten bekannt?'),
(37, 'tierwelt', 'Welche amphibische Kreatur verbringt einen Teil ihres Lebens im Wasser und einen Teil an Land?'),
(38, 'tierwelt', 'Welches Raubtier ist für seine charakteristische Mähne bekannt?'),
(39, 'tierwelt', 'Welches Meereslebewesen ist für seine leuchtenden Eigenschaften bekannt?'),
(40, 'tierwelt', 'Welches Nagetier ist für seine Baufähigkeiten und Holzverarbeitung bekannt?'),
(41, 'tierwelt', 'Welches Tier ist für seine Fähigkeit zur Echolokation bekannt, um Beute zu orten?'),
(42, 'tierwelt', 'Welches Tier ist für seine Wanderungen über weite Strecken bekannt, insbesondere in der Serengeti?'),
(43, 'tierwelt', 'Welches Tier ist für seine Fähigkeit zum Farbwechsel bekannt und lebt in verschiedenen Meereshabitaten?'),
(44, 'tierwelt', 'Welche Art von Affe ist dafür bekannt, lange Arme und einen langen Schwanz zu haben?'),
(45, 'tierwelt', 'Welches Meeressäugetier ist dafür bekannt, in Gruppen, auch als \"Pods\", zu leben?'),
(46, 'ch-norris', 'How many push-ups can Chuck Norris do?'),
(47, 'ch-norris', 'What does Chuck Norris eat for breakfast?'),
(48, 'ch-norris', 'How does Chuck Norris celebrate his birthday?'),
(49, 'ch-norris', 'What happens when Chuck Norris enters a room?'),
(50, 'ch-norris', 'Why did Chuck Norris become an actor?'),
(51, 'ch-norris', 'How does Chuck Norris cut his hair?'),
(52, 'ch-norris', 'What does Chuck Norris do in his free time?'),
(53, 'ch-norris', 'What is Chuck Norris\'s favorite color?'),
(54, 'ch-norris', 'How does Chuck Norris win arguments?'),
(55, 'ch-norris', 'What is Chuck Norris\'s favorite hobby?'),
(56, 'ch-norris', 'How does Chuck Norris drink his coffee?'),
(57, 'ch-norris', 'What does Chuck Norris do before going to bed?'),
(58, 'ch-norris', 'How does Chuck Norris handle stress?'),
(59, 'ch-norris', 'What does Chuck Norris do when he\'s sick?'),
(60, 'ch-norris', 'What does Chuck Norris say to fear?'),
(61, 'history', 'In welchem Jahr wurde die Berliner Mauer errichtet?'),
(62, 'history', 'Wer war der erste Präsident der Vereinigten Staaten?'),
(63, 'history', 'Welches Jahr markiert das Ende des Zweiten Weltkriegs?'),
(64, 'history', 'Was war die Magna Carta?'),
(65, 'history', 'Wer war die Herrscherin des antiken Ägyptens und die letzte Pharaonin?'),
(66, 'history', 'In welchem Jahr wurde die Unabhängigkeit der Vereinigten Staaten erklärt?'),
(67, 'history', 'Was war die industrielle Revolution?'),
(68, 'history', 'Wer war der Architekt des Eiffelturms in Paris?'),
(69, 'history', 'Was war die Renaissance?'),
(70, 'history', 'Welches Ereignis führte zur Teilung Deutschlands nach dem Zweiten Weltkrieg?'),
(71, 'history', 'Wer war der Hauptanführer der amerikanischen Bürgerrechtsbewegung?'),
(72, 'history', 'In welchem Jahr endete der Kalte Krieg?'),
(73, 'history', 'Welche antike Stadt wurde durch einen Vulkanausbruch im Jahr 79 n.Chr. zerstört?'),
(74, 'history', 'Wer war der erste Mensch, der die Spitze des Mount Everest erreichte?'),
(75, 'tiere', 'Welches Tier trägt ein gestreiftes Pyjama?'),
(76, 'tiere', 'Welches Tier hat acht Arme oder Beine?'),
(77, 'tiere', 'Welche Hunderassen sind bekannt, für Ihre Schnelligkeit?'),
(78, 'tiere', 'Welche diese Tiere sind bekannt, für ihre lange Zunge?'),
(79, 'tiere', 'Welches Tiere vergraben Ihren Kod?'),
(80, 'tiere', 'Welche Tiere haben einen Rüssel?'),
(81, 'tiere', 'Was können Delphine nicht?'),
(82, 'tiere', 'Welche Tiere gehören zu den Insekten?'),
(83, 'tiere', 'Welche dieser Tiere haben einen langen Hals?'),
(84, 'tiere', 'Welches Tier kann seinen Schwanz abwerfen, um Feinde zu täuschen?'),
(85, 'tiere', 'Welches Tier legt Eier?'),
(86, 'tiere', 'Welches Tier hat einen giftigen Stachel?'),
(87, 'tiere', 'Welches Tier ist für seine Intelligenz bekannt?'),
(88, 'tiere', 'Welches Tier kann seinen Körper extrem verlängern?'),
(89, 'tiere', 'Welches Tier kann unter Wasser schlafen?'),
(90, 'tiere', 'Welches Tier ist für seine Kletterfähigkeiten bekannt?'),
(91, 'tiere', 'Welches Tier kann ultrasonic hören?'),
(92, 'tiere', 'Welches Tier hat einen spitzen Schnabel zum Aufspießen von Beute?'),
(93, 'tiere', 'Welches Tier hat ein sehr gutes Gedächtnis?'),
(94, 'tiere', 'Welches Tier kann rückwärts fliegen?'),
(95, 'werkzeuge', 'Welche Werkzeuge gibt es wirklich?'),
(96, 'werkzeuge', 'Welche Werkzeuge gibt es wirklich?'),
(97, 'werkzeuge', 'Welche Werkzeuge gibt es wirklich?'),
(98, 'werkzeuge', 'Welche Werkzeuge gibt es wirklich?'),
(99, 'werkzeuge', 'Welche Werkzeuge gibt es wirklich?'),
(100, 'werkzeuge', 'Welche Werkzeuge gibt es wirklich?'),
(101, 'werkzeuge', 'Welche Werkzeuge gibt es wirklich?'),
(102, 'werkzeuge', 'Welche Werkzeuge gibt es wirklich?'),
(103, 'werkzeuge', 'Welche Werkzeuge gibt es wirklich?'),
(104, 'werkzeuge', 'Welche Werkzeuge gibt es wirklich?'),
(105, 'werkzeuge', 'Welche Werkzeuge gibt es wirklich?'),
(106, 'werkzeuge', 'Welche Werkzeuge gibt es wirklich?'),
(107, 'werkzeuge', 'Welche Werkzeuge gibt es wirklich?'),
(108, 'werkzeuge', 'Welche Werkzeuge gibt es wirklich?'),
(109, 'werkzeuge', 'Welche Werkzeuge gibt es wirklich?'),
(110, 'werkzeuge', 'Welche Werkzeuge gibt es wirklich?'),
(111, 'werkzeuge', 'Welche Werkzeuge gibt es wirklich?'),
(112, 'werkzeuge', 'Welche Werkzeuge gibt es wirklich?'),
(113, 'werkzeuge', 'Welche Werkzeuge gibt es wirklich?'),
(114, 'werkzeuge', 'Welche Werkzeuge gibt es wirklich?'),
(115, 'cinema', 'Who invented camera?'),
(116, 'cinema', 'Who invented storytelling?'),
(117, 'cinema', 'Who played the lead role in the movie \"Zorba the Greek\"?\r\n'),
(118, 'cinema', 'Who directed the film \"Gone by the winds\"?\r\n'),
(119, 'cinema', 'What is the title of first book about analysis of storytelling?\r\n'),
(120, 'cinema', 'Which actor has a role in some of his own films?'),
(121, 'cinema', 'How many acts has a standard story?'),
(122, 'cinema', 'What is common between film and theater?'),
(123, 'cinema', 'Who is the author of Pride and Prejudice?'),
(124, 'cinema', 'What is the film  \"Enemy at the Gate\" about?'),
(125, 'cinema', 'What is act one in a story about?'),
(126, 'cinema', 'Which Film festival is the first historically?'),
(127, 'cinema', 'Who played the lead role in the movie \"Malena\"?\r\n'),
(128, 'cinema', 'Who directed the film \"A Time for Drunken Horses\"?\r\n'),
(129, 'cinema', 'Where was the stories of One Thousand and One Nights drawn?\r\n'),
(130, 'cinema', 'Who plays the lead role in Hiroshima my love?'),
(131, 'cinema', 'What are the main parts of post production?'),
(132, 'cinema', 'Which one is a film Genre?'),
(133, 'cinema', 'What does fiction means?'),
(134, 'cinema', 'What does a cinematographer do?'),
(135, 'geography', 'What is the capital of France?'),
(136, 'geography', 'Which ocean is the largest?'),
(137, 'geography', 'What is the tallest mountain in the world?'),
(138, 'geography', 'What is the longest river in the world?'),
(139, 'geography', 'Which country is known as the Land of the Rising Sun?'),
(140, 'geography', 'What is the smallest country in the world?'),
(141, 'geography', 'Which desert is the largest in the world?'),
(142, 'geography', 'What is the capital of Australia?'),
(143, 'geography', 'Which continent is the least populated?'),
(144, 'geography', 'Which river runs through Baghdad?'),
(145, 'geography', 'What is the largest country in South America?'),
(146, 'geography', 'What is the capital of Canada?'),
(147, 'geography', 'Which is the smallest ocean?'),
(148, 'geography', 'What is the driest desert in the world?'),
(149, 'geography', 'Which city is known as the City of Love?'),
(150, 'astronomy', 'What is the closest star to Earth?'),
(151, 'astronomy', 'What is the largest planet in our solar system?'),
(152, 'astronomy', 'What is the name of the galaxy containing the Earth?'),
(153, 'astronomy', 'What causes the phases of the moon?'),
(154, 'astronomy', 'What is a shooting star?'),
(155, 'astronomy', 'What is the brightest star in the night sky?'),
(156, 'astronomy', 'What is the name of the phenomenon when the moon completely blocks the sun?'),
(157, 'astronomy', 'What is the name of the point in space where gravity pulls so much that even light cannot escape?'),
(158, 'astronomy', 'What is the study of celestial bodies beyond Earth\'s atmosphere called?'),
(159, 'astronomy', 'Which planet is known as the Red Planet?'),
(160, 'astronomy', 'What is the name of the closest galaxy to the Milky Way?'),
(161, 'astronomy', 'What is the hottest planet in our solar system?'),
(162, 'astronomy', 'What is the process of a star dying called?'),
(163, 'astronomy', 'What is the name of the force that pulls objects towards each other?'),
(164, 'astronomy', 'What are the two types of planets in our solar system?'),
(165, 'animals', 'Which animal has the biggest heart in the world?'),
(166, 'animals', 'Which is the fastest animal in the world?'),
(167, 'animals', 'Which animal lives the longest on earth?'),
(168, 'animals', 'Which of the following animal is not a mammal?'),
(169, 'animals', 'Which fish needs to come up for air?'),
(170, 'animals', 'which animal can only be found in Australia?'),
(171, 'animals', 'Which animal has the longest gestation period?'),
(172, 'animals', 'how long can camel stay without water?'),
(173, 'animals', 'which animal does not belong to the cold-blooded animals?'),
(174, 'animals', 'How long can crocodile go without food?');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions_mk3`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions_mk3`
--
ALTER TABLE `questions`
  MODIFY `question_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
