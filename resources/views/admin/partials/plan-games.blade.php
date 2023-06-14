<form action="{{route('admin.add-games-to-plan',$current_company->slug)}}" id="plan_form" method="POST">
    @csrf
    <div class="col-12">
        <div>
            <input type="hidden" value="{{$plan->id}}" name="plan_id">
            @foreach($all_games as $game)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="game_status[]" id="game_{{$game->id}}"
                           value="{{$game->id}}" {{in_array($game->id, $games) ? 'checked' : ''}}>
                    <label class="form-check-label" for="game_{{$game->id}}">
                        {{$game->name}}
                    </label>
                </div>
            @endforeach
            <div class="btn-inline">
                <button type="button" class="btn btn-text-secondary" data-bs-dismiss="modal">CLOSE</button>
                <button type="submit" class="btn btn-text-primary" data-bs-dismiss="modal">Salvar</button>
            </div>
        </div>
    </div>
</form>
