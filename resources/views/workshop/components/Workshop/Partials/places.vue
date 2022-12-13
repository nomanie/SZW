<template>
    <div class="mt-3 px-3">

        <div class="mt-3 align-items-baseline" v-for="(place, index) in form.places">
            <div class="d-flex justify-content-between">
                <h5>Placówka {{index + 1}}</h5>
                <button class="btn btn-primary fs-12 py-0" @click="$bvModal.show('map_modal')">
                    <i class="fa-solid fa-location-dot mr-2"></i>
                    Zaznacz na mapie
                </button>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 col-lg-4 px-3">
                    <b-form-group label="Miasto placówki">
                        <b-input type="text" v-model="place.city" placeholder="Miasto placówki">

                        </b-input>
                    </b-form-group>
                </div>
                <div class="col-12 col-lg-4 px-3">
                    <b-form-group label="Ulica placówki">
                        <b-input type="text" v-model="place.street" placeholder="Ulica placówki">

                        </b-input>
                    </b-form-group>
                </div>
                <div class="col-12 col-lg-4 px-3">
                    <b-form-group label="Telefon do placówki">
                        <b-input type="text" v-model="place.phone" placeholder="Telefon do placówki">

                        </b-input>
                    </b-form-group>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 col-lg-4 px-3">
                    <b-form-group label="Numer budynku">
                        <b-input type="text" v-model="place.building_number" placeholder="Numer budynku">

                        </b-input>
                    </b-form-group>
                </div>
                <div class="col-12 col-lg-4 px-3">
                    <b-form-group label="Numer lokalu">
                        <b-input type="text" v-model="place.flat_number" placeholder="Numer lokalu">

                        </b-input>
                    </b-form-group>
                </div>
                <div class="col-12 col-lg-4 px-3">
                    <b-form-group label="Kod pocztowy">
                        <b-input type="text" v-model="place.zip_code" placeholder="Kod pocztowy">

                        </b-input>
                    </b-form-group>
                </div>
            </div>
           <div class="row mt-3">
               <div class="col-12 col-lg-12 px-3">
                   <b-button variant="danger" @click="removePlace(index)" v-if="index > 0">
                       <i class="fa fa-minus"></i>
                       placówke
                   </b-button>
                   <b-button variant="primary" @click="addPlace()" v-if="index === form.places.length - 1">
                       <i class="fa fa-plus"></i>
                       placówke
                   </b-button>
               </div>
           </div>
            <div class="row">
                <div class="col-12">
                    <hr class="mt-3">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 d-flex justify-content-end px-3">
                    <b-button variant="warning" class="mr-2">
                        <i class="fa fa-eraser"></i>
                        Cofnij zmiany
                    </b-button>
                    <b-button variant="success" @click="save()">
                        <i class="fa fa-floppy-disk"></i>
                        Zapisz
                    </b-button>
                </div>
            </div>
        </div>
        <map-modal></map-modal>
    </div>
</template>
<script>
import mapModal from './mapModal'
export default {
    name: 'places',
    components: {
      mapModal
    },
    props: {
        id: {
            type: Number,
            default: () => null
        },
        data: {
            type: [Object, Array],
            default: () => []
        }
    },
    data() {
        return {
            form: {
                places: [
                    {
                        city: null,
                        street: null,
                        zip_code: null,
                        building_number: null,
                        flat_number: null,
                        phone: null
                    }
                ]
            }
        }
    },
    mounted() {
        if (this.data.length > 0) {
            this.form.places = this.data
        }
    },
    methods: {
        save() {
            this.form.section = 'places'
            this.$http.put(route('workshop.workshops.update', this.id), this.form).then(() => {

            })
        },
        addPlace() {
            this.form.places.push({
                city: null,
                street: null,
                zip_code: null,
                building_number: null,
                flat_number: null,
                phone: null
            })
        },
        removePlace(index) {
            this.form.places.splice(index, 1)
        }
    }
}
</script>
