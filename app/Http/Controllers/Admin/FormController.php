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

class   FormController extends Controller
{

    public function dashboard()
    {
        return view('admin.index');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        // Consulta base para registros
        $query = UserData::query();

        // Si hay un término de búsqueda
        if (!empty($search)) {
            // Validar longitud mínima del término de búsqueda
            if (strlen($search) < 3) {
                return redirect()->back()->with('warning', 'Por favor, ingresa al menos 3 caracteres para realizar la búsqueda.');
            }

            // Filtrar registros por datos relacionados de `UserData`
            $query->where(function ($query) use ($search) {
                $query->where('cei', 'like', '%' . $search . '%')
                    ->orWhere('name', 'like', '%' . $search . '%')
                    ->orWhere('lastname', 'like', '%' . $search . '%')
                    ->orWhere('phone_number', 'like', '%' . $search . '%');
            });
        }

        // Cargar relaciones necesarias y paginar resultados
        $registros = $query->with(['applicationDetails.institutes', 'semesters', 'grades'])->paginate(5);

        // dd($registros);
        return view('admin.registers.index', compact('registros'));
    }

    public function create()
    {
        $entidades = Institute::all();
        $grades = Grade::all();
        $semesters = Semester::all();

        return view('welcome', compact('entidades', 'grades', 'semesters'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'cei' => 'required|numeric|digits_between:1,10',
            'name' => 'required',
            'lastname' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'address' => 'required',
            'neighborhood' => 'required',
            'id_semester' => 'required',
            'id_grade' => 'required',
            'daytrip' => 'required',
            'id_institute' => 'required',
        ]);

        // dd($request);
        $existente = UserData::where('cei', $request->cei)
            ->orWhere('email', $request->email)
            ->first();


        // dd($existente);
        if ($existente) {
            return redirect()->back()->with('error', 'Este usuario ya está registrado.');
        }

        // Validación de limite de usuarios
        $institucion = Institute::findOrFail($request->id_institute);

        $currentUserCount = ApplicationDetails::where('id_institutes', $institucion->id)->count();

        if ($currentUserCount >= $institucion->user_limit) {
            return redirect()->back()->with('error', 'Límite de estudiantes alcanzado.');
        }

        // Crear y almacenar el formulario
        $userData = UserData::create($request->all());

        ApplicationDetails::create([
            'id_application_calls' => null, // Define si hay una convocatoria activa
            'id_user_data' => $userData->id,
            'id_institutes' => $institucion->id,
            'status_individual' => 'Pendiente', // O el estado inicial que prefieras
        ]);

        return redirect('/')->with('success', 'Formulario enviado con éxito.');
    }

    public function destroy($id)
    {

        $registro = UserData::findOrFail($id);
        $registro->delete();

        return redirect()->route('admin.dashboard.registers.index')->with('success', 'Registro eliminado con éxito.');
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
