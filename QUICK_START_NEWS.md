# NEWS FUNCTIONALITY - QUICK START GUIDE

## 🎯 What's Been Implemented

Your Blantyre District Council website now has a **fully functional NEWS SYSTEM** that allows:

✅ **Admins** to create, edit, and publish news articles  
✅ **Public visitors** to view published news on the `/news` page  
✅ **Featured images** for news articles  
✅ **Draft/Published status** control  
✅ **Search and filtering** in admin panel  

---

## 🚀 Quick Start (Step-by-Step)

### Step 1: Log Into Admin Panel
- Go to your site's admin login page
- Log in with your admin credentials

### Step 2: Go to News Management
- Click on **News** in the admin sidebar (newspaper icon)
- Or navigate to: `yourdomain.com/admin/news`

### Step 3: Create a New Article
- Click the blue **"Add News"** button
- Fill in the form:
  - **Headline**: Your news article title
  - **News Content**: The full article text
  - **Featured Image**: Optional - upload a nice image
  - **Status**: Choose "Publish now" or "Save as draft"
- Click **"Save News"**

### Step 4: See Your News Published
- Visit `yourdomain.com/news` 
- Your published article appears in the news feed!
- Click "More" to expand and read full content

---

## 📝 Admin Panel Features

### News Management Page (`/admin/news`)

**Create**
- Click "Add News" button in top right
- Fills a form to create new articles

**List**
- See all your news articles in a table
- Shows: ID, Title, Status, Published Date, Created Date
- Articles can be in draft (hidden) or published (public) status

**Search**
- Use the search box to find articles by title or content
- Results update instantly

**Edit**
- Click the pencil icon on any article to edit
- Update title, content, image, or status

**Delete**
- Click the trash icon to delete an article
- Confirm the deletion

---

## 🎨 Public News Page (`/news`)

Visitors see your published news in a beautiful layout:

- **Modern card design** with hover effects
- **Featured images** displayed prominently
- **Preview text** (auto-generated from content)
- **Publication dates** for each article
- **Expandable cards** to read full content
- **Newest articles first** (ordered by date)
- **Responsive design** - works on mobile and desktop

---

## 📋 Article Fields Explained

| Field | Purpose | Auto-Filled? |
|-------|---------|--------------|
| **Headline** | Article title (max 255 chars) | ❌ You enter |
| **News Content** | Full article body | ❌ You enter |
| **Featured Image** | Optional image for article | ❌ You upload |
| **Status** | draft or published | ❌ You choose |
| **Slug** | URL identifier (e.g., "my-news") | ✅ Auto-generated |
| **Excerpt** | Preview text (150 chars) | ✅ Auto-generated |
| **Author** | Who created article | ✅ Your username |
| **Published Date** | When article went public | ✅ Set on publish |
| **Created Date** | When article was created | ✅ Auto-set |

---

## 💡 Tips & Best Practices

### Creating Great Articles
1. Use a clear, descriptive headline
2. Write engaging content (news, updates, announcements)
3. Add a featured image for visual appeal
4. Keep content readable with short paragraphs

### Using Status Correctly
- **Draft** - For articles in progress, not ready for public
- **Published** - Article is live and visible to everyone
- **Archived** - Hide old articles from public view while keeping them

### Image Tips
- Use JPG or PNG format
- Keep images under 5MB
- Use clear, high-quality images
- Recommended size: 1200x600px for best appearance

---

## 🔧 Technical Details (For Developers)

### File Structure
```
App/Controllers/AdminController.php    - News management logic
App/Models/NewsModel.php               - Database model
App/Views/admin/news.php              - Admin list view
App/Views/admin/create_news.php       - Create form
App/Views/admin/edit_news.php         - Edit form
App/Views/news/index.php              - Public display
public/image/news/                    - Image storage
```

### Database Table: `news`
- id (Primary Key)
- title (VARCHAR 255)
- slug (VARCHAR 255, UNIQUE)
- content (TEXT)
- excerpt (TEXT)
- featured_image (VARCHAR 500)
- status (ENUM: draft, published, archived)
- author_id (Foreign Key → users)
- published_at (TIMESTAMP)
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)

### Routes
```
GET  /admin/news              → List all articles
GET  /admin/news/create       → Show create form
POST /admin/news/create       → Save new article
GET  /admin/news/{id}/edit    → Show edit form
POST /admin/news/{id}/edit    → Update article
POST /admin/news/{id}/delete  → Delete article
GET  /news                    → Public news page
```

---

## ❓ Frequently Asked Questions

**Q: Can I schedule articles for future publish?**  
A: Not currently. Articles are published immediately when you select "Publish now"

**Q: What image formats are supported?**  
A: JPG, PNG, GIF (max 5MB each)

**Q: Can I unpublish an article?**  
A: Yes, edit the article and change status from "published" to "draft" or "archived"

**Q: How long is the auto-generated excerpt?**  
A: 150 characters of your content (excluding HTML tags)

**Q: Who is listed as the author?**  
A: Automatically set to the admin user who created the article

**Q: Is there a character limit for content?**  
A: No limit - you can write as much as you want

**Q: Can I delete published articles?**  
A: Yes, the delete button works for any article regardless of status

---

## 📞 Support

If you encounter any issues:

1. **Check the admin logs** - Look for error messages
2. **Verify image upload** - Ensure file is < 5MB and correct format
3. **Check permissions** - Ensure directory `public/image/news/` exists
4. **Database migration** - Run: `php spark migrate`

---

## 🎉 You're All Set!

Your NEWS system is ready to use. Start creating and publishing news articles today!

**Next steps:**
1. Log in to admin panel
2. Go to News Management
3. Create your first news article
4. Publish it
5. Share the `/news` page with your community!

Enjoy your new news publishing system! 📰
