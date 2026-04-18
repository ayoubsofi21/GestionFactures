<!-- Make sure Alpine.js is loaded in your layout -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<section class="bg-white rounded-xl shadow-sm overflow-hidden border border-red-200" x-data="{ showModal: false }">
    <div class="p-6">
        <div class="flex items-start">
            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center mr-3 flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-red-600"></i>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Supprimer le compte</h3>
                <p class="text-sm text-gray-600 mt-1">
                    Une fois votre compte supprimé, toutes ses données seront définitivement perdues. 
                    Pensez à sauvegarder vos informations importantes avant de continuer.
                </p>
            </div>
        </div>

        <div class="mt-6">
            <button
                @click="showModal = true"
                class="px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition flex items-center"
            >
                <i class="fas fa-trash-alt mr-2"></i> Supprimer mon compte
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div 
        x-show="showModal" 
        x-transition 
        class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
    >
        <div 
            class="bg-white w-full max-w-md mx-auto rounded-xl shadow-lg p-6 relative"
            @click.outside="showModal = false"
        >
            <div class="flex items-start mb-4">
                <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center mr-3 flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-red-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">Êtes-vous absolument sûr ?</h3>
                    <p class="text-sm text-gray-600 mt-1">
                        Cette action est irréversible. Toutes vos données seront définitivement supprimées.
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-4">
                @csrf
                @method('delete')

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        Confirmez avec votre mot de passe
                    </label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent transition"
                        placeholder="Votre mot de passe actuel"
                        required
                    />
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3 pt-2">
                    <button 
                        type="button" 
                        @click="showModal = false"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition"
                    >
                        Annuler
                    </button>
                    <button 
                        type="submit" 
                        class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition flex items-center"
                    >
                        <i class="fas fa-trash-alt mr-2"></i> Supprimer définitivement
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
