<template>
    <div class="card">
    <div class="card-header">{{ name }} Server</div>

        <div class="card-body">

            This is the admin panel !

        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'name'
        ],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
