<?php

namespace App\Livewire\Leave;

use Carbon\Carbon;
use App\Models\Cuti;
use Livewire\Component;
use App\Models\UnitKerja;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Report extends Component
{
    use WithPagination;
    
    #[Layout('livewire.layouts.app-layout')]
    // Filters
    public $search = '';
    public $statusFilter = 'approved';
    public $departmentFilter = '';
    public $monthFilter = '';
    public $yearFilter = '';
    public $dateRange = 'thisMonth';
    public $customDateStart;
    public $customDateEnd;
    
    // Sort
    public $sortField = 'tanggal_mulai';
    public $sortDirection = 'desc';
    public $perPage = 10;
    
    // Stats
    public $totalLeaves = 0;
    public $totalDays = 0;
    public $totalEmployees = 0;
    public $departmentStats = [];
    public $monthlyStats = [];
    
    // Export
    public $isExporting = false;
    
    protected $queryString = [
        'search' => ['except' => ''],
        'statusFilter' => ['except' => 'approved'],
        'departmentFilter' => ['except' => ''],
        'dateRange' => ['except' => 'thisMonth'],
        'sortField' => ['except' => 'tanggal_mulai'],
        'sortDirection' => ['except' => 'desc'],
    ];
    
    public function mount()
    {
        // Set default date range
        $this->setDefaultDateRange();
        
        // Set current year and month for filters
        $this->yearFilter = date('Y');
        $this->monthFilter = date('m');
    }
    
    public function setDefaultDateRange()
    {
        $now = Carbon::now();
        $this->customDateStart = $now->startOfMonth()->format('Y-m-d');
        $this->customDateEnd = $now->endOfMonth()->format('Y-m-d');
    }
    
    public function updatedDateRange()
    {
        $now = Carbon::now();
        
        switch ($this->dateRange) {
            case 'today':
                $this->customDateStart = $now->format('Y-m-d');
                $this->customDateEnd = $now->format('Y-m-d');
                break;
            case 'thisWeek':
                $this->customDateStart = $now->startOfWeek()->format('Y-m-d');
                $this->customDateEnd = $now->endOfWeek()->format('Y-m-d');
                break;
            case 'thisMonth':
                $this->customDateStart = $now->startOfMonth()->format('Y-m-d');
                $this->customDateEnd = $now->endOfMonth()->format('Y-m-d');
                break;
            case 'lastMonth':
                $this->customDateStart = $now->subMonth()->startOfMonth()->format('Y-m-d');
                $this->customDateEnd = $now->endOfMonth()->format('Y-m-d');
                break;
            case 'thisYear':
                $this->customDateStart = $now->startOfYear()->format('Y-m-d');
                $this->customDateEnd = $now->endOfYear()->format('Y-m-d');
                break;
            case 'custom':
                // Do nothing, as custom dates are set by the user
                break;
        }
        
        $this->resetPage();
    }
    
    public function updatedMonthFilter()
    {
        if ($this->monthFilter && $this->yearFilter) {
            $date = Carbon::createFromDate($this->yearFilter, $this->monthFilter, 1);
            $this->customDateStart = $date->startOfMonth()->format('Y-m-d');
            $this->customDateEnd = $date->endOfMonth()->format('Y-m-d');
            $this->dateRange = 'custom';
            $this->resetPage();
        }
    }
    
    public function updatedYearFilter()
    {
        if ($this->yearFilter && !$this->monthFilter) {
            $date = Carbon::createFromDate($this->yearFilter, 1, 1);
            $this->customDateStart = $date->startOfYear()->format('Y-m-d');
            $this->customDateEnd = $date->endOfYear()->format('Y-m-d');
            $this->dateRange = 'custom';
            $this->resetPage();
        } else if ($this->yearFilter && $this->monthFilter) {
            $this->updatedMonthFilter();
        }
    }
    
    public function updatedSearch()
    {
        $this->resetPage();
    }
    
    public function updatedStatusFilter()
    {
        $this->resetPage();
    }
    
    public function updatedDepartmentFilter()
    {
        $this->resetPage();
    }
    
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }
    
    public function resetFilters()
    {
        $this->reset(['search', 'statusFilter', 'departmentFilter', 'dateRange']);
        $this->setDefaultDateRange();
        $this->resetPage();
    }
    
    public function exportToExcel()
    {
        $this->isExporting = true;
        
        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => 'Export Berhasil',
            'text' => 'Data laporan cuti berhasil di-export ke Excel.',
        ]);
        
        $this->isExporting = false;
    }
    
    public function exportToPdf()
    {
        $this->isExporting = true;
        
        $this->dispatch('swal:modal', [
            'icon' => 'success',
            'title' => 'Export Berhasil',
            'text' => 'Data laporan cuti berhasil di-export ke PDF.',
        ]);
        
        $this->isExporting = false;
    }
    
    public function calculateStats($leaves)
    {
        // Reset stats
        $this->totalLeaves = $leaves->count();
        $this->totalDays = 0;
        $this->totalEmployees = $leaves->pluck('pegawai_id')->unique()->count();
        $this->departmentStats = [];
        $this->monthlyStats = array_fill(0, 12, 0);
        
        // Department stats
        $departments = UnitKerja::all();
        foreach ($departments as $department) {
            $this->departmentStats[$department->id] = [
                'name' => $department->nama_unit,
                'count' => 0,
                'days' => 0
            ];
        }
        
        // Calculate stats
        foreach ($leaves as $leave) {
            $this->totalDays += $leave->jumlah_hari;
            
            // Department stats
            $departmentId = $leave->pegawai->unit_kerja_id ?? null;
            if ($departmentId && isset($this->departmentStats[$departmentId])) {
                $this->departmentStats[$departmentId]['count']++;
                $this->departmentStats[$departmentId]['days'] += $leave->jumlah_hari;
            }
            
            // Monthly stats
            $month = Carbon::parse($leave->tanggal_mulai)->month - 1; // 0-indexed
            $this->monthlyStats[$month] += $leave->jumlah_hari;
        }
    }
    
    public function render()
    {
        $dateStart = Carbon::parse($this->customDateStart)->startOfDay();
        $dateEnd = Carbon::parse($this->customDateEnd)->endOfDay();
        
        $query = Cuti::query()
            ->with(['pegawai.unitKerja', 'approvedBy'])
            ->whereBetween('tanggal_mulai', [$dateStart, $dateEnd]);
        
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }
        
        if ($this->departmentFilter) {
            $query->whereHas('pegawai', function ($query) {
                $query->where('unit_kerja_id', $this->departmentFilter);
            });
        }
        
        if ($this->search) {
            $query->whereHas('pegawai', function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%')
                      ->orWhere('nip', 'like', '%' . $this->search . '%');
            })->orWhere('alasan', 'like', '%' . $this->search . '%');
        }
        
        $leaves = $query->orderBy($this->sortField, $this->sortDirection)->get();
        
        // Calculate stats from all matching leaves
        $this->calculateStats($leaves);
        
        // Get paginated results for display
        $leavesPaginated = $query->orderBy($this->sortField, $this->sortDirection)
                               ->paginate($this->perPage);
        
        $departments = UnitKerja::orderBy('nama_unit')->get();
        
        return view('livewire.leave.report', [
            'leaves' => $leavesPaginated,
            'departments' => $departments,
            'months' => $this->getMonthsList(),
            'years' => $this->getYearsList(),
        ]);
    }
    
    private function getMonthsList()
    {
        return [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
    }
    
    private function getYearsList()
    {
        $currentYear = (int)date('Y');
        $years = [];
        
        for ($i = $currentYear - 2; $i <= $currentYear + 1; $i++) {
            $years[$i] = $i;
        }
        
        return $years;
    }
}
