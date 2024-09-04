<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function index(){
        
        $success = false;
        $data = Expense::all();
        if(!empty($data)){
            $success = true;
        }
        return response()->json([
            'success' => $success,
            'data' => $data
        ]);;
    }
}
