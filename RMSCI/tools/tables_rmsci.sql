SET foreign_key_checks = 0;
DROP TABLE IF EXISTS patient;
DROP TABLE IF EXISTS exam;
DROP TABLE IF EXISTS image;
DROP TABLE IF EXISTS CR;
DROP TABLE IF EXISTS CT;
DROP TABLE IF EXISTS MG;
DROP TABLE IF EXISTS mg_filters;
DROP TABLE IF EXISTS ct_filters;
DROP TABLE IF EXISTS cr_filters;
DROP TABLE IF EXISTS ct_sums;
DROP TABLE IF EXISTS cr_sums;
DROP TABLE IF EXISTS mg_sums;
DROP TABLE IF EXISTS allCTdata;
DROP TABLE IF EXISTS allMGdata;
DROP TABLE IF EXISTS allCRdata;
DROP TABLE IF EXISTS users;
SET foreign_key_checks = 1;

CREATE TABLE users (
	user CHAR(100),
	keyword CHAR(100),
	email CHAR(100),
	PRIMARY KEY (email));


CREATE TABLE patient (
	patientID CHAR(100),
	gender CHAR (1),
	age INT(3),
	pregnancy INT(1),
	email CHAR(100),
	PRIMARY KEY (email, patientID));
	
CREATE TABLE exam (
	examID CHAR(100),
	date date,
	equipment CHAR(100),
	equipmentModel CHAR (100),
	modality CHAR(100),
	operatorsName CHAR(100),
	DLP_mGYcm FLOAT,
	DAP_mGycm2 FLOAT,
	patientID CHAR(100) NOT NULL,
	email CHAR(100),
	PRIMARY KEY (email, examID),
	FOREIGN KEY (email, patientID) REFERENCES patient(email, patientID));
	
CREATE TABLE image(
	imageID INT(10) AUTO_INCREMENT,
	studyDescription CHAR(100),
	bodyPart CHAR(100),
	voltage_kV FLOAT,
	exposureTime_secs FLOAT,
	examID CHAR(100),
	email CHAR(100),
	PRIMARY KEY (imageID, examID),
	FOREIGN KEY (email, examID) REFERENCES exam(email, examID));
	
CREATE TABLE CR(
	imageID INT(10),
	examID CHAR(100),
	seriesDescription CHAR(100),
	relativeExposure FLOAT,
	exposureIndex FLOAT,
	IADP_mGycm2 FLOAT,
	focalSpot_cm FLOAT,
	email CHAR(100),
	PRIMARY KEY (imageID, examID),
	FOREIGN KEY (imageID, examID) REFERENCES image (imageID, examID));
	
CREATE TABLE MG(
	imageID INT(10),
	examID CHAR(100),
	organDose_mGy FLOAT,
	relativeExposure FLOAT,
	entranceDose_mGy FLOAT,
	sliceThickness_cm FLOAT,
	cforce_N FLOAT,
	email CHAR(100),
	PRIMARY KEY (imageID, examID),
	FOREIGN KEY (imageID, examID) REFERENCES image (imageID, examID));
	
CREATE TABLE CT(
	imageID INT(10),
	examID CHAR(100),
	ctdivol_mGy FLOAT,
	ctdiw  FLOAT,
	pitch_factor FLOAT,
	sliceThick_cm FLOAT,
	email CHAR(100),
	PRIMARY KEY (imageID, examID),
	FOREIGN KEY (imageID, examID) REFERENCES image (imageID, examID));
	

CREATE TABLE mg_filters (	
	examid CHAR(100),
	slice_thick FLOAT,
	equipmentmodel CHAR(100),
	email CHAR(100),
	PRIMARY KEY (examid, slice_thick, equipmentmodel, email));

	
CREATE TABLE ct_filters (
	examid CHAR(100),
	bodypart CHAR(100),
	equipmentmodel CHAR(100),
	email CHAR(100),
	PRIMARY KEY (examid, bodypart, equipmentmodel, email));
	
CREATE TABLE cr_filters (
	examid CHAR(100),
	bodypart CHAR(100),
	seriesDesc CHAR(100),
	voltage FLOAT,
	exposureTime FLOAT,
	equipmentmodel CHAR(100),
	email CHAR(100),
	PRIMARY KEY (examid, bodypart, seriesDesc, voltage, exposureTime, equipmentmodel, email));
	
	
CREATE TABLE ct_sums (
	examid CHAR(100),
	date date,
	ctdiw_sums FLOAT,
	dlp FLOAT,
	imagesNumber INT(5),
	equipmentmodel CHAR(100),
	email CHAR(100),
	PRIMARY KEY (email, examid),
	FOREIGN KEY (email, examid) REFERENCES exam(email,examid));
	
