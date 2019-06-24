-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2019 at 03:45 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toyr`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteSpecialOffers` ()  BEGIN
    delete from promotions where  valid_from < CURRENT_TIMESTAMP AND CURRENT_TIMESTAMP > valid_until;
    delete from special_event where starting_date < CURRENT_TIMESTAMP AND CURRENT_TIMESTAMP > ending_date;
    delete from discounts   where valid_from < CURRENT_TIMESTAMP AND CURRENT_TIMESTAMP > valid_until;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `telephone` varchar(15) COLLATE utf8_general_mysql500_ci NOT NULL,
  `county` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `locality` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `street_address` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `postal_code` varchar(12) COLLATE utf8_general_mysql500_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(12, 'Jocuri și puzzle-uri', '2019-06-24 00:14:10', '2019-06-24 00:14:10'),
(13, 'Educaționale', '2019-06-24 00:14:21', '2019-06-24 00:14:21'),
(14, 'Figurine', '2019-06-24 00:14:29', '2019-06-24 00:14:29'),
(15, 'Vehicule', '2019-06-24 00:14:38', '2019-06-24 00:14:38'),
(16, 'Modele telghidate', '2019-06-24 00:14:46', '2019-06-24 00:14:46'),
(17, 'Păpuși', '2019-06-24 00:15:04', '2019-06-24 00:15:04'),
(18, 'Plușuri', '2019-06-24 00:15:13', '2019-06-24 00:15:13'),
(19, 'Creativitate', '2019-06-24 00:15:21', '2019-06-24 00:15:21'),
(20, 'Jucării din lemn', '2019-06-24 00:15:29', '2019-06-24 00:15:29'),
(21, 'Exterior', '2019-06-24 00:15:36', '2019-06-24 00:15:36'),
(22, 'Lego', '2019-06-24 00:15:45', '2019-06-24 00:15:45'),
(23, 'Arme de jucărie', '2019-06-24 00:15:58', '2019-06-24 00:15:58'),
(24, 'Hobby-uri și roleplay', '2019-06-24 00:16:05', '2019-06-24 00:16:05');

-- --------------------------------------------------------

--
-- Table structure for table `credit_cards`
--

CREATE TABLE `credit_cards` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `cardholder` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `card_number` varchar(16) COLLATE utf8_general_mysql500_ci NOT NULL,
  `expiration_month` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `expiration_year` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `security_code` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `discount_percentage` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `price_with_discount` decimal(10,2) UNSIGNED NOT NULL,
  `valid_from` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_until` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `product_id`, `discount_percentage`, `price_with_discount`, `valid_from`, `valid_until`, `created_at`, `updated_at`) VALUES
(10, 94, 30, '70.00', '2019-06-23 23:01:00', '2019-06-26 10:12:00', '2019-06-24 01:33:00', '2019-06-24 01:33:00'),
(11, 93, 10, '1210.50', '2019-06-23 22:12:00', '2019-06-26 22:12:00', '2019-06-24 01:33:45', '2019-06-24 01:33:45'),
(12, 81, 40, '54.00', '2019-06-15 22:12:00', '2019-06-30 10:31:00', '2019-06-24 01:37:22', '2019-06-24 01:37:22');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('paid','delivered','ongoing_delivery') COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE `orders_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(10) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `credit_card_id` int(11) NOT NULL,
  `amount` decimal(10,2) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `age_lower_bound` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `nr_sold` int(10) UNSIGNED DEFAULT '0',
  `description` text COLLATE utf8_general_mysql500_ci,
  `image` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `price` decimal(10,2) UNSIGNED NOT NULL,
  `units_in_stock` int(10) UNSIGNED DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `age_lower_bound`, `category_id`, `name`, `nr_sold`, `description`, `image`, `price`, `units_in_stock`, `created_at`, `updated_at`) VALUES
