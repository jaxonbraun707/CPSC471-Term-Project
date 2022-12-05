-- Employees
INSERT INTO EMPLOYEE (`SSN`, `First_Name`, `Last_Name`, `DOB`, `Phone_No`, `Email`, `Address_Line_1`, `Address_Line_2`, `City`, `Prov_State`, `Country`, `Postal_Zip`, `Job_Type`)
VALUES(
	1,
	'Rupert',
	'Amodia',
	'1999-02-11', 
	'123456', 
	'rupertraphael@live.com',
	'Address Line 1',
	'Address Line 2',
	'Calgary',
	'Alberta',
	'Canada',
	'Postal', 
	'Engineering'
); 

INSERT INTO Eng_Specialties(`Eng_SSN`, `Eng_Specialty`)
VALUES(
	1,
	'Software'
);

INSERT INTO EMPLOYEE (`SSN`, `First_Name`, `Last_Name`, `DOB`, `Phone_No`, `Email`, `Address_Line_1`, `Address_Line_2`, `City`, `Prov_State`, `Country`, `Postal_Zip`, `Job_Type`)
VALUES(
	2,
	'Jaxon',
	'Braun',
	'2000-01-01', 
	'123456', 
	'jaxonbraun@worc.com',
	'Address Line 1',
	'Address Line 2',
	'Calgary',
	'Alberta',
	'Canada',
	'Postal', 
	'Engineering'
); 

INSERT INTO Eng_Specialties(`Eng_SSN`, `Eng_Specialty`)
VALUES(
	2,
	'Software'
);

INSERT INTO EMPLOYEE (`SSN`, `First_Name`, `Last_Name`, `DOB`, `Phone_No`, `Email`, `Address_Line_1`, `Address_Line_2`, `City`, `Prov_State`, `Country`, `Postal_Zip`, `Job_Type`)
VALUES(
	3,
	'Gareth',
	'Jenkins',
	'2010-01-01', 
	'123456', 
	'garethjenkins@worc.com',
	'Address Line 1',
	'Address Line 2',
	'Calgary',
	'Alberta',
	'Canada',
	'Postal', 
	'Engineering'
);

INSERT INTO Eng_Specialties(`Eng_SSN`, `Eng_Specialty`)
VALUES(
	3,
	'Software'
);

INSERT INTO User (`Username`, `Password`, `User_Type`, `ESSN`)
VALUES ('rupertraphael', 'password', 'Admin', 1);

INSERT INTO User (`Username`, `Password`, `User_Type`, `ESSN`)
VALUES ('jaxonbraun', 'password', 'Admin', 2);

INSERT INTO User (`Username`, `Password`, `User_Type`, `ESSN`)
VALUES ('garethjenkins', 'password', 'Admin', 3);

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

INSERT INTO Regions(`Sales_SSN`, `Sales_Region`)
VALUES(4, 'Northern Alberta');

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

INSERT INTO Regions(`Sales_SSN`, `Sales_Region`)
VALUES(5, 'Southern Alberta');

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

INSERT INTO Regions(`Sales_SSN`, `Sales_Region`)
VALUES(6, 'British Columbia');

INSERT INTO USER (`Username`, `Password`, `User_Type`, `ESSN`)
VALUES(
	'jameswong',
	'password',
	'Regular',
	'6' 
);

INSERT INTO EMPLOYEE (`SSN`, `First_Name`, `Last_Name`, `DOB`, `Phone_No`, `Email`, `Address_Line_1`, `Address_Line_2`, `City`, `Prov_State`, `Country`, `Postal_Zip`, `Job_Type`)
VALUES(
	7,
	'David',
	'Rose',
	'1999-02-11', 
	'123456', 
	'davidrose@worc.com',
	'Address Line 1',
	'Address Line 2',
	'Calgary',
	'Alberta',
	'Canada',
	'Postal', 
	'Engineering'
); 

