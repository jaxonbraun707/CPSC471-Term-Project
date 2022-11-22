Order: 

Creating the table:  

CREATE TABLE ORDER 

(Order_No	CHAR(10)	NOT NULL,  

Ship_Date	DATE, 

Project_No	CHAR(10)	NOT NULL, 

PRIMARY KEY (Order_No),  

FOREIGN KEY (Project_No) REFERENCES PROJECT(Project_No) ); 

Create Order: 

INSERT INTO ORDER VALUES(‘Order_No’, ‘Ship-Date’, ‘Project_No’); 

View Order Listing: 

SELECT * FROM ORDER; 

Search Order: 

SELECT * FROM ORDER WHERE Order_No LIKE %’Search_Query’%; 

Edit Order: 

SET Ship_Date=’New_Ship_Date’ WHERE Order_No=’Order_No’; 

SET Project_No=’New_Project_No’ WHERE Order_No=’Order_No’; 

Part: 

Create the table: 

CREATE TABLE PART 

(Part_No	VARCHAR(20)	NOT NULL,  

PRIMARY KEY (Part_No) ); 

Create Part: 

INSERT INTO PART VALUES(‘Part_No’); 

View All Parts: 

SELECT * FROM PART; 

Search for part: 

SELECT * FROM PART WHERE Part_No LIKE %’Search_Query’%; 

Delete Part: 

DELETE FROM PART WHERE Part_No=’Part_No’; 

Vendor: 

Creating the Table: 

CREATE TABLE VENDOR 

(Vendor_ID	INT	NOT NULL, 

Vendor_Name	VARCHAR(20)	NOT NULL, 

Phone_No	INT, 

PRIMARY KEY(Vendor_ID) ); 

Add Vendor: 

INSERT INTO VENDOR VALUES(‘Vendor_ID’, ‘Vendor_Name’, ‘Phone_No’); 

View All Vendors: 

SELECT * FROM VENDOR; 

Search for a vendor: 

SELECT * FROM VENDOR WHERE Vendor_Name LIKE %’Search_Query’%; 

Edit Vendor: 

SET Vendor_Name=’New_Vendor_Name’ WHERE Vendor_ID=’Vendor_ID’; 

SET Phone_No=’Phone_No’ WHERE Vendor_ID=’Vendor_ID’; 

Delete Vendor: 

DELETE FROM VENDOR WHERE Vendor_ID=’Vendor_ID’; 

Employees: 

Creating the table: 

CREATE TABLE EMPLOYEE 

(SSN	INT	NOT NULL, 

First_Name	VARCHAR(255)	NOT NULL, 

Last_Name	VARCHAR(255)	NOT NULL, 

DOB	DATE	NOT NULL, 

Phone_No	INT	NOT NULL, 

Email	VARCHAR(255), 

Address_Line_1		VARCHAR(255)	NOT NULL, 

Address_Line_2		VARCHAR(255), 

City			VARCHAR(255)	NOT NULL, 

Prov_State		VARCHAR(255)	NOT NULL, 

Country			VARCHAR(255)	NOT NULL, 

Postal_Zip		VARCHAR(255)	NOT NULL, 

Job_Type	VARCHAR(255), 

PRIMARY KEY(SSN) ); 

Insert an employee: 

INSERT INTO EMPLOYEE VALUES('SSN', 'First_Name', 'Last_Name', ‘DOB, 'Phone_No', ‘Email’, 'Address_Line_1', 'Address_Line_2', 'City', 'Prov_State', 'Country', 'Postal_Zip', ‘Job_Type’); 

View all Employees: 

SELECT * FROM EMPLOYEE 

Search for an Employee: 

SELECT * FROM EMPLOYEE WHERE First_Name LIKE %’First_Search_Query’% OR WHERE Last_Name LIKE %’Last_Search_Query’%; 

Edit Employee: 

SET First_Name=’New_First_Name’ WHERE SSN=’SSN’; 

SET Last_Name=’New_Last_Name’ WHERE SSN=’SSN’; 

SET DOB=’New_DOB’ WHERE SSN=’SSN’; 

SET Phone_No=’New_Phone_No’ WHERE SSN=’SSN’; 

SET Email=’New_Email’ WHERE SSN=’SSN’; 

SET Address_Line_1=’New_Address_Line_1’ WHERE SSN=’SSN’; 

SET Address_Line_2=’New_Address_Line_2’ WHERE SSN=’SSN’; 

SET City=’New_City’ WHERE SSN=’SSN’; 

SET Prov_State=’New_Prov_State WHERE SSN=’SSN’; 

SET Country=’New_Country’ WHERE SSN=’SSN’; 

SET Postal_Zip=’New_Postal_Zip’ WHERE SSN=’SSN’; 

SET Job_Type=’New_Job_Type’ WHERE SSN=’SSN’; 

Delete Employee: 

DELETE EMPLOYEE WHERE SSN=’SSN’; 

Sales have clients table create: 

CREATE TABLE SALES_HAVE_CLIENTS 

(Sales_SSN	INT	NOT NULL, 

Client_ID	INT	NOT NULL, 

FOREIGN KEY(Sales_SSN) REFERENCES EMPLOYEE(SSN), 

FOREIGN KEY(Client_ID) REFERENCES CLIENT(Client_ID) ); 

Sales proposals table create: 

CREATE TABLE SALES_PROPOSALS 

Sales_SSN	INT	NOT NULL, 

Proposal_No	INT	NOT NULL, 

FOREIGN KEY(Sales_SSN) REFERENCES EMPLOYEE(SSN), 

FOREIGN KEY(Proposal_No) REFERENCES CLIENT(Proposal_No) ); 

Vendors provide parts table create: 

CREATE TABLE VENDORS_PROVIDES_PARTS 

(Vendor_ID	INT	NOT NULL, 

Part_No	INT	NOT NULL, 

FOREIGN KEY(Vendor_Id) REFERENCES VENDOR(Vendor_ID), 

FOREIGN KEY(Part_No) REFERENCES PART(Part_No) ); 

Purchase_orders table create: 

CREATE TABLE PURCHASE_ORDERS 

(Purchaser_SSN	INT	NOT NULL, 

Vendor_ID	INT	NOT NULL, 

Purchase_Order	VARCHAR(255)	NOT NULL, 

FOREIGN KEY(Purchaser_SSN) REFERENCES  EMPLOYEE(SSN), 

FOREIGN KEY(Vendor_ID) REFERENCES VENDOR(Vendor_ID) ); 

Labour_order table create: 

CREATE TABLE LABOUR_ORDER 

(Labour_SSN	INT	NOT NULL, 

Order_No	INT	NOT NULL, 

Start_Date	DATE	NOT NULL, 

Hours	INT	NOT NULL, 

FOREIGN KEY(Labour_SSN) REFERENCES EMPLOYEE(SSN), 

FOREIGN KEY(Order_No) REFERENCES ORDER(Order_No) ); 

Parts inventory table create: 

CREATE TABLE PARTS_INVENTORY 

(Order_No	INT	NOT NULL, 

Part_No	INT	NOT NULL, 

Qty	INT	NOT NULL, 

FOREIGN KEY(Order_No) REFERENCES ORDER(Order_No), 

FOREIGN KEY(Part_No) REFERENCES PART(Part_No) ); 