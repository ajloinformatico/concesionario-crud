
use concesionario;
INSERT INTO usuarios (id, username, email, contrasena) VALUES (NULL, 'sabascal', 'sabascalito@smd.wtf', 'pestillo'); 
INSERT INTO usuarios (id, username, email, contrasena) VALUES (NULL, 'psanchez', 'psan@smd.wtf', 'pestillo'); 

INSERT INTO coches (matricula, precio, marca, modelo, n_puertas, edad)
VALUES ('4444fff',  5000.60,'citroen', 'c4', 4, '2009-01-02'),
    ('6666hhh', 6000.00, 'dacia', 'duster', 4, '2019-01-02');



REVOKE ALL PRIVILEGES ON *.* FROM 'alumnado'@'%'; GRANT ALL PRIVILEGES ON *.* TO 'alumnado'@'%' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0; 
