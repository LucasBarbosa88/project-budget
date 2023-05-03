<?php

namespace App\Services\Models\Budgetß;

use App\Models\Budget;
use App\Services\BaseService;

class RegisterBudgetService extends BaseService
{
    protected $data = [];

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function run() {
        $budget = new Budget($this->data);
        if($budget->save()) {
            return $budget->refresh();
        }
        try {} catch (\Throwable $th) {
            report($th);
        }
        return false;
    }
}