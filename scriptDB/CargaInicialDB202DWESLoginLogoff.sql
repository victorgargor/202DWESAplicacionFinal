USE DB202DWESLoginLogoff;

INSERT INTO T01_Usuario (T01_CodUsuario, T01_Password, T01_DescUsuario, T01_Perfil, T01_ImagenUsuario) VALUES
('admin', SHA2('adminpaso', 256), 'administrador', 'administrador',LOAD_FILE('../doc/admin.jpg')),
('victor', SHA2('victorpaso', 256), 'Víctor García Gordón', 'usuario',LOAD_FILE('../doc/victor.png')),
('alex', SHA2('alexpaso', 256), 'Alex Asensio Sánchez', 'usuario',LOAD_FILE('../doc/alex.jpg')),
('luis', SHA2('luispaso', 256), 'Luis Ferreras González', 'usuario',LOAD_FILE('../doc/luis.png')),
('jesus', SHA2('jesuspaso', 256), 'Jesus Ferreras González', 'usuario',LOAD_FILE('../doc/jesus.png')),
('heraclio', SHA2('heracliopaso', 256), 'Heraclio Borbujo Moran', 'usuario',LOAD_FILE('../doc/heraclio.jpg')),
('amor', SHA2('amorpaso', 256), 'Amor Rodriguez Navarro', 'usuario',LOAD_FILE('../doc/amor.png'));

INSERT INTO T02_Departamento VALUES
('ABC', 'Innovación y Desarrollo', now(), 3432, now()),
('DEF', 'Excelencia Operativa', now(), 4324, '2024-11-03 16:00:00'),
('GHI', 'Talento y Cultura', now(), 654, now()),
('JKL', 'Estrategia y Crecimiento', now(), 654.6, '2024-11-05 14:00:00'),
('MNO', 'Experiencia del Cliente', now(), 8766, '2024-11-02 13:00:00'),
('PQR', 'Finanzas y Administración', now(), 1234, '2024-12-01 10:00:00'),
('STU', 'Marketing Digital', now(), 2456, now()),
('VWX', 'Relaciones Públicas', now(), 6789, '2024-11-15 09:00:00'),
('YZA', 'Gestión de Riesgos', now(), 5623, now()),
('BCD', 'Sistemas y Tecnología', now(), 7845, '2024-11-20 12:00:00'),
('EFG', 'Logística y Distribución', now(), 4567, now()),
('HIJ', 'Atención al Cliente', now(), 3245, '2024-12-05 11:30:00'),
('KLM', 'Compras y Proveedores', now(), 8765, now()),
('NOP', 'Investigación de Mercado', now(), 1123, '2024-11-18 08:00:00'),
('QRS', 'Sostenibilidad y Medio Ambiente', now(), 3345, now()),
('TUV', 'Producción y Manufactura', now(), 6678, '2024-11-25 15:00:00'),
('WXY', 'Auditoría Interna', now(), 2234, now()),
('ZAB', 'Gestión de Proyectos', now(), 9987, '2024-12-02 17:00:00'),
('CDE', 'Desarrollo Organizacional', now(), 5566, now()),
('FGH', 'Seguridad y Salud Ocupacional', now(), 8899, '2024-11-30 14:30:00');

