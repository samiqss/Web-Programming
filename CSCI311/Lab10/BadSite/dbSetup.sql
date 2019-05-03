/*
	use this file to rebuild your database. 
*/
/*
keep the following 3 lines commented out the first time
then uncomment them to wipe and reset the db
*/
/*
drop table bands;
drop table albums;
drop table labels;
*/
/*create 3 tables*/
Create table bands (bandID int not null auto_increment primary key, bandName varchar (40) not null);
Create table albums( 
	albumID int not null auto_increment primary key, 
	albumName varchar(70) not null, releaseDate date,
	bandID int not null,
 	producerID int
	);

/*insert some data*/
Insert into bands(bandName) values 
	("The Who"), ("Moxy Fruvous"), ("The Doors"),
	("Maroon 5"), ("Justin Bieber"), ("Michael Jackson"),
	("Prince");

Insert into albums(albumName, bandID, releaseDate) values 
	("Under the Mistletow", 5, "2010-11-01"), 
	("Thriller", 6, "1982-11-30"), 
	("Off the Wall", 6, "1979-08-10"),
	("Tommy", 1, "1969-05-23"), 
	("Bargainville", 2, "1993-07-20"), 
	("Full Circle", 3, "1972-07-17");
	
