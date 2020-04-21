<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.patient.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.patient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $uid = generate_patient_uid();
        Patient::create([
            'uid' => $uid,
            'name' => $request['name'],
            'age' => $request['age'],
            'gender' => $request['gender'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'companion' => $request['companion'],
//            'referral_letter' => $request['referral_letter'],
            'patient_type' => $request['patient_type'],
            'file_no' => $request['file_no'],
            'user_id' => get_user()->id,
        ]);
        Payment::create([
            'patient_id' => Patient::where('uid', $uid)->get()[0]->id,
            'service_id' => $request['service'],
            'service_type' => $request['service_type'],
            'service_amount' => $request['service_amount'],
            'payment_type' => $request['payment_type'],
            'payment_status' => $request['payment_status'],
            'user_id' => get_user()->id,
            'receipt_no' => get_payment_receipt_no(),
        ]);
        $patient = Patient::all()->last();
        return view('admin.patient.show',compact('patient'));
    }

    public function get_stats_year(Request $request){
//        return $request;
        $year = $request['year'];
        return view('admin.dashboard', compact('year'));
    }
    public function get_stats_date(Request $request){
//        return $request['date'];
        $day = date("Y-m-d", strtotime($request['date']));
        $month = date("Y-m", strtotime($request['date']));
        $year = date("Y", strtotime($request['date']));
        $date = $request['date'];
//        return $day;
        return view('admin.dashboard', compact('year','month', 'day', 'date'));
    }

    public function add_service(Patient $patient){
//        return $patient;
        return view('admin.patient.service.add', compact('patient'));
    }

    public function store_service(Request $request, Patient $patient){
//        return get_payment_receipt_no();
        Payment::create([
            'patient_id' => $patient->id,
            'service_id' => $request['service'],
            'service_type' => $request['service_type'],
            'service_amount' => $request['service_amount'],
            'payment_type' => $request['payment_type'],
            'payment_status' => $request['payment_status'],
            'user_id' => get_user()->id,
            'receipt_no' => get_payment_receipt_no(),
        ]);
        return view('admin.patient.show', compact('patient'));
    }

    public function payment_invoice(Patient $patient, Payment $payment){
        return view('admin.patient.service.invoice', compact('patient', 'payment'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        return view('admin.patient.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        return view('admin.patient.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
//        return $request;
        Patient::where('id', $patient->id)
            ->update([
                'name' => $request['name'],
                'age' => $request['age'],
                'gender' => $request['gender'],
                'address' => $request['address'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'companion' => $request['companion'],
                'patient_type' => $request['patient_type'],
                'file_no' => $request['file_no'],
            ]);
        $patient = Patient::where('id', $patient->id)->get()[0];
        return view('admin.patient.show',compact('patient'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        if(Patient::destroy($patient->id)){
            Payment::where('patient_id', $patient->id)->delete();
            return view('admin.patient.list');
        }
        return response()->json([
            'status' => false,
            "error" => "Problem deleting service types"
        ]);
    }

    public function export($type = 'xlsx')
    {
        $patients = get_patients();
//        return $patients;
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'UID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Age');
        $sheet->setCellValue('D1', 'Gender');
        $sheet->setCellValue('E1', 'Address');
        $sheet->setCellValue('F1', 'Phone');
        $sheet->setCellValue('G1', 'Email');
        $sheet->setCellValue('H1', 'Companion');
        $sheet->setCellValue('I1', 'Patient Type');
        $sheet->setCellValue('J1', 'Amount');
        $sheet->setCellValue('K1', 'Type');
        $rows = 2;
        foreach ($patients as $patient) {
            $sheet->setCellValue('A' . $rows, $patient['uid']);
            $sheet->setCellValue('B' . $rows, $patient['name']);
            $sheet->setCellValue('C' . $rows, $patient['age']);
            $sheet->setCellValue('D' . $rows, $patient['gender']);
            $sheet->setCellValue('E' . $rows, $patient['address']);
            $sheet->setCellValue('F' . $rows, $patient['phone']);
            $sheet->setCellValue('G' . $rows, $patient['email']);
            $sheet->setCellValue('H' . $rows, $patient['companion']);
            $sheet->setCellValue('I' . $rows, $patient['patient_type']);
            foreach ($patient['payment'] as $payment){
                $sheet->setCellValue('J' . $rows, $payment['service_amount']);
                $sheet->setCellValue('K' . $rows, $payment['service_type']);
            }
            $rows++;
        }
        $fileName = "patients." . $type;
        if ($type == 'xlsx') {
            $writer = new Xlsx($spreadsheet);
        } else if ($type == 'xls') {
            $writer = new Xls($spreadsheet);
        }
        $writer->save("export/" . $fileName);
        header("Content-Type: application/vnd.ms-excel");
        return response()->download('export/' . $fileName);
//        return "/export/" . $fileName;
    }


    public function filter(Request $request){

//        return $request;
//        return $request;
        $service_id = $request->service_id;
        $service_type = $request->service_type;
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        if(is_null($date_from)){
            $date_from = "1990-01-01";
        }
        if(is_null($date_to)){
            $date_to = date("Y-m-d");
        }

        if($service_id != "all" && $service_type != "all" && !is_null($service_id) && !is_null($service_type)){
            $patient_ids = Payment::select('payments.patient_id')
                ->where("service_id", $service_id)
                ->where("service_type", $service_type)
                ->whereBetween('created_at', [$date_from, $date_to] )
                ->get();
//            return "When service and type are selected";
        }
        if($service_id == "all" && $service_type != "all" && !is_null($service_id) && !is_null($service_type)){
            $patient_ids = Payment::select('payments.patient_id')
//                ->where("service_id", $service_id)
                ->where("service_type", $service_type)
                ->whereBetween('created_at', [$date_from, $date_to] )
                ->get();
//            return "When service not specified";
        }
        if($service_id != "all" && $service_type == "all" && !is_null($service_id) && !is_null($service_type)){
            $patient_ids = Payment::select('payments.patient_id')
                ->where("service_id", $service_id)
//                ->where("service_type", $service_type)
                ->whereBetween('created_at', [$date_from, $date_to] )
                ->get();
//            return "When service type in not specified";
        }

        if($service_id == "all" && $service_type == "all"){
            $patient_ids = Payment::select('payments.patient_id')
//                ->where("service_id", $service_id)
//                ->where("service_type", $service_type)
                ->whereBetween('created_at', [$date_from, $date_to] )
                ->get();
//            return "When service and type are selected";
        }



        /*if(!is_null($date_from)){
            $patient_ids = Payment::select('payments.patient_id')->whereBetween("created_at", [$date_from, date('Y-m-d')])->get();
        }
        if(!is_null($service_id) && !is_null($service_type)){
            $patient_ids = Payment::select('payments.patient_id')
                ->where("service_id", $service_id)
                ->where("service_type", $service_type)
                ->get();
//            return "this worked";
        }
        if(!is_null($service_id) && $service_type == "all"){
            $patient_ids = Payment::select('payments.patient_id')->where("service_id", $service_id)->get();
        }
        if(!is_null($service_type) && $service_id == "all"){
            $patient_ids = Payment::select('payments.patient_id')->where("service_type", $service_type)->get();
        }

        if($service_id == "all" && $service_type == "all" && is_null($date_from) && is_null($date_to)){
            $patient_ids = Payment::select('payments.patient_id')
                ->get();
//            return "this worked";
        }
        if($service_id == "all" && $service_type == "all"){
            $patient_ids = Payment::select('payments.patient_id')
                ->get();
//            return "this worked";
        }
        if(!is_null($service_id) && $service_type == "all" && !is_null($date_from) && !is_null($date_to)){
            $patient_ids = Payment::select('payments.patient_id')
                ->where("service_id", $service_id)
                ->whereBetween('created_at', [$date_from, $date_to] )
                ->get();
//            return $patient_ids;
        }
        if($service_id == "all" && !is_null($service_type) && !is_null($date_from) && !is_null($date_to)){
            $patient_ids = Payment::select('payments.patient_id')
                ->where("service_type", $service_type)
                ->whereBetween('created_at', [$date_from, $date_to] )
                ->get();
//            return $patient_ids;
        }
        */


//        $patient_ids = Payment::select('payments.patient_id')->where("service_id", $service_id)->get();
        $arr_patient_id = array();
        foreach($patient_ids as $patient_id){
            $arr_patient_id[] = $patient_id->patient_id;
        }
        //selecting patients
        $patients = Patient::whereIn('id', $arr_patient_id)->get();
//        return $patients;
//        $patients = filter_patients();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'UID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Age');
        $sheet->setCellValue('D1', 'Gender');
        $sheet->setCellValue('E1', 'Address');
        $sheet->setCellValue('F1', 'Phone');
        $sheet->setCellValue('G1', 'Email');
        $sheet->setCellValue('H1', 'Companion');
        $sheet->setCellValue('I1', 'Patient Type');
        /*$sheet->setCellValue('J1', 'Amount');
        $sheet->setCellValue('K1', 'Type');*/
        $rows = 2;
        foreach ($patients as $patient) {
            $sheet->setCellValue('A' . $rows, $patient['uid']);
            $sheet->setCellValue('B' . $rows, $patient['name']);
            $sheet->setCellValue('C' . $rows, $patient['age']);
            $sheet->setCellValue('D' . $rows, $patient['gender']);
            $sheet->setCellValue('E' . $rows, $patient['address']);
            $sheet->setCellValue('F' . $rows, $patient['phone']);
            $sheet->setCellValue('G' . $rows, $patient['email']);
            $sheet->setCellValue('H' . $rows, $patient['companion']);
            $sheet->setCellValue('I' . $rows, $patient['patient_type']);
            /*foreach ($patient['payment'] as $payment){
                $sheet->setCellValue('J' . $rows, $payment['service_amount']);
                $sheet->setCellValue('K' . $rows, $payment['service_type']);
            }*/
            $rows++;
        }
        $fileName = "filter.xlsx";
        $writer = new Xlsx($spreadsheet);
        $writer->save("export/" . $fileName);
        header("Content-Type: application/vnd.ms-excel");
//        return response()->download('export/' . $fileName);
        return view('admin.patient.filter', compact('patients'));
    }

    public function filter_export(){
        return response()->download('export/filter.xlsx');
    }

}
