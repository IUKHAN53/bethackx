<div class="appBottomMenu">
    <a href="#type_roletas" class="item active">
        <div class="col">
            <div class="d-flex justify-content-center align-items-center flex-column gap-1 rounded py-1">
                <img src="{{asset('img/icon/roletas.png')}}" alt="">
                <span class="text-white">Roleta</span>
            </div>
        </div>
    </a>
    <a href="#type_dados" class="item">
        <div class="col">
            <div class="d-flex justify-content-center align-items-center flex-column gap-1 py-1">
                <img src="{{asset('img/icon/dados.png')}}" alt="">
                <span class="text-white">Dados</span>
            </div>
        </div>
    </a>
    <a href="{{route('home')}}" class="item">
        <div class="col d-flex justify-content-center align-items-center flex-column gap-1">
            <div style="position: relative">
                <img src="{{asset('img/home_logo.png')}}" class="bg-primary p-1 shadow"
                     style="border: 1px solid white; border-radius: 100%; width: 70px; height: 65px; position: absolute; bottom: -1rem; left: -2.2rem; right: 2rem"
                     alt="">
            </div>
            <span class="text-white mt-3">BetHack</span>
        </div>
    </a>
    <a href="#type_cartas" class="item">
        <div class="col">
            <div class="d-flex justify-content-center align-items-center flex-column gap-1 py-1">
                <img src="{{asset('img/icon/cartas.png')}}" alt="">
                <span class="text-white">Cards</span>
            </div>
        </div>
    </a>
    <a href="#type_slots" class="item">
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
                <strong>Julian Gruber</strong>
                <div class="text-muted">
                    <ion-icon name="location" role="img" class="md hydrated" aria-label="location"></ion-icon>
                    California
                </div>
            </div>
            <a href="#" class="close-sidebar-button" data-bs-dismiss="offcanvas">
                <ion-icon name="close" role="img" class="md hydrated" aria-label="close"></ion-icon>
            </a>
        </div>
        <!-- * profile box -->

        <ul class="listview flush transparent no-line image-listview mt-2">
            <li>
                <a href="index.html" class="item">
                    <div class="icon-box bg-primary">
                        <ion-icon name="home-outline" role="img" class="md hydrated"
                                  aria-label="home outline"></ion-icon>
                    </div>
                    <div class="in">
                        Discover
                    </div>
                </a>
            </li>
            <li>
                <a href="app-components.html" class="item">
                    <div class="icon-box bg-primary">
                        <ion-icon name="cube-outline" role="img" class="md hydrated"
                                  aria-label="cube outline"></ion-icon>
                    </div>
                    <div class="in">
                        Components
                    </div>
                </a>
            </li>
            <li>
                <a href="app-pages.html" class="item">
                    <div class="icon-box bg-primary">
                        <ion-icon name="layers-outline" role="img" class="md hydrated"
                                  aria-label="layers outline"></ion-icon>
                    </div>
                    <div class="in">
                        <div>Pages</div>
                    </div>
                </a>
            </li>
            <li>
                <a href="page-chat.html" class="item">
                    <div class="icon-box bg-primary">
                        <ion-icon name="chatbubble-ellipses-outline" role="img" class="md hydrated"
                                  aria-label="chatbubble ellipses outline"></ion-icon>
                    </div>
                    <div class="in">
                        <div>Chat</div>
                        <span class="badge badge-danger">5</span>
                    </div>
                </a>
            </li>
            <li>
                <div class="item">
                    <div class="icon-box bg-primary">
                        <ion-icon name="moon-outline" role="img" class="md hydrated"
                                  aria-label="moon outline"></ion-icon>
                    </div>
                    <div class="in">
                        <div>Dark Mode</div>
                        <div class="form-check form-switch">
                            <input class="form-check-input dark-mode-switch" type="checkbox" id="darkmodesidebar">
                            <label class="form-check-label" for="darkmodesidebar"></label>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    <!-- sidebar buttons -->
    <div class="sidebar-buttons">
        <a href="#" class="button">
            <ion-icon name="person-outline" role="img" class="md hydrated" aria-label="person outline"></ion-icon>
        </a>
        <a href="#" class="button">
            <ion-icon name="archive-outline" role="img" class="md hydrated" aria-label="archive outline"></ion-icon>
        </a>
        <a href="#" class="button">
            <ion-icon name="settings-outline" role="img" class="md hydrated" aria-label="settings outline"></ion-icon>
        </a>
        <a href="javascript:void(0)" type="submit" class="button" onclick="$('#logout_form').submit()">
            <ion-icon name="log-out-outline" role="img" class="md hydrated" aria-label="log out outline"></ion-icon>
        </a>
        <form action="{{route('logout')}}" method="POST" id="logout_form">
            @csrf
        </form>

    </div>
    <!-- * sidebar buttons -->
</div>

<div id="notification-welcome" class="notification-box">
    <div class="notification-dialog android-style">
        <div class="notification-header">
            <div class="in">
                <img src="assets/img/icon/72x72.png" alt="image" class="imaged w24">
                <strong>Mobilekit</strong>
                <span>just now</span>
            </div>
            <a href="#" class="close-button">
                <ion-icon name="close" role="img" class="md hydrated" aria-label="close"></ion-icon>
            </a>
        </div>
        <div class="notification-content">
            <div class="in">
                <h3 class="subtitle">Welcome to Mobilekit</h3>
                <div class="text">
                    Mobilekit is a PWA ready Mobile UI Kit Template.
                    Great way to start your mobile websites and pwa projects.
                </div>
            </div>
        </div>
    </div>
</div>
