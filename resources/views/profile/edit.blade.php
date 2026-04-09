<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-green-400 leading-tight font-mono">
            > OPERATOR_PROFILE // ENCRYPTED_DATA
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Operator Identity Card -->
            <div class="bg-gray-800 border-2 border-green-500/30 rounded-lg overflow-hidden shadow-[0_0_20px_rgba(34,197,94,0.1)]">
                <div class="p-8 flex flex-col md:flex-row items-center gap-8">
                    <!-- Photo Section -->
                    <div class="relative group">
                        <div class="size-32 rounded border-4 border-green-500/50 overflow-hidden shadow-[0_0_15px_rgba(34,197,94,0.3)] bg-slate-900 flex items-center justify-center">
                            <img src="{{ auth()->user()->avatar_url }}" alt="Profile" class="w-full h-full object-cover">
                        </div>
                        <div class="absolute -bottom-2 -right-2 bg-green-500 text-black text-[10px] font-black px-2 py-1 rounded-sm uppercase tracking-tighter">
                            Active
                        </div>
                    </div>

                    <!-- Info Section -->
                    <div class="flex-grow text-center md:text-left">
                        <h3 class="text-3xl font-black text-white font-mono uppercase tracking-tighter mb-1">
                            {{ auth()->user()->name }}
                        </h3>
                        <div class="flex flex-wrap justify-center md:justify-start gap-4 mt-4">
                            <div class="px-4 py-2 bg-slate-900 border border-slate-700 rounded shadow-inner">
                                <span class="block text-[9px] uppercase tracking-widest text-slate-500 mb-1">Reputation_Points</span>
                                <span class="text-green-500 font-bold text-xl font-mono">{{ number_format(auth()->user()->global_score) }} XP</span>
                            </div>
                            <div class="px-4 py-2 bg-slate-900 border border-slate-700 rounded shadow-inner">
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
            </div>

            <!-- Configuration Terminal -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Profile Information -->
                <div class="bg-gray-800 p-6 rounded border border-slate-700 shadow-lg">
                    <div class="mb-6 flex items-center gap-2 border-b border-slate-700 pb-2">
                        <span class="text-green-500 text-sm font-black">></span>
                        <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Update_Profile_Info</h4>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="name" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1.5">> Operator_Name</label>
                            <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}" required
                                   class="block w-full bg-slate-900 border-slate-700 rounded text-green-300 placeholder-slate-700 focus:border-green-500 focus:ring-green-500 py-2 px-3 border transition-colors font-mono text-sm shadow-inner">
                            <x-forms.input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <label for="email" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1.5">> Email_Internal</label>
                            <input id="email" name="email" type="email" value="{{ old('email', auth()->user()->email) }}" required
                                   class="block w-full bg-slate-900 border-slate-700 rounded text-green-300 placeholder-slate-700 focus:border-green-500 focus:ring-green-500 py-2 px-3 border transition-colors font-mono text-sm shadow-inner">
                            <x-forms.input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>

                        <div>
                            <label for="profile_photo" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1.5">> Update_Avatar (IMG)</label>
                            <input id="profile_photo" name="profile_photo" type="file"
                                   class="block w-full bg-slate-900 border-slate-700 rounded text-slate-400 file:bg-slate-800 file:text-green-500 file:border-0 file:py-1 file:px-3 file:mr-4 file:text-xs file:uppercase file:font-black focus:border-green-500 border transition-colors font-mono text-[10px] py-1">
                            <x-forms.input-error class="mt-2" :messages="$errors->get('profile_photo')" />
                        </div>

                        <div class="flex items-center gap-4 pt-2">
                            <button type="submit" class="bg-green-600 hover:bg-green-500 text-black px-4 py-2 rounded text-[10px] font-black uppercase tracking-widest transition-all">
                                Execute_Update()
                            </button>
                            @if (session('status') === 'profile-updated')
                                <span class="text-green-500 font-mono text-[10px] animate-pulse">[ SUCCESS_UPDATED ]</span>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Update Password -->
                <div class="bg-gray-800 p-6 rounded border border-slate-700 shadow-lg">
                    <div class="mb-6 flex items-center gap-2 border-b border-slate-700 pb-2">
                        <span class="text-green-500 text-sm font-black">></span>
                        <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">Security_Protocol_Update</h4>
                    </div>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
                        @csrf
                        @method('put')

                        <div>
                            <label for="current_password" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1.5">> Old_Cipher</label>
                            <input id="current_password" name="current_password" type="password"
                                   class="block w-full bg-slate-900 border-slate-700 rounded text-green-300 placeholder-slate-700 focus:border-green-500 focus:ring-green-500 py-2 px-3 border transition-colors font-mono text-sm shadow-inner">
                            <x-forms.input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password" class="block text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-1.5">> New_Cipher</label>
                            <input id="password" name="password" type="password"
                                   class="block w-full bg-slate-900 border-slate-700 rounded text-green-300 placeholder-slate-700 focus:border-green-500 focus:ring-green-500 py-2 px-3 border transition-colors font-mono text-sm shadow-inner">
                            <x-forms.input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4 pt-2">
                            <button type="submit" class="bg-slate-700 hover:bg-slate-600 text-white px-4 py-2 rounded text-[10px] font-black uppercase tracking-widest transition-all">
                                Re_Encrypt()
                            </button>
                            @if (session('status') === 'password-updated')
                                <span class="text-green-500 font-mono text-[10px] animate-pulse">[ CIPHER_STRENGTHENED ]</span>
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
                           class="bg-slate-900 border-red-900/40 rounded text-red-400 placeholder-red-900/50 focus:border-red-500 focus:ring-red-500 py-1.5 px-3 border transition-colors font-mono text-[10px] shadow-inner">
                    <button type="submit" class="border border-red-600 bg-red-600/10 hover:bg-red-600 text-red-500 hover:text-white px-4 py-2 rounded text-[10px] font-black uppercase tracking-widest transition-all">
                        SELF_DESTRUCT
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
