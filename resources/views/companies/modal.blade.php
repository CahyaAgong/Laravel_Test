<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <input type="hidden" id="company_id" name="company_id">
            </div>

            <div class="modal-body">
                <form id="companydata" action="" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                    <div class="form-group">
                        <label for="company_name">Company Name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter E-mail">
                    </div>
                    <div class="form-group">
                        <label for="logo_file">Logo</label>
                        <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="logo_file" name="logo_file">
                              <label class="custom-file-label" for="logo_file">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="text" class="form-control" id="website" name="website" placeholder="Enter Website">
                    </div>
                    <input type="submit" value="Submit" id="submit" class="btn btn-primary" style="font-size: 0.8em;">
                </form>
            </div>

        </div>
    </div>
</div>
