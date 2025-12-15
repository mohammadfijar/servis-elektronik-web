<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /** Default dashboard (kasir/user) */
    public function index()
    {
        $today     = now()->toDateString();
        $txCount   = Transaction::whereDate('created_at', $today)->count();
        $txRevenue = Transaction::whereDate('created_at', $today)->sum('grand_total');

        return view('dashboard.index', compact('txCount', 'txRevenue'));
    }

    /** Dashboard owner: overview penuh */
    public function owner()
    {
        $categoriesCount   = Category::count();
        $itemsCount        = Item::count();
        $customersCount    = Customer::count();
        $totalTransactions = Transaction::count();
        $totalRevenue      = Transaction::sum('grand_total');
        $totalServices     = Service::count();
    
        // Ambil data revenue per bulan
        $revenueData = Transaction::select(
                DB::raw('MONTHNAME(created_at) as month'),
                DB::raw('SUM(grand_total) as revenue')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('MONTH(created_at)'), DB::raw('MONTHNAME(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();
    
        return view('dashboard.owner', compact(
            'categoriesCount','itemsCount','customersCount',
            'totalTransactions','totalRevenue','totalServices',
            'revenueData' // tambahkan ini
        ));
    }

    /** Dashboard admin: monitoring stok & service */
    public function admin()
    {
        $pendingServices = Service::where('status', 'pending')->count();
        $inProgress      = Service::where('status', 'in_progress')->count();
        $completed       = Service::where('status', 'completed')->count();
        $totalItems      = Item::count();

        return view('dashboard.admin', compact(
            'pendingServices','inProgress','completed','totalItems'
        ));
    }

    /** Dashboard staff: tugas teknisi */
    public function staff()
    {
        $userId       = Auth::id();
        $myPending    = Service::where('staff_id', $userId)->where('status', 'pending')->count();
        $myInProgress = Service::where('staff_id', $userId)->where('status', 'in_progress')->count();
        $myCompleted  = Service::where('staff_id', $userId)->where('status', 'completed')->count();

        return view('dashboard.staff', compact(
            'myPending','myInProgress','myCompleted'
        ));
    }
}
