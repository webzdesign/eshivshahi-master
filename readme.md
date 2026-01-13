# EShivshahi - Transport Management System

## Project Overview

EShivshahi is a comprehensive Laravel-based transport management system designed for managing vendor invoices, bill summaries, routes, vehicles, and multi-level approval workflows for transportation companies. The system facilitates the complete lifecycle of transportation billing from vendor invoice creation through government voucher processing (Parisishtha A & B) to final bill summary generation and approval.

### Target Users

- **Transport Company Administrators**: Manage divisions, depots, routes, rates, and users
- **Vendor Managers**: Create and manage vendor invoices
- **Vendor Accountants**: Process invoices and handle vendor-related operations
- **Government Officials**: Review and approve Parisishtha vouchers
- **Finance Team**: Process bill summaries and handle payment approvals
- **System Administrators**: Manage user permissions and system configuration

### Business Context

The system handles the complex workflow of transportation billing where:
1. Vendors submit invoices for vehicle operations
2. Invoices are processed into government vouchers (Parisishtha B, then Parisishtha A)
3. Bill summaries are generated combining vendor invoices and government approvals
4. Multi-level approval workflows ensure proper authorization before payments
5. Query management allows resolution of discrepancies in billing

---

## Tech Stack

### Backend
- **Framework**: Laravel 5.6
- **PHP Version**: 7.1.3 or higher
- **Database**: MySQL
- **Key Packages**:
  - `barryvdh/laravel-dompdf` (^0.8.3) - PDF generation
  - `yajra/laravel-datatables-oracle` (^8.7) - Server-side DataTables
  - `laravel/tinker` (^1.0) - REPL for Laravel

### Frontend
- **JavaScript**: jQuery 3.2, Vue.js 2.5.7
- **CSS Framework**: Bootstrap 4.0.0
- **Build Tools**: Laravel Mix 2.0, Webpack
- **Additional Libraries**: 
  - Popper.js 1.12
  - Axios 0.18
  - Lodash 4.17.4

### Development Tools
- **Testing**: PHPUnit 7.0
- **Code Quality**: Mockery 1.0, Collision 2.0

---

## Folder Structure

```
eshivshahi-master/
├── app/
│   ├── Console/              # Artisan commands and scheduled tasks
│   │   └── Kernel.php        # Task scheduling configuration
│   ├── Exceptions/            # Exception handlers
│   ├── Helpers/               # Custom helper functions
│   │   └── Helper.php        # Utility functions (permissions, rates, vehicles)
│   ├── Http/
│   │   ├── Controllers/       # Application controllers (34 files)
│   │   │   ├── Auth/          # Authentication controllers
│   │   │   ├── VendorinvoicesController.php
│   │   │   ├── BillsummaryController.php
│   │   │   ├── ParisishthaAController.php
│   │   │   ├── ParisishthaBController.php
│   │   │   └── ...            # Other controllers
│   │   ├── Middleware/        # HTTP middleware (7 files)
│   │   │   ├── Permissionmiddleware.php
│   │   │   └── ...            # Other middleware
│   │   └── Requests/          # Form request validation (7 files)
│   ├── Model/                 # Eloquent models (24 files)
│   │   ├── Vendorinvoice.php
│   │   ├── Billsummary.php
│   │   ├── ParisishthaA.php
│   │   ├── ParisishthaB.php
│   │   └── ...                # Other models
│   ├── Providers/             # Service providers
│   └── User.php               # User model
├── bootstrap/                 # Application bootstrap files
├── config/                    # Configuration files
├── database/
│   ├── migrations/            # Database migrations (18 files)
│   ├── seeds/                 # Database seeders
│   └── factories/             # Model factories
├── public/                    # Public assets and entry point
│   ├── assets/                # Frontend assets
│   └── index.php              # Application entry point
├── resources/
│   ├── assets/                # Raw assets (JS, SCSS)
│   ├── lang/                  # Language files
│   └── views/                 # Blade templates (89 files)
├── routes/
│   ├── web.php                # Web routes
│   ├── api.php                # API routes
│   └── console.php            # Console routes
├── storage/                   # Logs, cache, sessions
├── tests/                     # PHPUnit tests
├── artisan                    # Artisan command-line tool
├── composer.json              # PHP dependencies
├── package.json               # Node.js dependencies
└── webpack.mix.js             # Laravel Mix configuration
```

