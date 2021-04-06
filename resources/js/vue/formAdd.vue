<template>
    <div class="form">
      <div class="form-container">
        <label for="name">Nome Completo</label>
        <input id="name" v-model="name">
      </div>
    
      <div class="form-container">
        <label for="cell">Celular</label>
        <input id="cell" v-model="cell">
      </div>

      <div class="grid">
        <div class="form-container address">
          <label for="state">Estado</label>
          <select id="state" v-model="stateSelected">
            <option disabled value="">Escolha um Estado</option>
            <option v-for="state in states" v-bind:value="state">
              {{ state.sigla }}
            </option>
          </select>
        </div>

        <div class="form-container">
          <label for="city">Cidade</label>
          <select id="city" v-model="citySelected">
            <option disabled value="">Escolha uma Cidade</option>
            <option v-for="city in cities" v-bind:value="city.nome">
              {{ city.nome }}
            </option>
          </select>
        </div>
      </div>

      <div class="form-container">
        <label for="dad">Pai Empresarial</label>
        <select id="dad" v-model="businessmenSelected">
          <option disabled value="">Escolha um item</option>
          <option value=""></option>
          <option v-for="businessmen in listBusinessmen" v-bind:value="businessmen.id">
            {{businessmen.name}}
          </option>
        </select>
      </div>
      <button v-on:click="addBusinessmen()">Enviar</button>
  </div>
</template>
<script>
import axios from 'axios'

export default {
  data () {
    return {
      name: '',
      cell: '',
      states: null,
      stateSelected: '', 
      cities: '',
      citySelected: '',
      businessmenSelected: '',
      listBusinessmen: null
    }
   
  },
  mounted () {
    axios
      .get('https://servicodados.ibge.gov.br/api/v1/localidades/estados?orderBy=nome')
      .then(response => (this.states = response.data))
    axios
      .get('api/businessmen')
      .then(response => (this.listBusinessmen = response.data))
  },
  watch: {
    stateSelected: function (){
      axios
      .get(`https://servicodados.ibge.gov.br/api/v1/localidades/estados/${this.stateSelected.id}/distritos`)
      .then(response => (this.cities = response.data))
    }
  },
  methods: {
    addBusinessmen() {
      const data = {
        name: this.name,
        dad_businessmen_id: this.businessmenSelected,
        cell: this.cell,
        state: this.stateSelected.sigla,
        city: this.citySelected
      }
      axios
        .post('api/businessmen', data)
        .then(response => {
          if(response.status == 201){
            alert("Cadastro realizado com sucesso")
            this.name = ''
            this.cell = ''
            this.businessmenSelected = ''
            this.citySelected = ''
            this.cities = ''
            this. stateSelected =  ''
            this.refreshListBusinessmen()
          }
        })
    },

    refreshListBusinessmen() {
      axios
      .get('api/businessmen')
      .then(response => (this.listBusinessmen = response.data))
    }
  }

}
</script>

<style scoped>
  
  .form {
    width: 50vw;
  }
  .form-container {
    display: flex;
    flex-direction: column;
    margin-top: 10px;
    margin-bottom: 10px;
    font-size: 16px;
  }
  .grid {
    display: grid;
    grid-template-columns: 1fr 2fr;
  }
  .address {
    margin-right: 20px
  }

  .container h3 {
    margin: 5vh;
  }
  
</style>