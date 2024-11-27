import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  private tokenKey = 'authToken';
  private idKey = 'authId';
  private usernameKey = 'authUsername';

  private isLoggedInSubject = new BehaviorSubject<boolean>(this.isLoggedIn());
  isLoggedIn$ = this.isLoggedInSubject.asObservable();

  saveToken(token: string, user: { id: number; name: string }): void {
    localStorage.setItem(this.tokenKey, token);
    localStorage.setItem(this.idKey, user.id.toString());
    localStorage.setItem(this.usernameKey, user.name);
    this.isLoggedInSubject.next(true);
  }

  getToken(): string | null {
    return localStorage.getItem(this.tokenKey);
  }

  // Método para obtener el username almacenado
  getUsername(): string | null {
    return localStorage.getItem(this.usernameKey);
  }

  // Método para obtener el ID almacenado
  getUserId(): number | null {
    const id = localStorage.getItem(this.idKey);
    return id ? parseInt(id, 10) : null; // Convertir a número si existe
  }
  // Cierra sesión eliminando el token
  logout(): void {
    localStorage.removeItem(this.tokenKey);
    localStorage.removeItem(this.idKey);
    localStorage.removeItem(this.usernameKey);
    this.isLoggedInSubject.next(false);
  }

  isLoggedIn(): boolean {
    return !!localStorage.getItem(this.tokenKey);
  }
}
