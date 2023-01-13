<template>
    <div class="mb-5">
        <h4>Dane klienta</h4>
        <hr>
        <h5>Podstawowe dane</h5>
        <div class="row mt-3">
            <div class="col-12">
                <div class="col-12 col-md-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <div class="row">
                                        <div class="col item">
                                            Imię klienta
                                            <div>
                                                <div class="input__wrapper mt-1">
                                                    <input
                                                        v-model="form.first_name"
                                                        type="text"
                                                        placeholder="Imię"
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
                                            Nazwisko klienta
                                            <div>
                                                <div class="input__wrapper mt-1">
                                                    <input
                                                        v-model="form.last_name"
                                                        type="text"
                                                        placeholder="Nazwisko"
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
                                            Numer telefonu
                                            <div>
                                                <div class="input__wrapper mt-1">
                                                    <input
                                                        v-model="form.phone"
                                                        type="text"
                                                        placeholder="Numer telefonu"
                                                        class="form-control"
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
                                            Adres e-mail
                                            <div>
                                                <div class="input__wrapper mt-1">
                                                    <input
                                                        v-model="form.email"
                                                        type="email"
                                                        placeholder="Adres e-mail"
                                                        class="form-control"
                                                        :class="{invalid : errors.email}"
                                                    >
                                                    <error :errors="errors.email"></error>
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
                                            Data urodzenia
                                            <div>
                                                <div class="input__wrapper mt-1">
                                                    <input
                                                        v-model="form.date_of_birth"
                                                        type="date"
                                                        placeholder="Data urodzenia"
                                                        class="form-control"
                                                        :class="{invalid : errors.date_of_birth}"
                                                    >
                                                    <error :errors="errors.date_of_birth"></error>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <h5>Adres</h5>
        <div class="row mt-3">
            <div class="col-12">
                <div class="col-12 col-md-6">
                    <div class="row">
                        <div class="col-12">
                            <div class="row mb-3">
                                <div class="col item">
                                    Miasto
                                    <div>
                                        <div class="input__wrapper mt-1">
                                            <input
                                                v-model="form.city"
                                                type="text"
                                                placeholder="Miasto"
                                                class="form-control"
                                                :class="{invalid : errors.city}"
                                            >
                                            <error :errors="errors.city"></error>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="row">
                                <div class="col item">
                                    Ulica
                                    <div>
                                        <div class="input__wrapper mt-1">
                                            <input
                                                v-model="form.street"
                                                type="text"
                                                placeholder="Ulica"
                                                class="form-control"
                                                :class="{invalid : errors.street}"
                                            >
                                            <error :errors="errors.street"></error>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="row">
                                <div class="col item">
                                    <b-form-group label="Kod pocztowy">
                                        <format-field
                                            :key='form.zip_code'
                                            :data='form.zip_code'
                                            :min="0"
                                            :max="6"
                                            :state="errors.zip_code && errors.zip_code.length > 0"
                                            format="..-..."
                                            placeholder="Kod pocztowy"
                                            @input="form.zip_code = $event"
                                        ></format-field>
                                        <error :errors="errors.zip_code"></error>
                                    </b-form-group>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col item">
                                    Numer budynku
                                    <div>
                                        <div class="input__wrapper mt-1">
                                            <input
                                                v-model="form.building_number"
                                                type="text"
                                                placeholder="Numer budynku"
                                                class="form-control"
                                                :class="{invalid : errors.building_number}"
                                            >
                                            <error :errors="errors.building_number"></error>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row">
                                <div class="col item">
                                    Numer lokalu
                                    <div>
                                        <div class="input__wrapper mt-1">
                                            <input
                                                v-model="form.flat_number"
                                                type="text"
                                                placeholder="Numer lokalu"
                                                class="form-control"
                                                :class="{invalid : errors.flat_number}"
                                            >
                                            <error :errors="errors.flat_number"></error>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <h5>Zgody</h5>
        <div class="row mt-3 fs-12">
            <div class="col-12">
                <div class="col-12 col-md-10">
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <b-form-checkbox
                                v-model="form.consent_marketing_notification"
                                :class="{invalid : errors.consent_marketing_notification}"
                            >
                                Zgoda na otrzymywanie marketingowych wiadomości e-mail
                            </b-form-checkbox>
                            <error :errors="errors.consent_marketing_notification"></error>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <b-form-checkbox
                                v-model="form.consent_sms_notification"
                                :class="{invalid : errors.consent_sms_notification}"
                            >
                                Zgoda na otrzymywanie wiadomości SMS
                            </b-form-checkbox>
                            <error :errors="errors.consent_sms_notification"></error>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <b-button variant="outline-success" class="py-0 px-3 mt-2">Powiąż klienta z istniejącym
                                kontem
                            </b-button>
                            <div class="mt-2 d-flex justify-content-start align-items-center">
                                <b-button variant="outline-secondary" class="py-0 px-3" disabled>Powiązano z istniejącym
                                    kontem
                                </b-button>
                                <i class="fa-solid fa-trash text-danger ml-2 cursor-pointer" v-b-tooltip.hover
                                   title="Usuń powiązanie"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="w-100 justify-content-end d-flex">
            <button type="button" class="btn btn-warning mr-3 " @click="get"><i
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
import FormatField from '@js/components/FormatField'

export default {
    name: 'info',
    components: {
        error,
        FormatField
    },
    props: {},
    data() {
        return {
            form: {},
            errors: {},
            id: this.$route.params.id
        }
    },
    mounted() {
        this.get()
    },
    computed: {
        name() {
            return this.form.first_name + ' ' + this.form.last_name
        }
    },
    methods: {
        get() {
            this.$http.get(route('workshop.clients.show', this.id)).then((res) => {
                this.form = res.data.data
                this.$emit('edit', this.name)
            })
        },
        save() {
            this.$http.put(route('workshop.clients.update', this.id), this.form).then((res)=>{
                this.$emit('edit', this.name)
            })
        },
        connect() {
            //@todo łączenie klienta z identity - wysłanie prośby o zgodę na udostępnienie danych
        },
        disconnect() {
            //@todo rozłączenie klienta z identity
        }
    }
}
</script>
