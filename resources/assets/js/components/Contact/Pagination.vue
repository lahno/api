<style lang="sass">
.pagination
    justify-content: flex-end !important
    float: right
    .page-stats
        align-items: center
        margin-right: 5px
    i
        color: #3273dc !important
    a
        display: inline-block
        background: #3097d1
        color: #ffffff
        text-align: center
        padding: 5px 15px
        &:hover
            cursor: pointer
            text-decoration: none
        &[disabled]
            background: rgba(51, 51, 51, 0.43)
            cursor: default
</style>

<template>
    <nav class="pagination">
        <span class="page-stats">{{pagination.from}} - {{pagination.to}} of {{pagination.total}}</span>
        <a v-if="pagination.prevPageUrl" class="button is-small pagination-previous" @click="$emit('prev')">
            Prev
        </a>
        <a class="button is-small pagination-previous" v-else :disabled="true">
           Prev
        </a>

        <a v-if="pagination.nextPageUrl" class="button is-small pagination-next" @click="$emit('next')">
            Next
        </a>
        <a class="button is-small pagination-next" v-else :disabled="true">
            Next
        </a>
    </nav>
</template>

<script>
    export default {
        props: ['pagination', 'contact', 'filtered']
    }
</script>