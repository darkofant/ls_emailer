<template>
    <div class="inbox-body">
        <div class="mail-option">
            <div class="btn-group">
                <a href="#" class="btn" @click="refresh">
                    <i class="fa fa-refresh"></i>&nbsp; aktualisieren
                </a>
            </div>
        </div>

        <app-messages :messages="incomingMessages"></app-messages>
    </div>
</template>

<script>
    import { eventBus } from '../index';
    import Messages from './Messages.vue';

    export default {
        props: {
            data: {
                type: Object,
                required: true
            }
        },
        methods: {
            refresh() {
                eventBus.$emit('refreshMessages');
            }
        },
        computed: {
            incomingMessages() {
                return this.$store.getters["mail/mails"].filter(function(message) {
                    return (message.type == 0 && message.type != 2);
                });
            }
        },
        components: {
            appMessages: Messages
        }
    }
</script>