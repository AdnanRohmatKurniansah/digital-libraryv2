<main class="flex flex-col items-center flex-1 px-4 pt-6 sm:justify-center">
    <div>
        <a href="/">
            <x-application-logo class="w-20 h-20" />
        </a>
    </div>

    <div class="w-full px-6 py-4 my-6 overflow-hidden bg-white rounded-md shadow-md {{ Request::is('login') ? 'sm:max-w-md' : 'sm:max-w-2xl' }} dark:bg-dark-eval-1">
        {{ $slot }}
    </div>
</main>