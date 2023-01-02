<template>
    <input
        class="form-control"
        type="text"
        :placeholder="placeholder"
        v-model="field"
        :maxlength="max"
        :minlength="min"
        :class="{invalid : state}"
        @keyup="keyUp"
        @blur="$emit('input', field)"
    >
</template>
<script>
export default {
    name: 'NipField',
    props: {
        state: {
            type: Boolean,
            default: false
        },
        data: {
            type: String,
            default: null
        },
        placeholder: {
            type: String,
            default: null
        },
        max: {
            type: Number,
            default: 100
        },
        min: {
            type: Number,
            default: 100
        },
        format: {
            type: String,
            default: null
        },

    },
    data() {
        return{
            field: this.data
        }
    },
    methods: {
        keyUp($event)
        {
            let format = this.format
            let formatString = format.split('').map((e, i) => e !== '.' ? e : '').filter((el) => el !== '')
            let indexes = format.split('').map((e, i) => e === formatString[0] ? i : '').filter((el) => el !== '')
            let tempNip = this.field.split('')
            if ($event.keyCode !== 8 && $event.keyCode !== 46) {
                for (let i = 0; i <= tempNip.length; i++) {
                    if (indexes.includes(i) && tempNip[i] !== formatString[0]) {
                        tempNip.splice(i, 0, format.split('')[i])
                    }
                }
            }
            this.field = tempNip.join('')
        }
    }
}
</script>
