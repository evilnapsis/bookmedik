-- BookMedik Demo Data Script
-- Categorias / Especialidades
INSERT INTO category (id, name) VALUES 
(1, 'Medicina General')
ON DUPLICATE KEY UPDATE name='Medicina General';

INSERT INTO category (id, name) VALUES
(2, 'Pediatría'),
(3, 'Cardiología'),
(4, 'Dermatología'),
(5, 'Ginecología y Obstetricia'),
(6, 'Traumatología y Ortopedia'),
(7, 'Oftalmología'),
(8, 'Odontología'),
(9, 'Neurología'),
(10, 'Otorrinolaringología')
ON DUPLICATE KEY UPDATE name=VALUES(name);

-- Médicos Demo (12 registros)
INSERT INTO medic (id, no, name, lastname, gender, day_of_birth, email, address, phone, image, is_active, created_at, category_id) VALUES
(1, 'MED-001', 'Carlos', 'Ramírez Ruiz', 'm', '1980-05-14', 'carlos.ramirez@bookmedik.com', 'Av. Insurgentes Sur 1245, CDMX', '555-123-4567', NULL, 1, '2026-08-01 10:00:00', 1),
(2, 'MED-002', 'Sofía', 'Mendoza Morales', 'f', '1985-09-22', 'sofia.mendoza@bookmedik.com', 'Calle Reforma 402, Guadalajara', '333-890-1234', NULL, 1, '2026-08-02 11:30:00', 2),
(3, 'MED-003', 'Alejandro', 'Torres Vega', 'm', '1976-12-03', 'alejandro.torres@bookmedik.com', 'Blvd. Puerta de Hierro 550, Zapopan', '333-456-7890', NULL, 1, '2026-08-03 09:15:00', 3),
(4, 'MED-004', 'Valeria', 'Gómez Castillo', 'f', '1988-03-18', 'valeria.gomez@bookmedik.com', 'Av. Constitución 890, Monterrey', '811-234-5678', NULL, 1, '2026-08-05 14:00:00', 4),
(5, 'MED-005', 'Mariana', 'Herrera Silva', 'f', '1982-07-29', 'mariana.herrera@bookmedik.com', 'Av. Hidalgo 312, Puebla', '222-345-6789', NULL, 1, '2026-08-10 08:30:00', 5),
(6, 'MED-006', 'Roberto', 'Flores Cruz', 'm', '1979-11-11', 'roberto.flores@bookmedik.com', 'Calzada del Valle 120, San Pedro', '818-765-4321', NULL, 1, '2026-08-12 16:45:00', 6),
(7, 'MED-007', 'Laura', 'Navarro Pérez', 'f', '1984-01-25', 'laura.navarro@bookmedik.com', 'Calle 60 No. 405, Mérida', '999-123-9876', NULL, 1, '2026-08-15 12:00:00', 7),
(8, 'MED-008', 'Fernando', 'Vargas Ortiz', 'm', '1990-06-30', 'fernando.vargas@bookmedik.com', 'Av. Juárez 780, Querétaro', '442-987-6543', NULL, 1, '2026-08-18 10:20:00', 8),
(9, 'MED-009', 'Gabriel', 'Castro Reyes', 'm', '1975-04-15', 'gabriel.castro@bookmedik.com', 'Paseo de la Victoria 300, Cd Juárez', '656-234-8901', NULL, 1, '2026-08-20 15:10:00', 9),
(10, 'MED-010', 'Daniela', 'Jiménez Santos', 'f', '1989-10-08', 'daniela.jimenez@bookmedik.com', 'Av. Venustiano Carranza 640, SLP', '444-567-8901', NULL, 1, '2026-08-22 11:00:00', 2),
(11, 'MED-011', 'Javier', 'Morales Delgado', 'm', '1983-08-19', 'javier.morales@bookmedik.com', 'Av. López Mateos 1500, Aguascalientes', '449-345-6712', NULL, 1, '2026-08-25 13:40:00', 1),
(12, 'MED-012', 'Andrea', 'Romero Benítez', 'f', '1987-02-14', 'andrea.romero@bookmedik.com', 'Av. Cuauhtémoc 820, Veracruz', '229-456-7823', NULL, 1, '2026-08-28 09:50:00', 3)
ON DUPLICATE KEY UPDATE name=VALUES(name), lastname=VALUES(lastname), email=VALUES(email), phone=VALUES(phone), category_id=VALUES(category_id);

