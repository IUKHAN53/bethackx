<form action="{{route('admin.update-user-data',$current_company->slug)}}" method="POST" id="user_edit_form">
    @csrf
    <div class="modal-body text-start mb-2">
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="name" class="form-control login-input-control" id="user_name" value="{{$user->name}}"
                       placeholder="Nome">
                <i class="clear-input">
                    <ion-icon name="close-circle"></ion-icon>
                </i>
            </div>
        </div>
        <div class="form-group boxed">
            <div class="input-wrapper">
                <input type="password" class="form-control login-input-control" id="user_password"
                       placeholder="Digite a senha atualizada">
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
            <button type="button" class="btn btn-text-primary" id="save-user" onclick="submitUserDataForm('{{$user->id}}')"
                    data-bs-dismiss="modal">Salvar
            </button>
        </div>
    </div>
</form>
