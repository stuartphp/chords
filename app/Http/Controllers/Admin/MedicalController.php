<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedicalController extends Controller
{
    public function doctors()
    {
        return view('medical.doctors');
    }
}
