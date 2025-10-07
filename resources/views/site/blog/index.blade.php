<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Car Hire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .blog-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 30px;
            overflow: hidden;
        }
        .blog-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }
        .blog-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .blog-content {
            padding: 20px;
        }
        .blog-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
            line-height: 1.3;
        }
        .blog-description {
            color: #6c757d;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .blog-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        .blog-date {
            color: #6c757d;
            font-size: 0.85rem;
        }
        .read-more-btn {
            background: linear-gradient(135deg, #ff6b35, #f7931e);
            border: none;
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .read-more-btn:hover {
            background: linear-gradient(135deg, #e55a2b, #e0841a);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        }
        .sidebar-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            overflow: hidden;
        }
        .sidebar-header {
            background: #f8f9fa;
            padding: 15px 20px;
            border-bottom: 1px solid #e9ecef;
            font-weight: 600;
            color: #2c3e50;
        }
        .sidebar-content {
            padding: 20px;
        }
        .featured-blog {
            position: relative;
            height: 200px;
            background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://via.placeholder.com/400x200/2c3e50/ffffff?text=Featured+Blog');
            background-size: cover;
            background-position: center;
            border-radius: 8px;
            display: flex;
            align-items: flex-end;
            padding: 20px;
            color: white;
            text-decoration: none;
        }
        .featured-blog:hover {
            color: white;
            text-decoration: none;
        }
        .featured-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 5px;
        }
        .featured-date {
            font-size: 0.85rem;
            opacity: 0.9;
        }
        .tag {
            display: inline-block;
            background: #e9ecef;
            color: #495057;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            margin: 3px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .tag:hover {
            background: #ff6b35;
            color: white;
            text-decoration: none;
        }
        .tag.active {
            background: #ff6b35;
            color: white;
        }
        .loading {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }
        .no-blogs {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
        }
        .no-blogs i {
            font-size: 3rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-4">
        <div class="container">
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div id="blogs-container">
                        <div class="loading">
                            <i class="fas fa-spinner fa-spin"></i> Loading blogs...
                        </div>
                    </div>
                    
                    <!-- Pagination -->
                    <div id="pagination-container" class="d-flex justify-content-center mt-4">
                    </div>
                </div>
                
                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Featured Blog -->
                    <div class="sidebar-card">
                        <div class="sidebar-header">
                            <i class="fas fa-star me-2"></i>Featured Article
                        </div>
                        <div class="sidebar-content">
                            <div id="featured-blog">
                                <div class="loading">Loading featured blog...</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tags -->
                    <div class="sidebar-card">
                        <div class="sidebar-header">
                            <i class="fas fa-tags me-2"></i>Tags
                        </div>
                        <div class="sidebar-content">
                            <div id="tags-container">
                                <div class="loading">Loading tags...</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentPage = 1;
        let selectedTag = null;
        const baseUrl = '{{ url("/api") }}';
        
        // Load blogs
        async function loadBlogs(page = 1, tag = null) {
            try {
                let url = `${baseUrl}/blogs?page=${page}`;
                if (tag) {
                    url = `${baseUrl}/blogs-search?tag=${encodeURIComponent(tag)}&page=${page}`;
                }
                
                const response = await fetch(url);
                const data = await response.json();
                
                if (data.status === 200) {
                    displayBlogs(data.data.data);
                    displayPagination(data.data);
                } else {
                    showNoBlogs();
                }
            } catch (error) {
                console.error('Error loading blogs:', error);
                showNoBlogs();
            }
        }
        
        // Display blogs
        function displayBlogs(blogs) {
            const container = document.getElementById('blogs-container');
            
            if (blogs.length === 0) {
                showNoBlogs();
                return;
            }
            
            const blogsHtml = blogs.map(blog => `
                <div class="blog-card">
                    <img src="${blog.image || 'https://via.placeholder.com/400x200/6c757d/ffffff?text=No+Image'}" 
                         alt="${blog.title}" class="blog-image">
                    <div class="blog-content">
                        <h3 class="blog-title">${blog.title}</h3>
                        <p class="blog-description">${blog.short_description}</p>
                        <div class="blog-meta">
                            <span class="blog-date">${blog.formatted_date}</span>
                            <button class="read-more-btn" onclick="viewBlog(${blog.id})">
                                <i class="fas fa-arrow-right me-1"></i>Read More
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
            
            container.innerHTML = blogsHtml;
        }
        
        // Display pagination
        function displayPagination(pagination) {
            const container = document.getElementById('pagination-container');
            
            if (pagination.last_page <= 1) {
                container.innerHTML = '';
                return;
            }
            
            let paginationHtml = '<nav><ul class="pagination">';
            
            // Previous button
            if (pagination.current_page > 1) {
                paginationHtml += `
                    <li class="page-item">
                        <a class="page-link" href="#" onclick="loadBlogs(${pagination.current_page - 1}, '${selectedTag}')">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    </li>
                `;
            }
            
            // Page numbers
            for (let i = 1; i <= pagination.last_page; i++) {
                if (i === pagination.current_page) {
                    paginationHtml += `<li class="page-item active"><span class="page-link">${i}</span></li>`;
                } else {
                    paginationHtml += `
                        <li class="page-item">
                            <a class="page-link" href="#" onclick="loadBlogs(${i}, '${selectedTag}')">${i}</a>
                        </li>
                    `;
                }
            }
            
            // Next button
            if (pagination.current_page < pagination.last_page) {
                paginationHtml += `
                    <li class="page-item">
                        <a class="page-link" href="#" onclick="loadBlogs(${pagination.current_page + 1}, '${selectedTag}')">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>
                `;
            }
            
            paginationHtml += '</ul></nav>';
            container.innerHTML = paginationHtml;
        }
        
        // Show no blogs message
        function showNoBlogs() {
            document.getElementById('blogs-container').innerHTML = `
                <div class="no-blogs">
                    <i class="fas fa-newspaper"></i>
                    <h4>No blogs found</h4>
                    <p>There are no blogs available at the moment.</p>
                </div>
            `;
        }
        
        // Load featured blog
        async function loadFeaturedBlog() {
            try {
                const response = await fetch(`${baseUrl}/blogs-latest`);
                const data = await response.json();
                
                if (data.status === 200 && data.data.length > 0) {
                    const featuredBlog = data.data[0];
                    document.getElementById('featured-blog').innerHTML = `
                        <a href="#" class="featured-blog" onclick="viewBlog(${featuredBlog.id})">
                            <div>
                                <div class="featured-title">${featuredBlog.title}</div>
                                <div class="featured-date">${featuredBlog.formatted_date}</div>
                            </div>
                        </a>
                    `;
                } else {
                    document.getElementById('featured-blog').innerHTML = `
                        <div class="text-muted text-center py-3">No featured blog available</div>
                    `;
                }
            } catch (error) {
                console.error('Error loading featured blog:', error);
                document.getElementById('featured-blog').innerHTML = `
                    <div class="text-muted text-center py-3">Error loading featured blog</div>
                `;
            }
        }
        
        // Load tags
        async function loadTags() {
            try {
                const response = await fetch(`${baseUrl}/blogs-tags`);
                const data = await response.json();
                
                if (data.status === 200 && data.data.length > 0) {
                    const tagsHtml = data.data.map(tag => `
                        <a href="#" class="tag" onclick="filterByTag('${tag}')">${tag}</a>
                    `).join('');
                    
                    document.getElementById('tags-container').innerHTML = tagsHtml;
                } else {
                    document.getElementById('tags-container').innerHTML = `
                        <div class="text-muted text-center py-3">No tags available</div>
                    `;
                }
            } catch (error) {
                console.error('Error loading tags:', error);
                document.getElementById('tags-container').innerHTML = `
                    <div class="text-muted text-center py-3">Error loading tags</div>
                `;
            }
        }
        
        // Filter by tag
        function filterByTag(tag) {
            selectedTag = tag;
            currentPage = 1;
            
            // Update active tag
            document.querySelectorAll('.tag').forEach(t => t.classList.remove('active'));
            event.target.classList.add('active');
            
            loadBlogs(1, tag);
        }
        
        // View blog details
        function viewBlog(id) {
            // This would typically navigate to a blog detail page
            alert(`Viewing blog ${id} - This would navigate to blog detail page`);
        }
        
        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            loadBlogs();
            loadFeaturedBlog();
            loadTags();
        });
    </script>
</body>
</html>
