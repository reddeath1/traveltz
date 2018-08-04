CREATE TABLE IF NOT EXISTS company (
    id int(11) auto_increment NOT NULL,
    name varchar(25),	primary key(id)
);	CREATE TABLE IF NOT EXISTS bus (    id int(11) auto_increment NOT NULL,    name text,    bus_no int(11) NOT NULL,    co_id int(11) NOT NULL,    seats_count int(11) NOT NULL,	primary key(id),	co_id references company(id));	CREATE TABLE IF NOT EXISTS IF NOT EXISTS users (    id int(11) auto_increment NOT NULL,    username varchar(255) NOT NULL,    fname varchar(25) NOT NULL,    lname varchar(25) NOT NULL,    email text NOT NULL,    phone_number int(11) NOT NULL,    age int(11) NOT NULL,    password text NOT NULL,    co_id int(11),    priv enum('user','admin','agent','super') default 'user' not null,    gender enum('m','f') default 'm' NOT NULL,	PRIMARY KEY(id),	UNIQUE KEY(username) );
CREATE TABLE IF NOT EXISTS location (
    id int(11) auto_increment NOT NULL,
    name text NOT NULL,	primary key(id)
);
CREATE TABLE IF NOT EXISTS routes (
    id int(11) auto_increment NOT NULL,
    r1 text NOT NULL,
    r2 text NOT NULL,	primary key(id),	r1 references location(id),	r2 references location(id)
);	CREATE TABLE IF NOT EXISTS seats (    id int(11) auto_increment NOT NULL,    sno int(11) NOT NULL,	primary key(id));

CREATE TABLE IF NOT EXISTS seat_costs (
    id int(11) auto_increment NOT NULL,
    cost int(11) NOT NULL,    seat_id int(11) NOT NULL,
    bus_id int(11) NOT NULL,
    co_id int(11) NOT NULL,	primary key(id),	bus_id references bus(id),	co_id references company(id),	seat_id references seats(id)
	);	
CREATE TABLE IF NOT EXISTS seat_status (
    id int(11) auto_increment NOT NULL,
    status enum('0','1') DEFAULT '0'  NOT NULL,    time datetime  DEFAULT CURRENT_TIMESTAMP NOT NULL,    seat_id int(11) NOT NULL,
    co_id int(11) NOT NULL,
    bus_id int(11) NOT NULL,
    user_id int(11) NOT NULL,	s_cost_id int(11) not null,	primary key(id),	seat_id references seats(id),	user_id references users(id),	bus_id references bus(id),	co_id references company(id),	s_cost_id references seat_costs(id)
);
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
    seat_id int(11) NOT NULL,	primary key(id),	unique key(tno),	bus_id references bus(id),	route_id references routes(id),	user_id references users(id),	seat_id references seats(id)
);