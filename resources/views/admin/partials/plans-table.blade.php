@foreach($plans as $plan)
    <div class="p-2 d-flex flex-column gap-3" style="color: #b2b2b2">
        <div class="d-flex justify-content-between align-items-center gap-2">
            <div style="line-height: 18px">
                <span>{{$plan->name}}</span><br>
            </div>
            <div class="d-flex justify-content-center align-items-center gap-3">
                <a href="#" onclick="fetchCurrentPlanGames('{{$plan->id}}')" data-bs-toggle="modal"
                   data-bs-target="#add_games_to_plan">
                    <ion-icon name="game-controller-outline" style="color: #b2b2b2"></ion-icon>
                </a>
                
            </div>
        </div>
    </div>
@endforeach
<div class="modal fade dialogbox" id="create_plan_modal" data-bs-backdrop="static" tabindex="-1"
     role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar planos</h5>
            </div>
            <form action="{{route('admin.add-plan',$current_company->slug)}}" method="POST">
                @csrf
                <div class="modal-body text-start mb-2">
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="name" class="form-control login-input-control" id="plan_name"
                                   placeholder="Name">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="text" class="form-control login-input-control" id="plan_description"
                                   placeholder="Descrição">
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
                        <button type="button" class="btn btn-text-primary" id="save-plan"
                                data-bs-dismiss="modal">Salvar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade dialogbox" id="add_games_to_plan" data-bs-backdrop="static" tabindex="-1"
     role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar jogos ao plano</h5>
            </div>
            <div id="plan_games" class="row">
            </div>

        </div>
    </div>
</div>
