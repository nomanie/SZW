
var dtMixin = {
    data() {
        return {
            table_id: this.tableId,
        }
    },
    mounted() {
        let _self = this
        // obsługa dropdown action buttons
        document.addEventListener("click", function (e) {
            const target = e.target.closest(".dt-ajax");
            if (target) {
                e.preventDefault()
                _self[target.dataset.type](target.dataset.id)
            }
        });
    },
    methods: {
        delete(id) {
            this.$emit('delete', id)
        },
        edit(id) {
            this.$emit('edit', id)
        },
        show(id) {
            this.$emit('show', id)
        },
    }
}
export default dtMixin
