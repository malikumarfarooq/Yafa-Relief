<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProgramAttributeController extends Controller
{
    public function index()
    {
        return view('Admin.Programs.Attributes.Index');
    }

    public function create()
    {
        return view('Admin.Programs.Attributes.Create');
    }

    public function edit($id)
    {
        $attribute = \App\Models\ProgramAttribute::findOrFail($id);
        return view('Admin.Programs.Attributes.Edit', compact('attribute'));
    }
}
