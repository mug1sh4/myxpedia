-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2025 at 08:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flight_booking`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddAircraft` (IN `model` VARCHAR(50), IN `capacity` INT, IN `manufacturer` VARCHAR(50))   BEGIN
  INSERT INTO Aircraft (Model, Capacity, Manufacturer)
  VALUES (model, capacity, manufacturer);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AddAirline` (IN `name` VARCHAR(100), IN `code` VARCHAR(10), IN `country` VARCHAR(50))   BEGIN
  INSERT INTO Airline (Name, Code, Country)
  VALUES (name, code, country);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AddAirport` (IN `name` VARCHAR(100), IN `city` VARCHAR(50), IN `country` VARCHAR(50), IN `code` VARCHAR(10))   BEGIN
  INSERT INTO Airport (Name, City, Country, Code)
  VALUES (name, city, country, code);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AddBooking` (IN `passID` INT, IN `flightID` INT, IN `seatID` INT, IN `paymentID` INT, IN `bookDate` DATE, IN `status` VARCHAR(20))   BEGIN
  INSERT INTO Booking (PassengerID, FlightID, SeatID, PaymentID, BookingDate, Status)
  VALUES (passID, flightID, seatID, paymentID, bookDate, status);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AddFlight` (IN `airlineID` INT, IN `aircraftID` INT, IN `depID` INT, IN `arrID` INT, IN `depTime` DATETIME, IN `arrTime` DATETIME)   BEGIN
  INSERT INTO Flight (AirlineID, AircraftID, DepartureID, ArrivalID, DepartureTime, ArrivalTime)
  VALUES (airlineID, aircraftID, depID, arrID, depTime, arrTime);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AddPassenger` (IN `fName` VARCHAR(50), IN `lName` VARCHAR(50), IN `email` VARCHAR(100), IN `phone` VARCHAR(20), IN `passport` VARCHAR(20))   BEGIN
  INSERT INTO Passenger (FirstName, LastName, Email, PhoneNumber, PassportNumber)
  VALUES (fName, lName, email, phone, passport);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AddPayment` (IN `amount` DECIMAL(10,2), IN `method` VARCHAR(20), IN `payDate` DATETIME, IN `status` VARCHAR(20))   BEGIN
  INSERT INTO Payment (Amount, Method, PaymentDate, Status)
  VALUES (amount, method, payDate, status);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `AddSeat` (IN `aircraftID` INT, IN `seatNum` VARCHAR(10), IN `seatClass` VARCHAR(20))   BEGIN
  INSERT INTO Seat (AircraftID, SeatNumber, Class)
  VALUES (aircraftID, seatNum, seatClass);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteBooking` (IN `bID` INT)   BEGIN
  DELETE FROM Booking WHERE BookingID = bID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteFlight` (IN `fID` INT)   BEGIN
  DELETE FROM Flight WHERE FlightID = fID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeletePassenger` (IN `pID` INT)   BEGIN
  DELETE FROM Passenger WHERE PassengerID = pID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAircraft` (IN `aID` INT)   BEGIN
  SELECT * FROM Aircraft WHERE AircraftID = aID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAirline` (IN `aID` INT)   BEGIN
  SELECT * FROM Airline WHERE AirlineID = aID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAirport` (IN `aID` INT)   BEGIN
  SELECT * FROM Airport WHERE AirportID = aID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetBooking` (IN `bID` INT)   BEGIN
  SELECT * FROM Booking WHERE BookingID = bID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetFlight` (IN `fID` INT)   BEGIN
  SELECT * FROM Flight WHERE FlightID = fID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetPassenger` (IN `pID` INT)   BEGIN
  SELECT * FROM Passenger WHERE PassengerID = pID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetPayment` (IN `pID` INT)   BEGIN
  SELECT * FROM Payment WHERE PaymentID = pID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GetSeat` (IN `sID` INT)   BEGIN
  SELECT * FROM Seat WHERE SeatID = sID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_check_airline` (IN `airlineCode` VARCHAR(10))   BEGIN
    SELECT * FROM Airline WHERE Code = airlineCode;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_delete_airline` (IN `airlineID` INT)   BEGIN
    DELETE FROM Airline WHERE AirlineID = airlineID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_filter_airline` (IN `country` VARCHAR(50))   BEGIN
    SELECT * FROM Airline WHERE Country = country;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_airline` ()   BEGIN
    SELECT * FROM Airline;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_airline_details` (IN `airlineID` INT)   BEGIN
    SELECT * FROM Airline WHERE AirlineID = airlineID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_save_airline` (IN `name` VARCHAR(100), IN `code` VARCHAR(10), IN `country` VARCHAR(50))   BEGIN
    INSERT INTO Airline (Name, Code, Country)
    VALUES (name, code, country);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateBookingStatus` (IN `bID` INT, IN `newStatus` VARCHAR(20))   BEGIN
  UPDATE Booking SET Status = newStatus WHERE BookingID = bID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateFlightTimes` (IN `fID` INT, IN `newDep` DATETIME, IN `newArr` DATETIME)   BEGIN
  UPDATE Flight SET DepartureTime = newDep, ArrivalTime = newArr WHERE FlightID = fID;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdatePassengerEmail` (IN `pID` INT, IN `newEmail` VARCHAR(100))   BEGIN
  UPDATE Passenger SET Email = newEmail WHERE PassengerID = pID;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `aircraft`