---

## Feature List

### Master Data Management
- **Division Management**: Create and manage organizational divisions
- **Depot Management**: Manage depots within divisions
- **Vehicle Management**: Register and manage vehicles with vendor associations
- **Vendor Management**: Manage vendor accounts and details
- **Route Master**: Define routes with scheduled timings, KM, and bus types
- **Rate Master**: Configure rates based on bus type and kilometer ranges
- **Charges Master**: Manage various charges (breakdown, parking, wash, etc.)
- **City Master**: Manage city names for route planning

### User Management & Permissions
- **User Management**: Create and manage system users
- **User Types**: Define different user roles (Admin, Vendor Manager, Accountant, etc.)
- **Access Types**: Control access levels (Division-level, Depot-level)
- **Permission System**: Module-based permission control (Create, Edit, View)
- **Hierarchy Management**: Configure approval hierarchies for different modules
- **Allow Users**: Manage user access permissions
- **Vendor Managers**: Assign managers to vendors
- **Vendor Accountants**: Assign accountants to vendors

### Invoice Management
- **Vendor Invoice Creation**: Create invoices with multi-day entries
  - Track kilometers, diesel consumption, expenses
  - Calculate rates based on route and KM
  - Handle schedule completion tracking
  - Support for idling minutes tracking
- **Invoice Validation**: 
  - Duplicate invoice number checking
  - Date and vehicle validation
  - Schedule number validation
- **Invoice Approval**: Multi-level approval workflow
- **Invoice Printing**: PDF generation for vendor invoices

### Parisishtha (Government Voucher) Processing
- **Parisishtha B**: 
  - Create government vouchers from vendor invoices
  - Track daily KM, diesel, expenses
  - Calculate diesel as per government rates
  - Handle breakdown charges, parking, wash expenses
  - Support for multiple days in a single voucher
- **Parisishtha A**: 
  - Generate final government vouchers from Parisishtha B
  - Calculate average KM and rates
  - Handle diesel calculations and deductions
  - Calculate final payable amounts
- **Voucher Validation**: 
  - Check for duplicate vouchers
  - Validate billing periods
  - Verify vehicle and route associations

### Bill Summary Management
- **Bill Summary Creation**: Combine vendor invoices with Parisishtha vouchers
- **Amount Calculations**:
  - Vendor invoice amounts
  - Government approved amounts
  - Deductions (vendor, percentage, previous)
  - Vendor reimbursements
  - TDS calculations
  - Final payable amounts
- **Bill Summary Approval**: Multi-level sequential approval workflow
- **Query Management**: Raise and resolve queries on bill summaries
- **Bill Summary Printing**: PDF generation for approved bills

### Approval Workflows
- **Sequential Approval**: Sequence-based approval system
- **Hierarchy-based Routing**: Approvals routed based on user hierarchy
- **Query Resolution**: Raise queries and track resolution
- **Approval History**: Track all approval actions and history
- **Manager Confirmation**: Separate manager-level confirmation workflow

### Reporting & Data Management
- **DataTables Integration**: Server-side pagination and filtering
- **PDF Reports**: Generate PDFs for invoices and bills
- **Edit History Tracking**: Track all changes to records
- **Data Export**: Export data in various formats

### Authentication & Security
- **Mobile-based Login**: Login using mobile number and password
- **OTP-based Password Reset**: OTP verification for password reset
- **Session Management**: Secure session handling
- **CSRF Protection**: Cross-site request forgery protection
- **Role-based Access Control**: Access control based on user roles

---

## Application Flow

### High-Level Workflow

```
┌─────────────────┐
│  Vendor Invoice │
│    Creation     │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│  Invoice        │
│  Validation     │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│  Parisishtha B  │
│    Creation     │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│  Parisishtha A  │
│    Creation     │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│  Bill Summary   │
│    Generation   │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│  Approval       │
│  Workflow       │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│  Payment        │
│  Processing     │
└─────────────────┘
```

### Detailed Invoice Processing Flow

