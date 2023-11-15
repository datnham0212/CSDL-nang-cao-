-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 28, 2023 lúc 01:19 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hospitaldb`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `caringnurses`
--

CREATE TABLE `caringnurses` (
  `NurseEmployeeCode` int(11) DEFAULT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `InpatientID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `departments`
--

CREATE TABLE `departments` (
  `DepartmentCode` int(11) NOT NULL,
  `Title` varchar(100) DEFAULT NULL,
  `DeanEmployeeCode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `doctors`
--

CREATE TABLE `doctors` (
  `EmployeeCode` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `StartDate` date DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `SpecialityName` varchar(50) DEFAULT NULL,
  `DegreeYear` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `doctors`
--

INSERT INTO `doctors` (`EmployeeCode`, `FirstName`, `LastName`, `DateOfBirth`, `Gender`, `Address`, `StartDate`, `PhoneNumber`, `SpecialityName`, `DegreeYear`) VALUES
(1, 'Jane', 'Smith', '1980-10-01', 'Female', NULL, NULL, NULL, 'Pediatrician', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `examinations`
--

CREATE TABLE `examinations` (
  `ExaminationID` int(11) NOT NULL,
  `PatientCode` char(11) DEFAULT NULL,
  `ExaminingDoctorEmployeeCode` int(11) DEFAULT NULL,
  `ExaminationDate` date DEFAULT NULL,
  `Diagnosis` text DEFAULT NULL,
  `NextExaminationDate` date DEFAULT NULL,
  `Medications` text DEFAULT NULL,
  `Fee` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `inpatients`
--

CREATE TABLE `inpatients` (
  `InpatientID` int(11) NOT NULL,
  `PatientCode` char(11) DEFAULT NULL,
  `DateOfAdmission` date DEFAULT NULL,
  `DateOfDischarge` date DEFAULT NULL,
  `Diagnosis` text DEFAULT NULL,
  `Sickroom` varchar(50) DEFAULT NULL,
  `Fee` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `medicationinventory`
--

CREATE TABLE `medicationinventory` (
  `MedicationCode` int(11) DEFAULT NULL,
  `ImportedDate` date DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `IsOutOfDate` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `medicationproviders`
--

CREATE TABLE `medicationproviders` (
  `ProviderCode` int(11) NOT NULL,
  `ProviderName` varchar(100) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `medications`
--

CREATE TABLE `medications` (
  `MedicationCode` int(11) NOT NULL,
  `MedicationName` varchar(100) DEFAULT NULL,
  `Effects` text DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `ExpirationDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `patients`
--

CREATE TABLE `patients` (
  `PatientCode` char(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `patients`
--

INSERT INTO `patients` (`PatientCode`, `FirstName`, `LastName`, `DateOfBirth`, `Gender`, `Address`, `PhoneNumber`) VALUES
('IP000000000', 'Jane', 'Doe', '1994-10-19', 'Female', '456 Vile St', '0987654321'),
('OP000000000', 'John', 'Doe', '1999-10-01', 'Male', '123 Main St', '0123456789');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `treatments`
--

CREATE TABLE `treatments` (
  `TreatmentID` int(11) NOT NULL,
  `InpatientID` int(11) DEFAULT NULL,
  `DoctorEmployeeCode` int(11) DEFAULT NULL,
  `TreatmentStartDate` date DEFAULT NULL,
  `TreatmentEndDate` date DEFAULT NULL,
  `Result` text DEFAULT NULL,
  `Medications` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `hospital_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `hospital_id`, `password`) VALUES
(1, 'admin', '$2y$12$e2mVdmmnt3ZsYcMwBsUxl.2tV0vbDslCjFQD6ju32ACzLYzVfGUP2');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `caringnurses`
--
ALTER TABLE `caringnurses`
  ADD KEY `InpatientID` (`InpatientID`),
  ADD KEY `NurseEmployeeCode` (`NurseEmployeeCode`);

--
-- Chỉ mục cho bảng `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`DepartmentCode`),
  ADD KEY `DeanEmployeeCode` (`DeanEmployeeCode`);

--
-- Chỉ mục cho bảng `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`EmployeeCode`);

--
-- Chỉ mục cho bảng `examinations`
--
ALTER TABLE `examinations`
  ADD PRIMARY KEY (`ExaminationID`),
  ADD KEY `PatientCode` (`PatientCode`),
  ADD KEY `ExaminingDoctorEmployeeCode` (`ExaminingDoctorEmployeeCode`);

--
-- Chỉ mục cho bảng `inpatients`
--
ALTER TABLE `inpatients`
  ADD PRIMARY KEY (`InpatientID`),
  ADD KEY `PatientCode` (`PatientCode`);

--
-- Chỉ mục cho bảng `medicationinventory`
--
ALTER TABLE `medicationinventory`
  ADD KEY `MedicationCode` (`MedicationCode`);

--
-- Chỉ mục cho bảng `medicationproviders`
--
ALTER TABLE `medicationproviders`
  ADD PRIMARY KEY (`ProviderCode`);

--
-- Chỉ mục cho bảng `medications`
--
ALTER TABLE `medications`
  ADD PRIMARY KEY (`MedicationCode`);

--
-- Chỉ mục cho bảng `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`PatientCode`);

--
-- Chỉ mục cho bảng `treatments`
--
ALTER TABLE `treatments`
  ADD PRIMARY KEY (`TreatmentID`),
  ADD KEY `InpatientID` (`InpatientID`),
  ADD KEY `DoctorEmployeeCode` (`DoctorEmployeeCode`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `examinations`
--
ALTER TABLE `examinations`
  MODIFY `ExaminationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `inpatients`
--
ALTER TABLE `inpatients`
  MODIFY `InpatientID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `treatments`
--
ALTER TABLE `treatments`
  MODIFY `TreatmentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `caringnurses`
--
ALTER TABLE `caringnurses`
  ADD CONSTRAINT `caringnurses_ibfk_1` FOREIGN KEY (`InpatientID`) REFERENCES `inpatients` (`InpatientID`),
  ADD CONSTRAINT `caringnurses_ibfk_2` FOREIGN KEY (`NurseEmployeeCode`) REFERENCES `doctors` (`EmployeeCode`);

--
-- Các ràng buộc cho bảng `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`DeanEmployeeCode`) REFERENCES `doctors` (`EmployeeCode`);

--
-- Các ràng buộc cho bảng `examinations`
--
ALTER TABLE `examinations`
  ADD CONSTRAINT `examinations_ibfk_1` FOREIGN KEY (`PatientCode`) REFERENCES `patients` (`PatientCode`),
  ADD CONSTRAINT `examinations_ibfk_2` FOREIGN KEY (`ExaminingDoctorEmployeeCode`) REFERENCES `doctors` (`EmployeeCode`);

--
-- Các ràng buộc cho bảng `inpatients`
--
ALTER TABLE `inpatients`
  ADD CONSTRAINT `inpatients_ibfk_1` FOREIGN KEY (`PatientCode`) REFERENCES `patients` (`PatientCode`);

--
-- Các ràng buộc cho bảng `medicationinventory`
--
ALTER TABLE `medicationinventory`
  ADD CONSTRAINT `medicationinventory_ibfk_1` FOREIGN KEY (`MedicationCode`) REFERENCES `medications` (`MedicationCode`);

--
-- Các ràng buộc cho bảng `treatments`
--
ALTER TABLE `treatments`
  ADD CONSTRAINT `treatments_ibfk_1` FOREIGN KEY (`InpatientID`) REFERENCES `inpatients` (`InpatientID`),
  ADD CONSTRAINT `treatments_ibfk_2` FOREIGN KEY (`DoctorEmployeeCode`) REFERENCES `doctors` (`EmployeeCode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