-- Pacientes Demo (16 registros)
INSERT INTO pacient (id, no, name, lastname, gender, day_of_birth, email, address, phone, image, sick, medicaments, alergy, is_favorite, is_active, created_at) VALUES
(1, 'PAC-001', 'Juan', 'Pérez López', 'm', '1978-04-12', 'juan.perez@gmail.com', 'Colonia Roma Norte, CDMX', '555-901-2345', NULL, 'Hipertensión arterial estadio 1', 'Enalapril 10mg cada 24 hrs', 'Penicilina', 1, 1, '2026-08-10 10:00:00'),
(2, 'PAC-002', 'María Elena', 'Fernández Díaz', 'f', '1983-09-05', 'maria.fernandez@outlook.com', 'Col. Ladrón de Guevara, Guadalajara', '333-112-2334', NULL, 'Diabetes Mellitus tipo 2', 'Metformina 850mg con alimentos', 'Ninguna conocida', 1, 1, '2026-08-11 11:20:00'),
(3, 'PAC-003', 'Jorge', 'Gutiérrez Ramos', 'm', '1995-02-18', 'jorge.gutierrez@yahoo.com', 'Col. Obispado, Monterrey', '811-998-8776', NULL, 'Asma bronquial intermitente', 'Salbutamol en aerosol en caso de crisis', 'AINES (Aspirina)', 0, 1, '2026-08-12 15:30:00'),
(4, 'PAC-004', 'Carmen', 'López Serrano', 'f', '1992-11-30', 'carmen.lopez@gmail.com', 'Barrio de Santiago, Puebla', '222-776-6554', NULL, 'Control prenatal - Embarazo 24 SDG', 'Ácido fólico 5mg, Sulfato ferroso', 'Ninguna', 1, 1, '2026-08-15 09:10:00'),
(5, 'PAC-005', 'Luis Alberto', 'Castro Gil', 'm', '1968-07-24', 'luis.castro@hotmail.com', 'Col. Providencia, Guadalajara', '333-665-5443', NULL, 'Lumbalgia mecánica crónica', 'Paracetamol 500mg, Complejo B', 'Sulfamidas', 0, 1, '2026-08-18 12:45:00'),
(6, 'PAC-006', 'Ana Patricia', 'Ruiz Domínguez', 'f', '2001-03-14', 'ana.ruiz@gmail.com', 'Col. Del Valle, CDMX', '555-334-4556', NULL, 'Rinitis alérgica estacional', 'Loratadina 10mg, Solución salina nasal', 'Polvo y polen de olivo', 1, 1, '2026-08-20 16:00:00'),
(7, 'PAC-007', 'Miguel Ángel', 'Ortiz Santos', 'm', '1986-12-08', 'miguel.ortiz@outlook.com', 'Fracc. Las Américas, Mérida', '999-554-4332', NULL, 'Gastritis antral crónica', 'Omeprazol 20mg en ayunas', 'Ninguna', 0, 1, '2026-08-22 14:15:00'),
(8, 'PAC-008', 'Rosa Elena', 'Martínez Luna', 'f', '1974-06-19', 'rosa.martinez@gmail.com', 'Col. Álamos, Querétaro', '442-332-2110', NULL, 'Caries dental y gingivitis leve', 'Clorhexidina enjuague bucal', 'Ninguna', 0, 1, '2026-08-25 10:30:00'),
(9, 'PAC-009', 'David Santiago', 'Medina Rocha', 'm', '1998-01-27', 'david.medina@gmail.com', 'Col. Cumbres, Monterrey', '818-443-3221', NULL, 'Cefalea tensional recurrente', 'Sumatriptán 50mg, Magnesio', 'Ninguna', 1, 1, '2026-08-28 17:00:00'),
(10, 'PAC-010', 'Lucía', 'Méndez Campos', 'f', '1990-08-15', 'lucia.mendez@yahoo.com', 'Col. Narvarte, CDMX', '555-887-7665', NULL, 'Dermatitis atópica facial', 'Emolientes dermatológicos', 'Ciprofloxacino', 0, 1, '2026-09-01 11:00:00'),
(11, 'PAC-011', 'Pablo Emilio', 'Salazar Cruz', 'm', '1981-10-03', 'pablo.salazar@gmail.com', 'Col. Chapultepec, Guadalajara', '333-778-8990', NULL, 'Chequeo preventivo anual', 'Ninguno habitual', 'Ninguna', 1, 1, '2026-09-05 09:30:00'),
(12, 'PAC-012', 'Teresa', 'Morales Alarcón', 'f', '1965-05-21', 'teresa.morales@hotmail.com', 'Centro Histórico, Morelia', '443-123-4567', NULL, 'Hipotiroidismo primario', 'Levotiroxina sódica 75mcg', 'Ninguna', 0, 1, '2026-09-08 13:15:00'),
(13, 'PAC-013', 'Andrés Felipe', 'Navarro Reyes', 'm', '2005-07-16', 'andres.navarro@gmail.com', 'Col. San Jerónimo, Monterrey', '811-654-3210', NULL, 'Esguince de tobillo derecho grado II', 'Ketorolaco trometamina 10mg', 'Ninguna', 0, 1, '2026-09-12 16:40:00'),
(14, 'PAC-014', 'Gabriela', 'Santos Espinosa', 'f', '2020-04-10', 'gabriela.padres@gmail.com', 'Col. Arboledas, Zapopan', '333-987-1234', NULL, 'Control pediátrico de desarrollo', 'Complejo multivitamínico infantil', 'Ninguna', 1, 1, '2026-09-15 10:15:00'),
(15, 'PAC-015', 'José Manuel', 'Cruz Valdés', 'm', '1984-03-29', 'jose.cruz@gmail.com', 'Col. Condesa, CDMX', '555-667-7889', NULL, 'Miopía progresiva y astenopía', 'Carboximetilcelulosa gotas oftálmicas', 'Ninguna', 0, 1, '2026-09-20 12:00:00'),
(16, 'PAC-016', 'Valentina', 'Vega Solís', 'f', '1999-12-14', 'valentina.vega@outlook.com', 'Col. Juriquilla, Querétaro', '442-556-6778', NULL, 'Alergia alimentaria recurrente', 'Cetirizina 10mg', 'Mariscos y nueces', 1, 1, '2026-09-25 15:00:00')
ON DUPLICATE KEY UPDATE name=VALUES(name), lastname=VALUES(lastname), email=VALUES(email), phone=VALUES(phone), sick=VALUES(sick), medicaments=VALUES(medicaments);