1. **Vendor Invoice Entry**
   - Select vendor, vehicle, route, division, depot
   - Enter billing period (from date to date)
   - Add daily entries: date, KM, diesel, expenses
   - System calculates rates based on Route Master and Rate Master
   - Validate invoice number uniqueness
   - Save invoice

2. **Parisishtha B Processing**
   - Select vendor invoice or create standalone Parisishtha B
   - Enter government voucher details
   - Add daily entries with KM, diesel, expenses
   - Calculate diesel as per government rates
   - Handle extra diesel charges
   - Save Parisishtha B

3. **Parisishtha A Processing**
   - Create from Parisishtha B
   - Calculate average KM
   - Apply rate calculations
   - Calculate diesel amounts
   - Apply deductions
   - Generate final amounts

4. **Bill Summary Generation**
   - Select vendor, vehicle, billing period
   - Link Parisishtha A and Parisishtha B
   - Link vendor invoice
   - Calculate vendor invoice amount
   - Calculate government approved amount
   - Apply deductions (vendor, percentage, previous)
   - Calculate TDS
   - Generate final payable amount
   - Save bill summary

5. **Approval Workflow**
   - Bill summary enters approval queue
   - Sequential approval based on hierarchy
   - Each approver can approve or raise query
   - Queries must be resolved before proceeding
   - Final approval triggers payment processing

### Approval Hierarchy Flow

```
Bill Summary Created
        │
        ▼
┌───────────────┐
│ Vendor        │
│ Confirmation  │
└───────┬───────┘
        │
        ▼
┌───────────────┐
│ Sequence 1    │
│ Approver      │
└───────┬───────┘
        │
        ▼
┌───────────────┐
│ Sequence 2    │
│ Approver      │
└───────┬───────┘
        │
        ▼
┌───────────────┐
│ Manager       │
│ Confirmation  │
└───────┬───────┘
        │
        ▼
┌───────────────┐
│ Final         │
│ Approval      │
└───────────────┘
```

---

## API & Third-Party Integrations

### SMS Gateway Integration
- **Service**: SMS Gateway Hub
- **Purpose**: OTP sending for password reset
- **Status**: Currently commented out in code
- **Configuration**: API key and sender ID stored in environment variables
- **Implementation**: Found in `app/Http/Controllers/Auth/LoginController.php`
- **Note**: Currently using hardcoded OTP '123456' for testing

### PDF Generation
- **Library**: Laravel DomPDF (barryvdh/laravel-dompdf)
- **Usage**: 
  - Vendor invoice printing
  - Parisishtha A printing
  - Parisishtha B printing
  - Bill summary printing
- **Implementation**: Used in various controllers for generating PDF reports

### DataTables Integration
- **Library**: Yajra Laravel DataTables (yajra/laravel-datatables-oracle)
- **Purpose**: Server-side data processing for tables
- **Usage**: 
  - Listing vendor invoices
  - Listing bill summaries
  - Listing Parisishtha records
  - All master data listings
- **Features**: Pagination, sorting, filtering, searching

### No External API Integrations
The application does not currently integrate with:
- Payment gateways
- Shipping/tracking services
- External accounting systems
- Real-time SMS services (commented out)

---

## Setup & Installation

### Prerequisites

- **PHP**: 7.1.3 or higher
- **Composer**: Latest version
- **Node.js**: 8.x or higher
- **NPM**: Comes with Node.js
- **MySQL**: 5.7 or higher
- **Web Server**: Apache/Nginx
- **PHP Extensions**:
  - OpenSSL
  - PDO
  - Mbstring
  - Tokenizer
  - XML
  - Ctype
  - JSON
  - BCMath

### Installation Steps

1. **Clone the Repository**
   ```bash
   git clone <repository-url>
   cd eshivshahi-master
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js Dependencies**
   ```bash
   npm install
   ```

4. **Environment Configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   
   Edit `.env` file with your configuration (see Environment Variables section)

5. **Database Setup**
   ```bash
   # Create database
   mysql -u root -p
   CREATE DATABASE eshivshahi_db;
   
   # Run migrations
   php artisan migrate
   
   # Seed initial data (optional)
   php artisan db:seed
   ```

6. **Storage Link**
   ```bash
   php artisan storage:link
   ```

7. **Build Frontend Assets**
   ```bash
   # Development
   npm run dev
   
   # Production
   npm run production
   ```

8. **Set Permissions** (Linux/Mac)
   ```bash
   chmod -R 775 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache
   ```

9. **Clear Cache**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan view:clear
   ```

