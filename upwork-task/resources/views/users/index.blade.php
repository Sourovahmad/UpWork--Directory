<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">

    <!------------------LIght BOx for Gallery-------------->
    <link rel="stylesheet" href="{{ asset('css/lightBox.min.css') }}">
    <script type="text/javascript" src="{{ asset('js/lightBox.js') }}"></script>

    <!------------------LIght BOx for Gallery-------------->

    <title>Find Your Perfect</title>
</head>
<body>


    <!-------------------------------NAvigation Starts------------------>

    <nav class="navbar navbar-expand-md navbar-dark mb-4" style="background-color:#3097D1">
        <a href="{{ route('home') }}" class="navbar-brand"><img src="{{ asset('images/'.auth()->user()->image_file) }}" alt="logo" class="img-fluid" width="65px" height="55px" style="border-radius: 53px"></a>

        <button class="navbar-toggler" data-toggle="collapse" data-target="#responsive"><span class="navbar-toggler-icon"></span></button>


        <div class="collapse navbar-collapse" id="responsive">
            <ul class="navbar-nav mr-auto text-capitalize">
                <li class="nav-item"><a href="index.html" class="nav-link active">home</a></li>
                {{--
                <li class="nav-item"><a href="profile.html" class="nav-link">profile</a></li>
                <li class="nav-item"><a href="#modalview" class="nav-link" data-toggle="modal">messages</a></li>
                <li class="nav-item"><a href="notification.html" class="nav-link">docs</a></li>
                <li class="nav-item"><a href="#" class="nav-link d-md-none">growl</a></li>
                <li class="nav-item"><a href="#" class="nav-link d-md-none">logout</a></li> --}}

            </ul>

            <form action="" class="form-inline ml-auto d-none d-md-block">
                <input type="text" name="search" id="search" placeholder="Search" class="form-control form-control-sm">
            </form>
            <a href="{{ route('home') }}" class="text-decoration-none" style="color:#CBE4F2;font-size:22px;"><i class="far fa-bell ml-3 d-none d-md-block"></i></a>
            <img src="{{ asset('images/'.auth()->user()->image_file) }}" alt="" class="rounded-circle ml-3 d-none d-md-block" width="32px" height="32px">

        </div>

    </nav>

    <!---------------------------------------------Ends navigation------------------------------>





    <!-------------------------------------------Start Grids layout for lg-xl-3 columns and (xs-lg 1 columns)--------------------------------->


    <div class="container">
        <div class="row">


            <!--------------------------left columns  start-->

            <div class="col-12 col-lg-3">

                <div class="left-column">


                    <div class="card card-left1 mb-4">
                        <div class="card-body text-center ">
                            <img src="{{ asset('images/'.auth()->user()->image_file) }}" alt="img" width="120px" height="120px" class="rounded-circle mt-n5">
                            <h5 class="card-title">{{ auth()->user()->name }}</h5>
                            <p class="card-text text-justify mb-2">{{ auth()->user()->address }}</p>


                        </div>




                    </div>


                    <div class="card shadow-sm card-left2 mb-4">

                        <div class="card-body">

                            <h5 class="mb-3 card-title">About </h5>

                            {{-- <p class="card-text"> <i class="fas fa-calendar-week mr-2"></i> Went to  <a href="#" class="text-decoration-none">{{ auth()->user()->address }} </a></p> --}}

                            <p class="card-text"> <i class="far fa-building mr-2"></i> Work at <a href="#" class="text-decoration-none">{{ auth()->user()->bussiness_and_company_name }}</a></p>
                            <p class="card-text"> <i class="fas fa-home mr-2"></i> Live in <a href="#" class="text-decoration-none">{{ auth()->user()->address }}</a></p>
                            <p class="card-text"> <i class="fas fa-map-marker mr-2"></i> Designation <a href="#" class="text-decoration-none">{{ auth()->user()->designation }}</a></p>
                            <p class="card-text"> <i class="fas fa-map-marker mr-2"></i> Gender <a href="#" class="text-decoration-none">{{ auth()->user()->gender }}</a></p>
                            <p class="card-text"> <i class="fas fa-map-marker mr-2"></i> Marital Status <a href="#" class="text-decoration-none">{{ auth()->user()->marital_status }}</a></p>




                        </div>


                        <div class="text-center mb-3">
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="btn btn-outline-info card-link btn-sm">Logout</a>


                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                        </div>

                    </div>



                </div>





            </div>








            <!--------------------------Ends Left columns-->





            <!---------------------------------------Middle columns  start---------------->




            <div class="col-12 col-lg-6" style="height: 100vh; overflow-y:scroll;">


                <div class="middle-column">


                    <div class="card">


                        <div class="card-header bg-transparent">
                          
                        </div>

                  @forelse ($users as $user)
                      

                        <div class="card-body">
                            <div class="media">

                                <div class="container mb-2 p-2 d-flex justify-content-center">
                                    <div class="card_user_profile p-4">
                                       <div class="user_card_image d-flex flex-column justify-content-center align-items-center">
                                          <button class="btn_user_card btn-secondary"> 
                                            <img src="{{ asset('images/'.$user->image_file) }}" height="100" width="100" style="border-radius: 45px" />
                                            {{-- <img src="{{ asset('images/user_1.png') }}" height="100" width="100" style="border-radius: 45px" /> --}}
                                            </button> <span class="name mt-3">{{ $user->name }}</span> 
                                            
                                          {{-- <div class="d-flex mt-2"> <button class="btn1 btn-dark">View Profile</button> </div> --}}


                                          <div class="text mt-3"> <span>{{ $user->name }} Pena is a {{ $user->designation }} of  {{ $user->bussiness_and_company_name }}<br><br> Located At {{ $user->address }} </span> </div>

                                          <div class="gap-3 mt-3 icons d-flex flex-row justify-content-center align-items-center">

                                            <a href="{{ $user->facebook }}"><span class="m-2 p-2"><i class="fa fa-facebook-f"></i></span> </a>
                                             <a href="{{ $user->insta }}"><span class="m-2 p-2"><i class="fa fa-instagram"></i></span> </a>
                                            </div>

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



                                <div class="text-center m-2">
                                    <button class="btn btn-outline-success card-link btn-sm" type="submit">Apply</button>
                                </div>
                             


                            </form>
                        </div>

                    </div>


                </div>


            </div>





        </div>










        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>


       

</body>
</html>