-- Citas Médicas / Reservaciones Demo (26 registros distribuidos en pasado, presente y futuro)
-- Nota: CURDATE() en el servidor es 2026-10-02
-- Status: 1=Pendiente, 2=Aplicada, 3=No asistio, 4=Cancelada
-- Payment: 1=Pendiente, 2=Pagado, 3=Anulado
INSERT INTO reservation (id, title, note, message, date_at, time_at, created_at, pacient_id, symtoms, sick, medicaments, user_id, medic_id, price, is_web, payment_id, status_id) VALUES
-- Citas Pasadas (Aplicadas / Concluidas y No asistió)
(1, 'Chequeo General Preventivo', 'Paciente asiste puntualmente a valoración semestral', 'Estudios de laboratorio en rangos normales', '2026-09-15', '09:00', '2026-09-10 11:00:00', 11, 'Ninguno', 'Chequeo general preventivo', 'Dieta balanceada y ejercicio regular', 1, 1, 500.00, 0, 2, 2),
(2, 'Consulta de Cardiología', 'Revisión de cifras tensionales y electrocardiograma', 'ECG con ritmo sinusal sin alteraciones isquémicas', '2026-09-16', '10:30', '2026-09-11 14:20:00', 1, 'Cefalea matutina leve y mareo esporádico', 'Hipertensión arterial estadio 1', 'Continuar Enalapril 10mg cada 24 horas', 1, 3, 900.00, 0, 2, 2),
(3, 'Control Pediátrico Infantil', 'Control de niño sano, peso 18.5kg, talla 110cm', 'Vacunación al corriente', '2026-09-18', '11:00', '2026-09-12 16:10:00', 14, 'Ninguno reportado', 'Control del desarrollo psicomotriz', 'Vitamina C y D infantil', 1, 2, 600.00, 0, 2, 2),
(4, 'Revisión Dermatológica', 'Evaluación de lesiones eccematosas en rostro y brazos', 'Se observa eritema y descamación leve', '2026-09-20', '16:00', '2026-09-15 09:40:00', 10, 'Prurito intenso nocturno y resequedad', 'Dermatitis atópica facial', 'Tacrolimus ungüento 0.03%, jabón syndet', 1, 4, 750.00, 0, 2, 2),
(5, 'Evaluación Traumatológica', 'Revaloración de esguince de tobillo derecho', 'Mejoría franca del edema, movilidad 80%', '2026-09-22', '15:30', '2026-09-16 10:00:00', 13, 'Dolor al apoyo plantar moderado', 'Esguince de tobillo derecho grado II', 'Fisioterapia 10 sesiones y tobillera de soporte', 1, 6, 850.00, 0, 2, 2),
(6, 'Control de Diabetes', 'Revisión de hemoglobina glucosilada HbA1c (6.8%)', 'Buen apego al tratamiento farmacológico', '2026-09-24', '10:00', '2026-09-18 12:30:00', 2, 'Poliuria ocasional', 'Diabetes Mellitus tipo 2', 'Metformina 850mg tabletas dos veces al día', 1, 1, 550.00, 0, 2, 2),
(7, 'Examen de la Vista y Graduación', 'Paciente refiere fatiga ocular frente a pantallas', 'Se detecta miopía -1.50 OD y -1.75 OI', '2026-09-25', '12:00', '2026-09-19 13:00:00', 15, 'Visión borrosa lejana y cansancio visual', 'Astenopía acomodativa y miopía', 'Lentes con filtro antireflejante y luz azul', 1, 7, 500.00, 0, 2, 2),
(8, 'Limpieza y Profilaxis Dental', 'Limpieza profunda por ultrasonido realizada', 'No se observan nuevas cavidades cariosas', '2026-09-26', '11:30', '2026-09-20 15:45:00', 8, 'Sensibilidad dental al frío', 'Gingivitis leve tratada', 'Pasta dental desensibilizante y cepillado suave', 1, 8, 650.00, 0, 2, 2),
(9, 'Consulta Neurológica', 'Seguimiento de cefaleas pulsátiles hemicraneales', 'Se solicita diario de cefaleas y RMN cerebral', '2026-09-28', '17:00', '2026-09-21 17:15:00', 9, 'Dolor punzante lado izquierdo con fotofobia', 'Migraña común recurrente', 'Sumatriptán 50mg SOS, Topiramato 25mg noche', 1, 9, 1200.00, 0, 2, 2),
(10, 'Control Prenatal Trimestral', 'Paciente no asistió a su cita programada', 'Se intentó contacto telefónico sin éxito', '2026-09-29', '09:30', '2026-09-22 09:00:00', 4, 'Ninguno', 'Control prenatal 24 SDG', 'Reagendar cita a la brevedad', 1, 5, 700.00, 0, 1, 3),
(11, 'Evaluación Lumbar', 'Cita cancelada con previo aviso por el paciente', 'Solicita reagendar para el siguiente mes', '2026-09-30', '13:00', '2026-09-23 10:15:00', 5, 'Dolor lumbar mecánico', 'Lumbalgia mecánica', 'Reposo y analgésicos', 1, 6, 800.00, 0, 3, 4),

