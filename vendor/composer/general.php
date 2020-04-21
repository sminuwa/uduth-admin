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

/*
 * We have what is called logical operators
 * 1. And
 * 2. Or
 * 3. Not
 * And is represented as &&
 * Or is represented as ||
 * Not is represented as !
 * */

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
        return Service::orderBy('id', 'DESC')->get();
    }
}

if (function_exists('get_service_type') == false) {
    function get_service_type($service_id)
    {
        return ServiceType::where('service_id', $service_id)->orderBy('id', 'DESC')->get();
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
            return  User::select('users.*', 'roles.name as role', 'roles.prefix as prefix')
                ->join('roles', 'users.role_id','roles.id')
                ->where('users.id', '=', $user_id)
                ->get()[0];
        }
        return  User::select('users.*', 'roles.name as role', 'roles.prefix as prefix')
            ->join('roles', 'users.role_id','roles.id')
            ->where('users.id', Auth::user()->id)
            ->get()[0];

    }
}

if(function_exists('get_users') == false){
    function get_users(){
        return  User::select('users.*', 'roles.name as role', 'roles.prefix as prefix')
            ->join('roles', 'users.role_id','roles.id');
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
        $config = Configuration::groupBy('identifier')->orderBy('identifier', 'DESC')->get();
        return $config;
//        return Configuration::all();
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
            return Payment::select('payments.*', 'services.name as service_name')
                ->join("services", "payments.service_id", "=", "services.id")
//                ->join('service_types', 'payments.service_type', '=', 'service_types.id')
                ->where('patient_id', $patient_id)->orderBy('id', 'DESC')->get();
        }
        return Payment::select('payments.*', 'services.name as service_name')
            ->join("services", "payments.service_id", "=", "services.id")
//            ->join('service_types', 'payments.service_type', '=', 'service_types.id')
            ->orderBy('id', 'DESC')->get();
//        return Payment::orderBy('id', 'DESC')->get();
    }
}

