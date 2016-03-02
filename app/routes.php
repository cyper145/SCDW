<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//=====================usuarios(sesiones)==================
Route::get('login','UserallController@get_login');
Route::post('login','UserallController@post_login');
Route::get('logout','UserallController@logout');

//===================Funciones del Administrator=========================
Route::group(array('before'=>'admin'), function()
        {
            //----begin cuentas de usuarios----
            //para el administrador            
            Route::get('usuariocrearauto','CuentasController@autocompletedocente');//autocompletardo
            Route::get('usuariocrear','CuentasController@crear_get');
            Route::post('usuariocrear','CuentasController@crear_post');            
            Route::get('usuario/listar','CuentasController@listar');            
            Route::any('usuarioeditar{id}','CuentasController@editaradmin');
            Route::post('usuarioupdate/{id}','CuentasController@updateadmin');
            Route::get('usuario/delete/{id}','CuentasController@eliminaradmin');
            //para la comision organizadora
            Route::get('usuariocorgcrear','CuentasController@crearco_get');
            Route::post('usuariocorgcrear','CuentasController@crearco_post');            
            Route::get('usuariocorg/listar','CuentasController@listarcorg');            
            Route::get('usuariocorg/editar/{id}','CuentasController@editarcorg');
            Route::post('usuariocorg/update/{id}','CuentasController@updatecorg');
            Route::get('usuariocorg/eliminar/{id}','CuentasController@eliminarcorg');
            //para el equipo
            Route::get('usuarioequipocrear','CuentasController@creareq_get');
            Route::post('usuarioequipocrear','CuentasController@creareq_post');
            Route::get('usuarioequipo/listar','CuentasController@listarequipo');
            Route::get('usuarioequipo/editar/{id}','CuentasController@editarequipo');
            Route::post('usuarioequipo/update/{id}','CuentasController@updateequipo');
            Route::get('usuarioequipo/eliminar/{id}','CuentasController@eliminarequipo');
            //end cuentas de usuarios
            //miembro comision de justicia
            Route::get('miembrocomjusticia/listar', 'MiembroComJusticiaController@index');
            Route::get('miembrocomjusticiainsertar', 'MiembroComJusticiaController@insertarmiembro');
            Route::any('miembrocomjusticiaeditar{id}', 'MiembroComJusticiaController@editarmiembro');
            Route::post('miembrocomjusticia/formulario1', 'MiembroComJusticiaController@store');
            Route::post('miembrocomjusticia/formulario2/{id}', 'MiembroComJusticiaController@update');
            Route::get('miembrocomjusticia/eliminar/{id}', 'MiembroComJusticiaController@delete');
            //docente
            Route::get('docente/listar', 'DocenteController@index');
            Route::get('docente/insertar', 'DocenteController@insertardocente');
            Route::get('docente/editar/{id}', 'DocenteController@editardocente');
            Route::post('docente/formulario1', 'DocenteController@store');
            Route::post('docente/formulario2/{id}', 'DocenteController@update');
            Route::get('docente/eliminar/{id}', 'DocenteController@delete');
            Route::any('docente/search', 'DocenteController@buscar');
            Route::any('docente/pdf','DocenteController@getPDF');
            //departamento academico
            Route::get('DptoAcademico/listar', 'DptoAcademicoController@index');
            Route::get('DptoAcademico/insertar', 'DptoAcademicoController@insertarDptoAcademico');
            Route::get('DptoAcademico/editar/{id}', 'DptoAcademicoController@editarDptoAcademico');
            Route::post('DptoAcademico/formulario1', 'DptoAcademicoController@store');
            Route::post('DptoAcademico/formulario2/{id}', 'DptoAcademicoController@update');
            Route::get('DptoAcademico/eliminar/{id}', 'DptoAcademicoController@delete');

            //espectadores
            Route::get('espectadores/listar', 'ExpectadoresController@index');
            Route::get('espectadores/insertar', 'ExpectadoresController@insertardocente');
            Route::get('espectadores/editar/{id}', 'ExpectadoresController@editardocente');
            Route::post('espectador/formulario1', 'ExpectadoresController@store');
            Route::post('espectador/formulario2/{id}', 'ExpectadoresController@update');
            Route::get('espectadores/eliminar/{id}', 'ExpectadoresController@delete');
            Route::post('espectadores/search', 'ExpectadoresController@buscar');
           // Route::any('docente/pdf','DocenteController@getPDF');

        });