-- Citas de Hoy (2026-10-02)
(12, 'Revisión Endocrinológica', 'Control de niveles de TSH y perfil tiroideo', 'TSH en 2.4 mUI/L, dentro de metas terapéuticas', '2026-10-02', '09:00', '2026-09-25 11:20:00', 12, 'Fatiga leve y piel seca', 'Hipotiroidismo primario', 'Levotiroxina sódica 75mcg en ayunas diario', 1, 11, 750.00, 0, 2, 2),
(13, 'Alergología y Pruebas Cutáneas', 'Cita de seguimiento para evaluar respuesta al tratamiento', 'Pendiente de atención', '2026-10-02', '11:00', '2026-09-26 14:00:00', 16, 'Estornudos en salva y prurito ocular', 'Rinitis alérgica persistente', 'Cetirizina 10mg y spray nasal mometasona', 1, 10, 800.00, 0, 1, 1),
(14, 'Consulta General por Síndrome Febril', 'Paciente acude por malestar general y dolor faríngeo', 'Pendiente de consulta vespertina', '2026-10-02', '14:30', '2026-10-01 08:30:00', 7, 'Odinofagia, fiebre de 38.2°C y mialgias', 'Faringoamigdalitis aguda probable', 'Por determinar en consulta', 1, 1, 500.00, 0, 1, 1),
(15, 'Ecocardiograma Transtorácico', 'Estudio diagnóstico por soplo cardiaco detectado', 'Programada en sala de cardiología', '2026-10-02', '16:00', '2026-09-28 10:45:00', 3, 'Disnea de medianos esfuerzos ocasional', 'Sospecha de valvulopatía', 'Por definir posterior a ecografía', 1, 12, 1400.00, 0, 2, 1),

