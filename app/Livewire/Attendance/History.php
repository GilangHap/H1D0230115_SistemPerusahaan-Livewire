<?php

namespace App\Livewire\Attendance;

use Carbon\Carbon;
use App\Models\Absensi;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class History extends Component
{
    use WithPagination;

    #[Layout('livewire.layouts.app-layout')]

    public $month;
    public $year;
    public $filterStatus = '';
    
    protected $queryString = [
        'month' => ['except' => ''],
        'year' => ['except' => ''],
        'filterStatus' => ['except' => ''],
    ];

    public function mount()
    {
        // Set default month and year to current
        $this->month = $this->month ?: Carbon::now()->month;
        $this->year = $this->year ?: Carbon::now()->year;
    }

    public function updatingMonth()
    {
        $this->resetPage();
    }

    public function updatingYear()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        $userId = Auth::id();
        
        // Build the base query
        $baseQuery = Absensi::where('pegawai_id', $userId);
        
        // Apply filters
        if ($this->month) {
            $baseQuery->whereMonth('tanggal', $this->month);
        }
        
        if ($this->year) {
            $baseQuery->whereYear('tanggal', $this->year);
        }
        
        // Calculate stats correctly without using clone
        $stats = [
            'total' => (clone $baseQuery)->count(),
            'hadir' => (clone $baseQuery)->where('status', 'hadir')->count(),
            'terlambat' => (clone $baseQuery)->where('status', 'terlambat')->count(),
            'izin' => (clone $baseQuery)->where('status', 'izin')->count(),
            'sakit' => (clone $baseQuery)->where('status', 'sakit')->count(),
        ];
        
        // Apply status filter after stats calculation if needed
        if ($this->filterStatus) {
            $baseQuery->where('status', $this->filterStatus);
        }
        
        // Order and paginate
        $attendance = $baseQuery->orderBy('tanggal', 'desc')
                              ->orderBy('jam_masuk', 'desc')
                              ->paginate(10);
        
        // Get list of months and years for filters
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        $currentYear = Carbon::now()->year;
        $years = range($currentYear - 2, $currentYear);
        
        return view('livewire.attendance.history', [
            'attendance' => $attendance,
            'months' => $months,
            'years' => $years,
            'stats' => $stats
        ]);
    }
    
    public function resetFilters()
    {
        $this->reset(['month', 'year', 'filterStatus']);
        $this->resetPage();
    }
}
