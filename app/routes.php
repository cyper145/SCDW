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
            Route::post('usuarioupdate{id}','CuentasController@updateadmin');
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
            Route::post('docente/search', 'DocenteController@buscar');
            Route::any('docente/pdf','DocenteController@getPDF');
            //departamento academico
            Route::get('DptoAcademico/listar', 'DptoAcademicoController@index');
            Route::get('DptoAcademico/insertar', 'DptoAcademicoController@insertarDptoAcademico');
            Route::get('DptoAcademico/editar/{id}', 'DptoAcademicoController@editarDptoAcademico');
            Route::post('DptoAcademico/formulario1', 'DptoAcademicoController@store');
            Route::post('DptoAcademico/formulario2/{id}', 'DptoAcademicoController@update');
            Route::get('DptoAcademico/eliminar/{id}', 'DptoAcademicoController@delete');
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
            Route::get('arbitros/', 'ArbitroController@mostrarArbitros');
            Route::get('arbitros/listar', 'ArbitroController@mostrarArbitros');
            Route::get('arbitros/agregar', 'ArbitroController@agregarArbitro');
            Route::post('arbitros/formulario1', 'ArbitroController@store');
            Route::get('arbitros/editar/{id}', 'ArbitroController@editarArbitro');
            Route::post('arbitros/formulario2/{id}', 'ArbitroController@update');
            Route::get('arbitros/buscar', 'ArbitroController@buscar');
            Route::get('arbitros/eliminar/{id}', 'ArbitroController@eliminar');
            Route::get('arbitros/porPartido', 'ArbitroPorPartidoController@mostrar');
            //movimientos
            Route::get('movimientos','MovimientoController@index');
            Route::get('ingresos/listar', 'MovimientoController@listaI');
            Route::get('egresos/listar', 'MovimientoController@listaE');
            Route::post('NuevoMov/addIngreso','MovimientoController@storeI');
            Route::get('NuevoMov/addIngreso','MovimientoController@createI');
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
            Route::get('campeonato/detail/equipo/detalle/{id}', 'CampeonatoController@detalleequipojugador');
            Route::get('campeonato/detail/equipo/detalle/jugador/detail/{id}', 'CampeonatoController@detallejugador');
            //acta de reunion
            Route::get('acta/ver', 'ActaController@index');  
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
            Route::post('partido/cambios/add', 'PartidoController@partido_add');
            Route::get('partido/cambios/edit/{id}', 'PartidoController@partido_get_edit');
            Route::post('partido/cambios/edit/{id}', 'PartidoController@partido_post_edit');
            Route::get('partido/cambios/delete/{id}', 'PartidoController@partido_delete');
            //torneos
            Route::get('torneo/create/{id}','TorneoController@create');
            Route::get('torneo/detail/{id}/{id2}','TorneoController@detail');
            Route::get('torneo/delete/{id}/{id2}','TorneoController@destroy');
            Route::resource('torneo','TorneoController');
});

//===================Funciones del Equipo====================
Route::group(array('before'=>'equip'), function()
        {
            Route::get('delegado/ver', 'DelegadoController@index');
            //jugador
            Route::resource('jugador', 'JugadorController');
        });
           
//===================Funciones del User Normal====================
Route::get('autodocente','AutocompletadoController@autocompletedocente');//autocompletardo

Route::get('arbitros/ver', 'ArbitroController@index');
Route::get('tablaposicion/ver.html','UsernormalController@tablaposiciones');
Route::get('/','UsernormalController@index');
