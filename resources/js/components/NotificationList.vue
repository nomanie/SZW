<template>
    <div>
        <button class="btn-no-style text-center my-2 check_all">
            Oznacz wszystkie jako przeczytane
        </button>
        <li v-for="notification in notifications">
            <a class="dropdown-item" href="#">
                <h5>{{ notification.title }}</h5>
                <div class="dropdown-item--footer">
                    <div class="row">
                        <div class="col-12 col-md-6 text-start">
                            {{ notification.author }}
                        </div>
                        <div class="col-12 col-md-6">
                            {{ notification.date }}
                        </div>
                    </div>
                </div>
            </a>
        </li>
        <button class="btn btn-primary w-100 blue">Zobacz wszystkie</button>
    </div>
</template>

<script>
export default {
    name: 'NotificationList',
    props: {
        notifications: {
            type: [Object, Array],
            default: () => [
                {
                    title: 'Zgłoszenie klienta',
                    author: 'Arkadiusz Ciekawowski',
                    date: '22.08.2022 12:30'
                },
                {
                    title: 'Ukończono naprawę',
                    author: 'Wojciech Lipa',
                    date: '21.08.2022 15:30'
                }
            ]
        }
    }
}
</script>
