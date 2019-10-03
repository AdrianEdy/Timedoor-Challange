<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" class="form-manage" id="form-edit" 
            enctype="multipart/form-data" action="{{ route('delete', Session::get('board')->id) }}">
                @csrf
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
                            file_exists('storage/image/board/' . Session::get('board')->image))
                            <img class="img-responsive modal-image" 
                            src="{{ url('storage/image/board/' . Session::get('board')->image) }}" alt="image">
                        @else
                            <img class="img-responsive modal-image" 
                            src="{{ url('storage/image/image-not-available.jpg') }}" alt="image">
                        @endif
                    </div>
                    @if(Session::get('passErr') !== 'not set')
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control modal-password" name="submitPass">
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    @if(Session::get('passErr') !== 'not set')
                        <button class="btn btn-primary">Submit</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>