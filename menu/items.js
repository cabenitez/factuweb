function seleccionar(){		// abre el pop up para seleccionar en cliente 
	var win = window.open("buscar_cliente_alta_remito.php", "win",  "toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=500,top=100,left=200");
}

 
var MenuPrincipal = [
<!--    '<img src="../imagenes/cargando2.gif">'  "imagen", nombre del menu,pagina,nombre del iframe,nombre q aparecee en la bara de estado -->
	//[null,'Inicio','principal.php','_parent','Inicio'],  // _parent  es para no cargar la pagina en el div "principal" 
	[null,'Inicio','entrada.php','principal','Inicio'],
	[null,'Archivos',null,null,'Archivos Generales',
		[null, 'Zonas Geográficas', null,null, 'Gestion de Zonas Geograficas',
					[null, 'Paises', null,null, 'Gestion de Paises',
								[null,'Alta de Paises','alta_pais.php','principal','Gestion de Paises'],
								[null,'Buscar...','buscar_pais.php','principal','Gestion de Paises']
					],
					[null, 'Provincias', null,null, 'Gestion de Provincias',
								[null,'Alta de Provincias','alta_provincia.php','principal','Gestion de Provincias'],
								[null,'Buscar...','buscar_provincia.php','principal','Gestion de Provincias']
					],
					[null, 'Localidades', null,null, 'Gestion de Localidades',
								[null,'Alta de Localidades','alta_localidad.php','principal','Gestion de Localidades'],
								[null,'Buscar...','buscar_localidad.php','principal','Gestion de Localidades']
					],
					[null, 'Zonas', null,null, 'Gestion de Zonas',
								[null,'Alta de Zonas','alta_zona.php','principal','Gestion de Zonas'],
								[null,'Buscar...','buscar_zona.php','principal','Gestion de Zonas']
					],
					
		],
		[null,'Alícuotas',null,null,'Gestión de Alícuotas',
							[null,'IVA',null,null,'Gestion de Alícuotas',
								[null,'Alta de IVA','alta_iva.php','principal','Gestion de Alícuotas'],
								[null,'Buscar...','buscar_iva.php','principal','Gestion de Alícuotas'],
							],
							[null,'Impuestos internos',null,null,'Gestion de Alícuotas',
								[null,'Alta de Impuestos internos','alta_imp_int.php','principal','Gestion de Alícuotas'],
								[null,'Buscar...','buscar_imp_int.php','principal','Gestion de Alícuotas'],
							],
							[null,'Percepción de IVA',null,null,'Gestion de Alícuotas',
								[null,'Alta Percepcion de IVA','alta_perc_iva.php','principal','Gestion de Alícuotas'],
								[null,'Buscar...','buscar_perc_iva.php','principal','Gestion de Alícuotas'],
							],
							[null,'Ingresos brutos',null,null,'Gestion de Alícuotas',
								[null,'Alta de Ingresos brutos','alta_ing_bruto.php','principal','Gestion de Alícuotas'],
								[null,'Buscar...','buscar_ing_bruto.php','principal','Gestion de Alícuotas'],
							],
		],
		//[null, '<hr>', null,null, null], // linea
		[null,'Comprobantes',null,null,'Gestion de Comprobantes',
							[null,'Alta de Comprobantes','alta_tipo_talonario.php','principal','Gestion de Comprobantess'],
							[null,'Buscar...','buscar_tipo_talonario.php','principal','Gestion de Talonarios']
		],
		[null,'Condición de IVA',null,null,'Gestion de Condición de IVA',
							[null,'Alta de Condición de IVA','alta_condicion_iva.php','principal','Gestion de Condición de IVA'],
							[null,'Buscar...','buscar_cond_iva.php','principal','Gestion de Condición de IVA']
		],
		[null,'Talonarios',null,null,'Gestion de Talonarios',
							[null,'Alta de Talonarios','alta_talonario.php','principal','Gestion de Talonarios'],
							[null,'Buscar...','buscar_talonario.php','principal','Gestion de Talonarios']
		],
		//[null, '<hr>', null,null, null], // linea
		[null, 'Proveedores', null,null, 'Gestion de Proveedores',
					[null,'Alta de Proveedores','alta_proveedor.php','principal','Gestion de Proveedores'],
					[null,'Buscar...','buscar_proveedor.php','principal','Gestion de Proveedores'],
					//[null,'Deuda a Proveedores','deuda_proveedor.php','principal','Gestion de Proveedores']
		],
		[null, 'Vehículos', null,null, 'Gestion de Vehiculos',
					[null,'Alta de Vehículos','alta_vehiculo.php','principal','Gestion de Vehiculos'],
					[null,'Buscar...','buscar_vehiculo.php','principal','Gestion de Vehiculos']
		],
		[null, 'Repartidores', null,null, 'Gestion de Repartidores',
					[null,'Alta de Repartidores','alta_repartidor.php','principal','Gestion de Repartidores'],
					[null,'Buscar...','buscar_repartidor.php','principal','Gestion de Repartidores']
		],		
		[null, 'Vendedores', null,null, 'Gestion de Vendedores',
					[null,'Alta de Vendedores','alta_vendedor.php','principal','Gestion de Vendedores'],
					[null,'Buscar...','buscar_vendedor.php','principal','Gestion de Vendedores']
		],

		[null, 'Categorias', null,null, 'Gestion de Categorias',
					[null,'Alta de Categorias','alta_categoria.php','principal','Gestion de Categorias'],
					[null,'Buscar...','buscar_categoria.php','principal','Gestion de Categorias']
		],
		[null,'Formas de Pago',null,null,'Gestion de Formas de Pago',
							[null,'Alta de Formas de Pago','alta_forma_pago.php','principal','Gestion de Formas de Pago'],
							[null,'Buscar...','buscar_forma_pago.php','principal','Gestion de Formas de Pago']
		],
		[null, 'Clientes', null,null, 'Gestion de Clientes',
					[null,'Alta de Clientes','alta_cliente.php','principal','Gestion de Clientes'],
					[null,'Buscar...','buscar_cliente.php','principal','Gestion de Clientes'],
					[null,'Hoja de Ruta','alta_hoja_ruta.php','principal','Gestion de Clientes'],
					[null,'Constancia de Inscripción','constancia_inscripcion_afip.php','principal','Gestion de Clientes']
					
					//[null,'Deuda de Clientes','deuda_cliente.php','principal','Gestion de Clientes']
		],
		//[null, '<hr>', null,null, null], // linea
		[null, 'Artículos', null,null, 'Gestion de Articulos',
					[null,'Grupos',null,null,'Gestion de Articulos',
							[null,'Alta de Grupos','alta_grupo.php','principal','Gestion de Articulos'],
							[null,'Buscar...','buscar_grupo.php','principal','Gestion de Articulos']			
					],
					[null,'Marcas',null,null,'Gestion de Articulos',
							[null,'Alta de Marcas','alta_marca.php','principal','Gestion de Articulos'],
							[null,'Buscar...','buscar_marca.php','principal','Gestion de Articulos']			
					],
					[null,'Variedad',null,null,'Gestion de Articulos',
							[null,'Alta de Variedad','alta_variedad.php','principal','Gestion de Articulos'],
							[null,'Buscar...','buscar_variedad.php','principal','Gestion de Articulos']			
					],
					
					[null,'Medidas',null,null,'Gestion de Articulos',
							[null,'Alta de Medida','alta_medida.php','principal','Gestion de Articulos'],
							[null,'Buscar...','buscar_medida.php','principal','Gestion de Articulos']			
					],
				  
				    [null,'Ajuste de Precios','ajuste_precios.php','principal','Gestion de Precios'], //'<img src="../imagenes/dinero.gif" >'
					
					[null,'Artículos',null,null,'Gestión de Articulos',
							[null,'Alta de Artículos','alta_articulo.php','principal','Gestion de Articulos'],
							[null,'Buscar...','buscar_articulo.php','principal','Gestion de Articulos']			
					]
		]
	],
	[null,'Configuraciones',null,null,'Configuraciones',
					[null,'Datos de Empresa','alta_datos_empresa.php','principal','Datos de Empresa'],
					[null,'Configurar Listados','conf_listados_bd.php','principal','Listados'],
					[null,'Usuarios',null,null,'Usuarios',
							[null,'Alta de Usuarios','alta_usuarios.php','principal','Gestión de Usuarios'],
							[null,'Modificar Datos','modificar_datos_usuario.php','principal','Gestión de Usuarios']
					]					
	],
	[null,'Movimientos',null,null,'Gestion de Remitos, Facturas y Cuenta Corriente',
					[null,'Stock',null,null,'Gestión de Stock',
							[null,'Ingreso Stock Inicial', 'ingreso_stock.php','principal','Ingreso Stock Inicial'],
							[null,'Poner a cero existencias','reiniciar_stock.php','principal','Poner a cero existencias de todos los productos']
					],
					[null,'Caja',null,null,'Gestión de Caja',
							[null,'Caja Inicial', 'caja.php','principal','Caja Inicial'],
					],

					[null, 'Compras',null,null,'Gestion de Compras',
							/*
							[null,'Remitos',null,null,'Gestion de Remitos',
									[null,'Alta de Remito','alta_remito_compra.php','principal','Gestion de Remitos'],
									[null,'Buscar...','buscar_remito_compra.php','principal','Gestion de Remitos']
							],
							*/
							[null,'Depositos',null,null,'Gestion de Depositos',
									[null,'Alta de Depositos','alta_deposito_compra.php','principal','Gestion de Depositos'],
									[null,'Buscar...','buscar_depositos_compra.php','principal','Gestion de Depositos']
							],
							[null,'Facturas',null,null,'Gestion de Facturas',
									[null,'Alta de Factura','alta_factura_compra.php','principal','Gestion de Facturas'],
									//[null,'Buscar...','buscar_factura_compra.php','principal','Gestion de Facturas']
							],
							/*
							[null,'Cuenta Corriente',null,null,'Gestion de Cuenta Corriente',
									[null,'Pago en Cuenta Corriente','pago_cc_compra.php','principal','Gestion de Cuenta Corriente'],
									[null,'Buscar...','buscar_cc_compra.php','principal','Gestion de Cuenta Corriente']
							]
							*/
					],
					[null, 'Ventas',null,null,'Gestion de Ventas',
							[null,'Remitos',null,null,'Gestion de Remitos',
									[null,'Alta de Remito','alta_remito_vta.php','principal','Gestion de Remitos'],
									[null,'Buscar...','buscar_remito_vta.php','principal','Gestion de Remitos']
							],
							[null,'Presupuestos',null,null,'Gestion de Presupuestos',
									[null,'Alta de Presupuestos','alta_presupuesto_vta.php','principal','Gestion de Presupuestos'],
									[null,'Descargar Presupuesto','descargar_presupuesto_vta.php','principal','Gestion de Presupuestos'],
									[null,'Buscar...','buscar_presupuesto_vta.php','principal','Gestion de Presupuestos']
							],
							[null,'Facturas',null,null,'Gestion de Facturas',
									[null,'Alta de Factura','alta_factura_vta.php','principal','Gestion de Facturas'],
									[null,'Buscar...','buscar_factura_vta.php','principal','Gestion de Facturas'],
									[null,'Anular Factura',null,null,'Gestion de Facturas',
											[null,'Anular Factura Generada','anular_factura_vta.php','principal','Gestion de Facturas'],
											[null,'Anular Numeración','anular_factura_vta_numeracion.php','principal','Gestion de Facturas']
									]
							],
							[null,'Notas de Crédito',null,null,'Gestion de Notas de Crédito',
									[null,'Alta de Nota de Crédito','alta_nota_credito.php','principal','Gestion de Notas de Crédito']
									//[null,'Buscar...','buscar_factura_vta.php','principal','Gestion de Facturas'],
									//[null,'Anular Factura',null,null,'Gestion de Facturas',
									//		[null,'Anular Factura Generada','anular_factura_vta.php','principal','Gestion de Facturas'],
									//		[null,'Anular Numeración','anular_factura_vta_numeracion.php','principal','Gestion de Facturas']
									//]
							],
							[null,'Cuenta Corriente',null,null,'Gestion de Cuenta Corriente',
									[null,'Asignación de Talonarios','asignacion_tal_recibo.php','principal','Gestion de Cuenta Corriente'],
									[null,'Ingreso de Cobranzas','pago_cc_vta.php','principal','Gestion de Cuenta Corriente'],
									[null,'Imputación de Comprobantes','imputacion_pago_cc_vta.php','principal','Gestion de Cuenta Corriente'],
									[null,'Buscar...','buscar_cc_vta.php','principal','Gestion de Cuenta Corriente']
							],

							[null,'Comisiones',null,null,'Gestión de Comisiones',
									[null,'Regular Comisión','regular_comision.php','principal','Comisión de vendedores'],
									[null,'Comisión de Vendedores','comision_vendedor.php','principal','Comisión de vendedores']
							],
							[null,'Devoluciones','devoluciones.php','principal','Gestion de Facturas'],
							[null,'Finalizar Carga','finalizar_carga.php','principal','Gestion de Cargas'],
							[null,'Cierre Z','cierre_z.php','principal','Cierre Z']
					],
					[null,'Gastos',null,null,'Gestión de Gastos',
									[null,'Alta de Gastos','alta_gastos.php','principal','Gestión de Gastos'], 
									[null,'Buscar...','buscar_gastos.php','principal','Gestion de Gastos']
									//[null,'Modificar Direccion de acceso','modificar_sistema_preventa.php','principal','Gestion de Facturas']
					],
					/*
					[null,'Sistema Preventa',null,null,'Gestión de Preventa',
									[null,'Asociar Articulos Especiales','asociar_art_especial.php','principal','Comisión de vendedores'],
									[null,'Generar Archivos CSV','generar_csv.php','principal','Comisión de vendedores'],
									[null,'Alta de Factura PREVENTA','alta_factura_vta_sis_preventa.php','principal','Gestion de Facturas']
									//[null,'Acceder Al Sistema','acceder_sistema_preventa.php','principal','Gestion de Facturas'],
									//[null,'Modificar Direccion de acceso','modificar_sistema_preventa.php','principal','Gestion de Facturas']
					]
					*/
					
	],

	[null,'Informes',null,null,'Datos de interés para toma de decisiones',
		[null, 'Compras',null,null,null,
			[null,'Compras del día','informe_compras_del_dia.php','principal','Resumen de ventas del día'],  
			//[null,'Detalle de Comprobantes','informe_detalle_comprobante.php','principal','Detalle de Comprobantes'],  
			//[null,'Compras a Proveedor','informe_comprascliente.php','principal','Resumen de compras por cliente'],
			[null,'Depósitos','informe_depositos.php','principal','Resumen de compras por cliente'],
			//[null,'Ventas por provincia','informe_vtas_provincia.php','principal','Resumen de Ventas por provincia'],
			//[null,'IVA Compras','informe_iva_compras.php','principal','Resumen de IVA Compras'],
			//[null,'IVA Compras','informe_iva_ventas.php','principal','Resumen de IVA Ventas'],
			
			//[null,'Impuestos Registrados','informe_impuestos_registrados.php','principal','Impuestos Registrados']
		],
		[null, 'Ventas',null,null,null,
			//[null,'Detalle de Remitos','informe_ventas_del_dia.php','principal','Resumen de ventas del día'],  
			[null,'Ventas del día','informe_ventas_del_dia.php','principal','Resumen de ventas del día'],  
			[null,'Detalle de Comprobantes','informe_detalle_comprobante.php','principal','Detalle de Comprobantes'],  
			[null,'Compras por cliente','informe_comprascliente.php','principal','Resumen de compras por cliente'],
			//[null,'Ventas por provincia','informe_vtas_provincia.php','principal','Resumen de Ventas por provincia'],
			//[null,'IVA Compras','informe_iva_compras.php','principal','Resumen de IVA Compras'],
			[null,'IVA Ventas','informe_iva_ventas.php','principal','Resumen de IVA Ventas'],
			
			//[null,'Impuestos Registrados','informe_impuestos_registrados.php','principal','Impuestos Registrados']
		],
		[null, 'Gastos',null,null,null,
			//[null,'Gastos del día','informe_ventas_del_dia.php','principal','Resumen de ventas del día'],  
		],
		
		[null, 'Cuenta Corriente',null,null,null,
			[null,'Composición de Saldos','informe_composicion_saldos.php','principal','Cuenta Corriente'],
			[null,'Estado de Deudas','informe_saldo_cliente.php','principal','Resumen de pagos pendientes de clientes']			//Saldo de Clientes
		],
/*
		[null, 'Clientes',null,null,null,
			[null,'Compras por cliente','informe_comprascliente.php','principal','Resumen de compras por cliente'],
			[null,'Ranking de Artículos por cliente','informe_articuloscliente.php','principal','Resumen de pagos pendientes de clientes']
			[null,'Resumen anual facturación a clientes','totalfacturas.php','principal','Resumen de facturación a clientes']
		],
*/		
		[null,'Artículos',null,null,null,
			[null,'Ranking de Artículos vendidos','informe_articuloscliente.php','principal','Ranking de Artículos vendidos'],
			[null,'Ranking de Artículos vendidos por zona','informe_articulos_vendidos_zona.php','principal','Ranking de Artículos vendidos por zona'],
			[null,'Ranking de Artículos vendidos con bonificacion','informe_articulosbonificados.php','principal','Ranking de Artículos vendidos con bonificacion'],
			
			[null,'Lista de Precios','informe_lista_precio.php','principal','Lista de Precios'],
			[null,'Stock actual','informe_stock.php','principal','Stock actual']
		],
		[null,'Resumen Envases','informe_resumen_envases.php','principal','Gestion de Envases'],
		[null,'Cargas Diarias','informe_cargas_finalizadas.php','principal','Gestion de Cargas'],
		[null,'Caja / Rentabilidad','informe_caja_rentabilidad.php','principal','Gestion de Cargas'],
	],
	
	[null,'Estadisticas',null,null,'Herramientas varias',
		[null,'Ranking de Ventas por Vendedor','ranking_ventas_vendedor.php','principal','Ranking de Ventas'],
		[null,'Ranking de Artículos mas vendidos','ranking_articulos_mas_vendidos.php','principal','Ranking de Ventas'],
		//[null,'Ranking de Ventas Mensuales','ranking_prueba_borrar.php','principal','Ranking de Ventas'],
		[null,'Ranking de Ventas Mensuales','ranking_ventas_anuales.php','principal','Ranking de Ventas'],
		//[null,'Ranking de Ventas Facturas','backups.php','principal','Ranking de Ventas']
	],
	
	[null,'Utilidades',null,null,'Utilidades',
		[null,'Copia de seguridad',null,null,null,
	 		[null,'Generar','backup_dump.php','principal','Copia de seguridad'],
			[null,'Restaurar',null,null,null,
				[null,'Desde Archivo Externo','backup_restaurar.php','principal','Restaurar base de datos'],
				[null,'Desde Servidor','backup_restaurar_servidor.php','principal','Restaurar base de datos'],		
			]
		 ],
		
		[null,'Cambiar Base de Datos','cambiar_base_datos.php','principal','Restaurar base de datos'],
		//[null,'Calculadora','calculadora.php','principal','Calculadora'],
		[null,'Calendario de Eventos','class_calendario/index.php','principal','Calendario'], 
		[null,'Agenda telefónica','agenda.php','principal','Agenda'], 
		[null,'Exportar Archivos',null,null,null,
			[null,'Informe Cervecería','generar_txt.php','principal','Exportar Archivos'],
			[null,'Informe DGR Misiones','generar_txt_siap.php','principal','Exportar Archivos'],
		]
		
		//[null,'Auditoría del Sistema','auditoria.php','principal','Auditoría del Sistema']
		//[null,'Eliminar ejercicio económico','eliminar_ejercicio_economico.php','principal','Eliminar ejercicio económico'],
		
	],
	[null,'Acerca de',null,null,'Créditos y ayuda del programa',
		//[null,'Créditos','creditos.php','principal','Créditos del programa'],
		['<img src="../ayuda/icons/1.gif">','Guía de utilización','../ayuda/index.htm','_blank','Guía rápido de utilización'], 
	],
	
	[null,'Salir','logout.php','_parent','Salir']

];
