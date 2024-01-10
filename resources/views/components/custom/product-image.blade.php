@props(['row_data', 'col'])

<td class="flex">
    <img src="{{$row_data->image['path']}}" alt="" class="h-20 w-20 rounded-sm mr-2">
    <p>{{ $row_data->name}}</p>
</td>
