import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { catchError, Observable, throwError } from 'rxjs';
import { AuthService } from './auth.service';

@Injectable({
  providedIn: 'root',
})
export class ApiService {
  private apiUrl = 'http://localhost:8000/api'; // Cambia a la URL de tu backend

  constructor(private http: HttpClient, private authService: AuthService) {}

  private getHeaders(): HttpHeaders {
    const token = this.authService.getToken();
    return new HttpHeaders({
      Authorization: token ? ` ${token}` : '', // Solo agrega el token si existe
    });
  }

  // Método de registro
  register(user: { name: string; email: string; password: string }): Observable<any> {
    return this.http.post<any>(`${this.apiUrl}/register`, user);
  }

  // Login de usuarios
  login(credentials: { email: string; password: string }): Observable<any> {
    return this.http.post(`${this.apiUrl}/login`, credentials).pipe(
      catchError((error) => {
        console.error('Error:', error);
        return throwError(
          () => new Error('Credenciales inválidas. Inténtalo nuevamente.')
        );
      })
    );
  }

  // Crear un nuevo post
  createPost(post: any): Observable<any> {
    const headers = this.getHeaders(); // Obtener los encabezados con el token
    return this.http.post(`${this.apiUrl}/posts`, post, { headers });
  }

  // Obtener posts
  getPosts(categoryId?: any): Observable<any> {
    const headers = this.getHeaders(); // Obtener los encabezados con el token
    const url = categoryId
      ? `${this.apiUrl}/posts/${categoryId}`
      : `${this.apiUrl}/posts`;
    return this.http.get(url, { headers });
  }

  // Obtener categorías
  getCategories(): Observable<any> {
    return this.http.get(`${this.apiUrl}/categories`);
  }

  // Crear una nueva categoría
  createCategory(category: any): Observable<any> {
    const headers = this.getHeaders(); // Obtener los encabezados con el token
    return this.http.post(`${this.apiUrl}/categories`, category, { headers });
  }
}