INSERT INTO Eng_Specialties(`Eng_SSN`, `Eng_Specialty`)
VALUES(
	7,
	'Mechanical'
);

INSERT INTO USER (`Username`, `Password`, `User_Type`, `ESSN`)
VALUES(
	'davidrose',
	'password',
	'Regular',
	'7' 
);

INSERT INTO EMPLOYEE (`SSN`, `First_Name`, `Last_Name`, `DOB`, `Phone_No`, `Email`, `Address_Line_1`, `Address_Line_2`, `City`, `Prov_State`, `Country`, `Postal_Zip`, `Job_Type`)
VALUES(
	8,
	'Jake',
	'Peralta',
	'1999-02-11', 
	'123456', 
	'jakeperalta@worc.com',
	'Address Line 1',
	'Address Line 2',
	'New York',
	'New York',
	'USA',
	'Postal', 
	'Labour'
); 

INSERT INTO Lab_Specialties(`Lab_SSN`, `Lab_Specialty`)
VALUES(
	8,
	'Electrical'
);

INSERT INTO USER (`Username`, `Password`, `User_Type`, `ESSN`)
VALUES(
	'jakeperalta',
	'password',
	'Regular',
	8 
);

INSERT INTO EMPLOYEE (`SSN`, `First_Name`, `Last_Name`, `DOB`, `Phone_No`, `Email`, `Address_Line_1`, `Address_Line_2`, `City`, `Prov_State`, `Country`, `Postal_Zip`, `Job_Type`)
VALUES(
	9,
	'Doug',
	'Judy',
	'1999-02-11', 
	'123456', 
	'dougjudy@worc.com',
	'Address Line 1',
	'Address Line 2',
	'New York',
	'New York',
	'USA',
	'Postal', 
	'Labour'
); 

INSERT INTO Lab_Specialties(`Lab_SSN`, `Lab_Specialty`)
VALUES(
	9,
	'Electrical'
);

INSERT INTO USER (`Username`, `Password`, `User_Type`, `ESSN`)
VALUES(
	'dougjudy',
	'password',
	'Regular',
	9 
);

INSERT INTO EMPLOYEE (`SSN`, `First_Name`, `Last_Name`, `DOB`, `Phone_No`, `Email`, `Address_Line_1`, `Address_Line_2`, `City`, `Prov_State`, `Country`, `Postal_Zip`, `Job_Type`)
VALUES(
	10,
	'Rosa',
	'Diaz',
	'1999-02-11', 
	'123456', 
	'rosadiaz@worc.com',
	'Address Line 1',
	'Address Line 2',
	'New York',
	'New York',
	'USA',
	'Postal', 
	'Labour'
); 

INSERT INTO Lab_Specialties(`Lab_SSN`, `Lab_Specialty`)
VALUES(
	10,
	'Electrical'
);

INSERT INTO USER (`Username`, `Password`, `User_Type`, `ESSN`)
VALUES(
	'rosadiaz',
	'password',
	'Regular',
	10 
);

-- Create Clients
INSERT INTO client (`Client_Id`, `Email`, `Contact_Name`, `Company_Name`, `Website`, `Phone_No`,
		            `Address_Line_1`, `Address_Line_2`, `City`, `Prov_State`, `Country`,
		            `Postal_Zip`)
        VALUES (1, 'client1@gmail.com', 'Bob Loblaw', 'Bob Loblaw Law', 'www.blahblahblah.com',
                2354563478, '123 Main Street', 'NULL', 'Calgary', 'Alberta', 'Canada', 'T2X 4Z5');

