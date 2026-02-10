<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;

class ProgramController extends Controller
{
    public function index()
    {
        return view('Admin.Programs.Index');
    }
    public function create()
    {
        return view('Admin.Programs.Create');
    }
    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }
}
