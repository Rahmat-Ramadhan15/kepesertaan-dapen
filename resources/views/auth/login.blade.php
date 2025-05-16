<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bank Sulselbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/lucide-icons@0.378.0/dist/lucide.min.css" rel="stylesheet">
    <script src="https://unpkg.com/lucide@0.378.0/dist/umd/lucide.js"></script>
    <style>
    :root {
        --primary-color: #1e3a8a;
        --primary-light: #2563eb;
        --primary-dark: #1e40af;
    }
    
    body {
        background-color: #f0f4f8;
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
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-8">
            <div class="flex justify-center mb-4">
            <img src="{{ asset('images/sulselbar.jpg') }}" alt="Bank Sulselbar Logo" class="h-20 w-auto">

            </div>
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-1">BANK SULSELBAR</h2>
            <p class="text-center text-gray-500 text-sm mb-6">Kepesertaan Dana Pensiun</p>
            
            @if ($errors->any())
            <div class="mb-4 text-red-600 text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <div>
                    <div class="relative">
                        <input 
                            type="text" 
                            name="nip" 
                            id="nip"
                            placeholder="Username" 
                            required
                            value="{{ old('nip') }}"
                            class="block w-full px-3 py-3 border border-gray-200 rounded-md leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm"
                        >
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <input 
                            type="password" 
                            name="password" 
                            id="password"
                            placeholder="Password" 
                            required
                            class="block w-full px-3 py-3 border border-gray-200 rounded-md leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm"
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

                <div class="captcha-container bg-gray-200 p-4 rounded-lg">
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
                        <input 
                            type="text" 
                            name="captcha" 
                            placeholder="Enter Captcha" 
                            required
                            class="block w-full px-3 py-2 border border-gray-200 rounded-md leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary sm:text-sm"
                        >
                    </div>
                </div>

                <div>
                    <button 
                        type="submit" 
                        class="w-full flex justify-center items-center gap-2 py-3 px-4 rounded-md text-sm font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition"
                    >
                        <i data-lucide="log-in" class="h-4 w-4"></i>
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
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
    </script>
</body>
</html>