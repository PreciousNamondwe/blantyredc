# Notices & Announcements System - Implementation Guide

## Overview

The Notices & Announcements system is a complete backend solution for managing public notices and announcements on the Blantyre District Council website. It includes:

- **Public Frontend**: Display notices with search, filtering, and pagination
- **Admin Dashboard**: Full CRUD operations for notice management
- **API Endpoints**: RESTful endpoints for programmatic access
- **Database**: Persistent storage with advanced querying capabilities

## Features

### For Public Users

- Browse all published notices with pagination
- Search notices by title, content, or reference number
- Filter notices by category
- View urgent notices sidebar
- Individual notice detail pages with related notices
- Social sharing capabilities (Facebook, Twitter, WhatsApp, Email)

### For Administrators

- Create, edit, delete notices
- Manage notice status (Draft, Published, Archived)
- Set urgency levels (Low, Medium, High, Urgent)
- Categorize notices
- Add reference numbers
- Publish/Archive notices with timestamps

## Installation & Setup

### 1. Run Database Migration

```bash
php spark migrate
```

This will create the `notices` table with the following structure:

- id (Primary Key)
- title (VARCHAR 255)
- slug (VARCHAR 255, Unique)
- content (LONGTEXT)
- reference (VARCHAR 100, Optional)
- category (VARCHAR 100)
- urgency_level (ENUM: low, medium, high, urgent)
- status (ENUM: draft, published, archived)
- author_id (Foreign Key to users table)
- published_at (TIMESTAMP)
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)

### 2. (Optional) Seed Sample Data

To populate the database with sample notices:

```bash
php spark db:seed NoticesSeeder
```

This will add 5 sample notices for testing.

## Usage

### Public Interface

#### Main Notices Page

- **URL**: `/notices`
- **Features**:
  - List all published notices
  - Search functionality
  - Pagination (10 per page)
  - Category filtering
  - Urgent notices sidebar
  - Category cloud with counts

#### Individual Notice Page

- **URL**: `/notices/{slug}`
- **Features**:
  - Full notice content
  - Meta information (date, category, urgency level, reference)
  - Social sharing buttons
  - Related notices from same category
  - Urgent notices sidebar

### API Endpoints

#### Get Urgent Notices

```
GET /api/notices/urgent
```

**Response**: JSON array of urgent/high priority notices (max 10)

#### Get Recent Notices

```
GET /api/notices/recent?limit=5
```

**Query Parameters**:

- `limit` (optional): Number of notices to return (default: 5)

**Response**: JSON array of recent notices

#### Search Notices

```
GET /api/notices/search?q=keyword&page=1
```

**Query Parameters**:

- `q` (required): Search keyword
- `page` (optional): Page number (default: 1)

**Response**: Paginated JSON array of search results

### Admin Interface

#### Notices Management

- **URL**: `/admin/notices`
- **Features**:
  - List all notices with pagination
  - Filter by status (Draft, Published, Archived)
  - Quick action buttons (Edit, Publish, Archive, Delete)
  - Status indicators with color coding
  - Urgency level badges

#### Create Notice

- **URL**: `/admin/notices/create`
- **Form Fields**:
  - Title (required, max 255 characters)
  - Content (required, supports HTML)
  - Reference Number (optional)
  - Category (required, with suggestions)
  - Urgency Level (required: Low, Medium, High, Urgent)
  - Status (Draft, Published, Archived)

#### Edit Notice

- **URL**: `/admin/notices/{id}/edit`
- **Features**:
  - Edit all notice fields
  - View creation and publication dates
  - Automatic slug regeneration on title change

## Models & Controllers

### NoticesModel (App\Models\NoticesModel)

**Methods**:

- `getPublishedNotices($limit, $offset)` - Get published notices with pagination
- `getNoticesByCategory($category, $limit, $offset)` - Get notices by category
- `getUrgentNotices($limit)` - Get urgent/high priority notices
- `getNoticeBySlug($slug)` - Get single notice by slug
- `getRecentNotices($limit)` - Get recent notices
- `getPublishedCount()` - Get count of published notices
- `getCategoriesWithCount()` - Get all categories with counts
- `searchNotices($keyword, $limit, $offset)` - Search notices
- `generateSlug($title)` - Generate unique slug from title

