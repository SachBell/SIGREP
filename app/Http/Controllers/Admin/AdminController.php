<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplicationDetail;
use App\Models\ReceivingEntity;
use App\Models\TeacherProfile;
use App\Models\TutorStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $convenant = ReceivingEntity::byEntityCareer($user)->count();
        $posts = ApplicationDetail::all()->count();

        $tutor = TeacherProfile::where('users_id', $user->id)->first();

        $count = $tutor ? TutorStudent::where('teacher_profile_id', $tutor->id)->count() : 0;

        return view('admin.dashboard', compact('user', 'convenant', 'posts', 'count'));
    }
}
