<div class="collapse show" id="Fliter">
    <div class="card card-body card-report">
      <form id="advance_search" role="form" class="form-horizontal" enctype="multipart/form-data" action="">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="option bold"> Option</div>
              <div class="col-sm-3 p-3">
                <span class="labels">ដេប៉ាតឺម៉ង់</span>
                <select class="js-example-basic-single" id="department_id" name="department_id" style="width: 100%;">
                  <option value="">&nbsp;</option>
                    @foreach ($department as $dp)
                      <option value="{{ $dp->id ?? ''}}">{{ $dp->department_name ??'' }}</option>
                    @endforeach
                </select>
              </div>
              <div class="col-sm-3 p-3">
                <span class="labels">ឆ្មាំសិក្សា</span>
                <select class="js-example-basic-single" id="session_id" name="session_id" style="width: 100%;">
                  <option value="">&nbsp;</option>
                  @foreach ($sessions as $session)
                  <option value="{{ $session->id ?? ''}}">{{ $session->session ??'' }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-3 p-3">
                <span class="labels">ជំនាញ</span>
                <select class="js-example-basic-single" id="category_id" name="category_id" style="width: 100%;">
                  <option value="">&nbsp;</option>
                  @foreach ($categories as $categories)
                  <option value="{{ $categories->id ?? ''}}">{{ $categories->category ??'' }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-3 p-3">
                <span class="labels">ថ្នាក់</span>
                <select class="js-example-basic-single" id="class_id" name="class_id" style="width: 100%;">
                  <option value="">&nbsp;</option>
                  @foreach ($classes as $class)
                  <option value="{{ $class->id ?? ''}}">{{ $class->class ??'' }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="option bold"> Option Group BY</div>
            <div class="form-group row">
                <div class="col-sm-3">
                  <span class="labels">Group By</span>
                  <select class="js-example-basic-single" id="group_by_category" name="group_by_category" style="width: 100%;">
                    <option value="">&nbsp;</option>
                    <option value="category">ជំនាញ</option>
                  </select>
                </div>
              </div>
            <!-- <button type="button" class="btn btn-primary text-white" data-page="student" id="btn-adSearch">Search</button> -->
          </div>
        </div>
      </form>
    </div>
  </div>
  