-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Lis 2021, 15:29
-- Wersja serwera: 10.1.38-MariaDB
-- Wersja PHP: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `laboratorium`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `element`
--

CREATE TABLE `element` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(40) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `model` varchar(60) NOT NULL,
  `fotografia` varchar(40) NOT NULL,
  `opis` varchar(200) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `url` varchar(200) NOT NULL,
  `liczba_sztuk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `element`
--

INSERT INTO `element` (`id`, `nazwa`, `model`, `fotografia`, `opis`, `url`, `liczba_sztuk`) VALUES
(1, 'Zlewka laboratoryjna mała', 'E234', 'zlewka', 'objętość: 200 ml, materiał: szkło', 'https://sklep-chemland.pl/pl/szklo-laboratoryjne/szklo-podstawowe/zlewki-szklane/zlewki-niskie/zlewka-niska-10000-ml-borokrzem-chemland.html', 31),
(2, 'Zlewka laboratoryjna duża', 'E834', 'zlewka_d', 'objętość: 400 ml, materiał: szkło', 'https://sklep-chemland.pl/pl/szklo-laboratoryjne/szklo-podstawowe/zlewki-szklane/zlewki-niskie/zlewka-niska-400-ml-borokrzem-chemland.html', 40),
(3, 'Zlewka laboratoryjna średnia', 'E534', 'zlewka_s', 'objętość: 300 ml, materiał: szkło', 'https://sklep-chemland.pl/pl/szklo-laboratoryjne/szklo-podstawowe/zlewki-szklane/zlewki-niskie/zlewka-300-ml-borokrzem-chemland.html', 10),
(4, 'Butelka z nakrętką', 'K123', 'butelka', 'Butelka z nakrętką i skalą 050ml BORO 3,3', 'https://sklep-chemland.pl/pl/szklo-laboratoryjne/butelki/butelki-z-nakretka/butelki-boro-3-3-z-nakretka/butelka-hl-z-nakretka/butelka-z-nakretka-i-skala-050ml-boro-3-3.html?___SID=U', 70),
(5, 'Butelka z nakrętką mała', 'K723', 'butelka_m', 'Butelka z nakrętką i skalą 010ml BORO 3,3', 'https://sklep-chemland.pl/pl/szklo-laboratoryjne/butelki/butelki-z-nakretka/butelki-boro-3-3-z-nakretka/butelka-hl-z-nakretka/butelka-z-nakretka-i-skala-010ml-boro-3-3.html', 90),
(6, 'Butelka Mac-Cartney', 'G123', 'butelka_mc', 'Butelka Mac-Cartney z nakrętką aluminiową 14ml', 'https://sklep-chemland.pl/pl/szklo-laboratoryjne/butelki/butelki-z-nakretka/butelki-boro-3-3-z-nakretka/butelki-mac-cartney/butelka-mac-cartney-z-korkiem-aluminiowym-14ml.html?___SID=U', 32),
(7, 'Butelka z nakrętką oranż', 'GW45', 'butelka_o', 'Butelka szklana z niebieską zakrętką GL 45, BORO 3.3.\r\nDo przechowywania substancji wrażliwych na światło.', 'https://sklep-chemland.pl/pl/szklo-laboratoryjne/butelki/butelki-z-nakretka/butelki-boro-3-3-z-nakretka/butelki-gwint-gl-45/butelki-szklo-oranzowe/butelka-z-nakretka-oranz-gw-45-0500ml.html?___SID=U', 10),
(8, 'Eksykator z tubusem', 'EKS234', 'eksykator', 'Eksykator szklany z pokrywą i tubusem komplet z wkładem porcelanowym. 100 mm', 'https://sklep-chemland.pl/pl/szklo-laboratoryjne/eksykatory/eksykator-z-tubusem/eksykator-z-tubusem-w-pokrywie-100.html?___SID=U', 12),
(9, 'Eksykator 100 bez tubusa', 'EKS456', 'eksykator_bez', 'Eksykator szklany z pokrywą bez tubusa wraz z wkładem porcelanowym.100 mm', 'https://sklep-chemland.pl/pl/szklo-laboratoryjne/eksykatory/eksykator-bez-tubusa/eksykator-100-bez-tubusa.html?___SID=U', 34),
(10, 'Termometr bagietkowy ', 'T546', 'termom', 'Termometr bagietkowy, szklany - wypełnienie bezrtęciowe, płynowe w opakowaniu ochronnym. Skala: 0 +50°C', 'https://sklep-chemland.pl/pl/urzadzenia-chemland/przyrzady-pomiarowe/termometry/termometry-bagietkowe/termometr-bagietkowy-plyn-00-50oc-1-1-l-300.html?___SID=U', 10),
(11, 'Czujnik temperatury', 'CT567', 'cz_temp', 'Czujnik - sonda do termometru cyfrowego YC811K. Max temperatura : ~700 °C.', 'https://sklep-chemland.pl/pl/urzadzenia-chemland/przyrzady-pomiarowe/termometry/termometry-elektroniczne/czujnik-temperatury-do-yc811k-dl-kabla-1-m.html', 3),
(12, 'Termometr cyfrowy', 'TC342', 'termometr_c', 'Zakres temperatur: -50 ° C ~ + 300 ° C (-58 ~ + 527 ° F) Stopień wyróżnienia: 0,1 ° C Dokładność: (-20 ° C ~ 80 ° C) ± 1 ° C', 'https://sklep-chemland.pl/pl/urzadzenia-chemland/przyrzady-pomiarowe/termometry/termometry-elektroniczne/termometr-cyfrowy-z-sonda-zewnetrzna-50-300oc.html', 4),
(13, 'Termometr ścienny', 'TS534', 'termometr_s', 'Termometr żółty wewnętrzny/zewnętrzny -30 +50 oC', 'https://sklep-chemland.pl/pl/urzadzenia-chemland/przyrzady-pomiarowe/termometry/termometry-scienne/termometr-wewnetrzny-zewnetrzny-30-50-oc.html?___SID=U', 7),
(14, 'PH-metr', 'PH888', 'phmetr', 'Ph-metr przenośny mini pH , mV , Temp. Kompaktowy miernik mikroprocesorowy w obudowie odpornej na zachlapania. ', 'https://sklep-chemland.pl/pl/urzadzenia-chemland/przyrzady-pomiarowe/urzadzenia-pomiarowe-testery/ph-metr-przenosny-mini-ph-mv-temp.html', 2),
(15, 'Wirówka laboratoryjna mini', 'W345', 'wirowka_m', 'Kompaktowa mini wirówka D 1008 Maksymalna prędkość 7000rpm/2680xg Dostarczany z rotorami 16x0,2ml, 8 x 1.5/2.0 mL.', 'https://sklep-chemland.pl/pl/urzadzenia-chemland/wirowki/wirowki/wirowka-laboratoryjna-mini-max-obroty-7000-rpm.html', 4),
(16, 'Wirówka laboratoryjna ', 'WR567', 'wirowka', 'Praca cicha przy szybkich obrotach Automatyczna blokada drzwi Over-speed - czujnik przekroczenia szybkości. Max. Prędkość : 15000 rpm (200-15000rpm), skok co 100rpm Max. RCF : 15100 × g, 100 rpm × g p', 'https://sklep-chemland.pl/pl/urzadzenia-chemland/wirowki/wirowki/wirowka-laboratoryjna-15000-rpm.html', 1),
(17, 'Płyta grzewcza', 'PG567', 'plyta_c', 'Cyfrowa płyta grzewcza, pokryta warstwą grafitu, dzięki której osiąga szybko zadaną temperaturę. Posiada kolorowy wyświetlacz LCD.', 'https://sklep-chemland.pl/pl/urzadzenia-chemland/plyty-grzewcze/plyta-grzewcza-nastawa-cyfrowa-wym-40x60cm-temp-400oc-dok-10.html', 1),
(18, 'Płyta grzewcza czworokątna', 'PGC456', 'plyta', 'Płyta grzewcza czworokątna o wymiarze 40x60cm, moc 3000 W, o max temperaturze 350 oC. Wykonie płyty - aluminum.', 'https://sklep-chemland.pl/pl/urzadzenia-chemland/plyty-grzewcze/plyta-grzewcza-czworokatna-40x60cm.html', 3),
(19, 'Płyta grzewcza LED', 'PGL345', 'plyta_l', 'Płyta grzewcza, ceramiczna z wyświetlaczem LED wskazującym temperaturę osiągniętą\r\ni temperaturę ustawioną. Maksymalna temperatura do 550° C.', 'https://sklep-chemland.pl/pl/urzadzenia-chemland/plyty-grzewcze/plyta-grzewcza-550-oc-powierzchnia-robocza-szklana-ceramika.html', 4),
(20, 'Mieszadełko cylindr', 'M345', 'mieszadelko', 'Mieszadełko cylindryczne OCTAGON w osłonie PTFE. Z pierścieniem oraz rdzeniem magnetycznym o wysokiej trwałości. ISO 9001/2000,FDA', 'https://sklep-chemland.pl/pl/urzadzenia-chemland/mieszadla/mieszadelka/mieszadelka-typ-octagon/mieszadelko-cylindr-octagon-ptfe-10-x-13.html?___SID=U', 60),
(21, 'Mieszadełko magnetyczne OVAL', 'MO234', 'mieszadelko_o', 'Mieszadełko magnetyczn PTFE z rdzeniem magnetycznym o wysokiej trwałości. Idealne do kolb okrągłodennych.', 'https://sklep-chemland.pl/pl/urzadzenia-chemland/mieszadla/mieszadelka/mieszadelka-typ-oval/mieszadelko-magnetyczne-oval-ptfe-10-x-20.html?___SID=U', 63),
(22, 'Mieszadełko cylindr PTFE ', 'MR45', 'mieszadelko_ptfe', 'Mieszadełko cylindryczne do mieszadeł magnetycznych typu POLYGON pokryte PTFE, odporne chemicznie.', 'https://sklep-chemland.pl/pl/urzadzenia-chemland/mieszadla/mieszadelka/mieszadelka-typ-polygon/mieszadelko-cylindryczne-ptfe-10-x-70-chemland.html?___SID=U', 45),
(23, 'Mieszadło magnetyczne 4 polowe', 'M596', 'mieszadlo', 'Mieszadło magnetyczne bez grzania 4. polowe max objętości na polu do 1000ml. Płyta ze stali nierdzewnej.', 'https://sklep-chemland.pl/pl/urzadzenia-chemland/mieszadla/magnetyczne/bez-grzania/mieszadlo-magnetyczne-4-polowe-bez-grzania-4x1000ml.html', 7),
(24, 'Mieszadło magnetyczne małe', 'MM09', 'mieszadlo_m', 'Kompaktowe mieszadło magnetyczne \"niebieskiej serii CHEMLAND\". Zakres: 100-1500 obr/min (maualna regulacja) Max ilość mieszaniny: 3L Obudowa z ABS materiałów ognioodpornych, odpornych na słabe kwasy i', 'https://sklep-chemland.pl/pl/urzadzenia-chemland/mieszadla/magnetyczne/bez-grzania/mieszadlo-magnetyczne-manualna-regulacja.html', 4),
(25, 'Mieszadło magnetyczne małe', 'MM09', 'mieszadlo_m', 'Kompaktowe mieszadło magnetyczne \"niebieskiej serii CHEMLAND\". Zakres: 100-1500 obr/min (maualna regulacja) Max ilość mieszaniny: 3L Obudowa z ABS materiałów ognioodpornych.', 'https://sklep-chemland.pl/pl/urzadzenia-chemland/mieszadla/magnetyczne/bez-grzania/mieszadlo-magnetyczne-manualna-regulacja.html', 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `element_tag`
--

CREATE TABLE `element_tag` (
  `element_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `element_tag`
