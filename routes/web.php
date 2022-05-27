<?php

use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KnowledgeController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\UserNotificationsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\KnowledgebaseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\DashboardController as ControllersDashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RatingController;
use App\Models\Ticket;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProductController;

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

Route::get('/', [ControllersDashboardController::class, 'welcome'])->name('boss');
Route::get('generate-pdf/{business}', [PDFController::class, 'generatePDF'])->name('pdf');
Route::get('dashboard', [ControllersDashboardController::class, 'dashboard'])->name('dashboard');
Route::get('faqs', [ControllersDashboardController::class, 'faq'])->name('faqs');
Route::resource('products', ProductController::class);
Route::get('services', [ControllersDashboardController::class, 'service'])->name('services');
Route::get('ticket', [TicketController::class, 'create'])->name('ticket.create');
Route::post('ticket/store', [TicketController::class, 'store'])->name('ticket.store');
Route::get('ticket/submitted', [TicketController::class, 'submitted'])->name('ticket.submitted');
Route::resource('knowledgebase', KnowledgebaseController::class)->except(['edit', 'create', 'delete', 'update']);
Route::middleware(['guest'])->group(function () {
    Route::get('/auth/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/auth/signup', [AuthController::class, 'register'])->name('signup');
    Route::post('/auth/signup', [AuthController::class, 'signup'])->name('signup.store');
});
Route::get('news/create', [TicketController::class, 'create'])->name('news.create');
Route::get('gallery', [TicketController::class, 'gallery'])->name('gallery');
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('ticket/view', [TicketController::class, 'view'])->name('view');
    Route::get('ticket/{ticket:number}', [TicketController::class, 'show'])->name('ticket.show');
    Route::put('user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::post('reply', [TicketController::class, 'reply'])->name('reply');
    Route::get('password-update', [UserController::class, 'password'])->name('password.update');
    Route::post('rating/new', [TicketController::class, 'setrating'])->name('rating.set');
});
Route::name('kitchn.')->prefix('kitchn')->middleware(['auth:sanctum', 'verified', 'role:Admin|Agent|HOD|Editor'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::resource('ticket', AdminTicketController::class);
    Route::get('ticket/close/{ticket}', [AdminTicketController::class, 'close'])->name('ticket.close');
    Route::post('ticket/forward/{ticket}', [AdminTicketController::class, 'forward'])->name('ticket.forward');
    Route::get('get/agents/{dept}', [AdminTicketController::class, 'getAgents'])->name('get.agents');
    Route::resource('user', AdminUserController::class);
    Route::resource('menu', MenuController::class);
    Route::resource('business', BusinessController::class)->except(['edit', 'create']);
    Route::resource('departments', DepartmentController::class);
    Route::resource('service', AdminServiceController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('news', NewsController::class);
    Route::resource('knowledge', KnowledgeController::class);
    Route::resource('section', SectionController::class);
    Route::resource('faq', FaqController::class);
    Route::resource('chat', ChatController::class);
    Route::get('/removeRole/{role}/{user}', [AdminUserController::class, 'removeRole'])->name('role.remove');
    Route::get('/report', [ReportController::class, 'index'])->name('report');
    Route::get('/removeDept/{department}/{user}', [AdminUserController::class, 'removeDept'])->name('department.remove');
    Route::get('backup/create', function () {
        Artisan::call('database:backup');
        return back()->with('success', 'BackUp created');
    })->name('backup.now');
    Route::get('backup', [BackupController::class, 'index'])->name('backup.index');
    Route::get('backup/dl/{folder}/{file}', [BackupController::class, 'dl'])->name('backup.dl');
    Route::get('backup/rm/{folder}/{file}', [BackupController::class, 'rm'])->name('backup.rm');
    Route::get('export', [AdminTicketController::class, 'export'])->name('export');
    Route::get('businessexport', [BusinessController::class, 'export'])->name('export.business');
    Route::get('usersexport', [AdminUserController::class, 'export'])->name('export.users');
    Route::get('notifications', [UserNotificationsController::class, 'index'])->name('notifications');
});
Route::match(['get', 'post'], '/botman', [BotManController::class, 'handle']);
