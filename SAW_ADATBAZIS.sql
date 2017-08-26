/*Table: SERVICE_ACTION_WORK*/
CREATE TABLE `SERVICE_ACTION_WORK` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `munkalapszam` int(11) unsigned NOT NULL,
  `id_eredmeny` int(11) unsigned NOT NULL,
  `megjegyzes` longtext,
  `technikus` smallint(5) unsigned NOT NULL,
  `felvivo` smallint(5) unsigned NOT NULL,
  `felvitel_ideje` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_igspn_statusz` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8


/*Table: SERVICE_ACTION_WORK_EVIDENCIA*/
CREATE TABLE `SERVICE_ACTION_WORK_EVIDENCIA` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_saw` int(11) unsigned NOT NULL,
  `fajl_eleresi_ut` varchar(255) NOT NULL,
  `feltoltes_datuma` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `torolt` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8


/*Table: SERVICE_ACTION_WORK_EREDMENY_ERTEKEK*/
CREATE TABLE `SERVICE_ACTION_WORK_EREDMENY_ERTEKEK` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `eredmeny` varchar(255) NOT NULL,
  `mutat` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8


/*Table: KAPCS_SERVICE_ACTION_WORK_EREDMENY_ERTEKEK_GARTIPUS*/
CREATE TABLE `KAPCS_SERVICE_ACTION_WORK_EREDMENY_ERTEKEK_GARTIPUS` (
  `id_eredmeny` int(11) unsigned NOT NULL,
  `id_gartipus` tinyint(5) unsigned NOT NULL,
  PRIMARY KEY (`id_eredmeny`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8


/*Table: IGSPN_STATUSZ*/
CREATE TABLE `IGSPN_STATUSZ` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nev` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

LEFT JOIN 
	KAPCS_SERVICE_ACTION_WORK_EREDMENY_ERTEKEK_GARTIPUS KSAW_ee_gartipus ON KSAW_ee_gartipus.id_eredmeny = SAW_ee.id
LEFT JOIN
	gartipus g ON g.id = KSAW_ee_gartipus.id_gartipus
	
	
SELECT 
	SAW.munkalapszam,
	pcs.nev_group_partner AS 'partner_csoport',
	g.nev AS 'gartipus',
	gy.nev AS 'gyarto',
	t.nev AS 'tipus',
	m.imei,
	m.gyariszam,
	SAW_ee.eredmeny,
	SAW.megjegyzes,
	d.nev AS 'technikus',
	dolg.nev AS 'felvivo',
	SAW.felvitel_ideje,
	IGSPN.nev AS 'IGSPN_statusz'
FROM 
	SERVICE_ACTION_WORK SAW
LEFT JOIN
	munkalap m ON m.munkalapszam = SAW.munkalapszam
LEFT JOIN
	PARTNER p ON p.partnerID = m.id_partner
LEFT JOIN 
	PARTNER_CSOPORT pcs ON pcs.id_group_partner = p.id_group_partner
LEFT JOIN
	gartipus g ON g.id = m.gartipus
LEFT JOIN
	gyartok gy ON m.id_gyarto = gy.id
LEFT JOIN
	tipusok t ON t.id = m.id_tipus
LEFT JOIN
	SERVICE_ACTION_WORK_EREDMENY_ERTEKEK SAW_ee ON SAW.id_eredmeny = SAW_ee.id
LEFT JOIN 
	dolgozok d ON d.id = SAW.technikus
LEFT JOIN 
	dolgozok dolg ON dolg.id = SAW.felvivo	 	
LEFT JOIN
	IGSPN_STATUSZ IGSPN ON SAW.id_igspn_statusz = IGSPN.id
WHERE 1;
-- SAW MENUCSOPORT	
INSERT INTO `gsm`.`MENU` (`id_szulo`, `id_os`, `menupont`, `path`) VALUES ('2', '2', 'Service Action Work (SAW)', 'Munkalapok/Service Action Work (SAW)');
UPDATE `gsm`.`MENU` SET `link` = 'menu2.php?szulo=647' WHERE `id_menu` = '652'; 
INSERT INTO `gsm`.`KAPCS_MENU_DOLGOZO_CSOPORT` (`id_menu`, `id_csoport`) VALUES ('652', '11');  -- Rendszer Admin Csoport
INSERT INTO `gsm`.`KAPCS_MENU_DOLGOZO_CSOPORT` (`id_menu`, `id_csoport`) VALUES ('652', '24');  -- Szuper Admin Csoport
-- ALMENU PONTOK: (Sérült kijelző adminisztráció nevű almenü pont)
INSERT INTO `gsm`.`MENU` (`id_szulo`, `id_os`, `menupont`) VALUES ('652', '2', 'Szétszerelés adminisztráció'); 
UPDATE `gsm`.`MENU` SET `menupont` = 'Sérült kijelző adminisztráció' , `link` = 'munkalap_keres.php?w=20' , `szamlalo` = '0' , `path` = 'Munkalapok/Service Action Work (SAW)/Sérült kijelző adminisztráció' WHERE `id_menu` = '653'; 
INSERT INTO `gsm`.`KAPCS_MENU_DOLGOZO_CSOPORT` (`id_menu`, `id_csoport`) VALUES ('653', '11'); 	
INSERT INTO `gsm`.`KAPCS_MENU_DOLGOZO_CSOPORT` (`id_menu`, `id_csoport`) VALUES ('653', '24'); 
-- ALMENU PONTOK: (Sérült kijelzők lekérdezése nevű almenü pont)
INSERT INTO `gsm`.`MENU` (`id_szulo`, `id_os`, `menupont`, `szamlalo`) VALUES ('652', '2', 'Sérült kijelzők lekérdezése', '0');
UPDATE `gsm`.`MENU` SET `path` = 'Munkalapok/Service Action Work (SAW)/Sérült kijelzők lekérdezése' WHERE `id_menu` = '654'; 
INSERT INTO `gsm`.`KAPCS_MENU_DOLGOZO_CSOPORT` (`id_menu`, `id_csoport`) VALUES ('654', '11'); 
INSERT INTO `gsm`.`KAPCS_MENU_DOLGOZO_CSOPORT` (`id_menu`, `id_csoport`) VALUES ('654', '24'); 
UPDATE `gsm`.`MENU` SET `link` = 'service_action_work_eredmeny.php' WHERE `id_menu` = '654'; 
	
//TODO: KELL NEKI EGY ÚJ MAPPA MAJD ÉLESEN ! AZ EXCEL EXPORT FÁJLOKNAK !

$tablazat .= '<td align="center"' . $munkalapOnClick . cssMutatoujjKurzor() . '>' . $munkalapAdatok['munkalapszam'] . '</td>';
		$tablazat .= '<td>' . $munkalapAdatok['partner_csoport'] . '</td>';
		$tablazat .= '<td>' . $munkalapAdatok['gartipus'] . '</td>';
		$tablazat .= '<td>' . $munkalapAdatok['gyarto'] . '</td>';
		$tablazat .= '<td>' . $munkalapAdatok['tipus'] . '</td>';
		$tablazat .= '<td>' . $munkalapAdatok['imei'] . '</td>';
		$tablazat .= '<td>' . $munkalapAdatok['gyariszam'] . '</td>';
		$tablazat .= '<td>' . $munkalapAdatok['eredmeny'] . '</td>';
		$tablazat .= '<td>' . $munkalapAdatok['megjegyzes'] . '</td>';
		$tablazat .= '<td>' . $munkalapAdatok['technikus'] . '</td>';
		$tablazat .= '<td>' . $munkalapAdatok['felvivo'] . '</td>';
		$tablazat .= '<td>' . $munkalapAdatok['felvitel_ideje'] . '</td>';
		$tablazat .= '<td>' . $munkalapAdatok['IGSPN_statusz'] . '</td>';
		
-- B.Z. által kért módosítások utáni kevesebb menühöz a jogok:
INSERT INTO `gsm`.`KAPCS_MENU_DOLGOZO_CSOPORT` (`id_menu`, `id_csoport`) VALUES ('652', '11');  -- Rendszer Admin Csoport
INSERT INTO `gsm`.`KAPCS_MENU_DOLGOZO_CSOPORT` (`id_menu`, `id_csoport`) VALUES ('652', '24');  -- Szuper Admin Csoport
/*[14:51:09][31 ms]*/ INSERT INTO `gsm`.`KAPCS_MENU_DOLGOZO_CSOPORT` (`id_menu`, `id_csoport`) VALUES ('652', '1'); -- Technikus csoport
/*[14:51:14][1 ms]*/ INSERT INTO `gsm`.`KAPCS_MENU_DOLGOZO_CSOPORT` (`id_menu`, `id_csoport`) VALUES ('652', '2'); -- Csoportvezető csoport
/*[14:51:22][1 ms]*/ INSERT INTO `gsm`.`KAPCS_MENU_DOLGOZO_CSOPORT` (`id_menu`, `id_csoport`) VALUES ('652', '5'); -- Logisztika csoport
/*[14:51:37][1 ms]*/ INSERT INTO `gsm`.`KAPCS_MENU_DOLGOZO_CSOPORT` (`id_menu`, `id_csoport`) VALUES ('652', '6'); -- Logisztikai vezető csoport

INSERT INTO `gsm`.`KAPCS_MENU_DOLGOZO_CSOPORT` (`id_menu`, `id_csoport`) VALUES ('653', '11'); 	-- Rendszer Admin Csoport
INSERT INTO `gsm`.`KAPCS_MENU_DOLGOZO_CSOPORT` (`id_menu`, `id_csoport`) VALUES ('653', '24');  -- Szuper Admin Csoport
/*[14:52:05][1 ms]*/ INSERT INTO `gsm`.`KAPCS_MENU_DOLGOZO_CSOPORT` (`id_menu`, `id_csoport`) VALUES ('653', '1'); -- Technikus csoport
/*[14:52:19][2 ms]*/ INSERT INTO `gsm`.`KAPCS_MENU_DOLGOZO_CSOPORT` (`id_menu`, `id_csoport`) VALUES ('653', '2'); -- Csoportvezető csoport
/*[14:52:27][1 ms]*/ INSERT INTO `gsm`.`KAPCS_MENU_DOLGOZO_CSOPORT` (`id_menu`, `id_csoport`) VALUES ('653', '5'); -- Logisztika csoport
/*[14:52:30][1 ms]*/ INSERT INTO `gsm`.`KAPCS_MENU_DOLGOZO_CSOPORT` (`id_menu`, `id_csoport`) VALUES ('653', '6'); -- Logisztikai vezető csoport		
