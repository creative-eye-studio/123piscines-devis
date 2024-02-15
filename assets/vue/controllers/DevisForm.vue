<template>
<div class="container">
    <!-- Configuration de la piscine -->
    <form @change="this.updatePrice()">
        <div class="row flex-md-row-reverse">
            <!-- Configurateur -->
            <div class="col-12 col-md-5 accordion" id="list">
                <!-- Type de piscine -->
                <div class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#type-body" aria-expanded="true" aria-controls="collapseOne">
                            Piscine
                        </button>
                        <div id="type-body" class="accordion-collapse collapse" data-bs-parent="#list">
                            <div class="row m-2">
                                <div class="col-12">
                                    <label class="form-check-label" for="select-pool">Choisir sa piscine</label>
                                    <select class="form-select mb-2" id="select-pool" @change="this.getPiscinesDatas($event)">
                                        <option value=""></option>
                                        <option 
                                            v-for="pool in poolsList" 
                                            v-html="pool.nom" 
                                            :value="pool.nom" 
                                            :data-nom="pool.nom" 
                                            :data-id="pool.id" 
                                            :data-image="pool.image" 
                                            :data-fond="pool.fond"
                                            :data-eau="pool.eau"
                                            :data-prix="pool.prix"
                                            :key="pool.id"></option>
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
                                <select class="form-select mb-3" id="pool-dim" @change="this.getPiscineFilters($event)">
                                    <option value="" data-prix='0'></option>
                                    <option 
                                        v-for="size in sizes" 
                                        v-html="size.taille" 
                                        :key="size.id" 
                                        :value="size.taille" 
                                        :data-size="size.taille" 
                                        :data-id="size.id" 
                                        :data-prix=size.prix
                                        :data-image=size.image
                                        :data-alarme=size.alarme
                                        :data-cover=size.cover
                                        :data-barrier=size.barrier
                                        :data-revet=size.revet_poly
                                        :data-liner=size.liner
                                        :data-alarmeprix=size.alarme_prix
                                        :data-coverprix=size.cover_prix
                                        :data-barrierprix=size.barrier_prix
                                        :data-revetprix=size.revet_poly_prix
                                        :data-linerprix=size.liner_prix></option>
                                </select>
                                <p class="form-check">
                                    <input class="form-check-input" type="radio" name="proof" id="fond-plat" @click="handleProofClick('fond-plat')">
                                    <label class="form-check-label" for="fond-plat">Fond plat (1,50m de profondeur)</label>
                                </p>
                                <p class="form-check">
                                    <input class="form-check-input" type="radio" name="proof" id="fond-perso" @click="handleProofClick('fond-perso')">
                                    <label class="form-check-label" for="fond-perso">Fond personnalisé</label>
                                </p>
                                <p class="col-12 mt-2">
                                    <label for="custom-proof" class="form-label">Personnaliser sa profondeur</label>
                                    <input class="form-control" name="custom-proof" id="custom-proof" type="text" v-model="customProof" disabled>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Equipement -->
                <div class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#escalier-body" aria-expanded="true" aria-controls="personnalisation-body">
                            Personnalisation
                        </button>
                    </div>
                    <div id="escalier-body" class="accordion-collapse collapse" data-bs-parent="#list">
                        <div class="row m-3">
                            <div class="col-4 form-check" v-for="item in escaliers" :key="item.id">
                                <input class="form-check-input" type="radio" name="escalier" :id="this.sanitizeTitle(item.nom)" :data-nom=item.nom :data-prix=item.prix :data-image="item.image" @change="this.getEscalierPrix($event)" v-model="selectedEscIndex" :value="accessoires[item.type] + ' - (' +  item.nom + ') | ' + item.image">
                                <label class="form-check-label" :for="this.sanitizeTitle(item.nom)" v-html="accessoires[item.type] + ' - (' +  item.nom + ')'"></label>
                            </div>
                            <div class="col-4 form-check">
                                <input class="form-check-input" type="radio" name="escalier" id="no-escalier" data-nom="Sans personnalisation" data-image="" data-prix='0' @change="this.getEscalierPrix($event)" v-model="selectedEscIndex" value="Sans personnalisation | ">
                                <label class="form-check-label" for="no-escalier" v-html='"Sans personnalisation"'></label>
                            </div>
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
                            <div class="col-6 form-check" v-for="filter in filters" :key="index">
                                <input 
                                    class="form-check-input" 
                                    type="radio" 
                                    name="filtration" 
                                    :id="this.sanitizeTitle(filtersList[filter.type].name)"  
                                    :value="filtersList[filter.type].name"
                                    :data-nom="filtersList[filter.type].name"
                                    :data-prix=filter.prix
                                    :data-image="filter.image"
                                    @click="this.getFilterPrix($event)">
                                <label 
                                    class="form-check-label" 
                                    v-html="filtersList[filter.type].name"
                                    :for="this.sanitizeTitle(filtersList[filter.type].name)"></label>
                            </div>

                            <div class="col-6 form-check">
                                <input class="form-check-input" type="radio" name="filtration" id="no-filter"
                                    data-nom="Sans rien"
                                    data-prix=0
                                    data-image=''
                                    @click="this.getFilterPrix($event)">
                                <label class="form-check-label" for="no-filter">Sans système de filtration</label>
                            </div>
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
                            <div class="col-6 form-check" v-if="this.revetPolyBool">
                                <input class="form-check-input" type="radio" name="revet" v-model="selectedRevetIndex" id="poly" :value="'Revètement polymère | ' + revetPolyPrice" @change="handleRevetChange()">
                                <label class="form-check-label" for="poly">Revêtement polymère</label>
                            </div>
                            <div class="col-6 form-check" v-if="this.linerBool">
                                <input class="form-check-input" type="radio" name="revet" v-model="selectedRevetIndex" id="liner" :value="'Liner | ' + linerPrice" @change="handleRevetChange()">
                                <label class="form-check-label" for="liner">Liner</label>
                            </div>
                            <div class="col-6 form-check">
                                <input class="form-check-input" type="radio" name="revet" v-model="selectedRevetIndex" id="no-revet" :value="'Sans revêtement | 0'" @change="handleRevetChange()">
                                <label class="form-check-label" for="no-revet">Sans revêtement</label>
                            </div>
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
                                <input class="form-check-input" type="radio" name="color" 
                                :value="color.nom + ' | ' + color.image"
                                :id="this.sanitizeTitle(color.nom)"
                                :data-color="color.image"
                                v-model="selectedColorIndex" 
                                @change="handleColorChange"
                                >
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
                            <div class="row mb-2" v-if="this.alarmBool">
                                <div class="col-1">
                                    <input class="form-check-input" type="radio" name="securite" id="alarme" :value="'Alarme volumétrique | ' + alarmPrice" v-model="selectedSecurityIndex" @change="handleSecurityChange">
                                </div>
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

                            <div class="row mb-2" v-if="this.coverBool">
                                <div class="col-1">
                                    <input class="form-check-input" type="radio" name="securite" id="couverture" :value="'Couverture de sécurité | ' + coverPrice" v-model="selectedSecurityIndex" @change="handleSecurityChange">
                                </div>
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

                            <div class="row mb-2" v-if="this.barrierBool">
                                <div class="col-1">
                                    <input class="form-check-input" type="radio" name="securite" id="barriere" :value="'Barrière normalisée | ' + barrierPrice" v-model="selectedSecurityIndex" @change="handleSecurityChange">
                                </div>
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
                                <div class="col-1"><input class="form-check-input" type="radio" name="securite" id="no-secure" value='Sans système de sécurité | 0' v-model="selectedSecurityIndex" @change="handleSecurityChange"></div>
                                <div class="col-11 form-check">
                                    <label class="form-check-label" for="no-secure">
                                        <span>
                                            Sans système de sécurité
                                        </span>
                                        <span class="small d-block">
                                            <a href="/uploads/loi-piscines.pdf" download>Voir la norme sur la sécurité..</a>
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
                            Finalisez votre demande
                        </button>
                    </div>
                    <div id="contact-body" class="accordion-collapse collapse" data-bs-parent="#list">
                        <div class="row m-3 pt-3">
                            <p class="col-12">
                                <label for="contact-nom" class="form-label">Votre nom</label>
                                <input class="form-control" type="text" id="contact-nom" name="contact-nom" v-model="this.nom">
                            </p>
                            <p class="col-6">
                                <label for="contact-mail" class="form-label">Votre e-mail</label>
                                <input class="form-control" type="email" id="contact-mail" name="contact-mail" v-model="this.mail">
                            </p>
                            <p class="col-6">
                                <label for="contact-tel" class="form-label">Votre téléphone</label>
                                <input class="form-control" type="tel" id="contact-tel" name="contact-tel" v-model="this.tel">
                            </p>
                            <p class="col-12">
                                <label for="contact-message" class="form-label">Votre message</label>
                                <textarea class="form-control" name="contact-message" id="contact-message" v-model="this.message"></textarea>
                            </p>
                            <p id="mail-response" class="text-light p-3"></p>
                            <p class="mt-3">
                                <button type="submit" @click="submitForm" class="btn btn-primary">Envoyer ma demande de devis</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Image et prix -->
            <div class="col-12 col-md-7 position-relative">
                <p class="text-end">
                    <strong>Prix estimé : <span v-html="this.quotePrice"></span> € TTC (Hors livraison et agrégats)</strong>
                </p>
                <figure class="position-relative mt-3 img-config-container">
                    <img v-if="basePoolImg != ''" :src='"./uploads/images" + basePoolImg' alt="Présentation de la piscine" class="img-fluid position-absolute">
                    <img v-if="basePoolImgFond != '' && this.selectedProof !== ''" :src='"./uploads/images" + basePoolImgFond' alt="Présentation de la piscine en fond" class="img-fluid position-absolute">
                    <img v-if="basePoolImgEsc != ''" :src='"./uploads/images/escs/" + basePoolImgEsc' alt="Présentation de la couleur de la piscine" class="img-fluid position-absolute">
                    <img v-if="basePoolImgColor != ''" :src='"./uploads/images/colors/" + basePoolImgColor' alt="Présentation de la couleur" class="img-fluid position-absolute pool-color">
                    <img v-if="basePoolImgFilter != ''" :src='"./uploads/images/filters/" + basePoolImgFilter' alt="Présentation de la filtration" class="img-fluid position-absolute">
                    <img v-if="basePoolImgWater != ''" :src='"./uploads/images" + basePoolImgWater' alt="Présentation de la piscine en eau" class="img-fluid position-absolute pool-water">
                </figure>
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
            pricePoolForm: null,
            pricePoolSize: null,
            priceEscForm: null,
            priceFilterForm: null,
            priceRevetForm: null,

            alarmBool: false,
            alarmPrice: 0,
            coverBool: false,
            coverPrice: 0,
            barrierBool: false,
            barrierPrice: 0,
            revetPolyBool: false,
            revetPolyPrice: 0,
            linerBool: false,
            linerPrice: 0,

            securityPrice: 0,
            selectedSecurityIndex: null,
            selectedEscIndex: null,
            selectedColorIndex: null,
            selectedRevetIndex: null,

            quotePrice: parseFloat(0),

            accessoires: ["Petit bain", "Escalier", "Échelle", "Revètement polymère", "SPA à débordement", "Alarme volumétrique", "Couverture de sécurité", "Barrière normalisée"],

            filtersList: [
                {'name': "Filtre à sable"},
                {'name': "Bloc filtrant"},
                {'name': "Eco Responsable"},
                {'name': "Sans filtration"},
            ],

            basePoolImg: '',
            basePoolImgFond: '',
            basePoolImgWater: '',
            basePoolImgEsc: '',
            basePoolImgFilter: '',
            basePoolImgColor: '',
            basePoolId: '0',

            poolName: "",
            poolSize: "",
            selectedProof: '',
            customProof: "",
            equip: "",
            poolFilter: "",
            poolRevet: "",
            poolColor: "",
            poolSecurity: "",

            nom: "",
            mail: "",
            tel: "",
            message: "",

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
            ],
            filters: [
                {
                    'id': 11,
                    'type': 1,
                    'prix': 0,
                    'image': "img.jpg"
                }
            ]
            
        };
    },
    mounted() {
        this.getPiscinesListe()
    },
    methods: {
        calculateSum(...values) {
            return values.reduce((acc, value) => acc + value, 0);
        },

        async updatePrice() {
            // Piscine
            const sizePrice = parseFloat(this.priceSizeForm) || 0;
            const escPrice = parseFloat(this.priceEscForm) || 0;
            const filterPrice = parseFloat(this.priceFilterForm) || 0;
            const securityPrice = parseFloat(this.securityPrice) || 0;
            const priceRevet = parseFloat(this.priceRevetForm) || 0;
            this.quotePrice = parseFloat(sizePrice + escPrice + filterPrice + securityPrice + priceRevet) || parseFloat(0.00);
        },

        async getPiscinesListe() {
            try {
                const response = await fetch('/api/pools');
                this.poolsList = await response.json();
            } catch (error) {
                console.error('Erreur lors de la récupération des données:', error);
            }
        },

        async getPiscinesDatas(e) {
            if (e.target.options[e.target.options.selectedIndex].dataset != undefined) {
                const targetId = e.target.options[e.target.options.selectedIndex].dataset;
                this.poolName = targetId;
                this.basePoolImg = '/piscines/' + targetId.image;
                this.basePoolImgFond = '/piscines/' + targetId.fond;
                this.basePoolImgWater = '/piscines/' + targetId.eau;
                this.basePoolId = targetId.id;
                this.pricePoolForm = targetId.prix;
                this.getPiscineTailles(e);
                this.getPiscineColors(e);    
            }
        },

        async getPiscineTailles(e) {
            if (e.target.options.selectedIndex > -1) {
                const targetId = e.target.options[e.target.options.selectedIndex].dataset;
                try {
                    const response = await fetch('/api/pool-size/' + targetId.id);
                    if (!response.ok) {
                        return;
                    }
                    this.sizes = await response.json();
                } catch (error) {
                    console.error('Erreur lors de la récupération des données:', error);
                }
            }
        },

        async getPiscineEscaliers(id) {
            try {
                const response = await fetch('/api/pool-esc/' + id);
                this.escaliers = await response.json();
            } catch (error) {
                console.error('Erreur lors de la récupération des données:', error);
            }
        },

        async getEscalierPrix(e) {
            const targetId = e.target.dataset;
            this.priceEscForm = targetId.prix;
            this.handleEscChange()
        },

        async getPiscineFilters(e) {
            if (e.target !== undefined && e.target.options.selectedIndex > -1) { 
                const targetId = e.target.options[e.target.options.selectedIndex].dataset;
                this.poolSize = targetId;
                this.basePoolImg = '/tailles/' + targetId.image;
                this.priceSizeForm = targetId.prix;

                // Revetement
                this.revetPolyBool = JSON.parse(targetId.revet);
                this.linerBool = JSON.parse(targetId.liner);
                this.revetPolyPrice = targetId.revetprix;
                this.linerPrice = targetId.linerprix;

                // Alarmes
                this.alarmBool = JSON.parse(targetId.alarme);
                this.coverBool = JSON.parse(targetId.cover);
                this.barrierBool = JSON.parse(targetId.barrier);
                this.alarmPrice = targetId.alarmeprix;
                this.coverPrice = targetId.coverprix;
                this.barrierPrice = targetId.barrierprix;

                try {

                    // Filtres
                    const response = await fetch('/api/pool-filters/' + this.basePoolId + '/' + targetId.id);
                    if (!response.ok) {
                        return;
                    }
                    this.getPiscineEscaliers(targetId.id)
                    this.filters = await response.json();
                } catch (error) {
                    console.error('Erreur lors de la récupération des données:', error);
                }
            }
        },

        async getFilterPrix(e) {
            const targetId = e.target.dataset;
            this.poolFilter = targetId.nom;
            this.priceFilterForm = targetId.prix;
            this.basePoolImgFilter = targetId.image;
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

        handleSecurityChange() {
            const [name, price] = this.selectedSecurityIndex.split('|');
            this.securityPrice = parseFloat(price);
            this.poolSecurity = name;
        },

        handleEscChange() {
            if (this.selectedEscIndex !== null) {
                const [name, imageFileName] = this.selectedEscIndex.split('|').map(part => part.trim());
                this.basePoolImgEsc = imageFileName;
                this.equip = name;
            } else {
                console.warn('Aucun accessoire sélectionné.');
            }
        },

        handleColorChange() {
            if (this.selectedColorIndex !== null) {
                const [name, imageFileName] = this.selectedColorIndex.split('|').map(part => part.trim());
                this.basePoolImgColor = imageFileName;
                this.poolColor = name;
            } else {
                console.warn('Aucune couleur sélectionnée.');
            }
        },

        handleRevetChange() {
            if (this.selectedRevetIndex !== null) {
                const [name, price] = this.selectedRevetIndex.split('|').map(part => part.trim());
                this.poolRevet = name;
                this.priceRevetForm = price;
            } else {
                console.warn('Aucune couleur sélectionnée.');
            }
        },

        handleProofClick(value) {
            this.selectedProof = value;
            this.enableCustomProof();
        },

        enableCustomProof() {
            const customHole = document.querySelector('#custom-proof');
            customHole.disabled = this.selectedProof !== "fond-perso";
        },

        submitForm(event) {
            event.preventDefault();
            let proof = '1.50';

            if (this.customProof != "" & this.selectedProof == 'fond-perso') {
                proof = this.customProof;
            }

            var response = document.getElementById('mail-response');

            const formData = {
                price: parseFloat(this.quotePrice) + " €" ,
                pool: this.poolName.nom,
                size: this.poolSize.size,
                proof: proof,
                equip: this.equip,
                revet: this.poolRevet,
                filter: this.poolFilter,
                color: this.poolColor,
                security: this.poolSecurity,
                nom: this.nom,
                mail: this.mail,
                tel: this.tel,
                message: this.message
            };

            const requestOptions = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            }

            fetch('/api/contact-form', requestOptions)
                .then(fetchResponse => {
                    if (!fetchResponse.ok) {
                        throw new Error(`La requête a échoué avec le code : ${fetchResponse.status}`);
                    }
                    return fetchResponse.clone().json(); // Clonez la réponse avant de l'analyser
                })
                .then(data => {
                    console.log(data);
                    response.classList.remove('bg-danger');
                    response.classList.add('bg-success');
                    response.innerHTML = "Votre message a bien été envoyé";
                })
                .catch(error => {
                    console.error(error);
                    response.classList.remove('bg-success');
                    response.classList.add('bg-danger');
                    response.innerHTML = "Votre message n'a pas été envoyé ! Une erreur s'est produite !";
                });
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