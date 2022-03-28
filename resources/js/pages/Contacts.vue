<template>
  <div>
      <h1>Contatti</h1>

      <div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Nome e Cognome:</label>
          <input 
            type="email" class="form-control" 
            id="exampleFormControlInput1" 
            placeholder="Elisa Salva"
            v-model="formData.name"
          >
        </div>

        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Indirizzo Email:</label>
          <input 
            type="email" 
            class="form-control" 
            id="exampleFormControlInput1" 
            placeholder="name@example.com"
            v-model="formData.email"
          >
        </div>

        <div class="mb-3">
          <label for="exampleFormControlTextarea1" class="form-label">Messaggio:</label>
          <textarea 
              class="form-control" 
              id="exampleFormControlTextarea1" 
              rows="3"
              v-model="formData.message"
              >
          </textarea>
        </div>
      </div>

      <div>
        <button type="submit" class="btn btn-primary" @click="formSubmit">Invia!</button>
      </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      formData: {
        name: "",
        email: "",
        message: "",
      }
    }
  },
  methods: {
    async formSubmit() {
      const response = await axios.post("/api/contacts", this.formData)

      response.data
    }
  },
}
</script>

<style></style>