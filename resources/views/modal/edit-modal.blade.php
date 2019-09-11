<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="form-edit" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="edit-id" class="edit-id"/>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Item</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control edit-name" name="editName" value="{{ old('edit-name') }}">
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control edit-title" name="editTitle">
                    </div>
                    <div class="form-group">
                        <label>Body</label>
                        <textarea rows="5" class="form-control edit-body" name="editBody"></textarea>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                        <img class="img-responsive edit-image" alt="" src="https://via.placeholder.com/500x500">
                        </div>
                        <div class="col-md-8 pl-0">
                        <label>Choose image from your computer :</label>
                        <div class="input-group">
                            <input type="text" class="form-control upload-form" value="No file chosen" readonly>
                            <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                <i class="fa fa-folder-open"></i>&nbsp;Browse <input type="file" name="editImage" multiple>
                            </span>
                            </span>
                        </div>
                        <div class="checkbox">
                            <label>
                            <input type="checkbox" name="deleteImage">Delete image
                            </label>
                        </div>
                        </div>
                        @error('edit-image')
                            <p class="small text-danger mt-5">{{ $message }}</p>
                        @enderror
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