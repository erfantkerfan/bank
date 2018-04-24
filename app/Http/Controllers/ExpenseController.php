<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        return 'index';
    }

    public function create()
    {
        return 'create';
    }

    public function delete()
    {
        return 'delete';
    }

    public function expense()
    {
        return 'expense';
    }
}
