<template>
    <div v-if="errors" class="ms-2">
        <div v-for="error in errors" class="d-block invalid-feedback">
            {{ error }}
        </div>
    </div>
</template>
<script>
export default {
    name: 'error',
    props: {
        errors: {
            type: [String, Array],
            default: null
        }
    }
}
</script>
