<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function filter_by_date(Request $request)
    {
        $data = $request->all();
        $from_date = isset($data['from_date']) ? $data['from_date'] : now()->subDays(30)->format('Y-m-d');
        $to_date = isset($data['to_date']) ? $data['to_date'] : now()->format('Y-m-d');
        return response()->json($revenues);
    }
    public function chart_dashboard()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;
        $currentYearRevenue = $revenues->where('year', $currentYear)->first()->total_revenue ?? 0;
        $lastYearRevenue = $revenues->where('year', $currentYear - 1)->first()->total_revenue ?? 0;
        // dd($currentYearRevenue,$lastYearRevenue);
        if ($lastYearRevenue != 0) {
            $percentageChangeYear = round((($currentYearRevenue - $lastYearRevenue) / $lastYearRevenue) * 100, 2);
        } else {
            $percentageChangeYear = 0;
        }

        // Lấy tổng tiền thu nhập được của các tháng trong năm
        $revenuesMonth = Order::selectRaw('MONTH(created_at) as month, SUM(total) as total_revenue')
            ->whereRaw('YEAR(created_at) = ?', [$currentYear])
            ->where('pay', '=', 1) 
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $currentMonthData = $revenuesMonth->where('month', $currentMonth)->first();
        $currentMonthRevenue = $currentMonthData ? $currentMonthData->total_revenue : 0;

        $lastMonthData = $revenuesMonth->where('month', $currentMonth - 1)->first();
        $lastMonthRevenue = $lastMonthData ? $lastMonthData->total_revenue : 0;
        // Phần trăm thu nhập của tháng này sao với tháng trước
        if ($lastMonthRevenue != 0) {
            $percentageChangeMonth = round((($currentMonthRevenue - $lastMonthRevenue) / $lastMonthRevenue) * 100, 2);
        } else {
            $percentageChangeMonth = 0;
        }
        // Tổng thu nhập của năm nay
        $currentYearTotal = $revenues->where('year', $currentYear)->sum('total_revenue');
        // Tổng thu nhập của tháng này
        $currentMonthTotal = $revenuesMonth->where('month', $currentMonth)->sum('total_revenue');

        // Lượt xem cao nhất
        $topViewProducts = Product::withTrashed()->orderBy('view', 'desc')
            ->take(6)
            ->get();


        // Số lượng loại sản phẩm
        $categories = Category::all();
        foreach ($categories as $category) {
            $category->qty = Product::where('idCategory', $category->id)->count();
        };
        $brands = Brand::all();
        foreach ($brands as $brand) {
            $brand->qty = Product::where('idBrand', $brand->id)->count();
        };

        $totalProductsCount = Product::withTrashed()->count();
        $totalBlogsCount = Blog::withTrashed()->count();
        $totalUsersCount = User::withTrashed()->count();


        $topSellingProducts = Cart::selectRaw('idProduct, SUM(qty) as totalQty')
            ->whereNotNull('idOrder')
            ->groupBy('idProduct')
            ->orderByDesc('totalQty')
            ->limit(4)
            ->get();
        $topSellingProductDetails = [];
        $images = Image::all();
        foreach ($topSellingProducts as $topSellingProduct) {
            $product = Product::withTrashed()->find($topSellingProduct->idProduct);
            foreach ($images as $image) {
                if ($image->idProduct == $product->id) {
                    $product->image = $image;
                    break;
                }
            }
            if ($product) {
                $topSellingProductDetails[] = [
                    'product' => $product,
                    'totalQty' => $topSellingProduct->totalQty,
                ];
            }
        }
        return view('admin.dashboard', compact(
            'revenues',
            'percentageChangeYear',
            'currentYearTotal',
            'currentMonthTotal',
            'percentageChangeMonth',
            'currentMonthRevenue',
            'lastMonthRevenue',
            'revenuesMonth',
            'topViewProducts',
            'categories',
            'brands',
            'totalBlogsCount',
            'totalProductsCount',
            'totalUsersCount',
            'topSellingProductDetails'
        ));
    }
}