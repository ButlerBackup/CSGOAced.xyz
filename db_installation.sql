/* Setup */
CREATE DATABASE CSGOAced;

USE CSGOAced;

CREATE TABLE Roles
(
	Name VARCHAR(25) NOT NULL,
	Description VARCHAR(255),
	PRIMARY KEY (Name)
);

CREATE TABLE Skins
(
	MarketName VARCHAR(80) COLLATE utf8mb4_unicode_ci NOT NULL,
	Name VARCHAR(80) COLLATE utf8mb4_unicode_ci,
	IconURL VARCHAR(255),
	Color VARCHAR(255),
	PRIMARY KEY (MarketName)
);

CREATE TABLE Users
(
	ID INT NOT NULL AUTO_INCREMENT,
	Role VARCHAR(25) DEFAULT "Normal",
	Steam64 VARCHAR(17) NOT NULL,
	Name VARCHAR(32) NOT NULL,
	Coins INT NOT NULL DEFAULT 0,
	RefCode VARCHAR(7),
	Trade_URL VARCHAR(80),
	Avatar VARCHAR(125) NOT NULL,
	PrivateKey VARCHAR(128),
	FOREIGN KEY (Role) REFERENCES Roles (Name),
	PRIMARY KEY (ID)
);

CREATE TABLE LoginHistory
(
	ID INT NOT NULL AUTO_INCREMENT,
	UserID INT NOT NULL,
	IP VARCHAR(50) NOT NULL,
	LoginTimeStamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (UserID) REFERENCES Users (ID),
	PRIMARY KEY (ID)
);

CREATE TABLE ReferedUsersHistory
(
	ID INT NOT NULL AUTO_INCREMENT,
	UserID INT NOT NULL,
	ReferalID INT NOT NULL,
	ReferalCode VARCHAR(7) NOT NULL,
	RegistrationTimestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (UserID) REFERENCES Users (ID),
	FOREIGN KEY (ReferalID) REFERENCES Users (ID),
	PRIMARY KEY (ID)
);

CREATE TABLE ChatHistory
(
	ID INT NOT NULL AUTO_INCREMENT,
	UserID INT NOT NULL,
	Message VARCHAR(50) NOT NULL,
	MessageTimeStamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (UserID) REFERENCES Users (ID),
	PRIMARY KEY (ID)
);

CREATE TABLE RefreshPriceHistory
(
	ID INT NOT NULL AUTO_INCREMENT,
	UserID INT NOT NULL,
	RefreshTimeStamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (UserID) REFERENCES Users (ID),
	PRIMARY KEY (ID)
);

CREATE TABLE RefCodeHistory
(
	ID INT NOT NULL AUTO_INCREMENT,
	UserID INT NOT NULL,
	RefCode VARCHAR(7),
	CodeTimeStamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (UserID) REFERENCES Users (ID),
	PRIMARY KEY (ID)
);

CREATE TABLE TradeURLHistory
(
	ID INT NOT NULL AUTO_INCREMENT,
	UserID INT NOT NULL,
	Trade_URL VARCHAR(80),
	URLTimeStamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (UserID) REFERENCES Users (ID),
	PRIMARY KEY (ID)
);

CREATE TABLE NodeLogType
(
	Name VARCHAR(25) NOT NULL,
	Description VARCHAR(255),
	PRIMARY KEY (Name)
);

CREATE TABLE NodeLog
(
	ID INT NOT NULL AUTO_INCREMENT,
	Type VARCHAR(25),
	Description VARCHAR(255),
	LogTimeStamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (Type) REFERENCES NodeLogType (Name),
	PRIMARY KEY (ID)
);

CREATE TABLE SkinPrices
(
	ID INT NOT NULL AUTO_INCREMENT,
	SkinMarketName VARCHAR(80) COLLATE utf8mb4_unicode_ci NOT NULL,
	BuyPrice INT NOT NULL,
	SellPrice INT NOT NULL,
	FOREIGN KEY (SkinMarketName) REFERENCES Skins (MarketName),
	PRIMARY KEY (ID)
);

CREATE TABLE Inventories
(
	ID INT NOT NULL AUTO_INCREMENT,
	UserID INT NOT NULL,
	SkinMarketName VARCHAR(80) COLLATE utf8mb4_unicode_ci NOT NULL,
	AssetID VARCHAR(255) NOT NULL,
	ClassID VARCHAR(255) NOT NULL,
	FOREIGN KEY (UserID) REFERENCES Users (ID),
	FOREIGN KEY (SkinMarketName) REFERENCES Skins (MarketName),
	PRIMARY KEY (ID)
);

