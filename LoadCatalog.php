<?php
header('Content-Type: text/html; charset=ISO 8859-15');
/**
Description: This program is to generate a the inserts, deletes, updates and selects of the information structured in a database tables and relations
ChangeLog: Improvment for ofuscated or encrypted data
ChangeLog: Use NotePad to add the ofuscated code generated with the changeString.php program.
@package	FracRB
@subpackage	Catalog
@author		Mario González Jiménez
@version	1.3
@license: released under GPL-3.0-or-later
Copyright (C) 2018 Mario González Jiménez.

	LoadCatalog.php is part of the MY WEB APPLICATION COMMUNITY MANAGER
	
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

class LoadCatalog {
	var $_appName;
	var $_strinConn;
	
	var $_host="localhost";
	var $_port="3306";
	var $_dbname="fraccionamiento";
	var $_user="root";
	var $_password="nys|kwq<::A";
	
	
	function mysqlFetchResult($result,$row,$field) {
		$data = 0;
		if(mysqli_num_rows($result)>0){
			mysqli_data_seek($result,$row);
			$row = mysqli_fetch_row($result);
			$data = $row[$field];
		}
		return $data;
	}
	
	/** Get Connection string */
	function getStringConn($appName) {
		$this->_strinConn = $this->_host . ",".$this->_user."," .$this->returnString($this->_password)."," . $this->_dbname . ",". $this->_port;
		return $this->_strinConn;
	}
	
	/** Get Catalog */
	function getCatalog(String $table){
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);

		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}
		
		$query = "Select * from $table";
		//echo $query;

		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error();
		if (!$result) {
		  echo "resultado con error en getCatalog.\n";
		  exit;
		}
		return $result;
	}

	
	/** Get Catalog Houses by Frac */
	function getCatalogHouseByFrac(int $idFrac){
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);

		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}
		
		$query = "Select * from House where idFrac=$idFrac";
		
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
		return $result;
	}
	
	/** Get Catalog Cars by Frac */
	function getCatalogCarByFrac(int $idFrac){
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);

		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}
		$query = "Select Car.* from Car
 inner join House on House.idHouse = Car.idHouse
 where House.idFrac = $idFrac";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error catalogo by Car.\n";
		  exit;
		}
		return $result;
	}

	/** Get FracFromUser */
	function getFracFromUser(int $idUser){
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);

		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}
		$query = "SELECT * FROM User where idUser=$idUser";
		$result = mysqli_query($conn, $query);
		//echo $query;
		//echo mysqli_connect_error($conn);
		echo mysqli_connect_error();
		if (!$result) {
		  echo "resultado con error getFracFromUser.\n";
		  exit;
		}
		return $result;
	}
	
	/** Get CatalogUserExtended */
	function getCatalogUserExt(){
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);

		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}
		$query = "Select p246x_users.id, p246x_users.name,
 p246x_users.username,
 p246x_users.email, 
 p246x_users.registerDate,
 p246x_users.lastvisitDate,
 User.idFrac
 from p246x_users
 left join User on User.idUser = p246x_users.id";
		
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
		return $result;
	}
	
	/** Get CatalogUserExtended Without idFrac*/
	function getCatalogUserNoFrac(){
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);

		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}
		$query = "Select p246x_users.id, p246x_users.name,
 p246x_users.username,
 p246x_users.email, 
 p246x_users.registerDate,
 p246x_users.lastvisitDate,
 User.idFrac
 from p246x_users
 left join User on User.idUser = p246x_users.id
 where User.idFrac is null
 ";
		
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
		return $result;
	}
	
	/** Add User Frac relation */
	function addUserFrac($idUser,$idFrac) {
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);
		
		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "insert into User (idUser,idFrac) values($idUser,$idFrac);";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
	}
	
	/** Get InputMoney */
	function getInputMoney(int $year,int $month=null, int $idFrac=null){
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);

		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}
		
		$strqueryMonth = "";
		$strAndFrac = "";
		
		if(isset($month)) {
			if($month > 0) {
				$strqueryMonth = " and extract(month from InputMoney.date) =  $month";
			}
		}
		
		if(isset($idFrac)) {
			if($idFrac > 0) {
				$strAndFrac = " and House.idFrac = $idFrac ";
			}
		}
		
		$query = "Select InputMoney.date as Fecha, House.number as \"Numero de Casa\",Concept.name as Concepto,
 InputMoney.value as Cantidad, p246x_users.username as \"Registrado Por\", Frac.name as Fraccionamiento
 From InputMoney
 Inner join House on House.idHouse = InputMoney.idHouse
 Inner join Concept on Concept.idConcept = InputMoney.idConcept
 left join p246x_users on p246x_users.id = InputMoney.idUser
 left join Frac on Frac.idFrac = House.idFrac
 where extract(year from InputMoney.date) =  $year
 $strqueryMonth 
 $strAndFrac
 order by InputMoney.date asc;";
 
		//echo "$query";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
		return $result;
	}
	
	/** Get OutputMoney */
	function getOutputMoney(int $year,int $month=null,int $idFrac=null){
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);

		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}
		
		$strqueryMonth = "";
		$strAndFrac = "";
		
		if(isset($month)) {
			if($month > 0) {
				$strqueryMonth = " and extract(month from OutputMoney.date) =  $month";
			}
		}
		
		if(isset($idFrac)) {
			if($idFrac > 0) {
				$strAndFrac = " and OutputMoney.idFrac = $idFrac ";
			}
		}
		
		$query = "Select OutputMoney.date as Fecha, Supplier.name as Proveedor,Concept.name as Concepto,
 OutputMoney.value as Cantidad, p246x_users.username as \"Registrado Por\", Frac.name as Fraccionamiento
 From OutputMoney
 Inner join Supplier on Supplier.idSupplier = OutputMoney.idSupplier
 Inner join Concept on Concept.idConcept = OutputMoney.idConcept
 left join p246x_users on p246x_users.id = OutputMoney.idUser
 left join Frac on Frac.idFrac = OutputMoney.idFrac
 where extract(year from OutputMoney.date) = $year
 $strqueryMonth
 $strAndFrac
 order by OutputMoney.date asc;";
 
		//echo "$query";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
		return $result;
	}

	/** Get StartingAmount */
	function getCurrentStartingAmount(int $year,int $idFrac){
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);

		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}
		
	
		$query = "Select SaldoInicial.period, SaldoInicial.amount, SaldoInicial.idFrac 
		from SaldoInicial where SaldoInicial.period=$year and SaldoInicial.idFrac = $idFrac;";
 
		//echo "$query";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
		return $result;
	}
	
	/** Get Total Income in current year by Frac */
	function getTotalIncomes(int $year,int $idFrac){
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);

		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}
		
	
		$query = "Select sum(InputMoney.value) as Incomes
 from InputMoney 
 inner join House on House.idHouse = InputMoney.idHouse
 where extract(year FROM InputMoney.date) = $year
 and House.idFrac = $idFrac;";
 
		//echo "$query";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
		return $result;
	}

	/** Get Total Expense in current year by Frac */
	function getTotalExpenses(int $year,int $idFrac){
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);

		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}
		
	
		$query = "Select sum(OutputMoney.value) as Expenses
 from OutputMoney 
 where extract(year FROM OutputMoney.date) = $year
 and OutputMoney.idFrac = $idFrac;";
 
		//echo "$query";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
		return $result;
	}

	/** Get getMaxYearStartAmount */
	function getMaxYearStartAmount(int $year,int $idFrac){
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);

		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "Select max(period) as MaxRegYear from SaldoInicial 
 where SaldoInicial.period=$year and SaldoInicial.idFrac = $idFrac;";
		//echo $query;
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
		return $result;
	}
	
	/** Get getMinYearIncome */
	function getMinYearIncome(int $idFrac){
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);

		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "Select extract(year from min(InputMoney.date)) as MinRegYear
 from InputMoney 
 inner join House on House.idHouse = InputMoney.idHouse
 where House.idFrac = $idFrac;";
		//echo $query;
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
		return $result;
	}
	
	/** Get getMinYearExpense */
	function getMinYearExpense(int $idFrac){
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);

		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "Select extract(year from min(OutputMoney.date)) as MinRegYear
 from OutputMoney 
 where OutputMoney.idFrac = $idFrac;";
 
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
		return $result;
	}

	/** Add addStartAmount **/
	function addStartAmount(int $year,int $idFrac,int $value) {
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);
		
		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "insert into SaldoInicial (period,amount,idFrac) values($year,$value,$idFrac);";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
	}
	
	/** Add Frac */
	function addElementFrac($name,$address,$zip,$idCountry) {
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);
		
		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "insert into Frac (name,address,zipCode,idCountry) values('$name','$address','$zip',$idCountry);";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
	}
	
	/** Delete Frac */
	function delElementFrac($idFrac) {
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);
		
		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "delete from Frac where idFrac=$idFrac;";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
	}
	
	/** Get Frac */
	function getElementFrac(int $idFrac){
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);

		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$result = mysqli_query($conn, "SELECT * FROM Frac WHERE idFrac=$idFrac;");
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
		return $result;
	}
	
	/** Update Frac */
	function updateElementFrac(int $idFrac,$name,$address,$zipCode,int $idCountry) {
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);
		
		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "Update Frac set name='$name', address='$address', zipCode='$zipCode',idCountry=$idCountry  where idFrac=$idFrac;";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
	}	
	
	/** Add Concept **/
	function addElementConcept($name,$description,$idStatus) {
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);
		
		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "insert into Concept (name,description,idStatus) values('$name','$description',$idStatus);";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
	}

	/** Get Concept */
	function getElementConcept(int $idConcept){
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);

		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$result = mysqli_query($conn, "SELECT * FROM Concept WHERE idConcept=$idConcept;");
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
		return $result;
	}
	
	/** Update Concept */
	function updateElementConcept(int $idConcept,$name,$description,int $idStatus) {
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);
		
		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "Update Concept set name='$name', description='$description', idStatus=$idStatus  where idConcept=$idConcept;";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
	}
	
	/** Delete Concept */
	function delElementConcept($idConcept) {
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);
		
		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "delete from Concept where idConcept=$idConcept;";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
	}

	/** Add Supplier **/
	function addElementSupplier($name,$idStatus) {
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);
		
		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "insert into Supplier (name,idStatus) values('$name',$idStatus);";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
	}
	
	/** Get Supplier */
	function getElementSupplier(int $idSupplier){
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);

		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$result = mysqli_query($conn, "SELECT * FROM Supplier WHERE idSupplier=$idSupplier;");
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
		return $result;
	}
	
	/** Update Supplier */
	function updateElementSupplier(int $idSupplier,$name,int $idStatus) {
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);
		
		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "Update Supplier set name='$name', idStatus=$idStatus  where idSupplier=$idSupplier;";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
	}	
	
	/** Delete Supplier */
	function delElementSupplier($idSupplier) {
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);
		
		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "delete from Supplier where idSupplier=$idSupplier;";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
	}
	
	/** Add House **/
	function addElementHouse($family,$number,$idFrac,$idStatus) {
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);
		
		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "insert into House (Family,number,idFrac,idStatus) values('$family','$number',$idFrac,$idStatus);";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
	}
	
	/** Get House */
	function getElementHouse(int $idHouse){
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);

		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$result = mysqli_query($conn, "SELECT * FROM House WHERE idHouse=$idHouse;");
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
		return $result;
	}
	
	/** Get House by Number */
	function getElementHouseByNumber($number,int $idFrac = null){
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);
		$strQueryFrac = "";
		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}
		
		if($idFrac > 0) {
			$strQueryFrac = " and idFrac=$idFrac";
		}
		
		$query = "SELECT * FROM House WHERE number='$number' $strQueryFrac;";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
		return $result;
	}
	
	/** Update House */
	function updateElementHouse(int $idHouse,$family,$number,int $idFrac,int $idStatus) {
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);
		
		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "Update House set Family='$family', number=$number, idFrac=$idFrac, idStatus=$idStatus  where idHouse=$idHouse;";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
	}	
	
	/** Delete House */
	function delElementHouse($idHouse) {
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);
		
		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "delete from House where idHouse=$idHouse;";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
	}
	
	/** Add Car **/
	function addElementCar($licensePlate,$model,$idStatus,$idBrand,$idColor,$idHouse) {
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);
		
		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "insert into Car (licensePlate,model,idStatus,idBrand,idColor,idHouse) values('$licensePlate','$model',$idStatus,$idBrand,$idColor,$idHouse);";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
	}

	/** Get Car */
	function getElementCar(int $idCar){
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);

		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$result = mysqli_query($conn, "SELECT * FROM Car WHERE idCar=$idCar;");
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
		return $result;
	}

	/** Update Car */
	function updateElementCar(int $idCar,$licensePlate,$model,int $idStatus,int $idBrand,int $idColor,int $idHouse) {
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);
		
		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "Update Car set licensePlate='$licensePlate', model='$model', idStatus=$idStatus, idBrand=$idBrand, idColor=$idColor, idHouse=$idHouse  where idCar=$idCar;";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
	}

	/** Delete Car */
	function delElementCar($idCar) {
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);
		
		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "delete from Car where idCar=$idCar;";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
	}

	/** Add InputMoney **/
	function addElementInputMoney($value,$idHouse,$idConcept,$idUser) {
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);
		
		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "insert into InputMoney (value,date,idHouse,idConcept,idUser) values($value,now(),$idHouse,$idConcept,$idUser);";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
	}
	
	/** Add OutputMoney **/
	function addElementOutputMoney($value,$idSupplier,$idConcept,$idUser,int $idFrac) {
		$this->_appName = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
		$conn = mysqli_connect($this->_host,$this->_user,$this->returnString($this->_password),$this->_dbname,$this->_port);
		
		if (!$conn) {
		  echo "No se pudo conectar.\n";
		  exit;
		}

		$query = "insert into OutputMoney (value,date,idConcept,idUser,idSupplier,idFrac) values($value,now(),$idConcept,$idUser,$idSupplier,$idFrac);";
		$result = mysqli_query($conn, $query);
		echo mysqli_connect_error($conn);
		if (!$result) {
		  echo "resultado con error.\n";
		  exit;
		}
	}
	
	function returnString($string) {
		$strChanged = "";
		$ascii = 0;
		$offset = 0;
		for($i=0;$i<strlen($string);$i++){
			if($i==0) {
				$offset = ord($string[$i]) - 100;
			} else {
				$ascii = ord($string[$i]) - $offset;
				$strChanged .= chr($ascii);	
			}
		} 
		return $strChanged;	
	}
}
?>