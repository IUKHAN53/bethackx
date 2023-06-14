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
                <a href="#" onclick="deleteUser('{{$user->id}}')">
                    <ion-icon name="trash" role="img" class="md hydrated"
                              style="color: #b2b2b2"
                              aria-label="trash"></ion-icon>
                </a>
            </div>
        </div>
    </div>
@endforeach
