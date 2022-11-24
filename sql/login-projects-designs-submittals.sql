--Login
-- log in if count is 1
SELECT COUNT(*) FROM USER where username=$username and password=$password
-- store these in session.. use user_type to control read/write of data
SELECT username, user_type, essn FROM USER where username=$username and password=$password

--Project
--View Project Listing
SELECT
  Project.*, Design.Budget, Client.Contact_Name, Client.Company_Name, Client.Email
FROM
  PROJECT, DESIGN, CONTRACT, CLIENT
WHERE
  Project.Contract_No = Design.Contract_No AND
  Project.Contract_No = Contract.Contract_No AND
  Contract.Client_ID = Client.Client_ID

--Search
SELECT
  Project.*, Design.Budget, Client.Contact_Name, Client.Company_Name, Client.Email
FROM
  PROJECT, DESIGN, CONTRACT, CLIENT
WHERE
  Project.Contract_No = Design.Contract_No AND
  Project.Contract_No = Contract.Contract_No AND
  Contract.Client_ID = Client.Client_ID AND
  (
    Client.Contact_Name LIKE '%$search_term%' OR
    Client.Company_Name LIKE '%$search_term%' OR
    Client.Email LIKE '%$search_term%'
  )

--Select/View Single Project
SELECT
  Project.*,
  Design.Design_No,
  Design.Budget, 
  Client.Client_No,
  Client.Contact_Name,
  Client.Company_Name,
  Client.Email,
  Order.*

FROM
  PROJECT, DESIGN, CONTRACT, CLIENT, ORDER
WHERE
  Project.Project_No = $project_no AND
  Project.Contract_No = Design.Contract_No AND
  Project.Contract_No = Contract.Contract_No AND
  Contract.Client_ID = Client.Client_ID AND
  Order.Project_No = Project.Project_No

-- Create Project
INSERT INTO Project (Start_date, End_date, Contract_no, Design_No)
VALUES ($start_date, $end_date, $contract_no, $design_no)

-- Delete Project
DELETE FROM Project WHERE Project.project_no = $project_no

-- Edit Project
SELECT * FROM Project WHERE Project.project_no = $project_no

-- Save Project
UPDATE Project
SET Start_date = $start_date, End_date = $end_date
WHERE project.project_no = $project_no

-- Design
-- Design listing with engineering authors
SELECT  
  Design.*,
  Employees.First_Name,
  Employees.Last_Name,
  User.username
FROM Design, Engineering_Designs, Employees, User
WHERE
  Design.Design_No = Engineering_Designs.Design_No AND
  Engineering_Designs.Eng_SSN = Employee.SSN AND
  Employee.SSN = User.ESSN

-- Search through design listing
SELECT  
  Design.*,
  Employees.First_Name,
  Employees.Last_Name,
  User.username
FROM Design, Engineering_Designs, Employees, User
WHERE
  Design.Design_No = Engineering_Designs.Design_No AND
  Engineering_Designs.Eng_SSN = Employee.SSN AND
  Employee.SSN = User.ESSN AND
  (
    Design.Design_No LIKE '%$search_term%' OR
    Employees.First_Name LIKE '%$search_term%' OR
    Employees.Last_Name LIKE '%$search_term%' OR
    User.username LIKE '%$search_term%'
  )

-- View a design
SELECT  
  Design.*,
  Employees.First_Name,
  Employees.Last_Name,
  User.username,
  Drawing_No
FROM 
  Design,
  Engineering_Designs,
  Employees, 
  User, 
  (SELECT Drawing_No FROM Drawings WHERE Design_No = $design_no)
WHERE
  Design.Design_No = $design_no AND
  Engineering_Designs.Design_No = $design_no AND
  Engineering_Designs.Eng_SSN = Employee.SSN AND
  Employee.SSN = User.ESSN AND

-- Create a design
INSERT INTO Design (Design_No, Budget)
VALUES ($design_no, $budget)

-- Edit a design
SELECT  
  *
FROM Design, Drawings
WHERE
  Design.Design_No = $design_no

-- Update a design
UPDATE Design
SET Budget = $budget
WHERE Design_No = $design_no

-- Add a drawing
INSERT INTO Drawings (Design_No, Drawing_No)
VALUES ($design_no, $drawing_no)

-- Remove a drawing
DELETE FROM Drawings
WHERE design_no = $design_no AND drawing_no = $drawing_no

-- Add an author
INSERT INTO Engineering_Designs (Eng_SSN, Design_No)
VALUES ($eng_ssn, $design_no)

-- Remove an author
DELETE FROM Engineering_Designs
WHERE Eng_SSN = $eng_ssn and Design_No = $design_no

-- Delete a design
DELETE FROM Design
WHERE design_no = $design_no

-- Submittal
-- Submittal listing with engineering authors
SELECT  
  Submittal.*,
  Employees.First_Name,
  Employees.Last_Name,
  User.username
FROM Submittal, Engineering_Submittals, Employees, User
WHERE
  Submittal.Submittal_No = Engineering_Submittals.Submittal_No AND
  Engineering_Submittals.Eng_SSN = Employee.SSN AND
  Employee.SSN = User.ESSN


-- Search through submittal listing
SELECT  
  Submittal.*,
  Employees.First_Name,
  Employees.Last_Name,
  User.username
FROM Submittal, Engineering_Submittals, Employees, User
WHERE
  Submittal.Submittal_No = Engineering_Submittals.Submittal_No AND
  Engineering_Submittals.Eng_SSN = Employee.SSN AND
  Employee.SSN = User.ESSN AND
  (
    Submittal.Submittal_No LIKE '%$search_term%' OR
    Employees.First_Name LIKE '%$search_term%' OR
    Employees.Last_Name LIKE '%$search_term%' OR
    User.username LIKE '%$search_term%'
  )

-- View a single submittal
SELECT  
  Submittal.*,
  Employees.First_Name,
  Employees.Last_Name,
  User.username,
  Attachment
FROM 
  Submittal,
  Engineering_Submittals,
  Employees, 
  User, 
  (SELECT Attachment FROM Submittals_Attachments WHERE Submittal_No = $submittal_no)
WHERE
  Submittal.Submittal_No = $submittal_no AND
  Engineering_Submittals.Submittal_No = $submittal_no AND
  Engineering_Submittals.Eng_SSN = Employee.SSN AND
  Employee.SSN = User.ESSN AND

-- Create a submittal
INSERT INTO Submittal (Submittal_No, Contract_No)
VALUES ($submittal_no, $contract_no)

-- Add attachment
INSERT INTO Submittals_Attachments
VALUES ($submittal_no, $attachment)

-- Add an author
INSERT INTO Engineering_Submittals (Eng_SSN, Submittal_No)
VALUES ($eng_ssn, $submittal_no)

-- Remove an author
DELETE FROM Engineering_Submittals
WHERE Eng_SSN = $eng_ssn and Submittal_No = $submittal_no

-- Delete a submittal
DELETE FROM Submittal
WHERE Submittal_No = $submittal_no

-- Update a submittal
UPDATE Submittal
SET Contract_No = $contract_no
WHERE Submittal_No = $submittal_no

-- Edit submittal
SELECT * FROM Submittal
WHERE Submittal_No = $submittal_no





