@foreach(get_service_amount($_POST['type_id']) as $amount)
    <option>{{ $amount->amount }}</option>
@endforeach
