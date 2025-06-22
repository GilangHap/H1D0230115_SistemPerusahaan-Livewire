<?php

namespace App\Livewire\Leave;

use Carbon\Carbon;
use App\Models\Cuti;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

class Apply extends Component
{
    #[Layout('livewire.layouts.app-layout')]
    public $tanggal_mulai;
    public $tanggal_akhir;
    public $alasan;
    public $jumlah_hari = 0;
    public $remainingLeaves = 12; // Default quota - you might want to make this dynamic
    
    protected $rules = [
        'tanggal_mulai' => 'required|date|after_or_equal:today',
        'tanggal_akhir' => 'required|date|after_or_equal:tanggal_mulai',
        'alasan' => 'required|string|min:5|max:255',
    ];

    protected $messages = [
        'tanggal_mulai.required' => 'Tanggal mulai cuti wajib diisi.',
        'tanggal_mulai.date' => 'Format tanggal mulai tidak valid.',
        'tanggal_mulai.after_or_equal' => 'Tanggal mulai cuti harus hari ini atau setelahnya.',
        'tanggal_akhir.required' => 'Tanggal akhir cuti wajib diisi.',
        'tanggal_akhir.date' => 'Format tanggal akhir tidak valid.',
        'tanggal_akhir.after_or_equal' => 'Tanggal akhir cuti harus setelah atau sama dengan tanggal mulai.',
        'alasan.required' => 'Alasan cuti wajib diisi.',
        'alasan.min' => 'Alasan cuti minimal 5 karakter.',
        'alasan.max' => 'Alasan cuti maksimal 255 karakter.',
    ];
    
    public function mount()
    {
        // Set default dates to today and tomorrow
        $this->tanggal_mulai = Carbon::today()->format('Y-m-d');
        $this->tanggal_akhir = Carbon::tomorrow()->format('Y-m-d');
        
        // Calculate initial days count
        $this->calculateDays();
        
        // Get remaining leave days
        $this->calculateRemainingLeaves();
    }
    
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        
        if ($propertyName === 'tanggal_mulai' || $propertyName === 'tanggal_akhir') {
            $this->calculateDays();
        }
    }
    
    public function calculateDays()
    {
        try {
            if ($this->tanggal_mulai && $this->tanggal_akhir) {
                $startDate = Carbon::parse($this->tanggal_mulai);
                $endDate = Carbon::parse($this->tanggal_akhir);
                
                if ($endDate->lt($startDate)) {
                    $this->tanggal_akhir = $this->tanggal_mulai;
                    $endDate = $startDate;
                }
                
                // Only count weekdays (excluding weekends)
                $days = 0;
                for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
                    if (!$date->isWeekend()) {
                        $days++;
                    }
                }
                
                $this->jumlah_hari = $days;
            }
        } catch (\Exception $e) {
            $this->jumlah_hari = 0;
        }
    }
    
    /**
     * Cancel a pending leave request
     */
    public function cancelLeave($leaveId)
    {
        try {
            // Find the leave request
            $leave = Cuti::where('id', $leaveId)
                ->where('pegawai_id', Auth::id())  // Security check: ensure it belongs to the user
                ->where('status', 'pending')       // Only pending leaves can be canceled
                ->first();
                
            if (!$leave) {
                session()->flash('error', 'Pengajuan cuti tidak ditemukan atau tidak dapat dibatalkan.');
                return;
            }
            
            // Change status to canceled
            $leave->status = 'canceled';
            $leave->catatan = 'Dibatalkan oleh pengguna pada ' . now()->format('d M Y H:i');
            $leave->save();
            
            // Recalculate remaining leaves to restore the quota
            $this->calculateRemainingLeaves();
            
            session()->flash('message', 'Pengajuan cuti berhasil dibatalkan.');
            
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat membatalkan pengajuan cuti.');
        }
    }

    /**
     * Improved method to calculate remaining leaves
     * This considers approved and pending leave requests only
     * Canceled and rejected leaves are not counted against the quota
     */
    private function calculateRemainingLeaves()
    {
        $year = Carbon::now()->year;
        
        // Get total used leave days in current year
        // Only count approved and pending leaves against the quota
        $usedLeaves = Cuti::where('pegawai_id', Auth::id())
            ->whereYear('tanggal_mulai', $year)
            ->whereIn('status', ['approved', 'pending'])  // Only count these statuses
            ->sum('jumlah_hari');
        
        // Assuming annual leave quota is 12 days
        $this->remainingLeaves = 12 - $usedLeaves;
        if ($this->remainingLeaves < 0) {
            $this->remainingLeaves = 0;
        }
    }
    
    public function submitLeave()
    {
        $this->validate();
        
        // Additional validation
        if ($this->jumlah_hari <= 0) {
            $this->addError('tanggal_mulai', 'Jumlah hari cuti harus lebih dari 0.');
            return;
        }
        
        if ($this->jumlah_hari > $this->remainingLeaves) {
            $this->addError('tanggal_akhir', 'Jumlah hari cuti melebihi sisa kuota cuti anda.');
            return;
        }
        
        try {
            Cuti::create([
                'pegawai_id' => Auth::id(),
                'tanggal_mulai' => $this->tanggal_mulai,
                'tanggal_akhir' => $this->tanggal_akhir,
                'jumlah_hari' => $this->jumlah_hari,
                'alasan' => $this->alasan,
                'status' => 'pending',
            ]);
            
            session()->flash('message', 'Pengajuan cuti berhasil disubmit.');
            $this->reset(['alasan']);
            $this->calculateRemainingLeaves();
            
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    public function render()
    {
        // Get recent leave requests
        $recentLeaves = Cuti::where('pegawai_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit(2)
            ->get();
            
        return view('livewire.leave.apply', [
            'recentLeaves' => $recentLeaves
        ]);
    }
}
