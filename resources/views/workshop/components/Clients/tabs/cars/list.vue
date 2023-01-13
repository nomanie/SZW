<template>
    <div class="mt-1">
        <div class="row">
            <div class="col-12 d-flex justify-content-end">
                <button class="btn btn-success" @click="add">Dodaj pojazd</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <b-tabs>
                    <b-tab v-for="car in cars" lazy>
                        <template #title>{{car.brand + ' ' + car.model}}</template>
                        <div class="d-flex justify-content-end my-2">
                            <b-button variant="danger" class="py-0 px-3" @click="remove(car.id)">Usuń pojazd</b-button>
                        </div>
                        <car-details
                            :car="car"
                        ></car-details>
                    </b-tab>
                    <b-tab>
                        <template #title>
                            Zarchiwizowane pojazdy
                        </template>
                        <div class="text-center fs-20 my-3">
                            <i class="fa-solid fa-hammer"></i>
                            Prace trwają
                        </div>
                    </b-tab>
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
        add($event) {
            this.$bvModal.show(this.add_edit_modal_id)
        },
        remove(car_id) {
            this.$http.delete(route('workshop.cars.destroy', car_id)).then((response) => {
                this.getCarList()
            })
        },
        edit($event, edit = false) {
            this.isEdit = edit
            this.$http.get(route('workshop.cars.show', $event)).then((response) => {
                this.data = response.data.data
                this.$bvModal.show(this.add_edit_modal_id)
            })
        },
        show($event) {
            this.$router.push({ name: 'cars.show', params: { id: $event } })
        },
        getCarList() {
            this.$http.get(route('workshop.cars.index')).then((res) => {
                this.cars = res.data
            })
        }
    }
}
</script>
