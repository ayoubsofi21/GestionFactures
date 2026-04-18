<section class="space-y-6">
    <div class="flex items-center mb-4">
        <div class="w-10 h-10 rounded-full bg-marsa-accent bg-opacity-20 flex items-center justify-center mr-3">
            <i class="fas fa-key text-marsa-accent"></i>
        </div>
        <div>
            <h3 class="text-lg font-semibold text-gray-800">Modifier le mot de passe</h3>
            <p class="text-sm text-gray-500">Assurez-vous d'utiliser un mot de passe long et sécurisé</p>
        </div>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">
                Mot de passe actuel
            </label>
            <div class="relative">
                <input id="current_password" name="current_password" type="password" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-marsa-accent focus:border-transparent transition"
                       autocomplete="current-password">
                <button type="button" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600 toggle-password">
                    <i class="far fa-eye"></i>
                </button>
            </div>
            @error('current_password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- New Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                Nouveau mot de passe
            </label>
            <div class="relative">
                <input id="password" name="password" type="password" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-marsa-accent focus:border-transparent transition"
                       autocomplete="new-password">
                <button type="button" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600 toggle-password">
                    <i class="far fa-eye"></i>
                </button>
            </div>
            <p class="mt-1 text-xs text-gray-500">
                Minimum 8 caractères, avec majuscules, minuscules et chiffres
            </p>
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                Confirmer le mot de passe
            </label>
            <div class="relative">
                <input id="password_confirmation" name="password_confirmation" type="password" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-marsa-accent focus:border-transparent transition"
                       autocomplete="new-password">
                <button type="button" class="absolute right-3 top-2.5 text-gray-400 hover:text-gray-600 toggle-password">
                    <i class="far fa-eye"></i>
                </button>
            </div>
            @error('password_confirmation')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex items-center gap-4 pt-2">
            <button type="submit" 
                    class="px-5 py-2.5 bg-marsa-accent hover:bg-marsa-light-blue text-white rounded-lg font-medium transition flex items-center">
                <i class="fas fa-save mr-2"></i>
                Enregistrer
            </button>

            @if (session('status') === 'password-updated')
                <div class="flex items-center text-sm text-green-600">
                    <i class="fas fa-check-circle mr-2"></i>
                    Mot de passe mis à jour avec succès
                </div>
            @endif
        </div>
    </form>
</section>

<script>
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    });
</script>