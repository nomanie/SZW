<template>
    <div class="mt-1">
        <div class="row">
            <div class="col-12 d-flex justify-content-end">
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <b-tabs>
                    <b-tab v-if="cars.length > 0" v-for="car in cars" lazy>
                        <template #title>{{car.brand + ' ' + car.model}}</template>
                        <div class="d-flex justify-content-end my-2">
                            <b-button variant="warning" class="py-0 px-3" @click="restore(car.id)">Przywróć pojazd</b-button>
                        </div>
                        <car-details
                            :car="car"
                            :disabled-inputs="true"
                        ></car-details>
                    </b-tab>
                    <b-tab v-else> Brak zarchiwizowanych pojazdów</b-tab>
                </b-tabs>
            </div>
        </div>
        <modal
            :data="data"
            @reload="getCarList"
        ></modal>
    </div>
</template>
<script>
import modal from './modal'
import carDetails from './details/show'
export default {
    components: {
        modal,
        carDetails
    },
    data() {
        return {
            data: {},
            add_edit_modal_id: 'cars-modal',
            isEdit: false,
            cars: {}
        }
    },
    mounted() {
        this.getCarList()
    },
    methods: {
        restore(car_id) {
            this.$http.put(route('workshop.archived_cars.update', car_id)).then((response) => {
                this.getCarList()
                this.$emit('reload')
            })
        },
        show($event) {
            this.$router.push({ name: 'cars.show', params: { id: $event } })
        },
        getCarList() {
            this.$http.get(route('workshop.archived_cars.index')).then((res) => {
                this.cars = res.data
            })
        }
    }
}
</script>
