<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Crud Panel - Dashboard</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Font Awesome -->
        <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" type="text/css">

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('crud_panel/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('crud_panel/css/dashboard.min.css') }}" rel="stylesheet">
    </head>
    <body>
      <div id="app">
          <main>
              <!-- Navigation -->
              <nav class="navbar navbar-expand-md navbar-light bg-gradient-primary navbar-laravel">
                  <div class="container">
                      <a class="navbar-brand text-white" href="">Crud Panel</a>
                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                          <span class="navbar-toggler-icon"></span>
                      </button>

                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <!-- Left Side Of Navbar -->
                          <ul class="navbar-nav mr-auto"></ul>
                      </div>
                  </div>
              </nav>

              <div class="float-left" style="padding-top:2px;">
                  <!-- Sidebar -->
                  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="padding-top:5px;">
                      <!-- Sidebar - Brand -->
                      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                          <div class="sidebar-brand-icon">
                          <i class="fas fa-book-reader"></i>
                          </div>
                          <div class="sidebar-brand-text mx-3">Crud Panel</div>
                      </a>
                      <!-- Divider -->
                      <hr class="sidebar-divider my-0">

                      <!-- Nav Item - Dashboard -->
                      <li class="nav-item active">
                          <a class="nav-link" href="{{ url('/dashboard') }}">
                          <i class="fas fa-columns"></i>
                          <span>Dashboard</span></a>
                      </li>

                      <!-- Divider -->
                      <hr class="sidebar-divider">

                      <!-- Heading -->
                      <div class="sidebar-heading">Options</div>

                      <!-- Nav Item - Pages Collapse Menu -->
                      <li class="nav-item">
                          <a class="nav-link collapsed" href="{{ url('crudpanel/models') }}" >
                            <i class="fas fa-book"></i>
                            <span>Models</span>
                          </a>
                      </li>

                      <!-- Nav Item - Utilities Collapse Menu -->
                      <li class="nav-item">
                          <a class="nav-link collapsed" href="{{ url('/authors') }}" >
                              <i class="fas fa-pen-nib"></i>
                              <span>Migrations</span>
                          </a>
                      </li>

                      <!-- Nav Item - Utilities Collapse Menu -->
                      <li class="nav-item">
                          <a class="nav-link collapsed" href="{{ url('/borrowers') }}" >
                              <i class="fas fa-user-edit"></i>
                              <span>Controllers</span>
                          </a>
                      </li>
                  </ul>
              </div>
              <!-- End of Sidebar -->

              <div>
                <div class="container">
                    <div class="d-none alert alert-primary" id="alert_section" name="alert_section" role="alert"></div>
                    <div class="d-none alert alert-danger" id="alert_danger_section" name="alert_danger_section" role="alert"></div>
                    <div class="row" style="padding-top:10px;">

                    <!-- Models List -->
                    <div class="col-md-3">
                        <div class="list-group" >
                            <h3>Models</h3>
                            {{-- @foreach($books as $book)
                            <button type="button" data-bookid="{{ $book->id }}" name="book_row" class="list-group-item list-group-item-action">{{ $book->title }}</button>
                            @endforeach --}}
                            <div class="btn-group" role="group" aria-label="Basic example" style="padding-top:5px;">
                                <button type="button" class="btn btn-success" id="btn_new_model" data-toggle="modal" data-target="#model_form">Add </button>
                                <button type="button" class="btn btn-secondary"  id="btn_edit_model">Edit</button>
                                <button type="button" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>

                    <!-- Borrowers List -->
                    <div class="col-md-3">
                        <div class="list-group" >
                            <h3>Controllers</h3>
                            {{-- @foreach($borrowers as $borrower)
                            <button type="button" data-borrowerid="{{ $borrower->id }}" name="borrower_row" class="list-group-item list-group-item-action">{{ $borrower->lastname.' '.$borrower->firstname }}</button>
                            @endforeach --}}
                            <div class="btn-group" role="group" aria-label="Basic example" style="padding-top:5px;">
                                <button type="button" class="btn btn-success" id="btn_new_controller" data-toggle="modal" data-target="#controller_form">Add </button>
                                <button type="button" class="btn btn-secondary" id="btn_edit_controller">Edit</button>
                                <button type="button" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>

                    <!-- Authors List -->
                    <div class="col-md-3">
                        <div class="list-group" >
                            <h3>Migrations</h3>
                            {{-- @foreach( $authors->slice(0, 5) as $author )
                            <button type="button" name="author_row" data-authorid="{{ $author->id }}" class="list-group-item list-group-item-action">{{ $author->lastname.' '.$author->firstname }}</button>
                            @endforeach --}}
                            <div class="btn-group" role="group" aria-label="Basic example" style="padding-top:5px;">
                                <button type="button" class="btn btn-success" id="btn_new_migration" data-toggle="modal" data-target="#migration_form">Add </button>
                                <button type="button" class="btn btn-secondary"  id="btn_edit_migration">Edit</button>
                                <button type="button" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
              </div>


          </main>
      </div>
    </body>

    <!-- Forms -->
    <div class="modal" tabindex="-1" role="dialog" id="model_form">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Model Form</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="alert alert-danger" style="display:none"></div>
                <form action="" method="post">
                    <div class="modal-body">
                        <!-- Model Name -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="min-width: 100px;" id="inputGroup-sizing-default">Model Name</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="cp_model_name" id="cp_model_name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="btn_save_model" id="btn_save_model">Save Model</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="hidden" name="model_token" value="{{ csrf_token() }}">
                    </div>
                </form>
            </div>
        </div>
    </div>

      <script>
            $(document).ready(function() {

                $("button[name=btn_save_model]").click(function(event){
                    event.preventDefault();

                    var el_model_form = $('#model_form');
                    var el_alert_section = $('#alert_section');
                    var el_alert_danger_section = $('#alert_danger_section');
                    var model_name = $('input[name=cp_model_name]').val();
                    var _token = $('[name=_token]').val();

                    jQuery.ajax({
                        url: "model/create",
                        method: 'post',
                        data: { _token: _token, model_name: model_name },
                        success: function(response)
                        {
                            el_model_form.modal('hide');

                            el_alert_section.html(response.message);
                            el_alert_section.removeClass('d-none');
                        },
                        error: function (response)
                        {
                            el_model_form.modal('hide');

                            el_alert_danger_section.html(response.message);
                            el_alert_danger_section.removeClass('d-none');
                        }
                    });

                });

            });

        </script>
</html>