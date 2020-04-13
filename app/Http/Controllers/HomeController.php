<?php

namespace App\Http\Controllers;

use App\Patient;
use Carbon\Carbon;
use App\ObatHerbal;
use App\RawatInap;
use App\RawatJalan;
use App\RawatKunjungan;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $provinces = Patient::all()->groupBy('province');

        $output = null;
        foreach($provinces as $key => $province) {
            foreach($province as $item) {
                //get each item in the group
            }
        $output[$key] = $province->count();
        //$output[$key] = $province->sum('id');
        }

        $thisMonth = (int)\Carbon\Carbon::parse(now())->format('n');
        $lastMonth = $thisMonth - 1;
        $lastTwoMonth = $thisMonth - 2;
            
        $thisYear = (int)\Carbon\Carbon::parse(now())->format('Y');
        $lastYear = $thisYear - 1;
            
        $today = CarbonImmutable::now()->toDateString();
        $yesterday = CarbonImmutable::now()->sub('1 day')->toDateString();
        $lastTwoDay = CarbonImmutable::now()->sub('2 days')->toDateString();

        //Obat Herbal
        $obatHerbalToday = ObatHerbal::whereDate('date','=',$today)->sum('total');
        $obatHerbalYesterday = ObatHerbal::whereDate('date','=',$yesterday)->sum('total');
        $obatHerbalLastTwoDay = ObatHerbal::whereDate('date','=',$lastTwoDay)->sum('total');

        $obatHerbalThisMonth = ObatHerbal
            ::whereMonth('date','=',$thisMonth)
            ->whereYear('date','=',$thisYear)
            ->sum('total');
        $obatHerbalLastMonth = ObatHerbal
        ::whereMonth('date','=',$lastMonth)
            ->whereYear('date','=',$thisYear)
            ->sum('total');
        $obatHerbalLastTwoMonth = ObatHerbal
            ::whereMonth('date','=',$lastTwoMonth)
            ->whereYear('date','=',$thisYear)
            ->sum('total');

        //Rawat Jalan
        $rawatJalanToday = RawatJalan::whereDate('date','=',$today)->sum('total');
        $rawatJalanYesterday = RawatJalan::whereDate('date','=',$yesterday)->sum('total');
        $rawatJalanLastTwoDay = RawatJalan::whereDate('date','=',$lastTwoDay)->sum('total');

        $rawatJalanThisMonth = RawatJalan
            ::whereMonth('date','=',$thisMonth)
            ->whereYear('date','=',$thisYear)
            ->sum('total');
        $rawatJalanLastMonth = RawatJalan
            ::whereMonth('date','=',$lastMonth)
            ->whereYear('date','=',$thisYear)
            ->sum('total');
        $rawatJalanLastTwoMonth = RawatJalan
            ::whereMonth('date','=',$lastTwoMonth)
            ->whereYear('date','=',$thisYear)
            ->sum('total');

        //Rawat Kunjungan
        $rawatKunjunganToday = RawatKunjungan::whereDate('date','=',$today)->sum('total');
        $rawatKunjunganYesterday = RawatKunjungan::whereDate('date','=',$yesterday)->sum('total');
        $rawatKunjunganLastTwoDay = RawatKunjungan::whereDate('date','=',$lastTwoDay)->sum('total');

        $rawatKunjunganThisMonth = RawatKunjungan
            ::whereMonth('date','=',$thisMonth)
            ->whereYear('date','=',$thisYear)
            ->sum('total');
        $rawatKunjunganLastMonth = RawatKunjungan
            ::whereMonth('date','=',$lastMonth)
            ->whereYear('date','=',$thisYear)
            ->sum('total');
        $rawatKunjunganLastTwoMonth = RawatKunjungan
            ::whereMonth('date','=',$lastTwoMonth)
            ->whereYear('date','=',$thisYear)
            ->sum('total');

        //Rawat Inap
        $rawatInapToday = RawatInap::whereDate('dateOut','=',$today)->sum('total');
        $rawatInapYesterday = RawatInap::whereDate('dateOut','=',$yesterday)->sum('total');
        $rawatInapLastTwoDay = RawatInap::whereDate('dateOut','=',$lastTwoDay)->sum('total');

        $rawatInapThisMonth = RawatInap
            ::whereMonth('dateOut','=',$thisMonth)
            ->whereYear('dateOut','=',$thisYear)
            ->sum('total');
        $rawatInapLastMonth = RawatInap
            ::whereMonth('dateOut','=',$lastMonth)
            ->whereYear('dateOut','=',$thisYear)
            ->sum('total');
        $rawatInapLastTwoMonth = RawatInap
            ::whereMonth('dateOut','=',$lastTwoMonth)
            ->whereYear('dateOut','=',$thisYear)
            ->sum('total');
        
        $incomeToday = $obatHerbalToday + $rawatJalanToday + $rawatKunjunganToday + $rawatInapToday;
        $incomeYesterday = $obatHerbalYesterday + $rawatJalanYesterday + $rawatKunjunganYesterday + $rawatInapYesterday;
        $incomeThisMonth = $obatHerbalThisMonth + $rawatJalanThisMonth + $rawatKunjunganThisMonth + $rawatInapThisMonth;
        $incomeLastMonth = $obatHerbalLastMonth + $rawatJalanLastMonth + $rawatKunjunganLastMonth + $rawatInapLastMonth;
        
            $output = [$obatHerbalThisMonth,$obatHerbalLastMonth];                   
        return view('home', 
        compact(
            'incomeToday',
            'incomeYesterday',
            'incomeThisMonth',
            'incomeLastMonth'
        ));
    }
}
