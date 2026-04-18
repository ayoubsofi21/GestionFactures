<section class="space-y-6">
    <div class="flex items-center mb-4">
        <div class="w-10 h-10 rounded-full bg-marsa-accent bg-opacity-20 flex items-center justify-center mr-3">
            <i class="fas fa-user-edit text-marsa-accent"></i>
        </div>
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Informations du profil</h3>
            <p class="text-sm text-gray-500">Modifiez vos informations personnelles et votre adresse e-mail</p>
        </div>
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <!-- Name Field -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                Nom complet
            </label>
            <input id="name" name="name" type="text" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-marsa-accent focus:border-transparent transition"
                   value="{{ old('name', $user->name) }}" 
                   required 
                   autofocus 
                   autocomplete="name">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Field -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                Adresse e-mail
            </label>
            <input id="email" name="email" type="email" 
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-marsa-accent focus:border-transparent transition"
                   value="{{ old('email', $user->email) }}" 
                   required 
                   autocomplete="email">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror

            <!-- Email Verification Section -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-yellow-50 border-l-4 border-yellow-400 rounded">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 pt-0.5">
                            <i class="fas fa-exclamation-circle text-yellow-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700">
                                Votre adresse email n'est pas vérifiée.
                            </p>
                            <div class="mt-2 flex items-center space-x-3">
                                <button form="send-verification" 
                                        class="inline-flex items-center px-3 py-1 border border-gray-300 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    <i class="fas fa-paper-plane mr-2 text-marsa-accent"></i>
                                    Renvoyer l'email de vérification
                                </button>
                                @if (session('status') === 'verification-link-sent')
                                    <span class="text-sm text-green-600 flex items-center">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Lien envoyé !
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="flex items-center gap-4 pt-2">
            <button type="submit" 
                    class="px-5 py-2.5 bg-marsa-accent hover:bg-marsa-light-blue text-white rounded-lg font-medium transition flex items-center">
                <i class="fas fa-save mr-2"></i>
                Enregistrer les modifications
            </button>

            @if (session('status') === 'profile-updated')
                <div class="flex items-center text-sm text-green-600">
                    <i class="fas fa-check-circle mr-2"></i>
                    Profil mis à jour avec succès
                </div>
            @endif
        </div>
    </form>
</section>