<template>
    <tr>
        <td>{{businessmen.name}}</td>
        <td>{{businessmen.cell}}</td>
        <td>{{businessmen.city}}/{{businessmen.state}}</td>
        <td>{{businessmen.created_at}}</td>
        <td>{{businessmen.dad_name.name}}</td>
        <td>
            <button v-on:click="seeNetwork()">Ver Rede</button>
        </td>
        <td>
            <button v-on:click="deleteBusinessmen(businessmen.id)">Excluir</button>
        </td>
    </tr>
</template>

<script>

export default {
    data: function(){
        return {
            network: null
        }
    },
    props: ['businessmen'],
    methods: {
        deleteBusinessmen(id) {
            var r = confirm("Tem certeza que deseja excluir o registro?");
            if (r == true) {
                axios
                .delete(`/api/businessmen/${id}`)
                .then(response => alert("Registro apagado com sucesso"))
                .catch(res => alert("Erro ao deletar o registro"))
            } 
        },
        seeNetwork() {
            alert(JSON.stringify(this.network, null, ' '))
        }
    }, 
    mounted() {
        axios
            .get(`api/businessmen/${this.businessmen.id}`)
            .then( async response => this.network = response.data)
    }
}
</script>
<style scoped>
    
</style>