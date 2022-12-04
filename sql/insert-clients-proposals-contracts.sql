-- Truncate related tables
TRUNCATE client;
TRUNCATE proposal;
TRUNCATE employee;
TRUNCATE sales_proposals;
TRUNCATE client_proposals;

-- Create Clients
INSERT INTO client (`Client_Id`, `Email`, `Contact_Name`, `Company_Name`, `Website`, `Phone_No`,
		            `Address_Line_1`, `Address_Line_2`, `City`, `Prov_State`, `Country`,
		            `Postal_Zip`)
        VALUES (1, 'client1@gmail.com', 'Bob Loblaw', 'Bob Loblaw Law', 'www.blahblahblah.com',
                2354563478, '123 Main Street', 'NULL', 'Calgary', 'Alberta', 'Canada', 'T2X 4Z5');

INSERT INTO client (`Client_Id`, `Email`, `Contact_Name`, `Phone_No`,
		            `Address_Line_1`, `City`, `Prov_State`, `Country`,
		            `Postal_Zip`)
        VALUES (2, 'john.smith43@gmail.com', 'John Smith',
                2994363478, '45 34th Ave', 'Kiel', 'Wisconsin', 'USA', '53042');

INSERT INTO client (`Client_Id`, `Email`, `Contact_Name`, `Company_Name`, `Website`, `Phone_No`,
		            `Address_Line_1`, `City`, `Prov_State`, `Country`,
		            `Postal_Zip`)
        VALUES (3, 'billybob@verizon.com', 'William Longshanks', 'Shanks R Us', 'www.gotyourshanks.com',
                9133336711, '#546 7980 56th Street', 'Pasco', 'Washington', 'USA', '99301');


-- Create Proposals
INSERT INTO proposal (`Proposal_No`, `Title`, `Value`, `Issued_Date`, `Expiry_Date`)
        VALUES (1, 'Water System', 123699.00, '2022-10-15', '2022-11-15');

INSERT INTO proposal (`Proposal_No`, `Title`, `Value`, `Issued_Date`, `Expiry_Date`)
        VALUES (2, 'Pumping System', 199249.00, '2022-08-10', '2022-09-10');

INSERT INTO proposal (`Proposal_No`, `Title`, `Value`, `Issued_Date`, `Expiry_Date`)
        VALUES (3, 'Chiller', 1249000.00, '2021-01-09', '2021-02-09');

-- Create Sales Employees
INSERT INTO EMPLOYEE (`SSN`, `First_Name`, `Last_Name`, `DOB`, `Phone_No`, `Email`, `Address_Line_1`, `Address_Line_2`, `City`, `Prov_State`, `Country`, `Postal_Zip`, `Job_Type`)
VALUES(
	4,
	'Joe',
	'Tuff',
	'1995-04-15', 
	'123456', 
	'joetuff@worc.com',
	'Address Line 1',
	'Address Line 2',
	'Calgary',
	'Alberta',
	'Canada',
	'Postal', 
	'Sales'
); 

INSERT INTO USER (`Username`, `Password`, `User_Type`, `ESSN`)
VALUES(
	'joetuff',
	'password',
	'Regular',
	'4' 
); 

INSERT INTO EMPLOYEE (`SSN`, `First_Name`, `Last_Name`, `DOB`, `Phone_No`, `Email`, `Address_Line_1`, `Address_Line_2`, `City`, `Prov_State`, `Country`, `Postal_Zip`, `Job_Type`)
VALUES(
	5,
	'Sarah',
	'Steward',
	'1998-06-29', 
	'123456', 
	'sarahsteward@worc.com',
	'Address Line 1',
	'Address Line 2',
	'Calgary',
	'Alberta',
	'Canada',
	'Postal', 
	'Sales'
); 

INSERT INTO USER (`Username`, `Password`, `User_Type`, `ESSN`)
VALUES(
	'sarahsteward',
	'password',
	'Regular',
	'5' 
); 

INSERT INTO EMPLOYEE (`SSN`, `First_Name`, `Last_Name`, `DOB`, `Phone_No`, `Email`, `Address_Line_1`, `Address_Line_2`, `City`, `Prov_State`, `Country`, `Postal_Zip`, `Job_Type`)
VALUES(
	6,
	'James',
	'Wong',
	'1988-09-05', 
	'123456', 
	'jameswong@worc.com',
	'Address Line 1',
	'Address Line 2',
	'Calgary',
	'Alberta',
	'Canada',
	'Postal', 
	'Sales'
); 

INSERT INTO USER (`Username`, `Password`, `User_Type`, `ESSN`)
VALUES(
	'jameswong',
	'password',
	'Regular',
	'6' 
); 

-- Create Sales_Proposals

INSERT INTO sales_proposals (`Sales_SSN`, `Proposal_No`)
        VALUES (6, 1);

INSERT INTO sales_proposals (`Sales_SSN`, `Proposal_No`)
        VALUES (4, 2);

INSERT INTO sales_proposals (`Sales_SSN`, `Proposal_No`)
        VALUES (5, 3);

-- Create Client_Proposals

INSERT INTO client_proposals (`Client_Id`, `Proposal_No`)
        VALUES (3, 1);

INSERT INTO client_proposals (`Client_Id`, `Proposal_No`)
        VALUES (2, 2);

INSERT INTO client_proposals (`Client_Id`, `Proposal_No`)
        VALUES (1, 3);

-- Create Contracts

INSERT INTO contract (`Proposal_No`, `Contract_No`, `Start_Date`, `Delivery_Date`, `Payment_Terms`, `Issued_Date`, `Expiry_Date`, `Client_Id`)
        VALUES (1, '1', '2022-10-30', '2023-03-15', '30/40/20/10', '2022-10-25', '2023-03-30', 3);

INSERT INTO contract (`Proposal_No`, `Contract_No`, `Start_Date`, `Delivery_Date`, `Payment_Terms`, `Issued_Date`, `Expiry_Date`, `Client_Id`)
        VALUES (2, '3', '2022-08-15', '2023-01-31', '30/40/20/10', '2022-08-10', '2023-03-31', 2);

INSERT INTO contract (`Proposal_No`, `Contract_No`, `Start_Date`, `Delivery_Date`, `Payment_Terms`, `Issued_Date`, `Expiry_Date`, `Client_Id`)
        VALUES (3, '2', '2023-04-15', '2023-09-04', '30/40/30/10', '2023-04-05', '2023-12-31', 4);

-- Create Sales_Have_Clients

INSERT INTO sales_have_clients (`Sales_SSN`, `Client_Id`)
        VALUES (6, '3');

INSERT INTO sales_have_clients (`Sales_SSN`, `Client_Id`)
        VALUES (4, '2');

INSERT INTO sales_have_clients (`Sales_SSN`, `Client_Id`)
        VALUES (5, '1');
