-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2020 a las 06:06:28
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_mesapartes7`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE PROCEDURE `PA_BUSCARDOCUMENTO_EXTERNO` (IN `NRO_DOCUMENTO` VARCHAR(15), IN `ANIO` VARCHAR(5))  BEGIN
SELECT
documento.documento_id,
IFNULL(UPPER(documento.doc_dniremitente),''),
IFNULL(UPPER(documento.doc_nombreremitente),''),
IFNULL(UPPER(documento.doc_apepatremitente),''),
IFNULL(UPPER(documento.doc_apematremitente),''),
IFNULL(UPPER(documento.doc_celularremitente),''),
IFNULL(UPPER(documento.doc_emailremitente),''),
IFNULL(UPPER(documento.doc_direccionremitente),''),
IFNULL(UPPER(documento.doc_representacion),''),
IFNULL(UPPER(documento.doc_ruc),''),
IFNULL(UPPER(documento.doc_empresa),''),
IFNULL(UPPER(documento.tipodocumento_id),''),
IFNULL(UPPER(documento.doc_nrodocumento),''),
IFNULL(UPPER(documento.doc_folio),''),
IFNULL(UPPER(documento.doc_asunto),''),
IFNULL(UPPER(documento.doc_archivo),''),
IFNULL(UPPER(tipo_documento.tipodo_descripcion),''),
DATE_FORMAT(documento.doc_fecharegistro,'%Y'),
CONCAT(DATE_FORMAT(documento.doc_fecharegistro,'%d '),ELT(MONTH(documento.doc_fecharegistro), "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"),DATE_FORMAT(documento.doc_fecharegistro,' %Y')),
CONCAT(DATE_FORMAT(documento.doc_fecharegistro,'%d '),ELT(MONTH(documento.doc_fecharegistro), "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"),DATE_FORMAT(documento.doc_fecharegistro,' del %Y')),
DATE_FORMAT(documento.doc_fecharegistro,'%H : %i'),
documento.area_destino,
IFNULL(area.area_nombre,'') area_nombre
FROM
documento
LEFT JOIN tipo_documento ON documento.tipodocumento_id = tipo_documento.tipodocumento_id
LEFT JOIN area ON documento.area_destino = area.area_cod
WHERE documento.documento_id = NRO_DOCUMENTO and DATE_FORMAT(documento.doc_fecharegistro,'%Y') = ANIO;
END$$

CREATE PROCEDURE `PA_BUSCARDOCUMENTO_SEGUIMIENTO` (IN `ID_DOCUMENTO` VARCHAR(12))  BEGIN
SELECT
movimiento.movimiento_id,
IFNULL(UPPER(movimiento.area_origen_id),'') AS idarea_origen,
IFNULL(UPPER(movimiento.areadestino_id),'') AS idarea_destino,
DATE_FORMAT(movimiento.mov_fecharegistro,'%Y'),
CONCAT(DATE_FORMAT(movimiento.mov_fecharegistro,'%d '),ELT(MONTH(movimiento.mov_fecharegistro), "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"),DATE_FORMAT(movimiento.mov_fecharegistro,' %Y')),
CONCAT(DATE_FORMAT(movimiento.mov_fecharegistro,'%d '),ELT(MONTH(movimiento.mov_fecharegistro), "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"),DATE_FORMAT(movimiento.mov_fecharegistro,' del %Y')),
DATE_FORMAT(movimiento.mov_fecharegistro,'%H : %i'),
IFNULL(movimiento.mov_descripcion,''),
IFNULL(UPPER(movimiento.mov_estatus),''),
IFNULL(UPPER(origen.area_nombre),'') AS area_origen,
IFNULL(UPPER(destino.area_nombre),'') AS area_destino,
IFNULL(UPPER(usuario.usu_usuario),'') AS usuario,
movimiento.documento_id
FROM
movimiento
LEFT JOIN area AS origen ON movimiento.area_origen_id = origen.area_cod
LEFT JOIN area AS destino ON movimiento.areadestino_id = destino.area_cod
LEFT JOIN usuario ON movimiento.usuario_id = usuario.usu_id

WHERE movimiento.documento_id = ID_DOCUMENTO AND movimiento.tipo !=1 
AND (movimiento.mov_estatus != 'ACEPTADO' OR movimiento.mov_estatus != 'RECHAZADO');
END$$

CREATE PROCEDURE `PA_BUSCARDOCUMENTO_SEGUIMIENTO_ACCION` (IN `ID_MOVIMIENTO` INT)  BEGIN
SELECT
movimiento_accion.movimientoaccion_id,
movimiento_accion.movimiento_id,
movimiento_accion.moviac_descripcion,
movimiento_accion.moviac_estatus,
DATE_FORMAT(movimiento_accion.moviac_fecharegistro,'%Y'),
CONCAT(DATE_FORMAT(movimiento_accion.moviac_fecharegistro,'%d '),ELT(MONTH(movimiento_accion.moviac_fecharegistro), "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"),DATE_FORMAT(movimiento_accion.moviac_fecharegistro,' %Y')),
CONCAT(DATE_FORMAT(movimiento_accion.moviac_fecharegistro,'%d '),ELT(MONTH(movimiento_accion.moviac_fecharegistro), "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"),DATE_FORMAT(movimiento_accion.moviac_fecharegistro,' del %Y')),

DATE_FORMAT(movimiento_accion.moviac_fecharegistro,'%H : %i'),
area.area_nombre
FROM
movimiento_accion
INNER JOIN movimiento ON movimiento_accion.movimiento_id = movimiento.movimiento_id
INNER JOIN area ON movimiento.areadestino_id = area.area_cod
WHERE 
movimiento_accion.moviac_estatus != "PENDIENTE" AND
movimiento_accion.movimiento_id = ID_MOVIMIENTO;
END$$

CREATE PROCEDURE `PA_BUSCARDOCUMENTO_SEGUIMIENTO_NUEVO` (IN `BUSCAR` VARCHAR(20))  BEGIN
SELECT t.area_nombre,t.descripcion,t.anio,t.fecha_mini,t.fecha_comp,t.hora,t.accion,t.fecha,t.estado FROM (
SELECT
area.area_nombre,
movimiento.mov_descripcion as descripcion,
movimiento.mov_estatus as estado,
DATE_FORMAT(movimiento.mov_fecharegistro,'%Y') anio,
CONCAT(DATE_FORMAT(movimiento.mov_fecharegistro,'%d '),ELT(MONTH(movimiento.mov_fecharegistro), "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"),DATE_FORMAT(movimiento.mov_fecharegistro,' %Y')) fecha_mini,
CONCAT(DATE_FORMAT(movimiento.mov_fecharegistro,'%d '),ELT(MONTH(movimiento.mov_fecharegistro), "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"),DATE_FORMAT(movimiento.mov_fecharegistro,' del %Y')) fecha_comp,
DATE_FORMAT(movimiento.mov_fecharegistro,'%H : %i') hora,
'DERIVADO' as accion,
movimiento.mov_fecharegistro as fecha
FROM
movimiento
INNER JOIN area ON movimiento.areadestino_id = area.area_cod
where movimiento.documento_id = BUSCAR
union ALL
SELECT
area.area_nombre,
movimiento_accion.moviac_descripcion  as descripcion,
movimiento_accion.moviac_estatus  as estado,
DATE_FORMAT(movimiento_accion.moviac_fecharegistro,'%Y') AS anio,
CONCAT(DATE_FORMAT(movimiento_accion.moviac_fecharegistro,'%d '),ELT(MONTH(movimiento_accion.moviac_fecharegistro), "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"),DATE_FORMAT(movimiento_accion.moviac_fecharegistro,' %Y')) AS fecha_mini,
CONCAT(DATE_FORMAT(movimiento_accion.moviac_fecharegistro,'%d '),ELT(MONTH(movimiento_accion.moviac_fecharegistro), "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"),DATE_FORMAT(movimiento_accion.moviac_fecharegistro,' del %Y')) AS fecha_comp,
DATE_FORMAT(movimiento_accion.moviac_fecharegistro,'%H : %i') AS hora,
'ACCION' AS accion,
movimiento_accion.moviac_fecharegistro as fecha
FROM
movimiento_accion
INNER JOIN movimiento ON movimiento_accion.movimiento_id = movimiento.movimiento_id
INNER JOIN area ON movimiento.areadestino_id = area.area_cod
WHERE movimiento.documento_id = BUSCAR
) t 
ORDER BY t.fecha;
END$$

CREATE PROCEDURE `PA_COMBOAREA` ()  SELECT
area.area_cod,
UPPER(area.area_nombre) area_nombre,
area.area_fecha_registro,
area.area_estado
FROM
area WHERE area.area_estado = 'ACTIVO'$$

CREATE PROCEDURE `PA_COMBOAREA_DERIVAR` (IN `area_id` INT)  BEGIN
SELECT
area.area_cod,
UPPER(area.area_nombre) area_nombre,
area.area_fecha_registro,
area.area_estado
FROM
area
WHERE area.area_cod != area_id AND area.area_estado = 'ACTIVO';
END$$

CREATE PROCEDURE `PA_COMBOEMPLEADO` ()  SELECT
empleado.empleado_id,
UPPER(CONCAT_WS(' ',empleado.emple_nombre,
empleado.emple_apepat,
empleado.emple_apemat)) empleado
FROM
empleado

WHERE empleado.emple_estatus = 'ACTIVO'$$

CREATE PROCEDURE `PA_COMBOTIPODOCUMENTO` ()  SELECT
tipo_documento.tipodocumento_id,
upper(tipo_documento.tipodo_descripcion)tipodo_descripcion,
tipo_documento.tipodo_estado
FROM
tipo_documento
WHERE tipo_documento.tipodo_estado = 'ACTIVO'$$

CREATE PROCEDURE `PA_DASHBOARD_ADMINISTRADOR` ()  SELECT
(SELECT COUNT(*) FROM documento where doc_estatus='PENDIENTE'),
(SELECT COUNT(*) FROM documento where doc_estatus='RECHAZADO'),
(SELECT COUNT(*) FROM documento where doc_estatus='FINALIZADO')
FROM
documento
limit 1$$

CREATE PROCEDURE `PA_DASHBOARD_ADMINISTRADOR_AREA` (IN `IDAREA` INT)  SELECT
(SELECT COUNT(*) FROM documento where doc_estatus='PENDIENTE'  and area_id=IDAREA),
(SELECT COUNT(*) FROM documento where doc_estatus='RECHAZADO' and area_id=IDAREA),
(SELECT COUNT(*) FROM documento where doc_estatus='FINALIZADO' and area_id=IDAREA)
FROM
documento
limit 1$$

CREATE PROCEDURE `PA_EDITARCLAVE` (IN `idusuario` INT, IN `clave` VARCHAR(255))  BEGIN
UPDATE usuario SET
usuario.usu_contra = clave
WHERE usuario.usu_id = idusuario;
END$$

CREATE PROCEDURE `PA_EDITARCUENTA` (IN `usuario` VARCHAR(50), IN `actual` VARCHAR(250), IN `nueva` VARCHAR(250))  BEGIN
UPDATE usuario SET
usuario.usu_contra= nueva
WHERE usuario.usu_usuario = BINARY usuario and usuario.usu_contra = BINARY actual;
END$$

CREATE PROCEDURE `PA_EDITARFOTO` (IN `idtrabajador` INT, IN `archivo` VARCHAR(255))  UPDATE empleado SET
empl_fotoperfil = archivo
WHERE empleado_id = idtrabajador$$

CREATE PROCEDURE `PA_EDITAR_EMPLEADO` (IN `ID` INT, IN `NRODOCUMENTO` VARCHAR(11), IN `NOMBRE` VARCHAR(150), IN `APEPAT` VARCHAR(100), IN `APEMAT` VARCHAR(100), IN `FECHANACIMIENTO` VARCHAR(20), IN `CELULAR` CHAR(9), IN `EMAIL` VARCHAR(250), IN `DIRECCION` VARCHAR(255), IN `ESTADO` VARCHAR(20))  BEGIN
DECLARE idtrabajador INT;
set @idtrabajador:=(select ifnull(empleado.empleado_id,0) FROM empleado where emple_nrodocumento=NRODOCUMENTO);
IF (ID = @idtrabajador) THEN
	UPDATE empleado SET
		emple_nombre = NOMBRE,
		emple_apepat = APEPAT,
		emple_apemat = APEMAT,
		emple_email  = EMAIL,
		emple_fechanacimiento = FECHANACIMIENTO,
		emple_nrodocumento = NRODOCUMENTO,
		emple_movil = CELULAR,
		emple_direccion = DIRECCION,
		emple_estatus = ESTADO
	WHERE empleado_id = ID;
	SELECT 1;
ELSE
set @idtrabajador:=(select COUNT(*) FROM empleado where emple_nrodocumento=NRODOCUMENTO);
	IF @idtrabajador = 0 THEN
		UPDATE empleado SET
			emple_nombre = NOMBRE,
			emple_apepat = APEPAT,
			emple_apemat = APEMAT,
			emple_email  = EMAIL,
			emple_fechanacimiento = FECHANACIMIENTO,
			emple_nrodocumento = NRODOCUMENTO,
			emple_movil = CELULAR,
			emple_direccion = DIRECCION,
			emple_estatus = ESTADO
		WHERE empleado_id = ID;
		SELECT 1;
	ELSE
		SELECT 2;
	END IF;
END IF;
END$$

CREATE PROCEDURE `PA_EDITAR_USUARIO` (IN `id_usuario` INT, IN `cmb_area` INT)  BEGIN
UPDATE usuario SET
area_id = cmb_area
WHERE usu_id = id_usuario;
END$$

CREATE PROCEDURE `PA_LISTARAREA_USUARIO` (IN `id` INT)  SELECT
area.area_cod,
UPPER(area.area_nombre) area_nombre,
area.area_fecha_registro,
area.area_estado
FROM
area
WHERE area.area_estado = 'ACTIVO' AND area.area_cod != id$$

CREATE PROCEDURE `PA_LISTAR_AREA` ()  SELECT
area.area_cod,
area.area_nombre,
DATE(area.area_fecha_registro) as area_fecha_registro,
area.area_estado
FROM
area$$

CREATE PROCEDURE `PA_LISTAR_DOCUMENTOS_ADMIN` (IN `id_area` VARCHAR(11), IN `estado` VARCHAR(20))  SELECT
documento.documento_id,
documento.doc_dniremitente,
UPPER(CONCAT_WS(' ',documento.doc_nombreremitente,documento.doc_apepatremitente,documento.doc_apematremitente)) AS empleado,
documento.doc_celularremitente,
documento.doc_emailremitente,
documento.doc_direccionremitente,
documento.doc_representacion,
documento.doc_ruc,
documento.doc_empresa,
documento.doc_nrodocumento,
documento.doc_folio,
documento.doc_asunto,
documento.doc_archivo,
DATE_FORMAT(documento.doc_fecharegistro,'%d/%m/%Y') AS doc_fecharegistro,
documento.area_id,
area.area_nombre,
UPPER(tipo_documento.tipodo_descripcion) tipodo_descripcion,
documento.doc_estatus,
IFNULL(origen.area_nombre,'EXTERIOR') as origen_nombre,
origen2.area_nombre as origen_nombre2,
movimiento.movimiento_id,
documento.tipodocumento_id
FROM
documento
INNER JOIN area ON area.area_cod = documento.area_id
INNER JOIN tipo_documento ON documento.tipodocumento_id = tipo_documento.tipodocumento_id
LEFT JOIN area AS origen ON origen.area_cod = documento.area_origen
INNER JOIN movimiento ON  movimiento.documento_id = documento.documento_id
INNER JOIN area AS origen2 ON movimiento.area_origen_id = origen2.area_cod

WHERE documento.area_origen LIKE id_area AND documento.doc_estatus LIKE estado
GROUP BY documento.documento_id
ORDER BY documento.doc_fecharegistro$$

CREATE PROCEDURE `PA_LISTAR_DOCUMENTOS_SECRE` (IN `id_area` VARCHAR(11), IN `estado` VARCHAR(20))  SELECT
documento.documento_id,
documento.doc_dniremitente,
UPPER(CONCAT_WS(' ',documento.doc_nombreremitente,documento.doc_apepatremitente,documento.doc_apematremitente)) AS empleado,
documento.doc_celularremitente,
documento.doc_emailremitente,
documento.doc_direccionremitente,
documento.doc_representacion,
documento.doc_ruc,
documento.doc_empresa,
documento.doc_nrodocumento,
documento.doc_folio,
documento.doc_asunto,
documento.doc_archivo,
DATE_FORMAT(documento.doc_fecharegistro,'%d/%m/%Y') AS doc_fecharegistro,
documento.area_id,
area.area_nombre,
UPPER(tipo_documento.tipodo_descripcion)tipodo_descripcion,
documento.doc_estatus,
IFNULL(origen.area_nombre,'EXTERIOR') as origen_nombre,
origen2.area_nombre as origen_nombre2,
movimiento.mov_estatus,
TIMESTAMPDIFF(DAY, DATE_FORMAT(movimiento.mov_fecharegistro,'%Y-%m-%d'), CURDATE()) cant_dias,
movimiento.areadestino_id,
movimiento.movimiento_id,
documento.tipodocumento_id
FROM
documento
INNER JOIN area ON area.area_cod = documento.area_id
INNER JOIN tipo_documento ON documento.tipodocumento_id = tipo_documento.tipodocumento_id
LEFT JOIN area AS origen ON origen.area_cod = documento.area_origen
INNER JOIN movimiento ON  movimiento.documento_id = documento.documento_id
INNER JOIN area AS origen2 ON movimiento.area_origen_id = origen2.area_cod

WHERE movimiento.areadestino_id LIKE id_area AND movimiento.mov_estatus LIKE estado
GROUP BY documento.documento_id
ORDER BY documento.doc_fecharegistro$$

CREATE PROCEDURE `PA_LISTAR_DOCUMENTOS_SEGUIMIENTO` (IN `ID` VARCHAR(12))  SELECT
DATE_FORMAT(movimiento.mov_fecharegistro,'%d/%m/%Y') AS fecharegistro,
movimiento.mov_descripcion,
movimiento.documento_id,
area.area_nombre,
IFNULL(movimiento.mov_archivo,'') mov_archivo,
movimiento.mov_descripcion_original
FROM
movimiento
LEFT JOIN area ON  movimiento.areadestino_id = area.area_cod
WHERE
movimiento.documento_id = ID
ORDER BY 
movimiento.mov_fecharegistro$$

CREATE PROCEDURE `PA_LISTAR_EMPLEADO` ()  SELECT
empleado.empleado_id,
CONCAT_WS(' ',emple_nombre,emple_apepat,emple_apemat) as empleado,
empleado.emple_nombre,
empleado.emple_apepat,
empleado.emple_apemat,
empleado.emple_feccreacion,
empleado.emple_fechanacimiento,
DATE_FORMAT(emple_fechanacimiento,'%d/%m/%Y') AS fnacimiento, 
empleado.emple_nrodocumento,
empleado.emple_movil,
empleado.emple_email,
empleado.emple_estatus,
empleado.emple_direccion
FROM
empleado$$

CREATE PROCEDURE `PA_LISTAR_TIPODOCUMENTO` ()  SELECT
tipo_documento.tipodocumento_id,
tipo_documento.tipodo_descripcion,
tipo_documento.tipodo_estado
FROM
tipo_documento$$

CREATE PROCEDURE `PA_LISTAR_USUARIO` ()  SELECT
usuario.usu_id,
usuario.usu_usuario,
UPPER(empleado.emple_nombre) emple_nombre,
UPPER(empleado.emple_apepat) emple_apepat,
UPPER(empleado.emple_apemat) emple_apemat,
UPPER(CONCAT_WS(' ',empleado.emple_nombre,empleado.emple_apepat,empleado.emple_apemat)) empleado,
IFNULL(area.area_nombre,'NO DEFINIDO')area_nombre,
UPPER(usuario.usu_rol)usu_rol,
usuario.usu_estatus,
area.area_cod
FROM
usuario
INNER JOIN empleado ON usuario.empleado_id = empleado.empleado_id
LEFT JOIN area ON usuario.area_id = area.area_cod$$

CREATE PROCEDURE `PA_MODIFICAR_AREA` (IN `IDAREA` INT, IN `NOMBRE` VARCHAR(50), IN `ESTATUS` VARCHAR(10))  BEGIN
DECLARE NOMBREACTUAL VARCHAR(50);
DECLARE CANTIDAD INT;
SET @NOMBREACTUAL:=(SELECT area_nombre FROM area where area_cod=IDAREA);
SET @CANTIDAD:=(SELECT COUNT(*) FROM area where area_nombre=NOMBRE);
IF @NOMBREACTUAL = NOMBRE THEN
	UPDATE area set
	area_estado=ESTATUS
	where area_cod=IDAREA;
	SELECT 1;
ELSE
	if @CANTIDAD = 0 THEN 
		UPDATE area set
		area_nombre=NOMBRE,
		area_estado=ESTATUS
		where area_cod=IDAREA;
		SELECT 1;
	ELSE
		SELECT 2;
	END if;

END IF;
END$$

CREATE PROCEDURE `PA_MODIFICAR_ESTATUS_USUARIO` (IN `IDUSUARIO` INT, IN `ESTATUS` VARCHAR(10))  update usuario set usu_estatus=ESTATUS
where usu_id=IDUSUARIO$$

CREATE PROCEDURE `PA_MODIFICAR_TIPODOCUMENTO` (IN `IDTIPODOCUMENTO` INT, IN `NOMBRE` VARCHAR(50), IN `ESTATUS` VARCHAR(10))  BEGIN
DECLARE NOMBREACTUAL VARCHAR(50);
DECLARE CANTIDAD INT;
SET @NOMBREACTUAL:=(SELECT tipodo_descripcion FROM tipo_documento where tipodocumento_id=IDTIPODOCUMENTO);
SET @CANTIDAD:=(SELECT COUNT(*) FROM tipo_documento where tipodo_descripcion=NOMBRE);
IF @NOMBREACTUAL = NOMBRE THEN
	UPDATE tipo_documento set
	tipodo_estado=ESTATUS
	where tipodocumento_id=IDTIPODOCUMENTO;
	SELECT 1;
ELSE
	if @CANTIDAD = 0 THEN 
		UPDATE tipo_documento set
		tipodo_descripcion=NOMBRE,
		tipodo_estado=ESTATUS
		where tipodocumento_id=IDTIPODOCUMENTO;
		SELECT 1;
	ELSE
		SELECT 2;
	END if;

END IF;
END$$

CREATE PROCEDURE `PA_REGISTRAR_ACEPTAR_RECHAZAR` (IN `txt_idmovimiento` INT, IN `txt_iddocumento` CHAR(15), IN `txt_asunto` VARCHAR(255), IN `txt_tipo` VARCHAR(50))  BEGIN
SET time_zone = '-5:00';
INSERT INTO movimiento_accion (movimiento_id,moviac_descripcion,moviac_estatus,moviac_fecharegistro) 
                        VALUES (txt_idmovimiento,txt_asunto,txt_tipo,NOW());
END$$

CREATE PROCEDURE `PA_REGISTRAR_ACEPTAR_RECHAZAR2` (IN `txt_idmovimiento` INT, IN `txt_iddocumento` CHAR(15), IN `txt_asunto` VARCHAR(255), IN `txt_tipo` VARCHAR(50))  BEGIN
IF txt_tipo = 'ACEPTAR' THEN
	UPDATE movimiento SET
		movimiento.mov_estatus = 'ACEPTADO'
	WHERE movimiento.movimiento_id = txt_idmovimiento;
ELSE
	UPDATE movimiento SET
		movimiento.mov_estatus = 'RECHAZADO'
	WHERE movimiento.movimiento_id = txt_idmovimiento;
END IF;
END$$

CREATE PROCEDURE `PA_REGISTRAR_AREA` (IN `NOMBRE` VARCHAR(50))  BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM area where area_nombre=NOMBRE);
IF @CANTIDAD=0 THEN
	INSERT INTO area(area_nombre,area_fecha_registro,area_estado) VALUES(NOMBRE,CURRENT_DATE(),'ACTIVO');
	SELECT 1;
ELSE
	SELECT 2;
END IF;

END$$

CREATE PROCEDURE `PA_REGISTRAR_DERIVAR_FINALIZAR` (IN `txt_iddocumento` CHAR(12), IN `txt_idareaactual` INT, IN `txt_idareadestino` INT, IN `txt_descripcion` VARCHAR(255), IN `txt_estado` VARCHAR(20), IN `txt_idusuario` INT, IN `txt_idmovimiento` INT)  BEGIN
SET time_zone = '-5:00';
IF txt_estado = 'DERIVADO' THEN
	INSERT INTO  movimiento (documento_id,   area_origen_id,  areadestino_id,mov_fecharegistro,mov_descripcion,mov_estatus,usuario_id,tipo) 
                   VALUES (txt_iddocumento,txt_idareaactual,txt_idareadestino,NOW(),txt_descripcion,'PENDIENTE',txt_idusuario ,'');
	UPDATE movimiento SET
		movimiento.mov_estatus = txt_estado,
		movimiento.mov_descripcion_original = txt_descripcion
	WHERE movimiento.movimiento_id = txt_idmovimiento;
ELSE
INSERT INTO movimiento_accion (movimiento_id,moviac_descripcion,moviac_estatus,moviac_fecharegistro) 
                        VALUES (txt_idmovimiento,txt_descripcion,'FINALIZADO',NOW());
	UPDATE movimiento SET
		movimiento.mov_estatus = txt_estado,
		movimiento.mov_descripcion_original = txt_descripcion
	WHERE movimiento.movimiento_id = txt_idmovimiento;
END IF;
END$$

CREATE PROCEDURE `PA_REGISTRAR_DERIVAR_FINALIZAR_CON_ARCHIVO` (IN `txt_iddocumento` CHAR(12), IN `txt_idareaactual` INT, IN `txt_idareadestino` INT, IN `txt_descripcion` VARCHAR(255), IN `txt_estado` VARCHAR(20), IN `txt_idusuario` INT, IN `txt_idmovimiento` INT, IN `txt_archivo` VARCHAR(255))  BEGIN
SET time_zone = '-5:00';
IF txt_estado = 'DERIVADO' THEN
	INSERT INTO  movimiento (documento_id,   area_origen_id,  areadestino_id,mov_fecharegistro,mov_descripcion,mov_estatus,usuario_id,tipo) 
                   VALUES (txt_iddocumento,txt_idareaactual,txt_idareadestino,NOW(),txt_descripcion,'PENDIENTE',txt_idusuario ,'');
	UPDATE movimiento SET
		movimiento.mov_estatus = txt_estado,
		movimiento.mov_archivo = txt_archivo,
		movimiento.mov_descripcion_original = txt_descripcion
	WHERE movimiento.movimiento_id = txt_idmovimiento;
ELSE
INSERT INTO movimiento_accion (movimiento_id,moviac_descripcion,moviac_estatus,moviac_fecharegistro) 
                        VALUES (txt_idmovimiento,txt_descripcion,'FINALIZADO',NOW());
	UPDATE movimiento SET
		movimiento.mov_estatus = txt_estado,
		movimiento.mov_descripcion_original = txt_descripcion
	WHERE movimiento.movimiento_id = txt_idmovimiento;
END IF;
END$$

CREATE PROCEDURE `PA_REGISTRAR_DOCUMENTO` (IN `txtdni` CHAR(8), IN `txtnombre` VARCHAR(150), IN `txtapepat` VARCHAR(100), IN `txtapemat` VARCHAR(100), IN `txtcelular` CHAR(9), IN `txtemail` VARCHAR(150), IN `txt_direccion` VARCHAR(255), IN `txt_ruc` CHAR(12), IN `txt_empresa` VARCHAR(255), IN `cmb_tipodocumento` INT, IN `txt_nrodocumentos` VARCHAR(15), IN `txt_folios` INT, IN `txt_asunto` VARCHAR(255), IN `txt_archivo` VARCHAR(255), IN `txt_representacion` VARCHAR(255))  BEGIN
DECLARE nrodocumento INT;
DECLARE cantidad INT;
DECLARE cod CHAR(12);
SET time_zone = '-5:00';
SET @cantidad :=(SELECT count(*) FROM documento );
IF @cantidad >= 1 AND @cantidad <= 8  THEN
SET @cod :=(SELECT CONCAT('D000000',(@cantidad+1)));
ELSEIF @cantidad >=9 AND @cantidad <=98 THEN
SET @cod :=(SELECT CONCAT('D00000',(@cantidad+1)));
ELSEIF @cantidad >=99 AND @cantidad <=998 THEN
SET @cod :=(SELECT CONCAT('D0000',(@cantidad+1)));
ELSEIF @cantidad >=999 AND @cantidad <=9998 THEN
SET @cod :=(SELECT CONCAT('D000',(@cantidad+1)));
ELSEIF @cantidad >=9999 AND @cantidad <=99998 THEN
SET @cod :=(SELECT CONCAT('D00',(@cantidad+1)));
ELSEIF @cantidad >=99999 AND @cantidad <=999998 THEN
SET @cod :=(SELECT CONCAT('D0',(@cantidad+1)));
ELSEIF @cantidad >=999999 THEN
SET @cod :=(SELECT CONCAT('D',(@cantidad+1)));
ELSE
SET @cod :=(SELECT CONCAT('D0000001'));
END IF;
set @nrodocumento:=(select COUNT(*) FROM documento where documento.doc_nrodocumento=txt_nrodocumentos);
IF @nrodocumento = 0 THEN
	INSERT INTO documento (documento_id,doc_dniremitente,doc_nombreremitente,doc_apepatremitente,doc_apematremitente,doc_celularremitente,
												 doc_emailremitente,doc_direccionremitente,doc_representacion,doc_ruc,doc_empresa,
												 tipodocumento_id,doc_nrodocumento,doc_folio,doc_asunto,doc_archivo,area_id,area_destino) 
								 VALUES (@cod,txtdni,txtnombre,txtapepat,txtapemat,txtcelular,
												 txtemail,txt_direccion,txt_representacion,txt_ruc,txt_empresa,
												 cmb_tipodocumento,(@cantidad+1),txt_folios,txt_asunto,txt_archivo,1,1);
	SELECT @cod;
ELSE
	SELECT 2;
END IF;

END$$

CREATE PROCEDURE `PA_REGISTRAR_DOCUMENTO_INTERNO` (IN `txtdni` CHAR(8), IN `txtnombre` VARCHAR(150), IN `txtapepat` VARCHAR(100), IN `txtapemat` VARCHAR(100), IN `txtcelular` CHAR(9), IN `txtemail` VARCHAR(150), IN `txt_direccion` VARCHAR(255), IN `txt_ruc` CHAR(12), IN `txt_empresa` VARCHAR(255), IN `cmb_tipodocumento` INT, IN `txt_nrodocumentos` CHAR(15), IN `txt_folios` INT, IN `txt_asunto` VARCHAR(255), IN `txt_archivo` VARCHAR(255), IN `txt_representacion` VARCHAR(255), IN `cmb_procedenciadocumento` INT, IN `area_destino` INT)  BEGIN
DECLARE nrodocumento INT;
DECLARE cantidad INT;
DECLARE cod CHAR(12);
SET time_zone = '-5:00';
SET @cantidad :=(SELECT count(*) FROM documento );
IF @cantidad >= 1 AND @cantidad <= 8  THEN
SET @cod :=(SELECT CONCAT('D000000',(@cantidad+1)));
ELSEIF @cantidad >=9 AND @cantidad <=98 THEN
SET @cod :=(SELECT CONCAT('D00000',(@cantidad+1)));
ELSEIF @cantidad >=99 AND @cantidad <=998 THEN
SET @cod :=(SELECT CONCAT('D0000',(@cantidad+1)));
ELSEIF @cantidad >=999 AND @cantidad <=9998 THEN
SET @cod :=(SELECT CONCAT('D000',(@cantidad+1)));
ELSEIF @cantidad >=9999 AND @cantidad <=99998 THEN
SET @cod :=(SELECT CONCAT('D00',(@cantidad+1)));
ELSEIF @cantidad >=99999 AND @cantidad <=999998 THEN
SET @cod :=(SELECT CONCAT('D0',(@cantidad+1)));
ELSEIF @cantidad >=999999 THEN
SET @cod :=(SELECT CONCAT('D',(@cantidad+1)));
ELSE
SET @cod :=(SELECT CONCAT('D0000001'));
END IF;
set @nrodocumento:=(select COUNT(*) FROM documento where documento.doc_nrodocumento=txt_nrodocumentos);
IF @nrodocumento = 0 THEN
	INSERT INTO documento (documento_id,doc_dniremitente,doc_nombreremitente,doc_apepatremitente,doc_apematremitente,doc_celularremitente,
												 doc_emailremitente,doc_direccionremitente,doc_representacion,doc_ruc,doc_empresa,
												 tipodocumento_id,doc_nrodocumento,doc_folio,doc_asunto,doc_archivo,area_origen,area_id,area_destino) 
								 VALUES (@cod,txtdni,txtnombre,txtapepat,txtapemat,txtcelular,
												 txtemail,txt_direccion,txt_representacion,txt_ruc,txt_empresa,
												 cmb_tipodocumento,txt_nrodocumentos,txt_folios,txt_asunto,txt_archivo,cmb_procedenciadocumento,area_destino,area_destino);
	SELECT @cod;
ELSE
	SELECT 2;
END IF;

END$$

CREATE PROCEDURE `PA_REGISTRAR_EMPLEADO` (IN `NOMBRE` VARCHAR(150), IN `APEPAT` VARCHAR(100), IN `APEMAT` VARCHAR(100), IN `FECHANACIMIENTO` VARCHAR(20), IN `NRODOCUMENTO` VARCHAR(11), IN `MOVIL` CHAR(9), IN `DIRECCION` VARCHAR(255), IN `EMAIL` VARCHAR(250))  BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) from  empleado where emple_nrodocumento=NRODOCUMENTO);
IF @CANTIDAD = 0 THEN
	INSERT INTO empleado(emple_nombre,emple_apepat,emple_apemat,emple_feccreacion,emple_fechanacimiento,emple_nrodocumento,emple_movil,emple_email,emple_estatus,emple_direccion)
	VALUES(NOMBRE,APEPAT,APEMAT,CURDATE(),FECHANACIMIENTO,NRODOCUMENTO,MOVIL,EMAIL,'ACTIVO',DIRECCION);
	SELECT 1;
ELSE
	SELECT 2;
END IF;
END$$

CREATE PROCEDURE `PA_REGISTRAR_TIPODOCUMENTO` (IN `NOMBRE` VARCHAR(250))  BEGIN
DECLARE CANTIDAD INT;
SET @CANTIDAD:=(SELECT COUNT(*) FROM tipo_documento where tipo_documento.tipodo_descripcion=NOMBRE);
IF @CANTIDAD=0 THEN
	INSERT INTO tipo_documento(tipodo_descripcion,tipodo_estado) VALUES(NOMBRE,'ACTIVO');
	SELECT 1;
ELSE
	SELECT 2;
END IF;

END$$

CREATE PROCEDURE `PA_REGISTRAR_USUARIO` (IN `usuario` VARCHAR(150), IN `clave` VARCHAR(255), IN `empleado` INT, IN `area` INT, IN `rol` VARCHAR(30))  BEGIN
	DECLARE cant_usuario INT;
	DECLARE cant_usuario2 INT;
	SET time_zone = '-5:00';
	set @cant_usuario:=(select count(*) FROM usuario where usuario.empleado_id=empleado AND usuario.area_id=area);
	IF @cant_usuario = 0 THEN
		set @cant_usuario2:=(select count(*) FROM usuario where usuario.usu_usuario = usuario);
		IF @cant_usuario2 = 0 THEN
			INSERT INTO usuario (usu_usuario,usu_contra,usu_feccreacion,empleado_id,usu_estatus,area_id,usu_rol) 
									 VALUES (usuario,clave,CURDATE(),empleado,'ACTIVO',area,rol);
			SELECT 1;
		ELSE
			SELECT 3;
		END IF;
	ELSE
		SELECT 2;
	END IF;
END$$

CREATE PROCEDURE `PA_VERIFICARUSUARIO` (IN `USUARIO` VARCHAR(150))  SELECT
usuario.usu_id,
usuario.usu_usuario,
usuario.usu_contra,
usuario.usu_feccreacion,
usuario.usu_fecupdate,
usuario.empleado_id,
usuario.usu_observacion,
usuario.usu_estatus,
IFNULL(usuario.area_id,'') area_id,
usuario.usu_rol,
UPPER(empleado.emple_nombre) emple_nombre,
UPPER(empleado.emple_apepat) emple_apepat,
UPPER(empleado.emple_apemat) emple_apemat,
empleado.emple_feccreacion,
DATE_FORMAT(empleado.emple_fechanacimiento,'%d/%m/%Y')emple_fechanacimiento ,
empleado.emple_nrodocumento,
empleado.emple_movil,
empleado.emple_email as emple_email,
empleado.emple_estatus,
UPPER(area.area_nombre) area_nombre,
area.area_fecha_registro,
area.area_estado,
UPPER(usuario.usu_usuario) as usuario,
UPPER(empleado.emple_direccion) emple_direccion,
empleado.empl_fotoperfil
FROM
usuario
INNER JOIN empleado ON usuario.empleado_id = empleado.empleado_id
LEFT JOIN area ON usuario.area_id = area.area_cod

WHERE usuario.usu_usuario = BINARY USUARIO$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `area_cod` int(11) NOT NULL COMMENT 'Codigo auto-incrementado del movimiento del area',
  `area_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'nombre del area',
  `area_fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'fecha del registro del movimiento',
  `area_estado` enum('ACTIVO','INACTIVO') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'estado del area'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Entidad Area';

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`area_cod`, `area_nombre`, `area_fecha_registro`, `area_estado`) VALUES
(1, 'MESA DE PARTES', '2018-11-21 07:54:25', 'ACTIVO'),
(2, 'RECURSOS HUMANOS', '2018-11-21 08:41:19', 'ACTIVO'),
(3, 'ADMINISTRATIVA', '2020-06-26 04:00:00', 'ACTIVO'),
(4, 'SECRETARIA ACADEMICA', '2020-06-29 06:09:12', 'ACTIVO'),
(5, 'CONTABILIDAD', '2020-07-05 04:00:00', 'ACTIVO'),
(6, 'INFORMÁTICA', '2020-07-07 04:00:00', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `documento_id` char(12) COLLATE utf8_spanish_ci NOT NULL,
  `doc_dniremitente` char(8) COLLATE utf8_spanish_ci NOT NULL,
  `doc_nombreremitente` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `doc_apepatremitente` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `doc_apematremitente` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `doc_celularremitente` char(9) COLLATE utf8_spanish_ci NOT NULL,
  `doc_emailremitente` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `doc_direccionremitente` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `doc_representacion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `doc_ruc` char(12) COLLATE utf8_spanish_ci NOT NULL,
  `doc_empresa` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `tipodocumento_id` int(11) NOT NULL,
  `doc_nrodocumento` varchar(15) COLLATE utf8_spanish_ci NOT NULL DEFAULT '',
  `doc_folio` int(11) NOT NULL,
  `doc_asunto` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `doc_archivo` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `doc_fecharegistro` datetime DEFAULT current_timestamp(),
  `area_id` int(11) DEFAULT 1,
  `doc_estatus` enum('PENDIENTE','RECHAZADO','FINALIZADO') COLLATE utf8_spanish_ci NOT NULL,
  `area_origen` int(11) NOT NULL DEFAULT 0,
  `area_destino` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Disparadores `documento`
