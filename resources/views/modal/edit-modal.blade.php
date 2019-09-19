<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" class="form-manage" id="form-edit" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="editId" class="modal-id"/>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit Item</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control modal-name" name="editName" value="{{ old('modal-name') }}">
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control modal-title" name="editTitle">
                    </div>
                    <div class="form-group">
                        <label>Body</label>
                        <textarea rows="5" class="form-control modal-body" name="editBody"></textarea>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                        <img class="img-responsive modal-image" alt="" src="https://via.placeholder.com/500x500">
                        </div>
                        <div class="col-md-8 pl-0 edit-image">
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
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control modal-password" name="password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="update-btn">Save changes</button>
                    <button type="button" class="btn btn-primary edit-board-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>