<x-guest-layout>
    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div class="mb-8 p-3 bg-slate-900 border-l-4 border-green-500">
            <h3 class="text-xl font-bold text-white uppercase tracking-tighter">Accès Opérateur</h3>
            <p class="text-[10px] text-slate-500 mt-1 uppercase tracking-widest leading-tight">Veuillez injecter vos identifiants de session.</p>
        </div>

        <!-- Role Indicator (Visual only) -->
        <div class="flex justify-between items-center px-3 py-2 bg-slate-900/50 rounded text-[10px] font-bold text-slate-500 mb-6 uppercase tracking-[0.2em] border border-slate-700">
            <span>Privilège : </span>
            <span class="text-green-500 animate-pulse">Invité_Std</span>
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1.5">> Email_Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                   class="block w-full bg-slate-900 border-slate-700 rounded text-green-300 placeholder-slate-700 focus:border-green-500 focus:ring-green-500 py-2 px-3 border transition-colors font-mono text-sm shadow-inner" placeholder="admin@bughunter.ai">
            @error('email')
                <span class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest">[ FAIL ] {{ $message }}</span>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1.5">> Password_Crypted</label>
            <input id="password" type="password" name="password" required
                   class="block w-full bg-slate-900 border-slate-700 rounded text-green-300 placeholder-slate-700 focus:border-green-500 focus:ring-green-500 py-2 px-3 border transition-colors font-mono text-sm shadow-inner" placeholder="********">
            @error('password')
                <span class="text-red-500 text-[10px] mt-1 font-bold uppercase tracking-widest">[ FAIL ] {{ $message }}</span>
            @enderror
        </div>

        <div class="flex flex-col gap-4 mt-8">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-green-500 rounded bg-green-600 hover:bg-green-500 text-black text-xs font-black uppercase tracking-[0.3em] transition-all shadow-[0_0_15px_rgba(34,197,94,0.2)] active:scale-95">
                Authentifier()
            </button>
            
            <a href="{{ route('register') }}" class="text-[10px] text-slate-600 hover:text-green-400 text-center uppercase tracking-widest transition-colors">
                [ Créer un nouvel opérateur ]
            </a>
        </div>
    </form>
</x-guest-layout>
