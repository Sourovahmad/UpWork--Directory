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


    


<nav class="mb-4 navbar navbar-expand-lg navbar-dark bg-dark cyan">
    <a class="navbar-brand font-bold text-light">Your Website Title</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSuapportedContent-4">
        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown" style="cursor: pointer">
                <a class="nav-link dropdown-toggle text-light" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user text-light"></i> Profile </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-cyan" aria-labelledby="navbarDropdownMenuLink-4">
                    <a class="dropdown-item" href="#">Change Password</a>
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
