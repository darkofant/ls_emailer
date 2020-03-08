<template>
    <div>
        <a href="#composeModal" data-toggle="modal" class="btn btn-compose">E-Mail schreiben</a>

        <div aria-hidden="true" role="dialog" tabindex="-1" id="composeModal" class="modal fade" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                        <h4 class="modal-title">Neue E-Mail</h4>
                    </div>

                    <div class="modal-body">
                        <form @submit.prevent="sendMessage" role="form" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="subject">Betreff</label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="message.subject" id="subject" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="subject">Empfänger</label>
                                <div class="col-lg-10">
                                    <input type="text" v-model="message.recipients" id="rescipients" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label" for="message">Nachricht</label>
                                <div class="col-lg-10">
                                    <textarea v-model="message.content" rows="10" cols="30" class="form-control" id="message"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-send" type="submit">abschicken</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    import { eventBus } from '../index';

    export default {
        data() {
            return {
                message: {
                    subject: '',
                    content: '',
                    recipients: '',
                }
            };
        },
        methods: {
            sendMessage() {
                eventBus.$emit('sentMessage', {
                        subject: this.message.subject,
                        text: this.message.content,  
                        recipients: this.message.recipients,
                });
            }
        }
    }
</script>