/*CREATE DATABASE IF NOT EXISTS klmexpre_traveltz;

USE klmexpre_traveltz;*/

CREATE TABLE IF NOT EXISTS company (
    id int(11) auto_increment NOT NULL,
    name varchar(25) not null,
    logo text not null,
	primary key(id)
)ENGINE=INNODB;
	

CREATE TABLE IF NOT EXISTS bus (
    id int(11) auto_increment NOT NULL,
    name text,
    bus_no varchar (255) NOT NULL,
    co_id int(11) NOT NULL,
    features enum('TV','AC','CHARGE','DRINKS','TOILET','WIFI','TV,AC,CHARGE,DRINKS,TOILET,WIFI','TV,AC','TV,CHARGE','TV,DRINKS','TV,TOILET','TV,WIFI','AC,TV','AC,CHARGE','AC,DRINKS','AC,TOILET','AC,WIFI','CHARGE,TV','CHARGE,AC','CHARGE,DRINKS','CHARGE,TOILET','CHARGE,WIFI','DRINKS,TV','DRINKS,AC','DRINKS,CHARGE','DRINKS,TOILET','DRINKS,WIFI','TOILET,TV','TOILET,AC','TOILET,CHARGE','TOILET,DRINKS','TOILET,WIFI','WIFI,TV','WIFI,AC','WIFI,DRINKS','WIFI,CHARGE','WIFI,TOILET') not null default '',
    seats_count int(11) NOT NULL,
	primary key(id),
	foreign key(co_id) references company(id)
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS routine (
    id int(11) auto_increment NOT NULL,
    bus_id int(11) NOT NULL,
    dep_date datetime not null ,
	primary key(id),
	foreign key(bus_id) references bus(id)
)ENGINE=INNODB;
	

CREATE TABLE IF NOT EXISTS users (
    id int(11) auto_increment NOT NULL,
    username varchar(255) NOT NULL,
    fname varchar(25) NOT NULL,
    lname varchar(25) NOT NULL,
    email text NOT NULL,
    phone_number int(11) NOT NULL,
    age date NOT NULL,
    password text NOT NULL,
    co_id int(11),
	birth_date datetime not null,
    priv enum('user','admin','agent','super') default 'user' not null,
    gender enum('m','f') default 'm' NOT NULL,
	PRIMARY KEY(id),
	UNIQUE KEY(username), 
	foreign key(co_id) references company(id)
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS location (
    id int(11) auto_increment NOT NULL,
    name text NOT NULL,
	primary key(id)
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS routes (
    id int(11) auto_increment NOT NULL,
    r1 int(11) NOT NULL,
    r2 int(11) NOT NULL,
	primary key(id),
	foreign key(r1) references location(id),
	foreign key(r2) references location(id)
)ENGINE=INNODB;
	

CREATE TABLE IF NOT EXISTS seats (
    id int(11) auto_increment NOT NULL,
    sno int(11) NOT NULL,
	primary key(id)
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS bus_features(
id int(11) auto_increment not null,
	amenities enum('0','1','2','3','4') not null default '0',
	bus_id int(11) not null,
	primary key(id),
	foreign key(bus_id) references bus(id)
) ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS seat_costs (
    id int(11) auto_increment NOT NULL,
    cost int(11) NOT NULL,
    seat_id int(11) NOT NULL,
    bus_id int(11) NOT NULL,
    co_id int(11) NOT NULL,
	primary key(id),
	foreign key(bus_id) references bus(id),
	foreign key(co_id) references company(id),
	foreign key(seat_id) references seats(id)
)ENGINE=INNODB;
	
CREATE TABLE IF NOT EXISTS seat_status (
    id int(11) auto_increment NOT NULL,
    status enum('0','1') DEFAULT '0'  NOT NULL,
    time datetime  DEFAULT CURRENT_TIMESTAMP NOT NULL,
    seat_id int(11) NOT NULL,
    co_id int(11) NOT NULL,
    bus_id int(11) NOT NULL,
    user_id int(11) NOT NULL,
	s_cost_id int(11) not null,
	primary key(id),
	foreign key(seat_id) references seats(id),
	foreign key(user_id) references users(id),
	foreign key(bus_id) references bus(id),
	foreign key(co_id) references company(id),
	foreign key(s_cost_id) references seat_costs(id)
)ENGINE=INNODB;

CREATE TABLE IF NOT EXISTS tickets (
    id int(11) auto_increment NOT NULL,
    tno int(11) NOT NULL,
    ticket text NOT NULL,
    qr text NOT NULL,
    checkin enum('0','1') DEFAULT '0' NOT NULL,
    t_time datetime  DEFAULT CURRENT_TIMESTAMP NOT NULL,
    bus_id int(11) NOT NULL,
    route_id int(11) NOT NULL,
    user_id int(11) NOT NULL,
    seat_id int(11) NOT NULL,
	primary key(id),
	unique key(tno),
	foreign key(bus_id) references bus(id),
	foreign key(route_id) references routes(id),
	foreign key(user_id) references users(id),
	foreign key(seat_id) references seats(id)
)ENGINE=INNODB;
