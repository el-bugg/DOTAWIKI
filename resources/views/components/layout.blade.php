<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dota 2 App' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700;900&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="{{ asset('css/frozen-theme.css') }}" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            // Kita butuh important: true agar design item tetap jalan
            important: true, 
            corePlugins: {
                // MATIKAN RESET CSS (Biar Bootstrap aman)
                preflight: false, 
                
                // MATIKAN CLASS YANG BENTROK DENGAN NAVBAR BOOTSTRAP:
                container: false,  // Biarkan Bootstrap yang atur lebar container
                visibility: false, // Biarkan Bootstrap yang atur class .collapse
            },
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Roboto', 'sans-serif'],
                        cinzel: ['Cinzel', 'serif'],
                        roboto: ['Roboto', 'sans-serif'],
                    },
                    colors: {
                        slate: {
                            850: '#151e2e',
                            900: '#0f172a',
                            950: '#020617',
                        }
                    },
                    // Tambah z-index custom buat jaga-jaga
                    zIndex: {
                        'sticky': '1020',
                        'fixed': '1030',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #050b14;
            color: #cbd5e1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Pastikan Navbar Bootstrap selalu di atas salju */
        .navbar {
            z-index: 1040; /* Standar Bootstrap z-index */
            position: relative;
        }

        /* Snowflake Animation Styling */
        #snow-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1; /* Di bawah navbar */
            pointer-events: none;
            overflow: hidden;
        }

        .snowflake {
            position: absolute;
            top: -10px;
            background-color: white;
            border-radius: 50%;
            opacity: 0.8;
            pointer-events: none;
            animation: fall linear infinite;
        }

        @keyframes fall {
            0% { transform: translateY(-10vh); }
            100% { transform: translateY(110vh); }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #0f172a; }
        ::-webkit-scrollbar-thumb { background: #334155; border-radius: 4px; }
        
        main {
            flex: 1;
            position: relative;
            z-index: 10;
        }
    </style>

    {{ $styles ?? '' }}
</head>
<body>

    <div id="snow-container"></div>

    <x-navbar />

    <main>
        {{ $slot }}
    </main>

    <x-footer />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const snowContainer = document.getElementById('snow-container');
            if (!snowContainer) return;

            for (let i = 0; i < 50; i++) {
                const div = document.createElement('div');
                div.classList.add('snowflake');
                const size = Math.random() * 3 + 2 + 'px';
                div.style.width = size;
                div.style.height = size;
                div.style.left = Math.random() * 100 + 'vw';
                const duration = Math.random() * 5 + 5 + 's';
                const delay = Math.random() * 5 + 's';
                div.style.animationDuration = duration;
                div.style.animationDelay = delay;
                div.style.opacity = Math.random() * 0.5 + 0.3;
                snowContainer.appendChild(div);
            }
        });
    </script>

    {{ $scripts ?? '' }}
</body>
</html>