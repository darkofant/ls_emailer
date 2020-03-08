<template>
    <div class="inbox-body">
        <app-messages :messages="sentMessages"></app-messages>
    </div>
</template>

<script>
    import Messages from './Messages.vue';

    export default {
        props: {
            data: {
                type: Object,
                required: true
            }
        },
        computed: {
            sentMessages() {
                return this.$store.getters["mail/mails"].filter(function(message) {
                    return (message.type == 1 && message.type != 2);
                });
            }
        },
        components: {
            appMessages: Messages
        }
    }
</script>