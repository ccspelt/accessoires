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
        return view('user.index', [
            'product' => DB::table('product')->paginate(20)
        ]);
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