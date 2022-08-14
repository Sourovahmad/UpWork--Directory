@extends('admin.master')

@section('content')
<main id="main" class="main">

    <div class="pagetitle d-flex justify-content-between">
      <h1>Users</h1>
      <div>
        <button type="button" class="btn btn-sm btn-success btn-lg me-4 ps-3 pe-3" data-bs-toggle="modal" data-bs-target="#add_modal"> Add csv </button>
        <button type="button" class="btn btn-sm btn-success btn-lg me-4 ps-3 pe-3" data-bs-toggle="modal" data-bs-target="#image_modal"> upload Image </button>
      <button type="button" class="btn btn-sm btn-info btn-lg me-4 ps-3 pe-3" data-bs-toggle="modal" data-bs-target="#setting_modal"><span class="iconify" data-icon="icon-park:setting" style="font-size:22px"></span>  </button>

      </div>
      
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

                  <table class="table table-borderless table-responsive" id="users_table">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Reg No</th>
                        <th scope="col">Password</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Marital Status</th>
                        <th scope="col">Mangalik Staus</th>
                        <th scope="col">State</th>
                        <th scope="col">birth Year</th>
                        <th scope="col">image</th>
                        <th scope="col">Action</th>

                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($users as $user)
                      <tr>
                        <th scope="row"> {{ $user->name }}</th>
                        <th scope="row"> {{ $user->reg_no }}</th>
                        <th scope="row"> {{ $user->password }}</th>
                        <th scope="row"> {{ $user->gender }}</th>
                        <th scope="row"> {{ $user->marital_status }}</th>
                        <th scope="row"> {{ $user->mangalik_status }}</th>
                        <th scope="row"> {{ $user->state }}</th>
                        <th scope="row"> {{ $user->year }}</th>
                        <th scope="row"> <img src="{{ url('/images/'.$user->image_file) }}" alt="" style="height: 35px; width:40px"> </th>
                   
                        <td>
                          <button type="button" class="btn btn-sm btn-outline-success editButton" data-id="{{ $user->id }}"> edit </button>
                          <button type="button" class="btn btn-sm btn-outline-danger deleteButton" data-id="{{ $user->id }}">delete </button>

                        </td>
                      </tr>

                     @endforeach
                    </tbody>
                  </table>

                </div>

                {{-- <nav aria-label="Page navigation example" style="float: right">
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
              </nav> --}}

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

    {{-- form for delete user --}}
    <form action="{{ route('delete_user') }}" method="POST" id="user_delete_hdiden_form" hidden>
      @csrf
      <input type="number" name="user_id" id="form_user_id">
    </form>

        
    <!-- Modal -->
    <div class="modal fade" id="setting_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('change_status') }}" method="POST" enctype="multipart/form-data">

              @csrf
              <div class="mb-3">
                <div class="form-check form-switch">
                  <input class="form-check-input" name="status" type="checkbox" id="flexSwitchCheckChecked" 
                  
                  @if($setting->online_status == true)
                    checked
                  @endif
                  
                  >
                  <label class="form-check-label" for="flexSwitchCheckChecked">Change Website Status</label>
                </div>


              </div>

   
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>

        </form>
        </div>
      </div>
    </div>



    {{--  image upload modal --}}


    
    <!-- Modal -->
    <div class="modal fade" id="image_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Upload Image  </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('import_image') }}" method="POST" enctype="multipart/form-data">

              @csrf
              <div class="mb-3">
                <label class="form-label" for="csv" class="form-label">Image zip</label>
                <input class="form-control" id="csv" name="file" type="file" accept=".zip" required />
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
  



        <!-- edit modal -->
        <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">


                <form action="{{ route('update_user') }}" method="POST" enctype="multipart/form-data">

                  @csrf

                  <input type="text" class="form-control" name="user_id" id="edit_user_id" required hidden>




                  <div class="row">

                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="reg_no">Reg No</label>
                            <input type="text" class="form-control"  name="reg_no"  id="edit_reg_no" required>
                        </div>
                    
                      </div>
                    </div>



                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_password">Password</label>
                            <input type="text" class="form-control"  name="password"  id="edit_password" required>
                        </div>
                    
                      </div>
                    </div>



                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_name">Name</label>
                            <input type="text" class="form-control"  name="name"  id="edit_name" required>
                        </div>
                    
                      </div>
                    </div>



                    
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_gender">Gender</label>
                            <input type="text" class="form-control" name="gender"  id="edit_gender" required>
                        </div>
                    
                      </div>
                    </div>



                              
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_imageFile">Image File Name</label>
                            <input type="text" class="form-control" name="image_file"  id="edit_imageFile" >
                        </div>
                    
                      </div>
                    </div>



                    
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_marital_status">Marital Status</label>
                            <input type="text" class="form-control" name="marital_status"  id="edit_marital_status" >
                        </div>
                    
                      </div>
                    </div>



                                        
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_mangalik_status">Mangalik Status</label>
                            <input type="text" class="form-control" name="mangalik_status"  id="edit_mangalik_status" >
                        </div>
                    
                      </div>
                    </div>



                                                     
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_birth_date">Birth Date</label>
                            <input type="text" class="form-control" name="birth_date"  id="edit_birth_date" >
                        </div>
                    
                      </div>
                    </div>



                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_state">State</label>
                            <input type="text" class="form-control" name="state"  id="edit_state" >
                        </div>
                    
                      </div>
                    </div>



                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_payment">Payment</label>
                            <input type="text" class="form-control" name="payment"  id="edit_payment" >
                        </div>
                    
                      </div>
                    </div>



                    
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_facebook">facebook</label>
                            <input type="text" class="form-control" name="facebook"  id="edit_facebook" >
                        </div>
                    
                      </div>
                    </div>



                    

                    
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_insta">Instagram</label>
                            <input type="text" class="form-control" name="insta"  id="edit_insta" >
                        </div>
                    
                      </div>
                    </div>




                             
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_mobile">Mobile</label>
                            <input type="text" class="form-control" name="mobile_no"  id="edit_mobile" >
                        </div>
                    
                      </div>
                    </div>




                    
                             
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_address">Address</label>
                            <input type="text" class="form-control" name="address"  id="edit_address" >
                        </div>
                    
                      </div>
                    </div>




                                    
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_father_name">Father Name</label>
                            <input type="text" class="form-control" name="father_name"  id="edit_father_name" >
                        </div>
                    
                      </div>
                    </div>



                    
                                    
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_father_occuption">Father occuption</label>
                            <input type="text" class="form-control" name="father_occuption"  id="edit_father_occuption" >
                        </div>
                    
                      </div>
                    </div>



                    
                    
                                    
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_mother_name">Mother Name</label>
                            <input type="text" class="form-control" name="mother_name"  id="edit_mother_name" >
                        </div>
                    
                      </div>
                    </div>






                    
                                    
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_mother_occuption">Mother occuption</label>
                            <input type="text" class="form-control" name="mother_occuption"  id="edit_mother_occuption" >
                        </div>
                    
                      </div>
                    </div>



                    
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_month">month</label>
                            <input type="text" class="form-control" name="month"  id="edit_month" >
                        </div>
                    
                      </div>
                    </div>


                            
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_year">Year</label>
                            <input type="text" class="form-control" name="year"  id="edit_year" >
                        </div>
                    
                      </div>
                    </div>



                    
                            
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_time">Time</label>
                            <input type="text" class="form-control" name="time"  id="edit_time" >
                        </div>
                    
                      </div>
                    </div>



                                 
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_birth_city">Birth City</label>
                            <input type="text" class="form-control" name="birth_city"  id="edit_birth_city" >
                        </div>
                    
                      </div>
                    </div>


                                        
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_height">Height</label>
                            <input type="text" class="form-control" name="height"  id="edit_height" >
                        </div>
                    
                      </div>
                    </div>




                    
                                        
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_complexion">Complexion</label>
                            <input type="text" class="form-control" name="complexion"  id="edit_complexion" >
                        </div>
                    
                      </div>
                    </div>



                    
                    
                                        
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_occupation">Occupation</label>
                            <input type="text" class="form-control" name="occupation"  id="edit_occupation" >
                        </div>
                    
                      </div>
                    </div>




                                              
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_income">income</label>
                            <input type="text" class="form-control" name="income"  id="edit_income" >
                        </div>
                    
                      </div>
                    </div>




                    

                                              
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_education_qualification">Education Qualification</label>
                            <input type="text" class="form-control" name="education_qualification"  id="edit_education_qualification" >
                        </div>
                    
                      </div>
                    </div>



                    
                                              
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_drinking">Drinking</label>
                            <input type="text" class="form-control" name="drinking"  id="edit_drinking" >
                        </div>
                    
                      </div>
                    </div>



                                                          
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_eating">Eating</label>
                            <input type="text" class="form-control" name="eating"  id="edit_eating" >
                        </div>
                    
                      </div>
                    </div>



                                                                    
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_weight">Weight</label>
                            <input type="text" class="form-control" name="weight"  id="edit_weight" >
                        </div>
                    
                      </div>
                    </div>


                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_smoker">Smoker</label>
                            <input type="text" class="form-control" name="smoker"  id="edit_smoker" >
                        </div>
                    
                      </div>
                    </div>



                    
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_relation">Relation</label>
                            <input type="text" class="form-control" name="relation"  id="edit_relation" >
                        </div>
                    
                      </div>
                    </div>



                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_number">RNumber</label>
                            <input type="text" class="form-control" name="rnumber"  id="edit_number" >
                        </div>
                    
                      </div>
                    </div>



                    
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_rname">Rname</label>
                            <input type="text" class="form-control" name="rname"  id="edit_rname" >
                        </div>
                    
                      </div>
                    </div>


                    
                    
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_bussiness_and_company_name">bussiness and company name</label>
                            <input type="text" class="form-control" name="bussiness_and_company_name"  id="edit_bussiness_and_company_name" >
                        </div>
                    
                      </div>
                    </div>




                    
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_family_gotra">family Gotra</label>
                            <input type="text" class="form-control" name="family_gotra"  id="edit_family_gotra" >
                        </div>
                    
                      </div>
                    </div>


                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_working_city">Working city</label>
                            <input type="text" class="form-control" name="working_city"  id="edit_working_city" >
                        </div>
                    
                      </div>
                    </div>



                    
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_min_income">Min income</label>
                            <input type="text" class="form-control" name="min_income"  id="edit_min_income" >
                        </div>
                    
                      </div>
                    </div>



                    
                    
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_rashi">Rashi</label>
                            <input type="text" class="form-control" name="rashi"  id="edit_rashi" >
                        </div>
                    
                      </div>
                    </div>



                      
                    
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_preference">Preference</label>
                            <input type="text" class="form-control" name="preference"  id="edit_preference" >
                        </div>
                    
                      </div>
                    </div>




                          
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_additional">Additional</label>
                            <input type="text" class="form-control" name="additional"  id="edit_additional" >
                        </div>
                    
                      </div>
                    </div>


                    


                          
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_brothers">Brothers</label>
                            <input type="text" class="form-control" name="brothers"  id="edit_brothers" >
                        </div>
                    
                      </div>
                    </div>



                            
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_sisters">Sisters</label>
                            <input type="text" class="form-control" name="sisters"  id="edit_sisters" >
                        </div>
                    
                      </div>
                    </div>



                               
                    <div class="col-md-6 col-sm-12">
                      <div class="mb-3">

                        <div class="form-group">
                            <label for="edit_designation">Designation</label>
                            <input type="text" class="form-control" name="designation"  id="edit_designation" >
                        </div>
                    
                      </div>
                    </div>








                  </div>
    
    
       
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
    
            </form>



            </div>
          </div>
        </div>
    





  </main>



