<?php

namespace App\Http\ViewComposers;

use App\Models\Position;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\StudyProgram;
use Illuminate\Support\Facades\Log;

class LecturerComposer
{
    public function compose(View $view)
    {
        $user = Auth::user();
        $nidn = $user->lecturer->nidn ?? null;
        $position = $user->lecturer->position->name ?? null;
        
        $view->with(compact('nidn','user', 'position'));
    }
}
