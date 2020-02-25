<template>
    <div class="inbox-body">
        <app-messages :messages="trashedMessages"></app-messages>
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
            trashedMessages() {
                return this.$store.getters["mail/mails"].filter(function(message) {
                    return message.status == 2;
                });
            }
        },
        components: {
            appMessages: Messages
        }
    }
</script>