# Gideon’s Church Website (Modern Local Church)

## What’s included
- Modern shared layout/navigation
- `index.php` (Home)
- Sermon Archive: `sermons.php` (filters by date, speaker, topic)
- Ministries Directory: `ministries.php`
- Connect Card: `connect.php` (PHP backend stub)
- Location & Times: `location.php`
- MySQL schema + PHP helpers

## Setup
1. Copy this folder to your PHP server root.
2. Create a MySQL database and run the SQL in `db/church_db.sql`.
3. Update DB credentials in `config/db.php`.
4. Open `index.php`.

## Notes
- Sermon data is expected from DB table `sermons`.
- Connect card form posts to `connect.php` and saves to `connect_cards`.

