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

                    <!-- Migration Files List -->
                    <h3>Migration Files</h3>
                    <table width="100%">
                        <tr>
                            <th><b>Migration File</b></th>
                            <th><b>Migration Table</b></th>
                            <th><b>Created</b></th>
                            <th><b>Updated</b></th>
                            <th><b> - </b></th>
                            <th><b> - </b></th>
                        </tr>
                        @foreach($migration_files as $migration_file)
                            <tr>
                                <td>{{ $migration_file->MigrationFileName }}</td>
                                <td>{{ $migration_file->MigrationTable }}</td>
                                <td>{{ $migration_file->created_at }}</td>
                                <td>{{ $migration_file->updated_at }}</td>
                                <td>
                                    <button type="submit"
                                            class="btn btn-secondary"
                                            name="btn_edit_migration"
                                            id={{ $migration_file->MigrationFileId }}
                                    >Edit</button>
                                </td>
                                <td>
                                    <button type="submit"
                                            class="btn btn-danger"
                                            name="btn_delete_migration"
                                            id={{ $migration_file->MigrationFileId }}
                                    >Delete</button>
                                </td>
                            </tr>
                        @endforeach
                        </table>
              </div>


          </main>
      </div>
    </body>

    <!-- Forms -->

    <!-- Model Form -->
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
                                <span class="input-group-text"
                                      style="min-width: 100px;"
                                      id="inputGroup-sizing-default">Model Name
                                </span>
                            </div>
                            <input type="text"
                                   class="form-control"
                                   aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default"
                                   name="cp_model_name"
                                   id="cp_model_name"
                            >
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="chk_migration" name="chk_migration">
                            <label class="form-check-label" for="chk_migration">create migration </label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="chk_controller" name="chk_controller">
                            <label class="form-check-label" for="chk_controller">create controller </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="btn_save_model" id="btn_save_model">Save Model</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Migration Form -->
    <div class="modal" tabindex="-1" role="dialog" id="migration_form">
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
                        <!--  Migration Table Name -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"
                                      style="min-width: 100px;"
                                      id="inputGroup-sizing-default">Table Name
                                </span>
                            </div>
                            <input type="text"
                                   class="form-control"
                                   aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default"
                                   name="cp_migration_table_name"
                                   id="cp_migration_table_name"
                            >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="btn_save_migration" id="btn_save_migration">Create Migration File</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="hidden" name="migration_token" value="{{ csrf_token() }}">
                    </div>
                </form>
            </div>
        </div>
    </div>

      <script>
            $(document).ready(function() {

                $('button[name=btn_edit_migration]').click(function () {
                    var migration_id_selected = $(this).attr('id');
                    if(migration_id_selected == 0) return;

                    open_migration_editor(migration_id_selected);
                });

                $('button[name=btn_delete_migration]').click(function (event) {
                    event.preventDefault();
                    var migration_id_selected = $(this).attr('id');
                    if(migration_id_selected == 0) return;

                    $.ajaxSetup({
                        headers:
                            {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                    });

                    jQuery.ajax({
                        url: "/crudpanel/migration/delete",
                        method: 'post',
                        data:
                            {
                                MigrationFileId: migration_id_selected,
                            },
                        success: function(response)
                        {
                            location.reload();
                        },
                        error: function (response)
                        {
                            alert(response.responseText);
                        }
                    });
                });

                function open_migration_editor( migration_file_id)
                {
                    let url = "/crudpanel/migration/editor?migration_file_id=";
                    url = url+migration_file_id;
                    window.location.href = url;
                }

            });

        </script>
</html>
