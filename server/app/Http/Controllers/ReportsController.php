<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function index(Request $request): View
    {
        // Selected report period
        $period = $request->get('period', 'month');

        // Selected date
        $date = $request->get('date', now()->format('Y-m-d'));

        $selectedDate = Carbon::parse($date);

        // Today
        $todayStart = now()->startOfDay();
        $todayEnd = now()->endOfDay();

        // Current week
        $weekStart = now()->startOfWeek();
        $weekEnd = now()->endOfWeek();

        // Current month
        $monthStart = now()->startOfMonth();
        $monthEnd = now()->endOfMonth();

        // Current year
        $yearStart = now()->startOfYear();
        $yearEnd = now()->endOfYear();

        // Summary counts
        $todayCount = Document::whereBetween(
            'date_received',
            [$todayStart->toDateString(), $todayEnd->toDateString()]
        )->count();

        $weekCount = Document::whereBetween(
            'date_received',
            [$weekStart->toDateString(), $weekEnd->toDateString()]
        )->count();

        $monthCount = Document::whereBetween(
            'date_received',
            [$monthStart->toDateString(), $monthEnd->toDateString()]
        )->count();

        $yearCount = Document::whereBetween(
            'date_received',
            [$yearStart->toDateString(), $yearEnd->toDateString()]
        )->count();

        // Selected period
        switch ($period) {

            case 'day':
                $periodStart = $selectedDate->copy()->startOfDay();
                $periodEnd = $selectedDate->copy()->endOfDay();
                break;

            case 'week':
                $periodStart = $selectedDate->copy()->startOfWeek();
                $periodEnd = $selectedDate->copy()->endOfWeek();
                break;

            case 'year':
                $periodStart = $selectedDate->copy()->startOfYear();
                $periodEnd = $selectedDate->copy()->endOfYear();
                break;

            case 'month':
            default:
                $periodStart = $selectedDate->copy()->startOfMonth();
                $periodEnd = $selectedDate->copy()->endOfMonth();
                $period = 'month';
                break;
        }

        // Category statistics
        $categoryStatistics = Document::with('category')
            ->whereBetween('date_received', [
                $periodStart->toDateString(),
                $periodEnd->toDateString()
            ])
            ->get()
            ->groupBy(function ($document) {
                return $document->category->name ?? 'Uncategorized';
            })
            ->map(function ($documents) {
                return $documents->count();
            })
            ->sortDesc();

        $selectedPeriodCount = $categoryStatistics->sum();

        return view('reports.index', compact(
            'period',
            'date',
            'selectedDate',
            'periodStart',
            'periodEnd',
            'todayCount',
            'weekCount',
            'monthCount',
            'yearCount',
            'categoryStatistics',
            'selectedPeriodCount'
        ));
    }
}
