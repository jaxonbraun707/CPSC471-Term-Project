Create Tables

CREATE TABLE CLIENT
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

CREATE TABLE PROPOSAL
	(Proposal_No		INT			NOT NULL,
	 Title			VARCHAR(255),
	 Value			FLOAT,
	 Issued_Date		DATE,
	 Expiry_Date		DATE,
	 PRIMARY KEY (Proposal_No) );

CREATE TABLE CONTRACT
	(Proposal_No		INT			NOT NULL,
	 Contract_No		INT			NOT NULL,
	 Start_Date			DATE,
	 Delivery_Date		DATE,
	 Payment_Terms		VARCHAR(255),
	 Issued_Date		DATE,
	 Expiry_Date		DATE,
	 PRIMARY KEY (Proposal_No, Contract_No),
	 FOREIGN KEY (Client_Id) );

CREATE TABLE PROJECT
	(Project_No			INT			NOT NULL,
	 Start_Date			DATE,
	 End_Date			DATE,
	 Contract_No		INT 			NOT NULL,
	 Design_No			VARCHAR(255)	NOT NULL,
	 PRIMARY KEY (Project_No),
	 FOREIGN KEY (Contract_No, Design_No) );

CREATE TABLE CLIENT_PROPOSALS
	(Client_Id			INT			NOT NULL,
	 Proposal_No		INT			NOT NULL,
	 PRIMAY KEY (Client_Id, Proposal_No) );

Client SQL Statements

SELECT * FROM CLIENT;

SELECT * FROM CLIENT
	WHERE 'Client_Name';

INSERT INTO CLIENT
	VALUES('Client_Id', 'Email', 'Contact_Name', 'Company_Name', 'Website', 'Phone_No',
		 'Address_Line_1', 'Address_Line_2', 'City', 'Prov_State', 'Country',
		 'Postal_Zip');

DELETE FROM CLIENT
	WHERE Client_Id='Client_Id';

UPDATE CLIENT
SET		Email='New_Email'
WHERE		Client_Id='Client_Id'; 

UPDATE CLIENT
SET		Contact_Name='New_ContactName'
WHERE		Client_Id='Client_Id';  

UPDATE CLIENT
SET		Phone_No='New_PhoneNo'
WHERE		Client_Id='Client_Id'; 

UPDATE CLIENT
SET		Address_Line_1='NewAddressLine1', Address_Line_2='NewAddressLine2'
		City='NewCity', Prov_State='NewProvState', Country='NewCountry',
		Postal_Zip='NewPostalZip'; 
WHERE		Client_Id='Client_Id'; 

Proposal SQL Statements

SELECT * FROM PROPOSAL;

SELECT * FROM PROPOSAL
	WHERE 'Client_Name';

INSERT INTO PROPOSAL
	VALUES('Proposal_no', 'Title', 'Value', 'Issued_Date', 'Expiry_Date');

DELETE FROM PROPOSAL
	WHERE Proposal_No='Proposal_No';

UPDATE PROPOSAL
SET		Value='New_Value'
WHERE		Proposal_No='Proposal_No'; 

UPDATE PROPOSAL
SET		Expiry_Date='New_ExpiryDate'
WHERE		Proposal_No='Proposal_No';  

Contract SQL Statements

SELECT * FROM CONTRACT;

SELECT * FROM CONTRACT
	WHERE 'Client_Id';

INSERT INTO CONTRACT
	VALUES('Proposal_no', 'Contract_No', 'Start_Date', 'Delivery_Date', 
		 'Payment_Terms', 'Client_Id');

DELETE FROM CONTRACT
	WHERE Contract_No='Contract_No' AND Proposal_No='Proposal_No';

UPDATE CONTRACT
SET		Delivery_Date='New_DeliveryDate'
WHERE		Contract_No='Contract_No' AND Proposal_No='Proposal_No'; 

UPDATE CONTRACT
SET		Payment_Terms='New_PaymentTerms'
WHERE		Contract_No='Contract_No' AND Proposal_No='Proposal_No';  

Project SQL Statements

SELECT * FROM PROJECT;

SELECT * FROM PROJECT
	WHERE 'Project_No';

INSERT INTO PROJECT
	VALUES('Project_No', 'Start_Date', 'End_Date', 
		 'Contract_No', 'Design_No');

DELETE FROM Project
	WHERE Project_No='Project_No';

UPDATE PROJECT
SET		End_Date='New_EndDate'
WHERE		Project_No='Project_No'; 

UPDATE PROJECT
SET		Design_No='New_DesignNo'
WHERE		Project_No='Project_No';  