CREATE TABLE mg_sums (
	examid CHAR(100),
	date date,
	dosesums FLOAT,
	timesums FLOAT,
	voltagesums FLOAT,
	cforcesums FLOAT,
	imagesNumber INT(5),
	email CHAR(100),
	PRIMARY KEY (email, examid),
	FOREIGN KEY (email, examid) REFERENCES exam(email,examid));
	
CREATE TABLE cr_sums (
	examid CHAR(100),
	date date,
	iadp_sums FLOAT,
	timesums FLOAT,
	voltagesums FLOAT,
	imagesNumber INT(5),
	email CHAR(100),
	PRIMARY KEY (email, examid),
	FOREIGN KEY (email, examid) REFERENCES exam(email,examid));
	
CREATE TABLE allCTdata (
	imageid INT(10),
	examid CHAR(100),
	date date,
	ctdiw FLOAT,
	bodypart CHAR(100),
	equipmentmodel CHAR(100),
	email CHAR(100),
	PRIMARY KEY(imageid));
	

CREATE TABLE allMGdata (
	imageid INT(10),
	examid CHAR(100),
	date date,
	organDose FLOAT,
	sliceThickness_cm FLOAT,
	cforce_N FLOAT,
	voltage FLOAT,
	exposureTime FLOAT,
	equipmentmodel CHAR(100),
	email CHAR(100),
	PRIMARY KEY(imageid));
	

	
CREATE TABLE allCRdata (
	imageid INT(10),
	examid CHAR(100),
	date date,
	iadp FLOAT,
	exposureTime FLOAT,
	voltage FLOAT,
	bodypart CHAR(100),
	series CHAR(100),
	equipmentmodel CHAR(100),
	email CHAR(100),
	PRIMARY KEY(imageid));


	
DELIMITER $$  
CREATE TRIGGER after_Exam
AFTER INSERT ON exam
FOR EACH ROW
	BEGIN 
		IF (NEW.modality = 'CT')
		THEN
		INSERT IGNORE INTO ct_sums
		VALUES (NEW.examID, NEW.date, NULL, NULL, NULL, NEW.equipmentModel, NEW.email);
		ELSEIF (NEW.modality = 'CR')
		THEN
		INSERT IGNORE INTO cr_sums
		VALUES (NEW.examID, NEW.date, NULL, NULL, NULL, NULL, NEW.email);
		ELSE
		INSERT IGNORE INTO mg_sums
		VALUES (NEW.examID, NEW.date, NULL, NULL, NULL, NULL, NULL, NEW.email);
		END IF;
	END $$
DELIMITER ;

DELIMITER $$  
CREATE TRIGGER after_ct
AFTER INSERT ON ct
FOR EACH ROW
	BEGIN 
		
		IF ((SELECT ctdiw_sums from ct_sums where examid=NEW.examID AND email=NEW.email) IS NOT NULL)
		THEN
		UPDATE ct_sums
		SET ctdiw_sums = ctdiw_sums + NEW.ctdiw, imagesNumber = imagesNumber + 1
		WHERE examid = NEW.examID AND NEW.ctdiw IS NOT NULL;
		UPDATE ct_sums
		SET dlp = dlp + (NEW.ctdivol_mGy * NEW.sliceThick_cm)
		WHERE examid = NEW.examID;
		ELSE
		UPDATE ct_sums
		SET ctdiw_sums = 0, imagesNumber = 0
		WHERE examid = NEW.examID AND NEW.ctdiw IS NOT NULL;
		UPDATE ct_sums
		SET dlp = 0
		WHERE examid = NEW.examID AND NEW.ctdivol_mGy IS NOT NULL;
		UPDATE ct_sums
		SET ctdiw_sums = ctdiw_sums + NEW.ctdiw, imagesNumber = imagesNumber + 1
		WHERE examid = NEW.examID AND NEW.ctdiw IS NOT NULL;
		UPDATE ct_sums
		SET dlp = dlp + (NEW.ctdivol_mGy * NEW.sliceThick_cm)
		WHERE examid = NEW.examID AND NEW.ctdivol_mGy IS NOT NULL;
		END IF;
		IF (NEW.ctdivol_mGy IS NOT NULL)
		THEN
		INSERT IGNORE INTO ct_filters
		VALUES (NEW.examID, (SELECT bodyPart FROM image WHERE imageID = NEW.imageID), (SELECT equipmentModel FROM exam WHERE examID = NEW.examID AND email=NEW.email), NEW.email);
		INSERT INTO allCTdata
		VALUES (NEW.imageID, NEW.examID, (SELECT date FROM exam WHERE examID=NEW.examID AND email=NEW.email), NEW.ctdiw, (SELECT bodyPart FROM image WHERE imageID=NEW.imageID), (SELECT equipmentModel FROM exam WHERE examID = NEW.examID AND email=NEW.email), NEW.email);
		END IF;
	END $$
