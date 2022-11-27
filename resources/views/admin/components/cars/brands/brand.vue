<template>
    <div class="container mt-3">
        <div>
            <div class="d-flex justify-content-end">
                <modal
                    :data="data"
                ></modal>
            </div>
        </div>
    </div>
</template>
<script>
import modal from './modal'

export default {
    components: {
        modal,
    },
    data() {
        return {
            data: {},
        }
    },
    methods: {
        edit($event) {
            this.$http.get(route('admin.cars.brand.edit', $event)).then((response) => {
                this.data = response.data.data;
                this.isEdit = true
            })
        }
    }
}
</script>
