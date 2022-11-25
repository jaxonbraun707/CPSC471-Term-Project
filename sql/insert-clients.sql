-- Truncate related tables
TRUNCATE client;

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
