<div class="appBottomMenu">
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
                <img src="{{asset('img/home_logo.png')}}" class="bg-primary p-1 shadow"
                     style="border: 1px solid white; border-radius: 100%; width: 70px; height: 65px; position: absolute; bottom: -1rem; left: -2.2rem; right: 2rem"
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
<script>
    function gotoSection(id) {
        // window.location.hash = id;
    }
</script>
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarPanel">
    <div class="offcanvas-body">
        <!-- profile box -->
        <div class="profileBox">
            <div class="image-wrapper">
                <img src="{{asset('img/sample/avatar/avatar1.jpg')}}" alt="image" class="imaged rounded">
            </div>
            <div class="in">
                <strong>{{auth()->user()->name}}</strong>
            </div>
            <a href="#" class="close-sidebar-button" data-bs-dismiss="offcanvas">
                <ion-icon name="close" role="img" class="md hydrated" aria-label="close"></ion-icon>
            </a>
        </div>
        <!-- * profile box -->

        @if(auth()->user()->isAdmin())
            <ul class="listview flush transparent no-line image-listview mt-2">
                <li>
                    <a href="{{route('admin.view', $current_company->slug)}}" class="item">
                        <div class="icon-box bg-primary">
                            <ion-icon name="desktop-outline"></ion-icon>
                        </div>
                        <div class="in">
                            Admin
                        </div>
                    </a>
                </li>
            </ul>
        @endif
        <ul class="listview flush transparent no-line image-listview mt-2">
            <li>
                <a href="javascript:void(0)" class="item" onclick="$('#logout_form').submit()">
                    <div class="icon-box bg-primary">
                        <ion-icon name="log-out-outline" role="img" class="md hydrated"
                                  aria-label="log out outline"></ion-icon>
                    </div>
                    <div class="in">
                        Logout
                    </div>
                </a>
            </li>
        </ul>
        <form action="{{route('user.logout', $current_company->slug )}}" method="POST" id="logout_form">
            @csrf
        </form>
    </div>
</div>
