<template>
    <div class="container">
        <div class="row mt-5">
            <card v-for="d in data" :color="d.color" :type='`information`' :information_data="d.data"></card>
        </div>
        <div class="row text-center mt-5 mx-auto">
            <div class="col-12">
                <h2>Zobacz poradnik, aby dowiedzieć się jak działa Nasz system</h2>
            </div>
            <div class="col-12 mt-3">
                <button class="btn btn-support blue">Przejdź do poradnika</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Support',
    data() {
        return {
            data: {
                facebook: {
                    data: {
                        header_icon: 'fa-brands fa-square-facebook',
                        header_text: 'Facebook',
                        value: 'Odwiedź',
                        footer_content: '00:00-24:00',
                        footer_icon: 'fa-regular fa-clock'
                    },
                    color: 'blue',
                },
                phone: {
                    data: {
                        header_icon: 'fa-solid fa-phone',
                        header_text: '123 123 123',
                        value: 'Zadzwoń',
                        footer_content: '10:00-22:00',
                        footer_icon: 'fa-regular fa-clock'
                    },
                    color: 'green',
                },
                email: {
                    data: {
                        header_icon: 'fa-solid fa-envelope',
                        header_text: 'support@szw.pl',
                        value: 'Napisz',
                        footer_content: '00:00-24:00',
                        footer_icon: 'fa-regular fa-clock'
                    },
                    color: 'orange',
                },
                discord: {
                    data: {
                        header_icon: 'fa-brands fa-discord',
                        header_text: '@discord',
                        value: 'Zdalna pomoc',
                        footer_content: '00:00-24:00',
                        footer_icon: 'fa-regular fa-clock'
                    },
                    color: 'blue',
                }
            }

        }
    }
}
</script>
