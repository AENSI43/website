<template>
    <div class="card">
    <div class="card-header">{{ name }} Server
    <span v-if="online == null" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    <span v-else-if="online" class="badge badge-success">Online</span>
    <span v-else class="badge badge-danger">Disconnected</span>
    </div>
        <div class="card-body">
            <button type="button" v-if="online" @click="setOff()" class="btn btn-outline-danger" :disabled="runningAction">Stop</button>
            <button type="button" v-else @click="setOn()" class="btn btn-outline-success" :disabled="runningAction">Start</button>
            <button type="button" @click="update()" class="btn btn-outline-secondary" :disabled="runningAction">Update</button>
            <button type="button" @click="updateStatus()" class="btn btn-outline-secondary" :disabled="runningAction">Refresh</button>
            <div class="console mt-3">
                <div v-if="cmdLoading" class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div v-for="line in cmd" :key="line">{{ line }}</div>
            </div>
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
                online: null,
                cmd: [],
                cmdLoading: false,
                runningAction: false,
                updateFreq: 60 * 1000 //seconds
            }
        },
        mounted() {
            this.updateStatus()
            this.$interval= setInterval(() => {
                this.updateStatus()
            }, this.updateFreq)
        },
        destroyed() {
            clearInterval(this.$interval)
        },
        components: {
            serverStatus
        },
        methods: {
            updateStatus() {
                this.runningAction = true
                this.online = null
                axios.get('http://fivem-server.project/admin-panel/server-status').then(response => {
                    this.online = response.data
                    this.runningAction = false
                })
            },
            setOn() {
                this.runningAction = true
                axios.get('http://fivem-server.project/admin-panel/server-start').then(response => {
                    this.online = response.data
                    this.runningAction = false
                })
            },
            setOff() {
                this.runningAction = true
                axios.get('http://fivem-server.project/admin-panel/server-stop').then(response => {
                    this.online = response.data
                    this.runningAction = false
                })
            },
            update() {
                this.setOff()
                this.cmd = []
                this.cmdLoading = true
                this.runningAction = true

                axios.get('http://fivem-server.project/admin-panel/server-update').then(response => {
                    this.cmdLoading = false
                    this.cmd = response.data.cmd
                    if (!response.data.error) this.setOn()
                    this.runningAction = false
                })
            }
        },
    }
</script>
