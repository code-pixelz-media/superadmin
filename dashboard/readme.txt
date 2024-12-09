file folder structure for reference
/dzyns/
│
├── /config/                 # Configuration files
│   └── config.php           # Database and global configuration
│
├── /public/                 # Publicly accessible files (HTML, CSS, JS)
│   ├── /css/                # Stylesheets
│   │   ├── style.css
│   │   └── dashboard.css    # Specific CSS for user dashboard
│   ├── /js/                 # JavaScript files
│   │   ├── main.js
│   │   └── dashboard.js     # JavaScript for user dashboard functionality
│   ├── /images/             # Images and other media assets
│   └── index.php            # Main entry point (home page)
│
├── /src/                    # Application logic
│   ├── /controllers/        # Handle requests and manage views
│   │   ├── TaskController.php
│   │   ├── UserController.php
│   │   └── DashboardController.php  # Controller for user dashboard
│   ├── /models/             # Database-related logic (CRUD operations)
│   │   ├── Task.php
│   │   ├── User.php
│   │   └── Dashboard.php    # Dashboard model for user-specific data
│   └── /core/               # Core components like routing and base controllers
│       ├── Controller.php   # Base controller class
│       └── Router.php       # Routing logic
│
├── /views/                  # HTML templates and views
│   ├── /tasks/              # View files related to tasks
│   │   ├── list.php         # List view for tasks
│   │   └── edit.php         # Edit view for tasks
│   ├── /users/              # View files related to users
│   │   ├── list.php         # List view for users
│   │   └── edit.php         # Edit view for users
│   ├── /dashboard/          # Views specific to the user dashboard
│   │   ├── overview.php     # Dashboard overview page
│   │   ├── profile.php      # User profile view in dashboard
│   │   ├── settings.php     # User settings page
│   │   └── activity.php     # User activity log page
│   └── layouts/             # Main layouts
│       ├── header.php       # Header layout
│       ├── footer.php       # Footer layout
│       └── dashboard_header.php  # Header specific to dashboard (optional)
│
├── /includes/               # Reusable PHP components
│   ├── header.php           # Header component
│   ├── footer.php           # Footer component
│   └── sidebar.php          # Sidebar component for user dashboard
│
├── /helpers/                # Utility functions
│   └── helpers.php          # Helper functions for validation, formatting, etc.
│
├── /logs/                   # Application logs
│   └── error.log            # Log errors for debugging
│
├── /assets/                 # Additional assets like icons, fonts
│   └── /icons/              # Icons and SVGs
│
├── /vendor/                 # Third-party libraries (if any, e.g., Composer packages)
│
└── .htaccess                # Apache configuration for URL rewriting




Nov5 - Nov8
    - Login
    - Register
    - Create Project
    - New Task