### NoticesController (App\Controllers\NoticesController)

**Methods**:

- `index()` - Display notices list with filtering and pagination
- `detail($slug)` - Display individual notice with related notices
- `getUrgentNotices()` - API endpoint for urgent notices
- `getRecentNotices()` - API endpoint for recent notices
- `search()` - API endpoint for searching notices

### AdminController Methods

**Notices Management**:

- `notices()` - List notices with filtering
- `createNotice()` - Create new notice
- `editNotice($id)` - Edit existing notice
- `deleteNotice($id)` - Delete notice
- `publishNotice($id)` - Publish draft notice
- `archiveNotice($id)` - Archive published notice

## Database Queries

### Get all published notices

```php
$notices = $this->noticesModel->getPublishedNotices(20, 0);
```

### Get urgent notices

```php
$urgent = $this->noticesModel->getUrgentNotices(10);
```

### Search notices

```php
$results = $this->noticesModel->searchNotices('emergency', 10, 0);
```

### Get notices by category

```php
$category = $this->noticesModel->getNoticesByCategory('Public Services', 20, 0);
```

## Views

### Public Views

- `app/Views/notices/index.php` - Main notices list page
- `app/Views/notices/detail.php` - Individual notice detail page

### Admin Views

- `app/Views/admin/notices/index.php` - Notices management list
- `app/Views/admin/notices/create.php` - Create notice form
- `app/Views/admin/notices/edit.php` - Edit notice form

## Routes

### Public Routes

```php
$routes->add('notices','NoticesController::index');
$routes->add('notices/(:any)','NoticesController::detail/$1');
```

### API Routes

```php
$routes->get('api/notices/urgent', 'NoticesController::getUrgentNotices');
$routes->get('api/notices/recent', 'NoticesController::getRecentNotices');
$routes->get('api/notices/search', 'NoticesController::search');
```

### Admin Routes

```php
$routes->get('admin/notices', 'AdminController::notices');
$routes->get('admin/notices/create', 'AdminController::createNotice');
$routes->post('admin/notices/create', 'AdminController::createNotice');
$routes->get('admin/notices/(:num)/edit', 'AdminController::editNotice/$1');
$routes->post('admin/notices/(:num)/edit', 'AdminController::editNotice/$1');
$routes->post('admin/notices/(:num)/delete', 'AdminController::deleteNotice/$1');
$routes->post('admin/notices/(:num)/publish', 'AdminController::publishNotice/$1');
$routes->post('admin/notices/(:num)/archive', 'AdminController::archiveNotice/$1');
```

## Best Practices

### Creating Notices

1. Use clear, descriptive titles
2. Use HTML formatting for better content organization
3. Set appropriate urgency levels
4. Categorize notices logically
5. Add reference numbers for official documents

### Content Guidelines

- Use consistent formatting
- Include contact information when relevant
- Add effective dates/deadlines
- Use lists and tables for complex information
- Keep language clear and accessible

### Performance Tips

- Archive old notices regularly
- Use categories to organize notices
- Limit urgent notices (max 5-10)
- Cache frequently accessed notices in production

## Troubleshooting

### Notices Not Showing

- Check notice status is "Published"
- Verify published_at date is not in the future
- Check database connection

### Search Not Working

- Verify search keyword in content/title/reference
- Check database collation for proper text search
- Ensure content is plain text or basic HTML

### Slug Issues

- Slugs are auto-generated from titles
- Can be manually edited before creation
- Must be unique (duplicates get -1, -2, etc. appended)

## Future Enhancements

Possible improvements:

- Rich text editor integration (TinyMCE, Quill, CKEditor)
- Scheduled publishing
- Email notifications for urgent notices
- Multi-language support
- File attachments to notices
- Notice expiration dates
- Notification subscriptions by category
- SMS alerts for urgent notices
- Social media auto-posting

## Support & Questions

For technical issues or questions about the implementation:

1. Check the NoticesModel and NoticesController code
2. Review database schema in migrations
3. Check error logs in `writable/logs/`
4. Verify file permissions for uploads (if added in future)

---

**Last Updated**: May 31, 2026
**Version**: 1.0
**Status**: Production Ready
