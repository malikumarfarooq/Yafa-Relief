<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProgramCategoryController extends Controller
{
    public function index()
    {
        return view('Admin.Programs.Categories.Index');
    }

    public function create()
    {
        return view('Admin.Programs.Categories.Create');
    }

    public function edit($id)
    {
        $category = \App\Models\ProgramCategory::findOrFail($id);
        return view('Admin.Programs.Categories.Edit', compact('category'));
    }
}
