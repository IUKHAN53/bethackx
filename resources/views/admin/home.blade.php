@extends('layouts.app')

@section('content')
    <div class="header-large-title bg-primary text-center">
        <h4 class="subtitle">altere as informações e depois clique em salvar!</h4>
    </div>

    <div class="section full mt-3">

        <div class="wide-block pt-2 pb-2">
            <ul class="nav nav-tabs capsuled" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="true">
                        <ion-icon name="home"></ion-icon>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#users" role="tab" aria-selected="false">
                        <ion-icon name="person-circle"></ion-icon>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#company" role="tab" aria-selected="false">
                        <ion-icon name="briefcase-outline"></ion-icon>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#plans" role="tab" aria-selected="false">
                        <ion-icon name="pricetags-outline"></ion-icon>
                    </a>
                </li>
            </ul>
            <div class="tab-content mt-2">
                @include('admin.partials.tab-home')
                @include('admin.partials.tab-users')
                @include('admin.partials.tab-company')
                @include('admin.partials.tab-plans')
            </div>
            <!-- Dialog Form -->
            <div class="modal fade dialogbox" id="create_edit_user_modal" data-bs-backdrop="static" tabindex="-1"
                 role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cadastrar usuário</h5>
                        </div>
                        <form action="{{route('admin.add-user',$current_company->slug)}}" method="POST">
                            @csrf
                            <div class="modal-body text-start mb-2">
                                <div class="form-group boxed">
                                    <div class="input-wrapper">
                                        <input type="name" class="form-control login-input-control" id="name"
                                               placeholder="Name">
                                        <i class="clear-input">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </i>
                                    </div>
                                </div>
                                <div class="form-group boxed">
                                    <div class="input-wrapper">
                                        <input type="email" class="form-control login-input-control" id="email"
                                               placeholder="E-mail">
                                        <i class="clear-input">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </i>
                                    </div>
                                </div>

                                <div class="form-group boxed">
                                    <div class="input-wrapper">
                                        <input type="password" class="form-control login-input-control" id="password"
                                               placeholder="Password">
                                        <i class="clear-input">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </i>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="btn-inline">
                                    <button type="button" class="btn btn-text-secondary" data-bs-dismiss="modal">CLOSE
                                    </button>
                                    <button type="button" class="btn btn-text-primary" id="save-user"
                                            data-bs-dismiss="modal">Salvar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="module">

        $('#user_plan_form').submit(function (event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: '{{ route("admin.add-plan-to-user", $current_company->slug) }}',
                method: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (response) {
                    alert('Plans saved successfully!');
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });


        window.fetchCurrentUserPlans = function (id) {
            let _token = $('input[name=_token]').val();
            $.ajax({
                url: "{{route('admin.fetch-plans',$current_company->slug)}}",
                type: "POST",
                data: {
                    id: id,
                    _token: _token
                },
                success: function (response) {
                    $('#user_plans').html(response.html)
                }
            })
        }
        $('#plan_form').submit(function (event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: '{{ route("admin.add-games-to-plan", $current_company->slug) }}',
                method: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function (response) {
                    alert('Games saved successfully!');
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });


        window.fetchCurrentPlanGames = function (id) {
            let _token = $('input[name=_token]').val();
            $.ajax({
                url: "{{route('admin.fetch-games',$current_company->slug)}}",
                type: "POST",
                data: {
                    id: id,
                    _token: _token
                },
                success: function (response) {
                    $('#plan_games').html(response.html)
                }
            })
        }
        window.deleteUser = function (id) {
            let _token = $('input[name=_token]').val();
            $.ajax({
                url: "{{route('admin.delete-user',$current_company->slug)}}",
                type: "POST",
                data: {
                    id: id,
                    _token: _token
                },
                success: function (response) {
                    $('#users_div').html(response.html)
                }
            })
        }
        window.deletePlan = function (id) {
            let _token = $('input[name=_token]').val();
            $.ajax({
                url: "{{route('admin.delete-plan',$current_company->slug)}}",
                type: "POST",
                data: {
                    id: id,
                    _token: _token
                },
                success: function (response) {
                    $('#plans_div').html(response.html)
                }
            })
        }

        $("#keyword").keyup(function () {
            let str = $("#keyword").val();
            let _token = $('input[name=_token]').val();
            $.ajax({
                url: "{{route('admin.search-user',$current_company->slug)}}",
                type: "POST",
                data: {
                    keyword: str,
                    _token: _token
                },
                success: function (response) {
                    $('#users_div').html(response.html)
                }
            })
        });
        $('#save-user').on('click', function () {
            let name = $('#name').val();
            let email = $('#email').val();
            let password = $('#password').val();
            let _token = $('input[name=_token]').val();
            $.ajax({
                url: "{{route('admin.add-user',$current_company->slug)}}",
                type: "POST",
                data: {
                    name: name,
                    email: email,
                    password: password,
                    _token: _token
                },
                success: function (response) {
                    $('#users_div').html(response.html)
                }
            })
        })
        $('#save-plan').on('click', function () {
            let name = $('#plan_name').val();
            let description = $('#plan_description').val();
            let _token = $('input[name=_token]').val();
            $.ajax({
                url: "{{route('admin.add-plan',$current_company->slug)}}",
                type: "POST",
                data: {
                    name: name,
                    description: description,
                    _token: _token
                },
                success: function (response) {
                    $('#plans_div').html(response.html)
                }
            })
        })

        window.fetchUserData = function (id) {
            let _token = $('input[name=_token]').val();
            $.ajax({
                url: "{{route('admin.fetch-user-data',$current_company->slug)}}",
                type: "POST",
                data: {
                    id: id,
                    _token: _token
                },
                success: function (response) {
                    $('#edit_user_modal_content').html(response.html)
                }
            })
        }
        window.submitUserDataForm = function (id) {
            let _token = $('input[name=_token]').val();
            let name = $('#user_name').val();
            let password = $('#user_password').val();
            $.ajax({
                url: "{{route('admin.update-user-data',$current_company->slug)}}",
                type: "POST",
                data: {
                    id: id,
                    name: name,
                    password: password,
                    _token: _token
                },
                success: function (response) {
                    $('#users_div').html(response.html)
                }
            })
        }
    </script>
@endpush
