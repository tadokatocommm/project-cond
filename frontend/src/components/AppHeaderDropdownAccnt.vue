<template>
  <CDropdown variant="nav-item">
    <CDropdownToggle placement="bottom-end" class="py-0" :caret="false">
      <CAvatar :src="avatar" size="md" class="avatar-padding my-1" /> 
    </CDropdownToggle>
    <CDropdownMenu class="pt-0">
      <CDropdownHeader component="h6" class="bg-light fw-semibold py-2">
        Conta
      </CDropdownHeader>
      <CDropdownItem>
        <CIcon icon="cilUser" /> Seus dados
        <CBadge color="secondary" class="ms-auto"></CBadge>
      </CDropdownItem>
      <CDropdownItem> <CIcon icon="cilCalendar" /> Reservas </CDropdownItem>
      <CDropdownDivider />
      <CDropdownItem @click="logout"> <CIcon icon="cil-lock-locked" /> Logout </CDropdownItem>
    </CDropdownMenu>
  </CDropdown>
</template>

<script>
import avatar from '@/assets/images/avatars/8.jpg';
import axios from 'axios';
import { useRouter } from 'vue-router';

export default {
  name: 'AppHeaderDropdownAccnt',
  setup() {
    const router = useRouter();
    return {
      avatar: avatar,
    };
  },
  methods: {
    logout() {
      const token = localStorage.getItem('token');
      console.log('Token:', token);
      if (!token) {
        alert('Usuário não autenticado. Impossível fazer logout.');
        return;
      }
      const config = {
        headers: {
          Authorization: `Bearer ${token}`,
        },
      };
      axios.post('http://localhost:8000/api/logout', null, config)
        .then(response => {
          if (response.status === 200) {
            console.log('Logout realizado com sucesso', response.data);
            localStorage.removeItem('token');
             this.$router.push({ name: 'Login' });
          } else {
            console.error('Erro ao fazer logout', response.data.message);
            alert('O logout falhou. Tente novamente');
          }
        })
        .catch(error => {
          console.error('Erro ao fazer logout', error.message);
          alert('O logout falhou. Tente novamente');
        });
    },
  },
};
</script>

<style scoped>
.avatar-padding {
  padding-right: 10px; 
}
</style>