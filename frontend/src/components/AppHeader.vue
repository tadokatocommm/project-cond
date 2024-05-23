<template>
  <CHeader position="sticky" class="mb-4">
    <CContainer fluid>
      <CHeaderBrand class="mx-2">
        <CIcon :icon="logo" height="48" alt="Logo" />
      </CHeaderBrand>
      <CHeaderNav class="align-items-center">
        <CNavItem>
          <CNavLink active @click="navigateTo('/home')" class="nunito-font">
            Home
          </CNavLink>
        </CNavItem>
        <CNavItem>
          <CNavLink active @click="navigateTo('/reserva')" class="nunito-font">
            Faça sua reserva
          </CNavLink>
        </CNavItem>
        <AppHeaderDropdownAccnt />
      </CHeaderNav>
    </CContainer>
  </CHeader>
</template>

<script>
import AppHeaderDropdownAccnt from './AppHeaderDropdownAccnt'
import { logo } from '@/assets/brand/logo'
import '@/assets/css/fonts.css';
import { useRouter } from 'vue-router'; 

export default {
  name: 'AppHeader',
  components: {
    AppHeaderDropdownAccnt,
  },
  
  setup() {
    const router = useRouter(); 
  
    return {
      logo,
      navigateTo: (route) => { 
        router.push(route); 
      },
    };
  },
}
</script>

<style scoped>
.nunito-font {
  font-family: 'Nunito', sans-serif;
  cursor: pointer; 
}
</style>