<?php

namespace App\Exports;

use App\User;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionsExport implements FromView, WithEvents, ShouldAutoSize, WithStyles
{
    public function view(): View
    {
        $users = User::orderBy('acc_id')->get();
        foreach ($users as $user){
            $user->summary = $user->summary();
            $user->summary->delays = $user->delays();
            $user->summary->debt_all = $user->summary->debt + $user->summary->debt_force;
        }
        if (request()->has('sort')){
            $users = $users->sortByDesc('summary.'.request()->input('sort'));
        }
        $date = Verta::now();
        return view('export.admin_transaction', compact('users', 'date'));
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
            },
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            'A1:Z900' => [
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center',
                ]
            ],

        ];
    }
}