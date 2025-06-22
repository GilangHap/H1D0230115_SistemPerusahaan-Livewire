<?php

namespace App\Livewire\Attendance;

use Carbon\Carbon;
use App\Models\Absensi;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CheckInOut extends Component
{
    public $keterangan = '';
    public $todayAttendance = null;
    public $currentTime;
    public $status = '';
    public $jamMasuk = null;
    public $jamPulang = null;
    public $isTerlambat = false;
    public $jamMasukLimit = '08:00:00'; // Batas jam masuk

    public function mount()
    {
        $this->checkTodayAttendance();
        $this->updateCurrentTime();
    }
    
    public function updateCurrentTime()
    {
        try {
            $this->currentTime = now()->format('H:i:s');
        } catch (\Exception $e) {
            Log::error('Error updating time: ' . $e->getMessage());
            $this->currentTime = date('H:i:s');
        }
    }
    #[Layout('livewire.layouts.app-layout')]
    public function render()
    {
        return view('livewire.attendance.check-in-out');
    }

    public function checkIn()
    {
        try {
            $this->validate([
                'keterangan' => 'nullable|string|max:255',
            ]);

            if (!Auth::check()) {
                session()->flash('error', 'Anda belum login.');
                return;
            }

            $now = Carbon::now();
            $jamMasukLimit = Carbon::createFromTimeString($this->jamMasukLimit);
            $status = 'hadir';
            
            // Cek apakah terlambat (absen setelah jam 8 pagi)
            if ($now->format('H:i:s') > $this->jamMasukLimit) {
                $status = 'terlambat';
            }

            Absensi::create([
                'pegawai_id' => Auth::id(),
                'tanggal' => Carbon::today()->toDateString(),
                'jam_masuk' => $now,
                'status' => $status,
                'keterangan' => $this->keterangan,
            ]);

            $statusMessage = $status === 'terlambat' 
                ? 'Berhasil absen masuk! Anda terlambat hari ini.' 
                : 'Berhasil absen masuk!';
                
            session()->flash('message', $statusMessage);
            session()->flash('status', $status);
            
            $this->checkTodayAttendance();
            $this->reset('keterangan');
        } catch (\Exception $e) {
            Log::error('Check-in error: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat melakukan absen masuk. Silakan coba lagi.');
        }
    }

    public function checkOut()
    {
        try {
            if ($this->todayAttendance) {
                $this->todayAttendance->jam_pulang = Carbon::now();
                $this->todayAttendance->save();

                session()->flash('message', 'Berhasil absen pulang!');
                $this->checkTodayAttendance();
            }
        } catch (\Exception $e) {
            Log::error('Check-out error: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat melakukan absen pulang. Silakan coba lagi.');
        }
    }

    private function checkTodayAttendance()
    {
        try {
            if (!Auth::check()) {
                $this->status = 'not-logged-in';
                return;
            }

            $this->todayAttendance = Absensi::where('pegawai_id', Auth::id())
                ->whereDate('tanggal', Carbon::today())
                ->first();
            
            if ($this->todayAttendance) {
                // Store formatted time strings to avoid calling format() on a string in the blade file
                if ($this->todayAttendance->jam_masuk) {
                    if ($this->todayAttendance->jam_masuk instanceof Carbon) {
                        $this->jamMasuk = $this->todayAttendance->jam_masuk->format('H:i:s');
                    } else {
                        $this->jamMasuk = Carbon::parse($this->todayAttendance->jam_masuk)->format('H:i:s');
                    }
                    
                    // Set status terlambat
                    $this->isTerlambat = $this->todayAttendance->status === 'terlambat';
                }
                
                if ($this->todayAttendance->jam_pulang) {
                    if ($this->todayAttendance->jam_pulang instanceof Carbon) {
                        $this->jamPulang = $this->todayAttendance->jam_pulang->format('H:i:s');
                    } else {
                        $this->jamPulang = Carbon::parse($this->todayAttendance->jam_pulang)->format('H:i:s');
                    }
                    $this->status = 'completed';
                } else {
                    $this->status = 'checked-in';
                }
            } else {
                $this->status = 'not-checked-in';
                
                // Periksa apakah waktu saat ini sudah melewati batas jam masuk
                $this->isTerlambat = Carbon::now()->format('H:i:s') > $this->jamMasukLimit;
            }
        } catch (\Exception $e) {
            Log::error('Checking attendance error: ' . $e->getMessage());
            $this->status = 'error';
        }
    }
}
