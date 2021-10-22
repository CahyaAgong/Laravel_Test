@extends('../layouts.layout')

@section('main_content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- TO DO List -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="ion ion-clipboard mr-1"></i>
                        Company List
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap" id="datatable">
                            <thead>
                            <tr>
                                <th> Name </th>
                                <th> Email </th>
                                <th> Logo </th>
                                <th> Website </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                <tr>
                                    <td>{{ $company->name }}</td>
                                    <td>{{ $company->email }}</td>
                                    <td><img src="{{ asset('storage/'.$company->logo) }}" width="50" height="50"/></td>
                                    <td><a href="{{ $company->website }}" target="_blank">{{ $company->website }}</a></td>
                                    <td>
                                        <button class="btn btn-sm btn-info edit-btn" data-id="{{$company->Id}}" data-name="{{ $company->name }}" data-toggle="modal" data-target="#modal-id">Update</button>
                                        <button class="btn btn-sm btn-danger delete-btn" data-id="{{$company->Id}}">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @include('companies.modal')
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

            $('.edit-btn').click(function(){
              $.ajax({
                  type :'GET',
                  url  :'{{url("/")}}/companies/'+ $(this).data('id') +'/edit',
                  dataType: 'json',
                  success:function(data) {
                    $('#companydata').prop('action', '{{url("/")}}/companies/' + data.Id);

                    $('#modal-id').find('input[name="company_id"]').val(data.Id);
                    $('#modal-id').find('input[name="company_name"]').val(data.name);
                    $('#modal-id').find('input[name="email"]').val(data.email);
                    $('#modal-id').find('input[name="website"]').val(data.website);
                  },
                  complete:function(){
                  },
                  error:function(e){
                    console.log(e)
                  }
              });
            });

            $('.delete-btn').click(function(){
              var id = $(this).attr('data-id');
              swal({
                    title: "Are You Sure?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                            type: "DELETE",
                            url: "{{ url('/') }}/companies/"+ id,
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
