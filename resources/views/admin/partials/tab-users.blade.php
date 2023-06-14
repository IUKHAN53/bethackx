<div class="tab-pane fade mb-5" id="users" role="tabpanel">
    <div class="">
        <label for="keyword"
               class="form-label-custom d-flex justify-content-start align-items-center ps-2 mb-3 rounded">
            <input type="text" name="" id="keyword" class="form-control form-control-custom w-100"
                   placeholder="digite para buscar">
            <ion-icon name="search" role="img" class="md hydrated" aria-label="search"></ion-icon>
        </label>
        <button class="btn btn-secondary btn-sm mb-2" data-bs-toggle="modal"
                data-bs-target="#create_edit_user_modal">Adicionar usuário
        </button>
        <div id="users_div">
            @include('admin.partials.users-table')
        </div>
    </div>
</div>