--

CREATE TABLE `aircraft` (
  `AircraftID` int(11) NOT NULL,
  `Model` varchar(50) DEFAULT NULL,
  `Capacity` int(11) DEFAULT NULL,
  `Manufacturer` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aircraft`
--

INSERT INTO `aircraft` (`AircraftID`, `Model`, `Capacity`, `Manufacturer`) VALUES
(1, 'Boeing 737-800', 160, 'Boeing');

-- --------------------------------------------------------

--
-- Table structure for table `airline`
--

CREATE TABLE `airline` (
  `AirlineID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `Code` varchar(10) DEFAULT NULL,
  `Country` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airline`
--

INSERT INTO `airline` (`AirlineID`, `Name`, `Code`, `Country`) VALUES
(1, 'Kenya Airways', 'KQ', 'Kenya');

-- --------------------------------------------------------

--
-- Table structure for table `airport`
--

CREATE TABLE `airport` (
  `AirportID` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `Country` varchar(50) DEFAULT NULL,
  `Code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airport`
--

INSERT INTO `airport` (`AirportID`, `Name`, `City`, `Country`, `Code`) VALUES
(1, 'Jomo Kenyatta International', 'Nairobi', 'Kenya', 'NBO'),
(2, 'John F. Kennedy International', 'New York', 'USA', 'JFK');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `BookingID` int(11) NOT NULL,
  `PassengerID` int(11) DEFAULT NULL,
  `FlightID` int(11) DEFAULT NULL,
  `SeatID` int(11) DEFAULT NULL,
  `PaymentID` int(11) DEFAULT NULL,
  `BookingDate` date DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`BookingID`, `PassengerID`, `FlightID`, `SeatID`, `PaymentID`, `BookingDate`, `Status`) VALUES
(1, 1, 1, 1, 1, '2025-08-20', 'Confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

CREATE TABLE `flight` (
  `FlightID` int(11) NOT NULL,
  `AirlineID` int(11) DEFAULT NULL,
  `AircraftID` int(11) DEFAULT NULL,
  `DepartureID` int(11) DEFAULT NULL,
  `ArrivalID` int(11) DEFAULT NULL,
  `DepartureTime` datetime DEFAULT NULL,
  `ArrivalTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`FlightID`, `AirlineID`, `AircraftID`, `DepartureID`, `ArrivalID`, `DepartureTime`, `ArrivalTime`) VALUES
