<template>
    <aside class="sm-side">
        <div class="user-head">
            <div class="user-name">
                <h5>Test</h5>
                <span class="email-address">test@testmail.com</span>
            </div>
        </div>

        <div class="compose-wrapper">
            <app-compose></app-compose>
        </div>

        <ul class="inbox-nav">
            <li :class="{ active: activeView == 'app-inbox' }">
                <a href="#" @click.prevent="navigate('app-inbox', 'Inbox')">
                    <i class="fa fa-inbox"></i>Posteingang <span class="label label-danger pull-right">{{ unreadMessages.length }}</span>
                </a>
            </li>

            <li :class="{ active: activeView == 'app-sent' }">
                <a href="#" @click.prevent="navigate('app-sent', 'Sent')">
                    <i class="fa fa-envelope-o"></i>Postausgang <span class="label label-default pull-right">{{ sentMessages.length }}</span>
                </a>
            </li>

            <li :class="{ active: activeView == 'app-trash' }">
                <a href="#" @click.prevent="navigate('app-trash', 'Trash')">
                    <i class=" fa fa-trash-o"></i>Papierkorb <span class="label label-default pull-right">{{ trashedMessages.length }}</span>
                </a>
            </li>
        </ul>
    </aside>
</template>

<script>
    import { eventBus } from '../index';
    import Compose from './Compose.vue';

    export default {
        props: {
            messages: {
                type: Array,
                required: true
            }
        },
        data() {
            return {
                activeView: 'app-inbox'
            };
        },
        created() {
            eventBus.$on('changeView', (data) => {
                this.activeView = data.tag;
            });
        },
        methods: {
            navigate(newView, title) {
                eventBus.$emit('changeView', {
                    tag: newView,
                    title: title
                });
            }
        },
        computed: {
            unreadMessages() {
                return this.messages.filter(function(message) {
                    return (message.type == 0 && message.status == 0);
                });
            },
            sentMessages() {
                return this.messages.filter(function(message) {
                    return message.type == 1;
                });
            },
            trashedMessages() {
                return this.messages.filter(function(message) {
                    return message.status == 2;
                });
            }
        },
        components: {
            appCompose: Compose
        }
    }
</script>