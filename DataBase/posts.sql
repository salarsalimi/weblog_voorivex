-- Posts table to store blog posts
CREATE TABLE posts (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author_id INT NOT NULL,
    publication_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