INSERT INTO client (`Client_Id`, `Email`, `Contact_Name`, `Company_Name`, `Phone_No`,
		            `Address_Line_1`, `City`, `Prov_State`, `Country`,
		            `Postal_Zip`)
        VALUES (2, 'john.smith43@gmail.com', 'John Smith', 'John Smith',
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

INSERT INTO sales_proposals (`Sales_SSN`, `Proposal_No`)
        VALUES (6, 1);

INSERT INTO sales_proposals (`Sales_SSN`, `Proposal_No`)
        VALUES (4, 2);

INSERT INTO sales_proposals (`Sales_SSN`, `Proposal_No`)
        VALUES (5, 3);

INSERT INTO client_proposals (`Client_Id`, `Proposal_No`)
        VALUES (3, 1);

INSERT INTO client_proposals (`Client_Id`, `Proposal_No`)
        VALUES (2, 2);

INSERT INTO client_proposals (`Client_Id`, `Proposal_No`)
        VALUES (1, 3);

INSERT INTO sales_have_clients (`Sales_SSN`, `Client_Id`)
        VALUES (6, '3');

INSERT INTO sales_have_clients (`Sales_SSN`, `Client_Id`)
        VALUES (4, '2');

INSERT INTO sales_have_clients (`Sales_SSN`, `Client_Id`)
        VALUES (5, '1');

-- create contracts
INSERT INTO contract (`Proposal_No`, `Contract_No`, `Start_Date`, `Delivery_Date`, `Payment_Terms`, `Issued_Date`, `Expiry_Date`, `Client_Id`)
        VALUES (1, '1', '2022-10-30', '2023-03-15', '30/40/20/10', '2022-10-25', '2023-03-30', 3);

INSERT INTO contract (`Proposal_No`, `Contract_No`, `Start_Date`, `Delivery_Date`, `Payment_Terms`, `Issued_Date`, `Expiry_Date`, `Client_Id`)
        VALUES (2, '3', '2022-08-15', '2023-01-31', '30/40/20/10', '2022-08-10', '2023-03-31', 2);

INSERT INTO contract (`Proposal_No`, `Contract_No`, `Start_Date`, `Delivery_Date`, `Payment_Terms`, `Issued_Date`, `Expiry_Date`, `Client_Id`)
        VALUES (3, '2', '2023-04-15', '2023-09-04', '30/40/30/10', '2023-04-05', '2023-12-31', 1);

-- Create designs
INSERT INTO Design (`Design_No`, `Budget`)
VALUES (1, 3500.0000);

INSERT INTO Design (`Design_No`, `Budget`)
VALUES (2, 1500.0000);

INSERT INTO Design (`Design_No`, `Budget`)
VALUES (3, 2700.0000);

INSERT INTO Design (`Design_No`, `Budget`)
VALUES (4, 3800.0000);

INSERT INTO Design (`Design_No`, `Budget`)
VALUES (5, 6900.6969);

INSERT INTO Design (`Design_No`, `Budget`)
VALUES (6, 4200.4200);

INSERT INTO Engineering_Designs (`Eng_SSN`, `Design_No`)
VALUES (1, 1);

INSERT INTO Engineering_Designs (`Eng_SSN`, `Design_No`)
VALUES (1, 2);

INSERT INTO Engineering_Designs (`Eng_SSN`, `Design_No`)
VALUES (1, 3);

INSERT INTO Engineering_Designs (`Eng_SSN`, `Design_No`)
VALUES (1, 4);

INSERT INTO Engineering_Designs (`Eng_SSN`, `Design_No`)
VALUES (1, 5);

INSERT INTO Engineering_Designs (`Eng_SSN`, `Design_No`)
VALUES (1, 6);

INSERT INTO Engineering_Designs (`Eng_SSN`, `Design_No`)
VALUES (2, 4);

INSERT INTO Engineering_Designs (`Eng_SSN`, `Design_No`)
VALUES (2, 5);

INSERT INTO Engineering_Designs (`Eng_SSN`, `Design_No`)
VALUES (2, 6);

INSERT INTO Engineering_Designs (`Eng_SSN`, `Design_No`)
VALUES (3, 1);

INSERT INTO Engineering_Designs (`Eng_SSN`, `Design_No`)
VALUES (3, 2);

-- Create submittals
INSERT INTO Submittal (`Submittal_No`, `Contract_No`)
VALUES (1, 1);

INSERT INTO Submittal (`Submittal_No`, `Contract_No`)
VALUES (2, 2);

INSERT INTO Submittal (`Submittal_No`, `Contract_No`)
VALUES (3, 3);

INSERT INTO Engineering_Submittals (`Eng_SSN`, `Submittal_No`)
VALUES (1, 1);

INSERT INTO Engineering_Submittals (`Eng_SSN`, `Submittal_No`)
VALUES (2, 2);

INSERT INTO Engineering_Submittals (`Eng_SSN`, `Submittal_No`)
VALUES (3, 3);

-- Create projects
INSERT INTO Project (`Start_Date`, `End_Date`, `Contract_No`, `Design_No`)
 	VALUES ('2022-10-30', '2023-03-15', 1, 1);

INSERT INTO Project (`Start_Date`, `End_Date`, `Contract_No`, `Design_No`)
 	VALUES ('2022-08-15', '2023-01-31', 2, 2);

INSERT INTO Project (`Start_Date`, `End_Date`, `Contract_No`, `Design_No`)
 	VALUES ('2022-06-15', '2024-05-31', 3, 3);

-- Create orders
INSERT INTO Orders(`Order_No`, `Ship_Date`, `Project_No`)
VALUES(1, '2023-12-01', 1);

INSERT INTO Orders(`Order_No`, `Ship_Date`, `Project_No`)
VALUES(2, '2022-10-15', 2);

INSERT INTO Orders(`Order_No`, `Ship_Date`, `Project_No`)
VALUES(3, '2023-11-01', 3);

-- Create parts
INSERT INTO Part(`Part_No`) VALUES(1);
INSERT INTO Part(`Part_No`) VALUES(2);
INSERT INTO Part(`Part_No`) VALUES(3);
INSERT INTO Part(`Part_No`) VALUES(4);
INSERT INTO Part(`Part_No`) VALUES(5);

-- Assign labourers
INSERT INTO Labour_Order(`Labour_SSN`, `Order_No`, `Start_Date`, `Hours`)
VALUES(8,1,'2022-02-01',50);

INSERT INTO Labour_Order(`Labour_SSN`, `Order_No`, `Start_Date`, `Hours`)
VALUES(9,1,'2022-02-01',50);

INSERT INTO Labour_Order(`Labour_SSN`, `Order_No`, `Start_Date`, `Hours`)
VALUES(10,1,'2022-02-01',50);

INSERT INTO Labour_Order(`Labour_SSN`, `Order_No`, `Start_Date`, `Hours`)
VALUES(9,2,'2022-02-01',50);

INSERT INTO Labour_Order(`Labour_SSN`, `Order_No`, `Start_Date`, `Hours`)
VALUES(10,3,'2022-02-01',50);

-- Assign parts to orders
INSERT INTO Parts_Inventory(`Order_No`, `Part_No`, `Qty`)
VALUES(
    1,
    1,
    5
);

INSERT INTO Parts_Inventory(`Order_No`, `Part_No`, `Qty`)
VALUES(
    1,
    2,
    3
);

INSERT INTO Vendor(`Vendor_Id`, `Vendor_Name`, `Phone_No`)
VALUES(
    1,
    "Joe's Fat Parts",
    123456
);

INSERT INTO Vendor(`Vendor_Id`, `Vendor_Name`, `Phone_No`)
VALUES(
    2,
    "General Parts",
    654321
);

INSERT INTO Vendors_Provides_Parts(`Vendor_Id`, `Part_No`, `Price`)
VALUES(
    1,
    1,
    5.00
);

INSERT INTO Vendors_Provides_Parts(`Vendor_Id`, `Part_No`, `Price`)
VALUES(
    1,
    2,
    2.00
);

INSERT INTO Vendors_Provides_Parts(`Vendor_Id`, `Part_No`, `Price`)
VALUES(
    2,
    3,
    10.00
);