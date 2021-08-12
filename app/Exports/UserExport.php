<?php

namespace App\Exports;

use App\Http\Controllers\Controller;
use App\User;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UserExport implements FromView, WithEvents, ShouldAutoSize, WithStyles
{
    private int $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $id = $this->id;
        $user = User::query()->findOrFail($id);
        $date = Verta::now();
        $payments = $user->Payment()->OrderByDesc('date_time')->get();
        $tote = $user->Payment()->sum('payment');
        $sum = 0;
        foreach ($payments as $payment) {
            $payment->sum = $payment->payment_cost + $payment->loan_payment_force + $payment->loan_payment + $payment->payment;
            $payment->momentary = ($payment->is_proved ? $tote - $sum : $tote);
            $sum = ($payment->is_proved ? $payment->payment : 0) + $sum;
        }
//        Controller::NumberFormat($payments);
        $loans = User::query()->findOrFail($id)->Loan()->OrderByDesc('date_time')->get();
//        Controller::NumberFormat($loans);
        $requests = User::query()->findOrFail($id)->request()->OrderByDesc('date_time')->get();
//        Controller::NumberFormat($requests);
        $summary = $user->summary();
        return view('export.full', compact('payments', 'loans', 'requests', 'user', 'date', 'summary'));
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