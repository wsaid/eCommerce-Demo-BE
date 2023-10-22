<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemCollection;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return new ItemCollection(Item::paginate(12));
    }
}
