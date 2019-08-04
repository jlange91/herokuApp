<template>
    <app-dropdown :options="options" :value="selected" @input="input" :error="error" @click="$emit('click')" />
</template>

<script>
import AppDropdown from './AppDropdown'

export default {
    name: 'AppSelect',
    components: {
        AppDropdown
    },
    props: {
        options: {
            type: Object,
            required: true
        },
        selected: {
            type: String,
            required: true
        },
        error: {
            type: Boolean,
            required: false,
            default: false
        }
    },
    methods: {
        input(e) {
            this.$emit('selected', e)
        }
    }
}
</script>
