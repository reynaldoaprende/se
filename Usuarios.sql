INSERT INTO `saludmentalunimag`.`users` (`role_id`, `document`, `name`, `last_name`, `email`, `phone`, `enabled`, `created_user_at`, `created_at`) VALUES 
('3', '40935960', 'Carmen', 'Reynoso Escorcia', 'creynoso@unimagdalena.edu.co', '3218730017', '2022-04-26 00:00:00', '1', '2022-04-26 00:00:00'),

('3', '1083004723', 'Katherin', 'Escudero Gutiérrez', 'kescudero@unimagdalena.edu.co', '3014298948', '2022-04-26 00:00:00', '1', '2022-04-26 00:00:00'),

('3', '57461980', 'Julia Lucía', 'Carrascal Navarro', 'jlcarrascal@unimagdalena.edu.co', '3004104165', '2022-04-26 00:00:00', '1', '2022-04-26 00:00:00'),

('3', '1082972026', 'Martha', 'Bolaño Miranda', 'mibolano@unimagdalena.edu.co', '3023749221', '2022-04-26 00:00:00', '1', '2022-04-26 00:00:00'),

('3', '39046066', 'Nazly', 'Barros González', 'nbarrosgon@unimagdalena.edu.co', '3183639096', '2022-04-26 00:00:00', '1', '2022-04-26 00:00:00'),

('3', '7142604', 'René', 'Peñaranda Pérez', 'rpenaranda@unimagdalena.edu.co', '3013612963', '2022-04-26 00:00:00', '1', '2022-04-26 00:00:00'),

('3', '1082870484', 'Johanna', 'Bocanegra Sandova', 'jbocanegras@unimagdalena.edu.co', '3118663346', '2022-04-26 00:00:00', '1', '2022-04-26 00:00:00'),

('3', '22506099', 'Diana', 'Diazgranados Fernández', 'ddiazgranadosf@unimagdalena.edu.co', '3156712668', '2022-04-26 00:00:00', '1', '2022-04-26 00:00:00');

update `users` set password='$2y$10$TxoMJHB/sIdkuNye.mTmp.aS.y0FQuFn5Nrnwc/1m3rGBEWfm.zc6' where role_id=3