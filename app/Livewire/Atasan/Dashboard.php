<?php

namespace App\Livewire\Atasan;

use Carbon\Carbon;
use App\Models\Cuti;
use App\Models\Absensi;
use App\Models\Pegawai;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{
    #[Layout('livewire.layouts.app-layout')]
    public $teamMembers = [];
    public $pendingApprovals = [];
    public $todayAttendance = [];
    public $recentLeaveRequests = [];
    public $currentDate;

    public function mount()
    {
        $this->currentDate = Carbon::now()->format('j M Y');
        $manager = Auth::user();
        
        // Get the manager's unit
        $unitKerjaId = $manager->unit_kerja_id;
        
        // Get team members in the same unit
        $this->teamMembers = Pegawai::where('unit_kerja_id', $unitKerjaId)
            ->where('id', '!=', $manager->id)
            ->with('jabatan')
            ->take(5)
            ->get();
        
        // Count all team members for calculations
        $teamMemberCount = Pegawai::where('unit_kerja_id', $unitKerjaId)
            ->where('id', '!=', $manager->id)
            ->count();
        
        // Get pending approvals (cuti requests)
        $this->pendingApprovals = Cuti::where('status', 'pending')
            ->whereHas('pegawai', function($query) use ($unitKerjaId) {
                $query->where('unit_kerja_id', $unitKerjaId);
            })
            ->with('pegawai')
            ->take(5)
            ->get();
        
        // Generate today's attendance summary for the team
        $this->generateTodayAttendance($unitKerjaId, $teamMemberCount);
        
        // Recent leave requests with status
        $this->recentLeaveRequests = Cuti::whereHas('pegawai', function($query) use ($unitKerjaId) {
                $query->where('unit_kerja_id', $unitKerjaId);
            })
            ->with('pegawai')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    }

    private function generateTodayAttendance($unitKerjaId, $teamMemberCount)
    {
        // Get today's date
        $today = Carbon::today()->format('Y-m-d');
        $employeeIds = Pegawai::where('unit_kerja_id', $unitKerjaId)
            ->where('id', '!=', Auth::id())
            ->pluck('id')
            ->toArray();
            
        // Get attendance data for today
        $todayAttendances = Absensi::whereIn('pegawai_id', $employeeIds)
            ->where('tanggal', $today)
            ->get();
            
        // Count present and late employees
        $present = 0;
        $late = 0;
        
        foreach ($todayAttendances as $attendance) {
            if ($attendance->jam_masuk) {
                $checkInTime = Carbon::createFromFormat('H:i:s', $attendance->jam_masuk);
                $lateThreshold = Carbon::createFromFormat('H:i:s', '08:00:00');
                
                if ($checkInTime->gt($lateThreshold)) {
                    $late++;
                } else {
                    $present++;
                }
            } else if ($attendance->status === 'hadir') {
                $present++;
            } else if ($attendance->status === 'terlambat') {
                $late++;
            }
        }
            
        // Count employees on approved leave for today
        $onLeaveCount = Cuti::whereIn('pegawai_id', $employeeIds)
            ->where('status', 'approved')
            ->where(function ($query) use ($today) {
                $query->where('tanggal_mulai', '<=', $today)
                    ->where('tanggal_akhir', '>=', $today);
            })
            ->count();
            
        // Calculate absent count (total - present - late - on leave)
        $absent = max(0, $teamMemberCount - $present - $late - $onLeaveCount);
        
        $this->todayAttendance = [
            'present' => $present,
            'presentPercent' => $teamMemberCount > 0 ? round(($present / $teamMemberCount) * 100) : 0,
            'late' => $late,
            'latePercent' => $teamMemberCount > 0 ? round(($late / $teamMemberCount) * 100) : 0,
            'absent' => $absent,
            'absentPercent' => $teamMemberCount > 0 ? round(($absent / $teamMemberCount) * 100) : 0,
            'onLeave' => $onLeaveCount,
            'total' => $teamMemberCount
        ];
    }

    public function approveCuti($cutiId)
    {
        $cuti = Cuti::find($cutiId);
        if ($cuti && $cuti->status === 'pending') {
            $cuti->status = 'approved';
            $cuti->approved_by = Auth::id();
            $cuti->save();
            
            $this->dispatch('showAlert', [
                'type' => 'success',
                'message' => 'Pengajuan cuti berhasil disetujui'
            ]);
            
            // Refresh the pending approvals list
            $unitKerjaId = Auth::user()->unit_kerja_id;
            $this->pendingApprovals = Cuti::where('status', 'pending')
                ->whereHas('pegawai', function($query) use ($unitKerjaId) {
                    $query->where('unit_kerja_id', $unitKerjaId);
                })
                ->with('pegawai')
                ->take(5)
                ->get();
                
            // Update recent leave requests
            $this->recentLeaveRequests = Cuti::whereHas('pegawai', function($query) use ($unitKerjaId) {
                    $query->where('unit_kerja_id', $unitKerjaId);
                })
                ->with('pegawai')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        }
    }

    public function rejectCuti($cutiId)
    {
        $cuti = Cuti::find($cutiId);
        if ($cuti && $cuti->status === 'pending') {
            $cuti->status = 'rejected';
            $cuti->approved_by = Auth::id();
            $cuti->save();
            
            $this->dispatch('showAlert', [
                'type' => 'success',
                'message' => 'Pengajuan cuti berhasil ditolak'
            ]);
            
            // Refresh the pending approvals list
            $unitKerjaId = Auth::user()->unit_kerja_id;
            $this->pendingApprovals = Cuti::where('status', 'pending')
                ->whereHas('pegawai', function($query) use ($unitKerjaId) {
                    $query->where('unit_kerja_id', $unitKerjaId);
                })
                ->with('pegawai')
                ->take(5)
                ->get();
                
            // Update recent leave requests
            $this->recentLeaveRequests = Cuti::whereHas('pegawai', function($query) use ($unitKerjaId) {
                    $query->where('unit_kerja_id', $unitKerjaId);
                })
                ->with('pegawai')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.atasan.dashboard');
    }
}
