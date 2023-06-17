<div class="appBottomMenu" style="max-width: 700px;margin-left: auto; margin-right: auto;">
    <a href="{{request()->routeIs('home')?'#type_roletas':route('home', $current_company).'/#type_roletas'}}" class="item active">
        <div class="col">
            <div class="d-flex justify-content-center align-items-center flex-column gap-1 rounded py-1">
                <img src="{{asset('img/icon/roletas.png')}}" alt="">
                <span class="text-white">Roleta</span>
            </div>
        </div>
    </a>
    <a href="{{request()->routeIs('home')?'#type_dados':route('home', $current_company).'/#type_dados'}}" class="item">
        <div class="col">
            <div class="d-flex justify-content-center align-items-center flex-column gap-1 py-1">
                <img src="{{asset('img/icon/dados.png')}}" alt="">
                <span class="text-white">Dados</span>
            </div>
        </div>
    </a>
    <a href="{{route('home', $current_company)}}" class="item">
        <div class="col d-flex justify-content-center align-items-center flex-column gap-1">
            <div style="position: relative">
                <img src="{{Storage::url($current_company->favicon)}}" class="bg-primary p-1 shadow"
                     style="border-radius: 100%; width: 70px; height: 65px; position: absolute; bottom: -1rem; left: -2.2rem; right: 2rem"
                     alt="">
            </div>
            <span class="text-white mt-3">BetHack</span>
        </div>
    </a>
    <a href="{{request()->routeIs('home')?'#type_cartas':route('home', $current_company).'/#type_cartas'}}" class="item">
        <div class="col">
            <div class="d-flex justify-content-center align-items-center flex-column gap-1 py-1">
                <img src="{{asset('img/icon/cartas.png')}}" alt="">
                <span class="text-white">Cartas</span>
            </div>
        </div>
    </a>
    <a href="{{request()->routeIs('home')?'#type_slots':route('home', $current_company).'/#type_slots'}}" class="item">
        <div class="col">
            <div class="d-flex justify-content-center align-items-center flex-column gap-1 py-1">
                <img src="{{asset('img/icon/slots.png')}}" alt="">
                <span class="text-white">Slots</span>
            </div>
        </div>
    </a>
</div>
