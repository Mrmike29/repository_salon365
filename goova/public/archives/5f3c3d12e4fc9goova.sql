CREATE Database goova;

use goova;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2020 at 04:43 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `goova`
--

-- --------------------------------------------------------

--
-- Table structure for table `archives_content_foro`
--

CREATE TABLE `archives_content_foro` (
  `id` int(11) NOT NULL,
  `id_content_foro` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `archives_homework_course`
--

CREATE TABLE `archives_homework_course` (
  `id` int(11) NOT NULL,
  `id_homework_course` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `arcvives_homework`
--

CREATE TABLE `arcvives_homework` (
  `id` int(11) NOT NULL,
  `id_homework` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `primary_color` varchar(15) NOT NULL,
  `secundary_color` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `content_foro`
--

CREATE TABLE `content_foro` (
  `id` int(11) NOT NULL,
  `id_foro` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `id_list_students` int(11) NOT NULL,
  `id_subjects` int(11) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `entity`
--

CREATE TABLE `entity` (
  `id` int(11) NOT NULL,
  `id_type_document` int(11) NOT NULL,
  `id_color` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `document` varchar(20) NOT NULL,
  `image` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `id_rubrics` int(11) NOT NULL,
  `id_theme_time` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `exam_list`
--

CREATE TABLE `exam_list` (
  `id` int(11) NOT NULL,
  `id_exam` int(11) NOT NULL,
  `id_parcial_notes` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `final_note`
--

CREATE TABLE `final_note` (
  `id` int(11) NOT NULL,
  `id_year_final_report` int(11) NOT NULL,
  `value` decimal(3,0) NOT NULL,
  `id_student` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `foro`
--

CREATE TABLE `foro` (
  `id` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `description` text NOT NULL,
  `date_end` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `id` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `id_rubrics` int(11) NOT NULL,
  `id_theme_time` int(11) NOT NULL,
  `limit_time` datetime DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `homework_course`
--

CREATE TABLE `homework_course` (
  `id` int(11) NOT NULL,
  `id_homework` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `homework_list`
--

CREATE TABLE `homework_list` (
  `id` int(11) NOT NULL,
  `id_homework` int(11) NOT NULL,
  `id_parcial_notes` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `important_dates`
--

CREATE TABLE `important_dates` (
  `id` int(11) NOT NULL,
  `id_entity` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `list_students`
--

CREATE TABLE `list_students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `type_message` tinyint(1) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message_multiple`
--

CREATE TABLE `message_multiple` (
  `id` int(11) NOT NULL,
  `id_message` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `parcial_notes`
--

CREATE TABLE `parcial_notes` (
  `id` int(11) NOT NULL,
  `id_final_note` int(11) NOT NULL,
  `id_period_final_report` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` decimal(3,0) NOT NULL,
  `observation` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `period_final_report`
--

CREATE TABLE `period_final_report` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `observation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `id_exam` int(11) NOT NULL,
  `id_type_question` int(11) NOT NULL,
  `description` text NOT NULL,
  `answer` text NOT NULL,
  `max_answer` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `question_multiple`
--

CREATE TABLE `question_multiple` (
  `id` int(11) NOT NULL,
  `id_question` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Super Administrador', '2020-08-04 14:20:08', '2020-08-04 14:19:15'),
(2, 'Administrador', '2020-08-04 14:20:11', '2020-08-04 14:19:15'),
(3, 'Secretaría', '2020-08-04 14:20:14', '2020-08-04 14:19:15'),
(4, 'Profesor', '2020-08-04 14:20:16', '2020-08-04 14:19:15'),
(5, 'Estudiante', '2020-08-04 14:20:18', '2020-08-04 14:19:15'),
(6, 'Padres', '2020-08-04 14:20:21', '2020-08-04 14:19:15');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `id_list_students` int(11) NOT NULL,
  `id_subject` int(11) NOT NULL,
  `id_video_chat` int(11) NOT NULL,
  `description` text NOT NULL,
  `time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rubrics`
--

CREATE TABLE `rubrics` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `score` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rubrics_range`
--

CREATE TABLE `rubrics_range` (
  `id` int(11) NOT NULL,
  `id_rubrics` int(11) NOT NULL,
  `range` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `themes_time`
--

CREATE TABLE `themes_time` (
  `id` int(11) NOT NULL,
  `id_subject` int(11) NOT NULL,
  `id_curse` int(11) NOT NULL,
  `id_time` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `times`
--

CREATE TABLE `times` (
  `id` int(11) NOT NULL,
  `id_entity` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `type_document`
--

CREATE TABLE `type_document` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_id` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type_document`
--

INSERT INTO `type_document` (`id`, `name`, `created_id`, `updated_at`) VALUES
(1, 'Cedula de Ciudadanía', '2020-08-04 14:30:27', '2020-08-04 14:30:27'),
(2, 'Tarjeta de Identidad', '2020-08-04 14:30:27', '2020-08-04 14:30:27'),
(3, 'Cédula de Extranjenría', '2020-08-04 14:30:27', '2020-08-04 14:30:27'),
(4, 'Pasaporte', '2020-08-04 14:30:27', '2020-08-04 14:30:27'),
(5, 'NIT', '2020-08-04 14:30:27', '2020-08-04 14:30:27');

-- --------------------------------------------------------

--
-- Table structure for table `type_question`
--

CREATE TABLE `type_question` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type_question`
--

INSERT INTO `type_question` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Multiples Opciones', '2020-08-04 14:42:53', '2020-08-04 14:42:53'),
(2, 'Única Respuesta', '2020-08-04 14:42:53', '2020-08-04 14:42:53'),
(3, 'Pregunta Abierta', '2020-08-04 14:42:53', '2020-08-04 14:42:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_type_document` int(11) NOT NULL,
  `id_info_entity` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `document` int(15) NOT NULL,
  `phone` int(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users_list_students`
--

CREATE TABLE `users_list_students` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_list_students` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `video_chat`
--

CREATE TABLE `video_chat` (
  `id` int(11) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `code` text NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `time_stop` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `year_final_report`
--

CREATE TABLE `year_final_report` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `observation` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archives_content_foro`
--
ALTER TABLE `archives_content_foro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `archives_content_foro_fk0` (`id_content_foro`);

--
-- Indexes for table `archives_homework_course`
--
ALTER TABLE `archives_homework_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `archives_homework_course_fk0` (`id_homework_course`);

--
-- Indexes for table `arcvives_homework`
--
ALTER TABLE `arcvives_homework`
  ADD PRIMARY KEY (`id`),
  ADD KEY `arcvives_homework_fk0` (`id_homework`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_foro`
--
ALTER TABLE `content_foro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_foro_fk0` (`id_foro`),
  ADD KEY `content_foro_fk1` (`id_user`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_fk0` (`id_list_students`),
  ADD KEY `course_fk1` (`id_subjects`),
  ADD KEY `course_fk2` (`id_teacher`);

--
-- Indexes for table `entity`
--
ALTER TABLE `entity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entity_fk0` (`id_type_document`),
  ADD KEY `entity_fk1` (`id_color`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_fk0` (`id_course`),
  ADD KEY `exam_fk1` (`id_rubrics`),
  ADD KEY `exam_fk2` (`id_theme_time`);

--
-- Indexes for table `exam_list`
--
ALTER TABLE `exam_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_list_fk0` (`id_exam`),
  ADD KEY `exam_list_fk1` (`id_parcial_notes`);

--
-- Indexes for table `final_note`
--
ALTER TABLE `final_note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `final_note_fk0` (`id_year_final_report`),
  ADD KEY `final_note_fk1` (`id_student`);

--
-- Indexes for table `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foro_fk0` (`id_course`);

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`),
  ADD KEY `homework_fk0` (`id_course`),
  ADD KEY `homework_fk1` (`id_rubrics`),
  ADD KEY `homework_fk2` (`id_theme_time`);

--
-- Indexes for table `homework_course`
--
ALTER TABLE `homework_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `homework_course_fk0` (`id_homework`),
  ADD KEY `homework_course_fk1` (`id_course`),
  ADD KEY `homework_course_fk2` (`id_student`);

--
-- Indexes for table `homework_list`
--
ALTER TABLE `homework_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `homework_list_fk0` (`id_homework`),
  ADD KEY `homework_list_fk1` (`id_parcial_notes`);

--
-- Indexes for table `important_dates`
--
ALTER TABLE `important_dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `important_dates_fk0` (`id_entity`);

--
-- Indexes for table `list_students`
--
ALTER TABLE `list_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_fk0` (`id_user`);

--
-- Indexes for table `message_multiple`
--
ALTER TABLE `message_multiple`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_multiple_fk0` (`id_message`),
  ADD KEY `message_multiple_fk1` (`id_user`);

--
-- Indexes for table `parcial_notes`
--
ALTER TABLE `parcial_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parcial_notes_fk0` (`id_final_note`),
  ADD KEY `parcial_notes_fk1` (`id_period_final_report`);

--
-- Indexes for table `period_final_report`
--
ALTER TABLE `period_final_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_fk0` (`id_exam`),
  ADD KEY `questions_fk1` (`id_type_question`);

--
-- Indexes for table `question_multiple`
--
ALTER TABLE `question_multiple`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_multiple_fk0` (`id_question`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_fk0` (`id_teacher`),
  ADD KEY `room_fk1` (`id_list_students`),
  ADD KEY `room_fk2` (`id_subject`),
  ADD KEY `room_fk3` (`id_video_chat`);

--
-- Indexes for table `rubrics`
--
ALTER TABLE `rubrics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rubrics_range`
--
ALTER TABLE `rubrics_range`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rubrics_range_fk0` (`id_rubrics`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes_time`
--
ALTER TABLE `themes_time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `themes_time_fk0` (`id_subject`),
  ADD KEY `themes_time_fk1` (`id_curse`),
  ADD KEY `themes_time_fk2` (`id_time`);

--
-- Indexes for table `times`
--
ALTER TABLE `times`
  ADD PRIMARY KEY (`id`),
  ADD KEY `times_fk0` (`id_entity`);

--
-- Indexes for table `type_document`
--
ALTER TABLE `type_document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_question`
--
ALTER TABLE `type_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_fk0` (`id_rol`),
  ADD KEY `users_fk1` (`id_type_document`),
  ADD KEY `users_fk2` (`id_info_entity`);

--
-- Indexes for table `users_list_students`
--
ALTER TABLE `users_list_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_list_students_fk0` (`id_users`),
  ADD KEY `users_list_students_fk1` (`id_list_students`);

--
-- Indexes for table `video_chat`
--
ALTER TABLE `video_chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_chat_fk0` (`id_teacher`);

--
-- Indexes for table `year_final_report`
--
ALTER TABLE `year_final_report`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archives_content_foro`
--
ALTER TABLE `archives_content_foro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `archives_homework_course`
--
ALTER TABLE `archives_homework_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `arcvives_homework`
--
ALTER TABLE `arcvives_homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `content_foro`
--
ALTER TABLE `content_foro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entity`
--
ALTER TABLE `entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exam_list`
--
ALTER TABLE `exam_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `final_note`
--
ALTER TABLE `final_note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foro`
--
ALTER TABLE `foro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homework_course`
--
ALTER TABLE `homework_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homework_list`
--
ALTER TABLE `homework_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `important_dates`
--
ALTER TABLE `important_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `list_students`
--
ALTER TABLE `list_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message_multiple`
--
ALTER TABLE `message_multiple`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parcial_notes`
--
ALTER TABLE `parcial_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `period_final_report`
--
ALTER TABLE `period_final_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_multiple`
--
ALTER TABLE `question_multiple`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rubrics`
--
ALTER TABLE `rubrics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rubrics_range`
--
ALTER TABLE `rubrics_range`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `themes_time`
--
ALTER TABLE `themes_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `times`
--
ALTER TABLE `times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_document`
--
ALTER TABLE `type_document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `type_question`
--
ALTER TABLE `type_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_list_students`
--
ALTER TABLE `users_list_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `video_chat`
--
ALTER TABLE `video_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `year_final_report`
--
ALTER TABLE `year_final_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `archives_content_foro`
--
ALTER TABLE `archives_content_foro`
  ADD CONSTRAINT `archives_content_foro_fk0` FOREIGN KEY (`id_content_foro`) REFERENCES `content_foro` (`id`);

--
-- Constraints for table `archives_homework_course`
--
ALTER TABLE `archives_homework_course`
  ADD CONSTRAINT `archives_homework_course_fk0` FOREIGN KEY (`id_homework_course`) REFERENCES `homework_course` (`id`);

--
-- Constraints for table `arcvives_homework`
--
ALTER TABLE `arcvives_homework`
  ADD CONSTRAINT `arcvives_homework_fk0` FOREIGN KEY (`id_homework`) REFERENCES `homework` (`id`);

--
-- Constraints for table `content_foro`
--
ALTER TABLE `content_foro`
  ADD CONSTRAINT `content_foro_fk0` FOREIGN KEY (`id_foro`) REFERENCES `foro` (`id`),
  ADD CONSTRAINT `content_foro_fk1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_fk0` FOREIGN KEY (`id_list_students`) REFERENCES `list_students` (`id`),
  ADD CONSTRAINT `course_fk1` FOREIGN KEY (`id_subjects`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `course_fk2` FOREIGN KEY (`id_teacher`) REFERENCES `users` (`id`);

--
-- Constraints for table `entity`
--
ALTER TABLE `entity`
  ADD CONSTRAINT `entity_fk0` FOREIGN KEY (`id_type_document`) REFERENCES `type_document` (`id`),
  ADD CONSTRAINT `entity_fk1` FOREIGN KEY (`id_color`) REFERENCES `color` (`id`);

--
-- Constraints for table `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_fk0` FOREIGN KEY (`id_course`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `exam_fk1` FOREIGN KEY (`id_rubrics`) REFERENCES `rubrics` (`id`),
  ADD CONSTRAINT `exam_fk2` FOREIGN KEY (`id_theme_time`) REFERENCES `themes_time` (`id`);

--
-- Constraints for table `exam_list`
--
ALTER TABLE `exam_list`
  ADD CONSTRAINT `exam_list_fk0` FOREIGN KEY (`id_exam`) REFERENCES `exam` (`id`),
  ADD CONSTRAINT `exam_list_fk1` FOREIGN KEY (`id_parcial_notes`) REFERENCES `parcial_notes` (`id`);

--
-- Constraints for table `final_note`
--
ALTER TABLE `final_note`
  ADD CONSTRAINT `final_note_fk0` FOREIGN KEY (`id_year_final_report`) REFERENCES `year_final_report` (`id`),
  ADD CONSTRAINT `final_note_fk1` FOREIGN KEY (`id_student`) REFERENCES `users` (`id`);

--
-- Constraints for table `foro`
--
ALTER TABLE `foro`
  ADD CONSTRAINT `foro_fk0` FOREIGN KEY (`id_course`) REFERENCES `course` (`id`);

--
-- Constraints for table `homework`
--
ALTER TABLE `homework`
  ADD CONSTRAINT `homework_fk0` FOREIGN KEY (`id_course`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `homework_fk1` FOREIGN KEY (`id_rubrics`) REFERENCES `rubrics` (`id`),
  ADD CONSTRAINT `homework_fk2` FOREIGN KEY (`id_theme_time`) REFERENCES `themes_time` (`id`);

--
-- Constraints for table `homework_course`
--
ALTER TABLE `homework_course`
  ADD CONSTRAINT `homework_course_fk0` FOREIGN KEY (`id_homework`) REFERENCES `homework` (`id`),
  ADD CONSTRAINT `homework_course_fk1` FOREIGN KEY (`id_course`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `homework_course_fk2` FOREIGN KEY (`id_student`) REFERENCES `users` (`id`);

--
-- Constraints for table `homework_list`
--
ALTER TABLE `homework_list`
  ADD CONSTRAINT `homework_list_fk0` FOREIGN KEY (`id_homework`) REFERENCES `homework` (`id`),
  ADD CONSTRAINT `homework_list_fk1` FOREIGN KEY (`id_parcial_notes`) REFERENCES `parcial_notes` (`id`);

--
-- Constraints for table `important_dates`
--
ALTER TABLE `important_dates`
  ADD CONSTRAINT `important_dates_fk0` FOREIGN KEY (`id_entity`) REFERENCES `entity` (`id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_fk0` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `message_multiple`
--
ALTER TABLE `message_multiple`
  ADD CONSTRAINT `message_multiple_fk0` FOREIGN KEY (`id_message`) REFERENCES `message` (`id`),
  ADD CONSTRAINT `message_multiple_fk1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `parcial_notes`
--
ALTER TABLE `parcial_notes`
  ADD CONSTRAINT `parcial_notes_fk0` FOREIGN KEY (`id_final_note`) REFERENCES `final_note` (`id`),
  ADD CONSTRAINT `parcial_notes_fk1` FOREIGN KEY (`id_period_final_report`) REFERENCES `period_final_report` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_fk0` FOREIGN KEY (`id_exam`) REFERENCES `exam` (`id`),
  ADD CONSTRAINT `questions_fk1` FOREIGN KEY (`id_type_question`) REFERENCES `type_question` (`id`);

--
-- Constraints for table `question_multiple`
--
ALTER TABLE `question_multiple`
  ADD CONSTRAINT `question_multiple_fk0` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_fk0` FOREIGN KEY (`id_teacher`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `room_fk1` FOREIGN KEY (`id_list_students`) REFERENCES `list_students` (`id`),
  ADD CONSTRAINT `room_fk2` FOREIGN KEY (`id_subject`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `room_fk3` FOREIGN KEY (`id_video_chat`) REFERENCES `video_chat` (`id`);

--
-- Constraints for table `rubrics_range`
--
ALTER TABLE `rubrics_range`
  ADD CONSTRAINT `rubrics_range_fk0` FOREIGN KEY (`id_rubrics`) REFERENCES `rubrics` (`id`);

--
-- Constraints for table `themes_time`
--
ALTER TABLE `themes_time`
  ADD CONSTRAINT `themes_time_fk0` FOREIGN KEY (`id_subject`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `themes_time_fk1` FOREIGN KEY (`id_curse`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `themes_time_fk2` FOREIGN KEY (`id_time`) REFERENCES `times` (`id`);

--
-- Constraints for table `times`
--
ALTER TABLE `times`
  ADD CONSTRAINT `times_fk0` FOREIGN KEY (`id_entity`) REFERENCES `entity` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_fk0` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `users_fk1` FOREIGN KEY (`id_type_document`) REFERENCES `type_document` (`id`),
  ADD CONSTRAINT `users_fk2` FOREIGN KEY (`id_info_entity`) REFERENCES `entity` (`id`);

--
-- Constraints for table `users_list_students`
--
ALTER TABLE `users_list_students`
  ADD CONSTRAINT `users_list_students_fk0` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_list_students_fk1` FOREIGN KEY (`id_list_students`) REFERENCES `list_students` (`id`);

--
-- Constraints for table `video_chat`
--
ALTER TABLE `video_chat`
  ADD CONSTRAINT `video_chat_fk0` FOREIGN KEY (`id_teacher`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
