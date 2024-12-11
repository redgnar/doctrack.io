# DocTrack

DocTrack is a secure, multi-tenant document management system built with Domain-Driven Design (DDD) principles. The application enables organizations to efficiently manage, track, and store documents with their associated metadata and attachments.

## Key Features

- Multi-tenant architecture with separate database per organization for complete data isolation
- JWT-based authentication and authorization
- Document management with unique numbering system
- Support for multiple file attachments per document
- Rich document metadata and descriptions
- Domain-Driven Design architecture

## Technical Architecture

### Domain Model

- **Tenant**: Represents an organization in the multi-tenant system with its dedicated database
- **User**: System user with authentication and authorization capabilities
- **Document**: Core entity containing document metadata, number, and description
- **Attachment**: File attachments with descriptions linked to documents

### Multi-tenant Bundle

The multi-tenant functionality is implemented as a separate bundle (`@doctrack/tenant-bundle`) that provides:

- Tenant database connection management
- Database creation and migration per tenant
- Tenant context resolution and switching
- Tenant-aware repositories and services
- Middleware for tenant resolution from request
- CLI commands for tenant management

Key components:
```typescript
// Tenant configuration
interface TenantConfig {
  id: string;
  name: string;
  dbName: string;
  dbConfig: DatabaseConfig;
}

// Tenant context service
class TenantContextService {
  getCurrentTenant(): Tenant;
  setCurrentTenant(tenant: Tenant): void;
  getTenantConnection(): Connection;
}

// Tenant middleware
class TenantMiddleware {
  resolveTenant(request: Request): Tenant;
}

// Tenant-aware repository base
abstract class TenantAwareRepository<T> {
  protected getTenantConnection(): Connection;
}
```

### Security

- JWT (JSON Web Token) based authentication
- Role-based access control (RBAC)
- Complete tenant isolation through separate databases
- Secure file storage

### Technology Stack

- Backend: Node.js/TypeScript with Express
- Database: PostgreSQL (separate database per tenant)
- File Storage: S3-compatible storage
- Authentication: JWT with refresh token mechanism
- API: RESTful with OpenAPI specification

## API Endpoints

### Authentication
- POST /api/auth/login
- POST /api/auth/refresh-token
- POST /api/auth/logout

### Documents
- POST /api/documents
- GET /api/documents
- GET /api/documents/{id}
- PUT /api/documents/{id}
- DELETE /api/documents/{id}

### Attachments
- POST /api/documents/{id}/attachments
- GET /api/documents/{id}/attachments
- DELETE /api/documents/{id}/attachments/{attachmentId}

### Tenant Management
- POST /api/tenants - Create new tenant
- GET /api/tenants - List all tenants
- GET /api/tenants/{id} - Get tenant details
- PUT /api/tenants/{id} - Update tenant
- DELETE /api/tenants/{id} - Remove tenant

## Getting Started

[Installation and setup instructions will be added]

## Running project

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run `docker compose build --no-cache` to build fresh images
3. Run `docker compose up --pull always -d --wait` to set up and start a fresh Symfony project
4. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
5. Run `docker compose down --remove-orphans` to stop the Docker containers.


