

<div class="modal fade" id="create_roadmap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add RoadMap</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="{{ route('road-map-store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="RoadMap tilte" id="title" required>
                  </div>
              </div>



                  <div class="col-sm-12 col-md-6">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" placeholder="RoadMap file" id="image" accept="image/x-png,image/gif,image/jpeg" required>
                  </div>



                <div class="col-12">
                    <div class="mb-3">
                      <label for="item">Item</label>
                      <input type="text" class="form-control" name="items[]" placeholder="Add Item" id="item" required>
                    </div>
                  </div>

                  <div id="item_add_section"></div>

            </div>



          <button type="button" class="btn btn-primary" id="item_add_btn">Add Item</button>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" >Save</button>

        </form>
        </div>
      </div>
    </div>
  </div>




  <div class="modal fade" id="edit_roadmap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add RoadMap</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

                  <form action="{{ route('road-map-update') }}" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                          <div class="col-sm-12 col-md-6">
                              <div class="mb-3">
                                  <label for="title">Title</label>
                                  <input type="text" class="form-control" name="title" placeholder="RoadMap tilte" id="edit_title" required>
                              </div>
                          </div>

                          <input type="text" name="roadmap_id" id="edit_roadmap_id" hidden>

                          <div class="col-sm-12 col-md-6">
                              <label for="image">Image</label>
                              <input type="file" class="form-control" name="image" placeholder="RoadMap file" id="image" accept="image/x-png,image/gif,image/jpeg" >
                          </div>

                          <div id="item_add_section_edit"></div>

                      </div>



                      <button type="button" class="btn btn-primary" id="item_add_btn_edit">Add Item</button>


              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Update</button>

                  </form>
              </div>
          </div>
      </div>
  </div>



<div class="modal fade" id="edit_faq_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">edit Faq test</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">


                    <div class="row">
                        <form action="{{ route('faq-update') }}" method="POST">
                            @csrf
                            <input type="text" name="faq_id" id="faq_hidden_id" hidden>
                            <div class="col-12">
                                <label for="faq_title">Faq</label>
                                <input type="text" name="title"  class="form-control" id="edit_faq_title">
                            </div>

                                  <div class="col-12">
                                      <label for="faq_ans">Answear</label>
                                      <input type="text" name="ans"  class="form-control" id="edit_faq_ans">


                                  </div>

                                  <button type="submit" class="btn btn-info mt-3" >Update</button>

                        </form>
                    </div>

            </div>
        </div>
    </div>
</div>




 



<!-- todo list --->
<div class="modal fade" id="create_todo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Todo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <form action="{{ route('todo-store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="todo tilte" id="title" required>
                  </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="mb-3">
                    <label for="title">desc</label>
                    <input type="text" class="form-control" name="desc" placeholder="todo description" id="title" required>
                  </div>
              </div>



                  <div class="col-sm-12 col-md-6">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image" placeholder="todo file" id="image" accept="image/x-png,image/gif,image/jpeg" required>
                  </div>


            </div>



     

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" >Save</button>

        </form>
        </div>
      </div>
    </div>
  </div>


  <!-- todo list --->
<div class="modal fade" id="edit_todo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Todo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form action="{{ route('todo-update') }}" method="post" enctype="multipart/form-data">
          @csrf
          <input type="text" name="todo_id" id="hidden_todo_id" hidden required>
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <div class="mb-3">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" name="title" placeholder="todo tilte" id="todo_title" required>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
              <div class="mb-3">
                  <label for="title">desc</label>
                  <input type="text" class="form-control" name="desc" placeholder="todo description" id="todo_desc" required>
                </div>
            </div>



                <div class="col-sm-12 col-md-6">
                  <label for="image">Image</label>
                  <input type="file" class="form-control" name="image" placeholder="todo file" id="todo_image" accept="image/x-png,image/gif,image/jpeg" >
                </div>


          </div>



   

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Save</button>

      </form>
      </div>
    </div>
  </div>
</div>











  <form action="{{ route('roadmap-delete') }}" method="POST" hidden>
    @csrf
    <input type="text" name="roadmap_id" id="delete_roadmap_id">
    <button id="delete_roadmap_button">delete</button>
  </form>


  <form action="{{ route('faq-delete') }}" method="POST" hidden>
      @csrf
      <input type="text" name="faq_id" id="delete_faq_id">
      <button id="delete_faq_button">delete</button>
  </form>



  <form action="{{ route('todo-delete') }}" method="POST" hidden>
    @csrf
    <input type="text" name="todo_id" id="delete_todo_id" required>
    <button id="delete_todo_button">delete</button>
  </form>



  <script>
    window.onload = function(){
      var item_add_section = document.getElementById('item_add_section');
      var item_add_btn = document.getElementById('item_add_btn');
      var item_input = document.getElementById('item');

      item_add_btn.addEventListener('click', function(){
        var item_value = item_input.value;
        var item_div = document.createElement('div');
        item_div.classList.add('col-sm-12');
        item_div.innerHTML = '<div class="mb-3"><label >Item</label><input type="text" class="form-control" name="items[]" placeholder="Add Item" id="item"></div>';
        item_add_section.append(item_div);
      });



      var item_add_edit_btn = document.getElementById('item_add_btn_edit');
      var edit_item_add_section = document.getElementById('item_add_section_edit');
      item_add_edit_btn.addEventListener('click', function(){

        var item_div = document.createElement('div');
        item_div.classList.add('col-sm-12');
        item_div.innerHTML = '<div class="mb-3"><label >Item</label><input type="text" class="form-control" name="items[]" placeholder="Add Item" id="item"></div>';
        edit_item_add_section.append(item_div);
      });


    }
  </script>
