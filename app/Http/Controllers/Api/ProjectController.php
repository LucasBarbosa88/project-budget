<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterProjectRequest;
use App\Mail\BudgetMail;
use App\Models\User;
use App\Services\Models\Budget\RegisterBudgetService;
use App\Services\Models\Project\RegisterProjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = RegisterProjectRequest::validate($request);
        $service = new RegisterProjectService($data);

        if( !$project = $service->run() ) return response( null, 503 );
        if($project) {
            $dataBudget['user_id'] = $project->user_id;
            $dataBudget['type'] = $project->type;
            $this->storeBudget($dataBudget);
        }
        return response()->json( $project , 201 );
    }

    public function storeBudget($data) {
        $service = new RegisterBudgetService($data);
        if( !$budget = $service->run() ) return response( null, 503 );
        if($budget) {
            $user = User::find($budget['user_id']);
            Mail::to($user->email)->send(new BudgetMail($budget->budget_amount));
        }

        return response()->json( $budget , 201 );
    }
}