-- Citas Futuras / Próximas (Octubre 2026)
(16, 'Ultrasonido Obstétrico Estructural', 'Ultrasonido del segundo trimestre 25 semanas', 'Cita confirmada por recepcionista', '2026-10-03', '10:00', '2026-09-29 11:00:00', 4, 'Movimientos fetales normales percibidos', 'Embarazo normoevolutivo 25 SDG', 'Multivitamínico con DHA prenatal', 1, 5, 950.00, 0, 1, 1),
(17, 'Consulta Neumológica por Asma', 'Prueba de espirometría forzada pre y post broncodilatador', 'Se solicita no suspender medicación matutina', '2026-10-05', '11:30', '2026-09-30 12:15:00', 3, 'Sibilancias nocturnas y tos seca', 'Asma bronquial en control', 'Budesonida/Formoterol polvo seco', 1, 11, 850.00, 0, 1, 1),
(18, 'Revisión Dermatológica por Lunares', 'Dermatoscopia digital de nevus displásicos sospechosos', 'Cita agendada para mapeo de lunares', '2026-10-06', '15:00', '2026-09-30 16:30:00', 6, 'Aparición de nuevo lunar en espalda baja', 'Nevus melanocíticos múltiples', 'Protector solar FPS 50+ cada 4 horas', 1, 4, 750.00, 0, 1, 1),
(19, 'Revisión y Ajuste de Ortopedia', 'Control de columna lumbar y ejercicios Williams', 'Paciente refiere disminución del dolor en un 60%', '2026-10-08', '09:30', '2026-10-01 10:00:00', 5, 'Rigidez matutina en zona lumbar baja', 'Lumbalgia crónica postural', 'Higiene de columna y natación recomendada', 1, 6, 800.00, 0, 1, 1),
(20, 'Profilaxis y Curación Dental', 'Obturación con resina fotocurable en pieza 16 y 26', 'Tratamiento estético y funcional', '2026-10-10', '12:00', '2026-10-01 11:30:00', 8, 'Sensibilidad moderada a alimentos dulces', 'Caries oclusal incipiente', 'Selladores dentales en piezas premolares', 1, 8, 900.00, 0, 1, 1),
(21, 'Control Pediátrico de Vacunas', 'Aplicación de refuerzo vacunal según esquema nacional', 'Cita con la pediatra Dra. Sofía Mendoza', '2026-10-12', '10:30', '2026-10-01 13:00:00', 14, 'Ninguno', 'Seguimiento de cartilla nacional de salud', 'Paracetamol gotas en caso de febrícula', 1, 2, 600.00, 0, 1, 1),
(22, 'Chequeo Cardiológico de Esfuerzo', 'Prueba de esfuerzo en banda ergométrica', 'Instrucciones: ropa deportiva y ayuno ligero', '2026-10-14', '08:30', '2026-10-01 15:00:00', 1, 'Pesadez precordial en ejercicio extenuante', 'Hipertensión arterial / Descarte coronariopatía', 'Suspender betabloqueadores 24h previas', 1, 3, 1500.00, 0, 2, 1),
(23, 'Consulta de Fondo de Ojo', 'Retinografía y examen macular con lámpara de hendidura', 'Paciente acudirá con acompañante por dilatación pupilar', '2026-10-15', '16:30', '2026-10-01 16:15:00', 2, 'Visión de destellos luminosos ocasionales', 'Retinopatía diabética no proliferativa descarte', 'Gotas tropicamina midriáticas para estudio', 1, 7, 700.00, 0, 1, 1),
(24, 'Control Médico y Curación de Gastritis', 'Endoscopia digestiva alta programada', 'Ayuno estricto de 8 horas previas', '2026-10-18', '09:00', '2026-10-01 17:00:00', 7, 'Epigastralgia ardorosa y pirosis posprandial', 'Gastritis erosiva antral y reflujo gastroesofágico', 'Esomeprazol 40mg, Sucralfato suspensión', 1, 1, 600.00, 0, 1, 1),
(25, 'Electroencefalograma y Valoración', 'Estudio ambulatorio para descartar foco epileptógeno', 'Programada en gabinete neurológico', '2026-10-20', '11:00', '2026-10-02 08:00:00', 9, 'Episodios de mareo intenso y visión en túnel', 'Cefalea vascular compleja', 'Por pautar tras reporte del trazado EEG', 1, 9, 1300.00, 0, 1, 1),
(26, 'Consulta Pediátrica Respiratoria', 'Valoración de cuadro gripal con tos persistente', 'Cita agendada para el fin de semana', '2026-10-24', '10:00', '2026-10-02 08:30:00', 14, 'Rinorrea hialina y tos nocturna seca', 'Rinofaringitis aguda viral probable', 'Aseo nasal y antipirético si hay fiebre', 1, 10, 600.00, 0, 1, 1),
(27, 'Consulta Inicial de Control', 'Primera valoración', 'Apto', '2026-07-10', '10:00', '2026-07-05 09:00:00', 1, 'Ninguno', 'Chequeo', 'Ninguno', 1, 1, 500.00, 0, 2, 2),
(28, 'Control Pediátrico Anual', 'Control niño', 'Bien', '2026-07-22', '11:00', '2026-07-15 10:00:00', 14, 'Ninguno', 'Sano', 'Vitaminas', 1, 2, 600.00, 0, 2, 2),
(29, 'Valoración Cardíaca', 'Chequeo ECG', 'Normal', '2026-08-05', '09:30', '2026-08-01 11:00:00', 3, 'Fatiga', 'Arritmia leve', 'Aspirina protect', 1, 3, 900.00, 0, 2, 2),
(30, 'Consulta Dermatología', 'Acné juvenil', 'Mejoría', '2026-08-14', '16:00', '2026-08-10 14:00:00', 6, 'Lesiones pápulas', 'Acné inflamatorio', 'Peróxido de benzoilo', 1, 4, 750.00, 0, 2, 2),
(31, 'Consulta Traumatología', 'Dolor rodilla', 'Radiografía normal', '2026-08-20', '12:00', '2026-08-15 08:30:00', 13, 'Gonalgia post esfuerzo', 'Tendinitis rotuliana', 'Hielo y fisioterapia', 1, 6, 850.00, 0, 2, 2),
(32, 'Control Dental Preventivo', 'Limpieza dental', 'Sin caries', '2026-08-28', '11:00', '2026-08-22 10:00:00', 8, 'Hipersensibilidad', 'Sensibilidad dental', 'Pasta con flúor', 1, 8, 650.00, 0, 2, 2)
ON DUPLICATE KEY UPDATE title=VALUES(title), date_at=VALUES(date_at), time_at=VALUES(time_at), pacient_id=VALUES(pacient_id), medic_id=VALUES(medic_id), price=VALUES(price), status_id=VALUES(status_id), payment_id=VALUES(payment_id);
