<template>
    <v-select
        ref="select"
        :options="options"
        :clearable="clearable"
        :searchable="searchable"
        :class="stateClasses"
        :clear-search-on-blur="clearSearchOnBlur"
        :clear-search-on-select="clearSearchOnSelect"
        :close-on-select="closeOnSelect || multiple"
        :create-option="createOption"
        :deselect-from-dropdown="deselectFromDropdown"
        :disabled="disabled"
        :dropdown-should-open="dropdownShouldOpen"
        :filter="filter"
        :filterable="filterable"
        :filter-by="filterBy"
        :get-option-key="getOptionKey"
        :get-option-label="getOptionLabel"
        :input-id="inputId"
        :label="label"
        :loading="loading"
        :multiple="multiple"
        :no-drop="noDrop"
        :on-tab="onTab"
        :placeholder="placeholder"
        :push-tags="pushTags"
        :reduce="reduce"
        :reset-on-option-change="resetOnOptionsChange"
        :selectable="selectable"
        :select-on-tab="selectOnTab"
        :tabindex="tabindex"
        :taggable="taggable"
        :transition="transition"
        :uid="uid"
        :value="value"
        @option:selected="$emit('option:selected', $event)"
        @option:selecting="$emit('option:selecting', $event)"
        @option:deselecting="$emit('option:deselecting', $event)"
        @option:deselected="$emit('option:deselected', $event)"
        @option:created="$emit('option:created', $event)"
        @input="$emit('input', $event)"
        @open="open"
        @close="$emit('close')"
        @search="$emit('search', $event, true)"
        @search:blur="$emit('search:blur')"
        @search:focus="$emit('search:focus')"
    >
        <template #open-indicator="{ attributes }">
            <span v-bind="attributes">{{ indicator }}</span>
        </template>
        <template #search="{ attributes, events }">
            <span v-bind="attributes" v-on="events"></span>
        </template>
        <template
            #selected-option-container="{ option, deselect, multiple, disabled }"
        >
            <div class="vs__selected">{{ option.label }}</div>
        </template>
    </v-select>
</template>
<script>

import {uniqueId} from "lodash/util";

export default {
    name: 'Vselect',
    methods: {
        hideOnBackdropMethod() {
            const _self = this
            document.addEventListener('click', function (ev, el) {
                if (
                    !ev.target.classList.contains('vs__selected-options')
                    && !ev.target.classList.contains('vs__dropdown-option')
                    && !ev.target.classList.contains('vs__dropdown-toggle')
                    && !ev.target.classList.contains('v-select')
                    && !ev.target.classList.contains('vs__selected')
                ) {
                    _self.$refs.select.open = !1
                }
            })
        },
        open($event) {
            this.$emit('open')
            this.$nextTick(() => {
                this.$refs.select.$el.classList.remove('vs--open')
            })
        }
    },
    computed: {
        stateClasses: function () {
            return {
                "": this.dropdownOpen,
                "vs--single": !this.multiple,
                "vs--multiple": this.multiple,
                "vs--searching": this.searching && !this.noDrop,
                "vs--searchable": this.searchable && !this.noDrop,
                "vs--unsearchable": !this.searchable,
                "vs--loading": this.mutableLoading,
                "vs--disabled": this.disabled,
            };
        },
    },
    mounted() {
        if (this.hideOnBackdrop) {
            this.hideOnBackdropMethod()
        }
    },
    props: {
        hideOnBackdrop: {
            type: Boolean,
            default: false
        },
        clearable: {
            type: Boolean,
            default: false
        },
        searchable: {
            type: Boolean,
            default: true
        },
        classes: {
            type: String,
            default: ''
        },
        indicator: {
            type: String,
            default: ''
        },
        clearSearchOnBlur: {
            type: Function,
            default: function ({ clearSearchOnSelect, multiple }) {
                return clearSearchOnSelect && !multiple
            }
        },
        clearSearchOnSelect: {
            type: Boolean,
            default: true
        },
        closeOnSelect: {
            type: Boolean,
            default: true
        },
        createOption: {
            type: Function,
            default(newOption) {
                if (typeof this.optionList[0] === 'object') {
                    newOption = {[this.label]: newOption}
                }

                this.$emit('option:created', newOption)
                return newOption
            }
        },
        deselectFromDropdown: {
            type: Boolean,
            default: false
        },
        disabled: {
            type: Boolean,
            default: false
        },
        dropdownShouldOpen: {
            type: Function,
            default({noDrop, open, mutableLoading}) {
                return noDrop ? false : open && !mutableLoading;
            }
        },
        filter: {
            type: Function,
            default(options, search) {
                return options.filter(option => {
                    let label = this.getOptionLabel(option);
                    if (typeof label === "number") {
                        label = label.toString();
                    }
                    return this.filterBy(option, label, search);
                });
            }
        },
        filterable: {
            type: Boolean,
            default: true
        },
        filterBy: {
            type: Function,
            default(option, label, search) {
                return (label || '').toLocaleLowerCase().indexOf(search.toLocaleLowerCase()) > -1
            }
        },
        getOptionKey: {
            type: Function,
            default(option) {
                if (typeof option === 'object' && option.id) {
                    return option.id
                } else {
                    try {
                        return JSON.stringify(option)
                    } catch(e) {
                        return console.warn(
                            `[vue-select warn]: Could not stringify option ` +
                            `to generate unique key. Please provide 'getOptionKey' prop ` +
                            `to return a unique key for each option.\n` +
                            'https://vue-select.org/api/props.html#getoptionkey'
                        )
                        return null
                    }
                }
            }
        },
        getOptionLabel: {
            type: Function,
            default(option) {
                if (typeof option === 'object') {
                    if (!option.hasOwnProperty(this.label)) {
                        return console.warn(
                            `[vue-select warn]: Label key "option.${this.label}" does not` +
                            ` exist in options object ${JSON.stringify(option)}.\n` +
                            'https://vue-select.org/api/props.html#getoptionlabel'
                        )
                    }
                    return option[this.label]
                }
                return option;
            }
        },
        inputId: {
            type: String
        },
        label: {
            type: String,
            default: "label"
        },
        loading: {
            type: Boolean,
            default: false
        },
        multiple: {
            type: Boolean,
            default: false
        },
        noDrop: {
            type: Boolean,
            default: false
        },
        onTab: {
            type: Function,
            default: function() {
                if (this.selectOnTab) {
                    this.typeAheadSelect();
                }
            }
        },
        options: {
            type: Array,
            default() {
                return [];
            }
        },
        placeholder: {
            type: String,
            default: ""
        },
        pushTags: {
            type: Boolean,
            default: false
        },
        reduce: {
            type: Function,
            default: option => option,
        },
        resetOnOptionsChange: {
            default: false,
            validator: (value) => ['function', 'boolean'].includes(typeof value)
        },
        selectable: {
            type: Function,
            /**
             * @param {Object|String} option
             * @return {boolean}
             */
            default: option => true,
        },
        selectOnTab: {
            type: Boolean,
            default: false
        },
        tabindex: {
            type: Number,
            default: null
        },
        taggable: {
            type: Boolean,
            default: false
        },
        transition: {
            type: String,
            default: "fade"
        },
        uid: {
            type: [String, Number],
            default: () => uniqueId(),
        },
        value: {
            default: null
        },
    },
}
</script>
