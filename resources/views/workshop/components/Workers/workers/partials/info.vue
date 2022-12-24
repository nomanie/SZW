<template>
    <div>
        <p>Dane pracownika</p>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col item">
                        Imię pracownika:
                        <div>
                            <div class="input__wrapper mt-1">
                                <input
                                    v-model="form.first_name"
                                    type="text"
                                    placeholder="Imię pracownika"
                                    class="form-control"
                                    :class="{invalid : errors.first_name}"
                                >
                                <error :errors="errors.first_name"></error>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col item">
                        Nazwisko pracownika:
                        <div>
                            <div class="input__wrapper mt-1">
                                <input
                                    v-model="form.last_name"
                                    type="text"
                                    placeholder="Nazwisko pracownika"
                                    class="form-control"
                                    :class="{invalid : errors.last_name}"
                                >
                                <error :errors="errors.last_name"></error>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col item">
                        Numer telefonu:
                        <div>
                            <div class="input__wrapper mt-1">
                                <input
                                    v-model="form.phone"
                                    type="text"
                                    class="form-control"
                                    placeholder="Numer telefonu"
                                    :class="{invalid : errors.phone}"
                                >
                                <error :errors="errors.phone"></error>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col item">
                        Login:
                        <div>
                            <div class="input__wrapper mt-1">
                                <input
                                    v-model="form.login"
                                    type="text"
                                    placeholder="Login"
                                    class="form-control"
                                    :class="{invalid : errors.login}"
                                >
                                <error :errors="errors.login"></error>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <p>Notatki</p>
        <div class="row mt-3 mb-3">
            <div class="col-12">
                <div class="row">
                    <div class="col item">
                        <div>
                            <div class="input__wrapper mt-1">
                                <textarea
                                    v-model="form.info"
                                    class="form-control"
                                    placeholder="uwagi"
                                ></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
import error from '@js/assets/form/error'

export default {
    name: 'info',
    components: {
        error
    },
    props: {
        data: {
            type: [Array, Object],
            default: () => {}
        }
    },
    data() {
        return {
            form: {},
            errors: {},
            id: this.$route.params.id,
        }
    },
    watch: {
      data: function() {
          this.form = this.data
      }
    },
    methods: {
        save() {
            this.$http.put(route('workshop.workers.update', this.id), this.form)
        }
    }
}
</script>
