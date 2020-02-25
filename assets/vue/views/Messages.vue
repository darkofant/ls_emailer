<template>
    <table v-if="messages.length > 0" class="table table-inbox table-hover">
        <tbody>
            <tr v-for="message in messages" @click="openMessage(message)" :key="message.id" :class="{ unread: typeof message.type == 0 }">
                <td></td>
                <td>
                </td>
                <td>{{ message.sender }}</td>
                <td>{{ message.subject }}</td>
                <td></td>
                <td class="text-right">{{ message.datetime | moment("DD.MM.YYYY HH:mm") }}</td>
            </tr>
        </tbody>
        
    </table>
    <p v-else>keine Nachrichten</p>
    
</template>

<script>
    import { eventBus } from '../index';

    export default {
        props: {
            messages: {
                type: Array,
                required: true
            }
        },
        methods: {
            openMessage(message) {
                eventBus.$emit('changeView', {
                    tag: 'app-view-message',
                    title: message.subject,
                    data: {
                        message: message
                    }
                });
            }
        }
    }
    
</script>