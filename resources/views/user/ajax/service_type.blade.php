<option value=""> -- Type --</option>
@foreach(get_service_type($_POST['service_id']) as $type)
    <option value="{{ $type->id }}">{{ $type->name }}</option>
@endforeach
