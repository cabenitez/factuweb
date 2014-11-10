/*
SQLyog Community v8.4 RC2
MySQL - 5.1.54-1ubuntu4 : Database - factuweb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`factuweb` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `factuweb`;

/*Table structure for table `agenda` */

DROP TABLE IF EXISTS `agenda`;

CREATE TABLE `agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` char(50) NOT NULL,
  `telefono` char(50) NOT NULL,
  `correo` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `agenda` */

insert  into `agenda`(`id`,`nombre`,`telefono`,`correo`) values (1,'BETO','sadasdsa','dasdsa@sadsa.com');
insert  into `agenda`(`id`,`nombre`,`telefono`,`correo`) values (2,'DSAD','asdasd','asdasd');
insert  into `agenda`(`id`,`nombre`,`telefono`,`correo`) values (3,'SADASD','sadsa','');
insert  into `agenda`(`id`,`nombre`,`telefono`,`correo`) values (4,'LUCAS MATIAS DOMINGUEZ','03752-15548163','lmdominguez@dos-insumos.com.ar');

/*Table structure for table `ajuste_precio` */

DROP TABLE IF EXISTS `ajuste_precio`;

CREATE TABLE `ajuste_precio` (
  `cod_grupo` int(11) NOT NULL,
  `cod_categoria` int(11) NOT NULL,
  `utilidad` float NOT NULL,
  PRIMARY KEY (`cod_grupo`,`cod_categoria`),
  KEY `Refcategoria135` (`cod_categoria`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `ajuste_precio` */

insert  into `ajuste_precio`(`cod_grupo`,`cod_categoria`,`utilidad`) values (2,2,30);
insert  into `ajuste_precio`(`cod_grupo`,`cod_categoria`,`utilidad`) values (1,1,13);
insert  into `ajuste_precio`(`cod_grupo`,`cod_categoria`,`utilidad`) values (2,1,50);
insert  into `ajuste_precio`(`cod_grupo`,`cod_categoria`,`utilidad`) values (11,3,30);
insert  into `ajuste_precio`(`cod_grupo`,`cod_categoria`,`utilidad`) values (1,4,10);
insert  into `ajuste_precio`(`cod_grupo`,`cod_categoria`,`utilidad`) values (9,1,2);
insert  into `ajuste_precio`(`cod_grupo`,`cod_categoria`,`utilidad`) values (9,2,1);
insert  into `ajuste_precio`(`cod_grupo`,`cod_categoria`,`utilidad`) values (11,1,30);
insert  into `ajuste_precio`(`cod_grupo`,`cod_categoria`,`utilidad`) values (11,2,10);
insert  into `ajuste_precio`(`cod_grupo`,`cod_categoria`,`utilidad`) values (1,2,30);
insert  into `ajuste_precio`(`cod_grupo`,`cod_categoria`,`utilidad`) values (3,2,12);
insert  into `ajuste_precio`(`cod_grupo`,`cod_categoria`,`utilidad`) values (4,2,5);
insert  into `ajuste_precio`(`cod_grupo`,`cod_categoria`,`utilidad`) values (5,2,45);

/*Table structure for table `alicuota_iva` */

DROP TABLE IF EXISTS `alicuota_iva`;

CREATE TABLE `alicuota_iva` (
  `cod_iva` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `tasa` float NOT NULL,
  PRIMARY KEY (`cod_iva`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `alicuota_iva` */

insert  into `alicuota_iva`(`cod_iva`,`nombre`,`tasa`) values (1,'TASA GENERAL 21%',21);
insert  into `alicuota_iva`(`cod_iva`,`nombre`,`tasa`) values (2,'TASA GENERAL 10.5%',10.5);
insert  into `alicuota_iva`(`cod_iva`,`nombre`,`tasa`) values (6,'SIN IVA',0);

/*Table structure for table `art_especial` */

DROP TABLE IF EXISTS `art_especial`;

CREATE TABLE `art_especial` (
  `codigo` int(11) NOT NULL,
  `tipo` char(2) NOT NULL,
  `valor` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `art_especial` */

insert  into `art_especial`(`codigo`,`tipo`,`valor`) values (13211,'NC','NO COMPRA');
insert  into `art_especial`(`codigo`,`tipo`,`valor`) values (13321,'SF','SIN FACTURA');

/*Table structure for table `caja_inicial` */

DROP TABLE IF EXISTS `caja_inicial`;

CREATE TABLE `caja_inicial` (
  `fecha` int(11) NOT NULL,
  `importe` float NOT NULL,
  `observacion` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `caja_inicial` */

insert  into `caja_inicial`(`fecha`,`importe`,`observacion`) values (20110326,1000,'INGRESO BETOS');
insert  into `caja_inicial`(`fecha`,`importe`,`observacion`) values (20110326,1000,'INGRESO NUEVO');
insert  into `caja_inicial`(`fecha`,`importe`,`observacion`) values (20110326,100,'INGRESO 3');

/*Table structure for table `cargas` */

DROP TABLE IF EXISTS `cargas`;

CREATE TABLE `cargas` (
  `fecha` int(11) NOT NULL,
  `cod_flero` int(11) NOT NULL,
  `hora` text NOT NULL,
  `usuario` text NOT NULL,
  PRIMARY KEY (`fecha`,`cod_flero`),
  KEY `Reffletero116` (`cod_flero`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `cargas` */

insert  into `cargas`(`fecha`,`cod_flero`,`hora`,`usuario`) values (20090124,1,'19:07:26','admin');

/*Table structure for table `categoria` */

DROP TABLE IF EXISTS `categoria`;

CREATE TABLE `categoria` (
  `cod_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text,
  PRIMARY KEY (`cod_categoria`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `categoria` */

insert  into `categoria`(`cod_categoria`,`descripcion`) values (1,'PUB. GRAL.');
insert  into `categoria`(`cod_categoria`,`descripcion`) values (2,'ADM. PUBLICA');

/*Table structure for table `cc_compra` */

DROP TABLE IF EXISTS `cc_compra`;

CREATE TABLE `cc_compra` (
  `n_factura` int(8) unsigned zerofill NOT NULL,
  `total` float NOT NULL,
  `estado` text NOT NULL,
  PRIMARY KEY (`n_factura`),
  KEY `Ref3746` (`n_factura`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `cc_compra` */

/*Table structure for table `cc_compra_detalle` */

DROP TABLE IF EXISTS `cc_compra_detalle`;

CREATE TABLE `cc_compra_detalle` (
  `n_factura` int(8) unsigned zerofill NOT NULL,
  `n_compr` int(11) NOT NULL,
  `fecha` int(11) NOT NULL,
  `monto` float NOT NULL,
  `observacion` text,
  `cod_fp` int(11) NOT NULL,
  PRIMARY KEY (`n_factura`),
  KEY `Ref3447` (`n_factura`),
  KEY `Ref2655` (`cod_fp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `cc_compra_detalle` */

/*Table structure for table `cc_vta` */

DROP TABLE IF EXISTS `cc_vta`;

CREATE TABLE `cc_vta` (
  `num_recibo` int(8) unsigned zerofill NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `cod_zona` int(11) NOT NULL,
  `cod_localidad` int(11) NOT NULL,
  `cod_prov` int(11) NOT NULL,
  `cod_pais` int(11) NOT NULL,
  `cod_talonario` char(1) NOT NULL,
  `num_talonario` int(4) unsigned zerofill NOT NULL,
  `importe` float NOT NULL,
  `cod_vendedor` int(11) NOT NULL,
  `fecha` int(11) DEFAULT NULL,
  `observacion` text,
  `usuario` text,
  PRIMARY KEY (`num_recibo`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_talonario`,`num_talonario`),
  KEY `Refrecibos_por_cliente131` (`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_talonario`,`num_talonario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `cc_vta` */

insert  into `cc_vta`(`num_recibo`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_talonario`,`num_talonario`,`importe`,`cod_vendedor`,`fecha`,`observacion`,`usuario`) values (00000001,1,5,33,1,1,'C',0001,100,1,20110909,'','admin');
insert  into `cc_vta`(`num_recibo`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_talonario`,`num_talonario`,`importe`,`cod_vendedor`,`fecha`,`observacion`,`usuario`) values (00000002,1,5,33,1,1,'C',0001,100,1,20110909,'','admin');

/*Table structure for table `cc_vta_detalle` */

DROP TABLE IF EXISTS `cc_vta_detalle`;

CREATE TABLE `cc_vta_detalle` (
  `id_imputacion` int(11) NOT NULL AUTO_INCREMENT,
  `n_factura` int(8) unsigned zerofill NOT NULL,
  `cod_talonario` char(1) NOT NULL,
  `num_talonario` int(4) unsigned zerofill NOT NULL,
  `num_recibo` int(8) unsigned zerofill DEFAULT NULL,
  `cod_talonario_recibo` char(1) DEFAULT NULL,
  `num_talonario_recibo` int(4) unsigned zerofill DEFAULT NULL,
  `importe` float NOT NULL,
  `fecha` int(11) NOT NULL,
  `observacion` text,
  `usuario` text,
  PRIMARY KEY (`id_imputacion`),
  KEY `Reffactura_vta128` (`n_factura`,`cod_talonario`,`num_talonario`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `cc_vta_detalle` */

insert  into `cc_vta_detalle`(`id_imputacion`,`n_factura`,`cod_talonario`,`num_talonario`,`num_recibo`,`cod_talonario_recibo`,`num_talonario_recibo`,`importe`,`fecha`,`observacion`,`usuario`) values (1,00000001,'A',0001,00000001,'C',0001,50,20110909,'','admin');
insert  into `cc_vta_detalle`(`id_imputacion`,`n_factura`,`cod_talonario`,`num_talonario`,`num_recibo`,`cod_talonario_recibo`,`num_talonario_recibo`,`importe`,`fecha`,`observacion`,`usuario`) values (2,00000001,'A',0001,00000002,'C',0001,50,20110909,'','admin');
insert  into `cc_vta_detalle`(`id_imputacion`,`n_factura`,`cod_talonario`,`num_talonario`,`num_recibo`,`cod_talonario_recibo`,`num_talonario_recibo`,`importe`,`fecha`,`observacion`,`usuario`) values (3,00000003,'A',0001,00000002,'C',0001,50,20110909,'','admin');
insert  into `cc_vta_detalle`(`id_imputacion`,`n_factura`,`cod_talonario`,`num_talonario`,`num_recibo`,`cod_talonario_recibo`,`num_talonario_recibo`,`importe`,`fecha`,`observacion`,`usuario`) values (4,00000003,'A',0001,00000001,'C',0001,46.7,20110909,'','admin');

/*Table structure for table `cc_vta_tmp` */

DROP TABLE IF EXISTS `cc_vta_tmp`;

CREATE TABLE `cc_vta_tmp` (
  `usuario` text,
  `n_factura` int(8) unsigned zerofill NOT NULL,
  `cod_talonario` char(1) NOT NULL,
  `num_talonario` int(4) unsigned zerofill NOT NULL,
  `importe` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `cc_vta_tmp` */

/*Table structure for table `cliente` */

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `cod_cliente` int(11) NOT NULL,
  `cod_zona` int(11) NOT NULL,
  `cod_localidad` int(11) NOT NULL,
  `cod_prov` int(11) NOT NULL,
  `cod_pais` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `razon_social` text NOT NULL,
  `tel` text,
  `fax` text,
  `movil` text,
  `direccion` text NOT NULL,
  `cuit` text,
  `limite_credito` text,
  `web` text,
  `email` text,
  `cod_iva` int(11) NOT NULL,
  `cod_categoria` int(11) NOT NULL,
  `cod_vendedor` int(11) NOT NULL,
  `cod_flero` int(11) NOT NULL,
  `cod_talonario` char(1) NOT NULL,
  `cod_fp` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `activo` varchar(1) NOT NULL,
  PRIMARY KEY (`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`),
  KEY `Ref1814` (`cod_pais`,`cod_prov`,`cod_localidad`,`cod_zona`),
  KEY `Ref2830` (`cod_iva`,`cod_talonario`),
  KEY `Ref475` (`cod_categoria`),
  KEY `Ref4582` (`cod_vendedor`),
  KEY `Ref683` (`cod_flero`),
  KEY `Ref2584` (`cod_talonario`),
  KEY `Ref26113` (`cod_fp`),
  KEY `Refzona14` (`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `cliente` */

insert  into `cliente`(`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`razon_social`,`tel`,`fax`,`movil`,`direccion`,`cuit`,`limite_credito`,`web`,`email`,`cod_iva`,`cod_categoria`,`cod_vendedor`,`cod_flero`,`cod_talonario`,`cod_fp`,`orden`,`activo`) values (1,5,33,1,1,'TITO','DOS MIL S.A.','03758-422504','03758-422504','','LOTE 52 -','30687923878','','','',1,1,1,1,'A',3,7,'S');
insert  into `cliente`(`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`razon_social`,`tel`,`fax`,`movil`,`direccion`,`cuit`,`limite_credito`,`web`,`email`,`cod_iva`,`cod_categoria`,`cod_vendedor`,`cod_flero`,`cod_talonario`,`cod_fp`,`orden`,`activo`) values (2,5,33,1,1,'','HORODESKI ADOLFO  BLAS','','','','SARMIENTO Y ALVEAR','20279817991','','','',2,1,1,1,'B',1,0,'S');
insert  into `cliente`(`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`razon_social`,`tel`,`fax`,`movil`,`direccion`,`cuit`,`limite_credito`,`web`,`email`,`cod_iva`,`cod_categoria`,`cod_vendedor`,`cod_flero`,`cod_talonario`,`cod_fp`,`orden`,`activo`) values (3,5,33,1,1,'','CATALANO SERGIO','','','','H.RAMELLA - FTE. P.LA ESPIGA','20147459131','','','',2,1,1,1,'B',1,0,'S');
insert  into `cliente`(`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`razon_social`,`tel`,`fax`,`movil`,`direccion`,`cuit`,`limite_credito`,`web`,`email`,`cod_iva`,`cod_categoria`,`cod_vendedor`,`cod_flero`,`cod_talonario`,`cod_fp`,`orden`,`activo`) values (4,5,33,1,1,'','DA LUZ SALVADOR','','','','ALVEAR Y RUTA 105','23207572349','','','',1,1,1,1,'A',1,8,'S');
insert  into `cliente`(`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`razon_social`,`tel`,`fax`,`movil`,`direccion`,`cuit`,`limite_credito`,`web`,`email`,`cod_iva`,`cod_categoria`,`cod_vendedor`,`cod_flero`,`cod_talonario`,`cod_fp`,`orden`,`activo`) values (5,5,33,1,1,'','KRAUCHUK JOSE','','','','BELGRANO 1012','20124163367','','','',1,1,1,1,'A',1,6,'S');
insert  into `cliente`(`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`razon_social`,`tel`,`fax`,`movil`,`direccion`,`cuit`,`limite_credito`,`web`,`email`,`cod_iva`,`cod_categoria`,`cod_vendedor`,`cod_flero`,`cod_talonario`,`cod_fp`,`orden`,`activo`) values (6,5,33,1,1,'','PROKOPIW JULIO CESAR','','','','HUSSAY Y LIBERTAD','20184625890','','','',2,1,1,1,'B',1,9,'S');

/*Table structure for table `comision_vendedor` */

DROP TABLE IF EXISTS `comision_vendedor`;

CREATE TABLE `comision_vendedor` (
  `cod_vendedor` int(11) NOT NULL,
  `fecha_desde` int(11) NOT NULL,
  `fecha_hasta` int(11) NOT NULL,
  `fecha_liq` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `comision_vendedor` */

insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (20,20071115,20071115,20071115);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (17,20071101,20071117,20071117);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (3,20071112,20071123,20071124);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (3,20071201,20071210,20071212);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (10,20071101,20071130,20071219);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (5,20080101,20080115,20080116);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (17,20080101,20080131,20080202);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (10,20080101,20080131,20080206);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (2,20080101,20080131,20080209);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (14,20080101,20080131,20080209);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (1,20080128,20080217,20080220);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (5,20080128,20080203,20080227);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (5,20080204,20080220,20080227);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (6,20080111,20080126,20080228);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (6,20080211,20080226,20080228);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (6,20080128,20080202,20080228);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (6,20080204,20080221,20080228);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (2,20080201,20080229,20080307);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (14,20080201,20080229,20080307);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080329,20080329,20080405);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (2,20080301,20080331,20080405);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (14,20080301,20080331,20080405);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080425,20080425,20080430);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080426,20080426,20080505);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080502,20080502,20080506);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080506,20080506,20080508);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (2,20080401,20080430,20080510);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (14,20080401,20080430,20080510);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080503,20080503,20080510);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080509,20080509,20080513);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080520,20080520,20080522);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080523,20080523,20080528);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080527,20080527,20080530);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080524,20080524,20080531);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080530,20080530,20080603);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080603,20080603,20080606);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080531,20080531,20080606);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080606,20080606,20080610);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080610,20080610,20080613);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080613,20080613,20080618);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080617,20080617,20080621);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080607,20080607,20080621);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080614,20080614,20080621);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080620,20080620,20080625);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080624,20080624,20080627);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080622,20080622,20080628);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080621,20080621,20080628);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (6,20080616,20080630,20080701);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080627,20080627,20080701);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080701,20080701,20080704);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (17,20080601,20080630,20080705);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080628,20080628,20080705);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080704,20080704,20080707);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080707,20080707,20080711);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080705,20080705,20080712);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080711,20080711,20080722);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080715,20080715,20080722);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080718,20080718,20080722);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080722,20080722,20080725);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080719,20080719,20080726);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080712,20080712,20080726);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080725,20080725,20080729);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080729,20080729,20080801);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080726,20080726,20080802);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080801,20080801,20080805);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (14,20080701,20080731,20080807);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (2,20080701,20080731,20080807);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080805,20080805,20080808);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080802,20080802,20080809);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080808,20080808,20080812);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080812,20080812,20080815);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080809,20080809,20080815);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080815,20080815,20080819);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080819,20080819,20080822);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080816,20080816,20080822);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080822,20080822,20080825);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080826,20080826,20080828);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080823,20080823,20080829);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080820,20080820,20080901);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080829,20080829,20080901);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080905,20080905,20080909);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (6,20080817,20080905,20080909);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080909,20080909,20080911);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080904,20080904,20080912);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080906,20080906,20080912);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080830,20080830,20080912);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080829,20080829,20080912);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080912,20080912,20080915);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080913,20080913,20080918);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080916,20080916,20080919);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080917,20080917,20080920);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080913,20080913,20080920);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080919,20080919,20080922);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080922,20080922,20080923);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080920,20080920,20080923);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080923,20080923,20080924);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080924,20080924,20080926);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080925,20080925,20080926);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080920,20080920,20080926);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080926,20080926,20080929);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080929,20080929,20080929);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20080930,20080930,20081003);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20081001,20081001,20081003);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20081002,20081002,20081003);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20080927,20080927,20081003);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20081003,20081003,20081006);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20081007,20081007,20081008);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (2,20080901,20080930,20081009);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20081004,20081004,20081011);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (14,20080901,20080930,20081014);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20081010,20081010,20081014);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20081011,20081011,20081017);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20081014,20081014,20081017);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20081017,20081017,20081020);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20081021,20081021,20081022);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20081018,20081018,20081022);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20081024,20081024,20081027);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20081028,20081028,20081029);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20081025,20081025,20081029);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20081031,20081031,20081103);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20081104,20081104,20081106);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20081101,20081101,20081108);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20081107,20081107,20081110);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20081111,20081111,20081113);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20081108,20081108,20081113);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20081114,20081114,20081117);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20081118,20081118,20081121);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20081114,20081114,20081121);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20081121,20081121,20081124);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20081125,20081125,20081128);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (15,20081122,20081122,20081129);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20081128,20081128,20081202);
insert  into `comision_vendedor`(`cod_vendedor`,`fecha_desde`,`fecha_hasta`,`fecha_liq`) values (4,20081201,20081204,20081204);

/*Table structure for table `conf_listados` */

DROP TABLE IF EXISTS `conf_listados`;

CREATE TABLE `conf_listados` (
  `lineas` int(11) NOT NULL,
  `impresora` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `conf_listados` */

insert  into `conf_listados`(`lineas`,`impresora`) values (35,'LaserJet-P1005#LaserJet-P1005');

/*Table structure for table `deposito` */

DROP TABLE IF EXISTS `deposito`;

CREATE TABLE `deposito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` longblob NOT NULL,
  `hora` longblob NOT NULL,
  `banco` text NOT NULL,
  `n_trans` char(20) NOT NULL,
  `n_cta` char(20) NOT NULL,
  `titular` text,
  `importe` float NOT NULL,
  `observacion` char(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `deposito` */

insert  into `deposito`(`id`,`fecha`,`hora`,`banco`,`n_trans`,`n_cta`,`titular`,`importe`,`observacion`) values (1,'20110909','12:30','MACRO','1','111111','BETOS',1000,'NADA');
insert  into `deposito`(`id`,`fecha`,`hora`,`banco`,`n_trans`,`n_cta`,`titular`,`importe`,`observacion`) values (2,'20110909','13:00','GALICIA','111','12354','BETOS',250,'OBSERVACIO');

/*Table structure for table `devolucion` */

DROP TABLE IF EXISTS `devolucion`;

CREATE TABLE `devolucion` (
  `n_devolucion` int(8) unsigned zerofill NOT NULL,
  `cod_vendedor` int(11) DEFAULT NULL,
  `cod_talonario` char(1) DEFAULT NULL,
  `num_talonario` int(4) unsigned zerofill DEFAULT NULL,
  `fecha_rebote` int(11) DEFAULT NULL,
  `fecha_carga` int(11) NOT NULL,
  PRIMARY KEY (`n_devolucion`),
  KEY `Reftalonario117` (`cod_talonario`,`num_talonario`),
  KEY `Refvendedor118` (`cod_vendedor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `devolucion` */

/*Table structure for table `devolucion_detalle` */

DROP TABLE IF EXISTS `devolucion_detalle`;

CREATE TABLE `devolucion_detalle` (
  `n_devolucion` int(8) unsigned zerofill NOT NULL,
  `cod_prod` int(11) NOT NULL,
  `cod_variedad` int(11) NOT NULL,
  `cod_marca` int(11) NOT NULL,
  `cod_grupo` int(11) NOT NULL,
  `cantidad` float DEFAULT NULL,
  `precio` float NOT NULL,
  PRIMARY KEY (`n_devolucion`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`),
  KEY `Refproducto120` (`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `devolucion_detalle` */

/*Table structure for table `devolucion_detalle_tmp` */

DROP TABLE IF EXISTS `devolucion_detalle_tmp`;

CREATE TABLE `devolucion_detalle_tmp` (
  `usuario` text,
  `cod_prod` int(11) DEFAULT NULL,
  `descripcion` text NOT NULL,
  `precio` float NOT NULL,
  `cantidad` float NOT NULL,
  `linea` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `devolucion_detalle_tmp` */

/*Table structure for table `empresa` */

DROP TABLE IF EXISTS `empresa`;

CREATE TABLE `empresa` (
  `cod_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `dueno` text NOT NULL,
  `razon_social` text NOT NULL,
  `cuit` text,
  `ing_bruto` text,
  `iva` text NOT NULL,
  `inicio_act` int(11) DEFAULT NULL,
  `tel` text,
  `fax` text,
  `movil` text,
  `direccion` text NOT NULL,
  `pais` text NOT NULL,
  `provincia` text NOT NULL,
  `localidad` text NOT NULL,
  `web` text,
  `email` text,
  `logo` text,
  `imagen_fondo` text,
  PRIMARY KEY (`cod_empresa`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `empresa` */

insert  into `empresa`(`cod_empresa`,`dueno`,`razon_social`,`cuit`,`ing_bruto`,`iva`,`inicio_act`,`tel`,`fax`,`movil`,`direccion`,`pais`,`provincia`,`localidad`,`web`,`email`,`logo`,`imagen_fondo`) values (1,'CAB','Æ’actuweb v2.0','23298402149','11111111','RESP. INSCRIPTO',19112011,'(011) 11111','(011) 11111','','Arenales 2955','ARGENTINA','BUENOS AIRES','CAPITAL FEDERAL','www.factuweb-ar.com.ar','info@factuweb-ar.com.ar','N','N');

/*Table structure for table `evento` */

DROP TABLE IF EXISTS `evento`;

CREATE TABLE `evento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `body` text,
  `timestamp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=172 DEFAULT CHARSET=latin1;

/*Data for the table `evento` */

insert  into `evento`(`id`,`body`,`timestamp`) values (2,'1 frezeer azara; casamiento; gerardo',1201316400);
insert  into `evento`(`id`,`body`,`timestamp`) values (3,'9 freezer concepcion carnaval',1201316400);
insert  into `evento`(`id`,`body`,`timestamp`) values (15,'1 freezer expo yerba krayeski',1201921200);
insert  into `evento`(`id`,`body`,`timestamp`) values (6,'9 freezer concepcion carnaval',1202526000);
insert  into `evento`(`id`,`body`,`timestamp`) values (9,'1 freezer Alem casamiento',1200711600);
insert  into `evento`(`id`,`body`,`timestamp`) values (10,'2 freezer skulkin recital',1200538800);

/*Table structure for table `factura_anulada_numeracion` */

DROP TABLE IF EXISTS `factura_anulada_numeracion`;

CREATE TABLE `factura_anulada_numeracion` (
  `cod_talonario` char(1) NOT NULL,
  `num_talonario` int(4) unsigned zerofill NOT NULL,
  `sucursal` int(11) NOT NULL,
  `n_factura` int(8) unsigned zerofill NOT NULL,
  `usuario` text NOT NULL,
  `fecha` int(11) NOT NULL,
  PRIMARY KEY (`cod_talonario`,`num_talonario`,`sucursal`,`n_factura`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `factura_anulada_numeracion` */

/*Table structure for table `factura_compra` */

DROP TABLE IF EXISTS `factura_compra`;

CREATE TABLE `factura_compra` (
  `n_factura` int(8) unsigned zerofill NOT NULL,
  `n_sucursal` int(4) unsigned zerofill NOT NULL,
  `cod_proveedor` int(11) NOT NULL,
  `fecha_fact` int(11) NOT NULL,
  `subtotal` float NOT NULL,
  `imp_interno_alicuota` float DEFAULT NULL,
  `imp_interno_monto` float DEFAULT NULL,
  `iva_alicuota` float NOT NULL,
  `iva_monto` float NOT NULL,
  `perc_iva_alicuota` float DEFAULT NULL,
  `perc_iva_monto` float DEFAULT NULL,
  `pib_alicuota` float DEFAULT NULL,
  `pib_monto` float DEFAULT NULL,
  `otros_alicuota` float DEFAULT NULL,
  `otros_monto` float DEFAULT NULL,
  `total` float NOT NULL,
  `fecha_reg` int(11) NOT NULL,
  `observacion` text,
  `usuario` text NOT NULL,
  `id_deposito` int(11) DEFAULT NULL,
  PRIMARY KEY (`n_factura`,`n_sucursal`,`cod_proveedor`),
  KEY `Refproveedor53` (`cod_proveedor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `factura_compra` */

insert  into `factura_compra`(`n_factura`,`n_sucursal`,`cod_proveedor`,`fecha_fact`,`subtotal`,`imp_interno_alicuota`,`imp_interno_monto`,`iva_alicuota`,`iva_monto`,`perc_iva_alicuota`,`perc_iva_monto`,`pib_alicuota`,`pib_monto`,`otros_alicuota`,`otros_monto`,`total`,`fecha_reg`,`observacion`,`usuario`,`id_deposito`) values (00000001,0001,1,20110909,200,0,0,21,240,0,0,0,0,0,0,240,20110909,'','admin',NULL);
insert  into `factura_compra`(`n_factura`,`n_sucursal`,`cod_proveedor`,`fecha_fact`,`subtotal`,`imp_interno_alicuota`,`imp_interno_monto`,`iva_alicuota`,`iva_monto`,`perc_iva_alicuota`,`perc_iva_monto`,`pib_alicuota`,`pib_monto`,`otros_alicuota`,`otros_monto`,`total`,`fecha_reg`,`observacion`,`usuario`,`id_deposito`) values (11111111,1111,1,20110909,1000,1,1,1,1,1,1,1,1,1,1,1100,20110909,'','admin',0);

/*Table structure for table `factura_compra_detalle` */

DROP TABLE IF EXISTS `factura_compra_detalle`;

CREATE TABLE `factura_compra_detalle` (
  `cod_prod` int(11) DEFAULT NULL,
  `cod_variedad` int(11) DEFAULT NULL,
  `cod_marca` int(11) DEFAULT NULL,
  `cod_grupo` int(11) DEFAULT NULL,
  `n_factura` int(8) unsigned zerofill DEFAULT NULL,
  `n_sucursal` int(4) unsigned zerofill DEFAULT NULL,
  `cod_proveedor` int(11) DEFAULT NULL,
  `precio` float NOT NULL,
  `cantidad` float NOT NULL,
  `bonificacion` float DEFAULT NULL,
  `importe` float NOT NULL,
  KEY `Reffactura_compra44` (`n_factura`,`n_sucursal`,`cod_proveedor`),
  KEY `Refproducto122` (`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `factura_compra_detalle` */

insert  into `factura_compra_detalle`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`n_factura`,`n_sucursal`,`cod_proveedor`,`precio`,`cantidad`,`bonificacion`,`importe`) values (1,1,1,1,00000001,0001,1,18.9,2,0,200);
insert  into `factura_compra_detalle`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`n_factura`,`n_sucursal`,`cod_proveedor`,`precio`,`cantidad`,`bonificacion`,`importe`) values (1,1,1,1,11111111,1111,1,18.9,10,5,1000);

/*Table structure for table `factura_compra_tmp` */

DROP TABLE IF EXISTS `factura_compra_tmp`;

CREATE TABLE `factura_compra_tmp` (
  `usuario` text,
  `cod_prod` int(11) DEFAULT NULL,
  `descripcion` text,
  `cantidad` float NOT NULL,
  `precio` float NOT NULL,
  `bonificacion` float DEFAULT NULL,
  `importe` float DEFAULT NULL,
  `linea` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `factura_compra_tmp` */

/*Table structure for table `factura_vta` */

DROP TABLE IF EXISTS `factura_vta`;

CREATE TABLE `factura_vta` (
  `n_factura` int(8) unsigned zerofill NOT NULL,
  `fecha` int(11) NOT NULL,
  `hora_entrega` text,
  `lugar` text,
  `observacion` text,
  `cod_categoria` int(11) NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `cod_zona` int(11) NOT NULL,
  `cod_localidad` int(11) NOT NULL,
  `cod_prov` int(11) NOT NULL,
  `cod_pais` int(11) NOT NULL,
  `num_remito` int(8) unsigned zerofill NOT NULL,
  `cod_talonario` char(1) NOT NULL,
  `num_talonario` int(4) unsigned zerofill NOT NULL,
  `cod_vendedor` int(11) DEFAULT NULL,
  `cod_repartidor` int(11) DEFAULT NULL,
  `iva` float DEFAULT NULL,
  `imp_interno` float DEFAULT NULL,
  `perc_iva` float DEFAULT NULL,
  `ing_bruto` float DEFAULT NULL,
  `usuario` text,
  `cod_fp` int(11) NOT NULL,
  PRIMARY KEY (`n_factura`,`cod_talonario`,`num_talonario`),
  KEY `Refcliente32` (`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`),
  KEY `Ref532` (`cod_prov`,`cod_zona`,`cod_pais`,`cod_localidad`,`cod_cliente`),
  KEY `Ref2433` (`num_remito`),
  KEY `Ref2236` (`cod_talonario`,`num_talonario`),
  KEY `Ref26115` (`cod_fp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `factura_vta` */

insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000001,20110109,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000001,20110109,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000002,20110109,'','','',1,3,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000002,20110109,'','','',1,4,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000003,20110109,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000004,20110109,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000003,20110109,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000005,20110109,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'fabian',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000006,20110109,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'fabian',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000007,20110109,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'fabian',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000008,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'fabian',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000009,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000004,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000010,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000005,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000011,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000012,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000013,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000014,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000015,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000016,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000017,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000018,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000019,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000020,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000021,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000022,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000023,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000024,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000025,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000026,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000027,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000028,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000029,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000030,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000006,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000031,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000007,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000032,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000033,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000034,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000035,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000008,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000036,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000037,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000038,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000039,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000040,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000041,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000042,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000043,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000044,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000045,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000046,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000047,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000048,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000049,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000050,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000051,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000052,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000053,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000054,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000055,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000056,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000057,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000058,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000059,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000060,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000061,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000009,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000062,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000010,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000011,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000063,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000012,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000013,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000064,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000065,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000066,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000014,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000067,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000068,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000069,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000070,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000071,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000072,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000073,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000074,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000075,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000015,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000016,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000017,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000018,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000019,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000076,20110909,'','','N/C',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000020,20110909,'','','N/C',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000077,20110909,'','','',1,1,5,33,1,1,00000001,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000078,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000079,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000021,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000080,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000022,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000081,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000082,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000083,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000084,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000085,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000086,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000087,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000023,20110909,'','','',1,3,5,33,1,1,00000000,'B',0001,2,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000024,20110909,'','','',1,6,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000025,20110909,'','','',1,6,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000088,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,2,1,0,0,0,0,'admin',3);
insert  into `factura_vta`(`n_factura`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000089,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',1);

/*Table structure for table `factura_vta_detalle` */

DROP TABLE IF EXISTS `factura_vta_detalle`;

CREATE TABLE `factura_vta_detalle` (
  `n_factura` int(8) unsigned zerofill DEFAULT NULL,
  `cod_prod` int(11) DEFAULT NULL,
  `cod_variedad` int(11) DEFAULT NULL,
  `cod_marca` int(11) DEFAULT NULL,
  `cod_grupo` int(11) DEFAULT NULL,
  `cantidad` float NOT NULL,
  `precio` float NOT NULL,
  `bonificacion` float DEFAULT NULL,
  `cod_talonario` char(1) DEFAULT NULL,
  `num_talonario` int(4) unsigned zerofill DEFAULT NULL,
  `iva` float NOT NULL,
  KEY `Reffactura_vta26` (`n_factura`,`cod_talonario`,`num_talonario`),
  KEY `Refproducto27` (`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`),
  KEY `Ref2726` (`n_factura`,`num_talonario`,`cod_talonario`),
  KEY `Ref127` (`cod_marca`,`cod_prod`,`cod_grupo`,`cod_variedad`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `factura_vta_detalle` */

insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000001,1,1,1,1,3,21.35,3,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000001,1,2,1,1,10,20.22,2,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000001,1,1,2,1,5,21.36,4.5,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000001,1,1,1,3,75,12,3,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000001,1,1,2,3,6,10,4.5,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000002,1,1,1,5,10,6,5,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000002,1,1,2,5,30,6,3,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000002,1,1,1,1,10,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000002,1,2,1,1,10,20.22,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000002,1,1,2,1,10,21.36,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000002,1,2,2,1,10,61.01,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000002,1,1,1,3,10,12,6,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000003,1,1,1,5,100,6,10,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000004,2,1,1,5,1,800,0,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000003,1,1,1,1,1,21.35,0,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000003,2,1,1,5,1,800,0,'B',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000005,1,1,1,1,3,21.35,5,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000005,1,1,2,1,5,21.36,1,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000005,1,1,1,2,2,28.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000005,2,1,1,5,1,800,0,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000006,1,1,1,1,5,21.35,5,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000006,1,1,2,1,6,21.36,2,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000006,1,1,2,1,6,21.36,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000006,2,1,1,5,1,800,0,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000007,1,1,1,1,4,21.35,25,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000007,2,1,1,5,1,800,4,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000008,1,1,1,1,5,21.35,3,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000008,2,1,1,5,1,800,30,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000008,1,1,2,1,6,21.36,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000009,1,1,1,1,10,21.35,2,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000009,1,1,2,1,2,21.36,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000004,1,1,1,1,10,21.35,0,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000010,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000005,1,1,1,1,10,21.35,6,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000011,1,1,1,1,10,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000012,1,1,1,1,10,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000013,1,1,1,1,10,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000014,1,1,1,1,10,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000015,1,1,1,1,10,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000016,1,1,1,1,10,21.35,1,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000017,1,1,1,1,10,21.35,2,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000018,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000019,1,1,1,1,10,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000020,1,1,1,1,10,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000021,1,1,1,1,10,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000022,1,1,1,2,10,28.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000023,1,1,1,1,10,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000024,1,1,1,1,10,21.35,2,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000025,1,1,1,1,10,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000026,1,1,1,1,10,21.35,2,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000027,1,1,2,1,100,21.36,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000028,1,1,1,1,10,21.35,1,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000029,1,1,1,1,10,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000029,1,1,1,2,5,28.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000029,1,1,2,1,3,21.36,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000030,1,1,1,1,10,21.35,5,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000030,1,1,2,1,2,21.36,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000030,1,1,1,2,3,28.35,2,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000030,1,1,1,3,5,12,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000030,1,1,2,4,4,19,3,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000030,1,1,1,5,9,6,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000006,1,1,1,1,10,21.35,5,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000006,1,1,2,1,2,21.36,0,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000006,1,1,1,2,3,28.35,2,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000006,1,1,1,3,5,12,0,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000006,1,1,2,4,4,19,3,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000006,1,1,1,5,9,6,0,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000031,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000031,2,1,1,5,1,800,0,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000007,1,1,1,1,1,21.35,0,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000007,2,1,1,5,1,800,0,'B',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000032,1,1,1,1,10,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000032,1,1,2,1,10,21.36,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000033,1,1,1,1,10,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000033,1,1,2,1,2,21.36,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000033,1,1,1,2,3,28.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000033,1,1,1,5,1,6,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000034,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000035,1,1,1,1,1,21.35,10,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000035,1,1,2,1,5,21.36,2,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000035,1,1,1,2,10,28.35,3,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000035,1,1,1,3,10,12,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000035,1,1,1,4,10,9,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000008,1,1,1,4,10,9,0,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000008,1,1,2,3,5,10,0,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000008,1,1,1,4,10,9,0,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000008,1,1,1,1,20,21.35,5,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000036,1,1,1,1,10,21.35,5,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000036,1,2,2,1,20,61.01,5,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000036,1,1,1,5,3,6,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000036,1,1,1,3,10,12,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000037,1,1,1,1,10,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000037,1,2,1,1,5,20.22,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000037,1,1,1,2,3,28.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000037,1,1,1,5,3,6,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000038,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000038,2,1,1,5,1,800,0,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000039,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000040,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000040,2,1,1,5,1,800,0,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000041,1,1,1,1,1,21.35,2,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000041,1,1,2,1,2,21.36,1,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000042,1,1,1,1,10,21.35,2,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000042,1,1,1,2,1,28.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000042,1,1,1,3,1,12,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000043,1,1,1,1,1,21.35,1,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000043,1,1,1,2,1,28.35,1,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000044,1,1,1,1,1,21.35,1,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000044,1,1,1,2,1,28.35,1,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000045,1,1,1,1,10,21.35,5,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000045,1,1,1,2,20,28.35,6,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000046,1,1,1,1,10,21.35,5,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000046,1,1,1,2,20,28.35,6,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000047,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000047,1,1,1,2,1,28.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000048,1,1,1,1,10,21.35,1,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000048,1,1,1,2,20,28.35,2,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000048,1,1,1,3,3,12,4,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000049,1,1,1,1,200,21.35,4,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000049,1,1,1,3,200,12,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000049,1,1,1,2,100,28.35,5,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000050,1,1,1,1,12,21.35,3,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000050,1,2,1,1,25,20.22,5,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000051,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000052,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000053,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000054,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000055,2,1,1,5,10,800,0,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000056,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000056,2,1,1,5,1,800,0,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000057,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000057,2,1,1,5,1,800,0,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000058,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000058,2,1,1,5,1,800,0,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000059,1,1,1,1,10,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000059,1,1,2,1,3,21.36,2,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000059,2,1,1,5,2,800,0,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000059,1,1,1,3,4,12,4,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000060,1,1,1,1,10,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000060,1,1,2,1,3,21.36,2,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000060,2,1,1,5,2,800,0,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000060,1,1,1,3,4,12,4,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000061,1,1,1,1,1,21.35,1,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000061,1,1,2,1,1,21.36,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000009,1,1,1,1,1,21.35,1,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000009,1,1,2,1,1,21.36,0,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000062,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000062,1,1,2,1,1,21.36,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000010,1,1,1,1,1,21.35,1,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000010,1,1,2,1,1,21.36,0,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000011,1,1,1,1,1,21.35,1,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000011,1,1,2,1,1,21.36,0,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000063,1,1,1,1,1,21.35,1,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000063,1,1,2,1,1,21.36,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000012,1,1,1,1,1,21.35,1,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000012,1,1,2,1,1,21.36,0,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000013,1,1,1,1,1,21.35,1,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000013,1,1,2,1,1,21.36,0,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000064,1,1,1,1,1,21.35,1,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000064,1,1,2,1,1,21.36,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000065,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000066,1,1,1,1,10,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000066,1,1,2,1,3,21.36,2,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000066,2,1,1,5,2,800,0,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000066,1,1,1,3,4,12,4,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000014,1,1,1,1,10,21.35,0,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000014,1,1,2,1,3,21.36,2,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000014,2,1,1,5,2,800,0,'B',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000014,1,1,1,3,4,12,4,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000067,1,1,1,1,20,21.35,5,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000067,1,1,2,1,3,21.36,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000067,1,1,1,2,4,28.35,5,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000067,2,1,1,5,2,800,0,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000068,2,1,1,5,2,800,0,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000069,2,1,1,5,2,800,0,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000070,1,1,1,1,1,21.35,2,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000070,1,1,2,1,3,21.36,4,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000070,1,1,1,3,1,12,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000070,1,1,1,4,6,9,2,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000070,1,1,1,5,1,6,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000070,2,1,1,5,1,800,0,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000071,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000072,1,1,1,1,1,21.35,1,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000073,1,1,1,1,1,21.35,3,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000073,1,1,2,1,2,21.36,3,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000074,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000074,1,1,2,1,1,21.36,1,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000075,2,1,1,5,2,800,5,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000075,1,1,1,4,10,9,6,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000015,1,1,1,1,1,21.35,0,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000016,1,1,1,1,10,21.35,0,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000016,1,1,2,1,8,21.36,0,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000017,1,1,1,1,1,21.35,0,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000018,1,1,1,1,10,21.35,0,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000019,2,1,1,5,20,800,0,'B',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000076,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000020,1,1,2,1,20,21.36,1,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000077,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000077,2,1,1,5,1,800,0,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000078,1,1,1,1,10,21.35,1,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000079,1,1,1,1,1,21.35,1,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000021,1,1,1,1,1,21.35,1,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000080,1,1,1,1,1,21.35,1,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000022,1,1,1,1,1,21.35,0,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000081,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000082,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000083,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000084,1,1,1,1,1,21.35,0,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000085,2,1,1,5,1,800,0,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000086,1,1,1,1,10,21.35,2,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000086,1,2,1,1,20,20.22,3,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000087,1,1,1,1,1,21.35,0,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000023,1,1,1,1,10,21.35,1,'B',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000024,1,1,1,1,100,21.35,5,'B',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000025,1,1,1,5,200,6,5,'B',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000088,1,1,1,1,10,21.35,0,'A',0001,21);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000089,1,2,1,2,10,28.35,5,'A',0001,10.5);
insert  into `factura_vta_detalle`(`n_factura`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000089,1,1,1,1,10,21.35,10,'A',0001,21);

/*Table structure for table `factura_vta_no_cliente` */

DROP TABLE IF EXISTS `factura_vta_no_cliente`;

CREATE TABLE `factura_vta_no_cliente` (
  `n_factura` int(8) unsigned zerofill NOT NULL,
  `fecha` int(11) NOT NULL,
  `hora_entrega` text,
  `lugar` text,
  `observacion` text,
  `razon_social` text NOT NULL,
  `cod_zona` int(11) DEFAULT NULL,
  `direccion` text NOT NULL,
  `localidad` text NOT NULL,
  `provincia` text,
  `cond_iva` text,
  `cuit` varchar(11) DEFAULT NULL,
  `cod_categoria` int(11) DEFAULT NULL,
  `cod_vendedor` int(11) DEFAULT NULL,
  `cod_repartidor` int(11) DEFAULT NULL,
  `cod_talonario` char(1) NOT NULL,
  `num_talonario` int(4) unsigned zerofill NOT NULL,
  `num_remito` int(11) NOT NULL,
  `iva` float DEFAULT NULL,
  `imp_interno` float DEFAULT NULL,
  `perc_iva` float DEFAULT NULL,
  `ing_bruto` float DEFAULT NULL,
  `usuario` text,
  `cod_fp` int(11) NOT NULL,
  PRIMARY KEY (`n_factura`,`cod_talonario`,`num_talonario`),
  KEY `Reftalonario124` (`cod_talonario`,`num_talonario`),
  KEY `Ref26114` (`cod_fp`),
  KEY `Ref22124` (`num_talonario`,`cod_talonario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `factura_vta_no_cliente` */

/*Table structure for table `factura_vta_no_cliente_detalle` */

DROP TABLE IF EXISTS `factura_vta_no_cliente_detalle`;

CREATE TABLE `factura_vta_no_cliente_detalle` (
  `n_factura` int(8) unsigned zerofill DEFAULT NULL,
  `cod_prod` int(11) DEFAULT NULL,
  `cod_variedad` int(11) DEFAULT NULL,
  `cod_marca` int(11) DEFAULT NULL,
  `cod_grupo` int(11) DEFAULT NULL,
  `cantidad` float NOT NULL,
  `precio` float NOT NULL,
  `bonificacion` float DEFAULT NULL,
  `cod_talonario` char(1) DEFAULT NULL,
  `num_talonario` int(4) unsigned zerofill DEFAULT NULL,
  `iva` float NOT NULL,
  KEY `Reffactura_vta_no_cliente111` (`n_factura`,`cod_talonario`,`num_talonario`),
  KEY `Refproducto112` (`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`),
  KEY `Ref53111` (`n_factura`,`num_talonario`,`cod_talonario`),
  KEY `Ref1112` (`cod_marca`,`cod_prod`,`cod_grupo`,`cod_variedad`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `factura_vta_no_cliente_detalle` */

/*Table structure for table `factura_vta_tmp` */

DROP TABLE IF EXISTS `factura_vta_tmp`;

CREATE TABLE `factura_vta_tmp` (
  `usuario` text,
  `cod_prod` int(11) DEFAULT NULL,
  `descripcion` text,
  `cantidad` float NOT NULL,
  `precio` float NOT NULL,
  `bonificacion` float DEFAULT NULL,
  `importe` float DEFAULT NULL,
  `linea` int(11) DEFAULT NULL,
  `iva` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `factura_vta_tmp` */

/*Table structure for table `fletero` */

DROP TABLE IF EXISTS `fletero`;

CREATE TABLE `fletero` (
  `cod_flero` int(11) NOT NULL,
  `dni` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `domicilio` text,
  `tel` text,
  `cuit` text,
  `cod_localidad` int(11) NOT NULL,
  `cod_prov` int(11) NOT NULL,
  `cod_pais` int(11) NOT NULL,
  `cod_iva` int(11) NOT NULL,
  `cod_talonario` char(1) NOT NULL,
  PRIMARY KEY (`cod_flero`),
  KEY `Ref1716` (`cod_prov`,`cod_localidad`,`cod_pais`),
  KEY `Ref2864` (`cod_talonario`,`cod_iva`),
  KEY `Reflocalidad16` (`cod_localidad`,`cod_prov`,`cod_pais`),
  KEY `Refiva64` (`cod_iva`,`cod_talonario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `fletero` */

insert  into `fletero`(`cod_flero`,`dni`,`nombre`,`domicilio`,`tel`,`cuit`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_iva`,`cod_talonario`) values (1,0,'LUIS ','BÂº ANDRESITO ','03758-15456515','',33,1,1,4,'B');
insert  into `fletero`(`cod_flero`,`dni`,`nombre`,`domicilio`,`tel`,`cuit`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_iva`,`cod_talonario`) values (2,1,'SEVERO ANTUNEZ','B. IRIGOYEN','1','',33,1,1,4,'B');
insert  into `fletero`(`cod_flero`,`dni`,`nombre`,`domicilio`,`tel`,`cuit`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_iva`,`cod_talonario`) values (3,11,'NEVES ','APOSTOLES','15456630','',33,1,1,4,'B');
insert  into `fletero`(`cod_flero`,`dni`,`nombre`,`domicilio`,`tel`,`cuit`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_iva`,`cod_talonario`) values (4,1111,'IBARRA MAURICIO','APOSTOLES','15408158','',33,1,1,4,'B');
insert  into `fletero`(`cod_flero`,`dni`,`nombre`,`domicilio`,`tel`,`cuit`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_iva`,`cod_talonario`) values (6,111111,'PEDRO KLEVET','BARRIO ILLIA MAZ 9 CASA8','15451240','',33,1,1,4,'B');
insert  into `fletero`(`cod_flero`,`dni`,`nombre`,`domicilio`,`tel`,`cuit`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_iva`,`cod_talonario`) values (5,33333333,'MULA','A','1','',33,1,1,4,'B');
insert  into `fletero`(`cod_flero`,`dni`,`nombre`,`domicilio`,`tel`,`cuit`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_iva`,`cod_talonario`) values (7,121211,'JAVIER','BARRIO IRIGOYEN','11111','',33,1,1,4,'B');
insert  into `fletero`(`cod_flero`,`dni`,`nombre`,`domicilio`,`tel`,`cuit`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_iva`,`cod_talonario`) values (8,11111,'DURE DAMIAN JAVIER','APOSTOLES','15408143','',33,1,1,4,'B');
insert  into `fletero`(`cod_flero`,`dni`,`nombre`,`domicilio`,`tel`,`cuit`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_iva`,`cod_talonario`) values (20,11111111,'DEPOSITO','RUTA 201 - KM 40','3758-424181','',33,1,1,4,'B');
insert  into `fletero`(`cod_flero`,`dni`,`nombre`,`domicilio`,`tel`,`cuit`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_iva`,`cod_talonario`) values (9,66666,'NEVES','APOSTOLES','15456630','',25,2,1,4,'B');
insert  into `fletero`(`cod_flero`,`dni`,`nombre`,`domicilio`,`tel`,`cuit`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_iva`,`cod_talonario`) values (10,77777,'NEVES','APOSTOLES','15456630','',47,2,1,4,'B');
insert  into `fletero`(`cod_flero`,`dni`,`nombre`,`domicilio`,`tel`,`cuit`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_iva`,`cod_talonario`) values (11,8888,'NEVES','APOSTOLES','15456630','',24,2,1,4,'B');
insert  into `fletero`(`cod_flero`,`dni`,`nombre`,`domicilio`,`tel`,`cuit`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_iva`,`cod_talonario`) values (12,12,'LUIS','APOSTOLES','03758-15456515','',33,1,1,4,'B');
insert  into `fletero`(`cod_flero`,`dni`,`nombre`,`domicilio`,`tel`,`cuit`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_iva`,`cod_talonario`) values (13,13,'PEDRO','APOSTOLES','0375815451240','',33,1,1,4,'B');
insert  into `fletero`(`cod_flero`,`dni`,`nombre`,`domicilio`,`tel`,`cuit`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_iva`,`cod_talonario`) values (14,14,'IBARRA MAURICIO','APOSTOLES','15408168','',27,1,1,4,'B');
insert  into `fletero`(`cod_flero`,`dni`,`nombre`,`domicilio`,`tel`,`cuit`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_iva`,`cod_talonario`) values (21,21,'VENTA DE DEPOSITO','RUTA 201 - KM 40','424181','',33,1,1,4,'B');
insert  into `fletero`(`cod_flero`,`dni`,`nombre`,`domicilio`,`tel`,`cuit`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_iva`,`cod_talonario`) values (19,19,'VENTA EN DEPOSITO','RTA.201 KM 2','424181','',33,1,1,4,'B');
insert  into `fletero`(`cod_flero`,`dni`,`nombre`,`domicilio`,`tel`,`cuit`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_iva`,`cod_talonario`) values (15,15,'LUIS','APOSTOLES','03758-15456515','',33,1,1,6,'X');
insert  into `fletero`(`cod_flero`,`dni`,`nombre`,`domicilio`,`tel`,`cuit`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_iva`,`cod_talonario`) values (16,16,'SUBRESKI','APOSTOLES','03758-15438088','',33,1,1,6,'X');
insert  into `fletero`(`cod_flero`,`dni`,`nombre`,`domicilio`,`tel`,`cuit`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_iva`,`cod_talonario`) values (17,17,'IBARRA','XXXX','1111111','',49,1,1,6,'X');
insert  into `fletero`(`cod_flero`,`dni`,`nombre`,`domicilio`,`tel`,`cuit`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_iva`,`cod_talonario`) values (18,18,'SUBRESKI MOISES','B. ESTACION ','3758-438088','',33,1,1,6,'X');

/*Table structure for table `fletero_por_vehiculo` */

DROP TABLE IF EXISTS `fletero_por_vehiculo`;

CREATE TABLE `fletero_por_vehiculo` (
  `cod_flero` int(11) NOT NULL,
  `cod_vehiculo` int(11) NOT NULL,
  PRIMARY KEY (`cod_flero`,`cod_vehiculo`),
  KEY `Ref617` (`cod_flero`),
  KEY `Ref718` (`cod_vehiculo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `fletero_por_vehiculo` */

insert  into `fletero_por_vehiculo`(`cod_flero`,`cod_vehiculo`) values (1,1);
insert  into `fletero_por_vehiculo`(`cod_flero`,`cod_vehiculo`) values (2,2);
insert  into `fletero_por_vehiculo`(`cod_flero`,`cod_vehiculo`) values (3,3);
insert  into `fletero_por_vehiculo`(`cod_flero`,`cod_vehiculo`) values (4,4);
insert  into `fletero_por_vehiculo`(`cod_flero`,`cod_vehiculo`) values (5,7);
insert  into `fletero_por_vehiculo`(`cod_flero`,`cod_vehiculo`) values (6,6);
insert  into `fletero_por_vehiculo`(`cod_flero`,`cod_vehiculo`) values (7,5);
insert  into `fletero_por_vehiculo`(`cod_flero`,`cod_vehiculo`) values (8,8);
insert  into `fletero_por_vehiculo`(`cod_flero`,`cod_vehiculo`) values (9,9);
insert  into `fletero_por_vehiculo`(`cod_flero`,`cod_vehiculo`) values (10,9);
insert  into `fletero_por_vehiculo`(`cod_flero`,`cod_vehiculo`) values (11,9);
insert  into `fletero_por_vehiculo`(`cod_flero`,`cod_vehiculo`) values (12,1);
insert  into `fletero_por_vehiculo`(`cod_flero`,`cod_vehiculo`) values (13,6);
insert  into `fletero_por_vehiculo`(`cod_flero`,`cod_vehiculo`) values (14,4);
insert  into `fletero_por_vehiculo`(`cod_flero`,`cod_vehiculo`) values (15,1);
insert  into `fletero_por_vehiculo`(`cod_flero`,`cod_vehiculo`) values (16,21);
insert  into `fletero_por_vehiculo`(`cod_flero`,`cod_vehiculo`) values (17,6);
insert  into `fletero_por_vehiculo`(`cod_flero`,`cod_vehiculo`) values (18,21);
insert  into `fletero_por_vehiculo`(`cod_flero`,`cod_vehiculo`) values (19,21);
insert  into `fletero_por_vehiculo`(`cod_flero`,`cod_vehiculo`) values (20,20);
insert  into `fletero_por_vehiculo`(`cod_flero`,`cod_vehiculo`) values (21,21);

/*Table structure for table `forma_pago` */

DROP TABLE IF EXISTS `forma_pago`;

CREATE TABLE `forma_pago` (
  `cod_fp` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  `observacion` text,
  PRIMARY KEY (`cod_fp`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `forma_pago` */

insert  into `forma_pago`(`cod_fp`,`descripcion`,`observacion`) values (1,'CONTADO','PAGO CONTADO EFECTIVO');
insert  into `forma_pago`(`cod_fp`,`descripcion`,`observacion`) values (2,'CTA CTE','CUENTA CORRIENTE');
insert  into `forma_pago`(`cod_fp`,`descripcion`,`observacion`) values (3,'CTA CTE 7 DIAS','');

/*Table structure for table `gastos` */

DROP TABLE IF EXISTS `gastos`;

CREATE TABLE `gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` int(11) NOT NULL,
  `hora` char(20) NOT NULL,
  `descripcion` text NOT NULL,
  `importe` float NOT NULL,
  `observacion` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `gastos` */

insert  into `gastos`(`id`,`fecha`,`hora`,`descripcion`,`importe`,`observacion`) values (1,20110909,'12:30','desc',10.6,'obs');
insert  into `gastos`(`id`,`fecha`,`hora`,`descripcion`,`importe`,`observacion`) values (2,20110909,'1','desc',12,'obs');
insert  into `gastos`(`id`,`fecha`,`hora`,`descripcion`,`importe`,`observacion`) values (3,20110909,'16:30','TORNILLOS',20,'PARA ESTANTE');

/*Table structure for table `grupo` */

DROP TABLE IF EXISTS `grupo`;

CREATE TABLE `grupo` (
  `cod_grupo` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`cod_grupo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `grupo` */

insert  into `grupo`(`cod_grupo`,`descripcion`) values (1,'DISCO RIGIDO');
insert  into `grupo`(`cod_grupo`,`descripcion`) values (2,'PLACA MADRE');
insert  into `grupo`(`cod_grupo`,`descripcion`) values (4,'PROCESADORES');
insert  into `grupo`(`cod_grupo`,`descripcion`) values (3,'MONITORES');
insert  into `grupo`(`cod_grupo`,`descripcion`) values (5,'IMPRESORAS');
insert  into `grupo`(`cod_grupo`,`descripcion`) values (6,'TECLADOS');
insert  into `grupo`(`cod_grupo`,`descripcion`) values (7,'MOUSE');
insert  into `grupo`(`cod_grupo`,`descripcion`) values (8,'PARLANTES');
insert  into `grupo`(`cod_grupo`,`descripcion`) values (9,'OTROS');
insert  into `grupo`(`cod_grupo`,`descripcion`) values (10,'PENDRIVE');
insert  into `grupo`(`cod_grupo`,`descripcion`) values (11,'JOYSTICK');
insert  into `grupo`(`cod_grupo`,`descripcion`) values (12,'WEBCAM');

/*Table structure for table `imp_interno` */

DROP TABLE IF EXISTS `imp_interno`;

CREATE TABLE `imp_interno` (
  `cod_imp_interno` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text,
  `tasa` float NOT NULL,
  PRIMARY KEY (`cod_imp_interno`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `imp_interno` */

insert  into `imp_interno`(`cod_imp_interno`,`nombre`,`tasa`) values (1,'IMPUESTO INTERNO',0);

/*Table structure for table `ing_bruto` */

DROP TABLE IF EXISTS `ing_bruto`;

CREATE TABLE `ing_bruto` (
  `cod_ing_bruto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text,
  `tasa` float NOT NULL,
  `cod_prov` int(11) NOT NULL,
  `cod_pais` int(11) NOT NULL,
  PRIMARY KEY (`cod_ing_bruto`),
  KEY `Refprovincia133` (`cod_prov`,`cod_pais`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `ing_bruto` */

/*Table structure for table `iva` */

DROP TABLE IF EXISTS `iva`;

CREATE TABLE `iva` (
  `cod_iva` int(11) NOT NULL,
  `cod_talonario` char(1) NOT NULL,
  `nombre` text NOT NULL,
  `cuit` char(1) DEFAULT NULL,
  PRIMARY KEY (`cod_iva`,`cod_talonario`),
  KEY `Ref2598` (`cod_talonario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `iva` */

insert  into `iva`(`cod_iva`,`cod_talonario`,`nombre`,`cuit`) values (6,'B','CONSUMIDOR FINAL','N');
insert  into `iva`(`cod_iva`,`cod_talonario`,`nombre`,`cuit`) values (1,'A','RESP. INSCRIPTO','S');
insert  into `iva`(`cod_iva`,`cod_talonario`,`nombre`,`cuit`) values (2,'B','RESP. MONOTRIBUTO','N');

/*Table structure for table `localidad` */

DROP TABLE IF EXISTS `localidad`;

CREATE TABLE `localidad` (
  `cod_localidad` int(11) NOT NULL AUTO_INCREMENT,
  `cod_prov` int(11) NOT NULL,
  `cod_pais` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `cp` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod_localidad`,`cod_prov`,`cod_pais`),
  KEY `Ref1912` (`cod_pais`,`cod_prov`),
  KEY `Refprovincia12` (`cod_prov`,`cod_pais`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

/*Data for the table `localidad` */

insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (5,1,1,'CERRO AZUL',3313);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (6,1,1,'L.N ALEM',3315);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (7,1,1,'DOS DE MAYO',3364);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (8,1,1,'SAN VICENTE',3364);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (9,1,1,'A. DEL VALLE',3364);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (10,1,1,'CAM.GRANDE',3362);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (11,1,1,'EL SOBERBIO',3364);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (12,1,1,'CAMPO VIERA',3362);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (13,1,1,'CAM.RAMON',3361);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (14,1,1,'VILLA BONITA',3361);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (16,1,1,'CNIA ACARAGUATAY',3386);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (17,1,1,'S.FRANCISO DE ASIS',3363);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (18,1,1,'PANAMBI',3361);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (19,1,1,'9JULIO-A. POSSE, D.25 MAYO-',3363);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (20,1,1,'SANTA RITA',3363);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (21,1,1,'ALBA POSSE',3363);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (22,1,1,'CNIA 25 DE MAYO',3363);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (23,1,1,'OBERA',3360);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (24,2,1,'SANTO TOME',3340);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (25,2,1,'ALVEAR',3344);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (26,2,1,'VIRASORO',3342);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (27,1,1,'SAN JAVIER',3357);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (28,1,1,'AZARA',3351);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (29,2,1,'GARRUCHOS',3351);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (30,1,1,'SAN JOSE',3306);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (31,2,1,'SAN CARLOS',3306);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (32,2,1,'GARABI',3342);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (33,1,1,'APOSTOLES',3350);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (34,2,1,'COL. LIEBIG',3351);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (35,1,1,'C. DE LA SIERRA',3355);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (36,2,1,'ITUZAINGO',3360);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (37,5,1,'CALCHINES',1111);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (38,5,1,'STA. FE',3000);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (39,1,1,'POSADAS',3300);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (40,3,1,'SAENZ PENA',1);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (41,3,1,'PARANA',3100);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (42,3,1,'ENTRE RIOS',3100);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (43,4,1,'CHASCOMUS',7130);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (44,4,1,'BELLA VISTA',1661);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (45,1,1,'ITACARUARE',3353);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (46,1,1,'S.ENCANTADO',3364);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (47,2,1,'LA CRUZ',3346);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (48,1,1,'SAN ANTONIO',3366);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (49,1,1,'GOB. LOPEZ',1111);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (50,1,1,'2 ARROYOS',1111);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (51,1,1,'LA CORITA',1111);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (52,1,1,'COLONIA GUARANI',3309);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (53,1,1,'PARAJE LIBERTAD',3363);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (54,1,1,'PICADA YEPOYA',3361);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (55,4,1,'CAPITAL FEDERAL',1112);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (56,4,1,'SAN JUSTO',1754);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (57,3,1,'FEDERACION',1);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (58,2,1,'LIEBIG',1);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (59,1,1,'3 CAPONES',3353);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (60,2,1,'YAPEYU',1111);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (61,2,1,'GUAVIRAVI',1111);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (62,3,1,'VALLE MARIA',3101);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (63,5,1,'FUNES',2132);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (64,3,1,'CHAJARI',3228);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (65,2,1,'CORRIENTES',3400);
insert  into `localidad`(`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`cp`) values (66,4,1,'LLAVALLOL',1836);

/*Table structure for table `marca` */

DROP TABLE IF EXISTS `marca`;

CREATE TABLE `marca` (
  `cod_marca` int(11) NOT NULL,
  `cod_grupo` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`cod_marca`,`cod_grupo`),
  KEY `Ref1319` (`cod_grupo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `marca` */

insert  into `marca`(`cod_marca`,`cod_grupo`,`descripcion`) values (1,1,'SAMSUNG');
insert  into `marca`(`cod_marca`,`cod_grupo`,`descripcion`) values (2,1,'SEAGATE');
insert  into `marca`(`cod_marca`,`cod_grupo`,`descripcion`) values (1,2,'ASUS');
insert  into `marca`(`cod_marca`,`cod_grupo`,`descripcion`) values (2,2,'GIGABYTE');
insert  into `marca`(`cod_marca`,`cod_grupo`,`descripcion`) values (1,3,'WIESONIC');
insert  into `marca`(`cod_marca`,`cod_grupo`,`descripcion`) values (2,3,'SAMSUNG');
insert  into `marca`(`cod_marca`,`cod_grupo`,`descripcion`) values (1,4,'INTEL');
insert  into `marca`(`cod_marca`,`cod_grupo`,`descripcion`) values (2,4,'AMD');
insert  into `marca`(`cod_marca`,`cod_grupo`,`descripcion`) values (1,5,'EPSON');
insert  into `marca`(`cod_marca`,`cod_grupo`,`descripcion`) values (2,5,'HP');

/*Table structure for table `medida` */

DROP TABLE IF EXISTS `medida`;

CREATE TABLE `medida` (
  `cod_medida` int(11) NOT NULL AUTO_INCREMENT,
  `unidad_de_medida` text NOT NULL,
  PRIMARY KEY (`cod_medida`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `medida` */

insert  into `medida`(`cod_medida`,`unidad_de_medida`) values (1,'CM3');

/*Table structure for table `pais` */

DROP TABLE IF EXISTS `pais`;

CREATE TABLE `pais` (
  `cod_pais` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  PRIMARY KEY (`cod_pais`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `pais` */

insert  into `pais`(`cod_pais`,`nombre`) values (1,'ARGENTINA');
insert  into `pais`(`cod_pais`,`nombre`) values (7,'BRASIL');
insert  into `pais`(`cod_pais`,`nombre`) values (8,'EEUU');

/*Table structure for table `pedidos` */

DROP TABLE IF EXISTS `pedidos`;

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `id_dep` int(11) NOT NULL,
  `codigo` int(11) DEFAULT NULL,
  `cant` float DEFAULT NULL,
  `peso` float DEFAULT NULL,
  `tipo` char(1) DEFAULT NULL,
  `estado` char(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `pedidos` */

insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (1,'<b>Pedido N&ordm; 1827</b>',0,1827,0,0,'P','F');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (2,'Vendedor N&ordm; 1',1,1,0,0,'V','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (3,'Ped. 1: Cliente N&ordm; 9018',2,9018,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (4,'Art. 3111 - Cant: 12.00',3,3111,12,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (5,'Ped. 2: Cliente N&ordm; 9254',2,9254,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (6,'Art. 1111 - Cant: 20.00',5,1111,20,3,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (7,'Art. 1112 - Cant: 30.00',5,1112,30,5,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (8,'Art. 1113 - Cant: 40.00',5,1113,40,8,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (9,'Art. 1114 - Cant: 50.00',5,1114,50,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (10,'<b>Pedido N&ordm; 1902</b>',0,1902,0,0,'P','F');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (11,'Vendedor N&ordm; 1',10,1,0,0,'V','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (12,'Ped. 1: Cliente N&ordm; 9016',11,9016,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (13,'Art. 13211 - Cant: 1.00',12,13211,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (14,'<b>Pedido N&ordm; 1052</b>',0,1052,0,0,'P','F');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (15,'Vendedor N&ordm; 1',14,1,0,0,'V','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (16,'Ped. 1: Cliente N&ordm; 9016',15,9016,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (17,'Art. 1111 - Cant: 2.00',16,1111,2,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (18,'Art. 1112 - Cant: 5.00',16,1112,5,25,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (19,'Art. 1113 - Cant: 3.00',16,1113,3,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (20,'Art. 1113 - Cant: 4.00',16,1113,4,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (21,'Art. 12111 - Cant: 1.00',16,12111,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (22,'Ped. 2: Cliente N&ordm; 9119',15,9119,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (23,'Art. 2111 - Cant: 9.00',22,2111,9,3,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (24,'Art. 2113 - Cant: 6.00',22,2113,6,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (25,'Art. 2114 - Cant: 10.00',22,2114,10,6,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (26,'Ped. 3: Cliente N&ordm; 9210',15,9210,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (27,'Art. 1111 - Cant: 0.50',26,1111,0.5,5,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (28,'Art. 1112 - Cant: 20.00',26,1112,20,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (29,'Art. 1113 - Cant: 3.50',26,1113,3.5,10,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (30,'Ped. 4: Cliente N&ordm; 9737',15,9737,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (31,'Art. 7711 - Cant: 2.00',30,7711,2,50,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (32,'Art. 21011 - Cant: 6.00',30,21011,6,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (33,'Art. 21021 - Cant: 2.00',30,21021,2,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (34,'Art. 71014 - Cant: 4.00',30,71014,4,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (35,'Art. 1111 - Cant: 3.00',30,1111,3,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (36,'Ped. 5: Cliente N&ordm; 9739',15,9739,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (37,'Art. 7911 - Cant: 2.00',36,7911,2,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (38,'<b>Pedido N&ordm; 1117</b>',0,1117,0,0,'P','F');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (39,'Vendedor N&ordm; 1',38,1,0,0,'V','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (40,'Ped. 1: Cliente N&ordm; 9259',39,9259,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (41,'Art. 1111 - Cant: 1.00',40,1111,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (42,'Art. 1112 - Cant: 2.00',40,1112,2,5,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (43,'Art. 1113 - Cant: 3.00',40,1113,3,1,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (44,'<b>Pedido N&ordm; 1133</b>',0,1133,0,0,'P','F');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (45,'Vendedor N&ordm; 1',44,1,0,0,'V','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (46,'Ped. 1: Cliente N&ordm; 9015',45,9015,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (47,'Art. 3111 - Cant: 3.00',46,3111,3,10,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (48,'Ped. 2: Cliente N&ordm; 9018',45,9018,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (49,'Art. 2211 - Cant: 30.00',48,2211,30,2,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (50,'Art. 2112 - Cant: 23.00',48,2112,23,6,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (51,'Ped. 3: Cliente N&ordm; 9254',45,9254,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (52,'Art. 1111 - Cant: 5.00',51,1111,5,2,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (53,'Art. 1112 - Cant: 10.00',51,1112,10,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (54,'<b>Pedido N&ordm; 1643</b>',0,1643,0,0,'P','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (55,'Vendedor N&ordm; 1',54,1,0,0,'V','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (56,'Ped. 1: Cliente N&ordm; 9119',55,9119,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (57,'Art. 5215 - Cant: 10.00',56,5215,10,5,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (58,'Art. 71632 - Cant: 1.00',56,71632,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (59,'<b>Pedido N&ordm; 0823</b>',0,823,0,0,'P','F');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (60,'Vendedor N&ordm; 1',59,1,0,0,'V','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (61,'Ped. 1: Cliente N&ordm; 9003',60,9003,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (62,'Art. 1111 - Cant: 5.00',61,1111,5,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (63,'Art. 3111 - Cant: 5.00',61,3111,5,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (64,'Art. 3112 - Cant: 5.00',61,3112,5,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (65,'Art. 3115 - Cant: 3.00',61,3115,3,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (66,'Art. 3116 - Cant: 3.00',61,3116,3,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (67,'Art. 3117 - Cant: 3.00',61,3117,3,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (68,'Art. 3118 - Cant: 5.00',61,3118,5,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (69,'Art. 3121 - Cant: 1.00',61,3121,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (70,'Art. 3122 - Cant: 1.00',61,3122,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (71,'Art. 3123 - Cant: 1.00',61,3123,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (72,'Art. 3124 - Cant: 1.00',61,3124,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (73,'Art. 3125 - Cant: 1.00',61,3125,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (74,'Art. 3127 - Cant: 1.00',61,3127,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (75,'Art. 3128 - Cant: 1.00',61,3128,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (76,'Art. 3131 - Cant: 1.00',61,3131,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (77,'Art. 3132 - Cant: 1.00',61,3132,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (78,'Art. 3133 - Cant: 1.00',61,3133,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (79,'Art. 3134 - Cant: 1.00',61,3134,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (80,'Art. 3137 - Cant: 1.00',61,3137,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (81,'Art. 3138 - Cant: 1.00',61,3138,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (82,'Art. 3212 - Cant: 2.00',61,3212,2,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (83,'Art. 3215 - Cant: 3.00',61,3215,3,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (84,'Art. 3216 - Cant: 3.00',61,3216,3,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (85,'Art. 6211 - Cant: 3.00',61,6211,3,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (86,'Art. 4211 - Cant: 2.00',61,4211,2,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (87,'Art. 6111 - Cant: 4.00',61,6111,4,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (88,'Art. 6114 - Cant: 1.00',61,6114,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (89,'Art. 6116 - Cant: 1.00',61,6116,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (90,'Art. 5311 - Cant: 8.00',61,5311,8,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (91,'Art. 5312 - Cant: 8.00',61,5312,8,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (92,'Art. 5313 - Cant: 8.00',61,5313,8,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (93,'Art. 5314 - Cant: 8.00',61,5314,8,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (94,'Art. 5315 - Cant: 8.00',61,5315,8,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (95,'Art. 5316 - Cant: 8.00',61,5316,8,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (96,'Art. 6214 - Cant: 1.00',61,6214,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (97,'Art. 2112 - Cant: 4.00',61,2112,4,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (98,'Art. 2132 - Cant: 1.00',61,2132,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (99,'Art. 2122 - Cant: 3.00',61,2122,3,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (100,'Art. 2311 - Cant: 2.00',61,2311,2,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (101,'Art. 2313 - Cant: 1.00',61,2313,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (102,'Art. 2315 - Cant: 1.00',61,2315,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (103,'Art. 2316 - Cant: 1.00',61,2316,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (104,'Art. 2411 - Cant: 5.00',61,2411,5,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (105,'Art. 2611 - Cant: 6.00',61,2611,6,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (106,'Art. 2822 - Cant: 6.00',61,2822,6,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (107,'Art. 2814 - Cant: 6.00',61,2814,6,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (108,'Art. 2813 - Cant: 6.00',61,2813,6,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (109,'Art. 2811 - Cant: 6.00',61,2811,6,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (110,'Art. 2815 - Cant: 6.00',61,2815,6,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (111,'Art. 6313 - Cant: 1.00',61,6313,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (112,'Art. 6312 - Cant: 2.00',61,6312,2,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (113,'Art. 6322 - Cant: 2.00',61,6322,2,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (114,'Art. 6332 - Cant: 2.00',61,6332,2,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (115,'Art. 6361 - Cant: 2.00',61,6361,2,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (116,'Ped. 2: Cliente N&ordm; 9040',60,9040,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (117,'Art. 1113 - Cant: 1.00',116,1113,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (118,'Art. 3117 - Cant: 1.00',116,3117,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (119,'Art. 6212 - Cant: 1.00',116,6212,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (120,'Art. 6222 - Cant: 1.00',116,6222,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (121,'Art. 6111 - Cant: 1.00',116,6111,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (122,'Art. 6116 - Cant: 1.00',116,6116,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (123,'Ped. 3: Cliente N&ordm; 9223',60,9223,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (124,'Art. 1111 - Cant: 1.00',123,1111,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (125,'Ped. 4: Cliente N&ordm; 9259',60,9259,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (126,'Art. 1111 - Cant: 5.00',125,1111,5,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (127,'Art. 1112 - Cant: 2.00',125,1112,2,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (128,'Art. 1114 - Cant: 1.00',125,1114,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (129,'<b>Pedido N&ordm; 1445</b>',0,1445,0,0,'P','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (130,'Vendedor N&ordm; 1',129,1,0,0,'V','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (131,'Ped. 1: Cliente N&ordm; 9023',130,9023,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (132,'Art. 1111 - Cant: 1.00',131,1111,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (133,'Art. 2123 - Cant: 1.00',131,2123,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (134,'Ped. 2: Cliente N&ordm; 9041',130,9041,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (135,'Art. 1711 - Cant: 1.00',134,1711,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (136,'Art. 6213 - Cant: 1.00',134,6213,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (137,'Art. 6121 - Cant: 2.00',134,6121,2,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (138,'Art. 6313 - Cant: 1.00',134,6313,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (139,'Ped. 3: Cliente N&ordm; 9045',130,9045,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (140,'Art. 1111 - Cant: 15.00',139,1111,15,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (141,'Art. 1112 - Cant: 1.00',139,1112,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (142,'Art. 1113 - Cant: 1.00',139,1113,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (143,'Art. 1211 - Cant: 2.00',139,1211,2,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (144,'Art. 1213 - Cant: 1.00',139,1213,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (145,'Art. 1711 - Cant: 2.00',139,1711,2,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (146,'Art. 1312 - Cant: 1.00',139,1312,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (147,'Art. 6111 - Cant: 1.00',139,6111,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (148,'Art. 6114 - Cant: 1.00',139,6114,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (149,'Art. 6112 - Cant: 1.00',139,6112,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (150,'Art. 6116 - Cant: 1.00',139,6116,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (151,'Art. 6113 - Cant: 1.00',139,6113,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (152,'Ped. 4: Cliente N&ordm; 9062',130,9062,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (153,'Art. 6212 - Cant: 2.00',152,6212,2,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (154,'Art. 6213 - Cant: 1.00',152,6213,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (155,'Art. 6116 - Cant: 1.00',152,6116,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (156,'Ped. 5: Cliente N&ordm; 9063',130,9063,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (157,'Art. 1111 - Cant: 1.00',156,1111,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (158,'Art. 2123 - Cant: 1.00',156,2123,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (159,'Ped. 6: Cliente N&ordm; 9067',130,9067,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (160,'Art. 1111 - Cant: 1.00',159,1111,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (161,'Art. 1211 - Cant: 1.00',159,1211,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (162,'Art. 3121 - Cant: 1.00',159,3121,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (163,'Art. 3122 - Cant: 1.00',159,3122,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (164,'Art. 3123 - Cant: 1.00',159,3123,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (165,'Art. 3127 - Cant: 1.00',159,3127,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (166,'Art. 3131 - Cant: 1.00',159,3131,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (167,'Art. 3132 - Cant: 1.00',159,3132,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (168,'Art. 3133 - Cant: 1.00',159,3133,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (169,'Art. 6212 - Cant: 1.00',159,6212,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (170,'Art. 6213 - Cant: 1.00',159,6213,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (171,'Art. 6111 - Cant: 1.00',159,6111,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (172,'Art. 6114 - Cant: 1.00',159,6114,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (173,'Art. 5312 - Cant: 1.00',159,5312,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (174,'Art. 5316 - Cant: 1.00',159,5316,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (175,'Art. 5313 - Cant: 1.00',159,5313,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (176,'Art. 2111 - Cant: 1.00',159,2111,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (177,'Ped. 7: Cliente N&ordm; 9075',130,9075,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (178,'Art. 1111 - Cant: 4.00',177,1111,4,3,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (179,'Art. 1211 - Cant: 1.00',177,1211,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (180,'Art. 1911 - Cant: 3.00',177,1911,3,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (181,'Art. 1711 - Cant: 1.00',177,1711,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (182,'Ped. 8: Cliente N&ordm; 9095',130,9095,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (183,'Art. 1111 - Cant: 3.00',182,1111,3,3,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (184,'Art. 3113 - Cant: 1.00',182,3113,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (185,'Art. 3114 - Cant: 1.00',182,3114,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (186,'Art. 3117 - Cant: 1.00',182,3117,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (187,'Art. 3118 - Cant: 1.00',182,3118,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (188,'Art. 3122 - Cant: 1.00',182,3122,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (189,'Art. 3123 - Cant: 1.00',182,3123,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (190,'Art. 3137 - Cant: 1.00',182,3137,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (191,'Art. 3138 - Cant: 1.00',182,3138,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (192,'Art. 3211 - Cant: 1.00',182,3211,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (193,'Art. 3212 - Cant: 1.00',182,3212,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (194,'Art. 3214 - Cant: 1.00',182,3214,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (195,'Art. 3218 - Cant: 1.00',182,3218,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (196,'Art. 4111 - Cant: 1.00',182,4111,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (197,'Art. 4121 - Cant: 1.00',182,4121,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (198,'Art. 6211 - Cant: 1.00',182,6211,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (199,'Art. 6111 - Cant: 1.00',182,6111,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (200,'Art. 5312 - Cant: 1.00',182,5312,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (201,'Art. 5316 - Cant: 1.00',182,5316,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (202,'Art. 5311 - Cant: 1.00',182,5311,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (203,'Art. 5315 - Cant: 1.00',182,5315,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (204,'Art. 5314 - Cant: 1.00',182,5314,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (205,'Art. 5313 - Cant: 1.00',182,5313,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (206,'Art. 2132 - Cant: 1.00',182,2132,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (207,'Art. 2211 - Cant: 1.00',182,2211,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (208,'Art. 6322 - Cant: 1.00',182,6322,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (209,'Ped. 9: Cliente N&ordm; 9096',130,9096,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (210,'Art. 3123 - Cant: 1.00',209,3123,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (211,'Art. 3127 - Cant: 1.00',209,3127,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (212,'Art. 3128 - Cant: 1.00',209,3128,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (213,'Art. 3133 - Cant: 1.00',209,3133,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (214,'Art. 3137 - Cant: 1.00',209,3137,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (215,'Art. 3138 - Cant: 1.00',209,3138,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (216,'Art. 6123 - Cant: 1.00',209,6123,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (217,'Art. 6114 - Cant: 1.00',209,6114,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (218,'Art. 6112 - Cant: 1.00',209,6112,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (219,'Art. 6116 - Cant: 1.00',209,6116,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (220,'Art. 6214 - Cant: 1.00',209,6214,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (221,'Art. 6313 - Cant: 1.00',209,6313,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (222,'Art. 6332 - Cant: 1.00',209,6332,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (223,'Ped. 10: Cliente N&ordm; 9240',130,9240,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (224,'Art. 1111 - Cant: 10.00',223,1111,10,5,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (225,'Art. 1211 - Cant: 2.00',223,1211,2,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (226,'Art. 2111 - Cant: 1.00',223,2111,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (227,'Art. 2212 - Cant: 1.00',223,2212,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (228,'Art. 2311 - Cant: 1.00',223,2311,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (229,'Art. 2315 - Cant: 1.00',223,2315,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (230,'Ped. 11: Cliente N&ordm; 9253',130,9253,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (231,'Art. 1111 - Cant: 4.00',230,1111,4,3,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (232,'Art. 1211 - Cant: 1.00',230,1211,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (233,'Art. 6212 - Cant: 1.00',230,6212,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (234,'Art. 6312 - Cant: 1.00',230,6312,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (235,'Ped. 12: Cliente N&ordm; 9267',130,9267,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (236,'Art. 1111 - Cant: 1.00',235,1111,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (237,'Ped. 13: Cliente N&ordm; 9301',130,9301,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (238,'Art. 1213 - Cant: 1.00',237,1213,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (239,'Art. 6212 - Cant: 1.00',237,6212,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (240,'Art. 6213 - Cant: 1.00',237,6213,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (241,'Art. 2111 - Cant: 1.00',237,2111,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (242,'Art. 2112 - Cant: 1.00',237,2112,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (243,'Art. 2316 - Cant: 2.00',237,2316,2,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (244,'Ped. 14: Cliente N&ordm; 9510',130,9510,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (245,'Art. 1111 - Cant: 1.00',244,1111,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (246,'Ped. 15: Cliente N&ordm; 9520',130,9520,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (247,'Art. 3131 - Cant: 1.00',246,3131,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (248,'Art. 2311 - Cant: 1.00',246,2311,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (249,'Ped. 16: Cliente N&ordm; 9524',130,9524,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (250,'Art. 1911 - Cant: 1.00',249,1911,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (251,'Ped. 17: Cliente N&ordm; 9527',130,9527,0,0,'C','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (252,'Art. 1111 - Cant: 5.00',251,1111,5,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (253,'Art. 2113 - Cant: 1.00',251,2113,1,0,'A','-');
insert  into `pedidos`(`id`,`nombre`,`id_dep`,`codigo`,`cant`,`peso`,`tipo`,`estado`) values (254,'Art. 2111 - Cant: 2.00',251,2111,2,0,'A','-');

/*Table structure for table `perc_iva` */

DROP TABLE IF EXISTS `perc_iva`;

CREATE TABLE `perc_iva` (
  `cod_perc_iva` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` text,
  `tasa` float NOT NULL,
  PRIMARY KEY (`cod_perc_iva`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `perc_iva` */

insert  into `perc_iva`(`cod_perc_iva`,`nombre`,`tasa`) values (1,'PERCEP.DE IVA RES. 3337',0);

/*Table structure for table `presupuesto_vta` */

DROP TABLE IF EXISTS `presupuesto_vta`;

CREATE TABLE `presupuesto_vta` (
  `n_presupuesto` int(8) unsigned zerofill NOT NULL,
  `fecha` int(11) NOT NULL,
  `hora_entrega` text,
  `lugar` text,
  `observacion` text,
  `cod_categoria` int(11) NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `cod_zona` int(11) NOT NULL,
  `cod_localidad` int(11) NOT NULL,
  `cod_prov` int(11) NOT NULL,
  `cod_pais` int(11) NOT NULL,
  `num_remito` int(8) unsigned zerofill NOT NULL,
  `cod_talonario` char(1) NOT NULL,
  `num_talonario` int(4) unsigned zerofill NOT NULL,
  `cod_vendedor` int(11) DEFAULT NULL,
  `cod_repartidor` int(11) DEFAULT NULL,
  `iva` float DEFAULT NULL,
  `imp_interno` float DEFAULT NULL,
  `perc_iva` float DEFAULT NULL,
  `ing_bruto` float DEFAULT NULL,
  `usuario` text,
  `cod_fp` int(11) NOT NULL,
  PRIMARY KEY (`n_presupuesto`,`cod_talonario`,`num_talonario`),
  KEY `Refcliente32` (`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`),
  KEY `Ref532` (`cod_prov`,`cod_zona`,`cod_pais`,`cod_localidad`,`cod_cliente`),
  KEY `Ref2433` (`num_remito`),
  KEY `Ref2236` (`cod_talonario`,`num_talonario`),
  KEY `Ref26115` (`cod_fp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `presupuesto_vta` */

insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000001,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000001,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000002,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000003,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000004,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000005,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000006,20110909,'','','',1,4,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',1);
insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000002,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000007,20110909,'','','',1,4,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',1);
insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000008,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000009,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000003,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000010,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000004,20110909,'','','',1,2,5,33,1,1,00000000,'B',0001,1,1,0,0,0,0,'admin',1);
insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000011,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000012,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000013,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000014,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000015,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000016,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000017,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);
insert  into `presupuesto_vta`(`n_presupuesto`,`fecha`,`hora_entrega`,`lugar`,`observacion`,`cod_categoria`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`num_remito`,`cod_talonario`,`num_talonario`,`cod_vendedor`,`cod_repartidor`,`iva`,`imp_interno`,`perc_iva`,`ing_bruto`,`usuario`,`cod_fp`) values (00000018,20110909,'','','',1,1,5,33,1,1,00000000,'A',0001,1,1,0,0,0,0,'admin',3);

/*Table structure for table `presupuesto_vta_detalle` */

DROP TABLE IF EXISTS `presupuesto_vta_detalle`;

CREATE TABLE `presupuesto_vta_detalle` (
  `n_presupuesto` int(8) unsigned zerofill DEFAULT NULL,
  `cod_prod` int(11) DEFAULT NULL,
  `cod_variedad` int(11) DEFAULT NULL,
  `cod_marca` int(11) DEFAULT NULL,
  `cod_grupo` int(11) DEFAULT NULL,
  `cantidad` float NOT NULL,
  `precio` float NOT NULL,
  `bonificacion` float DEFAULT NULL,
  `cod_talonario` char(1) DEFAULT NULL,
  `num_talonario` int(4) unsigned zerofill DEFAULT NULL,
  `iva` float NOT NULL,
  KEY `Reffactura_vta26` (`n_presupuesto`,`cod_talonario`,`num_talonario`),
  KEY `Refproducto27` (`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`),
  KEY `Ref2726` (`n_presupuesto`,`num_talonario`,`cod_talonario`),
  KEY `Ref127` (`cod_marca`,`cod_prod`,`cod_grupo`,`cod_variedad`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `presupuesto_vta_detalle` */

insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000001,1,1,1,1,10,21.35,0,'A',0001,21);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000001,1,2,1,1,555,20.22,6,'A',0001,10.5);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000001,1,2,1,1,100,20.22,5,'B',0001,10.5);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000002,1,1,2,1,32,21.36,0,'A',0001,10.5);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000003,1,1,1,1,52,21.35,0,'A',0001,21);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000004,1,1,1,1,5,21.35,0,'A',0001,21);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000005,1,1,1,1,5,21.35,0,'A',0001,21);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000006,1,1,1,1,100,21.35,50,'A',0001,21);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000002,1,1,1,1,10,21.35,0,'B',0001,21);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000007,1,2,1,1,20,20.22,0,'A',0001,10.5);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000007,1,1,1,1,10,21.35,0,'A',0001,21);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000008,1,1,1,1,1,21.35,0,'A',0001,21);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000009,1,1,1,1,1,21.35,0,'A',0001,21);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000003,1,1,1,1,10,21.35,0,'B',0001,21);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000010,1,1,1,1,10,21.35,0,'A',0001,21);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000004,1,1,1,1,20,21.35,0,'B',0001,21);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000011,1,1,1,1,20,21.35,0,'A',0001,21);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000012,1,1,1,1,1,21.35,0,'A',0001,21);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000013,1,1,1,1,10,21.35,0,'A',0001,21);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000014,1,1,1,1,500,21.35,0,'A',0001,21);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000015,1,1,1,1,20,21.35,0,'A',0001,21);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000016,1,1,1,1,10,21.35,0,'A',0001,21);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000017,1,1,1,1,12,21.35,0,'A',0001,21);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000018,1,2,1,1,52,20.22,3,'A',0001,10.5);
insert  into `presupuesto_vta_detalle`(`n_presupuesto`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`,`cod_talonario`,`num_talonario`,`iva`) values (00000018,1,1,1,1,10,21.35,5,'A',0001,21);

/*Table structure for table `presupuesto_vta_no_cliente` */

DROP TABLE IF EXISTS `presupuesto_vta_no_cliente`;

CREATE TABLE `presupuesto_vta_no_cliente` (
  `n_presupuesto` int(8) unsigned zerofill NOT NULL,
  `fecha` int(11) NOT NULL,
  `hora_entrega` text,
  `lugar` text,
  `observacion` text,
  `razon_social` text NOT NULL,
  `cod_zona` int(11) DEFAULT NULL,
  `direccion` text NOT NULL,
  `localidad` text NOT NULL,
  `provincia` text,
  `cond_iva` text,
  `cuit` varchar(11) DEFAULT NULL,
  `cod_categoria` int(11) DEFAULT NULL,
  `cod_vendedor` int(11) DEFAULT NULL,
  `cod_repartidor` int(11) DEFAULT NULL,
  `cod_talonario` char(1) NOT NULL,
  `num_talonario` int(4) unsigned zerofill NOT NULL,
  `num_remito` int(11) NOT NULL,
  `iva` float DEFAULT NULL,
  `imp_interno` float DEFAULT NULL,
  `perc_iva` float DEFAULT NULL,
  `ing_bruto` float DEFAULT NULL,
  `usuario` text,
  `cod_fp` int(11) NOT NULL,
  PRIMARY KEY (`n_presupuesto`,`cod_talonario`,`num_talonario`),
  KEY `Reftalonario124` (`cod_talonario`,`num_talonario`),
  KEY `Ref26114` (`cod_fp`),
  KEY `Ref22124` (`num_talonario`,`cod_talonario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `presupuesto_vta_no_cliente` */

/*Table structure for table `presupuesto_vta_no_cliente_detalle` */

DROP TABLE IF EXISTS `presupuesto_vta_no_cliente_detalle`;

CREATE TABLE `presupuesto_vta_no_cliente_detalle` (
  `n_presupuesto` int(8) unsigned zerofill DEFAULT NULL,
  `cod_prod` int(11) DEFAULT NULL,
  `cod_variedad` int(11) DEFAULT NULL,
  `cod_marca` int(11) DEFAULT NULL,
  `cod_grupo` int(11) DEFAULT NULL,
  `cantidad` float NOT NULL,
  `precio` float NOT NULL,
  `bonificacion` float DEFAULT NULL,
  `cod_talonario` char(1) DEFAULT NULL,
  `num_talonario` int(4) unsigned zerofill DEFAULT NULL,
  `iva` float NOT NULL,
  KEY `Reffactura_vta_no_cliente111` (`n_presupuesto`,`cod_talonario`,`num_talonario`),
  KEY `Refproducto112` (`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`),
  KEY `Ref53111` (`n_presupuesto`,`num_talonario`,`cod_talonario`),
  KEY `Ref1112` (`cod_marca`,`cod_prod`,`cod_grupo`,`cod_variedad`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `presupuesto_vta_no_cliente_detalle` */

/*Table structure for table `presupuesto_vta_tmp` */

DROP TABLE IF EXISTS `presupuesto_vta_tmp`;

CREATE TABLE `presupuesto_vta_tmp` (
  `usuario` text,
  `cod_prod` int(11) DEFAULT NULL,
  `descripcion` text,
  `cantidad` float NOT NULL,
  `precio` float NOT NULL,
  `bonificacion` float DEFAULT NULL,
  `importe` float DEFAULT NULL,
  `linea` int(11) DEFAULT NULL,
  `iva` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `presupuesto_vta_tmp` */

/*Table structure for table `prod_por_categ` */

DROP TABLE IF EXISTS `prod_por_categ`;

CREATE TABLE `prod_por_categ` (
  `cod_categoria` int(11) NOT NULL,
  `cod_prod` int(11) NOT NULL,
  `cod_variedad` int(11) NOT NULL,
  `cod_marca` int(11) NOT NULL,
  `cod_grupo` int(11) NOT NULL,
  `precio_vta` float NOT NULL,
  PRIMARY KEY (`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`),
  KEY `Ref410` (`cod_categoria`),
  KEY `Ref170` (`cod_variedad`,`cod_prod`,`cod_grupo`,`cod_marca`),
  KEY `Refproducto70` (`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `prod_por_categ` */

insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (1,1,1,1,1,21.35);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (1,1,1,2,1,21.36);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (1,1,1,1,2,28.35);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (1,1,2,1,2,28.35);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (1,1,1,2,2,28.35);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (1,1,2,2,2,28.35);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (1,1,1,1,3,12);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (1,1,2,1,3,8);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (1,2,1,1,5,800);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (1,1,1,2,5,6);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (1,1,1,2,3,10);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (1,1,1,1,5,6);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (1,1,1,1,4,9);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (1,1,2,1,4,8);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (1,1,1,2,4,19);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (1,1,2,2,3,32);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (2,1,2,2,3,25.76);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (1,1,2,2,1,61.01);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (2,1,2,2,1,70.2);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (2,2,1,1,5,725);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (2,1,2,2,2,24.57);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (2,1,2,1,4,19.84);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (2,1,2,1,3,21.17);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (2,1,2,1,2,24.57);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (1,1,2,2,5,65);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (2,1,2,2,5,1.45);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (1,1,2,1,5,6);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (2,1,2,1,5,72.5);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (1,1,2,2,4,23);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (2,1,2,2,4,24.15);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (2,1,1,2,5,27.4);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (2,1,1,2,4,19.84);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (2,1,1,2,3,21.17);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (2,1,1,2,2,24.57);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (2,1,1,2,1,24.57);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (2,1,1,1,5,27.4);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (2,1,1,1,4,19.84);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (2,1,1,1,3,21.17);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (2,1,1,1,2,24.57);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (2,1,1,1,1,24.57);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (1,1,2,1,1,20.22);
insert  into `prod_por_categ`(`cod_categoria`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`precio_vta`) values (2,1,2,1,1,23.27);

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `cod_prod` int(11) NOT NULL,
  `cod_variedad` int(11) NOT NULL,
  `cod_marca` int(11) NOT NULL,
  `cod_grupo` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `precio_costo` float NOT NULL,
  `envase` char(2) NOT NULL,
  `stock_actual` float NOT NULL,
  `stock_min` float NOT NULL,
  `stock_max` float DEFAULT NULL,
  `foto` text NOT NULL,
  `cod_proveedor` int(11) NOT NULL,
  `medida` float NOT NULL,
  `cod_medida` int(11) NOT NULL,
  `porc_vta` float NOT NULL,
  `porc_transporte` float NOT NULL,
  `unidad_bulto` int(11) NOT NULL,
  `peso` float NOT NULL,
  `activo` varchar(1) NOT NULL,
  `cod_iva` int(11) NOT NULL,
  PRIMARY KEY (`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`),
  KEY `Ref23` (`cod_marca`,`cod_variedad`,`cod_grupo`),
  KEY `Ref3350` (`cod_proveedor`),
  KEY `Ref1077` (`cod_medida`),
  KEY `Refvariedad3` (`cod_variedad`,`cod_marca`,`cod_grupo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `producto` */

insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,1,1,1,'SAMSUNG-SATA',18.9,'SI',3810.75,1,1,'N',1,970,1,1.25,3,12,25,'S',1);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,1,2,1,'SEAGATE-SATA',18.9,'SI',117.25,1,1,'N',4,970,1,1.25,3,12,25,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,1,1,2,'ASUS-FSB 800',18.9,'NO',587.5,1,1,'N',7,930,1,1.25,3,8,11.29,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,2,1,2,'ASUS-FSB 1600',18.9,'NO',271.5,1,1,'N',6,930,1,1.25,3,8,15,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,3,1,2,'NATIVO 8 X 1 BLANCO',18.9,'NO',63,1,1,'N',2,930,1,1.25,3,8,15,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,1,2,2,'GIGABYTE-FSB 800',18.9,'NO',412,1,1,'N',6,1000,1,1.25,3,12,20,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,2,2,2,'GIGABYTE-FSB 1600',18.9,'NO',31.5,1,1,'N',4,1000,1,1.25,3,12,20,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,3,2,2,'TORO 12 X 1 BLANCO',18.9,'NO',79,1,1,'N',2,1000,1,1.25,3,12,20,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,1,1,3,'SAMSUNG-LCD',18.9,'NO',-152,1,1,'N',1,2125,1,1.25,3,6,21,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,2,1,3,'SAMSUNG-CRT',18.9,'NO',269.25,1,1,'N',5,1000,1,1.25,3,6,10,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,3,1,3,'TUBITO 6 X 350 COLA',18.9,'NO',433,1,1,'N',4,350,1,1.25,3,6,6,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,1,2,5,'EPSON-LASER',18.9,'NO',480.5,1,1,'N',1,500,1,1.25,3,1,10,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,1,2,3,'WIESONIC-LCD',18.9,'NO',209.5,1,1,'N',8,2125,1,1.25,3,6,10,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,1,1,5,'HP-LASER',18.9,'NO',152,1,1,'N',6,1,1,1.25,3,1,1,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,1,1,4,'AMD-CORE DUO',18.9,'NO',147.5,1,1,'N',7,2125,1,1.25,3,6,6,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,2,1,4,'AMD-CORE 2 DUO',18.9,'NO',107.5,1,1,'N',2,1500,1,1.25,3,6,5,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,1,2,4,'INTEL-CORE DUO',18.9,'NO',2,1,1,'N',6,1750,1,1.25,3,6,15,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,2,2,5,'EPSON-CHORRO A TINTA',18.9,'NO',32,2,63,'N',5,32,1,2,1,32,65,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,2,1,1,'SAMSUNG-IDE',18.9,'NO',-50,12,80,'N',2,3,1,2,1.5,23,1,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,2,2,1,'SEAGATE-IDE',18.9,'NO',26,12,63,'N',5,3,1,1,2,54,1.5,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,2,1,5,'HP-CHORRO A TINTA',18.9,'NO',6,1,23,'N',3,3,1,3,2.5,65,23,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,2,2,3,'WIESONIC-CRT',18.9,'NO',32,2,63,'N',3,2,1,3,2,9,3,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (1,2,2,4,'INTEL-CORE 2 DUO',18.9,'NO',23,15,90,'N',10,3,1,2,1,65,1,'S',2);
insert  into `producto`(`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`,`precio_costo`,`envase`,`stock_actual`,`stock_min`,`stock_max`,`foto`,`cod_proveedor`,`medida`,`cod_medida`,`porc_vta`,`porc_transporte`,`unidad_bulto`,`peso`,`activo`,`cod_iva`) values (2,1,1,5,'EPSON-LASER-MULTIFUNCION',500,'NO',38,10,1000,'N',4,1,1,1,1,1,10,'S',1);

/*Table structure for table `proveedor` */

DROP TABLE IF EXISTS `proveedor`;

CREATE TABLE `proveedor` (
  `cod_proveedor` int(11) NOT NULL,
  `razon_social` text NOT NULL,
  `cuit` text NOT NULL,
  `ingreso_bruto` text,
  `direccion` text NOT NULL,
  `tel` text,
  `fax` text,
  `movil` text,
  `contacto` text,
  `web` text,
  `email` text,
  `limite_cred` text,
  `agente_retencion` char(1) NOT NULL,
  `cond_iva` text NOT NULL,
  `cod_localidad` int(11) NOT NULL,
  `cod_prov` int(11) NOT NULL,
  `cod_pais` int(11) NOT NULL,
  PRIMARY KEY (`cod_proveedor`),
  KEY `Ref1742` (`cod_pais`,`cod_prov`,`cod_localidad`),
  KEY `Reflocalidad42` (`cod_localidad`,`cod_prov`,`cod_pais`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `proveedor` */

insert  into `proveedor`(`cod_proveedor`,`razon_social`,`cuit`,`ingreso_bruto`,`direccion`,`tel`,`fax`,`movil`,`contacto`,`web`,`email`,`limite_cred`,`agente_retencion`,`cond_iva`,`cod_localidad`,`cod_prov`,`cod_pais`) values (1,'AIR COMPUTERS','30505779858','9216200187','CALCHINES 1401','03783-425660','0342-4502200','','','','','','S','1',38,1,1);
insert  into `proveedor`(`cod_proveedor`,`razon_social`,`cuit`,`ingreso_bruto`,`direccion`,`tel`,`fax`,`movil`,`contacto`,`web`,`email`,`limite_cred`,`agente_retencion`,`cond_iva`,`cod_localidad`,`cod_prov`,`cod_pais`) values (2,'CHIPORITO S.R.L','30634595623','9135009681','CTE. ESPORA Y HERRERA ','03752-152443','','','MUJICA','','','','S','1',39,1,1);
insert  into `proveedor`(`cod_proveedor`,`razon_social`,`cuit`,`ingreso_bruto`,`direccion`,`tel`,`fax`,`movil`,`contacto`,`web`,`email`,`limite_cred`,`agente_retencion`,`cond_iva`,`cod_localidad`,`cod_prov`,`cod_pais`) values (3,'COMPUNET S.A','30602276097','9083521804','VIRGEN DE LUJAN Y ALBERDI','03456-421632','','','','','','','S','1',42,3,1);
insert  into `proveedor`(`cod_proveedor`,`razon_social`,`cuit`,`ingreso_bruto`,`direccion`,`tel`,`fax`,`movil`,`contacto`,`web`,`email`,`limite_cred`,`agente_retencion`,`cond_iva`,`cod_localidad`,`cod_prov`,`cod_pais`) values (4,'NOGANET','33586981949','9062912937','CALLE 321 NRO. 78','03732-421800','','','','','','','S','1',40,3,1);
insert  into `proveedor`(`cod_proveedor`,`razon_social`,`cuit`,`ingreso_bruto`,`direccion`,`tel`,`fax`,`movil`,`contacto`,`web`,`email`,`limite_cred`,`agente_retencion`,`cond_iva`,`cod_localidad`,`cod_prov`,`cod_pais`) values (5,'INFORMATICA S.A','30517050225','9019127179','RTA. NACIONAL NÂ° 2 KM 102','011-49594388','',' 03752-15540781','MINUTILLO','','','','S','1',43,4,1);
insert  into `proveedor`(`cod_proveedor`,`razon_social`,`cuit`,`ingreso_bruto`,`direccion`,`tel`,`fax`,`movil`,`contacto`,`web`,`email`,`limite_cred`,`agente_retencion`,`cond_iva`,`cod_localidad`,`cod_prov`,`cod_pais`) values (6,'REDITEL S.A','30500710507','9029139252','JUJUY 1197','011-44698000','','','','','','','N','1',44,4,1);
insert  into `proveedor`(`cod_proveedor`,`razon_social`,`cuit`,`ingreso_bruto`,`direccion`,`tel`,`fax`,`movil`,`contacto`,`web`,`email`,`limite_cred`,`agente_retencion`,`cond_iva`,`cod_localidad`,`cod_prov`,`cod_pais`) values (7,'ZONACERONET','23298402149','156','GRAL PAZ 635','1596325','','','','','','','N','3',33,1,1);
insert  into `proveedor`(`cod_proveedor`,`razon_social`,`cuit`,`ingreso_bruto`,`direccion`,`tel`,`fax`,`movil`,`contacto`,`web`,`email`,`limite_cred`,`agente_retencion`,`cond_iva`,`cod_localidad`,`cod_prov`,`cod_pais`) values (8,'TECOM','33709776989','9012230070','BOGOTA 311 P. 5 DTO. 20','011-47552916','011-47542888','','','WWW.SIVIAR.COM.AR','VENTAS@SIVIAR.COM.AR','','N','1',55,4,1);
insert  into `proveedor`(`cod_proveedor`,`razon_social`,`cuit`,`ingreso_bruto`,`direccion`,`tel`,`fax`,`movil`,`contacto`,`web`,`email`,`limite_cred`,`agente_retencion`,`cond_iva`,`cod_localidad`,`cod_prov`,`cod_pais`) values (9,'NETCOM','30500548041','9029127147','ARENALES 460 - VICENTE LOPEZ','011- 51988000','','','','','','','S','1',55,4,1);
insert  into `proveedor`(`cod_proveedor`,`razon_social`,`cuit`,`ingreso_bruto`,`direccion`,`tel`,`fax`,`movil`,`contacto`,`web`,`email`,`limite_cred`,`agente_retencion`,`cond_iva`,`cod_localidad`,`cod_prov`,`cod_pais`) values (10,'COMPUCOM','30708222190','30708222190','RUTA 4,KM.10','03752430878','','0375215561749','','','','','S','1',39,1,1);

/*Table structure for table `provincia` */

DROP TABLE IF EXISTS `provincia`;

CREATE TABLE `provincia` (
  `cod_prov` int(11) NOT NULL AUTO_INCREMENT,
  `cod_pais` int(11) NOT NULL,
  `nombre` text NOT NULL,
  PRIMARY KEY (`cod_prov`,`cod_pais`),
  KEY `Ref811` (`cod_pais`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `provincia` */

insert  into `provincia`(`cod_prov`,`cod_pais`,`nombre`) values (1,1,'MISIONES');
insert  into `provincia`(`cod_prov`,`cod_pais`,`nombre`) values (2,1,'CORRIENTES');
insert  into `provincia`(`cod_prov`,`cod_pais`,`nombre`) values (3,1,'ENTRE RIOS');
insert  into `provincia`(`cod_prov`,`cod_pais`,`nombre`) values (4,1,'BUENOS AIRES');
insert  into `provincia`(`cod_prov`,`cod_pais`,`nombre`) values (5,1,'SANTA FE');
insert  into `provincia`(`cod_prov`,`cod_pais`,`nombre`) values (6,1,'POSADAS');

/*Table structure for table `recibos_por_cliente` */

DROP TABLE IF EXISTS `recibos_por_cliente`;

CREATE TABLE `recibos_por_cliente` (
  `cod_cliente` int(11) NOT NULL,
  `cod_zona` int(11) NOT NULL,
  `cod_localidad` int(11) NOT NULL,
  `cod_prov` int(11) NOT NULL,
  `cod_pais` int(11) NOT NULL,
  `cod_talonario` char(1) NOT NULL,
  `num_talonario` int(4) unsigned zerofill NOT NULL,
  PRIMARY KEY (`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_talonario`,`num_talonario`),
  KEY `Reftalonario130` (`cod_talonario`,`num_talonario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `recibos_por_cliente` */

insert  into `recibos_por_cliente`(`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_talonario`,`num_talonario`) values (1,5,33,1,1,'C',0001);

/*Table structure for table `regular_comision` */

DROP TABLE IF EXISTS `regular_comision`;

CREATE TABLE `regular_comision` (
  `descuento` float NOT NULL,
  `minimo` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `regular_comision` */

insert  into `regular_comision`(`descuento`,`minimo`) values (5,1);

/*Table structure for table `remito_compra` */

DROP TABLE IF EXISTS `remito_compra`;

CREATE TABLE `remito_compra` (
  `num_remito` int(8) unsigned zerofill NOT NULL,
  `fecha` int(11) NOT NULL,
  `cod_proveedor` int(11) NOT NULL,
  `cod_talonario` char(1) NOT NULL,
  `num_talonario` int(4) unsigned zerofill NOT NULL,
  PRIMARY KEY (`num_remito`),
  KEY `Ref3348` (`cod_proveedor`),
  KEY `Ref2261` (`num_talonario`,`cod_talonario`),
  KEY `Reftalonario61` (`cod_talonario`,`num_talonario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `remito_compra` */

/*Table structure for table `remito_compra_detalle` */

DROP TABLE IF EXISTS `remito_compra_detalle`;

CREATE TABLE `remito_compra_detalle` (
  `num_remito` int(8) unsigned zerofill NOT NULL,
  `cod_prod` int(11) NOT NULL,
  `cod_variedad` int(11) NOT NULL,
  `cod_marca` int(11) NOT NULL,
  `cod_grupo` int(11) NOT NULL,
  `cantidad` float NOT NULL,
  `precio` float NOT NULL,
  `bonificacion` float DEFAULT NULL,
  PRIMARY KEY (`num_remito`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`),
  KEY `Ref3643` (`num_remito`),
  KEY `Ref152` (`cod_variedad`,`cod_prod`,`cod_grupo`,`cod_marca`),
  KEY `Refproducto52` (`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `remito_compra_detalle` */

/*Table structure for table `remito_vta` */

DROP TABLE IF EXISTS `remito_vta`;

CREATE TABLE `remito_vta` (
  `num_remito` int(8) unsigned zerofill NOT NULL,
  `fecha` int(11) NOT NULL,
  `lugar_entrega` text,
  `hora_entrega` text,
  `cod_cliente` int(11) NOT NULL,
  `cod_zona` int(11) NOT NULL,
  `cod_localidad` int(11) NOT NULL,
  `cod_prov` int(11) NOT NULL,
  `cod_pais` int(11) NOT NULL,
  `cod_talonario` char(1) NOT NULL,
  `num_talonario` int(4) unsigned zerofill NOT NULL,
  `cod_categoria` int(11) DEFAULT NULL,
  `cod_vendedor` int(11) DEFAULT NULL,
  `cod_repartidor` int(11) DEFAULT NULL,
  `observacion` text,
  `pendiente` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`num_remito`),
  KEY `Ref522` (`cod_localidad`,`cod_zona`,`cod_cliente`,`cod_pais`,`cod_prov`),
  KEY `Ref2249` (`cod_talonario`,`num_talonario`),
  KEY `Refcliente22` (`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `remito_vta` */

insert  into `remito_vta`(`num_remito`,`fecha`,`lugar_entrega`,`hora_entrega`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_talonario`,`num_talonario`,`cod_categoria`,`cod_vendedor`,`cod_repartidor`,`observacion`,`pendiente`) values (00000001,20110909,'','',1,5,33,1,1,'R',0001,1,1,1,'','N');
insert  into `remito_vta`(`num_remito`,`fecha`,`lugar_entrega`,`hora_entrega`,`cod_cliente`,`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`cod_talonario`,`num_talonario`,`cod_categoria`,`cod_vendedor`,`cod_repartidor`,`observacion`,`pendiente`) values (00000002,20110909,'','',1,5,33,1,1,'R',0001,1,1,1,'','S');

/*Table structure for table `remito_vta_detalle` */

DROP TABLE IF EXISTS `remito_vta_detalle`;

CREATE TABLE `remito_vta_detalle` (
  `num_remito` int(8) unsigned zerofill NOT NULL,
  `cod_prod` int(11) NOT NULL,
  `cod_variedad` int(11) NOT NULL,
  `cod_marca` int(11) NOT NULL,
  `cod_grupo` int(11) NOT NULL,
  `cantidad` float NOT NULL,
  `precio` float NOT NULL,
  `bonificacion` float DEFAULT NULL,
  PRIMARY KEY (`num_remito`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`),
  KEY `Ref125` (`cod_prod`,`cod_grupo`,`cod_marca`,`cod_variedad`),
  KEY `Ref2486` (`num_remito`),
  KEY `Refproducto25` (`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `remito_vta_detalle` */

insert  into `remito_vta_detalle`(`num_remito`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`) values (00000001,1,1,1,1,1,21.35,0);
insert  into `remito_vta_detalle`(`num_remito`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`) values (00000001,2,1,1,5,1,800,0);
insert  into `remito_vta_detalle`(`num_remito`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`,`cantidad`,`precio`,`bonificacion`) values (00000002,1,1,1,1,10,21.35,0);

/*Table structure for table `remito_vta_detalle_no_cliente` */

DROP TABLE IF EXISTS `remito_vta_detalle_no_cliente`;

CREATE TABLE `remito_vta_detalle_no_cliente` (
  `num_remito` int(8) unsigned zerofill NOT NULL,
  `cod_prod` int(11) NOT NULL,
  `cod_variedad` int(11) NOT NULL,
  `cod_marca` int(11) NOT NULL,
  `cod_grupo` int(11) NOT NULL,
  `cantidad` float NOT NULL,
  `precio` float NOT NULL,
  `bonificacion` float DEFAULT NULL,
  PRIMARY KEY (`num_remito`,`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`),
  KEY `Ref4995` (`num_remito`),
  KEY `Ref1110` (`cod_marca`,`cod_variedad`,`cod_prod`,`cod_grupo`),
  KEY `Refproducto110` (`cod_prod`,`cod_variedad`,`cod_marca`,`cod_grupo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `remito_vta_detalle_no_cliente` */

/*Table structure for table `remito_vta_no_cliente` */

DROP TABLE IF EXISTS `remito_vta_no_cliente`;

CREATE TABLE `remito_vta_no_cliente` (
  `num_remito` int(8) unsigned zerofill NOT NULL,
  `fecha` int(11) NOT NULL,
  `lugar_entrega` text,
  `hora_entrega` text,
  `cod_talonario` char(1) NOT NULL,
  `num_talonario` int(4) unsigned zerofill NOT NULL,
  `razon_social` text NOT NULL,
  `direccion` text NOT NULL,
  `localidad` text NOT NULL,
  `provincia` text,
  `iva` text,
  `cuit` varchar(11) DEFAULT NULL,
  `cod_categoria` int(11) DEFAULT NULL,
  `cod_vendedor` int(11) DEFAULT NULL,
  `cod_repartidor` int(11) DEFAULT NULL,
  `observacion` text,
  `zona` int(11) NOT NULL,
  `pendiente` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`num_remito`),
  KEY `Ref2290` (`num_talonario`,`cod_talonario`),
  KEY `Reftalonario90` (`cod_talonario`,`num_talonario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `remito_vta_no_cliente` */

/*Table structure for table `remito_vta_tmp` */

DROP TABLE IF EXISTS `remito_vta_tmp`;

CREATE TABLE `remito_vta_tmp` (
  `usuario` text,
  `cod_prod` int(11) DEFAULT NULL,
  `descripcion` text,
  `cantidad` float NOT NULL,
  `precio` float NOT NULL,
  `bonificacion` float DEFAULT NULL,
  `importe` float DEFAULT NULL,
  `linea` int(11) DEFAULT NULL,
  `iva` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `remito_vta_tmp` */

/*Table structure for table `sis_preventa` */

DROP TABLE IF EXISTS `sis_preventa`;

CREATE TABLE `sis_preventa` (
  `url` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `sis_preventa` */

/*Table structure for table `stock_inicial` */

DROP TABLE IF EXISTS `stock_inicial`;

CREATE TABLE `stock_inicial` (
  `fecha` int(11) DEFAULT NULL,
  `ususario` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `stock_inicial` */

insert  into `stock_inicial`(`fecha`,`ususario`) values (20080830,'alonso');

/*Table structure for table `talonario` */

DROP TABLE IF EXISTS `talonario`;

CREATE TABLE `talonario` (
  `cod_talonario` char(1) NOT NULL,
  `num_talonario` int(4) unsigned zerofill NOT NULL,
  `n_sucursal` int(4) unsigned zerofill NOT NULL,
  `destino_impr` text,
  `max_iter` int(11) NOT NULL,
  `primer_num` int(8) unsigned zerofill NOT NULL,
  `ultimo_num` int(8) unsigned zerofill NOT NULL,
  `sig_num` int(8) unsigned zerofill NOT NULL,
  `fecha_venc` int(11) NOT NULL,
  `num_cai` text NOT NULL,
  PRIMARY KEY (`cod_talonario`,`num_talonario`),
  KEY `Ref2529` (`cod_talonario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `talonario` */

insert  into `talonario`(`cod_talonario`,`num_talonario`,`n_sucursal`,`destino_impr`,`max_iter`,`primer_num`,`ultimo_num`,`sig_num`,`fecha_venc`,`num_cai`) values ('A',0001,0001,'epsonlx300#EPSON LX-300',35,00000001,00001000,00000001,30122011,'27681113320534');
insert  into `talonario`(`cod_talonario`,`num_talonario`,`n_sucursal`,`destino_impr`,`max_iter`,`primer_num`,`ultimo_num`,`sig_num`,`fecha_venc`,`num_cai`) values ('B',0001,0001,'epsonlx300#EPSON LX-300',35,00000001,00001000,00000001,30122011,'276811133205');
insert  into `talonario`(`cod_talonario`,`num_talonario`,`n_sucursal`,`destino_impr`,`max_iter`,`primer_num`,`ultimo_num`,`sig_num`,`fecha_venc`,`num_cai`) values ('R',0001,0001,'HP-LaserJet-M1319f-MFP#HP LaserJet M1319f',20,00000001,00001000,00000001,30122011,'28681107914228');
insert  into `talonario`(`cod_talonario`,`num_talonario`,`n_sucursal`,`destino_impr`,`max_iter`,`primer_num`,`ultimo_num`,`sig_num`,`fecha_venc`,`num_cai`) values ('C',0001,0001,'HP-LaserJet-M1319f-MFP#HP LaserJet M1319f',25,00000001,00001000,00000001,30122011,'56702312984563');
insert  into `talonario`(`cod_talonario`,`num_talonario`,`n_sucursal`,`destino_impr`,`max_iter`,`primer_num`,`ultimo_num`,`sig_num`,`fecha_venc`,`num_cai`) values ('X',0001,0001,'HP-LaserJet-M1319f-MFP#HP LaserJet M1319f',12,00000001,00001000,00000001,30122011,'38740123886403');

/*Table structure for table `tipo_talonario` */

DROP TABLE IF EXISTS `tipo_talonario`;

CREATE TABLE `tipo_talonario` (
  `cod_talonario` char(1) NOT NULL,
  `descripcion` text NOT NULL,
  `cant_copias` int(11) NOT NULL,
  PRIMARY KEY (`cod_talonario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tipo_talonario` */

insert  into `tipo_talonario`(`cod_talonario`,`descripcion`,`cant_copias`) values ('A','FAC A',1);
insert  into `tipo_talonario`(`cod_talonario`,`descripcion`,`cant_copias`) values ('B','FAC B',1);
insert  into `tipo_talonario`(`cod_talonario`,`descripcion`,`cant_copias`) values ('R','REMITO',1);
insert  into `tipo_talonario`(`cod_talonario`,`descripcion`,`cant_copias`) values ('C','RECIBO DE COBRANZAS',1);
insert  into `tipo_talonario`(`cod_talonario`,`descripcion`,`cant_copias`) values ('X','PRESUPUESTOS',1);
insert  into `tipo_talonario`(`cod_talonario`,`descripcion`,`cant_copias`) values ('D','DEVOLUCIONES (REBOTE)',1);

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `cod_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` char(20) NOT NULL,
  `clave` text NOT NULL,
  `nombre` text NOT NULL,
  `abm_zonas_geo` char(1) NOT NULL,
  `abm_alicuotas` varchar(1) NOT NULL,
  `abm_comprobante` varchar(1) NOT NULL,
  `abm_cond_iva` varchar(1) NOT NULL,
  `abm_talonario` varchar(1) NOT NULL,
  `abm_proveedor` varchar(1) NOT NULL,
  `abm_vehiculo` varchar(1) NOT NULL,
  `abm_repartidor` varchar(1) NOT NULL,
  `abm_vendedor` varchar(1) NOT NULL,
  `abm_categoria` varchar(1) NOT NULL,
  `abm_forma_pago` varchar(1) NOT NULL,
  `abm_cliente` varchar(1) NOT NULL,
  `abm_articulo` varchar(1) NOT NULL,
  `datos_empresa` varchar(1) NOT NULL,
  `conf_listados` varchar(1) NOT NULL,
  `abm_usuarios` varchar(1) NOT NULL,
  `stock` varchar(1) NOT NULL,
  `factura_compra` varchar(1) NOT NULL,
  `remito_vta` varchar(1) NOT NULL,
  `factura_vta` varchar(1) NOT NULL,
  `nota_credito` varchar(1) NOT NULL,
  `cta_cte` varchar(1) NOT NULL,
  `comisiones` varchar(1) NOT NULL,
  `devoluciones` varchar(1) NOT NULL,
  `finalizar_carga` varchar(1) NOT NULL,
  `informes` varchar(1) NOT NULL,
  `estadisticas` varchar(1) NOT NULL,
  `utilidades` varchar(1) NOT NULL,
  `activo` varchar(1) NOT NULL,
  `presupuestos` varchar(1) NOT NULL,
  PRIMARY KEY (`cod_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `usuario` */

insert  into `usuario`(`cod_usuario`,`usuario`,`clave`,`nombre`,`abm_zonas_geo`,`abm_alicuotas`,`abm_comprobante`,`abm_cond_iva`,`abm_talonario`,`abm_proveedor`,`abm_vehiculo`,`abm_repartidor`,`abm_vendedor`,`abm_categoria`,`abm_forma_pago`,`abm_cliente`,`abm_articulo`,`datos_empresa`,`conf_listados`,`abm_usuarios`,`stock`,`factura_compra`,`remito_vta`,`factura_vta`,`nota_credito`,`cta_cte`,`comisiones`,`devoluciones`,`finalizar_carga`,`informes`,`estadisticas`,`utilidades`,`activo`,`presupuestos`) values (17,'admin','2a52adc7b1da6a4e0a7a14e4c8db1b11','ADMINISTRADOR','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S');
insert  into `usuario`(`cod_usuario`,`usuario`,`clave`,`nombre`,`abm_zonas_geo`,`abm_alicuotas`,`abm_comprobante`,`abm_cond_iva`,`abm_talonario`,`abm_proveedor`,`abm_vehiculo`,`abm_repartidor`,`abm_vendedor`,`abm_categoria`,`abm_forma_pago`,`abm_cliente`,`abm_articulo`,`datos_empresa`,`conf_listados`,`abm_usuarios`,`stock`,`factura_compra`,`remito_vta`,`factura_vta`,`nota_credito`,`cta_cte`,`comisiones`,`devoluciones`,`finalizar_carga`,`informes`,`estadisticas`,`utilidades`,`activo`,`presupuestos`) values (19,'fabian','e982a1d9df63a418d43776debb08b542','FABIAN','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S','S');

/*Table structure for table `variedad` */

DROP TABLE IF EXISTS `variedad`;

CREATE TABLE `variedad` (
  `cod_variedad` int(11) NOT NULL,
  `cod_marca` int(11) NOT NULL,
  `cod_grupo` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`cod_variedad`,`cod_marca`,`cod_grupo`),
  KEY `Ref122` (`cod_grupo`,`cod_marca`),
  KEY `Refmarca2` (`cod_marca`,`cod_grupo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `variedad` */

insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,1,2,'FSB 800');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (2,1,2,'FSB 1600');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,2,2,'FSB 800');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (2,2,2,'FSB 1600');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,3,2,'TINTO');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (2,3,2,'ROSADO');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (2,2,1,'IDE');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,4,2,'TINTO');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (2,4,2,'ROSADO');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (2,1,1,'IDE');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,5,2,'UNICA');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,6,2,'TINTO');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (2,6,2,'BLANCO');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,7,2,'UNICA');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,8,2,'TINTO');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (2,8,2,'BLANCO');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,9,2,'TINTO');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (2,9,2,'TORRONTES');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,10,2,'UNICA');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,1,3,'LCD');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (2,1,3,'CRT');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,2,3,'LCD');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,1,4,'CORE DUO');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (2,1,4,'CORE 2 DUO');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,2,4,'CORE DUO');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,1,5,'LASER');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,2,5,'LASER');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,3,5,'POLVO');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,11,2,'UNICA');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (2,5,5,'LIQUIDO');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,1,1,'SATA');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,2,1,'SATA');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,3,1,'UNICA');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,4,1,'UNICA');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,5,1,'UNICA');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,6,1,'UNICA');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,12,2,'TINTO');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,13,2,'UNICO');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (2,12,2,'BLANCO');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (2,2,5,'CHORRO A TINTA');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (2,1,5,'CHORRO A TINTA');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (2,2,4,'CORE 2 DUO');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (2,10,2,'BLANCO');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (2,2,3,'CRT');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,7,1,'UNICA');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,8,1,'UNICA');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,9,1,'UNICA');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,3,4,'UNICA');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (2,7,2,'BLANCO');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (2,6,5,'LIQUIDO');
insert  into `variedad`(`cod_variedad`,`cod_marca`,`cod_grupo`,`descripcion`) values (1,4,5,'UNICA');

/*Table structure for table `vehiculo` */

DROP TABLE IF EXISTS `vehiculo`;

CREATE TABLE `vehiculo` (
  `cod_vehiculo` int(11) NOT NULL,
  `patente` text NOT NULL,
  `patente_acop` text NOT NULL,
  `marca` text NOT NULL,
  `modelo` text NOT NULL,
  `propiedad` char(1) DEFAULT NULL,
  PRIMARY KEY (`cod_vehiculo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `vehiculo` */

insert  into `vehiculo`(`cod_vehiculo`,`patente`,`patente_acop`,`marca`,`modelo`,`propiedad`) values (1,'URF 569','','FORD -350','1985','N');
insert  into `vehiculo`(`cod_vehiculo`,`patente`,`patente_acop`,`marca`,`modelo`,`propiedad`) values (2,'ASDDF','','FORD-250','1970','N');
insert  into `vehiculo`(`cod_vehiculo`,`patente`,`patente_acop`,`marca`,`modelo`,`propiedad`) values (3,'UHF211','','FORD-350','1985','N');
insert  into `vehiculo`(`cod_vehiculo`,`patente`,`patente_acop`,`marca`,`modelo`,`propiedad`) values (4,'TSK282','','FORD 14000','1982','N');
insert  into `vehiculo`(`cod_vehiculo`,`patente`,`patente_acop`,`marca`,`modelo`,`propiedad`) values (5,'UOK361','','MERCEDEZ BENZ 1114','1979','N');
insert  into `vehiculo`(`cod_vehiculo`,`patente`,`patente_acop`,`marca`,`modelo`,`propiedad`) values (6,'RBY 439','','MERCEDES BENZ 1114','1967','N');
insert  into `vehiculo`(`cod_vehiculo`,`patente`,`patente_acop`,`marca`,`modelo`,`propiedad`) values (7,'RTY 429','','FORD 350','1973','N');
insert  into `vehiculo`(`cod_vehiculo`,`patente`,`patente_acop`,`marca`,`modelo`,`propiedad`) values (8,'GMO285','GMO291','RENAULT','2007','S');
insert  into `vehiculo`(`cod_vehiculo`,`patente`,`patente_acop`,`marca`,`modelo`,`propiedad`) values (20,'FMF534','','SAVEIRO','2006','N');
insert  into `vehiculo`(`cod_vehiculo`,`patente`,`patente_acop`,`marca`,`modelo`,`propiedad`) values (9,'NNNNN','','MERCEDES','1111','N');
insert  into `vehiculo`(`cod_vehiculo`,`patente`,`patente_acop`,`marca`,`modelo`,`propiedad`) values (21,'DEPOSIT','XXX','XXX','XXX','N');

/*Table structure for table `vendedor` */

DROP TABLE IF EXISTS `vendedor`;

CREATE TABLE `vendedor` (
  `cod_vendedor` int(11) NOT NULL,
  `dni` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `direccion` text NOT NULL,
  `tel` text NOT NULL,
  `cod_localidad` int(11) NOT NULL,
  `cod_prov` int(11) NOT NULL,
  `cod_pais` int(11) NOT NULL,
  PRIMARY KEY (`cod_vendedor`),
  KEY `Ref1780` (`cod_pais`,`cod_prov`,`cod_localidad`),
  KEY `Reflocalidad80` (`cod_localidad`,`cod_prov`,`cod_pais`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `vendedor` */

insert  into `vendedor`(`cod_vendedor`,`dni`,`nombre`,`direccion`,`tel`,`cod_localidad`,`cod_prov`,`cod_pais`) values (1,21300727,'BARCHUK JUAN CARLOS','APOSTOLES','3758-408161',33,1,1);
insert  into `vendedor`(`cod_vendedor`,`dni`,`nombre`,`direccion`,`tel`,`cod_localidad`,`cod_prov`,`cod_pais`) values (2,23256842,'RECALDE LUIS','B. ILLIA','3758-418500',33,1,1);
insert  into `vendedor`(`cod_vendedor`,`dni`,`nombre`,`direccion`,`tel`,`cod_localidad`,`cod_prov`,`cod_pais`) values (3,1,'MIGUEL CARPES','VIRASORO','11',26,2,1);
insert  into `vendedor`(`cod_vendedor`,`dni`,`nombre`,`direccion`,`tel`,`cod_localidad`,`cod_prov`,`cod_pais`) values (5,16696595,'BARCHUK GERARDO','BARRIO ANDRESITO','3758-408155',33,1,1);
insert  into `vendedor`(`cod_vendedor`,`dni`,`nombre`,`direccion`,`tel`,`cod_localidad`,`cod_prov`,`cod_pais`) values (4,1111111,'SEGOVIA LEO FABIO','SAN JAVIER','3754-400329',27,1,1);
insert  into `vendedor`(`cod_vendedor`,`dni`,`nombre`,`direccion`,`tel`,`cod_localidad`,`cod_prov`,`cod_pais`) values (6,30430829,'HELFENRITTER MATIAS','L.ALEM','3754-458994',6,1,1);
insert  into `vendedor`(`cod_vendedor`,`dni`,`nombre`,`direccion`,`tel`,`cod_localidad`,`cod_prov`,`cod_pais`) values (10,92523447,'WAPPLER DAVID','ITUZAINGO','3786-458010',36,2,1);
insert  into `vendedor`(`cod_vendedor`,`dni`,`nombre`,`direccion`,`tel`,`cod_localidad`,`cod_prov`,`cod_pais`) values (17,31880573,'ROLANDO BURAK','USHAI','03758-15454255',33,1,1);
insert  into `vendedor`(`cod_vendedor`,`dni`,`nombre`,`direccion`,`tel`,`cod_localidad`,`cod_prov`,`cod_pais`) values (15,22727522,'TORRES MARTIN','SAN VICENTE','3755-500012',8,1,1);
insert  into `vendedor`(`cod_vendedor`,`dni`,`nombre`,`direccion`,`tel`,`cod_localidad`,`cod_prov`,`cod_pais`) values (20,11101091,'DEPOSITO','RUTA 201 - KM 40','3758-424181',33,1,1);
insert  into `vendedor`(`cod_vendedor`,`dni`,`nombre`,`direccion`,`tel`,`cod_localidad`,`cod_prov`,`cod_pais`) values (12,27414728,'RAMIREZ PABLO MARTIN - LA CRUZ','BS.AS Y RIVADAVIA','03772-15433320',47,2,1);
insert  into `vendedor`(`cod_vendedor`,`dni`,`nombre`,`direccion`,`tel`,`cod_localidad`,`cod_prov`,`cod_pais`) values (11,27414278,'RAMIREZ PABLO MARTIN - ALVEAR','BS.AS Y RIVADAVIA','03772-15433320',25,2,1);
insert  into `vendedor`(`cod_vendedor`,`dni`,`nombre`,`direccion`,`tel`,`cod_localidad`,`cod_prov`,`cod_pais`) values (14,14,'RECALDE LUIS','XXX','03758-15418500',5,1,1);
insert  into `vendedor`(`cod_vendedor`,`dni`,`nombre`,`direccion`,`tel`,`cod_localidad`,`cod_prov`,`cod_pais`) values (21,21,'DEPOSITO','RTA.201 KM 2','3758-424181',33,1,1);
insert  into `vendedor`(`cod_vendedor`,`dni`,`nombre`,`direccion`,`tel`,`cod_localidad`,`cod_prov`,`cod_pais`) values (22,22,'DESCARGA','RUTA 201 KM 2','03758-424181',33,1,1);
insert  into `vendedor`(`cod_vendedor`,`dni`,`nombre`,`direccion`,`tel`,`cod_localidad`,`cod_prov`,`cod_pais`) values (19,19,'VENTA EN DEPOSITO','RTA.201 KM 2','424181',33,1,1);
insert  into `vendedor`(`cod_vendedor`,`dni`,`nombre`,`direccion`,`tel`,`cod_localidad`,`cod_prov`,`cod_pais`) values (18,18,'JOSE PEREIRA','XXX','111111',23,1,1);
insert  into `vendedor`(`cod_vendedor`,`dni`,`nombre`,`direccion`,`tel`,`cod_localidad`,`cod_prov`,`cod_pais`) values (13,13,'RECALDE LUIS','XXX','3758-418500',58,2,1);

/*Table structure for table `zona` */

DROP TABLE IF EXISTS `zona`;

CREATE TABLE `zona` (
  `cod_zona` int(11) NOT NULL AUTO_INCREMENT,
  `cod_localidad` int(11) NOT NULL,
  `cod_prov` int(11) NOT NULL,
  `cod_pais` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `porc_vta` float DEFAULT NULL,
  `porc_transporte` float DEFAULT NULL,
  PRIMARY KEY (`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`),
  KEY `Ref1713` (`cod_localidad`,`cod_pais`,`cod_prov`),
  KEY `Reflocalidad13` (`cod_localidad`,`cod_prov`,`cod_pais`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

/*Data for the table `zona` */

insert  into `zona`(`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`porc_vta`,`porc_transporte`) values (5,33,1,1,'APOSTOLES',1.25,1.452);
insert  into `zona`(`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`porc_vta`,`porc_transporte`) values (66,6,1,1,'L.N. ALEM',3,3);
insert  into `zona`(`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`porc_vta`,`porc_transporte`) values (65,23,1,1,'OBERA',2,2);
insert  into `zona`(`cod_zona`,`cod_localidad`,`cod_prov`,`cod_pais`,`nombre`,`porc_vta`,`porc_transporte`) values (64,39,1,1,'POSADAS',1,1);

/* Procedure structure for procedure `activar_desactivar_articulo` */

/*!50003 DROP PROCEDURE IF EXISTS  `activar_desactivar_articulo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `activar_desactivar_articulo`(codigo int , valor char (1))
update producto set activo = valor  where concat(cod_grupo,cod_marca,cod_variedad,cod_prod) = codigo */$$
DELIMITER ;

/* Procedure structure for procedure `activar_desactivar_cliente` */

/*!50003 DROP PROCEDURE IF EXISTS  `activar_desactivar_cliente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `activar_desactivar_cliente`(codigo int , valor char (1))
update cliente set activo = valor  where cod_cliente = codigo */$$
DELIMITER ;

/* Procedure structure for procedure `actualizar_bonif_art_fact_compra` */

/*!50003 DROP PROCEDURE IF EXISTS  `actualizar_bonif_art_fact_compra` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_bonif_art_fact_compra`(usuario_sesion text, fila_art_fact int, bonif float)
UPDATE factura_compra_tmp SET bonificacion  = bonif where usuario = usuario_sesion and linea = fila_art_fact */$$
DELIMITER ;

/* Procedure structure for procedure `actualizar_bonif_art_fact_vta` */

/*!50003 DROP PROCEDURE IF EXISTS  `actualizar_bonif_art_fact_vta` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_bonif_art_fact_vta`(usuario_sesion text, fila_art_fact_vta int, cant float)
UPDATE factura_vta_tmp SET bonificacion = cant where usuario = usuario_sesion and linea = fila_art_fact_vta */$$
DELIMITER ;

/* Procedure structure for procedure `actualizar_bonif_art_presupuesto_vta` */

/*!50003 DROP PROCEDURE IF EXISTS  `actualizar_bonif_art_presupuesto_vta` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_bonif_art_presupuesto_vta`(usuario_sesion TEXT, fila_art_presu_vta INT, cant FLOAT)
UPDATE presupuesto_vta_tmp SET bonificacion = cant WHERE usuario = usuario_sesion AND linea = fila_art_presu_vta */$$
DELIMITER ;

/* Procedure structure for procedure `actualizar_cant_art_devolucion` */

/*!50003 DROP PROCEDURE IF EXISTS  `actualizar_cant_art_devolucion` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_cant_art_devolucion`(usuario_sesion text, fila_art int, cant float)
UPDATE devolucion_detalle_tmp SET cantidad = cant where usuario = usuario_sesion and linea = fila_art */$$
DELIMITER ;

/* Procedure structure for procedure `actualizar_cant_art_fact_compra` */

/*!50003 DROP PROCEDURE IF EXISTS  `actualizar_cant_art_fact_compra` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_cant_art_fact_compra`(usuario_sesion text, fila_art_fact int, cant float)
UPDATE factura_compra_tmp SET cantidad = cant where usuario = usuario_sesion and linea = fila_art_fact */$$
DELIMITER ;

/* Procedure structure for procedure `actualizar_cant_art_fact_vta` */

/*!50003 DROP PROCEDURE IF EXISTS  `actualizar_cant_art_fact_vta` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_cant_art_fact_vta`(usuario_sesion text, fila_art_fact_vta int, cant float)
UPDATE factura_vta_tmp SET cantidad = cant where usuario = usuario_sesion and linea = fila_art_fact_vta */$$
DELIMITER ;

/* Procedure structure for procedure `actualizar_cant_art_presupuesto_vta` */

/*!50003 DROP PROCEDURE IF EXISTS  `actualizar_cant_art_presupuesto_vta` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_cant_art_presupuesto_vta`(usuario_sesion TEXT, fila_art_presu_vta INT, cant FLOAT)
UPDATE presupuesto_vta_tmp SET cantidad = cant WHERE usuario = usuario_sesion AND linea = fila_art_presu_vta */$$
DELIMITER ;

/* Procedure structure for procedure `actualizar_cant_art_rem_vta` */

/*!50003 DROP PROCEDURE IF EXISTS  `actualizar_cant_art_rem_vta` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_cant_art_rem_vta`(usuario_sesion text, fila_art_rem_vta int, cant float)
UPDATE remito_vta_tmp SET cantidad = cant where usuario = usuario_sesion and linea = fila_art_rem_vta */$$
DELIMITER ;

/* Procedure structure for procedure `actualizar_conf_listados` */

/*!50003 DROP PROCEDURE IF EXISTS  `actualizar_conf_listados` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_conf_listados`(filas int, impr_mod text)
insert into conf_listados values(filas , impr_mod) */$$
DELIMITER ;

/* Procedure structure for procedure `actualizar_importe_art_fact_compra` */

/*!50003 DROP PROCEDURE IF EXISTS  `actualizar_importe_art_fact_compra` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_importe_art_fact_compra`(usuario_sesion text, fila_art_fact int, importe float)
UPDATE factura_compra_tmp SET importe = importe where usuario = usuario_sesion and linea = fila_art_fact */$$
DELIMITER ;

/* Procedure structure for procedure `actualizar_precio_art_fact_compra` */

/*!50003 DROP PROCEDURE IF EXISTS  `actualizar_precio_art_fact_compra` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_precio_art_fact_compra`(usuario_sesion text, fila_art_fact int, precio float)
UPDATE factura_compra_tmp SET precio = precio where usuario = usuario_sesion and linea = fila_art_fact */$$
DELIMITER ;

/* Procedure structure for procedure `actualizar_regular_comision` */

/*!50003 DROP PROCEDURE IF EXISTS  `actualizar_regular_comision` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_regular_comision`(descuento float, minimo float)
insert into regular_comision values(descuento, minimo) */$$
DELIMITER ;

/* Procedure structure for procedure `ajuste_precios_manual` */

/*!50003 DROP PROCEDURE IF EXISTS  `ajuste_precios_manual` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ajuste_precios_manual`(id_grupo int, id_categoria int)
delete from ajuste_precio where cod_grupo = id_grupo and cod_categoria = id_categoria */$$
DELIMITER ;

/* Procedure structure for procedure `ajuste_precios_utilidad` */

/*!50003 DROP PROCEDURE IF EXISTS  `ajuste_precios_utilidad` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ajuste_precios_utilidad`(id_grupo int, id_categoria int, porcentaje float)
BEGIN
   /* actualizo los articulos*/           
   UPDATE prod_por_categ INNER JOIN producto ON producto.cod_prod = prod_por_categ.cod_prod
   AND producto.cod_variedad = prod_por_categ.cod_variedad 
   AND producto.cod_marca = prod_por_categ.cod_marca
   AND producto.cod_grupo = prod_por_categ.cod_grupo
   SET prod_por_categ.precio_vta = ROUND(precio_costo + (precio_costo * porcentaje / 100),2) 
   WHERE prod_por_categ.cod_categoria = id_categoria
   AND prod_por_categ.cod_grupo = id_grupo;
   /* agrego el registro en la tabla ajuste de precio*/	      
   DELETE FROM ajuste_precio WHERE cod_grupo = id_grupo AND cod_categoria = id_categoria;
   INSERT INTO ajuste_precio VALUES(id_grupo,id_categoria,porcentaje);	       
END */$$
DELIMITER ;

/* Procedure structure for procedure `alta_art_esp` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_art_esp` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_art_esp`(codigo int,tipo char(2),porc text)
insert into art_especial values(codigo, tipo, porc) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_asignar_tal_recibo_cliente` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_asignar_tal_recibo_cliente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_asignar_tal_recibo_cliente`(cod_cliente int ,cod_zona int,cod_localidad int,cod_prov int,cod_pais int,n_talonario int,cod_tal char(1))
insert into recibos_por_cliente values(cod_cliente ,cod_zona ,cod_localidad ,cod_prov ,cod_pais ,cod_tal ,n_talonario ) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_caja` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_caja` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_caja`(fecha int,importe float,obs text)
insert into caja_inicial values(fecha ,importe ,obs) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_categoria` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_categoria` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_categoria`(nombre_cat text)
insert into categoria (descripcion ) values(nombre_cat) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_cc_tmp` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_cc_tmp` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_cc_tmp`(usuario_cc text, n_factura int, cod_tal char(1), num_tal int,importe_imp float)
insert into cc_vta_tmp values(usuario_cc , n_factura , cod_tal , num_tal ,importe_imp) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_cc_vta_detalle` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_cc_vta_detalle` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_cc_vta_detalle`(n_factura int, cod_talonario char(1), num_talonario int , num_recibo int, codigo_tal char(1), numero_tal int, importe float , fecha int, obs text, usuario_cc text)
insert into cc_vta_detalle (n_factura , cod_talonario , num_talonario  , num_recibo , cod_talonario_recibo, num_talonario_recibo , importe , fecha , observacion , usuario) values( n_factura , cod_talonario , num_talonario  , num_recibo , codigo_tal , numero_tal , importe  , fecha , obs , usuario_cc) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_cliente` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_cliente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_cliente`(codigo int,razon text,cuit text,dir text,tel text,fax text,cel text,contacto text,web text,mail text,lim_cred text,cod_iva int,cod_zona int,cod_loca int,cod_prov int,cod_pais int,cod_cat int,cod_ven int,cod_rep int,cod_tal char(1),fp int)
insert into cliente(cod_cliente,razon_social,cuit,direccion,tel,fax,movil,nombre,web,email,limite_credito,cod_iva,cod_zona,cod_localidad,cod_prov,cod_pais,cod_categoria,cod_vendedor,cod_flero,cod_talonario,cod_fp,orden, activo)values(codigo,razon,cuit,dir,tel,fax,cel,contacto,web,mail,lim_cred,cod_iva,cod_zona,cod_loca,cod_prov,cod_pais,cod_cat,cod_ven,cod_rep,cod_tal,fp,0,'S') */$$
DELIMITER ;

/* Procedure structure for procedure `alta_cond_iva` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_cond_iva` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_cond_iva`(idnombre int, comp char(1),nomb text,cuit char(1) )
insert into iva (cod_iva, cod_talonario, nombre,cuit) values (idnombre, comp, nomb,cuit) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_deposito_compra` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_deposito_compra` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_deposito_compra`(fecha_dep int,hora_dep char (20),banco text,trans char (20), cta char (20), titular text,importe float, obs char (20))
insert into deposito(fecha, hora, banco, n_trans, n_cta, titular, importe, observacion)values(fecha_dep ,hora_dep ,banco ,trans , cta , titular ,importe , obs) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_devolucion` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_devolucion` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_devolucion`(num_devolucion int,vendedor int,cod_tt text,numero_tal int,fecha_rebote int,fecha_carga int)
insert into devolucion values(num_devolucion ,vendedor ,cod_tt, numero_tal ,fecha_rebote ,fecha_carga) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_devolucion_detalle` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_devolucion_detalle` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_devolucion_detalle`(num_devolucion int,cod_producto int,cod_variedad int,cod_marca int,cod_grupo int,cantidad float,precio float)
insert into devolucion_detalle values(num_devolucion ,cod_producto ,cod_variedad ,cod_marca ,cod_grupo ,cantidad, precio) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_devolucion_tmp` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_devolucion_tmp` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_devolucion_tmp`(usuario text, codigo_art int,descri text,precio float,cant_art float, linea int)
insert into devolucion_detalle_tmp values(usuario, codigo_art, descri,precio,cant_art,linea) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_empresa` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_empresa` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_empresa`(razon text,dueno text,cuit text, ing_bruto text, iva text, fecha int,tel text,fax text,cel text,dir text, pais text, prov text, localidad text, web text, mail text,logo text, fondo text)
insert into empresa(dueno,razon_social,cuit,ing_bruto,iva,inicio_act,tel,fax,movil,direccion,pais,provincia,localidad,web,email,logo,imagen_fondo)values(dueno,razon,cuit,ing_bruto,iva,fecha,tel,fax,cel,dir,pais,prov,localidad,web,mail,logo,fondo) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_factura_compra` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_factura_compra` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_factura_compra`(factura INT,sucursal INT,proveedor INT,fecha_factura INT,subtotal FLOAT, imp_int_ali FLOAT, imp_int_imp FLOAT, iva_ali FLOAT, iva_imp FLOAT, perc_iva_ali FLOAT, perc_iva_imp FLOAT, pib_ali FLOAT , pib_imp FLOAT, otros_ali FLOAT, otros_imp FLOAT, total FLOAT , fecha_fac INT,obs TEXT, usuario_fac TEXT,id_deposito int)
INSERT INTO factura_compra VALUES(factura ,sucursal ,proveedor ,fecha_factura ,subtotal , imp_int_ali , imp_int_imp , iva_ali , iva_imp , perc_iva_ali , perc_iva_imp , pib_ali  , pib_imp , otros_ali , otros_imp , total  , fecha_fac ,obs , usuario_fac, id_deposito) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_factura_compra_detalle` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_factura_compra_detalle` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_factura_compra_detalle`(factura int, sucursal int, cod_prod int,cod_variedad int,cod_marca int,cod_grupo int, prov int,precio float,cantidad float,bonificacion float, importe float)
insert into factura_compra_detalle values(cod_prod ,cod_variedad,cod_marca ,cod_grupo ,factura , sucursal , prov, precio, cantidad ,bonificacion,importe) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_factura_compra_tmp` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_factura_compra_tmp` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_factura_compra_tmp`(usuario text, codigo_art int,descripcion text,cant_art float,precio_art float,bonif_art float, importe float, linea int)
insert into factura_compra_tmp values(usuario, codigo_art, descripcion, cant_art, precio_art, bonif_art,importe,linea) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_factura_vta` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_factura_vta` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_factura_vta`(numero_fac int,fecha int,lugar text,hora text,cod_cliente int,cod_zona int,cod_localidad int,cod_prov int,cod_pais int,numero_rem int,codigo_tal char(1),numero_tal int,categoria int,vendedor int,repartidor int,obs text,tasa_iva float,tasa_perc_iva float,tasa_img_bruto float,monto_imp_int float,usuario_fac text,forma_pago int)
insert into factura_vta values(numero_fac,fecha,hora,lugar,obs,categoria,cod_cliente,cod_zona,cod_localidad,cod_prov,cod_pais, numero_rem ,codigo_tal ,numero_tal,vendedor ,repartidor ,tasa_iva,monto_imp_int, tasa_perc_iva,tasa_img_bruto,usuario_fac,forma_pago) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_factura_vta_detalle` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_factura_vta_detalle` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_factura_vta_detalle`(numero int,cod_prod int,cod_variedad int,cod_marca int,cod_grupo int,cantidad float,precio float,bonificacion float,codigo_tal char(1),numero_tal int,tasa_iva float)
insert into factura_vta_detalle values(numero ,cod_prod ,cod_variedad,cod_marca ,cod_grupo ,cantidad ,precio ,bonificacion,codigo_tal ,numero_tal,tasa_iva) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_factura_vta_detalle_no_cliente` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_factura_vta_detalle_no_cliente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_factura_vta_detalle_no_cliente`(numero int,cod_prod int,cod_variedad int,cod_marca int,cod_grupo int,cantidad float,precio float,bonificacion float,codigo_tal char(1),numero_tal int,tasa_iva float)
insert into factura_vta_no_cliente_detalle values(numero ,cod_prod ,cod_variedad,cod_marca ,cod_grupo ,cantidad ,precio ,bonificacion,codigo_tal ,numero_tal,tasa_iva) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_factura_vta_no_cliente` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_factura_vta_no_cliente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_factura_vta_no_cliente`(num_factura int,fecha int,lugar text,hora text,obs text,razon text,cod_zona int,dir text,localidad text,provincia text,cond_iva int,cuit varchar(11),categoria int,vendedor int,repartidor int,codigo_tal char(1),numero_tal int,numero_rem int,tasa_iva float,monto_imp_int float,tasa_perc_iva float,tasa_img_bruto float,usuario_fac text,forma_pago int)
insert into factura_vta_no_cliente values(num_factura ,fecha ,lugar ,hora ,obs ,razon ,cod_zona ,dir ,localidad ,provincia ,cond_iva ,cuit ,categoria ,vendedor ,repartidor ,codigo_tal ,numero_tal ,numero_rem ,tasa_iva ,monto_imp_int ,tasa_perc_iva ,tasa_img_bruto ,usuario_fac ,forma_pago) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_factura_vta_tmp` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_factura_vta_tmp` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_factura_vta_tmp`(usuario text, codigo_art int,descripcion text,cant_art float,precio_art float,bonif_art float, importe float, linea int,tasa_iva float)
insert into factura_vta_tmp values(usuario, codigo_art, descripcion, cant_art, precio_art, bonif_art,importe,linea,tasa_iva) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_fp` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_fp` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_fp`(nombre text, obs text)
insert into forma_pago (descripcion, observacion) values (nombre , obs) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_gasto` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_gasto` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_gasto`(fecha int , hora char(20), descri text, importe float, observ text )
insert into gastos (fecha, hora, descripcion, importe, observacion) values (fecha , hora, descri , importe , observ) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_grupo` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_grupo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_grupo`(codigo int, nombre text)
insert into grupo values(codigo, nombre) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_imp_int` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_imp_int` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_imp_int`(nombre text, tasa float)
insert into imp_interno (nombre, tasa)values (nombre, tasa) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_ingreso_stock` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_ingreso_stock` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_ingreso_stock`(fecha_stock int, usuario text)
insert into stock_inicial values(fecha_stock , usuario) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_ing_bruto` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_ing_bruto` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_ing_bruto`(nombre text, tasa float, cod_prov int, cod_pais int )
insert into ing_bruto (nombre, tasa, cod_prov, cod_pais)values (nombre, tasa, cod_prov , cod_pais) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_iva` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_iva` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_iva`(nombre_iva text, tasa float)
insert into alicuota_iva (nombre, tasa) values(nombre_iva, tasa) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_localidad` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_localidad` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_localidad`(cod_prov int,cod_pais int,nombre_loca text,cp_loca int)
insert into localidad (cod_prov,cod_pais,nombre,cp) values(cod_prov,cod_pais,nombre_loca,cp_loca) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_marca` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_marca` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_marca`(codigo int,nombre text,grupo int)
insert into marca values(codigo,grupo,nombre) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_medida` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_medida` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_medida`(nombre_med text)
insert into medida (unidad_de_medida ) values(nombre_med) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_orden_cliente` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_orden_cliente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`dba`@`10.1.1.50` PROCEDURE `alta_orden_cliente`(cliente int,orden_n int)
update cliente set orden = orden_n where cod_cliente = cliente */$$
DELIMITER ;

/* Procedure structure for procedure `alta_pago_cc_vta` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_pago_cc_vta` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_pago_cc_vta`(num_recibo int, cod_cliente int, cod_zona int, cod_loca int, cod_prov int, cod_pais int, codigo_tal char(1), numero_tal int, importe float, vendedor int, fecha int, obs text,usuario_cc text)
insert into cc_vta values(num_recibo, cod_cliente, cod_zona, cod_loca, cod_prov, cod_pais, codigo_tal, numero_tal, importe, vendedor, fecha, obs, usuario_cc) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_pais` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_pais` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_pais`(nombre_p text)
insert into pais (nombre) values(nombre_p) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_pedido_odb` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_pedido_odb` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_pedido_odb`(id_fila int,nombre_p text, id_dep_p int, cod_p int, cant_p float, peso_p float, tipo_p char(1), estado_p char(1))
insert into pedidos values(id_fila, nombre_p, id_dep_p, cod_p , cant_p , peso_p , tipo_p , estado_p) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_persona_agenda` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_persona_agenda` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_persona_agenda`(nombre char (50), tel char (50), mail char (50))
insert into agenda (nombre, telefono, correo) values (nombre, tel, mail) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_pi` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_pi` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_pi`(nombre text, tasa float)
insert into perc_iva (nombre, tasa)values (nombre, tasa) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_presupuesto_vta` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_presupuesto_vta` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_presupuesto_vta`(numero_presu INT,fecha INT,lugar TEXT,hora TEXT,cod_cliente INT,cod_zona INT,cod_localidad INT,cod_prov INT,cod_pais INT,numero_rem INT,codigo_tal CHAR(1),numero_tal INT,categoria INT,vendedor INT,repartidor INT,obs TEXT,tasa_iva FLOAT,tasa_perc_iva FLOAT,tasa_img_bruto FLOAT,monto_imp_int FLOAT,usuario_fac TEXT,forma_pago INT)
INSERT INTO presupuesto_vta VALUES(numero_presu,fecha,hora,lugar,obs,categoria,cod_cliente,cod_zona,cod_localidad,cod_prov,cod_pais, numero_rem ,codigo_tal ,numero_tal,vendedor ,repartidor ,tasa_iva,monto_imp_int, tasa_perc_iva,tasa_img_bruto,usuario_fac,forma_pago) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_presupuesto_vta_detalle` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_presupuesto_vta_detalle` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_presupuesto_vta_detalle`(numero INT,cod_prod INT,cod_variedad INT,cod_marca INT,cod_grupo INT,cantidad FLOAT,precio FLOAT,bonificacion FLOAT,codigo_tal CHAR(1),numero_tal INT,tasa_iva FLOAT)
INSERT INTO presupuesto_vta_detalle VALUES(numero ,cod_prod ,cod_variedad,cod_marca ,cod_grupo ,cantidad ,precio ,bonificacion,codigo_tal ,numero_tal,tasa_iva) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_presupuesto_vta_detalle_no_cliente` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_presupuesto_vta_detalle_no_cliente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_presupuesto_vta_detalle_no_cliente`(numero INT,cod_prod INT,cod_variedad INT,cod_marca INT,cod_grupo INT,cantidad FLOAT,precio FLOAT,bonificacion FLOAT,codigo_tal CHAR(1),numero_tal INT,tasa_iva FLOAT)
INSERT INTO presupuesto_vta_no_cliente_detalle VALUES(numero ,cod_prod ,cod_variedad,cod_marca ,cod_grupo ,cantidad ,precio ,bonificacion,codigo_tal ,numero_tal,tasa_iva) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_presupuesto_vta_no_cliente` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_presupuesto_vta_no_cliente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_presupuesto_vta_no_cliente`(num_presu INT,fecha INT,lugar TEXT,hora TEXT,obs TEXT,razon TEXT,cod_zona INT,dir TEXT,localidad TEXT,provincia TEXT,cond_iva INT,cuit VARCHAR(11),categoria INT,vendedor INT,repartidor INT,codigo_tal CHAR(1),numero_tal INT,numero_rem INT,tasa_iva FLOAT,monto_imp_int FLOAT,tasa_perc_iva FLOAT,tasa_img_bruto FLOAT,usuario_fac TEXT,forma_pago INT)
INSERT INTO presupuesto_vta_no_cliente VALUES(num_presu ,fecha ,lugar ,hora ,obs ,razon ,cod_zona ,dir ,localidad ,provincia ,cond_iva ,cuit ,categoria ,vendedor ,repartidor ,codigo_tal ,numero_tal ,numero_rem ,tasa_iva ,monto_imp_int ,tasa_perc_iva ,tasa_img_bruto ,usuario_fac ,forma_pago) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_presupuesto_vta_tmp` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_presupuesto_vta_tmp` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_presupuesto_vta_tmp`(usuario TEXT, codigo_art INT,descripcion TEXT,cant_art FLOAT,precio_art FLOAT,bonif_art FLOAT, importe FLOAT, linea INT,tasa_iva FLOAT)
INSERT INTO presupuesto_vta_tmp VALUES(usuario, codigo_art, descripcion, cant_art, precio_art, bonif_art,importe,linea,tasa_iva) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_producto` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_producto` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_producto`(codigo int,variedad int,marca int,grupo int,descri text ,precio_costo float,envase char(2),stock_actual float,stock_min float,stock_max float,foto text,proveedor int,medida float,cod_medida int,porc_vta float,porc_trans float,unidad_bulto int,peso float,iva float)
insert into producto values(codigo,variedad,marca,grupo,descri,precio_costo,envase,stock_actual,stock_min,stock_max,foto,proveedor,medida,cod_medida,porc_vta,porc_trans,unidad_bulto,peso,'S',iva) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_prod_por_cat` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_prod_por_cat` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_prod_por_cat`(codigo_cat int,codigo_prod int,variedad int,marca int,grupo int,precio_cat float)
insert into prod_por_categ values(codigo_cat,codigo_prod,variedad,marca,grupo,precio_cat) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_proveedor` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_proveedor` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_proveedor`(codigo int,razon text,cuit text,ing_bruto text,dir text,tel text,fax text,cel text,contacto text,web text,mail text,lim_cred text,agente char,iva text,cod_loca int,cod_prov int,cod_pais int)
insert into proveedor(cod_proveedor,razon_social,cuit,ingreso_bruto,direccion,tel,fax,movil,contacto,web,email,limite_cred,agente_retencion,cond_iva,cod_localidad,cod_prov,cod_pais)values(codigo,razon,cuit,ing_bruto,dir,tel,fax,cel,contacto,web,mail,lim_cred,agente,iva,cod_loca,cod_prov,cod_pais) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_provincia` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_provincia` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_provincia`(cod_pais int,nombre text)
insert into provincia (cod_pais , nombre) values(cod_pais , nombre) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_remito_vta` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_remito_vta` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_remito_vta`(numero_rem int,fecha int,lugar text,hora text,cod_cliente int,cod_zona int,cod_localidad int,cod_prov int,cod_pais int, codigo_tal char(1),numero_tal int,categoria int, vendedor int,repartidor int,obs text,estado varchar(1))
insert into remito_vta values(numero_rem ,fecha ,lugar ,hora ,cod_cliente,cod_zona ,cod_localidad ,cod_prov ,cod_pais ,codigo_tal ,numero_tal, categoria, vendedor ,repartidor ,obs,estado) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_remito_vta_detalle` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_remito_vta_detalle` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_remito_vta_detalle`(numero_rem int,cod_prod int,cod_variedad int,cod_marca int,cod_grupo int,cantidad float,precio float,bonificacion float)
insert into remito_vta_detalle values(numero_rem ,cod_prod ,cod_variedad,cod_marca ,cod_grupo ,cantidad ,precio ,bonificacion) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_remito_vta_detalle_no_cliente` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_remito_vta_detalle_no_cliente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_remito_vta_detalle_no_cliente`(numero_rem int,cod_prod int,cod_variedad int,cod_marca int,cod_grupo int,cantidad float,precio float,bonificacion float)
insert into remito_vta_detalle_no_cliente values(numero_rem ,cod_prod ,cod_variedad,cod_marca ,cod_grupo ,cantidad ,precio ,bonificacion) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_remito_vta_no_cliente` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_remito_vta_no_cliente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_remito_vta_no_cliente`(numero_rem int,fecha int,lugar text,hora text,codigo_tal char(1),numero_tal int,razon text,dir text,localidad text, provincia text,iva text, cuit varchar(11),categoria int,vendedor int,repartidor int,obs text,cod_zona int,estado varchar(1))
insert into remito_vta_no_cliente values(numero_rem ,fecha ,lugar ,hora ,codigo_tal ,numero_tal ,razon ,dir ,localidad ,provincia ,iva ,cuit ,categoria ,vendedor ,repartidor ,obs,cod_zona,estado) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_remito_vta_tmp` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_remito_vta_tmp` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_remito_vta_tmp`(usuario text, codigo_art int,descripcion text,cant_art float,precio_art float,bonif_art float, importe float, linea int,tasa_iva float)
insert into remito_vta_tmp values(usuario, codigo_art, descripcion, cant_art, precio_art, bonif_art,importe,linea, tasa_iva) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_repartidor` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_repartidor` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_repartidor`(codigo int,dni int,nombre text,dir text,tel text,cuit text,cod_loca int,cod_prov int,cod_pais int,cod_iva int,cod_tal char(1))
insert into fletero(cod_flero,dni,nombre,domicilio,tel,cuit,cod_localidad,cod_prov,cod_pais,cod_iva,cod_talonario) values(codigo,dni,nombre,dir,tel,cuit,cod_loca,cod_prov,cod_pais,cod_iva,cod_tal) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_repartidor_x_vehi` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_repartidor_x_vehi` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_repartidor_x_vehi`(cod_fletero int,cod_vehiculo int)
insert into fletero_por_vehiculo values(cod_fletero,cod_vehiculo) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_talonario` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_talonario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_talonario`(codigo_tt char(1),numero int,sucursal int,iteraciones int,primer_num int,ultimo_num int,sig_num int,fecha int,impr text,cai text)
insert into talonario values(codigo_tt,numero,sucursal,impr,iteraciones,primer_num,ultimo_num,sig_num,fecha,cai) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_tipo_asociado` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_tipo_asociado` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_tipo_asociado`(letra char(1))
insert into tipo_asociado values(letra) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_tipo_talonario` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_tipo_talonario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_tipo_talonario`(codigo char(1),descri text,cant_copias int)
insert into tipo_talonario values(codigo,descri,cant_copias) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_url_sis_preventa` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_url_sis_preventa` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_url_sis_preventa`(nombre text)
begin	
	truncate table sis_preventa;
	insert into sis_preventa values(nombre);
end */$$
DELIMITER ;

/* Procedure structure for procedure `alta_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_usuario`( usuario_reg char(20), clave_reg text, nombre text,abm_zonas_geo char(1), abm_alicuotas varchar(1),   abm_comprobante varchar(1),   abm_cond_iva varchar(1),   abm_talonario varchar(1),   abm_proveedor varchar(1),   abm_vehiculo varchar(1),   abm_repartidor varchar(1),   abm_vendedor varchar(1),   abm_categoria varchar(1),   abm_forma_pago varchar(1),   abm_cliente varchar(1),   abm_articulo varchar(1),   datos_empresa varchar(1),   conf_listados varchar(1),   abm_usuarios varchar(1),   stock varchar(1),   factura_compra varchar(1),   remito_vta varchar(1),   factura_vta varchar(1),   nota_credito varchar(1),  cta_cte varchar(1) ,comisiones varchar(1),   devoluciones varchar(1),   finalizar_carga varchar(1),   informes varchar(1),   estadisticas varchar(1),   utilidades varchar(1))
insert into usuario ( usuario , clave , nombre ,abm_zonas_geo , abm_alicuotas ,   abm_comprobante ,   abm_cond_iva ,   abm_talonario ,   abm_proveedor ,   abm_vehiculo ,   abm_repartidor ,   abm_vendedor ,   abm_categoria ,   abm_forma_pago ,   abm_cliente ,   abm_articulo ,   datos_empresa ,   conf_listados ,   abm_usuarios ,   stock ,   factura_compra ,   remito_vta ,   factura_vta ,   nota_credito ,   cta_cte ,comisiones ,   devoluciones ,   finalizar_carga ,   informes ,   estadisticas ,   utilidades, activo ) values  ( usuario_reg , clave_reg , nombre ,abm_zonas_geo , abm_alicuotas ,   abm_comprobante ,   abm_cond_iva ,   abm_talonario ,   abm_proveedor ,   abm_vehiculo ,   abm_repartidor ,   abm_vendedor ,   abm_categoria ,   abm_forma_pago ,   abm_cliente ,   abm_articulo ,   datos_empresa ,   conf_listados ,   abm_usuarios ,   stock ,   factura_compra ,   remito_vta ,   factura_vta ,   nota_credito ,  cta_cte ,comisiones ,   devoluciones ,   finalizar_carga ,   informes ,   estadisticas ,   utilidades, 'S' ) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_variedad` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_variedad` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_variedad`(codigo int,nombre text,grupo int,marca int)
insert into variedad values(codigo,marca,grupo,nombre) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_vehiculo` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_vehiculo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_vehiculo`(codigo int,patente text, patente_a text, marca text, modelo text, propio text)
insert into vehiculo(cod_vehiculo,patente, patente_acop, marca, modelo, propiedad)values(codigo,patente, patente_a, marca, modelo, propio) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_vendedor` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_vendedor` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_vendedor`(codigo int,dni int,nombre text,dir text,tel text,cod_loca int,cod_prov int,cod_pais int)
insert into vendedor(cod_vendedor,dni,nombre,direccion,tel,cod_localidad,cod_prov,cod_pais) values(codigo,dni,nombre,dir,tel,cod_loca,cod_prov,cod_pais) */$$
DELIMITER ;

/* Procedure structure for procedure `alta_zona` */

/*!50003 DROP PROCEDURE IF EXISTS  `alta_zona` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_zona`(cod_loca int, cod_prov int, cod_pais int, nombre_zona text, p_vta float, p_trans float)
insert into zona (cod_localidad, cod_prov, cod_pais, nombre, porc_vta, porc_transporte) values(cod_loca, cod_prov, cod_pais, nombre_zona, p_vta, p_trans) */$$
DELIMITER ;

/* Procedure structure for procedure `anular_factura_vta` */

/*!50003 DROP PROCEDURE IF EXISTS  `anular_factura_vta` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `anular_factura_vta`(cod_tal text, num_tal int, num_factura int,usuario_anular text)
BEGIN
  update factura_vta_no_cliente set observacion = 'ANULADO',usuario = usuario_anular where n_factura= num_factura and cod_talonario=cod_tal and num_talonario = num_tal;
  update factura_vta set observacion = 'ANULADO',usuario = usuario_anular where n_factura= num_factura and cod_talonario=cod_tal and num_talonario = num_tal;
END */$$
DELIMITER ;

/* Procedure structure for procedure `anular_factura_vta_detalle` */

/*!50003 DROP PROCEDURE IF EXISTS  `anular_factura_vta_detalle` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `anular_factura_vta_detalle`(codigo int,cantidad float)
BEGIN
update producto set stock_actual= stock_actual + cantidad where concat(cod_grupo,cod_marca,cod_variedad,cod_prod)= codigo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `anular_factura_vta_numeracion` */

/*!50003 DROP PROCEDURE IF EXISTS  `anular_factura_vta_numeracion` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `anular_factura_vta_numeracion`(cod_tal text, num_tal int,sucursal int, num_factura int, usuario_anular text,fecha integer )
BEGIN
	INSERT INTO factura_anulada_numeracion values(cod_tal , num_tal, sucursal , num_factura, usuario_anular, fecha);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `aumentar_stock` */

/*!50003 DROP PROCEDURE IF EXISTS  `aumentar_stock` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `aumentar_stock`(cod_p int,cod_v int ,cod_m int ,cod_g int,cant float)
update producto set stock_actual = producto.stock_actual + cant where cod_prod=cod_p and cod_variedad=cod_v  and cod_marca=cod_m and cod_grupo=cod_g */$$
DELIMITER ;

/* Procedure structure for procedure `corrimiento_orden_cliente` */

/*!50003 DROP PROCEDURE IF EXISTS  `corrimiento_orden_cliente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `corrimiento_orden_cliente`(cod_zona_p int, orden_p int)
UPDATE cliente set orden = orden + 1 where cod_zona = cod_zona_p and orden >= orden_p */$$
DELIMITER ;

/* Procedure structure for procedure `descontar_stock` */

/*!50003 DROP PROCEDURE IF EXISTS  `descontar_stock` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `descontar_stock`(cod_p int,cod_v int ,cod_m int ,cod_g int,cant float)
update producto set stock_actual = producto.stock_actual - cant where cod_prod=cod_p and cod_variedad=cod_v  and cod_marca=cod_m and cod_grupo=cod_g */$$
DELIMITER ;

/* Procedure structure for procedure `eliminar_art_asociado` */

/*!50003 DROP PROCEDURE IF EXISTS  `eliminar_art_asociado` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_art_asociado`(cod int)
delete from art_especial where codigo = cod */$$
DELIMITER ;

/* Procedure structure for procedure `eliminar_cc_tmp` */

/*!50003 DROP PROCEDURE IF EXISTS  `eliminar_cc_tmp` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_cc_tmp`(usuario_cc text, n_fact int, cod_tal char(1), num_tal int)
delete from cc_vta_tmp where usuario = usuario_cc and n_factura = n_fact and cod_talonario = cod_tal and num_talonario = num_tal */$$
DELIMITER ;

/* Procedure structure for procedure `eliminar_ib` */

/*!50003 DROP PROCEDURE IF EXISTS  `eliminar_ib` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_ib`(codigo int)
delete from ing_bruto where cod_ing_bruto = codigo */$$
DELIMITER ;

/* Procedure structure for procedure `eliminar_ii` */

/*!50003 DROP PROCEDURE IF EXISTS  `eliminar_ii` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_ii`(codigo int)
delete from imp_interno where cod_imp_interno = codigo */$$
DELIMITER ;

/* Procedure structure for procedure `eliminar_iva` */

/*!50003 DROP PROCEDURE IF EXISTS  `eliminar_iva` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_iva`(codigo int)
delete from alicuota_iva where cod_iva = codigo */$$
DELIMITER ;

/* Procedure structure for procedure `eliminar_linea_devolucion` */

/*!50003 DROP PROCEDURE IF EXISTS  `eliminar_linea_devolucion` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_linea_devolucion`(usuario_dev text,fila int)
delete from devolucion_detalle_tmp where usuario=usuario_dev and linea = fila */$$
DELIMITER ;

/* Procedure structure for procedure `eliminar_linea_factura_compra` */

/*!50003 DROP PROCEDURE IF EXISTS  `eliminar_linea_factura_compra` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_linea_factura_compra`(usuario_fac text,fila int)
delete from factura_compra_tmp where usuario=usuario_fac and linea = fila */$$
DELIMITER ;

/* Procedure structure for procedure `eliminar_linea_factura_vta` */

/*!50003 DROP PROCEDURE IF EXISTS  `eliminar_linea_factura_vta` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_linea_factura_vta`(usuario_rem text,fila int)
delete from factura_vta_tmp where usuario=usuario_rem and linea = fila */$$
DELIMITER ;

/* Procedure structure for procedure `eliminar_linea_remito_vta` */

/*!50003 DROP PROCEDURE IF EXISTS  `eliminar_linea_remito_vta` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_linea_remito_vta`(usuario_rem text,fila int)
delete from remito_vta_tmp where usuario=usuario_rem and linea = fila */$$
DELIMITER ;

/* Procedure structure for procedure `eliminar_localidad` */

/*!50003 DROP PROCEDURE IF EXISTS  `eliminar_localidad` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_localidad`(codigo int)
delete from localidad where cod_localidad = codigo */$$
DELIMITER ;

/* Procedure structure for procedure `eliminar_pais` */

/*!50003 DROP PROCEDURE IF EXISTS  `eliminar_pais` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_pais`(codigo_pais int)
delete from pais where cod_pais = codigo_pais */$$
DELIMITER ;

/* Procedure structure for procedure `eliminar_pi` */

/*!50003 DROP PROCEDURE IF EXISTS  `eliminar_pi` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_pi`(codigo int)
delete from perc_iva where cod_perc_iva = codigo */$$
DELIMITER ;

/* Procedure structure for procedure `eliminar_provincia` */

/*!50003 DROP PROCEDURE IF EXISTS  `eliminar_provincia` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_provincia`(codigo int)
delete from provincia where cod_prov = codigo */$$
DELIMITER ;

/* Procedure structure for procedure `eliminar_tipo_asociado` */

/*!50003 DROP PROCEDURE IF EXISTS  `eliminar_tipo_asociado` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_tipo_asociado`(varletra char(1))
delete from tipo_asociado where letra = varletra */$$
DELIMITER ;

/* Procedure structure for procedure `eliminar_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `eliminar_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_usuario`(codigo_usuario int)
update usuario set activo= 'N' where cod_usuario = codigo_usuario */$$
DELIMITER ;

/* Procedure structure for procedure `eliminar_zona` */

/*!50003 DROP PROCEDURE IF EXISTS  `eliminar_zona` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_zona`(codigo int)
delete from zona where cod_zona = codigo */$$
DELIMITER ;

/* Procedure structure for procedure `finalizar_carga` */

/*!50003 DROP PROCEDURE IF EXISTS  `finalizar_carga` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `finalizar_carga`(repartidor int,fecha_actual int,hora_actual text, usuario_carga text)
insert into cargas values(fecha_actual, repartidor, hora_actual, usuario_carga) */$$
DELIMITER ;

/* Procedure structure for procedure `liquidar_comision_vendedor` */

/*!50003 DROP PROCEDURE IF EXISTS  `liquidar_comision_vendedor` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `liquidar_comision_vendedor`(vendedor int,fecha_desde int,fecha_hasta int, fecha_liq int)
INSERT INTO comision_vendedor VALUES (vendedor, fecha_desde, fecha_hasta, fecha_liq) */$$
DELIMITER ;

/* Procedure structure for procedure `marcar_pedido` */

/*!50003 DROP PROCEDURE IF EXISTS  `marcar_pedido` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `marcar_pedido`(id_p int)
update pedidos set estado = 'F' where id = id_p */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_asignar_tal_recibo_cliente` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_asignar_tal_recibo_cliente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_asignar_tal_recibo_cliente`(cod_cliente int ,cod_zona int,cod_localidad int,cod_prov int,cod_pais int,n_talonario int,cod_tal char(1),num_tal_anterior int)
update recibos_por_cliente set num_talonario=n_talonario where cod_cliente=cod_cliente and  cod_zona=cod_zona and cod_localidad=cod_localidad and  cod_prov=cod_prov and cod_pais=cod_pais and cod_talonario=cod_tal and num_talonario=num_tal_anterior */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_categoria` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_categoria` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_categoria`(codigo_cat int ,nombre_cat text)
UPDATE categoria SET descripcion = nombre_cat WHERE cod_categoria = codigo_cat */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_cc_tmp` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_cc_tmp` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_cc_tmp`(usuario_cc text, n_factura int, cod_tal char(1), num_tal int,importe_imp float)
update cc_vta_tmp set importe = importe_imp  where usuario = usuario_cc and n_factura = n_factura and cod_talonario = cod_tal and num_talonario = num_tal */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_cliente` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_cliente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_cliente`(codigo_original int,codigo int,razon text,cuit text,cod_iva int,dir text,cod_pais int,cod_prov int,cod_loca int,cod_zona int,tel text,fax text,cel text,web text,mail text,contacto text,lim_cred text,cod_cat int,vendedor int,repartidor int,cod_tal char(1),fp int)
update cliente set cod_cliente = codigo, cod_zona = cod_zona, cod_localidad = cod_loca, cod_prov = cod_prov, cod_pais = cod_pais, nombre = contacto, razon_social = razon,tel = tel, fax = fax, movil = cel, direccion = dir, cuit = cuit, limite_credito = lim_cred, web = web, email= mail, cod_iva = cod_iva, cod_categoria = cod_cat, cod_vendedor = vendedor, cod_flero= repartidor, cod_talonario=cod_tal, cod_fp=fp where cod_cliente = codigo_original */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_cond_iva` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_cond_iva` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_cond_iva`(codigo int, cod_mod int, nombre text, comp char(1),cuit char(1))
update iva set cod_iva = cod_mod, cod_talonario=comp, nombre = nombre, cuit=cuit where cod_iva = codigo */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_datos_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_datos_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_datos_usuario`(usr text, usuario_mod text,clave_mod text)
if clave_mod <> 'd41d8cd98f00b204e9800998ecf8427e'then  /* clave vacia*/
	UPDATE usuario SET usuario = usuario_mod, clave = clave_mod WHERE usuario = usr;
ELSE
	UPDATE usuario SET usuario = usuario_mod WHERE usuario = usr;
END IF */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_estado_remito_vta` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_estado_remito_vta` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_estado_remito_vta`(num_rem int)
update remito_vta set pendiente = "N" where num_remito = num_rem */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_estado_remito_vta_no_cliente` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_estado_remito_vta_no_cliente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_estado_remito_vta_no_cliente`(num_rem int)
update remito_vta_no_cliente set pendiente = "N" where num_remito = num_rem */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_fp` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_fp` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_fp`(codigo_fp int,nombre_fp text,obs_fp_mod text)
update forma_pago set descripcion= nombre_fp, observacion=obs_fp_mod where cod_fp=codigo_fp */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_grupo` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_grupo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_grupo`(cod_orig int, codigo int, nombre text)
update grupo set cod_grupo=codigo, descripcion=nombre where cod_grupo = cod_orig */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_ib` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_ib` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_ib`(codigo int, nombre text, tasa float, cod_prov int, cod_pais int)
update ing_bruto set nombre = nombre, tasa = tasa, cod_prov = cod_prov , cod_pais = cod_pais where cod_ing_bruto = codigo */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_ii` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_ii` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_ii`(codigo int, nombre text, tasa float)
update imp_interno set nombre = nombre, tasa = tasa where cod_imp_interno = codigo */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_iva` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_iva` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_iva`(codigo int, nombre text, tasa float)
update alicuota_iva set nombre = nombre, tasa = tasa where cod_iva = codigo */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_localidad` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_localidad` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_localidad`(cod_loca int ,nombre_localidad text,cp int, cod_prov int,cod_pais int)
UPDATE localidad SET nombre = nombre_localidad , cod_prov = cod_prov , cod_pais = cod_pais, cp = cp where cod_localidad = cod_loca */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_marca` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_marca` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_marca`(codigo_orig int,codigo_mod int,nombre_mod text,cod_grupo_mod int, cod_grupo_orig int)
update marca set cod_marca=codigo_mod, descripcion= nombre_mod, cod_grupo=cod_grupo_mod where cod_marca=codigo_orig and cod_grupo=cod_grupo_orig */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_medida` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_medida` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_medida`(codigo_med int ,nombre_med text)
UPDATE medida SET  unidad_de_medida = nombre_med WHERE cod_medida = codigo_med */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_pais` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_pais` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_pais`(codigo_pais int ,nombre_pais text)
UPDATE pais SET nombre = nombre_pais WHERE cod_pais = codigo_pais */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_pi` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_pi` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_pi`(codigo int, nombre text, tasa float)
update perc_iva set nombre = nombre, tasa = tasa where cod_perc_iva = codigo */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_precio` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_precio` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_precio`(cod_producto int,cod_variedad int ,cod_marca int ,cod_grupo int , precio float)
update producto set precio_costo = precio where cod_prod = cod_producto and cod_variedad = cod_variedad and cod_marca = cod_marca and cod_grupo = cod_grupo */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_producto` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_producto` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_producto`(codigo_art_mod_orig int,grupo_orig int,marca_orig int,variedad_orig int,codigo_art_mod int,variedad int,marca int,grupo int,descri text,precio_costo float,envase char(2),stock_actual float,stock_min float,stock_max float,foto text,proveedor int,medida float,cod_medida int,porc_vta float,porc_trans float,unidad_bulto int,peso float,iva_m int)
update producto set cod_prod = codigo_art_mod, cod_variedad = variedad, cod_marca=marca, cod_grupo=grupo, descripcion=descri,  precio_costo=precio_costo, envase=envase, stock_actual=stock_actual, stock_min=stock_min, stock_max=stock_max, foto=foto, cod_proveedor=proveedor, medida=medida, cod_medida=cod_medida, porc_vta=porc_vta, porc_transporte=porc_trans, unidad_bulto=unidad_bulto, peso=peso, cod_iva=iva_m where cod_prod = codigo_art_mod_orig and cod_grupo=grupo_orig and cod_marca=marca_orig and cod_variedad=variedad_orig */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_prod_por_cat` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_prod_por_cat` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_prod_por_cat`(codigo_cat int,codigo_prod int,variedad int,marca int,grupo int,precio_cat float,codigo_prod_orig int,variedad_orig int,marca_orig int,grupo_orig int)
update prod_por_categ set cod_variedad=variedad, cod_marca=marca, cod_grupo=grupo, precio_vta=precio_cat where cod_categoria=codigo_cat and cod_prod=codigo_prod_orig and cod_variedad=variedad_orig and cod_marca=marca_orig and cod_grupo=grupo_orig */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_proveedor` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_proveedor` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_proveedor`(codigo_original int,codigo_proveedor_mod int,razon_proveedor_mod text,cuit_proveedor_mod text,ing_bruto_proveedor_mod text,dir_proveedor_mod text,tel_proveedor_mod text,fax_proveedor_mod text, cel_proveedor_mod text,contacto_proveedor_mod text,web_proveedor_mod text,mail_proveedor_mod text,lim_cred_proveedor_mod text,agente_proveedor_mod text,iva_proveedor_mod text,cod_loca_proveedor_mod int,cod_prov_proveedor_mod int, cod_pais_proveedor_mod int)
update proveedor set cod_proveedor = codigo_proveedor_mod, razon_social = razon_proveedor_mod, cuit = cuit_proveedor_mod, ingreso_bruto = ing_bruto_proveedor_mod, direccion = dir_proveedor_mod, tel = tel_proveedor_mod, fax = fax_proveedor_mod, movil = cel_proveedor_mod, contacto = contacto_proveedor_mod, web = web_proveedor_mod, email = mail_proveedor_mod, limite_cred = lim_cred_proveedor_mod, agente_retencion = agente_proveedor_mod, cond_iva = iva_proveedor_mod, cod_localidad = cod_loca_proveedor_mod, cod_prov = cod_prov_proveedor_mod,  cod_pais = cod_pais_proveedor_mod where cod_proveedor = codigo_original */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_provincia` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_provincia` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_provincia`(cod_p int, nombre_p text, cod_pai int)
UPDATE provincia SET nombre = nombre_p, cod_pais = cod_pai WHERE cod_prov = cod_p */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_repartidor` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_repartidor` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_repartidor`(codigo_original int,codigo int,dni int,nombre text,dir text,tel text,cuit text,localidad int,prov int,pais int,iva int,cod_tal char(1))
update fletero set cod_flero=codigo, dni=dni, nombre=nombre, domicilio=dir, tel=tel, cuit=cuit,  cod_localidad=localidad, cod_prov=prov,  cod_pais=pais, cod_iva=iva ,cod_talonario=cod_tal where cod_flero=codigo_original */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_repartidor_x_vehi` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_repartidor_x_vehi` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_repartidor_x_vehi`(cod_repartidor int, cod_vehiculo int)
update fletero_por_vehiculo set cod_vehiculo=cod_vehiculo where  cod_flero=cod_repartidor */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_stock` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_stock` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_stock`(cod_art int, cantidad float)
update producto set stock_actual = cantidad where concat(cod_grupo,cod_marca,cod_variedad,cod_prod) = cod_art */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_talonario` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_talonario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_talonario`(codigo_tt_orig char(1),numero_tal_orig int,codigo_tt char(1),numero_tal int,sucursal int,iteraciones int,primer_num int,ultimo_num int,sig_num int,fecha int,cai text,impr text)
update talonario set cod_talonario=codigo_tt, num_talonario=numero_tal, n_sucursal=sucursal, destino_impr=impr, max_iter=iteraciones, primer_num=primer_num, ultimo_num=ultimo_num, sig_num=sig_num, fecha_venc=fecha, num_cai=cai where num_talonario = numero_tal_orig and cod_talonario = codigo_tt_orig */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_tipo_talonario` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_tipo_talonario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_tipo_talonario`(codigo_orig char(1),codigo_mod char(1),desc_tt_mod text,cant_copias int)
update tipo_talonario set cod_talonario=codigo_mod, descripcion=desc_tt_mod, cant_copias=cant_copias where cod_talonario=codigo_orig */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_usuario`(codigo int, usuario char(20), nombre text,abm_zonas_geo char(1), abm_alicuotas varchar(1),   abm_comprobante varchar(1),   abm_cond_iva varchar(1),   abm_talonario varchar(1),   abm_proveedor varchar(1),   abm_vehiculo varchar(1),   abm_repartidor varchar(1),   abm_vendedor varchar(1),   abm_categoria varchar(1),   abm_forma_pago varchar(1),   abm_cliente varchar(1),   abm_articulo varchar(1),   datos_empresa varchar(1),   conf_listados varchar(1),   abm_usuarios varchar(1),   stock varchar(1),   factura_compra varchar(1),   remito_vta varchar(1),   factura_vta varchar(1),   nota_credito varchar(1),   cta_cte varchar(1), comisiones varchar(1),   devoluciones varchar(1),   finalizar_carga varchar(1),   informes varchar(1),   estadisticas varchar(1),   utilidades varchar(1))
update usuario set usuario=usuario, nombre=nombre, abm_zonas_geo=abm_zonas_geo, abm_alicuotas=abm_alicuotas, abm_comprobante= abm_comprobante,
abm_cond_iva=abm_cond_iva, abm_talonario=abm_talonario, abm_proveedor=abm_proveedor, abm_vehiculo=abm_vehiculo, abm_repartidor=abm_repartidor,
abm_vendedor=abm_vendedor, abm_categoria=abm_categoria, abm_forma_pago=abm_forma_pago, abm_cliente=abm_cliente, abm_articulo=abm_articulo,
datos_empresa=datos_empresa, conf_listados=conf_listados, abm_usuarios=abm_usuarios, stock=stock, factura_compra=factura_compra, remito_vta=remito_vta,
factura_vta=factura_vta, nota_credito=nota_credito, cta_cte=cta_cte, comisiones=comisiones, devoluciones=devoluciones, finalizar_carga=finalizar_carga, informes=informes,
estadisticas=estadisticas, utilidades=utilidades, activo='S' where cod_usuario = codigo */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_variedad` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_variedad` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_variedad`(codigo_orig int,codigo_mod int,nombre_mod text,cod_grupos int,cod_marcas int,cod_grupo_orig int,cod_marca_orig int)
update variedad set cod_variedad=codigo_mod, cod_marca=cod_marcas, cod_grupo=cod_grupos, descripcion= nombre_mod where cod_variedad = codigo_orig and cod_marca=cod_marca_orig and cod_grupo = cod_grupo_orig */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_vehiculo` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_vehiculo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_vehiculo`(codigo int,codigo_mod int, patente text, patente_a text, marca text, modelo text, propio text)
update vehiculo set cod_vehiculo = codigo_mod, patente = patente, patente_acop = patente_a, marca = marca, modelo = modelo, propiedad = propio where cod_vehiculo = codigo */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_vendedor` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_vendedor` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_vendedor`(codigo_original int,codigo int,dni int,nombre text,dir text,tel text,localidad int,prov int,pais int)
update vendedor set cod_vendedor=codigo, dni=dni, nombre=nombre, direccion=dir, tel=tel, cod_localidad=localidad, cod_prov=prov,  cod_pais=pais where cod_vendedor=codigo_original */$$
DELIMITER ;

/* Procedure structure for procedure `modificar_zona` */

/*!50003 DROP PROCEDURE IF EXISTS  `modificar_zona` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_zona`(codigo_zona_mod int,cod_loca int,cod_prov int,cod_pais int,nombre_zona_mod text, porc_vta_mod float, porc_trans_mod float)
UPDATE zona SET cod_localidad = cod_loca, cod_prov = cod_prov, cod_pais = cod_pais, nombre = nombre_zona_mod , porc_vta = porc_vta_mod, porc_transporte = porc_trans_mod where cod_zona = codigo_zona_mod */$$
DELIMITER ;

/* Procedure structure for procedure `ordenar_orden_cliente` */

/*!50003 DROP PROCEDURE IF EXISTS  `ordenar_orden_cliente` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `ordenar_orden_cliente`(orden_inicial int, cod_cliente_a_mod int)
UPDATE cliente set orden = orden_inicial where cod_cliente = cod_cliente_a_mod */$$
DELIMITER ;

/* Procedure structure for procedure `reiniciar_conf_listados` */

/*!50003 DROP PROCEDURE IF EXISTS  `reiniciar_conf_listados` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `reiniciar_conf_listados`()
truncate table conf_listados */$$
DELIMITER ;

/* Procedure structure for procedure `reiniciar_regular_comision` */

/*!50003 DROP PROCEDURE IF EXISTS  `reiniciar_regular_comision` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `reiniciar_regular_comision`()
truncate table regular_comision */$$
DELIMITER ;

/* Procedure structure for procedure `upload_fondo_empresa` */

/*!50003 DROP PROCEDURE IF EXISTS  `upload_fondo_empresa` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `upload_fondo_empresa`(foto_ok text)
update empresa set imagen_fondo=foto_ok */$$
DELIMITER ;

/* Procedure structure for procedure `upload_foto_producto` */

/*!50003 DROP PROCEDURE IF EXISTS  `upload_foto_producto` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `upload_foto_producto`(codigo_prod int, foto_ok text)
update producto set foto = foto_ok where cod_prod = codigo_prod */$$
DELIMITER ;

/* Procedure structure for procedure `upload_logo_empresa` */

/*!50003 DROP PROCEDURE IF EXISTS  `upload_logo_empresa` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `upload_logo_empresa`(foto_ok text)
update empresa set logo=foto_ok */$$
DELIMITER ;

/* Procedure structure for procedure `vaciar_tabla_cc_vta_tmp` */

/*!50003 DROP PROCEDURE IF EXISTS  `vaciar_tabla_cc_vta_tmp` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `vaciar_tabla_cc_vta_tmp`(usuario_cc text)
DELETE FROM cc_vta_tmp WHERE usuario = usuario_cc */$$
DELIMITER ;

/* Procedure structure for procedure `vaciar_tabla_devolucion_tmp` */

/*!50003 DROP PROCEDURE IF EXISTS  `vaciar_tabla_devolucion_tmp` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `vaciar_tabla_devolucion_tmp`(usuario_dev text)
DELETE FROM devolucion_detalle_tmp WHERE usuario = usuario_dev */$$
DELIMITER ;

/* Procedure structure for procedure `vaciar_tabla_dev_tmp` */

/*!50003 DROP PROCEDURE IF EXISTS  `vaciar_tabla_dev_tmp` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `vaciar_tabla_dev_tmp`(usuario_dev text)
DELETE FROM devolucion_detalle_tmp WHERE usuario = usuario_dev */$$
DELIMITER ;

/* Procedure structure for procedure `vaciar_tabla_fac_compra_tmp` */

/*!50003 DROP PROCEDURE IF EXISTS  `vaciar_tabla_fac_compra_tmp` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `vaciar_tabla_fac_compra_tmp`(usuario_fac text)
DELETE FROM factura_compra_tmp WHERE usuario = usuario_fac */$$
DELIMITER ;

/* Procedure structure for procedure `vaciar_tabla_fac_vta_tmp` */

/*!50003 DROP PROCEDURE IF EXISTS  `vaciar_tabla_fac_vta_tmp` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `vaciar_tabla_fac_vta_tmp`(usuario_fac text)
DELETE FROM factura_vta_tmp WHERE usuario = usuario_fac */$$
DELIMITER ;

/* Procedure structure for procedure `vaciar_tabla_presupuesto_vta_tmp` */

/*!50003 DROP PROCEDURE IF EXISTS  `vaciar_tabla_presupuesto_vta_tmp` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `vaciar_tabla_presupuesto_vta_tmp`(usuario_presu TEXT)
DELETE FROM presupuesto_vta_tmp WHERE usuario = usuario_presu */$$
DELIMITER ;

/* Procedure structure for procedure `vaciar_tabla_rem_vta_tmp` */

/*!50003 DROP PROCEDURE IF EXISTS  `vaciar_tabla_rem_vta_tmp` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `vaciar_tabla_rem_vta_tmp`(usuario_rem text)
DELETE FROM remito_vta_tmp WHERE usuario = usuario_rem */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
