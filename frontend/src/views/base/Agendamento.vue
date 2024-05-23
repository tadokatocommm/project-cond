<template>
    <div>
      <h1>Agendamento de serviços online do seu condomínio</h1>
      <form @submit.prevent="submitForm">
        <FormkitStep :step="1" :currentStep="currentStep">
          <h2 slot="title">Selecione o Serviço</h2>
          <FormkitSelect
            v-model="selectedService"
            aria-label="Selecione o serviço"
          >
            <option disabled value="">Selecione o serviço:</option>
            <option v-for="service in services" :key="service.id" :value="service.id">{{ service.name }}</option>
          </FormkitSelect>
          <button @click="nextStep" type="button">Continuar</button>
        </FormkitStep>
  
        <FormkitStep :step="2" :currentStep="currentStep">
          <h2 slot="title">Selecione a Data</h2>
          <!-- Coloque os campos para selecionar a data aqui -->
          <button @click="nextStep" type="button" :disabled="currentStep < 2">Continuar</button>
        </FormkitStep>
  
        <FormkitStep :step="3" :currentStep="currentStep">
          <h2 slot="title">Revisar</h2>
          <!-- Coloque os campos para revisar aqui -->
          <button type="submit">Confirmar</button>
        </FormkitStep>
      </form>
    </div>
  </template>
  
  <script>
  import { FormkitStep, FormkitSelect } from '@formkit/vue';
  import axios from 'axios'; 
  
  export default {
    components: {
      FormkitStep,
      FormkitSelect,
    },
    data() {
      return {
        services: [],
        selectedService: '',
        currentStep: 1,
      };
    },
    methods: {
      async fetchServices() {
        try {
          const response = await axios.get('http://localhost:8000/api/services'); 
          this.services = response.data;
        } catch (error) {
          console.error('Error fetching services:', error);
        }
      },
      nextStep() {
        this.currentStep += 1;
      },
      async submitForm() {
        // Lógica para enviar o formulário
      },
    },
    mounted() {
      this.fetchServices();
    },
  };
  </script>
  
  <style>
  /* Estilos do FormKit */
  </style>