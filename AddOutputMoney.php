<?php
/**
Description: This program is to insert on database new information of Outcome payment for Suppliers.
@package	FracRB
@subpackage	Outcome
@author		Mario González Jiménez
@version	1.0
@license: released under GPL-3.0-or-later
Copyright (C) 2018 Mario González Jiménez.

	AddOutputMoney.php is part of the MY WEB APPLICATION COMMUNITY MANAGER
	
	MY WEB APPLICATION COMMUNITY MANAGER is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    MY WEB APPLICATION COMMUNITY MANAGER is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with MY WEB APPLICATION COMMUNITY MANAGER.  If not, see <http://www.gnu.org/licenses/>.
*/

require_once 'LoadCatalog.php';
require_once 'Catalog.php';


$catalogStatus = new LoadCatalog;

$value = floatval($_POST['valueF']);
$idConcept = (int)($_POST['idConcept']);
$idSupplier = (int)($_POST['idSupplier']);
$idUser = (int)($_POST['idUser']);
$idFrac = (int)($_POST['idFrac']);
$error = false;

$resultStatus = $catalogStatus->addElementOutputMoney($value,$idSupplier,$idConcept,$idUser,$idFrac);


$x = $_SERVER['HTTP_REFERER'];
$url = strtok($x, '?');
If($error) {
	header("Location: " . $url."?modStatus=2");
}  else {
	header("Location: " . $url."?modStatus=1");	
}
die();



?>