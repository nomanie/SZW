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
                        <b-input
                            type="text"
                            v-model="place.city"
                            placeholder="Miasto placówki"
                            :class="{invalid : errors[`places.${index}.city`]}"
                        >
                        </b-input>
                        <error :errors="errors[`places.${index}.city`]"></error>
                    </b-form-group>
                </div>
                <div class="col-12 col-lg-4 px-3">
                    <b-form-group label="Ulica placówki">
                        <b-input
                            type="text"
                            v-model="place.street"
                            placeholder="Ulica placówki"
                            :class="{invalid : errors[`places.${index}.street`]}"
                        >
                        </b-input>
                        <error :errors="errors[`places.${index}.street`]"></error>
                    </b-form-group>
                </div>
                <div class="col-12 col-lg-4 px-3">
                    <b-form-group label="Telefon do placówki">
                        <b-input
                            type="text"
                            v-model="place.phone"
                            placeholder="Telefon do placówki"
                            :class="{invalid : errors[`places.${index}.phone`]}"
                        >
                        </b-input>
                        <error :errors="errors[`places.${index}.phone`]"></error>
                    </b-form-group>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 col-lg-4 px-3">
                    <b-form-group label="Numer budynku">
                        <b-input
                            type="text"
                            v-model="place.building_number"
                            placeholder="Numer budynku"
                            :class="{invalid : errors[`places.${index}.building_number`]}"
                        >
                        </b-input>
                        <error :errors="errors[`places.${index}.building_number`]"></error>
                    </b-form-group>
                </div>
                <div class="col-12 col-lg-4 px-3">
                    <b-form-group label="Numer lokalu">
                        <b-input
                            type="text"
                            v-model="place.flat_number"
                            placeholder="Numer lokalu"
                            :class="{invalid : errors[`places.${index}.flat_number`]}"
                        >
                        </b-input>
                        <error :errors="errors[`places.${index}.flat_number`]"></error>
                    </b-form-group>
                </div>
                <div class="col-12 col-lg-4 px-3">
                    <b-form-group label="Kod pocztowy">
                        <b-input
                            type="text"
                            v-model="place.zip_code"
                            placeholder="Kod pocztowy"
                            :class="{invalid : errors[`places.${index}.zip_code`]}"
                        >
                        </b-input>
                        <error :errors="errors[`places.${index}.zip_code`]"></error>
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
        <map-modal></map-modal>
    </div>
</template>
<script>
import mapModal from './mapModal'
import error from '@js/assets/form/error'

export default {
    name: 'places',
    components: {
      mapModal,
        error
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
            errors: {},
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