--
DELIMITER $$
CREATE TRIGGER `TRG_REGISTRAR_MOVIMIENTO_INICIAL` AFTER INSERT ON `documento` FOR EACH ROW BEGIN
IF new.area_origen!= '' AND new.area_origen!= '0' THEN
	INSERT INTO movimiento (documento_id,area_origen_id,areadestino_id,mov_fecharegistro,mov_descripcion,mov_estatus,tipo) VALUES (new.documento_id,new.area_origen,new.area_id,now(),'','PENDIENTE','1');
ELSE
	INSERT INTO movimiento (documento_id,area_origen_id,areadestino_id,mov_fecharegistro,mov_descripcion,mov_estatus,tipo) VALUES (new.documento_id,'1',new.area_id,now(),'','PENDIENTE','1');
END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `empleado_id` int(11) NOT NULL,
  `emple_nombre` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `emple_apepat` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `emple_apemat` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `emple_feccreacion` date DEFAULT NULL,
  `emple_fechanacimiento` date DEFAULT NULL,
  `emple_nrodocumento` char(12) COLLATE utf8_spanish_ci DEFAULT NULL,
  `emple_movil` char(9) COLLATE utf8_spanish_ci DEFAULT NULL,
  `emple_email` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `emple_estatus` enum('ACTIVO','INACTIVO') COLLATE utf8_spanish_ci NOT NULL,
  `emple_direccion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empl_fotoperfil` varchar(255) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Fotos/admin.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`empleado_id`, `emple_nombre`, `emple_apepat`, `emple_apemat`, `emple_feccreacion`, `emple_fechanacimiento`, `emple_nrodocumento`, `emple_movil`, `emple_email`, `emple_estatus`, `emple_direccion`, `empl_fotoperfil`) VALUES
