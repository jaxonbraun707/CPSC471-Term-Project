-- truncate related tables
TRUNCATE Design;
TRUNCATE Engineering_Designs;
TRUNCATE User;
TRUNCATE Employee;
TRUNCATE Regions;
TRUNCATE Eng_Specialties;
TRUNCATE Lab_Specialties;

-- create designs
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

-- insert employee (author of the designs)
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

-- insert author
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

-- insert user for employee/author
INSERT INTO User (`Username`, `Password`, `User_Type`, `ESSN`)
VALUES ('rupertraphael', 'password', 'Regular', 1);

INSERT INTO User (`Username`, `Password`, `User_Type`, `ESSN`)
VALUES ('jaxonbraun', 'password', 'Regular', 2);