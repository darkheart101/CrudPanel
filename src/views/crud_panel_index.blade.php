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

                    <!-- Models List -->
                    <div class="col-md-3">
                        <div class="list-group" >
                            <h3>Models</h3>
                            @foreach($modelFiles as $model)
                                <div name="ModelFileName" id="{{ $model->ModelFileId }}">
                                    {{ $model->ModelFileName }}
                                </div>
                            @endforeach
                            <div class="btn-group" role="group" aria-label="Basic example" style="padding-top:5px;">
                                <button type="button"
                                        class="btn btn-success"
                                        id="btn_new_model"
                                        data-toggle="modal"
                                        data-target="#model_form"
                                >Add </button>
                                <button type="button" class="btn btn-danger" name="btn_model_delete">Delete</button>
                            </div>
                        </div>
                    </div>

                    <!-- Controllers List -->
                    <div class="col-md-3">
                        <div class="list-group" >
                            <h3>Controllers</h3>
                            @foreach($controllerFiles as $controller_file)
                                <div name="controllerFileFilename" id="{{ $controller_file->ControllerFileId }}">
                                    {{ $controller_file->ControllerFileFilename }}
                                </div>
                            @endforeach
                            <div class="btn-group" role="group" aria-label="Basic example" style="padding-top:5px;">
                                <button type="button"
                                        class="btn btn-success"
                                        id="btn_new_controller"
                                        data-toggle="modal"
                                        data-target="#controller_form">Add
                                </button>
                                <button type="button" name="btn_controller_delete" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>

                    <!-- Migrations List -->
                    <div class="col-md-3">
                        <div class="list-group" >
                            <h3>Migrations</h3>
                            @foreach($migrationFiles as $migration_file)
                                <div name="MigrationFileName" id="{{$migration_file->MigrationFileId}}">
                                    {{ $migration_file->MigrationFileName }}
                                </div>
                            @endforeach
                            <div class="btn-group" role="group" aria-label="Basic example" style="padding-top:5px;">
                                <button type="button"
                                        class="btn btn-success"
                                        id="btn_new_migration"
                                        data-toggle="modal"
                                        data-target="#migration_form">Add
                                </button>
                                <button type="button" class="btn btn-secondary"  name="btn_edit_migration">Edit</button>
                                <button type="button" class="btn btn-danger" name="btn_delete_migration">Delete</button>
                            </div>
                        </div>
                    </div>
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

    <!-- Controller Form -->
    <div class="modal" tabindex="-1" role="dialog" id="controller_form">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Controller Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="alert alert-danger" style="display:none"></div>
                <form action="" method="post">
                    <div class="modal-body">
                        <!--  Controller Name -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"
                                      style="min-width: 100px;"
                                      id="inputGroup-sizing-default">Controller Name
                                </span>
                            </div>
                            <input type="text"
                                   class="form-control"
                                   aria-label="Default"
                                   aria-describedby="inputGroup-sizing-default"
                                   name="cp_controller_name"
                                   id="cp_controller_name"
                            >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="btn_save_controller" id="btn_save_migration">Create Controller</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="hidden" name="migration_token" value="{{ csrf_token() }}">
                    </div>
                </form>
            </div>
        </div>
    </div>

      <script>
            $(document).ready(function() {

                var migration_id_selected = 0;
                var model_id_selected = 0;
                var controller_id_selected = 0;

                // Models
                $("button[name=btn_save_model]").click(function(event){
                    event.preventDefault();

                    var el_model_form = $('#model_form');
                    var el_alert_section = $('#alert_section');
                    var el_alert_danger_section = $('#alert_danger_section');
                    var model_name = $('input[name=cp_model_name]').val();

                    var el_migration = $('input[name=chk_migration]')
                    var create_migration = 0
                    if(el_migration.is(":checked")) create_migration = 1;

                    var el_controller = $('input[name=chk_controller]')
                    var create_controller = 0
                    if(el_controller.is(":checked")) create_controller = 1;

                    $.ajaxSetup({
                        headers:
                        {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    jQuery.ajax({
                        url: "crudpanel/model/create",
                        method: 'post',
                        data:
                        {
                            model_name: model_name,
                            create_migration: create_migration,
                            create_controller: create_controller
                        },
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

                $("button[name=btn_model_delete]").click(function(event){
                    event.preventDefault();
                    if(model_id_selected == 0) return;
                    $.ajaxSetup({
                        headers:
                            {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                    });

                    jQuery.ajax({
                        url: "crudpanel/model/delete",
                        method: 'post',
                        data:
                            {
                                ModelFileId: model_id_selected,
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


                $('[name=ModelFileName]').click(function () {
                    $('[name=ModelFileName]').removeClass('font-weight-bold');
                    $(this).addClass('font-weight-bold');
                    model_id_selected = $(this).attr('id');
                });

                // Controllers
                $('[name=controllerFileFilename]').click(function () {
                    $('[name=controllerFileFilename]').removeClass('font-weight-bold');
                    $(this).addClass('font-weight-bold');
                    controller_id_selected = $(this).attr('id');
                });


                $("button[name=btn_save_controller]").click(function(event) {
                    event.preventDefault();
                    var controller_name = $('input[name=cp_controller_name]').val();

                    $.ajaxSetup({
                        headers:
                            {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                    });

                    jQuery.ajax({
                        url: "crudpanel/controller/create",
                        method: 'post',
                        data:
                            {
                                ControllerName: controller_name,
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

                $('button[name=btn_controller_delete]').click(function (event) {
                    event.preventDefault();
                    if(controller_id_selected == 0) return;

                    $.ajaxSetup({
                        headers:
                            {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                    });

                    jQuery.ajax({
                        url: "crudpanel/controller/delete",
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


                // Migrations
                $("button[name=btn_save_migration]").click(function(event){
                    event.preventDefault();

                    var migration_name = $('input[name=cp_migration_table_name]').val();

                    $.ajaxSetup({
                        headers:
                        {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    jQuery.ajax({
                        url: "crudpanel/migration/create",
                        method: 'post',
                        data:
                        {
                            table_name: migration_name,
                        },
                        success: function(response)
                        {
                            console.log(response.data.MigrationFileId);
                            open_migration_editor(response.data.MigrationFileId);
                        },
                        error: function (response)
                        {
                            el_model_form.modal('hide');

                            el_alert_danger_section.html(response.message);
                            el_alert_danger_section.removeClass('d-none');
                        }
                    });
                });

                $('button[name=btn_delete_migration]').click(function (event) {
                    event.preventDefault();
                    if(migration_id_selected == 0) return;

                    $.ajaxSetup({
                        headers:
                            {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                    });

                    jQuery.ajax({
                        url: "crudpanel/migration/delete",
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

                $('[name=MigrationFileName]').click(function () {
                    $('[name=MigrationFileName]').removeClass('font-weight-bold');
                    $(this).addClass('font-weight-bold');
                    migration_id_selected = $(this).attr('id');
                });

                $('button[name=btn_edit_migration]').click(function () {
                    if(migration_id_selected == 0) return;

                    open_migration_editor(migration_id_selected);
                });

                function open_migration_editor( migration_file_id)
                {
                    let url = "crudpanel/migration/editor?migration_file_id=";
                    url = url+migration_file_id;
                    window.location.href = url;

                }
            });

        </script>
</html>
