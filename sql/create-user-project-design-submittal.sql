START TRANSACTION;
-- --------------------------------------------------------

--
-- Table structure for table `Design`
--

CREATE TABLE `Design` (
  `Design_No` int(11) NOT NULL,
  `Budget` decimal(19,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Drawings`
--

CREATE TABLE `Drawings` (
  `Design_No` int(11) NOT NULL,
  `Drawing_No` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Engineering_Designs`
--

CREATE TABLE `Engineering_Designs` (
  `Eng_SSN` int(11) NOT NULL,
  `Design_No` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Engineering_Submittals`
--

CREATE TABLE `Engineering_Submittals` (
  `Eng_SSN` int(11) NOT NULL,
  `Submittal_No` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Project`
--

CREATE TABLE `Project` (
  `Project_No` int(11) NOT NULL,
  `Start_Date` date NOT NULL,
  `End_Date` date NOT NULL,
  `Contract_No` int(11) NOT NULL,
  `Design_No` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Submittal`
--

CREATE TABLE `Submittal` (
  `Submittal_No` int(11) NOT NULL,
  `Contract_No` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Submittals_Attachments`
--

CREATE TABLE `Submittals_Attachments` (
  `Submittal_No` int(11) NOT NULL,
  `Attachment` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `User_Type` varchar(255) NOT NULL,
  `ESSN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Design`
--
ALTER TABLE `Design`
  ADD PRIMARY KEY (`Design_No`);

--
-- Indexes for table `Drawings`
--
ALTER TABLE `Drawings`
  ADD PRIMARY KEY (`Design_No`,`Drawing_No`);

--
-- Indexes for table `Engineering_Designs`
--
ALTER TABLE `Engineering_Designs`
  ADD PRIMARY KEY (`Eng_SSN`,`Design_No`),
  ADD KEY `fk_Design_No` (`Design_No`);

--
-- Indexes for table `Engineering_Submittals`
--
ALTER TABLE `Engineering_Submittals`
  ADD PRIMARY KEY (`Eng_SSN`,`Submittal_No`),
  ADD KEY `fk_Submittal_No` (`Submittal_No`);

--
-- Indexes for table `Project`
--
ALTER TABLE `Project`
  ADD PRIMARY KEY (`Project_No`);

--
-- Indexes for table `Submittal`
--
ALTER TABLE `Submittal`
  ADD PRIMARY KEY (`Submittal_No`);

--
-- Indexes for table `Submittals_Attachments`
--
ALTER TABLE `Submittals_Attachments`
  ADD KEY `fk_Submittals_Attachments_Submittal_No` (`Submittal_No`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Project`
--
ALTER TABLE `Project`
  MODIFY `Project_No` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for table `Drawings`
--
ALTER TABLE `Drawings`
  ADD CONSTRAINT `fk_Drawings_Design_No` FOREIGN KEY (`Design_No`) REFERENCES `Design` (`Design_No`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Engineering_Designs`
--
ALTER TABLE `Engineering_Designs`
  ADD CONSTRAINT `fk_Engineering_Designs_Design_No` FOREIGN KEY (`Design_No`) REFERENCES `Design` (`Design_No`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Engineering_Submittals`
--
ALTER TABLE `Engineering_Submittals`
  ADD CONSTRAINT `fk_Engineering_Submittals_Submittal_No` FOREIGN KEY (`Submittal_No`) REFERENCES `Submittal` (`Submittal_No`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Submittals_Attachments`
--
ALTER TABLE `Submittals_Attachments`
  ADD CONSTRAINT `fk_Submittals_Attachments_Submittal_No` FOREIGN KEY (`Submittal_No`) REFERENCES `Submittal` (`Submittal_No`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;