(1, 1, 1, 1, 2, '2025-08-21 08:00:00', '2025-08-21 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `PassengerID` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `PassportNumber` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`PassengerID`, `FirstName`, `LastName`, `Email`, `PhoneNumber`, `PassportNumber`) VALUES
(1, 'Alice', 'Mwangi', 'alice@example.com', '0712345678', 'K1234567');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `Method` varchar(20) DEFAULT NULL,
  `PaymentDate` datetime DEFAULT NULL,
  `Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `Amount`, `Method`, `PaymentDate`, `Status`) VALUES
(1, 500.00, 'Credit Card', '2025-08-20 10:00:00', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE `seat` (
  `SeatID` int(11) NOT NULL,
  `AircraftID` int(11) DEFAULT NULL,
  `SeatNumber` varchar(10) DEFAULT NULL,
  `Class` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`SeatID`, `AircraftID`, `SeatNumber`, `Class`) VALUES
(1, 1, '12A', 'Economy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aircraft`
--
ALTER TABLE `aircraft`
  ADD PRIMARY KEY (`AircraftID`);

--
-- Indexes for table `airline`
--
ALTER TABLE `airline`
  ADD PRIMARY KEY (`AirlineID`);

--
-- Indexes for table `airport`
--
ALTER TABLE `airport`
  ADD PRIMARY KEY (`AirportID`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `PassengerID` (`PassengerID`),
  ADD KEY `FlightID` (`FlightID`),
  ADD KEY `SeatID` (`SeatID`),
  ADD KEY `PaymentID` (`PaymentID`);

--
-- Indexes for table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`FlightID`),
  ADD KEY `AirlineID` (`AirlineID`),
  ADD KEY `AircraftID` (`AircraftID`),
  ADD KEY `DepartureID` (`DepartureID`),
  ADD KEY `ArrivalID` (`ArrivalID`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`PassengerID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`);

--
-- Indexes for table `seat`
--
ALTER TABLE `seat`
  ADD PRIMARY KEY (`SeatID`),
  ADD KEY `AircraftID` (`AircraftID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aircraft`
--
ALTER TABLE `aircraft`
  MODIFY `AircraftID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `airline`
--
ALTER TABLE `airline`
  MODIFY `AirlineID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `airport`
--
ALTER TABLE `airport`
  MODIFY `AirportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `flight`
--
ALTER TABLE `flight`
  MODIFY `FlightID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `passenger`
--
ALTER TABLE `passenger`
  MODIFY `PassengerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `seat`
--
ALTER TABLE `seat`
  MODIFY `SeatID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`PassengerID`) REFERENCES `passenger` (`PassengerID`),
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`FlightID`) REFERENCES `flight` (`FlightID`),
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`SeatID`) REFERENCES `seat` (`SeatID`),
  ADD CONSTRAINT `booking_ibfk_4` FOREIGN KEY (`PaymentID`) REFERENCES `payment` (`PaymentID`);

--
-- Constraints for table `flight`
--
ALTER TABLE `flight`
  ADD CONSTRAINT `flight_ibfk_1` FOREIGN KEY (`AirlineID`) REFERENCES `airline` (`AirlineID`),
  ADD CONSTRAINT `flight_ibfk_2` FOREIGN KEY (`AircraftID`) REFERENCES `aircraft` (`AircraftID`),
  ADD CONSTRAINT `flight_ibfk_3` FOREIGN KEY (`DepartureID`) REFERENCES `airport` (`AirportID`),
  ADD CONSTRAINT `flight_ibfk_4` FOREIGN KEY (`ArrivalID`) REFERENCES `airport` (`AirportID`);

--
-- Constraints for table `seat`
--
ALTER TABLE `seat`
  ADD CONSTRAINT `seat_ibfk_1` FOREIGN KEY (`AircraftID`) REFERENCES `aircraft` (`AircraftID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
