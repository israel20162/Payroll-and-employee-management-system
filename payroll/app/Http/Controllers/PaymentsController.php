<?php

namespace App\Http\Controllers;

use App\Exports\EmployeesExport;
use App\Exports\PaymentsExport;
use App\Models\Employee;
use App\Models\PaymentsHistory;
use Dompdf\Adapter\PDFLib;
use Excel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;
use PDF;

class PaymentsController extends Controller
{

    public function viewEmployeePayments(Request $request)
    {
        $selectedMonth = $request->input('month', date('m')); // Default to the current month
        $selectedYear = $request->input('year',date('Y'));
        $month = date('F', mktime(0, 0, 0, $selectedMonth));

        // $employees = Employee::get();
        $payments = PaymentsHistory::with('employee')->where('year',$selectedYear)->where('month', strtolower($month))->get();


        return view('employees.payment.payments', ['payments' => $payments, 'month' => $month,'selectedYear' =>$selectedYear]);
    }

    public function createEmployeePayments(Request $request)
    {
        $selectedMonth = $request->input('month', date('m')); // Default to the current month
        $month = date('F', mktime(0, 0, 0, $selectedMonth));

        $employees = Employee::whereDoesntHave('payments', function ($query) {
            $query->where('month', date('F', mktime(0, 0, 0, date('m'))));
        })->get();



        return view('employees.payment.create.index', ['employees' => $employees, 'month' => $month,]);
    }
    public function viewEmployeePayment(Request $request, string $id)
    {
        $selectedMonth = $request->input('month', date('m')); // Default to the current month
        $month = date('F', mktime(0, 0, 0, $selectedMonth));

        $employees = Employee::get();
        $payment = PaymentsHistory::where('id', $id)->with('employee')->where('month', strtolower($month))->first();


        return view('employees.payment.payment', ['payment' => $payment, 'month' => $month,]);
    }
    public function createEmployeePayment(Request $request, $employee)
    {
        $employee = Employee::find($request->query('id'));
        return view('employees.payment.create.create_form', ['employee' => $employee]);
    }

    public function storeEmployeePayment(Request $request, $employee)
    {


        $employee_salary = Employee::find($employee)->current_salary;

        PaymentsHistory::create([
            'payment_date' => date('Y-m-d'),
            'status' => 'UNPAID',
            'amount' => $employee_salary,
            'tax' => $request->input('tax'),
            'deductions' => number_format(($request->input('tax') / 100) * $employee_salary),
            'bonus' => $request->input('bonus'),
            'employee_id' => $employee,
            'start_date' => date('Y-m-01'),
            'end_date' => date('Y-m-t'),
            'month' => date('F', mktime(0, 0, 0, date('m'))),
            'year' => date('Y'),
            'net_pay' => $employee_salary + $request->input('bonus') - (($request->input('tax') / 100) * $employee_salary)
        ]);


        return redirect()->route('employees.payments');

    }
    public function storeAllEmployeePayments(Request $request, $employee)
    {


        $employee_salary = Employee::find($employee)->current_salary;

        PaymentsHistory::create([
            'payment_date' => date('Y-m-d'),
            'status' => 'UNPAID',
            'amount' => $employee_salary,
            'tax' => $request->input('tax'),
            'deductions' => number_format(($request->input('tax') / 100) * $employee_salary),
            'bonus' => $request->input('bonus'),
            'employee_id' => $employee,
            'start_date' => date('Y-m-01'),
            'end_date' => date('Y-m-t'),
            'month' => date('F', mktime(0, 0, 0, date('m'))),
            'year' => date('Y'),
            'net_pay' => $employee_salary + $request->input('bonus') - (($request->input('tax') / 100) * $employee_salary)
        ]);


        return redirect()->route('employees.payments');

    }
    public function payHistory(Request $request)
    {
        $employee = Employee::where('employee_id', $request->query(('id')))->get()->toArray();

        $payments = PaymentsHistory::with('employee')->where('employee_id', $employee['0']['id'])->get();

        return view('employee.payments.history', ['payHistory' => $payments]);
    }
    public function setPaymentStatus(Request $request, $id, $action)
    {
        $payment = PaymentsHistory::where('id', $id)->update(['status' => strtoupper($action)]);

        return redirect()->back();
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function payslip(Request $request, $id)
    {
        $payment = PaymentsHistory::where('id', $id)->with(['employee'])->first();
        return view('employee.payments.payslip', ['payment' => $payment]);
    }
    /**
     * Generate a PDF.
     *
     * @param \Barryvdh\DomPDF\Facade\Pdf $pdf
     *
     */
    public function generatePdf(Request $request, $id)
    {
        // retreive all records from db
        $data = PaymentsHistory::where('id', $id)->with(['employee'])->first()->toArray();
        // share data to view
        view()->share('employee.payments.history', $data);


        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('employee.payments.payslip_pdf', ['payment' => $data]); // @phpcs:ignore
        return $pdf->download($data['employee']['employee_id'] . $data['month'] . $data['year'] . '.pdf');

        // @phpstan-ignore-next-line // @phpcs:ignore

        // download PDF file with download method

    }
    public function exportPaymentsToExcel(string $month, int $year)
    {
        return FacadesExcel::download(new PaymentsExport($month, $year), 'payments_' . $month . '_' . date('Y') . '.xlsx');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
