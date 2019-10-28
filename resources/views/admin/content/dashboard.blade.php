@extends('admin.layout')

@section('content')
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <!-- /.col-xs-12 -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h1 class="font-18 m-0">Timedoor Challenge - Level 9</h1>
        </div>
        <div class="box-body">
          <form method="GET" action="{{ route('dashboard')}} ">
            <div class="bordered-box mb-20">
              <table class="table table-no-border mb-0">
                <tbody>
                  <tr>
                    <td width="80"><b>Title</b></td>
                    <td>
                      <div class="form-group mb-0">
                        <input type="text" name="title" class="form-control"
                        value="{{ request()->get('title') }}">
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td><b>Body</b></td>
                    <td>
                      <div class="form-group mb-0">
                        <input type="text" name="message" class="form-control"
                        value="{{ request()->get('message') }}">
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <table class="table table-search">
                <tbody>
                  <tr>
                    <td width="80"><b>Image</b></td>
                    <td width="60">
                      <label class="radio-inline">
                        <input type="radio" name="imageOption" id="inlineRadio1" value="with"
                        {{ request()->get('imageOption') == 'with' ? "checked" : ""}}> with
                      </label>
                    </td>
                    <td width="80">
                      <label class="radio-inline">
                        <input type="radio" name="imageOption" id="inlineRadio2" value="without"
                        {{ request()->get('imageOption') == 'without' ? "checked" : ""}}> without
                      </label>
                    </td>
                    <td>
                      <label class="radio-inline">
                        <input type="radio" name="imageOption" id="inlineRadio3" value=""
                        {{ empty(request()->get('imageOption')) ? "checked" : ""}}> unspecified
                      </label>
                    </td>
                  </tr>
                  <tr>
                    <td width="80"><b>Status</b></td>
                    <td>
                      <label class="radio-inline">
                      <input type="radio" name="statusOption" id="inlineRadio1" value="on" 
                      {{ request()->get('statusOption') == 'on' ? "checked" : ""}}> on
                      </label>
                    </td>
                    <td>
                      <label class="radio-inline">
                        <input type="radio" name="statusOption" id="inlineRadio2" value="delete"
                        {{ request()->get('statusOption') == 'delete' ? "checked" : ""}}> delete
                      </label>
                    </td>
                    <td>
                      <label class="radio-inline">
                        <input type="radio" name="statusOption" id="inlineRadio3" value=""
                        {{ empty(request()->get('statusOption')) ? "checked" : ""}}>
                        unspecified
                      </label>
                    </td>
                  </tr>
                  <tr>
                    <td><button href="#" class="btn btn-default mt-10"><i class="fa fa-search">
                        </i> Search</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </form>
          @if (! $boards->isEmpty())
          <form id="formTable" method="POST">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th><input type="checkbox" onclick="toggle(this)"></th>
                  <th>ID</th>
                  <th>Title</th>
                  <th>Body</th>
                  <th width="200">Image</th>
                  <th>Date</th>
                  <th width="50">Action</th>
                </tr>
              </thead>
              <tbody>
                @csrf
                @foreach ($boards as $board)
                <tr {!! $board->trashed() ? "class='bg-gray-light'" : '' !!}>
                  <td>{!! $board->trashed() ? "&nbsp;" : "
                    <input type='checkbox' value='$board->id' name='checked[]'>" !!}
                  </td>
                  <td>{{ $board->id }}</td>
                  <td>{{ $board->title }}</td>
                  <td>{!! nl2br(e($board->message)) !!}</td>
                  <td>
                    @if (!is_null($board->image) &&
                    file_exists('storage/' . $board->getImageFolder() . 'thumbnail/' . $board->image))
                    <img class="img-prev" style="width:130px"
                      src="{{ url('storage/' . $board->getImageFolder() . 'thumbnail/' . $board->image) }}" alt="image">
                    <a id="deleteImage" onclick="destroyImage()" href="#" data-toggle="modal" data-target="#deleteModal"
                      data-id="{{ $board->id }}" class="btn btn-danger ml-10 btn-img" rel="tooltip"
                      title="Delete Image">
                      <i class="fa fa-trash"></i>
                    </a>
                    @else
                    -
                    @endif
                  </td>
                  <td>{{ date('Y/m/d', strtotime($board->created_at)) }}<br>
                    <span class="small">{{ date('H:i:s', strtotime($board->created_at)) }}</span></td>
                  @if ($board->trashed())
                  <td><button formaction="{{ route('dashboard.restore', $board->id )}}" class="btn btn-default"
                      rel="tooltip" title="Recover">
                      <i class="fa fa-repeat"></i>
                    </button></td>
                  @else
                  <td><a id="delete" onclick="destroy()" href="#" data-id="{{ $board->id }}" data-toggle="modal"
                      data-target="#deleteModal" class="btn btn-danger" rel="tooltip" title="Delete">
                      <i class="fa fa-trash"></i>
                    </a></td>
                  @endif
                </tr>
                @endforeach
              </tbody>
            </table>
          </form>
          <a id="deleteCheck" href="#" onclick="destroyMultiple()" class="btn btn-default mt-5" data-toggle="modal"
            data-target="#deleteModal">Delete Checked Items</a>
          <div class="text-center">
            {{ $boards->links() }}
          </div>
          @else
          No Data Found
          @endif
        </div>
      </div>
    </div><!-- /.col-xs-12 -->
  </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('script')
<script>
  // BOOTSTRAP TOOLTIPS
      if ($(window).width() > 767) {
        $(function () {
          $('[rel="tooltip"]').tooltip()
        });
      };
      
      // DISPLAY MODAL WITH FORM ACTION
      function destroyImage() {
        id = document.getElementById("deleteImage").dataset.id;
        table = document.getElementById("formTable");
        table.action = "dashboard/destroy/image/" + id;
      }

      function deleteBoard() {
          document.getElementById("formTable").submit();
      }

      function destroy() {
        id = document.getElementById("delete").dataset.id;
        table = document.getElementById("formTable");
        table.action = "dashboard/destroy/" + id;
      }

      function destroyMultiple() {
        table = document.getElementById("formTable");
        table.action = "dashboard/destroy-multiple";
      }

      function toggle(source) {
        boxes = document.getElementsByName("checked[]");

        for(var i = 0, n = boxes.length; i<n; i++) {
          boxes[i].checked = source.checked;
        }
      }
      alert("{{ request()->get('statusOption') }}")
</script>
@if (Session::has('bruh'))
<script>
  alert("{{Session::get('bruh')}}");
</script>
@endif
@endsection