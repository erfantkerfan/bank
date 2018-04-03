<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Loan;

class LoanController extends Controller
{
    public function confirm($id)
    {
        $loan = Loan::FindOrFail($id);
        $loan->is_proved = 1;
        $loan->proved_by = Auth::User()->name;
        $loan-> save();

        return redirect()->back();
    }

    public function delete($id)
    {
        Loan::destroy($id);
        return redirect()->back();
    }

    public function create(request $request)
    {
        $proved_by = null;
        if ($request->is_proved == 1) {
            $proved_by = Auth::user()->name;
        };

        $user_id = basename(url()->previous());

        if (($user_id) == 'home') {
            $user_id = Auth::user()->id;
        }

        if (Auth::user()->is_super_admin == 0 && Auth::user()->id != $user_id) {
            abort(500);
        };

        $this->Validate($request, [
            'loan' => 'nullable|integer',
            'description' => 'nullable|string',
            'date_time' => 'required',
            'is_proved' => 'boolean',
            'force' => 'boolean',
        ]);

        Loan::create([
            'user_id' => $user_id,
            'loan' => $request['loan'],
            'description' => $request['description'],
            'date_time' => $request['date_time'],
            'is_proved' => $request['is_proved'],
            'proved_by' => $proved_by,
            'force' => $request['force'],
        ]);

        return back();

    }
}
