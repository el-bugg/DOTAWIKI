<?php
namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::whereNotNull('img_url')
                     ->where('cost', '>', 0)
                     ->orderBy('cost') 
                     ->get();
                     
        return view('items.index', compact('items'));
    }
}