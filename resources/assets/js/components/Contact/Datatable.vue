<template>
    <div class="table-responsive">
    <table class="table table-hover">
        <thead>
            <tr>
                <th v-for="column in columns" :key="column.name" @click="$emit('sort', column.name)"
                    :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sort sorting_asc' : 'sort sorting_desc') : 'sort sorting'"
                    :style="'width:'+column.width+';'+'cursor:pointer;'">
                    {{column.label}}
                </th>
                <th>Action</th>
            </tr>
        </thead>
        <slot></slot>
    </table>
    </div>
</template>

<script>
    export default {
        props: ['columns', 'sortKey', 'sortOrders']
    }
</script>