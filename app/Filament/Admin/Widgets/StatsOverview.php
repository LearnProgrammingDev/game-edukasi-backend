<?php

namespace App\Filament\Admin\Widgets; // ← pastikan ini yang ada

use App\Models\Node;
use App\Models\User;
use App\Models\UserProgress;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Siswa', User::where('role', 'student')->count())
                ->description('Akun terdaftar')
                ->icon('heroicon-o-users')
                ->color('success'),

            Stat::make('Total Node', Node::count())
                ->description(
                    Node::where('type', 'materi')->count() . ' materi · ' .
                        Node::where('type', 'kuis')->count() . ' kuis'
                )
                ->icon('heroicon-o-map')
                ->color('primary'),

            Stat::make(
                'Total Penyelesaian',
                UserProgress::where('status', 'completed')->count()
            )
                ->description('Oleh semua siswa')
                ->icon('heroicon-o-check-circle')
                ->color('warning'),
        ];
    }
}
