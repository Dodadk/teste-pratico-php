# Host: localhost  (Version 5.7.21)
# Date: 2019-02-04 22:33:46
# Generator: MySQL-Front 6.1  (Build 1.26)


#
# Structure for table "clientes"
#

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `data_nascimento` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "clientes"
#

INSERT INTO `clientes` VALUES (1,'teste','1234','Douglas','1991-07-12'),(2,'teste1','1234','Felipe','1989-11-02');

#
# Structure for table "enderecos_entregas"
#

DROP TABLE IF EXISTS `enderecos_entregas`;
CREATE TABLE `enderecos_entregas` (
  `id` int(11) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `endereco` varchar(255) NOT NULL DEFAULT '',
  `numero` varchar(45) NOT NULL DEFAULT '',
  `complemento` varchar(255) NOT NULL DEFAULT '',
  `cep` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) NOT NULL DEFAULT '',
  `cidade` varchar(255) NOT NULL DEFAULT '',
  `uf` varchar(255) NOT NULL DEFAULT '',
  `token` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8;

#
# Data for table "enderecos_entregas"
#

INSERT INTO `enderecos_entregas` VALUES (00000000031,'Rua da Igreja','74','','25042320','Vila Santo Antônio','Duque de Caxias','RJ','1755f36cd2b196da719223496cd64966'),(00000000032,'Rua Delgado de Carvalho','74','','25040240','Vila Santo Antônio','Duque de Caxias','RJ','037f7f0dfe67275b2891828af058bcd7'),(00000000033,'Rua da Igreja','225','','25042320','Vila Santo Antônio','Duque de Caxias','RJ','2e6cdfe84a0322066976f0754a99d4d5'),(00000000034,'Rua Delgado de Carvalho','1245','','25040240','Vila Santo Antônio','Duque de Caxias','RJ','4cd70e7759db81b59a98555fd2d9c391'),(00000000035,'Rua Kemal Pacha','741','','25040220','Vila Santo Antônio','Duque de Caxias','RJ','7fec7e16438c1b8e658d0ae85f857545'),(00000000036,'Rua Kemal Pacha','13554','','25040220','Vila Santo Antônio','Duque de Caxias','RJ','6c9d5f00a6f26252d03ae3a04453e141'),(00000000037,'Rua Kemal Pacha','11235','','25040220','Vila Santo Antônio','Duque de Caxias','RJ','c4f24cafb6aef6cd022869e7b30d6d0a'),(00000000038,'Rua da Igreja','74','lt20 qd 48','25042320','Vila Santo Antônio','Duque de Caxias','RJ','ca02a1daf59955ec9efa323679067e2d');

#
# Structure for table "fabricantes"
#

DROP TABLE IF EXISTS `fabricantes`;
CREATE TABLE `fabricantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

#
# Data for table "fabricantes"
#

INSERT INTO `fabricantes` VALUES (1,'Asus'),(2,'Gigabite'),(3,'MSI'),(4,'Scandisk'),(5,'Kingston'),(6,'Samsung'),(7,'Western Digital'),(8,'Corsair'),(9,'Gougar'),(10,'EVGA');

#
# Structure for table "fornecedores"
#

DROP TABLE IF EXISTS `fornecedores`;
CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

#
# Data for table "fornecedores"
#

INSERT INTO `fornecedores` VALUES (1,'All Nations'),(2,'Alcateia');

#
# Structure for table "produtos"
#

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(255) DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `descricao` text,
  `referencia` varchar(255) NOT NULL,
  `fabricantes_id` int(11) NOT NULL,
  `fornecedores_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`fabricantes_id`,`fornecedores_id`),
  UNIQUE KEY `referencia_UNIQUE` (`referencia`),
  KEY `fk_Produtos_fabricantes1_idx` (`fabricantes_id`),
  KEY `fk_Produtos_fornecedores1_idx` (`fornecedores_id`),
  CONSTRAINT `fk_Produtos_fabricantes1` FOREIGN KEY (`fabricantes_id`) REFERENCES `fabricantes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Produtos_fornecedores1` FOREIGN KEY (`fornecedores_id`) REFERENCES `fornecedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

#
# Data for table "produtos"
#

INSERT INTO `produtos` VALUES (1,'https://www.asus.com/websites/global/products/wlwpxOCHGKQvVRLb/product_overview.jpg','M5A97 ',495.15,NULL,'#1154',1,1),(2,'https://megamamute.vteximg.com.br/arquivos/ids/6751744-1000-1000/59892_original.jpg?v=636310654906200000','GA-AX370',798.55,NULL,'#1153',2,1),(3,'https://adrenaline.uol.com.br/files/upload/reviews/2013/msi_z87-gd65_gaming/msi_z87-gd65_gaming_oficial_01.png','Z87-GD65',688.99,NULL,'#1152',3,2),(4,'https://www.hardware.com.br/static/20160523/msi.jpg','Z170A',885.99,NULL,'#1151',3,1),(5,'https://29028l.ha.azioncdn.net/img/2017/05/produto/47062/borda-ssd-sandisk-plus-25-240gb-sata-iii-6gbs-sdssda-240g.jpg','SSD ScanDisk 240GB',289.99,NULL,'#1157',4,2),(6,'https://images6.kabum.com.br/produtos/fotos/85196/85196_index_g.jpg','SSD Kingston 120GB',225.55,NULL,'#1198',5,2),(7,'https://www.bhphotovideo.com/images/images2500x2500/samsung_mz_76e1t0b_am_860_evo_1tb_internal_1382499.jpg','SSD Samsung 1TB',998.69,NULL,'#1150',6,2),(8,'https://assets.pcmag.com/media/images/483710-wd-blue-3d-ssd-m-2-1tb.jpg?width=810&height=456','SSD WD Blue M.2 1TB',1542.99,NULL,'#5574',7,1),(9,'http://s2.glbimg.com/kg3ntFcdwM6u_eVMmIrycrxw4t8=/695x0/s.glbimg.com/po/tt2/f/original/2015/03/30/fonte-corsair-cx-750w.jpg','Fonte Corsair CX750',356.99,NULL,'#8445',8,1),(10,'https://29028l.ha.azioncdn.net/img/2015/11/produto/24274/19/large/fonte-evga-600w-80plus-white-100w10600k1.jpg','Fonte EVGA 600W',389.00,NULL,'#4485',10,2);

#
# Structure for table "itemscompras"
#

DROP TABLE IF EXISTS `itemscompras`;
CREATE TABLE `itemscompras` (
  `Clientes_id` int(11) NOT NULL,
  `Vendas_id` int(11) NOT NULL DEFAULT '0',
  `Produtos_id` int(11) NOT NULL,
  `item_qts` int(11) DEFAULT NULL,
  `item_valor` decimal(10,2) NOT NULL,
  `DataDeCompra` datetime DEFAULT NULL,
  KEY `fk_Produtos_has_Clientes_Clientes1_idx` (`Clientes_id`),
  KEY `fk_Produtos_has_Clientes_Produtos_idx` (`Produtos_id`),
  CONSTRAINT `fk_Produtos_has_Clientes_Clientes1` FOREIGN KEY (`Clientes_id`) REFERENCES `clientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Produtos_has_Clientes_Produtos` FOREIGN KEY (`Produtos_id`) REFERENCES `produtos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# Data for table "itemscompras"
