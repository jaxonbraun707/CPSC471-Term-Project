-- --------------------------------------------------------

--
-- Table structure for table `Design`
--

CREATE TABLE `Design` (
  `Design_No` int(11) NOT NULL,
  `Budget` decimal(19,2) NOT NULL
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

CREATE TABLE Client
	(Client_Id			INT			NOT NULL,
	 Email			VARCHAR(255),
	 Contact_Name		VARCHAR(255),
	 Company_Name		VARCHAR(255),
	 Website			VARCHAR(255),
	 Phone_No			INT,
	 Address_Line_1		VARCHAR(255)	NOT NULL,
	 Address_Line_2		VARCHAR(255),
	 City				VARCHAR(255)	NOT NULL,
	 Prov_State			VARCHAR(255)	NOT NULL,
	 Country			VARCHAR(255)	NOT NULL,
	 Postal_Zip			VARCHAR(255)	NOT NULL,
	 PRIMARY KEY (Client_Id) );

CREATE TABLE Proposal
	(Proposal_No		INT			NOT NULL,
	 Title			VARCHAR(255),
	 Value			FLOAT,
	 Issued_Date		DATE,
	 Expiry_Date		DATE,
	 PRIMARY KEY (Proposal_No) );

CREATE TABLE Contract
	(Proposal_No		INT			NOT NULL,
	 Contract_No		INT			NOT NULL,
	 Start_Date			DATE,
	 Delivery_Date		DATE,
	 Payment_Terms		VARCHAR(255),
	 Issued_Date		DATE,
	 Expiry_Date		DATE,
     Client_Id			INT NOT NULL,
	 PRIMARY KEY (Proposal_No, Contract_No),
	 FOREIGN KEY (Client_Id) REFERENCES Client (Client_Id) );

CREATE TABLE Client_Proposals
	(Client_Id			INT			NOT NULL,
	 Proposal_No		INT			NOT NULL,
	 PRIMARY KEY (Client_Id, Proposal_No),
	 FOREIGN KEY (Client_Id) REFERENCES Client (Client_Id),
	 FOREIGN KEY (Proposal_No) REFERENCES Proposal (Proposal_No)
	);

CREATE TABLE Orders
(
	Order_No	INT	NOT NULL,  
	Ship_Date	DATE, 
	Project_No	INT	NOT NULL, 
	PRIMARY KEY (Order_No),  
	FOREIGN KEY (Project_No) REFERENCES Project(Project_No) 
); 

CREATE TABLE Part 
(
	Part_No	INT	NOT NULL,  
	PRIMARY KEY (Part_No) 
); 

CREATE TABLE Vendor 
(
	Vendor_Id	INT	NOT NULL, 
	Vendor_Name	VARCHAR(20)	NOT NULL, 
	Phone_No	BIGINT, 
	PRIMARY KEY(Vendor_Id) 
); 

CREATE TABLE Employee 
(
	SSN	INT	NOT NULL, 
	First_Name	VARCHAR(255)	NOT NULL, 
	Last_Name	VARCHAR(255)	NOT NULL, 
	DOB	DATE	NOT NULL, 
	Phone_No	BIGINT	NOT NULL, 
	Email	VARCHAR(255), 
	Address_Line_1		VARCHAR(255)	NOT NULL, 
	Address_Line_2		VARCHAR(255), 
	City			VARCHAR(255)	NOT NULL, 
	Prov_State		VARCHAR(255)	NOT NULL, 
	Country			VARCHAR(255)	NOT NULL, 
	Postal_Zip		VARCHAR(255)	NOT NULL, 
	Job_Type	VARCHAR(255), 
	PRIMARY KEY(SSN) 
); 

CREATE TABLE Sales_Have_Clients 
(
	Sales_SSN	INT	NOT NULL, 
	Client_Id	INT	NOT NULL, 
	PRIMARY KEY(Sales_SSN, Client_Id),
	FOREIGN KEY(Sales_SSN) REFERENCES Employee(SSN), 
	FOREIGN KEY(Client_Id) REFERENCES Client(Client_Id) 
); 


CREATE TABLE Sales_Proposals (
	Sales_SSN	INT	NOT NULL, 
	Proposal_No	INT	NOT NULL, 
	PRIMARY KEY(Sales_SSN, Proposal_No),
	FOREIGN KEY(Sales_SSN) REFERENCES Employee(SSN), 
	FOREIGN KEY(Proposal_No) REFERENCES Proposal(Proposal_No) ); 

CREATE TABLE Vendors_Provides_Parts 
(	
	Vendor_Id	INT	NOT NULL, 
	Part_No	INT	NOT NULL, 
	Price	decimal(19,2)	NOT NULL,
	PRIMARY KEY(Vendor_Id, Part_No),
	FOREIGN KEY(Vendor_Id) REFERENCES Vendor(Vendor_Id), 
	FOREIGN KEY(Part_No) REFERENCES Part(Part_No) 
); 


CREATE TABLE Purchase_Orders 
(	
	Purchaser_SSN	INT	NOT NULL, 
	Vendor_Id	INT	NOT NULL, 
	Purchase_Order	VARCHAR(255)	NOT NULL, 
	PRIMARY KEY(Purchaser_SSN, Vendor_Id),
	FOREIGN KEY(Purchaser_SSN) REFERENCES Employee(SSN), 
	FOREIGN KEY(Vendor_ID) REFERENCES Vendor(Vendor_Id) 
); 

CREATE TABLE Labour_Order 
(
	Labour_SSN	INT	NOT NULL, 
	Order_No	INT	NOT NULL, 
	Start_Date	DATE	NOT NULL, 
	Hours	INT	NOT NULL, 
	PRIMARY KEY(Labour_SSN, Order_No),
	FOREIGN KEY(Labour_SSN) REFERENCES Employee(SSN), 
	FOREIGN KEY(Order_No) REFERENCES Orders(Order_No) 
); 

CREATE TABLE Parts_Inventory

(
	Order_No INT	NOT NULL, 
	Part_No	INT	NOT NULL, 
	Qty	INT	NOT NULL, 
	PRIMARY KEY(Order_No, Part_No),
	FOREIGN KEY(Order_No) REFERENCES Orders(Order_No), 
	FOREIGN KEY(Part_No) REFERENCES Part(Part_No) 
); 

CREATE TABLE Regions 
(
	Sales_SSN	INT		NOT NULL,
	Sales_Region	VARCHAR(255),
	PRIMARY KEY(Sales_SSN),
	FOREIGN KEY(Sales_SSN) REFERENCES Employee(SSN)
);

CREATE TABLE Eng_Specialties
(
	Eng_SSN		INT		NOT NULL,
	Eng_Specialty	VARCHAR(255),
	PRIMARY KEY(Eng_SSN),
	FOREIGN KEY(Eng_SSN) REFERENCES Employee(SSN)
);

CREATE TABLE Lab_Specialties
(
	Lab_SSN		INT		NOT NULL,
	Lab_Specialty	VARCHAR(255),
	PRIMARY KEY(Lab_SSN),
	FOREIGN KEY(Lab_SSN) REFERENCES Employee(SSN)
);