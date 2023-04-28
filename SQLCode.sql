
CREATE database WoodyAutomative ;
USE WoodyAutomative;


CREATE TABLE  CUSTOMER ( ID INT AUTO_INCREMENT NOT NULL,  Name VARCHAR(45) NULL,  Address VARCHAR(45) NULL,  Phone VARCHAR(45) NULL,  Email VARCHAR(45) NULL,  CreditCard VARCHAR(45) NULL,  PRIMARY KEY (ID));


INSERT INTO CUSTOMER (ID, Name, Address, Phone, Email, CreditCard)
VALUES
  (1, 'Tanvi', '12 Lenmore Ct', '123-4567', 'tanvi99@gmail.com', '1234567891234567'),
  (2, 'Bala', '23 Jersey City', '234-5678', 'bala99@gmail.com', '2345678912345678'),
  (3, 'Sriram', '78 Newark', '345-6789', 'sriram99@gmail.com', '3456789123456789'),
  (4, 'Harry', '8 Comstock Ln', '456-7891', 'harry99@gmail.com', '4567891234567891'),
  (5, 'William', '948 West Side Ave', '567-8912', 'william78@gmail.com', '5678912345678912');



CREATE TABLE  LOCATION (  ID INT  AUTO_INCREMENT NOT NULL,  Address VARCHAR(45) NULL,  PRIMARY KEY (ID));


INSERT INTO LOCATION (ID, Address)
VALUES  (1, '1 Lenmore Ct'),  (2, '6 Comstock Ln'),  (3, '16 Cirdoff Street'),  (4, '5 Lenmore Ct'),  (5, '12 Cirdoff Street');




CREATE TABLE  VEHICLE (  VIN VARCHAR(45) NOT NULL, Model VARCHAR(15), Mfg DATE NULL,  Color VARCHAR(45) NULL,  Year INT NULL,  Type VARCHAR(45) NULL,  Customer_ID INT NULL,  PRIMARY KEY (VIN),  CONSTRAINT vehicle_customer    FOREIGN KEY (Customer_ID)    REFERENCES CUSTOMER (ID));



INSERT INTO VEHICLE (VIN, Model, Mfg, Color, Year, Type, Customer_ID)
VALUES
  ('JN3MS37A9PW202929', 'TESLA', '2022-01-20', 'Graphite', 2022, 'Sedan', 1),
  ('5YJSA1DG9DFP14705', 'BMW', '2020-02-21', 'Black', 2020, 'Coupe', 2),
  ('1GY1Z23J9P5803427', 'JAGUAR','2023-03-22', 'White', 2023, 'Sedan', 3),
  ('7J3ZZ56T783450003', 'MAZDA', '2021-04-23', 'Blue', 2021, 'SUV', 4),
  ('1G1YY0789G5100001', 'HONDA', '2020-05-24', 'Red', 2020, 'Sedan', 5);




CREATE TABLE  APPOINTMENT (  ID INT AUTO_INCREMENT NOT NULL,  Date DATE NULL,  Customer_ID INT NULL,  Location_ID INT NULL,
  VIN VARCHAR(45) NULL,  PRIMARY KEY (ID),  CONSTRAINT appointment_location_fk    FOREIGN KEY (Location_ID)   REFERENCES LOCATION (ID),  CONSTRAINT appointment_customer_fk    FOREIGN KEY (Customer_ID)    REFERENCES CUSTOMER (ID),  CONSTRAINT appointment_vehcile    FOREIGN KEY (VIN)    REFERENCES VEHICLE (VIN));



INSERT INTO APPOINTMENT (ID, Date, Customer_ID, Location_ID, VIN)
VALUES
  (1, '2023-04-01', 1, 1, 'JN3MS37A9PW202929'),
  (2, '2023-04-02', 2, 2, '5YJSA1DG9DFP14705'),
  (3, '2023-04-03', 3, 3, '1GY1Z23J9P5803427'),
  (4, '2023-04-04', 4, 4, '7J3ZZ56T783450003'),
  (5, '2023-04-05', 5, 5, '1G1YY0789G5100001');





CREATE TABLE  EMPLOYEE (
  SSN INT AUTO_INCREMENT NOT NULL,
  Name VARCHAR(45) NULL,
  HireDate DATE NULL,
  Role VARCHAR(45) NULL,
  Location_ID INT NULL,
  PRIMARY KEY (SSN),
CONSTRAINT location_employee
    FOREIGN KEY (Location_ID)
    REFERENCES LOCATION (ID));


INSERT INTO EMPLOYEE (SSN, Name, HireDate, Role, Location_ID)
VALUES
  (1, 'Justin', '2018-05-01', 'Manager', 1),
  (2, 'Selena', '2019-05-02', 'Service Advisor', 2),
  (3, 'Charan', '2020-05-03', 'Mechanic', 3),
  (4, 'John', '2021-05-04', 'Technician', 4),
  (5, 'Micheal', '2022-05-05', 'Salesperson', 5);



CREATE TABLE  TECHNICIAN (
  SSN INT AUTO_INCREMENT NOT NULL,
  HourlyRate INT NULL,
  PRIMARY KEY (SSN),
  CONSTRAINT tech_emp_fk
    FOREIGN KEY (SSN)
    REFERENCES EMPLOYEE (SSN));


