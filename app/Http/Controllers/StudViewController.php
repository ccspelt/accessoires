<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
 
class UserController extends Controller
{
    /**
     * Show a list of all of the application's users.
     */
    public function index(): View
    {
        $products = DB::table('product')->get();
 
        return view('user.index', ['product' => $products]);
    }

    public function card($item)
{
    return [
        'name' => $item->name,
        'info' => $item->info,
        'price' => $item->price,

    ];
}
}