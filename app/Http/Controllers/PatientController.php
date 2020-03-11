<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