DELIMITER ;

DELIMITER $$  
CREATE TRIGGER after_cr
AFTER INSERT ON cr
FOR EACH ROW
	BEGIN 
		
		IF ((SELECT iadp_sums  from cr_sums where examid=NEW.examID AND email=NEW.email) IS NOT NULL)
		THEN
		UPDATE cr_sums
		SET iadp_sums = iadp_sums + NEW.IADP_mGycm2, imagesNumber = imagesNumber + 1
		WHERE examid = NEW.examID AND NEW.IADP_mGycm2 IS NOT NULL;
		ELSE
		UPDATE cr_sums
		SET iadp_sums = 0, imagesNumber = 0
		WHERE examid = NEW.examID AND NEW.IADP_mGycm2 IS NOT NULL;
		UPDATE cr_sums
		SET iadp_sums = iadp_sums + NEW.IADP_mGycm2, imagesNumber = imagesNumber + 1
		WHERE examid = NEW.examID AND NEW.IADP_mGycm2 IS NOT NULL;
		END IF;
		IF (NEW.IADP_mGycm2 IS NOT NULL)
		THEN
		INSERT IGNORE INTO cr_filters
		VALUES (NEW.examID, (SELECT bodypart FROM image WHERE imageID = NEW.imageID), NEW.seriesDescription, (SELECT voltage_kV FROM image WHERE imageID = NEW.imageID), (SELECT exposureTime_secs FROM image WHERE imageID = NEW.imageID), (SELECT equipmentModel FROM exam WHERE examID = NEW.examID AND email=NEW.email), NEW.email);
		END IF;
		INSERT INTO allCRdata
		VALUES (NEW.imageID, NEW.examID, (SELECT date FROM exam WHERE examID=NEW.examID AND email=NEW.email), NEW.IADP_mGycm2, (SELECT exposureTime_secs FROM image WHERE imageID=NEW.imageID), (SELECT voltage_kV FROM image WHERE imageID=NEW.imageID), (SELECT bodyPart FROM image WHERE imageID=NEW.imageID), NEW.seriesDescription, (SELECT equipmentModel FROM exam WHERE examID = NEW.examID AND email=NEW.email), NEW.email);
		
		
	END $$
DELIMITER ;

DELIMITER $$  
CREATE TRIGGER after_image
AFTER INSERT ON image
FOR EACH ROW
	BEGIN 
		IF ((SELECT timesums from cr_sums where examid=NEW.examID AND email=NEW.email) IS NOT NULL)
		THEN
		UPDATE cr_sums
		SET timesums = timesums + NEW.exposureTime_secs
		WHERE examid = NEW.examID AND NEW.exposureTime_secs IS NOT NULL;
		ELSE
		UPDATE cr_sums
		SET timesums = 0
		WHERE examid = NEW.examID AND NEW.exposureTime_secs IS NOT NULL;
		UPDATE cr_sums
		SET timesums = timesums + NEW.exposureTime_secs
		WHERE examid = NEW.examID AND NEW.exposureTime_secs IS NOT NULL;
		END IF;
		IF ((SELECT timesums from mg_sums where examid=NEW.examID AND email=NEW.email) IS NOT NULL)
		THEN
		UPDATE mg_sums
		SET timesums = timesums + NEW.exposureTime_secs
		WHERE examid = NEW.examID AND NEW.exposureTime_secs IS NOT NULL;
		ELSE
		UPDATE mg_sums
		SET timesums = 0
		WHERE examid = NEW.examID AND NEW.exposureTime_secs IS NOT NULL;
		UPDATE mg_sums
		SET timesums = timesums + NEW.exposureTime_secs
		WHERE examid = NEW.examID AND NEW.exposureTime_secs IS NOT NULL;
		END IF;
		IF ((SELECT voltagesums from mg_sums where examid=NEW.examID AND email=NEW.email) IS NOT NULL)
		THEN
		UPDATE mg_sums
		SET voltagesums = voltagesums + NEW.voltage_kV
		WHERE examid = NEW.examID AND NEW.voltage_kV IS NOT NULL;
		ELSE
		UPDATE mg_sums
		SET voltagesums = 0
		WHERE examid = NEW.examID AND NEW.voltage_kV IS NOT NULL;
		UPDATE mg_sums
		SET voltagesums = voltagesums + NEW.voltage_kV
		WHERE examid = NEW.examID AND NEW.voltage_kV IS NOT NULL;
		END IF;
		IF ((SELECT voltagesums from cr_sums where examid=NEW.examID AND email=NEW.email) IS NOT NULL)
		THEN
		UPDATE cr_sums
		SET voltagesums = voltagesums + NEW.voltage_kV
		WHERE examid = NEW.examID AND NEW.voltage_kV IS NOT NULL;
		ELSE
		UPDATE cr_sums
		SET voltagesums= 0
		WHERE examid = NEW.examID AND NEW.voltage_kV IS NOT NULL;
		UPDATE cr_sums
		SET voltagesums = voltagesums + NEW.voltage_kV
		WHERE examid = NEW.examID AND NEW.voltage_kV IS NOT NULL;
		END IF;
	END $$
