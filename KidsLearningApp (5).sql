-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 24, 2024 at 04:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `KidsLearningApp`
--

-- --------------------------------------------------------

--
-- Table structure for table `DetailCategory`
--

CREATE TABLE `DetailCategory` (
  `id` int(11) NOT NULL,
  `imageurl` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `DetailCategory`
--

INSERT INTO `DetailCategory` (`id`, `imageurl`, `category_id`) VALUES
(1, 'https://i.pinimg.com/originals/36/56/37/3656370154485ab8bddf4d8b5d181367.jpg', 1),
(2, 'https://i.pinimg.com/originals/f6/cb/f7/f6cbf7a32a848f951b95eb6a758c493d.jpg', 1),
(3, 'https://i.pinimg.com/originals/cb/e2/17/cbe21701f990489a3b276ef8dfc236d4.jpg', 1),
(4, 'https://i.pinimg.com/originals/4b/0c/4d/4b0c4dca973aa94853ad981aa707e231.jpg', 1),
(5, 'https://i.pinimg.com/originals/9b/92/ce/9b92ce437ee798f075a54c26c66debc8.jpg', 1),
(6, 'https://i.pinimg.com/originals/02/39/6f/02396f428896f8af1e4a81af043ff0e5.jpg', 1),
(7, 'https://i.pinimg.com/originals/66/0c/c9/660cc9ae6cdcd6ed5e796d65ba50425c.jpg', 1),
(8, 'https://i.pinimg.com/originals/1d/48/4e/1d484eae7d94b35e817e3b17f269a3e9.jpg', 1),
(9, 'https://i.pinimg.com/originals/0b/7a/8a/0b7a8a2fe5909dbfcfd433608383f356.jpg', 1),
(10, 'https://i.pinimg.com/originals/d9/ca/9c/d9ca9c4c02daf62e3d2d8a5450e38eec.jpg', 1),
(11, 'https://i.pinimg.com/originals/c1/69/78/c1697863b1a720b5a0f2e849e2abdd02.jpg', 1),
(12, 'https://i.pinimg.com/originals/22/0e/ca/220ecae21eacab4c8c1616107a5dfee4.jpg', 1),
(13, 'https://i.pinimg.com/originals/da/44/b8/da44b8d20a5079f9ed89dffc5cd1d21e.jpg', 1),
(14, 'https://previews.123rf.com/images/lenm/lenm1206/lenm120600074/13898687-Illustration-Featuring-the-Letter-N-Stock-Illustration-letter-cartoon-alphabet.jpg', 1),
(15, 'https://i.pinimg.com/originals/32/ad/1a/32ad1a74e826946c48eec8c6c768b991.jpg', 1),
(16, 'https://i.pinimg.com/originals/34/a1/c4/34a1c4132897ee79dc71fc0b1ee5624f.jpg', 1),
(17, 'https://i.pinimg.com/originals/f8/6d/7e/f86d7eff81c433afa4b3833faa258c31.jpg', 1),
(18, 'https://i.pinimg.com/originals/60/18/3a/60183a3c5593b69229759d227cfc54c6.jpg', 1),
(19, 'https://i.pinimg.com/originals/5a/dd/be/5addbeb51c07e26b0903a3c9648b3bdc.jpg', 1),
(20, 'https://i.pinimg.com/originals/94/25/9f/94259f4f6f46a48a7fc3081ce1111716.jpg', 1),
(21, 'https://i.pinimg.com/originals/ee/99/10/ee9910a1346afdf0697d4417be5bb71d.jpg', 1),
(22, 'https://i.pinimg.com/originals/8d/ec/42/8dec429ff6aeede3482df0851c265ec9.jpg', 1),
(23, 'https://i.pinimg.com/originals/68/46/86/684686e05c94902a7566fc6a252488c4.jpg', 1),
(24, 'https://i.pinimg.com/originals/3d/17/6a/3d176a8f08883eb64815b327bbfc0a64.png', 1),
(25, 'https://i.pinimg.com/originals/90/09/33/900933ba301d852343c00b66e9f65feb.jpg', 1),
(26, 'https://i.pinimg.com/originals/75/84/c1/7584c1c3fe40d2072592d047001c7a5f.jpg', 1),
(27, 'https://i.pinimg.com/originals/8f/98/d0/8f98d0ae40d25dffad7f79878c9fd21e.jpg', 2),
(28, 'https://i.pinimg.com/originals/dd/04/ef/dd04efabc94cb02c07214d40ee74a379.jpg', 2),
(29, 'https://i.pinimg.com/originals/11/31/69/1131699d49c227dc55e47665a5870b81.jpg', 2),
(30, 'https://i.pinimg.com/originals/e8/0d/c8/e80dc8ca273724cf178f64de7f88e51d.jpg', 2),
(31, 'https://i.pinimg.com/originals/2e/0f/91/2e0f910a24349af099e2500526644026.jpg', 2),
(32, 'https://i.pinimg.com/originals/33/f3/f9/33f3f957ca0ed82321de676293dfeea1.jpg', 2),
(33, 'https://i.pinimg.com/originals/35/48/83/354883d33922da00464d82c19b517a37.jpg', 2),
(34, 'https://i.pinimg.com/originals/b5/74/ed/b574edf0665c4bef8b891adefd35e932.jpg', 2),
(35, 'https://i.pinimg.com/originals/78/34/98/783498359acb97aaa92c0988688b5109.jpg', 2),
(36, 'https://i.pinimg.com/originals/3a/09/29/3a0929431b2824aa108e38ddb923cd15.jpg', 2),
(37, 'https://i.pinimg.com/originals/f3/11/bd/f311bd598e59d4ec44f647f71a9cb7a3.jpg', 2),
(38, 'https://i.pinimg.com/originals/3b/e8/13/3be813f88238d915180184966e1d907b.jpg', 2),
(39, 'https://i.pinimg.com/originals/e5/f0/95/e5f095e46610aeb4b2a83d505bae7a1c.jpg', 2),
(40, 'https://i.pinimg.com/originals/83/78/09/837809763a1614d11f2a642328ef4a8d.jpg', 2),
(41, 'https://i.pinimg.com/originals/56/ca/d2/56cad2c266f4a6864319605a63099f9c.jpg', 2),
(42, 'https://i.pinimg.com/originals/f7/8e/9d/f78e9d858b7d623189b5c92069e1bed6.jpg', 2),
(43, 'https://i.pinimg.com/originals/4c/ec/e3/4cece355ef2d44dbe7c2f6a4a234d41c.jpg', 2),
(44, 'https://i.pinimg.com/originals/94/1e/ca/941eca2038794392f5068e4ad4c26968.jpg', 2),
(45, 'https://i.pinimg.com/originals/9c/03/87/9c038793a64a72a2a818e7866e7074d2.jpg', 2),
(46, 'https://i.pinimg.com/originals/e6/12/96/e6129621d08c4d9d1d4ea409c25da4d0.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `LearningCategory`
--

CREATE TABLE `LearningCategory` (
  `id` int(11) NOT NULL,
  `type` enum('Alphabets','Numbers','Flowers','Month','Week','Colors','Shapes','Birds','Emotions','Weather','Fruits') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `LearningCategory`
--

INSERT INTO `LearningCategory` (`id`, `type`) VALUES
(1, 'Alphabets'),
(2, 'Numbers'),
(3, 'Flowers'),
(4, 'Month'),
(5, 'Week'),
(6, 'Colors'),
(7, 'Shapes'),
(8, 'Birds'),
(9, 'Emotions'),
(10, 'Weather'),
(11, 'Fruits');

-- --------------------------------------------------------

--
-- Table structure for table `performance`
--

CREATE TABLE `performance` (
  `id` int(11) NOT NULL,
  `user_id` int(50) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `time_spent` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `progress` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `QuizAnswer`
--

CREATE TABLE `QuizAnswer` (
  `id` int(11) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer_text` text NOT NULL,
  `is_correct` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `QuizAnswer`
--

INSERT INTO `QuizAnswer` (`id`, `question_id`, `answer_text`, `is_correct`) VALUES
(1, 1, 'B', 1),
(2, 1, 'C', 0),
(3, 1, 'D', 0),
(4, 1, 'E', 0),
(5, 2, 'A', 1),
(6, 2, 'B', 0),
(7, 2, 'C', 0),
(8, 2, 'D', 0),
(9, 3, 'D', 1),
(10, 3, 'C', 0),
(11, 3, 'E', 0),
(12, 3, 'F', 0),
(13, 4, 'C', 1),
(14, 4, 'B', 0),
(15, 4, 'D', 0),
(16, 4, 'E', 0),
(17, 5, 'H', 1),
(18, 5, 'I', 0),
(19, 5, 'G', 0),
(20, 5, 'F', 0);

-- --------------------------------------------------------

--
-- Table structure for table `QuizQuestions`
--

CREATE TABLE `QuizQuestions` (
  `id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `QuizQuestions`
--

INSERT INTO `QuizQuestions` (`id`, `question_text`, `category_id`) VALUES
(1, 'Which letter comes after A?', 1),
(2, 'What is the first letter of the alphabet?', 1),
(3, 'Which letter is between C and E?', 1),
(4, 'What letter is represented by the third position in the alphabet?', 1),
(5, 'Which letter follows the letter G?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `phone_number`, `password`, `address`, `username`) VALUES
(18, 'Smriti', 'Khadka', 'smriti@gmail.com', '9756890988', '$2y$10$pegW7gURKnOKVZwQV57Jse48uUIvLhs.5u.rKM8/U8s4imyzNQLMm', 'bagmati', 'smriti'),
(19, 'Smriti', 'Khadka', 'smrit1i@gmail.com', '9756890988', '$2y$10$dW6ybMcjgA5HaCYzQVhsVeAl1VnNcZHG7hN2B2TGebLcwwZtTJx2S', 'bagmati', 'smriti'),
(21, 'smriti', 'koirala', 'smriti4@gmail.com', '9867546748', '$2y$10$Sq7UiAoS7iJdDtxj7bhGyuG5UaloVivdvDgl.fvx5ecysDSQHDBHy', 'bagmati', 'smriti'),
(22, 'roshne', 'koirala', 'roshne@gmail.com', '9876543128', '$2y$10$.KGzVYNflnaXAeAHiXh5Uu.8j63UklAH3JMhHbPIfHIYAm1vUIbbe', 'koteshwor', 'roshne'),
(24, 'Jyoti', 'Jyoti', 'jyoti@gmail.com', '987654647', '$2y$10$bl6f9VaGaKrTwy2S3lnW5eO471J7mGgQHm1tb2pLmQ22pa.5cmdsa', 'ktm', 'jyoti');

-- --------------------------------------------------------

--
-- Table structure for table `VideoCategory`
--

CREATE TABLE `VideoCategory` (
  `id` int(11) NOT NULL,
  `type` enum('Alphabets','Numbers','Weeks','Weather','Education') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `VideoCategory`
--

INSERT INTO `VideoCategory` (`id`, `type`) VALUES
(1, 'Alphabets'),
(2, 'Numbers'),
(3, 'Weeks'),
(4, 'Weather');

-- --------------------------------------------------------

--
-- Table structure for table `VideoDetail`
--

CREATE TABLE `VideoDetail` (
  `id` int(11) NOT NULL,
  `video_url` varchar(255) NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `VideoDetail`
--

INSERT INTO `VideoDetail` (`id`, `video_url`, `title`, `image_url`, `category_id`) VALUES
(1, 'https://youtu.be/HZmfFYwvnns', 'Learn Alphabets', 'https://i.pinimg.com/originals/16/7c/d5/167cd520e95e853bab50ad2fff843404.png', 1),
(2, 'https://youtu.be/DR-cfDsHCGA?si=PuCZLMpNRdJhWUCA', 'counting number', 'https://i.pinimg.com/originals/cd/9f/d2/cd9fd213dc922e6d5bf860b789113063.jpg', 2),
(3, 'https://youtu.be/FnSm9kCSNx4?si=v-Lhdl_TCatYQNPi', 'Couting apple', '/Users/roshneekoirala/Desktop/alphabet/a.png', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `DetailCategory`
--
ALTER TABLE `DetailCategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `LearningCategory`
--
ALTER TABLE `LearningCategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `performance`
--
ALTER TABLE `performance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `QuizAnswer`
--
ALTER TABLE `QuizAnswer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `QuizQuestions`
--
ALTER TABLE `QuizQuestions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `VideoCategory`
--
ALTER TABLE `VideoCategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `VideoDetail`
--
ALTER TABLE `VideoDetail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `DetailCategory`
--
ALTER TABLE `DetailCategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `LearningCategory`
--
ALTER TABLE `LearningCategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `performance`
--
ALTER TABLE `performance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `QuizAnswer`
--
ALTER TABLE `QuizAnswer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `QuizQuestions`
--
ALTER TABLE `QuizQuestions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `VideoCategory`
--
ALTER TABLE `VideoCategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `DetailCategory`
--
ALTER TABLE `DetailCategory`
  ADD CONSTRAINT `detailcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `LearningCategory` (`id`);

--
-- Constraints for table `performance`
--
ALTER TABLE `performance`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `QuizAnswer`
--
ALTER TABLE `QuizAnswer`
  ADD CONSTRAINT `quizanswer_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `QuizQuestions` (`id`);

--
-- Constraints for table `QuizQuestions`
--
ALTER TABLE `QuizQuestions`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `LearningCategory` (`id`);

--
-- Constraints for table `VideoDetail`
--
ALTER TABLE `VideoDetail`
  ADD CONSTRAINT `videodetail_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `VideoCategory` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
