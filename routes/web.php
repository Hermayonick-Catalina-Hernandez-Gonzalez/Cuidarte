<?php

use App\Http\Controllers\Admin\AdministradorController;
use App\Http\Controllers\ConsultasMEDICOController;
use App\Http\Controllers\ConsultasSECRETARIOController;
use App\Http\Controllers\CrearCitasMEDICOController;
use App\Http\Controllers\CrearCitasSecretarioController;
use App\Http\Controllers\Medico\MedicoController;
use App\Http\Controllers\Paciente\PacienteController;
use App\Http\Controllers\Enfermero\EnfermeroController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistroMedicosADMINController;
use App\Http\Controllers\RegistroPacientesADMINController;
use App\Http\Controllers\RegistroPacientesMEDICOController;
use App\Http\Controllers\RegistroPacientesSECRETARIOController;
use App\Http\Controllers\RegistroSecretarioADMINController;
use App\Http\Controllers\RegistroServiciosController;
use App\Http\Controllers\Secretario\SecretarioController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\RegistroEnfermeroController;
use App\Http\Controllers\RegistroProductoADMINController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroProductoSECRETARIOController;
use App\Http\Controllers\VentaController;

// Ruta principal para iniciar sesión
Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


//* Rutas para el medico
Route::middleware(['auth', 'MedicoMiddleware'])->group(function () {
    Route::get('dashboard', [MedicoController::class, 'index'])->name('dashboard'); //* Vista principal del médico
    Route::get('registro-pacientes', [RegistroPacientesMEDICOController::class, 'index'])->name('registro-pacientes'); //* Vista para registrar pacientes
    Route::post('registro-pacientes', [RegistroPacientesMEDICOController::class, 'registro_paciente'])->name('registro-pacientes.store'); //* POST a registrar pacientes a BD
    Route::get('ver-consulta/{paciente_id}', [ConsultasMEDICOController::class, 'show'])->name('consultas.show');
    Route::get('consultas', [ConsultasMEDICOController::class, 'index'])->name('consultas');
    Route::post('consultas', [ConsultasMEDICOController::class, 'storeConsulta'])->name('consultas.storeConsulta'); //* POST a registrar consultas a BD
    Route::get('ver-consulta/{paciente_id}', [ConsultasMEDICOController::class, 'show'])->name('consultas.show');
    Route::get('crear-cita', [CrearCitasMEDICOController::class, 'index'])->name('crear-cita');
    Route::post('crear-cita', [CrearCitasMEDICOController::class, 'store'])->name('crear-cita.store');
});

//* Rutas para el administrador
Route::middleware(['auth', 'AdministradorMiddleware'])->group(function () {
    Route::get('/admin/dashboard', [AdministradorController::class, 'index'])->name('admin.dashboard'); //* Vista principal del administrador
    /**
     * Rutas para modificar la información de los médicos
     *
     */
    Route::get('/admin/medicos/{medico}/edit', [MedicoController::class, 'edit'])->name('medicos.edit'); //* Vista para editar médicos
    Route::patch('/admin/medicos/{medico}', [MedicoController::class, 'update'])->name('medicos.update'); //* PATCH a actualizar médicos
    Route::delete('/admin/medicos/{medico}', [MedicoController::class, 'destroy'])->name('medicos.destroy'); //* DELETE a eliminar médicos
    /**
     * Rutas para modificar la información de los secretarios
     */
    Route::get('/admin/secretarios/{secretario}/edit', [SecretarioController::class, 'edit'])->name('secretarios.edit'); //* Vista para editar secretarios
    Route::patch('/admin/secretarios/{secretario}', [SecretarioController::class, 'update'])->name('secretarios.update'); //* PATCH a actualizar secretarios
    Route::delete('/admin/secretarios/{secretario}', [SecretarioController::class, 'destroy'])->name('secretarios.destroy'); //* DELETE a eliminar secretarios
    /**
     * Rutas para modificar la información de los pacientes
     */
    Route::get('/admin/pacientes/{paciente}/edit', [PacienteController::class, 'edit'])->name('pacientes.edit'); //* Vista para editar pacientes
    Route::patch('/admin/pacientes/{paciente}', [PacienteController::class, 'update'])->name('pacientes.update'); //* PATCH a actualizar pacientes
    Route::delete('/admin/pacientes/{paciente}', [PacienteController::class, 'destroy'])->name('pacientes.destroy'); //* DELETE a eliminar pacientes
    /**
     * Rutas para los enfermeros
     */
    Route::get('/admin/enfermeros/{enfermero}/edit', [EnfermeroController::class, 'edit'])->name('enfermeros.edit'); //* Vista para editar enfermeros
    Route::patch('/admin/enfermeros/{enfermero}', [EnfermeroController::class, 'update'])->name('enfermeros.update'); //* PATCH a actualizar enfermeros
    Route::delete('/admin/enfermeros/{enfermero}', [EnfermeroController::class, 'destroy'])->name('enfermeros.destroy'); //* DELETE a eliminar enfermeros

    Route::get('/admin/registro-pacientes', [RegistroPacientesADMINController::class, 'index'])->name('admin.registro-pacientes'); //* Vista para registrar pacientes
    Route::post('/admin/registro-pacientes', [RegistroPacientesADMINController::class, 'registro_paciente'])->name('admin.registro-pacientes.store'); //* POST a registrar pacientes a BD
    Route::get('/admin/registro-medicos', [RegistroMedicosADMINController::class, 'index'])->name('admin.registro-medicos'); //* Vista para registrar médicos
    Route::post('/admin/registro-medicos', [RegistroMedicosADMINController::class, 'registro_medico'])->name('admin.registro-medicos.store'); //* POST a registrar médicos a BD
    Route::get('/admin/registro-secretarios', [RegistroSecretarioADMINController::class, 'index'])->name('admin.registro-secretarios'); //* Vista para registrar secretarios
    Route::post('/admin/registro-secretarios', [RegistroSecretarioADMINController::class, 'registro_secretarios'])->name('admin.registro-secretarios.store'); //* POST a registrar secretarios a BD
    /**
     * Rutas para servicios
     */
    Route::get('/admin/registro-servicios', [RegistroServiciosController::class, 'index'])->name('admin.registro-servicios'); //* Vista para registrar servicios
    Route::get('/admin/registro-servicios/{servicio}/edit', [RegistroServiciosController::class, 'edit'])->name('registro-servicios.edit'); //* Vista para editar servicios
    Route::patch('/admin/registro-servicios/{servicio}', [RegistroServiciosController::class, 'update'])->name('registro-servicios.update'); //* PATCH a actualizar servicios
    Route::delete('/admin/registro-servicios/{servicio}', [RegistroServiciosController::class, 'destroy'])->name('registro-servicios.destroy'); //* DELETE a eliminar servicios

    Route::post('/admin/registro-servicios', [RegistroServiciosController::class, 'store'])->name('admin.registro-servicios.store');
    /**
     * Rutas para enfermeros
     */
    Route::get('/admin/registro-enfermeros', [RegistroEnfermeroController::class, 'index'])->name('admin.registro-enfermeros'); //* Vista para registrar enfermeros
    Route::post('/admin/registro-enfermeros', [RegistroEnfermeroController::class, 'registro_enfermeros'])->name('admin.registro-enfermeros'); //* POST a registrar enfermeros a BD

    /**
     * Rutas para modificar la información de los productos
     *
     */
    Route::get('/admin/registro-productos/{productos}/edit', [RegistroProductoADMINController::class, 'edit'])->name('registro-productos.edit'); //* Vista para editar pacientes
    Route::patch('/admin/registro-productos/{productos}', [RegistroProductoADMINController::class, 'update'])->name('registro-productos.update'); //* PATCH a actualizar pacientes
    Route::delete('/admin/registro-productos/{productos}', [RegistroProductoADMINController::class, 'destroy'])->name('registro-productos.destroy'); //* DELETE a eliminar pacientes

    Route::get('/admin/registro-productos', [RegistroProductoADMINController::class, 'index'])->name('admin.registro-productos');
    Route::post('/admin/registro-productos', [RegistroProductoADMINController::class, 'store'])->name('admin.registro-productos.store');
});

