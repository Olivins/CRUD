

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET time_zone = "+00:00";

DROP DATABASE tabelasemformatacao;

CREATE DATABASE tabelasemFormatacao;
SELECT DATABASE tabelasemFormatacao;
CREATE TABLE `medico` (
  `id` int(11) NOT NULL,
  `nomeMedico` varchar(100) NOT NULL DEFAULT '',
  `especialidade` longtext NOT NULL, /*especialidade*/
  `crm` text NOT NULL /*shortDesc*/
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE `medico`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `medico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;


INSERT INTO `medico` (`nomeMedico`, `especialidade`, `crm`) VALUES
('Diogo','Newbie do Html','333333555MG'),
('Maylla','Design Full Stack','88888555MG'),
('Lucas','Conspiração Ogro','44444555MG');

