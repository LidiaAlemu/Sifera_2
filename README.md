# Sifera - Book Café Management System

A modern web-based management system for a quiet book café and alternative space where coffee, books, and community meet.

## Architecture

This project uses a modern Next.js + Laravel architecture:

```
Customer
     │
     ▼
Next.js 15 Frontend (Premium Brown Design)
     │
REST API (JSON) /api/v1/
     │
     ▼
Laravel 12 Backend
     │
Laravel Sanctum Authentication
     │
Eloquent ORM
     │
Supabase PostgreSQL Database
```

## Project Structure

```
Sifera_2/
├── frontend/          # Next.js 15 frontend application
│   ├── src/          # React components and pages
│   ├── public/       # Static assets
│   └── package.json  # Frontend dependencies
├── backend/          # Laravel 12 backend API
│   ├── app/          # Laravel application code
│   ├── routes/       # API routes
│   └── database/     # Laravel migrations and models
├── docs/             # Project documentation
│   ├── architecture.md    # System architecture overview
│   ├── database/          # Database schema and ER diagrams
│   ├── api/               # API documentation
│   └── ui/                # UI design system documentation
├── design/           # Design assets and specifications
├── database/         # Database scripts and backups
├── api/              # API contracts and specifications
└── scripts/          # Utility scripts
```

## Getting Started

### Prerequisites

- Node.js 18+
- PHP 8.2+
- Composer
- PostgreSQL (Supabase)

### Frontend Setup

```bash
cd frontend
npm install
npm run dev
```

The frontend will be available at `http://localhost:3000`

### Backend Setup

```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

The backend API will be available at `http://localhost:8000`

## Technology Stack

### Frontend
- Next.js 15
- React 19
- TypeScript
- Tailwind CSS
- Axios (API client)

### Backend
- Laravel 12
- PHP 8.2+
- Laravel Sanctum (Authentication)
- Eloquent ORM
- PHPUnit (Testing)

### Database
- PostgreSQL (Supabase)

## User Roles

- **Customer**: Browse books, view menu, register for events, manage profile
- **Manager**: Manage books, inventory, menu, events, orders, view dashboard
- **Admin**: All manager capabilities plus system settings and user management

## Documentation

- [Architecture Overview](docs/architecture.md)
- [Database Schema](docs/database/schema.md)
- [API Documentation](docs/api/)
- [UI Design System](docs/ui/design-system.md)
- [Deployment Guide](docs/deployment.md)

## Development Status

This project is currently undergoing a major architecture migration. See the migration plan for details.

## License

Proprietary