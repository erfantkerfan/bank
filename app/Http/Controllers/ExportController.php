<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use App\Exports\UserExport;
use App\User;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function full($id)
    {
        if (auth()->user()->is_super_admin==0 && auth()->id()!=$id){
            abort(403);
        };
        $user = User::query()->findOrFail($id);
        $file_name = $user->f_name.' '.$user->l_name;
        return Excel::download(new UserExport($id), "$file_name.xlsx");
    }

    public function transaction()
    {
        return Excel::download(new TransactionsExport(), 'document.pdf');
    }
}
