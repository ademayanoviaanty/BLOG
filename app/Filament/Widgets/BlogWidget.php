<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class BlogWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $userCount = User::count();
        $postCount = Post::count();
        $categoryCount = Category::count();

        // Mengambil data pengguna baru yang terdaftar dalam 7 hari terakhir
        $newUsersPerDay = User::where('created_at', '>=', Carbon::now()->subDays(7))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->toArray();

        // Mengambil data kategori baru yang dibuat dalam 7 hari terakhir
        $newCategoriesPerDay = Category::where('created_at', '>=', Carbon::now()->subDays(7))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->toArray();

        // Mengambil data post baru yang dibuat dalam 7 hari terakhir
        $newPostsPerDay = Post::where('created_at', '>=', Carbon::now()->subDays(7))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date')
            ->toArray();

        // Fungsi untuk mengisi data chart dengan 0 jika tidak ada data pada hari tertentu
        function fillChartData($data, $days)
        {
            $chartData = [];
            for ($i = 0; $i < $days; $i++) {
                $date = Carbon::now()->subDays($days - 1 - $i)->toDateString();
                $chartData[] = $data[$date] ?? 0;
            }
            return $chartData;
        }

        return [
            Stat::make('New Users', $userCount)
                ->description('Newly Registered User')
                ->icon('heroicon-o-users')
                ->chart(fillChartData($newUsersPerDay, 7))
                ->color('success'),
            Stat::make('New Categories', $categoryCount)
                ->description('Categories Created')
                ->icon('heroicon-o-folder')
                ->chart(fillChartData($newCategoriesPerDay, 7))
                ->color('success'),
            Stat::make('New Posts', $postCount)
                ->description('Posts Created')
                ->icon('heroicon-o-newspaper')
                ->chart(fillChartData($newPostsPerDay, 7))
                ->color('success'),
        ];
    }
}
