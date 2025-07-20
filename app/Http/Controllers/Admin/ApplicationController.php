<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplicationCall;

class ApplicationController extends Controller
{
    public function index(ApplicationCall $applicationCall)
    {
        $this->authorize('viewAny', $applicationCall);

        return view('admin.app-calls.index');
    }
}
