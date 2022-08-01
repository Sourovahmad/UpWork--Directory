@extends('admin.master')

@section('content')
<main id="main" class="main">

    <div class="pagetitle d-flex justify-content-between">
      <h1>Users</h1>
      <button type="button" class="btn btn-sm btn-success btn-lg me-4 ps-3 pe-3" data-bs-toggle="modal" data-bs-target="#add_modal"> Add </button>
    </div>

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">


            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ $message }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    @endif

    @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $error }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    @endforeach


            <!-- Top Selling -->
            <div class="col-12 ">
              <div class="card top-selling">

                <div class="card-body pb-0">

                  <table class="table table-borderless table-responsive">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Marital Status</th>
                        <th scope="col">Date of birth</th>
                        <th scope="col">State</th>
                        <th scope="col">Date of birth</th>
                        <th scope="col">image</th>
                        <th scope="col">Action</th>

                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($users as $user)
                      <tr>
                        <th scope="row"> {{ $user->name }}</th>
                        <th scope="row"> {{ $user->reg_no }}</th>
                        <th scope="row"> {{ $user->gender }}</th>
                        <th scope="row"> {{ $user->marital_status }}</th>
                        <th scope="row"> {{ $user->mangalik_status }}</th>
                        <th scope="row"> {{ $user->birth_date }}</th>
                        <th scope="row"> {{ $user->state }}</th>
                        {{-- <th scope="row"> {{ $user->image_file }}</th> --}}
                   
                        <td>
                          <button type="button" class="btn btn-sm btn-outline-success editButton" data-id="{{ $user->id }}"> edit </button>
                          <button type="button" class="btn btn-sm btn-outline-danger deleteButton" data-id="{{ $user->id }}">delete </button>

                        </td>
                      </tr>

                     @endforeach
                    </tbody>
                  </table>

                </div>

                <nav aria-label="Page navigation example" style="float: right">
                  <ul class="pagination">
                      @if($users->onFirstPage())
                      <li class="page-item disabled"> <a class="page-link" >Previous</a></li>
                      @else
                      <li class="page-item"> <a class="page-link" href="{{ $users->previousPageUrl() }}" >Previous</a></li>
                      @endif

                      @if ($users->hasMorePages())
                          <li class="page-item"> <a class="page-link" href="{{ $users->nextPageUrl() }}">Next</a></li>
                      @else
                          <li class="page-item disabled"> <a class="page-link">Next</a></li>
                      @endif

                  </ul>
              </nav>

              </div>
            </div><!-- End Top Selling -->

          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

    
    <!-- Modal -->
    <div class="modal fade" id="add_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add User Data</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('import_csv') }}" method="POST" enctype="multipart/form-data">

              @csrf
              <div class="mb-3">
                <label class="form-label" for="csv" class="form-label">CSV File</label>
                <input class="form-control" id="csv" name="csv" type="file" accept=".csv, text/csv" />
              </div>

   
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Upload</button>
          </div>

        </form>
        </div>
      </div>
    </div>

  </main>



 

@endsection