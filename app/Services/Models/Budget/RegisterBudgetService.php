<?php

namespace App\Services\Models\Budget;

use App\Models\Budget;
use App\Services\BaseService;

class RegisterBudgetService extends BaseService
{
  protected $data = [];

  public function __construct(array $data)
  {
    switch($data['type']) {
      case('web'):
        $data['budget_amount'] = 2000.00;
        break;
      case('mobile'):
        $data['budget_amount'] = 5000.00;
        break;
      case('desktop'):
        $data['budget_amount'] = 6000.00;
        break;
    }
    $this->data = $data;
  }

  public function run()
  {
    $budget = new Budget($this->data);
    if ($budget->save()) {
      return $budget->refresh();
    }
    try {
    } catch (\Throwable $th) {
      report($th);
    }
    return false;
  }
}
