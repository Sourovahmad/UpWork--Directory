
  @extends('admin.master')

  @section('content')
  
  <main id="main" class="main">

    <div class="pagetitle d-flex justify-content-between">
      <h1>Todo</h1>
      <button type="button" class="btn btn-sm btn-success btn-lg me-4 ps-3 pe-3" data-bs-toggle="modal" data-bs-target="#create_todo"> Add </button>
    </div>

    <section class="section dashboard">
      <div class="row">

       
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


           
            <div class="col-12">
              <div class="card top-selling">

                <div class="card-body pb-0">

                  <table class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Phase Title</th>
                        <th scope="col">Item first</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($todos as $todo)
                      <tr>
                        <th scope="row"> <img src="{{ $todo->image }}" alt=""> </th>
                        <td><a href="#" class="text-primary fw-bold">{{ $todo->title }}</a></td>
                        <td><a href="#" class="text-primary fw-bold">{{ $todo->desc }}</a></td>
                            
                        <td>
                          <button type="button" class="btn btn-sm btn-outline-success todoeditButton" data-id="{{ $todo->id }}"> edit </button>
                          <button type="button" class="btn btn-sm btn-outline-danger tododeleteButton" data-id="{{ $todo->id }}">delete </button>

                        </td>
                      </tr>

                     @endforeach
                    </tbody>
                  </table>

                </div>


                 <nav aria-label="Page navigation example" style="float: right">
                  <ul class="pagination">
                      @if($todos->onFirstPage())
                      <li class="page-item disabled"> <a class="page-link" >Previous</a></li>
                      @else
                      <li class="page-item"> <a class="page-link" href="{{ $todos->previousPageUrl() }}" >Previous</a></li>
                      @endif

                      @if ($todos->hasMorePages())
                          <li class="page-item"> <a class="page-link" href="{{ $todos->nextPageUrl() }}">Next</a></li>
                      @else
                          <li class="page-item disabled"> <a class="page-link">Next</a></li>
                      @endif

                  </ul>
              </nav> 


              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

  </main>
  
  
  <!-- End #main -->
 @endsection


@section('script')

  <script>
     $(document).ready(function(){
        $('.todoeditButton').on('click', function(){
            const alltodos = @json($todos);

            const todos = alltodos.data;
            const selectedId = $(this).attr('data-id');
            const todo = todos.find(r => r.id == selectedId);

            elementFinder('hidden_todo_id').value = todo.id
            elementFinder('todo_title').value = todo.title;
            elementFinder('todo_desc').value = todo.desc;

            const editModal = new bootstrap.Modal(document.getElementById('edit_todo'), {});
            editModal.show();
        });



        $('.tododeleteButton').on('click', function(){
              if (confirm("Are You Sure!")) {
                    const selectedId = $(this).attr('data-id');
                    elementFinder('delete_todo_id').value = selectedId;
                    elementFinder('delete_todo_button').click();

              } else {
                $(this).preventDefault();
              }

        });


        function elementFinder(id){
            return document.getElementById(id);
        }
     });
  </script>


@endsection
