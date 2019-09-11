<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete Data</h4>
    </div>
    <div class="modal-body pad-20">
        <div class="clearfix">
        <div class="pull-left">
            <h2 class="mb-5 text-green"><b>{{ $board->title }}</b></h2>
        </div>
        <div class="pull-right text-right">
            <p class="text-lgray">{{ date('d-m-Y', strtotime($board->created_at)) }}<br/>
            <span class="small">{{ date('H:i', strtotime($board->created_at)) }}</span></p>
        </div>
        </div>
        <h4 class="mb-20">{{ $board->name }} <span class="text-id">-</span></h4>
        <p>
        {{ $board->message }}
        </p>
        <div class="img-box my-10">
        @if (!is_null($board->image) && file_exists('storage/' . $board->image))
            <img class="img-responsive img-post" src="{{ url('storage/' . $board->image) }}" alt="image">
        @else
            <img class="img-responsive img-post" src="{{ url('storage/image/image-not-available.jpg') }}" alt="image">
        @endif
        </div>
        <p>Are you sure want to delete this item?</p>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a href="{{ route('destroy', $board->id) }}">
            <button type="button" class="btn btn-danger">Delete</button>
        </a>
    </div>
</div>