(1, 'SOFTNET', 'SOLUTIONS', 'PE', '2019-09-27', '1996-09-27', '12345678', '982255930', 'softnet.solutions.pe@gmail.com', 'ACTIVO', 'CORAZON DE JESUS MZ B LOT 13', 'Fotos/admin.PNG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento`
--

CREATE TABLE `movimiento` (
  `movimiento_id` int(11) NOT NULL,
  `documento_id` char(12) COLLATE utf8_spanish_ci NOT NULL,
  `area_origen_id` int(11) DEFAULT NULL,
  `areadestino_id` int(11) NOT NULL,
  `mov_fecharegistro` datetime DEFAULT current_timestamp(),
  `mov_descripcion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `mov_estatus` enum('PENDIENTE','CONFORME','INCOFORME','ACEPTADO','DERIVADO','FINALIZADO','RECHAZADO') COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `mov_archivo` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `mov_descripcion_original` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Disparadores `movimiento`
--
DELIMITER $$
CREATE TRIGGER `TRG_ACTUALIZAR_DOCUMENTO` AFTER INSERT ON `movimiento` FOR EACH ROW BEGIN
IF new.tipo!=1 THEN
UPDATE documento SET
documento.area_id = new.areadestino_id
WHERE documento.documento_id =  new.documento_id;
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TRG_ACTUALIZAR_DOCUMENTO_FINALIZAR` AFTER UPDATE ON `movimiento` FOR EACH ROW BEGIN
IF new.mov_estatus = 'FINALIZADO' THEN
    UPDATE documento SET
    	documento.doc_estatus = 'FINALIZADO'
    WHERE documento.documento_id =  new.documento_id;
END IF;
IF new.mov_estatus = 'RECHAZADO' THEN
    UPDATE documento SET
    	documento.doc_estatus = 'RECHAZADO'
    WHERE documento.documento_id =  new.documento_id;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento_accion`
--

CREATE TABLE `movimiento_accion` (
  `movimientoaccion_id` int(11) NOT NULL,
  `movimiento_id` int(11) DEFAULT NULL,
  `moviac_descripcion` varchar(255) COLLATE utf8_spanish_ci DEFAULT '',
  `moviac_estatus` enum('PENDIENTE','ACEPTADO','CONFORME','INCOFORME','RECHAZADO','FINALIZADO') COLLATE utf8_spanish_ci NOT NULL,
  `moviac_fecharegistro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Disparadores `movimiento_accion`
--
DELIMITER $$
CREATE TRIGGER `TRAG_ACTUALIZAR_MOVIMIENTO` AFTER INSERT ON `movimiento_accion` FOR EACH ROW BEGIN
DECLARE destino_inicial INT;
set @destino_inicial :=(SELECT documento.area_destino FROM documento 
INNER JOIN movimiento ON movimiento.documento_id = documento.documento_id
WHERE movimiento.movimiento_id = new.movimiento_id);
IF @destino_inicial = 1 THEN
	UPDATE movimiento SET
    	movimiento.mov_estatus = new.moviac_estatus,
        movimiento.mov_descripcion_original = new.moviac_descripcion
    WHERE movimiento.movimiento_id = new.movimiento_id;
ELSE
	UPDATE movimiento SET
    	movimiento.mov_estatus = new.moviac_estatus,
        movimiento.mov_descripcion_original = new.moviac_descripcion,
        movimiento.tipo = ''
    WHERE movimiento.movimiento_id = new.movimiento_id;
END IF;
IF new.moviac_estatus = 'RECHAZADO' THEN
    SET @ID :=(SELECT movimiento.documento_id FROM movimiento WHERE movimiento.movimiento_id = new.movimiento_id);
    SET @AREA :=(SELECT movimiento.areadestino_id FROM movimiento WHERE movimiento.movimiento_id = new.movimiento_id);
    SET @USUARIO :=(SELECT movimiento.usuario_id FROM movimiento WHERE movimiento.movimiento_id = new.movimiento_id);
    INSERT INTO movimiento (documento_id,area_origen_id,  areadestino_id,mov_fecharegistro,mov_descripcion,mov_estatus,usuario_id,tipo) 
                   VALUES (@ID,@AREA,1,NOW(),'DOCUMENTO RECHAZADO','PENDIENTE',@USUARIO ,'');
 END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `tipodocumento_id` int(11) NOT NULL COMMENT 'Codigo auto-incrementado del tipo documento',
  `tipodo_descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripcion del  tipo documento',
  `tipodo_estado` enum('ACTIVO','INACTIVO') COLLATE utf8_spanish_ci NOT NULL COMMENT 'estado del tipo de documento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='Entidad Documento';

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`tipodocumento_id`, `tipodo_descripcion`, `tipodo_estado`) VALUES
(1, 'ORDEN DE COORDINACION', 'ACTIVO'),
(2, 'CARTA', 'ACTIVO'),
(3, 'DIRECTIVA', 'ACTIVO'),
(4, 'ANEXO', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL,
  `usu_usuario` varchar(250) COLLATE utf8_spanish_ci DEFAULT '',
  `usu_contra` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usu_feccreacion` date DEFAULT NULL,
  `usu_fecupdate` date DEFAULT NULL,
  `empleado_id` int(11) DEFAULT NULL,
  `usu_observacion` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usu_estatus` enum('ACTIVO','INACTIVO') COLLATE utf8_spanish_ci NOT NULL,
  `area_id` int(11) DEFAULT NULL,
  `usu_rol` enum('Secretario (a)','Administrador') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usu_id`, `usu_usuario`, `usu_contra`, `usu_feccreacion`, `usu_fecupdate`, `empleado_id`, `usu_observacion`, `usu_estatus`, `area_id`, `usu_rol`) VALUES
(1, 'admin00', '$2y$10$9f73EzbIt.emnMGPCLgwjOzli.P/snMNGX7kNXWrBx.jrovJ34Bq6', '2019-08-31', '2019-08-31', 1, '', 'ACTIVO', NULL, 'Administrador'),
(2, 'admin', '$2y$10$9f73EzbIt.emnMGPCLgwjOzli.P/snMNGX7kNXWrBx.jrovJ34Bq6', '2019-08-31', '2019-08-31', 1, '', 'ACTIVO', 1, 'Secretario (a)'),
(3, 'rrhh', '$2y$10$9f73EzbIt.emnMGPCLgwjOzli.P/snMNGX7kNXWrBx.jrovJ34Bq6', '2019-08-31', '2019-08-31', 1, '', 'ACTIVO', 2, 'Secretario (a)');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`area_cod`),
  ADD UNIQUE KEY `unico` (`area_nombre`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`documento_id`),
  ADD KEY `tipodocumento_id` (`tipodocumento_id`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`empleado_id`);

