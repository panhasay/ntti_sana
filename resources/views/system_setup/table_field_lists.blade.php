<div class="control-table">
  <table class="table bg-white table-hover content-table">
      <thead class="bg-white">
         @foreach ($column as $col)
              <th width="100px" class="bold"><b>{{$col}}</b></th>
         @endforeach
      </thead>
      <tbody>
      @foreach ($records as $item)
          <tr>
           @foreach ($column as $col)
             <td>{{$item[$col]}}</td>
          @endforeach
          </tr>
      @endforeach
      </tbody>
    </table>
</div>
{{-- {{$records->links("pagination::bootstrap-4")}} --}}