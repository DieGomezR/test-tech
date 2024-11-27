import { Component, OnDestroy, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AuthService } from '../services/auth.service';
import { Subscription } from 'rxjs';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css'],
  imports: [CommonModule],
})
export class NavbarComponent implements OnInit, OnDestroy {
  isDropdownOpen = false;
  isMobileMenuOpen = false;
  isLoggedIn = false;
  username: string | null = null;

  private authSubscription!: Subscription;

  constructor(private authService: AuthService) {}

  ngOnInit(): void {
    this.authSubscription = this.authService.isLoggedIn$.subscribe((loggedIn) => {
      this.isLoggedIn = loggedIn;
      this.username = loggedIn ? this.authService.getUsername() : '';
    });
  }

  toggleDropdown() {
    this.isDropdownOpen = !this.isDropdownOpen;
  }

  toggleMobileMenu() {
    this.isMobileMenuOpen = !this.isMobileMenuOpen;
  }

  logout(): void {
    this.authService.logout();
  }

  ngOnDestroy(): void {
    // Evitar fugas de memoria
    this.authSubscription.unsubscribe();
  }
}
