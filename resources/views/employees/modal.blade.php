<div class="modal fade" id="modal-id">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal">Update Employee</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <input type="hidden" id="company_id" name="company_id">
            </div>

            <div class="modal-body">
                <form id="employeeData" action="" method="post">
                  @csrf
                  @method('put')
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name_edit" placeholder="Enter First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name_edit" placeholder="Enter Last Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email_edit" placeholder="Enter E-mail">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone_edit" placeholder="Enter Phone">
                    </div>
                    <div class="form-group">
                        <label for="companies_id_edit">Company</label> <br>
                        <select style="padding:8px; width:100%" id="companies-edit" name="companies_id_edit"></select>
                    </div>
                    <input type="submit" value="Submit" id="submit" class="btn btn-primary" style="font-size: 0.8em;">
                </form>
            </div>

        </div>
    </div>
</div>
