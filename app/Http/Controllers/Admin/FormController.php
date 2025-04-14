<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserData;
use App\Models\Institute;
use App\Models\Grade;
use App\Models\Semester;
use App\Exports\FormularioExport;
use App\Models\ApplicationDetails;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class FormController extends Controller
{
    public function index(Request $request)
    {
        // Consulta base para registros
        $registros = ApplicationDetails::with(['userData', 'institutes', 'applicationCalls']) // Trae relaciones
            ->join('user_data', 'application_details.id_user_data', '=', 'user_data.id') // Relaciona con UserData
            ->orderBy('user_data.name', 'asc') // Ordena por el nombre del usuario
            ->select('application_details.*') // Evita conflictos de columnas
            ->paginate(8);

        // dd($registros);
        return view('admin.registers.index', compact('registros'));
    }

    public function create()
    {
        $users = User::all();
        $institutes = Institute::all();
        $grades = Grade::all();
        $semesters = Semester::all();

        return view('admin.registers.partials.create', compact('institutes', 'grades', 'semesters', 'users'));
    }

    public function store(Request $request)
    {

        // dd($request->all());

        $request->validate([
            'id_user' => 'required|exists:users,id',
            'cei' => 'required|numeric|digits_between:1,10',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone_number' => 'required|numeric|digits_between:1,10',
            'address' => 'required|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'id_semester' => 'required|exists:semesters,id',
            'id_grade' => 'required|exists:grades,id',
            'daytrip' => 'required|string',
            'id_institute' => 'required|exists:institutes,id',
        ]);

        // dd($request);
        $regExist = UserData::where('cei', $request->cei)->first();

        // dd($existente);
        if ($regExist) {
            return redirect()->back()->with('error', 'Este usuario ya está registrado.');
        }

        // Validación de limite de usuarios
        $institutes = Institute::findOrFail($request->id_institute);

        $currentUserCount = ApplicationDetails::where('id_institutes', $institutes->id)->count();

        if ($currentUserCount >= $institutes->user_limit) {
            return redirect()->back()->with('error', 'Límite de estudiantes alcanzado.');
        }



        // Crear y almacenar el formulario
        $userData = UserData::create($request->all());

        ApplicationDetails::create([
            'id_application_calls' => null, // Define si hay una convocatoria activa
            'id_user_data' => $userData->id,
            'id_institutes' => $institutes->id,
            'status_individual' => 'Pendiente', // O el estado inicial que prefieras
        ]);

        return redirect()->route('admin.dashboard.registers.index')->with('success', 'Registro creado con éxito');
    }

    public function destroy($id)
    {

        $registro = UserData::findOrFail($id);
        $registro->delete();

        return redirect()->route('admin.dashboard.registers.index')->with('success', 'Registro eliminado con éxito.');
    }

    public function search(Request $request)
    {
        $search = $request->input('query');

        $registros = UserData::search($search)->paginate(5);

        return view('admin.registers.index', compact('registros'));
    }

    public function edit($id)
    {
        $registro = UserData::findOrFail($id);
        $applicationDetail = $registro->applicationDetails()->first();
        // dd($applicationDetail);
        $id_institute = $applicationDetail ? $applicationDetail->id_institutes : null;
        $entidades = Institute::all();
        $semesters = Semester::all();
        $grades = Grade::all();
        return view('admin.registers.partials.edit', compact('registro', 'entidades', 'grades', 'semesters', 'id_institute'));
    }

    public function update(Request $request, $id)
    {

        // dd($request->all());
        // dd($request);

        $registro = UserData::findOrFail($id);

        $request->validate([
            'cei' => 'required|numeric|digits_between:1,10',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'phone_number' => 'required|digits:10',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'id_semester' => 'required|exists:semesters,id',
            'id_grade' => 'required|exists:grades,id',
            'daytrip' => 'required|string|max:255',
            'id_institute' => 'required|exists:institutes,id',
        ]);

        // dd($request);

        $user = User::findOrFail($registro->id_user);

        // Verificar si hay otro usuario con el mismo CEI y correo electrónico (excluyendo este usuario)
        $existsCei = UserData::where('cei', $request->cei)
            ->where('id', '!=', $id)
            ->first();

        $existsEmail = User::where('email', $request->email)
            ->where('id', '!=', $registro->user->id)
            ->first();

        if ($existsCei || $existsEmail) {
            return redirect()->back()->with('error', 'Este usuario ya está registrado.');
        }

        // Buscar la postulación del usuario
        $applicationDetail = ApplicationDetails::where('id_user_data', $registro->id)->first();

        if (!$applicationDetail) {
            return redirect()->back()->with('error', 'No se encontró la postulación del usuario.');
        }

        // Validación de limite de usuarios
        $institucion = Institute::findOrFail($request->id_institute);

        $currentUserCount = ApplicationDetails::where('id_institutes', $institucion->id)->count();

        if ($currentUserCount >= $institucion->user_limit) {
            return redirect()->back()->with('error', 'Límite de estudiantes alcanzado.');
        }

        $user->update(['email' => $request->email]);

        $applicationDetail->update([
            'id_institutes' => $institucion->id, // Actualizamos el instituto
        ]);

        $registro->update($request->all());

        return redirect()->route('admin.dashboard.registers.index')->with('success', 'Registro Actualizado con Exito');
    }

    public function export()
    {
        return Excel::download(new FormularioExport, 'registros.xlsx');
    }
}