#

INSERT INTO `itemscompras` VALUES (1,29,1,1,495.15,'2019-01-29 05:34:36'),(1,29,6,16,225.55,'2019-01-29 05:34:36'),(1,29,9,6,356.99,'2019-01-29 05:34:36'),(1,29,10,1,389.00,'2019-01-29 05:34:36'),(1,30,9,4,356.99,'2019-02-04 17:37:39'),(1,30,1,7,495.15,'2019-02-04 17:37:39'),(1,30,10,100,389.00,'2019-02-04 17:37:39'),(1,31,1,7,495.15,'2019-02-04 17:43:45'),(1,32,10,1,389.00,'2019-02-04 19:31:25'),(1,33,6,5,225.55,'2019-02-04 19:32:10'),(1,34,1,2,495.15,'2019-02-04 19:34:09'),(1,34,9,4,356.99,'2019-02-04 19:34:09'),(1,34,6,1,225.55,'2019-02-04 19:34:09'),(1,34,8,6,1542.99,'2019-02-04 19:34:09'),(1,34,7,1,998.69,'2019-02-04 19:34:09'),(1,34,2,1,798.55,'2019-02-04 19:34:09'),(1,34,3,25,688.99,'2019-02-04 19:34:09'),(1,35,6,5,225.55,'2019-02-04 22:13:27'),(1,35,5,11,289.99,'2019-02-04 22:13:27'),(1,35,1,20,495.15,'2019-02-04 22:13:27'),(1,35,8,20,1542.99,'2019-02-04 22:13:27'),(1,35,4,1,885.99,'2019-02-04 22:13:27'),(1,35,2,1,798.55,'2019-02-04 22:13:27'),(1,35,3,1,688.99,'2019-02-04 22:13:27'),(1,35,10,1,389.00,'2019-02-04 22:13:27'),(1,35,9,5,356.99,'2019-02-04 22:13:27'),(1,36,9,6,356.99,'2019-02-04 22:26:08'),(1,36,1,12,495.15,'2019-02-04 22:26:08');

#
# Structure for table "vendas"
#

DROP TABLE IF EXISTS `vendas`;
CREATE TABLE `vendas` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Enderecos_Entregas_id` int(10) unsigned zerofill NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `data_venda` datetime DEFAULT NULL,
  `token` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `fk_Vendas_Enderecos_Entregas1_idx` (`Enderecos_Entregas_id`),
  CONSTRAINT `fk_Vendas_Enderecos_Entrega1` FOREIGN KEY (`Enderecos_Entregas_id`) REFERENCES `enderecos_entregas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

#
# Data for table "vendas"
#

INSERT INTO `vendas` VALUES (29,0000000031,6634.89,'2019-01-29 05:34:36','1755f36cd2b196da719223496cd64966'),(30,0000000032,43794.01,'2019-02-04 17:37:39','037f7f0dfe67275b2891828af058bcd7'),(31,0000000033,180276.15,'2019-02-04 17:43:45','2e6cdfe84a0322066976f0754a99d4d5'),(32,0000000034,389.00,'2019-02-04 19:31:25','4cd70e7759db81b59a98555fd2d9c391'),(33,0000000035,36712.99,'2019-02-04 19:32:10','7fec7e16438c1b8e658d0ae85f857545'),(34,0000000036,30923.74,'2019-02-04 19:34:09','6c9d5f00a6f26252d03ae3a04453e141'),(35,0000000037,49627.92,'2019-02-04 22:13:27','c4f24cafb6aef6cd022869e7b30d6d0a'),(36,0000000038,8083.74,'2019-02-04 22:26:08','ca02a1daf59955ec9efa323679067e2d');