### Initial User Setup

After installation, you need to create the first admin user. You can do this via:

1. **Database Seeder** (if provided)
2. **Tinker Command**:
   ```bash
   php artisan tinker
   ```
   Then create user:
   ```php
   $user = new App\User();
   $user->first_name = 'Admin';
   $user->last_name = 'User';
   $user->mobile = '1234567890';
   $user->password = Hash::make('password');
   $user->usertype_id = 1; // Admin
   $user->status = 1;
   $user->active_status = 1;
   $user->save();
   ```

---

## Environment Variables

Create a `.env` file in the root directory with the following variables:

```env
APP_NAME=EShivshahi
APP_ENV=local
APP_KEY=base64:your-generated-key-here
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eshivshahi_db
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password

# Mail Configuration (Optional)
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=noreply@eshivshahi.com
MAIL_FROM_NAME="${APP_NAME}"

# SMS Gateway Configuration (Currently Disabled)
SMS_API_KEY=your_sms_api_key
SMS_SENDER_ID=ESHIVS
SMS_GATEWAY_URL=https://www.smsgatewayhub.com/api/mt/SendSMS

# Session Configuration
SESSION_DRIVER=file
SESSION_LIFETIME=120

# Cache Configuration
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

# Redis Configuration (Optional)
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# Broadcasting (Optional)
BROADCAST_DRIVER=log

# Filesystem
FILESYSTEM_DRIVER=local
```

### Required Variables

- `APP_KEY` - Application encryption key (generate with `php artisan key:generate`)
- `DB_*` - Database connection details
- `APP_URL` - Application URL

### Optional Variables

- `MAIL_*` - Email configuration (if using email features)
- `SMS_*` - SMS gateway configuration (currently not active)
- `REDIS_*` - Redis configuration (if using Redis)

---

## Running the Project

### Local Development

1. **Start Development Server**
   ```bash
   php artisan serve
   ```
   Application will be available at `http://localhost:8000`

2. **Watch for Asset Changes**
   ```bash
   npm run watch
   ```
   This will automatically recompile assets when changes are detected.

3. **Hot Module Replacement** (Optional)
   ```bash
   npm run hot
   ```
   Enables hot reloading for Vue components.

### Production Deployment

1. **Optimize Application**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

2. **Build Production Assets**
   ```bash
   npm run production
   ```

3. **Set Environment**
   ```env
   APP_ENV=production
   APP_DEBUG=false
   ```

4. **Configure Web Server**
   - Point document root to `public/` directory
   - Configure URL rewriting for Apache/Nginx
   - Set proper file permissions

5. **Queue Workers** (if using queues)
   ```bash
   php artisan queue:work
   ```

### Common Commands

```bash
# Clear all caches
php artisan optimize:clear

# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Create new migration
php artisan make:migration create_table_name

# Create new controller
php artisan make:controller ControllerName

# Run tests
php artisan test
# or
phpunit
```

---

## Cron Jobs / Background Tasks

### Scheduled Tasks

Currently, there are **no scheduled tasks** configured in the application. The `app/Console/Kernel.php` file's `schedule()` method is empty.

### Recommended Cron Jobs

For production environments, you may want to add:

1. **Laravel Scheduler** (add to crontab):
   ```bash
   * * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1
   ```

2. **Queue Workers** (if using queues):
   ```bash
   php artisan queue:work --daemon
   ```

3. **Log Rotation** (system-level):
   ```bash
   0 0 * * * find /path-to-project/storage/logs -name "*.log" -mtime +30 -delete
   ```

### Future Considerations

Consider implementing scheduled tasks for:
- Automated bill summary generation
- Reminder notifications for pending approvals
- Data archival
- Report generation

---

## Common Use Cases

### Use Case 1: Creating a Vendor Invoice

