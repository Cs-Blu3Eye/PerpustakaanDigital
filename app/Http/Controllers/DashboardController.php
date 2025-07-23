<?php
// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard admin.
     */
    public function index(Request $request)
    {
        $range = $request->get('range', 'year'); // default: 5 tahun
        $totalBooks = Book::count();
        $totalMembers = Member::count();
        $activeLoans = Loan::where('status', 'borrowed')->count();

        $loanMonths = [];
        $loanCounts = [];

        switch ($range) {
            case 'month':
                $loanData = Loan::selectRaw('MONTH(loan_date) as month, COUNT(*) as total')
                    ->whereYear('loan_date', now()->year)
                    ->groupByRaw('MONTH(loan_date)')
                    ->pluck('total', 'month')
                    ->all();

                foreach (range(1, 12) as $month) {
                    $loanMonths[] = \Carbon\Carbon::create()->month($month)->translatedFormat('F');
                    $loanCounts[] = $loanData[$month] ?? 0;
                }
                break;

            case 'week':
                $startOfMonth = now()->startOfMonth();
                for ($i = 0; $i < 4; $i++) {
                    $start = $startOfMonth->copy()->addWeeks($i);
                    $end = $start->copy()->addDays(6);
                    $count = Loan::whereBetween('loan_date', [$start, $end])->count();

                    $loanMonths[] = 'Minggu ' . ($i + 1);
                    $loanCounts[] = $count;
                }
                break;

            case 'day':
                $startOfWeek = now()->startOfWeek();
                for ($i = 0; $i < 7; $i++) {
                    $date = $startOfWeek->copy()->addDays($i);
                    $count = Loan::whereDate('loan_date', $date)->count();

                    $loanMonths[] = $date->translatedFormat('l'); // Senin, Selasa, ...
                    $loanCounts[] = $count;
                }
                break;

            case 'year':
            default:
                $currentYear = now()->year;
                $loanData = Loan::selectRaw('YEAR(loan_date) as year, COUNT(*) as total')
                    ->whereBetween('loan_date', [now()->subYears(4)->startOfYear(), now()->endOfYear()])
                    ->groupByRaw('YEAR(loan_date)')
                    ->pluck('total', 'year')
                    ->all();

                foreach (range($currentYear - 4, $currentYear) as $year) {
                    $loanMonths[] = $year;
                    $loanCounts[] = $loanData[$year] ?? 0;
                }
                break;
        }

        return view('dashboard', compact(
            'totalBooks',
            'totalMembers',
            'activeLoans',
            'loanMonths',
            'loanCounts'
        ));
    }
}
