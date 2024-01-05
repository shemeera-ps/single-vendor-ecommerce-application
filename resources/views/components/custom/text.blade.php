@props(['row_data', 'col'])
<td>
    <span>
        @foreach ($col['fields'] as $field)   
        {{$row_data->$field}}
        @if(!$loop->last && trim($row_data->$field) != ''),@endif             
        @endforeach
    </span>
</td>