--
-- Indices de la tabla `movimiento`
--
ALTER TABLE `movimiento`
  ADD PRIMARY KEY (`movimiento_id`),
  ADD KEY `area_origen_id` (`area_origen_id`),
  ADD KEY `areadestino_id` (`areadestino_id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `documento_id` (`documento_id`);

--
-- Indices de la tabla `movimiento_accion`
--
ALTER TABLE `movimiento_accion`
  ADD PRIMARY KEY (`movimientoaccion_id`),
  ADD KEY `movimiento_id` (`movimiento_id`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`tipodocumento_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_id`),
  ADD KEY `empleado_id` (`empleado_id`),
  ADD KEY `area_id` (`area_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `area_cod` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo auto-incrementado del movimiento del area', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `empleado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `movimiento`
--
ALTER TABLE `movimiento`
  MODIFY `movimiento_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `movimiento_accion`
--
ALTER TABLE `movimiento_accion`
  MODIFY `movimientoaccion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `tipodocumento_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo auto-incrementado del tipo documento', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`tipodocumento_id`) REFERENCES `tipo_documento` (`tipodocumento_id`);

--
-- Filtros para la tabla `movimiento`
--
ALTER TABLE `movimiento`
  ADD CONSTRAINT `movimiento_ibfk_1` FOREIGN KEY (`area_origen_id`) REFERENCES `area` (`area_cod`),
  ADD CONSTRAINT `movimiento_ibfk_2` FOREIGN KEY (`areadestino_id`) REFERENCES `area` (`area_cod`),
  ADD CONSTRAINT `movimiento_ibfk_3` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`usu_id`),
  ADD CONSTRAINT `movimiento_ibfk_4` FOREIGN KEY (`documento_id`) REFERENCES `documento` (`documento_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `movimiento_accion`
--
ALTER TABLE `movimiento_accion`
  ADD CONSTRAINT `movimiento_accion_ibfk_1` FOREIGN KEY (`movimiento_id`) REFERENCES `movimiento` (`movimiento_id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`empleado_id`) REFERENCES `empleado` (`empleado_id`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `area` (`area_cod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
