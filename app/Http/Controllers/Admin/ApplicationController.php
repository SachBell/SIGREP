<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplicationCall;

class ApplicationController extends Controller
{
    public function index(ApplicationCall $applicationCall)
    {
        $this->authorize('viewAny', $applicationCall);

        $calls = $applicationCall->byUserCareer(auth()->user())->get();

        return view('admin.app-calls.index', compact('calls'));
    }

    public function destroy($id)
    {
        $call = ApplicationCall::findOrFail($id);

        $this->authorize('delete', $call);

        $call->delete();

        return redirect()->back()->with('success', 'Convocatoria eliminada con éxito.');
    }
}
