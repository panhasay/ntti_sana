<div class="control-table">
    <table class="table bg-white table-hover">
        {{-- <thead class="bg-white">
           @foreach ($column as $col)
                <th width="100px" class="bold"><b>{{$col}}</b></th>
           @endforeach
        </thead> --}}
        <tbody>
            @foreach ($records as $record)
            <tr>
                <td><a href="{{url('table/table_field?code=')}}{{App\service\service::Encr_string($record->id,null,null)}}"> <button type="button" class="btn btn-primary btn-md pd-1"> View </button></a></td>
                <td>{{$record->id}}</td>
                <td>{{$record->table_id}}</td>
                <td>{{$record->table_name}}</td>
                <td>{{$record->created_at}}</td>
                <td>{{$record->updated_at}}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
</div>
{{$records->links("pagination::bootstrap-4")}}

