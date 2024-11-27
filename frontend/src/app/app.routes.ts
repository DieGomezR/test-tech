import { Routes } from '@angular/router';
import PostsComponent from './dashboard/dashboard.component';
import { authGuard } from './guard/auth.guard';

export const routes: Routes = [
  {
    path: '',
    redirectTo: 'auth/login',
    pathMatch: 'full', // Redirige a auth por defecto
  },
  {
    path: 'auth',
    loadChildren: () => import('./components/auth/auth.route'),
  },
  {
    path: 'dashboard',
    component: PostsComponent,
    canActivate: [authGuard], // Protege la ruta del dashboard
  },
  {
    path: '**',
    redirectTo: 'auth/login', // Redirige a auth si la ruta no existe
  },
];
