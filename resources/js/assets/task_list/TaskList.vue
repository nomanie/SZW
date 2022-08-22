<template>
    <div class="container">
        <div class="row" v-for="task in tasks">
            <div class="col-md-1">
                <input type="checkbox" name="" class="form-check-input" :checked="task.finished">
            </div>
            <div class="col-md-9">
                {{ task.text}}
            </div>
            <div class="col-md-1">
                <i class="fa-solid fa-pencil edit"></i>
            </div>
            <div class="col-md-1">
                <i class="fa-solid fa-x delete"></i>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'TaskList',
    props: {
        tasks: {
            type: [Array, Object],
            default: () => {}
        }
    }
}
</script>
