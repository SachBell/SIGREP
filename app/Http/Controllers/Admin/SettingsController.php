<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\SettingsHelper;
use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('Admin.settings.index');
    }

    public function emailsUpdate(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|exists:email_templates,key',
            'subject' => 'required|string',
            'body' => 'required|string',
        ]);

        $template = EmailTemplate::where('key', $validated['key'])->first();
        $template->subject = $validated['subject'];
        $template->body = $validated['body'];
        $template->save();

        return back()->with('success_' . $validated['key'], 'Plantilla actualizada correctamente.');
    }

    public function generalUpdate(Request $request)
    {
        $data = $request->validate([
            'settings' => 'required|array',
        ]);

        foreach ($data['settings'] as $key => $value) {
            SettingsHelper::set($key, is_bool($value) ? (int) $value : $value);
        }

        return back()->with('success', 'Configuraciones guardadas correctamente.');
    }
}
