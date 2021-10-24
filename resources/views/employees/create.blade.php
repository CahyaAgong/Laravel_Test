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
                    Create Employees
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{url('/employees')}}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" />
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name" />
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter E-mail"/>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone"/>
                        </div>
                        <div class="form-group">
                            <label for="companies_id">Company</label>
                            <select class="form-control companies" name="companies_id">
                              @foreach($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                              @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.card -->
      </section>
      <!-- /.Left col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<script>
  $(document).ready(function() {
    $('.companies').select2();
  });
</script>
<!-- /.content -->
@endsection
