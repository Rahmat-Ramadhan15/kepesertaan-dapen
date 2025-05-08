<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bank Sulselbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/lucide-icons@0.378.0/dist/lucide.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@0.378.0/dist/umd/lucide.js"></script>
    <style>
    :root {
        --primary-color: #3f51b5;
        --primary-light: #757de8;
        --primary-dark: #002984;
    }
    
    .background-wrapper {
        position: absolute;
        inset: 0;
        overflow: hidden;
        z-index: 0;
    }

    .cube {
        width: 20px;
        height: 20px;
        background-color: rgba(255, 255, 255, 0.1);
        position: absolute;
        top: 100%;
        animation: floatCube 15s linear infinite;
        border-radius: 4px;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
    }

    @keyframes floatCube {
        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(-120vh) rotate(720deg);
            opacity: 0;
        }
    }
    
    .bg-primary {
        background-color: var(--primary-color);
    }
    
    .bg-primary-light {
        background-color: var(--primary-light);
    }
    
    .bg-primary-dark {
        background-color: var(--primary-dark);
    }
    
    .text-primary {
        color: var(--primary-color);
    }
    
    .ring-primary {
        --tw-ring-color: var(--primary-color);
    }
    
    .border-primary {
        border-color: var(--primary-color);
    }
    
    .hover\:bg-primary-dark:hover {
        background-color: var(--primary-dark);
    }
    
    .focus\:ring-primary:focus {
        --tw-ring-color: var(--primary-color);
    }
    
    .focus\:border-primary:focus {
        border-color: var(--primary-color);
    }
</style>

</head>
<body class="bg-gradient-to-br from-[#757de8] to-[#3f51b5] min-h-screen flex items-center justify-center p-4 relative">
    <div class="background-wrapper" id="cubeContainer"></div>
    
    <div class="w-full max-w-md p-8 bg-white backdrop-blur-lg rounded-3xl shadow-2xl border-2 transform hover:shadow-3xl relative z-10">
        
    @if ($errors->any())
    <div class="mb-4 text-red-600 text-sm">
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            
            <div>
                <label for="nip" class="block text-sm font-medium text-gray-700 mb-1 flex items-center gap-2">
                    <i data-lucide="id-badge" class="text-primary"></i>
                    NIP
                </label>
                <div class="relative">
                    <i data-lucide="user" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input 
                        type="text" 
                        name="nip" 
                        id="nip"
                        placeholder="Masukkan NIP" 
                        required
                        value="{{ old('nip') }}"
                        class="block w-full pl-10 px-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm"
                    >
                </div>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1 flex items-center gap-2">
                    Password
                </label>
                <div class="relative">
                    <i data-lucide="key" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input 
                        type="password" 
                        name="password" 
                        id="password"
                        placeholder="Masukkan Password" 
                        required
                        class="block w-full pl-10 px-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm"
                    >
                    <button 
                        type="button" 
                        id="togglePassword"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-primary transition"
                    >
                        <i data-lucide="eye" id="passwordToggleIcon"></i>
                    </button>
                </div>
            </div>

            <div class="captcha-container bg-gray-100 p-4 rounded-lg">
                <div class="flex items-center justify-between mb-2">
                    <img src="{{ captcha_src() }}" id="captcha-image" class="img-thumbnail rounded-lg max-h-12">
                    <button 
                        type="button" 
                        id="refresh-captcha"
                        class="bg-primary text-white p-2 rounded-lg hover:bg-primary-dark transition flex items-center justify-center group"
                    >
                        <i data-lucide="refresh-cw" class="group-hover:rotate-180 transition-transform"></i>
                    </button>
                </div>
                <div class="relative">
                    <i data-lucide="shield-check" class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input 
                        type="text" 
                        name="captcha" 
                        placeholder="Masukkan Captcha" 
                        required
                        class="block w-full pl-10 px-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm"
                    >
                </div>
            </div>

            <div>
                <button 
                    type="submit" 
                    class="w-full flex justify-center items-center gap-2 py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition transform hover:scale-105 hover:shadow-lg"
                >
                    <i data-lucide="log-in"></i>
                    Login
                </button>
            </div>
        </form>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
            createCubes();
        });


        $(document).ready(function() {
            // Captcha Refresh
            $('#refresh-captcha').click(function(){
                $.get('{{ route("captcha.refresh") }}', function(data) {
                    $('#captcha-image').attr('src', data.captcha);
                });
            });

            // Password Toggle
            $('#togglePassword').click(function() {
                const passwordInput = $('#password');
                const passwordToggleIcon = $('#passwordToggleIcon');
                const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
                passwordInput.attr('type', type);
                
                if (type === 'text') {
                    passwordToggleIcon.attr('data-lucide', 'eye-off');
                } else {
                    passwordToggleIcon.attr('data-lucide', 'eye');
                }
                lucide.createIcons();
            });
        });

        function createCubes() {
            const container = document.getElementById('cubeContainer');
            for (let i = 0; i < 40; i++) {
                const cube = document.createElement('div');
                cube.classList.add('cube');
                cube.style.left = `${Math.random() * 100}%`;
                cube.style.animationDuration = `${10 + Math.random() * 10}s`;
                cube.style.width = `${10 + Math.random() * 20}px`;
                cube.style.height = cube.style.width;
                cube.style.animationDelay = `${Math.random() * 5}s`;
                container.appendChild(cube);
            }
        }
    </script>
</body>
</html>