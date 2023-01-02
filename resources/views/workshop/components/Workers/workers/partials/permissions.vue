<template>
    <div ref="checkboxes" v-if="form">
        <h5>Uprawnienia</h5>
        <div class="row mx-4 flex-column mb-3" v-for="(section, index) in permissions">
            <div class="col-12 text-capitalize">{{ section[0].section }}:</div>
            <b-form-checkbox
                v-for="(permission, id) in section" :key="id"
                :value="permission.id"
                :checked="form"
            >
                {{ permission.name }}
            </b-form-checkbox>
        </div>
        <div class="col-12 mb-2">
            <hr>
        </div>
        <hr>
        <div class="w-100 justify-content-end d-flex">
            <button type="button" class="btn btn-warning mr-3 " @click="$emit('reset')"><i
                class="fa fa-eraser pr-3"></i>
                Cofnij zmiany
            </button>
            <div>
                <button type="button" class="btn btn-success" @click="save"><i class="fa fa-save pr-3"></i>
                    Zapisz
                </button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'permissions',
    props: {
        data: {
            type: [Array, Object],
            default: () => []
        }
    },
    data() {
        return {
            permissions: {},
            form: []
        }
    },
    mounted() {
        this.form = this.data
        this.get()
        console.log(this.form)
    },
    methods: {
        get() {
            this.$http.get(route('workshop.workers.permissions.index')).then((res) => {
                this.permissions = res.data
            })
        },
        save() {
            this.form = Array.from(this.$refs.checkboxes.querySelectorAll('input[type="checkbox"]:checked')).map((item) => item.value)
            this.$http.post(route('workshop.workers.permissions.store'), this.form)
        }
    }
}
</script>