(70, 1, 18, 'Toto povesteste si canta', 0, 'Toto este ursuletul istet, care iti spune povesti, iti canta si interactioneaza cu tine! Citeste cu el! Canta cu el! Stie povesti si cantece traditionale romanesti! Are sase senzori pe corp, prin atingerea carora copiii pot interactiona cu el.\r\n\r\nToto spune cu multa iscusinta si mult haz opt povesti indragite din carticica lui magica.  Aceasta carticica, trimisa din Lumea Copiilor, iti va aduce opt povesti minunate. Ele te vor purta intr-o lume fabuloasa, pe care nu ai mai intalnit-o pana acum. Asculta-le, citeste-le si lasa-te fermecat de ele!', 'toto-1200x1200.jpg', '89.00', 20, '2019-06-24 00:35:02', '2019-06-24 00:35:02'),
(71, 3, 18, 'Catelusa Mera Golden Retriever-Jucarie de Plus', 0, 'Jucarie de plush Noriel Pets - Mera Catelusa golden retriever cu functii.\r\n\r\nMera e dragastoasa si ascultatoare si face tot ce poate ca sa te incante!\r\nScoate-o la plimbare si interactioneaza cu ea folosind lesa: Pune-a pe podea si impinge butonul lesei in sus ca s-o faci sa mearga in fata sau trage butonul in jos ca s-o faci sa latre si sa dea din coada! Ca s-o opresti, lasa butonul in pozitie intermediara.', 'Golden1-1200x1200.jpg', '74.00', 20, '2019-06-24 00:36:29', '2019-06-24 00:36:29'),
(72, 5, 18, 'Jucarie de Plus Noriel-Maimutica 15cm', 0, 'Descopera jucariile de plus de la Noriel Plush! Maimutica de 15 centimetri este tare caraghioasa, pregatita sa fie alaturi de micutul tau pas cu pas, in timp ce el descopera lumea. Colorata, va fi partenerul potrivit de joaca pentru cei mici.', 'Maimutica-1200x1200.jpg', '14.00', 100, '2019-06-24 00:37:19', '2019-06-24 00:37:19'),
(73, 3, 18, 'Moki Maimutica Vesela-Jucarie de Plus', 0, 'Moki e maimutica vesela care n-ar astampar! Atinge-o la subratul drept sau stang ca s-o gadili si priveste cum se maimutareste: da din maini, rade, chicoteste si raspandeste bucurie!', 'Moki-1200x1200.png', '69.00', 100, '2019-06-24 00:39:09', '2019-06-24 00:39:09'),
(74, 12, 18, 'Jucarie de plus Yo-Kai Watch - Blazion', 0, 'Yo-kai sunt creaturi invizibile care se fac vinovate de problemele de zi cu zi ale oamenilor. Oricine renunta la prietenia cu ei poate scapa de orice problema. Dar doar Nate este capabil sa le identifice si sa le urmareasca, cu ajutorul ceasului Yo-kai, pe care l-a descoperit intr-o zi, pe cand cauta insecte in padure. Nate si prietenii lui pornesc intr-o aventura in jurul orasului, in cautarea celui mai de temut Yo-kai, care este responsabil de o multime de probleme teribile.', 'jucarie-de-plus-yo-kai-watch-blazion_2.jpg', '20.00', 32, '2019-06-24 00:41:39', '2019-06-24 00:41:39'),
(75, 7, 18, 'Jucarie de plus Ursulet Gri, 24 cm', 0, 'Primul prieten al copilului dumneavoastra este pufos, usor de imbratisat in timpul somnului si care ii face cunostinta acestuia cu lumea inconjuratoare, atat de vasta si de interesanta! Cu totii ne amintim de ursuletul de plus carpit, cu un nasture cusut de mama sau de bunica, dar care ne insotea in fiecare zi in noi aventuri si noi descoperiri. Iar la fel este si cel mic! Pentru ca lumea e mai frumoasa atunci cand cel mai bun prieten este o jucarie de plus.\r\n\r\nPufos si catifelat, copilul tau se va indragosti de imediat de Ursulet gri', 'jucarie-de-plus-ursulet-gri-24-cm_2.jpg', '50.00', 60, '2019-06-24 00:43:09', '2019-06-24 00:43:09'),
(76, 10, 18, 'Jucarie de plus Disney Frozen Fever - Bulgarasii de zapada', 0, 'Bulgarasii de zapada de la Disney Frozen sunt pusi pe vorba! Trebuie doar sa deschizi un subiect, iar ei vor incerca sa continue discutie cu tine. Adorabili, complet diferiti, dar toti din zapada, acestia completeaza perfect coelctia oricarui copil care este in continuare fascinat de animatia Frozen. Prin joaca, se invata cel mai bine. Iar bulgarasii de zapada de la Disney Frozen sunt ideali pentru copii!', 'jucarie-de-plus-disney-frozen-fever-bulgarasii-de-zapada.jpg', '100.00', 2, '2019-06-24 00:43:55', '2019-06-24 00:43:55'),
(77, 3, 18, 'Jucarie de plus Elefant, 36 cm', 0, 'Un prieten vesel si rotofei care se pricepe de minune sa creeze... amintiri de plus! Tot ce trebuie sa faci ca sa obtii de la el o amintire noua este sa-l iei in brate, sa-l strangi bine si sa-l indragesti mult de tot!', 'plus-diverse-animale-36cm_4.jpg', '300.00', 3, '2019-06-24 00:48:21', '2019-06-24 00:48:21'),
(78, 2, 18, 'Jucarie de plus Donald Duck, 25 cm', 0, 'Camasa de marinar, berete, papion rosu, dar nu si pantaloni. Pe cine am descris acum? Pe Donald Duck, evident. Cu un temperament exploziv, Donald Duck este al treilea cel mai popular personaj pentru copii din toate timpurile si ii amuza la culme pe cei mici. Acum, cand vine sub forma de jucarie de plus, este ideal pentru cei din urma. Lumea arata altfel prin ochii lui.', 'jucarie-de-plus-donald-duck-25-cm.jpg', '678.00', 12, '2019-06-24 00:50:07', '2019-06-24 00:50:07'),
(79, 9, 18, ' Jucarie de plus Ice Age 5 - Space Scrat, 20 cm', 0, 'Veverita Scrat nu se da batuta niciodata in lupta de a dobandi sau apara o ghinda.\r\n\r\nNu este de mirare ca pateste fel de fel de lucruri neplacute: lovit de fulger, ingropat de o avalansa, ranit in numeroase batalii!\r\n\r\nIa-l acasa pe Space Scrat, astfel poti viziona noul episod a filmului, cu personajul preferat langa tine!\r\n\r\nObtine toate personajele din Ice Age 5, astfel vei avea o colectie completa, si poti juca scenele care au devenit preferate!', 'jucarie-de-plus-ice-age-5-space-scrat-20-cm.jpg', '489.00', 34, '2019-06-24 00:51:24', '2019-06-24 00:51:24'),
(80, 6, 18, 'Jucarie de plus Catel Bej cu fular, 37 cm', 0, 'Primul prieten al copilului dumneavoastra este pufos, usor de imbratisat in timpul somnului si care ii face cunostinta acestuia cu lumea inconjuratoare, atat de vasta si de interesanta! Pentru ca lumea e mai frumoasa atunci cand cel mai bun prieten este o jucarie de plus - Catelul bej cu fular.', 'jucarie-de-plus-catel-bej-cu-fular-37-cm.jpg', '67.00', 3, '2019-06-24 00:53:44', '2019-06-24 00:53:44'),
(81, 10, 18, ' Jucarie de plus Star Wars - Lead Trooper Commander, 17 cm', 0, 'Inspirata de seria Jedi Knight Space Saw, jucaria de plus Lead Trooper Commander este moale și foarte confortabila la atingere. Un cadou original, nu doar pentru fanii Star Wars!\r\n\r\nJucaria este fabricata din fibre de poliester si este potrivita pentru copii de la nastere.\r\n\r\nInaltimea jucariei este de aproximativ 17 cm.', 'sw-plus-lead-trooper-commander-17-cm.jpg', '90.00', 4, '2019-06-24 00:55:19', '2019-06-24 00:55:19'),
(82, 13, 20, 'Jucarie educativa din lemn Eichhorn', 0, 'Setul de construit de la Eichhorn cu forme geometrice din lemn ofera distractie prin invatarea formelor. \r\nCulorile luminoase si formele diferite, ii ajuta pe cei mici sa-si dezvolte simtul tactil si coordonarea mana-och.', '100002087_-jucarie_educativa_din_lemn_simba_eichhorn_1_.jpg', '200.00', 70, '2019-06-24 00:56:33', '2019-06-24 00:56:33'),
(83, 12, 20, 'Puzzle din lemn Oops, Animale din Padure', 0, 'Pune la incercare memoria ta cu acest puzzle din lemn. Te asteapta o joaca fenomenala cu aceasta jucarie, care poate fi folosit si de catre copii mici, nu numai de copii mari. Produsul respectiv este facut din lemn, deci calitatea exceptionala este garantata. O jucarie din lemn intotdeauna este mai speciala. Foloseste des acest produs fantastic!', '16009.10_001w_puzzle_din_lemn_oops_animale_din_padure.jpg', '400.00', 5, '2019-06-24 00:57:48', '2019-06-24 00:57:48'),
(84, 4, 20, ' Jucarie de impins din lemn Beeboo, 55 cm - Clawn', 0, 'Confectionata din lemn si pictata in culori vesele este jucaria preferata pentru dezvoltarea abilitatilor motrice (echilibru, coordonare, forta fizica)', 'clown.jpg', '18.00', 3, '2019-06-24 00:58:41', '2019-06-24 00:58:41'),
(85, 10, 12, 'Puzzle Noriel &ndash; Jocul antonimelor, 48 piese', 0, 'Invata sa recunosti conceptele cu sensuri opuse!\r\n\r\nSetul contine 48 de piese care se potrivesc cate doua, astfel: pe ambele piese sunt ilustratii similare, dar care infatiseaza stari, atribute sau notiuni opuse. Ilustratiile sunt insotite de cuvintele care denumesc conceptele reprezentate.', 'nor4024_001_puzzle_noriel_jocul_antonimelor_48_piese_1_.jpg', '40.00', 4, '2019-06-24 01:00:15', '2019-06-24 01:00:15'),
(86, 7, 12, 'Puzzle NORIEL - Harta Romaniei, 240 piese', 0, 'Puzzle-urile Noriel cu 240 de piese sunt distractive si educative, pline de viata si de culoare. Copiii vor invata sa gandeasca logic, sa caute solutii, sa recunoasca si sa potriveasca forme si culori. Tot ce trebuie pentru joaca si invatare! 240 de piese, 240 de motive de distractie.\r\n\r\nHarta Romaniei este reprezentata cu granite, relief si orase principale, reprezentand o buna initiere a celor mici in cunoasterea Romaniei ca stat si relief.', 'nor4544_fata.jpg', '50.00', 56, '2019-06-24 01:01:00', '2019-06-24 01:01:00'),
(87, 13, 12, 'Puzzle 3D Noriel - Cetatea Dragonului, 116 piese', 0, 'O cetate medievala de asamblat piesa cu piesa, o scena de lupta perfecta pentru jocul pe roluri in care tu esti cel mai viteaz, un set de joaca super distractiv!\r\n\r\nCeatea Dragonului are doua turnuri de aparare, o poarta culisanta, curte interioara cu scari si o multime de accesorii! Imbina piesele, asambleaz-o si pune in scena povestile care traiesc in imaginatia ta.', 'int6482_cetatea_dragonului_-_produs.jpg', '300.00', 12, '2019-06-24 01:01:57', '2019-06-24 01:01:57'),
(88, 8, 14, 'Figurine SW CLASIC - Chewbacca', 0, 'Figurina Star Wars - Razboiul Stelelor Clasic pentru copii. Aceaste figurine au o inaltime de aprox. 50 de cm si fac parte din colectia Star Wars Clasic. Marimea conteaza! De la Jakks Pacific Pacific ai acum noua linie de figurine mari Star Wars foarte detaliate! Disponibil in 3 modele diferite: Darth Vader, Chewbacca sau Boba Fett. Fiecare figurina se vinde separat! Varsta: 3+ Inaltime figurine aprox. 50 cm. Greutate produs: 750 gr Dimensiuni produs: 10 x 20 x 51 cm', 'blf-81871chewbacca-figurine-sw-clasic-chewbacca-0-1200x1200.jpg', '100.00', 5, '2019-06-24 01:03:36', '2019-06-24 01:03:36'),
(89, 7, 14, 'PUPPY DOG PALS FIGURINE CU LANSATOR - Bingo', 0, 'Puppy Dog Pals te invită să-i oferi celui mic ocazia să se joace și să exploreze cu Bingo și Rolly, doi cățeluși iubitori.  Bingo și Rolly se pot deplasa pe leagăn, pot lua liftul &icirc;n sus și &icirc;n jos, se pot da pe balansoar. Fiecare set conține și accesorii foarte captivante pentru cei mici. Setul contine: o figurina de actiune si accesorii.', 'blf-94020-1-puppy-dog-pals-figurine-cu-lansator-bingo-0-1200x1200.jpg', '70.00', 4, '2019-06-24 01:04:43', '2019-06-24 01:04:43'),
(90, 14, 22, 'LEGO&reg; Technic&trade; - Incarcator cu carlig ', 0, 'Deplaseaza marfa grea in vrac cu puternicul Incarcator cu carlig LEGO&reg; Technic&trade; 2-in-1. Aceasta reproducere robusta autentica a unui camion incarcator cu carlig real vine cu o cabina pentru sofer, pneuri pentru conditii grele, lumina mare de avertizare si o super schema de culori rosu, gri si negru. Condu incarcatorul in pozitie si activeaza sistemul de incarcare cu carlig pentru a cobori containerul. Apoi incarca marfa, muta containerul inapoi in camion si transporta bunurile la destinatie! Reconstruieste acest set pentru a crea un Camion de pompieri de aeroport.', 'lg42084_001_lego_technic_-_incarcator_cu_carlig_42084_.jpg', '234.00', 1, '2019-06-24 01:07:10', '2019-06-24 01:07:10'),
(91, 6, 22, 'LEGO&reg; City Great Vehicles - Furgoneta de pizza', 0, 'Comanda o pizza din mers!\r\n\r\nDeschide Furgoneta de pizza si pregateste-te sa primesti comenzi! Ia aluatul si apuca-te sa faci pizza. Taie o felie si serveste clientul infometat inainte de a pune in cutii cateva pizze proaspete pentru a le livra cu scuterul. A venit pizza, masa e servita!', 'lego-city-great-vehicles-furgoneta-de-pizza-60150.jpg', '56.00', 23, '2019-06-24 01:08:36', '2019-06-24 01:08:36'),
(92, 10, 23, 'Blaster Nerf N-Strike Elite, Rukkus Ics', 0, 'Acest blaster Nerf N-Strike Elite include un rezervor pentru 8 proiectile care trece automat la urmatorul proiectil. Rezervorul ramane atasat de blaster, fiind astfel rapid si usor de incarcat - poate fi incarcat fara a-l scoate de pe blaster. Incarca 8 proiectile in partea din fata a rezervorului, incarca si apasa pe tragaci pentru a lansa.', 'e2654_001w_blaster_nerf_n-strike_elite_rukkus_ics_3_.jpg', '100.00', 5, '2019-06-24 01:09:56', '2019-06-24 01:09:56'),
(93, 14, 23, 'Pusca AK-47 PHANTOM KING S47N cu bile de apa si laser', 0, 'Pusca AK-47 PHANTOM KING S47N cu bile de apa si laser , lungime 59 cm , Robetoyns', '0001334_mini-toy-ak-47-lights-and-sounds-machine-gun.jpg', '1345.00', 3, '2019-06-24 01:12:05', '2019-06-24 01:12:05'),
(94, 9, 23, 'Pistol de jucarie Poltie Gonher', 0, '-', 'PISTOL-POLITIE-Gonher-GH30736-230339-0.jpg', '100.00', 45, '2019-06-24 01:13:08', '2019-06-24 01:13:08'),
(95, 12, 23, 'Arizona pusca cu 8 focuri jucarie', 0, 'Armele cu cartuș de bandă &icirc;ntotdeauna au fost ușor de folosite, erau siguri și foarte distractivi. Fiecare &icirc;mpușcătură sună de parcă ar fi pistolul sau pușca adevărată. Această jucărie este special făcut pentru băieți, deci cu siguranță distracția o să fie garantată. Joaca poate sa inceapa? ', 'Arizona-atlatszo-8-lovetu-rozsapatronos-puska-tavcsovel-es-vallpanttal-65cm.jpg', '500.00', 123, '2019-06-24 01:45:20', '2019-06-24 01:45:20');

