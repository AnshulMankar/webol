import { createRouter, createWebHistory } from 'vue-router';
import BookCylinder from './Pages/BookCylinder.vue';

const routes = [
  {
    name: 'book-cylinder',
    path: '/book-cylinder',
    component: BookCylinder
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
