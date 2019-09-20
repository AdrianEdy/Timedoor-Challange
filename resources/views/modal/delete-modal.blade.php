<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" class="form-manage" id="form-delete" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="deleteId" class="modal-id"/>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Delete Item</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control modal-name" name="deleteName" value="{{ old('modal-name') }}">
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control modal-title" name="deleteTitle">
                    </div>
                    <div class="form-group">
                        <label>Body</label>
                        <textarea rows="5" class="form-control modal-body" name="deleteBody"></textarea>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                        <img class="img-responsive modal-image" alt="" src="https://via.placeholder.com/500x500">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control modal-password" name="password">
                    </div>
                </div>
                <p style="text-align:center" class="confirm-message"></p>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a id="destroy-btn">
                        <button type="button" class="btn btn-danger">Delete</button>
                    </a>
                    <button type="button" class="btn btn-success delete-board-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>