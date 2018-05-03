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
        $loan->proved_by = Auth::User()->f_name.' '.Auth::User()->l_name;
        $loan-> save();

        return redirect()->route('user_edit',['id'=>$loan->user->id]);
    }

    public function delete($id)
    {
        $loan = Loan::FindOrFail($id);
        $loan -> delete();
        return redirect()->back();
    }

    public function create(request $request)
    {
        $input = $request->all();
        if($input["loan"]!=null){$input["loan"] = str_replace(",","",$input["loan"]);}
        $request->replace((array)$input);

        $proved_by = null;
        if($request->is_proved==1){
            $proved_by = Auth::User()->f_name.' '.Auth::User()->l_name;
        };

        $user_id = basename(url()->previous());

        if (($user_id) == 'home') {
            $user_id = Auth::user()->id;
        }

        if (Auth::user()->is_super_admin == 0 && Auth::user()->id != $user_id) {
            abort(500);
        };

        if(($request->has('is_proved'))){
            $is_proved = $request->is_proved;
        }
        else{
            $is_proved=0;
        }

        $date_time = verta()->formatdate();

        $this->Validate($request, [
            'loan' => 'nullable|integer',
            'description' => 'nullable|string',
            'is_proved' => 'nullable|boolean',
            'force' => 'boolean',
        ]);

        Loan::create([
            'user_id' => $user_id,
            'date_time' => $date_time,
            'is_proved' => $is_proved,
            'proved_by' => $proved_by,
            'loan' => $request['loan'],
            'description' => $request['description'],
            'force' => $request['force'],
        ]);

        return back();

    }
}