-- --------------------------------------------------------

--
-- Table structure for table `products_events`
--

CREATE TABLE `products_events` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `products_events`
--

INSERT INTO `products_events` (`id`, `product_id`, `event_id`) VALUES
(11, 94, 12),
(12, 93, 12),
(13, 92, 12);

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `product_bought_id` int(11) NOT NULL,
  `gifted_product_id` int(11) DEFAULT NULL,
  `product_units_bought` int(11) DEFAULT '1',
  `gifted_product_quantity` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_from` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_until` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `product_bought_id`, `gifted_product_id`, `product_units_bought`, `gifted_product_quantity`, `created_at`, `updated_at`, `valid_from`, `valid_until`) VALUES
(9, 92, 88, 2, 2, '2019-06-24 01:34:56', '2019-06-24 01:34:56', '2019-06-23 22:12:00', '2019-06-27 17:12:00'),
(10, 81, 89, 12, 3, '2019-06-24 01:38:49', '2019-06-24 01:38:49', '2019-06-23 12:32:00', '2019-06-28 22:03:00'),
(11, 75, 84, 1, 1, '2019-06-24 01:40:11', '2019-06-24 01:40:11', '2019-06-22 22:21:00', '2019-06-28 22:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `special_event`
--

CREATE TABLE `special_event` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `starting_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ending_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `image` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Dumping data for table `special_event`
--

INSERT INTO `special_event` (`id`, `name`, `starting_date`, `ending_date`, `created_at`, `updated_at`, `image`) VALUES
(12, 'Join the army', '2019-06-23 23:00:00', '2019-06-26 22:12:00', '2019-06-24 01:24:40', '0000-00-00 00:00:00', 'kids-army-shop-uk.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `password` text COLLATE utf8_general_mysql500_ci NOT NULL,
  `salt` text COLLATE utf8_general_mysql500_ci NOT NULL,
  `user_type` enum('admin','customer') COLLATE utf8_general_mysql500_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `avatar_img` blob,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_cards`
--
ALTER TABLE `credit_cards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cardholder` (`cardholder`,`card_number`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credit_card_id` (`credit_card_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `products_events`
--
ALTER TABLE `products_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_buyed_id` (`product_bought_id`),
  ADD KEY `gifted_product_id` (`gifted_product_id`);

--
-- Indexes for table `special_event`
--
ALTER TABLE `special_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `credit_cards`
--
ALTER TABLE `credit_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `products_events`
--
ALTER TABLE `products_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `special_event`
--
ALTER TABLE `special_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`id`) REFERENCES `payments` (`id`);

--
-- Constraints for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD CONSTRAINT `orders_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`credit_card_id`) REFERENCES `credit_cards` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_events`
--
ALTER TABLE `products_events`
  ADD CONSTRAINT `products_events_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_events_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `special_event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promotions`
--
ALTER TABLE `promotions`
  ADD CONSTRAINT `promotions_ibfk_1` FOREIGN KEY (`product_bought_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promotions_ibfk_2` FOREIGN KEY (`gifted_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `deleteSpecialOffers` ON SCHEDULE EVERY 4 SECOND STARTS '2019-06-24 01:50:57' ON COMPLETION PRESERVE ENABLE DO CALL DeleteSpecialOffers()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
