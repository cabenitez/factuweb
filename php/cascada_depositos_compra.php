<?
	//variables="fecha_desde="+fecha_desde+"&fecha_hasta="+fecha_hasta+"&banco="+banco.value+"&trans="+trans.value+"&cta="+cta.value+"&titular="+titular.value;
	if (!empty($fecha_desde)){
		$consulta = $consulta. " fecha >= $fecha_desde";
		if (!empty($fecha_hasta)){
			$consulta = $consulta. " " . "and fecha <= $fecha_hasta";
		}
		if (!empty($banco)){
			$consulta = $consulta. " " . "and banco like '%$banco%'";
		}
		if (!empty($trans)){
			$consulta = $consulta. " " . "and n_trans ='$trans'";
		}
		if (!empty($cta)){
			$consulta = $consulta. " " . "and n_cta = '$cta'";
		}
		if (!empty($titular)){
			$consulta = $consulta. " " . "and titular like '%$titular%'";
		}

	}else{
		if (!empty($fecha_hasta)){
			$consulta = $consulta. " " . "fecha <= $fecha_hasta";

			if (!empty($banco)){
				$consulta = $consulta. " " . "and banco like '%$banco%'";
			}
			if (!empty($trans)){
				$consulta = $consulta. " " . "and n_trans ='$trans'";
			}
			if (!empty($cta)){
				$consulta = $consulta. " " . "and n_cta = '$cta'";
			}
			if (!empty($titular)){
				$consulta = $consulta. " " . "and titular like '%$titular%'";
			}
		}else{
				if (!empty($banco)){
					$consulta = $consulta. " " . "banco like '%$banco%'";
					
					if (!empty($trans)){
						$consulta = $consulta. " " . "and n_trans ='$trans'";
					}
					if (!empty($cta)){
						$consulta = $consulta. " " . "and n_cta = '$cta'";
					}
					if (!empty($titular)){
						$consulta = $consulta. " " . "and titular like '%$titular%'";
					}
				}else{
						if (!empty($trans)){
							$consulta = $consulta. " " . "n_trans ='$trans'";

							if (!empty($cta)){
								$consulta = $consulta. " " . "and n_cta = '$cta'";
							}
							if (!empty($titular)){
								$consulta = $consulta. " " . "and titular like '%$titular%'";
							}
						}else{
								if (!empty($cta)){
									$consulta = $consulta. " " . "n_cta = '$cta'";

									if (!empty($titular)){
										$consulta = $consulta. " " . "and titular like '%$titular%'";
									}
								}else{
										if (!empty($titular)){
											$consulta = $consulta. " " . "titular like '%$titular%'";
										}

								}
						}
				}
		}
	} 
?>