//===================Funciones de la Comision Organizadora====================
Route::group(array('before'=>'organ'), function()
        {
            //--bienvenida
            Route::get('comision/index.html', 'ComisionOrganizadorController@index');//bienvenida
            //--para los integrantes
            Route::get('comisionintegrantesadd', 'ComisionOrganizadorController@addintegrante_get');
            Route::post('comisionintegrantesadd', 'ComisionOrganizadorController@addintegrante_post');
            Route::get('comision/integrantes/list.html', 'ComisionOrganizadorController@listintegrante');
            Route::get('comision/integrantes/delete/{id}','ComisionOrganizadorController@deleteintegrante');
            //--jugador en juego
            Route::resource('jugador_juego', 'JugadorEnJuegoController');
            //--arbitro
            Route::get('Arbitros/list.html', 'ArbitroController@index');
            Route::get('Arbitros/insertar.html', 'ArbitroController@insertar_get');
            Route::post('Arbitros/insertar.html', 'ArbitroController@insertar_post');
            Route::get('Arbitros/editar/{id}', 'ArbitroController@editar_get');
            Route::post('Arbitros/editar/{id}', 'ArbitroController@editar_post');
            Route::get('Arbitros/eliminar/{id}', 'ArbitroController@eliminar');
            //movimientos
            Route::get('movimientos','MovimientoController@index');
            Route::get('NuevoMov/addIngreso','MovimientoController@createI');
            Route::post('NuevoMov/addIngreso','MovimientoController@storeI');
            Route::get('movimientos/{id}/delete.html','MovimientoController@destroy');

            Route::get('movimientos/editar/{id}', 'MovimientoController@editarIngreso');
            Route::post('ingreso/formulario2/{id}', 'MovimientoController@update');
            Route::get('NuevoMov/addEgreso','MovimientoController@createE');
            Route::post('NuevoMov/addEgreso','MovimientoController@storeE');
            //gol
            Route::get('gol/', array('uses' => 'GolController@mostrar'));
            Route::get('gol/listar', array('uses' => 'GolController@mostrar'));
            Route::get('gol/insertar', 'GolController@insertar');
            Route::post('gol/formulario1', 'GolController@store');
            Route::get('gol/editar/{id}', 'GolController@editar');
            Route::post('arbitros/formulario2/{id}', 'GolController@update');
            Route::get('gol/buscar', 'GolController@buscar');
            //cronograma
            //partido
            Route::get('partido/listar', 'PartidoController@index');
            Route::get('partido/nuevo', 'PartidoController@nuevo');
            Route::post('partido/formulario1', 'PartidoController@store');
            //Sancion
            Route::get('sancion/listar', 'sancionController@index');
            Route::get('sancion/insertar', 'sancionController@insertarsancion');
            Route::get('sancion/editar/{id}', 'sancionController@editarsancion');
            Route::post('sancion/formulario1', 'sancionController@store');
            Route::post('sancion/formulario2/{id}', 'sancionController@update');
            Route::get('sancion/eliminar/{id}', 'sancionController@delete');
            //Incidencias
            Route::get('incidencias/listar', 'IncidenciaController@index');
            Route::get('incidencias/insertar', 'IncidenciaController@insertarincidencias');
            Route::get('incidencias/editar/{id}', 'IncidenciaController@editarincidencias');
            Route::post('incidencias/formulario1', 'IncidenciaController@store');
            Route::post('incidencias/formulario2/{id}', 'IncidenciaController@update');
            Route::get('incidencias/eliminar/{id}', 'IncidenciaController@delete');
            //--campeonato
            Route::get('campeonato/listar', 'CampeonatoController@index');
            Route::get('campeonato/insertar', 'CampeonatoController@insertarcampeonato');
            Route::get('campeonato/editar/{id}', 'CampeonatoController@editarcampeonato');
            Route::get('campeonato/detail/{id}', 'CampeonatoController@detalle');
            Route::post('campeonato/formulario1', 'CampeonatoController@store');
            Route::post('campeonato/formulario2/{id}', 'CampeonatoController@update');
            Route::get('campeonato/eliminar/{id}', 'CampeonatoController@delete');
            Route::get('campeonato/detail/equipo/{id1}/{id2}/detalle.html', 'CampeonatoController@detalleequipojugador');
            Route::get('campeonato/detail/equipo/{id1}/{id2}/jugador/{id3}/detail.html', 'CampeonatoController@detallejugador');

            Route::get('campeonato/detail/{id}/configuracion.html', 'CampeonatoController@configuracion');
            Route::post('campeonato/detail/{id}/configuracion/add.html', 'CampeonatoController@addconfig');

            Route::get('campeonato/detail/{id}/configuracionD.html', 'CampeonatoController@configuracionD');
            Route::post('campeonato/detail/{id}/configuracionD/add.html', 'CampeonatoController@addconfigD');


            Route::get('campeonato/detail/{id}/actividad.html', 'CampeonatoController@actividad');
            Route::post('campeonato/detail/{id}/actividad/add.html', 'CampeonatoController@addacti');

            Route::get('campeonato/detail/{id}/actadd.html', 'ActaController@conclusiones_all');
            Route::any('campeonato/detail/{id}/actaagregar', 'ActaController@conclusiones_add');
            //campeonato/detail/{id}/actaedit/{id2}
            Route::get('campeonato/detail/{id}/actaedit/{id2}', 'ActaController@conclusiones_get_edit');
            Route::post('campeonato/detail/{id}/actaedit/{id2}', 'ActaController@conclusiones_post_edit');

            Route::get('campeonato/detail/{id}/actadelete/{id2}', 'ActaController@conclusiones_delete');
            //campeonato/detail/{id}/actadetalle/{id2}
            Route::get('campeonato/detail/{id}/actadetalle/{id2}', 'ActaController@actare_all');

            //campeonato/detail/{id}/abriracta/{id2}
            Route::get('campeonato/detail/{id}/abriracta/{id2}', 'ActaController@actareunion_all');
            Route::get('campeonato/detail/{id}/abriracta/{id2}/autodelegado','AutocompletadoController@autocompletedelegado');
            //asistencia
            Route::any('campeonato/detail/{id}/addasistencia/{id2}', 'ActaController@actareunion_add1');
            //agenda
            Route::post('campeonato/detail/{id}/addagenda/{id2}', 'ActaController@actareunion_add2');
            //conclusion
            Route::post('campeonato/detail/{id}/addconclusion/{id2}', 'ActaController@actareunion_add3');
            //eliminacion

            Route::get('campeonato/detail/{id}/abriracta/{id2}/delete1/{id3}', 'ActaController@actareunion_delete1');

            Route::get('campeonato/detail/{id}/abriracta/{id2}/delete2/{id3}', 'ActaController@actareunion_delete2');

            Route::get('campeonato/detail/{id}/abriracta/{id2}/delete3/{id3}', 'ActaController@actareunion_delete3');

            //=======             Equipo            =============

            Route::get('campeonato/detail/{id}/equipodetalle/{id2}', 'CampeonatoController@detalleEquipo');
            Route::post('campeonato/detail/{id}/equipodetalle/{id2}/{id3}', 'CampeonatoController@editJugador');
            Route::post('campeonato/detail/{id}/equipodetalle/{id2}/delegado/{id3}', 'CampeonatoController@editDelegado');
            //campeonato/detail/{id}/equipodetalle/{id2}





            //campeonato/detail/{id}/abriracta/{id2}/delete1/{id3}
            //campeonato/detail/CAM001/abriracta/reu002


            //acta de reunion
            Route::get('acta/ver', 'ActaController@index');
            //agregar nueva reunion
            Route::get('acta/verc', 'ActaController@conclusiones_all'); 
            Route::post('acta/verc/add', 'ActaController@conclusiones_add');


            Route::get('/acta/verc/edit/{id}', 'ActaController@conclusiones_get_edit');
            Route::post('/acta/verc/edit/{id}', 'ActaController@conclusiones_post_edit');
            Route::get('/acta/verc/delete/{id}', 'ActaController@conclusiones_delete');

            Route::get('acta/verA/{id}', 'ActaController@actareunion_all'); 
            Route::any('/acta/verA/add1', 'ActaController@actareunion_add1');
            Route::post('/acta/verA/add2', 'ActaController@actareunion_add2');
            Route::post('/acta/verA/add3', 'ActaController@actareunion_add3');
            Route::get('/acta/verA/{id1}/delete1/{id2}', 'ActaController@actareunion_delete1');
            Route::get('/acta/verA/{id1}/delete2/{id2}', 'ActaController@actareunion_delete2'); 
            Route::get('/acta/verA/{id1}/delete3/{id2}', 'ActaController@actareunion_delete3');
            Route::get('acta/verAs/{id}', 'ActaController@actare_all');   
           //cambios
            Route::get('partido/cambios', 'PartidoController@partido_all');  
            Route::post('partido/cambios/add/{id}/{id2}/{id3}/{id4}/{id5}', 'PartidoController@partido_add');
            Route::get('partido/cambios/edit/{id}', 'PartidoController@partido_get_edit');
            Route::post('partido/cambios/edit/{id}', 'PartidoController@partido_post_edit');
            Route::get('partido/cambios/delete/{id}', 'PartidoController@partido_delete');
            //torneos
            Route::get('torneo/create/{id}','TorneoController@create');
            Route::get('torneo/{id}/{id2}/detail.html','TorneoController@detail');
            Route::get('torneo/detail/{id}/{id2}/fixture.html','TorneoController@fixture');
            Route::post('torneo/{id}/{id2}/agregarE','TorneoController@agregarE');

            Route::get('torneo/delete/{id}/{id2}','TorneoController@destroy');
            Route::resource('torneo','TorneoController');
            Route::post('torneo/{id}/{id2}/detail.html/reportes','TorneoController@reportes');
            //fechas y partido
            Route::get('fechas/{id1}/{id2}/{id3}/detail.html','FechasController@detail');
            Route::get('fechas/{id1}/{id2}/{id3}/{id4}/partido.html','PartidoController@partido');
            Route::post('fechas/{id1}/{id2}/{id3}/{id4}/partido.html/planilla/{id5}','PartidoController@planilla');
            //======= creacion de fechas la programacion ===============
            Route::get('fecha/edit/{id}/{id2}/{id3}', 'FechasController@actualizarfechas');
            Route::post('fecha/edit/{id}/{id2}/add', 'FechasController@add');
                //====== programacion de partido
            Route::get('fecha/edit/{id}/{id2}/programacion/{id3}', 'ProgramacionController@editpartido_get');
            Route::post('fecha/edit/{id}/{id2}/programacioPartido/{id3}', 'ProgramacionController@editpartido_post');

           // 'fecha/edit/'.$codcampeonato.'/'.$codtorneo.'/programacioPartido/'.$codfixture

            Route::get('fecha/edit/{id}/{id2}/programacion/escenarioauto', 'AutocompletadoController@autocompleteescenario');






            //======= END creacion de fechas la programacion ===============
            Route::post('fechas/detail/partido/arbitros/add.html', 'PartidoController@arbitroadd');
            Route::post('fechas/detail/partido/plantillas/add.html', 'PartidoController@enviarP');

            Route::post('fechas/detail/partido/jugador/add.html', 'PartidoController@jugadoradd');
            Route::get('fechas/{id1}/{id2}/{id3}/{id4}/{id5}/eliminar.html', 'PartidoController@jugadordelete');//borra a un jugador del partido
            //gol
                Route::get('fechas/{id1}/{id2}/{id3}/{id4}/{id5}/goles.html', 'PartidoController@jugadorgollist');
                Route::get('fechas/{id1}/{id2}/{id3}/{id4}/{id5}/goles/add.html', 'PartidoController@jugadorgol_get');
                Route::post('fechas/detail/partido/gol.html', 'PartidoController@jugadorgol_post');
                Route::get('fechas/{id1}/{id2}/{id3}/{id4}/{id5}/{id6}/delete.html', 'PartidoController@jugadorgoldelete');//elimina un gol de un jugador de un partido
                //tarjeta
                Route::get('fechas/{id1}/{id2}/{id3}/{id4}/{id5}/tarjeta.html', 'PartidoController@jugadortarjetalist');
                Route::get('fechas/{id1}/{id2}/{id3}/{id4}/{id5}/tarjeta/add.html', 'PartidoController@jugadortarjeta_get');
                Route::post('fechas/detail/partido/tarjeta.html', 'PartidoController@jugadortarjeta_post');
                Route::get('fechas/{id1}/{id2}/{id3}/{id4}/{id5}/{id6}/tarjeta/delete.html', 'PartidoController@jugadortarjetadelete');//elimina un gol de un jugador de un partido
                //insidencias
                Route::get('fechas/detail/partido/insidencia/{id1}/{id2}', 'PartidoController@jugadorinsidencia');
});

