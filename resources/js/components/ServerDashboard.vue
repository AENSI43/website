<template>
    <div class="card">
    <div class="card-header">{{ name }} Server
    <span v-if="online" class="badge badge-success">Online</span>
    <span v-else class="badge badge-danger">Disconnected</span>
    </div>
        <div class="card-body">
            <button type="button" v-if="online" @click="setOff()" class="btn btn-outline-danger">Stop</button>
            <button type="button" v-else @click="setOn()" class="btn btn-outline-success">Start</button>
            This is the admin panel !
        </div>
    </div>
</template>


<script>
    import serverStatus from './ServerStatus.vue'
    export default {
        props: [
            'name'
        ],
        data: function () {
            return {
                online: false
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        components: {
            serverStatus
        },
        methods: {
            setOn() {
                this.online = true
                console.log(this.online)
            },
            setOff() {
                this.online = false
                console.log(this.online)
            }
        },
    }
</script>
