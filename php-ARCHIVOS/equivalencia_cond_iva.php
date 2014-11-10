<?
	function equivalenciaCondIva($idIva){
		// 6 = F = CONSUMIDOR FINAL				5 = E = EXENTO						7 = S = NO CATEGORIZADO 				4 = N = NO RESPONSABLE
		// 1 = I = IVA RESPONSABLE INSCRIPTO 	2 = M = RESPONSABLE MONOTRIBUTO		3 = R = IVA RESPONSABLE NO INSCRIPTO
		switch ($idIva) {
			 case 6:
				 return("F");
				 break;
			 case 5:
				 return("E");
				 break;
			 case 7:
				 return("S");
				 break;
			 case 4:
				 return("N");
				 break;
			 case 1:
				 return("I");
				 break;
			 case 2:
				 return("M");
				 break;
			 case 3:
				 return("R");
				 break;
		}
	}
?>