DELIMITER ;


DELIMITER $$  
CREATE TRIGGER after_mg
AFTER INSERT ON mg
FOR EACH ROW
	BEGIN 
		IF ((SELECT dosesums from mg_sums where examid=NEW.examID AND email=NEW.email) IS NOT NULL)
		THEN
		UPDATE mg_sums
		SET dosesums = dosesums + NEW.organDose_mGy, imagesNumber = imagesNumber + 1
		WHERE examid = NEW.examID AND NEW.organDose_mGy IS NOT NULL;
		ELSE
		UPDATE mg_sums
		SET dosesums = 0, imagesNumber = 0
		WHERE examid = NEW.examID AND NEW.organDose_mGy IS NOT NULL;
		UPDATE mg_sums
		SET dosesums = dosesums + NEW.organDose_mGy, imagesNumber = imagesNumber + 1
		WHERE examid = NEW.examID AND NEW.organDose_mGy IS NOT NULL;
		END IF;
		IF (NEW.organDose_mGy IS NOT NULL)
		THEN
		INSERT IGNORE INTO mg_filters
		VALUES (NEW.examID, NEW.sliceThickness_cm, (SELECT equipmentModel FROM exam WHERE examID = NEW.examID AND email=NEW.email),NEW.email);
		INSERT INTO allMGdata
		VALUES (NEW.imageID, NEW.examID, (SELECT date FROM exam WHERE examID=NEW.examID AND email=NEW.email), NEW.organDose_mGy, NEW.sliceThickness_cm, NEW.cforce_N, (SELECT voltage_kV FROM image WHERE imageID = NEW.imageID), (SELECT exposureTime_secs FROM image WHERE imageID = NEW.imageID), (SELECT equipmentModel FROM exam WHERE examID = NEW.examID AND email=NEW.email),NEW.email);
		END IF;
		IF ((SELECT cforcesums from mg_sums where examid=NEW.examID AND email=NEW.email) IS NOT NULL)
		THEN
		UPDATE mg_sums
		SET cforcesums = cforcesums + NEW.cforce_N
		WHERE examid = NEW.examID and NEW.cforce_N IS NOT NULL;
		ELSE
		UPDATE mg_sums
		SET cforcesums = 0
		WHERE examid = NEW.examID and NEW.cforce_N IS NOT NULL;
		UPDATE mg_sums
		SET cforcesums = cforcesums + NEW.cforce_N
		WHERE examid = NEW.examID and NEW.cforce_N IS NOT NULL;
		END IF;
		
	END $$
DELIMITER ;

DELIMITER $$  
CREATE TRIGGER after_cr_sums
AFTER UPDATE ON cr_sums
FOR EACH ROW
	BEGIN 
		IF (NEW.iadp_sums IS NOT NULL)
		THEN
		UPDATE exam
		SET DAP_mGycm2 = NEW.iadp_sums
		WHERE examID = NEW.examid
		AND email=NEW.email;
		END IF;
	END $$
DELIMITER ;

DELIMITER $$  
CREATE TRIGGER after_ct_sums
AFTER UPDATE ON ct_sums
FOR EACH ROW
	BEGIN 
		IF (NEW.dlp IS NOT NULL)
		THEN
		UPDATE exam
		SET DLP_mGYcm = NEW.dlp
		WHERE examID = NEW.examid
		AND email=NEW.email;
		END IF;
	END $$
DELIMITER ;


