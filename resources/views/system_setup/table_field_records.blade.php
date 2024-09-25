<div class="control-table content-table">
  <table class="table bg-white table-hover">
      <thead class="bg-white">
         {{-- @foreach ($column as $col)
              <th width="100px" class="bold"><b>{{$col}}</b></th>
         @endforeach --}}
      </thead>
      <tbody>
      @foreach ($records as $record)
          <tr>
           @foreach ($record as $col)
             <td>{{$record[$col]}}</td>
          @endforeach
          </tr>
      @endforeach
      </tbody>
    </table>
</div>
{{$records->links("pagination::bootstrap-4")}}