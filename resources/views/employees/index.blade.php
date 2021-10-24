@extends('../layouts.layout')

@section('main_content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ion ion-clipboard mr-1"></i>
                        Employees List
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap" id="datatable">
                            <thead>
                            <tr>
                                <th> No </th>
                                <th> Full Name </th>
                                <th> Company </th>
                                <th> Email </th>
                                <th> Phone </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                              @php($i = 1)
                                @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{$employee->full_name}}</td>
                                    <td><a href="#" class="detail_company" data-id="{{$employee->company->id}}" data-toggle="modal" data-target="#modal-company">{{$employee->company->name}}</a></td>
                                    <td>{{$employee->email}}</td>
                                    <td>{{$employee->phone}}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info edit-btn" data-id="{{$employee->id}}" data-toggle="modal" data-target="#modal-id">Update</button>
                                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{$employee->id}}">Delete</button>
                                    </td>
                                </tr>
                                @php($i++)
                                @endforeach
                            </tbody>
                        </table>
                        @include('employees.modal')
                        @include('employees.company_modal')
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
            $('#companies-edit').select2();

            /*=== update employee ===*/
            $('.edit-btn').click(function(){
              $.ajax({
                  type :'GET',
                  url  :'{{url("/")}}/employees/'+ $(this).data('id') +'/edit',
                  dataType: 'json',
                  success:function(data) {
                    $('#employeeData').prop('action', '{{url("/")}}/employees/' + data.employee.id);

                    $.each(data.company, function( index, value ) {
                      $('#modal-id').find('select[name="companies_id_edit"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });

                    $('#modal-id').find('input[name="first_name_edit"]').val(data.employee.first_name);
                    $('#modal-id').find('input[name="last_name_edit"]').val(data.employee.last_name);
                    $('#modal-id').find('input[name="email_edit"]').val(data.employee.email);
                    $('#modal-id').find('input[name="phone_edit"]').val(data.employee.phone);

                    $('#modal-id').find('select[name="companies_id_edit"]').val(data.employee.company_id);
                  },
                  complete:function(){
                  },
                  error:function(e){
                    console.log(e)
                  }
              });
            });

            /*=== detail company ===*/
            $('.detail_company').click(function(){
              $.ajax({
                  type :'GET',
                  url  :'{{url("/")}}/employees/'+ $(this).data('id'),
                  dataType: 'json',
                  success:function(data) {
                    $('#modal-company').find('img[name="logo_comp"]').attr('src', '/storage/'+ data.logo +'');
                    $('#modal-company').find('input[name="name_comp"]').val(data.name);
                    $('#modal-company').find('input[name="email_comp"]').val(data.email);
                    $('#modal-company').find('input[name="site_comp"]').val(data.website);
                  },
                  complete:function(){
                  },
                  error:function(e){
                    console.log(e)
                  }
              });
            });

            /*=== delete employee ===*/
            $('.delete-btn').click(function(){
              var id = $(this).attr('data-id');
              swal({
                    title: "Are You Sure ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            type: "DELETE",
                            url: "{{ url('/') }}/employees/"+ id,
                            dataType: "json",
                            success: function (data) {
                                swal("Poof! Berhasil Dihapus!", {
                                icon: "success",
                                });
                                location.reload();
                            },
                            complete: function (e) {},
                            error: function(e){
                              console.log(e);
                            }
                            });

                        }
                    });
            });
        });
    </script>
</section>
<!-- /.content -->
@endsection