@endsection




@section('script')

  <script>
     $(document).ready(function(){

    $('#users_table').DataTable();




      const all_users = @json($users);


      $('.editButton').on('click', function() {

        const selectedId = $(this).attr('data-id');
        const single = all_users.find(f => f.id == selectedId);

        console.log(single);

        elementFinder('edit_user_id').value = selectedId;
        elementFinder('edit_reg_no').value = single.reg_no;
        elementFinder('edit_name').value = single.name;
        elementFinder('edit_gender').value = single.gender;
        elementFinder('edit_marital_status').value = single.marital_status;
        elementFinder('edit_mangalik_status').value = single.mangalik_status;
        elementFinder('edit_birth_date').value = single.birth_date;


        elementFinder('edit_state').value = single.state;
        elementFinder('edit_payment').value = single.payment;
        elementFinder('edit_facebook').value = single.facebook;
        elementFinder('edit_insta').value = single.insta;
        elementFinder('edit_mobile').value = single.mobile_no;
        elementFinder('edit_address').value = single.address;
        elementFinder('edit_father_name').value = single.father_name;
        elementFinder('edit_father_occuption').value = single.father_occuption;
        elementFinder('edit_mother_name').value = single.mother_name;

        elementFinder('edit_mother_occuption').value = single.mother_occuption;
        elementFinder('edit_month').value = single.month;
        elementFinder('edit_year').value = single.year;
        elementFinder('edit_time').value = single.time;
        elementFinder('edit_birth_city').value = single.birth_city;
        elementFinder('edit_height').value = single.height;
        elementFinder('edit_complexion').value = single.complexion;
        elementFinder('edit_occupation').value = single.occupation;
        elementFinder('edit_income').value = single.income;
        elementFinder('edit_education_qualification').value = single.education_qualification;

        elementFinder('edit_drinking').value = single.drinking;
        elementFinder('edit_eating').value = single.eating;
        elementFinder('edit_weight').value = single.weight;
        elementFinder('edit_smoker').value = single.smoker;
        elementFinder('edit_relation').value = single.relation;
        elementFinder('edit_number').value = single.number;
        elementFinder('edit_rname').value = single.rname;
        elementFinder('edit_bussiness_and_company_name').value = single.bussiness_and_company_name;

        elementFinder('edit_family_gotra').value = single.family_gotra;
        elementFinder('edit_working_city').value = single.working_city;
        elementFinder('edit_min_income').value = single.min_income;
        elementFinder('edit_rashi').value = single.rashi;
        elementFinder('edit_preference').value = single.preference;
        elementFinder('edit_additional').value = single.additional;
        elementFinder('edit_brothers').value = single.brothers;
        elementFinder('edit_sisters').value = single.sisters;
        elementFinder('edit_designation').value = single.designation;
        elementFinder('edit_password').value = single.pss_forsetting;
        elementFinder('edit_imageFile').value = single.image_file;




        const editmodal = new bootstrap.Modal(document.getElementById('edit_modal'), {});
        editmodal.show();



    });

     
        $('.deleteButton').on('click', function(){
              if (confirm("Are You Sure!")) {
                    const selectedId = $(this).attr('data-id');
                    console.log(selectedId);
                    elementFinder('form_user_id').value = selectedId;
                    elementFinder('user_delete_hdiden_form').submit();

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