1. Navigate to **Vendor Invoice** → **Create**
2. Select:
   - Vendor
   - Vehicle (filtered by vendor)
   - Division
   - Depot (filtered by division)
   - Route (filtered by depot)
   - Billing Period (from date to date)
3. Enter invoice number (validated for uniqueness)
4. Add daily entries:
   - Date
   - Kilometers
   - Diesel liters
   - Expenses (breakdown, parking, wash, etc.)
5. System automatically calculates:
   - Rate based on Route Master and Rate Master
   - Total amount
   - Average rate
6. Save invoice
7. Invoice can be printed as PDF

### Use Case 2: Processing Parisishtha B

1. Navigate to **Parisishtha B** → **Create**
2. Select vendor invoice (or create standalone)
3. Enter government voucher number and date
4. Add daily entries:
   - Date
   - Kilometers
   - Diesel liters
   - Expenses
5. System calculates:
   - Diesel as per government rates
   - Extra diesel charges
   - Total amounts
6. Save Parisishtha B
7. Can be printed as PDF

### Use Case 3: Generating Bill Summary

1. Navigate to **Bill Summary** → **Create**
2. Select:
   - Vendor
   - Vehicle
   - Billing Period
3. System shows available:
   - Parisishtha A records
   - Parisishtha B records
   - Vendor invoices
4. Select records to include
5. System calculates:
   - Vendor invoice amount
   - Government approved amount
   - Deductions
   - Final payable amount
6. Save bill summary
7. Bill enters approval workflow

### Use Case 4: Approval Workflow

1. Approver logs in
2. Navigate to **Bill Summary Confirm**
3. View pending bill summaries (filtered by access level)
4. Review bill details:
   - View linked vendor invoice
   - View Parisishtha A
   - View Parisishtha B
5. Options:
   - **Approve**: Move to next approver in sequence
   - **Raise Query**: Add query remarks, bill returns to vendor
6. Query Resolution:
   - Vendor resolves query
   - Query status updated
   - Bill returns to approval queue

### Use Case 5: Managing Routes and Rates

1. **Create Route**:
   - Navigate to **Route Master** → **Create**
   - Select from depot and to depot
   - Enter scheduled KM
   - Enter scheduled time
   - Select bus type
   - Set maximum idling minutes
   - Save route

2. **Create Rate**:
   - Navigate to **Rate Master** → **Create**
   - Select bus type
   - Enter from KM and to KM range
   - Enter rate per KM
   - Save rate

3. Rates are automatically applied when creating vendor invoices based on route and actual KM.

---

## Known Limitations

### 1. OTP Hardcoded
- **Issue**: OTP for password reset is hardcoded to '123456' in `LoginController.php`
- **Location**: `app/Http/Controllers/Auth/LoginController.php` (lines 61, 140)
- **Impact**: Security risk in production
- **Recommendation**: Enable SMS gateway integration or use email-based OTP

### 2. Missing Middleware File
- **Issue**: `PreventBackHistory` middleware is referenced in routes but file doesn't exist
- **Location**: Referenced in `routes/web.php` line 46 and `app/Http/Kernel.php` line 63
- **Impact**: Application may throw errors when accessing routes with this middleware
- **Recommendation**: Create the middleware file or remove the reference

### 3. SMS Integration Disabled
- **Issue**: SMS Gateway Hub integration code is commented out
- **Location**: `app/Http/Controllers/Auth/LoginController.php`
- **Impact**: OTP functionality not working
- **Recommendation**: Uncomment and configure SMS gateway or implement alternative

### 4. No Scheduled Tasks
- **Issue**: No cron jobs or scheduled tasks configured
- **Impact**: No automated processes (reminders, reports, etc.)
- **Recommendation**: Implement scheduled tasks for business-critical processes

### 5. Limited API Endpoints
- **Issue**: `routes/api.php` only contains default Laravel route
- **Impact**: No REST API for external integrations
- **Recommendation**: Implement API endpoints if needed for integrations

### 6. Database Defaults in Config
- **Issue**: Database credentials are hardcoded in `config/database.php`
- **Location**: `config/database.php` lines 46-48
- **Impact**: Security risk if config is committed
- **Recommendation**: Use environment variables only

