TRUNCATE Lab_Specialties;
TRUNCATE Eng_Specialties;
TRUNCATE Regions;
TRUNCATE Employee;
TRUNCATE Part;
TRUNCATE Contract;
TRUNCATE Design;
TRUNCATE Project;
TRUNCATE Orders;
TRUNCATE User;


-- An Order has parts and labour

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
	'Labour'
); 

INSERT INTO Lab_Specialties(`Lab_SSN`, `Lab_Specialty`)
VALUES(
	1,
	'Electrical'
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
	'Labour'
); 

INSERT INTO Lab_Specialties(`Lab_SSN`, `Lab_Specialty`)
VALUES(
	2,
	'Contractor'
);

INSERT INTO User (`Username`, `Password`, `User_Type`, `ESSN`)
VALUES ('rupertraphael', 'password', 'Regular', 1);

INSERT INTO User (`Username`, `Password`, `User_Type`, `ESSN`)
VALUES ('jaxonbraun', 'password', 'Regular', 2);

INSERT INTO Part(`Part_No`) VALUES(1);
INSERT INTO Part(`Part_No`) VALUES(2);
INSERT INTO Part(`Part_No`) VALUES(3);
INSERT INTO Part(`Part_No`) VALUES(4);
INSERT INTO Part(`Part_No`) VALUES(5);

-- add a project, but project needs a contract and design, and contract also needs a client and Proposal
INSERT INTO client (`Client_Id`, `Email`, `Contact_Name`, `Company_Name`, `Website`, `Phone_No`,
		            `Address_Line_1`, `Address_Line_2`, `City`, `Prov_State`, `Country`,
		            `Postal_Zip`)
        VALUES (1, 'client1@gmail.com', 'Bob Loblaw', 'Bob Loblaw Law', 'www.blahblahblah.com',
                23548, '123 Main Street', 'NULL', 'Calgary', 'Alberta', 'Canada', 'T2X 4Z5');

INSERT INTO Proposal (`Proposal_No`, `Title`, `Value`, `Issued_Date`, `Expiry_Date`)
VALUES(
    1,
    'The Best Proposal',
    10000.00, 
    '2022-08-12',
    '2023-08-12'
);

INSERT INTO Client_Proposals(`Client_Id`, `Proposal_No`)
VALUES(
    1,
    1
);

INSERT INTO Contract(`Proposal_No`, `Contract_No`, `Start_Date`, `Delivery_Date`, `Payment_Terms`, `Issued_Date`, `Expiry_Date`, `Client_Id`)
VALUES(
    1,
    1,
    '2020-01-01',
    '2021-01-01',
    'Pay or else',
    '2019-12-01',
    '2021-12-01',
    1
);

INSERT INTO Design (`Design_No`, `Budget`)
VALUES (1, 3500.0000);

INSERT INTO Project(`Project_No`, `Start_Date`, `End_Date`, `Contract_No`, `Design_No`)
VALUES(
    1,
    '2022-01-01',
    '2023-01-01',
    1,
    1
);

-- insert order, labour_order and parts_inventory
INSERT INTO Orders(`Order_No`, `Ship_Date`, `Project_No`)
VALUES(
    1,
    '2023-02-01',
    1
);

INSERT INTO Labour_Order(`Labour_SSN`, `Order_No`, `Start_Date`, `Hours`)
VALUES(
    1,
    1,
    '2022-02-01',
    50
);

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

-- Vendor and Vendors_provides_parts

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
