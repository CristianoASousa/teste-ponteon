<template>
    <div class="container">
        <h3>Cadastro de Empresários</h3>
        <form-add />
        <h3>Lista de Empresários já cadastrados</h3>
        <table-list />
    </div>
</template>

<script>
import tableList from './tableList'
import formAdd from './formAdd'
export default {
    components: {
        formAdd,
        tableList
    }
    
}
</script>
<style scoped>
    .container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
</style>