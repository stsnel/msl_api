<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin', function () {
    User::all();
    
    try {
        DB::connection()->getPDO();
        echo DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        echo 'None';
    }
    
    return 'Hello World';
});

Auth::routes(['register' => false]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/remove-dataset', [HomeController::class, 'removeDataset'])->name('remove-dataset');
Route::get('/remove-dataset/confirm', [HomeController::class, 'removeDatasetConfirm'])->name('remove-dataset-confirm');
Route::post('/remove-dataset/confirmed', [HomeController::class, 'removeDatasetConfirmed'])->name('remove-dataset-confirmed');
Route::get('/queues', [HomeController::class, 'queues'])->name('queues');
Route::get('/delete-actions', [HomeController::class, 'deleteActions'])->name('delete-actions');

Route::get('/importers', [HomeController::class, 'importers'])->name('importers');
Route::get('/importer/{id}/imports', [HomeController::class, 'importerImports'])->name('importer-imports');
Route::get('/importer/{importer_id}/imports/{import_id}/flow', [HomeController::class, 'importerImportsFlow'])->name('importer-imports-flow');

Route::post('/create-import', [HomeController::class, 'createImport'])->name('create-import');
Route::get('/imports', [HomeController::class, 'imports'])->name('imports');
Route::get('/source-dataset-identifiers', [HomeController::class, 'sourceDatasetIdentifiers'])->name('source-dataset-identifiers');
Route::get('/source-datasets', [HomeController::class, 'sourceDatasets'])->name('source-datasets');
Route::get('/source-datasets/{id}', [HomeController::class, 'sourceDataset'])->name('source-dataset');
Route::get('/create-actions', [HomeController::class, 'createActions'])->name('create-actions');
Route::get('/create-action/{id}', [HomeController::class, 'createAction'])->name('create-action');

Route::get('/test', [HomeController::class, 'test'])->name('test');