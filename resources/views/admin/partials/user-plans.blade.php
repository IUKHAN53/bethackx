<form action="{{route('admin.add-plan-to-user',$current_company->slug)}}" id="user_plan_form" method="POST">
    @csrf
    <div class="col-12">
        <div>
            <input type="hidden" value="{{$user->id}}" name="user_id">
            @foreach($all_plans as $plan)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="plan_status[]" id="plan_{{$plan->id}}"
                           value="{{$plan->id}}" {{in_array($plan->id, $user_plans) ? 'checked' : ''}}>
                    <label class="form-check-label" for="plan_{{$plan->id}}">
                        {{$plan->name}}
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

