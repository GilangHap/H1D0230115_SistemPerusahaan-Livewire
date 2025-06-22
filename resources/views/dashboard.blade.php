<!-- filepath: d:\laragon\www\Sistem-Perusahaan\resources\views\atasan\dashboard.blade.php -->
@extends('livewire.layouts.app-layout')

@section('content')
    @php
        $role = auth()->user()->jabatan->role->name ?? 'staff';
    @endphp
    
    @if($role == 'admin')
        <livewire:admin.dashboard />
    @elseif($role == 'atasan')
        <livewire:atasan.dashboard />
    @else
        <livewire:staff.dashboard />
    @endif
@endsection