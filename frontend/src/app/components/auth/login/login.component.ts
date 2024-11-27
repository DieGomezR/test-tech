import { Component } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { ApiService } from '../../../services/api.service';
import { AuthService } from '../../../services/auth.service';
import { Router } from '@angular/router'; // Importa Router

@Component({
  selector: 'app-sign-in',
  standalone: true,
  imports: [CommonModule, FormsModule],
  templateUrl: './login.component.html',
  styles: ``,
})
export default class SignInComponent {
  email: string = '';
  password: string = '';
  message: string = '';

  constructor(
    private apiService: ApiService,
    private router: Router,
    private authService: AuthService
  ) {}

  ngOnInit(): void {
    // Verificar si ya está logueado
    if (this.authService.isLoggedIn()) {
      // Si está logueado, redirigir al dashboard
      this.router.navigate(['/dashboard']); // Asegúrate de que la ruta sea correcta
    }
  }

  login() {
    if (!this.email || !this.password) {
      this.message = 'Por favor, completa todos los campos.';
      return;
    }

    const loginData = { email: this.email, password: this.password };
    this.apiService.login(loginData).subscribe({
      next: (response: any) => {
        const token = response.token; // Asegúrate de que el backend devuelve un campo "token"
        if (token) {
          this.authService.saveToken(token, response.user); // Guarda el token en el AuthService
          this.router.navigate(['/dashboard']); // Redirige al dashboard
        } else {
          this.message = 'No se recibió un token válido.';
        }
      },
      error: (error: any) => {
        console.error('Error:', error);
        this.message = 'Credenciales inválidas. Inténtalo nuevamente.';
      },
    });
  }
}
