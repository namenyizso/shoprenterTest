-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Aug 25. 00:03
-- Kiszolgáló verziója: 10.4.17-MariaDB
-- PHP verzió: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `shoprenter`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(2, '2021-08-24-203529', 'App\\Database\\Migrations\\CreateSecretsTable', 'default', 'App', 1629837705, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `secrets`
--

CREATE TABLE `secrets` (
  `secret_id` int(11) UNSIGNED NOT NULL,
  `hash` text NOT NULL,
  `secretText` text NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `expiresAt` datetime DEFAULT NULL,
  `remainingViews` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `secrets`
--

INSERT INTO `secrets` (`secret_id`, `hash`, `secretText`, `createdAt`, `expiresAt`, `remainingViews`) VALUES
(1, '72a98dffe032222f5f583dcba189db215abe', 'teszt', '2021-08-24 16:04:17', '2021-08-24 16:09:17', 5),
(2, '2231bacce58ffc563273c950e65ae2ef44e0', 'teszt', '2021-08-24 16:04:27', '2021-08-24 16:09:27', 5),
(3, 'fb086ed83a94c313d58b17f09bdd567593ab', 'teszt', '2021-08-24 23:04:59', '2021-08-24 23:09:59', 5),
(4, '6f920fe96dcf6590e14253e50ddee02ce107', 'teszt', '2021-08-24 23:07:18', '2021-08-24 23:12:18', 5),
(5, 'b16af9d5fa9e859aeb478671dc523545fba0', 'teszt', '2021-08-24 23:07:49', NULL, 0),
(6, '1e8e986cfa8491cb3f1534a6e9de38ae0ced', 'tesztfdgdfg', '2021-08-24 23:26:20', NULL, 5),
(7, '18a3a49089853f230172b829aef5a6b5a674', 'tesztfdgdfg', '2021-08-24 23:26:24', '2021-08-24 23:34:24', 5),
(8, '5379576f791a4403bd9562ec6e1a07006a74', 'tesztfdgdfg', '2021-08-24 23:26:51', '2021-08-24 23:34:51', 5),
(9, '7bedccee79e6a3a480cb89078f2dbc00ba44', 'tesztfdgdfg', '2021-08-24 23:27:16', '2021-08-24 23:27:16', 1);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `secrets`
--
ALTER TABLE `secrets`
  ADD PRIMARY KEY (`secret_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT a táblához `secrets`
--
ALTER TABLE `secrets`
  MODIFY `secret_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
