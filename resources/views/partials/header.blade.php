<div id="navbar">
    <div class="navbar-section">
        <div class="navbar-item" data-target="sidebar">
            <ion-icon name="menu-outline"></ion-icon>
        </div>
        <div class="navbar-item" onclick="location.href='{{admin_url('')}}'">
            <ion-icon name="home-outline" class="mr-3"></ion-icon>
            Inicio
        </div>
    </div>
    <div class="navbar-section justify-content-end">
  
        <div class="dropdown">
            <div class="navbar-item" data-toggle="dropdown">
                <ion-icon name="notifications-outline"></ion-icon>
            </div>
            <ul class="navbar-dropdown dropdown-menu dropdown-menu-right">
                <li>
                    <a class="dropdown-item py-2" href="#">
                        <b class="d-block">Novas mensagens</b>
                        Você tem 3 nova(s) mensagen(s)
                    </a>
                </li>
                <li>
                    <a class="dropdown-item py-2" href="#">
                        <b class="d-block">Novo comentário</b>
                        novo comentário no post #1 meu super post aleatório
                    </a>
                </li>
            </ul>
        </div><!-- notificacoes -->
        
        <div class="navbar-item" onclick="location.href='{{ admin_url('auth/setting') }}'">
            <ion-icon name="person-circle-outline"></ion-icon>
        </div>                    
    </div>
</div>
