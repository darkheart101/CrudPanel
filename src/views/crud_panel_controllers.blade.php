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
        <link href="{{ asset('crud_panel/css/all.min.css') }}" rel="stylesheet" type="text/css">

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('crud_panel/css/dashboard.min.css') }}" rel="stylesheet">
    </head>
    <body>
      <div id="app">
          <main>
              <!-- Navigation -->
              <nav class="navbar navbar-expand-md navbar-light bg-gradient-primary navbar-laravel">
                  <div class="container">
                      <a class="navbar-brand text-white" href="">Crud Panel</a>
                      <button class="navbar-toggler" type="button"
                              data-toggle="collapse"
                              data-target="#navbarSupportedContent"
                              aria-controls="navbarSupportedContent"
                              aria-expanded="false" aria-label="{{ __('Toggle navigation') }}"
                      >
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
                  <ul class="navbar-nav
                             bg-gradient-primary
                             sidebar
                             sidebar-dark
                             accordion"
                      id="accordionSidebar"
                      style="padding-top:5px;"
                  >
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
                          <a class="nav-link" href="{{ url('/crudpanel') }}">
                              <i class="fas fa-columns"></i>
                              <span>Dashboard</span></a>
                      </li>

                      <!-- Divider -->
                      <hr class="sidebar-divider">

                      <!-- Heading -->
                      <div class="sidebar-heading">Options</div>

                      <!-- Nav Item - Pages Collapse Menu -->
                      <li class="nav-item">
                          <a class="nav-link collapsed" href="{{ url('crudpanel/model/list') }}" >
                              <i class="fas fa-book"></i>
                              <span>Models</span>
                          </a>
                      </li>

                      <!-- Nav Item - Utilities Collapse Menu -->
                      <li class="nav-item">
                          <a class="nav-link collapsed" href="{{ url('/crudpanel/migration/list') }}" >
                              <i class="fas fa-pen-nib"></i>
                              <span>Migrations</span>
                          </a>
                      </li>

                      <!-- Nav Item - Utilities Collapse Menu -->
                      <li class="nav-item">
                          <a class="nav-link collapsed" href="{{ url('/crudpanel/controller/list') }}" >
                              <i class="fas fa-user-edit"></i>
                              <span>Controllers</span>
                          </a>
                      </li>
                  </ul>
              </div>
              <!-- End of Sidebar -->

              <div>
                <div class="container">
                    <div class="d-none alert alert-primary"
                         id="alert_section"
                         name="alert_section"
                         role="alert">
                    </div>
                    <div class="d-none alert alert-danger"
                         id="alert_danger_section"
                         name="alert_danger_section"
                         role="alert">
                    </div>
                    <div class="row" style="padding-top:10px;">

                    <!-- Controller Files List -->
                    <h3>Controller Files</h3>
                    <table width="100%">
                        <tr>
                            <th><b>Controller Filename</b></th>
                            <th><b>Created</b></th>
                            <th><b>Updated</b></th>
                            <th><b> - </b></th>
                        </tr>
                        @foreach($controllerFiles as $controller)
                            <td>{{ $controller->ControllerFileFilename }}</td>
                            <td>{{ $controller->created_at }}</td>
                            <td>{{ $controller->updated_at }}</td>
                            <td>
                                <button type="submit"
                                        class="btn btn-danger"
                                        name="btn_delete_controller"
                                        id={{ $controller->ControllerFileId }}
                                >Delete Controller</button>
                            </td>
                        @endforeach
                        </table>
              </div>


          </main>
      </div>
    </body>

      <script>
            $(document).ready(function() {

                $('button[name=btn_delete_controller]').click(function (event) {
                    event.preventDefault();
                    var controller_id_selected = $(this).attr('id');
                    if(controller_id_selected == 0) return;

                    $.ajaxSetup({
                        headers:
                            {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                    });

                    jQuery.ajax({
                        url: "/crudpanel/controller/delete",
                        method: 'post',
                        data:
                            {
                                ControllerFileId: controller_id_selected,
                            },
                        success: function(response)
                        {
                            location.reload();
                        },
                        error: function (response)
                        {
                            location.reload();
                        }
                    });
                });

            });

        </script>
</html>
