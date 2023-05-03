<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterProjectRequest;
use App\Services\Models\Budgetß\RegisterBudgetService;
use App\Services\Models\Project\RegisterProjectService;
use Illuminate\Http\Request;

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
            $this->storeBudget($project);
        }
        return response()->json( $project , 201 );
    }

    public function storeBudget($data) {
        $service = new RegisterBudgetService($data);
        if( !$budget = $service->run() ) return response( null, 503 );

        return response()->json( $budget , 201 );
    }
}
