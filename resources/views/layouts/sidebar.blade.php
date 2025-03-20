 <!-- ! Sidebar -->
 <style>
    .badge-danger {
        background-color: red;
        color: white;
        font-size: 12px;
        padding: 4px 8px;
        border-radius: 50%;
        font-weight: bold;
        position: absolute;
        top: 5px;
        right: 5px;
    }
</style>

 <aside class="sidebar">
   
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="/" class="logo-wrapper" title="Home">
                <span class="sr-only">Home</span>
                <span class="icon logo" aria-hidden="true"></span>
                <div class="logo-text">
                    <span class="logo-title">🍔 ISI BURGER</span>
                    <span class="logo-subtitle">Dashboard</span>
                </div>

            </a>
            <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                <span class="sr-only">Toggle menu</span>
                <span class="icon menu-toggle" aria-hidden="true"></span>
            </button>
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-body-menu">

                @if(Auth::user()->isGestionnaire())
                <li>
                    <a class="active" href="{{ route('dashboard') }}"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
                </li>

                <li>
                    <a class="" href="{{ route('burgers.index') }}">
                        
                        <i class="fa-solid fa-burger"></i></span>&nbsp; Burgers
                    </a>
                </li>

                <li>
                    <a class="sho" href="{{ route('gestionnaire.commandes.index') }}">
                        <i class="fa-solid fa-border-none"></i></span>&nbsp; Commandes
                    </a>
                </li>

            @elseif(Auth::user()->role === 'client')
                <li>
                    <a class="sho" href="{{ route('catalogue') }}">
                        
                        <i class="fa-solid fa-burger"></i></span>&nbsp; Catalogues
                    </a>
                </li>

                <li>
                    <a class="sho" href="{{ route('commandes.index') }}">
                        <i class="fa-solid fa-border-none"></i></span>&nbsp; Mes Commandes
                    </a>
                </li>

                <li>
                    <a class="sho" href="{{ route('commandes.create') }}">
                        <i class="fa-solid fa-border-none"></i></span>&nbsp; Commander
                    </a>
                </li>
                <li>
    <a class="sho" href="{{ route('notifications.index') }}">
        <i class="fa-solid fa-file-invoice-dollar"></i>&nbsp; Factures
        <span id="factureBadge" class="badge badge-danger" style="display: none;">0</span>
    </a>
</li>

            @endif         
                
                <li>
                    <a class="sho" href="{{ route('profile.edit') }}">
                        <i class="fa-regular fa-address-card"></i>&nbsp; Profile
                    </a>
                </li>

            </ul>
            <span class="system-menu__title">system</span>
            
        </div>
    </div>
    <div class="sidebar-footer">
        <a href="##" class="sidebar-user">
        <span class="nav-user-img">
  <img src="{{ asset('storage/images/profile.jpg') }}" alt="Photo de profil" class="profile-img">
</span>

            <div class="sidebar-user-info">
                <span class="sidebar-user__title">{{ Auth::user()->name }}</span>
                <span class="sidebar-user__subtitle">{{ Auth::user()->email }}</span>
            </div>
        </a>
    </div>
</aside>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        function loadFactures() {
            fetch("{{ route('notifications.unread') }}", {
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                const factureBadge = document.getElementById('factureBadge');

                if (factureBadge) {
                    if (data.count > 0) {
                        factureBadge.style.display = 'inline-block';
                        factureBadge.textContent = data.count;
                    } else {
                        factureBadge.style.display = 'none';
                    }
                }
            })
            .catch(error => console.error("Erreur lors du chargement des notifications :", error));
        }

        // Charger les notifications au chargement de la page
        loadFactures();

        // Mettre à jour toutes les 10 secondes
        setInterval(loadFactures, 10000);
    });
</script>
