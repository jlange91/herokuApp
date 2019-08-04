<template>
    <div>
        <input :class="[error ? 'bg-white border-red-500' : '', disabled ? 'bg-grey-300' : 'bg-white']"
                class="rounded w-full appearance-none block text-gray-900 border border-grey-300 py-2 px-4 mb-2 focus:outline-none focus:bg-white focus:border-blue-500"
                @input="$emit('input', $event.target.value)"
                :type="type"
                :name="name"
                :id="name"
                :value="value"
                :disabled="disabled"
                @focus="$emit('focus')"
                @blur="$emit('blur')">
    </div>
</template>

<script>
export default {
    name: 'AppInput',
    props: {
        type: {
            type: String,
            required: false,
            default: 'text'
        },
        name: {
            type: String,
            required: true,
        },
        value: {
            type: String,
            required: true
        },
        disabled: {
            type: Boolean,
            required: false,
            default: false
        },
        error: {
            type: Boolean,
            required: false,
            default: false
        },
    },
   
 }
</script>
