<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" class="form-manage" id="form-edit" 
            action="{{ route('update', Session::get('board')->id ?? old('editId')) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" 
                name="editId" value="{{ old('editId') ?? Session::get('board')->id }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Item</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control modal-name" 
                        name="editName" value="{{ old('editName') ?? Session::get('board')->name }}">
                        @error('editName')
                            <p class="small text-danger mt-5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control modal-title"
                        name="editTitle" value="{{ old('editTitle') ?? Session::get('board')->title ?? null}}">
                        @error('editTitle')
                            <p class="small text-danger mt-5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Body</label>
                        <textarea rows="5" class="form-control modal-body" 
                        name="editBody">{{ old('editBody') ?? Session::get('board')->message ?? null }}</textarea>
                        @error('editBody')
                            <p class="small text-danger mt-5">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                        <?php
                            $imageName = Session::get('board')->image ?? old('editImageName');
                        ?>
                        @if (!is_null($imageName) &&
                            file_exists('storage/image/board/' . $imageName))
                            <img class="img-responsive modal-image" 
                            src="{{ url('storage/image/board/' . $imageName) }}" alt="image">
                        @else
                            <img class="img-responsive modal-image" 
                            src="{{ url('storage/image/image-not-available.jpg') }}" alt="image">
                        @endif
                        </div>
                        <div class="col-md-8 pl-0 edit-image">
                            <label>Choose image from your computer :</label>
                            <div class="input-group">
                                <input type="text" class="form-control upload-form" value="No file chosen" readonly>
                                <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    <i class="fa fa-folder-open"></i>&nbsp;Browse
                                    <input type="file" name="editImage" multiple>
                                    <input type="hidden" name="editImageName"
                                    value="{{ Session::get('board')->image ?? old('editImageName') ?? null }}">
                                </span>
                                </span>
                            </div>
                            <div class="checkbox">
                                <label>
                                <input type="checkbox" name="deleteImage">Delete image
                                </label>
                            </div>
                            @error('editImage')
                                <p class="small text-danger mt-5">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group hidden">
                            <label>Password</label>
                            <input type="text" class="form-control" 
                            name="editPassword" value="{{ old('editPassword') ?? Session::get('submitPass') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="update-btn">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>