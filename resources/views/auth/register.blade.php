<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div class="text-center mb-6">
            <h3 class="text-2xl font-bold text-gray-900">Inscription</h3>
        </div>

        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm py-2 px-3 border border-gray-300 text-gray-700">
            @error('name')<span class="text-red-600 text-sm mt-1">{{ $message }}</span>@enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Adresse Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm py-2 px-3 border border-gray-300 text-gray-700">
            @error('email')<span class="text-red-600 text-sm mt-1">{{ $message }}</span>@enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
            <input id="password" type="password" name="password" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm py-2 px-3 border border-gray-300 text-gray-700">
            @error('password')<span class="text-red-600 text-sm mt-1">{{ $message }}</span>@enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm py-2 px-3 border border-gray-300 text-gray-700">
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">Déjà inscrit ?</a>
            <button type="submit" class="flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700">
                S'inscrire
            </button>
        </div>
    </form>
</x-guest-layout>
