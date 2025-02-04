<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplicationCalls;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = ApplicationCalls::all();
        return view('admin.application-calls.index', compact('applications'));

        if (!$applications->isActive()) {
            return redirect()->back()->with('error', 'El periodo de postulación ha terminado.');
        }
    }

    public function create()
    {
        return view('admin.application-calls.partials.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'title',
            'start_date',
            'end_date',
            'status'
        ]);

        ApplicationCalls::create($request->all());

        return redirect()->route('admin.application-calls.index')->with('success', 'Periodo de postulación creada con éxito.');
    }

    public function edit($id)
    {

        $applications = ApplicationCalls::findOrFail($id);

        return view('admin.application-calls.partials.edit', compact('applications'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);

        $request->validate([
            'application_title' => 'required|string|max:255',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status_call' => 'required|boolean'
        ]);


        $applications = ApplicationCalls::findOrFail($id);

        $applications->update($request->all());

        // dd($request);

        return redirect()->route('admin.application-calls.index')->with('success', 'Periodo de postulación actualizado con éxito.');
    }

    public function destroy($id)
    {

        $applications = ApplicationCalls::findOrFail($id);

        $applications->delete();

        return redirect()->route('admin.application-calls.index')->with('success', 'Periodo de postulación eliminado con éxito.');
    }
}
