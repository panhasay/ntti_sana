<style>
    .btn-danger:not(.btn-light) {
      color: #ffffff;
      font-size: 11px;
    }
    .btn-primary:not(.btn-light) {
      color: #ffffff;
      font-size: 11px;
    }
  </style>
  <div class="control-table">
    <table class="table table-striped">
      <thead>
        <tr>
          <th width="50"></th>
          <th width="10">លរ</th>
          <th>ឈ្មោះ អ្នកប្រើប្រាស់</th>
          <th>អុីម៉ែល</th>
          <th>តួនាទី</th>
          <th class="text-center">សកម្មភាព</th>
        </tr>
      </thead>
      <tbody>
        <?php $index = 1; ?>
        @foreach ($records as $record)
        <?php 
          $data = $record->username;
          $username = ucfirst($data);
        ?>
            <tr id="row{{$record->id}}">
                <td class="">
                    <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" href="{{ 'departments/transaction?type=ed&code='.\App\Service\service::Encr_string($record->id) }}"><i class="mdi mdi-border-color"></i> Edit</a>
                    <button class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btnDelete" data-code="{{ $record->id ?? '' }}"><i class="mdi mdi-delete-forever"></i> Delete</button>
                </td>
                <td class="">&nbsp;{{ $record->id ?? '' }}</td>
                <td class="">{{ $username ?? '' }}</td>
                <td class="">{{ $record->user }}</td>
                <td class="">{{ $record->role }}</td>
                <td class="text-right">
                  <label class="badge {{ $record->is_active == 'no' ? 'badge-danger' : 'badge-success' }} btn-sm mb-2 mb-md-0 me-2">
                    {{ $record->is_active ?? '' }}
                  </label>
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>
    {{$records->links("pagination::bootstrap-4")}}
  </div><br><br>