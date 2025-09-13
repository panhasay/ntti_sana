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
          <th>ឈ្មោះ អ្នកប្រើប្រាស់</th>
          <th>អុីម៉ែល</th>
          <th>ភេទ</th>
          <th>លេខទូរសព្ទ</th>
          <th>តួនាទី</th>
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
                    <a class="btn btn-primary btn-icon-text btn-sm mb-2 mb-md-0 me-2" href="{{ 'users/transaction?type=ed&code='.\App\Service\service::Encr_string($record->id) }}"><i class="mdi mdi-border-color"></i> កែប្រែ</a>
                    <button class="btn btn-danger btn-icon-text btn-sm mb-2 mb-md-0 me-2" id="btnDelete" data-code="{{ $record->id ?? '' }}"><i class="mdi mdi-delete-forever"></i>លុប</button>
                </td>
                <td class="">{{ $record->name ?? '' }}</td>
                <td class="">{{ $record->email }}</td>
                <td class="">{{ $record->gender }}</td>
                <td class="">{{ $record->phone }}</td>
                <td class="">{{ $record->roles->name_2 ?? '' }}</td>
            </tr>
        @endforeach
      </tbody>
    </table>
    {{$records->links("pagination::bootstrap-4")}}
  </div><br><br>