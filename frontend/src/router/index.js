import { h, resolveComponent } from 'vue'
import { createRouter, createWebHashHistory } from 'vue-router'

import DefaultLayout from '@/layouts/DefaultLayout'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: DefaultLayout,
    redirect: '/home',
    children: [
      {
        path: '/home',
        name: 'HomeContent',
        component: () => import('@/views/dashboard/Home.vue'),
        meta: { requiresAuth: true }
      },
      {
        path: '/reserva',
        name: 'Reserva',
        component: {
          render () {
            return h(resolveComponent('router-view'))
          },
        },
        redirect: '/reserva/agendamento',
        children: [
          {
            path: 'agendamento',
            name: 'ReservaAgendamento',
            component: () => import('@/views/base/Agendamento.vue'),
            meta: { requiresAuth: true },
          },
        ],
      },
    ],
  },
  {
    path: '/pages',
    redirect: '/pages/404',
    name: 'Pages',
    component: {
      render() {
        return h(resolveComponent('router-view'))
      },
    },
    children: [
      {
        path: '404',
        name: 'Page404',
        component: () => import('@/views/pages/Page404'),
      },
      {
        path: '500',
        name: 'Page500',
        component: () => import('@/views/pages/Page500'),
      },
      {
        path: 'login',
        name: 'Login',
        component: () => import('@/views/pages/Login'),
      },
      {
        path: 'register',
        name: 'Register',
        component: () => import('@/views/pages/Register'),
      },
    ],
  },
]

const router = createRouter({
  history: createWebHashHistory(process.env.BASE_URL),
  routes,
  scrollBehavior() {
    // always scroll to top
    return { top: 0 }
  },
})

router.beforeEach((to, from, next) => {
  const isLoggedIn = !!localStorage.getItem('token');
  const isLoginPage = to.path === '/pages/login';

  if (to.matched.some(route => route.meta.requiresAuth)) {
    if (isLoggedIn) {
      next();
    } else {
      next('/pages/login');
    }
  } else {
    if (isLoginPage && isLoggedIn) {
      next('/home');
    } else {
      next();
    }
  }
});

export default router