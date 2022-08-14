<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.5/viewer.css" integrity="sha512-c7kgo7PyRiLnl7mPdTDaH0dUhJMpij4aXRMOHmXaFCu96jInpKc8sZ2U6lby3+mOpLSSlAndRtH6dIonO9qVEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">

    <!------------------LIght BOx for Gallery-------------->
    <link rel="stylesheet" href="{{ asset('css/lightBox.min.css') }}">
    <script type="text/javascript" src="{{ asset('js/lightBox.js') }}"></script>

    <!------------------LIght BOx for Gallery-------------->

    <title>Find Your Perfect</title>
</head>
<body>


    <!-------------------------------NAvigation Starts------------------>


    


<nav class="mb-4 navbar navbar-expand-lg navbar-dark bg-dark cyan">
    <a class="navbar-brand font-bold text-light"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSuapportedContent-4">
        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown" style="cursor: pointer">
                <a class="nav-link dropdown-toggle text-light" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user text-light"></i> Profile </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-cyan" aria-labelledby="navbarDropdownMenuLink-4">
                    
                    <a class="dropdown-item" data-toggle="modal" data-target="#password_modal" >Change Password</a>

                    <a class="dropdown-item" href="{{ route('logout') }}"   onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Log out</a>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>








    <!---------------------------------------------Ends navigation------------------------------>



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


    <!-------------------------------------------Start Grids layout for lg-xl-3 columns and (xs-lg 1 columns)--------------------------------->


    <div class="container">
        <div class="row">


            <!--------------------------left columns  start-->

           
            <div class="col-1"></div>



            <!--------------------------Ends Left columns-->





            <!---------------------------------------Middle columns  start---------------->




            <div class="col-12 col-lg-8" style="height: 100vh; overflow-y:scroll;">


                <div class="middle-column">


                    <div class="card">


                        <div class="card-header bg-transparent" id="fullcontainer">
                          
                        </div>

                  @forelse ($users as $user)
                      

                        <div class="card-body">
                            <div class="media">

                                <div class="container mb-2 p-2 d-flex justify-content-center">
                                    <div class="card_user_profile p-4">
                                       <div class="user_card_image d-flex flex-column justify-content-center align-items-center">
                                          <button class="btn_user_card btn-secondary"> 
                                            <img class="user_images" src="{{ asset('images/'.$user->image_file) }}" height="100" width="100"/>
                                            
                                            </button> <span class="name mt-3">{{ $user->name }}</span> 
                                            
                                      

                                       </div>
                                    </div>



                            </div>
                        </div>
                    </div>

                    @empty


                    <div class="card-body w-100">
                        <div class="media">
                            <div class="text-cente">
                                <h4> No Data Available</h4>
                            </div>
                        </div>
                    </div>

                @endforelse




                    <hr>



      

                    </div>






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





            <br> <br> <br><br> <br> <br>

            <!------------------------Middle column Ends---------------->








            <!---------------------------Statrs Right Columns----------------->



            <div class="col-12 col-lg-3">


                <div class="right-column">

                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h6 class="card-title">Filter</h6>
                            
                            <form action="{{ route('filterData') }}" method="GET">

                                <div class="mb-2">
                                    <label for="uploadTime" class="form-label">Upload Time</label>
                                    <select class="form-control" id="uploadTime" name="upload_time">
                                        <option value="">Select </option>
                                        <option value="this_week">This Week</option>
                                        <option value="all">All Time</option>
                                      </select>
                                </div>

                                <div class="mb-2">
                                    <label for="uploadTime" class="form-label">Mangalik</label>
                                    <select class="form-control" id="uploadTime" name="mangalik">
                                        <option value="">Select </option>
                                        <option value="non_mangalik">Non Mangalik</option>
                                        <option value="anshik">Anshik</option>
                                        <option value="dont_know">Dont Know</option>
                                      </select>
                                </div>



                                
                                <div class="mb-2">
                                    <label for="uploadTime" class="form-label">Born</label>
                                    <select class="form-control" id="uploadTime" name="born">
                                        <option value="">Select </option>
                                        <option value="before_1985">Before 1985</option>
                                        <option value="1985_1995">1985-1995</option>
                                        <option value="after_1995">After 1995</option>
                                      </select>
                                </div>



                                
                                
                                <div class="mb-2">
                                    <label for="state" class="form-label">State</label>
                                    <select class="form-control" id="state" name="state">
                                        <option value="">Select </option>
                                        <option value="Rajasthan">Rajasthan</option>
                                        <option value="Delhi">Delhi</option>
                                        <option value="UP">UP</option>
                                        <option value="Haryana">Haryana</option>
                                        <option value="MP">MP</option>
                                        <option value="Bihar">Bihar</option>
                                        <option value="Rajasthan">Rajasthan</option>
                                      </select>
                                </div>



                                               
                                <div class="mb-2">
                                    <label for="marital_status" class="form-label">Marital Status</label>
                                    <select class="form-control" id="marital_status" name="marital_status">
                                        <option value="">Select </option>
                                        <option value="Unmarried">Unmarried</option>
                                        <option value="Divorcee">Divorcee</option>
                                        <option value="Widow">Widow</option>
                                        <option value="Widower">Widower</option>
                                      </select>
                                </div>




                                <div class="text-center m-2">
                                    <button class="btn btn-outline-success card-link btn-sm" type="submit">Apply</button>
                                </div>
                             


                            </form>
                        </div>

                    </div>


                </div>


            </div>





        </div>





        {{-- --------------------- Modals ----------------- --}}
        <div class="modal fade" id="password_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <div class="modal-body">
                 

                    <form action="{{ route('change_password') }}" method="POST">
                        @csrf
                    
                    <div class="row">
                  
                    <div class="col-12">
                          
                    <div class="mb-3">
      
                              <div class="form-group">
                                  <label for="prev"> Previous Password </label>
                                  <input type="text" class="form-control" name="prev"  id="prev" required>
                              </div>
                          
                          </div>
      
                    </div>
                </div>
                 

                <div class="row">  
                 <div class="col-md-6 col-sm-12">

                    <input type="text" name="user_id" value="{{ auth()->user()->id }}" hidden required>
                    
                    <div class="form-group">
                        <label for="password"> New Password </label>
                        <input type="text" class="form-control" name="password"  id="password" required>
                    </div>
                 </div>


                 
                 <div class="col-md-6 col-sm-12">
                    
                    <div class="form-group">
                        <label for="password_confirmation"> Confirm Password  </label>
                        <input type="text" class="form-control" name="password_confirmation"  id="password_confirmation" required>
                    </div>
                 </div>

                </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">update</button>

                </form>
                </div>
              </div>
            </div>
          </div>





        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.5/viewer.min.js" integrity="sha512-i5q29evO2Z4FHGCO+d5VLrwgre/l+vaud5qsVqQbPXvHmD9obORDrPIGFpP2+ep+HY+z41kAmVFRHqQAjSROmA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     

        <script>
            window.onload = function(){

                const images = document.querySelectorAll('img');
                images.forEach(element => {
                    const gallery =  new Viewer(element,{
                        toolbar:false
                    });
                });
               


            }
        </script>

       

</body>
</html>
