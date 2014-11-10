<?
class CrearTXT {
    var $db_server;
    var $db_name;
    var $db_user;
    var $db_pass;
    var $dbh;
    var $path; 
	var $nombre_arch;
	var $consulta;
	var $descarga;
    var $separador;
	var $num_filas;
	
	function CrearTXT($servidor, $nombre_db, $usuario, $clave){		// constructor
        $this->descarga = 0;
		$this->db_server = $servidor;
        $this->db_name   = $nombre_db;
        $this->db_user   = $usuario;
        $this->db_pass   = $clave;
        $this->connect();
    }

    function connect(){													// conexion
         $this->dbh = @mysql_connect($this->db_server, $this->db_user, $this->db_pass);
         if (!$this->dbh){
                printf("Error: No se puede conectar con el Servidor.<BR>\n");
                return;
         }
         if (!@mysql_select_db($this->db_name, $this->dbh)){
                printf("Error: No se puede conectar con la Base de Datos.");
                return;
         }
    }

    function query ($query){												// ejecuta la consulta
    	if(!$this->dbh) die();
		$result = mysql_query($query, $this->dbh) or die("<br>".mysql_error());
        $this->num_filas = mysql_num_rows ($result); 
		return $result;
    }

    function crear(){														// metodo de construccion de CSV
		$sql = $this->consulta;
		
		$rs  = $this->query($sql);
        //$rs1 = $this->query($sql);
        if($rs){
            //$string ="";
            
			// obtiene el nombre de los campos ===============================================
            /*
			$fields =  mysql_fetch_assoc($rs1);
            if(!is_array($fields))
              return;
            while(list($key,$val) =each($fields)) //encabezado de campos
                $string .= '"'.$key.'",';
            $string = substr($string,0,-1)."\015\012";
			*/
            
			// obtiene los registros ==========================================================
            $i = 0;
			while($row = mysql_fetch_assoc($rs)) {
                /*
				while(list($key,$val) = each($row)){
                  $row[$key] = htmlentities($row[$key], ENT_COMPAT, "UTF-8");
                  $row[$key] = str_replace(',',' ',rtrim($row[$key]));
                  $row[$key] = str_replace("\015\012",' ',$row[$key]);
	              // agrega doble comilla despues de cada campo
				  //$row[$key] = '"'.$row[$key].'"';
				}
				*/
				$i++;
				$string .= (implode($row,$this->separador));	// toma los registros y los asigna a la variable
				if($i < $this->num_filas){						// control para no crear el ultimo salto de linea
					$string .="\015\012";
				}
             }
			
            // crea el directorio si no existe ===================================================
            if (!file_exists($this->path)) {
				mkdir($this->path,0777);
			}

			// crea el archivo =================================================================
			$fp = fopen($this->path.$this->nombre_arch,'w');
            fwrite($fp,$string);
            fclose($fp);
        }
		/*
		if($this->descarga == 1){
			// obliga la descarga =================================================================
			header("Content-Description: File Transfer");
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment; filename=".$this->nombre_arch); 
			echo $string;
		}
		*/
    }
}
?>