<template>
    <div class="inbox-body">
        <div class="mail-option">
            <button class="btn btn-primary" @click="navigateBack">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp; zurück
            </button>

            <button class="btn btn-danger" @click="data.message.status = 2" :disabled="data.message.status == 2">
                <i class="fa fa-trash-o"></i>&nbsp; {{ data.message.status == 2 ? 'gelöscht' : 'löschen' }}
            </button>

            <template>
                <button class="btn btn-primary" @click="data.message.status = 0" :disabled="data.message.status == 0">
                    <i class="fa fa-envelope-open" aria-hidden="true"></i>&nbsp; ungelesen
                </button>

                <button class="btn btn-primary" @click="data.message.status = 1" :disabled="data.message.status == 1">
                    <i class="fa fa-envelope" aria-hidden="true"></i>&nbsp; gelesen
                </button>
            </template>
        </div>

        <p><strong>Datum:</strong> {{ data.message.datetime | moment("DD.MM.YYYY HH:mm")}}</p>
        <p><strong>Absender:</strong> {{ data.message.sender }}</p>
        <hr>

        <div v-html="data.message.text" class="message"></div>

    </div>
</template>

<script>
    import { eventBus } from '../index';

    export default {
        props: {
            data: {
                type: Object,
                required: true
            },
        },
        activated() {
            if (typeof this.data.message.isRead == 0) {
                this.data.message.status = 1;
            }
        },
        methods: {
            navigateBack() {
                let previousView = this.$parent.previousView;

                eventBus.$emit('changeView', {
                    tag: previousView.tag,
                    title: previousView.title,
                    data: previousView.data
                });
            }
        },

    }
</script>