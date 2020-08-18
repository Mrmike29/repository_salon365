-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-08-2020 a las 15:01:58
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `goova`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archives_content_foro`
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
-- Estructura de tabla para la tabla `archives_homework_course`
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
-- Estructura de tabla para la tabla `arcvives_homework`
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
-- Estructura de tabla para la tabla `color`
--

CREATE TABLE `color` (
  `id` int(11) NOT NULL,
  `primary_color` varchar(15) NOT NULL,
  `secundary_color` varchar(15) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `color`
--

INSERT INTO `color` (`id`, `primary_color`, `secundary_color`, `created_at`, `updated_at`) VALUES
(1, 'red', 'green', '2020-08-04 16:32:31', '2020-08-04 16:32:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `content_foro`
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
-- Estructura de tabla para la tabla `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `id_list_students` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `course`
--

INSERT INTO `course` (`id`, `id_list_students`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-08-13 15:39:03', '2020-08-13 15:39:03'),
(2, 2, '2020-08-13 15:39:03', '2020-08-13 15:39:03'),
(3, 3, '2020-08-13 23:41:15', '2020-08-13 23:41:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entity`
--

CREATE TABLE `entity` (
  `id` int(11) NOT NULL,
  `id_type_document` int(11) NOT NULL,
  `id_color` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `document` varchar(20) NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `entity`
--

INSERT INTO `entity` (`id`, `id_type_document`, `id_color`, `name`, `document`, `image`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 'Stratecsa', '111111111', '', '2020-08-04 16:33:05', '2020-08-04 16:33:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exam`
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
-- Estructura de tabla para la tabla `exam_list`
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
-- Estructura de tabla para la tabla `final_note`
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
-- Estructura de tabla para la tabla `foro`
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
-- Estructura de tabla para la tabla `homework`
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
-- Estructura de tabla para la tabla `homework_course`
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
-- Estructura de tabla para la tabla `homework_list`
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
-- Estructura de tabla para la tabla `important_dates`
--

CREATE TABLE `important_dates` (
  `id` int(11) NOT NULL,
  `id_entity` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `end` timestamp NOT NULL DEFAULT current_timestamp(),
  `name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `list_students`
--

CREATE TABLE `list_students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `list_students`
--

INSERT INTO `list_students` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '11', '2020-08-12 18:55:33', '0000-00-00 00:00:00'),
(2, '10', '2020-08-12 20:50:37', '2020-08-12 20:50:37'),
(3, '11-1', '2020-08-13 23:41:15', '2020-08-13 23:41:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message`
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
-- Estructura de tabla para la tabla `message_multiple`
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
-- Estructura de tabla para la tabla `parcial_notes`
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
-- Estructura de tabla para la tabla `period_final_report`
--

CREATE TABLE `period_final_report` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `observation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `questions`
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
-- Estructura de tabla para la tabla `question_multiple`
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
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
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
-- Estructura de tabla para la tabla `room`
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
-- Estructura de tabla para la tabla `rubrics`
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
-- Estructura de tabla para la tabla `rubrics_range`
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
-- Estructura de tabla para la tabla `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Matematicas', '2020-08-13 16:26:16', '0000-00-00 00:00:00'),
(2, 'Sociales', '2020-08-13 16:26:16', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `teacher_course`
--

CREATE TABLE `teacher_course` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `id_subjects` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `teacher_course`
--

INSERT INTO `teacher_course` (`id`, `id_users`, `id_course`, `id_subjects`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 2, '2020-08-13 23:41:15', '2020-08-13 23:41:15'),
(2, 2, 3, 1, '2020-08-13 23:41:15', '2020-08-13 23:41:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `themes_time`
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
-- Estructura de tabla para la tabla `times`
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
-- Estructura de tabla para la tabla `type_document`
--

CREATE TABLE `type_document` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `type_document`
--

INSERT INTO `type_document` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Cedula de Ciudadanía', '2020-08-04 14:30:27', '2020-08-04 14:30:27'),
(2, 'Tarjeta de Identidad', '2020-08-04 14:30:27', '2020-08-04 14:30:27'),
(3, 'Cédula de Extranjenría', '2020-08-04 14:30:27', '2020-08-04 14:30:27'),
(4, 'Pasaporte', '2020-08-04 14:30:27', '2020-08-04 14:30:27'),
(5, 'NIT', '2020-08-04 14:30:27', '2020-08-04 14:30:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_question`
--

CREATE TABLE `type_question` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `type_question`
--

INSERT INTO `type_question` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Multiples Opciones', '2020-08-04 14:42:53', '2020-08-04 14:42:53'),
(2, 'Única Respuesta', '2020-08-04 14:42:53', '2020-08-04 14:42:53'),
(3, 'Pregunta Abierta', '2020-08-04 14:42:53', '2020-08-04 14:42:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
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
  `document` varchar(15) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` varchar(20) NOT NULL DEFAULT 'HABILITADO',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `id_rol`, `id_type_document`, `id_info_entity`, `name`, `last_name`, `email`, `password`, `document`, `phone`, `address`, `state`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 'Jhon', 'Perlaza', 'admin@stratecsa.com', '$2y$10$2gMcFQ6DslFEQ.idoqVO9..04t83bZoM/Y/Jx/IPmN4kCQYmUOpBa', '1192722315', '2649898', 'Calle 1000', 'HABILITADO', '2020-08-11 18:55:30', '2020-08-11 23:55:30'),
(2, 4, 1, 1, 'jhon', 'perlaza', 'jhon@gmail.com', '$2y$10$Ob07f5U.nIOu9ASNj9S4CeyRklixut7RI8y2bO13KVNRbyrlPqg4O', '1192722315', '3148805433', 'calle 100', 'INHABILITADO', '2020-08-11 16:59:46', '2020-08-11 21:59:04'),
(3, 5, 1, 1, 'Jaiver', 'Serna', 'jhonjhon.1717@gmail.com', '$2y$10$MVwRqxWH9GsT5qvr32xWQOaA/yrcWtJliSylCuV9mdcN4AhuRnfFK', '1192722315', '3227941293', 'Calle 100', 'HABILITADO', '2020-08-12 21:10:01', '2020-08-13 02:10:01'),
(4, 5, 2, 1, 'Andres', 'Velez', 'andres@gmail.com', '$2y$10$bMuFpnF8xnuYzVNsKLAJ0uBF.jaNMu5r7gZWK0Dq1sik5B32V3nBK', '5790162569', '3148805433', 'calle 100', 'HABILITADO', '2020-08-13 23:45:38', '2020-08-13 23:45:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_list_students`
--

CREATE TABLE `users_list_students` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_list_students` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users_list_students`
--

INSERT INTO `users_list_students` (`id`, `id_users`, `id_list_students`, `created_at`, `updated_at`) VALUES
(1, 3, 3, '2020-08-13 18:43:15', '2020-08-13 23:43:15'),
(2, 4, 3, '2020-08-13 23:45:38', '2020-08-13 23:45:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `video_chat`
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
-- Estructura de tabla para la tabla `year_final_report`
--

CREATE TABLE `year_final_report` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `observation` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archives_content_foro`
--
ALTER TABLE `archives_content_foro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `archives_content_foro_fk0` (`id_content_foro`);

--
-- Indices de la tabla `archives_homework_course`
--
ALTER TABLE `archives_homework_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `archives_homework_course_fk0` (`id_homework_course`);

--
-- Indices de la tabla `arcvives_homework`
--
ALTER TABLE `arcvives_homework`
  ADD PRIMARY KEY (`id`),
  ADD KEY `arcvives_homework_fk0` (`id_homework`);

--
-- Indices de la tabla `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `content_foro`
--
ALTER TABLE `content_foro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `content_foro_fk0` (`id_foro`),
  ADD KEY `content_foro_fk1` (`id_user`);

--
-- Indices de la tabla `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_fk0` (`id_list_students`);

--
-- Indices de la tabla `entity`
--
ALTER TABLE `entity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entity_fk0` (`id_type_document`),
  ADD KEY `entity_fk1` (`id_color`);

--
-- Indices de la tabla `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_fk0` (`id_course`),
  ADD KEY `exam_fk1` (`id_rubrics`),
  ADD KEY `exam_fk2` (`id_theme_time`);

--
-- Indices de la tabla `exam_list`
--
ALTER TABLE `exam_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_list_fk0` (`id_exam`),
  ADD KEY `exam_list_fk1` (`id_parcial_notes`);

--
-- Indices de la tabla `final_note`
--
ALTER TABLE `final_note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `final_note_fk0` (`id_year_final_report`),
  ADD KEY `final_note_fk1` (`id_student`);

--
-- Indices de la tabla `foro`
--
ALTER TABLE `foro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foro_fk0` (`id_course`);

--
-- Indices de la tabla `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`),
  ADD KEY `homework_fk0` (`id_course`),
  ADD KEY `homework_fk1` (`id_rubrics`),
  ADD KEY `homework_fk2` (`id_theme_time`);

--
-- Indices de la tabla `homework_course`
--
ALTER TABLE `homework_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `homework_course_fk0` (`id_homework`),
  ADD KEY `homework_course_fk1` (`id_course`),
  ADD KEY `homework_course_fk2` (`id_student`);

--
-- Indices de la tabla `homework_list`
--
ALTER TABLE `homework_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `homework_list_fk0` (`id_homework`),
  ADD KEY `homework_list_fk1` (`id_parcial_notes`);

--
-- Indices de la tabla `important_dates`
--
ALTER TABLE `important_dates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `important_dates_fk0` (`id_entity`);

--
-- Indices de la tabla `list_students`
--
ALTER TABLE `list_students`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_fk0` (`id_user`);

--
-- Indices de la tabla `message_multiple`
--
ALTER TABLE `message_multiple`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_multiple_fk0` (`id_message`),
  ADD KEY `message_multiple_fk1` (`id_user`);

--
-- Indices de la tabla `parcial_notes`
--
ALTER TABLE `parcial_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parcial_notes_fk0` (`id_final_note`),
  ADD KEY `parcial_notes_fk1` (`id_period_final_report`);

--
-- Indices de la tabla `period_final_report`
--
ALTER TABLE `period_final_report`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_fk0` (`id_exam`),
  ADD KEY `questions_fk1` (`id_type_question`);

--
-- Indices de la tabla `question_multiple`
--
ALTER TABLE `question_multiple`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_multiple_fk0` (`id_question`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_fk0` (`id_teacher`),
  ADD KEY `room_fk1` (`id_list_students`),
  ADD KEY `room_fk2` (`id_subject`),
  ADD KEY `room_fk3` (`id_video_chat`);

--
-- Indices de la tabla `rubrics`
--
ALTER TABLE `rubrics`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rubrics_range`
--
ALTER TABLE `rubrics_range`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rubrics_range_fk0` (`id_rubrics`);

--
-- Indices de la tabla `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `teacher_course`
--
ALTER TABLE `teacher_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `id_course` (`id_course`),
  ADD KEY `id_subjects` (`id_subjects`);

--
-- Indices de la tabla `themes_time`
--
ALTER TABLE `themes_time`
  ADD PRIMARY KEY (`id`),
  ADD KEY `themes_time_fk0` (`id_subject`),
  ADD KEY `themes_time_fk1` (`id_curse`),
  ADD KEY `themes_time_fk2` (`id_time`);

--
-- Indices de la tabla `times`
--
ALTER TABLE `times`
  ADD PRIMARY KEY (`id`),
  ADD KEY `times_fk0` (`id_entity`);

--
-- Indices de la tabla `type_document`
--
ALTER TABLE `type_document`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `type_question`
--
ALTER TABLE `type_question`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_fk0` (`id_rol`),
  ADD KEY `users_fk1` (`id_type_document`),
  ADD KEY `users_fk2` (`id_info_entity`);

--
-- Indices de la tabla `users_list_students`
--
ALTER TABLE `users_list_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_list_students_fk0` (`id_users`),
  ADD KEY `users_list_students_fk1` (`id_list_students`);

--
-- Indices de la tabla `video_chat`
--
ALTER TABLE `video_chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_chat_fk0` (`id_teacher`);

--
-- Indices de la tabla `year_final_report`
--
ALTER TABLE `year_final_report`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archives_content_foro`
--
ALTER TABLE `archives_content_foro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `archives_homework_course`
--
ALTER TABLE `archives_homework_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `arcvives_homework`
--
ALTER TABLE `arcvives_homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `color`
--
ALTER TABLE `color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `content_foro`
--
ALTER TABLE `content_foro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `entity`
--
ALTER TABLE `entity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `exam_list`
--
ALTER TABLE `exam_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `final_note`
--
ALTER TABLE `final_note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `foro`
--
ALTER TABLE `foro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `homework_course`
--
ALTER TABLE `homework_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `homework_list`
--
ALTER TABLE `homework_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `important_dates`
--
ALTER TABLE `important_dates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `list_students`
--
ALTER TABLE `list_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `message_multiple`
--
ALTER TABLE `message_multiple`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `parcial_notes`
--
ALTER TABLE `parcial_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `period_final_report`
--
ALTER TABLE `period_final_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `question_multiple`
--
ALTER TABLE `question_multiple`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rubrics`
--
ALTER TABLE `rubrics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rubrics_range`
--
ALTER TABLE `rubrics_range`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `teacher_course`
--
ALTER TABLE `teacher_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `themes_time`
--
ALTER TABLE `themes_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `times`
--
ALTER TABLE `times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `type_document`
--
ALTER TABLE `type_document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `type_question`
--
ALTER TABLE `type_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users_list_students`
--
ALTER TABLE `users_list_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `video_chat`
--
ALTER TABLE `video_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `year_final_report`
--
ALTER TABLE `year_final_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archives_content_foro`
--
ALTER TABLE `archives_content_foro`
  ADD CONSTRAINT `archives_content_foro_fk0` FOREIGN KEY (`id_content_foro`) REFERENCES `content_foro` (`id`);

--
-- Filtros para la tabla `archives_homework_course`
--
ALTER TABLE `archives_homework_course`
  ADD CONSTRAINT `archives_homework_course_fk0` FOREIGN KEY (`id_homework_course`) REFERENCES `homework_course` (`id`);

--
-- Filtros para la tabla `arcvives_homework`
--
ALTER TABLE `arcvives_homework`
  ADD CONSTRAINT `arcvives_homework_fk0` FOREIGN KEY (`id_homework`) REFERENCES `homework` (`id`);

--
-- Filtros para la tabla `content_foro`
--
ALTER TABLE `content_foro`
  ADD CONSTRAINT `content_foro_fk0` FOREIGN KEY (`id_foro`) REFERENCES `foro` (`id`),
  ADD CONSTRAINT `content_foro_fk1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_fk0` FOREIGN KEY (`id_list_students`) REFERENCES `list_students` (`id`);

--
-- Filtros para la tabla `entity`
--
ALTER TABLE `entity`
  ADD CONSTRAINT `entity_fk0` FOREIGN KEY (`id_type_document`) REFERENCES `type_document` (`id`),
  ADD CONSTRAINT `entity_fk1` FOREIGN KEY (`id_color`) REFERENCES `color` (`id`);

--
-- Filtros para la tabla `exam`
--
ALTER TABLE `exam`
  ADD CONSTRAINT `exam_fk0` FOREIGN KEY (`id_course`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `exam_fk1` FOREIGN KEY (`id_rubrics`) REFERENCES `rubrics` (`id`),
  ADD CONSTRAINT `exam_fk2` FOREIGN KEY (`id_theme_time`) REFERENCES `themes_time` (`id`);

--
-- Filtros para la tabla `exam_list`
--
ALTER TABLE `exam_list`
  ADD CONSTRAINT `exam_list_fk0` FOREIGN KEY (`id_exam`) REFERENCES `exam` (`id`),
  ADD CONSTRAINT `exam_list_fk1` FOREIGN KEY (`id_parcial_notes`) REFERENCES `parcial_notes` (`id`);

--
-- Filtros para la tabla `final_note`
--
ALTER TABLE `final_note`
  ADD CONSTRAINT `final_note_fk0` FOREIGN KEY (`id_year_final_report`) REFERENCES `year_final_report` (`id`),
  ADD CONSTRAINT `final_note_fk1` FOREIGN KEY (`id_student`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `foro`
--
ALTER TABLE `foro`
  ADD CONSTRAINT `foro_fk0` FOREIGN KEY (`id_course`) REFERENCES `course` (`id`);

--
-- Filtros para la tabla `homework`
--
ALTER TABLE `homework`
  ADD CONSTRAINT `homework_fk0` FOREIGN KEY (`id_course`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `homework_fk1` FOREIGN KEY (`id_rubrics`) REFERENCES `rubrics` (`id`),
  ADD CONSTRAINT `homework_fk2` FOREIGN KEY (`id_theme_time`) REFERENCES `themes_time` (`id`);

--
-- Filtros para la tabla `homework_course`
--
ALTER TABLE `homework_course`
  ADD CONSTRAINT `homework_course_fk0` FOREIGN KEY (`id_homework`) REFERENCES `homework` (`id`),
  ADD CONSTRAINT `homework_course_fk1` FOREIGN KEY (`id_course`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `homework_course_fk2` FOREIGN KEY (`id_student`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `homework_list`
--
ALTER TABLE `homework_list`
  ADD CONSTRAINT `homework_list_fk0` FOREIGN KEY (`id_homework`) REFERENCES `homework` (`id`),
  ADD CONSTRAINT `homework_list_fk1` FOREIGN KEY (`id_parcial_notes`) REFERENCES `parcial_notes` (`id`);

--
-- Filtros para la tabla `important_dates`
--
ALTER TABLE `important_dates`
  ADD CONSTRAINT `important_dates_fk0` FOREIGN KEY (`id_entity`) REFERENCES `entity` (`id`);

--
-- Filtros para la tabla `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_fk0` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `message_multiple`
--
ALTER TABLE `message_multiple`
  ADD CONSTRAINT `message_multiple_fk0` FOREIGN KEY (`id_message`) REFERENCES `message` (`id`),
  ADD CONSTRAINT `message_multiple_fk1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `parcial_notes`
--
ALTER TABLE `parcial_notes`
  ADD CONSTRAINT `parcial_notes_fk0` FOREIGN KEY (`id_final_note`) REFERENCES `final_note` (`id`),
  ADD CONSTRAINT `parcial_notes_fk1` FOREIGN KEY (`id_period_final_report`) REFERENCES `period_final_report` (`id`);

--
-- Filtros para la tabla `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_fk0` FOREIGN KEY (`id_exam`) REFERENCES `exam` (`id`),
  ADD CONSTRAINT `questions_fk1` FOREIGN KEY (`id_type_question`) REFERENCES `type_question` (`id`);

--
-- Filtros para la tabla `question_multiple`
--
ALTER TABLE `question_multiple`
  ADD CONSTRAINT `question_multiple_fk0` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id`);

--
-- Filtros para la tabla `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_fk0` FOREIGN KEY (`id_teacher`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `room_fk1` FOREIGN KEY (`id_list_students`) REFERENCES `list_students` (`id`),
  ADD CONSTRAINT `room_fk2` FOREIGN KEY (`id_subject`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `room_fk3` FOREIGN KEY (`id_video_chat`) REFERENCES `video_chat` (`id`);

--
-- Filtros para la tabla `rubrics_range`
--
ALTER TABLE `rubrics_range`
  ADD CONSTRAINT `rubrics_range_fk0` FOREIGN KEY (`id_rubrics`) REFERENCES `rubrics` (`id`);

--
-- Filtros para la tabla `teacher_course`
--
ALTER TABLE `teacher_course`
  ADD CONSTRAINT `teacher_course_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `teacher_course_ibfk_2` FOREIGN KEY (`id_course`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `teacher_course_ibfk_3` FOREIGN KEY (`id_subjects`) REFERENCES `subjects` (`id`);

--
-- Filtros para la tabla `themes_time`
--
ALTER TABLE `themes_time`
  ADD CONSTRAINT `themes_time_fk0` FOREIGN KEY (`id_subject`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `themes_time_fk1` FOREIGN KEY (`id_curse`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `themes_time_fk2` FOREIGN KEY (`id_time`) REFERENCES `times` (`id`);

--
-- Filtros para la tabla `times`
--
ALTER TABLE `times`
  ADD CONSTRAINT `times_fk0` FOREIGN KEY (`id_entity`) REFERENCES `entity` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_fk0` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `users_fk1` FOREIGN KEY (`id_type_document`) REFERENCES `type_document` (`id`),
  ADD CONSTRAINT `users_fk2` FOREIGN KEY (`id_info_entity`) REFERENCES `entity` (`id`);

--
-- Filtros para la tabla `users_list_students`
--
ALTER TABLE `users_list_students`
  ADD CONSTRAINT `users_list_students_fk0` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_list_students_fk1` FOREIGN KEY (`id_list_students`) REFERENCES `list_students` (`id`);

--
-- Filtros para la tabla `video_chat`
--
ALTER TABLE `video_chat`
  ADD CONSTRAINT `video_chat_fk0` FOREIGN KEY (`id_teacher`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
