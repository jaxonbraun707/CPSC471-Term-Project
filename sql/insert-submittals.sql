-- create submittals
INSERT INTO Submittal (`Submittal_No`, `Contract_No`)
VALUES (1, NULL);

INSERT INTO Submittal (`Submittal_No`, `Contract_No`)
VALUES (2, NULL);

INSERT INTO Submittal (`Submittal_No`, `Contract_No`)
VALUES (3, NULL);

-- insert employee (author of the submittals)
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
	1,
	'Software'
);

INSERT INTO Engineering_Submittals (`Eng_SSN`, `Submittal_No`)
VALUES (1, 1);

INSERT INTO Engineering_Submittals (`Eng_SSN`, `Submittal_No`)
VALUES (1, 2);

INSERT INTO Engineering_Submittals (`Eng_SSN`, `Submittal_No`)
VALUES (1, 3);

-- insert user for employee/author
INSERT INTO User (`Username`, `Password`, `User_Type`, `ESSN`)
VALUES ('rupertraphael', 'password', 'Regular', 1);

INSERT INTO User (`Username`, `Password`, `User_Type`, `ESSN`)
VALUES ('jaxonbraun', 'password', 'Regular', 2);