### 7. No Queue Configuration
- **Issue**: Queue connection is set to 'sync' by default
- **Impact**: Long-running tasks block requests
- **Recommendation**: Configure proper queue driver for production

### 8. Limited Error Handling
- **Issue**: Some controllers may lack comprehensive error handling
- **Impact**: User experience may be affected by unhandled errors
- **Recommendation**: Implement try-catch blocks and proper error responses

---

## Future Improvements

Based on code analysis, the following improvements are recommended:

### Security Enhancements
1. **Enable SMS Gateway**: Implement proper OTP generation and SMS sending
2. **Create PreventBackHistory Middleware**: Implement the missing middleware
3. **Remove Hardcoded Credentials**: Move all credentials to environment variables
4. **Implement API Authentication**: Add proper API authentication if REST API is needed
5. **Add Rate Limiting**: Implement rate limiting for login and OTP endpoints

### Functionality Improvements
1. **Automated Notifications**: 
   - Email/SMS notifications for pending approvals
   - Reminder notifications for overdue bills
   - Query resolution notifications

2. **Reporting Module**:
   - Dashboard with key metrics
   - Financial reports
   - Vendor performance reports
   - Route utilization reports

3. **Audit Trail**:
   - Comprehensive logging of all actions
   - User activity tracking
   - Change history for all records

4. **Bulk Operations**:
   - Bulk invoice creation
   - Bulk approval
   - Bulk export

5. **Advanced Search**:
   - Full-text search
   - Advanced filtering options
   - Saved search filters

### Technical Improvements
1. **API Development**: 
   - RESTful API for mobile app integration
   - API documentation (Swagger/OpenAPI)

2. **Queue Implementation**:
   - Move heavy operations to queues
   - Background PDF generation
   - Email/SMS queue processing

3. **Caching Strategy**:
   - Cache frequently accessed data
   - Redis integration for session storage
   - Query result caching

4. **Database Optimization**:
   - Add indexes for frequently queried columns
   - Optimize complex queries
   - Implement database archiving

5. **Testing**:
   - Unit tests for models and helpers
   - Feature tests for controllers
   - Integration tests for workflows

6. **Code Quality**:
   - Implement PSR-12 coding standards
   - Add PHPDoc comments
   - Refactor duplicate code
   - Implement service layer pattern

### User Experience Improvements
1. **Responsive Design**: Ensure mobile-friendly interface
2. **Progressive Web App**: Convert to PWA for mobile access
3. **Real-time Updates**: WebSocket integration for live updates
4. **Bulk Import**: Excel/CSV import for master data
5. **Advanced Filters**: More filtering options in listings

---

## Contribution Guidelines

### Getting Started

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Make your changes
4. Commit your changes (`git commit -m 'Add some amazing feature'`)
5. Push to the branch (`git push origin feature/amazing-feature`)
6. Open a Pull Request

### Coding Standards

- Follow PSR-12 coding standards
- Use meaningful variable and function names
- Add comments for complex logic
- Write unit tests for new features
- Update documentation for API changes

### Commit Messages

- Use clear, descriptive commit messages
- Reference issue numbers if applicable
- Follow conventional commit format when possible

### Pull Request Process

1. Ensure all tests pass
2. Update documentation if needed
3. Request review from maintainers
4. Address review comments
5. Wait for approval before merging

### Reporting Issues

When reporting issues, please include:
- Description of the issue
- Steps to reproduce
- Expected behavior
- Actual behavior
- Environment details (PHP version, Laravel version, etc.)
- Screenshots if applicable

---

## License

This project is licensed under the **MIT License** - see the `composer.json` file for details.

---

## Support & Contact

For support, please contact the development team or create an issue in the repository.

---

## Acknowledgments

- Built with [Laravel Framework](https://laravel.com)
- Uses [Laravel DomPDF](https://github.com/barryvdh/laravel-dompdf) for PDF generation
- Uses [Yajra DataTables](https://yajrabox.com/docs/laravel-datatables) for server-side data tables
- Frontend built with [Bootstrap](https://getbootstrap.com) and [Vue.js](https://vuejs.org)

---

**Last Updated**: Generated from codebase analysis
**Version**: Based on Laravel 5.6
