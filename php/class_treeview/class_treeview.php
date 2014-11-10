<?
  
// +------------------------------------------------------------------------+
// | PHP version 5.0 					                                  	|
// +------------------------------------------------------------------------+
// | Description:													      	|
// | Class to populate tree view using AJAX + PHP 	  						|
// | 																		|
// +------------------------------------------------------------------------+
// | Author				: Neeraj Thakur <neeraj_th@yahoo.com>   			|
// | Created Date     	: 19-11-2007                  						|
// | Last Modified    	: 19-11-2007                  						|
// | Last Modified By 	: Neeraj Thakur                  					|
// +------------------------------------------------------------------------+
include("../conexion.php");

DEFINE ('DB_USER', $usuario);
DEFINE ('DB_PASSWORD', $clave);
DEFINE ('DB_HOST', $host);
DEFINE ('DB_NAME', $db);
	
	if ( @$_REQUEST['method'] == 'getCat' )
	{
		$objServices = new AjaxTreeview();
		$catid = isset($_REQUEST['catid'])?$_REQUEST['catid']:0;
		
		$arr = $objServices->getCatList($catid);
		$arrReturn['data'] = $arr;
		$arrReturn['id'] = @$_REQUEST['id'];
		$arrReturn['value'] = $catid;
		$jsonstring = json_encode($arrReturn);
		echo $jsonstring;
	}
	
	class AjaxTreeview
	{
		public function AjaxTreeview()
		{
			// Make the connnection and then select the database.
			$dbc = @mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) OR die ('Could not connect to MySQL: ' . mysql_error() );
			mysql_select_db (DB_NAME) OR die ('Could not select the database: ' . mysql_error() );
			$this->table = "pedidos";
		}
		
		function dbConnect()
		{
			DEFINE ('LINK', mysql_connect (DB_HOST, DB_USER, DB_PASSWORD));
		}
		
		public function getCatList($catid)
		{
			$this->dbConnect();
			$query = "SELECT * FROM {$this->table} where id_dep = {$catid} and estado <> 'F' ORDER BY id asc";
			$result = mysql_db_query (DB_NAME, $query, LINK);			
			$arr = array();
			$i = 0;			
			while( $rec = mysql_fetch_array($result)){
					$arr[$i]['id'] = $rec['id'];
					$arr[$i]['name'] = $rec['nombre'];
					$arr[$i]['pid'] = $rec['id_dep'];
					$i ++ ;
			}
		return $arr;
		}
	}
?>