--

INSERT INTO `element_tag` (`element_id`, `tag_id`) VALUES
(1, 1),
(1, 5),
(1, 10),
(2, 1),
(2, 10),
(3, 1),
(3, 10),
(4, 1),
(4, 9),
(5, 1),
(5, 9),
(6, 1),
(6, 9),
(7, 1),
(7, 9),
(8, 1),
(8, 11),
(9, 1),
(9, 11),
(10, 2),
(10, 3),
(10, 4),
(10, 8),
(11, 2),
(11, 3),
(11, 4),
(11, 8),
(12, 2),
(12, 3),
(12, 4),
(13, 4),
(14, 2),
(14, 8),
(15, 8),
(15, 12),
(16, 8),
(16, 12),
(17, 4),
(17, 8),
(17, 13),
(18, 4),
(18, 8),
(18, 13),
(19, 4),
(19, 8),
(19, 13),
(20, 5),
(21, 5),
(22, 5),
(23, 6),
(23, 8),
(24, 6),
(24, 8),
(25, 6),
(25, 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rodzaje_uzytkownikow`
--

CREATE TABLE `rodzaje_uzytkownikow` (
  `id` int(1) NOT NULL,
  `nazwa` varchar(20) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `rodzaje_uzytkownikow`
--

INSERT INTO `rodzaje_uzytkownikow` (`id`, `nazwa`) VALUES
(1, 'student'),
(2, 'opiekun');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `slowo` varchar(40) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `tag`
--

INSERT INTO `tag` (`id`, `slowo`) VALUES
(1, 'szkło'),
(2, 'przyrząd pomiarowy'),
(3, 'termometr'),
(4, 'temperatura'),
(5, 'mieszadełko'),
(6, 'mieszadło'),
(8, 'urządzenie'),
(9, 'butelka'),
(10, 'zlewka'),
(11, 'eksykator'),
(12, 'wirówka'),
(13, 'płyta grzewcza');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `id` int(11) NOT NULL,
  `login` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `imie` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `nazwisko` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_polish_ci NOT NULL,
  `haslo` varchar(200) CHARACTER SET latin1 NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`id`, `login`, `imie`, `nazwisko`, `email`, `haslo`, `status`) VALUES
(1, 'teresa.majewska', 'Teresa', 'Majewska', 'ter.maj@pw.edu.pl', '$2y$10$mYFrprvA/jfVo85dMiVcbuEu496/RpAFs/31/nb6cEhO2xFfsr1Cu', 2),
(3, 'adam.kura', 'Adam', 'Kura', 'akura@gmail.com', '$2y$10$XIeDec6HYJIisHhW7Jh4LeQJDoUt/adLu0kPDnirdssUwZUACmx72', 2),
(4, 'maja.wasz', 'Maja', 'Wasz', 'majawasz@gmail.com', '$2y$10$uEZNt3J5xVue1NFMUSGTfOgRRFNIrxYHrGiBdXvGS1Kl7ggjx8JRC', 2),
(5, 'marek.mostowiak', 'Marek', 'Mostowiak', 'marek.mostowiak@mjakmilosc.pl', '$2y$10$QOsCs7rtYMMcB1tvOMb7i.vhN0rNq33TLPs6E7pRFMME2JjKVqIXy', 2),
(6, 'ewa.rygiel', 'Ewa', 'Rygiel', 'ewaadam@biblia.com', '$2y$10$zrsWryXDsK1FgXLqDNHjn.0vhwmUiSJPuhyiVKUyHkj2ACww2Yn8i', 2),
(7, 'admin', 'admin1', 'admin1', 'arekpisak@admin.com', '$2y$10$xb3Djova2PzQiutrIaDI0Ob6/Gvu1hp4QSk4nUqMU2ALdrSmbxFee', 2),
(8, 'a.kiel', 'Asia', 'Kielecka', 'kkkk@kiel.pl', '', 1),
(9, 'p.kasp', 'Paulina', 'Kasperczyk', 'p.kasp@gmail.com', '', 1),
(10, 'p.jaki', 'Partyk', 'Jaki', 'p.jaks@poczta.pl', '', 1),
(11, 'admijknlin', 'hiulhui', 'lvgyuhvgh', 'fyulk@gjdtyj.pl', '$2y$10$GSr02eRDAEK7OqnQmQZwNOcGk/2ixDyCUNFkMbsOez/yE9Z0ey0Ai', 1),
(12, 'adminbigbhyu8', 'gvyikhgj', 'wesdxfgh', 'zsedx@ggrx.pl', '$2y$10$M9XwhQpgaR1jnzn/xFCafO6SdoPVEAmJSTovduqFTJfhs0L/0ktJG', 1),
(13, 'adminguj', 'dtfk', 'dfghj', 'derfgvthjb@t.pl', '$2y$10$CRdKz9nrFdQl9tF4Ta.ydeoZpAYRaucE57.5jO6pGhxoLgp3TZxsS', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypozyczenia`
--

CREATE TABLE `wypozyczenia` (
  `element_id` int(11) NOT NULL,
  `uzytkownik_id` int(11) NOT NULL,
  `ilosc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `wypozyczenia`
--

INSERT INTO `wypozyczenia` (`element_id`, `uzytkownik_id`, `ilosc`) VALUES
(6, 9, 1),
(11, 10, 1),
(24, 5, 3),
(14, 8, 1),
(11, 8, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `element`
--
ALTER TABLE `element`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `element_tag`
--
ALTER TABLE `element_tag`
  ADD PRIMARY KEY (`element_id`,`tag_id`),
  ADD KEY `element_tag_ibfk_2` (`tag_id`);

--
-- Indeksy dla tabeli `rodzaje_uzytkownikow`
--
ALTER TABLE `rodzaje_uzytkownikow`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indeksy dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD KEY `element_id` (`element_id`),
  ADD KEY `uzytkownik_id` (`uzytkownik_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `element`
--
ALTER TABLE `element`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT dla tabeli `rodzaje_uzytkownikow`
--
ALTER TABLE `rodzaje_uzytkownikow`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `element_tag`
--
ALTER TABLE `element_tag`
  ADD CONSTRAINT `element_tag_ibfk_1` FOREIGN KEY (`element_id`) REFERENCES `element` (`id`),
  ADD CONSTRAINT `element_tag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`);

--
-- Ograniczenia dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD CONSTRAINT `uzytkownicy_ibfk_1` FOREIGN KEY (`status`) REFERENCES `rodzaje_uzytkownikow` (`id`);

--
-- Ograniczenia dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD CONSTRAINT `wypozyczenia_ibfk_1` FOREIGN KEY (`element_id`) REFERENCES `element` (`id`),
  ADD CONSTRAINT `wypozyczenia_ibfk_2` FOREIGN KEY (`uzytkownik_id`) REFERENCES `uzytkownicy` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
