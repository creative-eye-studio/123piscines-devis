<template>
<div class="container">
    <!-- Configuration de la piscine -->
    <form action="">
        <div class="row">
            <!-- Image et prix -->
            <div class="col-7">
                <p class="text-end">Prix estimé : <span>0000,00</span> € TTC (Hors livraison et agrégats)</p>
                <img :src='"./uploads/images/piscines/" + basePoolImg' alt="Présentation de la piscine" class="img-fluid">
            </div>
            <!-- Configurateur -->
            <div class="col-5 accordion" id="list">
                <!-- Type de piscine -->
                <div class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#type-body" aria-expanded="true" aria-controls="collapseOne">
                            Type de piscine
                        </button>
                        <div id="type-body" class="accordion-collapse collapse" data-bs-parent="#list">
                            <div class="row m-3">
                                <div class="col-4 form-check">
                                    <input class="form-check-input" type="radio" name="type" id="origin" @click="getPiscinesListe('1')">
                                    <label class="form-check-label" for="origin">Piscines originales</label>
                                </div>
                                <div class="col-4 form-check">
                                    <input class="form-check-input" type="radio" name="type" id="classic" @click="getPiscinesListe('2')">
                                    <label class="form-check-label" for="classic">Piscines classiques</label>
                                </div>
                                <div class="col-4 form-check">
                                    <input class="form-check-input" type="radio" name="type" id="creative" @click="getPiscinesListe('3')">
                                    <label class="form-check-label" for="creative">Piscines créatives</label>
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="col-12">
                                    <label class="form-check-label" for="select-pool">Choisir sa piscine</label>
                                    <select class="form-select mb-2" id="select-pool" @change="this.getPiscinesDatas($event)">
                                        <option v-for="pool in poolsList" v-html="pool.nom" :value="pool.nom" :data-image="pool.image" :data-id="pool.id" :key="pool.id"></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dimensions et profondeur -->
                <div class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#dim-body" aria-expanded="true" aria-controls="collapseOne">
                            Dimensions et profondeur
                        </button>
                        <div id="dim-body" class="accordion-collapse collapse" data-bs-parent="#list">
                            <div class="m-3">
                                <label class="form-check-label" for="pool-dim">Dimensions</label>
                                <select class="form-select mb-3" id="pool-dim">
                                    <option v-for="size in sizes" v-html="size.taille" :key="size.id" :value="size.taille" :data-id="size.id" :data-prix="size.prix"></option>
                                </select>
                                <p class="form-check">
                                    <input class="form-check-input" type="radio" name="proof" id="fond-plat" @click="handleRadioClick('fond-plat')">
                                    <label class="form-check-label" for="fond-plat">Fond plat (1,50m de profondeur)</label>
                                </p>
                                <p class="form-check">
                                    <input class="form-check-input" type="radio" name="proof" id="fond-perso" @click="handleRadioClick('fond-perso')">
                                    <label class="form-check-label" for="fond-perso">Fond personnalisé</label>
                                </p>
                                <p class="col-12 mt-2">
                                    <label for="custom-proof" class="form-label">Personnaliser sa profondeur</label>
                                    <input class="form-control" name="custom-proof" id="custom-proof" type="text" disabled>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Escalier -->
                <div class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#escalier-body" aria-expanded="true" aria-controls="personnalisation-body">
                            Escalier
                        </button>
                    </div>
                    <div id="escalier-body" class="accordion-collapse collapse" data-bs-parent="#list">
                        <div class="row m-3">
                            <div class="col-6 form-check" v-for="item in escaliers" :key="item.id">
                                <input class="form-check-input" type="radio" name="escalier" :id="this.sanitizeTitle(item.nom)" :data-image="item.image">
                                <label class="form-check-label" :for="this.sanitizeTitle(item.nom)" v-html="item.nom"></label>
                            </div>
                            <div class="col-6 form-check">
                                <input class="form-check-input" type="radio" name="escalier" id="no-escalier" data-image="">
                                <label class="form-check-label" for="no-escalier" v-html='"Sans escalier"'></label>
                            </div>
                        </div>  
                    </div>
                </div>

                <!-- Petit bain / Échelle -->
                <div class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#perso-body" aria-expanded="true" aria-controls="personnalisation-body">
                            Petit bain / Échelle
                        </button>
                    </div>
                    <div id="perso-body" class="accordion-collapse collapse" data-bs-parent="#list">
                        <div class="row m-3">
                            <div class="col-4 form-check"><input class="form-check-input" type="radio" name="personnalisation" id="petit-bain"><label class="form-check-label" for="petit-bain">Petit-bain</label></div>
                            <div class="col-4 form-check"><input class="form-check-input" type="radio" name="personnalisation" id="echelle"><label class="form-check-label" for="echelle">Échelle</label></div>
                            <div class="col-4 form-check"><input class="form-check-input" type="radio" name="personnalisation" id="sans-perso"><label class="form-check-label" for="sans-perso">Sans personnalisation</label></div>
                        </div>    
                    </div>
                </div>
                
                <!-- Système de filtration -->
                <div class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#filter-body" aria-expanded="true" aria-controls="filter-body">
                            Système de filtration
                        </button>
                    </div>
                    <div id="filter-body" class="accordion-collapse collapse" data-bs-parent="#list">
                        <div class="row m-3">
                            <div class="col-6 form-check"><input class="form-check-input" type="radio" name="filtration" id="filtre-sable"><label class="form-check-label" for="filtre-sable">Filtre à sable</label></div>
                            <div class="col-6 form-check"><input class="form-check-input" type="radio" name="filtration" id="bloc-filtre"><label class="form-check-label" for="bloc-filtre">Bloc filtrant</label></div>
                            <div class="col-6 form-check"><input class="form-check-input" type="radio" name="filtration" id="eco-responsable"><label class="form-check-label" for="eco-responsable">Éco responsable</label></div>
                            <div class="col-6 form-check"><input class="form-check-input" type="radio" name="filtration" id="no-filter"><label class="form-check-label" for="no-filter">Sans rien</label></div>
                        </div>    
                    </div>
                </div>

                <!-- Revêtement -->
                <div class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#revet-body" aria-expanded="true" aria-controls="revet-body">
                            Revêtement
                        </button>
                    </div>
                    <div id="revet-body" class="accordion-collapse collapse" data-bs-parent="#list">
                        <div class="row m-3">
                            <div class="col-4 form-check"><input class="form-check-input" type="radio" name="revet" id="poly"><label class="form-check-label" for="poly">Revêtement polymère</label></div>
                            <div class="col-4 form-check"><input class="form-check-input" type="radio" name="revet" id="liner"><label class="form-check-label" for="liner">Liner</label></div>
                            <div class="col-4 form-check"><input class="form-check-input" type="radio" name="revet" id="no-revet"><label class="form-check-label" for="no-revet">Sans revêtement</label></div>
                        </div>    
                    </div>
                </div>

                <!-- Couleur -->
                <div class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#color-body" aria-expanded="true" aria-controls="collapseOne">
                            Couleur
                        </button>
                    </div>
                    <div id="color-body" class="accordion-collapse collapse" data-bs-parent="#list">
                        <div class="row m-3">
                            <div class="col-3 form-check" v-for="color in colors" :key="color.id">
                                <input class="form-check-input" type="radio" name="color" :id="this.sanitizeTitle(color.nom)">
                                <label class="form-check-label" :for="this.sanitizeTitle(color.nom)">{{ color.nom }}</label>
                            </div>
                        </div>    
                    </div>
                </div>

                <!-- Sécurité -->
                <div class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#secure-body" aria-expanded="true" aria-controls="collapseOne">
                            Sécurité
                        </button>
                    </div>

                    <div id="secure-body" class="accordion-collapse collapse" data-bs-parent="#list">
                        <div class="row m-3">
                            <div class="row mb-2">
                                <div class="col-1"><input class="form-check-input" type="radio" name="securite" id="alarme"></div>
                                <div class="col-11 form-check">
                                    <label class="form-check-label" for="alarme">
                                        <span>
                                            Alarme volumetrique
                                        </span>
                                        <span class="small d-block">
                                            Imperméable à l'eau. Perméable à la vapeur d'eau: laisse respirer le support. Bonne résistance chimique aux produits courants de traitement d'eau de piscine (SIKA).
                                        </span> 
                                    </label>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-1"><input class="form-check-input" type="radio" name="securite" id="couverture"></div>
                                <div class="col-11 form-check">
                                    <label class="form-check-label" for="couverture">
                                        <span>
                                            Couverture de sécurité
                                        </span>
                                        <span class="small d-block">
                                            Le liner d'une piscine est un revêtement en PVC souple qui assure l'étanchéité de la piscine.
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-1"><input class="form-check-input" type="radio" name="securite" id="barriere"></div>
                                <div class="col-11 form-check">
                                    <label class="form-check-label" for="barriere">
                                        <span>
                                            Barrière normalisée
                                        </span>
                                        <span class="small d-block">
                                            Le liner d'une piscine est un revêtement en PVC souple qui assure l'étanchéité de la piscine.
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-1"><input class="form-check-input" type="radio" name="securite" id="no-secure"></div>
                                <div class="col-11 form-check">
                                    <label class="form-check-label" for="no-secure">
                                        <span>
                                            Sans système de sécurité
                                        </span>
                                        <span class="small d-block">
                                            Texte RAPPEL de la norme.
                                        </span>
                                    </label>
                                </div>
                            </div>    
                        </div>
                    </div>

                </div>

                <!-- Contact -->
                <div class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#contact-body" aria-expanded="true" aria-controls="collapseOne">
                            Contact
                        </button>
                    </div>
                    <div id="contact-body" class="accordion-collapse collapse" data-bs-parent="#list">
                        <div class="row m-3">
                            <p class="col-12">
                                <label for="contact-nom" class="form-label">Votre nom</label>
                                <input class="form-control" type="text" id="contact-nom" name="contact-nom">
                            </p>
                            <p class="col-6">
                                <label for="contact-mail" class="form-label">Votre e-mail</label>
                                <input class="form-control" type="email" id="contact-mail" name="contact-mail">
                            </p>
                            <p class="col-6">
                                <label for="contact-tel" class="form-label">Votre téléphone</label>
                                <input class="form-control" type="tel" id="contact-tel" name="contact-tel">
                            </p>
                            <p class="col-12">
                                <label for="contact-sujet" class="form-label">Objet</label>
                                <input class="form-control" type="text" id="contact-sujet" name="contact-sujet">
                            </p>
                            <p class="col-12">
                                <label for="contact-message" class="form-label">Votre message</label>
                                <textarea class="form-control" name="contact-message" id="contact-message"></textarea>
                            </p>
                            <p><input type="submit" value="Envoyer ma demande de devis" @click.prevent="submitForm()"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
