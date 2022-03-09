CREATE TABLE IF NOT EXISTS `users` (
`id` INT AUTO_INCREMENT NOT NULL,
`fullName` varchar(60),
`username` varchar(60) NOT NULL UNIQUE,
`password` varchar(60) NOT NULL,
`role` varchar(40) NOT NULL,
`introduce` varchar(1000),
`status` INT,
PRIMARY KEY (`id`))

CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO users (username, password, role, introduce, status) VALUES ('admin', 'm4g1c_p14y_b0i_sql1njction', 'admin', 'I\'m the admin, i\'m smart', 1);
INSERT INTO users (fullName, username, password, role, introduce, status) VALUES ('John fish', 'jonathan69', 'heckye4h!', 'it', 'I don\'t like eating fish.', 0);
INSERT INTO users (fullName, username, password, role, introduce, status) VALUES ('Hannah Eve', 'ghanah', 'cr4ck_me123', 'accountant', 'SAY MY NAME backwards', 1);
INSERT INTO users (fullName, username, password, role, introduce, status) VALUES ('Rick Astley', 'rick123', 'summeR6532', 'it', 'Stop rick rolling me!', 0);
INSERT INTO users (fullName, username, password, role, introduce, status) VALUES ('Sam Sepiol', 'sepiolm4', 'elliot6745', 'manager', "<b>Control</b> can sometimes be an <b>illusion</b>. But sometimes you need illusions to gain control. Fantasy is an easy way to give meaning to the world. To cloak our harsh reality with escapist comfort. After all, isn't that why we surround ourselves with so many screens? So we can avoid seeing? So we can avoid each other? So we can avoid truth?", 1);
INSERT INTO users (fullName, username, password, role, introduce, status) VALUES ('George Washmachine', 'george420', 'pro_vip01', 'accountant', 'I don\'t like washing dishes.', 1);
