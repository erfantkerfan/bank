<?php

namespace App\Http\Controllers;

use App\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function confirm($id)
    {
        $loan = Loan::query()->findOrFail($id);
        $loan->is_proved = 1;
        $loan->proved_by = auth()->user()->l_name;
        $loan->save();

        return redirect()->route('user_edit', ['id' => $loan->user->id]);
    }

    public function delete($id)
    {
        $loan = Loan::query()->findOrFail($id);
        if (auth()->user()->is_super_admin == 1 || ($loan->user_id==auth()->id() && $loan->isproved==0)) {
            $loan->delete();
            return redirect()->back();
        } else {
            abort(403);
        }
    }

    public function forcedelete($id)
    {
        $loan = Loan::onlyTrashed()->FindOrFail($id);
        if (auth()->user()->is_super_admin != 1) {
            abort(403);
        }
        $loan->forceDelete();
        return redirect()->back();
    }

    public function create(request $request)
    {
        $input = $request->all();
        if ($input["loan"] != null) {
            $input["loan"] = str_replace(",", "", $input["loan"]);
        }
        $request->replace((array)$input);

        $proved_by = null;
        if ($request->is_proved == 1) {
            $proved_by = auth()->user()->l_name;
        };

        $user_id = basename(url()->previous());

        if (($user_id) == 'home') {
            $user_id = auth()->id();
        }

        if (auth()->user()->is_super_admin == 0 && auth()->id() != $user_id) {
            abort(500);
        };

        if (($request->has('is_proved'))) {
            $is_proved = $request->is_proved;
        } else {
            $is_proved = 0;
        }

        $creator = auth()->user()->f_name . ' ' . auth()->user()->l_name;

        $date_time = verta();

        $this->Validate($request, [
            'loan' => 'nullable|integer',
            'description' => 'nullable|string',
            'is_proved' => 'nullable|boolean',
            'force' => 'boolean',
            'request_date' => 'string',
        ]);

        Loan::create([
            'user_id' => $user_id,
            'date_time' => $date_time,
            'is_proved' => $is_proved,
            'proved_by' => $proved_by,
            'loan' => $request['loan'],
            'description' => $request['description'],
            'force' => $request['force'],
            'request_date' => $request['request_date'],
            'creator' => $creator,
        ]);

        return back();

    }

    public function show_edit($id)
    {
        $loan = Loan::query()->findOrFail($id);
        return view('loan_edit')->with(['loan' => $loan]);
    }

    public function edit(request $request, $id)
    {
        $loan = Loan::query()->findOrFail($id);

        if ($loan->is_proved == 1) {
            $loan->proved_by = auth()->user()->f_name . ' ' . auth()->user()->l_name;
        }

        $input = $request->all();
        if ($input["loan"] != null) {
            $input["loan"] = str_replace(",", "", $input["loan"]);
        }
        $request->replace((array)$input);

        $this->Validate($request, [
            'loan' => 'nullable|integer',
            'description' => 'nullable|string',
            'note' => 'nullable|string',
            'request_date' => 'nullable|string',
        ]);

        $loan->loan = $request->loan;
        $loan->description = $request->description;
        $loan->note = $request->note;
        $loan->force = $request->force;
        $loan->request_date = $request->request_date;

        $loan->save();

        return redirect(route('user', ['id' => $loan->user_id]));
    }
}