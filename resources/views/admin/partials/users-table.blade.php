@foreach($users as $user)
    <div class="p-2 d-flex flex-column gap-3" style="color: #b2b2b2">
        <div class="d-flex justify-content-between align-items-center gap-2">
            <div style="line-height: 18px">
                <span>{{$user->name}}</span><br>
                <span>{{$user->email}}</span>
            </div>
            <div class="d-flex justify-content-center align-items-center gap-3">
                <a href="#" onclick="fetchCurrentUserPlans('{{$user->id}}')" data-bs-toggle="modal"
                   data-bs-target="#add_plan_to_games">
                    <ion-icon name="pricetag-outline" style="color: #b2b2b2"></ion-icon>
                </a>
                <a href="#" onclick="fetchUserData('{{$user->id}}')" data-bs-toggle="modal"
                   data-bs-target="#edit_user_modal">
                    <ion-icon name="create-outline" style="color: #b2b2b2"></ion-icon>
                </a>
                <a href="#" onclick="deleteUser('{{$user->id}}')">
                    <ion-icon name="trash" role="img" class="md hydrated"
                              style="color: #b2b2b2"
                              aria-label="trash"></ion-icon>
                </a>
            </div>
        </div>
    </div>
@endforeach
<div class="modal fade dialogbox" id="create_edit_user_modal" data-bs-backdrop="static" tabindex="-1"
     role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar / Editar usuário</h5>
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
