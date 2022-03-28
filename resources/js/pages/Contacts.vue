<template>
  <div>
    <h1>Contatti</h1>

    <div v-if="!formSubmitted">
      <div>
        <div class="mb-3">
          <label for="exampleFormControlInput1" class="form-label">Nome e Cognome:</label>
          <input 
            type="email" class="form-control" 
            id="exampleFormControlInput1" 
            placeholder="Inserisci il tuo nome e cognome"
            v-model="formData.name"
          >
          <span class="text-danger" 
            v-if="formValidationErrors && formValidationErrors.name"> 
              {{formValidationErrors.name}} 
          </span>
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
          <span class="text-danger" 
            v-if="formValidationErrors && formValidationErrors.email"> 
              {{formValidationErrors.email}} 
          </span>
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
          <span class="text-danger" 
            v-if="formValidationErrors && formValidationErrors.message"> 
              {{formValidationErrors.message}} 
          </span>
        </div>
      </div>

      <div>
        <button type="submit" class="btn btn-primary" @click="formSubmit">Invia!</button>
      </div>
    </div>

    <div v-else class="alert alert-success py-4">
      <h4>Grazie per averci contattato.</h4>
      <p class="lead">La sua richiesta è stata inviata, a breve le invieremo una email di conferma.</p>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      formSubmitted: false,
      formData: {
        name: "",
        email: "",
        message: "",
      },
      formValidationErrors: null
    };
  },
  methods: {
    async formSubmit() {
      try {
        this.formValidationErrors = null;
        
        const resp = await axios.post("/api/contacts", this.formData);
        
        //resp.data;
        this.formSubmitted = true;

      } catch (er) {
        if (er.response.status === 422) {
          this.formValidationErrors = er.response.data.errors;
        }

        alert("A causa di un errore non è stato possibile inviare la sua richiesta.\n"
          + er.response.data.message
        );
      }
    }
  },
}
</script>

<style></style>