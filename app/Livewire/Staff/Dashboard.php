<?php

namespace App\Livewire\Staff;

use Carbon\Carbon;
use App\Models\Cuti;
use App\Models\Absensi;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{

    #[Layout('livewire.layouts.app-layout')]
    public $currentDate;
    public $attendanceSummary;
    public $leaveBalance;
    public $recentAttendance;
    public $weeklyPerformance;
    public $pegawaiData;
    public $todayAttendance;
    public $jamMasukLimit = '08:00:00'; // Batas jam masuk

    public function mount()
    {
        $this->currentDate = Carbon::now()->format('l, d F Y');
        $this->loadPegawaiData();
        $this->loadAttendanceSummary();
        $this->loadLeaveBalance();
        $this->loadRecentAttendance();
        $this->loadWeeklyPerformance();
        $this->loadTodayAttendance();
    }

    private function loadPegawaiData()
    {
        $this->pegawaiData = Auth::user();
    }

    private function loadAttendanceSummary()
    {
        $pegawaiId = Auth::id();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        
        // Calculate working days in month (excluding weekends)
        $daysInMonth = Carbon::now()->daysInMonth;
        $firstDayOfMonth = Carbon::create($currentYear, $currentMonth, 1);
        $lastDayOfMonth = Carbon::create($currentYear, $currentMonth, $daysInMonth);
        
        $totalWorkDays = 0;
        $current = $firstDayOfMonth->copy();
        
        while ($current <= $lastDayOfMonth) {
            if ($current->isWeekday()) { // Monday to Friday
                $totalWorkDays++;
            }
            $current->addDay();
        }
        
        // Calculate working days elapsed so far
        $workDaysElapsed = 0;
        $current = $firstDayOfMonth->copy();
        $today = Carbon::now();
        
        while ($current <= $today && $current <= $lastDayOfMonth) {
            if ($current->isWeekday()) {
                $workDaysElapsed++;
            }
            $current->addDay();
        }
        
        // Get attendance data
        $attendanceThisMonth = Absensi::where('pegawai_id', $pegawaiId)
            ->whereYear('tanggal', $currentYear)
            ->whereMonth('tanggal', $currentMonth)
            ->get();
            
        $onTime = $attendanceThisMonth->where('status', 'hadir')->count();
        $late = $attendanceThisMonth->where('status', 'terlambat')->count();
        $absent = $workDaysElapsed - ($onTime + $late);
        $absent = max(0, $absent); // Ensure no negative values
        
        $attendanceRate = $workDaysElapsed > 0 ? round((($onTime + $late) / $workDaysElapsed) * 100) : 0;
        
        $this->attendanceSummary = [
            'onTime' => $onTime,
            'late' => $late,
            'absent' => $absent,
            'attendanceRate' => $attendanceRate,
            'currentMonth' => Carbon::now()->format('F'),
            'workDaysTotal' => $totalWorkDays,
            'workDaysElapsed' => $workDaysElapsed,
            'daysRemaining' => $totalWorkDays - $workDaysElapsed
        ];
    }

    private function loadLeaveBalance()
    {
        $pegawaiId = Auth::id();
        $currentYear = Carbon::now()->year;
        
        $totalLeaveAllowance = 12; // Assuming 12 days annual leave allowance
        
        // Only count approved leaves against quota
        $usedLeave = Cuti::where('pegawai_id', $pegawaiId)
            ->whereYear('tanggal_mulai', $currentYear)
            ->where('status', 'approved')
            ->sum('jumlah_hari');
            
        // Count pending leaves separately
        $pendingLeave = Cuti::where('pegawai_id', $pegawaiId)
            ->whereYear('tanggal_mulai', $currentYear)
            ->where('status', 'pending')
            ->sum('jumlah_hari');
        
        $remainingLeave = $totalLeaveAllowance - $usedLeave - $pendingLeave;
        $remainingLeave = max(0, $remainingLeave); // Ensure no negative values
        
        $this->leaveBalance = [
            'total' => $totalLeaveAllowance,
            'used' => $usedLeave,
            'pending' => $pendingLeave,
            'remaining' => $remainingLeave,
            'percentUsed' => $totalLeaveAllowance > 0 ? round(($usedLeave / $totalLeaveAllowance) * 100) : 0
        ];
    }

    private function loadRecentAttendance()
    {
        $pegawaiId = Auth::id();
        $this->recentAttendance = Absensi::where('pegawai_id', $pegawaiId)
            ->latest('tanggal')
            ->take(5)
            ->get();
    }
    
    private function loadTodayAttendance()
    {
        $pegawaiId = Auth::id();
        $this->todayAttendance = Absensi::where('pegawai_id', $pegawaiId)
            ->whereDate('tanggal', Carbon::today())
            ->first();
    }

    private function loadWeeklyPerformance()
    {
        $pegawaiId = Auth::id();
        $startDate = Carbon::now()->subDays(6);
        $endDate = Carbon::now();
        
        $this->weeklyPerformance = [];
        
        for ($date = clone $startDate; $date <= $endDate; $date->addDay()) {
            $day = $date->format('D');
            $dateCopy = $date->copy();
            
            // Calculate performance based on attendance only
            $attendance = Absensi::where('pegawai_id', $pegawaiId)
                ->whereDate('tanggal', $dateCopy)
                ->first();
            
            // Simple performance calculation based on attendance
            $performance = 0;
            $status = 'absent';
            
            if ($attendance) {
                switch($attendance->status) {
                    case 'hadir':
                        $performance = 100; // Full performance for on-time attendance
                        $status = 'ontime';
                        break;
                    case 'terlambat':
                        $performance = 70; // Reduced performance for late attendance
                        $status = 'late';
                        break;
                    default:
                        $performance = 0;
                        $status = 'absent';
                }
            } else if ($date->isWeekend()) {
                // Weekend without attendance record
                $performance = 0;
                $status = 'weekend';
            } else if ($date->isFuture()) {
                // Future date
                $performance = 0;
                $status = 'upcoming';
            }
                
            $this->weeklyPerformance[] = [
                'day' => $day,
                'value' => $performance,
                'date' => $dateCopy->format('d M'),
                'status' => $status,
                'isToday' => $dateCopy->isToday()
            ];
        }
    }

    public function render()
    {
        return view('livewire.staff.dashboard');
    }
}