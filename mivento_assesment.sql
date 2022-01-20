-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 20 Oca 2022, 17:11:06
-- Sunucu sürümü: 10.4.14-MariaDB
-- PHP Sürümü: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `mivento_assesment`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `campaigns`
--

CREATE TABLE `campaigns` (
  `campaign_id` int(11) NOT NULL,
  `campaign_name` varchar(255) NOT NULL,
  `campaign_period_id` varchar(11) NOT NULL,
  `campaign_status` int(11) NOT NULL,
  `create_at` datetime DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `employee`
--

CREATE TABLE `employee` (
  `employee_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `point` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `periods`
--

CREATE TABLE `periods` (
  `period_id` int(11) NOT NULL,
  `period_name` varchar(255) NOT NULL,
  `period` varchar(255) NOT NULL,
  `period_status` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`campaign_id`);

--
-- Tablo için indeksler `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Tablo için indeksler `periods`
--
ALTER TABLE `periods`
  ADD PRIMARY KEY (`period_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `campaign_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `periods`
--
ALTER TABLE `periods`
  MODIFY `period_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