//===================Funciones del Equipo====================
Route::group(array('before'=>'equip'), function()
        {
            //--bienvenida
            Route::get('equipo/index.html', 'EquipoController@index');//bienvenida
            //jugador
            Route::get('jugador/listar.html', 'JugadorController@listar');
            Route::get('jugadorinsertar', 'JugadorController@insertar_get');



            Route::post('jugador/insertar.html', 'JugadorController@insertar_post');
            Route::get('jugador/{id}/delete/.html', 'JugadorController@delete');
            Route::get('jugador/{id}/detail/.html', 'JugadorController@detail');
            Route::any('jugadoredit{id}', 'JugadorController@edit_get');
            Route::post('jugador/edit.html', 'JugadorController@edit_post');

            //delegado
            Route::get('delegado/listar.html', 'DelegadoController@listar');
            Route::get('delegadoinsertar', 'DelegadoController@insertar_get');



            Route::post('delegado/insertar.html', 'DelegadoController@insertar_post');
            Route::get('delegado/{id}/delete/.html', 'DelegadoController@delete');
            Route::get('delegado/{id}/detail/.html', 'DelegadoController@detail');
            Route::any('delegadoedit{id}', 'DelegadoController@edit_get');
            Route::post('delegado/edit.html', 'DelegadoController@edit_post');
           //plantilla
            Route::get('plantilla/{id}', 'EquipoController@agregarplantilla_get');
            Route::get('plantilla/{id}/autodocente', 'EquipoController@autocompletedocente');




            //--equipo
            Route::get('jugador/camiseta.html','EquipoController@camisetaadd_get');
            Route::post('jugador/camiseta.html','EquipoController@camisetaadd_post');
            Route::get('jugador/camiseta/delete.html','EquipoController@camisetadelete');

            Route::get('jugador/logo.html','EquipoController@logoadd_get');
            Route::post('jugador/logo.html','EquipoController@logoadd_post');
            Route::get('jugador/logo/delete.html','EquipoController@logodelete');

            //plantilla
            //Route::get('plantilla/{id}','EquipoController@indexPlantilla');

        });
           
//===================Funciones del User Normal====================
Route::get('autodocente','AutocompletadoController@autocompletedocente');//autocompletardo
//Route::get('escenarioauto', 'AutocompletadoController@autocompleteescenario');

//Route::get('autodelegado','AutocompletadoController@autocompletedelegado');

Route::get('arbitros/ver', 'ArbitroController@index');
Route::get('tablaposicion/ver.html','UsernormalController@tablaposiciones');
Route::get('/','UsernormalController@index');