INSERT INTO TECHNICIAN (SSN, HourlyRate)
VALUES
  (1, 25),
  (2, 35),
  (3, 45),
  (4, 55),
  (5, 65);



CREATE TABLE  MANAGER (  SSN INT AUTO_INCREMENT NOT NULL,  Salary INT NULL,
  PRIMARY KEY (SSN),  CONSTRAINT manager_employee_fk    FOREIGN KEY (SSN)   REFERENCES EMPLOYEE (SSN));



INSERT INTO MANAGER (SSN, Salary)
VALUES
  (1, 35000),
  (2, 30000),
  (3, 25000),
  (4, 40000),
  (5, 20000);



CREATE TABLE  SKILL (
  ID INT AUTO_INCREMENT NOT NULL,
  Name VARCHAR(45) NULL,
  PRIMARY KEY (ID));


INSERT INTO SKILL (ID, Name)
VALUES
  (1, 'Brake repair'),
  (2, 'Oil replace'),
  (3, 'Engine diagnostics'),
  (4, 'Suspension repair'),
  (5, 'Transmission repair');




CREATE TABLE  SERVICES_OFFERED (
  SVCType VARCHAR(45) NOT NULL,
  VehicleType VARCHAR(45) NOT NULL,
  Labor VARCHAR(45) NULL,
  Price INT NULL,
  Skill_ID INT NULL,
  PRIMARY KEY (SVCType, VehicleType),
 CONSTRAINT Skill_Service_Offered
    FOREIGN KEY (Skill_ID)
    REFERENCES SKILL (ID));


INSERT INTO SERVICES_OFFERED (SVCType, VehicleType, Labor, Price, Skill_ID)
VALUES
  ('Oil replace', 'Sedan', '30 minutes', 50, 2),
  ('Suspension repair', 'Hyundai', '3 hours', 300, 4),
  ('Brake repair', 'SUV', '2 hours', 200, 1),
  ('Engine diagnostics', 'Hyundai', '1 hour', 150, 3),
  ('Transmission repair', 'SUV', '4 hours', 400, 5);



CREATE TABLE  PART (
  ID INT AUTO_INCREMENT NOT NULL,
  Name VARCHAR(45) NULL,
  Price INT NULL,
  PRIMARY KEY (ID));


INSERT INTO PART (ID, Name, Price)
VALUES
  (1, 'Brake pads', 50),
  (2, 'Oil filter', 10),
  (3, 'Spark plugs', 20),
  (4, 'Shocks', 100),
  (5, 'Timing belt', 80);




CREATE TABLE  SERVICE_PART (
  Part_ID INT AUTO_INCREMENT NULL,
  SVCType VARCHAR(45) NULL,
  VehicleType VARCHAR(45) NULL,
  SP_ID INT NOT NULL,
  PRIMARY KEY (SP_ID),
  CONSTRAINT part_fk
    FOREIGN KEY (Part_ID)
    REFERENCES PART (ID),
  CONSTRAINT ServiceOffer_fk
    FOREIGN KEY (SVCType , VehicleType)
    REFERENCES SERVICES_OFFERED (SVCType , VehicleType));



INSERT INTO SERVICE_PART (Part_ID, SVCType, VehicleType, SP_ID)
VALUES
  (1, 'Oil replace', 'Sedan', 1),
  (2, 'Brake repair', 'SUV', 2),
  (3, 'Suspension repair', 'Hyundai', 3),
  (4, 'Engine diagnostics', 'Hyundai', 4),
  (5, 'Transmission repair', 'SUV', 5);



CREATE TABLE  INVOICE (
  ID INT AUTO_INCREMENT NOT NULL,
  Amount INT NULL,
  DatePaid DATE NULL,
  Appointment_ID INT NULL,
  SP_ID INT NULL,
  PRIMARY KEY (ID),
  FOREIGN KEY (SP_ID)
    REFERENCES service_part  (SP_ID), 
  FOREIGN KEY (Appointment_ID) 
references APPOINTMENT (ID)
 );



INSERT INTO INVOICE (ID, Amount, DatePaid, Appointment_ID, SP_ID )
VALUES
  (1, 200, '2022-04-15', 1, 1 ),
  (2, 150, '2022-03-25', 2, 2 ),
  (3, 300, '2022-05-10', 3, 3 ),
  (4, 100, NULL, 4, 4 ),
  (5, 400, '2022-06-01', 5, 5 );


CREATE TABLE  TECHNICIAN_SKILL (
  Technician_ID INT AUTO_INCREMENT NOT NULL,
  Skill_ID INT NOT NULL,
  PRIMARY KEY (Technician_ID, Skill_ID),
  CONSTRAINT skill_tech_fk
    FOREIGN KEY (Skill_ID)
    REFERENCES SKILL (ID),
  CONSTRAINT tech_skill_fk
    FOREIGN KEY (Technician_ID)
    REFERENCES TECHNICIAN (SSN));



INSERT INTO TECHNICIAN_SKILL (Technician_ID, Skill_ID)
VALUES 
  (1, 1),
  (2, 2),
  (3, 3),
  (4, 4),
  (5, 5);