//* Rutas para el secretario
Route::middleware(['auth', 'SecretarioMiddleware'])->group(function () {
    Route::get('/secretario/dashboard', [SecretarioController::class, 'index'])->name('secretario.dashboard'); //* Vista principal del secretario
    Route::get('/secretario/registro-pacientes', [RegistroPacientesSECRETARIOController::class, 'index'])->name('secretario.registro-pacientes'); //* Vista para registrar pacientes
    Route::post('secretario/registro-pacientes', [RegistroPacientesSECRETARIOController::class, 'registro_paciente'])->name('secretario.registro-pacientes.store'); //* POST a registrar pacientes a BD
    Route::get('/secretario/crear-cita', [CrearCitasSecretarioController::class, 'index'])->name('secretario.crear-cita'); //* Vista para crear citas
    Route::post('/secretario/crear-cita', [CrearCitasSecretarioController::class, 'store'])->name('secretario.crear-cita.blade'); //* POST a crear citas
    Route::get('/secretario/citas', [CrearCitasSecretarioController::class, 'getCitas'])->name('secretario.citas');
    Route::get('/secretario/pagos', [PagosController::class, 'index'])->name('secretario.pagos'); //* Vista para pagos
    Route::get('/secretario/producto', [ProductosController::class, 'index'])->name('secretario.medicamentos'); //* Vista para productos
    //Productos
    Route::get('/secretario/registro-productos', [RegistroProductoSECRETARIOController::class, 'index'])->name('secretario.registro-productos');
    Route::post('/secretario/registro-productos', [RegistroProductoSECRETARIOController::class, 'store'])->name('secretario.registro-productos.store');

    //rutas para las citas agendadas
    Route::get('/secretario/consultas', [ConsultasSecretarioController::class, 'index'])->name('secretario.consultas'); //* Vista para consultar pacientes
    Route::delete('/secretario/consultas/{id}', [ConsultasSecretarioController::class, 'destroy'])->name('consultas.destroy');
    Route::get('/secretario/citas/{id}/edit', [ConsultasSecretarioController::class, 'edit'])->name('consultas.edit');
    Route::put('/secretario/citas/{id}', [ConsultasSecretarioController::class, 'update'])->name('consultas.update');
    // Ventas
    Route::post('/secretario/ventas', [VentaController::class, 'store'])->name('ventas.store');
});

use App\Http\Controllers\ImageController;

Route::get('/imagen/{id}', [ImageController::class, 'show'])->name('imagen.show');
Route::get('/productos/{id}', [ProductosController::class, 'show'])->name('productos.show');
Route::post('/ventas', [ProductosController::class, 'store'])->name('ventas.store');
Route::get('/ver-ticket/{id}', [PagosController::class, 'generarTicket'])->name('ver.ticket');
Route::delete('/servicios/{id}', [RegistroServiciosController::class, 'destroy'])->name('servicios.destroy');
