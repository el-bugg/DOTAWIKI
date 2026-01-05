<footer class="bg-black border-top border-secondary mt-5 py-5 position-relative overflow-hidden">
    <div class="ice-particles position-absolute top-0 start-0 w-100 h-100 opacity-25 pointer-events-none"></div>

    <div class="container position-relative z-2">
        <div class="row g-4">
            <div class="col-md-4">
                <a class="navbar-brand frozen-text text-white fs-3" href="/">DOTA WIKI</a>
                <p class="text-secondary small mt-3">
                    The ultimate community resource for Dota 2. Detailed stats, mechanics, and guides for the Ancient.
                </p>
                <p class="text-secondary small">&copy; {{ date('Y') }} Frozen Wiki. All rights reserved.</p>
            </div>
            
            <div class="col-md-2">
                <h6 class="text-ice font-cinzel mb-3">DATABASE</h6>
                <ul class="list-unstyled small">
                    <li><a href="/heroes" class="text-secondary text-decoration-none hover-white">Heroes</a></li>
                    <li><a href="/items" class="text-secondary text-decoration-none hover-white">Items</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none hover-white">Mechanics</a></li>
                </ul>
            </div>

            <div class="col-md-2">
                <h6 class="text-ice font-cinzel mb-3">COMMUNITY</h6>
                <ul class="list-unstyled small">
                    @auth
                        <li><a href="/dashboard" class="text-secondary text-decoration-none hover-white">My Profile</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="text-secondary text-decoration-none hover-white">Login</a></li>
                        <li><a href="{{ route('register') }}" class="text-secondary text-decoration-none hover-white">Register</a></li>
                    @endauth
                </ul>
            </div>

            <div class="col-md-4">
                <h6 class="text-ice font-cinzel mb-3">LEGAL</h6>
                <p class="text-secondary small" style="font-size: 0.75rem;">
                    Dota 2 is a registered trademark of Valve Corporation. This site is not affiliated with Valve.
                    Game content and materials are trademarks and copyrights of their respective publisher and its licensors.
                </p>
            </div>
        </div>
    </div>
</footer>

<style>
    .hover-white:hover { color: white !important; text-shadow: 0 0 5px white; }
</style>