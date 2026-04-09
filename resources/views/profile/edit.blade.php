<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-green-400 leading-tight font-mono">
            > OPERATOR_PROFILE // ENCRYPTED_DATA
        </h2>
    </x-slot>

    <div class="py-12 theme-bg-deep min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Operator Identity Card -->
            <div class="theme-bg-panel border-2 theme-border rounded-lg overflow-hidden theme-glow">
                <div class="p-8 flex flex-col md:flex-row items-center gap-8">
                    <!-- Photo Section -->
                    <div class="relative group">
                        <div class="size-32 rounded border-4 theme-border-primary overflow-hidden shadow-[0_0_15px_var(--primary-glow)] theme-bg-deep flex items-center justify-center">
                            <img id="avatar_preview" src="{{ auth()->user()->avatar_url }}" alt="Profile" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute -bottom-2 -right-2 theme-bg-deep border theme-border-primary theme-primary text-[10px] font-black px-2 py-1 rounded-sm uppercase tracking-tighter">
                            Active
                        </div>
                    </div>

                    <!-- Info Section -->
                    <div class="flex-grow text-center md:text-left">
                        <h3 class="text-3xl font-black text-white font-mono uppercase tracking-tighter mb-1">
                            {{ auth()->user()->name }}
                        </h3>
                        <div class="flex flex-wrap justify-center md:justify-start gap-4 mt-4">
                            <div class="px-4 py-2 theme-bg-deep border theme-border rounded shadow-inner">
                                <span class="block text-[9px] uppercase tracking-widest text-slate-500 mb-1">Reputation_Points</span>
                                <span class="theme-primary font-bold text-xl font-mono">{{ number_format(auth()->user()->global_score) }} XP</span>
                            </div>
                            <div class="px-4 py-2 theme-bg-deep border theme-border rounded shadow-inner">
                                <span class="block text-[9px] uppercase tracking-widest text-slate-500 mb-1">Current_Streak</span>
                                <span class="text-orange-500 font-bold text-xl font-mono uppercase">
                                    {{ auth()->user()->current_streak }} 🔥
                                </span>
                            </div>
                            <div class="px-4 py-2 theme-bg-deep border theme-border rounded shadow-inner">
                                <span class="block text-[9px] uppercase tracking-widest text-slate-500 mb-1">Operator_Grade</span>
                                <span class="text-blue-400 font-bold text-xl font-mono uppercase">
                                    @if(auth()->user()->global_score > 5000) Elite_Hunter
                                    @elseif(auth()->user()->global_score > 1000) Active_Agent
                                    @else Rookie_Op @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Badges Showcase -->
                @if(auth()->user()->badges->count() > 0)
                <div class="bg-black/20 border-t border-slate-700 p-4">
                    <span class="block text-[9px] uppercase tracking-[0.3em] font-black text-slate-600 mb-3 ml-2">// Unlocked_Specialized_Skillset</span>
                    <div class="flex flex-wrap gap-4">
                        @foreach(auth()->user()->badges as $badge)
                        <div class="flex items-center gap-2 bg-slate-800/50 border theme-border p-2 rounded group relative hover:theme-border-primary transition-all cursor-help" title="{{ $badge->description }}">
                            <div class="theme-primary">
                                @if($badge->icon === 'zap') <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                @elseif($badge->icon === 'database') <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                @elseif($badge->icon === 'shield-check') <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                @elseif($badge->icon === 'ghost') <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 11V9a2 2 0 00-2-2m-1 7l3 3m-3-3l-3-3m3 3l3-3m-3 3l-3 3M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                @elseif($badge->icon === 'flame') <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.99 7.99 0 0120 13a7.99 7.99 0 01-2.343 5.657z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                @elseif($badge->icon === 'target') <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                @endif
                            </div>
                            <span class="text-[10px] uppercase font-black tracking-widest text-white">{{ $badge->name }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Configuration Terminal -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Profile Information -->
                <div class="theme-bg-panel p-6 rounded border theme-border shadow-lg">
                    <div class="mb-6 flex items-center gap-2 border-b theme-border pb-2">
                        <span class="theme-primary text-sm font-black">></span>
                        <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Update_Profile_Info</h4>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('patch')

                        <div class="grid grid-cols-1 gap-4">
                            <div>
                                <label for="name" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1.5">> Operator_Name</label>
                                <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}" required
                                       class="block w-full theme-bg-deep theme-border rounded theme-primary placeholder-slate-700 focus:theme-border-primary focus:ring-1 focus:ring-green-500 py-2 px-3 border transition-colors font-mono text-sm shadow-inner">
                                <x-forms.input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <label for="email" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1.5">> Email_Internal</label>
                                <input id="email" name="email" type="email" value="{{ old('email', auth()->user()->email) }}" required
                                       class="block w-full theme-bg-deep theme-border rounded theme-primary placeholder-slate-700 focus:theme-border-primary focus:ring-1 focus:ring-green-500 py-2 px-3 border transition-colors font-mono text-sm shadow-inner">
                                <x-forms.input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <div>
                                <label for="theme" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1.5">> UI_Terminal_Theme</label>
                                <select id="theme" name="theme" 
                                        class="block w-full theme-bg-deep theme-border rounded theme-primary focus:theme-border-primary focus:ring-1 focus:ring-green-500 py-2 px-3 border transition-colors font-mono text-sm shadow-inner">
                                    <option value="matrix" {{ auth()->user()->theme === 'matrix' ? 'selected' : '' }}>MATRIX (Classic Green)</option>
                                    <option value="cyberpunk" {{ auth()->user()->theme === 'cyberpunk' ? 'selected' : '' }}>CYBERPUNK (Neon Fuchsia)</option>
                                    <option value="dark_web" {{ auth()->user()->theme === 'dark_web' ? 'selected' : '' }}>DARK WEB (Cruel Red)</option>
                                    <option value="bios" {{ auth()->user()->theme === 'bios' ? 'selected' : '' }}>BIOS (Legacy Blue)</option>
                                </select>
                                <x-forms.input-error class="mt-2" :messages="$errors->get('theme')" />
                            </div>

                            <div>
                                <label for="profile_photo" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1.5">> Update_Avatar (IMG)</label>
                                <input id="profile_photo_input" name="profile_photo" type="file" onchange="previewImage(event)"
                                       class="block w-full theme-bg-deep theme-border rounded text-slate-400 file:theme-bg-panel file:theme-primary file:border-0 file:py-1 file:px-3 file:mr-4 file:text-xs file:uppercase file:font-black focus:theme-border-primary border transition-colors font-mono text-[10px] py-1">
                                <x-forms.input-error class="mt-2" :messages="$errors->get('profile_photo')" />
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <button type="submit" class="theme-bg-deep border theme-border-primary theme-primary hover:theme-bg-panel px-6 py-2 rounded text-[10px] font-black uppercase tracking-widest transition-all shadow-[0_0_10px_var(--primary-glow)]">
                                Execute_Core_Update()
                            </button>
                            @if (session('status') === 'profile-updated')
                                <span class="theme-primary font-mono text-[10px] animate-pulse">[ SUCCESS_COMMITTED ]</span>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Update Password -->
                <div class="theme-bg-panel p-6 rounded border theme-border shadow-lg">
                    <div class="mb-6 flex items-center gap-2 border-b theme-border pb-2">
                        <span class="theme-primary text-sm font-black">></span>
                        <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Security_Protocol_Update</h4>
                    </div>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                        @csrf
                        @method('put')

                        <div>
                            <label for="current_password" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1.5">> Old_Cipher</label>
                            <input id="current_password" name="current_password" type="password"
                                   class="block w-full theme-bg-deep theme-border rounded theme-primary placeholder-slate-700 focus:theme-border-primary focus:ring-1 focus:ring-green-500 py-2 px-3 border transition-colors font-mono text-sm shadow-inner">
                            <x-forms.input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1.5">> New_Cipher</label>
                            <input id="password" name="password" type="password"
                                   class="block w-full theme-bg-deep theme-border rounded theme-primary placeholder-slate-700 focus:theme-border-primary focus:ring-1 focus:ring-green-500 py-2 px-3 border transition-colors font-mono text-sm shadow-inner">
                            <x-forms.input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4 pt-4">
                            <button type="submit" class="bg-slate-700 hover:bg-slate-600 text-white px-6 py-2 rounded text-[10px] font-black uppercase tracking-widest transition-all">
                                Re_Encrypt_Keys()
                            </button>
                            @if (session('status') === 'password-updated')
                                <span class="theme-primary font-mono text-[10px] animate-pulse">[ CIPHER_STRENGTHENED ]</span>
                            @endif
                        </div>
                    </form>
                </div>

            </div>

            <!-- Danger Zone -->
            <div class="bg-red-950/10 border-2 border-red-500/20 p-8 rounded-lg flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <h5 class="text-red-500 font-black uppercase tracking-widest font-mono text-lg">[ TERMINATE_OPERATOR_ACCOUNT ]</h5>
                    <p class="text-slate-500 text-xs mt-1 font-mono uppercase tracking-widest">Une fois que vous supprimez votre compte, toutes vos données seront dé-encryptées et détruites.</p>
                </div>
                
                <form method="post" action="{{ route('profile.destroy') }}" class="flex items-center gap-4">
                    @csrf
                    @method('delete')
                    <input name="password" type="password" placeholder="Verify_Password" required
                           class="theme-bg-deep border-red-900/40 rounded text-red-400 placeholder-red-900/50 focus:border-red-500 focus:ring-red-500 py-1.5 px-3 border transition-colors font-mono text-[10px] shadow-inner">
                    <button type="submit" class="border border-red-600 bg-red-600/10 hover:bg-red-600 text-red-500 hover:text-white px-4 py-2 rounded text-[10px] font-black uppercase tracking-widest transition-all">
                        SELF_DESTRUCT
                    </button>
                </form>
            </div>

        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('avatar_preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-app-layout>
