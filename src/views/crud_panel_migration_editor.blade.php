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
                    @if($migrated == true)
                        <div class="alert alert-danger"
                             id="alert_section"
                             name="alert_section"
                             role="alert">Cannot be edited - Already Migrated
                        </div>
                    @endif
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
                        <h1>Migration Editor</h1>
                    </div>
                    <div class="row" style="padding-top:10px;">
                        <h5><b>Migration file:</b> </h5>&nbsp;{{ $migration_record->MigrationFileName }}
                    </div>
                    <div class="row" style="padding-top:10px;">
                        <h5><b>Migration table:</b> </h5>&nbsp;{{ $migration_record->MigrationTable }}
                    </div>
                    @if($migrated == false)
                        <div class="row" style="padding-top:10px;margin-bottom:20px;">
                            <button type="submit"
                                    class="btn btn-success"
                                    name="btn_new_field"
                                    id="btn_new_field"
                                    data-toggle="modal"
                                    data-target="#field_form"
                            >Add Field</button>
                        </div>
                    @endif
                    <h3>Table Fields</h3>
                    <table border="1" width="100%">
                        <tr>
                            <th>
                                <b>Filed Name</b>
                            </th>
                            <th>
                                <b>Filed Type</b>
                            </th>
                            <th>
                                <b>Action</b>
                            </th>
                        </tr>
                        @foreach ($tableFieldList as $table_field_record)
                            <tr>
                                <td>{{$table_field_record->TableFieldName}}</td>
                                <td>{{$table_field_record->TableFieldType}}</td>
                                <td>
                                    @if($migrated == false)
                                        <button type="submit"
                                                class="btn btn-primary"
                                                name="btn_edit_field"
                                                id={{ $table_field_record->TableFieldId }}
                                                data-toggle="modal"
                                                data-target="#field_form"
                                        >Edit Field</button>
                                        <button type="submit"
                                                class="btn btn-danger"
                                                name="btn_delete_field"
                                                id={{ $table_field_record->TableFieldId }}
                                        >Delete Field</button>
                                    @endif
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
    <div class="modal" tabindex="-1" role="dialog" id="field_form">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Table Field</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="alert alert-danger" style="display:none"></div>
                <form action="" method="post">
                    <div class="modal-body">
                        <!-- Field Name -->
                        <input type="text"
                            class="d-none form-control"
                            aria-label="Default"
                            aria-describedby="inputGroup-sizing-default"
                            name="migration_file_id"
                            id="migration_file_id"
                            value="{{ $migration_record->MigrationFileId }}"
                        >
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"
                                    style="min-width: 100px;"
                                    id="inputGroup-sizing-default">Field Name
                                </span>
                            </div>
                            <input type="text"
                                class="form-control"
                                aria-label="Default"
                                aria-describedby="inputGroup-sizing-default"
                                name="field_name"
                                id="field_name"
                            >
                        </div>

                        <div class="form-group mb-3">
                            <label for="field_type">Field Type:</label>
                            <select class="form-control" id="field_type">
                                <option id='bigIncrements'>bigIncrements</option>
                                <option id='bigInteger'>bigInteger</option>
                                <option id='binary'>binary</option>
                                <option id='boolean'>boolean</option>
                                <option id='char'>char</option>
                                <option id='date'>date</option>
                                <option id='dateTime'>dateTime</option>
                                <option id='dateTimeTz'>dateTimeTz</option>
                                <option id='decimal'>decimal</option>
                                <option id='double'>double</option>
                                <option id='enum'>enum</option>
                                <option id='enum'>enum</option>
                                <option id='float'>float</option>
                                <option id='geometry'>geometry</option>
                                <option id='geometryCollection'>geometryCollection</option>
                                <option id='increments'>increments</option>
                                <option id='integer'>integer</option>
                                <option id='ipAddress'>ipAddress</option>
                                <option id='json'>json</option>
                                <option id='jsonb'>jsonb</option>
                                <option id='lineString'>lineString</option>
                                <option id='longText'>longText</option>
                                <option id='macAddress'>macAddress</option>
                                <option id='mediumIncrements'>mediumIncrements</option>
                                <option id='mediumInteger'>mediumInteger</option>
                                <option id='mediumText'>mediumText</option>
                                <option id='morphs'>morphs</option>
                                <option id='uuidMorphs'>uuidMorphs</option>
                                <option id='multiLineString'>multiLineString</option>
                                <option id='multiPoint'>multiPoint</option>
                                <option id='multiPolygon'>multiPolygon</option>
                                <option id='nullableMorphs'>nullableMorphs</option>
                                <option id='nullableUuidMorphs'>nullableUuidMorphs</option>
                                <option id='nullableTimestamps'>nullableTimestamps</option>
                                <option id='polygon'>polygon</option>
                                <option id='point'>point</option>
                                <option id='rememberToken'>rememberToken</option>
                                <option id='smallIncrements'>smallIncrements</option>
                                <option id='smallInteger'>smallInteger</option>
                                <option id='softDeletes'>softDeletes</option>
                                <option id='softDeletesTz'>softDeletesTz</option>
                                <option id='string'>string</option>
                                <option id='text'>text</option>
                                <option id='time'>time</option>
                                <option id='timeTz'>timeTz</option>
                                <option id='timestamp'>timestamp</option>
                                <option id='timestampTz'>timestampTz</option>
                                <option id='timestamps'>timestamps</option>
                                <option id='timestampsTz'>timestampsTz</option>
                                <option id='tinyIncrements'>tinyIncrements</option>
                                <option id='tinyInteger'>tinyInteger</option>
                                <option id='unsignedBigInteger'>unsignedBigInteger</option>
                                <option id='unsignedDecimal'>unsignedDecimal</option>
                                <option id='unsignedInteger'>unsignedInteger</option>
                                <option id='unsignedMediumInteger'>unsignedMediumInteger</option>
                                <option id='unsignedSmallInteger'>unsignedSmallInteger</option>
                                <option id='unsignedTinyInteger'>unsignedTinyInteger</option>
                                <option id='uuid'>uuid</option>
                                <option id='year'>year</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="btn_save_field" id="btn_save_field">Save Field</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            /**
             * create new field
             */
            $("button[name=btn_save_field]").click(function(event){
                event.preventDefault();

                var el_field_form = $('#field_form');
                var field_name = $('input[name=field_name]').val();
                var migration_file_id = $('input[name=migration_file_id]').val();
                var field_type = $("#field_type").find('option:selected').attr('id');

                var getUrl = window.location;
                var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

                $.ajaxSetup({
                    headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                jQuery.ajax({
                    url: baseUrl + "/tablefields/create",
                    method: 'post',
                    data:
                    {
                        field_name: field_name,
                        field_type: field_type,
                        migration_file_id: migration_file_id,
                    },
                    success: function(response)
                    {
                        window.location.href = "/crudpanel/migration/editor?migration_file_id="+migration_file_id;
                    },
                    error: function (response)
                    {
                        el_model_form.modal('hide');

                        el_alert_danger_section.html(response.message);
                        el_alert_danger_section.removeClass('d-none');
                    }
                });

            });


            /**
             * delete field
             */
            $("button[name=btn_delete_field]").click(function(event){
                event.preventDefault();

                var TableFieldId = $(this).attr('id');

                var getUrl = window.location;
                var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];

                $.ajaxSetup({
                    headers:
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                jQuery.ajax({
                    url: baseUrl + "/tablefields/delete/" + TableFieldId,
                    method: 'delete',
                    success: function(response)
                    {
                        location.reload();
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
