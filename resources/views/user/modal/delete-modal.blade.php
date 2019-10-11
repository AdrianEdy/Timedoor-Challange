<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" class="form-manage"
                action="{{ route('destroy', Session::get('board')->id ?? old('deleteId')) }}">
                @csrf
                <input type="hidden" name="deleteId" value="{{ old('deleteId') ?? Session::get('board')->id }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Delete Item</h4>
                </div>
                <div class="modal-body">
                    <p class="small text-danger mt-5 error text-center">
                        {{ Session::get('message') }}
                    </p>
                    <div class="form-group">
                        <label>Name</label>
                        <p>{{ Session::get('board')->name }}</p>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <p>{{ Session::get('board')->title }}</p>
                    </div>
                    <div class="form-group">
                        <label>Body</label>
                        <p>{!! nl2br(e(Session::get('board')->message)) !!}</p>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        @if (!is_null(Session::get('board')->image) &&
                        file_exists('storage/' . $board->getImageFolder() . Session::get('board')->image))
                        <img class="img-responsive modal-image"
                            src="{{ url('storage/' . $board->getImageFolder() . Session::get('board')->image) }}" alt="image">
                        @else
                        <img class="img-responsive modal-image" src="{{ url('storage/image/image-not-available.jpg') }}"
                            alt="image">
                        @endif
                    </div>
                    <div class="form-group hidden">
                        <label>Password</label>
                        <input type="text" class="form-control" name="submitPass"
                            value="{{ old('submitPass') ?? Session::get('submitPass') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <p style="text-align:center">
                        Are you sure want to delete this item?
                    </p>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger delete-board-btn">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>