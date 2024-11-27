import { Injectable } from '@angular/core';
import { ApiService } from './api.service';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class PostsService {
  constructor(private apiService: ApiService) {}

  // Obtener las categorías
  getCategories(): Observable<any> {
    return this.apiService.getCategories();
  }

  // Obtener posts por categoría
  getPostsByCategory(categoryId: number | null): Observable<any> {
    return this.apiService.getPosts(categoryId);
  }

  // Crear un post
  createPost(postData: any): Observable<any> {
    return this.apiService.createPost(postData);
  }

  // Crear una categoría
  createCategory(categoryData: any): Observable<any> {
    return this.apiService.createCategory(categoryData);
  }
}
