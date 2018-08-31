<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Support\Carbon;
use Lava;

class StatisticController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders_by_month = Order::all()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->toDateTimeString();
        });

        //dd($orders_by_month);

        $sales = Lava::DataTable();

        $sales->addDateColumn('Date')
            ->addNumberColumn('Sales');

        foreach ($orders_by_month as $month => $orders) {

            $total = $orders->reduce(function ($carry, $order) {
                return $carry + $order['amount'] * $order['price'];
            }, 0);

            $sales->addRow([$month, $total]);
        }

        Lava::AreaChart('Sales', $sales, [
            'title' => 'Sales',
            'legend' => [
                'position' => 'in',
            ],
        ]);

        return view('statistic.index');
    }
}