CREATE TABLE CoinflipHistory
(
	ID INT NOT NULL AUTO_INCREMENT,
	UserID1 INT NOT NULL,
	UserID2 INT,
	Ammount INT NOT NULL,
	Fee INT NOT NULL,
	IsFinished BOOLEAN NOT NULL Default 0,
	CreateTimestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (UserID1) REFERENCES Users (ID),
	FOREIGN KEY (UserID2) REFERENCES Users (ID),
	PRIMARY KEY (ID)
);

CREATE TABLE CoinflipResultHistory
(
	ID INT NOT NULL AUTO_INCREMENT,
	CoinflipID INT NOT NULL,
	WinnerID  INT NOT NULL,
	CreateTimestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (WinnerID) REFERENCES Users (ID),
	FOREIGN KEY (CoinflipID) REFERENCES CoinflipHistory (ID),
	PRIMARY KEY (ID)
);

CREATE TABLE TransactionTypes
(
	Name VARCHAR(25) NOT NULL,
	Description VARCHAR(255),
	PRIMARY KEY (Name)
);

CREATE TABLE TransactionState
(
	ID INT NOT NULL AUTO_INCREMENT,
	Name VARCHAR(25) NOT NULL,
	Description VARCHAR(255),
	PRIMARY KEY (ID)
);

CREATE TABLE Transactions
(
	ID INT NOT NULL AUTO_INCREMENT,
	Type VARCHAR(25) NOT NULL,
	UID INT NOT NULL,
	OfferID VARCHAR(10) NOT NULL,
	Status INT NOT NULL,
	OfferTimestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (Type) REFERENCES TransactionTypes (Name),
	FOREIGN KEY (Status) REFERENCES TransactionState (ID),
	FOREIGN KEY (UID) REFERENCES Users (ID),
	PRIMARY KEY (ID)
);

CREATE TABLE TransactionItems
(
	ID INT NOT NULL AUTO_INCREMENT,
	TransactionID INT NOT NULL,
	SkinMarketName VARCHAR(80) COLLATE utf8mb4_unicode_ci NOT NULL,
	AssetID VARCHAR(255) NOT NULL,
	ClassID VARCHAR(255) NOT NULL,
	Coins INT NOT NULL,
	FOREIGN KEY (TransactionID) REFERENCES Transactions (ID),
	FOREIGN KEY (SkinMarketName) REFERENCES Skins (MarketName),
	PRIMARY KEY (ID)
);

/* Create Default Registrys */
INSERT INTO Roles (Name) VALUES ('Normal');
INSERT INTO Roles (Name) VALUES ('Moderator');
INSERT INTO Roles (Name) VALUES ('Admin');
INSERT INTO Roles (Name) VALUES ('Bot');
INSERT INTO Roles (Name) VALUES ('Banned');

INSERT INTO NodeLogType (Name) VALUES ('Steam');
INSERT INTO NodeLogType (Name) VALUES ('Server');

INSERT INTO TransactionTypes (Name) VALUES ('Deposit');
INSERT INTO TransactionTypes (Name) VALUES ('Withdraw');

INSERT INTO TransactionState (Name) VALUES ('Invalid');
INSERT INTO TransactionState (Name) VALUES ('Active');
INSERT INTO TransactionState (Name) VALUES ('Accepted');
INSERT INTO TransactionState (Name) VALUES ('Countered');
INSERT INTO TransactionState (Name) VALUES ('Expired');
INSERT INTO TransactionState (Name) VALUES ('Canceled');
INSERT INTO TransactionState (Name) VALUES ('Declined');
INSERT INTO TransactionState (Name) VALUES ('Invalid Items');
INSERT INTO TransactionState (Name) VALUES ('Created Needs Confirmation');
INSERT INTO TransactionState (Name) VALUES ('Canceled By Second Factor');
INSERT INTO TransactionState (Name) VALUES ('In Escrow');

INSERT INTO Users (Steam64, Role) VALUES ('76561198357661961', 'Bot');
INSERT INTO Users (Steam64, Role) VALUES ('76561198357873819', 'Admin');

/* Profit Formula */
SELECT (
    (SELECT SUM(SkinPrices.SellPrice) FROM Skins INNER JOIN SkinPrices INNER JOIN Inventories ON Inventories.UserID = 1 AND Skins.MarketName=SkinPrices.SkinMarketName and Skins.MarketName=Inventories.SkinMarketName) -
    (SELECT SUM(Fee) FROM CoinflipHistory) -
    (SELECT SUM(Coins) FROM Users WHERE ID != 1) - 
    (SELECT SUM(Ammount) FROM CoinflipHistory WHERE IsFinished = 0)
);