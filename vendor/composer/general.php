<?php

use App\User;
use App\Configuration;
use App\Patient;
use App\Payment;
use App\PaymentStatus;
use App\PaymentType;
use App\Service;
use App\ServiceType;
use App\Report;
use App\Role;
use Illuminate\Support\Facades\Auth;


if (function_exists('get_patients') == false) {
    function get_patients($user_id = null, $date = null)
    {
        if ($date != null && $user_id != null) {
            return Patient::where('created_at', 'like', '%' . $date . '%')->where('user_id', $user_id);
        }
        if ($user_id != null) {
            return Patient::where('user_id', $user_id)->orderBy('id', 'DESC')->get();
        }
        if ($date != null) {
            return Patient::where('created_at', 'like', '%' . $date . '%');
        }
        return Patient::orderBy('id', 'DESC')->get();
    }
}

if (function_exists('get_patient_by_id') == false) {
    function get_patient_by_id($patient_id = null)
    {
        return Patient::where('id', $patient_id);
    }
}

if (function_exists('get_services') == false) {
    function get_services($service_id = null)
    {
        if ($service_id != null) {
            return Service::where('id', $service_id);
        }
        return Service::orderBy('name', 'ASC')->get();
    }
}

if (function_exists('get_service_type') == false) {
    function get_service_type($service_id)
    {
        return ServiceType::where('service_id', $service_id)->orderBy('name', 'ASC')->get();
    }
}

if (function_exists('get_service_amount') == false) {
    function get_service_amount($service_type_id)
    {
        return ServiceType::where('id', $service_type_id)->get();
    }
}

if (function_exists('get_payment_type') == false) {
    function get_payment_type()
    {
        return PaymentType::all();
    }
}

if (function_exists('get_payment_status') == false) {
    function get_payment_status()
    {
        return PaymentStatus::all();
    }
}

if (function_exists('get_user') == false) {
    function get_user($user_id = null)
    {
        if($user_id != null){
            return  User::select('users.*', 'roles.id as role_id', 'roles.name as role', 'roles.prefix as prefix')
                ->join('roles', 'users.id','roles.user_id')
                ->where('users.id', $user_id)
                ->get()[0];
        }
        return  User::select('users.*', 'roles.id as role_id', 'roles.name as role', 'roles.prefix as prefix')
            ->join('roles', 'users.id','roles.user_id')
            ->where('users.id', Auth::user()->id)
            ->get()[0];

    }
}

if(function_exists('get_users') == false){
    function get_users(){
        return  User::select('users.*', 'roles.id as role_id', 'roles.name as role', 'roles.prefix as prefix')
            ->join('roles', 'users.id','roles.user_id')
            ->orderBy('roles.name', 'ASC')
            ->get();
    }
}

if (function_exists('get_last_patient_uid') == false) {
    function get_last_patient_uid()
    {
        $patient_uid = Patient::all()->last();
        if ($patient_uid != null) {
            $patient_uid = $patient_uid->uid;
            return $patient_uid;
        }
        return "00/00/0000";
    }
}

//configurations
if (function_exists('get_patient_uid_pattern') == false) {
    function get_patient_uid_pattern()
    {
        $pattern = Configuration::where('name', 'patient_uid')->where('status', 2)->get();
        if (count($pattern) > 0) {
            return $pattern[0]->value;
        }
        return "";
    }
}
if (function_exists('get_configuration') == false) {
    function get_configuration($name = null)
    {
        if ($name != null) {
            return Configuration::where('name', $name)->get()[0];
        }
        return Configuration::all();
    }
}

if (function_exists('get_payment_receipt_no') == false) {
    function get_payment_receipt_no()
    {
        $payment_id = Payment::all()->last();
        if ($payment_id != null) {
            $payment_id = $payment_id->id + 1;
            return $payment_id;
        }
        return 1;
    }
}

if (function_exists('generate_patient_uid') == false) {
    function generate_patient_uid()
    {
        $patient_uid = get_last_patient_uid();
        $last_uid = explode("/", $patient_uid);
        //user id
        $user_id = get_user()->id;
        //check the year
        $currentyear = $last_uid['1'];
        if ($last_uid['2'] !== "") {
            $patient_id = $last_uid['2'];
        }
        $newyear = date("y");
        if ($newyear == $currentyear) {
            $year = $currentyear;
        } else {
            $year = $newyear;
            $patient_id = 0;
        }
        $patient_id = $patient_id + 1;
        $patient_id = str_pad($patient_id, 4, "0", STR_PAD_LEFT);
        // concatenate
        $patient_uid = get_patient_uid_pattern() . $user_id . '/' . $year . '/' . $patient_id;
        return $patient_uid;
    }
}

