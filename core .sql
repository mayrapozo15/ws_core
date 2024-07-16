CREATE TABLE `categoria_escuela` (
  `id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
);
CREATE TABLE `escuelas` (
  `id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `categoria` bigint UNSIGNED DEFAULT NULL,
  FOREIGN KEY (`categoria`) REFERENCES `categoria_escuela`(`id`)
);

CREATE TABLE `rol` (
  `id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `nombre` varchar(35) DEFAULT NULL
);
CREATE TABLE `usuarios` (
  `id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `escuela` bigint UNSIGNED DEFAULT NULL,
  `usuario` varchar(10) NOT NULL,
  `clave` varchar(10) DEFAULT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `rol` bigint UNSIGNED DEFAULT NULL,
  FOREIGN KEY (`escuela`) REFERENCES `escuelas`(`id`),
  FOREIGN KEY (`rol`) REFERENCES `rol`(`id`)
);


CREATE TABLE `categoria_estudiante` (
  `id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `nombre` varchar(100) DEFAULT NULL
);
CREATE TABLE `alumnos` (
  `id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `escuela` bigint UNSIGNED DEFAULT NULL,
  `categria` bigint UNSIGNED DEFAULT NULL,
  `cedula` varchar(10) NOT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `genero` varchar(20) DEFAULT NULL,
  `estatura` decimal(20,2) DEFAULT NULL,
  `peso` decimal(20,2) DEFAULT NULL,
  `edad` int DEFAULT NULL,
  FOREIGN KEY (`escuela`) REFERENCES `escuelas`(`id`),
   FOREIGN KEY (`categria`) REFERENCES `categoria_estudiante`(`id`)
);

CREATE TABLE `jugadores_destacados` (
  `id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `categoria` bigint UNSIGNED DEFAULT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `genero` varchar(20) DEFAULT NULL,
  `estatura` decimal(20,2) DEFAULT NULL,
  `peso` decimal(20,2) DEFAULT NULL,
  `edad` int DEFAULT NULL,
  FOREIGN KEY (`categria`) REFERENCES `categoria_estudiante`(`id`)
);
CREATE TABLE `rutina_deportivas` (
  `id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `jugador` bigint UNSIGNED DEFAULT NULL,
  `dia` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `repeticiones` varchar(50) DEFAULT NULL,
  FOREIGN KEY (`jugador`) REFERENCES `jugadores_destacados`(`id`)
);

CREATE TABLE `registro_entrenamiento` (
  `id` bigint UNSIGNED PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `escuela` bigint UNSIGNED DEFAULT NULL,
  `alumno` bigint UNSIGNED DEFAULT NULL,
  `rutina` bigint UNSIGNED DEFAULT NULL,
  `fecha` date DEFAULT NULL,
    FOREIGN KEY (`escuela`) REFERENCES `escuelas`(`id`),
  FOREIGN KEY (`alumno`) REFERENCES `alumnos`(`id`),
  FOREIGN KEY (`rutina`) REFERENCES `rutina_deportivas`(`id`)
);