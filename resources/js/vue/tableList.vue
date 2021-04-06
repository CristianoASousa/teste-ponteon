<template>
    <table class="table">
        <tr>
            <th>Nome Completo</th>
            <th>Celular</th>
            <th>Cidade/UF</th>
            <th>Cadastrado em</th>
            <th>Pai Empresarial</th>
            <th>Rede</th>
            <th></th>
        </tr>
        <table-item v-for="(item ,index) in businessmen" :key="index" :businessmen="item"/>
    </table>
</template>

<script>
import tableItem from './tableItem'

export default {
    data: function(){
        return {
            businessmen: null
        }
    },
    components: {
        tableItem
    },
    mounted() {
        axios
            .get('api/businessmen')
            .then(response => (this.businessmen = response.data))
    }
}
</script>
<style scoped>
    .table {
        width: 90vw;
    }

</style>