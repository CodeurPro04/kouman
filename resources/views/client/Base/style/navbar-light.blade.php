@php
    $client = Auth::guard('client')->user();
    $partenaire = Auth::guard('partenaire')->user();
    $user = $client ?? $partenaire;
@endphp
<!-- Début de la Navbar -->
<nav id="topnav" class="defaultscroll is-sticky">
    <div class="container relative">
        <!-- Début du logo -->
        <a class="logo" href="/index">
            <span class="inline-block  dark:hidden">
                <img src="{{ asset('client/assets/images/logoG.ico') }}" class="l-dark" height="24" alt="">
                <img src="{{ asset('client/assets/images/logoG.ico') }}" class="l-light" height="24" alt="">
            </span>
            <img src="{{ asset('client/assets/images/logoG.ico') }}" height="24" class="hidden mt-4 dark:inline-block" alt="">
        </a>
        <!-- Fin du logo -->

        <!-- Bouton menu mobile -->
        <div class="menu-extras">
            <div class="menu-item">
                <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
            </div>
        </div>
        <!-- Fin menu mobile -->

        <!-- Boutons Connexion / Inscription -->
        <ul class="buy-button list-none mb-0">
            @auth('client')
                <!-- Bouton tableau de bord client -->
                <li class="dropdown inline-block relative">
                    <button data-dropdown-toggle="dropdown" class="dropdown-toggle items-center" type="button">
                        <span
                            class="btn btn-icon bg-green-600 hover:bg-green-700 border-green-600 dark:border-green-600 text-white rounded-full">
                            @if ($user && $user->image)
                                <img src="{{ asset('storage/'.$user->image) }}" class="rounded-md object-cover w-full h-full" alt="Photo de profil">
                            @else
                                <i data-feather="user" class="size-4 stroke-[3]"></i>
                            @endif
                        </span>
                    </button>
                    <!-- Dropdown menu -->
                    <div class="dropdown-menu absolute left-1/2 -translate-x-1/2 m-0 mt-4 z-10 w-44 rounded-md overflow-hidden bg-white dark:bg-slate-900 shadow hidden" onclick="event.stopPropagation();">
                        <ul class="py-2 text-start text-slate-900 dark:text-white">
                            {{-- <li>
                                <a href="{{ route($partenaire ? 'partenaire.profile' : 'client.profile') }}" class="block py-1 px-4 hover:text-green-600">👤 Profil</a>
                            </li>
                            <li>
                                <a href="{{ route($partenaire ? 'partenaire.chat' : 'client.chat') }}" class="block py-1 px-4 hover:text-green-600">💬 Chat</a>
                            </li>
                            <li>
                                <a href="{{ route($partenaire ? 'partenaire.profile-setting' : 'client.profile-setting') }}" class="block py-1 px-4 hover:text-green-600">⚙️ Paramètres</a>
                            </li>
                            <li class="border-t border-gray-100 dark:border-gray-700 my-2"></li>
                            <li>
                                <a href="{{ route($partenaire ? 'partenaire.lock-screen' : 'client.lock-screen') }}" class="block py-1 px-4 hover:text-green-600">🔒 Verrouiller</a>
                            </li> --}}
                            <li>
                                <form action="{{ route('client.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="block w-full text-left py-1 px-4 hover:text-green-600 bg-transparent border-0">
                                        Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="inline mb-0">
                    {{-- <a href="{{ route('client.cart.index') }}" --}}
                    <a href=""
                    class="btn btn-icon bg-yellow-500 hover:bg-yellow-600 border-yellow-500 dark:border-yellow-500 text-white rounded-full relative">
                        <i data-feather="shopping-cart" class="size-4 stroke-[3]"></i>
                    </a>
                </li>
            @elseif(auth('partenaire')->check())
                <!-- Bouton tableau de bord partenaire -->
                <li class="inline mb-0">
                    <a href="{{ route('partenaire.dashboard') }}"
                        class="btn bg-green-600 hover:bg-green-700 border-green-600 dark:border-green-600 text-white rounded-full">
                        Tableau de bord
                    </a>
                </li>
                <li class="inline mb-0">
                    {{-- <a href="{{ route('client.cart.index') }}" --}}
                    <a href=""
                    class="btn btn-icon bg-yellow-500 hover:bg-yellow-600 border-yellow-500 dark:border-yellow-500 text-white rounded-full relative">
                        <i data-feather="shopping-cart" class="size-4 stroke-[3]"></i>
                    </a>
                </li>
            @else
                <!-- Boutons Connexion et Inscription visibles si aucun connecté -->
                <li class="inline mb-0">
                    <a href="{{ route('client.auth.login') }}"
                        class="btn btn-icon bg-green-600 hover:bg-green-700 border-green-600 dark:border-green-600 text-white rounded-full">
                        <i data-feather="user" class="size-4 stroke-[3]"></i>
                    </a>
                </li>
                <li class="sm:inline ps-1 mb-0 hidden">
                    <a href="{{ route('partenaire.register.index') }}"
                    class="btn bg-green-600 hover:bg-green-700 border border-green-600 text-white rounded-full px-4 py-2 text-sm leading-tight text-center whitespace-normal">
                        S'inscrire en tant<br>que partenaire
                    </a>
                </li>

            @endauth
        </ul>

        <!-- Fin des boutons -->

        <div id="navigation">
            <!-- Menu de navigation -->
            <ul class="navigation-menu justify-end nav-light">

                <li><a href="{{ route('client.index') }}" class="sub-menu-item">Accueil</a></li>
                <li><a href="{{ route('client.grid.sidebar') }}" class="sub-menu-item">Nos Offres</a></li>
                <li><a href="{{ route('client.aboutus') }}" class="sub-menu-item">À propos de nous</a></li>

                <li class="has-submenu parent-parent-menu-item">
                    <a href="javascript:void(0)">Autres Pages</a><span class="menu-arrow"></span>
                    <ul class="submenu">
                        <li><a href="{{ route('client.features') }}" class="sub-menu-item">Fonctionnalités</a></li>
                        <li><a href="{{ route('client.pricing') }}" class="sub-menu-item">Tarification</a></li>
                        <li><a href="{{ route('client.faqs') }}" class="sub-menu-item">FAQ</a></li>

                        {{-- <li class="has-submenu parent-menu-item"><a href="javascript:void(0)">Agences</a><span class="submenu-arrow"></span>
                            <ul class="submenu"> --}}
                                <li><a href="{{ route('client.agencies') }}" class="sub-menu-item">Nos Partenaires</a></li>
                                {{-- <li><a href="{{ route('client.agency.profile') }}" class="sub-menu-item">Profil d’agence</a></li> --}}
                            {{-- </ul>
                        </li> --}}

                        <li class="has-submenu parent-menu-item"><a href="javascript:void(0)">Utilitaires</a><span class="submenu-arrow"></span>
                            <ul class="submenu">
                                <li><a href="{{ route('client.terms') }}" class="sub-menu-item">Conditions d’utilisation</a></li>
                                <li><a href="{{ route('client.privacy') }}" class="sub-menu-item">Politique de confidentialité</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li><a href="{{ route('client.contact') }}" class="sub-menu-item">Contact</a></li>

            </ul><!-- Fin du menu -->
        </div><!-- Fin navigation -->
    </div><!-- Fin container -->
</nav><!-- Fin navbar -->
<!-- Fin de la Navbar -->


<!-- Script pour l’état actif (corrigé pour .sub-menu-item) -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const navItems = document.querySelectorAll('.sub-menu-item');
        navItems.forEach(item => {
            item.addEventListener('click', function() {
                navItems.forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>
