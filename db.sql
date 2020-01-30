-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 08. Jul 2019 um 05:36
-- Server-Version: 10.1.37-MariaDB-0+deb9u1
-- PHP-Version: 7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `bbeutgsql1`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adress`
--

CREATE TABLE `adress` (
  `id` int(11) NOT NULL,
  `city` text NOT NULL,
  `postal_code` text NOT NULL,
  `street` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `image_path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `image_path`) VALUES
(0, 'Sandwich', 'Zwei Scheiben frisches, regionales Brot und dazwischen viele weitere Zutaten. Mehr braucht es nicht für eine gelungene Mahlzeit! Entdecke jetzt unser unglaublich vielfältiges Sortiment an frischen, klassischen Sandwiches.\r\n', '/img/upload/sandwich/sandwich.jpg'),
(1, 'Burger', 'Ein knuspriges Brötchen, leckere Sauce, frisches Gemüse und das beste, saftigste Fleisch! Was will man mehr? Bei uns werden die Burger noch ganz klassisch nach einem alten Familienrezept hergestellt und nur die besten Zutaten sind für uns gerade gut genug.', '/img/upload/burger/burger.jpg'),
(2, 'Snacks', 'Knusprig gegrillte Chicken-Wings oder doch lieber eine ordentliche Portion Nachos mit bestem Cheddar überbacken? Was darf\'s denn sein? Nur hier bei uns gibt es die Snack-Klassiker nach Originalrezept mit besten, frischen Zutaten!', '/img/upload/snack/snacks_chicken_wings.jpg'),
(3, 'Drinks', 'Was wenn beim Bestellen unseres Essens dann doch noch der Durst kommt? Dann bestell doch gleich eine Flasche Vivi-Kola und fühl Dich als wärst Du in den 60ern. Vielleicht dazu auch noch ein kühles Bier? Kein Problem! Da können wir dich mit trendigen Produkten aus dem hohen Norden und sogar Asien versorgen!', '/img/upload/drink/softdrinks.jpg'),
(4, 'Asia', 'Darf es etwas exotischer sein? Dann probier doch mal unser Asia-Sortiment durch! Hier findest du viele Currys und auch ein neues Trendgericht: die Ramen-Suppe. Wir verwenden ausschliesslich beste Zutaten und Vieles importieren wir direkt aus dem Herkunftsland des Gerichts.', '/img/upload/asia/curry_yellow.jpg'),
(5, 'Pizza', 'Was macht diesen italienischen Klassiker aus? Bei uns ist das ganz klar: ein fluffiger, knuspriger Boden, eine fruchtig-würzige Sauce und frischer Büffelmozzarella! Ein Biss von Deiner Lieblingspizza und Du hast das Gefühl im tiefsten Italien zu sein.', '/img/upload/pizza/pizza.jpg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `ingredient`
--

INSERT INTO `ingredient` (`id`, `name`) VALUES
(1, 'Salat'),
(2, 'Brot'),
(3, 'Aufschnitt'),
(4, 'Tomaten'),
(5, 'Falafel'),
(6, 'Gurken'),
(7, 'Paprika'),
(8, 'Crème fraîche'),
(9, 'Kichererbsen'),
(10, 'Schinken'),
(11, 'Urban Red Sauce'),
(12, 'Urban White Sauce'),
(13, 'Rindersteak'),
(14, 'Kräuter'),
(15, 'Zwiebeln'),
(16, 'Speck'),
(18, 'Zwiebelsauce'),
(19, 'Käse'),
(20, 'Rindsfleisch'),
(21, 'Karotten'),
(22, 'Quinoa'),
(23, 'Poulet'),
(24, 'Nachos'),
(25, 'Kartoffeln'),
(26, 'Wasser'),
(27, 'Zucker'),
(28, 'Alkohol(16+)'),
(29, 'Curry'),
(30, 'Reis'),
(31, 'Auberginen'),
(32, 'Nudeln'),
(33, ' Zucchini '),
(34, 'Peperoni'),
(35, 'Salami'),
(36, 'Pilze');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ordering`
--

CREATE TABLE `ordering` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `comment` text NOT NULL,
  `allergy` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ordering_product`
--

CREATE TABLE `ordering_product` (
  `ordering_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product`
--

CREATE TABLE `product` (
  `name` text NOT NULL,
  `price` float NOT NULL,
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `image_path` text NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `product`
--

INSERT INTO `product` (`name`, `price`, `id`, `description`, `image_path`, `category_id`) VALUES
('Pizza Peperoni', 14.99, 32, 'Eine hervorragende, ofenfrische Pizza mit dem verführerischen Duft nach \"la dolce vita”. Grosszügig mit Peperoni belegt, kombiniert diese Pizza Fruchtig und Scharf zu einem einzigartigen Aroma.', '/img/upload/pizza/pizza_peperoni.jpg', 5),
('Pizza Salami', 16.99, 33, 'Eine hervorragende, ofenfrische Pizza mit dem verführerischen Duft nach \"la dolce vita”. Grosszügig mit Salami belegt, hat diese Pizza den unverkennbaren Geschmack des absoluten Klassikers.', '/img/upload/pizza/pizza_salami.jpg', 5),
('Pizza Quattro Formaggi', 16.99, 34, 'Eine hervorragende, ofenfrische Pizza mit dem verführerischen Duft nach \"la dolce vita”. Belegt mit vier verschiedenen Käsesorten ist es ein Feuerwerk für den Gaumen.', '/img/upload/pizza/pizza_quattro_formaggi.jpg', 5),
('Pizza Prosciutto', 15.99, 35, 'Eine hervorragende, ofenfrische Pizza mit dem verführerischen Duft nach \"la dolce vita”. Die Pizza wird sehr grosszügig mit Parma- und Lardo-Schinken belegt und ist der Kracher auf jeder Party.', '/img/upload/pizza/pizza_prosciutto.jpg', 5),
('Pizza Funghi', 14.99, 36, 'Eine hervorragende, ofenfrische Pizza mit dem verführerischen Duft nach \"la dolce vita”. Die Pizza wird mit saisonalen, regionalen Pilzen frisch aus dem Wald belegt.', '/img/upload/pizza/pizza_funghi.jpg', 5),
('Madras Curry', 13.99, 37, 'Dieses Gericht bringt dir traditionelle Gerüche aus der asiatischen Küche direkt nach Hause! Die weltbekannte Curry-Mischung „Madras“ bringt dir ein mildes und interessantes Geschmackserlebnis.', '/img/upload/asia/curry_madras.JPG', 4),
('Green Curry', 16.99, 38, 'Dieses Gericht bringt dir traditionelle Gerüche aus der asiatischen Küche direkt nach Hause! Das moderne grüne Curry, bringt ziemlich viel Schärfe und ein fruchtiges Aroma in die heimische Küche.', '/img/upload/asia/curry_green.jpg', 4),
('Yellow Curry', 14.99, 39, 'Dieses Gericht bringt dir traditionelle Gerüche aus der asiatischen Küche direkt nach Hause! Die intensive Mischung von Gewürzen wie Kurkuma setzt klassische Farbaspekte und bringt einen interessanten Geschmack nach Hause.', '/img/upload/asia/curry_yellow.jpg', 4),
('Ramen Suppe', 14.99, 40, 'Dieses Gericht bringt dir traditionelle Gerüche aus der asiatischen Küche direkt nach Hause! Eine starke Brühe und handgemachte Nudeln machen dieses Gericht aus.', '/img/upload/asia/ramen_soup.jpg', 4),
('Bacon & Jalapeño Burger', 17.99, 41, 'Gutes Fleisch, hervorragende Sauce und frisches Gemüse machen den perfekten Burger aus. Dieses Stück kommt zusätzlich mit gebratenem Bacon und eingelegten Jalapeños.', '/img/upload/burger/burger_bacon_jalapeno.jpg', 1),
('Cheeseburger', 15.99, 42, 'Gutes Fleisch, hervorragende Sauce und frisches Gemüse machen den perfekten Burger aus. Dieses Stück kommt mit einer guten Ladung Cheddar und Greyerzer garniert. ', '/img/upload/burger/burger_cheese.jpg', 1),
('Hamburger', 14.99, 43, 'Gutes Fleisch, hervorragende Sauce und frisches Gemüse machen den perfekten Burger aus. Das ist der Klassiker. 100% bestes Rindfleisch und ein puristischer Geschmack. ', '/img/upload/burger/burger_ham.jpg', 1),
('Pulled-Pork Burger', 17.99, 44, 'Gutes Fleisch, hervorragende Sauce und frisches Gemüse machen den perfekten Burger aus. Das ist BBQ. Stundenlang gesmoktes Fleisch und frischer Kohlsalat machen dieses Gericht aus.', '/img/upload/burger/burger_pulledpork.jpg', 1),
('Vegi-Burger', 16.99, 45, 'Hervorragende Sauce und frisches Gemüse machen den perfekten Burger aus. Eine Wohltat für den Gaumen und das Ganze ist auch noch vegetarisch.', '/img/upload/burger/burger_vegetarian.jpg', 1),
('Clubsandwich', 12.99, 46, 'Der Klassiker unter den Sandwiches. Frisches Gemüse und gutes Fleisch bringen den besten Geschmack.', '/img/upload/sandwich/sandwich_club.jpg', 0),
('Falafelsandwich', 12.99, 47, 'Diese orientalischen Bällchen aus pürierten Kichererbsen sind der perfekte Belag für ein hervorragendes Sandwich.', '/img/upload/sandwich/sandwich_falafel.jpg', 0),
('Pastramisandwich', 15.99, 48, 'Hier kommt ein klassischer BBQ-Schinken, kombiniert mit einem guten Sandwich zusammen. Das ergibt einen unvergleichbaren Geschmack.', '/img/upload/sandwich/sandwich_pastrami.jpg', 0),
('Steaksandwich', 15.99, 49, 'Das beste Stück vom Rind zwischen zwei geschmacksvollen Brotstücken bringt den ultimativen Geschmack.', '/img/upload/sandwich/sandwich_steak.jpg', 0),
('Kirin Ichiban', 4.99, 50, 'Beste japanische Braukunst!', '/img/upload/drink/beer_kirin_ichiban.jpg', 3),
('Lapin Kulta', 4.55, 51, 'Nordisches Kulturgut in seiner reinsten Form.', '/img/upload/drink/beer_lapin_kulta.JPG', 3),
('Fizzy', 2.75, 52, 'Der Softdrink-Klassiker aus den USA ist auch Heute unverkennbar.', '/img/upload/drink/fizzy.jpg', 3),
('Schweppes Bitter Lemon', 2.55, 53, 'Ebenfalls ein Klassiker überzeugt mit seinem bitteren Aroma.', '/img/upload/drink/schweppes_bitter_lemon.jpg', 3),
('Vivi Kola', 3.25, 54, 'Ein schweizer Originalprodukt, adaptiert vom Klassiker schlechthin.', '/img/upload/drink/vivi_kola.jpg', 3),
('Chicken Wings', 6.25, 55, 'Knusperige Wings, bedeckt mit einer intensiven Marinade die dir das Wasser im Mund zusammenlaufen lässt.', '/img/upload/snack/snacks_chicken_wings.jpg', 2),
('Nachos', 6.99, 56, 'Die traditionellen mexikanischen Chips, bedeckt mit geschmolzenem Cheddar-Käse.', '/img/upload/snack/snacks_nachos.jpg', 2),
('Onion Rings', 5.99, 57, 'Die geschmacksvolle Knolle mal anders. Mit Bierteig im heissen Fett frittiert, sind Zwiebelringe ein wahrer Genuss.', '/img/upload/snack/snacks_onion_rings.jpg', 2),
('Potato Wedges', 5.99, 58, 'Pommes mal anders. In einem etwas rustikalen Schnitt geben Kartoffeln einen göttlichen Snack ab.', '/img/upload/snack/snacks_potato_wedges.jpg', 2),
('Chopfab', 3.99, 59, 'Ein relativ neues, schweizer Produkt, aber schon jetzt ein Renner!', '/img/upload/drink/chopfab.JPG', 3);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_ingredient`
--

CREATE TABLE `product_ingredient` (
  `product_id` int(11) NOT NULL,
  `ingredient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `product_ingredient`
--

INSERT INTO `product_ingredient` (`product_id`, `ingredient_id`) VALUES
(32, 4),
(32, 7),
(32, 10),
(32, 19),
(32, 34),
(33, 4),
(33, 14),
(33, 15),
(33, 19),
(33, 35),
(34, 14),
(34, 16),
(34, 19),
(34, 34),
(35, 4),
(35, 14),
(35, 16),
(35, 34),
(36, 14),
(36, 34),
(36, 36),
(37, 4),
(37, 7),
(37, 15),
(37, 21),
(37, 23),
(37, 29),
(37, 30),
(38, 14),
(38, 23),
(38, 29),
(38, 30),
(38, 31),
(39, 7),
(39, 15),
(39, 23),
(39, 29),
(39, 30),
(39, 32),
(39, 33),
(40, 1),
(40, 14),
(40, 23),
(40, 31),
(40, 32),
(40, 33),
(42, 1),
(42, 2),
(42, 4),
(42, 11),
(42, 19),
(42, 20),
(43, 1),
(43, 2),
(43, 4),
(43, 11),
(43, 15),
(43, 20),
(44, 2),
(44, 15),
(44, 18),
(44, 20),
(44, 21),
(45, 1),
(45, 2),
(45, 12),
(45, 15),
(45, 22),
(46, 1),
(46, 2),
(46, 3),
(46, 4),
(47, 1),
(47, 2),
(47, 5),
(47, 6),
(47, 7),
(47, 8),
(47, 9),
(48, 2),
(48, 10),
(48, 12),
(49, 2),
(49, 12),
(49, 13),
(49, 14),
(50, 28),
(51, 28),
(52, 26),
(52, 27),
(53, 26),
(53, 27),
(54, 26),
(54, 27),
(55, 23),
(56, 7),
(56, 18),
(56, 19),
(56, 24),
(57, 15),
(58, 25),
(59, 28);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `prename` text NOT NULL,
  `lastname` text NOT NULL,
  `id` int(11) NOT NULL,
  `adress_id` int(11) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `adress`
--
ALTER TABLE `adress`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `ordering`
--
ALTER TABLE `ordering`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `ordering_product`
--
ALTER TABLE `ordering_product`
  ADD KEY `ordering_id` (`ordering_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indizes für die Tabelle `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indizes für die Tabelle `product_ingredient`
--
ALTER TABLE `product_ingredient`
  ADD PRIMARY KEY (`product_id`,`ingredient_id`),
  ADD KEY `ingredient_id` (`ingredient_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `adress_id` (`adress_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `adress`
--
ALTER TABLE `adress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT für Tabelle `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT für Tabelle `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT für Tabelle `ordering`
--
ALTER TABLE `ordering`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT für Tabelle `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `ordering`
--
ALTER TABLE `ordering`
  ADD CONSTRAINT `ordering_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `ordering_product`
--
ALTER TABLE `ordering_product`
  ADD CONSTRAINT `ordering_product_ibfk_1` FOREIGN KEY (`ordering_id`) REFERENCES `ordering` (`id`),
  ADD CONSTRAINT `ordering_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Constraints der Tabelle `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints der Tabelle `product_ingredient`
--
ALTER TABLE `product_ingredient`
  ADD CONSTRAINT `product_ingredient_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `product_ingredient_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredient` (`id`);

--
-- Constraints der Tabelle `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`adress_id`) REFERENCES `adress` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
