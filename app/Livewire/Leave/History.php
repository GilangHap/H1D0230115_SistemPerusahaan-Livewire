<?php

namespace App\Livewire\Leave;

use Carbon\Carbon;
use App\Models\Cuti;
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
    public $searchQuery = '';
    
    protected $queryString = [
        'month' => ['except' => ''],
        'year' => ['except' => ''],
        'filterStatus' => ['except' => ''],
        'searchQuery' => ['except' => '']
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

    public function updatingSearchQuery()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['month', 'year', 'filterStatus', 'searchQuery']);
        $this->resetPage();
    }

    public function render()
    {
        $userId = Auth::id();
        
        // Build the base query
        $baseQuery = Cuti::where('pegawai_id', $userId);
        
        // Apply filters
        if ($this->month) {
            $baseQuery->whereMonth('tanggal_mulai', $this->month);
        }
        
        if ($this->year) {
            $baseQuery->whereYear('tanggal_mulai', $this->year);
        }
        
        if ($this->filterStatus) {
            $baseQuery->where('status', $this->filterStatus);
        }
        
        if ($this->searchQuery) {
            $baseQuery->where(function ($query) {
                $query->where('alasan', 'like', '%' . $this->searchQuery . '%')
                      ->orWhere('catatan', 'like', '%' . $this->searchQuery . '%');
            });
        }
        
        // Calculate statistics
        $stats = [
            'total' => (clone $baseQuery)->count(),
            'approved' => (clone $baseQuery)->where('status', 'approved')->count(),
            'pending' => (clone $baseQuery)->where('status', 'pending')->count(),
            'rejected' => (clone $baseQuery)->where('status', 'rejected')->count(),
            'canceled' => (clone $baseQuery)->where('status', 'canceled')->count(),
        ];
        
        // Calculate total days
        $totalDays = (clone $baseQuery)->where('status', 'approved')->sum('jumlah_hari');
        $pendingDays = (clone $baseQuery)->where('status', 'pending')->sum('jumlah_hari');
        
        // Get remaining leaves
        $year = Carbon::now()->year;
        $usedLeaves = Cuti::where('pegawai_id', $userId)
            ->whereYear('tanggal_mulai', $year)
            ->whereIn('status', ['approved', 'pending'])
            ->sum('jumlah_hari');
        
        $remainingLeaves = 12 - $usedLeaves; // Assuming 12 days per year
        if ($remainingLeaves < 0) {
            $remainingLeaves = 0;
        }
        
        // Get paginated results
        $leaveRequests = $baseQuery->orderBy('created_at', 'desc')
                                   ->paginate(10);
        
        // Get list of months and years for filters
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        
        $currentYear = Carbon::now()->year;
        $years = range($currentYear - 2, $currentYear);
        
        return view('livewire.leave.history', [
            'leaveRequests' => $leaveRequests,
            'months' => $months,
            'years' => $years,
            'stats' => $stats,
            'totalDays' => $totalDays,
            'pendingDays' => $pendingDays,
            'remainingLeaves' => $remainingLeaves
        ]);
    }
}
