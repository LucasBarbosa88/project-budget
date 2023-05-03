<?php

namespace App\Services\Models\Project;

use App\Models\Address;
use App\Models\Project;
use App\Services\BaseService;
use Illuminate\Support\Facades\Hash;

class RegisterProjectService extends BaseService
{
    protected $data = [];

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function run() {
        $project = new Project($this->data);
        if($project->save()) {
            return $project->refresh();
        }
        try {} catch (\Throwable $th) {
            report($th);
        }
        return false;
    }
}