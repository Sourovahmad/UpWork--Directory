@extends('admin.master')

@section('content')

  <main id="main" class="main">

    <div class="pagetitle d-flex justify-content-between">
      <h1>RoadMaps</h1>
      <button type="button" class="btn btn-sm btn-success btn-lg me-4 ps-3 pe-3" data-bs-toggle="modal" data-bs-target="#create_roadmap"> Add </button>
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
                      @foreach ($roadmaps as $roadmap)
                      <tr>
                        <th scope="row"> <img src="{{ $roadmap->image }}" alt=""> </th>
                        <td><a href="#" class="text-primary fw-bold">{{ $roadmap->title }}</a></td>
                             <td> {{ $roadmap->items[0]->item }}</td>
                        <td>
                          <button type="button" class="btn btn-sm btn-outline-success editButton" data-id="{{ $roadmap->id }}"> edit </button>
                          <button type="button" class="btn btn-sm btn-outline-danger deleteButton" data-id="{{ $roadmap->id }}">delete </button>

                        </td>
                      </tr>

                     @endforeach
                    </tbody>
                  </table>

                </div>

                <nav aria-label="Page navigation example" style="float: right">
                  <ul class="pagination">
                      @if($roadmaps->onFirstPage())
                      <li class="page-item disabled"> <a class="page-link" >Previous</a></li>
                      @else
                      <li class="page-item"> <a class="page-link" href="{{ $roadmaps->previousPageUrl() }}" >Previous</a></li>
                      @endif

                      @if ($roadmaps->hasMorePages())
                          <li class="page-item"> <a class="page-link" href="{{ $roadmaps->nextPageUrl() }}">Next</a></li>
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

  </main><!-- End #main -->
@endsection


@section('script')

  <script>
     $(document).ready(function(){
        $('.editButton').on('click', function(){
            const allRoadmaps = @json($roadmaps);

            const roadmaps = allRoadmaps.data;
            const selectedId = $(this).attr('data-id');
            const roadmap = roadmaps.find(r => r.id == selectedId);

            elementFinder('edit_roadmap_id').value = roadmap.id
            elementFinder('edit_title').value = roadmap.title;

            var html = '';
            roadmap.items.map(item => {
            html += `<div class="col-12">
                    <div class="mb-3">
                        <label for="item">Item</label>
                        <input type="text" class="form-control" name="items[]" placeholder="Add Item" id="edit_item"  value="${item.item}">
                    </div>
                </div>`

            });

            elementFinder('item_add_section_edit').innerHTML = html;
            const editModal = new bootstrap.Modal(document.getElementById('edit_roadmap'), {});
            editModal.show();
        });



        $('.deleteButton').on('click', function(){
              if (confirm("Are You Sure!")) {
                    const selectedId = $(this).attr('data-id');
                    elementFinder('delete_roadmap_id').value = selectedId;
                    elementFinder('delete_roadmap_button').click();

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
