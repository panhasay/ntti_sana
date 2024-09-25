<div class="dive">
    <div id="system_overlay" class="setting-overlay">
      <nav class="real-menu" role="navigation">
        <h5 class="text-center mt-2">Customize CardField</h5> 
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Field_name</th>
              <th>Heddin</th>
            </tr>
          </thead>
          <tbody>
            @foreach ( $FieldsCustomize as $CardField)
            <?php 
                if($CardField->hide == 'yes'){
                    $checked = 'checked';
                }else {
                    $checked = null;
                }
            ?>
              <tr class="p-3">
                <td>{{ $CardField->field_description }}</td>
                <td>{{ $CardField->field_name }}</td>
                <td>
                    <input type="checkbox" name="check" id="GFG" value="1" {{ $checked }}>    
                </td>
              </tr>
            @endforeach 
          </tbody>
        </table>
      </nav>
    </div>

    <div id="bg_overlay" class="bgOverlay ">

    </div>
  </div>