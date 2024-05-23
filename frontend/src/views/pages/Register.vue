<template>
  <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
    <CContainer>
      <CRow class="justify-content-center">
        <CCol :md="9" :lg="7" :xl="6">
          <CCard class="mx-4">
            <CCardBody class="p-4">
              <CForm @submit.prevent="register">
                <h1>Register</h1>
                <p class="text-medium-emphasis">Create your account</p>
                <CInputGroup class="mb-3">
                  <CInputGroupText>
                    <CIcon icon="cil-user" />
                  </CInputGroupText>
                  <CFormInput
                    v-model="name"
                    placeholder="Nome"
                    autocomplete="nome"
                  />
                </CInputGroup>
                <CInputGroup class="mb-3">
                  <CInputGroupText>@</CInputGroupText>
                  <CFormInput
                    v-model="email"
                    placeholder="Email"
                    autocomplete="email"
                  />
                </CInputGroup>
                <CInputGroup class="mb-3">
                  <CInputGroupText>@</CInputGroupText>
                  <CFormInput
                    v-model="bloco"
                    placeholder="Bloco"
                    autocomplete="bloco"
                  />
                </CInputGroup>
                <CInputGroup class="mb-3">
                  <CInputGroupText>
                    <CIcon icon="cil-lock-locked" />
                  </CInputGroupText>
                  <CFormInput
                    type="password"
                    v-model="password"
                    placeholder="Password"
                    autocomplete="new-password"
                  />
                </CInputGroup>
                <CInputGroup class="mb-4">
                  <CInputGroupText>
                    <CIcon icon="cil-lock-locked" />
                  </CInputGroupText>
                  <CFormInput
                    type="password"
                    v-model="confirmPassword"
                    placeholder="Repeat password"
                    autocomplete="new-password"
                  />
                </CInputGroup>
                <div class="d-grid">
                  <CButton type="submit" color="success">Create Account</CButton>
                </div>
              </CForm>
            </CCardBody>
          </CCard>
        </CCol>
      </CRow>
    </CContainer>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Register',
  data() {
    return {
      name: '',
      email: '',
      bloco: '',
      password: '',
      confirmPassword: '',
    };
  },
  methods: {
    register() {
      if (this.password !== this.confirmPassword) {
        alert('As senhas não coincidem');
        return;
      }

      let userData = {
        name: this.name,
        email: this.email,
        bloco: this.bloco,
        password: this.password,
        password_confirmation: this.confirmPassword,
      };

      axios.post('http://localhost:8000/api/users/create', userData)
        .then(response => {
          console.log('Registrado com sucesso', response.data);
          this.$router.push('/pages/login');
        })
        .catch(error => {
          console.error('Registro deu erro', error.message);
          alert('O registro falhou. Tente novamente');
        });
    },
  },
};
</script>