</template>

<script>
import SelectPiscine from './SelectPiscine.vue';
export default {
    components: { SelectPiscine },
    data() {
        return {
            basePoolImg: '',

            selectedPool: '',
            selectedSize: '',
            selectedOption: '',
            disabledCustomProof: false,
            poolsList: [
                {
                    'id': 0,
                    'nom': "Choisir un type de piscine",
                    'image': ''
                },
            ],
            sizes: [
                {
                    'id': 0,
                    'taille': "Sélectionnez une piscine",
                    'prix': 0.00,
                }
            ],
            colors: [
                {'nom': "Bleu"}
            ],
            escaliers: [
                {
                    'id': 0,
                    'nom': "Haut - Droite",
                    'image': "image",
                    'prix':	6.45
                }
            ]
            
        };
    },
    methods: {
        async getPiscinesListe(id) {
            this.selectedPool = id;
            try {
                const response = await fetch('/api/pool/' + this.selectedPool);
                this.poolsList = await response.json();
            } catch (error) {
                console.error('Erreur lors de la récupération des données:', error);
            }
        },

        async getPiscinesDatas(e) {
            const targetId = e.target.options[e.target.options.selectedIndex].dataset;
            this.basePoolImg = targetId.image;
            this.getPiscineTailles(e);
            this.getPiscineEscaliers(e);
            this.getPiscineColors(e);
        },

        async getPiscineTailles(e) {
            if (e.target.options.selectedIndex > -1) {
                const targetId = e.target.options[e.target.options.selectedIndex].dataset;
                try {
                    const response = await fetch('/api/pool-size/' + targetId.id);
                    this.sizes = await response.json();
                } catch (error) {
                    console.error('Erreur lors de la récupération des données:', error);
                }
            }
        },

        async getPiscineEscaliers(e) {
            if (e.target.options.selectedIndex > -1) {
                const targetId = e.target.options[e.target.options.selectedIndex].dataset;
                try {
                    const response = await fetch('/api/pool-esc/' + targetId.id);
                    this.escaliers = await response.json();
                } catch (error) {
                    console.error('Erreur lors de la récupération des données:', error);
                }
            }
        },

        async getPiscineColors(e) {
            if (e.target.options.selectedIndex > -1) {
                const targetId = e.target.options[e.target.options.selectedIndex].dataset;
                try {
                    const response = await fetch('/api/pool-colors/' + targetId.id);
                    this.colors = await response.json();
                } catch (error) {
                    console.error('Erreur lors de la récupération des données:', error);
                }
            }
        },

        handleRadioClick(value) {
            this.selectedOption = value;
            this.enableCustomProof();
        },

        enableCustomProof() {
            const customHole = document.querySelector('#custom-proof');
            customHole.disabled = this.selectedOption !== "fond-perso";
        },

        submitForm() {
            var type = document.querySelector('input[name="type"]:checked').value;
            var pool = document.querySelector('#select-pool').value;
            var dims = document.querySelector('#pool-dim').value;
            var proof = document.querySelector('input[name="proof"]:checked').value;
            var customProof = document.querySelector('#custom-proof').value;
            var personnalisation = document.querySelector('input[name="personnalisation"]:checked').value;
            var filtration = document.querySelector('input[name="filtration"]:checked').value;
            var revet = document.querySelector('input[name="revet"]:checked').value;
            var color = document.querySelector('input[name="color"]:checked').value;
            var securite = document.querySelector('input[name="securite"]:checked').value;
        },

        sanitizeTitle: function(title) {
            var slug = "";
            // Change to lower case
            var titleLower = title.toLowerCase();
            // Letter "e"
            slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e');
            // Letter "a"
            slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a');
            // Letter "o"
            slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o');
            // Letter "u"
            slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u');
            // Letter "d"
            slug = slug.replace(/đ/gi, 'd');
            // Trim the last whitespace
            slug = slug.replace(/\s*$/g, '');
            // Change whitespace to "-"
            slug = slug.replace(/\s+/g, '-');
            
            return slug;
        }
    },
}
</script>