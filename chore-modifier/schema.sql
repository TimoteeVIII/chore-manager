DROP TABLE user;
CREATE TABLE user (UserID integer primary key, Username varchar(30), Email varchar(100), Passcode varchar(200));

DROP TABLE household;
CREATE TABLE household (HouseID integer primary key, Inhabitant integer, HouseName varchar(50));

DROP TABLE chores;
CREATE TABLE chores (ChoreID integer primary key, HouseholdName varchar(50), ChoreName varchar(30), ChoreDesc varchar(100), Frequency varchar(30), PersonToComplete varchar(30), DateSet varchar(20), DateDue varchar(20), Completed varchar(15));