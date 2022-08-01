@extends('admin.master')



@section('content')
    <main id="main" class="main">

        <div class="pagetitle d-flex justify-content-between">
            <h1>Faqs</h1>
            <button type="button" class="btn btn-sm btn-success btn-lg me-4 ps-3 pe-3" data-bs-toggle="modal" data-bs-target="#create_faq"> Add </button>


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
                                                <th scope="col">faq</th>
                                                <th scope="col">Answer</th>

                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($faqs as $faqData)

                                            <tr>

                                                <td> <span class="text-primary fw-bold">{{ $faqData->title }}</span> </td>
                                                <td> <span class="text-primary fw-bold">{{ $faqData->ans }}</span> </td>



                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-success faqeditButton" data-id="{{ $faqData->id }}"> edit </button>
                                                    <button type="button" class="btn btn-sm btn-outline-danger faqdeleteButton" data-id="{{ $faqData->id }}">delete </button>



                                                </td>
                                            </tr>

                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>


                            </div>
                        </div><!-- End Top Selling -->

                    </div>
                </div><!-- End Left side columns -->

            </div>
        </section>

       


        <div class="modal fade" id="create_faq" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add faq</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="{{ route('faq-store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" name="title" placeholder="faq tilte" id="title" required>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="title">Answer</label>
                                        <input type="text" class="form-control" name="ans" placeholder="faq ans" id="title" required>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>






    </main><!-- End #main -->
    @endsection


    @section('script')

    <script>
        $(document).ready(function() {

            $('.faqeditButton').on('click', function() {

                const allFaqs = @json($faqs);
                const selectedId = $(this).attr('data-id');
                const single = allFaqs.find(f => f.id == selectedId);

                elementFinder('faq_hidden_id').value = selectedId;
                elementFinder('edit_faq_title').value = single.title;
                elementFinder('edit_faq_ans').value = single.ans;


                const faqeditmodal = new bootstrap.Modal(document.getElementById('edit_faq_modal'), {});
                faqeditmodal.show();



            });



            $('.faqdeleteButton').on('click', function() {
                if (confirm("Are You Sure!")) {
                    const selectedId = $(this).attr('data-id');
                    elementFinder('delete_faq_id').value = selectedId;

                    elementFinder('delete_faq_button').click();


                } else {
                    $(this).preventDefault();
                }

            });


            function elementFinder(id) {
                return document.getElementById(id);
            }
        });

    </script>

    @endsection




