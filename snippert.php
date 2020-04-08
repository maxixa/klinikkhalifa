<?php

Cart::instance('wishlist')->add('suber', 'Product 6', 1, 19.95, 550, ['size' => 'small']);
Cart::instance('wishlist')->total();
Gloudemans\Shoppingcart\Facades\Cart::instance('rawatJalanCart')->content();
Cart::instance('wishlist')->update($rowId, 2009);

// today month
intval(\Carbon\Carbon::parse(now())->format('n'));
(int)\Carbon\Carbon::parse(now())->format('n');
//today date
(int)\Carbon\Carbon::parse(now())->format('j');
//QUERY MODEL
Model::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get();

whereDay('created_at', '=', date('d'));
whereMonth('created_at', '=', date('m'));
whereYear('created_at', '=', date('Y'));

//group
Item::where('year', $year)
        ->groupBy('month', 'category_id')
        ->selectRaw('sum(amount) as sum, month, category_id')
        ->orderBy('category_id')
        ->orderBy('month')
        ->get()
        ->groupBy('category_id')
        ->map(function($item){
                $item = $item->pluck('sum', 'month');
                $item['total'] = $item->sum();
                return $item;
            });

$now = \Carbon\Carbon::now();

//cari
toDateString()
toStringDate()

strtotime()
