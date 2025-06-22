<?php

use App\Livewire\Profile;
use App\Livewire\Leave\Apply;
use App\Livewire\Leave\Approve;
use App\Livewire\Salary\Report;
use App\Livewire\Salary\Payslip;
use App\Livewire\Admin\Dashboard;
use App\Livewire\MemberDepartement;
use App\Livewire\Attendance\History;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Member\EmployeeForm;
use Illuminate\Support\Facades\Route;
use App\Livewire\Attendance\AllMember;
use App\Livewire\Attendance\CheckInOut;
use App\Livewire\Position\PositionForm;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\StaffMiddleware;
use App\Http\Middleware\AtasanMiddleware;
use App\Livewire\Position\ManagePosition;
use App\Livewire\Report\DepartmentSalary;
use App\Http\Controllers\PayslipController;
use App\Livewire\Departement\DepartementForm;
use App\Livewire\Leave\Report as LeaveReport;
use App\Livewire\Departement\ManageDepartement;
use App\Livewire\Leave\History as LeaveHistory;
use App\Livewire\Attendance\DepartementAttendance;
use App\Livewire\Staff\Dashboard as StaffDashboard;
use App\Livewire\Atasan\Dashboard as AtasanDashboard;
use App\Livewire\Member\AllMember as MemberAllMember;

// Public routes
Route::get('/', function () {return redirect('/login');});

// Login Routes
Route::get('/login', function() {return view('auth.login');})->name('login');
Route::post('/logout', function() {Auth::logout();return redirect('/login');})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/salary/payslip', Payslip::class)->name('salary.payslip');
    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/salary/payslip/download/{year}/{month}', [PayslipController::class, 'download'])
    ->name('payslip.download');
});

// Admin Routes
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/attendance/all-member', AllMember::class)->name('attendance.all-member');
    Route::get('/leave/report', LeaveReport::class)->name('leave.report');
    Route::get('/salary/report', Report::class)->name('salary.report');
    Route::get('/departement/manage', ManageDepartement::class)->name('departement.manage');
    Route::get('/departement/create', DepartementForm::class)->name('departement.create');
    Route::get('/departement/edit/{id}', DepartementForm::class)->name('departement.edit');
    Route::get('/member', MemberAllMember::class)->name('member');
    Route::get('/member/create', EmployeeForm::class)->name('member.create');
    Route::get('/member/edit/{id}', EmployeeForm::class)->name('member.edit');
    Route::get('/position', ManagePosition::class)->name('position.manage');
    Route::get('/position/create', PositionForm::class)->name('position.create');
    Route::get('/position/edit/{id}', PositionForm::class)->name('position.edit');
});

// Atasan Routes
Route::middleware(['auth', AtasanMiddleware::class])->group(function () {
    Route::get('/atasan/dashboard', AtasanDashboard::class)->name('atasan.dashboard');
    Route::get('/attendance/departement', DepartementAttendance::class)->name('attendance.departement');
    Route::get('/report/departement-salary', DepartmentSalary::class)->name('report.departement-salary');
    Route::get('/leave/approve', Approve::class)->name('leave.approve');
    Route::get('/departement/{id}/members', MemberDepartement::class)->name('departement.members');
});

// Staff Routes
Route::middleware(['auth', StaffMiddleware::class])->group(function () {
    Route::get('/staff/dashboard', StaffDashboard::class)->name('staff.dashboard');
    Route::get('/attendance/check', CheckInOut::class)->name('attendance.check');
    Route::get('/attendance/history', History::class)->name('attendance.history');
    Route::get('/leave/apply', Apply::class)->name('leave.apply');
    Route::get('/leave/history', LeaveHistory::class)->name('leave.history');
});