if (function_exists('get_payment') == false) {
    function get_payment($payment_id = null)
    {
        if ($payment_id != null) {
            return Payment::select('payments.*', 'services.name as service_name')
                ->join("services", "payments.service_id", "=", "services.id")
//                ->join('service_types', 'payments.service_type', '=', 'service_types.id')
                ->where('payments.id', $payment_id)
                ->get()[0];
        }
        return Payment::select('payments.*', 'services.name as service_name')
            ->join("services", "payments.service_id", "=", "services.id")
//            ->join('service_types', 'payments.service_type', '=', 'service_types.id')
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

if (function_exists('get_payment_distinct_year') == false) {
    function get_payment_distinct_year()
    {
        $result = Payment::select(DB::raw('YEAR(created_at) as year'))->distinct()->orderBy('created_at', 'DESC')->get();
        return $result->pluck('year');
    }
}

if (function_exists('get_reports') == false) {
    function get_reports($user_id = null, $report_id = null)
    {
        if ($user_id != null) {
            return Report::where('user_id', $user_id)->orderBy("id", "DESC")->get();
        }
        if ($user_id != null && $report_id != null) {
            return Report::where('user_id', $user_id)->where('id', $report_id)->orderBy("id", "DESC")->get();
        }
        return Report::orderBy("id", "DESC")->get();
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

if(!function_exists('SQLStatement')) {
    function SQLStatement($table, $data)
    {
        $table = '`' . $table . '`';
        // variable declaration
        $columns = "";
        $values = "";

        // loop
        foreach ($data as $column => $value) {
            $columns = $columns . ", `" . $column . "`";
            $values = $values . ",'" . $value . "' ";
        }

        // trimming the first comma from the result above
        $columns = ltrim($columns, ',');
        $values = ltrim($values, ',');

        // statement
        $sql = "INSERT INTO ${table} ( ${columns} ) VALUES ( ${values} )";

        return $sql;
    }
}
if(!function_exists('getTotalMonthlyRevenue')){
    function getTotalMonthlyRevenue($month)
    {
        //fetch revenue according to month
        return Payment::where('created_at', 'like', '%' . $month . '%')->sum('service_amount');
    }
}

if(!function_exists('calculateRevenue')){
    function calculateRevenue($month)
    {
//        return getTotalMonthlyRevenue($month);
        //fetching all the active configuration record in the database
//        $fixedConfiguration = $db->getAll("select * from udut_configurations where configStatus = 1 and configType = 'Fixed' ");
        $fixedConfiguration = Configuration::where(['status'=> 1, 'type'=>'Fixed'])->get();
//        return $fixedConfiguration;
//        $percent1Configuration = $db->getAll("select * from udut_configurations where configStatus = 1 and configType = '1 %' ");
        $percent1Configuration = Configuration::where(['status'=> 1, 'type'=>'#1'])->get();

        $percent0Configuration = Configuration::where(['status'=> 1, 'type'=>'#0'])->get();
//        return $percent1Configuration;
//        $percent2Configuration = $db->getAll("select * from udut_configurations where configStatus = 1 and configType = '2 %' ");
        $percent2Configuration = Configuration::where(['status'=> 1, 'type'=>'#2'])->get();
//        return $percent2Configuration;
//        $percent3Configuration = $db->getAll("select * from udut_configurations where configStatus = 1 and configType = '3 %' ");
        $percent3Configuration = Configuration::where(['status'=> 1, 'type'=>'#3'])->get();
//        $percent4Configuration = $db->getAll("select * from udut_configurations where configStatus = 1 and configType = '4 %' ");
        $percent4Configuration = Configuration::where(['status'=> 1, 'type'=>'#4'])->get();
//        $percent5Configuration = $db->getAll("select * from udut_configurations where configStatus = 1 and configType = '5 %' ");
        $percent5Configuration = Configuration::where(['status'=> 1, 'type'=>'#5'])->get();
//        $fixedPercentConfiguration = $db->getAll("select * from udut_configurations where configStatus = 1 and configType = 'Fixed%' ");
        $fixedPercentConfiguration = Configuration::where(['status'=> 1, 'type'=>'Fixed%'])->get();
//        return $fixedPercentConfiguration;

        //getting the full month
        $m_y = explode("-", $month);
        $monthNum = $m_y[1];
        $dateObj = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('F'); // March

        //deduct all fixed amounts
        $totalMonthlyRevenue = getTotalMonthlyRevenue($month);
        $fixedRows = "";
        $percent0Rows = "";
        $percent1Rows = "";
        $percent2Rows = "";
        $percent3Rows = "";
        $percent4Rows = "";
        $percent5Rows = "";
        $fixedPercentRows = "";
        $totalPercent0 = 0;
        $totalPercent1 = 0;
        $totalPercent2 = 0;
        $totalPercent3 = 0;
        $totalPercent4 = 0;
        $totalPercent5 = 0;
        foreach ($percent0Configuration as $percent0Config) {
            $amount = ($percent0Config['value'] * $totalMonthlyRevenue) / 100;
            $percent0Rows =
                $percent0Rows . "<tr>
              <td>" . ucwords($percent0Config['name']) . "</td>
              <td class='color-yellow'>" . $percent0Config['type'] . "</td>
              <td>&#x20A6; " . number_format($amount) . " (" . $percent0Config['value'] . "% of &#x20A6;" . number_format($totalMonthlyRevenue) . ")</td>
              <td>" . $monthName . ", " . $m_y[0] . "</td>
            </tr>";
            $totalMonthlyRevenue = ($totalMonthlyRevenue - $amount);
            $totalPercent0 = $totalPercent0 + $percent0Config['value'];
        }
        foreach ($fixedConfiguration as $fixedConfig) {

            $fixedRows =
                $fixedRows . "<tr>
              <td>" . ucwords($fixedConfig['name']) . "</td>
              <td class='color-yellow'>" . $fixedConfig['type'] . "</td>
              <td>&#x20A6; " . number_format($fixedConfig['value']) . " (Fixed of &#x20A6;" . $totalMonthlyRevenue . "))</td>
              <td>" . $monthName . ", " . $m_y[0] . "</td>
            </tr>";
            $totalMonthlyRevenue = ($totalMonthlyRevenue - $fixedConfig['value']);
//        print($config['configName'] . " = " . $config['configValue'] . "<br>");
        }
        foreach ($fixedPercentConfiguration as $fixedPercentConfig) {
            $amount = ($fixedPercentConfig['value'] * $totalMonthlyRevenue) / 100;
            $fixedPercentRows =
                $fixedPercentRows . "<tr>
              <td>" . ucwords($fixedPercentConfig['name']) . "</td>
              <td class='color-yellow'>" . $fixedPercentConfig['type'] . "</td>
              <td>&#x20A6; " . number_format($amount) . " (Fixed & % of &#x20A6;" . $totalMonthlyRevenue . "))</td>
              <td>" . $monthName . ", " . $m_y[0] . "</td>
            </tr>";
//        print($config['configName'] . " = " . $config['configValue'] . "<br>");
            $totalMonthlyRevenue = ($totalMonthlyRevenue - $amount);
        }
        $totalMonthlyRevenueAfterFixedValues1 = $totalMonthlyRevenue;
        foreach ($percent1Configuration as $percent1Config) {
            $amount = ($percent1Config['value'] * $totalMonthlyRevenueAfterFixedValues1) / 100;
            $percent1Rows =
                $percent1Rows . "<tr>
              <td>" . ucwords($percent1Config['name']) . "</td>
              <td class='color-yellow'>" . $percent1Config['type'] . "</td>
              <td>&#x20A6; " . number_format($amount) . " (" . $percent1Config['value'] . "% of &#x20A6;" . number_format($totalMonthlyRevenueAfterFixedValues1) . ")</td>
              <td>" . $monthName . ", " . $m_y[0] . "</td>
            </tr>";
            $totalMonthlyRevenue = ($totalMonthlyRevenue - $amount);
            $totalPercent1 = $totalPercent1 + $percent1Config['value'];
        }
        //    $totalPercent1 = 100 - $totalPercent1;
        $totalMonthlyRevenueAfterFixedValues2 = $totalMonthlyRevenue;
        foreach ($percent2Configuration as $percent2Config) {
            $amount = ($percent2Config['value'] * $totalMonthlyRevenueAfterFixedValues2) / 100;
            $percent2Rows =
                $percent2Rows . "<tr>
              <td>" . ucwords($percent2Config['name']) . "</td>
              <td class='color-yellow'>" . $percent2Config['type'] . "</td>
              <td>&#x20A6; " . number_format($amount) . " (" . $percent2Config['value'] . "% of " . $totalPercent1 . "% of &#x20A6;" . number_format($totalMonthlyRevenueAfterFixedValues1) . ")</td>
              <td>" . $monthName . ", " . $m_y[0] . "</td>
            </tr>";
            $totalMonthlyRevenue = ($totalMonthlyRevenue - $amount);
            $totalPercent2 = $totalPercent2 + $percent2Config['value'];
        }

        $totalMonthlyRevenueAfterFixedValues3 = $totalMonthlyRevenue;
        foreach ($percent3Configuration as $percent3Config) {
            $amount = ($percent3Config['value'] * $totalMonthlyRevenueAfterFixedValues3) / 100;
            $percent3Rows =
                $percent3Rows . "<tr>
              <td>" . ucwords($percent3Config['name']) . "</td>
              <td class='color-yellow'>" . $percent3Config['type'] . "</td>
              <td>&#x20A6; " . number_format($amount) . " (" . $percent3Config['value'] . "% of " . $totalPercent3 . "% of &#x20A6;" . number_format($totalMonthlyRevenueAfterFixedValues3) . ")</td>
              <td>" . $monthName . ", " . $m_y[0] . "</td>
            </tr>";
            $totalMonthlyRevenue = ($totalMonthlyRevenue - $amount);
            $totalPercent3 = $totalPercent3 + $percent3Config['value'];
        }

        $totalMonthlyRevenueAfterFixedValues4 = $totalMonthlyRevenue;
        foreach ($percent4Configuration as $percent4Config) {
            $amount = ($percent4Config['value'] * $totalMonthlyRevenueAfterFixedValues4) / 100;
            $percent4Rows =
                $percent4Rows . "<tr>
              <td>" . ucwords($percent4Config['name']) . "</td>
              <td class='color-yellow'>" . $percent4Config['type'] . "</td>
              <td>&#x20A6; " . number_format($amount) . " (" . $percent4Config['value'] . "% of " . $totalPercent4 . "% of &#x20A6;" . number_format($totalMonthlyRevenueAfterFixedValues4) . ")</td>
              <td>" . $monthName . ", " . $m_y[0] . "</td>
            </tr>";
            $totalMonthlyRevenue = ($totalMonthlyRevenue - $amount);
            $totalPercent4 = $totalPercent4 + $percent4Config['value'];
        }

        $totalMonthlyRevenueAfterFixedValues5 = $totalMonthlyRevenue;
        foreach ($percent5Configuration as $percent5Config) {
            $amount = ($percent5Config['value'] * $totalMonthlyRevenueAfterFixedValues5) / 100;
            $percent5Rows =
                $percent5Rows . "<tr>
              <td>" . ucwords($percent5Config['name']) . "</td>
              <td class='color-yellow'>" . $percent5Config['type'] . "</td>
              <td>&#x20A6; " . number_format($amount) . " (" . $percent5Config['value'] . "% of " . $totalPercent5 . "% of &#x20A6;" . number_format($totalMonthlyRevenueAfterFixedValues5) . ")</td>
              <td>" . $monthName . ", " . $m_y[0] . "</td>
            </tr>";
            $totalMonthlyRevenue = ($totalMonthlyRevenue - $amount);
            $totalPercent5 = $totalPercent5 + $percent5Config['value'];
        }

        $totalRevenue =
            "<tr>
              <td>" . ucwords("Total") . "</td>
              <td class='color-yellow'> - </td>
              <td class='color-red'><strong>&#x20A6; " . number_format(getTotalMonthlyRevenue($month)) . "</strong></td>
            </tr>";
//    echo $totalMonthlyRevenueAfterFixedValues;
        //getting the percentage value
        $revenueTablekhalifa = '
      <table class="table" width="100%" class="table table-condensed table-bordered">
          <thead>
            <tr>
              <th>Names</th>
              <th>Types</th>
              <th>Amount (Fixed / Percent)</th>
              <th>Month</th>
            </tr>
          </thead>
          <tbody>
            ' . $percent0Rows . '
            ' . $fixedRows . '
            ' . $fixedPercentRows . '
            ' . $percent1Rows . '
            ' . $percent2Rows . '
            ' . $percent3Rows . '
            ' . $percent4Rows . '
            ' . $percent5Rows . '
            ' . $totalRevenue . '
          </tbody>
      </table>
    ';

        $revenueTableForesight = '
      <table class="table" width="100%" class="table table-condensed table-bordered">
          <thead>
            <tr>
              <th>Names</th>
              <th>Types</th>
              <th>Amount (Fixed / Percent)</th>
              <th>Month</th>
            </tr>
          </thead>
          <tbody>
            ' . $fixedRows . '
            ' . $fixedPercentRows . '
            ' . $percent1Rows . '
            ' . $percent2Rows . '
            ' . $percent3Rows . '
            ' . $percent4Rows . '
            ' . $percent5Rows . '
            ' . $totalRevenue . '
          </tbody>
      </table>
    ';

        $revenueTableuduth = '
      <table class="table" width="100%" class="table table-condensed table-bordered">
          <thead>
            <tr>
              <th>Names</th>
              <th>Types</th>
              <th>Amount (Fixed / Percent)</th>
              <th>Month</th>
            </tr>
          </thead>
          <tbody>

            ' . $percent1Rows . '

          </tbody>
      </table>
    ';

        if(getTotalMonthlyRevenue($month) > 0){
            if (get_user()->role == "admin") {
                return $revenueTablekhalifa;
            }
            if (get_user()->role == "uduth") {
                return $revenueTableuduth;
            }
            if (get_user()->role == "manager") {
                return $revenueTableuduth;
            }
            if (get_user()->role == "foresight") {
                return $revenueTableForesight;
            }else{
                return "This user is not allowed to view the revenue page.";
            }
        }
        else{
            return "<h3>Sorry! No data for the month of " . $month . "</h3>";
        }

    }
}

if(!function_exists('get_date_from_string')){
    function get_date_from_string($string = null){
        if(!is_null($string)){
            return date('d/M/Y H:i:s', now());
        }
        return date('d/M/Y H:i:s', $string);
    }
}

if(!function_exists('filter_patients')){
    function filter_patients($service = null,$service_type = null, $date_from = null, $date_to = null){

        if(!is_null($service) && !is_null($service_type) && !is_null($date_from) && !is_null($date_to)){
            return Patient::where("")
                ->where('created_at', 'like', '%' . $date_from . '%');
        }
        if(!is_null($service_type) && !is_null($date_from) && !is_null($date_to)){

        }
        if(!is_null($service) && !is_null($date_from) && !is_null($date_to)){

        }
        if(!is_null($service) && !is_null($service_type)){

        }
        if(!is_null($date_from) && !is_null($date_to)){

        }
        if(!is_null($service)){

        }
        if(!is_null($service_type)){

        }
        if(!is_null($date_from)){
            return Patient::where('created_at', 'like', '%' . $date_from . '%');
        }
        return get_patients();
    }
}