if (function_exists('get_payments') == false) {
    function get_payments($patient_id = null)
    {
        if ($patient_id != null) {
            return Payment::select('payments.*', 'services.name as service_name', 'service_types.name as service_type_name')
                ->join("services", "payments.service_id", "=", "services.id")
                ->join('service_types', 'payments.service_type', '=', 'service_types.id')
                ->where('patient_id', $patient_id)->orderBy('id', 'DESC')->get();
        }
        return Payment::select('payments.*', 'services.name as service_name', 'service_types.name as service_type_name')
            ->join("services", "payments.service_id", "=", "services.id")
            ->join('service_types', 'payments.service_type', '=', 'service_types.id')
            ->orderBy('id', 'DESC')->get();
//        return Payment::orderBy('id', 'DESC')->get();
    }
}

if (function_exists('get_payment') == false) {
    function get_payment($payment_id = null)
    {
        if ($payment_id != null) {
            return Payment::select('payments.*', 'services.name as service_name', 'service_types.name as service_type_name')
                ->join("services", "payments.service_id", "=", "services.id")
                ->join('service_types', 'payments.service_type', '=', 'service_types.id')
                ->where('payments.id', $payment_id)
                ->get()[0];
        }
        return Payment::select('payments.*', 'services.name as service_name', 'service_types.name as service_type_name')
            ->join("services", "payments.service_id", "=", "services.id")
            ->join('service_types', 'payments.service_type', '=', 'service_types.id')
            ->get()[0];
    }
}

if (function_exists('get_payment_by_user') == false) {
    function get_payment_by_user($user_id = null, $date = null)
    {
        if ($date != null && $user_id != null) {
            return Payment::where('user_id', $user_id)->where('created_at', 'like', '%' . $date . '%');
        }
        if ($user_id != null) {
            return Payment::where('user_id', $user_id);
        }
        if ($date != null) {
            return Payment::where('created_at', 'like', '%' . $date . '%');
        }

        return Payment::all();
    }
}

if (function_exists('get_receipt_no') == false) {
    function get_receipt_no($receipt_no)
    {
        return str_pad($receipt_no, 7, "0", STR_PAD_LEFT);
    }
}

//user patient stats
if (function_exists('get_patient_stats_label') == false) {
    function get_patient_stats_label($date = null, $year = null)
    {
        if ($date != null && $year != null) return date('Y-m', strtotime($year . '-' . $date));
        if ($date != null) return date('Y-m', strtotime($date));
        else return date('Y-m', strtotime('Today'));
    }
}
if (function_exists('get_patient_stats_data') == false) {
    function get_patient_stats_data($user_id = null, $date = null)
    {
        if($date != null && $user_id != null){
            return Patient::selectRaw('created_at')->where('created_at', 'like', '%' . get_patient_stats_label($date) . '%')->where('user_id', $user_id);
        }
        if($date != null){
            return Patient::selectRaw('created_at')->where('created_at', 'like', '%' . get_patient_stats_label($date) . '%');
        }
        if($user_id != null){
            return Patient::selectRaw('created_at')->where('user_id', $user_id);
        }
        return Patient::selectRaw('created_at');

    }
}
if (function_exists('get_revenue_stats_label') == false) {
    function get_revenue_stats_label($date = null, $year = null)
    {
        if ($date != null && $year != null) return date('Y-m', strtotime($year . '-' . $date));
        if ($date != null) return date('Y-m', strtotime($date));
        else return date('Y-m', strtotime('Today'));
    }
}
if (function_exists('get_revenue_stats_data') == false) {
    function get_revenue_stats_data($user_id = null,$date = null)
    {
        if($user_id != null && $date != null){
            return Payment::selectRaw('created_at')->where('created_at', 'like', '%' . get_patient_stats_label($date) . '%')->where('user_id', get_user()->id);
        }
        if($user_id != null){
            return Payment::selectRaw('created_at')->where('user_id', $user_id);
        }
        if($date != null){
            return Payment::selectRaw('created_at')->where('created_at', 'like', '%' . get_patient_stats_label($date) . '%');
        }
        return Payment::selectRaw('created_at');


    }
}
if (function_exists('get_patient_distinct_year') == false) {
    function get_patient_distinct_year()
    {
        $result = Patient::select(DB::raw('YEAR(created_at) as year'))->distinct()->orderBy('created_at', 'DESC')->get();
        return $result->pluck('year');
    }
}


if (function_exists('get_reports') == false) {
    function get_reports($user_id = null, $report_id = null)
    {
        if ($user_id != null) return Report::where('user_id', $user_id);
        elseif ($user_id != null && $report_if != null) return Report::where('user_id', $user_id)->where('id', $report_id);
        else return Report::orderBy("id", "DESC");
    }
}

if(function_exists('check_permission') == false){
    function check_permission(){

    }
}


if(function_exists('get_roles') == false){
    function get_roles(){
        return Role::orderBy('name', 'ASC')->get();
    }
}




