<?php

namespace tkouleris\CrudPanel\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CrudPanelController extends Controller
{
    public function index()
    {
        return view('CrudPanel::crud_panel_index');
    }

    public function create_model(Request $request)
    {
        return $request->all();
    }
}
