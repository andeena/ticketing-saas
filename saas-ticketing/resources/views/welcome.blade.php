<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DeskOne - Helpdesk SaaS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="min-h-screen flex items-center justify-center">
        <div class="text-center max-w-md bg-white p-8 rounded-lg shadow">
            <h1 class="text-3xl font-bold mb-2 text-indigo-600">
                DeskOne
            </h1>

            <p class="text-gray-600 mb-6">
                Simple on-premise helpdesk for your organization
            </p>

            @auth
                <a href="{{ route('dashboard') }}"
                   class="inline-block bg-indigo-600 hover:bg-indigo-700
                          text-white px-6 py-2 rounded-md font-semibold">
                    Go to Dashboard
                </a>
            @else
                <div class="flex justify-center gap-4">
                    <a href="{{ route('login') }}"
                       class="border border-indigo-600 text-indigo-600
                              hover:bg-indigo-50 px-5 py-2 rounded-md">
                        Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="border border-indigo-600 text-indigo-600
                              hover:bg-indigo-50 px-5 py-2 rounded-md">
                        Register
                    </a>
                </div>
            @endauth
        </div>
    </div>

</body>
</html>
