-- Truncate related tables
TRUNCATE client;
TRUNCATE proposal;

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

IINSERT INTO proposal (`Proposal_No`, `Title`, `Value`, `Issued_Date`, `Expiry_Date`)
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

INSERT INTO EMPLOYEE (`SSN`, `First_Name`, `Last_Name`, `DOB`, `Phone_No`, `Email`, `Address_Line_1`, `Address_Line_2`, `City`, `Prov_State`, `Country`, `Postal_Zip`, `Job_Type`)
VALUES(
	5,
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

