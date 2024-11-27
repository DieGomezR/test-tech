import { Component } from '@angular/core';
import { ApiService } from '../../../services/api.service';
import { FormsModule } from '@angular/forms';
import { AuthService } from '../../../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css'],
  imports: [FormsModule],
})
export default class RegisterComponent {
  user = { name: '', email: '', password: '' };
  message = '';
  constructor(
    private apiService: ApiService,
    private router: Router,
    private authService: AuthService
  ) {}

  ngOnInit(): void {
    if (this.authService.isLoggedIn()) {
      this.router.navigate(['/dashboard']);
    }
  }

  register() {
    if (!this.user.name || !this.user.email || !this.user.password) {
      this.message = 'Por favor, completa todos los campos.';
      return;
    }

    this.apiService.register(this.user).subscribe({
      next: (response: any) => {
        this.router.navigate(['/dashboard']);
      },
      error: (error) => {
        console.error('Error al registrar al usuario:', error);
        this.message = 'Hubo un problema al registrarse. Intenta nuevamente.';
      },
    });
  }
}
