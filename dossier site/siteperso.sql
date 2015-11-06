-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Dim 11 Janvier 2015 à 19:58
-- Version du serveur :  5.5.38
-- Version de PHP :  5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `siteperso`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
`ID` int(11) NOT NULL,
  `name_fr` varchar(100) DEFAULT NULL,
  `name_en` varchar(100) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`ID`, `name_fr`, `name_en`) VALUES
(1, 'Journaux Nationaux et Internationaux', 'International Journals'),
(2, 'Conf', 'International and national conferences '),
(3, 'Documentation technique', 'Technical documentation'),
(4, 'Th', 'Thesis'),
(5, 'Divers', 'Miscellaneous');

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE `menu` (
`ID` int(11) NOT NULL,
  `titre_fr` varchar(20) DEFAULT NULL,
  `titre_en` varchar(20) DEFAULT NULL,
  `actif` int(1) NOT NULL,
  `position` int(5) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `menu`
--

INSERT INTO `menu` (`ID`, `titre_fr`, `titre_en`, `actif`, `position`) VALUES
(7, 'Outils', 'tools', 1, 5),
(2, 'Home', 'Home', 1, 2),
(6, 'Enseignement', 'Teaching', 1, 4),
(4, 'Recherche', 'Research', 1, 3),
(8, 'Liens', 'Links', 1, 6);

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

CREATE TABLE `publication` (
`ID` int(11) NOT NULL,
  `reference` text,
  `auteurs` text,
  `titre` text,
  `date` date NOT NULL,
  `journal` text,
  `volume` text,
  `number` text,
  `pages` text,
  `note` text,
  `abstract` text,
  `keywords` text,
  `series` text,
  `localite` text,
  `publisher` text,
  `editor` text,
  `pdf` text,
  `date_display` text,
  `categorie_id` int(5) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `publication`
--

INSERT INTO `publication` (`ID`, `reference`, `auteurs`, `titre`, `date`, `journal`, `volume`, `number`, `pages`, `note`, `abstract`, `keywords`, `series`, `localite`, `publisher`, `editor`, `pdf`, `date_display`, `categorie_id`) VALUES
(1, 'SR08a', 'S. Salva and A. Rollet', 'Testabilit', '2008-06-01', 'Revue Ing', '13', '3', '35--58', 'Usually, Web service compositions are tested by assuming\nthat these ones are executed inside an open environment where all\nthe messages exchanged between the services participating to the\ncomposition are observable. Nevertheless, when services are\ndeployed in partially open environments e.g., Clouds, this\nassumption cannot be sustained. This paper proposes a method to\ncheck whether a service composition is conform to its\nspecification according to the ioco test relation, by considering\nthat the internal messages exchanged between the services are\nhidden but that we can invoke each service directly (or an exact\ncopy). Specifications are modelled with Symbolic Transition\nSystems (STS) that we specialize in Web services with some\nannotations and functions. Our approach consists in decomposing an\nexisting test case set according to the operation interleaving\nthat we formalize with a factor denoted the dependency degree.\nThen, while executing the new test case set, we recover fragments\nof traces (observable reactions) that are reassembled. With the\nfinal traces, we are able to check whether the implemented\ncomposition is ioco-conform to its specification. We illustrate\nour approach with an example derived from the application of\nElectronic Health Record externalization for both patients and\npractitioners, currently in development by the Orange Business Service company.', '', 'composition; partially open environment; ioco test relation; conformance testing; trace reconstruction', '', '', 'Hermes, Lavoisier', '', '', '2008', 1),
(2, 'SF04', 'S. Salva and H. Fouchal', 'Testability Analysis for Timed Systems', '2004-05-01', 'International Journal of Computers and Their Applications (IJCTA)', '', '', '', '', '', '', '', '', '', '', '', '', 1),
(3, 'BFPS01', 'S. Bloch and H. Fouchal and E. Petitjean and  S. Salva', 'Some Issues on Testing Real-Time Systems', '2001-12-01', 'International Journal in Computer Information Science (IJCIS)', '2', '4', '', '', '', '', '', '', 'ACIS', '', '', '', 1),
(4, 'RS09', 'A. Rollet and S. Salva', 'Testing robustness of communicating systems using ioco-based approach', '2009-07-05', 'Proceedings of In 1st IEEE Workshop on Performance evaluation of communications in distributed systems and Web based service architectures, in conjunction with IEEE ISCC 2009', '', '1530-1346 ', '67-72', '', '', '', '', 'Sousse, Tunisia', 'IEEE', '', 'useruploads/files/RS09.pdf', 'July 5 - 8, 2009', 2),
(6, 'SR09b', 'S. Salva and I. Rabhi', 'Automatic web service robustness testing from WSDL descriptions', '2009-05-14', '12th European Workshop on Dependable Computing, EWDC 2009', '', '', '', 'Web Services fall under the so-called emerging technologies\ncategory and are getting more and more used for Internet\napplications or business transactions. Since web services are used\nin large and heterogeneous applications, they need to be reliable.\nSo, we propose in this paper, a robustness testing method which\ngenerates and executes test cases automatically from WSDL\ndescriptions. We analyze the web service observability to find the\nrelevant hazards which may be used for testing and those which are\nalways blocked by SOAP processors. We show that few hazards can be\nreally handled. By reducing them, we reduce the test cost too. We\nimprove the robustness issue detection by separating the SOAP\nprocessor behavior to the web service one. With an academic tool,\nwe show that many web services have robustness issues and that our\nmethod is able to detect them.', '', 'robustness testing, web services, test framework', '', 'Toulouse, France ', '', '', 'useruploads/files/SR09b.pdf', 'may 2009', 2),
(7, 'SL09', 'S. Salva and P. Lauren', 'Automatic Ajax application testing', '2009-05-24', 'Fourth International Conference on Internet and Web Applications and Services, ICIW 2009', '', '', '229-234', 'Asynchronous javascript and XML (AJAX) is a recent group of\ntechnologies used to develop dynamic web pages. Ajax applications\nare wisely used nowadays and need to be tested to ensure their\nreliability.  This paper introduces a method and an architecture\nfor automatic AJAX application testing. We use STS automata for\ndescribing the application and for generating test cases. We\nperform an improved random testing using some predefined values\nand also test purpose based testing for verifying specific properties.\nThe testing framework is composed of several testers which control and monitor the test\nexecution to give a test verdict. The Google map search\napplication is used as an example to illustrate the method', '', 'conformance testing, Ajax application, test architecture', '', 'Venice/Mestre, Italy', 'IEEE Computer Society Press', '', 'useruploads/files/SL09.pdf', 'may 2009', 2),
(8, 'SR08', 'S. Salva and A. Rollet', 'Automatic web service testing from WSDL Descriptions', '2008-06-16', '8th International Conference on Innovative Internet Community Systems I2CS 2008', '2011', '', '', '', '', '', 'Lecture Notes in Informatics (LNI)', 'Schoelcher, Martinique', 'Gesellschaft f', '', 'useruploads/files/SR08.pdf', 'June 16-18, 2008,', 2),
(9, 'RS08', 'A. Rollet and S. Salva', 'Two complementary approaches to test robustness of reactive systems (Invited paper)', '2008-05-22', '17th IEEE International Conference on Automation, Quality and Testing, Robotics AQTR 2010', '', '', '47--53', '', '', '', '', 'Cluj-Napoca, Romania', 'IEEE Computer Society Press', '', 'useruploads/files/RS08.pdf', 'May 22-25 2008', 2),
(56, 'SBD07', 'S. Salva and C. Bastoul and C. Delamare', 'Web Service Call Parallelization Using OpenMP', '2007-06-20', '3rd INTERNATIONAL WORKSHOP on OpenMP (IWOMP) 2007', '4935/2008', '', '185-194', '', '', '', 'LNCS', 'Tsinghua University, Beijing, China', 'Springer Verlag', '', '', '2007', 2),
(49, 'S11c', 'S', 'An Approach For Testing Web Service Compositions When Internal Messages Are Unobservable', '2011-09-01', 'International Journal of Electronic Business Management (IJEBM), Special Issue on New web technologies for collaborative product and process commerce and concurrent engineering', '9', '4', '334-344', 'Usually, Web service compositions are tested by assuming that all the messages ex-changed between the services, participating to the composition, are observable. Nev-ertheless, when services are deployed in an infrastructure which restricts access or when they are deployed on Clouds, this assumption cannot be sustained. Indeed, these environments do not allow extracting the observable reactions of a composition under test (impossibility to install testers or sniffer based tools in the environment). So, this paper proposes a method to check whether a service composition conforms its speci-fication with reference to the ioco test relation, by considering that the internal mes-sages exchanged between the services are hidden but that we can invoke each service one by one (or an exact copy). We propose a method which decomposes an existing test case set according to the operation interleaving that we formalize with a factor denoted the dependency degree. Then, while executing the new test case set, we re-cover fragments of traces (observable reactions) that are reassembled. With the final traces, we are able to check whether the implemented composition is ioco-conform to its specification in the real environment where is deployed the composition.', 'submitted: 2011 january\naccepted: 2011 may\n', 'Web service composition, ioco test relation, conformance testing, trace reconstruction  ', '', '', 'Electronic Business Management Society', '', '', 'nov, 2011', 1),
(11, 'SL07', 'S. Salva and P. Lauren', 'Generation of tests for real-time systems with test purposes', '2007-03-29', '15th International Conference on Real-Time and Network Systems RTNS07', '', '', '35-44', '', '', '', '', 'Nancy, France ', '', '', '', 'march, 2007', 2),
(12, 'SL05', 'S. Salva and P. Lauren', 'G', '2005-04-29', 'Colloque Francophone de l ing', '', '', '', '', '', '', '', 'Bordeaux, France', 'lavoisier', '', '', 'abril, 2005', 2),
(13, 'SL04', 'P. Lauren', 'Testing mobile and distributed systems : method and experimentation', '2004-12-01', '8th International Conference on Distribued Systems (OPODIS)', '', '', '', '', '', '', 'LNCS 3544 2005', 'Grenoble, France', 'springer', '', '', 'dec, 2004', 2),
(14, 'SL03a', 'S. Salva and P. Lauren', 'A Testing Tool using the State Characterization Approach for Timed Systems', '2003-09-01', 'WRTES, satellite workshop of FME symposium', '', '', '', '', '', '', '', 'Pisa, Italy', '', '', '', 'sept 2003', 2),
(15, 'SL03b', 'S. Salva and P. Lauren', 'G', '2003-12-01', 'Colloque Francophone de l ing', '', '', '', '', '', '', '', 'Paris, France', 'lavoisier', '', '', 'dec 2003', 2),
(16, 'SF02', 'S. Salva and H. Fouchal', 'Une m', '2002-04-01', 'RENPAR14', '', '', '', '', '', '', '', 'Hamamet, Tunisie', '', '', '', 'abr 2002', 2),
(17, 'S02', 'S. Salva', 'Testing temporal and behavior events on timed systems with timed test purposes', '2002-12-01', '6th International Conference on Distribued Systems (OPODIS)', '', '', '73--84 ', '', '', '', '', 'Reims, France', 'Studia Informatica Universalis', '', '', 'dec 2002', 2),
(18, 'SRF02', 'S. Salva and A. Rollet and H. Fouchal', 'Temporal and Behavior Characterization of States in Timed Systems', '2002-08-01', '23rd ACIS Annual International Conference on Computer and Information Science (ICIS02)', '', '', '', '', '', '', '', 'Seoul, South Korea', '', '', '', 'aug 2002', 2),
(19, 'FPS01', 'H. Fouchal and E. Petitjean and S. Salva', 'A User-Oriented Testing of Real Time Systems', '2001-12-01', 'IEEE/IEE Real-Time Embedded Systems Workshop (RTES), satellite of RTSS', '', '', '', '', '', '', '', 'London, UK', 'IEEE Computer Society 2001', '', '', 'dec, 2001', 2),
(20, 'SF01a', 'S. Salva and H. Fouchal', 'Some Parameters for Timed System Testability', '2001-06-01', 'ACS/IEEE International Conference on Computer System and Applications (AICCS01 )', '', '', '335-', '', '', '', '', 'Beirut, Lebanon', 'IEEE Computer Society', '', '', 'june, 2001', 2),
(21, 'SF01c', 'S. Salva and H. Fouchal', 'Timed Test Execution and TTCN generation', '2001-08-01', '2nd International Conference on Software Engineering applied to Networking and Parallel/Distributed Computing (SNPD02)', '', '', '', '', '', '', '', 'Nagoya, Japon', 'ACIS', '', '', 'aug 2001', 2),
(22, 'SF01d', 'S. Salva and E. Petitjean and H. Fouchal', 'A Simple Approach for Timed System Testing', '2001-08-01', 'Formal Approaches to Testing of Software (FATES01), A Satellite Workshop of CONCUR01', '', '', '', '', '', '', '', 'Aalborg, Denmark', '', '', '', 'aug 2001', 2),
(23, 'S01', 'S. Salva', 'La qualit', '2001-04-01', '3eme Colloque sur la Mod', '', '', '', '', '', '', '', 'Troyes, France', '', '', '', 'abr 2001', 2),
(24, 'FPS00', 'H. Fouchal and E. Petitjean and S. Salva', 'Timed testing using test purposes', '2000-12-01', '7th IEEE International Conference on Real-Time Computing Systems and Applications (RTCSA00)', '', '', '166-171', '', '', '', '', 'Cheju Island, South Korea', 'IEEE Computer Society', '', '', 'dec 2000', 2),
(25, 'SFB00', 'S. Salva and H. Fouchal and S. Bloch', 'Metrics for Timed Systems Testing', '2000-12-01', '4th International Conference on Distribued Systems (OPODIS)', '', '', '', '', '', '', '', 'Paris, France', '', '', '', 'dec 2000', 2),
(26, 'SALV01', 'S. Salva', 'Th', '2001-12-01', '', '', '', '', 'Le co', '', 'conformance testing, timed systems, testability', '', 'reims, france', '', '', 'useruploads/files/SALV01.PDF', 'dec, 2001', 4),
(27, 'SALV0', 'S. Salva', 'seminaire Testabilit', '2000-10-01', '', '', '', '', '', '', '', '', '', '', '', 'useruploads/files/SALV0.pdf', 'oct, 2000', 5),
(28, 'SALV02', 'S. Salva', 'S', '2002-03-01', '', '', '', '', '', '', '', '', '', '', '', 'useruploads/files/SALV02.pdf', 'march, 2002', 5),
(29, 'RR02', 'S. Salva and H. Fouchal', 'Research report: The influence of time in timed systems testing', '2002-01-01', '', '', '', '', '', '', '', '', '', 'LERI-Resycom', '', 'useruploads/files/RR02.pdf', '2002', 3),
(30, 'RR03', 'S. Salva and J. Toussain', 'Research report: Description d?un outil de g', '2003-01-01', '', '', '', '', '', '', '', '', '', '', '', 'useruploads/files/RR03.pdf', '2003', 3),
(31, 'SALV07a', 'S. Salva', 'S', '2007-01-01', '', '', '', '', '', '', '', '', '', '', '', 'useruploads/files/SALV07a.pdf', '2007', 5),
(32, 'SALV07b', 'S. Salva', 'S', '2007-01-01', '', '', '', '', '', '', '', '', '', '', '', 'useruploads/files/SALV07b.pdf', '2007', 5),
(33, 'RR09', 'Salva Sebastien and Issam Rabhi', 'research report: Statefull web service robustness, extended paper', '2009-09-01', '', '', '', '', '', 'http://www.isima.fr/limos/publi/RR-09-09.pdf', '', '', '', '', '', '', '2009', 3),
(39, 'SR10', 'S. Salva and I. rabhi', 'Statefull web service robustness', '2010-05-09', 'The Fifth International Conference on Internet and Web Applications and Services, ICIW10', '', '', '167-173 ', 'Web Services fall under the so-called emerging technologies\ncategory and are getting more and more used for Internet\napplications or business transactions. Since Web Services are\noften the foundation of large applications, they need to be\nreliable and robust. So, we propose in this paper, a robustness\ntesting method of stateful Web Services, modeled with Symbolic\nTransition Systems \\cite{FTW05}. We analyze the Web Service\nobservability and the hazard effectiveness in a SOAP environment\n\\cite{SOAP}. Then, we propose a test case generation method based\non the two hazards "Using unusual values" and "Replacing /Adding\noperation names", which are the only ones that can be applied. The\nAmazon E-commerce Web Service is taken as example', '', 'Robustness testing, stateful Web Services, STS, test architecture', '', 'Barcelona, Spain', 'IEEE Computer Society Press', '', 'useruploads/files/SR10.pdf', 'May 9 - 15, 2010 ', 2),
(42, 'SLR10', 'Sebastien Salva and Patrice Laurencot and Issam Rabhi', 'An Approach Dedicated for Web Service Security Testing', '2010-08-22', '5th International Conference on Software Engineering Advances, International Conference, ICSEA10', '', '', '494-500', 'Web Services are more and more used in designing and building\nsystems in open and dynamic distributed environments. The security\nof these transactions is becoming a critical issue. This paper\nproposes a security testing method for stateful Web Services. We\ndefine some specific security rules with the Nomad language. Then,\nwe construct test cases from a symbolic specification and test\npurposes derived from the previous rules. We present some\nexperimentation results based on roughly 100 Web Services and we\nshow that 11 percent have vulnerabilities, using the rules introduce in the article.', '', 'Web Services; Security rules; Test purposes; Test generation', '', 'Nice, France', 'IEEE Computer Society', '', 'useruploads/files/SLR10.pdf', 'August 22-27, 2010', 2),
(41, 'SR10c', 'S. Salva and I. Rabhi', 'A BPEL observability enhancement method', '2010-07-05', 'Proceedings of the 2010 8th IEEE International Conference on Web Services, ICWS 2010', '', '', '638--639', '', '', 'BPEL, testability, observability, enhancement methods', 'ICWS ''10', 'Miami, USA', 'IEEE Computer Society ', '', '', 'july, 5-10, 2010', 2),
(40, 'SR10b', 'S. Salva and I. Rabhi', 'A preliminary study on BPEL process testability', '2010-04-01', 'QuomBat2010, ICST Workshop on Quality of Model-Based Testing, Co-located with  ICST  2010, Third International Conference on Software Testing, Verification, and Validation Workshops (ICSTW), 2010 Third International Conference on Software Testing, Verification, and Validation Workshops (ICSTW), 2010', '', '', '62-71', '', '', '', '', 'Paris, France', 'IEEE Computer Society', '', 'useruploads/files/SR10b.pdf', 'April 10, 2010', 2),
(43, 'CZ10', 'Cavalli, A.  Tien-Dung Cao  Mallouli, W.  Martins, E.  Sadovykh, A.  Salva, S.  Zaidi, F.', 'WebMov: A Dedicated Framework for the Modelling and Testing of Web Services Composition', '2010-07-22', 'ICWS 2010 - 8th IEEE International Conference on Web Services', '', '', '377-384', '', '', '', '', 'Miami, USA', 'IEEE Computer Society', '', '', 'July 2010', 2),
(44, 'SR09', 'S. Salva, A. Rollet', 'Test purpose generation for timed protocol testing', '2009-07-20', 'Proceedings of the 2009 Second International Conference on Communication Theory, Reliability, and Quality of Service, CTRQ 2009', '', '', '8--14', '', '', '', '', 'Colmar, France', 'IEEE Computer Society Press ', '', 'useruploads/files/SR09.pdf', 'July 20-25, 2009 ', 2),
(45, 'SR10d', 'S. Salva and I. Rabhi', 'Robustesse des Services Web persistants', '2010-05-01', 'MOSIM10, 8', '', '', '', '', '', '', '', 'Hammanet, Tunisy', '', '', '', 'may, 2010', 2),
(52, 'S11d', 'S', 'Passive testing with proxy tester', '2011-10-01', 'International Journal of  Software Engineering and Its Applications (IJSEIA)', '5', '4', '1--16', 'Passive testing is an alternative testing approach whose purpose\nis to passively analyze an implementation behaviour without\ndisturbing it. Usually, passive testing methods extract traces by\nmeans of sniffer-based tools, running in the same environment as\nthe implementation. Nevertheless, many implementation environments\nprevent from setting a sniffer-based tool for security or\ntechnical reasons. We propose a passive testing method based on\nthe notion of proxy-tester which represents an intermediary\nbetween client applications and the implementation. We define a\nproxy-tester as a product between the specification and its\ncanonical tester, which is able to receive the client traffic and\nto forward it to the implementation and vice versa. It also aims\nto analyze the implementation traces to detect faults. We define a\nnon conformance relation between the implementation, its\nspecification and the external environment from which is received\nthe client traffic. We also provide some preliminary results on\nthe Amazon E-commerce Web service and discuss about the\nproxy-tester benefits.\n', 'submitted: 2011 june\naccepted 2011 august\npublished 2011 october', 'passive testing; proxy-tester; STS; conformance relation.', '', '', 'Science & Engineering Research Support soCiety  (SERSC)', '', '', 'october 2011', 1),
(53, 'S12b', 'S', 'Modelling and testing of service compositions in partially open environments', '2012-05-01', 'Studia Unformatica Universalis, special issue on "Mod', '10', '1', '155-185 ', '', 'submitted: 2011 march\naccepted: 2011 september\n', '', '', '', 'HERMANN', '', 'useruploads/files/S12b.pdf', 'may 2012', 1),
(54, 'S12f', 'S. SALVA and A. Rollet', 'A pragmatic approach for testing stateless and stateful Web Service Robustness', '2012-10-01', 'Studia Informatica Universalis', '10', '2', '139-179', 'The interest in testing methodologies dedicated to Web\nServices is soaring as much as the massive use of these\ncomponents. Since Web Services are heterogeneous in nature and\ntake part in complex Business processes, robustness testing which\nis the topic of this paper, is an important step to build them\nwith confidence. Firstly, we focus on the SOAP environment which\nis used to call Web Service operations in an XML format. We show\nthat SOAP must be taken into account in testing methods because it\nsubstantially modifies the Web Service observable behaviour and\nblocks many classical hazards used for testing. Then, we propose\ntwo approaches: the first one aims to test stateless Web Services,\nrepresented by relational models. The second approach is dedicated\nto stateful ones modelled with Symbolic Transition Systems. For\nboth methods, the SOAP environment is taken into account by\nfiltering the messages or by completing the specification. These\nmethods have been experimented with an academic tool on many Web\nServices deployed on the Internet. This experimentation shows that\nseveral ones have robustness issues and that our methods are able\nto detect them.', '', 'Robustness testing; stateless, stateful Web Services; testing framework', '', '', 'Hermann', '', '', '2012', 1),
(46, 'S11', 'S. Salva', 'An observability enhancement method of ABPEL specifications', '2011-03-27', 'The 2nd International Conference on    Engineering and Meta-Engineering: ICEME 2011   ', '', '', '1--6', '', '', '', '', 'Orlando, Florida USA', 'IIIS', '', 'useruploads/files/S11.pdf', 'March 27-30, 2011 ', 2),
(47, 'S11b', 'S. Salva', 'Automatic test purpose generation for Web services', '2011-06-20', 'International Conference on Electric and Electronics (EEIC 2011) ', '99', '1876-1100', '721--728', '', '', '', 'Lecture Notes in Electrical Engineering', 'Nanchang University, China ', 'Springer Berlin Heidelberg', 'Wang, Xiaofeng', 'useruploads/files/S11b.pdf', 'june 20-22, 2011', 2),
(55, 'SR11', 'S. SALVA and I. Rabhi', 'A Test Purpose and Test Case Generation Approach for SOAP Web Services', '2011-10-23', 'The Sixth International Conference on Software Engineering Advances  ICSEA 2011', '', '', '35-42', '', '', '', '', 'barcelona, spain', 'XPS (Xpert Publishing Services)', '', 'useruploads/files/SR11.pdf', '2011, October 23-29', 2),
(57, 'S12a', 'S', 'A Guided Web Service Security Testing Method', '2012-04-20', 'Book: Emerging Informatics - Innovative Concepts and Applications, Chapter 11', '', '', '195-222', 'http://www.intechopen.com/books/emerging-informatics-innovative-concepts-and-applications/a-guided-web-service-security-testing-method', '', '', '', '', 'Intech', 'Shah Jahan (Ed.)', '', '2012-04-20', 1),
(59, 'S12c', 'S', 'HDR (Habilitation ', '2012-05-18', 'Universit', '', '', '', '', '', '', '', '', '', '', 'useruploads/files/hdr.pdf', '2012, may', 4),
(63, 'SR11b', 'S', 'Automatic web service testing from wsdl descriptions. ', '2011-06-01', 'In 11th International Conference on Innovative Internet Community Services (I2CS 2011)', '186', '', '217--226', '(late publication of [SR08])', '', '', '', 'Berlin, Germany', '', 'Lecture Notes in Informatics', '', '2011 june', 2),
(61, 'ZSP12', 'Stassia R. Zafimiharisoa and S. Salva and P. Lauren', 'An Automatic Security Testing approach of Android Applications', '2012-11-18', 'The Seventh International Conference on Software Engineering Advances (ICSEA 2012)', '', '', '643-646', '', '', '', '', 'Lisbon, Portugal', 'XPS (Xpert Publishing Services),', '', 'useruploads/files/ZSP12.pdf', '2012 nov.', 2),
(62, 'RR-13-04', 'S', 'A Model-based testing approach combining passive testing and runtime verification. Application to Web service composition testing in Clouds, Reseach report RR13-04', '2013-04-01', '', '', '', '', '', '', '', '', '', '', '', 'useruploads/files/RR-13-04.pdf', '2013, abril', 3),
(64, 'S12e', 'S', 'Passive Testing of Symbolic Systems. A IOCO Proxy-Tester Based Approach', '2012-07-01', 'International Review on Computers and Software (IRECOS)', '7', '4', '', '', '', '', '', '', '', 'praise worthy prize', '', '2012 july', 1),
(65, 'S12d', 'S', 'An approach for testing passively Web service compositions in Clouds', '2012-07-01', 'SERP''12, The 2012 International Conference on Software Engineering Research and Practice, WorlComp''12', '', '', '', '', '', '', '', '', '', '', '', '2012 july', 2),
(66, 'SC13', ' S', 'Combining Passive Conformance Testing and Runtime Verification: Application to Web Service Compositions Deployed in Clouds', '2013-08-01', 'Software Engineering Research, Management and Applications', '496', '', '99-116', 'This paper proposes a model-based testing approach which combines two monitoring methods, runtime verification and passive testing. Starting from ioSTS (input output Symbolic Transition System) models, this approach generates monitors to check whether an implementation is conforming to its specification and meets safety properties. This paper also tackles the trace extraction problem by reusing the notion of proxy to collect traces from environments whose access rights are restricted. Instead of using a classical proxy to collect traces, we propose to generate a formal model from the specification, called Proxy-monitor, which acts as a proxy and which can directly detect implementation errors. We apply and specialise this approach on Web service compositions deployed in PaaS environments.', '(selected publication of ', '          Passive Testing         Runtime Verification         Proxy         ioco         Web services         Clouds', 'Studies in Computational Intelligence', '', 'Lee, Roger', 'Springer International Publishing', 'useruploads/files/SC13.pdf', '2013 july', 1),
(67, 'SZ13', 'S', 'Data vulnerability detection by security testing for Android applications', '2013-08-01', '2013 Information Security for South Africa, Johannesburg,                South Africa (ISSA), August 14-16', '', '', '1-8', '', '?The Android intent messaging is a mechanism that ties components together to build Mobile applications. Intents are kinds of messages composed of actions and data, sent by a component to another component to perform sev- eral operations, e.g., launching a user interface. The intent mechanism eases the writing of Mobile applications, but it might also be used as an entry point for security attacks. The latter can be easily sent with intents to components, that can indirectly forward attacks to other components and so on. In this context, this paper proposes a Model-based security testing approach to attempt to detect data vulnerabilities in Android applications. In other words, this approach generates test cases to check whether components are vulnerable to attacks, sent through intents, that expose personal data. Our method takes Android applications and intent-based vulnerabilities formally expressed with models called vulnerability patterns. Then, and this is the originality of our approach, partial speci?cations are automatically generated from con?guration ?les and component codes. Test cases are then automatically generated from vulnerability patterns and the previous speci?- cations. A tool, called APSET, is presented and evaluated with experimentations on some Android applications. ', 'Security testing, Android applications, Model- based testing, Mobile device security', '', 'Johannesburg, South Africa', '', '', 'useruploads/files/SZ13.pdf', 'aug 2013', 2),
(68, 'SZL13', 'S', 'Intent Security Testing - An Approach to Testing the Intent-based                Vulnerability of Android Components', '2013-07-01', 'SECRYPT 2013 - Proceedings of the 10th International Conference on Security and Cryptography', '', '', '355-362', '', 'The intent mechanism is a powerful feature of the Android platform that helps compose existing components together to build a Mobile application. However, hackers can leverage the intent messaging to extract personal data or to call components without credentials by sending malicious intents to components. This paper tackles this issue by proposing a security testing method which aims at detecting whether the components of an Android application are vulnerable to malicious intents. Our method takes Android projects and intent-based vulnerabilities formally represented with models called vulnerability patterns. The originality of our approach resides in the generation of partial specifications from configuration files and component codes to generate test cases. A tool, called APSET, is presented and evaluated with experimentations on some Android applications.', ' Security Testing; Android Applications; Model-Based Testing ', '', 'Reykjav', ' SciTePress 2013 ISBN 978-989-8565-73-0', '', 'useruploads/files/SZL13.pdf', 'july 2013', 2),
(69, 'SP14', 'S', 'Conformance Testing with ioco Proxy-Testers: Application to Web service compositions deployed in Clouds', '2014-01-01', 'International Journal of Computer Aided Engineering and Technology (IJCAET)', '', '', '', ' This paper describes a conformance testing method which aims\n at passively testing the conformance of component-based systems. The paper\n addresses the problem of reaction sequence observation in implementation\n environments where the installation of testing tools is not possible. The\n originality of the method resides in the definition of a Proxy-tester model from a\n specification and in the reformulation of the\n ioco\n test relation with Proxy-tester\n properties. Initially, we define the Proxy-tester model and we give the theoretical\n background to automatically generate Proxy-testers from specifications modelled\n with IOSTSs (input output Symbolic Transition System). The second part of\n the paper describes the application of this method on Web service compositions\n deployed in Clouds. We provide algorithms and passive tester architectures to\n collect traces from several concurrent composition instances running in parallel.\n Finally, we present the testing tool Cloud Paste and experiment results on two\n Clouds, Google AppEngine and Windows Azure', '', 'Passive testing; Proxy; Ioco; Google AppEngine; Windows Azure ', '', '', 'Inderscience', '', 'useruploads/files/SP14.pdf', '2014', 1),
(70, 'SZ14', 'S', 'APSET, an Android aPplication SEcurity Testing tool for detecting intent-based vulnerabilities', '2014-01-02', 'International Journal on Software Tools for Technology Transfer (STTT)', '', '', '1-21', '', 'The Android messaging system, called in-\n tent, is a mechanism that ties comp onents together to\n build applications for smartphones. Intents are kinds of\n messages comp osed of actions and data, sent by a com-\n p onent to another comp onent to p erform several op era-\n tions, e.g., launching a user interface. The intent mech-\n anism o?er a lot of exibility for developing Android\n applications, but it might also b e used as an entry p oint\n for security attacks. The latter can b e easily sent with\n intents to comp onents, that can indirectly forward at-\n tacks to other comp onents and so on. In this context, this\n pap er prop oses APSET, a to ol for Android aPplication\n SEcurity Testing, which aims at detecting intent-based\n vulnerabilities. It takes as inputs Android applications\n and intent-based vulnerabilities formally expressed with\n mo dels called vulnerability patterns. Then, and this is\n the originality of our approach, class diagrams and par-\n tial sp eci cations are automatically generated from ap-\n plications with algorithms re ecting some knowledge of\n the Android do cumentation. These partial sp eci cations\n avoid false p ositives and re ne the test result with sp e-\n cial verdicts notifying that a comp onent is not compli-\n ant to its sp eci cation. Furthermore, we prop ose a test\n case execution framework which supp orts the receipt\n of any exception, the detection of application crashes,\n and provides a nal XML test rep ort detailing the test\n case verdicts. The vulnerability detection effectiveness of\n APSET is evaluated with exp erimentations on randomly\n chosen Android applications of the Android Market', ' Android Application Development; Model-Based Testing; Security Testing ', '', '', 'Springer Berlin Heidelberg', '', 'useruploads/files/SZ14.pdf', '2014', 1),
(71, 'SZ13b', 'S. Salva and Stassia R. Zafimiharisoa', 'Detection of intent-based vulnerabilities in Android applications, chapter 24', '2013-12-01', 'Book ICT: Emerging Trends in Information and Communication Technologies Security', '', '24', '', '', '', ' Security; Android Application Development; intent mechanism', '', '', 'Elsevier', '', 'useruploads/files/ICT143.zip', '2013', 1),
(72, 'DS14', 'William Durand and S', 'Inference de modeles dirigee par la logique metier', '2014-06-11', 'AFADL (Approches Formelles dans l''Assistance au D', '', '', '', '', '', ' IOSTS; test automatique; inf', '', 'paris, France', '', '', 'useruploads/files/DS14.pdf', 'juin 2014', 2),
(73, 'S14', 'S', 'S', '2014-04-02', '', '', '', '', '', '', '', '', '', '', '', 'useruploads/files/semmontp.zip', 'avril 2014', 5),
(74, 'SZ14b', 'S', 'Model reverse-engineering of Mobile applications with exploration strategies', '2014-10-12', 'The Ninth International Conference on Software Engineering Advances, ICSEA 2014', '', '', '396-403', 'Best Paper Award', 'This paper presents a model reverse-engineering approach for mobile applications that belong to the GUI application category. This approach covers the interfaces of an application with automatic testing to incrementally infer a formal model expressing the navigational paths and states of the application. We propose the definition of a specialised GUI application model which stores the discovered interfaces and helps limit the application exploration. Then, we present an algorithm based upon the Ant Colony Optimisation technique which offers the possibility to parallelise the exploration and to conceive any application exploration strategy. Finally, our approach is experimented on Android applications and compared to other tools available in the literature.', ' model generation; Automatic testing;  Android application', '', 'Nice, France', '', '', 'useruploads/files/SZ14b.pdf', '2014, october', 2),
(75, 'SC14', 'S', 'Proxy-Monitor: An integration of runtime verification with passive conformance testing.', '2014-09-01', 'International Journal of Software Innovation (IJSI)', '2', '3', '20--42', 'extension of Sera''13', 'This paper proposes a conformance testing method combining two well-known testing approaches, runtime verification and passive testing. Runtime verification addresses the monitoring of a system under test to check whether formal properties hold, while passive testing aims at checking the conformance of the system in the long-term. The method, proposed in this paper, checks whether an implementation conforms to its specification with reference to the ioco test relation. While passively checking if ioco holds, it also checks whether the implementation meets safety properties, which informally state that ?nothing bad ever happens?. This paper also tackles the trace extraction problem, which is common to both runtime verification and passive testing. We define the notion of Proxy-monitors for collecting traces even when the implementation environment access rights are restricted. Then, we apply and specialise this approach on Web service compositions. A Web service composition deployed in different Clouds is experimented to assess the feasibility of the method.', 'Conformance testing, Passive Testing, Runtime Verification, Proxy-Tester, ioco, Monitoring, Service Composition, Clouds. ', '', '', 'IGI Global', '', 'useruploads/files/SC14.pdf', '2014', 1),
(76, 'SD14', 'S', 'Domain-Driven Model Inference Applied To Web Applications.', '2014-07-21', 'The 2014 International Conference on Software Engineering Research and Practice (SERP14)', '', '', '', 'Model inference methods are attracting increased attention from industrials and researchers since they can be used to generate models for software comprehension, for test case generation, or for helping devise a complete model (or documentation). In this context, this paper presents an original inference model approach which recovers models from Web application HTTP traces. This approach combines formal model inference with domain-driven expert systems. Our framework, whose purpose is to simulate this human behaviour, is composed of inference rules, translating the domain expert knowledge, organised into layers. Each yields partial IOSTSs (Input Output Symbolic Transition System), which become more and more abstract and intelligible.', '', '?Model inference, formal model, IOSTS, rule- based system', '', 'Las Vegas, USA', '', '', 'useruploads/files/SD14.pdf', '2014 july, ', 2),
(77, 'DS14b', 'William Durand and S', 'Inferring models with rule-based expert systems ', '2014-12-04', '5th symposium on Information and Communication Technology (SoICT 2014)', '', '', '', '', 'Many works related to software engineering rely upon for- mal models, e.g., to perform model-checking or automatic test case generation. Nonetheless, producing such mod- els is usually tedious and error-prone. Model inference is a research field helping in producing models by generating partial models from documentation or execution traces (ob- served action sequences). This paper presents a new model generation method combining model inference and expert systems. It appears that an engineer is able to recognise the functional behaviours of an application from its traces by applying deduction rules. We propose a framework, applied to Web applications, simulating this reasoning mechanism, with inference rules organised into layers. Each yields par- tial IOSTSs (Input Output Symbolic Transition Systems), which become more and more abstract and understandable.', 'Model inference, automatic testing, IOSTS, expert system', '', 'Hanoi, Vietnam', 'ACM', '', 'useruploads/files/DS14b.pdf', '2014, dec', 2);

-- --------------------------------------------------------

--
-- Structure de la table `rubrique`
--

CREATE TABLE `rubrique` (
`ID` int(11) NOT NULL,
  `date_creation` date NOT NULL,
  `date_modification` date NOT NULL,
  `content_fr` text,
  `content_en` text,
  `menu_id` int(5) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `rubrique`
--

INSERT INTO `rubrique` (`ID`, `date_creation`, `date_modification`, `content_fr`, `content_en`, `menu_id`) VALUES
(4, '2010-04-15', '2014-03-07', '<h1>Enseignement</h1>\n<p><strong>Responsable de la Licence Professionnelle D', '<h1>Teaching</h1>\n<p><strong><em>Licence Professionnelle Developpement d''Applications  Intranet/Internet</em> Manager(link <a href="http://iutweb.u-clermont1.fr/index.php?option=com_content&amp;task=view&amp;id=211&amp;Itemid=772">here</a>)</strong></p>\n<p><strong><br /></strong></p>\n<h3 class="style1" lang="fr-FR">2002 - 2014 IUT d<em>''</em>Aubiere  (Auvergne University)</h3>\n<p lang="fr-FR"><em>DUT: </em>Network protocols(Ethernet,   IP, TCP/UDP, ...)  and web programming (PHP, servlet, JSP, design   pattern).</p>\n<p lang="fr-FR">', 6),
(2, '2010-04-14', '2014-09-04', '<p><span style="font-size: xx-large;">Salva   S', '<p><span style="font-size: xx-large;">Salva S', 2),
(3, '2010-04-14', '2014-03-07', '<h2>Domaine de recherche</h2>\n<p><img style="vertical-align: baseline;" title="testing" src="useruploads/images/test.jpg" alt="" width="591" height="395" /></p>\n<p>', '<h2>Research Activity</h2>\n<p><img style="vertical-align: baseline;" title="testing" src="useruploads/images/test.jpg" alt="" width="591" height="395" /></p>\n<p>', 4),
(5, '2010-04-15', '2012-06-11', '<h1>Quelques outils</h1>\n<p>', '<h1>Some tools</h1>\n<p>', 7),
(6, '2010-04-15', '2012-08-31', '<p><strong><span style="font-size: large;">Quelques photos de conf', '<p><a href="http://www.testinggeek.com/index.php">testing geek</a></p>\n<p>My reef tank automaton <a title="Aquanywhere" href="http://aquanywhere.free.fr/">Aquanywhere</a></p>\n<p>Logo 600 heli fly (2011 may)</p>\n<p>\n<object width="425" height="350" data="http://www.youtube.com/v/SP8Y2vIjhZg&amp;feature" type="application/x-shockwave-flash">\n<param name="src" value="http://www.youtube.com/v/SP8Y2vIjhZg&amp;feature" />\n</object>\n</p>', 8);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
`ID` int(11) NOT NULL,
  `login` varchar(20) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `rank` int(2) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`ID`, `login`, `password`, `rank`) VALUES
(1, 'sebastien.salva', ‘**********’, 9);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
 ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `publication`
--
ALTER TABLE `publication`
 ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `rubrique`
--
ALTER TABLE `rubrique`
 ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `menu`
--
ALTER TABLE `menu`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `publication`
--
ALTER TABLE `publication`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT pour la table `rubrique`
--
ALTER TABLE `rubrique`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
