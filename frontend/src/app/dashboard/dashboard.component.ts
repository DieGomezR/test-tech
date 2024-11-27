import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { PostsService } from '../services/posts.service';
import { AuthService } from '../services/auth.service';

@Component({
  selector: 'app-posts',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css'],
  imports: [FormsModule, CommonModule],
})
export default class PostsComponent implements OnInit {
  posts: any[] = [];
  categories: any[] = [];
  selectedCategory: number | null = null;
  message: string = '';
  categoryMessage: string = '';
  modalMessage: string = '';
  isModalOpen: boolean = false;
  newPost: { title: string; content: string; category_id: number } = {
    title: '',
    content: '',
    category_id: 0,
  };
  isModalOpenCategories: boolean = false;
  newCategory: { name: string; description: string } = {
    name: '',
    description: '',
  };

  constructor(
    private postsService: PostsService,
    private authService: AuthService
  ) {}

  ngOnInit() {
    this.loadCategories();
    this.loadPosts();
  }

  loadCategories(): void {
    this.postsService.getCategories().subscribe({
      next: (data) => {
        this.categories = Array.isArray(data) ? data : [];
      },
      error: () => {
        this.message = 'No se pudieron cargar las categorías.';
      },
    });
  }

  loadPosts(): void {
    this.postsService.getPostsByCategory(this.selectedCategory).subscribe({
      next: (data) => {
        this.posts = Array.isArray(data) ? data : [];
      },
      error: () => {
        this.message = 'No se pudieron cargar los posts.';
      },
    });
  }

  onCategoryChange(categoryId: number): void {
    this.selectedCategory = categoryId;
    this.loadPosts();
  }

  openModal(): void {
    this.isModalOpen = true;
  }

  closeModal(): void {
    this.isModalOpen = false;
    this.newPost = { title: '', content: '', category_id: 0 };
    this.modalMessage = '';
  }

  openModalCategories(): void {
    this.isModalOpenCategories = true;
  }

  closeModalCategories(): void {
    this.isModalOpenCategories = false;
    this.newCategory = { name: '', description: '' };
    this.categoryMessage = '';
  }

  createCategory(): void {
    if (!this.newCategory.name || !this.newCategory.description) {
      this.categoryMessage = 'Por favor, completa todos los campos.';
      return;
    }

    this.postsService.createCategory(this.newCategory).subscribe({
      next: () => {
        this.categoryMessage = 'Categoría creada exitosamente';
        this.loadCategories();
        this.closeModalCategories();
      },
      error: () => {
        this.categoryMessage = 'No se pudo crear la categoría.';
      },
    });
  }

  createPost(): void {
    const userId = this.authService.getUserId();

    if (!userId) {
      this.message = 'No se pudo identificar al usuario. Inicia sesión nuevamente.';
      return;
    }

    if (!this.newPost.title || !this.newPost.content || !this.newPost.category_id) {
      this.message = 'Por favor, completa todos los campos.';
      return;
    }

    const postData = { ...this.newPost, user_id: +userId };

    this.postsService.createPost(postData).subscribe({
      next: () => {
        this.message = 'Post creado exitosamente';
        this.loadPosts();
        this.closeModal();
      },
      error: () => {
        this.message = 'No se pudo crear el post. Intenta nuevamente.';
      },
    });
  }
}
