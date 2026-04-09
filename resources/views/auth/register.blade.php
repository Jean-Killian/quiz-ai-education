<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div class="mb-8 p-3 bg-slate-900 border-l-4 border-green-500">
            <h3 class="text-xl font-bold text-white uppercase tracking-tighter">Initialisation Opérateur</h3>
            <p class="text-[10px] text-slate-500 mt-1 uppercase tracking-widest leading-tight">Enregistrement d'un nouveau profil dans le système.</p>
        </div>

        <!-- Name -->
        <div>
            <label for="name" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1.5">> Operator_Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                   class="block w-full bg-slate-900 border-slate-700 rounded text-green-300 placeholder-slate-700 focus:border-green-500 focus:ring-green-500 py-2 px-3 border transition-colors font-mono text-sm shadow-inner" placeholder="John Doe">
            @error('name')<span class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest">[ FAIL ] {{ $message }}</span>@enderror
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1.5">> Email_Internal</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                   class="block w-full bg-slate-900 border-slate-700 rounded text-green-300 placeholder-slate-700 focus:border-green-500 focus:ring-green-500 py-2 px-3 border transition-colors font-mono text-sm shadow-inner" placeholder="operator@bughunter.ai">
            @error('email')<span class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest">[ FAIL ] {{ $message }}</span>@enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1.5">> Security_Key</label>
            <input id="password" type="password" name="password" required
                   class="block w-full bg-slate-900 border-slate-700 rounded text-green-300 placeholder-slate-700 focus:border-green-500 focus:ring-green-500 py-2 px-3 border transition-colors font-mono text-sm shadow-inner" placeholder="********">
            @error('password')<span class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest">[ FAIL ] {{ $message }}</span>@enderror
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1.5">> Verify_Key</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                   class="block w-full bg-slate-900 border-slate-700 rounded text-green-300 placeholder-slate-700 focus:border-green-500 focus:ring-green-500 py-2 px-3 border transition-colors font-mono text-sm shadow-inner" placeholder="********">
        </div>

        <div class="flex flex-col gap-4 mt-8">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-green-500 rounded bg-green-600 hover:bg-green-500 text-black text-xs font-black uppercase tracking-[0.3em] transition-all shadow-[0_0_15px_rgba(34,197,94,0.2)] active:scale-95">
                Enregistrer_Profil()
            </button>
            
            <a href="{{ route('login') }}" class="text-[10px] text-slate-600 hover:text-green-400 text-center uppercase tracking-widest transition-colors">
                [ Port d'accès existant ]
            </a>
        </div>
    </form>
</x-guest-layout>
